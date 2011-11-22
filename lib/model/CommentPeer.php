<?php



/**
 * Skeleton subclass for performing query and update operations on the 'comment' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.lib.model
 */
class CommentPeer extends BaseCommentPeer {
  public static function getCommentsForBoard($userId = null, $repositoryId = null, $branchId = null)
  {
    $board = array();

    $commentsQuery = CommentQuery::create();

    if(!is_null($userId))
    {
      $commentsQuery->filterByUserId($userId);
    }

    if(!is_null($repositoryId))
    {
      $commentsQuery->useBranchQuery()
        ->filterByRepositoryId($repositoryId)
      ->endUse();
    }

    if(!is_null($branchId))
    {
      $commentsQuery->filterByBranchId($branchId);
    }

    $comments = $commentsQuery->orderByCreatedAt(Criteria::DESC)
      ->limit(50)
      ->find()
    ;

    foreach ($comments as $comment)
    {
      $board[$comment->getCreatedAt('YmdHisu')] = array(
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
        'Message'     => stringUtils::shorten($comment->getValue(), 95),
        'CreatedAt'   => $comment->getCreatedAt('d/m/Y H:i:s')
      );
    }

    krsort($board);

    return $board;
  }
} // CommentPeer
