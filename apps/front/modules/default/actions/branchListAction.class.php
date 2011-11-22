<?php

/**
 * repository actions.
 *
 * @package    crew
 * @subpackage repository
 * @author     Your name here
 */
class branchListAction extends sfAction
{
  /**
   * @param sfWebRequest $request
   * @return void
   */
  public function execute($request)
  {
    $repository = RepositoryPeer::retrieveByPK($request->getParameter('repository'));
    $this->forward404Unless($repository, "Repository Not Found");

    $this->repository = $repository;
    $branches = BranchQuery::create()
      ->filterByIsBlacklisted(false)
      ->filterByRepositoryId($this->repository->getId())
      ->find()
    ;
    $this->branches = array();
    foreach ($branches as $branch)
    {
      $addedFilesCount = FileQuery::create()->filterByBranchId($branch->getId())->filterByState(FilePeer::ADDED)->count();
      $modifiedFilesCount = FileQuery::create()->filterByBranchId($branch->getId())->filterByState(FilePeer::MODIFIED)->count();
      $deletedFilesCount = FileQuery::create()->filterByBranchId($branch->getId())->filterByState(FilePeer::DELETED)->count();

      $this->branches[] = array_merge($branch->toArray(), array(
        'total' => $addedFilesCount + $modifiedFilesCount + $deletedFilesCount,
        'added' => $addedFilesCount,
        'modified' => $modifiedFilesCount,
        'deleted' => $deletedFilesCount
      ));
    }

    $this->statusActions = StatusActionQuery::create()
      ->orderByCreatedAt(\Criteria::DESC)
      ->filterByRepositoryId($repository->getId())
      ->limit(25)
      ->find()
    ;

    $this->commentBoards = $this->getCommentBoards($repository->getId());
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
