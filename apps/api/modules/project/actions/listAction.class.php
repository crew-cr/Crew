<?php
 
class listAction extends crewAction
{
  /**
   * @param sfWebRequest $request
   * @return void
   */
  public function execute($request)
  {
    file_put_contents(sprintf("%s/api.log", sfConfig::get('sf_log_dir')), sprintf("%s [%s] list projects\n", date('d/m/Y H:i:s'), $_SERVER['REMOTE_ADDR']), FILE_APPEND);

    $repositories = RepositoryQuery::create()
      ->find()
    ;

    $result = array();
    foreach($repositories as $repository)
    {
      /** @var $repository Repository */
      $result[] = array(
        'id'         => $repository->getId(),
        'name'       => $repository->getName(),
        'repository' => $repository->getValue(),
        'remote'     => $repository->getRemote()
      );
    }

    $this->getResponse()->setStatusCode('200');
    $this->getResponse()->setContentType('application/json');
    return $this->renderText(json_encode($result));
  }
}
