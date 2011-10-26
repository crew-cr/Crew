<?php



/**
 * This class defines the structure of the 'branch' table.
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
class BranchTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.BranchTableMap';

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
		$this->setName('branch');
		$this->setPhpName('Branch');
		$this->setClassname('Branch');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('REPOSITORY_ID', 'RepositoryId', 'INTEGER', 'repository', 'ID', true, 11, null);
		$this->addColumn('NAME', 'Name', 'VARCHAR', true, 255, null);
		$this->addColumn('COMMIT_REFERENCE', 'CommitReference', 'VARCHAR', true, 50, null);
		$this->addColumn('IS_BLACKLISTED', 'IsBlacklisted', 'TINYINT', true, 1, 0);
		$this->addColumn('REVIEW_REQUEST', 'ReviewRequest', 'TINYINT', true, 1, 0);
		$this->addColumn('STATUS', 'Status', 'TINYINT', true, 1, 0);
		$this->addColumn('COMMIT_STATUS_CHANGED', 'CommitStatusChanged', 'VARCHAR', false, 50, null);
		$this->addForeignKey('USER_STATUS_CHANGED', 'UserStatusChanged', 'INTEGER', 'sf_guard_user', 'ID', false, null, null);
		$this->addColumn('DATE_STATUS_CHANGED', 'DateStatusChanged', 'TIMESTAMP', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Repository', 'Repository', RelationMap::MANY_TO_ONE, array('repository_id' => 'id', ), 'CASCADE', 'RESTRICT');
    $this->addRelation('sfGuardUser', 'sfGuardUser', RelationMap::MANY_TO_ONE, array('user_status_changed' => 'id', ), null, null);
    $this->addRelation('BranchComment', 'BranchComment', RelationMap::ONE_TO_MANY, array('id' => 'branch_id', ), 'CASCADE', 'RESTRICT');
    $this->addRelation('File', 'File', RelationMap::ONE_TO_MANY, array('id' => 'branch_id', ), 'CASCADE', 'RESTRICT');
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

} // BranchTableMap
