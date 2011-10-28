<?php


/**
 * Base class that represents a row from the 'status_action' table.
 *
 * 
 *
 * @package    propel.generator.lib.model.om
 */
abstract class BaseStatusAction extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'StatusActionPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        StatusActionPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the user_id field.
	 * @var        int
	 */
	protected $user_id;

	/**
	 * The value for the repository_id field.
	 * @var        int
	 */
	protected $repository_id;

	/**
	 * The value for the branch_id field.
	 * @var        int
	 */
	protected $branch_id;

	/**
	 * The value for the file_id field.
	 * @var        int
	 */
	protected $file_id;

	/**
	 * The value for the message field.
	 * @var        string
	 */
	protected $message;

	/**
	 * The value for the old_status field.
	 * @var        int
	 */
	protected $old_status;

	/**
	 * The value for the new_status field.
	 * @var        int
	 */
	protected $new_status;

	/**
	 * The value for the created_at field.
	 * @var        string
	 */
	protected $created_at;

	/**
	 * @var        sfGuardUser
	 */
	protected $asfGuardUser;

	/**
	 * @var        Repository
	 */
	protected $aRepository;

	/**
	 * @var        Branch
	 */
	protected $aBranch;

	/**
	 * @var        File
	 */
	protected $aFile;

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
	 * Get the [id] column value.
	 * 
	 * @return     int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Get the [user_id] column value.
	 * 
	 * @return     int
	 */
	public function getUserId()
	{
		return $this->user_id;
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
	 * Get the [branch_id] column value.
	 * 
	 * @return     int
	 */
	public function getBranchId()
	{
		return $this->branch_id;
	}

	/**
	 * Get the [file_id] column value.
	 * 
	 * @return     int
	 */
	public function getFileId()
	{
		return $this->file_id;
	}

	/**
	 * Get the [message] column value.
	 * 
	 * @return     string
	 */
	public function getMessage()
	{
		return $this->message;
	}

	/**
	 * Get the [old_status] column value.
	 * 
	 * @return     int
	 */
	public function getOldStatus()
	{
		return $this->old_status;
	}

	/**
	 * Get the [new_status] column value.
	 * 
	 * @return     int
	 */
	public function getNewStatus()
	{
		return $this->new_status;
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
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     StatusAction The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = StatusActionPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [user_id] column.
	 * 
	 * @param      int $v new value
	 * @return     StatusAction The current object (for fluent API support)
	 */
	public function setUserId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->user_id !== $v) {
			$this->user_id = $v;
			$this->modifiedColumns[] = StatusActionPeer::USER_ID;
		}

		if ($this->asfGuardUser !== null && $this->asfGuardUser->getId() !== $v) {
			$this->asfGuardUser = null;
		}

		return $this;
	} // setUserId()

	/**
	 * Set the value of [repository_id] column.
	 * 
	 * @param      int $v new value
	 * @return     StatusAction The current object (for fluent API support)
	 */
	public function setRepositoryId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->repository_id !== $v) {
			$this->repository_id = $v;
			$this->modifiedColumns[] = StatusActionPeer::REPOSITORY_ID;
		}

		if ($this->aRepository !== null && $this->aRepository->getId() !== $v) {
			$this->aRepository = null;
		}

		return $this;
	} // setRepositoryId()

	/**
	 * Set the value of [branch_id] column.
	 * 
	 * @param      int $v new value
	 * @return     StatusAction The current object (for fluent API support)
	 */
	public function setBranchId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->branch_id !== $v) {
			$this->branch_id = $v;
			$this->modifiedColumns[] = StatusActionPeer::BRANCH_ID;
		}

		if ($this->aBranch !== null && $this->aBranch->getId() !== $v) {
			$this->aBranch = null;
		}

		return $this;
	} // setBranchId()

	/**
	 * Set the value of [file_id] column.
	 * 
	 * @param      int $v new value
	 * @return     StatusAction The current object (for fluent API support)
	 */
	public function setFileId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->file_id !== $v) {
			$this->file_id = $v;
			$this->modifiedColumns[] = StatusActionPeer::FILE_ID;
		}

		if ($this->aFile !== null && $this->aFile->getId() !== $v) {
			$this->aFile = null;
		}

		return $this;
	} // setFileId()

	/**
	 * Set the value of [message] column.
	 * 
	 * @param      string $v new value
	 * @return     StatusAction The current object (for fluent API support)
	 */
	public function setMessage($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->message !== $v) {
			$this->message = $v;
			$this->modifiedColumns[] = StatusActionPeer::MESSAGE;
		}

		return $this;
	} // setMessage()

	/**
	 * Set the value of [old_status] column.
	 * 
	 * @param      int $v new value
	 * @return     StatusAction The current object (for fluent API support)
	 */
	public function setOldStatus($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->old_status !== $v) {
			$this->old_status = $v;
			$this->modifiedColumns[] = StatusActionPeer::OLD_STATUS;
		}

		return $this;
	} // setOldStatus()

	/**
	 * Set the value of [new_status] column.
	 * 
	 * @param      int $v new value
	 * @return     StatusAction The current object (for fluent API support)
	 */
	public function setNewStatus($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->new_status !== $v) {
			$this->new_status = $v;
			$this->modifiedColumns[] = StatusActionPeer::NEW_STATUS;
		}

		return $this;
	} // setNewStatus()

	/**
	 * Sets the value of [created_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     StatusAction The current object (for fluent API support)
	 */
	public function setCreatedAt($v)
	{
		// we treat '' as NULL for temporal objects because DateTime('') == DateTime('now')
		// -- which is unexpected, to say the least.
		if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
			// some string/numeric value passed; we normalize that so that we can
			// validate it.
			try {
				if (is_numeric($v)) { // if it's a unix timestamp
					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
					// We have to explicitly specify and then change the time zone because of a
					// DateTime bug: http://bugs.php.net/bug.php?id=43003
					$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->created_at !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d H:i:s') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->created_at = ($dt ? $dt->format('Y-m-d H:i:s') : null);
				$this->modifiedColumns[] = StatusActionPeer::CREATED_AT;
			}
		} // if either are not null

		return $this;
	} // setCreatedAt()

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
			$this->user_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->repository_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->branch_id = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->file_id = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->message = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->old_status = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
			$this->new_status = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
			$this->created_at = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 9; // 9 = StatusActionPeer::NUM_COLUMNS - StatusActionPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating StatusAction object", $e);
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

		if ($this->asfGuardUser !== null && $this->user_id !== $this->asfGuardUser->getId()) {
			$this->asfGuardUser = null;
		}
		if ($this->aRepository !== null && $this->repository_id !== $this->aRepository->getId()) {
			$this->aRepository = null;
		}
		if ($this->aBranch !== null && $this->branch_id !== $this->aBranch->getId()) {
			$this->aBranch = null;
		}
		if ($this->aFile !== null && $this->file_id !== $this->aFile->getId()) {
			$this->aFile = null;
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
			$con = Propel::getConnection(StatusActionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = StatusActionPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->asfGuardUser = null;
			$this->aRepository = null;
			$this->aBranch = null;
			$this->aFile = null;
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
			$con = Propel::getConnection(StatusActionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			// symfony_behaviors behavior
			foreach (sfMixer::getCallables('BaseStatusAction:delete:pre') as $callable)
			{
			  if (call_user_func($callable, $this, $con))
			  {
			    $con->commit();
			    return;
			  }
			}

			if ($ret) {
				StatusActionQuery::create()
					->filterByPrimaryKey($this->getPrimaryKey())
					->delete($con);
				$this->postDelete($con);
				// symfony_behaviors behavior
				foreach (sfMixer::getCallables('BaseStatusAction:delete:post') as $callable)
				{
				  call_user_func($callable, $this, $con);
				}

				$con->commit();
				$this->setDeleted(true);
			} else {
				$con->commit();
			}
		} catch (PropelException $e) {
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
			$con = Propel::getConnection(StatusActionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		$isInsert = $this->isNew();
		try {
			$ret = $this->preSave($con);
			// symfony_behaviors behavior
			foreach (sfMixer::getCallables('BaseStatusAction:save:pre') as $callable)
			{
			  if (is_integer($affectedRows = call_user_func($callable, $this, $con)))
			  {
			  	$con->commit();
			    return $affectedRows;
			  }
			}

			// symfony_timestampable behavior
			
			if ($isInsert) {
				$ret = $ret && $this->preInsert($con);
				// symfony_timestampable behavior
				if (!$this->isColumnModified(StatusActionPeer::CREATED_AT))
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
				foreach (sfMixer::getCallables('BaseStatusAction:save:post') as $callable)
				{
				  call_user_func($callable, $this, $con, $affectedRows);
				}

				StatusActionPeer::addInstanceToPool($this);
			} else {
				$affectedRows = 0;
			}
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
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

			if ($this->asfGuardUser !== null) {
				if ($this->asfGuardUser->isModified() || $this->asfGuardUser->isNew()) {
					$affectedRows += $this->asfGuardUser->save($con);
				}
				$this->setsfGuardUser($this->asfGuardUser);
			}

			if ($this->aRepository !== null) {
				if ($this->aRepository->isModified() || $this->aRepository->isNew()) {
					$affectedRows += $this->aRepository->save($con);
				}
				$this->setRepository($this->aRepository);
			}

			if ($this->aBranch !== null) {
				if ($this->aBranch->isModified() || $this->aBranch->isNew()) {
					$affectedRows += $this->aBranch->save($con);
				}
				$this->setBranch($this->aBranch);
			}

			if ($this->aFile !== null) {
				if ($this->aFile->isModified() || $this->aFile->isNew()) {
					$affectedRows += $this->aFile->save($con);
				}
				$this->setFile($this->aFile);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = StatusActionPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$criteria = $this->buildCriteria();
					if ($criteria->keyContainsValue(StatusActionPeer::ID) ) {
						throw new PropelException('Cannot insert a value for auto-increment primary key ('.StatusActionPeer::ID.')');
					}

					$pk = BasePeer::doInsert($criteria, $con);
					$affectedRows += 1;
					$this->setId($pk);  //[IMV] update autoincrement primary key
					$this->setNew(false);
				} else {
					$affectedRows += StatusActionPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			$this->alreadyInSave = false;

		}
		return $affectedRows;
	} // doSave()

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

			if ($this->asfGuardUser !== null) {
				if (!$this->asfGuardUser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->asfGuardUser->getValidationFailures());
				}
			}

			if ($this->aRepository !== null) {
				if (!$this->aRepository->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aRepository->getValidationFailures());
				}
			}

			if ($this->aBranch !== null) {
				if (!$this->aBranch->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aBranch->getValidationFailures());
				}
			}

			if ($this->aFile !== null) {
				if (!$this->aFile->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aFile->getValidationFailures());
				}
			}


			if (($retval = StatusActionPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
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
		$pos = StatusActionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getUserId();
				break;
			case 2:
				return $this->getRepositoryId();
				break;
			case 3:
				return $this->getBranchId();
				break;
			case 4:
				return $this->getFileId();
				break;
			case 5:
				return $this->getMessage();
				break;
			case 6:
				return $this->getOldStatus();
				break;
			case 7:
				return $this->getNewStatus();
				break;
			case 8:
				return $this->getCreatedAt();
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
	 * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
	 *
	 * @return    array an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $includeForeignObjects = false)
	{
		$keys = StatusActionPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getUserId(),
			$keys[2] => $this->getRepositoryId(),
			$keys[3] => $this->getBranchId(),
			$keys[4] => $this->getFileId(),
			$keys[5] => $this->getMessage(),
			$keys[6] => $this->getOldStatus(),
			$keys[7] => $this->getNewStatus(),
			$keys[8] => $this->getCreatedAt(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->asfGuardUser) {
				$result['sfGuardUser'] = $this->asfGuardUser->toArray($keyType, $includeLazyLoadColumns, true);
			}
			if (null !== $this->aRepository) {
				$result['Repository'] = $this->aRepository->toArray($keyType, $includeLazyLoadColumns, true);
			}
			if (null !== $this->aBranch) {
				$result['Branch'] = $this->aBranch->toArray($keyType, $includeLazyLoadColumns, true);
			}
			if (null !== $this->aFile) {
				$result['File'] = $this->aFile->toArray($keyType, $includeLazyLoadColumns, true);
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
		$pos = StatusActionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setUserId($value);
				break;
			case 2:
				$this->setRepositoryId($value);
				break;
			case 3:
				$this->setBranchId($value);
				break;
			case 4:
				$this->setFileId($value);
				break;
			case 5:
				$this->setMessage($value);
				break;
			case 6:
				$this->setOldStatus($value);
				break;
			case 7:
				$this->setNewStatus($value);
				break;
			case 8:
				$this->setCreatedAt($value);
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
		$keys = StatusActionPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setUserId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setRepositoryId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setBranchId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setFileId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setMessage($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setOldStatus($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setNewStatus($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCreatedAt($arr[$keys[8]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(StatusActionPeer::DATABASE_NAME);

		if ($this->isColumnModified(StatusActionPeer::ID)) $criteria->add(StatusActionPeer::ID, $this->id);
		if ($this->isColumnModified(StatusActionPeer::USER_ID)) $criteria->add(StatusActionPeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(StatusActionPeer::REPOSITORY_ID)) $criteria->add(StatusActionPeer::REPOSITORY_ID, $this->repository_id);
		if ($this->isColumnModified(StatusActionPeer::BRANCH_ID)) $criteria->add(StatusActionPeer::BRANCH_ID, $this->branch_id);
		if ($this->isColumnModified(StatusActionPeer::FILE_ID)) $criteria->add(StatusActionPeer::FILE_ID, $this->file_id);
		if ($this->isColumnModified(StatusActionPeer::MESSAGE)) $criteria->add(StatusActionPeer::MESSAGE, $this->message);
		if ($this->isColumnModified(StatusActionPeer::OLD_STATUS)) $criteria->add(StatusActionPeer::OLD_STATUS, $this->old_status);
		if ($this->isColumnModified(StatusActionPeer::NEW_STATUS)) $criteria->add(StatusActionPeer::NEW_STATUS, $this->new_status);
		if ($this->isColumnModified(StatusActionPeer::CREATED_AT)) $criteria->add(StatusActionPeer::CREATED_AT, $this->created_at);

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
		$criteria = new Criteria(StatusActionPeer::DATABASE_NAME);
		$criteria->add(StatusActionPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of StatusAction (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{
		$copyObj->setUserId($this->user_id);
		$copyObj->setRepositoryId($this->repository_id);
		$copyObj->setBranchId($this->branch_id);
		$copyObj->setFileId($this->file_id);
		$copyObj->setMessage($this->message);
		$copyObj->setOldStatus($this->old_status);
		$copyObj->setNewStatus($this->new_status);
		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setNew(true);
		$copyObj->setId(NULL); // this is a auto-increment column, so set to default value
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
	 * @return     StatusAction Clone of current object.
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
	 * @return     StatusActionPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new StatusActionPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a sfGuardUser object.
	 *
	 * @param      sfGuardUser $v
	 * @return     StatusAction The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setsfGuardUser(sfGuardUser $v = null)
	{
		if ($v === null) {
			$this->setUserId(NULL);
		} else {
			$this->setUserId($v->getId());
		}

		$this->asfGuardUser = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the sfGuardUser object, it will not be re-added.
		if ($v !== null) {
			$v->addStatusAction($this);
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
		if ($this->asfGuardUser === null && ($this->user_id !== null)) {
			$this->asfGuardUser = sfGuardUserQuery::create()->findPk($this->user_id, $con);
			/* The following can be used additionally to
				 guarantee the related object contains a reference
				 to this object.  This level of coupling may, however, be
				 undesirable since it could result in an only partially populated collection
				 in the referenced object.
				 $this->asfGuardUser->addStatusActions($this);
			 */
		}
		return $this->asfGuardUser;
	}

	/**
	 * Declares an association between this object and a Repository object.
	 *
	 * @param      Repository $v
	 * @return     StatusAction The current object (for fluent API support)
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
			$v->addStatusAction($this);
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
				 $this->aRepository->addStatusActions($this);
			 */
		}
		return $this->aRepository;
	}

	/**
	 * Declares an association between this object and a Branch object.
	 *
	 * @param      Branch $v
	 * @return     StatusAction The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setBranch(Branch $v = null)
	{
		if ($v === null) {
			$this->setBranchId(NULL);
		} else {
			$this->setBranchId($v->getId());
		}

		$this->aBranch = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Branch object, it will not be re-added.
		if ($v !== null) {
			$v->addStatusAction($this);
		}

		return $this;
	}


	/**
	 * Get the associated Branch object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Branch The associated Branch object.
	 * @throws     PropelException
	 */
	public function getBranch(PropelPDO $con = null)
	{
		if ($this->aBranch === null && ($this->branch_id !== null)) {
			$this->aBranch = BranchQuery::create()->findPk($this->branch_id, $con);
			/* The following can be used additionally to
				 guarantee the related object contains a reference
				 to this object.  This level of coupling may, however, be
				 undesirable since it could result in an only partially populated collection
				 in the referenced object.
				 $this->aBranch->addStatusActions($this);
			 */
		}
		return $this->aBranch;
	}

	/**
	 * Declares an association between this object and a File object.
	 *
	 * @param      File $v
	 * @return     StatusAction The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setFile(File $v = null)
	{
		if ($v === null) {
			$this->setFileId(NULL);
		} else {
			$this->setFileId($v->getId());
		}

		$this->aFile = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the File object, it will not be re-added.
		if ($v !== null) {
			$v->addStatusAction($this);
		}

		return $this;
	}


	/**
	 * Get the associated File object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     File The associated File object.
	 * @throws     PropelException
	 */
	public function getFile(PropelPDO $con = null)
	{
		if ($this->aFile === null && ($this->file_id !== null)) {
			$this->aFile = FileQuery::create()->findPk($this->file_id, $con);
			/* The following can be used additionally to
				 guarantee the related object contains a reference
				 to this object.  This level of coupling may, however, be
				 undesirable since it could result in an only partially populated collection
				 in the referenced object.
				 $this->aFile->addStatusActions($this);
			 */
		}
		return $this->aFile;
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->id = null;
		$this->user_id = null;
		$this->repository_id = null;
		$this->branch_id = null;
		$this->file_id = null;
		$this->message = null;
		$this->old_status = null;
		$this->new_status = null;
		$this->created_at = null;
		$this->alreadyInSave = false;
		$this->alreadyInValidation = false;
		$this->clearAllReferences();
		$this->resetModified();
		$this->setNew(true);
		$this->setDeleted(false);
	}

	/**
	 * Resets all collections of referencing foreign keys.
	 *
	 * This method is a user-space workaround for PHP's inability to garbage collect objects
	 * with circular references.  This is currently necessary when using Propel in certain
	 * daemon or large-volumne/high-memory operations.
	 *
	 * @param      boolean $deep Whether to also clear the references on all associated objects.
	 */
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} // if ($deep)

		$this->asfGuardUser = null;
		$this->aRepository = null;
		$this->aBranch = null;
		$this->aFile = null;
	}

	/**
	 * Catches calls to virtual methods
	 */
	public function __call($name, $params)
	{
		// symfony_behaviors behavior
		if ($callable = sfMixer::getCallable('BaseStatusAction:' . $name))
		{
		  array_unshift($params, $this);
		  return call_user_func_array($callable, $params);
		}

		if (preg_match('/get(\w+)/', $name, $matches)) {
			$virtualColumn = $matches[1];
			if ($this->hasVirtualColumn($virtualColumn)) {
				return $this->getVirtualColumn($virtualColumn);
			}
			// no lcfirst in php<5.3...
			$virtualColumn[0] = strtolower($virtualColumn[0]);
			if ($this->hasVirtualColumn($virtualColumn)) {
				return $this->getVirtualColumn($virtualColumn);
			}
		}
		return parent::__call($name, $params);
	}

} // BaseStatusAction
