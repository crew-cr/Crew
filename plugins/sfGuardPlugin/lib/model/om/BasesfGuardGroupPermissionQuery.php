<?php


/**
 * Base class that represents a query for the 'sf_guard_group_permission' table.
 *
 * 
 *
 * @method     sfGuardGroupPermissionQuery orderByGroupId($order = Criteria::ASC) Order by the group_id column
 * @method     sfGuardGroupPermissionQuery orderByPermissionId($order = Criteria::ASC) Order by the permission_id column
 *
 * @method     sfGuardGroupPermissionQuery groupByGroupId() Group by the group_id column
 * @method     sfGuardGroupPermissionQuery groupByPermissionId() Group by the permission_id column
 *
 * @method     sfGuardGroupPermissionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     sfGuardGroupPermissionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     sfGuardGroupPermissionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     sfGuardGroupPermissionQuery leftJoinsfGuardGroup($relationAlias = null) Adds a LEFT JOIN clause to the query using the sfGuardGroup relation
 * @method     sfGuardGroupPermissionQuery rightJoinsfGuardGroup($relationAlias = null) Adds a RIGHT JOIN clause to the query using the sfGuardGroup relation
 * @method     sfGuardGroupPermissionQuery innerJoinsfGuardGroup($relationAlias = null) Adds a INNER JOIN clause to the query using the sfGuardGroup relation
 *
 * @method     sfGuardGroupPermissionQuery leftJoinsfGuardPermission($relationAlias = null) Adds a LEFT JOIN clause to the query using the sfGuardPermission relation
 * @method     sfGuardGroupPermissionQuery rightJoinsfGuardPermission($relationAlias = null) Adds a RIGHT JOIN clause to the query using the sfGuardPermission relation
 * @method     sfGuardGroupPermissionQuery innerJoinsfGuardPermission($relationAlias = null) Adds a INNER JOIN clause to the query using the sfGuardPermission relation
 *
 * @method     sfGuardGroupPermission findOne(PropelPDO $con = null) Return the first sfGuardGroupPermission matching the query
 * @method     sfGuardGroupPermission findOneOrCreate(PropelPDO $con = null) Return the first sfGuardGroupPermission matching the query, or a new sfGuardGroupPermission object populated from the query conditions when no match is found
 *
 * @method     sfGuardGroupPermission findOneByGroupId(int $group_id) Return the first sfGuardGroupPermission filtered by the group_id column
 * @method     sfGuardGroupPermission findOneByPermissionId(int $permission_id) Return the first sfGuardGroupPermission filtered by the permission_id column
 *
 * @method     array findByGroupId(int $group_id) Return sfGuardGroupPermission objects filtered by the group_id column
 * @method     array findByPermissionId(int $permission_id) Return sfGuardGroupPermission objects filtered by the permission_id column
 *
 * @package    propel.generator.plugins.sfGuardPlugin.lib.model.om
 */
abstract class BasesfGuardGroupPermissionQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BasesfGuardGroupPermissionQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'propel', $modelName = 'sfGuardGroupPermission', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new sfGuardGroupPermissionQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    sfGuardGroupPermissionQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof sfGuardGroupPermissionQuery) {
			return $criteria;
		}
		$query = new sfGuardGroupPermissionQuery();
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
	 * @param     array[$group_id, $permission_id] $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    sfGuardGroupPermission|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = sfGuardGroupPermissionPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    sfGuardGroupPermissionQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		$this->addUsingAlias(sfGuardGroupPermissionPeer::GROUP_ID, $key[0], Criteria::EQUAL);
		$this->addUsingAlias(sfGuardGroupPermissionPeer::PERMISSION_ID, $key[1], Criteria::EQUAL);
		
		return $this;
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    sfGuardGroupPermissionQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		if (empty($keys)) {
			return $this->add(null, '1<>1', Criteria::CUSTOM);
		}
		foreach ($keys as $key) {
			$cton0 = $this->getNewCriterion(sfGuardGroupPermissionPeer::GROUP_ID, $key[0], Criteria::EQUAL);
			$cton1 = $this->getNewCriterion(sfGuardGroupPermissionPeer::PERMISSION_ID, $key[1], Criteria::EQUAL);
			$cton0->addAnd($cton1);
			$this->addOr($cton0);
		}
		
		return $this;
	}

	/**
	 * Filter the query on the group_id column
	 * 
	 * @param     int|array $groupId The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    sfGuardGroupPermissionQuery The current query, for fluid interface
	 */
	public function filterByGroupId($groupId = null, $comparison = null)
	{
		if (is_array($groupId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(sfGuardGroupPermissionPeer::GROUP_ID, $groupId, $comparison);
	}

	/**
	 * Filter the query on the permission_id column
	 * 
	 * @param     int|array $permissionId The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    sfGuardGroupPermissionQuery The current query, for fluid interface
	 */
	public function filterByPermissionId($permissionId = null, $comparison = null)
	{
		if (is_array($permissionId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(sfGuardGroupPermissionPeer::PERMISSION_ID, $permissionId, $comparison);
	}

	/**
	 * Filter the query by a related sfGuardGroup object
	 *
	 * @param     sfGuardGroup $sfGuardGroup  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    sfGuardGroupPermissionQuery The current query, for fluid interface
	 */
	public function filterBysfGuardGroup($sfGuardGroup, $comparison = null)
	{
		return $this
			->addUsingAlias(sfGuardGroupPermissionPeer::GROUP_ID, $sfGuardGroup->getId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the sfGuardGroup relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    sfGuardGroupPermissionQuery The current query, for fluid interface
	 */
	public function joinsfGuardGroup($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('sfGuardGroup');
		
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
			$this->addJoinObject($join, 'sfGuardGroup');
		}
		
		return $this;
	}

	/**
	 * Use the sfGuardGroup relation sfGuardGroup object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    sfGuardGroupQuery A secondary query class using the current class as primary query
	 */
	public function usesfGuardGroupQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinsfGuardGroup($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'sfGuardGroup', 'sfGuardGroupQuery');
	}

	/**
	 * Filter the query by a related sfGuardPermission object
	 *
	 * @param     sfGuardPermission $sfGuardPermission  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    sfGuardGroupPermissionQuery The current query, for fluid interface
	 */
	public function filterBysfGuardPermission($sfGuardPermission, $comparison = null)
	{
		return $this
			->addUsingAlias(sfGuardGroupPermissionPeer::PERMISSION_ID, $sfGuardPermission->getId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the sfGuardPermission relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    sfGuardGroupPermissionQuery The current query, for fluid interface
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
	 * @param     sfGuardGroupPermission $sfGuardGroupPermission Object to remove from the list of results
	 *
	 * @return    sfGuardGroupPermissionQuery The current query, for fluid interface
	 */
	public function prune($sfGuardGroupPermission = null)
	{
		if ($sfGuardGroupPermission) {
			$this->addCond('pruneCond0', $this->getAliasedColName(sfGuardGroupPermissionPeer::GROUP_ID), $sfGuardGroupPermission->getGroupId(), Criteria::NOT_EQUAL);
			$this->addCond('pruneCond1', $this->getAliasedColName(sfGuardGroupPermissionPeer::PERMISSION_ID), $sfGuardGroupPermission->getPermissionId(), Criteria::NOT_EQUAL);
			$this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
	  }
	  
		return $this;
	}

} // BasesfGuardGroupPermissionQuery
