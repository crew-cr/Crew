<?php

class GitCommand
{
  protected $logger;

  public function __construct(GitLogger $logger)
  {
    $this->logger = $logger;
  }
  
  /**
   * @param string $gitDir
   * @return string
   */
  public function getRemote($gitDir)
  {
    $remote = $this->exec("git --git-dir=%s remote -v | head -n1 | tr -d '\t' | cut -d' ' -f1", array($gitDir));
    return (count($remote)) ? $remote[0] : '';
  }

  /**
   * @static
   * @param string $gitDir
   * @return void
   */
  public function fetch($gitDir)
  {
    $this->exec('git --git-dir=%s fetch -p origin', array($gitDir));
  }

  /**
   * @param string $gitDir
   * @param string $baseBranch
   * @param string $branch
   * @return array
   */
  public function getNoMergedBranchInfos($gitDir, $baseBranch, $branch)
  {
    $this->fetch($gitDir);

    $result = $this->exec('git --git-dir=%s branch --no-merged %s | grep %s | sed "s/ //g"', array($gitDir, $baseBranch, $branch));
    if(count($result) == 0 || strpos($result[0], '->') !== false || $result[0] != $branch)
    {
      return null;
    }

    $noMergedBranchInfos = array();

    $commitRef = $this->exec('git --git-dir=%s merge-base %s %s | head -1', array($gitDir, $baseBranch, $branch));
    $noMergedBranchInfos['commit_reference'] = (count($commitRef)) ? $commitRef[0] : '';

    $commitStatus = $this->exec('git --git-dir=%s rev-parse --verify %s', array($gitDir, $branch));
    $noMergedBranchInfos['last_commit'] = (count($commitStatus)) ? $commitStatus[0] : '';

    $noMergedBranchInfos['last_commit_desc'] = $this->getCommitInfos($gitDir, $branch, '%s');

    return $noMergedBranchInfos;
  }

  /**
   * @param string $gitDir
   * @param string $referenceCommit
   * @param string $lastCommit
   * @param bool $withDetails
   * @return array
   */
  public function getDiffFilesFromBranch($gitDir, $referenceCommit, $lastCommit, $withDetails = true)
  {
    $this->fetch($gitDir);

    $results = $this->exec('git --git-dir=%s diff %s..%s --name-status', array($gitDir,  $referenceCommit, $lastCommit));

    if($withDetails)
    {
      $lineResults = $this->exec("git --git-dir=%s diff %s..%s --numstat", array($gitDir,  $referenceCommit, $lastCommit));

      $linesInfos = array();
      foreach($lineResults as $line)
      {
        $infos = explode("\t", $line);
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
   * @param string $gitDir
   * @param string $currentCommit
   * @param string $filename
   * @return string
   */
  public function getShowFile($gitDir, $currentCommit, $filename)
  {
    $this->fetch($gitDir);

    $fileContent = $this->exec('git --git-dir=%s show %s:%s', array($gitDir, $currentCommit, $filename));

    return implode(PHP_EOL, $fileContent);
  }

  /**
   * @param string $gitDir
   * @param string $currentCommit
   * @param string $referenceCommit
   * @param string $filename
   * @param array $options
   * @return string
   */
  public function getShowFileFromBranch($gitDir, $referenceCommit, $currentCommit, $filename, $options = array())
  {
    $this->fetch($gitDir);

    $gitDiffOptions = array(
      '-U9999'
    );

    if (isset($options['ignore-all-space']) && $options['ignore-all-space'])
    {
      $gitDiffOptions[] = '-w';
    }

    $currentContentLinesResults = $this->exec('git --git-dir=%s diff '.implode(' ', $gitDiffOptions).' %s..%s -- %s', array($gitDir, $referenceCommit, $currentCommit, $filename));

    $fileLines = $currentContentLinesResults;

    foreach($currentContentLinesResults as $key => $currentContentLinesResult)
    {
      unset($fileLines[$key]);
      if(substr($currentContentLinesResult, 0, 2) == "@@")
      {
        break;
      }
    }

    return $fileLines;
  }

  /**
   * @param string $gitDir
   * @param string $referenceCommit
   * @param string $currentCommit
   *
   * @return array
   */
  public function getCommits($gitDir, $referenceCommit, $currentCommit)
  {
    $result = $this->exec('git --git-dir=%s log %s...%s --pretty=oneline', array($gitDir, $referenceCommit, $currentCommit));
    
    $commits = array();
    foreach ($result as $commit)
    {
      list($sha, $message) = explode(' ', $commit, 2);
      $commits[$sha] = $message;
    }

    return $commits;
  }

  public function getLastModificationCommit($gitDir, $branch, $filename)
  {
    $return = $this->exec('git --git-dir=%s log %s --format="%%H" -- %s | head -n1', array($gitDir, $branch, $filename));
    return (count($return)) ? $return[0] : false;
  }

  /**
   * @param $repositoryReadOnlyUrl
   * @param $path
   * @return int
   */
  public function cloneRepository($repositoryReadOnlyUrl, $path)
  {
    $status = 0;
    $this->exec('git clone --mirror %s %s', array($repositoryReadOnlyUrl, $path), $status);
    return $status;
  }

  public function commitIsInHistory($gitDir, $commit, $searchedCommit)
  {
    $return = $this->exec('git --git-dir=%s log %s | grep %s', array($gitDir, $commit, $searchedCommit));
    return (count($return) > 0);
  }

  public function getCommitInfos($gitDir, $commit, $format)
  {
    $return = $this->exec('git --git-dir=%s log %s --format=%s -n1', array($gitDir, $commit, $format));
    return (count($return)) ? $return[0] : '';
  }

  public function exec($cmd, array $arguments = array(), &$status = null)
  {
    $arguments = array_map('escapeshellarg', $arguments);

    $cmd = vsprintf($cmd, $arguments);
    $cmd.= ' 2>&1';

    exec($cmd, $internOutput, $internStatus);

    if($this->logger !== null)
    {
      $this->logger->log($cmd, $internStatus, implode("\n", $internOutput));
    }

    if(!is_null($status))
    {
      $status = $internStatus;
    }

    return $internOutput;
  }
}
