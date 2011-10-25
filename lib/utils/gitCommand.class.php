<?php

class GitCommand
{
  /**
   * @static
   * @param string $gitDir
   * @return void
   */
  public static function fetch($gitDir)
  {
    $cmd = sprintf('git --git-dir="%s/.git" fetch -p', $gitDir);
    exec($cmd, $tata, $retour);
  }
  
  /**
   * @static
   * @param string $gitDir
   * @return string
   */
  public static function getCurrentBranch($gitDir)
  {
    $cmd = sprintf("git --git-dir='%s/.git' branch | grep \* | sed 's/* //g'", $gitDir);
    exec($cmd, $branch);
    if(count($branch)==0)
    {
      exit('No branch selected in '.$gitDir);
    }
    return $branch[0];
  }

  /**
   * @static
   * @param int $nbDays
   * @param string $gitDir
   * @return array
   */
  public static function getCommits($nbDays, $gitDir)
  {
    self::fetch($gitDir);
    
    $separator = '°';
    $from = date('Y-m-d 00:00:00', strtotime(sprintf("-%s days", $nbDays - 1)));
    $cmd = sprintf('git --git-dir="%s/.git" log --no-merges --ignore-all-space --since="%s" --format="%%ci%s%%ce%s%%cn%s%%h%s%%s" --numstat', $gitDir, $from, $separator, $separator, $separator, $separator);
    exec($cmd, $results);

    $commits = array();
    $commit = array();
    foreach($results as $line)
    {
      if(strlen($line) == 0)
      {
        continue;
      }
      if(strpos($line, $separator) !== false)
      {
        if(count($commit) > 0)
        {
          $commits[] = $commit;
        }
        $commit = self::getCommitFromLine($line, $separator);
      }
      else
      {
        $elements = preg_split("/[\s]+/", $line, null, PREG_SPLIT_NO_EMPTY);
        $commit['files'][] = array(
          'add' => $elements[0],
          'delete' => $elements[1],
          'file' => $elements[2],
        );
      }
    }

    if(count($commit) > 0)
    {
      $commits[] = $commit;
    }

    return $commits;
  }

  /**
   * @static
   * @param string $commits
   * @param string $displayPattern
   * @param string $pattern
   * @param string $timeUnit
   * @param string $iteration
   * @return array
   */
  public static function getBackwardInfos($commits, $displayPattern, $pattern, $timeUnit, $iteration)
  {
    $infos = array();
    $scanIndex = 0;
    $timeIndex = 0;

    for($i = 0; $i < $iteration; $i++)
    {
      $scannedDate = date($pattern, strtotime(sprintf("-%s %s", $i, $timeUnit)));
      $infos[$timeIndex]['displayDate'] = date($displayPattern, strtotime(sprintf("-%s %s", $i, $timeUnit)));
      $infos[$timeIndex]['nb-commits'] = 0;
      $infos[$timeIndex]['nb-files'] = 0;
      while(isset($commits[$scanIndex]) && strpos($commits[$scanIndex]['date'], $scannedDate) === 0)
      {
        $infos[$timeIndex]['nb-commits']++;
        $infos[$timeIndex]['nb-files'] += count($commits[$scanIndex]['files']);
        $scanIndex++;
      }
      $timeIndex++;
    }

    return $infos;
  }

  /**
   * @static
   * @param string $gitDir
   * @return array
   */
  public static function getNoMergedBranchesInfos($gitDir)
  {
    self::fetch($gitDir);

    $noMerdegBranchesInfos = array();

    $cmd = sprintf('git --git-dir="%s/.git" branch -r --no-merged | grep -v "*" | sed "s/ //g"', $gitDir);
    exec($cmd, $results);
    foreach($results as $result)
    {
      if(strpos($result, '->') !== false)
      {
        continue;
      }

      $cmd = sprintf('git --git-dir="%s/.git" log HEAD..%s --format="%%P" | tail -1', $gitDir, $result);
      exec($cmd, $commitRef);
      $noMerdegBranchesInfos[$result]['commit_reference'] = $commitRef[0];
      unset($commitRef);

      $cmd = sprintf('git --git-dir="%s/.git" log HEAD..%s --format="%%H" | head -1', $gitDir, $result);
      exec($cmd, $commitStatus);
      $noMerdegBranchesInfos[$result]['commit_status_changed'] = $commitStatus[0];
      unset($commitStatus);
    }

    return $noMerdegBranchesInfos;
  }

  /**
   * @static
   * @param $line
   * @param $separator
   * @return array
   */
  public static function getCommitFromLine($line, $separator)
  {
    $elements = explode($separator, $line);
    $commit = array(
      'date' => date('Y-m-d H:i:s', strtotime($elements[0])),
      'email' => $elements[1],
      'name' => $elements[2],
      'hash' => $elements[3],
      'message' => $elements[4],
      'files' => array()
    );

    return $commit;
  }

  /**
   * @static
   * @param string $gitDir
   * @param string $referenceCommit
   * @param string $lastCommit
   * @return array
   */
  public static function getDiffFilesFromBranch($gitDir, $referenceCommit, $lastCommit)
  {
    self::fetch($gitDir);

    $cmd = sprintf('git --git-dir="%s/.git" diff %s..%s --name-status', $gitDir,  $referenceCommit, $lastCommit);
    exec($cmd, $results);

    $diffFiles = array();

    foreach($results as $result)
    {
      $diffFiles[substr($result,2)] = array(
        'state' => substr($result,0, 1),
        'filename' => substr($result,2)
      );
    }

    return $diffFiles;
  }

  /**
   * @static
   * @param string $gitDir
   * @param string $currentCommit
   * @param string $referenceCommit
   * @param string $filename
   * @return string
   */
  public static function getShowFileFromBranch($gitDir, $currentCommit, $referenceCommit, $filename)
  {
    self::fetch($gitDir);

    $cmd = sprintf('git --git-dir="%s/.git" diff -U9999 %s..%s -- %s', $gitDir,  $currentCommit, $referenceCommit, $filename);
    exec($cmd, $currentContentLinesResults);

    $patternFinded = false;
    $fileLines = $currentContentLinesResults;

    foreach($currentContentLinesResults as $key => $currentContentLinesResult)
    {
      if($patternFinded === false)
      {
        unset($fileLines[$key]);
        if(substr($currentContentLinesResult, 0, 2) == "@@")
        {
          break;
        }
      }
    }
    return $fileLines;
  }
}