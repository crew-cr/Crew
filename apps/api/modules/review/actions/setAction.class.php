<?php
 
class setAction extends crewAction
{
  /**
   * @param sfWebRequest $request
   * @return void
   */
  public function execute($request)
  {
    $projectId      = $request->getParameter('project_id');
    $baseBranchName = $request->getParameter('base_branch');
    $branchName     = $request->getParameter('branch');
    $commit         = (string)$request->getParameter('commit'); // Last commit
    $result         = array();

    file_put_contents(sprintf("%s/api.log", sfConfig::get('sf_log_dir')), sprintf("%s [%s] set review = projectId : %s - baseBranchName : %s - branchName : %s - commit : %s\n", date('d/m/Y H:i:s'), $_SERVER['REMOTE_ADDR'], $projectId, $baseBranchName, $branchName, $commit), FILE_APPEND);

    $repository = RepositoryQuery::create()
      ->filterById($projectId)
      ->findOne()
    ;

    if($repository)
    {
      $branch = BranchQuery::create()
        ->filterByRepositoryId($repository->getId())
        ->filterByName($branchName)
        ->findOne()
      ;

      if(!$branch)
      {
        $branch = new Branch();
        $branch->setName($branchName)
          ->setRepositoryId($repository->getId())
          ->setBaseBranchName($baseBranchName)
          ->save()
        ;
      }

      if($branch->getBaseBranchName() != $baseBranchName)
      {
        $branch->setBaseBranchName($baseBranchName)->save();
      }

      if(($nbFiles = BranchPeer::synchronize($this->gitCommand, $repository, $branch)) != 0)
      {
        $result['message'] = sprintf("Your branch '%s' has too many files : %s (max : %s)", $branch->__toString(), $nbFiles, sfConfig::get('app_max_number_of_files_to_review', 4096));
        $this->getResponse()->setStatusCode('500');
      }
      elseif(!$branch->isDeleted())
      {
        if(strlen($commit) === 40)
        {
          if(!$this->gitCommand->commitIsInHistory($repository->getGitDir(), $branch->getCommitStatusChanged(), $commit))
          {
            $result['message'] = sprintf("Review has been %sengaged [old status : %s]", $branch->getReviewRequest() ? 're' : '', BranchPeer::getLabelStatus($branch->getStatus()));
            $branch->setReviewRequest(1)
              ->setStatus(BranchPeer::A_TRAITER)
              ->setIsBlacklisted(0)
              ->save()
            ;
            
            $request = new Request();
            $request
              ->setBranch($branch)
              ->setCommit($commit)
              ->save();
            
            $this->getResponse()->setStatusCode('201');
            $this->dispatcher->notify(new sfEvent($this, 'notification.review-request', array('project-id' => $branch->getRepositoryId(), 'object' => $branch)));
          }
          else
          {
            $result['message'] = sprintf("Commit already used : '%s'", $commit);
            $this->getResponse()->setStatusCode('200');
          }
        }
        else
        {
          $result['message'] = sprintf("No valid commit '%s'", $commit);
          $this->getResponse()->setStatusCode('422');
        }
      }
      else
      {
        $result['message'] = sprintf("Unknown branch '%s' in project '%s'", $branchName, $repository->getName());
        $this->getResponse()->setStatusCode('404');
      }
    }
    else
    {
      $result['message'] = sprintf("No valid project '%s'", $projectId);
      $this->getResponse()->setStatusCode('400');
    }

    $this->getResponse()->setContentType('application/json');
    return $this->renderText(json_encode($result));
  }
}
