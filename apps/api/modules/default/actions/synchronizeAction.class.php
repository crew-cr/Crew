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
    $baseBranchName = 'origin/'.$request->getParameter('base-branch', 'master');
    $branchName = 'origin/'.$request->getParameter('branch');

    $repository = RepositoryQuery::create()
      ->filterById($projectId)
      ->findOne()
    ;

    if($repository)
    {
      if(is_null($branchName))
      {
        BranchPeer::synchronize($repository);
        $result['result'] = true;
        $result['message'] = sprintf("Synchronization OK [all branches]");
      }
      else
      {
        $branch = BranchQuery::create()
          ->filterByName($branchName)
          ->filterByRepositoryId($projectId)
          ->findOne()
        ;
        $result = array();
        if($branch)
        {
          BranchPeer::synchronize($repository, $baseBranchName, $branch);
          $result['result'] = true;
          $result['message'] = sprintf("Synchronization OK [branch %s]", $branch);
        }
        else
        {
          $result['result'] = false;
          $result['message'] = sprintf("No valid Branch '%s' on project (id: %s)", $branchName, $projectId);
        }
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
