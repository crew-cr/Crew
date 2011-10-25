<?php


/**
 * Base class that represents a query for the 'sf_guard_user_permission' table.
 *
 * 
 *
 * @method     sfGuardUserPermissionQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     sfGuardUserPermissionQuery orderByPermissionId($order = Criteria::ASC) Order by the permission_id column
 *
 * @method     sfGuardUserPermissionQuery groupByUserId() Group by the user_id column
 * @method     sfGuardUserPermissionQuery groupByPermissionId() Group by the permission_id column
 *
 * @method     sfGuardUserPermissionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     sfGuardUserPermissionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     sfGuardUserPermissionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     sfGuardUserPermissionQuery leftJoinsfGuardUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the sfGuardUser relation
 * @method     sfGuardUserPermissionQuery rightJoinsfGuardUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the sfGuardUser relation
 * @method     sfGuardUserPermissionQuery innerJoinsfGuardUser($relationAlias = null) Adds a INNER JOIN clause to the query using the sfGuardUser relation
 *
 * @method     sfGuardUserPermissionQuery leftJoinsfGuardPermission($relationAlias = null) Adds a LEFT JOIN clause to the query using the sfGuardPermission relation
 * @method     sfGuardUserPermissionQuery rightJoinsfGuardPermission($relationAlias = null) Adds a RIGHT JOIN clause to the query using the sfGuardPermission relation
 * @method     sfGuardUserPermissionQuery innerJoinsfGuardPermission($relationAlias = null) Adds a INNER JOIN clause to the query using the sfGuardPermission relation
 *
 * @method     sfGuardUserPermission findOne(PropelPDO $con = null) Return the first sfGuardUserPermission matching the query
 * @method     sfGuardUserPermission findOneOrCreate(PropelPDO $con = null) Return the first sfGuardUserPermission matching the query, or a new sfGuardUserPermission object populated from the query conditions when no match is found
 *
 * @method     sfGuardUserPermission findOneByUserId(int $user_id) Return the first sfGuardUserPermission filtered by the user_id column
 * @method     sfGuardUserPermission findOneByPermissionId(int $permission_id) Return the first sfGuardUserPermission filtered by the permission_id column
 *
 * @method     array findByUserId(int $user_id) Return sfGuardUserPermission objects filtered by the user_id column
 * @method     array findByPermissionId(int $permission_id) Return sfGuardUserPermission objects filtered by the permission_id column
 *
 * @package    propel.generator.plugins.sfGuardPlugin.lib.model.om
 */
abstract class BasesfGuardUserPermissionQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BasesfGuardUserPermissionQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'propel', $modelName = 'sfGuardUserPermission', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new sfGuardUserPermissionQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    sfGuardUserPermissionQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof sfGuardUserPermissionQuery) {
			return $criteria;
		}
		$query = new sfGuardUserPermissionQuery();
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
	 * @param     array[$user_id, $permission_id] $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    sfGuardUserPermission|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = sfGuardUserPermissionPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    sfGuardUserPermissionQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		$this->addUsingAlias(sfGuardUserPermissionPeer::USER_ID, $key[0], Criteria::EQUAL);
		$this->addUsingAlias(sfGuardUserPermissionPeer::PERMISSION_ID, $key[1], Criteria::EQUAL);
		
		return $this;
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    sfGuardUserPermissionQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		if (empty($keys)) {
			return $this->add(null, '1<>1', Criteria::CUSTOM);
		}
		foreach ($keys as $key) {
			$cton0 = $this->getNewCriterion(sfGuardUserPermissionPeer::USER_ID, $key[0], Criteria::EQUAL);
			$cton1 = $this->getNewCriterion(sfGuardUserPermissionPeer::PERMISSION_ID, $key[1], Criteria::EQUAL);
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
	 * @return    sfGuardUserPermissionQuery The current query, for fluid interface
	 */
	public function filterByUserId($userId = null, $comparison = null)
	{
		if (is_array($userId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(sfGuardUserPermissionPeer::USER_ID, $userId, $comparison);
	}

	/**
	 * Filter the query on the permission_id column
	 * 
	 * @param     int|array $permissionId The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    sfGuardUserPermissionQuery The current query, for fluid interface
	 */
	public function filterByPermissionId($permissionId = null, $comparison = null)
	{
		if (is_array($permissionId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(sfGuardUserPermissionPeer::PERMISSION_ID, $permissionId, $comparison);
	}

	/**
	 * Filter the query by a related sfGuardUser object
	 *
	 * @param     sfGuardUser $sfGuardUser  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    sfGuardUserPermissionQuery The current query, for fluid interface
	 */
	public function filterBysfGuardUser($sfGuardUser, $comparison = null)
	{
		return $this
			->addUsingAlias(sfGuardUserPermissionPeer::USER_ID, $sfGuardUser->getId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the sfGuardUser relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    sfGuardUserPermissionQuery The current query, for fluid interface
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
	 * Filter the query by a related sfGuardPermission object
	 *
	 * @param     sfGuardPermission $sfGuardPermission  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    sfGuardUserPermissionQuery The current query, for fluid interface
	 */
	public function filterBysfGuardPermission($sfGuardPermission, $comparison = null)
	{
		return $this
			->addUsingAlias(sfGuardUserPermissionPeer::PERMISSION_ID, $sfGuardPermission->getId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the sfGuardPermission relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    sfGuardUserPermissionQuery The current query, for fluid interface
	 */
	public function joinsfGuardPermission($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('sfGuardPermission');
		
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
			$this->addJoinObject($join, 'sfGuardPermission');
		}
		
		return $this;
	}

	/**
	 * Use the sfGuardPermission relation sfGuardPermission object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    sfGuardPermissionQuery A secondary query class using the current class as primary query
	 */
	public function usesfGuardPermissionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinsfGuardPermission($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'sfGuardPermission', 'sfGuardPermissionQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     sfGuardUserPermission $sfGuardUserPermission Object to remove from the list of results
	 *
	 * @return    sfGuardUserPermissionQuery The current query, for fluid interface
	 */
	public function prune($sfGuardUserPermission = null)
	{
		if ($sfGuardUserPermission) {
			$this->addCond('pruneCond0', $this->getAliasedColName(sfGuardUserPermissionPeer::USER_ID), $sfGuardUserPermission->getUserId(), Criteria::NOT_EQUAL);
			$this->addCond('pruneCond1', $this->getAliasedColName(sfGuardUserPermissionPeer::PERMISSION_ID), $sfGuardUserPermission->getPermissionId(), Criteria::NOT_EQUAL);
			$this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
	  }
	  
		return $this;
	}

} // BasesfGuardUserPermissionQuery
