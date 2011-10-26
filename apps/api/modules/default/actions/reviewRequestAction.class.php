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
    $branchName = 'origin/'.$request->getParameter('branch');
    $commit = (string)$request->getParameter('commit'); //Dernier commit

    $repository = RepositoryQuery::create()
      ->filterById($projectId)
      ->findOne()
    ;

    $result = array();
    if($repository)
    {
      BranchPeer::synchronize($repository);

      $branch = BranchQuery::create()
        ->filterByName($branchName)
        ->filterByRepositoryId($repository->getId())
        ->findOne()
      ;

      if($branch)
      {
        if(strlen($commit) === 40)
        {
          $cmd = sprintf('git --git-dir="%s/.git" log %s | grep %s', $repository->getValue(), $branch->getCommitStatusChanged(), $commit);
          exec($cmd, $cmdReturn);
          if(count($cmdReturn) == 0)
          {
            $branch->setStatusId(1);
            $branch->setReviewRequest(1);
            $branch->setCommitStatusChanged($commit);
            $branch->save();
            $result['result'] = true;
            if(!$branch->getReviewRequest())
            {
              $result['message'] = sprintf("Review has been engaged");
            }
            else
            {
              $result['message'] = sprintf("Review already engaged");
            }
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
