<?php

/**
 * repository actions.
 *
 * @package    crew
 * @subpackage repository
 * @author     Your name here
 */
class fileListAction extends sfAction
{
  /**
   * @param sfWebRequest $request
   * @return void
   */
  public function execute($request)
  {
    $this->branch = BranchPeer::retrieveByPK($request->getParameter('branch'));
    $this->forward404Unless($this->branch, "Branch not found");

    $this->repository = RepositoryPeer::retrieveByPK($this->branch->getRepositoryId());
    $this->forward404Unless($this->repository, "Repository not found");

    $files = FileQuery::create()
      ->where('File.BranchId', $this->branch->getId())
      ->find()
    ;

    $this->files = array();
    foreach ($files as $file)
    {
      $fileCommentsCount = FileCommentQuery::create()
        ->filterByFileId($file->getId())
        ->count()
      ;

      $this->files[] = array_merge($file->toArray(), array('NbFileComments' => $fileCommentsCount));
    }
  }
}
