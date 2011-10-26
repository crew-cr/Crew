<?php

class lineDeleteCommentAction extends sfAction
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
      $lineComment = LineCommentPeer::retrieveByPK($request->getParameter('id'), $con);
      $this->forward404Unless($lineComment, 'LineComment Not Found');

      $countLineComment = LineCommentQuery::create()
        ->filterByCommitReference($lineComment->getCommitReference())
        ->filterByFileId($lineComment->getFileId())
        ->filterByPosition($lineComment->getPosition())
        ->filterByLine($lineComment->getLine())
        ->count($con)
      ;

      $datas = array(
        'commit_reference' => $lineComment->getCommitReference(),
        'file_id' => $lineComment->getFileId(),
        'position' => $lineComment->getPosition(),
        'line' => $lineComment->getLine(),
        'form_visible' => false,
      );

      $lineComment->delete($con);

      if (($countLineComment -1) > 0)
      {
        $html = $this->getComponent('default', 'lineComment', $datas);
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
