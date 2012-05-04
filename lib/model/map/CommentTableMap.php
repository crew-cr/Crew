<?php



/**
 * This class defines the structure of the 'comment' table.
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
class CommentTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.CommentTableMap';

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
		$this->setName('comment');
		$this->setPhpName('Comment');
		$this->setClassname('Comment');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'sf_guard_user', 'ID', false, null, null);
		$this->addForeignKey('BRANCH_ID', 'BranchId', 'INTEGER', 'branch', 'ID', false, 11, null);
		$this->addForeignKey('FILE_ID', 'FileId', 'INTEGER', 'file', 'ID', false, 11, null);
		$this->addColumn('POSITION', 'Position', 'INTEGER', false, 11, null);
		$this->addColumn('LINE', 'Line', 'INTEGER', false, 11, null);
		$this->addColumn('TYPE', 'Type', 'ENUM', false, null, null);
		$this->getColumn('TYPE', false)->setValueSet(array (
  0 => 'branch',
  1 => 'file',
  2 => 'line',
));
		$this->addColumn('COMMIT', 'Commit', 'VARCHAR', true, 50, null);
		$this->addColumn('VALUE', 'Value', 'LONGVARCHAR', true, null, null);
		$this->addColumn('ROOT_COMMENT_ID', 'RootCommentId', 'INTEGER', false, 11, null);
		$this->addForeignKey('CHECK_USER_ID', 'CheckUserId', 'INTEGER', 'sf_guard_user', 'ID', false, null, null);
		$this->addColumn('CHECKED_AT', 'CheckedAt', 'TIMESTAMP', false, null, null);
		$this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', true, null, null);
		$this->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', true, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('sfGuardUserRelatedByUserId', 'sfGuardUser', RelationMap::MANY_TO_ONE, array('user_id' => 'id', ), null, null);
		$this->addRelation('Branch', 'Branch', RelationMap::MANY_TO_ONE, array('branch_id' => 'id', ), 'CASCADE', 'RESTRICT');
		$this->addRelation('File', 'File', RelationMap::MANY_TO_ONE, array('file_id' => 'id', ), 'CASCADE', 'RESTRICT');
		$this->addRelation('sfGuardUserRelatedByCheckUserId', 'sfGuardUser', RelationMap::MANY_TO_ONE, array('check_user_id' => 'id', ), null, null);
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
			'symfony_timestampable' => array('create_column' => 'created_at', 'update_column' => 'updated_at', ),
		);
	} // getBehaviors()

} // CommentTableMap
