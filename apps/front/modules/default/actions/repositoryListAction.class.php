<?php

/**
 * repository actions.
 *
 * @package    crew
 * @subpackage repository
 * @author     Your name here
 */
class repositoryListAction extends sfAction
{
  public function execute($request)
  {
    $repositories = RepositoryQuery::create()->find();

    $this->repositories = array();
    foreach ($repositories as & $repository)
    {
      $branchesCount = BranchQuery::create()
        ->filterByRepositoryId($repository->getId())
        ->filterByIsBlacklisted(0)
        ->count()
      ;
      
      $this->repositories[] = array_merge($repository->toArray(), array('NbBranches' => $branchesCount));
    }

    $this->statusActions = StatusActionQuery::create()
      ->orderByCreatedAt(\Criteria::DESC)
      ->limit(25)
      ->find()
    ;

    $this->commentBoards = $this->getCommentBoards();
  }

  /**
   * Returns comments
   * @return array
   */
  private function getCommentBoards()
  {
    $commentBoards = array();

    $comments = CommentQuery::create()
      ->orderByCreatedAt(Criteria::DESC)
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
