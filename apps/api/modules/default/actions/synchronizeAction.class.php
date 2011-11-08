<?php
 
class synchronizeAction extends sfAction
{
  /**
   * @param sfWebRequest $request
   * @return void
   */
  public function execute($request)
  {
    $projectId = $request->getParameter('project');
    $branchName = 'origin/'.$request->getParameter('branch');
    $commit = $request->getParameter('commit'); // Dernier commit rapporté suite à un merge du master sur la branche

    $repository = RepositoryQuery::create()
      ->filterById($projectId)
      ->findOne()
    ;

    if($repository)
    {
      $branch = BranchQuery::create()
        ->filterByName($branchName)
        ->filterByRepositoryId($projectId)
        ->findOne()
      ;
      $result = array();
      if($branch)
      {
        if(strlen($commit) === 40)
        {
          $branch->setCommitReference($commit);
          $branch->save();
          $result['result'] = true;
          $result['message'] = sprintf("Synchronization OK with new reference commit %s ", $commit);
        }
        else if(strlen($commit) == 0)
        {
          $result['result'] = true;
          $result['message'] = sprintf("Synchronization OK without new reference commit");
        }
        else
        {
          $result['result'] = false;
          $result['message'] = sprintf("No valid commit '%s'", $commit);
        }
        BranchPeer::synchronize($repository, $branch);
      }
      else
      {
          $result['result'] = false;
          $result['message'] = sprintf("No valid Branch '%s' on project (id: %s)", $branchName, $projectId);
      }
    }
    else
    {
      $result['result'] = false;
      $result['message'] = sprintf("No valid project (id: %s)", $projectId);
    }

    $this->getResponse()->setContentType('application/json');
    return $this->renderText(json_encode($result));
  }
}
