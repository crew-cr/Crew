<?php


/**
 * Base class that represents a query for the 'branch_comment' table.
 *
 * 
 *
 * @method     BranchCommentQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     BranchCommentQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     BranchCommentQuery orderByBranchId($order = Criteria::ASC) Order by the branch_id column
 * @method     BranchCommentQuery orderByValue($order = Criteria::ASC) Order by the value column
 * @method     BranchCommentQuery orderByDate($order = Criteria::ASC) Order by the date column
 *
 * @method     BranchCommentQuery groupById() Group by the id column
 * @method     BranchCommentQuery groupByUserId() Group by the user_id column
 * @method     BranchCommentQuery groupByBranchId() Group by the branch_id column
 * @method     BranchCommentQuery groupByValue() Group by the value column
 * @method     BranchCommentQuery groupByDate() Group by the date column
 *
 * @method     BranchCommentQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     BranchCommentQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     BranchCommentQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     BranchCommentQuery leftJoinsfGuardUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the sfGuardUser relation
 * @method     BranchCommentQuery rightJoinsfGuardUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the sfGuardUser relation
 * @method     BranchCommentQuery innerJoinsfGuardUser($relationAlias = null) Adds a INNER JOIN clause to the query using the sfGuardUser relation
 *
 * @method     BranchCommentQuery leftJoinBranch($relationAlias = null) Adds a LEFT JOIN clause to the query using the Branch relation
 * @method     BranchCommentQuery rightJoinBranch($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Branch relation
 * @method     BranchCommentQuery innerJoinBranch($relationAlias = null) Adds a INNER JOIN clause to the query using the Branch relation
 *
 * @method     BranchComment findOne(PropelPDO $con = null) Return the first BranchComment matching the query
 * @method     BranchComment findOneOrCreate(PropelPDO $con = null) Return the first BranchComment matching the query, or a new BranchComment object populated from the query conditions when no match is found
 *
 * @method     BranchComment findOneById(int $id) Return the first BranchComment filtered by the id column
 * @method     BranchComment findOneByUserId(int $user_id) Return the first BranchComment filtered by the user_id column
 * @method     BranchComment findOneByBranchId(int $branch_id) Return the first BranchComment filtered by the branch_id column
 * @method     BranchComment findOneByValue(string $value) Return the first BranchComment filtered by the value column
 * @method     BranchComment findOneByDate(string $date) Return the first BranchComment filtered by the date column
 *
 * @method     array findById(int $id) Return BranchComment objects filtered by the id column
 * @method     array findByUserId(int $user_id) Return BranchComment objects filtered by the user_id column
 * @method     array findByBranchId(int $branch_id) Return BranchComment objects filtered by the branch_id column
 * @method     array findByValue(string $value) Return BranchComment objects filtered by the value column
 * @method     array findByDate(string $date) Return BranchComment objects filtered by the date column
 *
 * @package    propel.generator.lib.model.om
 */
abstract class BaseBranchCommentQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseBranchCommentQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'propel', $modelName = 'BranchComment', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new BranchCommentQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    BranchCommentQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof BranchCommentQuery) {
			return $criteria;
		}
		$query = new BranchCommentQuery();
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
	 * @return    BranchComment|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = BranchCommentPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    BranchCommentQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(BranchCommentPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    BranchCommentQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(BranchCommentPeer::ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the id column
	 * 
	 * @param     int|array $id The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    BranchCommentQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(BranchCommentPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the user_id column
	 * 
	 * @param     int|array $userId The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    BranchCommentQuery The current query, for fluid interface
	 */
	public function filterByUserId($userId = null, $comparison = null)
	{
		if (is_array($userId)) {
			$useMinMax = false;
			if (isset($userId['min'])) {
				$this->addUsingAlias(BranchCommentPeer::USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($userId['max'])) {
				$this->addUsingAlias(BranchCommentPeer::USER_ID, $userId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(BranchCommentPeer::USER_ID, $userId, $comparison);
	}

	/**
	 * Filter the query on the branch_id column
	 * 
	 * @param     int|array $branchId The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    BranchCommentQuery The current query, for fluid interface
	 */
	public function filterByBranchId($branchId = null, $comparison = null)
	{
		if (is_array($branchId)) {
			$useMinMax = false;
			if (isset($branchId['min'])) {
				$this->addUsingAlias(BranchCommentPeer::BRANCH_ID, $branchId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($branchId['max'])) {
				$this->addUsingAlias(BranchCommentPeer::BRANCH_ID, $branchId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(BranchCommentPeer::BRANCH_ID, $branchId, $comparison);
	}

	/**
	 * Filter the query on the value column
	 * 
	 * @param     string $value The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    BranchCommentQuery The current query, for fluid interface
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
		return $this->addUsingAlias(BranchCommentPeer::VALUE, $value, $comparison);
	}

	/**
	 * Filter the query on the date column
	 * 
	 * @param     string|array $date The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    BranchCommentQuery The current query, for fluid interface
	 */
	public function filterByDate($date = null, $comparison = null)
	{
		if (is_array($date)) {
			$useMinMax = false;
			if (isset($date['min'])) {
				$this->addUsingAlias(BranchCommentPeer::DATE, $date['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($date['max'])) {
				$this->addUsingAlias(BranchCommentPeer::DATE, $date['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(BranchCommentPeer::DATE, $date, $comparison);
	}

	/**
	 * Filter the query by a related sfGuardUser object
	 *
	 * @param     sfGuardUser $sfGuardUser  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    BranchCommentQuery The current query, for fluid interface
	 */
	public function filterBysfGuardUser($sfGuardUser, $comparison = null)
	{
		return $this
			->addUsingAlias(BranchCommentPeer::USER_ID, $sfGuardUser->getId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the sfGuardUser relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    BranchCommentQuery The current query, for fluid interface
	 */
	public function joinsfGuardUser($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
	public function usesfGuardUserQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinsfGuardUser($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'sfGuardUser', 'sfGuardUserQuery');
	}

	/**
	 * Filter the query by a related Branch object
	 *
	 * @param     Branch $branch  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    BranchCommentQuery The current query, for fluid interface
	 */
	public function filterByBranch($branch, $comparison = null)
	{
		return $this
			->addUsingAlias(BranchCommentPeer::BRANCH_ID, $branch->getId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the Branch relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    BranchCommentQuery The current query, for fluid interface
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
	 * @param     BranchComment $branchComment Object to remove from the list of results
	 *
	 * @return    BranchCommentQuery The current query, for fluid interface
	 */
	public function prune($branchComment = null)
	{
		if ($branchComment) {
			$this->addUsingAlias(BranchCommentPeer::ID, $branchComment->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseBranchCommentQuery
