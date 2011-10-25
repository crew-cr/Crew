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
        $result['message'] = "Status : ".$branch->getStatusId();
      }
      else
      {
        $result['result'] = 4;
        $result['message'] = "Votre dernier commit ne correspond pas a celui de la derniere review";
      }
    }
    else
    {
      $result['result'] = 4;
      $result['message'] = "Branche inexistante";
    }

    $this->getResponse()->setContentType('application/json');
    return $this->renderText(json_encode($result));
  }
}
