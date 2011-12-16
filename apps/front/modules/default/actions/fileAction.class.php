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

    $this->previousFileId = FileQuery::create()
      ->select('Id')
      ->filterByBranchId($this->file->getBranchId())
      ->filterById($this->file->getId(), Criteria::LESS_THAN)
      ->orderById(Criteria::DESC)
      ->findOne()
    ;

    $this->nextFileId = FileQuery::create()
      ->select('Id')
      ->filterByBranchId($this->file->getBranchId())
      ->filterById($this->file->getId(), Criteria::GREATER_THAN)
      ->orderById(Criteria::ASC)
      ->findOne()
    ;

    $this->branch = BranchPeer::retrieveByPK($this->file->getBranchId());
    $this->forward404Unless($this->branch, "Branch not found");

    $this->repository = RepositoryPeer::retrieveByPK($this->branch->getRepositoryId());
    $this->forward404Unless($this->repository, "Repository not found");

    $this->fileContentLines = GitCommand::getShowFileFromBranch(
      $this->repository->getGitDir(),
      $this->branch->getCommitReference(),
      $this->file->getLastChangeCommit(),
      $this->file->getFilename()
    );

    $fileLineCommentsModel = CommentQuery::create()
      ->filterByFileId($this->file->getId())
      ->filterByCommit($this->file->getLastChangeCommit())
      ->filterByType(CommentPeer::TYPE_LINE)
      ->find()
    ;

    $this->userId = $this->getUser()->getId();

    $this->fileLineComments = array();
    foreach ($fileLineCommentsModel as $fileLineCommentModel)
    {
      $this->fileLineComments[$fileLineCommentModel->getPosition()][] = $fileLineCommentModel;
    }
  }
}
