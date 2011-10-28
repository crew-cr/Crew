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

    $this->statusActions = StatusActionQuery::create()
      ->orderByCreatedAt(\Criteria::DESC)
      ->filterByUserId($this->user->getId())
      ->find()
    ;

    $this->commentBoards = $this->getCommentBoards($this->user->getId());
  }

  private function getCommentBoards($userId)
  {
    $commentBoards = array();

    $branchComments = BranchCommentQuery::create()
      ->orderByCreatedAt(Criteria::DESC)
      ->filterByUserId($userId)
      ->find()
    ;

    foreach ($branchComments as $branchComment)
    {
      $commentBoards[$branchComment->getCreatedAt('YmdHisu')] = array(
        'User' => $branchComment->getsfGuardUser(),
        'Message' => sprintf('%s <strong>on branch %s</strong>', stringUtils::shorten($branchComment->getValue(), 60), $branchComment->getBranchId()),
        'CreatedAt' => $branchComment->getCreatedAt('d/m/Y H:i:s')
      );
    }

    $FileComments = FileCommentQuery::create()
      ->orderByCreatedAt(Criteria::DESC)
      ->filterByUserId($userId)
      ->find()
    ;

    foreach ($FileComments as $FileComment)
    {
      $commentBoards[$FileComment->getCreatedAt('YmdHisu')] = array(
        'User' => $FileComment->getsfGuardUser(),
        'Message' => sprintf('%s <strong>on file %s</strong>', stringUtils::shorten($FileComment->getValue(), 60), $FileComment->getFileId()),
        'CreatedAt' => $FileComment->getCreatedAt('d/m/Y H:i:s')
      );
    }

    $LineComments = LineCommentQuery::create()
      ->orderByCreatedAt(Criteria::DESC)
      ->filterByUserId($userId)
      ->find()
    ;

    foreach ($LineComments as $LineComment)
    {
      $commentBoards[$LineComment->getCreatedAt('YmdHisu')] = array(
        'User' => $LineComment->getsfGuardUser(),
        'Message' => sprintf('%s <strong>on line %s of file %s</strong>', stringUtils::shorten($LineComment->getValue(), 60), $LineComment->getLine(), $LineComment->getFileId()),
        'CreatedAt' => $LineComment->getCreatedAt('d/m/Y H:i:s')
      );
    }

    krsort($commentBoards);

    return $commentBoards;
  }
}
