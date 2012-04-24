<?php

/**
 * repository actions.
 *
 * @package    crew
 * @subpackage repository
 * @author     Your name here
 */
class changeStatusAction extends crewAction
{
  const TYPE_BRANCH = 'branch';
  const TYPE_FILE   = 'file';

  /**
   * @param sfWebRequest $request
   * @return void
   */
  public function execute($request)
  {
    $type = $request->getParameter('type');
    if (null === $type)
    {
      throw new Exception('Type Not Found');
    }

    $id = $request->getParameter('id');
    if (null === $id)
    {
      throw new Exception('Id Not Found');
    }

    $status = $request->getParameter('status');
    if (null === $status)
    {
      throw new Exception('Status Not Found');
    }

    $con = Propel::getConnection();
    $con->beginTransaction();

    try
    {

      if (self::TYPE_BRANCH === $type)
      {
        $this->changeBranchStatus($id, $status, $con);
      }
      else if (self::TYPE_FILE === $type)
      {
        $this->changeFileStatus($id, $status, $con);
      }
      else
      {
        throw new Exception(sprintf('Unknow Type `%s`', $type));
      }

      $con->commit();
    }
    catch (Exception $e)
    {
      $con->rollBack();
      throw $e;
    }

    $this->getResponse()->setContentType('application/json');
    return $this->renderText(json_encode(array('status' => $status)));
  }


  /**
   * @param int $id
   * @param int $status
   * @param PropelPDO $con
   * @return string
   */
  public function changeBranchStatus($id, $status, PropelPDO $con)
  {
    $branch = BranchQuery::create()
      ->filterById($id)
      ->findOne()
    ;

    $this->forward404Unless($branch, 'Branch `%s` Not Found', $id);

    $oldStatus = $branch->getStatus();

    $branch->changeStatus($status, $this->getUser()->getId(), $con);

    $this->dispatcher->notify(new sfEvent($this, 'notification.status', array('project-id' => $branch->getRepositoryId(), 'type' => 'branch', 'object' => $branch, 'old' => $oldStatus)));
  }

  /**
   * @param int $id
   * @param int $status
   * @param PropelPDO $con
   * @return string
   */
  public function changeFileStatus($id, $status, PropelPDO $con)
  {
    $file = FileQuery::create()
      ->filterById($id)
      ->findOne()
    ;

    $this->forward404Unless($file, 'File `%s` Not Found', $id);

    $oldStatus = $file->getStatus();

    $file->changeStatus($status, $this->getUser()->getId(), $con);

    $this->dispatcher->notify(new sfEvent($this, 'notification.status', array('project-id' => $file->getBranch($con)->getRepositoryId(), 'type' => 'file', 'object' => $file, 'old' => $oldStatus)));
  }
}
