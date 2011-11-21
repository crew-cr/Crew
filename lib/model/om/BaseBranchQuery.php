<?php


/**
 * Base class that represents a query for the 'branch' table.
 *
 * 
 *
 * @method     BranchQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     BranchQuery orderByRepositoryId($order = Criteria::ASC) Order by the repository_id column
 * @method     BranchQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     BranchQuery orderByBaseBranchName($order = Criteria::ASC) Order by the base_branch_name column
 * @method     BranchQuery orderByCommitReference($order = Criteria::ASC) Order by the commit_reference column
 * @method     BranchQuery orderByLastCommit($order = Criteria::ASC) Order by the last_commit column
 * @method     BranchQuery orderByLastCommitDesc($order = Criteria::ASC) Order by the last_commit_desc column
 * @method     BranchQuery orderByIsBlacklisted($order = Criteria::ASC) Order by the is_blacklisted column
 * @method     BranchQuery orderByReviewRequest($order = Criteria::ASC) Order by the review_request column
 * @method     BranchQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     BranchQuery orderByCommitStatusChanged($order = Criteria::ASC) Order by the commit_status_changed column
 * @method     BranchQuery orderByUserStatusChanged($order = Criteria::ASC) Order by the user_status_changed column
 * @method     BranchQuery orderByDateStatusChanged($order = Criteria::ASC) Order by the date_status_changed column
 *
 * @method     BranchQuery groupById() Group by the id column
 * @method     BranchQuery groupByRepositoryId() Group by the repository_id column
 * @method     BranchQuery groupByName() Group by the name column
 * @method     BranchQuery groupByBaseBranchName() Group by the base_branch_name column
 * @method     BranchQuery groupByCommitReference() Group by the commit_reference column
 * @method     BranchQuery groupByLastCommit() Group by the last_commit column
 * @method     BranchQuery groupByLastCommitDesc() Group by the last_commit_desc column
 * @method     BranchQuery groupByIsBlacklisted() Group by the is_blacklisted column
 * @method     BranchQuery groupByReviewRequest() Group by the review_request column
 * @method     BranchQuery groupByStatus() Group by the status column
 * @method     BranchQuery groupByCommitStatusChanged() Group by the commit_status_changed column
 * @method     BranchQuery groupByUserStatusChanged() Group by the user_status_changed column
 * @method     BranchQuery groupByDateStatusChanged() Group by the date_status_changed column
 *
 * @method     BranchQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     BranchQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     BranchQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     BranchQuery leftJoinRepository($relationAlias = null) Adds a LEFT JOIN clause to the query using the Repository relation
 * @method     BranchQuery rightJoinRepository($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Repository relation
 * @method     BranchQuery innerJoinRepository($relationAlias = null) Adds a INNER JOIN clause to the query using the Repository relation
 *
 * @method     BranchQuery leftJoinsfGuardUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the sfGuardUser relation
 * @method     BranchQuery rightJoinsfGuardUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the sfGuardUser relation
 * @method     BranchQuery innerJoinsfGuardUser($relationAlias = null) Adds a INNER JOIN clause to the query using the sfGuardUser relation
 *
 * @method     BranchQuery leftJoinComment($relationAlias = null) Adds a LEFT JOIN clause to the query using the Comment relation
 * @method     BranchQuery rightJoinComment($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Comment relation
 * @method     BranchQuery innerJoinComment($relationAlias = null) Adds a INNER JOIN clause to the query using the Comment relation
 *
 * @method     BranchQuery leftJoinFile($relationAlias = null) Adds a LEFT JOIN clause to the query using the File relation
 * @method     BranchQuery rightJoinFile($relationAlias = null) Adds a RIGHT JOIN clause to the query using the File relation
 * @method     BranchQuery innerJoinFile($relationAlias = null) Adds a INNER JOIN clause to the query using the File relation
 *
 * @method     BranchQuery leftJoinStatusAction($relationAlias = null) Adds a LEFT JOIN clause to the query using the StatusAction relation
 * @method     BranchQuery rightJoinStatusAction($relationAlias = null) Adds a RIGHT JOIN clause to the query using the StatusAction relation
 * @method     BranchQuery innerJoinStatusAction($relationAlias = null) Adds a INNER JOIN clause to the query using the StatusAction relation
 *
 * @method     Branch findOne(PropelPDO $con = null) Return the first Branch matching the query
 * @method     Branch findOneOrCreate(PropelPDO $con = null) Return the first Branch matching the query, or a new Branch object populated from the query conditions when no match is found
 *
 * @method     Branch findOneById(int $id) Return the first Branch filtered by the id column
 * @method     Branch findOneByRepositoryId(int $repository_id) Return the first Branch filtered by the repository_id column
 * @method     Branch findOneByName(string $name) Return the first Branch filtered by the name column
 * @method     Branch findOneByBaseBranchName(string $base_branch_name) Return the first Branch filtered by the base_branch_name column
 * @method     Branch findOneByCommitReference(string $commit_reference) Return the first Branch filtered by the commit_reference column
 * @method     Branch findOneByLastCommit(string $last_commit) Return the first Branch filtered by the last_commit column
 * @method     Branch findOneByLastCommitDesc(string $last_commit_desc) Return the first Branch filtered by the last_commit_desc column
 * @method     Branch findOneByIsBlacklisted(int $is_blacklisted) Return the first Branch filtered by the is_blacklisted column
 * @method     Branch findOneByReviewRequest(int $review_request) Return the first Branch filtered by the review_request column
 * @method     Branch findOneByStatus(int $status) Return the first Branch filtered by the status column
 * @method     Branch findOneByCommitStatusChanged(string $commit_status_changed) Return the first Branch filtered by the commit_status_changed column
 * @method     Branch findOneByUserStatusChanged(int $user_status_changed) Return the first Branch filtered by the user_status_changed column
 * @method     Branch findOneByDateStatusChanged(string $date_status_changed) Return the first Branch filtered by the date_status_changed column
 *
 * @method     array findById(int $id) Return Branch objects filtered by the id column
 * @method     array findByRepositoryId(int $repository_id) Return Branch objects filtered by the repository_id column
 * @method     array findByName(string $name) Return Branch objects filtered by the name column
 * @method     array findByBaseBranchName(string $base_branch_name) Return Branch objects filtered by the base_branch_name column
 * @method     array findByCommitReference(string $commit_reference) Return Branch objects filtered by the commit_reference column
 * @method     array findByLastCommit(string $last_commit) Return Branch objects filtered by the last_commit column
 * @method     array findByLastCommitDesc(string $last_commit_desc) Return Branch objects filtered by the last_commit_desc column
 * @method     array findByIsBlacklisted(int $is_blacklisted) Return Branch objects filtered by the is_blacklisted column
 * @method     array findByReviewRequest(int $review_request) Return Branch objects filtered by the review_request column
 * @method     array findByStatus(int $status) Return Branch objects filtered by the status column
 * @method     array findByCommitStatusChanged(string $commit_status_changed) Return Branch objects filtered by the commit_status_changed column
 * @method     array findByUserStatusChanged(int $user_status_changed) Return Branch objects filtered by the user_status_changed column
 * @method     array findByDateStatusChanged(string $date_status_changed) Return Branch objects filtered by the date_status_changed column
 *
 * @package    propel.generator.lib.model.om
 */
abstract class BaseBranchQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseBranchQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'propel', $modelName = 'Branch', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new BranchQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    BranchQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof BranchQuery) {
			return $criteria;
		}
		$query = new BranchQuery();
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
	 * @return    Branch|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = BranchPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(BranchPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    Branch A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `REPOSITORY_ID`, `NAME`, `BASE_BRANCH_NAME`, `COMMIT_REFERENCE`, `LAST_COMMIT`, `LAST_COMMIT_DESC`, `IS_BLACKLISTED`, `REVIEW_REQUEST`, `STATUS`, `COMMIT_STATUS_CHANGED`, `USER_STATUS_CHANGED`, `DATE_STATUS_CHANGED` FROM `branch` WHERE `ID` = :p0';
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
			$obj = new Branch();
			$obj->hydrate($row);
			BranchPeer::addInstanceToPool($obj, (string) $row[0]);
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
	 * @return    Branch|array|mixed the result, formatted by the current formatter
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
	 * @return    BranchQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(BranchPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    BranchQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(BranchPeer::ID, $keys, Criteria::IN);
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
	 * @return    BranchQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(BranchPeer::ID, $id, $comparison);
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
	 * @return    BranchQuery The current query, for fluid interface
	 */
	public function filterByRepositoryId($repositoryId = null, $comparison = null)
	{
		if (is_array($repositoryId)) {
			$useMinMax = false;
			if (isset($repositoryId['min'])) {
				$this->addUsingAlias(BranchPeer::REPOSITORY_ID, $repositoryId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($repositoryId['max'])) {
				$this->addUsingAlias(BranchPeer::REPOSITORY_ID, $repositoryId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(BranchPeer::REPOSITORY_ID, $repositoryId, $comparison);
	}

	/**
	 * Filter the query on the name column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
	 * $query->filterByName('%fooValue%'); // WHERE name LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $name The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    BranchQuery The current query, for fluid interface
	 */
	public function filterByName($name = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($name)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $name)) {
				$name = str_replace('*', '%', $name);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(BranchPeer::NAME, $name, $comparison);
	}

	/**
	 * Filter the query on the base_branch_name column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByBaseBranchName('fooValue');   // WHERE base_branch_name = 'fooValue'
	 * $query->filterByBaseBranchName('%fooValue%'); // WHERE base_branch_name LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $baseBranchName The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    BranchQuery The current query, for fluid interface
	 */
	public function filterByBaseBranchName($baseBranchName = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($baseBranchName)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $baseBranchName)) {
				$baseBranchName = str_replace('*', '%', $baseBranchName);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(BranchPeer::BASE_BRANCH_NAME, $baseBranchName, $comparison);
	}

	/**
	 * Filter the query on the commit_reference column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByCommitReference('fooValue');   // WHERE commit_reference = 'fooValue'
	 * $query->filterByCommitReference('%fooValue%'); // WHERE commit_reference LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $commitReference The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    BranchQuery The current query, for fluid interface
	 */
	public function filterByCommitReference($commitReference = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($commitReference)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $commitReference)) {
				$commitReference = str_replace('*', '%', $commitReference);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(BranchPeer::COMMIT_REFERENCE, $commitReference, $comparison);
	}

	/**
	 * Filter the query on the last_commit column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByLastCommit('fooValue');   // WHERE last_commit = 'fooValue'
	 * $query->filterByLastCommit('%fooValue%'); // WHERE last_commit LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $lastCommit The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    BranchQuery The current query, for fluid interface
	 */
	public function filterByLastCommit($lastCommit = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($lastCommit)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $lastCommit)) {
				$lastCommit = str_replace('*', '%', $lastCommit);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(BranchPeer::LAST_COMMIT, $lastCommit, $comparison);
	}

	/**
	 * Filter the query on the last_commit_desc column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByLastCommitDesc('fooValue');   // WHERE last_commit_desc = 'fooValue'
	 * $query->filterByLastCommitDesc('%fooValue%'); // WHERE last_commit_desc LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $lastCommitDesc The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    BranchQuery The current query, for fluid interface
	 */
	public function filterByLastCommitDesc($lastCommitDesc = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($lastCommitDesc)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $lastCommitDesc)) {
				$lastCommitDesc = str_replace('*', '%', $lastCommitDesc);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(BranchPeer::LAST_COMMIT_DESC, $lastCommitDesc, $comparison);
	}

	/**
	 * Filter the query on the is_blacklisted column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByIsBlacklisted(1234); // WHERE is_blacklisted = 1234
	 * $query->filterByIsBlacklisted(array(12, 34)); // WHERE is_blacklisted IN (12, 34)
	 * $query->filterByIsBlacklisted(array('min' => 12)); // WHERE is_blacklisted > 12
	 * </code>
	 *
	 * @param     mixed $isBlacklisted The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    BranchQuery The current query, for fluid interface
	 */
	public function filterByIsBlacklisted($isBlacklisted = null, $comparison = null)
	{
		if (is_array($isBlacklisted)) {
			$useMinMax = false;
			if (isset($isBlacklisted['min'])) {
				$this->addUsingAlias(BranchPeer::IS_BLACKLISTED, $isBlacklisted['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($isBlacklisted['max'])) {
				$this->addUsingAlias(BranchPeer::IS_BLACKLISTED, $isBlacklisted['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(BranchPeer::IS_BLACKLISTED, $isBlacklisted, $comparison);
	}

	/**
	 * Filter the query on the review_request column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByReviewRequest(1234); // WHERE review_request = 1234
	 * $query->filterByReviewRequest(array(12, 34)); // WHERE review_request IN (12, 34)
	 * $query->filterByReviewRequest(array('min' => 12)); // WHERE review_request > 12
	 * </code>
	 *
	 * @param     mixed $reviewRequest The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    BranchQuery The current query, for fluid interface
	 */
	public function filterByReviewRequest($reviewRequest = null, $comparison = null)
	{
		if (is_array($reviewRequest)) {
			$useMinMax = false;
			if (isset($reviewRequest['min'])) {
				$this->addUsingAlias(BranchPeer::REVIEW_REQUEST, $reviewRequest['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($reviewRequest['max'])) {
				$this->addUsingAlias(BranchPeer::REVIEW_REQUEST, $reviewRequest['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(BranchPeer::REVIEW_REQUEST, $reviewRequest, $comparison);
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
	 * @return    BranchQuery The current query, for fluid interface
	 */
	public function filterByStatus($status = null, $comparison = null)
	{
		if (is_array($status)) {
			$useMinMax = false;
			if (isset($status['min'])) {
				$this->addUsingAlias(BranchPeer::STATUS, $status['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($status['max'])) {
				$this->addUsingAlias(BranchPeer::STATUS, $status['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(BranchPeer::STATUS, $status, $comparison);
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
	 * @return    BranchQuery The current query, for fluid interface
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
		return $this->addUsingAlias(BranchPeer::COMMIT_STATUS_CHANGED, $commitStatusChanged, $comparison);
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
	 * @see       filterBysfGuardUser()
	 *
	 * @param     mixed $userStatusChanged The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    BranchQuery The current query, for fluid interface
	 */
	public function filterByUserStatusChanged($userStatusChanged = null, $comparison = null)
	{
		if (is_array($userStatusChanged)) {
			$useMinMax = false;
			if (isset($userStatusChanged['min'])) {
				$this->addUsingAlias(BranchPeer::USER_STATUS_CHANGED, $userStatusChanged['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($userStatusChanged['max'])) {
				$this->addUsingAlias(BranchPeer::USER_STATUS_CHANGED, $userStatusChanged['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(BranchPeer::USER_STATUS_CHANGED, $userStatusChanged, $comparison);
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
	 * @return    BranchQuery The current query, for fluid interface
	 */
	public function filterByDateStatusChanged($dateStatusChanged = null, $comparison = null)
	{
		if (is_array($dateStatusChanged)) {
			$useMinMax = false;
			if (isset($dateStatusChanged['min'])) {
				$this->addUsingAlias(BranchPeer::DATE_STATUS_CHANGED, $dateStatusChanged['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($dateStatusChanged['max'])) {
				$this->addUsingAlias(BranchPeer::DATE_STATUS_CHANGED, $dateStatusChanged['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(BranchPeer::DATE_STATUS_CHANGED, $dateStatusChanged, $comparison);
	}

	/**
	 * Filter the query by a related Repository object
	 *
	 * @param     Repository|PropelCollection $repository The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    BranchQuery The current query, for fluid interface
	 */
	public function filterByRepository($repository, $comparison = null)
	{
		if ($repository instanceof Repository) {
			return $this
				->addUsingAlias(BranchPeer::REPOSITORY_ID, $repository->getId(), $comparison);
		} elseif ($repository instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(BranchPeer::REPOSITORY_ID, $repository->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
	 * @return    BranchQuery The current query, for fluid interface
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
	 * Filter the query by a related sfGuardUser object
	 *
	 * @param     sfGuardUser|PropelCollection $sfGuardUser The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    BranchQuery The current query, for fluid interface
	 */
	public function filterBysfGuardUser($sfGuardUser, $comparison = null)
	{
		if ($sfGuardUser instanceof sfGuardUser) {
			return $this
				->addUsingAlias(BranchPeer::USER_STATUS_CHANGED, $sfGuardUser->getId(), $comparison);
		} elseif ($sfGuardUser instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(BranchPeer::USER_STATUS_CHANGED, $sfGuardUser->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
	 * @return    BranchQuery The current query, for fluid interface
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
	 * @return    BranchQuery The current query, for fluid interface
	 */
	public function filterByComment($comment, $comparison = null)
	{
		if ($comment instanceof Comment) {
			return $this
				->addUsingAlias(BranchPeer::ID, $comment->getBranchId(), $comparison);
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
	 * @return    BranchQuery The current query, for fluid interface
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
	 * Filter the query by a related File object
	 *
	 * @param     File $file  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    BranchQuery The current query, for fluid interface
	 */
	public function filterByFile($file, $comparison = null)
	{
		if ($file instanceof File) {
			return $this
				->addUsingAlias(BranchPeer::ID, $file->getBranchId(), $comparison);
		} elseif ($file instanceof PropelCollection) {
			return $this
				->useFileQuery()
				->filterByPrimaryKeys($file->getPrimaryKeys())
				->endUse();
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
	 * @return    BranchQuery The current query, for fluid interface
	 */
	public function joinFile($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
	public function useFileQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinFile($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'File', 'FileQuery');
	}

	/**
	 * Filter the query by a related StatusAction object
	 *
	 * @param     StatusAction $statusAction  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    BranchQuery The current query, for fluid interface
	 */
	public function filterByStatusAction($statusAction, $comparison = null)
	{
		if ($statusAction instanceof StatusAction) {
			return $this
				->addUsingAlias(BranchPeer::ID, $statusAction->getBranchId(), $comparison);
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
	 * @return    BranchQuery The current query, for fluid interface
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
	 * @param     Branch $branch Object to remove from the list of results
	 *
	 * @return    BranchQuery The current query, for fluid interface
	 */
	public function prune($branch = null)
	{
		if ($branch) {
			$this->addUsingAlias(BranchPeer::ID, $branch->getId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseBranchQuery