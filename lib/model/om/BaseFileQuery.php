<?php


/**
 * Base class that represents a query for the 'file' table.
 *
 * 
 *
 * @method     FileQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     FileQuery orderByBranchId($order = Criteria::ASC) Order by the branch_id column
 * @method     FileQuery orderByStatusId($order = Criteria::ASC) Order by the status_id column
 * @method     FileQuery orderByState($order = Criteria::ASC) Order by the state column
 * @method     FileQuery orderByFilename($order = Criteria::ASC) Order by the filename column
 * @method     FileQuery orderByCommitStatusChanged($order = Criteria::ASC) Order by the commit_status_changed column
 * @method     FileQuery orderByUserStatusChanged($order = Criteria::ASC) Order by the user_status_changed column
 * @method     FileQuery orderByDateStatusChanged($order = Criteria::ASC) Order by the date_status_changed column
 *
 * @method     FileQuery groupById() Group by the id column
 * @method     FileQuery groupByBranchId() Group by the branch_id column
 * @method     FileQuery groupByStatusId() Group by the status_id column
 * @method     FileQuery groupByState() Group by the state column
 * @method     FileQuery groupByFilename() Group by the filename column
 * @method     FileQuery groupByCommitStatusChanged() Group by the commit_status_changed column
 * @method     FileQuery groupByUserStatusChanged() Group by the user_status_changed column
 * @method     FileQuery groupByDateStatusChanged() Group by the date_status_changed column
 *
 * @method     FileQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     FileQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     FileQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     FileQuery leftJoinBranch($relationAlias = null) Adds a LEFT JOIN clause to the query using the Branch relation
 * @method     FileQuery rightJoinBranch($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Branch relation
 * @method     FileQuery innerJoinBranch($relationAlias = null) Adds a INNER JOIN clause to the query using the Branch relation
 *
 * @method     FileQuery leftJoinStatus($relationAlias = null) Adds a LEFT JOIN clause to the query using the Status relation
 * @method     FileQuery rightJoinStatus($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Status relation
 * @method     FileQuery innerJoinStatus($relationAlias = null) Adds a INNER JOIN clause to the query using the Status relation
 *
 * @method     FileQuery leftJoinFileComment($relationAlias = null) Adds a LEFT JOIN clause to the query using the FileComment relation
 * @method     FileQuery rightJoinFileComment($relationAlias = null) Adds a RIGHT JOIN clause to the query using the FileComment relation
 * @method     FileQuery innerJoinFileComment($relationAlias = null) Adds a INNER JOIN clause to the query using the FileComment relation
 *
 * @method     FileQuery leftJoinLineComment($relationAlias = null) Adds a LEFT JOIN clause to the query using the LineComment relation
 * @method     FileQuery rightJoinLineComment($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LineComment relation
 * @method     FileQuery innerJoinLineComment($relationAlias = null) Adds a INNER JOIN clause to the query using the LineComment relation
 *
 * @method     File findOne(PropelPDO $con = null) Return the first File matching the query
 * @method     File findOneOrCreate(PropelPDO $con = null) Return the first File matching the query, or a new File object populated from the query conditions when no match is found
 *
 * @method     File findOneById(int $id) Return the first File filtered by the id column
 * @method     File findOneByBranchId(int $branch_id) Return the first File filtered by the branch_id column
 * @method     File findOneByStatusId(int $status_id) Return the first File filtered by the status_id column
 * @method     File findOneByState(string $state) Return the first File filtered by the state column
 * @method     File findOneByFilename(string $filename) Return the first File filtered by the filename column
 * @method     File findOneByCommitStatusChanged(string $commit_status_changed) Return the first File filtered by the commit_status_changed column
 * @method     File findOneByUserStatusChanged(int $user_status_changed) Return the first File filtered by the user_status_changed column
 * @method     File findOneByDateStatusChanged(string $date_status_changed) Return the first File filtered by the date_status_changed column
 *
 * @method     array findById(int $id) Return File objects filtered by the id column
 * @method     array findByBranchId(int $branch_id) Return File objects filtered by the branch_id column
 * @method     array findByStatusId(int $status_id) Return File objects filtered by the status_id column
 * @method     array findByState(string $state) Return File objects filtered by the state column
 * @method     array findByFilename(string $filename) Return File objects filtered by the filename column
 * @method     array findByCommitStatusChanged(string $commit_status_changed) Return File objects filtered by the commit_status_changed column
 * @method     array findByUserStatusChanged(int $user_status_changed) Return File objects filtered by the user_status_changed column
 * @method     array findByDateStatusChanged(string $date_status_changed) Return File objects filtered by the date_status_changed column
 *
 * @package    propel.generator.lib.model.om
 */
abstract class BaseFileQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseFileQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'propel', $modelName = 'File', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new FileQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    FileQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof FileQuery) {
			return $criteria;
		}
		$query = new FileQuery();
		if (null !== $modelAlias) {
			$query->setModelAlias($modelAlias);
		}
		if ($criteria instanceof Criteria) {
			$query->mergeWith($criteria);
		}
		return $query;
	}

	/**
	 * Find object by primary key
	 * Use instance pooling to avoid a database query if the object exists
	 * <code>
	 * $obj  = $c->findPk(12, $con);
	 * </code>
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    File|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = FilePeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
			// the object is alredy in the instance pool
			return $obj;
		} else {
			// the object has not been requested yet, or the formatter is not an object formatter
			$criteria = $this->isKeepQuery() ? clone $this : $this;
			$stmt = $criteria
				->filterByPrimaryKey($key)
				->getSelectStatement($con);
			return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
		}
	}

	/**
	 * Find objects by primary key
	 * <code>
	 * $objs = $c->findPks(array(12, 56, 832), $con);
	 * </code>
	 * @param     array $keys Primary keys to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    PropelObjectCollection|array|mixed the list of results, formatted by the current formatter
	 */
	public function findPks($keys, $con = null)
	{	
		$criteria = $this->isKeepQuery() ? clone $this : $this;
		return $this
			->filterByPrimaryKeys($keys)
			->find($con);
	}

	/**
	 * Filter the query by primary key
	 *
	 * @param     mixed $key Primary key to use for the query
	 *
	 * @return    FileQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(FilePeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    FileQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(FilePeer::ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the id column
	 * 
	 * @param     int|array $id The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    FileQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(FilePeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the branch_id column
	 * 
	 * @param     int|array $branchId The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    FileQuery The current query, for fluid interface
	 */
	public function filterByBranchId($branchId = null, $comparison = null)
	{
		if (is_array($branchId)) {
			$useMinMax = false;
			if (isset($branchId['min'])) {
				$this->addUsingAlias(FilePeer::BRANCH_ID, $branchId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($branchId['max'])) {
				$this->addUsingAlias(FilePeer::BRANCH_ID, $branchId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(FilePeer::BRANCH_ID, $branchId, $comparison);
	}

	/**
	 * Filter the query on the status_id column
	 * 
	 * @param     int|array $statusId The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    FileQuery The current query, for fluid interface
	 */
	public function filterByStatusId($statusId = null, $comparison = null)
	{
		if (is_array($statusId)) {
			$useMinMax = false;
			if (isset($statusId['min'])) {
				$this->addUsingAlias(FilePeer::STATUS_ID, $statusId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($statusId['max'])) {
				$this->addUsingAlias(FilePeer::STATUS_ID, $statusId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(FilePeer::STATUS_ID, $statusId, $comparison);
	}

	/**
	 * Filter the query on the state column
	 * 
	 * @param     string $state The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    FileQuery The current query, for fluid interface
	 */
	public function filterByState($state = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($state)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $state)) {
				$state = str_replace('*', '%', $state);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(FilePeer::STATE, $state, $comparison);
	}

	/**
	 * Filter the query on the filename column
	 * 
	 * @param     string $filename The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    FileQuery The current query, for fluid interface
	 */
	public function filterByFilename($filename = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($filename)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $filename)) {
				$filename = str_replace('*', '%', $filename);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(FilePeer::FILENAME, $filename, $comparison);
	}

	/**
	 * Filter the query on the commit_status_changed column
	 * 
	 * @param     string $commitStatusChanged The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    FileQuery The current query, for fluid interface
	 */
	public function filterByCommitStatusChanged($commitStatusChanged = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($commitStatusChanged)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $commitStatusChanged)) {
				$commitStatusChanged = str_replace('*', '%', $commitStatusChanged);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(FilePeer::COMMIT_STATUS_CHANGED, $commitStatusChanged, $comparison);
	}

	/**
	 * Filter the query on the user_status_changed column
	 * 
	 * @param     int|array $userStatusChanged The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    FileQuery The current query, for fluid interface
	 */
	public function filterByUserStatusChanged($userStatusChanged = null, $comparison = null)
	{
		if (is_array($userStatusChanged)) {
			$useMinMax = false;
			if (isset($userStatusChanged['min'])) {
				$this->addUsingAlias(FilePeer::USER_STATUS_CHANGED, $userStatusChanged['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($userStatusChanged['max'])) {
				$this->addUsingAlias(FilePeer::USER_STATUS_CHANGED, $userStatusChanged['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(FilePeer::USER_STATUS_CHANGED, $userStatusChanged, $comparison);
	}

	/**
	 * Filter the query on the date_status_changed column
	 * 
	 * @param     string|array $dateStatusChanged The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    FileQuery The current query, for fluid interface
	 */
	public function filterByDateStatusChanged($dateStatusChanged = null, $comparison = null)
	{
		if (is_array($dateStatusChanged)) {
			$useMinMax = false;
			if (isset($dateStatusChanged['min'])) {
				$this->addUsingAlias(FilePeer::DATE_STATUS_CHANGED, $dateStatusChanged['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($dateStatusChanged['max'])) {
				$this->addUsingAlias(FilePeer::DATE_STATUS_CHANGED, $dateStatusChanged['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(FilePeer::DATE_STATUS_CHANGED, $dateStatusChanged, $comparison);
	}

	/**
	 * Filter the query by a related Branch object
	 *
	 * @param     Branch $branch  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    FileQuery The current query, for fluid interface
	 */
	public function filterByBranch($branch, $comparison = null)
	{
		return $this
			->addUsingAlias(FilePeer::BRANCH_ID, $branch->getId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the Branch relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    FileQuery The current query, for fluid interface
	 */
	public function joinBranch($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Branch');
		
		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}
		
		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'Branch');
		}
		
		return $this;
	}

	/**
	 * Use the Branch relation Branch object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    BranchQuery A secondary query class using the current class as primary query
	 */
	public function useBranchQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinBranch($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Branch', 'BranchQuery');
	}

	/**
	 * Filter the query by a related Status object
	 *
	 * @param     Status $status  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    FileQuery The current query, for fluid interface
	 */
	public function filterByStatus($status, $comparison = null)
	{
		return $this
			->addUsingAlias(FilePeer::STATUS_ID, $status->getId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the Status relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    FileQuery The current query, for fluid interface
	 */
	public function joinStatus($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Status');
		
		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}
		
		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'Status');
		}
		
		return $this;
	}

	/**
	 * Use the Status relation Status object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    StatusQuery A secondary query class using the current class as primary query
	 */
	public function useStatusQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinStatus($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Status', 'StatusQuery');
	}

	/**
	 * Filter the query by a related FileComment object
	 *
	 * @param     FileComment $fileComment  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    FileQuery The current query, for fluid interface
	 */
	public function filterByFileComment($fileComment, $comparison = null)
	{
		return $this
			->addUsingAlias(FilePeer::ID, $fileComment->getFileId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the FileComment relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    FileQuery The current query, for fluid interface
	 */
	public function joinFileComment($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('FileComment');
		
		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}
		
		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'FileComment');
		}
		
		return $this;
	}

	/**
	 * Use the FileComment relation FileComment object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    FileCommentQuery A secondary query class using the current class as primary query
	 */
	public function useFileCommentQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinFileComment($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'FileComment', 'FileCommentQuery');
	}

	/**
	 * Filter the query by a related LineComment object
	 *
	 * @param     LineComment $lineComment  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    FileQuery The current query, for fluid interface
	 */
	public function filterByLineComment($lineComment, $comparison = null)
	{
		return $this
			->addUsingAlias(FilePeer::ID, $lineComment->getFileId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the LineComment relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    FileQuery The current query, for fluid interface
	 */
	public function joinLineComment($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('LineComment');
		
		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}
		
		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'LineComment');
		}
		
		return $this;
	}

	/**
	 * Use the LineComment relation LineComment object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    LineCommentQuery A secondary query class using the current class as primary query
	 */
	public function useLineCommentQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinLineComment($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'LineComment', 'LineCommentQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     File $file Object to remove from the list of results
	 *
	 * @return    FileQuery The current query, for fluid interface
	 */
	public function prune($file = null)
	{
		if ($file) {
			$this->addUsingAlias(FilePeer::ID, $file->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseFileQuery
