<?php

/**
 * repository actions.
 *
 * @package    crew
 * @subpackage repository
 * @author     Your name here
 */
class viewAction extends sfAction
{
  /**
   * @param sfWebRequest $request
   * @return void
   */
  public function execute($request)
  {
    $this->user = sfGuardUserPeer::retrieveByPK($request->getParameter('id'));
    $this->forward404Unless($this->user, 'User Not Found');

    $this->statusActions = StatusActionPeer::getStatusActionsForBoard($this->user->getId());
    $this->commentBoards = CommentPeer::getCommentsForBoard($this->user->getId());
  }
}
