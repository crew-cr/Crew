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

    FilePeer::synchronize($this->branch);

    $files = FileQuery::create()
      ->filterByBranchId($this->branch->getId())
      ->find()
    ;

    $this->files = array();
    foreach ($files as $file)
    {
      $fileCommentsCount = FileCommentQuery::create()
        ->filterByFileId($file->getId())
        ->count()
      ;
      
      $lineCommentsCount = LineCommentQuery::create()
        ->filterByFileId($file->getId())
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

    $this->commentBoards = $this->getCommentBoards($this->branch->getId());
  }

  private function getCommentBoards($branchId)
  {
    $commentBoards = array();

    $branchComments = BranchCommentQuery::create()
      ->orderByCreatedAt(Criteria::DESC)
      ->filterByBranchId($branchId)
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
      ->useFileQuery()
        ->filterByBranchId($branchId)
      ->endUse()
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
      ->useFileQuery()
        ->filterByBranchId($branchId)
      ->endUse()
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
