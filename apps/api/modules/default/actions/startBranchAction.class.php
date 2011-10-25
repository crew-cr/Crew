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

    $project = RepositoryQuery::create()
      ->filterById($projectId)
      ->findOne()
    ;

    $result = array();
    if($project)
    {
      $branchs = GitCommand::getNoMergedBranchesInfos($project->repository);
      Synchronize::branch($branchs, $project->getId());
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
