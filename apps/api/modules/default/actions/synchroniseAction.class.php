<?php
 
class synchroniseAction extends sfAction
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
        $result['message'] = sprintf("Synchronization OK : %s", $commit);
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
        $result['message'] = sprintf("No valid Branch '%s' on project (id: %s)", $branchName, $projectId);
    }

    $this->getResponse()->setContentType('application/json');
    return $this->renderText(json_encode($result));
  }
}
