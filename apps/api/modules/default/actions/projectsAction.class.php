<?php
 
class projectsAction extends sfAction
{
  /**
   * @param sfWebRequest $request
   * @return void
   */
  public function execute($request)
  {
    $repositories = RepositoryQuery::('project')
      ->find()
    ;
    if(count($repositories) > 0)
    {
      $result = array();
      foreach($repositories as $repository)
      {
        $result[] = array(
          'id' => $repository->getId(),
          'name' => $repository->getName(),
          'repository' => $repository->getValue(),
          'remote' => $repository->getRemote()
        );
      }
    }
    else
    {
      $result['result'] = false;
      $result['message'] = "Pas de projet";
    }

    $this->getResponse()->setContentType('application/json');
    return $this->renderText(json_encode($result));
  }
}
