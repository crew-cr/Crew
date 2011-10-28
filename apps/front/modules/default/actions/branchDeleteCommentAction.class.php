<?php

class branchDeleteCommentAction extends sfAction
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
      $branchComment = BranchCommentPeer::retrieveByPK($request->getParameter('id'), $con);
      $this->forward404Unless($branchComment, 'BranchComment Not Found');

      $branchComment->delete($con);

      $html = $this->getComponent('default', 'branchComment', array('branch' => $branchComment->getBranch($con)));

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
