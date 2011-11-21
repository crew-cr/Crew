<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Checks the migrations to run
 *
 * @package    symfony
 * @subpackage propel
 * @author     François Zaninotto
 * @version    SVN: $Id: sfPropelBuildModelTask.class.php 23922 2009-11-14 14:58:38Z fabien $
 */
class sfPropelStatusTask extends sfPropelBaseTask
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
    $this->name = 'status';
    $this->aliases = array('migration-status');
    $this->briefDescription = 'Lists the migrations yet to be executed';

    $this->detailedDescription = <<<EOF
The [propel:status|INFO] checks the version of the database structure, and looks for migration files not yet executed (i.e. with a greater version timestamp).

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

    $this->logSection('propel', 'Checking Database Versions...');
    foreach ($connections as $name => $params)
    {
      if ($options['verbose'])
      {
        $this->logSection('propel', sprintf('  Connecting to database "%s" using DSN "%s"', $name, $params['dsn']), null, 'COMMENT');
      }
      if (!$manager->migrationTableExists($name))
      {
        if ($options['verbose'])
        {
          $this->logSection('propel', sprintf('  Migration table does not exist in datasource "%s"; creating it.', $name), null, 'COMMENT');
        }
        $manager->createMigrationTable($name);
      }
    }

    $oldestMigrationTimestamp = $manager->getOldestDatabaseVersion();
    if ($options['verbose'])
    {
      if ($oldestMigrationTimestamp)
      {
        $this->logSection('propel', sprintf('  Latest migration was executed on %s (timestamp %d)', date('Y-m-d H:i:s', $oldestMigrationTimestamp), $oldestMigrationTimestamp), null, 'COMMENT');
      }
      else
      {
        $this->logSection('propel', '  No migration was ever executed on these connection settings.', null, 'COMMENT');
      }
    }

    $this->logSection('propel', 'Listing Migration files...');
    $migrationTimestamps = $manager->getMigrationTimestamps();
    $nbExistingMigrations = count($migrationTimestamps);
    if ($migrationTimestamps)
    {
      if ($options['verbose'])
      {
        $this->logSection('propel', sprintf('  %d valid migration classes found in "%s"', $nbExistingMigrations, $options['migration-dir']), null, 'COMMENT');
      }
      if ($validTimestamps = $manager->getValidMigrationTimestamps())
      {
        $countValidTimestamps = count($validTimestamps);
        if ($countValidTimestamps == 1)
        {
          $this->logSection('propel', '1 migration needs to be executed:');
        }
        else
        {
          $this->logSection('propel', sprintf('%d migrations need to be executed:', $countValidTimestamps));
        }
      }
      foreach ($migrationTimestamps as $timestamp)
      {
        if ($timestamp <= $oldestMigrationTimestamp && $options['verbose'])
        {
          $this->logSection('propel', sprintf('  %s %s (executed)', $timestamp == $oldestMigrationTimestamp ? '>' : ' ', $manager->getMigrationClassName($timestamp)), null, 'COMMENT');
        }
        elseif ($timestamp > $oldestMigrationTimestamp)
        {
          $this->logSection('propel', sprintf('    %s', $manager->getMigrationClassName($timestamp)));
        }
      }
    }
    else
    {
      $this->logSection('propel', sprintf('No migration file found in "%s".', $options['migration-dir']));
      $this->logSection('propel', 'Make sure you run the sql-diff task.');
      return false;
    }

    $migrationTimestamps = $manager->getValidMigrationTimestamps();
    $nbNotYetExecutedMigrations = count($migrationTimestamps);
    if (!$nbNotYetExecutedMigrations)
    {
      $this->logSection('propel', 'All migration files were already executed - Nothing to migrate.');
      return false;
    }
    $this->logSection('propel', sprintf('Call the "propel:migrate" task to execute %s', $countValidTimestamps == 1 ? 'it' : 'them'
    ));
  }

}
