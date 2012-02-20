<?php

class commentDeleteLineAction extends sfAction
{
  /**
   * @param sfWebRequest $request
   * @return application/json data
   */
  public function execute($request)
  {
    $this->forward404Unless($this->getUser()->isAuthenticated(), 'Your are not authorized to delete this comment');

    $con = Propel::getConnection();
    $con->beginTransaction();

    $html = '';
    try
    {
      $id = $request->getParameter('id');
      $this->forward404Unless($id, 'Line Comment Id Not Found');

      $aComment = CommentQuery::create()
        ->filterByType(CommentPeer::TYPE_LINE)
        ->filterById($id)
        ->findOne()
      ;
      $this->forward404Unless($aComment, 'Line Comment Not Found');
      $this->forward404Unless($aComment->getUserId() == $this->getUser()->getId(), 'Your are not authorized to delete this comment');

      $countLineComment = CommentQuery::create()
        ->filterByCommit($aComment->getCommit())
        ->filterByFileId($aComment->getFileId())
        ->filterByPosition($aComment->getPosition())
        ->filterByLine($aComment->getLine())
        ->filterByType(CommentPeer::TYPE_LINE)
        ->count($con)
      ;

      $datas = array(
        'commit'       => $aComment->getCommit(),
        'file_id'      => $aComment->getFileId(),
        'position'     => $aComment->getPosition(),
        'line'         => $aComment->getLine(),
        'user_id'      => $this->getUser()->getId(),
        'form_visible' => false,
      );

      $aComment->delete($con);

      if (($countLineComment -1) > 0)
      {
        $html = $this->getComponent('default', 'commentLine', $datas);
      }

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
