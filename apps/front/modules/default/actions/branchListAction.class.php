<?php

/**
 * repository actions.
 *
 * @package    crew
 * @subpackage repository
 * @author     Your name here
 */
class branchListAction extends crewAction
{
  /**
   * @param sfWebRequest $request
   * @return void
   */
  public function execute($request)
  {
    $this->repository = RepositoryPeer::retrieveByPK($request->getParameter('repository'));
    $this->forward404Unless($this->repository, "Repository Not Found");
    $this->getResponse()->setTitle($this->repository->getName());

    $branches = BranchQuery::create()
      ->filterByIsBlacklisted(false)
      ->filterByRepositoryId($this->repository->getId())
      ->orderByReviewRequest(Criteria::DESC)
      ->orderByCreatedAt(Criteria::DESC)
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
        'deleted' => $deletedFilesCount,
        'created' => $branch->getCreatedAt('U')
      );
    }

    $this->statusActions = StatusActionPeer::getStatusActionsForBoard(null, $this->repository->getId());
    $this->commentBoards = CommentPeer::getCommentsForBoard(null, $this->repository->getId());
  }
}
