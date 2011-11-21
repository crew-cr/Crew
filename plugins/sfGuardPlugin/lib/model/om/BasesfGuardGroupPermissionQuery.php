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
	 * Find object by primary key.
	 * Propel uses the instance pool to skip the database if the object exists.
	 * Go fast if the query is untouched.
	 *
	 * <code>
	 * $obj = $c->findPk(array(12, 34), $con);
	 * </code>
	 *
	 * @param     array[$group_id, $permission_id] $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    sfGuardGroupPermission|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = sfGuardGroupPermissionPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(sfGuardGroupPermissionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    sfGuardGroupPermission A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `GROUP_ID`, `PERMISSION_ID` FROM `sf_guard_group_permission` WHERE `GROUP_ID` = :p0 AND `PERMISSION_ID` = :p1';
		try {
			$stmt = $con->prepare($sql);
			$stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
			$stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
			$stmt->execute();
		} catch (Exception $e) {
			Propel::log($e->getMessage(), Propel::LOG_ERR);
			throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
		}
		$obj = null;
		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$obj = new sfGuardGroupPermission();
			$obj->hydrate($row);
			sfGuardGroupPermissionPeer::addInstanceToPool($obj, serialize(array((string) $row[0], (string) $row[1])));
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
	 * @return    sfGuardGroupPermission|array|mixed the result, formatted by the current formatter
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
	 * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
	 * Example usage:
	 * <code>
	 * $query->filterByGroupId(1234); // WHERE group_id = 1234
	 * $query->filterByGroupId(array(12, 34)); // WHERE group_id IN (12, 34)
	 * $query->filterByGroupId(array('min' => 12)); // WHERE group_id > 12
	 * </code>
	 *
	 * @see       filterBysfGuardGroup()
	 *
	 * @param     mixed $groupId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
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
	 * Example usage:
	 * <code>
	 * $query->filterByPermissionId(1234); // WHERE permission_id = 1234
	 * $query->filterByPermissionId(array(12, 34)); // WHERE permission_id IN (12, 34)
	 * $query->filterByPermissionId(array('min' => 12)); // WHERE permission_id > 12
	 * </code>
	 *
	 * @see       filterBysfGuardPermission()
	 *
	 * @param     mixed $permissionId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
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
	 * @param     sfGuardGroup|PropelCollection $sfGuardGroup The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    sfGuardGroupPermissionQuery The current query, for fluid interface
	 */
	public function filterBysfGuardGroup($sfGuardGroup, $comparison = null)
	{
		if ($sfGuardGroup instanceof sfGuardGroup) {
			return $this
				->addUsingAlias(sfGuardGroupPermissionPeer::GROUP_ID, $sfGuardGroup->getId(), $comparison);
		} elseif ($sfGuardGroup instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(sfGuardGroupPermissionPeer::GROUP_ID, $sfGuardGroup->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterBysfGuardGroup() only accepts arguments of type sfGuardGroup or PropelCollection');
		}
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
	 * @param     sfGuardPermission|PropelCollection $sfGuardPermission The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    sfGuardGroupPermissionQuery The current query, for fluid interface
	 */
	public function filterBysfGuardPermission($sfGuardPermission, $comparison = null)
	{
		if ($sfGuardPermission instanceof sfGuardPermission) {
			return $this
				->addUsingAlias(sfGuardGroupPermissionPeer::PERMISSION_ID, $sfGuardPermission->getId(), $comparison);
		} elseif ($sfGuardPermission instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(sfGuardGroupPermissionPeer::PERMISSION_ID, $sfGuardPermission->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterBysfGuardPermission() only accepts arguments of type sfGuardPermission or PropelCollection');
		}
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