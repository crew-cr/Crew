<?php
 
class reviewStatusAction extends sfAction
{
  /**
   * @param sfWebRequest $request
   * @return void
   */
  public function execute($request)
  {
    $projectId = $request->getParameter('project');
    $branchName = 'origin/'.$request->getParameter('branch');
    $commit = $request->getParameter('commit'); // Dernier commit effectué en local

    $branch = BranchQuery::create()
      ->filterByName($branchName)
      ->filterByRepositoryId($projectId)
      ->findOne()
    ;

    $result = array();
    if($branch)
    {
      if($branch->getCommitStatusChanged() == $commit)
      {
        $result['result'] = $branch->getStatusId();
        $result['message'] = "Status: ".$branch->getStatusId();
      }
      else
      {
        $result['result'] = -1;
        $result['message'] = sprintf("Last commit %s doesn't match with the commit of last review %s", $commit, $branch->getCommitStatusChanged());
      }
    }
    else
    {
      $result['result'] = -1;
      $result['message'] = sprintf("No valid branch '%s' on project (id: %s)", $branchName, $projectId);
    }

    $this->getResponse()->setContentType('application/json');
    return $this->renderText(json_encode($result));
  }
}
