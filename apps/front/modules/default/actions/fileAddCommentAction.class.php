<?php

/**
 * repository actions.
 *
 * @package    crew
 * @subpackage repository
 * @author     Your name here
 */
class fileAddCommentAction extends sfAction
{
  /**
   * @param sfWebRequest $request
   * @return void
   */
  public function execute($request)
  {
    $comment = $request->getParameter('comment');
    $this->forward404Unless($comment, 'No Comment Value');

    $file = FilePeer::retrieveByPK($request->getParameter('file'));
    $this->forward404Unless($file, 'File Not Found');

    $branchComment = new FileComment();
    $branchComment
      ->setUserId($this->getUser()->getGuardUser()->getId())
      ->setFileId($file->getId())
      ->setValue($comment['value'])
      ->save()
    ;
    
    $this->getResponse()->setContentType('application/json');
    return $this->renderText(json_encode(array('html' => $this->getComponent('default', 'fileComment', array('file' => $file)))));
  }
}
