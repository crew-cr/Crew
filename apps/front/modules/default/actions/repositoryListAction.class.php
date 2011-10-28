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
      BranchPeer::synchronize($repository);
      
      $branchesCount = BranchQuery::create()
        ->filterByRepositoryId($repository->getId())
        ->count()
      ;
      
      $this->repositories[] = array_merge($repository->toArray(), array('NbBranches' => $branchesCount));
    }

    $this->statusActions = StatusActionQuery::create()
      ->orderByCreatedAt(\Criteria::ASC)
      ->limit(10)
      ->find()
    ;
  }
}
