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

  private function getCommentBoards()
  {
    $commentBoards = array();

    $branchComments = BranchCommentQuery::create()
      ->orderByCreatedAt(Criteria::DESC)
      ->find()
    ;
    
    foreach ($branchComments as $branchComment)
    {
      $commentBoards[$branchComment->getCreatedAt('YmdHisu')] = array(
        'User' => $branchComment->getAuthorName(),
        'Message' => sprintf('%s <strong>on branch %s</strong>', stringUtils::shorten($branchComment->getValue(), 60), $branchComment->getBranch()->__toString()),
        'CreatedAt' => $branchComment->getCreatedAt('d/m/Y H:i:s')
      );
    }

    $FileComments = FileCommentQuery::create()
      ->orderByCreatedAt(Criteria::DESC)
      ->find()
    ;

    foreach ($FileComments as $FileComment)
    {
      $commentBoards[$FileComment->getCreatedAt('YmdHisu')] = array(
        'User' => $FileComment->getAuthorName(),
        'Message' => sprintf('%s <strong>on file %s</strong>', stringUtils::shorten($FileComment->getValue(), 60), $FileComment->getFile()->getFilename()),
        'CreatedAt' => $FileComment->getCreatedAt('d/m/Y H:i:s')
      );
    }

    $LineComments = LineCommentQuery::create()
      ->orderByCreatedAt(Criteria::DESC)
      ->find()
    ;

    foreach ($LineComments as $LineComment)
    {
      $commentBoards[$LineComment->getCreatedAt('YmdHisu')] = array(
        'User' => $LineComment->getAuthorName(),
        'Message' => sprintf('%s <strong>on line %s of file %s</strong>', stringUtils::shorten($LineComment->getValue(), 60), $LineComment->getLine(), $LineComment->getFile()->getFilename()),
        'CreatedAt' => $LineComment->getCreatedAt('d/m/Y H:i:s')
      );
    }

    krsort($commentBoards);

    return $commentBoards;
  }
}
