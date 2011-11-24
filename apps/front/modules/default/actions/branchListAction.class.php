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

      $this->branches[] = array(
        'id' => $branch->getId(),
        'name' => $branch->__toString(),
        'status' => $branch->getStatus(),
        'reviewRequest' => $branch->getReviewRequest(),
        'lastCommitDesc' => $branch->getLastCommitDesc(),
        'total' => $addedFilesCount + $modifiedFilesCount + $deletedFilesCount,
        'added' => $addedFilesCount,
        'modified' => $modifiedFilesCount,
        'deleted' => $deletedFilesCount
      );
    }

    $this->statusActions = StatusActionPeer::getStatusActionsForBoard(null, $repository->getId());
    $this->commentBoards = CommentPeer::getCommentsForBoard(null, $repository->getId());
  }
}
