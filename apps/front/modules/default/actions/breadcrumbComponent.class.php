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
    
    $gitCommand = $this->getContext()->getGitCommand();;
    $commitFrom = null;
    $commitTo   = null;
    
    if ($fileId = $request->getParameter('file'))
    {
      $this->currentBreadCrumbFile = FileQuery::create()
        ->filterById($fileId)
        ->findOne()
      ;

      $fileBreadCrumbList = FileQuery::create()
        ->filterById($fileId, Criteria::NOT_EQUAL)
        ->filterByBranchId($this->currentBreadCrumbFile->getBranchId())
        ->orderByFilename()
        ->find()
      ;

      $branch = $this->currentBreadCrumbFile->getBranch();
      $commitFrom = $request->getParameter('from', $branch->getCommitReference());
      $commitTo   = $request->getParameter('to', $branch->getLastCommit());

      $branch = $this->currentBreadCrumbFile->getBranch();
      $modifiedFiles = $gitCommand->getDiffFilesFromBranch(
        $branch->getRepository()->getGitDir(),
        $commitFrom,
        $commitTo,
        false
      );

      foreach ($fileBreadCrumbList as $file)
      {
        /** @var File $file */
        if (!isset($modifiedFiles[$file->getFilename()]))
        {
          continue;
        }
        
        $this->fileBreadCrumbList[] = $file;
      }

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

      $this->branchBreadCrumbList = BranchQuery::create()
        ->filterById($branchId, Criteria::NOT_EQUAL)
        ->filterByRepositoryId($this->currentBreadCrumbBranch->getRepositoryId())
        ->orderByName()
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

      $this->repositoryBreadCrumbList = RepositoryQuery::create()
        ->filterById($repositoryId, Criteria::NOT_EQUAL)
        ->orderByName()
        ->find()
      ;
    }

    $this->commit_from = null;
    $this->commit_to = null;
    if ($request->hasParameter('from'))
    {
      $this->commit_from = $commitFrom;
    }

    if ($request->hasParameter('to'))
    {
      $this->commit_to = $commitTo;
    }
  }
}
