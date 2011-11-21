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
	 * Find object by primary key.
	 * Propel uses the instance pool to skip the database if the object exists.
	 * Go fast if the query is untouched.
	 *
	 * <code>
	 * $obj  = $c->findPk(12, $con);
	 * </code>
	 *
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    StatusAction|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = StatusActionPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(StatusActionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$this->basePreSelect($con);
		if ($this->formatter || $this->modelAlias || $this->with || $this->select
		 || $this->selectColumns || $this->asColumns || $this->selectModifiers
		 || $this->map || $this->having || $this->joins) {
			return $this->findPkComplex($key, $con);
		} else {
			return $this->findPkSimple($key, $con);
		}
	}

	/**
	 * Find object by primary key using raw SQL to go fast.
	 * Bypass doSelect() and the object formatter by using generated code.
	 *
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con A connection object
	 *
	 * @return    StatusAction A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `USER_ID`, `REPOSITORY_ID`, `BRANCH_ID`, `FILE_ID`, `MESSAGE`, `OLD_STATUS`, `NEW_STATUS`, `CREATED_AT` FROM `status_action` WHERE `ID` = :p0';
		try {
			$stmt = $con->prepare($sql);
			$stmt->bindValue(':p0', $key, PDO::PARAM_INT);
			$stmt->execute();
		} catch (Exception $e) {
			Propel::log($e->getMessage(), Propel::LOG_ERR);
			throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
		}
		$obj = null;
		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$obj = new StatusAction();
			$obj->hydrate($row);
			StatusActionPeer::addInstanceToPool($obj, (string) $row[0]);
		}
		$stmt->closeCursor();

		return $obj;
	}

	/**
	 * Find object by primary key.
	 *
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con A connection object
	 *
	 * @return    StatusAction|array|mixed the result, formatted by the current formatter
	 */
	protected function findPkComplex($key, $con)
	{
		// As the query uses a PK condition, no limit(1) is necessary.
		$criteria = $this->isKeepQuery() ? clone $this : $this;
		$stmt = $criteria
			->filterByPrimaryKey($key)
			->doSelect($con);
		return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
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
		if ($con === null) {
			$con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
		}
		$this->basePreSelect($con);
		$criteria = $this->isKeepQuery() ? clone $this : $this;
		$stmt = $criteria
			->filterByPrimaryKeys($keys)
			->doSelect($con);
		return $criteria->getFormatter()->init($criteria)->format($stmt);
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
	 * Example usage:
	 * <code>
	 * $query->filterById(1234); // WHERE id = 1234
	 * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
	 * $query->filterById(array('min' => 12)); // WHERE id > 12
	 * </code>
	 *
	 * @param     mixed $id The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
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
	 * Example usage:
	 * <code>
	 * $query->filterByUserId(1234); // WHERE user_id = 1234
	 * $query->filterByUserId(array(12, 34)); // WHERE user_id IN (12, 34)
	 * $query->filterByUserId(array('min' => 12)); // WHERE user_id > 12
	 * </code>
	 *
	 * @see       filterBysfGuardUser()
	 *
	 * @param     mixed $userId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
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
	 * Example usage:
	 * <code>
	 * $query->filterByRepositoryId(1234); // WHERE repository_id = 1234
	 * $query->filterByRepositoryId(array(12, 34)); // WHERE repository_id IN (12, 34)
	 * $query->filterByRepositoryId(array('min' => 12)); // WHERE repository_id > 12
	 * </code>
	 *
	 * @see       filterByRepository()
	 *
	 * @param     mixed $repositoryId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
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
	 * Example usage:
	 * <code>
	 * $query->filterByBranchId(1234); // WHERE branch_id = 1234
	 * $query->filterByBranchId(array(12, 34)); // WHERE branch_id IN (12, 34)
	 * $query->filterByBranchId(array('min' => 12)); // WHERE branch_id > 12
	 * </code>
	 *
	 * @see       filterByBranch()
	 *
	 * @param     mixed $branchId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
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
	 * Example usage:
	 * <code>
	 * $query->filterByFileId(1234); // WHERE file_id = 1234
	 * $query->filterByFileId(array(12, 34)); // WHERE file_id IN (12, 34)
	 * $query->filterByFileId(array('min' => 12)); // WHERE file_id > 12
	 * </code>
	 *
	 * @see       filterByFile()
	 *
	 * @param     mixed $fileId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
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
	 * Example usage:
	 * <code>
	 * $query->filterByMessage('fooValue');   // WHERE message = 'fooValue'
	 * $query->filterByMessage('%fooValue%'); // WHERE message LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $message The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
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
	 * Example usage:
	 * <code>
	 * $query->filterByOldStatus(1234); // WHERE old_status = 1234
	 * $query->filterByOldStatus(array(12, 34)); // WHERE old_status IN (12, 34)
	 * $query->filterByOldStatus(array('min' => 12)); // WHERE old_status > 12
	 * </code>
	 *
	 * @param     mixed $oldStatus The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
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
	 * Example usage:
	 * <code>
	 * $query->filterByNewStatus(1234); // WHERE new_status = 1234
	 * $query->filterByNewStatus(array(12, 34)); // WHERE new_status IN (12, 34)
	 * $query->filterByNewStatus(array('min' => 12)); // WHERE new_status > 12
	 * </code>
	 *
	 * @param     mixed $newStatus The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
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
	 * Example usage:
	 * <code>
	 * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
	 * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
	 * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE created_at > '2011-03-13'
	 * </code>
	 *
	 * @param     mixed $createdAt The value to use as filter.
	 *              Values can be integers (unix timestamps), DateTime objects, or strings.
	 *              Empty strings are treated as NULL.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
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
	 * @param     sfGuardUser|PropelCollection $sfGuardUser The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    StatusActionQuery The current query, for fluid interface
	 */
	public function filterBysfGuardUser($sfGuardUser, $comparison = null)
	{
		if ($sfGuardUser instanceof sfGuardUser) {
			return $this
				->addUsingAlias(StatusActionPeer::USER_ID, $sfGuardUser->getId(), $comparison);
		} elseif ($sfGuardUser instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(StatusActionPeer::USER_ID, $sfGuardUser->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterBysfGuardUser() only accepts arguments of type sfGuardUser or PropelCollection');
		}
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
	 * @param     Repository|PropelCollection $repository The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    StatusActionQuery The current query, for fluid interface
	 */
	public function filterByRepository($repository, $comparison = null)
	{
		if ($repository instanceof Repository) {
			return $this
				->addUsingAlias(StatusActionPeer::REPOSITORY_ID, $repository->getId(), $comparison);
		} elseif ($repository instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(StatusActionPeer::REPOSITORY_ID, $repository->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByRepository() only accepts arguments of type Repository or PropelCollection');
		}
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
	 * @param     Branch|PropelCollection $branch The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    StatusActionQuery The current query, for fluid interface
	 */
	public function filterByBranch($branch, $comparison = null)
	{
		if ($branch instanceof Branch) {
			return $this
				->addUsingAlias(StatusActionPeer::BRANCH_ID, $branch->getId(), $comparison);
		} elseif ($branch instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(StatusActionPeer::BRANCH_ID, $branch->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByBranch() only accepts arguments of type Branch or PropelCollection');
		}
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
	 * @param     File|PropelCollection $file The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    StatusActionQuery The current query, for fluid interface
	 */
	public function filterByFile($file, $comparison = null)
	{
		if ($file instanceof File) {
			return $this
				->addUsingAlias(StatusActionPeer::FILE_ID, $file->getId(), $comparison);
		} elseif ($file instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(StatusActionPeer::FILE_ID, $file->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByFile() only accepts arguments of type File or PropelCollection');
		}
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