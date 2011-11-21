<?php


/**
 * Base class that represents a query for the 'profile' table.
 *
 * 
 *
 * @method     ProfileQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ProfileQuery orderByNickname($order = Criteria::ASC) Order by the nickname column
 * @method     ProfileQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ProfileQuery orderBySfGuardUserId($order = Criteria::ASC) Order by the sf_guard_user_id column
 *
 * @method     ProfileQuery groupById() Group by the id column
 * @method     ProfileQuery groupByNickname() Group by the nickname column
 * @method     ProfileQuery groupByEmail() Group by the email column
 * @method     ProfileQuery groupBySfGuardUserId() Group by the sf_guard_user_id column
 *
 * @method     ProfileQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ProfileQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ProfileQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ProfileQuery leftJoinsfGuardUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the sfGuardUser relation
 * @method     ProfileQuery rightJoinsfGuardUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the sfGuardUser relation
 * @method     ProfileQuery innerJoinsfGuardUser($relationAlias = null) Adds a INNER JOIN clause to the query using the sfGuardUser relation
 *
 * @method     Profile findOne(PropelPDO $con = null) Return the first Profile matching the query
 * @method     Profile findOneOrCreate(PropelPDO $con = null) Return the first Profile matching the query, or a new Profile object populated from the query conditions when no match is found
 *
 * @method     Profile findOneById(int $id) Return the first Profile filtered by the id column
 * @method     Profile findOneByNickname(string $nickname) Return the first Profile filtered by the nickname column
 * @method     Profile findOneByEmail(string $email) Return the first Profile filtered by the email column
 * @method     Profile findOneBySfGuardUserId(int $sf_guard_user_id) Return the first Profile filtered by the sf_guard_user_id column
 *
 * @method     array findById(int $id) Return Profile objects filtered by the id column
 * @method     array findByNickname(string $nickname) Return Profile objects filtered by the nickname column
 * @method     array findByEmail(string $email) Return Profile objects filtered by the email column
 * @method     array findBySfGuardUserId(int $sf_guard_user_id) Return Profile objects filtered by the sf_guard_user_id column
 *
 * @package    propel.generator.lib.model.om
 */
abstract class BaseProfileQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseProfileQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'propel', $modelName = 'Profile', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new ProfileQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    ProfileQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof ProfileQuery) {
			return $criteria;
		}
		$query = new ProfileQuery();
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
	 * @return    Profile|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = ProfilePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(ProfilePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    Profile A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `NICKNAME`, `EMAIL`, `SF_GUARD_USER_ID` FROM `profile` WHERE `ID` = :p0';
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
			$obj = new Profile();
			$obj->hydrate($row);
			ProfilePeer::addInstanceToPool($obj, (string) $row[0]);
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
	 * @return    Profile|array|mixed the result, formatted by the current formatter
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
	 * @return    ProfileQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(ProfilePeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    ProfileQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(ProfilePeer::ID, $keys, Criteria::IN);
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
	 * @return    ProfileQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(ProfilePeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the nickname column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByNickname('fooValue');   // WHERE nickname = 'fooValue'
	 * $query->filterByNickname('%fooValue%'); // WHERE nickname LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $nickname The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ProfileQuery The current query, for fluid interface
	 */
	public function filterByNickname($nickname = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($nickname)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $nickname)) {
				$nickname = str_replace('*', '%', $nickname);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ProfilePeer::NICKNAME, $nickname, $comparison);
	}

	/**
	 * Filter the query on the email column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
	 * $query->filterByEmail('%fooValue%'); // WHERE email LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $email The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ProfileQuery The current query, for fluid interface
	 */
	public function filterByEmail($email = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($email)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $email)) {
				$email = str_replace('*', '%', $email);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ProfilePeer::EMAIL, $email, $comparison);
	}

	/**
	 * Filter the query on the sf_guard_user_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterBySfGuardUserId(1234); // WHERE sf_guard_user_id = 1234
	 * $query->filterBySfGuardUserId(array(12, 34)); // WHERE sf_guard_user_id IN (12, 34)
	 * $query->filterBySfGuardUserId(array('min' => 12)); // WHERE sf_guard_user_id > 12
	 * </code>
	 *
	 * @see       filterBysfGuardUser()
	 *
	 * @param     mixed $sfGuardUserId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ProfileQuery The current query, for fluid interface
	 */
	public function filterBySfGuardUserId($sfGuardUserId = null, $comparison = null)
	{
		if (is_array($sfGuardUserId)) {
			$useMinMax = false;
			if (isset($sfGuardUserId['min'])) {
				$this->addUsingAlias(ProfilePeer::SF_GUARD_USER_ID, $sfGuardUserId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($sfGuardUserId['max'])) {
				$this->addUsingAlias(ProfilePeer::SF_GUARD_USER_ID, $sfGuardUserId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(ProfilePeer::SF_GUARD_USER_ID, $sfGuardUserId, $comparison);
	}

	/**
	 * Filter the query by a related sfGuardUser object
	 *
	 * @param     sfGuardUser|PropelCollection $sfGuardUser The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ProfileQuery The current query, for fluid interface
	 */
	public function filterBysfGuardUser($sfGuardUser, $comparison = null)
	{
		if ($sfGuardUser instanceof sfGuardUser) {
			return $this
				->addUsingAlias(ProfilePeer::SF_GUARD_USER_ID, $sfGuardUser->getId(), $comparison);
		} elseif ($sfGuardUser instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(ProfilePeer::SF_GUARD_USER_ID, $sfGuardUser->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
	 * @return    ProfileQuery The current query, for fluid interface
	 */
	public function joinsfGuardUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
	public function usesfGuardUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinsfGuardUser($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'sfGuardUser', 'sfGuardUserQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Profile $profile Object to remove from the list of results
	 *
	 * @return    ProfileQuery The current query, for fluid interface
	 */
	public function prune($profile = null)
	{
		if ($profile) {
			$this->addUsingAlias(ProfilePeer::ID, $profile->getId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseProfileQuery