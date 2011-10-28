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

      $oldtStatus = $file->getStatus();

      if ($file->getStatus() === BranchPeer::KO)
      {
        $file->setStatus(BranchPeer::A_TRAITER);
        $render = array('toggleState' => 'disabled');
      }
      else
      {
        $file->setStatus(BranchPeer::KO);
        $render = array('toggleState' => 'enabled');
      }

      $file
        ->save($con)
      ;

      // save file status action
      File::saveAction(
        $this->getUser()->getGuardUser()->getId(),
        $file->getBranch($con)->getRepositoryId(),
        $file->getId(),
        $oldtStatus,
        $file->getStatus()
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
