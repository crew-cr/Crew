<?php

/**
 * repository actions.
 *
 * @package    crew
 * @subpackage repository
 * @author     Your name here
 */
class branchToggleUnvalidateAction extends sfAction
{
  /**
   * @param sfWebRequest $request
   * @return void
   */
  public function execute($request)
  {
    $branch = BranchPeer::retrieveByPK($request->getParameter('branch'));
    $this->forward404Unless($branch, 'Branch Not Found');

    if ($branch->getStatusId() === StatusPeer::KO)
    {
      $branch->setStatusId(StatusPeer::A_TRAITER);
      $render = array('toggleState' => 'disabled');
    }
    else
    {
      $branch->setStatusId(StatusPeer::KO);
      $render = array('toggleState' => 'enabled');
    }

    $branch
      ->setReviewRequest(false)
      ->save()
    ;
    
    $this->getResponse()->setContentType('application/json');
    return $this->renderText(json_encode($render));
  }
}
