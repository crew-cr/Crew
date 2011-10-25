<?php


/**
 * Base class that represents a query for the 'sf_guard_remember_key' table.
 *
 * 
 *
 * @method     sfGuardRememberKeyQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     sfGuardRememberKeyQuery orderByRememberKey($order = Criteria::ASC) Order by the remember_key column
 * @method     sfGuardRememberKeyQuery orderByIpAddress($order = Criteria::ASC) Order by the ip_address column
 * @method     sfGuardRememberKeyQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 *
 * @method     sfGuardRememberKeyQuery groupByUserId() Group by the user_id column
 * @method     sfGuardRememberKeyQuery groupByRememberKey() Group by the remember_key column
 * @method     sfGuardRememberKeyQuery groupByIpAddress() Group by the ip_address column
 * @method     sfGuardRememberKeyQuery groupByCreatedAt() Group by the created_at column
 *
 * @method     sfGuardRememberKeyQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     sfGuardRememberKeyQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     sfGuardRememberKeyQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     sfGuardRememberKeyQuery leftJoinsfGuardUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the sfGuardUser relation
 * @method     sfGuardRememberKeyQuery rightJoinsfGuardUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the sfGuardUser relation
 * @method     sfGuardRememberKeyQuery innerJoinsfGuardUser($relationAlias = null) Adds a INNER JOIN clause to the query using the sfGuardUser relation
 *
 * @method     sfGuardRememberKey findOne(PropelPDO $con = null) Return the first sfGuardRememberKey matching the query
 * @method     sfGuardRememberKey findOneOrCreate(PropelPDO $con = null) Return the first sfGuardRememberKey matching the query, or a new sfGuardRememberKey object populated from the query conditions when no match is found
 *
 * @method     sfGuardRememberKey findOneByUserId(int $user_id) Return the first sfGuardRememberKey filtered by the user_id column
 * @method     sfGuardRememberKey findOneByRememberKey(string $remember_key) Return the first sfGuardRememberKey filtered by the remember_key column
 * @method     sfGuardRememberKey findOneByIpAddress(string $ip_address) Return the first sfGuardRememberKey filtered by the ip_address column
 * @method     sfGuardRememberKey findOneByCreatedAt(string $created_at) Return the first sfGuardRememberKey filtered by the created_at column
 *
 * @method     array findByUserId(int $user_id) Return sfGuardRememberKey objects filtered by the user_id column
 * @method     array findByRememberKey(string $remember_key) Return sfGuardRememberKey objects filtered by the remember_key column
 * @method     array findByIpAddress(string $ip_address) Return sfGuardRememberKey objects filtered by the ip_address column
 * @method     array findByCreatedAt(string $created_at) Return sfGuardRememberKey objects filtered by the created_at column
 *
 * @package    propel.generator.plugins.sfGuardPlugin.lib.model.om
 */
abstract class BasesfGuardRememberKeyQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BasesfGuardRememberKeyQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'propel', $modelName = 'sfGuardRememberKey', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new sfGuardRememberKeyQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    sfGuardRememberKeyQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof sfGuardRememberKeyQuery) {
			return $criteria;
		}
		$query = new sfGuardRememberKeyQuery();
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
	 * <code>
	 * $obj = $c->findPk(array(12, 34), $con);
	 * </code>
	 * @param     array[$user_id, $ip_address] $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    sfGuardRememberKey|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = sfGuardRememberKeyPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
	 * @return    sfGuardRememberKeyQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		$this->addUsingAlias(sfGuardRememberKeyPeer::USER_ID, $key[0], Criteria::EQUAL);
		$this->addUsingAlias(sfGuardRememberKeyPeer::IP_ADDRESS, $key[1], Criteria::EQUAL);
		
		return $this;
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    sfGuardRememberKeyQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		if (empty($keys)) {
			return $this->add(null, '1<>1', Criteria::CUSTOM);
		}
		foreach ($keys as $key) {
			$cton0 = $this->getNewCriterion(sfGuardRememberKeyPeer::USER_ID, $key[0], Criteria::EQUAL);
			$cton1 = $this->getNewCriterion(sfGuardRememberKeyPeer::IP_ADDRESS, $key[1], Criteria::EQUAL);
			$cton0->addAnd($cton1);
			$this->addOr($cton0);
		}
		
		return $this;
	}

	/**
	 * Filter the query on the user_id column
	 * 
	 * @param     int|array $userId The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    sfGuardRememberKeyQuery The current query, for fluid interface
	 */
	public function filterByUserId($userId = null, $comparison = null)
	{
		if (is_array($userId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(sfGuardRememberKeyPeer::USER_ID, $userId, $comparison);
	}

	/**
	 * Filter the query on the remember_key column
	 * 
	 * @param     string $rememberKey The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    sfGuardRememberKeyQuery The current query, for fluid interface
	 */
	public function filterByRememberKey($rememberKey = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($rememberKey)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $rememberKey)) {
				$rememberKey = str_replace('*', '%', $rememberKey);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(sfGuardRememberKeyPeer::REMEMBER_KEY, $rememberKey, $comparison);
	}

	/**
	 * Filter the query on the ip_address column
	 * 
	 * @param     string $ipAddress The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    sfGuardRememberKeyQuery The current query, for fluid interface
	 */
	public function filterByIpAddress($ipAddress = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($ipAddress)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $ipAddress)) {
				$ipAddress = str_replace('*', '%', $ipAddress);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(sfGuardRememberKeyPeer::IP_ADDRESS, $ipAddress, $comparison);
	}

	/**
	 * Filter the query on the created_at column
	 * 
	 * @param     string|array $createdAt The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    sfGuardRememberKeyQuery The current query, for fluid interface
	 */
	public function filterByCreatedAt($createdAt = null, $comparison = null)
	{
		if (is_array($createdAt)) {
			$useMinMax = false;
			if (isset($createdAt['min'])) {
				$this->addUsingAlias(sfGuardRememberKeyPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($createdAt['max'])) {
				$this->addUsingAlias(sfGuardRememberKeyPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(sfGuardRememberKeyPeer::CREATED_AT, $createdAt, $comparison);
	}

	/**
	 * Filter the query by a related sfGuardUser object
	 *
	 * @param     sfGuardUser $sfGuardUser  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    sfGuardRememberKeyQuery The current query, for fluid interface
	 */
	public function filterBysfGuardUser($sfGuardUser, $comparison = null)
	{
		return $this
			->addUsingAlias(sfGuardRememberKeyPeer::USER_ID, $sfGuardUser->getId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the sfGuardUser relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    sfGuardRememberKeyQuery The current query, for fluid interface
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
	 * @param     sfGuardRememberKey $sfGuardRememberKey Object to remove from the list of results
	 *
	 * @return    sfGuardRememberKeyQuery The current query, for fluid interface
	 */
	public function prune($sfGuardRememberKey = null)
	{
		if ($sfGuardRememberKey) {
			$this->addCond('pruneCond0', $this->getAliasedColName(sfGuardRememberKeyPeer::USER_ID), $sfGuardRememberKey->getUserId(), Criteria::NOT_EQUAL);
			$this->addCond('pruneCond1', $this->getAliasedColName(sfGuardRememberKeyPeer::IP_ADDRESS), $sfGuardRememberKey->getIpAddress(), Criteria::NOT_EQUAL);
			$this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
	  }
	  
		return $this;
	}

} // BasesfGuardRememberKeyQuery
