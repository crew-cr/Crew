<?php

/**
 * repository actions.
 *
 * @package    crew
 * @subpackage repository
 * @author     Your name here
 */
class fileContentAction extends crewAction
{
  /**
   * @param sfWebRequest $request
   * @return void
   */
  public function execute($request)
  {
    $this->file = FilePeer::retrieveByPK($request->getParameter('file'));
    $this->forward404Unless($this->file, "File not found");

    $this->branch = BranchPeer::retrieveByPK($this->file->getBranchId());
    $this->forward404Unless($this->branch, "Branch not found");

    $this->repository = RepositoryPeer::retrieveByPK($this->branch->getRepositoryId());
    $this->forward404Unless($this->repository, "Repository not found");

    $this->fileContent = $this->gitCommand->getShowFile($this->repository->getGitDir(), $this->file->getLastChangeCommit(), $this->file->getFilename());

    $this->fileExtension = pathinfo($this->file->getFilename(), PATHINFO_EXTENSION);
  }
}
