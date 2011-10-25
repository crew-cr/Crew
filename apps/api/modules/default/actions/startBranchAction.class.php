<?php
 
class startBranchAction extends sfAction
{
  /**
   * @param sfWebRequest $request
   * @return void
   */
  public function execute($request)
  {
    $projectId = $request->getParameter('project');

    $repository = RepositoryQuery::create()
      ->filterById($projectId)
      ->findOne()
    ;

    $result = array();
    if($repository)
    {
      BranchPeer::synchronize($repository);
      $result['result'] = true;
      $result['message'] = "Synchronisation OK";
    }
    else
    {
      $result['result'] = false;
      $result['message'] = "Projet inexistant";
    }

    $this->getResponse()->setContentType('application/json');
    return $this->renderText(json_encode($result));
  }
}
