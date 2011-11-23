<?php

/**
 * repository actions.
 *
 * @package    crew
 * @subpackage repository
 * @author     Your name here
 */
class fileToggleUnvalidateAction extends sfAction
{
  /**
   * @param sfWebRequest $request
   * @return mixed
   */
  public function execute($request)
  {
    $con = Propel::getConnection();
    $con->beginTransaction();

    try
    {
      $file = FilePeer::retrieveByPK($request->getParameter('file'));
      $this->forward404Unless($file, 'File Not Found');

      $oldStatus = $file->getStatus();

      if ($file->getStatus() === BranchPeer::KO)
      {
        $file->changeStatus(BranchPeer::A_TRAITER, $this->getUser()->getId(), $con);
        $render = array('toggleState' => 'disabled');
      }
      else
      {
        $file->changeStatus(BranchPeer::KO, $this->getUser()->getId(), $con);
        $render = array('toggleState' => 'enabled');
      }

      $con->commit();

      $this->dispatcher->notify(new sfEvent($this, 'notification.status', array('project-id' => $file->getBranch()->getRepositoryId(), 'type' => 'file', 'object' => $file, 'old' => $oldStatus)));
    }
    catch (Exception $e)
    {
      $con->rollBack();
      throw $e;
    }

    $this->getResponse()->setContentType('application/json');
    return $this->renderText(json_encode($render));
  }
}
