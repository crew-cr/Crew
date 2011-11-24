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
    $baseBranchName = 'origin/'.$request->getParameter('base-branch');
    $branchName     = 'origin/'.$request->getParameter('branch');
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

      BranchPeer::synchronize($repository, $branch);

      if(strlen($commit) === 40)
      {
        if(!gitCommand::commitIsInHistory($repository->getValue(), $branch->getCommitStatusChanged(), $commit))
        {
          $result['message'] = sprintf("Review has been %sengaged [old status : %s]", $branch->getReviewRequest() ? 're' : '', $branch->getStatus());
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
      $result['message'] = sprintf("No valid project '%s'", $projectId);
    }

    $this->getResponse()->setContentType('application/json');
    return $this->renderText(json_encode($result));
  }
}
