<?php
 
class reviewRequestAction extends sfAction
{
  /**
   * @param sfWebRequest $request
   * @return void
   */
  public function execute($request)
  {
    $projectId = $request->getParameter('project');
    $baseBranchName = 'origin/'.$request->getParameter('base-branch', 'master');
    $branchName = 'origin/'.$request->getParameter('branch');
    $commit = (string)$request->getParameter('commit'); //Dernier commit

    $repository = RepositoryQuery::create()
      ->filterById($projectId)
      ->findOne()
    ;

    $result = array();
    if($repository)
    {
      BranchPeer::synchronize($repository, $baseBranchName, $branchName);

      $branch = BranchQuery::create()
        ->filterByName($branchName)
        ->filterByRepositoryId($repository->getId())
        ->findOne()
      ;

      if($branch)
      {
        if(strlen($commit) === 40)
        {
          if(!gitCommand::commitIsInHistory($repository->getValue(), $commit, $branch->getCommitStatusChanged()))
          {
            $result['message'] = sprintf("Review has been %sengaged [old status : %s]", $branch->getReviewRequest() ? 're' : '', $branch->getStatus());
            $branch->setReviewRequest(1);
            $branch->setStatus(BranchPeer::A_TRAITER);
            $branch->save();
            $result['result'] = true;
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
        $result['message'] = sprintf("No valid Branch '%s'", $branchName);
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
