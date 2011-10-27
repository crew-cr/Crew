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

    BranchPeer::synchronize($repository);

    $branches = BranchQuery::create()
      ->filterByIsBlacklisted(false)
      ->filterByRepositoryId($repository->getId())
      ->find()
    ;

    $this->branches = array();
    foreach ($branches as $branch)
    {
      FilePeer::synchronize($branch);

      $filesCount = FileQuery::create()
        ->filterByBranchId($branch->getId())
        ->count()
      ;

      $this->branches[] = array_merge($branch->toArray(), array('NbFiles' => $filesCount));
    }
  }
}
