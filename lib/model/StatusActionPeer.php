<?php



/**
 * Skeleton subclass for performing query and update operations on the 'status_action' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.lib.model
 */
class StatusActionPeer extends BaseStatusActionPeer {
  public static function getStatusActionsForBoard($userId = null, $repositoryId = null, $branchId = null)
  {
    $statusActionsQuery = StatusActionQuery::create();

    if(!is_null($userId))
    {
      $statusActionsQuery->filterByUserId($userId);
    }

    if(!is_null($repositoryId))
    {
      $statusActionsQuery->filterByRepositoryId($repositoryId);
    }

    if(!is_null($branchId))
    {
      $statusActionsQuery->filterByBranchId($branchId);
    }

    $statusActions = $statusActionsQuery->orderByCreatedAt(\Criteria::DESC)
    ->limit(25)
    ->find()
  ;

    return $statusActions;
  }
} // StatusActionPeer
