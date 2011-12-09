<?php

class GitCommand
{
  /**
   * @static
   * @param string $gitDir
   * @return string
   */
  public static function getRemote($gitDir)
  {
    $cmd = sprintf("git --git-dir='%s' remote -v | head -n1 | tr -d '\t' | cut -d' ' -f1", $gitDir);
    exec($cmd, $remote);
    return (count($remote)) ? $remote[0] : '';
  }

  /**
   * @static
   * @param string $gitDir
   * @return void
   */
  public static function fetch($gitDir)
  {
    $cmd = sprintf('git --git-dir="%s" fetch -p origin', $gitDir);
    exec($cmd, $tata, $retour);
  }
  
  /**
   * @static
   * @param string $gitDir
   * @return array
   */
  public static function getNoMergedBranchInfos($gitDir, $baseBranch, $branch)
  {
    self::fetch($gitDir);

    $cmd = sprintf('git --git-dir="%s" branch --no-merged %s | grep %s | sed "s/ //g"', $gitDir, $baseBranch, $branch);
    exec($cmd, $result);
    if(count($result) == 0 || strpos($result[0], '->') !== false || $result[0] != $branch)
    {
      return null;
    }

    $noMergedBranchInfos = array();

    $cmd = sprintf('git --git-dir="%s" merge-base %s %s | head -1', $gitDir, $baseBranch, $branch);
    exec($cmd, $commitRef);
    $noMergedBranchInfos['commit_reference'] = (count($commitRef)) ? $commitRef[0] : '';

    $cmd = sprintf('git --git-dir="%s" rev-parse --verify %s', $gitDir, $branch);
    exec($cmd, $commitStatus);
    $noMergedBranchInfos['last_commit'] = (count($commitStatus)) ? $commitStatus[0] : '';

    $noMergedBranchInfos['last_commit_desc'] = self::getCommitInfos($gitDir, $branch, '%s');

    return $noMergedBranchInfos;
  }

  /**
   * @static
   * @param string $gitDir
   * @param string $referenceCommit
   * @param string $lastCommit
   * @return array
   */
  public static function getDiffFilesFromBranch($gitDir, $referenceCommit, $lastCommit, $withDetails = true)
  {
    self::fetch($gitDir);

    $cmd = sprintf('git --git-dir="%s" diff %s..%s --name-status', $gitDir,  $referenceCommit, $lastCommit);
    exec($cmd, $results);

    if($withDetails)
    {
      $cmd = sprintf('git --git-dir="%s" diff %s..%s --numstat | grep "^[0-9]" | sed "s/\t/ /g"', $gitDir,  $referenceCommit, $lastCommit);
      exec($cmd, $lineResults);

      $linesInfos = array();
      foreach($lineResults as $line)
      {
        $infos = explode(' ', $line);
        if(count($infos) == 3)
        {
          $linesInfos[$infos[2]] = array($infos[0], $infos[1]);
        }
      }
    }

    $diffFiles = array();
    foreach($results as $result)
    {
      $filename = substr($result, 2);

      $diffFiles[$filename] = array(
        'state' => substr($result,0, 1),
        'filename' => $filename
      );

      if($withDetails)
      {
        $diffFiles[$filename]['added-lines'] = (isset($linesInfos[$filename])) ? $linesInfos[$filename][0] : '';
        $diffFiles[$filename]['deleted-lines'] = (isset($linesInfos[$filename])) ? $linesInfos[$filename][1] : '';
      }
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
  public static function getShowFile($gitDir, $currentCommit, $filename)
  {
    self::fetch($gitDir);

    $cmd = sprintf('git --git-dir="%s" show %s:%s', $gitDir, $currentCommit, $filename);
    exec($cmd, $fileContent);

    return implode(PHP_EOL, $fileContent);
  }

  /**
   * @static
   * @param string $gitDir
   * @param string $currentCommit
   * @param string $referenceCommit
   * @param string $filename
   * @return string
   */
  public static function getShowFileFromBranch($gitDir, $referenceCommit, $currentCommit, $filename)
  {
    self::fetch($gitDir);

    $cmd = sprintf('git --git-dir="%s" diff -U9999 %s..%s -- %s', $gitDir, $referenceCommit, $currentCommit, $filename);
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

  public static function getLastModificationCommit($gitDir, $branch, $filename)
  {
    $cmd = sprintf('git --git-dir="%s" log %s --format="%%H" -- %s | head -n1', $gitDir, $branch, $filename);
    exec($cmd, $return);
    return (count($return)) ? $return[0] : false;
  }

  /**
   * @static
   * @param $repositoryReadOnlyUrl
   * @param $path
   * @return int
   */
  public static function cloneRepository($repositoryReadOnlyUrl, $path)
  {
    $cmd = sprintf('git clone --mirror %s %s', $repositoryReadOnlyUrl, $path);
    exec($cmd, $return, $status);
    return $status;
  }

  public static function commitIsInHistory($gitDir, $commit, $searchedCommit)
  {
    $cmd = sprintf('git --git-dir="%s" log %s | grep %s', $gitDir, $commit, $searchedCommit);
    exec($cmd, $return);
    return (count($return) > 0);
  }

  public static function getCommitInfos($gitDir, $commit, $format)
  {
    $cmd = sprintf('git --git-dir="%s" log %s --format="%s" -n1', $gitDir, $commit, $format);
    exec($cmd, $return);
    return (count($return)) ? $return[0] : '';
  }
}
