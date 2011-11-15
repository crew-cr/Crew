<?php

/**
 * repository actions.
 *
 * @package    crew
 * @subpackage repository
 * @author     Your name here
 */
class branchAddCommentAction extends sfAction
{
  /**
   * @param sfWebRequest $request
   * @return void
   */
  public function execute($request)
  {
    $comment = $request->getParameter('comment');
    $this->forward404Unless($comment, 'No Comment Value');

    $branch = BranchPeer::retrieveByPK($request->getParameter('branch'));
    $this->forward404Unless($branch, 'Branch Not Found');

    $branchComment = new BranchComment();
    $branchComment
      ->setUserId($this->getUser()->getGuardUser()->getId())
      ->setBranchId($branch->getId())
      ->setValue($comment['value'])
      ->save()
    ;
    
    $this->getResponse()->setContentType('application/json');
    return $this->renderText(json_encode(array('html' => $this->getComponent('default', 'branchComment', array('branch' => $branch)))));
  }
}
