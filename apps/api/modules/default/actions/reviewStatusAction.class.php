<?php
 
class reviewStatusAction extends sfAction
{
  /**
   * @param sfWebRequest $request
   * @return void
   */
  public function execute($request)
  {
    $projectId  = $request->getParameter('project-id');
    $branchName = $request->getParameter('branch');
    $commit     = $request->getParameter('commit'); // Dernier commit effectué en local (optionel)

    $branch = BranchQuery::create()
      ->filterByName($branchName)
      ->filterByRepositoryId($projectId)
      ->findOne()
    ;

    $result = array();
    if($branch)
    {
      if(!strlen($commit) || $branch->getCommitStatusChanged() == $commit)
      {
        $result['result'] = $branch->getStatus();
        $result['message'] = "Status: ".$branch->getStatus();
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
