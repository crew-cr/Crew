<?php

/**
 * repository actions.
 *
 * @package    crew
 * @subpackage repository
 * @author     Your name here
 */
class repositoryListAction extends sfAction
{
  public function execute($request)
  {
    $repositories = RepositoryQuery::create()->find();

    $this->repositories = array();
    foreach ($repositories as & $repository)
    {
      $branchesCount = BranchQuery::create()
        ->filterByRepositoryId($repository->getId())
        ->filterByIsBlacklisted(0)
        ->count()
      ;
      
      $this->repositories[] = array_merge($repository->toArray(), array('NbBranches' => $branchesCount));
    }

    $this->statusActions = StatusActionQuery::create()
      ->orderByCreatedAt(\Criteria::DESC)
      ->limit(25)
      ->find()
    ;

    $this->commentBoards = $this->getCommentBoards();
  }

  private function getCommentBoards()
  {
    $commentBoards = array();

    $branchComments = BranchCommentQuery::create()
      ->orderByCreatedAt(Criteria::DESC)
      ->find()
    ;

    foreach ($branchComments as $branchComment)
    {
      $commentBoards[$branchComment->getCreatedAt('YmdHisu')] = array(
        'ProjectName' => $branchComment->getBranch()->getRepository(),
        'ProjectId'   => $branchComment->getBranch()->getRepositoryId(),
        'UserName'    => $branchComment->getAuthorName(),
        'UserId'      => $branchComment->getUserId(),
        'BranchName'  => $branchComment->getBranch(),
        'BranchId'    => $branchComment->getBranchId(),
        'Message'     => stringUtils::shorten($branchComment->getValue(), 60),
        'CreatedAt'   => $branchComment->getCreatedAt('d/m/Y H:i:s')
      );
    }

    $FileComments = FileCommentQuery::create()
      ->orderByCreatedAt(Criteria::DESC)
      ->find()
    ;

    foreach ($FileComments as $FileComment)
    {
      $commentBoards[$FileComment->getCreatedAt('YmdHisu')] = array(
        'ProjectName' => $FileComment->getFile()->getBranch()->getRepository(),
        'ProjectId'   => $FileComment->getFile()->getBranch()->getRepositoryId(),
        'UserName'    => $FileComment->getAuthorName(),
        'UserId'      => $FileComment->getUserId(),
        'BranchName'  => $FileComment->getFile()->getBranch(),
        'BranchId'    => $FileComment->getFile()->getBranchId(),
        'FileName'    => $FileComment->getFile(),
        'FileId'      => $FileComment->getFileId(),
        'Message'     => stringUtils::shorten($FileComment->getValue(), 60),
        'CreatedAt'   => $FileComment->getCreatedAt('d/m/Y H:i:s')
      );
    }

    $LineComments = LineCommentQuery::create()
      ->orderByCreatedAt(Criteria::DESC)
      ->find()
    ;

    foreach ($LineComments as $LineComment)
    {
      $commentBoards[$LineComment->getCreatedAt('YmdHisu')] = array(
        'ProjectName' => $LineComment->getFile()->getBranch()->getRepository(),
        'ProjectId'   => $LineComment->getFile()->getBranch()->getRepositoryId(),
        'UserName'    => $LineComment->getAuthorName(),
        'UserId'      => $LineComment->getUserId(),
        'BranchName'  => $LineComment->getFile()->getBranch(),
        'BranchId'    => $LineComment->getFile()->getBranchId(),
        'FileName'    => $LineComment->getFile(),
        'FileId'      => $LineComment->getFileId(),
        'Position'    => $LineComment->getPosition(),
        'Line'        => $LineComment->getLine(),
        'Message'     => stringUtils::shorten($LineComment->getValue(), 60),
        'CreatedAt'   => $LineComment->getCreatedAt('d/m/Y H:i:s')
      );
    }

    krsort($commentBoards);

    return $commentBoards;
  }
}
