<?php

class fileDeleteCommentAction extends sfAction
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
      $fileComment = FileCommentPeer::retrieveByPK($request->getParameter('id'), $con);
      $this->forward404Unless($fileComment, 'FileComment Not Found');

      $fileComment->delete($con);

      $html = $this->getComponent('default', 'fileComment', array('file' => $fileComment->getFile($con)));

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
