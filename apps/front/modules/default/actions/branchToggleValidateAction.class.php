<?php

/**
 * repository actions.
 *
 * @package    crew
 * @subpackage repository
 * @author     Your name here
 */
class branchToggleValidateAction extends sfAction
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

      $oldtStatus = $branch->getStatus();

      if ($branch->getStatus() === BranchPeer::OK)
      {
        $branch->changeStatus(BranchPeer::A_TRAITER, $this->getUser()->getId(), $con);
        $render = array('toggleState' => 'disabled');
      }
      else
      {
        $branch->changeStatus(BranchPeer::OK, $this->getUser()->getId(), $con);
        $render = array('toggleState' => 'enabled');
      }

      Branch::saveAction(
        $this->getUser()->getId(),
        $branch->getRepositoryId(),
        $branch->getId(),
        $oldtStatus,
        $branch->getStatus()
      );

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
