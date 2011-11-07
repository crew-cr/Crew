<?php
 
class projectsAction extends sfAction
{
  /**
   * @param sfWebRequest $request
   * @return void
   */
  public function execute($request)
  {
    $repositories = RepositoryQuery::create()
      ->find()
    ;

    $result = array();
    foreach($repositories as $repository)
    {
      $result[] = array(
        'id'         => $repository->getId(),
        'name'       => $repository->getName(),
        'repository' => $repository->getValue(),
        'remote'     => $repository->getRemote()
      );
    }

    $this->getResponse()->setContentType('application/json');
    return $this->renderText(json_encode($result));
  }
}
