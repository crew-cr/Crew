<?php

/**
 * repository actions.
 *
 * @package    crew
 * @subpackage repository
 * @author     Your name here
 */
class branchesSynchronizeAction extends crewAction
{
  /**
   * @param sfWebRequest $request
   * @return void
   */
  public function execute($request)
  {
    $repository = RepositoryPeer::retrieveByPK($request->getParameter('repository'));
    $this->forward404Unless($repository, "Repository Not Found");

    $branches = BranchQuery::create()
      ->filterByRepositoryId($repository->getId())
      ->filterByIsBlacklisted(0)
      ->find()
    ;

    foreach($branches as $branch)
    {
      BranchPeer::synchronize($this->gitCommand, $repository, $branch, true);
    }

    $this->redirect('default/branchList?repository='.$repository->getId());
  }
}
