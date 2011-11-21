<?php


/**
 * Base class that represents a row from the 'sf_guard_user' table.
 *
 * 
 *
 * @package    propel.generator.plugins.sfGuardPlugin.lib.model.om
 */
abstract class BasesfGuardUser extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'sfGuardUserPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        sfGuardUserPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the username field.
	 * @var        string
	 */
	protected $username;

	/**
	 * The value for the algorithm field.
	 * Note: this column has a database default value of: 'sha1'
	 * @var        string
	 */
	protected $algorithm;

	/**
	 * The value for the salt field.
	 * @var        string
	 */
	protected $salt;

	/**
	 * The value for the password field.
	 * @var        string
	 */
	protected $password;

	/**
	 * The value for the created_at field.
	 * @var        string
	 */
	protected $created_at;

	/**
	 * The value for the last_login field.
	 * @var        string
	 */
	protected $last_login;

	/**
	 * The value for the is_active field.
	 * Note: this column has a database default value of: true
	 * @var        boolean
	 */
	protected $is_active;

	/**
	 * The value for the is_super_admin field.
	 * Note: this column has a database default value of: false
	 * @var        boolean
	 */
	protected $is_super_admin;

	/**
	 * @var        array Branch[] Collection to store aggregation of Branch objects.
	 */
	protected $collBranchs;

	/**
	 * @var        array Comment[] Collection to store aggregation of Comment objects.
	 */
	protected $collComments;

	/**
	 * @var        array File[] Collection to store aggregation of File objects.
	 */
	protected $collFiles;

	/**
	 * @var        array Profile[] Collection to store aggregation of Profile objects.
	 */
	protected $collProfiles;

	/**
	 * @var        array StatusAction[] Collection to store aggregation of StatusAction objects.
	 */
	protected $collStatusActions;

	/**
	 * @var        array sfGuardUserPermission[] Collection to store aggregation of sfGuardUserPermission objects.
	 */
	protected $collsfGuardUserPermissions;

	/**
	 * @var        array sfGuardUserGroup[] Collection to store aggregation of sfGuardUserGroup objects.
	 */
	protected $collsfGuardUserGroups;

	/**
	 * @var        array sfGuardRememberKey[] Collection to store aggregation of sfGuardRememberKey objects.
	 */
	protected $collsfGuardRememberKeys;

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
	protected $branchsScheduledForDeletion = null;

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
	protected $profilesScheduledForDeletion = null;

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $statusActionsScheduledForDeletion = null;

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $sfGuardUserPermissionsScheduledForDeletion = null;

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $sfGuardUserGroupsScheduledForDeletion = null;

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $sfGuardRememberKeysScheduledForDeletion = null;

	/**
	 * Applies default values to this object.
	 * This method should be called from the object's constructor (or
	 * equivalent initialization method).
	 * @see        __construct()
	 */
	public function applyDefaultValues()
	{
		$this->algorithm = 'sha1';
		$this->is_active = true;
		$this->is_super_admin = false;
	}

	/**
	 * Initializes internal state of BasesfGuardUser object.
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
	 * Get the [username] column value.
	 * 
	 * @return     string
	 */
	public function getUsername()
	{
		return $this->username;
	}

	/**
	 * Get the [algorithm] column value.
	 * 
	 * @return     string
	 */
	public function getAlgorithm()
	{
		return $this->algorithm;
	}

	/**
	 * Get the [salt] column value.
	 * 
	 * @return     string
	 */
	public function getSalt()
	{
		return $this->salt;
	}

	/**
	 * Get the [password] column value.
	 * 
	 * @return     string
	 */
	public function getPassword()
	{
		return $this->password;
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
	 * Get the [optionally formatted] temporal [last_login] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getLastLogin($format = 'Y-m-d H:i:s')
	{
		if ($this->last_login === null) {
			return null;
		}


		if ($this->last_login === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->last_login);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->last_login, true), $x);
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
	 * Get the [is_active] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsActive()
	{
		return $this->is_active;
	}

	/**
	 * Get the [is_super_admin] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsSuperAdmin()
	{
		return $this->is_super_admin;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     sfGuardUser The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = sfGuardUserPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [username] column.
	 * 
	 * @param      string $v new value
	 * @return     sfGuardUser The current object (for fluent API support)
	 */
	public function setUsername($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->username !== $v) {
			$this->username = $v;
			$this->modifiedColumns[] = sfGuardUserPeer::USERNAME;
		}

		return $this;
	} // setUsername()

	/**
	 * Set the value of [algorithm] column.
	 * 
	 * @param      string $v new value
	 * @return     sfGuardUser The current object (for fluent API support)
	 */
	public function setAlgorithm($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->algorithm !== $v) {
			$this->algorithm = $v;
			$this->modifiedColumns[] = sfGuardUserPeer::ALGORITHM;
		}

		return $this;
	} // setAlgorithm()

	/**
	 * Set the value of [salt] column.
	 * 
	 * @param      string $v new value
	 * @return     sfGuardUser The current object (for fluent API support)
	 */
	public function setSalt($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->salt !== $v) {
			$this->salt = $v;
			$this->modifiedColumns[] = sfGuardUserPeer::SALT;
		}

		return $this;
	} // setSalt()

	/**
	 * Set the value of [password] column.
	 * 
	 * @param      string $v new value
	 * @return     sfGuardUser The current object (for fluent API support)
	 */
	public function setPassword($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->password !== $v) {
			$this->password = $v;
			$this->modifiedColumns[] = sfGuardUserPeer::PASSWORD;
		}

		return $this;
	} // setPassword()

	/**
	 * Sets the value of [created_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.
	 *               Empty strings are treated as NULL.
	 * @return     sfGuardUser The current object (for fluent API support)
	 */
	public function setCreatedAt($v)
	{
		$dt = PropelDateTime::newInstance($v, null, 'DateTime');
		if ($this->created_at !== null || $dt !== null) {
			$currentDateAsString = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
			if ($currentDateAsString !== $newDateAsString) {
				$this->created_at = $newDateAsString;
				$this->modifiedColumns[] = sfGuardUserPeer::CREATED_AT;
			}
		} // if either are not null

		return $this;
	} // setCreatedAt()

	/**
	 * Sets the value of [last_login] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.
	 *               Empty strings are treated as NULL.
	 * @return     sfGuardUser The current object (for fluent API support)
	 */
	public function setLastLogin($v)
	{
		$dt = PropelDateTime::newInstance($v, null, 'DateTime');
		if ($this->last_login !== null || $dt !== null) {
			$currentDateAsString = ($this->last_login !== null && $tmpDt = new DateTime($this->last_login)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
			if ($currentDateAsString !== $newDateAsString) {
				$this->last_login = $newDateAsString;
				$this->modifiedColumns[] = sfGuardUserPeer::LAST_LOGIN;
			}
		} // if either are not null

		return $this;
	} // setLastLogin()

	/**
	 * Sets the value of the [is_active] column.
	 * Non-boolean arguments are converted using the following rules:
	 *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
	 *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
	 * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
	 * 
	 * @param      boolean|integer|string $v The new value
	 * @return     sfGuardUser The current object (for fluent API support)
	 */
	public function setIsActive($v)
	{
		if ($v !== null) {
			if (is_string($v)) {
				$v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
			} else {
				$v = (boolean) $v;
			}
		}

		if ($this->is_active !== $v) {
			$this->is_active = $v;
			$this->modifiedColumns[] = sfGuardUserPeer::IS_ACTIVE;
		}

		return $this;
	} // setIsActive()

	/**
	 * Sets the value of the [is_super_admin] column.
	 * Non-boolean arguments are converted using the following rules:
	 *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
	 *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
	 * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
	 * 
	 * @param      boolean|integer|string $v The new value
	 * @return     sfGuardUser The current object (for fluent API support)
	 */
	public function setIsSuperAdmin($v)
	{
		if ($v !== null) {
			if (is_string($v)) {
				$v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
			} else {
				$v = (boolean) $v;
			}
		}

		if ($this->is_super_admin !== $v) {
			$this->is_super_admin = $v;
			$this->modifiedColumns[] = sfGuardUserPeer::IS_SUPER_ADMIN;
		}

		return $this;
	} // setIsSuperAdmin()

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
			if ($this->algorithm !== 'sha1') {
				return false;
			}

			if ($this->is_active !== true) {
				return false;
			}

			if ($this->is_super_admin !== false) {
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
			$this->username = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->algorithm = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->salt = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->password = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->created_at = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->last_login = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->is_active = ($row[$startcol + 7] !== null) ? (boolean) $row[$startcol + 7] : null;
			$this->is_super_admin = ($row[$startcol + 8] !== null) ? (boolean) $row[$startcol + 8] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 9; // 9 = sfGuardUserPeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating sfGuardUser object", $e);
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
			$con = Propel::getConnection(sfGuardUserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = sfGuardUserPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->collBranchs = null;

			$this->collComments = null;

			$this->collFiles = null;

			$this->collProfiles = null;

			$this->collStatusActions = null;

			$this->collsfGuardUserPermissions = null;

			$this->collsfGuardUserGroups = null;

			$this->collsfGuardRememberKeys = null;

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
			$con = Propel::getConnection(sfGuardUserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$deleteQuery = sfGuardUserQuery::create()
				->filterByPrimaryKey($this->getPrimaryKey());
			$ret = $this->preDelete($con);
			// symfony_behaviors behavior
			foreach (sfMixer::getCallables('BasesfGuardUser:delete:pre') as $callable)
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
				foreach (sfMixer::getCallables('BasesfGuardUser:delete:post') as $callable)
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
			$con = Propel::getConnection(sfGuardUserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		$isInsert = $this->isNew();
		try {
			$ret = $this->preSave($con);
			// symfony_behaviors behavior
			foreach (sfMixer::getCallables('BasesfGuardUser:save:pre') as $callable)
			{
			  if (is_integer($affectedRows = call_user_func($callable, $this, $con)))
			  {
			  	$con->commit();
			    return $affectedRows;
			  }
			}

			if ($isInsert) {
				$ret = $ret && $this->preInsert($con);
				// symfony_timestampable behavior
				if (!$this->isColumnModified(sfGuardUserPeer::CREATED_AT))
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
				foreach (sfMixer::getCallables('BasesfGuardUser:save:post') as $callable)
				{
				  call_user_func($callable, $this, $con, $affectedRows);
				}

				sfGuardUserPeer::addInstanceToPool($this);
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

			if ($this->branchsScheduledForDeletion !== null) {
				if (!$this->branchsScheduledForDeletion->isEmpty()) {
					BranchQuery::create()
						->filterByPrimaryKeys($this->branchsScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->branchsScheduledForDeletion = null;
				}
			}

			if ($this->collBranchs !== null) {
				foreach ($this->collBranchs as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
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

			if ($this->profilesScheduledForDeletion !== null) {
				if (!$this->profilesScheduledForDeletion->isEmpty()) {
					ProfileQuery::create()
						->filterByPrimaryKeys($this->profilesScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->profilesScheduledForDeletion = null;
				}
			}

			if ($this->collProfiles !== null) {
				foreach ($this->collProfiles as $referrerFK) {
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

			if ($this->sfGuardUserPermissionsScheduledForDeletion !== null) {
				if (!$this->sfGuardUserPermissionsScheduledForDeletion->isEmpty()) {
					sfGuardUserPermissionQuery::create()
						->filterByPrimaryKeys($this->sfGuardUserPermissionsScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->sfGuardUserPermissionsScheduledForDeletion = null;
				}
			}

			if ($this->collsfGuardUserPermissions !== null) {
				foreach ($this->collsfGuardUserPermissions as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->sfGuardUserGroupsScheduledForDeletion !== null) {
				if (!$this->sfGuardUserGroupsScheduledForDeletion->isEmpty()) {
					sfGuardUserGroupQuery::create()
						->filterByPrimaryKeys($this->sfGuardUserGroupsScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->sfGuardUserGroupsScheduledForDeletion = null;
				}
			}

			if ($this->collsfGuardUserGroups !== null) {
				foreach ($this->collsfGuardUserGroups as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->sfGuardRememberKeysScheduledForDeletion !== null) {
				if (!$this->sfGuardRememberKeysScheduledForDeletion->isEmpty()) {
					sfGuardRememberKeyQuery::create()
						->filterByPrimaryKeys($this->sfGuardRememberKeysScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->sfGuardRememberKeysScheduledForDeletion = null;
				}
			}

			if ($this->collsfGuardRememberKeys !== null) {
				foreach ($this->collsfGuardRememberKeys as $referrerFK) {
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

		$this->modifiedColumns[] = sfGuardUserPeer::ID;
		if (null !== $this->id) {
			throw new PropelException('Cannot insert a value for auto-increment primary key (' . sfGuardUserPeer::ID . ')');
		}

		 // check the columns in natural order for more readable SQL queries
		if ($this->isColumnModified(sfGuardUserPeer::ID)) {
			$modifiedColumns[':p' . $index++]  = '`ID`';
		}
		if ($this->isColumnModified(sfGuardUserPeer::USERNAME)) {
			$modifiedColumns[':p' . $index++]  = '`USERNAME`';
		}
		if ($this->isColumnModified(sfGuardUserPeer::ALGORITHM)) {
			$modifiedColumns[':p' . $index++]  = '`ALGORITHM`';
		}
		if ($this->isColumnModified(sfGuardUserPeer::SALT)) {
			$modifiedColumns[':p' . $index++]  = '`SALT`';
		}
		if ($this->isColumnModified(sfGuardUserPeer::PASSWORD)) {
			$modifiedColumns[':p' . $index++]  = '`PASSWORD`';
		}
		if ($this->isColumnModified(sfGuardUserPeer::CREATED_AT)) {
			$modifiedColumns[':p' . $index++]  = '`CREATED_AT`';
		}
		if ($this->isColumnModified(sfGuardUserPeer::LAST_LOGIN)) {
			$modifiedColumns[':p' . $index++]  = '`LAST_LOGIN`';
		}
		if ($this->isColumnModified(sfGuardUserPeer::IS_ACTIVE)) {
			$modifiedColumns[':p' . $index++]  = '`IS_ACTIVE`';
		}
		if ($this->isColumnModified(sfGuardUserPeer::IS_SUPER_ADMIN)) {
			$modifiedColumns[':p' . $index++]  = '`IS_SUPER_ADMIN`';
		}

		$sql = sprintf(
			'INSERT INTO `sf_guard_user` (%s) VALUES (%s)',
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
					case '`USERNAME`':
						$stmt->bindValue($identifier, $this->username, PDO::PARAM_STR);
						break;
					case '`ALGORITHM`':
						$stmt->bindValue($identifier, $this->algorithm, PDO::PARAM_STR);
						break;
					case '`SALT`':
						$stmt->bindValue($identifier, $this->salt, PDO::PARAM_STR);
						break;
					case '`PASSWORD`':
						$stmt->bindValue($identifier, $this->password, PDO::PARAM_STR);
						break;
					case '`CREATED_AT`':
						$stmt->bindValue($identifier, $this->created_at, PDO::PARAM_STR);
						break;
					case '`LAST_LOGIN`':
						$stmt->bindValue($identifier, $this->last_login, PDO::PARAM_STR);
						break;
					case '`IS_ACTIVE`':
						$stmt->bindValue($identifier, (int) $this->is_active, PDO::PARAM_INT);
						break;
					case '`IS_SUPER_ADMIN`':
						$stmt->bindValue($identifier, (int) $this->is_super_admin, PDO::PARAM_INT);
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


			if (($retval = sfGuardUserPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collBranchs !== null) {
					foreach ($this->collBranchs as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
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

				if ($this->collProfiles !== null) {
					foreach ($this->collProfiles as $referrerFK) {
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

				if ($this->collsfGuardUserPermissions !== null) {
					foreach ($this->collsfGuardUserPermissions as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collsfGuardUserGroups !== null) {
					foreach ($this->collsfGuardUserGroups as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collsfGuardRememberKeys !== null) {
					foreach ($this->collsfGuardRememberKeys as $referrerFK) {
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
		$pos = sfGuardUserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getUsername();
				break;
			case 2:
				return $this->getAlgorithm();
				break;
			case 3:
				return $this->getSalt();
				break;
			case 4:
				return $this->getPassword();
				break;
			case 5:
				return $this->getCreatedAt();
				break;
			case 6:
				return $this->getLastLogin();
				break;
			case 7:
				return $this->getIsActive();
				break;
			case 8:
				return $this->getIsSuperAdmin();
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
		if (isset($alreadyDumpedObjects['sfGuardUser'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['sfGuardUser'][$this->getPrimaryKey()] = true;
		$keys = sfGuardUserPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getUsername(),
			$keys[2] => $this->getAlgorithm(),
			$keys[3] => $this->getSalt(),
			$keys[4] => $this->getPassword(),
			$keys[5] => $this->getCreatedAt(),
			$keys[6] => $this->getLastLogin(),
			$keys[7] => $this->getIsActive(),
			$keys[8] => $this->getIsSuperAdmin(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->collBranchs) {
				$result['Branchs'] = $this->collBranchs->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collComments) {
				$result['Comments'] = $this->collComments->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collFiles) {
				$result['Files'] = $this->collFiles->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collProfiles) {
				$result['Profiles'] = $this->collProfiles->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collStatusActions) {
				$result['StatusActions'] = $this->collStatusActions->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collsfGuardUserPermissions) {
				$result['sfGuardUserPermissions'] = $this->collsfGuardUserPermissions->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collsfGuardUserGroups) {
				$result['sfGuardUserGroups'] = $this->collsfGuardUserGroups->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collsfGuardRememberKeys) {
				$result['sfGuardRememberKeys'] = $this->collsfGuardRememberKeys->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
		$pos = sfGuardUserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setUsername($value);
				break;
			case 2:
				$this->setAlgorithm($value);
				break;
			case 3:
				$this->setSalt($value);
				break;
			case 4:
				$this->setPassword($value);
				break;
			case 5:
				$this->setCreatedAt($value);
				break;
			case 6:
				$this->setLastLogin($value);
				break;
			case 7:
				$this->setIsActive($value);
				break;
			case 8:
				$this->setIsSuperAdmin($value);
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
		$keys = sfGuardUserPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setUsername($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setAlgorithm($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setSalt($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setPassword($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCreatedAt($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setLastLogin($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setIsActive($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setIsSuperAdmin($arr[$keys[8]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);

		if ($this->isColumnModified(sfGuardUserPeer::ID)) $criteria->add(sfGuardUserPeer::ID, $this->id);
		if ($this->isColumnModified(sfGuardUserPeer::USERNAME)) $criteria->add(sfGuardUserPeer::USERNAME, $this->username);
		if ($this->isColumnModified(sfGuardUserPeer::ALGORITHM)) $criteria->add(sfGuardUserPeer::ALGORITHM, $this->algorithm);
		if ($this->isColumnModified(sfGuardUserPeer::SALT)) $criteria->add(sfGuardUserPeer::SALT, $this->salt);
		if ($this->isColumnModified(sfGuardUserPeer::PASSWORD)) $criteria->add(sfGuardUserPeer::PASSWORD, $this->password);
		if ($this->isColumnModified(sfGuardUserPeer::CREATED_AT)) $criteria->add(sfGuardUserPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(sfGuardUserPeer::LAST_LOGIN)) $criteria->add(sfGuardUserPeer::LAST_LOGIN, $this->last_login);
		if ($this->isColumnModified(sfGuardUserPeer::IS_ACTIVE)) $criteria->add(sfGuardUserPeer::IS_ACTIVE, $this->is_active);
		if ($this->isColumnModified(sfGuardUserPeer::IS_SUPER_ADMIN)) $criteria->add(sfGuardUserPeer::IS_SUPER_ADMIN, $this->is_super_admin);

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
		$criteria = new Criteria(sfGuardUserPeer::DATABASE_NAME);
		$criteria->add(sfGuardUserPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of sfGuardUser (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setUsername($this->getUsername());
		$copyObj->setAlgorithm($this->getAlgorithm());
		$copyObj->setSalt($this->getSalt());
		$copyObj->setPassword($this->getPassword());
		$copyObj->setCreatedAt($this->getCreatedAt());
		$copyObj->setLastLogin($this->getLastLogin());
		$copyObj->setIsActive($this->getIsActive());
		$copyObj->setIsSuperAdmin($this->getIsSuperAdmin());

		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getBranchs() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addBranch($relObj->copy($deepCopy));
				}
			}

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

			foreach ($this->getProfiles() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addProfile($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getStatusActions() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addStatusAction($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getsfGuardUserPermissions() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addsfGuardUserPermission($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getsfGuardUserGroups() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addsfGuardUserGroup($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getsfGuardRememberKeys() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addsfGuardRememberKey($relObj->copy($deepCopy));
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
	 * @return     sfGuardUser Clone of current object.
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
	 * @return     sfGuardUserPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new sfGuardUserPeer();
		}
		return self::$peer;
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
		if ('Branch' == $relationName) {
			return $this->initBranchs();
		}
		if ('Comment' == $relationName) {
			return $this->initComments();
		}
		if ('File' == $relationName) {
			return $this->initFiles();
		}
		if ('Profile' == $relationName) {
			return $this->initProfiles();
		}
		if ('StatusAction' == $relationName) {
			return $this->initStatusActions();
		}
		if ('sfGuardUserPermission' == $relationName) {
			return $this->initsfGuardUserPermissions();
		}
		if ('sfGuardUserGroup' == $relationName) {
			return $this->initsfGuardUserGroups();
		}
		if ('sfGuardRememberKey' == $relationName) {
			return $this->initsfGuardRememberKeys();
		}
	}

	/**
	 * Clears out the collBranchs collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addBranchs()
	 */
	public function clearBranchs()
	{
		$this->collBranchs = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collBranchs collection.
	 *
	 * By default this just sets the collBranchs collection to an empty array (like clearcollBranchs());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initBranchs($overrideExisting = true)
	{
		if (null !== $this->collBranchs && !$overrideExisting) {
			return;
		}
		$this->collBranchs = new PropelObjectCollection();
		$this->collBranchs->setModel('Branch');
	}

	/**
	 * Gets an array of Branch objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this sfGuardUser is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array Branch[] List of Branch objects
	 * @throws     PropelException
	 */
	public function getBranchs($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collBranchs || null !== $criteria) {
			if ($this->isNew() && null === $this->collBranchs) {
				// return empty collection
				$this->initBranchs();
			} else {
				$collBranchs = BranchQuery::create(null, $criteria)
					->filterBysfGuardUser($this)
					->find($con);
				if (null !== $criteria) {
					return $collBranchs;
				}
				$this->collBranchs = $collBranchs;
			}
		}
		return $this->collBranchs;
	}

	/**
	 * Sets a collection of Branch objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $branchs A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setBranchs(PropelCollection $branchs, PropelPDO $con = null)
	{
		$this->branchsScheduledForDeletion = $this->getBranchs(new Criteria(), $con)->diff($branchs);

		foreach ($branchs as $branch) {
			// Fix issue with collection modified by reference
			if ($branch->isNew()) {
				$branch->setsfGuardUser($this);
			}
			$this->addBranch($branch);
		}

		$this->collBranchs = $branchs;
	}

	/**
	 * Returns the number of related Branch objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Branch objects.
	 * @throws     PropelException
	 */
	public function countBranchs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collBranchs || null !== $criteria) {
			if ($this->isNew() && null === $this->collBranchs) {
				return 0;
			} else {
				$query = BranchQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterBysfGuardUser($this)
					->count($con);
			}
		} else {
			return count($this->collBranchs);
		}
	}

	/**
	 * Method called to associate a Branch object to this object
	 * through the Branch foreign key attribute.
	 *
	 * @param      Branch $l Branch
	 * @return     sfGuardUser The current object (for fluent API support)
	 */
	public function addBranch(Branch $l)
	{
		if ($this->collBranchs === null) {
			$this->initBranchs();
		}
		if (!$this->collBranchs->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddBranch($l);
		}

		return $this;
	}

	/**
	 * @param	Branch $branch The branch object to add.
	 */
	protected function doAddBranch($branch)
	{
		$this->collBranchs[]= $branch;
		$branch->setsfGuardUser($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfGuardUser is new, it will return
	 * an empty collection; or if this sfGuardUser has previously
	 * been saved, it will retrieve related Branchs from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfGuardUser.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array Branch[] List of Branch objects
	 */
	public function getBranchsJoinRepository($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = BranchQuery::create(null, $criteria);
		$query->joinWith('Repository', $join_behavior);

		return $this->getBranchs($query, $con);
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
	 * If this sfGuardUser is new, it will return
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
					->filterBysfGuardUser($this)
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
				$comment->setsfGuardUser($this);
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
					->filterBysfGuardUser($this)
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
	 * @return     sfGuardUser The current object (for fluent API support)
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
		$comment->setsfGuardUser($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfGuardUser is new, it will return
	 * an empty collection; or if this sfGuardUser has previously
	 * been saved, it will retrieve related Comments from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfGuardUser.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array Comment[] List of Comment objects
	 */
	public function getCommentsJoinBranch($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = CommentQuery::create(null, $criteria);
		$query->joinWith('Branch', $join_behavior);

		return $this->getComments($query, $con);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfGuardUser is new, it will return
	 * an empty collection; or if this sfGuardUser has previously
	 * been saved, it will retrieve related Comments from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfGuardUser.
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
	 * If this sfGuardUser is new, it will return
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
					->filterBysfGuardUser($this)
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
				$file->setsfGuardUser($this);
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
					->filterBysfGuardUser($this)
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
	 * @return     sfGuardUser The current object (for fluent API support)
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
		$file->setsfGuardUser($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfGuardUser is new, it will return
	 * an empty collection; or if this sfGuardUser has previously
	 * been saved, it will retrieve related Files from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfGuardUser.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array File[] List of File objects
	 */
	public function getFilesJoinBranch($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = FileQuery::create(null, $criteria);
		$query->joinWith('Branch', $join_behavior);

		return $this->getFiles($query, $con);
	}

	/**
	 * Clears out the collProfiles collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addProfiles()
	 */
	public function clearProfiles()
	{
		$this->collProfiles = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collProfiles collection.
	 *
	 * By default this just sets the collProfiles collection to an empty array (like clearcollProfiles());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initProfiles($overrideExisting = true)
	{
		if (null !== $this->collProfiles && !$overrideExisting) {
			return;
		}
		$this->collProfiles = new PropelObjectCollection();
		$this->collProfiles->setModel('Profile');
	}

	/**
	 * Gets an array of Profile objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this sfGuardUser is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array Profile[] List of Profile objects
	 * @throws     PropelException
	 */
	public function getProfiles($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collProfiles || null !== $criteria) {
			if ($this->isNew() && null === $this->collProfiles) {
				// return empty collection
				$this->initProfiles();
			} else {
				$collProfiles = ProfileQuery::create(null, $criteria)
					->filterBysfGuardUser($this)
					->find($con);
				if (null !== $criteria) {
					return $collProfiles;
				}
				$this->collProfiles = $collProfiles;
			}
		}
		return $this->collProfiles;
	}

	/**
	 * Sets a collection of Profile objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $profiles A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setProfiles(PropelCollection $profiles, PropelPDO $con = null)
	{
		$this->profilesScheduledForDeletion = $this->getProfiles(new Criteria(), $con)->diff($profiles);

		foreach ($profiles as $profile) {
			// Fix issue with collection modified by reference
			if ($profile->isNew()) {
				$profile->setsfGuardUser($this);
			}
			$this->addProfile($profile);
		}

		$this->collProfiles = $profiles;
	}

	/**
	 * Returns the number of related Profile objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Profile objects.
	 * @throws     PropelException
	 */
	public function countProfiles(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collProfiles || null !== $criteria) {
			if ($this->isNew() && null === $this->collProfiles) {
				return 0;
			} else {
				$query = ProfileQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterBysfGuardUser($this)
					->count($con);
			}
		} else {
			return count($this->collProfiles);
		}
	}

	/**
	 * Method called to associate a Profile object to this object
	 * through the Profile foreign key attribute.
	 *
	 * @param      Profile $l Profile
	 * @return     sfGuardUser The current object (for fluent API support)
	 */
	public function addProfile(Profile $l)
	{
		if ($this->collProfiles === null) {
			$this->initProfiles();
		}
		if (!$this->collProfiles->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddProfile($l);
		}

		return $this;
	}

	/**
	 * @param	Profile $profile The profile object to add.
	 */
	protected function doAddProfile($profile)
	{
		$this->collProfiles[]= $profile;
		$profile->setsfGuardUser($this);
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
	 * If this sfGuardUser is new, it will return
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
					->filterBysfGuardUser($this)
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
				$statusAction->setsfGuardUser($this);
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
					->filterBysfGuardUser($this)
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
	 * @return     sfGuardUser The current object (for fluent API support)
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
		$statusAction->setsfGuardUser($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfGuardUser is new, it will return
	 * an empty collection; or if this sfGuardUser has previously
	 * been saved, it will retrieve related StatusActions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfGuardUser.
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
	 * Otherwise if this sfGuardUser is new, it will return
	 * an empty collection; or if this sfGuardUser has previously
	 * been saved, it will retrieve related StatusActions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfGuardUser.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array StatusAction[] List of StatusAction objects
	 */
	public function getStatusActionsJoinBranch($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = StatusActionQuery::create(null, $criteria);
		$query->joinWith('Branch', $join_behavior);

		return $this->getStatusActions($query, $con);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfGuardUser is new, it will return
	 * an empty collection; or if this sfGuardUser has previously
	 * been saved, it will retrieve related StatusActions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfGuardUser.
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
	 * Clears out the collsfGuardUserPermissions collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addsfGuardUserPermissions()
	 */
	public function clearsfGuardUserPermissions()
	{
		$this->collsfGuardUserPermissions = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collsfGuardUserPermissions collection.
	 *
	 * By default this just sets the collsfGuardUserPermissions collection to an empty array (like clearcollsfGuardUserPermissions());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initsfGuardUserPermissions($overrideExisting = true)
	{
		if (null !== $this->collsfGuardUserPermissions && !$overrideExisting) {
			return;
		}
		$this->collsfGuardUserPermissions = new PropelObjectCollection();
		$this->collsfGuardUserPermissions->setModel('sfGuardUserPermission');
	}

	/**
	 * Gets an array of sfGuardUserPermission objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this sfGuardUser is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array sfGuardUserPermission[] List of sfGuardUserPermission objects
	 * @throws     PropelException
	 */
	public function getsfGuardUserPermissions($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collsfGuardUserPermissions || null !== $criteria) {
			if ($this->isNew() && null === $this->collsfGuardUserPermissions) {
				// return empty collection
				$this->initsfGuardUserPermissions();
			} else {
				$collsfGuardUserPermissions = sfGuardUserPermissionQuery::create(null, $criteria)
					->filterBysfGuardUser($this)
					->find($con);
				if (null !== $criteria) {
					return $collsfGuardUserPermissions;
				}
				$this->collsfGuardUserPermissions = $collsfGuardUserPermissions;
			}
		}
		return $this->collsfGuardUserPermissions;
	}

	/**
	 * Sets a collection of sfGuardUserPermission objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $sfGuardUserPermissions A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setsfGuardUserPermissions(PropelCollection $sfGuardUserPermissions, PropelPDO $con = null)
	{
		$this->sfGuardUserPermissionsScheduledForDeletion = $this->getsfGuardUserPermissions(new Criteria(), $con)->diff($sfGuardUserPermissions);

		foreach ($sfGuardUserPermissions as $sfGuardUserPermission) {
			// Fix issue with collection modified by reference
			if ($sfGuardUserPermission->isNew()) {
				$sfGuardUserPermission->setsfGuardUser($this);
			}
			$this->addsfGuardUserPermission($sfGuardUserPermission);
		}

		$this->collsfGuardUserPermissions = $sfGuardUserPermissions;
	}

	/**
	 * Returns the number of related sfGuardUserPermission objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related sfGuardUserPermission objects.
	 * @throws     PropelException
	 */
	public function countsfGuardUserPermissions(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collsfGuardUserPermissions || null !== $criteria) {
			if ($this->isNew() && null === $this->collsfGuardUserPermissions) {
				return 0;
			} else {
				$query = sfGuardUserPermissionQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterBysfGuardUser($this)
					->count($con);
			}
		} else {
			return count($this->collsfGuardUserPermissions);
		}
	}

	/**
	 * Method called to associate a sfGuardUserPermission object to this object
	 * through the sfGuardUserPermission foreign key attribute.
	 *
	 * @param      sfGuardUserPermission $l sfGuardUserPermission
	 * @return     sfGuardUser The current object (for fluent API support)
	 */
	public function addsfGuardUserPermission(sfGuardUserPermission $l)
	{
		if ($this->collsfGuardUserPermissions === null) {
			$this->initsfGuardUserPermissions();
		}
		if (!$this->collsfGuardUserPermissions->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddsfGuardUserPermission($l);
		}

		return $this;
	}

	/**
	 * @param	sfGuardUserPermission $sfGuardUserPermission The sfGuardUserPermission object to add.
	 */
	protected function doAddsfGuardUserPermission($sfGuardUserPermission)
	{
		$this->collsfGuardUserPermissions[]= $sfGuardUserPermission;
		$sfGuardUserPermission->setsfGuardUser($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfGuardUser is new, it will return
	 * an empty collection; or if this sfGuardUser has previously
	 * been saved, it will retrieve related sfGuardUserPermissions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfGuardUser.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array sfGuardUserPermission[] List of sfGuardUserPermission objects
	 */
	public function getsfGuardUserPermissionsJoinsfGuardPermission($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = sfGuardUserPermissionQuery::create(null, $criteria);
		$query->joinWith('sfGuardPermission', $join_behavior);

		return $this->getsfGuardUserPermissions($query, $con);
	}

	/**
	 * Clears out the collsfGuardUserGroups collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addsfGuardUserGroups()
	 */
	public function clearsfGuardUserGroups()
	{
		$this->collsfGuardUserGroups = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collsfGuardUserGroups collection.
	 *
	 * By default this just sets the collsfGuardUserGroups collection to an empty array (like clearcollsfGuardUserGroups());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initsfGuardUserGroups($overrideExisting = true)
	{
		if (null !== $this->collsfGuardUserGroups && !$overrideExisting) {
			return;
		}
		$this->collsfGuardUserGroups = new PropelObjectCollection();
		$this->collsfGuardUserGroups->setModel('sfGuardUserGroup');
	}

	/**
	 * Gets an array of sfGuardUserGroup objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this sfGuardUser is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array sfGuardUserGroup[] List of sfGuardUserGroup objects
	 * @throws     PropelException
	 */
	public function getsfGuardUserGroups($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collsfGuardUserGroups || null !== $criteria) {
			if ($this->isNew() && null === $this->collsfGuardUserGroups) {
				// return empty collection
				$this->initsfGuardUserGroups();
			} else {
				$collsfGuardUserGroups = sfGuardUserGroupQuery::create(null, $criteria)
					->filterBysfGuardUser($this)
					->find($con);
				if (null !== $criteria) {
					return $collsfGuardUserGroups;
				}
				$this->collsfGuardUserGroups = $collsfGuardUserGroups;
			}
		}
		return $this->collsfGuardUserGroups;
	}

	/**
	 * Sets a collection of sfGuardUserGroup objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $sfGuardUserGroups A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setsfGuardUserGroups(PropelCollection $sfGuardUserGroups, PropelPDO $con = null)
	{
		$this->sfGuardUserGroupsScheduledForDeletion = $this->getsfGuardUserGroups(new Criteria(), $con)->diff($sfGuardUserGroups);

		foreach ($sfGuardUserGroups as $sfGuardUserGroup) {
			// Fix issue with collection modified by reference
			if ($sfGuardUserGroup->isNew()) {
				$sfGuardUserGroup->setsfGuardUser($this);
			}
			$this->addsfGuardUserGroup($sfGuardUserGroup);
		}

		$this->collsfGuardUserGroups = $sfGuardUserGroups;
	}

	/**
	 * Returns the number of related sfGuardUserGroup objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related sfGuardUserGroup objects.
	 * @throws     PropelException
	 */
	public function countsfGuardUserGroups(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collsfGuardUserGroups || null !== $criteria) {
			if ($this->isNew() && null === $this->collsfGuardUserGroups) {
				return 0;
			} else {
				$query = sfGuardUserGroupQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterBysfGuardUser($this)
					->count($con);
			}
		} else {
			return count($this->collsfGuardUserGroups);
		}
	}

	/**
	 * Method called to associate a sfGuardUserGroup object to this object
	 * through the sfGuardUserGroup foreign key attribute.
	 *
	 * @param      sfGuardUserGroup $l sfGuardUserGroup
	 * @return     sfGuardUser The current object (for fluent API support)
	 */
	public function addsfGuardUserGroup(sfGuardUserGroup $l)
	{
		if ($this->collsfGuardUserGroups === null) {
			$this->initsfGuardUserGroups();
		}
		if (!$this->collsfGuardUserGroups->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddsfGuardUserGroup($l);
		}

		return $this;
	}

	/**
	 * @param	sfGuardUserGroup $sfGuardUserGroup The sfGuardUserGroup object to add.
	 */
	protected function doAddsfGuardUserGroup($sfGuardUserGroup)
	{
		$this->collsfGuardUserGroups[]= $sfGuardUserGroup;
		$sfGuardUserGroup->setsfGuardUser($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfGuardUser is new, it will return
	 * an empty collection; or if this sfGuardUser has previously
	 * been saved, it will retrieve related sfGuardUserGroups from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfGuardUser.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array sfGuardUserGroup[] List of sfGuardUserGroup objects
	 */
	public function getsfGuardUserGroupsJoinsfGuardGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = sfGuardUserGroupQuery::create(null, $criteria);
		$query->joinWith('sfGuardGroup', $join_behavior);

		return $this->getsfGuardUserGroups($query, $con);
	}

	/**
	 * Clears out the collsfGuardRememberKeys collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addsfGuardRememberKeys()
	 */
	public function clearsfGuardRememberKeys()
	{
		$this->collsfGuardRememberKeys = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collsfGuardRememberKeys collection.
	 *
	 * By default this just sets the collsfGuardRememberKeys collection to an empty array (like clearcollsfGuardRememberKeys());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initsfGuardRememberKeys($overrideExisting = true)
	{
		if (null !== $this->collsfGuardRememberKeys && !$overrideExisting) {
			return;
		}
		$this->collsfGuardRememberKeys = new PropelObjectCollection();
		$this->collsfGuardRememberKeys->setModel('sfGuardRememberKey');
	}

	/**
	 * Gets an array of sfGuardRememberKey objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this sfGuardUser is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array sfGuardRememberKey[] List of sfGuardRememberKey objects
	 * @throws     PropelException
	 */
	public function getsfGuardRememberKeys($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collsfGuardRememberKeys || null !== $criteria) {
			if ($this->isNew() && null === $this->collsfGuardRememberKeys) {
				// return empty collection
				$this->initsfGuardRememberKeys();
			} else {
				$collsfGuardRememberKeys = sfGuardRememberKeyQuery::create(null, $criteria)
					->filterBysfGuardUser($this)
					->find($con);
				if (null !== $criteria) {
					return $collsfGuardRememberKeys;
				}
				$this->collsfGuardRememberKeys = $collsfGuardRememberKeys;
			}
		}
		return $this->collsfGuardRememberKeys;
	}

	/**
	 * Sets a collection of sfGuardRememberKey objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $sfGuardRememberKeys A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setsfGuardRememberKeys(PropelCollection $sfGuardRememberKeys, PropelPDO $con = null)
	{
		$this->sfGuardRememberKeysScheduledForDeletion = $this->getsfGuardRememberKeys(new Criteria(), $con)->diff($sfGuardRememberKeys);

		foreach ($sfGuardRememberKeys as $sfGuardRememberKey) {
			// Fix issue with collection modified by reference
			if ($sfGuardRememberKey->isNew()) {
				$sfGuardRememberKey->setsfGuardUser($this);
			}
			$this->addsfGuardRememberKey($sfGuardRememberKey);
		}

		$this->collsfGuardRememberKeys = $sfGuardRememberKeys;
	}

	/**
	 * Returns the number of related sfGuardRememberKey objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related sfGuardRememberKey objects.
	 * @throws     PropelException
	 */
	public function countsfGuardRememberKeys(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collsfGuardRememberKeys || null !== $criteria) {
			if ($this->isNew() && null === $this->collsfGuardRememberKeys) {
				return 0;
			} else {
				$query = sfGuardRememberKeyQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterBysfGuardUser($this)
					->count($con);
			}
		} else {
			return count($this->collsfGuardRememberKeys);
		}
	}

	/**
	 * Method called to associate a sfGuardRememberKey object to this object
	 * through the sfGuardRememberKey foreign key attribute.
	 *
	 * @param      sfGuardRememberKey $l sfGuardRememberKey
	 * @return     sfGuardUser The current object (for fluent API support)
	 */
	public function addsfGuardRememberKey(sfGuardRememberKey $l)
	{
		if ($this->collsfGuardRememberKeys === null) {
			$this->initsfGuardRememberKeys();
		}
		if (!$this->collsfGuardRememberKeys->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddsfGuardRememberKey($l);
		}

		return $this;
	}

	/**
	 * @param	sfGuardRememberKey $sfGuardRememberKey The sfGuardRememberKey object to add.
	 */
	protected function doAddsfGuardRememberKey($sfGuardRememberKey)
	{
		$this->collsfGuardRememberKeys[]= $sfGuardRememberKey;
		$sfGuardRememberKey->setsfGuardUser($this);
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->id = null;
		$this->username = null;
		$this->algorithm = null;
		$this->salt = null;
		$this->password = null;
		$this->created_at = null;
		$this->last_login = null;
		$this->is_active = null;
		$this->is_super_admin = null;
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
			if ($this->collBranchs) {
				foreach ($this->collBranchs as $o) {
					$o->clearAllReferences($deep);
				}
			}
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
			if ($this->collProfiles) {
				foreach ($this->collProfiles as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collStatusActions) {
				foreach ($this->collStatusActions as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collsfGuardUserPermissions) {
				foreach ($this->collsfGuardUserPermissions as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collsfGuardUserGroups) {
				foreach ($this->collsfGuardUserGroups as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collsfGuardRememberKeys) {
				foreach ($this->collsfGuardRememberKeys as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		if ($this->collBranchs instanceof PropelCollection) {
			$this->collBranchs->clearIterator();
		}
		$this->collBranchs = null;
		if ($this->collComments instanceof PropelCollection) {
			$this->collComments->clearIterator();
		}
		$this->collComments = null;
		if ($this->collFiles instanceof PropelCollection) {
			$this->collFiles->clearIterator();
		}
		$this->collFiles = null;
		if ($this->collProfiles instanceof PropelCollection) {
			$this->collProfiles->clearIterator();
		}
		$this->collProfiles = null;
		if ($this->collStatusActions instanceof PropelCollection) {
			$this->collStatusActions->clearIterator();
		}
		$this->collStatusActions = null;
		if ($this->collsfGuardUserPermissions instanceof PropelCollection) {
			$this->collsfGuardUserPermissions->clearIterator();
		}
		$this->collsfGuardUserPermissions = null;
		if ($this->collsfGuardUserGroups instanceof PropelCollection) {
			$this->collsfGuardUserGroups->clearIterator();
		}
		$this->collsfGuardUserGroups = null;
		if ($this->collsfGuardRememberKeys instanceof PropelCollection) {
			$this->collsfGuardRememberKeys->clearIterator();
		}
		$this->collsfGuardRememberKeys = null;
	}

	/**
	 * Return the string representation of this object
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->exportTo(sfGuardUserPeer::DEFAULT_STRING_FORMAT);
	}

	/**
	 * Catches calls to virtual methods
	 */
	public function __call($name, $params)
	{
		
		// symfony_behaviors behavior
		if ($callable = sfMixer::getCallable('BasesfGuardUser:' . $name))
		{
		  array_unshift($params, $this);
		  return call_user_func_array($callable, $params);
		}

		return parent::__call($name, $params);
	}

} // BasesfGuardUser
