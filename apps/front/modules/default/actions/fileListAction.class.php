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
      ->filterByBranchId($this->branch->getId())
      ->find()
    ;

    $this->files = array();
    foreach ($files as $file)
    {
      $fileCommentsCount = CommentQuery::create()
        ->filterByFileId($file->getId())
        ->filterByType(CommentPeer::TYPE_FILE)
        ->count()
      ;
      
      $lineCommentsCount = CommentQuery::create()
        ->filterByFileId($file->getId())
        ->filterByCommit($file->getLastChangeCommit())
        ->filterByType(CommentPeer::TYPE_LINE)
        ->count()
      ;

      $this->files[] = array_merge($file->toArray(), array('NbFileComments' => ($fileCommentsCount + $lineCommentsCount)));
    }

    $this->statusActions = StatusActionQuery::create()
      ->orderByCreatedAt(\Criteria::DESC)
      ->filterByBranchId($this->branch->getId())
      ->limit(25)
      ->find()
    ;

    $this->commentBoards = $this->getCommentBoards($this->branch->getId());
  }

  /**
   * Returns comments
   * @return array
   */
  private function getCommentBoards()
  {
    $commentBoards = array();

    $comments = CommentQuery::create()
      ->orderByCreatedAt(Criteria::DESC)
      ->limit(50)
      ->find()
    ;

    /** @var Comment $comment */
    foreach ($comments as $comment)
    {
      $commentBoards[$comment->getCreatedAt('YmdHisu')] = array(
        'ProjectName' => $comment->getBranch()->getRepository(),
        'ProjectId'   => $comment->getBranch()->getRepositoryId(),
        'UserName'    => $comment->getAuthorName(),
        'UserId'      => $comment->getUserId(),
        'UserEmail'   => $comment->getsfGuardUser()->getProfile()->getEmail(),
        'BranchName'  => $comment->getBranch(),
        'BranchId'    => $comment->getBranchId(),
        'FileName'    => $comment->getFile(),
        'FileId'      => $comment->getFileId(),
        'Position'    => $comment->getPosition(),
        'Line'        => $comment->getLine(),
        'Message'     => stringUtils::shorten($comment->getValue(), 60),
        'CreatedAt'   => $comment->getCreatedAt('d/m/Y H:i:s')
      );
    }

    krsort($commentBoards);

    return $commentBoards;
  }
}
