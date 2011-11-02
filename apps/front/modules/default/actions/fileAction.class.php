<?php

/**
 * repository actions.
 *
 * @package    crew
 * @subpackage repository
 * @author     Your name here
 */
class fileAction extends sfAction
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

    $this->fileContentLines = GitCommand::getShowFileFromBranch(
      $this->repository->getValue(),
      $this->branch->getCommitReference(),
      $this->file->getCommitStatusChanged(),
      $this->file->getFilename()
    );

    $fileLineCommentsModel = LineCommentQuery::create()
      ->filterByFileId($this->file->getId())
      ->filterByCommit($this->branch->getLastCommit())
      ->find()
    ;

    $this->fileLineComments = array();
    foreach ($fileLineCommentsModel as $fileLineCommentModel)
    {
      $this->fileLineComments[$fileLineCommentModel->getPosition()][] = $fileLineCommentModel;
    }
  }
}
