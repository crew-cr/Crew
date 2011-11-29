<?php


/**
 * Base class that represents a query for the 'file' table.
 *
 * 
 *
 * @method     FileQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     FileQuery orderByBranchId($order = Criteria::ASC) Order by the branch_id column
 * @method     FileQuery orderByState($order = Criteria::ASC) Order by the state column
 * @method     FileQuery orderByFilename($order = Criteria::ASC) Order by the filename column
 * @method     FileQuery orderByNbAddedLines($order = Criteria::ASC) Order by the nb_added_lines column
 * @method     FileQuery orderByNbDeletedLines($order = Criteria::ASC) Order by the nb_deleted_lines column
 * @method     FileQuery orderByLastChangeCommit($order = Criteria::ASC) Order by the last_change_commit column
 * @method     FileQuery orderByLastChangeCommitDesc($order = Criteria::ASC) Order by the last_change_commit_desc column
 * @method     FileQuery orderByLastChangeCommitUser($order = Criteria::ASC) Order by the last_change_commit_user column
 * @method     FileQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     FileQuery orderByCommitStatusChanged($order = Criteria::ASC) Order by the commit_status_changed column
 * @method     FileQuery orderByUserStatusChanged($order = Criteria::ASC) Order by the user_status_changed column
 * @method     FileQuery orderByDateStatusChanged($order = Criteria::ASC) Order by the date_status_changed column
 *
 * @method     FileQuery groupById() Group by the id column
 * @method     FileQuery groupByBranchId() Group by the branch_id column
 * @method     FileQuery groupByState() Group by the state column
 * @method     FileQuery groupByFilename() Group by the filename column
 * @method     FileQuery groupByNbAddedLines() Group by the nb_added_lines column
 * @method     FileQuery groupByNbDeletedLines() Group by the nb_deleted_lines column
 * @method     FileQuery groupByLastChangeCommit() Group by the last_change_commit column
 * @method     FileQuery groupByLastChangeCommitDesc() Group by the last_change_commit_desc column
 * @method     FileQuery groupByLastChangeCommitUser() Group by the last_change_commit_user column
 * @method     FileQuery groupByStatus() Group by the status column
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
 * @method     FileQuery leftJoinsfGuardUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the sfGuardUser relation
 * @method     FileQuery rightJoinsfGuardUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the sfGuardUser relation
 * @method     FileQuery innerJoinsfGuardUser($relationAlias = null) Adds a INNER JOIN clause to the query using the sfGuardUser relation
 *
 * @method     FileQuery leftJoinComment($relationAlias = null) Adds a LEFT JOIN clause to the query using the Comment relation
 * @method     FileQuery rightJoinComment($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Comment relation
 * @method     FileQuery innerJoinComment($relationAlias = null) Adds a INNER JOIN clause to the query using the Comment relation
 *
 * @method     FileQuery leftJoinStatusAction($relationAlias = null) Adds a LEFT JOIN clause to the query using the StatusAction relation
 * @method     FileQuery rightJoinStatusAction($relationAlias = null) Adds a RIGHT JOIN clause to the query using the StatusAction relation
 * @method     FileQuery innerJoinStatusAction($relationAlias = null) Adds a INNER JOIN clause to the query using the StatusAction relation
 *
 * @method     File findOne(PropelPDO $con = null) Return the first File matching the query
 * @method     File findOneOrCreate(PropelPDO $con = null) Return the first File matching the query, or a new File object populated from the query conditions when no match is found
 *
 * @method     File findOneById(int $id) Return the first File filtered by the id column
 * @method     File findOneByBranchId(int $branch_id) Return the first File filtered by the branch_id column
 * @method     File findOneByState(string $state) Return the first File filtered by the state column
 * @method     File findOneByFilename(string $filename) Return the first File filtered by the filename column
 * @method     File findOneByNbAddedLines(int $nb_added_lines) Return the first File filtered by the nb_added_lines column
 * @method     File findOneByNbDeletedLines(int $nb_deleted_lines) Return the first File filtered by the nb_deleted_lines column
 * @method     File findOneByLastChangeCommit(string $last_change_commit) Return the first File filtered by the last_change_commit column
 * @method     File findOneByLastChangeCommitDesc(string $last_change_commit_desc) Return the first File filtered by the last_change_commit_desc column
 * @method     File findOneByLastChangeCommitUser(int $last_change_commit_user) Return the first File filtered by the last_change_commit_user column
 * @method     File findOneByStatus(int $status) Return the first File filtered by the status column
 * @method     File findOneByCommitStatusChanged(string $commit_status_changed) Return the first File filtered by the commit_status_changed column
 * @method     File findOneByUserStatusChanged(int $user_status_changed) Return the first File filtered by the user_status_changed column
 * @method     File findOneByDateStatusChanged(string $date_status_changed) Return the first File filtered by the date_status_changed column
 *
 * @method     array findById(int $id) Return File objects filtered by the id column
 * @method     array findByBranchId(int $branch_id) Return File objects filtered by the branch_id column
 * @method     array findByState(string $state) Return File objects filtered by the state column
 * @method     array findByFilename(string $filename) Return File objects filtered by the filename column
 * @method     array findByNbAddedLines(int $nb_added_lines) Return File objects filtered by the nb_added_lines column
 * @method     array findByNbDeletedLines(int $nb_deleted_lines) Return File objects filtered by the nb_deleted_lines column
 * @method     array findByLastChangeCommit(string $last_change_commit) Return File objects filtered by the last_change_commit column
 * @method     array findByLastChangeCommitDesc(string $last_change_commit_desc) Return File objects filtered by the last_change_commit_desc column
 * @method     array findByLastChangeCommitUser(int $last_change_commit_user) Return File objects filtered by the last_change_commit_user column
 * @method     array findByStatus(int $status) Return File objects filtered by the status column
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
	 * @return    File|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = FilePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(FilePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    File A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `BRANCH_ID`, `STATE`, `FILENAME`, `NB_ADDED_LINES`, `NB_DELETED_LINES`, `LAST_CHANGE_COMMIT`, `LAST_CHANGE_COMMIT_DESC`, `LAST_CHANGE_COMMIT_USER`, `STATUS`, `COMMIT_STATUS_CHANGED`, `USER_STATUS_CHANGED`, `DATE_STATUS_CHANGED` FROM `file` WHERE `ID` = :p0';
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
			$obj = new File();
			$obj->hydrate($row);
			FilePeer::addInstanceToPool($obj, (string) $row[0]);
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
	 * @return    File|array|mixed the result, formatted by the current formatter
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
	 * Filter the query on the state column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByState('fooValue');   // WHERE state = 'fooValue'
	 * $query->filterByState('%fooValue%'); // WHERE state LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $state The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
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
	 * Example usage:
	 * <code>
	 * $query->filterByFilename('fooValue');   // WHERE filename = 'fooValue'
	 * $query->filterByFilename('%fooValue%'); // WHERE filename LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $filename The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
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
	 * Filter the query on the nb_added_lines column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByNbAddedLines(1234); // WHERE nb_added_lines = 1234
	 * $query->filterByNbAddedLines(array(12, 34)); // WHERE nb_added_lines IN (12, 34)
	 * $query->filterByNbAddedLines(array('min' => 12)); // WHERE nb_added_lines > 12
	 * </code>
	 *
	 * @param     mixed $nbAddedLines The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    FileQuery The current query, for fluid interface
	 */
	public function filterByNbAddedLines($nbAddedLines = null, $comparison = null)
	{
		if (is_array($nbAddedLines)) {
			$useMinMax = false;
			if (isset($nbAddedLines['min'])) {
				$this->addUsingAlias(FilePeer::NB_ADDED_LINES, $nbAddedLines['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($nbAddedLines['max'])) {
				$this->addUsingAlias(FilePeer::NB_ADDED_LINES, $nbAddedLines['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(FilePeer::NB_ADDED_LINES, $nbAddedLines, $comparison);
	}

	/**
	 * Filter the query on the nb_deleted_lines column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByNbDeletedLines(1234); // WHERE nb_deleted_lines = 1234
	 * $query->filterByNbDeletedLines(array(12, 34)); // WHERE nb_deleted_lines IN (12, 34)
	 * $query->filterByNbDeletedLines(array('min' => 12)); // WHERE nb_deleted_lines > 12
	 * </code>
	 *
	 * @param     mixed $nbDeletedLines The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    FileQuery The current query, for fluid interface
	 */
	public function filterByNbDeletedLines($nbDeletedLines = null, $comparison = null)
	{
		if (is_array($nbDeletedLines)) {
			$useMinMax = false;
			if (isset($nbDeletedLines['min'])) {
				$this->addUsingAlias(FilePeer::NB_DELETED_LINES, $nbDeletedLines['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($nbDeletedLines['max'])) {
				$this->addUsingAlias(FilePeer::NB_DELETED_LINES, $nbDeletedLines['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(FilePeer::NB_DELETED_LINES, $nbDeletedLines, $comparison);
	}

	/**
	 * Filter the query on the last_change_commit column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByLastChangeCommit('fooValue');   // WHERE last_change_commit = 'fooValue'
	 * $query->filterByLastChangeCommit('%fooValue%'); // WHERE last_change_commit LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $lastChangeCommit The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    FileQuery The current query, for fluid interface
	 */
	public function filterByLastChangeCommit($lastChangeCommit = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($lastChangeCommit)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $lastChangeCommit)) {
				$lastChangeCommit = str_replace('*', '%', $lastChangeCommit);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(FilePeer::LAST_CHANGE_COMMIT, $lastChangeCommit, $comparison);
	}

	/**
	 * Filter the query on the last_change_commit_desc column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByLastChangeCommitDesc('fooValue');   // WHERE last_change_commit_desc = 'fooValue'
	 * $query->filterByLastChangeCommitDesc('%fooValue%'); // WHERE last_change_commit_desc LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $lastChangeCommitDesc The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    FileQuery The current query, for fluid interface
	 */
	public function filterByLastChangeCommitDesc($lastChangeCommitDesc = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($lastChangeCommitDesc)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $lastChangeCommitDesc)) {
				$lastChangeCommitDesc = str_replace('*', '%', $lastChangeCommitDesc);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(FilePeer::LAST_CHANGE_COMMIT_DESC, $lastChangeCommitDesc, $comparison);
	}

	/**
	 * Filter the query on the last_change_commit_user column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByLastChangeCommitUser(1234); // WHERE last_change_commit_user = 1234
	 * $query->filterByLastChangeCommitUser(array(12, 34)); // WHERE last_change_commit_user IN (12, 34)
	 * $query->filterByLastChangeCommitUser(array('min' => 12)); // WHERE last_change_commit_user > 12
	 * </code>
	 *
	 * @see       filterBysfGuardUser()
	 *
	 * @param     mixed $lastChangeCommitUser The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    FileQuery The current query, for fluid interface
	 */
	public function filterByLastChangeCommitUser($lastChangeCommitUser = null, $comparison = null)
	{
		if (is_array($lastChangeCommitUser)) {
			$useMinMax = false;
			if (isset($lastChangeCommitUser['min'])) {
				$this->addUsingAlias(FilePeer::LAST_CHANGE_COMMIT_USER, $lastChangeCommitUser['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($lastChangeCommitUser['max'])) {
				$this->addUsingAlias(FilePeer::LAST_CHANGE_COMMIT_USER, $lastChangeCommitUser['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(FilePeer::LAST_CHANGE_COMMIT_USER, $lastChangeCommitUser, $comparison);
	}

	/**
	 * Filter the query on the status column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByStatus(1234); // WHERE status = 1234
	 * $query->filterByStatus(array(12, 34)); // WHERE status IN (12, 34)
	 * $query->filterByStatus(array('min' => 12)); // WHERE status > 12
	 * </code>
	 *
	 * @param     mixed $status The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    FileQuery The current query, for fluid interface
	 */
	public function filterByStatus($status = null, $comparison = null)
	{
		if (is_array($status)) {
			$useMinMax = false;
			if (isset($status['min'])) {
				$this->addUsingAlias(FilePeer::STATUS, $status['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($status['max'])) {
				$this->addUsingAlias(FilePeer::STATUS, $status['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(FilePeer::STATUS, $status, $comparison);
	}

	/**
	 * Filter the query on the commit_status_changed column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByCommitStatusChanged('fooValue');   // WHERE commit_status_changed = 'fooValue'
	 * $query->filterByCommitStatusChanged('%fooValue%'); // WHERE commit_status_changed LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $commitStatusChanged The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
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
	 * Example usage:
	 * <code>
	 * $query->filterByUserStatusChanged(1234); // WHERE user_status_changed = 1234
	 * $query->filterByUserStatusChanged(array(12, 34)); // WHERE user_status_changed IN (12, 34)
	 * $query->filterByUserStatusChanged(array('min' => 12)); // WHERE user_status_changed > 12
	 * </code>
	 *
	 * @param     mixed $userStatusChanged The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
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
	 * Example usage:
	 * <code>
	 * $query->filterByDateStatusChanged('2011-03-14'); // WHERE date_status_changed = '2011-03-14'
	 * $query->filterByDateStatusChanged('now'); // WHERE date_status_changed = '2011-03-14'
	 * $query->filterByDateStatusChanged(array('max' => 'yesterday')); // WHERE date_status_changed > '2011-03-13'
	 * </code>
	 *
	 * @param     mixed $dateStatusChanged The value to use as filter.
	 *              Values can be integers (unix timestamps), DateTime objects, or strings.
	 *              Empty strings are treated as NULL.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
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
	 * @param     Branch|PropelCollection $branch The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    FileQuery The current query, for fluid interface
	 */
	public function filterByBranch($branch, $comparison = null)
	{
		if ($branch instanceof Branch) {
			return $this
				->addUsingAlias(FilePeer::BRANCH_ID, $branch->getId(), $comparison);
		} elseif ($branch instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(FilePeer::BRANCH_ID, $branch->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
	 * Filter the query by a related sfGuardUser object
	 *
	 * @param     sfGuardUser|PropelCollection $sfGuardUser The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    FileQuery The current query, for fluid interface
	 */
	public function filterBysfGuardUser($sfGuardUser, $comparison = null)
	{
		if ($sfGuardUser instanceof sfGuardUser) {
			return $this
				->addUsingAlias(FilePeer::LAST_CHANGE_COMMIT_USER, $sfGuardUser->getId(), $comparison);
		} elseif ($sfGuardUser instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(FilePeer::LAST_CHANGE_COMMIT_USER, $sfGuardUser->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
	 * @return    FileQuery The current query, for fluid interface
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
	 * Filter the query by a related Comment object
	 *
	 * @param     Comment $comment  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    FileQuery The current query, for fluid interface
	 */
	public function filterByComment($comment, $comparison = null)
	{
		if ($comment instanceof Comment) {
			return $this
				->addUsingAlias(FilePeer::ID, $comment->getFileId(), $comparison);
		} elseif ($comment instanceof PropelCollection) {
			return $this
				->useCommentQuery()
				->filterByPrimaryKeys($comment->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByComment() only accepts arguments of type Comment or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Comment relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    FileQuery The current query, for fluid interface
	 */
	public function joinComment($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Comment');

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
			$this->addJoinObject($join, 'Comment');
		}

		return $this;
	}

	/**
	 * Use the Comment relation Comment object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    CommentQuery A secondary query class using the current class as primary query
	 */
	public function useCommentQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinComment($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Comment', 'CommentQuery');
	}

	/**
	 * Filter the query by a related StatusAction object
	 *
	 * @param     StatusAction $statusAction  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    FileQuery The current query, for fluid interface
	 */
	public function filterByStatusAction($statusAction, $comparison = null)
	{
		if ($statusAction instanceof StatusAction) {
			return $this
				->addUsingAlias(FilePeer::ID, $statusAction->getFileId(), $comparison);
		} elseif ($statusAction instanceof PropelCollection) {
			return $this
				->useStatusActionQuery()
				->filterByPrimaryKeys($statusAction->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByStatusAction() only accepts arguments of type StatusAction or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the StatusAction relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    FileQuery The current query, for fluid interface
	 */
	public function joinStatusAction($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('StatusAction');

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
			$this->addJoinObject($join, 'StatusAction');
		}

		return $this;
	}

	/**
	 * Use the StatusAction relation StatusAction object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    StatusActionQuery A secondary query class using the current class as primary query
	 */
	public function useStatusActionQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinStatusAction($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'StatusAction', 'StatusActionQuery');
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