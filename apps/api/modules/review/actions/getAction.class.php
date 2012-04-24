<?php
 
class getAction extends crewAction
{
  /**
   * @param sfWebRequest $request
   * @return void
   */
  public function execute($request)
  {
    $projectId  = $request->getParameter('project_id');
    $branchName = $request->getParameter('branch');
    $result     = array();

    file_put_contents(sprintf("%s/api.log", sfConfig::get('sf_log_dir')), sprintf("%s [%s] get review = projectId : %s - branchName : %s\n", date('d/m/Y H:i:s'), $_SERVER['REMOTE_ADDR'], $projectId, $branchName), FILE_APPEND);

    $repository = RepositoryQuery::create()
      ->filterById($projectId)
      ->findOne()
    ;

    if($repository)
    {
      $branch = BranchQuery::create()
        ->filterByRepositoryId($repository->getId())
        ->filterByName($branchName)
        ->findOne()
      ;

      if($branch)
      {
        $result = $branch->toArray();
        $this->getResponse()->setStatusCode('200');
      }
      else
      {
        $result['message'] = sprintf("Unknown branch '%s' in project '%s'", $branchName, $repository->getName());
        $this->getResponse()->setStatusCode('404');
      }
    }
    else
    {
      $result['message'] = sprintf("No valid project '%s'", $projectId);
      $this->getResponse()->setStatusCode('400');
    }

    $this->getResponse()->setContentType('application/json');
    return $this->renderText(json_encode($result));
  }
}
