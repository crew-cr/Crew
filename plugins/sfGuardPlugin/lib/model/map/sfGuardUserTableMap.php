<?php



/**
 * This class defines the structure of the 'sf_guard_user' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.plugins.sfGuardPlugin.lib.model.map
 */
class sfGuardUserTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'plugins.sfGuardPlugin.lib.model.map.sfGuardUserTableMap';

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
		$this->setName('sf_guard_user');
		$this->setPhpName('sfGuardUser');
		$this->setClassname('sfGuardUser');
		$this->setPackage('plugins.sfGuardPlugin.lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('USERNAME', 'Username', 'VARCHAR', true, 128, null);
		$this->addColumn('ALGORITHM', 'Algorithm', 'VARCHAR', true, 128, 'sha1');
		$this->addColumn('SALT', 'Salt', 'VARCHAR', true, 128, null);
		$this->addColumn('PASSWORD', 'Password', 'VARCHAR', true, 128, null);
		$this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null, null);
		$this->addColumn('LAST_LOGIN', 'LastLogin', 'TIMESTAMP', false, null, null);
		$this->addColumn('IS_ACTIVE', 'IsActive', 'BOOLEAN', true, 1, true);
		$this->addColumn('IS_SUPER_ADMIN', 'IsSuperAdmin', 'BOOLEAN', true, 1, false);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('Branch', 'Branch', RelationMap::ONE_TO_MANY, array('id' => 'user_status_changed', ), null, null, 'Branchs');
		$this->addRelation('CommentRelatedByUserId', 'Comment', RelationMap::ONE_TO_MANY, array('id' => 'user_id', ), null, null, 'CommentsRelatedByUserId');
		$this->addRelation('CommentRelatedByCheckUserId', 'Comment', RelationMap::ONE_TO_MANY, array('id' => 'check_user_id', ), null, null, 'CommentsRelatedByCheckUserId');
		$this->addRelation('File', 'File', RelationMap::ONE_TO_MANY, array('id' => 'last_change_commit_user', ), null, null, 'Files');
		$this->addRelation('Profile', 'Profile', RelationMap::ONE_TO_MANY, array('id' => 'sf_guard_user_id', ), 'CASCADE', null, 'Profiles');
		$this->addRelation('StatusAction', 'StatusAction', RelationMap::ONE_TO_MANY, array('id' => 'user_id', ), null, null, 'StatusActions');
		$this->addRelation('sfGuardUserPermission', 'sfGuardUserPermission', RelationMap::ONE_TO_MANY, array('id' => 'user_id', ), 'CASCADE', null, 'sfGuardUserPermissions');
		$this->addRelation('sfGuardUserGroup', 'sfGuardUserGroup', RelationMap::ONE_TO_MANY, array('id' => 'user_id', ), 'CASCADE', null, 'sfGuardUserGroups');
		$this->addRelation('sfGuardRememberKey', 'sfGuardRememberKey', RelationMap::ONE_TO_MANY, array('id' => 'user_id', ), 'CASCADE', null, 'sfGuardRememberKeys');
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
			'symfony_timestampable' => array('create_column' => 'created_at', ),
		);
	} // getBehaviors()

} // sfGuardUserTableMap
