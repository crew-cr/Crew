<?php



/**
 * This class defines the structure of the 'file' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.lib.model.map
 */
class FileTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.FileTableMap';

	/**
	 * Initialize the table attributes, columns and validators
	 * Relations are not initialized by this method since they are lazy loaded
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function initialize()
	{
		// attributes
		$this->setName('file');
		$this->setPhpName('File');
		$this->setClassname('File');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('BRANCH_ID', 'BranchId', 'INTEGER', 'branch', 'ID', true, 11, null);
		$this->addColumn('STATE', 'State', 'CHAR', true, 1, null);
		$this->addColumn('FILENAME', 'Filename', 'VARCHAR', true, 255, null);
		$this->addColumn('COMMIT_REFERENCE', 'CommitReference', 'VARCHAR', true, 50, null);
		$this->addColumn('NB_ADDED_LINES', 'NbAddedLines', 'INTEGER', false, 11, null);
		$this->addColumn('NB_DELETED_LINES', 'NbDeletedLines', 'INTEGER', false, 11, null);
		$this->addColumn('LAST_CHANGE_COMMIT', 'LastChangeCommit', 'VARCHAR', false, 50, null);
		$this->addColumn('LAST_CHANGE_COMMIT_DESC', 'LastChangeCommitDesc', 'VARCHAR', false, 255, null);
		$this->addForeignKey('LAST_CHANGE_COMMIT_USER', 'LastChangeCommitUser', 'INTEGER', 'sf_guard_user', 'ID', false, null, null);
		$this->addColumn('STATUS', 'Status', 'TINYINT', true, 1, 0);
		$this->addColumn('COMMIT_STATUS_CHANGED', 'CommitStatusChanged', 'VARCHAR', false, 50, null);
		$this->addColumn('USER_STATUS_CHANGED', 'UserStatusChanged', 'INTEGER', false, 11, null);
		$this->addColumn('DATE_STATUS_CHANGED', 'DateStatusChanged', 'TIMESTAMP', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('Branch', 'Branch', RelationMap::MANY_TO_ONE, array('branch_id' => 'id', ), 'CASCADE', 'RESTRICT');
		$this->addRelation('sfGuardUser', 'sfGuardUser', RelationMap::MANY_TO_ONE, array('last_change_commit_user' => 'id', ), null, null);
		$this->addRelation('Comment', 'Comment', RelationMap::ONE_TO_MANY, array('id' => 'file_id', ), 'CASCADE', 'RESTRICT', 'Comments');
		$this->addRelation('StatusAction', 'StatusAction', RelationMap::ONE_TO_MANY, array('id' => 'file_id', ), 'CASCADE', 'RESTRICT', 'StatusActions');
	} // buildRelations()

	/**
	 *
	 * Gets the list of behaviors registered for this table
	 *
	 * @return array Associative array (name => parameters) of behaviors
	 */
	public function getBehaviors()
	{
		return array(
			'symfony' => array('form' => 'true', 'filter' => 'true', ),
			'symfony_behaviors' => array(),
		);
	} // getBehaviors()

} // FileTableMap
