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
    $remote = GitCommand::exec(sprintf("git --git-dir='%s' remote -v | head -n1 | tr -d '\t' | cut -d' ' -f1", $gitDir));
    return (count($remote)) ? $remote[0] : '';
  }

  /**
   * @static
   * @param string $gitDir
   * @return void
   */
  public static function fetch($gitDir)
  {
    GitCommand::exec(sprintf('git --git-dir="%s" fetch -p origin', $gitDir));
  }
  
  /**
   * @static
   * @param string $gitDir
   * @return array
   */
  public static function getNoMergedBranchInfos($gitDir, $baseBranch, $branch)
  {
    self::fetch($gitDir);

    $result = GitCommand::exec(sprintf('git --git-dir="%s" branch --no-merged %s | grep %s | sed "s/ //g"', $gitDir, $baseBranch, $branch));
    if(count($result) == 0 || strpos($result[0], '->') !== false || $result[0] != $branch)
    {
      return null;
    }

    $noMergedBranchInfos = array();

    $commitRef = GitCommand::exec(sprintf('git --git-dir="%s" merge-base %s %s | head -1', $gitDir, $baseBranch, $branch));
    $noMergedBranchInfos['commit_reference'] = (count($commitRef)) ? $commitRef[0] : '';

    $commitStatus = GitCommand::exec(sprintf('git --git-dir="%s" rev-parse --verify %s', $gitDir, $branch));
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

    $results = GitCommand::exec(sprintf('git --git-dir="%s" diff %s..%s --name-status', $gitDir,  $referenceCommit, $lastCommit));

    if($withDetails)
    {
      $lineResults = GitCommand::exec(sprintf('git --git-dir="%s" diff %s..%s --numstat | sed "s/\t/ /g"', $gitDir,  $referenceCommit, $lastCommit));

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
        $diffFiles[$filename]['added-lines']    = (isset($linesInfos[$filename])) ? $linesInfos[$filename][0] : '';
        $diffFiles[$filename]['deleted-lines']  = (isset($linesInfos[$filename])) ? $linesInfos[$filename][1] : '';
        $diffFiles[$filename]['is-binary']      = ($diffFiles[$filename]['added-lines'] == '-' && $diffFiles[$filename]['deleted-lines'] == '-');
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

    $fileContent = GitCommand::exec(sprintf('git --git-dir="%s" show %s:%s', $gitDir, $currentCommit, $filename));

    return implode(PHP_EOL, $fileContent);
  }

  /**
   * @static
   * @param string $gitDir
   * @param string $currentCommit
   * @param string $referenceCommit
   * @param string $filename
   * @param array $options
   * @return string
   */
  public static function getShowFileFromBranch($gitDir, $referenceCommit, $currentCommit, $filename, $options = array())
  {
    self::fetch($gitDir);

    $gitDiffOptions = array(
      '-U9999'
    );
    if (isset($options['ignore-all-space']) && $options['ignore-all-space'])
    {
      $gitDiffOptions[] = '-w';
    }
    
    $cmd = sprintf('git --git-dir="%s" diff %s %s..%s -- %s', $gitDir, implode(' ', $gitDiffOptions), $referenceCommit, $currentCommit, $filename);
    $currentContentLinesResults = GitCommand::exec($cmd);

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
    $return = GitCommand::exec(sprintf('git --git-dir="%s" log %s --format="%%H" -- %s | head -n1', $gitDir, $branch, $filename));
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
    GitCommand::exec(sprintf('git clone --mirror %s %s', $repositoryReadOnlyUrl, $path), $status);
    return $status;
  }

  public static function commitIsInHistory($gitDir, $commit, $searchedCommit)
  {
    $return = GitCommand::exec(sprintf('git --git-dir="%s" log %s | grep %s', $gitDir, $commit, $searchedCommit));
    return (count($return) > 0);
  }

  public static function getCommitInfos($gitDir, $commit, $format)
  {
    $return = GitCommand::exec(sprintf('git --git-dir="%s" log %s --format="%s" -n1', $gitDir, $commit, $format));
    return (count($return)) ? $return[0] : '';
  }

  public static function exec($cmd, &$status = null)
  {
    exec($cmd, $internOutput, $internStatus);

    $debug = sprintf("%s [%s] %s : %s\n%s result", date('d/m/Y H:i:s'), $_SERVER['REMOTE_ADDR'], $internStatus, $cmd, count($internOutput));
    if(count($internOutput) == 0)
    {
      $debug .= ".\n";
    }
    elseif(count($internOutput) == 1)
    {
      $debug .= " : ".$internOutput[0]."\n";
    }
    elseif(count($internOutput) > 1)
    {
      $debug .= "s :\n";
      $output = array_slice($internOutput, 0, 10);
      foreach($output as $line)
      {
        $debug .= $line."\n";
      }
      if(count($internOutput) > 10)
      {
        $debug .= (count($internOutput) - 10)." more..\n";
      }
    }
    $debug .= "----\n";
    file_put_contents(sprintf("%s/git.log", sfConfig::get('sf_log_dir')), $debug, FILE_APPEND);

    if(!is_null($status))
    {
      $status = $internStatus;
    }

    return $internOutput;
  }
}
