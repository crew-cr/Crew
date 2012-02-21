<?php

class commentDeleteGlobalAction extends sfAction
{
  /**
   * @param sfWebRequest $request
   * @return application/json data
   */
  public function execute($request)
  {
    $con = Propel::getConnection();
    $con->beginTransaction();

    $html = '';
    try
    {
      $type = $request->getParameter('type');
      $this->forward404Unless($type, 'Comment Type Not Found');

      $id = $request->getParameter('id');
      $this->forward404Unless($id, 'Comment ID Not Found');

      $aComment = CommentQuery::create()
        ->filterByType($type)
        ->filterById($id)
        ->findOne()
      ;

      $this->forward404Unless($aComment, sprintf('%s Comment Not Found', ucfirst($type)));
      $this->forward404Unless($aComment->getUserId() == $this->getUser()->getId(), 'Your are not authorized to delete this comment');

      // construction of returns array
      switch ($type)
      {
        case CommentPeer::TYPE_BRANCH:
          $returns = array('id' => $aComment->getBranchId(), 'type' => $type);
          break;

        case CommentPeer::TYPE_FILE:
          $returns = array('id' => $aComment->getFileId(), 'type' => $type);
          break;
      }

      $aComment->delete($con);

      $html = $this->getComponent('default', 'commentGlobal', $returns);

      $con->commit();
    }
    catch (Exception $e)
    {
      $con->rollBack();
      throw $e;
    }

    // returns a json object
    $this->getResponse()->setContentType('application/json');
    return $this->renderText(json_encode(array('html' => $html)));
  }
}
