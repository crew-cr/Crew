<?php

class breadcrumbComponent extends sfComponent
{
  /**
   * @param sfWebRequest $request
   * @return void
   */
  public function execute($request)
  {
    $this->list                        = null;
    $this->userIsAuthenticated         = $this->getUser()->isAuthenticated();
    $this->currentBreadCrumbFile       = null;
    $this->currentBreadCrumbBranch     = null;
    $this->currentBreadCrumbRepository = null;
    $this->fileBreadCrumbList          = array();
    $this->branchBreadCrumbList        = array();
    $this->repositoryBreadCrumbList    = array();

    if ($fileId = $request->getParameter('file'))
    {
      $this->currentBreadCrumbFile = FileQuery::create()
        ->filterById($fileId)
        ->findOne()
      ;

      $this->fileBreadCrumbList    = FileQuery::create()
        ->filterById($fileId, Criteria::NOT_EQUAL)
        ->filterByBranchId($this->currentBreadCrumbFile->getBranchId())
        ->find()
      ;
    }

    $branchId = $request->getParameter('branch');
    if (!$branchId)
    {
      $branchId = null != $this->currentBreadCrumbFile ? $this->currentBreadCrumbFile->getBranchId() : null;
    }

    if (null !== $branchId)
    {
      $this->currentBreadCrumbBranch = BranchQuery::create()
        ->filterById($branchId)
        ->findOne()
      ;

      $this->branchBreadCrumbList    = BranchQuery::create()
        ->filterById($branchId, Criteria::NOT_EQUAL)
        ->filterByRepositoryId($this->currentBreadCrumbBranch->getRepositoryId())
        ->find()
      ;
    }

    $repositoryId = $request->getParameter('repository');
    if (!$repositoryId)
    {
      $repositoryId = null != $this->currentBreadCrumbBranch ? $this->currentBreadCrumbBranch->getRepositoryId() : null;
    }

    if (null !== $repositoryId)
    {
      $this->currentBreadCrumbRepository = RepositoryQuery::create()
        ->filterById($repositoryId)
        ->findOne()
      ;

      $this->repositoryBreadCrumbList    = RepositoryQuery::create()
        ->filterById($repositoryId, Criteria::NOT_EQUAL)
        ->find()
      ;
    }
  }
}