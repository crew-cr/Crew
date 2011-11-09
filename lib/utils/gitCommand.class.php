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
    $cmd = sprintf("git --git-dir='%s/.git' remote -v | grep origin | head -n1 | tr -d '\t' | sed 's/origin//' | cut -d' ' -f1", $gitDir);
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
    $cmd = sprintf('git --git-dir="%s/.git" fetch -p origin', $gitDir);
    exec($cmd, $tata, $retour);
  }
  
  /**
   * @static
   * @param string $gitDir
   * @return array
   */
  public static function getNoMergedBranchesInfos($gitDir, $baseBranchName = 'origin/master', $branch = null)
  {
    self::fetch($gitDir);

    $noMerdegBranchesInfos = array();

    if(is_null($branch))
    {
      $cmd = sprintf('git --git-dir="%s/.git" branch -r --no-merged | grep -v "*" | sed "s/ //g"', $gitDir);
    }
    else
    {
      $cmd = sprintf('git --git-dir="%s/.git" branch -r --no-merged | grep %s | sed "s/ //g"', $gitDir, $branch);
    }
    exec($cmd, $results);

    foreach($results as $result)
    {
      if(strpos($result, '->') !== false)
      {
        continue;
      }

      $cmd = sprintf('git --git-dir="%s/.git" merge-base %s %s | head -1', $gitDir, $baseBranchName, $result);
      exec($cmd, $commitRef);
      $noMerdegBranchesInfos[$result]['commit_reference'] = (count($commitRef)) ? $commitRef[0] : '';
      unset($commitRef);

      $cmd = sprintf('git --git-dir="%s/.git" rev-parse --verify %s', $gitDir, $result);
      exec($cmd, $commitStatus);
      $noMerdegBranchesInfos[$result]['last_commit'] = (count($commitStatus)) ? $commitStatus[0] : '';
      unset($commitStatus);
    }

    return $noMerdegBranchesInfos;
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
  public static function getShowFileFromBranch($gitDir, $referenceCommit, $currentCommit, $filename)
  {
    self::fetch($gitDir);

    $cmd = sprintf('git --git-dir="%s/.git" diff -U9999 %s..%s -- %s', $gitDir, $referenceCommit, $currentCommit, $filename);
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
    $cmd = sprintf('git --git-dir="%s/.git" log %s --format="%%H" -- %s | head -n1', $gitDir, $branch, $filename);
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
    $cmd = sprintf('git clone %s %s', $repositoryReadOnlyUrl, $path);
    exec($cmd, $return, $status);
    return $status;
  }

  public static function commitIsInHistory($gitDir, $commit, $searchedCommit)
  {
    $cmd = sprintf('git --git-dir="%s/.git" log %s | grep %s', $gitDir, $commit, $searchedCommit);
    exec($cmd, $return);
    return (count($return) > 0);
  }
}
