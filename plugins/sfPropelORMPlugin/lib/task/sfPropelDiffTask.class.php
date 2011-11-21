<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once(dirname(__FILE__).'/sfPropelBaseTask.class.php');
require_once('generator/lib/model/AppData.php');
require_once('generator/lib/builder/util/XmlToAppData.php');
require_once('generator/lib/platform/DefaultPlatform.php');
require_once('generator/lib/model/diff/PropelDatabaseComparator.php');
require_once('generator/lib/util/PropelMigrationManager.php');

/**
 * Create classes for the current model.
 *
 * @package    symfony
 * @subpackage propel
 * @author     François Zaninotto
 * @version    SVN: $Id: sfPropelBuildModelTask.class.php 23922 2009-11-14 14:58:38Z fabien $
 */
class sfPropelDiffTask extends sfPropelBaseTask
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
      new sfCommandOption('editor-cmd', null, sfCommandOption::PARAMETER_OPTIONAL, 'A command used to edit the migration class'),
      new sfCommandOption('ask-confirmation', null, sfCommandOption::PARAMETER_NONE, 'Ask for confirmation'),
      new sfCommandOption('verbose', null, sfCommandOption::PARAMETER_NONE, 'Enables verbose output'),
    ));
    $this->namespace = 'propel';
    $this->name = 'diff';
    $this->aliases = array('migration-generate');
    $this->briefDescription = 'Computes diff between current model and database';

    $this->detailedDescription = <<<EOF
The [propel:diff|INFO] compares the current database structure and the
available schemas. If there is a difference, it creates a migration file:

  [./symfony propel:diff|INFO]

The task reads the database connection settings in [config/databases.yml|COMMENT].

The task reads the schema information in [config/*schema.xml|COMMENT] and/or
[config/*schema.yml|COMMENT] from the project and all installed plugins.

You can mix and match YML and XML schema files. The task will convert
YML ones to XML before calling the Propel task.

The migration classes files are created in [lib/model/migration|COMMENT].
EOF;
  }

  /**
   * @see sfTask
   */
  protected function execute($arguments = array(), $options = array())
  {
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connections = $this->getConnections($databaseManager);

    $this->logSection('propel', 'Reading databases structure...');
    $ad = new AppData();
    $totalNbTables = 0;
    foreach ($connections as $name => $params)
    {
      if ($options['verbose'])
      {
        $this->logSection('propel', sprintf('  Connecting to database "%s" using DSN "%s"', $name, $params['dsn']), null, 'COMMENT');
      }
      $pdo = $databaseManager->getDatabase($name)->getConnection();
      $database = new Database($name);
      $platform = $this->getPlatform($databaseManager, $name);
      $database->setPlatform($platform);
      $database->setDefaultIdMethod(IDMethod::NATIVE);
      $parser = $this->getParser($databaseManager, $name, $pdo);
      $parser->setMigrationTable($options['migration-table']);
      $parser->setPlatform($platform);
      $nbTables = $parser->parse($database);
      $ad->addDatabase($database);
      $totalNbTables += $nbTables;
      if ($options['verbose'])
      {
        $this->logSection('propel', sprintf('  %d tables imported from database "%s"', $nbTables, $name), null, 'COMMENT');
      }
    }
    if ($totalNbTables) {
      $this->logSection('propel', sprintf('%d tables imported from databases.', $totalNbTables));
    } else {
      $this->logSection('propel', 'Database is empty');
    }

    $this->logSection('propel', 'Loading XML schema files...');
    Phing::startup(); // required to locate behavior classes...
    $this->schemaToXML(self::DO_NOT_CHECK_SCHEMA, 'generated-');
    $this->copyXmlSchemaFromPlugins('generated-');
    $appData = $this->getModels($databaseManager, $options['verbose']);
    $this->logSection('propel', sprintf('%d tables defined in the schema files.', $appData->countTables()));
    $this->cleanup($options['verbose']);

    $this->logSection('propel', 'Comparing databases and schemas...');
    $manager = new PropelMigrationManager();
    $manager->setConnections($connections);
    $migrationsUp = array();
    $migrationsDown = array();
    foreach ($ad->getDatabases() as $database) {
      $name = $database->getName();
      if ($options['verbose'])
      {
        $this->logSection('propel', sprintf('  Comparing database "%s"', $name), null, 'COMMENT');
      }

      if (!$appData->hasDatabase($name)) {
        // FIXME: tables present in database but not in XML
        continue;
      }
      $databaseDiff = PropelDatabaseComparator::computeDiff($database, $appData->getDatabase($name));

      if (!$databaseDiff) {
        if($options['verbose']) {
          $this->logSection('propel', sprintf('  Same XML and database structures for datasource "%s" - no diff to generate', $name), null, 'COMMENT');
        }
        continue;
      }

      $this->logSection('propel', sprintf('Structure of database was modified in datasource "%s": %s', $name, $databaseDiff->getDescription()));
      if ($options['verbose'])
      {
        $this->logBlock($databaseDiff, 'COMMENT');
      }
      $platform = $this->getPlatform($databaseManager, $name);
      $migrationsUp[$name] = $platform->getModifyDatabaseDDL($databaseDiff);
      $migrationsDown[$name] = $platform->getModifyDatabaseDDL($databaseDiff->getReverseDiff());
    }

    if (!$migrationsUp)
    {
      $this->logSection('propel', 'Same XML and database structures for all datasources - no diff to generate');
      return;
    }

    $timestamp = time();
    $migrationDirectory = sfConfig::get('sf_root_dir') . DIRECTORY_SEPARATOR . $options['migration-dir'];
    $migrationFileName = $manager->getMigrationFileName($timestamp);
    $migrationFilePath = $migrationDirectory . DIRECTORY_SEPARATOR . $migrationFileName;
    if (
      $options['ask-confirmation']
      &&
      !$this->askConfirmation(array(
      sprintf('Migration class will be generated in %s', $migrationFilePath),
      'Are you sure you want to proceed? (Y/n)'
    ), 'QUESTION_LARGE', true))
    {
      $this->logSection('propel', 'Task aborted.');
      return 1;
    }
    $this->getFilesystem()->mkdirs($migrationDirectory);
    $migrationClassBody = $manager->getMigrationClassBody($migrationsUp, $migrationsDown, $timestamp);
    file_put_contents($migrationFilePath, $migrationClassBody);
    $this->logSection('propel', sprintf('"%s" file successfully created in %s', $migrationFileName, $migrationDirectory));

    if ($editorCmd = $options['editor-cmd'])
    {
      $this->logSection('propel', sprintf('Using "%s" as text editor', $editorCmd));
      shell_exec($editorCmd . ' ' . escapeshellarg($migrationFilePath));
    }
    else
    {
      $this->logSection('propel', '  Please review the generated SQL statements, and add data migration code if necessary.');
      $this->logSection('propel', '  Once the migration class is valid, call the "propel:migrate" task to execute it.');
    }
  }

}
