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
    $con = Propel::getConnection();
    $con->beginTransaction();

    try
    {
      $branch = BranchPeer::retrieveByPK($request->getParameter('branch'));
      $this->forward404Unless($branch, 'Branch Not Found');

      $oldStatus = $branch->getStatus();

      if ($branch->getStatus() === BranchPeer::KO)
      {
        $branch->changeStatus(BranchPeer::A_TRAITER, $this->getUser()->getId(), $con);
        $render = array('toggleState' => 'disabled');
      }
      else
      {
        $branch->changeStatus(BranchPeer::KO, $this->getUser()->getId(), $con);
        $render = array('toggleState' => 'enabled');
      }

      $this->dispatcher->notify(new sfEvent($this, 'notification.status', array('type' => 'branch', 'object' => $branch, 'old' => $oldStatus)));

      $con->commit();
    }
    catch (\Exception $e)
    {
      $con->rollBack();
      throw $e;
    }
    $this->getResponse()->setContentType('application/json');
    return $this->renderText(json_encode($render));
  }
}
