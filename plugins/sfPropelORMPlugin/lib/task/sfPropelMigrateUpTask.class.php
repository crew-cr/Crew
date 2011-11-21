<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once(dirname(__FILE__).'/sfPropelBaseTask.class.php');
require_once('generator/lib/util/PropelMigrationManager.php');

/**
 * Executes the next migration up
 *
 * @package    symfony
 * @subpackage propel
 * @author     François Zaninotto
 * @version    SVN: $Id: sfPropelBuildModelTask.class.php 23922 2009-11-14 14:58:38Z fabien $
 */
class sfPropelMigrateUpTask extends sfPropelBaseTask
{
  /**
   * @see sfTask
   */
  protected function configure()
  {
    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_OPTIONAL, 'The application name', true),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'cli'),
      new sfCommandOption('migration-dir', null, sfCommandOption::PARAMETER_OPTIONAL, 'The migrations subdirectory', 'lib/model/migration'),
      new sfCommandOption('migration-table', null, sfCommandOption::PARAMETER_OPTIONAL, 'The name of the migration table', 'propel_migration'),
      new sfCommandOption('verbose', null, sfCommandOption::PARAMETER_NONE, 'Enables verbose output'),
    ));
    $this->namespace = 'propel';
    $this->name = 'up';
    $this->aliases = array('migration-up');
    $this->briefDescription = 'Executes the next migration up';

    $this->detailedDescription = <<<EOF
The [propel:up|INFO] checks the version of the database structure, and looks for migration files not yet executed (i.e. with a greater version timestamp). The first migration found is executed.

The task reads the database connection settings in [config/databases.yml|COMMENT].

The task looks for migration classes in [lib/model/migration|COMMENT].
EOF;
  }

  /**
   * @see sfTask
   */
  protected function execute($arguments = array(), $options = array())
  {
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connections = $this->getConnections($databaseManager);
    $manager = new PropelMigrationManager();
    $manager->setConnections($connections);
    $manager->setMigrationTable($options['migration-table']);
    $migrationDirectory = sfConfig::get('sf_root_dir') . DIRECTORY_SEPARATOR . $options['migration-dir'];
    $manager->setMigrationDir($migrationDirectory);

    if (!$nextMigrationTimestamp = $manager->getFirstUpMigrationTimestamp())
    {
      $this->logSection('propel', 'All migrations were already executed - nothing to migrate.');
      return false;
    }
    $this->logSection('propel', sprintf(
      'Executing migration %s up',
      $manager->getMigrationClassName($nextMigrationTimestamp)
    ));

    $migration = $manager->getMigrationObject($nextMigrationTimestamp);
    if (false === $migration->preUp($manager))
    {
      $this->logSection('propel', 'preUp() returned false. Aborting migration.', null, 'ERROR');
      return false;
    }

    foreach ($migration->getUpSQL() as $datasource => $sql)
    {
      $connection = $manager->getConnection($datasource);
      if ($options['verbose'])
      {
        $this->logSection('propel', sprintf('  Connecting to database "%s" using DSN "%s"', $datasource, $connection['dsn']), null, 'COMMENT');
      }
      $pdo = $manager->getPdoConnection($datasource);
      $res = 0;
      $statements = PropelSQLParser::parseString($sql);
      foreach ($statements as $statement)
      {
        try
        {
          if ($options['verbose'])
          {
            $this->logSection('propel', sprintf('  Executing statement "%s"', $statement), null, 'COMMENT');
          }
          $stmt = $pdo->prepare($statement);
          $stmt->execute();
          $res++;
        }
        catch (PDOException $e)
        {
          $this->logSection(sprintf('Failed to execute SQL "%s". Aborting migration.', $statement), null, 'ERROR');
          return false;
          // continue
        }
      }
      if (!$res)
      {
        $this->logSection('propel', 'No statement was executed. The version was not updated.');
        $this->logSection('propel', sprintf(
          'Please review the code in "%s"',
          $manager->getMigrationDir() . DIRECTORY_SEPARATOR . $manager->getMigrationClassName($nextMigrationTimestamp)
        ));
        $this->logSection('propel', 'Migration aborted', null, 'ERROR');
        return false;
      }
      $this->logSection('propel', sprintf(
        '%d of %d SQL statements executed successfully on datasource "%s"',
        $res,
        count($statements),
        $datasource
      ));
      $manager->updateLatestMigrationTimestamp($datasource, $nextMigrationTimestamp);
      if ($options['verbose'])
      {
        $this->logSection('propel', sprintf('  Updated latest migration date to %d for datasource "%s"', $nextMigrationTimestamp, $datasource), null, 'COMMENT');
      }
    }

    $migration->postUp($manager);

    if ($timestamps = $manager->getValidMigrationTimestamps())
    {
      $this->logSection('propel', sprintf(
        'Migration complete. %d migrations left to execute.',
        count($timestamps)
      ));
    }
    else
    {
      $this->logSection('propel', 'Migration complete. No further migration to execute.');
    }
  }

}
