<?php

/**
 * repository actions.
 *
 * @package    crew
 * @subpackage repository
 * @author     Your name here
 */
class fileAction extends crewAction
{
  /**
   * @param sfWebRequest $request
   * @return void
   */
  public function execute($request)
  {
    $this->file = FilePeer::retrieveByPK($request->getParameter('file'));
    $this->forward404Unless($this->file, "File not found");
    $this->getResponse()->setTitle(basename($this->file->getFilename()));

    $this->branch = BranchPeer::retrieveByPK($this->file->getBranchId());
    $this->forward404Unless($this->branch, "Branch not found");

    $this->repository = RepositoryPeer::retrieveByPK($this->branch->getRepositoryId());
    $this->forward404Unless($this->repository, "Repository not found");

    $options = array();
    if ($request->getParameter('s', false))
    {
      $options['ignore-all-space'] = true;
    }

    $previousFiles = FileQuery::create()
      ->select(array('Id', 'Filename'))
      ->filterByBranchId($this->file->getBranchId())
      ->filterByFilename($this->file->getFilename(), Criteria::LESS_THAN)
      ->orderByFilename(Criteria::DESC)
      ->find()
    ;

    $nextFiles = FileQuery::create()
      ->select(array('Id', 'Filename'))
      ->filterByBranchId($this->file->getBranchId())
      ->filterByFilename($this->file->getFilename(), Criteria::GREATER_THAN)
      ->orderByFilename(Criteria::ASC)
      ->find()
    ;

    $commitFrom        = $request->getParameter('from', $this->branch->getCommitReference());
    $commitTo          = $request->getParameter('to', $this->branch->getLastCommit());
    $this->commit_from = null;
    $this->commit_to   = null;
    $this->readonly    = false;
    if ($request->hasParameter('from'))
    {
      $this->commit_from = $commitFrom;
      $this->readonly    = true;
    }

    if ($request->hasParameter('to'))
    {
      $this->commit_to = $commitTo;
      $this->readonly  = true;
    }

    $modifiedFiles = $this->gitCommand->getDiffFilesFromBranch(
      $this->repository->getGitDir(),
      $commitFrom,
      $commitTo,
      false
    );
    
    $this->previousFileId = $this->findClosestFileId($previousFiles, $modifiedFiles);
    $this->nextFileId     = $this->findClosestFileId($nextFiles, $modifiedFiles);

    if ($this->file->getIsBinary())
    {
        $oldBinaryContent = $this->gitCommand->getShowFile(
          $this->repository->getGitDir(),
          $commitFrom,
          $this->file->getFilename()
        );

        $this->oldImageExists  = !(strpos($oldBinaryContent, 'fatal: Path') === 0);
        $this->oldImageType    = ImageUtils::getImageTypeFromContent($oldBinaryContent);
        $this->oldImageContent = base64_encode($oldBinaryContent);

        $newBinaryContent = $this->gitCommand->getShowFile(
          $this->repository->getGitDir(),
          $commitTo,
          $this->file->getFilename()
        );

        $this->newImageExists  = !(strpos($newBinaryContent, 'fatal: Path') === 0);
        $this->newImageType    = ImageUtils::getImageTypeFromContent($newBinaryContent);
        $this->newImageContent = base64_encode($newBinaryContent);
    }
    else
    {
      $this->fileContentLines = $this->gitCommand->getShowFileFromBranch(
        $this->repository->getGitDir(),
        $commitFrom,
        $commitTo,
        $this->file->getFilename(),
        $options
      );

      $fileLineCommentsModel = CommentQuery::create()
        ->filterByFileId($this->file->getId())
        ->filterByCommit($this->file->getLastChangeCommit())
        ->filterByType(CommentPeer::TYPE_LINE)
        ->find()
      ;

      $this->fileLineComments = array();
      foreach ($fileLineCommentsModel as $fileLineCommentModel)
      {
        $this->fileLineComments[$fileLineCommentModel->getPosition()][] = $fileLineCommentModel;
      }
    }

    $this->userId = $this->getUser()->getId();
  }

  /**
   * @param Traversable $files
   * @param array       $modifiedFiles
   *
   * @return null
   */
  private function findClosestFileId(Traversable $files, array $modifiedFiles)
  {
    $fileId = null;
    foreach ($files as $file)
    {
      if (isset($modifiedFiles[$file['Filename']]))
      {
        return $file['Id'];
      }
    }
    
    return null;
  }
  
}
