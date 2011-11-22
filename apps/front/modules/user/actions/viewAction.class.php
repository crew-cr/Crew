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

    $comments = CommentQuery::create()
      ->orderByCreatedAt(Criteria::DESC)
      ->filterByUserId($userId)
      ->limit(50)
      ->find()
    ;

    foreach ($comments as $comment)
    {
      $commentBoards[$comment->getCreatedAt('YmdHisu')] = array(
        'ProjectName' => $comment->getBranch()->getRepository(),
        'ProjectId'   => $comment->getBranch()->getRepositoryId(),
        'UserName'    => $comment->getAuthorName(),
        'UserId'      => $comment->getUserId(),
        'UserEmail'   => $comment->getsfGuardUser()->getProfile()->getEmail(),
        'BranchName'  => $comment->getBranch(),
        'BranchId'    => $comment->getBranchId(),
        'FileName'    => $comment->getFile(),
        'FileId'      => $comment->getFileId(),
        'Position'    => $comment->getPosition(),
        'Line'        => $comment->getLine(),
        'Message'     => stringUtils::shorten($comment->getValue(), 60),
        'CreatedAt'   => $comment->getCreatedAt('d/m/Y H:i:s')
      );
    }

    krsort($commentBoards);

    return $commentBoards;
  }
}
