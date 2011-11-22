<?php

/**
 * repository actions.
 *
 * @package    crew
 * @subpackage repository
 * @author     Your name here
 */
class fileListAction extends sfAction
{
  /**
   * @param sfWebRequest $request
   * @return void
   */
  public function execute($request)
  {
    $this->branch = BranchPeer::retrieveByPK($request->getParameter('branch'));
    $this->forward404Unless($this->branch, "Branch not found");

    $this->repository = RepositoryPeer::retrieveByPK($this->branch->getRepositoryId());
    $this->forward404Unless($this->repository, "Repository not found");

    $files = FileQuery::create()
      ->filterByBranchId($this->branch->getId())
      ->find()
    ;

    $this->files = array();
    foreach ($files as $file)
    {
      $fileCommentsCount = CommentQuery::create()
        ->filterByFileId($file->getId())
        ->filterByType(CommentPeer::TYPE_FILE)
        ->count()
      ;
      
      $lineCommentsCount = CommentQuery::create()
        ->filterByFileId($file->getId())
        ->filterByCommit($file->getLastChangeCommit())
        ->filterByType(CommentPeer::TYPE_LINE)
        ->count()
      ;

      $this->files[] = array_merge($file->toArray(), array('NbFileComments' => ($fileCommentsCount + $lineCommentsCount)));
    }

    $this->statusActions = StatusActionQuery::create()
      ->orderByCreatedAt(\Criteria::DESC)
      ->filterByBranchId($this->branch->getId())
      ->limit(25)
      ->find()
    ;

    $this->commentBoards = CommentPeer::getCommentsForBoard(null, $this->repository->getId(), $this->branch->getId());
  }
}
