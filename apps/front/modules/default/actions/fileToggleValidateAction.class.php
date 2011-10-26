<?php

/**
 * repository actions.
 *
 * @package    crew
 * @subpackage repository
 * @author     Your name here
 */
class fileToggleValidateAction extends sfAction
{
  /**
   * @param sfWebRequest $request
   * @return void
   */
  public function execute($request)
  {
    $file = FilePeer::retrieveByPK($request->getParameter('file'));
    $this->forward404Unless($file, 'File Not Found');

    if ($file->getStatus() === BranchPeer::OK)
    {
      $file->setStatus(BranchPeer::A_TRAITER);
      $render = array('toggleState' => 'disabled');
    }
    else
    {
      $file->setStatus(BranchPeer::OK);
      $render = array('toggleState' => 'enabled');
    }

    $file->save();
    
    $this->getResponse()->setContentType('application/json');
    return $this->renderText(json_encode($render));
  }
}
