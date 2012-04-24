<?php


/**
 * Base class that represents a query for the 'log_git' table.
 *
 * 
 *
 * @method     LogGitQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     LogGitQuery orderByCommand($order = Criteria::ASC) Order by the command column
 * @method     LogGitQuery orderByCode($order = Criteria::ASC) Order by the code column
 * @method     LogGitQuery orderByMessage($order = Criteria::ASC) Order by the message column
 * @method     LogGitQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 *
 * @method     LogGitQuery groupById() Group by the id column
 * @method     LogGitQuery groupByCommand() Group by the command column
 * @method     LogGitQuery groupByCode() Group by the code column
 * @method     LogGitQuery groupByMessage() Group by the message column
 * @method     LogGitQuery groupByCreatedAt() Group by the created_at column
 *
 * @method     LogGitQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     LogGitQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     LogGitQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     LogGit findOne(PropelPDO $con = null) Return the first LogGit matching the query
 * @method     LogGit findOneOrCreate(PropelPDO $con = null) Return the first LogGit matching the query, or a new LogGit object populated from the query conditions when no match is found
 *
 * @method     LogGit findOneById(int $id) Return the first LogGit filtered by the id column
 * @method     LogGit findOneByCommand(string $command) Return the first LogGit filtered by the command column
 * @method     LogGit findOneByCode(int $code) Return the first LogGit filtered by the code column
 * @method     LogGit findOneByMessage(string $message) Return the first LogGit filtered by the message column
 * @method     LogGit findOneByCreatedAt(string $created_at) Return the first LogGit filtered by the created_at column
 *
 * @method     array findById(int $id) Return LogGit objects filtered by the id column
 * @method     array findByCommand(string $command) Return LogGit objects filtered by the command column
 * @method     array findByCode(int $code) Return LogGit objects filtered by the code column
 * @method     array findByMessage(string $message) Return LogGit objects filtered by the message column
 * @method     array findByCreatedAt(string $created_at) Return LogGit objects filtered by the created_at column
 *
 * @package    propel.generator.lib.model.om
 */
abstract class BaseLogGitQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseLogGitQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'propel', $modelName = 'LogGit', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new LogGitQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    LogGitQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof LogGitQuery) {
			return $criteria;
		}
		$query = new LogGitQuery();
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
	 * @return    LogGit|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = LogGitPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(LogGitPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    LogGit A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `COMMAND`, `CODE`, `MESSAGE`, `CREATED_AT` FROM `log_git` WHERE `ID` = :p0';
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
			$obj = new LogGit();
			$obj->hydrate($row);
			LogGitPeer::addInstanceToPool($obj, (string) $row[0]);
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
	 * @return    LogGit|array|mixed the result, formatted by the current formatter
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
	 * @return    LogGitQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(LogGitPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    LogGitQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(LogGitPeer::ID, $keys, Criteria::IN);
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
	 * @return    LogGitQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(LogGitPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the command column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByCommand('fooValue');   // WHERE command = 'fooValue'
	 * $query->filterByCommand('%fooValue%'); // WHERE command LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $command The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    LogGitQuery The current query, for fluid interface
	 */
	public function filterByCommand($command = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($command)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $command)) {
				$command = str_replace('*', '%', $command);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(LogGitPeer::COMMAND, $command, $comparison);
	}

	/**
	 * Filter the query on the code column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByCode(1234); // WHERE code = 1234
	 * $query->filterByCode(array(12, 34)); // WHERE code IN (12, 34)
	 * $query->filterByCode(array('min' => 12)); // WHERE code > 12
	 * </code>
	 *
	 * @param     mixed $code The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    LogGitQuery The current query, for fluid interface
	 */
	public function filterByCode($code = null, $comparison = null)
	{
		if (is_array($code)) {
			$useMinMax = false;
			if (isset($code['min'])) {
				$this->addUsingAlias(LogGitPeer::CODE, $code['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($code['max'])) {
				$this->addUsingAlias(LogGitPeer::CODE, $code['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(LogGitPeer::CODE, $code, $comparison);
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
	 * @return    LogGitQuery The current query, for fluid interface
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
		return $this->addUsingAlias(LogGitPeer::MESSAGE, $message, $comparison);
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
	 * @return    LogGitQuery The current query, for fluid interface
	 */
	public function filterByCreatedAt($createdAt = null, $comparison = null)
	{
		if (is_array($createdAt)) {
			$useMinMax = false;
			if (isset($createdAt['min'])) {
				$this->addUsingAlias(LogGitPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($createdAt['max'])) {
				$this->addUsingAlias(LogGitPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(LogGitPeer::CREATED_AT, $createdAt, $comparison);
	}

	/**
	 * Exclude object from result
	 *
	 * @param     LogGit $logGit Object to remove from the list of results
	 *
	 * @return    LogGitQuery The current query, for fluid interface
	 */
	public function prune($logGit = null)
	{
		if ($logGit) {
			$this->addUsingAlias(LogGitPeer::ID, $logGit->getId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseLogGitQuery