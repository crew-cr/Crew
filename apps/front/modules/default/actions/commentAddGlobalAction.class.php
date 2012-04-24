<?php

/**
 * repository actions.
 *
 * @package    crew
 * @subpackage repository
 * @author     Your name here
 */
class commentAddGlobalAction extends crewAction
{
  /**
   * @param sfWebRequest $request
   * @return void
   */
  public function execute($request)
  {
    $comment = $request->getParameter('comment');
    $this->forward404Unless($comment, 'No Comment Value');

    $type = $request->getParameter('type');
    $this->forward404Unless($type, 'Comment Type Not Found');

    $id = $request->getParameter('id');
    $this->forward404Unless($id, sprintf('%s Not Found', ucfirst($type)));

    $aComment = new Comment();
    $aComment
      ->setUserId($this->getUser()->getId())
      ->setType($type)
      ->setValue($comment['value'])
    ;

    switch ($type)
    {
      case CommentPeer::TYPE_BRANCH:
        $aComment->setBranchId($id);
        break;

      case CommentPeer::TYPE_FILE:
        $file = FileQuery::create()
          ->filterById($id)
          ->findOne()
        ;
        $this->forward404Unless($file, sprintf('File With ID %s Not Found', $id));

        $aComment
          ->setBranchId($file->getBranchId())
          ->setFileId($id)
        ;
        break;
    }

    $con = Propel::getConnection();
    $con->beginTransaction();

    try
    {
      $aComment->save();
      $aComment->getBranch()->setReviewRequest(false)->save();
      $con->commit();
    }
    catch (Exception $e)
    {
      $con->rollBack();
      throw $e;
    }

    $this->dispatcher->notify(new sfEvent($this, 'notification.comment', array('project-id' => $aComment->getBranch()->getRepositoryId(), 'type' => ($type == CommentPeer::TYPE_BRANCH) ? 'branch' : 'file', 'object' => $aComment)));

    $this->getResponse()->setContentType('application/json');
    return $this->renderText(json_encode(array('html' => $this->getComponent('default', 'commentGlobal', array('id' => $id, 'type' => $type)))));
  }
}
