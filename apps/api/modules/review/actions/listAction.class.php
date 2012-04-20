<?php
 
class listAction extends sfAction
{
  /**
   * @param sfWebRequest $request
   * @return void
   */
  public function execute($request)
  {
    $projectId  = $request->getParameter('project_id');
    $result     = array();

    file_put_contents(sprintf("%s/api.log", sfConfig::get('sf_log_dir')), sprintf("%s [%s] list reviews = projectId : %s\n", date('d/m/Y H:i:s'), $_SERVER['REMOTE_ADDR'], $projectId), FILE_APPEND);

    $repository = RepositoryQuery::create()
      ->filterById($projectId)
      ->findOne()
    ;

    if($repository)
    {
      $branches = BranchQuery::create()
        ->filterByRepositoryId($repository->getId())
        ->find()
      ;
      
      if($branches)
      {
        $result = $branches->toArray();
      }
      $this->getResponse()->setStatusCode('200');
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
