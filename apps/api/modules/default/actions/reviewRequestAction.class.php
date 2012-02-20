<?php
 
class reviewRequestAction extends sfAction
{
  /**
   * @param sfWebRequest $request
   * @return void
   */
  public function execute($request)
  {
    $projectId      = $request->getParameter('project-id');
    $baseBranchName = $request->getParameter('base-branch');
    $branchName     = $request->getParameter('branch');
    $commit         = (string)$request->getParameter('commit'); //Dernier commit

    $repository = RepositoryQuery::create()
      ->filterById($projectId)
      ->findOne()
    ;

    $result = array();
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

      file_put_contents(sprintf("%s/api.log", sfConfig::get('sf_log_dir')), sprintf("%s [%s] ReviewRequest = projectId : %s - baseBranchName : %s - branchName : %s - commit : %s\n", date('d/m/Y H:i:s'), $_SERVER['REMOTE_ADDR'], $projectId, $baseBranchName, $branchName, $commit), FILE_APPEND);
      if(($nbFiles = BranchPeer::synchronize($repository, $branch)) != 0)
      {
        $result['result'] = false;
        $result['message'] = sprintf("Your branch '%s' has too many files : %s (max : %s)", $branch->__toString(), $nbFiles, sfConfig::get('app_max_number_of_files_to_review', 4096));
      }
      elseif(!$branch->isDeleted())
      {
        if(strlen($commit) === 40)
        {
          if(!gitCommand::commitIsInHistory($repository->getValue(), $branch->getCommitStatusChanged(), $commit))
          {
            $result['message'] = sprintf("Review has been %sengaged [old status : %s]", $branch->getReviewRequest() ? 're' : '', BranchPeer::getLabelStatus($branch->getStatus()));
            $branch->setReviewRequest(1)
              ->setStatus(BranchPeer::A_TRAITER)
              ->setIsBlacklisted(0)
              ->save()
            ;
            $result['result'] = true;
            $this->dispatcher->notify(new sfEvent($this, 'notification.review-request', array('project-id' => $branch->getRepositoryId(), 'object' => $branch)));
          }
          else
          {
            $result['result'] = true;
            $result['message'] = sprintf("Commit already used : '%s'", $commit);
          }
        }
        else
        {
          $result['result'] = false;
          $result['message'] = sprintf("No valid commit '%s'", $commit);
        }
      }
      else
      {
        $result['result'] = false;
        $result['message'] = sprintf("Unknown branch '%s' in project '%s'", $branch->__toString(), $repository->getName());
      }
    }
    else
    {
      $result['result'] = false;
      $result['message'] = sprintf("No valid project '%s'", $projectId);
    }

    $this->getResponse()->setContentType('application/json');
    return $this->renderText(json_encode($result));
  }
}
