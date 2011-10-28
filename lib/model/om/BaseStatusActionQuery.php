<?php


/**
 * Base class that represents a query for the 'status_action' table.
 *
 * 
 *
 * @method     StatusActionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     StatusActionQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     StatusActionQuery orderByRepositoryId($order = Criteria::ASC) Order by the repository_id column
 * @method     StatusActionQuery orderByBranchId($order = Criteria::ASC) Order by the branch_id column
 * @method     StatusActionQuery orderByFileId($order = Criteria::ASC) Order by the file_id column
 * @method     StatusActionQuery orderByMessage($order = Criteria::ASC) Order by the message column
 * @method     StatusActionQuery orderByOldStatus($order = Criteria::ASC) Order by the old_status column
 * @method     StatusActionQuery orderByNewStatus($order = Criteria::ASC) Order by the new_status column
 * @method     StatusActionQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 *
 * @method     StatusActionQuery groupById() Group by the id column
 * @method     StatusActionQuery groupByUserId() Group by the user_id column
 * @method     StatusActionQuery groupByRepositoryId() Group by the repository_id column
 * @method     StatusActionQuery groupByBranchId() Group by the branch_id column
 * @method     StatusActionQuery groupByFileId() Group by the file_id column
 * @method     StatusActionQuery groupByMessage() Group by the message column
 * @method     StatusActionQuery groupByOldStatus() Group by the old_status column
 * @method     StatusActionQuery groupByNewStatus() Group by the new_status column
 * @method     StatusActionQuery groupByCreatedAt() Group by the created_at column
 *
 * @method     StatusActionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     StatusActionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     StatusActionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     StatusActionQuery leftJoinsfGuardUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the sfGuardUser relation
 * @method     StatusActionQuery rightJoinsfGuardUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the sfGuardUser relation
 * @method     StatusActionQuery innerJoinsfGuardUser($relationAlias = null) Adds a INNER JOIN clause to the query using the sfGuardUser relation
 *
 * @method     StatusActionQuery leftJoinRepository($relationAlias = null) Adds a LEFT JOIN clause to the query using the Repository relation
 * @method     StatusActionQuery rightJoinRepository($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Repository relation
 * @method     StatusActionQuery innerJoinRepository($relationAlias = null) Adds a INNER JOIN clause to the query using the Repository relation
 *
 * @method     StatusActionQuery leftJoinBranch($relationAlias = null) Adds a LEFT JOIN clause to the query using the Branch relation
 * @method     StatusActionQuery rightJoinBranch($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Branch relation
 * @method     StatusActionQuery innerJoinBranch($relationAlias = null) Adds a INNER JOIN clause to the query using the Branch relation
 *
 * @method     StatusActionQuery leftJoinFile($relationAlias = null) Adds a LEFT JOIN clause to the query using the File relation
 * @method     StatusActionQuery rightJoinFile($relationAlias = null) Adds a RIGHT JOIN clause to the query using the File relation
 * @method     StatusActionQuery innerJoinFile($relationAlias = null) Adds a INNER JOIN clause to the query using the File relation
 *
 * @method     StatusAction findOne(PropelPDO $con = null) Return the first StatusAction matching the query
 * @method     StatusAction findOneOrCreate(PropelPDO $con = null) Return the first StatusAction matching the query, or a new StatusAction object populated from the query conditions when no match is found
 *
 * @method     StatusAction findOneById(int $id) Return the first StatusAction filtered by the id column
 * @method     StatusAction findOneByUserId(int $user_id) Return the first StatusAction filtered by the user_id column
 * @method     StatusAction findOneByRepositoryId(int $repository_id) Return the first StatusAction filtered by the repository_id column
 * @method     StatusAction findOneByBranchId(int $branch_id) Return the first StatusAction filtered by the branch_id column
 * @method     StatusAction findOneByFileId(int $file_id) Return the first StatusAction filtered by the file_id column
 * @method     StatusAction findOneByMessage(string $message) Return the first StatusAction filtered by the message column
 * @method     StatusAction findOneByOldStatus(int $old_status) Return the first StatusAction filtered by the old_status column
 * @method     StatusAction findOneByNewStatus(int $new_status) Return the first StatusAction filtered by the new_status column
 * @method     StatusAction findOneByCreatedAt(string $created_at) Return the first StatusAction filtered by the created_at column
 *
 * @method     array findById(int $id) Return StatusAction objects filtered by the id column
 * @method     array findByUserId(int $user_id) Return StatusAction objects filtered by the user_id column
 * @method     array findByRepositoryId(int $repository_id) Return StatusAction objects filtered by the repository_id column
 * @method     array findByBranchId(int $branch_id) Return StatusAction objects filtered by the branch_id column
 * @method     array findByFileId(int $file_id) Return StatusAction objects filtered by the file_id column
 * @method     array findByMessage(string $message) Return StatusAction objects filtered by the message column
 * @method     array findByOldStatus(int $old_status) Return StatusAction objects filtered by the old_status column
 * @method     array findByNewStatus(int $new_status) Return StatusAction objects filtered by the new_status column
 * @method     array findByCreatedAt(string $created_at) Return StatusAction objects filtered by the created_at column
 *
 * @package    propel.generator.lib.model.om
 */
abstract class BaseStatusActionQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseStatusActionQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'propel', $modelName = 'StatusAction', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new StatusActionQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    StatusActionQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof StatusActionQuery) {
			return $criteria;
		}
		$query = new StatusActionQuery();
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
	 * @return    StatusAction|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = StatusActionPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    StatusActionQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(StatusActionPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    StatusActionQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(StatusActionPeer::ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the id column
	 * 
	 * @param     int|array $id The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    StatusActionQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(StatusActionPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the user_id column
	 * 
	 * @param     int|array $userId The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    StatusActionQuery The current query, for fluid interface
	 */
	public function filterByUserId($userId = null, $comparison = null)
	{
		if (is_array($userId)) {
			$useMinMax = false;
			if (isset($userId['min'])) {
				$this->addUsingAlias(StatusActionPeer::USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($userId['max'])) {
				$this->addUsingAlias(StatusActionPeer::USER_ID, $userId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(StatusActionPeer::USER_ID, $userId, $comparison);
	}

	/**
	 * Filter the query on the repository_id column
	 * 
	 * @param     int|array $repositoryId The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    StatusActionQuery The current query, for fluid interface
	 */
	public function filterByRepositoryId($repositoryId = null, $comparison = null)
	{
		if (is_array($repositoryId)) {
			$useMinMax = false;
			if (isset($repositoryId['min'])) {
				$this->addUsingAlias(StatusActionPeer::REPOSITORY_ID, $repositoryId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($repositoryId['max'])) {
				$this->addUsingAlias(StatusActionPeer::REPOSITORY_ID, $repositoryId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(StatusActionPeer::REPOSITORY_ID, $repositoryId, $comparison);
	}

	/**
	 * Filter the query on the branch_id column
	 * 
	 * @param     int|array $branchId The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    StatusActionQuery The current query, for fluid interface
	 */
	public function filterByBranchId($branchId = null, $comparison = null)
	{
		if (is_array($branchId)) {
			$useMinMax = false;
			if (isset($branchId['min'])) {
				$this->addUsingAlias(StatusActionPeer::BRANCH_ID, $branchId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($branchId['max'])) {
				$this->addUsingAlias(StatusActionPeer::BRANCH_ID, $branchId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(StatusActionPeer::BRANCH_ID, $branchId, $comparison);
	}

	/**
	 * Filter the query on the file_id column
	 * 
	 * @param     int|array $fileId The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    StatusActionQuery The current query, for fluid interface
	 */
	public function filterByFileId($fileId = null, $comparison = null)
	{
		if (is_array($fileId)) {
			$useMinMax = false;
			if (isset($fileId['min'])) {
				$this->addUsingAlias(StatusActionPeer::FILE_ID, $fileId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($fileId['max'])) {
				$this->addUsingAlias(StatusActionPeer::FILE_ID, $fileId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(StatusActionPeer::FILE_ID, $fileId, $comparison);
	}

	/**
	 * Filter the query on the message column
	 * 
	 * @param     string $message The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    StatusActionQuery The current query, for fluid interface
	 */
	public function filterByMessage($message = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($message)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $message)) {
				$message = str_replace('*', '%', $message);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(StatusActionPeer::MESSAGE, $message, $comparison);
	}

	/**
	 * Filter the query on the old_status column
	 * 
	 * @param     int|array $oldStatus The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    StatusActionQuery The current query, for fluid interface
	 */
	public function filterByOldStatus($oldStatus = null, $comparison = null)
	{
		if (is_array($oldStatus)) {
			$useMinMax = false;
			if (isset($oldStatus['min'])) {
				$this->addUsingAlias(StatusActionPeer::OLD_STATUS, $oldStatus['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($oldStatus['max'])) {
				$this->addUsingAlias(StatusActionPeer::OLD_STATUS, $oldStatus['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(StatusActionPeer::OLD_STATUS, $oldStatus, $comparison);
	}

	/**
	 * Filter the query on the new_status column
	 * 
	 * @param     int|array $newStatus The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    StatusActionQuery The current query, for fluid interface
	 */
	public function filterByNewStatus($newStatus = null, $comparison = null)
	{
		if (is_array($newStatus)) {
			$useMinMax = false;
			if (isset($newStatus['min'])) {
				$this->addUsingAlias(StatusActionPeer::NEW_STATUS, $newStatus['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($newStatus['max'])) {
				$this->addUsingAlias(StatusActionPeer::NEW_STATUS, $newStatus['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(StatusActionPeer::NEW_STATUS, $newStatus, $comparison);
	}

	/**
	 * Filter the query on the created_at column
	 * 
	 * @param     string|array $createdAt The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    StatusActionQuery The current query, for fluid interface
	 */
	public function filterByCreatedAt($createdAt = null, $comparison = null)
	{
		if (is_array($createdAt)) {
			$useMinMax = false;
			if (isset($createdAt['min'])) {
				$this->addUsingAlias(StatusActionPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($createdAt['max'])) {
				$this->addUsingAlias(StatusActionPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(StatusActionPeer::CREATED_AT, $createdAt, $comparison);
	}

	/**
	 * Filter the query by a related sfGuardUser object
	 *
	 * @param     sfGuardUser $sfGuardUser  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    StatusActionQuery The current query, for fluid interface
	 */
	public function filterBysfGuardUser($sfGuardUser, $comparison = null)
	{
		return $this
			->addUsingAlias(StatusActionPeer::USER_ID, $sfGuardUser->getId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the sfGuardUser relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    StatusActionQuery The current query, for fluid interface
	 */
	public function joinsfGuardUser($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('sfGuardUser');
		
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
			$this->addJoinObject($join, 'sfGuardUser');
		}
		
		return $this;
	}

	/**
	 * Use the sfGuardUser relation sfGuardUser object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    sfGuardUserQuery A secondary query class using the current class as primary query
	 */
	public function usesfGuardUserQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinsfGuardUser($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'sfGuardUser', 'sfGuardUserQuery');
	}

	/**
	 * Filter the query by a related Repository object
	 *
	 * @param     Repository $repository  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    StatusActionQuery The current query, for fluid interface
	 */
	public function filterByRepository($repository, $comparison = null)
	{
		return $this
			->addUsingAlias(StatusActionPeer::REPOSITORY_ID, $repository->getId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the Repository relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    StatusActionQuery The current query, for fluid interface
	 */
	public function joinRepository($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Repository');
		
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
			$this->addJoinObject($join, 'Repository');
		}
		
		return $this;
	}

	/**
	 * Use the Repository relation Repository object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    RepositoryQuery A secondary query class using the current class as primary query
	 */
	public function useRepositoryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinRepository($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Repository', 'RepositoryQuery');
	}

	/**
	 * Filter the query by a related Branch object
	 *
	 * @param     Branch $branch  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    StatusActionQuery The current query, for fluid interface
	 */
	public function filterByBranch($branch, $comparison = null)
	{
		return $this
			->addUsingAlias(StatusActionPeer::BRANCH_ID, $branch->getId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the Branch relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    StatusActionQuery The current query, for fluid interface
	 */
	public function joinBranch($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
	public function useBranchQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinBranch($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Branch', 'BranchQuery');
	}

	/**
	 * Filter the query by a related File object
	 *
	 * @param     File $file  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    StatusActionQuery The current query, for fluid interface
	 */
	public function filterByFile($file, $comparison = null)
	{
		return $this
			->addUsingAlias(StatusActionPeer::FILE_ID, $file->getId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the File relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    StatusActionQuery The current query, for fluid interface
	 */
	public function joinFile($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('File');
		
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
			$this->addJoinObject($join, 'File');
		}
		
		return $this;
	}

	/**
	 * Use the File relation File object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    FileQuery A secondary query class using the current class as primary query
	 */
	public function useFileQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinFile($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'File', 'FileQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     StatusAction $statusAction Object to remove from the list of results
	 *
	 * @return    StatusActionQuery The current query, for fluid interface
	 */
	public function prune($statusAction = null)
	{
		if ($statusAction) {
			$this->addUsingAlias(StatusActionPeer::ID, $statusAction->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseStatusActionQuery
