<?php


/**
 * Base class that represents a query for the 'line_comment' table.
 *
 * 
 *
 * @method     LineCommentQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     LineCommentQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     LineCommentQuery orderByCommitReference($order = Criteria::ASC) Order by the commit_reference column
 * @method     LineCommentQuery orderByFileId($order = Criteria::ASC) Order by the file_id column
 * @method     LineCommentQuery orderByPosition($order = Criteria::ASC) Order by the position column
 * @method     LineCommentQuery orderByLine($order = Criteria::ASC) Order by the line column
 * @method     LineCommentQuery orderByValue($order = Criteria::ASC) Order by the value column
 * @method     LineCommentQuery orderByDate($order = Criteria::ASC) Order by the date column
 *
 * @method     LineCommentQuery groupById() Group by the id column
 * @method     LineCommentQuery groupByUserId() Group by the user_id column
 * @method     LineCommentQuery groupByCommitReference() Group by the commit_reference column
 * @method     LineCommentQuery groupByFileId() Group by the file_id column
 * @method     LineCommentQuery groupByPosition() Group by the position column
 * @method     LineCommentQuery groupByLine() Group by the line column
 * @method     LineCommentQuery groupByValue() Group by the value column
 * @method     LineCommentQuery groupByDate() Group by the date column
 *
 * @method     LineCommentQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     LineCommentQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     LineCommentQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     LineCommentQuery leftJoinsfGuardUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the sfGuardUser relation
 * @method     LineCommentQuery rightJoinsfGuardUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the sfGuardUser relation
 * @method     LineCommentQuery innerJoinsfGuardUser($relationAlias = null) Adds a INNER JOIN clause to the query using the sfGuardUser relation
 *
 * @method     LineCommentQuery leftJoinFile($relationAlias = null) Adds a LEFT JOIN clause to the query using the File relation
 * @method     LineCommentQuery rightJoinFile($relationAlias = null) Adds a RIGHT JOIN clause to the query using the File relation
 * @method     LineCommentQuery innerJoinFile($relationAlias = null) Adds a INNER JOIN clause to the query using the File relation
 *
 * @method     LineComment findOne(PropelPDO $con = null) Return the first LineComment matching the query
 * @method     LineComment findOneOrCreate(PropelPDO $con = null) Return the first LineComment matching the query, or a new LineComment object populated from the query conditions when no match is found
 *
 * @method     LineComment findOneById(int $id) Return the first LineComment filtered by the id column
 * @method     LineComment findOneByUserId(int $user_id) Return the first LineComment filtered by the user_id column
 * @method     LineComment findOneByCommitReference(string $commit_reference) Return the first LineComment filtered by the commit_reference column
 * @method     LineComment findOneByFileId(int $file_id) Return the first LineComment filtered by the file_id column
 * @method     LineComment findOneByPosition(int $position) Return the first LineComment filtered by the position column
 * @method     LineComment findOneByLine(int $line) Return the first LineComment filtered by the line column
 * @method     LineComment findOneByValue(string $value) Return the first LineComment filtered by the value column
 * @method     LineComment findOneByDate(string $date) Return the first LineComment filtered by the date column
 *
 * @method     array findById(int $id) Return LineComment objects filtered by the id column
 * @method     array findByUserId(int $user_id) Return LineComment objects filtered by the user_id column
 * @method     array findByCommitReference(string $commit_reference) Return LineComment objects filtered by the commit_reference column
 * @method     array findByFileId(int $file_id) Return LineComment objects filtered by the file_id column
 * @method     array findByPosition(int $position) Return LineComment objects filtered by the position column
 * @method     array findByLine(int $line) Return LineComment objects filtered by the line column
 * @method     array findByValue(string $value) Return LineComment objects filtered by the value column
 * @method     array findByDate(string $date) Return LineComment objects filtered by the date column
 *
 * @package    propel.generator.lib.model.om
 */
abstract class BaseLineCommentQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseLineCommentQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'propel', $modelName = 'LineComment', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new LineCommentQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    LineCommentQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof LineCommentQuery) {
			return $criteria;
		}
		$query = new LineCommentQuery();
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
	 * @return    LineComment|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = LineCommentPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    LineCommentQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(LineCommentPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    LineCommentQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(LineCommentPeer::ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the id column
	 * 
	 * @param     int|array $id The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    LineCommentQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(LineCommentPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the user_id column
	 * 
	 * @param     int|array $userId The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    LineCommentQuery The current query, for fluid interface
	 */
	public function filterByUserId($userId = null, $comparison = null)
	{
		if (is_array($userId)) {
			$useMinMax = false;
			if (isset($userId['min'])) {
				$this->addUsingAlias(LineCommentPeer::USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($userId['max'])) {
				$this->addUsingAlias(LineCommentPeer::USER_ID, $userId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(LineCommentPeer::USER_ID, $userId, $comparison);
	}

	/**
	 * Filter the query on the commit_reference column
	 * 
	 * @param     string $commitReference The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    LineCommentQuery The current query, for fluid interface
	 */
	public function filterByCommitReference($commitReference = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($commitReference)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $commitReference)) {
				$commitReference = str_replace('*', '%', $commitReference);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(LineCommentPeer::COMMIT_REFERENCE, $commitReference, $comparison);
	}

	/**
	 * Filter the query on the file_id column
	 * 
	 * @param     int|array $fileId The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    LineCommentQuery The current query, for fluid interface
	 */
	public function filterByFileId($fileId = null, $comparison = null)
	{
		if (is_array($fileId)) {
			$useMinMax = false;
			if (isset($fileId['min'])) {
				$this->addUsingAlias(LineCommentPeer::FILE_ID, $fileId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($fileId['max'])) {
				$this->addUsingAlias(LineCommentPeer::FILE_ID, $fileId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(LineCommentPeer::FILE_ID, $fileId, $comparison);
	}

	/**
	 * Filter the query on the position column
	 * 
	 * @param     int|array $position The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    LineCommentQuery The current query, for fluid interface
	 */
	public function filterByPosition($position = null, $comparison = null)
	{
		if (is_array($position)) {
			$useMinMax = false;
			if (isset($position['min'])) {
				$this->addUsingAlias(LineCommentPeer::POSITION, $position['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($position['max'])) {
				$this->addUsingAlias(LineCommentPeer::POSITION, $position['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(LineCommentPeer::POSITION, $position, $comparison);
	}

	/**
	 * Filter the query on the line column
	 * 
	 * @param     int|array $line The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    LineCommentQuery The current query, for fluid interface
	 */
	public function filterByLine($line = null, $comparison = null)
	{
		if (is_array($line)) {
			$useMinMax = false;
			if (isset($line['min'])) {
				$this->addUsingAlias(LineCommentPeer::LINE, $line['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($line['max'])) {
				$this->addUsingAlias(LineCommentPeer::LINE, $line['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(LineCommentPeer::LINE, $line, $comparison);
	}

	/**
	 * Filter the query on the value column
	 * 
	 * @param     string $value The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    LineCommentQuery The current query, for fluid interface
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
		return $this->addUsingAlias(LineCommentPeer::VALUE, $value, $comparison);
	}

	/**
	 * Filter the query on the date column
	 * 
	 * @param     string|array $date The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    LineCommentQuery The current query, for fluid interface
	 */
	public function filterByDate($date = null, $comparison = null)
	{
		if (is_array($date)) {
			$useMinMax = false;
			if (isset($date['min'])) {
				$this->addUsingAlias(LineCommentPeer::DATE, $date['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($date['max'])) {
				$this->addUsingAlias(LineCommentPeer::DATE, $date['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(LineCommentPeer::DATE, $date, $comparison);
	}

	/**
	 * Filter the query by a related sfGuardUser object
	 *
	 * @param     sfGuardUser $sfGuardUser  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    LineCommentQuery The current query, for fluid interface
	 */
	public function filterBysfGuardUser($sfGuardUser, $comparison = null)
	{
		return $this
			->addUsingAlias(LineCommentPeer::USER_ID, $sfGuardUser->getId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the sfGuardUser relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    LineCommentQuery The current query, for fluid interface
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
	 * Filter the query by a related File object
	 *
	 * @param     File $file  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    LineCommentQuery The current query, for fluid interface
	 */
	public function filterByFile($file, $comparison = null)
	{
		return $this
			->addUsingAlias(LineCommentPeer::FILE_ID, $file->getId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the File relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    LineCommentQuery The current query, for fluid interface
	 */
	public function joinFile($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('File');
		
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
			$this->addJoinObject($join, 'File');
		}
		
		return $this;
	}

	/**
	 * Use the File relation File object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    FileQuery A secondary query class using the current class as primary query
	 */
	public function useFileQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinFile($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'File', 'FileQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     LineComment $lineComment Object to remove from the list of results
	 *
	 * @return    LineCommentQuery The current query, for fluid interface
	 */
	public function prune($lineComment = null)
	{
		if ($lineComment) {
			$this->addUsingAlias(LineCommentPeer::ID, $lineComment->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseLineCommentQuery
