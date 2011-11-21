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
	 * @return    sfGuardPermission|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = sfGuardPermissionPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(sfGuardPermissionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    sfGuardPermission A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `NAME`, `DESCRIPTION` FROM `sf_guard_permission` WHERE `ID` = :p0';
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
			$obj = new sfGuardPermission();
			$obj->hydrate($row);
			sfGuardPermissionPeer::addInstanceToPool($obj, (string) $row[0]);
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
	 * @return    sfGuardPermission|array|mixed the result, formatted by the current formatter
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
	 * Example usage:
	 * <code>
	 * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
	 * $query->filterByDescription('%fooValue%'); // WHERE description LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $description The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
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
		if ($sfGuardGroupPermission instanceof sfGuardGroupPermission) {
			return $this
				->addUsingAlias(sfGuardPermissionPeer::ID, $sfGuardGroupPermission->getPermissionId(), $comparison);
		} elseif ($sfGuardGroupPermission instanceof PropelCollection) {
			return $this
				->usesfGuardGroupPermissionQuery()
				->filterByPrimaryKeys($sfGuardGroupPermission->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterBysfGuardGroupPermission() only accepts arguments of type sfGuardGroupPermission or PropelCollection');
		}
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
		if ($sfGuardUserPermission instanceof sfGuardUserPermission) {
			return $this
				->addUsingAlias(sfGuardPermissionPeer::ID, $sfGuardUserPermission->getPermissionId(), $comparison);
		} elseif ($sfGuardUserPermission instanceof PropelCollection) {
			return $this
				->usesfGuardUserPermissionQuery()
				->filterByPrimaryKeys($sfGuardUserPermission->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterBysfGuardUserPermission() only accepts arguments of type sfGuardUserPermission or PropelCollection');
		}
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