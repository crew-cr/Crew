<?php

/**
 * repository actions.
 *
 * @package    crew
 * @subpackage repository
 * @author     Your name here
 */
class fileListAction extends crewAction
{
  /**
   * @param sfWebRequest $request
   * @return void
   */
  public function execute($request)
  {
    
    
    $this->branch = null;
    if ($request->hasParameter('name') && $request->hasParameter('repository'))
    {
      $repository = RepositoryQuery::create()->filterByName($request->getParameter('repository'))->findOne();
      $this->forward404Unless($repository, "Repository not found");
      
      $this->branch = BranchQuery::create()
        ->filterByName($request->getParameter('name'))
        ->filterByRepository($repository)
        ->findOne();
      
      // Dirty hack to make the breadcrumb work /!\
      if ($this->branch)
      {
        $this->redirect('default/fileList?branch='.$this->branch->getId());
      }
    }
    elseif ($request->hasParameter('branch'))
    {
      $this->branch = BranchPeer::retrieveByPK($request->getParameter('branch'));
    }
    $this->forward404Unless($this->branch, "Branch not found");
    $this->getResponse()->setTitle($this->branch->getName());

    $this->repository = RepositoryPeer::retrieveByPK($this->branch->getRepositoryId());
    $this->forward404Unless($this->repository, "Repository not found");

    $files = FileQuery::create()
      ->filterByBranchId($this->branch->getId())
      ->find()
    ;
    
    $commitFrom = $request->getParameter('from', $this->branch->getCommitReference());
    $commitTo   = $request->getParameter('to', $this->branch->getLastCommit());
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
    
    $modifiedFiles = $this->gitCommand->getDiffFilesFromBranch(
      $this->repository->getGitDir(),
      $commitFrom,
      $commitTo, 
      false
    );
    
    $this->files = array();
    foreach ($files as $file)
    {
      /** @var File $file  */
      if (!isset($modifiedFiles[$file->getFilename()]))
      {
        continue;
      }
      
      $fileCommentsCount = CommentQuery::create()
        ->filterByFileId($file->getId())
        ->filterByType(CommentPeer::TYPE_FILE)
        ->count()
      ;

      $fileCommentsCountNotChecked = CommentQuery::create()
        ->filterByFileId($file->getId())
        ->filterByType(CommentPeer::TYPE_FILE)
        ->filterByCheckUserId(null)
        ->count()
      ;
      
      $lineCommentsCount = CommentQuery::create()
        ->filterByFileId($file->getId())
        ->filterByCommit($file->getLastChangeCommit())
        ->filterByType(CommentPeer::TYPE_LINE)
        ->count()
      ;

      $lineCommentsCountNotChecked = CommentQuery::create()
        ->filterByFileId($file->getId())
        ->filterByCommit($file->getLastChangeCommit())
        ->filterByType(CommentPeer::TYPE_LINE)
        ->filterByCheckUserId(null)
        ->count()
      ;
      

      $lastCommentId = 0;
      if ($fileCommentsCount || $lineCommentsCount)
      {
        $lastComment = CommentQuery::create()
          ->filterByFileId($file->getId())
          ->filterByCommit($file->getLastChangeCommit())
          ->_or()
          ->filterByType(CommentPeer::TYPE_FILE)
          ->orderById(Criteria::DESC)
          ->findOne()
        ;
        if ($lastComment)
        {
          $lastCommentId = $lastComment->getId();
        }
      }

      $this->files[] = array_merge($file->toArray(), array(
        'NbFileComments'           => ($fileCommentsCount + $lineCommentsCount),
        'NbFileCommentsNotChecked' => $fileCommentsCountNotChecked + $lineCommentsCountNotChecked,
        'LastCommentId'            => $lastCommentId
      ));
    }

    usort($this->files, array('self', 'sortPath'));
    $this->statusActions = StatusActionPeer::getStatusActionsForBoard(null, $this->repository->getId(), $this->branch->getId());
    $this->commentBoards = CommentPeer::getCommentsForBoard(null, $this->repository->getId(), $this->branch->getId());
    
  }

  private static function sortPath($a, $b)
  {
    $pathA = dirname($a['Filename']);
    $fileA = basename($a['Filename']);
    $pathB = dirname($b['Filename']);
    $fileB = basename($b['Filename']);

    $cmpPath = strcmp($pathA, $pathB);
    if ($cmpPath === 0)
    {
      $cmpFile = strcmp($fileA, $fileB);
      return $cmpFile;
    }
    else
    {
      return $cmpPath;
    }
  }
}
