<?php


/**
 * Base class that represents a query for the 'repository' table.
 *
 * 
 *
 * @method     RepositoryQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     RepositoryQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     RepositoryQuery orderByValue($order = Criteria::ASC) Order by the value column
 * @method     RepositoryQuery orderByRemote($order = Criteria::ASC) Order by the remote column
 *
 * @method     RepositoryQuery groupById() Group by the id column
 * @method     RepositoryQuery groupByName() Group by the name column
 * @method     RepositoryQuery groupByValue() Group by the value column
 * @method     RepositoryQuery groupByRemote() Group by the remote column
 *
 * @method     RepositoryQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     RepositoryQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     RepositoryQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     RepositoryQuery leftJoinBranch($relationAlias = null) Adds a LEFT JOIN clause to the query using the Branch relation
 * @method     RepositoryQuery rightJoinBranch($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Branch relation
 * @method     RepositoryQuery innerJoinBranch($relationAlias = null) Adds a INNER JOIN clause to the query using the Branch relation
 *
 * @method     Repository findOne(PropelPDO $con = null) Return the first Repository matching the query
 * @method     Repository findOneOrCreate(PropelPDO $con = null) Return the first Repository matching the query, or a new Repository object populated from the query conditions when no match is found
 *
 * @method     Repository findOneById(int $id) Return the first Repository filtered by the id column
 * @method     Repository findOneByName(string $name) Return the first Repository filtered by the name column
 * @method     Repository findOneByValue(string $value) Return the first Repository filtered by the value column
 * @method     Repository findOneByRemote(string $remote) Return the first Repository filtered by the remote column
 *
 * @method     array findById(int $id) Return Repository objects filtered by the id column
 * @method     array findByName(string $name) Return Repository objects filtered by the name column
 * @method     array findByValue(string $value) Return Repository objects filtered by the value column
 * @method     array findByRemote(string $remote) Return Repository objects filtered by the remote column
 *
 * @package    propel.generator.lib.model.om
 */
abstract class BaseRepositoryQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseRepositoryQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'propel', $modelName = 'Repository', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new RepositoryQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    RepositoryQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof RepositoryQuery) {
			return $criteria;
		}
		$query = new RepositoryQuery();
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
	 * @return    Repository|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = RepositoryPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    RepositoryQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(RepositoryPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    RepositoryQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(RepositoryPeer::ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the id column
	 * 
	 * @param     int|array $id The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    RepositoryQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(RepositoryPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the name column
	 * 
	 * @param     string $name The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    RepositoryQuery The current query, for fluid interface
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
		return $this->addUsingAlias(RepositoryPeer::NAME, $name, $comparison);
	}

	/**
	 * Filter the query on the value column
	 * 
	 * @param     string $value The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    RepositoryQuery The current query, for fluid interface
	 */
	public function filterByValue($value = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($value)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $value)) {
				$value = str_replace('*', '%', $value);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(RepositoryPeer::VALUE, $value, $comparison);
	}

	/**
	 * Filter the query on the remote column
	 * 
	 * @param     string $remote The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    RepositoryQuery The current query, for fluid interface
	 */
	public function filterByRemote($remote = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($remote)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $remote)) {
				$remote = str_replace('*', '%', $remote);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(RepositoryPeer::REMOTE, $remote, $comparison);
	}

	/**
	 * Filter the query by a related Branch object
	 *
	 * @param     Branch $branch  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    RepositoryQuery The current query, for fluid interface
	 */
	public function filterByBranch($branch, $comparison = null)
	{
		return $this
			->addUsingAlias(RepositoryPeer::ID, $branch->getRepositoryId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the Branch relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    RepositoryQuery The current query, for fluid interface
	 */
	public function joinBranch($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Branch');
		
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
			$this->addJoinObject($join, 'Branch');
		}
		
		return $this;
	}

	/**
	 * Use the Branch relation Branch object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    BranchQuery A secondary query class using the current class as primary query
	 */
	public function useBranchQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinBranch($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Branch', 'BranchQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Repository $repository Object to remove from the list of results
	 *
	 * @return    RepositoryQuery The current query, for fluid interface
	 */
	public function prune($repository = null)
	{
		if ($repository) {
			$this->addUsingAlias(RepositoryPeer::ID, $repository->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseRepositoryQuery
