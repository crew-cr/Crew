<?php


/**
 * Base class that represents a query for the 'sf_guard_permission' table.
 *
 * 
 *
 * @method     sfGuardPermissionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     sfGuardPermissionQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     sfGuardPermissionQuery orderByDescription($order = Criteria::ASC) Order by the description column
 *
 * @method     sfGuardPermissionQuery groupById() Group by the id column
 * @method     sfGuardPermissionQuery groupByName() Group by the name column
 * @method     sfGuardPermissionQuery groupByDescription() Group by the description column
 *
 * @method     sfGuardPermissionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     sfGuardPermissionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     sfGuardPermissionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     sfGuardPermissionQuery leftJoinsfGuardGroupPermission($relationAlias = null) Adds a LEFT JOIN clause to the query using the sfGuardGroupPermission relation
 * @method     sfGuardPermissionQuery rightJoinsfGuardGroupPermission($relationAlias = null) Adds a RIGHT JOIN clause to the query using the sfGuardGroupPermission relation
 * @method     sfGuardPermissionQuery innerJoinsfGuardGroupPermission($relationAlias = null) Adds a INNER JOIN clause to the query using the sfGuardGroupPermission relation
 *
 * @method     sfGuardPermissionQuery leftJoinsfGuardUserPermission($relationAlias = null) Adds a LEFT JOIN clause to the query using the sfGuardUserPermission relation
 * @method     sfGuardPermissionQuery rightJoinsfGuardUserPermission($relationAlias = null) Adds a RIGHT JOIN clause to the query using the sfGuardUserPermission relation
 * @method     sfGuardPermissionQuery innerJoinsfGuardUserPermission($relationAlias = null) Adds a INNER JOIN clause to the query using the sfGuardUserPermission relation
 *
 * @method     sfGuardPermission findOne(PropelPDO $con = null) Return the first sfGuardPermission matching the query
 * @method     sfGuardPermission findOneOrCreate(PropelPDO $con = null) Return the first sfGuardPermission matching the query, or a new sfGuardPermission object populated from the query conditions when no match is found
 *
 * @method     sfGuardPermission findOneById(int $id) Return the first sfGuardPermission filtered by the id column
 * @method     sfGuardPermission findOneByName(string $name) Return the first sfGuardPermission filtered by the name column
 * @method     sfGuardPermission findOneByDescription(string $description) Return the first sfGuardPermission filtered by the description column
 *
 * @method     array findById(int $id) Return sfGuardPermission objects filtered by the id column
 * @method     array findByName(string $name) Return sfGuardPermission objects filtered by the name column
 * @method     array findByDescription(string $description) Return sfGuardPermission objects filtered by the description column
 *
 * @package    propel.generator.plugins.sfGuardPlugin.lib.model.om
 */
abstract class BasesfGuardPermissionQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BasesfGuardPermissionQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'propel', $modelName = 'sfGuardPermission', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new sfGuardPermissionQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    sfGuardPermissionQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof sfGuardPermissionQuery) {
			return $criteria;
		}
		$query = new sfGuardPermissionQuery();
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
	 * @return    sfGuardPermission|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = sfGuardPermissionPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    sfGuardPermissionQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(sfGuardPermissionPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    sfGuardPermissionQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(sfGuardPermissionPeer::ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the id column
	 * 
	 * @param     int|array $id The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    sfGuardPermissionQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(sfGuardPermissionPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the name column
	 * 
	 * @param     string $name The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    sfGuardPermissionQuery The current query, for fluid interface
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
		return $this->addUsingAlias(sfGuardPermissionPeer::NAME, $name, $comparison);
	}

	/**
	 * Filter the query on the description column
	 * 
	 * @param     string $description The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    sfGuardPermissionQuery The current query, for fluid interface
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
		return $this->addUsingAlias(sfGuardPermissionPeer::DESCRIPTION, $description, $comparison);
	}

	/**
	 * Filter the query by a related sfGuardGroupPermission object
	 *
	 * @param     sfGuardGroupPermission $sfGuardGroupPermission  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    sfGuardPermissionQuery The current query, for fluid interface
	 */
	public function filterBysfGuardGroupPermission($sfGuardGroupPermission, $comparison = null)
	{
		return $this
			->addUsingAlias(sfGuardPermissionPeer::ID, $sfGuardGroupPermission->getPermissionId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the sfGuardGroupPermission relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    sfGuardPermissionQuery The current query, for fluid interface
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
	 * Filter the query by a related sfGuardUserPermission object
	 *
	 * @param     sfGuardUserPermission $sfGuardUserPermission  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    sfGuardPermissionQuery The current query, for fluid interface
	 */
	public function filterBysfGuardUserPermission($sfGuardUserPermission, $comparison = null)
	{
		return $this
			->addUsingAlias(sfGuardPermissionPeer::ID, $sfGuardUserPermission->getPermissionId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the sfGuardUserPermission relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    sfGuardPermissionQuery The current query, for fluid interface
	 */
	public function joinsfGuardUserPermission($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('sfGuardUserPermission');
		
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
			$this->addJoinObject($join, 'sfGuardUserPermission');
		}
		
		return $this;
	}

	/**
	 * Use the sfGuardUserPermission relation sfGuardUserPermission object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    sfGuardUserPermissionQuery A secondary query class using the current class as primary query
	 */
	public function usesfGuardUserPermissionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinsfGuardUserPermission($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'sfGuardUserPermission', 'sfGuardUserPermissionQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     sfGuardPermission $sfGuardPermission Object to remove from the list of results
	 *
	 * @return    sfGuardPermissionQuery The current query, for fluid interface
	 */
	public function prune($sfGuardPermission = null)
	{
		if ($sfGuardPermission) {
			$this->addUsingAlias(sfGuardPermissionPeer::ID, $sfGuardPermission->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BasesfGuardPermissionQuery
