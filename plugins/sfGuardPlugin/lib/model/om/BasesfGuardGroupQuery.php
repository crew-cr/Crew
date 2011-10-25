<?php


/**
 * Base class that represents a query for the 'sf_guard_group' table.
 *
 * 
 *
 * @method     sfGuardGroupQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     sfGuardGroupQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     sfGuardGroupQuery orderByDescription($order = Criteria::ASC) Order by the description column
 *
 * @method     sfGuardGroupQuery groupById() Group by the id column
 * @method     sfGuardGroupQuery groupByName() Group by the name column
 * @method     sfGuardGroupQuery groupByDescription() Group by the description column
 *
 * @method     sfGuardGroupQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     sfGuardGroupQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     sfGuardGroupQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     sfGuardGroupQuery leftJoinsfGuardGroupPermission($relationAlias = null) Adds a LEFT JOIN clause to the query using the sfGuardGroupPermission relation
 * @method     sfGuardGroupQuery rightJoinsfGuardGroupPermission($relationAlias = null) Adds a RIGHT JOIN clause to the query using the sfGuardGroupPermission relation
 * @method     sfGuardGroupQuery innerJoinsfGuardGroupPermission($relationAlias = null) Adds a INNER JOIN clause to the query using the sfGuardGroupPermission relation
 *
 * @method     sfGuardGroupQuery leftJoinsfGuardUserGroup($relationAlias = null) Adds a LEFT JOIN clause to the query using the sfGuardUserGroup relation
 * @method     sfGuardGroupQuery rightJoinsfGuardUserGroup($relationAlias = null) Adds a RIGHT JOIN clause to the query using the sfGuardUserGroup relation
 * @method     sfGuardGroupQuery innerJoinsfGuardUserGroup($relationAlias = null) Adds a INNER JOIN clause to the query using the sfGuardUserGroup relation
 *
 * @method     sfGuardGroup findOne(PropelPDO $con = null) Return the first sfGuardGroup matching the query
 * @method     sfGuardGroup findOneOrCreate(PropelPDO $con = null) Return the first sfGuardGroup matching the query, or a new sfGuardGroup object populated from the query conditions when no match is found
 *
 * @method     sfGuardGroup findOneById(int $id) Return the first sfGuardGroup filtered by the id column
 * @method     sfGuardGroup findOneByName(string $name) Return the first sfGuardGroup filtered by the name column
 * @method     sfGuardGroup findOneByDescription(string $description) Return the first sfGuardGroup filtered by the description column
 *
 * @method     array findById(int $id) Return sfGuardGroup objects filtered by the id column
 * @method     array findByName(string $name) Return sfGuardGroup objects filtered by the name column
 * @method     array findByDescription(string $description) Return sfGuardGroup objects filtered by the description column
 *
 * @package    propel.generator.plugins.sfGuardPlugin.lib.model.om
 */
abstract class BasesfGuardGroupQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BasesfGuardGroupQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'propel', $modelName = 'sfGuardGroup', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new sfGuardGroupQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    sfGuardGroupQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof sfGuardGroupQuery) {
			return $criteria;
		}
		$query = new sfGuardGroupQuery();
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
	 * @return    sfGuardGroup|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = sfGuardGroupPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    sfGuardGroupQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(sfGuardGroupPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    sfGuardGroupQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(sfGuardGroupPeer::ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the id column
	 * 
	 * @param     int|array $id The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    sfGuardGroupQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(sfGuardGroupPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the name column
	 * 
	 * @param     string $name The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    sfGuardGroupQuery The current query, for fluid interface
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
		return $this->addUsingAlias(sfGuardGroupPeer::NAME, $name, $comparison);
	}

	/**
	 * Filter the query on the description column
	 * 
	 * @param     string $description The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    sfGuardGroupQuery The current query, for fluid interface
	 */
	public function filterByDescription($description = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($description)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $description)) {
				$description = str_replace('*', '%', $description);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(sfGuardGroupPeer::DESCRIPTION, $description, $comparison);
	}

	/**
	 * Filter the query by a related sfGuardGroupPermission object
	 *
	 * @param     sfGuardGroupPermission $sfGuardGroupPermission  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    sfGuardGroupQuery The current query, for fluid interface
	 */
	public function filterBysfGuardGroupPermission($sfGuardGroupPermission, $comparison = null)
	{
		return $this
			->addUsingAlias(sfGuardGroupPeer::ID, $sfGuardGroupPermission->getGroupId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the sfGuardGroupPermission relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    sfGuardGroupQuery The current query, for fluid interface
	 */
	public function joinsfGuardGroupPermission($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('sfGuardGroupPermission');
		
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
			$this->addJoinObject($join, 'sfGuardGroupPermission');
		}
		
		return $this;
	}

	/**
	 * Use the sfGuardGroupPermission relation sfGuardGroupPermission object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    sfGuardGroupPermissionQuery A secondary query class using the current class as primary query
	 */
	public function usesfGuardGroupPermissionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinsfGuardGroupPermission($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'sfGuardGroupPermission', 'sfGuardGroupPermissionQuery');
	}

	/**
	 * Filter the query by a related sfGuardUserGroup object
	 *
	 * @param     sfGuardUserGroup $sfGuardUserGroup  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    sfGuardGroupQuery The current query, for fluid interface
	 */
	public function filterBysfGuardUserGroup($sfGuardUserGroup, $comparison = null)
	{
		return $this
			->addUsingAlias(sfGuardGroupPeer::ID, $sfGuardUserGroup->getGroupId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the sfGuardUserGroup relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    sfGuardGroupQuery The current query, for fluid interface
	 */
	public function joinsfGuardUserGroup($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('sfGuardUserGroup');
		
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
			$this->addJoinObject($join, 'sfGuardUserGroup');
		}
		
		return $this;
	}

	/**
	 * Use the sfGuardUserGroup relation sfGuardUserGroup object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    sfGuardUserGroupQuery A secondary query class using the current class as primary query
	 */
	public function usesfGuardUserGroupQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinsfGuardUserGroup($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'sfGuardUserGroup', 'sfGuardUserGroupQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     sfGuardGroup $sfGuardGroup Object to remove from the list of results
	 *
	 * @return    sfGuardGroupQuery The current query, for fluid interface
	 */
	public function prune($sfGuardGroup = null)
	{
		if ($sfGuardGroup) {
			$this->addUsingAlias(sfGuardGroupPeer::ID, $sfGuardGroup->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BasesfGuardGroupQuery
