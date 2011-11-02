<?php

class lineAddCommentAction extends sfAction
{
  /**
   * @param sfWebRequest $request
   * @return application/json data
   */
  public function execute($request)
  {
    if ($request->getMethod() == \sfWebRequest::GET)
    {
      $datas = array(
        'commit' => $request->getParameter('commit'),
        'file_id' => $request->getParameter('fileId'),
        'position' => $request->getParameter('position'),
        'line' => $request->getParameter('line'),
      );
    }
    // saving the object if call post method
    else if ($request->getMethod() == \sfWebRequest::POST)
    {
      // get the propel connection
      $con = Propel::getConnection();
      $con->beginTransaction();

      try
      {
        // get the comment arguments parameter
        $datas = $request->getParameter('comment');
        $this->forward404Unless($datas, "Comment arguments not found");

        // new lineComment object
        $lineComment = new LineComment();
        $lineComment
          ->setUserId($this->getUser()->getGuardUser()->getId())
          ->setCommit($datas['commit'])
          ->setFileId($datas['file_id'])
          ->setPosition($datas['position'])
          ->setLine($datas['line'])
          ->setValue($datas['value'])
          ->save($con)
        ;

        $datas = array_merge($datas, array('form_visible' => false));

        $con->commit();
      }
      catch (Exception $e)
      {
        $con->rollBack();
        throw new $e;
      }
    }

    // returns a json object
    $this->getResponse()->setContentType('application/json');
    return $this->renderText(json_encode(array('html' => $this->getComponent('default', 'lineComment', $datas))));
  }
}
