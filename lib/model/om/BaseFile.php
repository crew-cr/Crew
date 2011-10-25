<?php


/**
 * Base class that represents a row from the 'file' table.
 *
 * 
 *
 * @package    propel.generator.lib.model.om
 */
abstract class BaseFile extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'FilePeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        FilePeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the branch_id field.
	 * @var        int
	 */
	protected $branch_id;

	/**
	 * The value for the status_id field.
	 * @var        int
	 */
	protected $status_id;

	/**
	 * The value for the state field.
	 * @var        string
	 */
	protected $state;

	/**
	 * The value for the filename field.
	 * @var        string
	 */
	protected $filename;

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
	 * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP
	 * @var        string
	 */
	protected $date_status_changed;

	/**
	 * @var        Branch
	 */
	protected $aBranch;

	/**
	 * @var        Status
	 */
	protected $aStatus;

	/**
	 * @var        array FileComment[] Collection to store aggregation of FileComment objects.
	 */
	protected $collFileComments;

	/**
	 * @var        array LineComment[] Collection to store aggregation of LineComment objects.
	 */
	protected $collLineComments;

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
	 * Applies default values to this object.
	 * This method should be called from the object's constructor (or
	 * equivalent initialization method).
	 * @see        __construct()
	 */
	public function applyDefaultValues()
	{
	}

	/**
	 * Initializes internal state of BaseFile object.
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
	 * Get the [branch_id] column value.
	 * 
	 * @return     int
	 */
	public function getBranchId()
	{
		return $this->branch_id;
	}

	/**
	 * Get the [status_id] column value.
	 * 
	 * @return     int
	 */
	public function getStatusId()
	{
		return $this->status_id;
	}

	/**
	 * Get the [state] column value.
	 * 
	 * @return     string
	 */
	public function getState()
	{
		return $this->state;
	}

	/**
	 * Get the [filename] column value.
	 * 
	 * @return     string
	 */
	public function getFilename()
	{
		return $this->filename;
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
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     File The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = FilePeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [branch_id] column.
	 * 
	 * @param      int $v new value
	 * @return     File The current object (for fluent API support)
	 */
	public function setBranchId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->branch_id !== $v) {
			$this->branch_id = $v;
			$this->modifiedColumns[] = FilePeer::BRANCH_ID;
		}

		if ($this->aBranch !== null && $this->aBranch->getId() !== $v) {
			$this->aBranch = null;
		}

		return $this;
	} // setBranchId()

	/**
	 * Set the value of [status_id] column.
	 * 
	 * @param      int $v new value
	 * @return     File The current object (for fluent API support)
	 */
	public function setStatusId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->status_id !== $v) {
			$this->status_id = $v;
			$this->modifiedColumns[] = FilePeer::STATUS_ID;
		}

		if ($this->aStatus !== null && $this->aStatus->getId() !== $v) {
			$this->aStatus = null;
		}

		return $this;
	} // setStatusId()

	/**
	 * Set the value of [state] column.
	 * 
	 * @param      string $v new value
	 * @return     File The current object (for fluent API support)
	 */
	public function setState($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->state !== $v) {
			$this->state = $v;
			$this->modifiedColumns[] = FilePeer::STATE;
		}

		return $this;
	} // setState()

	/**
	 * Set the value of [filename] column.
	 * 
	 * @param      string $v new value
	 * @return     File The current object (for fluent API support)
	 */
	public function setFilename($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->filename !== $v) {
			$this->filename = $v;
			$this->modifiedColumns[] = FilePeer::FILENAME;
		}

		return $this;
	} // setFilename()

	/**
	 * Set the value of [commit_status_changed] column.
	 * 
	 * @param      string $v new value
	 * @return     File The current object (for fluent API support)
	 */
	public function setCommitStatusChanged($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->commit_status_changed !== $v) {
			$this->commit_status_changed = $v;
			$this->modifiedColumns[] = FilePeer::COMMIT_STATUS_CHANGED;
		}

		return $this;
	} // setCommitStatusChanged()

	/**
	 * Set the value of [user_status_changed] column.
	 * 
	 * @param      int $v new value
	 * @return     File The current object (for fluent API support)
	 */
	public function setUserStatusChanged($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->user_status_changed !== $v) {
			$this->user_status_changed = $v;
			$this->modifiedColumns[] = FilePeer::USER_STATUS_CHANGED;
		}

		return $this;
	} // setUserStatusChanged()

	/**
	 * Sets the value of [date_status_changed] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     File The current object (for fluent API support)
	 */
	public function setDateStatusChanged($v)
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

		if ( $this->date_status_changed !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->date_status_changed !== null && $tmpDt = new DateTime($this->date_status_changed)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d H:i:s') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->date_status_changed = ($dt ? $dt->format('Y-m-d H:i:s') : null);
				$this->modifiedColumns[] = FilePeer::DATE_STATUS_CHANGED;
			}
		} // if either are not null

		return $this;
	} // setDateStatusChanged()

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
			$this->branch_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->status_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->state = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->filename = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->commit_status_changed = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->user_status_changed = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
			$this->date_status_changed = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 8; // 8 = FilePeer::NUM_COLUMNS - FilePeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating File object", $e);
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

		if ($this->aBranch !== null && $this->branch_id !== $this->aBranch->getId()) {
			$this->aBranch = null;
		}
		if ($this->aStatus !== null && $this->status_id !== $this->aStatus->getId()) {
			$this->aStatus = null;
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
			$con = Propel::getConnection(FilePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = FilePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aBranch = null;
			$this->aStatus = null;
			$this->collFileComments = null;

			$this->collLineComments = null;

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
			$con = Propel::getConnection(FilePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			// symfony_behaviors behavior
			foreach (sfMixer::getCallables('BaseFile:delete:pre') as $callable)
			{
			  if (call_user_func($callable, $this, $con))
			  {
			    $con->commit();
			    return;
			  }
			}

			if ($ret) {
				FileQuery::create()
					->filterByPrimaryKey($this->getPrimaryKey())
					->delete($con);
				$this->postDelete($con);
				// symfony_behaviors behavior
				foreach (sfMixer::getCallables('BaseFile:delete:post') as $callable)
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
			$con = Propel::getConnection(FilePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		$isInsert = $this->isNew();
		try {
			$ret = $this->preSave($con);
			// symfony_behaviors behavior
			foreach (sfMixer::getCallables('BaseFile:save:pre') as $callable)
			{
			  if (is_integer($affectedRows = call_user_func($callable, $this, $con)))
			  {
			  	$con->commit();
			    return $affectedRows;
			  }
			}

			if ($isInsert) {
				$ret = $ret && $this->preInsert($con);
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
				foreach (sfMixer::getCallables('BaseFile:save:post') as $callable)
				{
				  call_user_func($callable, $this, $con, $affectedRows);
				}

				FilePeer::addInstanceToPool($this);
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

			if ($this->aBranch !== null) {
				if ($this->aBranch->isModified() || $this->aBranch->isNew()) {
					$affectedRows += $this->aBranch->save($con);
				}
				$this->setBranch($this->aBranch);
			}

			if ($this->aStatus !== null) {
				if ($this->aStatus->isModified() || $this->aStatus->isNew()) {
					$affectedRows += $this->aStatus->save($con);
				}
				$this->setStatus($this->aStatus);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = FilePeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$criteria = $this->buildCriteria();
					if ($criteria->keyContainsValue(FilePeer::ID) ) {
						throw new PropelException('Cannot insert a value for auto-increment primary key ('.FilePeer::ID.')');
					}

					$pk = BasePeer::doInsert($criteria, $con);
					$affectedRows += 1;
					$this->setId($pk);  //[IMV] update autoincrement primary key
					$this->setNew(false);
				} else {
					$affectedRows += FilePeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collFileComments !== null) {
				foreach ($this->collFileComments as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collLineComments !== null) {
				foreach ($this->collLineComments as $referrerFK) {
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

			if ($this->aBranch !== null) {
				if (!$this->aBranch->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aBranch->getValidationFailures());
				}
			}

			if ($this->aStatus !== null) {
				if (!$this->aStatus->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aStatus->getValidationFailures());
				}
			}


			if (($retval = FilePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collFileComments !== null) {
					foreach ($this->collFileComments as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collLineComments !== null) {
					foreach ($this->collLineComments as $referrerFK) {
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
		$pos = FilePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getBranchId();
				break;
			case 2:
				return $this->getStatusId();
				break;
			case 3:
				return $this->getState();
				break;
			case 4:
				return $this->getFilename();
				break;
			case 5:
				return $this->getCommitStatusChanged();
				break;
			case 6:
				return $this->getUserStatusChanged();
				break;
			case 7:
				return $this->getDateStatusChanged();
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
		$keys = FilePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getBranchId(),
			$keys[2] => $this->getStatusId(),
			$keys[3] => $this->getState(),
			$keys[4] => $this->getFilename(),
			$keys[5] => $this->getCommitStatusChanged(),
			$keys[6] => $this->getUserStatusChanged(),
			$keys[7] => $this->getDateStatusChanged(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->aBranch) {
				$result['Branch'] = $this->aBranch->toArray($keyType, $includeLazyLoadColumns, true);
			}
			if (null !== $this->aStatus) {
				$result['Status'] = $this->aStatus->toArray($keyType, $includeLazyLoadColumns, true);
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
		$pos = FilePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setBranchId($value);
				break;
			case 2:
				$this->setStatusId($value);
				break;
			case 3:
				$this->setState($value);
				break;
			case 4:
				$this->setFilename($value);
				break;
			case 5:
				$this->setCommitStatusChanged($value);
				break;
			case 6:
				$this->setUserStatusChanged($value);
				break;
			case 7:
				$this->setDateStatusChanged($value);
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
		$keys = FilePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setBranchId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setStatusId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setState($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setFilename($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCommitStatusChanged($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setUserStatusChanged($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setDateStatusChanged($arr[$keys[7]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(FilePeer::DATABASE_NAME);

		if ($this->isColumnModified(FilePeer::ID)) $criteria->add(FilePeer::ID, $this->id);
		if ($this->isColumnModified(FilePeer::BRANCH_ID)) $criteria->add(FilePeer::BRANCH_ID, $this->branch_id);
		if ($this->isColumnModified(FilePeer::STATUS_ID)) $criteria->add(FilePeer::STATUS_ID, $this->status_id);
		if ($this->isColumnModified(FilePeer::STATE)) $criteria->add(FilePeer::STATE, $this->state);
		if ($this->isColumnModified(FilePeer::FILENAME)) $criteria->add(FilePeer::FILENAME, $this->filename);
		if ($this->isColumnModified(FilePeer::COMMIT_STATUS_CHANGED)) $criteria->add(FilePeer::COMMIT_STATUS_CHANGED, $this->commit_status_changed);
		if ($this->isColumnModified(FilePeer::USER_STATUS_CHANGED)) $criteria->add(FilePeer::USER_STATUS_CHANGED, $this->user_status_changed);
		if ($this->isColumnModified(FilePeer::DATE_STATUS_CHANGED)) $criteria->add(FilePeer::DATE_STATUS_CHANGED, $this->date_status_changed);

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
		$criteria = new Criteria(FilePeer::DATABASE_NAME);
		$criteria->add(FilePeer::ID, $this->id);

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
	 * @param      object $copyObj An object of File (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{
		$copyObj->setBranchId($this->branch_id);
		$copyObj->setStatusId($this->status_id);
		$copyObj->setState($this->state);
		$copyObj->setFilename($this->filename);
		$copyObj->setCommitStatusChanged($this->commit_status_changed);
		$copyObj->setUserStatusChanged($this->user_status_changed);
		$copyObj->setDateStatusChanged($this->date_status_changed);

		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getFileComments() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addFileComment($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getLineComments() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addLineComment($relObj->copy($deepCopy));
				}
			}

		} // if ($deepCopy)


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
	 * @return     File Clone of current object.
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
	 * @return     FilePeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new FilePeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Branch object.
	 *
	 * @param      Branch $v
	 * @return     File The current object (for fluent API support)
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
			$v->addFile($this);
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
				 $this->aBranch->addFiles($this);
			 */
		}
		return $this->aBranch;
	}

	/**
	 * Declares an association between this object and a Status object.
	 *
	 * @param      Status $v
	 * @return     File The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setStatus(Status $v = null)
	{
		if ($v === null) {
			$this->setStatusId(NULL);
		} else {
			$this->setStatusId($v->getId());
		}

		$this->aStatus = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Status object, it will not be re-added.
		if ($v !== null) {
			$v->addFile($this);
		}

		return $this;
	}


	/**
	 * Get the associated Status object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Status The associated Status object.
	 * @throws     PropelException
	 */
	public function getStatus(PropelPDO $con = null)
	{
		if ($this->aStatus === null && ($this->status_id !== null)) {
			$this->aStatus = StatusQuery::create()->findPk($this->status_id, $con);
			/* The following can be used additionally to
				 guarantee the related object contains a reference
				 to this object.  This level of coupling may, however, be
				 undesirable since it could result in an only partially populated collection
				 in the referenced object.
				 $this->aStatus->addFiles($this);
			 */
		}
		return $this->aStatus;
	}

	/**
	 * Clears out the collFileComments collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addFileComments()
	 */
	public function clearFileComments()
	{
		$this->collFileComments = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collFileComments collection.
	 *
	 * By default this just sets the collFileComments collection to an empty array (like clearcollFileComments());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initFileComments()
	{
		$this->collFileComments = new PropelObjectCollection();
		$this->collFileComments->setModel('FileComment');
	}

	/**
	 * Gets an array of FileComment objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this File is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array FileComment[] List of FileComment objects
	 * @throws     PropelException
	 */
	public function getFileComments($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collFileComments || null !== $criteria) {
			if ($this->isNew() && null === $this->collFileComments) {
				// return empty collection
				$this->initFileComments();
			} else {
				$collFileComments = FileCommentQuery::create(null, $criteria)
					->filterByFile($this)
					->find($con);
				if (null !== $criteria) {
					return $collFileComments;
				}
				$this->collFileComments = $collFileComments;
			}
		}
		return $this->collFileComments;
	}

	/**
	 * Returns the number of related FileComment objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related FileComment objects.
	 * @throws     PropelException
	 */
	public function countFileComments(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collFileComments || null !== $criteria) {
			if ($this->isNew() && null === $this->collFileComments) {
				return 0;
			} else {
				$query = FileCommentQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByFile($this)
					->count($con);
			}
		} else {
			return count($this->collFileComments);
		}
	}

	/**
	 * Method called to associate a FileComment object to this object
	 * through the FileComment foreign key attribute.
	 *
	 * @param      FileComment $l FileComment
	 * @return     void
	 * @throws     PropelException
	 */
	public function addFileComment(FileComment $l)
	{
		if ($this->collFileComments === null) {
			$this->initFileComments();
		}
		if (!$this->collFileComments->contains($l)) { // only add it if the **same** object is not already associated
			$this->collFileComments[]= $l;
			$l->setFile($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this File is new, it will return
	 * an empty collection; or if this File has previously
	 * been saved, it will retrieve related FileComments from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in File.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array FileComment[] List of FileComment objects
	 */
	public function getFileCommentsJoinsfGuardUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = FileCommentQuery::create(null, $criteria);
		$query->joinWith('sfGuardUser', $join_behavior);

		return $this->getFileComments($query, $con);
	}

	/**
	 * Clears out the collLineComments collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addLineComments()
	 */
	public function clearLineComments()
	{
		$this->collLineComments = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collLineComments collection.
	 *
	 * By default this just sets the collLineComments collection to an empty array (like clearcollLineComments());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initLineComments()
	{
		$this->collLineComments = new PropelObjectCollection();
		$this->collLineComments->setModel('LineComment');
	}

	/**
	 * Gets an array of LineComment objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this File is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array LineComment[] List of LineComment objects
	 * @throws     PropelException
	 */
	public function getLineComments($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collLineComments || null !== $criteria) {
			if ($this->isNew() && null === $this->collLineComments) {
				// return empty collection
				$this->initLineComments();
			} else {
				$collLineComments = LineCommentQuery::create(null, $criteria)
					->filterByFile($this)
					->find($con);
				if (null !== $criteria) {
					return $collLineComments;
				}
				$this->collLineComments = $collLineComments;
			}
		}
		return $this->collLineComments;
	}

	/**
	 * Returns the number of related LineComment objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related LineComment objects.
	 * @throws     PropelException
	 */
	public function countLineComments(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collLineComments || null !== $criteria) {
			if ($this->isNew() && null === $this->collLineComments) {
				return 0;
			} else {
				$query = LineCommentQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByFile($this)
					->count($con);
			}
		} else {
			return count($this->collLineComments);
		}
	}

	/**
	 * Method called to associate a LineComment object to this object
	 * through the LineComment foreign key attribute.
	 *
	 * @param      LineComment $l LineComment
	 * @return     void
	 * @throws     PropelException
	 */
	public function addLineComment(LineComment $l)
	{
		if ($this->collLineComments === null) {
			$this->initLineComments();
		}
		if (!$this->collLineComments->contains($l)) { // only add it if the **same** object is not already associated
			$this->collLineComments[]= $l;
			$l->setFile($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this File is new, it will return
	 * an empty collection; or if this File has previously
	 * been saved, it will retrieve related LineComments from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in File.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array LineComment[] List of LineComment objects
	 */
	public function getLineCommentsJoinsfGuardUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = LineCommentQuery::create(null, $criteria);
		$query->joinWith('sfGuardUser', $join_behavior);

		return $this->getLineComments($query, $con);
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->id = null;
		$this->branch_id = null;
		$this->status_id = null;
		$this->state = null;
		$this->filename = null;
		$this->commit_status_changed = null;
		$this->user_status_changed = null;
		$this->date_status_changed = null;
		$this->alreadyInSave = false;
		$this->alreadyInValidation = false;
		$this->clearAllReferences();
		$this->applyDefaultValues();
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
			if ($this->collFileComments) {
				foreach ((array) $this->collFileComments as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collLineComments) {
				foreach ((array) $this->collLineComments as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collFileComments = null;
		$this->collLineComments = null;
		$this->aBranch = null;
		$this->aStatus = null;
	}

	/**
	 * Catches calls to virtual methods
	 */
	public function __call($name, $params)
	{
		// symfony_behaviors behavior
		if ($callable = sfMixer::getCallable('BaseFile:' . $name))
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

} // BaseFile
