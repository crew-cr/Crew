<?php


/**
 * Base class that represents a row from the 'branch' table.
 *
 * 
 *
 * @package    propel.generator.lib.model.om
 */
abstract class BaseBranch extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'BranchPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        BranchPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the repository_id field.
	 * @var        int
	 */
	protected $repository_id;

	/**
	 * The value for the name field.
	 * @var        string
	 */
	protected $name;

	/**
	 * The value for the base_branch_name field.
	 * @var        string
	 */
	protected $base_branch_name;

	/**
	 * The value for the commit_reference field.
	 * @var        string
	 */
	protected $commit_reference;

	/**
	 * The value for the last_commit field.
	 * @var        string
	 */
	protected $last_commit;

	/**
	 * The value for the last_commit_desc field.
	 * @var        string
	 */
	protected $last_commit_desc;

	/**
	 * The value for the is_blacklisted field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $is_blacklisted;

	/**
	 * The value for the review_request field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $review_request;

	/**
	 * The value for the status field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $status;

	/**
	 * The value for the commit_status_changed field.
	 * @var        string
	 */
	protected $commit_status_changed;

	/**
	 * The value for the user_status_changed field.
	 * @var        int
	 */
	protected $user_status_changed;

	/**
	 * The value for the date_status_changed field.
	 * @var        string
	 */
	protected $date_status_changed;

	/**
	 * The value for the created_at field.
	 * @var        string
	 */
	protected $created_at;

	/**
	 * The value for the updated_at field.
	 * @var        string
	 */
	protected $updated_at;

	/**
	 * @var        Repository
	 */
	protected $aRepository;

	/**
	 * @var        sfGuardUser
	 */
	protected $asfGuardUser;

	/**
	 * @var        array Comment[] Collection to store aggregation of Comment objects.
	 */
	protected $collComments;

	/**
	 * @var        array File[] Collection to store aggregation of File objects.
	 */
	protected $collFiles;

	/**
	 * @var        array StatusAction[] Collection to store aggregation of StatusAction objects.
	 */
	protected $collStatusActions;

	/**
	 * Flag to prevent endless save loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInSave = false;

	/**
	 * Flag to prevent endless validation loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInValidation = false;

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $commentsScheduledForDeletion = null;

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $filesScheduledForDeletion = null;

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $statusActionsScheduledForDeletion = null;

	/**
	 * Applies default values to this object.
	 * This method should be called from the object's constructor (or
	 * equivalent initialization method).
	 * @see        __construct()
	 */
	public function applyDefaultValues()
	{
		$this->is_blacklisted = 0;
		$this->review_request = 0;
		$this->status = 0;
	}

	/**
	 * Initializes internal state of BaseBranch object.
	 * @see        applyDefaults()
	 */
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	/**
	 * Get the [id] column value.
	 * 
	 * @return     int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Get the [repository_id] column value.
	 * 
	 * @return     int
	 */
	public function getRepositoryId()
	{
		return $this->repository_id;
	}

	/**
	 * Get the [name] column value.
	 * 
	 * @return     string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Get the [base_branch_name] column value.
	 * 
	 * @return     string
	 */
	public function getBaseBranchName()
	{
		return $this->base_branch_name;
	}

	/**
	 * Get the [commit_reference] column value.
	 * 
	 * @return     string
	 */
	public function getCommitReference()
	{
		return $this->commit_reference;
	}

	/**
	 * Get the [last_commit] column value.
	 * 
	 * @return     string
	 */
	public function getLastCommit()
	{
		return $this->last_commit;
	}

	/**
	 * Get the [last_commit_desc] column value.
	 * 
	 * @return     string
	 */
	public function getLastCommitDesc()
	{
		return $this->last_commit_desc;
	}

	/**
	 * Get the [is_blacklisted] column value.
	 * 
	 * @return     int
	 */
	public function getIsBlacklisted()
	{
		return $this->is_blacklisted;
	}

	/**
	 * Get the [review_request] column value.
	 * 
	 * @return     int
	 */
	public function getReviewRequest()
	{
		return $this->review_request;
	}

	/**
	 * Get the [status] column value.
	 * 
	 * @return     int
	 */
	public function getStatus()
	{
		return $this->status;
	}

	/**
	 * Get the [commit_status_changed] column value.
	 * 
	 * @return     string
	 */
	public function getCommitStatusChanged()
	{
		return $this->commit_status_changed;
	}

	/**
	 * Get the [user_status_changed] column value.
	 * 
	 * @return     int
	 */
	public function getUserStatusChanged()
	{
		return $this->user_status_changed;
	}

	/**
	 * Get the [optionally formatted] temporal [date_status_changed] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getDateStatusChanged($format = 'Y-m-d H:i:s')
	{
		if ($this->date_status_changed === null) {
			return null;
		}


		if ($this->date_status_changed === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->date_status_changed);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->date_status_changed, true), $x);
			}
		}

		if ($format === null) {
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	/**
	 * Get the [optionally formatted] temporal [created_at] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCreatedAt($format = 'Y-m-d H:i:s')
	{
		if ($this->created_at === null) {
			return null;
		}


		if ($this->created_at === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->created_at);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->created_at, true), $x);
			}
		}

		if ($format === null) {
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	/**
	 * Get the [optionally formatted] temporal [updated_at] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getUpdatedAt($format = 'Y-m-d H:i:s')
	{
		if ($this->updated_at === null) {
			return null;
		}


		if ($this->updated_at === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->updated_at);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->updated_at, true), $x);
			}
		}

		if ($format === null) {
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     Branch The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = BranchPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [repository_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Branch The current object (for fluent API support)
	 */
	public function setRepositoryId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->repository_id !== $v) {
			$this->repository_id = $v;
			$this->modifiedColumns[] = BranchPeer::REPOSITORY_ID;
		}

		if ($this->aRepository !== null && $this->aRepository->getId() !== $v) {
			$this->aRepository = null;
		}

		return $this;
	} // setRepositoryId()

	/**
	 * Set the value of [name] column.
	 * 
	 * @param      string $v new value
	 * @return     Branch The current object (for fluent API support)
	 */
	public function setName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = BranchPeer::NAME;
		}

		return $this;
	} // setName()

	/**
	 * Set the value of [base_branch_name] column.
	 * 
	 * @param      string $v new value
	 * @return     Branch The current object (for fluent API support)
	 */
	public function setBaseBranchName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->base_branch_name !== $v) {
			$this->base_branch_name = $v;
			$this->modifiedColumns[] = BranchPeer::BASE_BRANCH_NAME;
		}

		return $this;
	} // setBaseBranchName()

	/**
	 * Set the value of [commit_reference] column.
	 * 
	 * @param      string $v new value
	 * @return     Branch The current object (for fluent API support)
	 */
	public function setCommitReference($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->commit_reference !== $v) {
			$this->commit_reference = $v;
			$this->modifiedColumns[] = BranchPeer::COMMIT_REFERENCE;
		}

		return $this;
	} // setCommitReference()

	/**
	 * Set the value of [last_commit] column.
	 * 
	 * @param      string $v new value
	 * @return     Branch The current object (for fluent API support)
	 */
	public function setLastCommit($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->last_commit !== $v) {
			$this->last_commit = $v;
			$this->modifiedColumns[] = BranchPeer::LAST_COMMIT;
		}

		return $this;
	} // setLastCommit()

	/**
	 * Set the value of [last_commit_desc] column.
	 * 
	 * @param      string $v new value
	 * @return     Branch The current object (for fluent API support)
	 */
	public function setLastCommitDesc($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->last_commit_desc !== $v) {
			$this->last_commit_desc = $v;
			$this->modifiedColumns[] = BranchPeer::LAST_COMMIT_DESC;
		}

		return $this;
	} // setLastCommitDesc()

	/**
	 * Set the value of [is_blacklisted] column.
	 * 
	 * @param      int $v new value
	 * @return     Branch The current object (for fluent API support)
	 */
	public function setIsBlacklisted($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->is_blacklisted !== $v) {
			$this->is_blacklisted = $v;
			$this->modifiedColumns[] = BranchPeer::IS_BLACKLISTED;
		}

		return $this;
	} // setIsBlacklisted()

	/**
	 * Set the value of [review_request] column.
	 * 
	 * @param      int $v new value
	 * @return     Branch The current object (for fluent API support)
	 */
	public function setReviewRequest($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->review_request !== $v) {
			$this->review_request = $v;
			$this->modifiedColumns[] = BranchPeer::REVIEW_REQUEST;
		}

		return $this;
	} // setReviewRequest()

	/**
	 * Set the value of [status] column.
	 * 
	 * @param      int $v new value
	 * @return     Branch The current object (for fluent API support)
	 */
	public function setStatus($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->status !== $v) {
			$this->status = $v;
			$this->modifiedColumns[] = BranchPeer::STATUS;
		}

		return $this;
	} // setStatus()

	/**
	 * Set the value of [commit_status_changed] column.
	 * 
	 * @param      string $v new value
	 * @return     Branch The current object (for fluent API support)
	 */
	public function setCommitStatusChanged($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->commit_status_changed !== $v) {
			$this->commit_status_changed = $v;
			$this->modifiedColumns[] = BranchPeer::COMMIT_STATUS_CHANGED;
		}

		return $this;
	} // setCommitStatusChanged()

	/**
	 * Set the value of [user_status_changed] column.
	 * 
	 * @param      int $v new value
	 * @return     Branch The current object (for fluent API support)
	 */
	public function setUserStatusChanged($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->user_status_changed !== $v) {
			$this->user_status_changed = $v;
			$this->modifiedColumns[] = BranchPeer::USER_STATUS_CHANGED;
		}

		if ($this->asfGuardUser !== null && $this->asfGuardUser->getId() !== $v) {
			$this->asfGuardUser = null;
		}

		return $this;
	} // setUserStatusChanged()

	/**
	 * Sets the value of [date_status_changed] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.
	 *               Empty strings are treated as NULL.
	 * @return     Branch The current object (for fluent API support)
	 */
	public function setDateStatusChanged($v)
	{
		$dt = PropelDateTime::newInstance($v, null, 'DateTime');
		if ($this->date_status_changed !== null || $dt !== null) {
			$currentDateAsString = ($this->date_status_changed !== null && $tmpDt = new DateTime($this->date_status_changed)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
			if ($currentDateAsString !== $newDateAsString) {
				$this->date_status_changed = $newDateAsString;
				$this->modifiedColumns[] = BranchPeer::DATE_STATUS_CHANGED;
			}
		} // if either are not null

		return $this;
	} // setDateStatusChanged()

	/**
	 * Sets the value of [created_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.
	 *               Empty strings are treated as NULL.
	 * @return     Branch The current object (for fluent API support)
	 */
	public function setCreatedAt($v)
	{
		$dt = PropelDateTime::newInstance($v, null, 'DateTime');
		if ($this->created_at !== null || $dt !== null) {
			$currentDateAsString = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
			if ($currentDateAsString !== $newDateAsString) {
				$this->created_at = $newDateAsString;
				$this->modifiedColumns[] = BranchPeer::CREATED_AT;
			}
		} // if either are not null

		return $this;
	} // setCreatedAt()

	/**
	 * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.
	 *               Empty strings are treated as NULL.
	 * @return     Branch The current object (for fluent API support)
	 */
	public function setUpdatedAt($v)
	{
		$dt = PropelDateTime::newInstance($v, null, 'DateTime');
		if ($this->updated_at !== null || $dt !== null) {
			$currentDateAsString = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
			if ($currentDateAsString !== $newDateAsString) {
				$this->updated_at = $newDateAsString;
				$this->modifiedColumns[] = BranchPeer::UPDATED_AT;
			}
		} // if either are not null

		return $this;
	} // setUpdatedAt()

	/**
	 * Indicates whether the columns in this object are only set to default values.
	 *
	 * This method can be used in conjunction with isModified() to indicate whether an object is both
	 * modified _and_ has some values set which are non-default.
	 *
	 * @return     boolean Whether the columns in this object are only been set with default values.
	 */
	public function hasOnlyDefaultValues()
	{
			if ($this->is_blacklisted !== 0) {
				return false;
			}

			if ($this->review_request !== 0) {
				return false;
			}

			if ($this->status !== 0) {
				return false;
			}

		// otherwise, everything was equal, so return TRUE
		return true;
	} // hasOnlyDefaultValues()

	/**
	 * Hydrates (populates) the object variables with values from the database resultset.
	 *
	 * An offset (0-based "start column") is specified so that objects can be hydrated
	 * with a subset of the columns in the resultset rows.  This is needed, for example,
	 * for results of JOIN queries where the resultset row includes columns from two or
	 * more tables.
	 *
	 * @param      array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
	 * @param      int $startcol 0-based offset column which indicates which restultset column to start with.
	 * @param      boolean $rehydrate Whether this object is being re-hydrated from the database.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->repository_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->name = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->base_branch_name = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->commit_reference = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->last_commit = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->last_commit_desc = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->is_blacklisted = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
			$this->review_request = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
			$this->status = ($row[$startcol + 9] !== null) ? (int) $row[$startcol + 9] : null;
			$this->commit_status_changed = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->user_status_changed = ($row[$startcol + 11] !== null) ? (int) $row[$startcol + 11] : null;
			$this->date_status_changed = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->created_at = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->updated_at = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 15; // 15 = BranchPeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating Branch object", $e);
		}
	}

	/**
	 * Checks and repairs the internal consistency of the object.
	 *
	 * This method is executed after an already-instantiated object is re-hydrated
	 * from the database.  It exists to check any foreign keys to make sure that
	 * the objects related to the current object are correct based on foreign key.
	 *
	 * You can override this method in the stub class, but you should always invoke
	 * the base method from the overridden method (i.e. parent::ensureConsistency()),
	 * in case your model changes.
	 *
	 * @throws     PropelException
	 */
	public function ensureConsistency()
	{

		if ($this->aRepository !== null && $this->repository_id !== $this->aRepository->getId()) {
			$this->aRepository = null;
		}
		if ($this->asfGuardUser !== null && $this->user_status_changed !== $this->asfGuardUser->getId()) {
			$this->asfGuardUser = null;
		}
	} // ensureConsistency

	/**
	 * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
	 *
	 * This will only work if the object has been saved and has a valid primary key set.
	 *
	 * @param      boolean $deep (optional) Whether to also de-associated any related objects.
	 * @param      PropelPDO $con (optional) The PropelPDO connection to use.
	 * @return     void
	 * @throws     PropelException - if this object is deleted, unsaved or doesn't have pk match in db
	 */
	public function reload($deep = false, PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("Cannot reload a deleted object.");
		}

		if ($this->isNew()) {
			throw new PropelException("Cannot reload an unsaved object.");
		}

		if ($con === null) {
			$con = Propel::getConnection(BranchPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = BranchPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aRepository = null;
			$this->asfGuardUser = null;
			$this->collComments = null;

			$this->collFiles = null;

			$this->collStatusActions = null;

		} // if (deep)
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      PropelPDO $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(BranchPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$deleteQuery = BranchQuery::create()
				->filterByPrimaryKey($this->getPrimaryKey());
			$ret = $this->preDelete($con);
			// symfony_behaviors behavior
			foreach (sfMixer::getCallables('BaseBranch:delete:pre') as $callable)
			{
			  if (call_user_func($callable, $this, $con))
			  {
			    $con->commit();
			    return;
			  }
			}

			if ($ret) {
				$deleteQuery->delete($con);
				$this->postDelete($con);
				// symfony_behaviors behavior
				foreach (sfMixer::getCallables('BaseBranch:delete:post') as $callable)
				{
				  call_user_func($callable, $this, $con);
				}

				$con->commit();
				$this->setDeleted(true);
			} else {
				$con->commit();
			}
		} catch (Exception $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Persists this object to the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All modified related objects will also be persisted in the doSave()
	 * method.  This method wraps all precipitate database operations in a
	 * single transaction.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(BranchPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		$isInsert = $this->isNew();
		try {
			$ret = $this->preSave($con);
			// symfony_behaviors behavior
			foreach (sfMixer::getCallables('BaseBranch:save:pre') as $callable)
			{
			  if (is_integer($affectedRows = call_user_func($callable, $this, $con)))
			  {
			  	$con->commit();
			    return $affectedRows;
			  }
			}

			// symfony_timestampable behavior
			if ($this->isModified() && !$this->isColumnModified(BranchPeer::UPDATED_AT))
			{
				$this->setUpdatedAt(time());
			}
			if ($isInsert) {
				$ret = $ret && $this->preInsert($con);
				// symfony_timestampable behavior
				if (!$this->isColumnModified(BranchPeer::CREATED_AT))
				{
				  $this->setCreatedAt(time());
				}

			} else {
				$ret = $ret && $this->preUpdate($con);
			}
			if ($ret) {
				$affectedRows = $this->doSave($con);
				if ($isInsert) {
					$this->postInsert($con);
				} else {
					$this->postUpdate($con);
				}
				$this->postSave($con);
				// symfony_behaviors behavior
				foreach (sfMixer::getCallables('BaseBranch:save:post') as $callable)
				{
				  call_user_func($callable, $this, $con, $affectedRows);
				}

				BranchPeer::addInstanceToPool($this);
			} else {
				$affectedRows = 0;
			}
			$con->commit();
			return $affectedRows;
		} catch (Exception $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Performs the work of inserting or updating the row in the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All related objects are also updated in this method.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        save()
	 */
	protected function doSave(PropelPDO $con)
	{
		$affectedRows = 0; // initialize var to track total num of affected rows
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;

			// We call the save method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aRepository !== null) {
				if ($this->aRepository->isModified() || $this->aRepository->isNew()) {
					$affectedRows += $this->aRepository->save($con);
				}
				$this->setRepository($this->aRepository);
			}

			if ($this->asfGuardUser !== null) {
				if ($this->asfGuardUser->isModified() || $this->asfGuardUser->isNew()) {
					$affectedRows += $this->asfGuardUser->save($con);
				}
				$this->setsfGuardUser($this->asfGuardUser);
			}

			if ($this->isNew() || $this->isModified()) {
				// persist changes
				if ($this->isNew()) {
					$this->doInsert($con);
				} else {
					$this->doUpdate($con);
				}
				$affectedRows += 1;
				$this->resetModified();
			}

			if ($this->commentsScheduledForDeletion !== null) {
				if (!$this->commentsScheduledForDeletion->isEmpty()) {
					CommentQuery::create()
						->filterByPrimaryKeys($this->commentsScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->commentsScheduledForDeletion = null;
				}
			}

			if ($this->collComments !== null) {
				foreach ($this->collComments as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->filesScheduledForDeletion !== null) {
				if (!$this->filesScheduledForDeletion->isEmpty()) {
					FileQuery::create()
						->filterByPrimaryKeys($this->filesScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->filesScheduledForDeletion = null;
				}
			}

			if ($this->collFiles !== null) {
				foreach ($this->collFiles as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->statusActionsScheduledForDeletion !== null) {
				if (!$this->statusActionsScheduledForDeletion->isEmpty()) {
					StatusActionQuery::create()
						->filterByPrimaryKeys($this->statusActionsScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->statusActionsScheduledForDeletion = null;
				}
			}

			if ($this->collStatusActions !== null) {
				foreach ($this->collStatusActions as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			$this->alreadyInSave = false;

		}
		return $affectedRows;
	} // doSave()

	/**
	 * Insert the row in the database.
	 *
	 * @param      PropelPDO $con
	 *
	 * @throws     PropelException
	 * @see        doSave()
	 */
	protected function doInsert(PropelPDO $con)
	{
		$modifiedColumns = array();
		$index = 0;

		$this->modifiedColumns[] = BranchPeer::ID;
		if (null !== $this->id) {
			throw new PropelException('Cannot insert a value for auto-increment primary key (' . BranchPeer::ID . ')');
		}

		 // check the columns in natural order for more readable SQL queries
		if ($this->isColumnModified(BranchPeer::ID)) {
			$modifiedColumns[':p' . $index++]  = '`ID`';
		}
		if ($this->isColumnModified(BranchPeer::REPOSITORY_ID)) {
			$modifiedColumns[':p' . $index++]  = '`REPOSITORY_ID`';
		}
		if ($this->isColumnModified(BranchPeer::NAME)) {
			$modifiedColumns[':p' . $index++]  = '`NAME`';
		}
		if ($this->isColumnModified(BranchPeer::BASE_BRANCH_NAME)) {
			$modifiedColumns[':p' . $index++]  = '`BASE_BRANCH_NAME`';
		}
		if ($this->isColumnModified(BranchPeer::COMMIT_REFERENCE)) {
			$modifiedColumns[':p' . $index++]  = '`COMMIT_REFERENCE`';
		}
		if ($this->isColumnModified(BranchPeer::LAST_COMMIT)) {
			$modifiedColumns[':p' . $index++]  = '`LAST_COMMIT`';
		}
		if ($this->isColumnModified(BranchPeer::LAST_COMMIT_DESC)) {
			$modifiedColumns[':p' . $index++]  = '`LAST_COMMIT_DESC`';
		}
		if ($this->isColumnModified(BranchPeer::IS_BLACKLISTED)) {
			$modifiedColumns[':p' . $index++]  = '`IS_BLACKLISTED`';
		}
		if ($this->isColumnModified(BranchPeer::REVIEW_REQUEST)) {
			$modifiedColumns[':p' . $index++]  = '`REVIEW_REQUEST`';
		}
		if ($this->isColumnModified(BranchPeer::STATUS)) {
			$modifiedColumns[':p' . $index++]  = '`STATUS`';
		}
		if ($this->isColumnModified(BranchPeer::COMMIT_STATUS_CHANGED)) {
			$modifiedColumns[':p' . $index++]  = '`COMMIT_STATUS_CHANGED`';
		}
		if ($this->isColumnModified(BranchPeer::USER_STATUS_CHANGED)) {
			$modifiedColumns[':p' . $index++]  = '`USER_STATUS_CHANGED`';
		}
		if ($this->isColumnModified(BranchPeer::DATE_STATUS_CHANGED)) {
			$modifiedColumns[':p' . $index++]  = '`DATE_STATUS_CHANGED`';
		}
		if ($this->isColumnModified(BranchPeer::CREATED_AT)) {
			$modifiedColumns[':p' . $index++]  = '`CREATED_AT`';
		}
		if ($this->isColumnModified(BranchPeer::UPDATED_AT)) {
			$modifiedColumns[':p' . $index++]  = '`UPDATED_AT`';
		}

		$sql = sprintf(
			'INSERT INTO `branch` (%s) VALUES (%s)',
			implode(', ', $modifiedColumns),
			implode(', ', array_keys($modifiedColumns))
		);

		try {
			$stmt = $con->prepare($sql);
			foreach ($modifiedColumns as $identifier => $columnName) {
				switch ($columnName) {
					case '`ID`':
						$stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
						break;
					case '`REPOSITORY_ID`':
						$stmt->bindValue($identifier, $this->repository_id, PDO::PARAM_INT);
						break;
					case '`NAME`':
						$stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
						break;
					case '`BASE_BRANCH_NAME`':
						$stmt->bindValue($identifier, $this->base_branch_name, PDO::PARAM_STR);
						break;
					case '`COMMIT_REFERENCE`':
						$stmt->bindValue($identifier, $this->commit_reference, PDO::PARAM_STR);
						break;
					case '`LAST_COMMIT`':
						$stmt->bindValue($identifier, $this->last_commit, PDO::PARAM_STR);
						break;
					case '`LAST_COMMIT_DESC`':
						$stmt->bindValue($identifier, $this->last_commit_desc, PDO::PARAM_STR);
						break;
					case '`IS_BLACKLISTED`':
						$stmt->bindValue($identifier, $this->is_blacklisted, PDO::PARAM_INT);
						break;
					case '`REVIEW_REQUEST`':
						$stmt->bindValue($identifier, $this->review_request, PDO::PARAM_INT);
						break;
					case '`STATUS`':
						$stmt->bindValue($identifier, $this->status, PDO::PARAM_INT);
						break;
					case '`COMMIT_STATUS_CHANGED`':
						$stmt->bindValue($identifier, $this->commit_status_changed, PDO::PARAM_STR);
						break;
					case '`USER_STATUS_CHANGED`':
						$stmt->bindValue($identifier, $this->user_status_changed, PDO::PARAM_INT);
						break;
					case '`DATE_STATUS_CHANGED`':
						$stmt->bindValue($identifier, $this->date_status_changed, PDO::PARAM_STR);
						break;
					case '`CREATED_AT`':
						$stmt->bindValue($identifier, $this->created_at, PDO::PARAM_STR);
						break;
					case '`UPDATED_AT`':
						$stmt->bindValue($identifier, $this->updated_at, PDO::PARAM_STR);
						break;
				}
			}
			$stmt->execute();
		} catch (Exception $e) {
			Propel::log($e->getMessage(), Propel::LOG_ERR);
			throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
		}

		try {
			$pk = $con->lastInsertId();
		} catch (Exception $e) {
			throw new PropelException('Unable to get autoincrement id.', $e);
		}
		$this->setId($pk);

		$this->setNew(false);
	}

	/**
	 * Update the row in the database.
	 *
	 * @param      PropelPDO $con
	 *
	 * @see        doSave()
	 */
	protected function doUpdate(PropelPDO $con)
	{
		$selectCriteria = $this->buildPkeyCriteria();
		$valuesCriteria = $this->buildCriteria();
		BasePeer::doUpdate($selectCriteria, $valuesCriteria, $con);
	}

	/**
	 * Array of ValidationFailed objects.
	 * @var        array ValidationFailed[]
	 */
	protected $validationFailures = array();

	/**
	 * Gets any ValidationFailed objects that resulted from last call to validate().
	 *
	 *
	 * @return     array ValidationFailed[]
	 * @see        validate()
	 */
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	/**
	 * Validates the objects modified field values and all objects related to this table.
	 *
	 * If $columns is either a column name or an array of column names
	 * only those columns are validated.
	 *
	 * @param      mixed $columns Column name or an array of column names.
	 * @return     boolean Whether all columns pass validation.
	 * @see        doValidate()
	 * @see        getValidationFailures()
	 */
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	/**
	 * This function performs the validation work for complex object models.
	 *
	 * In addition to checking the current object, all related objects will
	 * also be validated.  If all pass then <code>true</code> is returned; otherwise
	 * an aggreagated array of ValidationFailed objects will be returned.
	 *
	 * @param      array $columns Array of column names to validate.
	 * @return     mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
	 */
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			// We call the validate method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aRepository !== null) {
				if (!$this->aRepository->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aRepository->getValidationFailures());
				}
			}

			if ($this->asfGuardUser !== null) {
				if (!$this->asfGuardUser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->asfGuardUser->getValidationFailures());
				}
			}


			if (($retval = BranchPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collComments !== null) {
					foreach ($this->collComments as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collFiles !== null) {
					foreach ($this->collFiles as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collStatusActions !== null) {
					foreach ($this->collStatusActions as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	/**
	 * Retrieves a field from the object by name passed in as a string.
	 *
	 * @param      string $name name
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = BranchPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	/**
	 * Retrieves a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @return     mixed Value of field at $pos
	 */
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getRepositoryId();
				break;
			case 2:
				return $this->getName();
				break;
			case 3:
				return $this->getBaseBranchName();
				break;
			case 4:
				return $this->getCommitReference();
				break;
			case 5:
				return $this->getLastCommit();
				break;
			case 6:
				return $this->getLastCommitDesc();
				break;
			case 7:
				return $this->getIsBlacklisted();
				break;
			case 8:
				return $this->getReviewRequest();
				break;
			case 9:
				return $this->getStatus();
				break;
			case 10:
				return $this->getCommitStatusChanged();
				break;
			case 11:
				return $this->getUserStatusChanged();
				break;
			case 12:
				return $this->getDateStatusChanged();
				break;
			case 13:
				return $this->getCreatedAt();
				break;
			case 14:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} // switch()
	}

	/**
	 * Exports the object as an array.
	 *
	 * You can specify the key type of the array by passing one of the class
	 * type constants.
	 *
	 * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
	 *                    Defaults to BasePeer::TYPE_PHPNAME.
	 * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
	 * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
	 * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
	 *
	 * @return    array an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
	{
		if (isset($alreadyDumpedObjects['Branch'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['Branch'][$this->getPrimaryKey()] = true;
		$keys = BranchPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getRepositoryId(),
			$keys[2] => $this->getName(),
			$keys[3] => $this->getBaseBranchName(),
			$keys[4] => $this->getCommitReference(),
			$keys[5] => $this->getLastCommit(),
			$keys[6] => $this->getLastCommitDesc(),
			$keys[7] => $this->getIsBlacklisted(),
			$keys[8] => $this->getReviewRequest(),
			$keys[9] => $this->getStatus(),
			$keys[10] => $this->getCommitStatusChanged(),
			$keys[11] => $this->getUserStatusChanged(),
			$keys[12] => $this->getDateStatusChanged(),
			$keys[13] => $this->getCreatedAt(),
			$keys[14] => $this->getUpdatedAt(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->aRepository) {
				$result['Repository'] = $this->aRepository->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->asfGuardUser) {
				$result['sfGuardUser'] = $this->asfGuardUser->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->collComments) {
				$result['Comments'] = $this->collComments->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collFiles) {
				$result['Files'] = $this->collFiles->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collStatusActions) {
				$result['StatusActions'] = $this->collStatusActions->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
		}
		return $result;
	}

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param      string $name peer name
	 * @param      mixed $value field value
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     void
	 */
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = BranchPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	/**
	 * Sets a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @param      mixed $value field value
	 * @return     void
	 */
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setRepositoryId($value);
				break;
			case 2:
				$this->setName($value);
				break;
			case 3:
				$this->setBaseBranchName($value);
				break;
			case 4:
				$this->setCommitReference($value);
				break;
			case 5:
				$this->setLastCommit($value);
				break;
			case 6:
				$this->setLastCommitDesc($value);
				break;
			case 7:
				$this->setIsBlacklisted($value);
				break;
			case 8:
				$this->setReviewRequest($value);
				break;
			case 9:
				$this->setStatus($value);
				break;
			case 10:
				$this->setCommitStatusChanged($value);
				break;
			case 11:
				$this->setUserStatusChanged($value);
				break;
			case 12:
				$this->setDateStatusChanged($value);
				break;
			case 13:
				$this->setCreatedAt($value);
				break;
			case 14:
				$this->setUpdatedAt($value);
				break;
		} // switch()
	}

	/**
	 * Populates the object using an array.
	 *
	 * This is particularly useful when populating an object from one of the
	 * request arrays (e.g. $_POST).  This method goes through the column
	 * names, checking to see whether a matching key exists in populated
	 * array. If so the setByName() method is called for that column.
	 *
	 * You can specify the key type of the array by additionally passing one
	 * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
	 * The default key type is the column's phpname (e.g. 'AuthorId')
	 *
	 * @param      array  $arr     An array to populate the object from.
	 * @param      string $keyType The type of keys the array uses.
	 * @return     void
	 */
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = BranchPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setRepositoryId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setBaseBranchName($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCommitReference($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setLastCommit($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setLastCommitDesc($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setIsBlacklisted($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setReviewRequest($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setStatus($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCommitStatusChanged($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setUserStatusChanged($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setDateStatusChanged($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCreatedAt($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setUpdatedAt($arr[$keys[14]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(BranchPeer::DATABASE_NAME);

		if ($this->isColumnModified(BranchPeer::ID)) $criteria->add(BranchPeer::ID, $this->id);
		if ($this->isColumnModified(BranchPeer::REPOSITORY_ID)) $criteria->add(BranchPeer::REPOSITORY_ID, $this->repository_id);
		if ($this->isColumnModified(BranchPeer::NAME)) $criteria->add(BranchPeer::NAME, $this->name);
		if ($this->isColumnModified(BranchPeer::BASE_BRANCH_NAME)) $criteria->add(BranchPeer::BASE_BRANCH_NAME, $this->base_branch_name);
		if ($this->isColumnModified(BranchPeer::COMMIT_REFERENCE)) $criteria->add(BranchPeer::COMMIT_REFERENCE, $this->commit_reference);
		if ($this->isColumnModified(BranchPeer::LAST_COMMIT)) $criteria->add(BranchPeer::LAST_COMMIT, $this->last_commit);
		if ($this->isColumnModified(BranchPeer::LAST_COMMIT_DESC)) $criteria->add(BranchPeer::LAST_COMMIT_DESC, $this->last_commit_desc);
		if ($this->isColumnModified(BranchPeer::IS_BLACKLISTED)) $criteria->add(BranchPeer::IS_BLACKLISTED, $this->is_blacklisted);
		if ($this->isColumnModified(BranchPeer::REVIEW_REQUEST)) $criteria->add(BranchPeer::REVIEW_REQUEST, $this->review_request);
		if ($this->isColumnModified(BranchPeer::STATUS)) $criteria->add(BranchPeer::STATUS, $this->status);
		if ($this->isColumnModified(BranchPeer::COMMIT_STATUS_CHANGED)) $criteria->add(BranchPeer::COMMIT_STATUS_CHANGED, $this->commit_status_changed);
		if ($this->isColumnModified(BranchPeer::USER_STATUS_CHANGED)) $criteria->add(BranchPeer::USER_STATUS_CHANGED, $this->user_status_changed);
		if ($this->isColumnModified(BranchPeer::DATE_STATUS_CHANGED)) $criteria->add(BranchPeer::DATE_STATUS_CHANGED, $this->date_status_changed);
		if ($this->isColumnModified(BranchPeer::CREATED_AT)) $criteria->add(BranchPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(BranchPeer::UPDATED_AT)) $criteria->add(BranchPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	/**
	 * Builds a Criteria object containing the primary key for this object.
	 *
	 * Unlike buildCriteria() this method includes the primary key values regardless
	 * of whether or not they have been modified.
	 *
	 * @return     Criteria The Criteria object containing value(s) for primary key(s).
	 */
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(BranchPeer::DATABASE_NAME);
		$criteria->add(BranchPeer::ID, $this->id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	/**
	 * Generic method to set the primary key (id column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	/**
	 * Returns true if the primary key for this object is null.
	 * @return     boolean
	 */
	public function isPrimaryKeyNull()
	{
		return null === $this->getId();
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Branch (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setRepositoryId($this->getRepositoryId());
		$copyObj->setName($this->getName());
		$copyObj->setBaseBranchName($this->getBaseBranchName());
		$copyObj->setCommitReference($this->getCommitReference());
		$copyObj->setLastCommit($this->getLastCommit());
		$copyObj->setLastCommitDesc($this->getLastCommitDesc());
		$copyObj->setIsBlacklisted($this->getIsBlacklisted());
		$copyObj->setReviewRequest($this->getReviewRequest());
		$copyObj->setStatus($this->getStatus());
		$copyObj->setCommitStatusChanged($this->getCommitStatusChanged());
		$copyObj->setUserStatusChanged($this->getUserStatusChanged());
		$copyObj->setDateStatusChanged($this->getDateStatusChanged());
		$copyObj->setCreatedAt($this->getCreatedAt());
		$copyObj->setUpdatedAt($this->getUpdatedAt());

		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getComments() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addComment($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getFiles() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addFile($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getStatusActions() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addStatusAction($relObj->copy($deepCopy));
				}
			}

		} // if ($deepCopy)

		if ($makeNew) {
			$copyObj->setNew(true);
			$copyObj->setId(NULL); // this is a auto-increment column, so set to default value
		}
	}

	/**
	 * Makes a copy of this object that will be inserted as a new row in table when saved.
	 * It creates a new object filling in the simple attributes, but skipping any primary
	 * keys that are defined for the table.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @return     Branch Clone of current object.
	 * @throws     PropelException
	 */
	public function copy($deepCopy = false)
	{
		// we use get_class(), because this might be a subclass
		$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	/**
	 * Returns a peer instance associated with this om.
	 *
	 * Since Peer classes are not to have any instance attributes, this method returns the
	 * same instance for all member of this class. The method could therefore
	 * be static, but this would prevent one from overriding the behavior.
	 *
	 * @return     BranchPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new BranchPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Repository object.
	 *
	 * @param      Repository $v
	 * @return     Branch The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setRepository(Repository $v = null)
	{
		if ($v === null) {
			$this->setRepositoryId(NULL);
		} else {
			$this->setRepositoryId($v->getId());
		}

		$this->aRepository = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Repository object, it will not be re-added.
		if ($v !== null) {
			$v->addBranch($this);
		}

		return $this;
	}


	/**
	 * Get the associated Repository object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Repository The associated Repository object.
	 * @throws     PropelException
	 */
	public function getRepository(PropelPDO $con = null)
	{
		if ($this->aRepository === null && ($this->repository_id !== null)) {
			$this->aRepository = RepositoryQuery::create()->findPk($this->repository_id, $con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aRepository->addBranchs($this);
			 */
		}
		return $this->aRepository;
	}

	/**
	 * Declares an association between this object and a sfGuardUser object.
	 *
	 * @param      sfGuardUser $v
	 * @return     Branch The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setsfGuardUser(sfGuardUser $v = null)
	{
		if ($v === null) {
			$this->setUserStatusChanged(NULL);
		} else {
			$this->setUserStatusChanged($v->getId());
		}

		$this->asfGuardUser = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the sfGuardUser object, it will not be re-added.
		if ($v !== null) {
			$v->addBranch($this);
		}

		return $this;
	}


	/**
	 * Get the associated sfGuardUser object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     sfGuardUser The associated sfGuardUser object.
	 * @throws     PropelException
	 */
	public function getsfGuardUser(PropelPDO $con = null)
	{
		if ($this->asfGuardUser === null && ($this->user_status_changed !== null)) {
			$this->asfGuardUser = sfGuardUserQuery::create()->findPk($this->user_status_changed, $con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->asfGuardUser->addBranchs($this);
			 */
		}
		return $this->asfGuardUser;
	}


	/**
	 * Initializes a collection based on the name of a relation.
	 * Avoids crafting an 'init[$relationName]s' method name
	 * that wouldn't work when StandardEnglishPluralizer is used.
	 *
	 * @param      string $relationName The name of the relation to initialize
	 * @return     void
	 */
	public function initRelation($relationName)
	{
		if ('Comment' == $relationName) {
			return $this->initComments();
		}
		if ('File' == $relationName) {
			return $this->initFiles();
		}
		if ('StatusAction' == $relationName) {
			return $this->initStatusActions();
		}
	}

	/**
	 * Clears out the collComments collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addComments()
	 */
	public function clearComments()
	{
		$this->collComments = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collComments collection.
	 *
	 * By default this just sets the collComments collection to an empty array (like clearcollComments());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initComments($overrideExisting = true)
	{
		if (null !== $this->collComments && !$overrideExisting) {
			return;
		}
		$this->collComments = new PropelObjectCollection();
		$this->collComments->setModel('Comment');
	}

	/**
	 * Gets an array of Comment objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Branch is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array Comment[] List of Comment objects
	 * @throws     PropelException
	 */
	public function getComments($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collComments || null !== $criteria) {
			if ($this->isNew() && null === $this->collComments) {
				// return empty collection
				$this->initComments();
			} else {
				$collComments = CommentQuery::create(null, $criteria)
					->filterByBranch($this)
					->find($con);
				if (null !== $criteria) {
					return $collComments;
				}
				$this->collComments = $collComments;
			}
		}
		return $this->collComments;
	}

	/**
	 * Sets a collection of Comment objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $comments A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setComments(PropelCollection $comments, PropelPDO $con = null)
	{
		$this->commentsScheduledForDeletion = $this->getComments(new Criteria(), $con)->diff($comments);

		foreach ($comments as $comment) {
			// Fix issue with collection modified by reference
			if ($comment->isNew()) {
				$comment->setBranch($this);
			}
			$this->addComment($comment);
		}

		$this->collComments = $comments;
	}

	/**
	 * Returns the number of related Comment objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Comment objects.
	 * @throws     PropelException
	 */
	public function countComments(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collComments || null !== $criteria) {
			if ($this->isNew() && null === $this->collComments) {
				return 0;
			} else {
				$query = CommentQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByBranch($this)
					->count($con);
			}
		} else {
			return count($this->collComments);
		}
	}

	/**
	 * Method called to associate a Comment object to this object
	 * through the Comment foreign key attribute.
	 *
	 * @param      Comment $l Comment
	 * @return     Branch The current object (for fluent API support)
	 */
	public function addComment(Comment $l)
	{
		if ($this->collComments === null) {
			$this->initComments();
		}
		if (!$this->collComments->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddComment($l);
		}

		return $this;
	}

	/**
	 * @param	Comment $comment The comment object to add.
	 */
	protected function doAddComment($comment)
	{
		$this->collComments[]= $comment;
		$comment->setBranch($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Branch is new, it will return
	 * an empty collection; or if this Branch has previously
	 * been saved, it will retrieve related Comments from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Branch.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array Comment[] List of Comment objects
	 */
	public function getCommentsJoinsfGuardUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = CommentQuery::create(null, $criteria);
		$query->joinWith('sfGuardUser', $join_behavior);

		return $this->getComments($query, $con);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Branch is new, it will return
	 * an empty collection; or if this Branch has previously
	 * been saved, it will retrieve related Comments from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Branch.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array Comment[] List of Comment objects
	 */
	public function getCommentsJoinFile($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = CommentQuery::create(null, $criteria);
		$query->joinWith('File', $join_behavior);

		return $this->getComments($query, $con);
	}

	/**
	 * Clears out the collFiles collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addFiles()
	 */
	public function clearFiles()
	{
		$this->collFiles = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collFiles collection.
	 *
	 * By default this just sets the collFiles collection to an empty array (like clearcollFiles());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initFiles($overrideExisting = true)
	{
		if (null !== $this->collFiles && !$overrideExisting) {
			return;
		}
		$this->collFiles = new PropelObjectCollection();
		$this->collFiles->setModel('File');
	}

	/**
	 * Gets an array of File objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Branch is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array File[] List of File objects
	 * @throws     PropelException
	 */
	public function getFiles($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collFiles || null !== $criteria) {
			if ($this->isNew() && null === $this->collFiles) {
				// return empty collection
				$this->initFiles();
			} else {
				$collFiles = FileQuery::create(null, $criteria)
					->filterByBranch($this)
					->find($con);
				if (null !== $criteria) {
					return $collFiles;
				}
				$this->collFiles = $collFiles;
			}
		}
		return $this->collFiles;
	}

	/**
	 * Sets a collection of File objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $files A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setFiles(PropelCollection $files, PropelPDO $con = null)
	{
		$this->filesScheduledForDeletion = $this->getFiles(new Criteria(), $con)->diff($files);

		foreach ($files as $file) {
			// Fix issue with collection modified by reference
			if ($file->isNew()) {
				$file->setBranch($this);
			}
			$this->addFile($file);
		}

		$this->collFiles = $files;
	}

	/**
	 * Returns the number of related File objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related File objects.
	 * @throws     PropelException
	 */
	public function countFiles(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collFiles || null !== $criteria) {
			if ($this->isNew() && null === $this->collFiles) {
				return 0;
			} else {
				$query = FileQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByBranch($this)
					->count($con);
			}
		} else {
			return count($this->collFiles);
		}
	}

	/**
	 * Method called to associate a File object to this object
	 * through the File foreign key attribute.
	 *
	 * @param      File $l File
	 * @return     Branch The current object (for fluent API support)
	 */
	public function addFile(File $l)
	{
		if ($this->collFiles === null) {
			$this->initFiles();
		}
		if (!$this->collFiles->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddFile($l);
		}

		return $this;
	}

	/**
	 * @param	File $file The file object to add.
	 */
	protected function doAddFile($file)
	{
		$this->collFiles[]= $file;
		$file->setBranch($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Branch is new, it will return
	 * an empty collection; or if this Branch has previously
	 * been saved, it will retrieve related Files from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Branch.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array File[] List of File objects
	 */
	public function getFilesJoinsfGuardUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = FileQuery::create(null, $criteria);
		$query->joinWith('sfGuardUser', $join_behavior);

		return $this->getFiles($query, $con);
	}

	/**
	 * Clears out the collStatusActions collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addStatusActions()
	 */
	public function clearStatusActions()
	{
		$this->collStatusActions = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collStatusActions collection.
	 *
	 * By default this just sets the collStatusActions collection to an empty array (like clearcollStatusActions());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initStatusActions($overrideExisting = true)
	{
		if (null !== $this->collStatusActions && !$overrideExisting) {
			return;
		}
		$this->collStatusActions = new PropelObjectCollection();
		$this->collStatusActions->setModel('StatusAction');
	}

	/**
	 * Gets an array of StatusAction objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Branch is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array StatusAction[] List of StatusAction objects
	 * @throws     PropelException
	 */
	public function getStatusActions($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collStatusActions || null !== $criteria) {
			if ($this->isNew() && null === $this->collStatusActions) {
				// return empty collection
				$this->initStatusActions();
			} else {
				$collStatusActions = StatusActionQuery::create(null, $criteria)
					->filterByBranch($this)
					->find($con);
				if (null !== $criteria) {
					return $collStatusActions;
				}
				$this->collStatusActions = $collStatusActions;
			}
		}
		return $this->collStatusActions;
	}

	/**
	 * Sets a collection of StatusAction objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $statusActions A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setStatusActions(PropelCollection $statusActions, PropelPDO $con = null)
	{
		$this->statusActionsScheduledForDeletion = $this->getStatusActions(new Criteria(), $con)->diff($statusActions);

		foreach ($statusActions as $statusAction) {
			// Fix issue with collection modified by reference
			if ($statusAction->isNew()) {
				$statusAction->setBranch($this);
			}
			$this->addStatusAction($statusAction);
		}

		$this->collStatusActions = $statusActions;
	}

	/**
	 * Returns the number of related StatusAction objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related StatusAction objects.
	 * @throws     PropelException
	 */
	public function countStatusActions(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collStatusActions || null !== $criteria) {
			if ($this->isNew() && null === $this->collStatusActions) {
				return 0;
			} else {
				$query = StatusActionQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByBranch($this)
					->count($con);
			}
		} else {
			return count($this->collStatusActions);
		}
	}

	/**
	 * Method called to associate a StatusAction object to this object
	 * through the StatusAction foreign key attribute.
	 *
	 * @param      StatusAction $l StatusAction
	 * @return     Branch The current object (for fluent API support)
	 */
	public function addStatusAction(StatusAction $l)
	{
		if ($this->collStatusActions === null) {
			$this->initStatusActions();
		}
		if (!$this->collStatusActions->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddStatusAction($l);
		}

		return $this;
	}

	/**
	 * @param	StatusAction $statusAction The statusAction object to add.
	 */
	protected function doAddStatusAction($statusAction)
	{
		$this->collStatusActions[]= $statusAction;
		$statusAction->setBranch($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Branch is new, it will return
	 * an empty collection; or if this Branch has previously
	 * been saved, it will retrieve related StatusActions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Branch.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array StatusAction[] List of StatusAction objects
	 */
	public function getStatusActionsJoinsfGuardUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = StatusActionQuery::create(null, $criteria);
		$query->joinWith('sfGuardUser', $join_behavior);

		return $this->getStatusActions($query, $con);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Branch is new, it will return
	 * an empty collection; or if this Branch has previously
	 * been saved, it will retrieve related StatusActions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Branch.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array StatusAction[] List of StatusAction objects
	 */
	public function getStatusActionsJoinRepository($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = StatusActionQuery::create(null, $criteria);
		$query->joinWith('Repository', $join_behavior);

		return $this->getStatusActions($query, $con);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Branch is new, it will return
	 * an empty collection; or if this Branch has previously
	 * been saved, it will retrieve related StatusActions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Branch.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array StatusAction[] List of StatusAction objects
	 */
	public function getStatusActionsJoinFile($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = StatusActionQuery::create(null, $criteria);
		$query->joinWith('File', $join_behavior);

		return $this->getStatusActions($query, $con);
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->id = null;
		$this->repository_id = null;
		$this->name = null;
		$this->base_branch_name = null;
		$this->commit_reference = null;
		$this->last_commit = null;
		$this->last_commit_desc = null;
		$this->is_blacklisted = null;
		$this->review_request = null;
		$this->status = null;
		$this->commit_status_changed = null;
		$this->user_status_changed = null;
		$this->date_status_changed = null;
		$this->created_at = null;
		$this->updated_at = null;
		$this->alreadyInSave = false;
		$this->alreadyInValidation = false;
		$this->clearAllReferences();
		$this->applyDefaultValues();
		$this->resetModified();
		$this->setNew(true);
		$this->setDeleted(false);
	}

	/**
	 * Resets all references to other model objects or collections of model objects.
	 *
	 * This method is a user-space workaround for PHP's inability to garbage collect
	 * objects with circular references (even in PHP 5.3). This is currently necessary
	 * when using Propel in certain daemon or large-volumne/high-memory operations.
	 *
	 * @param      boolean $deep Whether to also clear the references on all referrer objects.
	 */
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collComments) {
				foreach ($this->collComments as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collFiles) {
				foreach ($this->collFiles as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collStatusActions) {
				foreach ($this->collStatusActions as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		if ($this->collComments instanceof PropelCollection) {
			$this->collComments->clearIterator();
		}
		$this->collComments = null;
		if ($this->collFiles instanceof PropelCollection) {
			$this->collFiles->clearIterator();
		}
		$this->collFiles = null;
		if ($this->collStatusActions instanceof PropelCollection) {
			$this->collStatusActions->clearIterator();
		}
		$this->collStatusActions = null;
		$this->aRepository = null;
		$this->asfGuardUser = null;
	}

	/**
	 * Return the string representation of this object
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->exportTo(BranchPeer::DEFAULT_STRING_FORMAT);
	}

	/**
	 * Catches calls to virtual methods
	 */
	public function __call($name, $params)
	{
		
		// symfony_behaviors behavior
		if ($callable = sfMixer::getCallable('BaseBranch:' . $name))
		{
		  array_unshift($params, $this);
		  return call_user_func_array($callable, $params);
		}

		return parent::__call($name, $params);
	}

} // BaseBranch
