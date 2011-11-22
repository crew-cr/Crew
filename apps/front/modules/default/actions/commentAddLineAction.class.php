<?php

class commentAddLineAction extends sfAction
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
        'commit'   => $request->getParameter('commit'),
        'file_id'  => $request->getParameter('fileId'),
        'position' => $request->getParameter('position'),
        'line'     => $request->getParameter('line'),
        'user_id'  => $this->getUser()->getId(),
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

        $commit = $datas['commit'];
        $this->forward404Unless($commit, 'Commit Hash Not Found');
        
        $fileId = $datas['file_id'];
        $this->forward404Unless($fileId, 'File Id Not Found');

        $file = FileQuery::create()
          ->filterById($fileId)
          ->findOne()
        ;
        $this->forward404Unless($file, 'File Not Found');

        $position = $datas['position'];
        $this->forward404Unless($position, 'Position Line Number Not Found');

        $line = $datas['line'];
        $this->forward404Unless($line, 'Line Number Not Found');

        $value = $datas['value'];
        $this->forward404Unless($value, 'Comment Value Not Found');

        // new comment object
        $lineComment = new Comment();
        $lineComment
          ->setUserId($this->getUser()->getId())
          ->setCommit($commit)
          ->setBranchId($file->getBranchId())
          ->setFileId($fileId)
          ->setPosition($position)
          ->setLine($line)
          ->setType(CommentPeer::TYPE_LINE)
          ->setValue($value)
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
    return $this->renderText(json_encode(array('html' => $this->getComponent('default', 'commentLine', $datas))));
  }
}
