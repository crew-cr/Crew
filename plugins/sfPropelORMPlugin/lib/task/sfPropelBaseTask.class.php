<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Base class for all symfony Propel tasks.
 *
 * @package    symfony
 * @subpackage propel
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfPropelBaseTask.class.php 23739 2009-11-09 23:32:46Z Kris.Wallsmith $
 */
abstract class sfPropelBaseTask extends sfBaseTask
{
  const CHECK_SCHEMA = true;
  const DO_NOT_CHECK_SCHEMA = false;

  static protected $done = false;

  protected $additionalPhingArgs = array();

  public function initialize(sfEventDispatcher $dispatcher, sfFormatter $formatter)
  {
    parent::initialize($dispatcher, $formatter);

    if (!self::$done)
    {
      sfToolkit::addIncludePath(array(
        realpath(dirname(__FILE__).'/../vendor'),
        dirname(__FILE__),
      ));

      self::$done = true;
    }
  }

  protected function process(sfCommandManager $commandManager, $options)
  {
    parent::process($commandManager, $options);

    // capture phing-arg options
    if ($commandManager->getOptionSet()->hasOption('phing-arg'))
    {
      $this->additionalPhingArgs = $commandManager->getOptionValue('phing-arg');
    }
  }

  protected function schemaToYML($checkSchema = self::CHECK_SCHEMA, $prefix = '', $verbose = false)
  {
    $finder = sfFinder::type('file')->name('*schema.xml')->prune('doctrine');

    $schemas = array_unique(array_merge($finder->in(sfConfig::get('sf_config_dir')), $finder->in($this->configuration->getPluginSubPaths('/config'))));
    if (self::CHECK_SCHEMA === $checkSchema && !count($schemas))
    {
      throw new sfCommandException('You must create a schema.xml file.');
    }

    $dbSchema = new sfPropelDatabaseSchema();
    foreach ($schemas as $schema)
    {
      $dbSchema->loadXML($schema);

      if ($verbose)
      {
        $this->logSection('schema', sprintf('  converting "%s" to YML', $schema), null, 'COMMENT');
      }

      $localprefix = $prefix;

      // change prefix for plugins
      if (preg_match('#plugins[/\\\\]([^/\\\\]+)[/\\\\]#', $schema, $match))
      {
        $localprefix = $prefix.$match[1].'-';
      }

      // save converted xml files in original directories
      $yml_file_name = str_replace('.xml', '.yml', basename($schema));

      $file = str_replace(basename($schema), $prefix.$yml_file_name,  $schema);
      if ($verbose)
      {
        $this->logSection('schema', sprintf('  putting %s', $file), null, 'COMMENT');
      }
      file_put_contents($file, $dbSchema->asYAML());
    }
  }

  protected function schemaToXML($checkSchema = self::CHECK_SCHEMA, $prefix = '', $verbose = false)
  {
    $finder = sfFinder::type('file')->name('*schema.yml')->prune('doctrine');
    $dirs = array_merge(array(sfConfig::get('sf_config_dir')), $this->configuration->getPluginSubPaths('/config'));
    $schemas = $finder->in($dirs);
    if (self::CHECK_SCHEMA === $checkSchema && !count($schemas))
    {
      throw new sfCommandException('You must create a schema.yml file.');
    }

    $dbSchema = new sfPropelDatabaseSchema();

    foreach ($schemas as $schema)
    {
      $schemaArray = sfYaml::load($schema);

      if (!is_array($schemaArray))
      {
        continue; // No defined schema here, skipping
      }

      if (!isset($schemaArray['classes']))
      {
        // Old schema syntax: we convert it
        $schemaArray = $dbSchema->convertOldToNewYaml($schemaArray);
      }

      $customSchemaFilename = str_replace(array(
        str_replace(DIRECTORY_SEPARATOR, '/', sfConfig::get('sf_root_dir')).'/',
        'plugins/',
        'config/',
        '/',
        'schema.yml'
      ), array('', '', '', '_', 'schema.custom.yml'), $schema);
      $customSchemas = sfFinder::type('file')->name($customSchemaFilename)->in($dirs);

      foreach ($customSchemas as $customSchema)
      {
        if ($verbose)
        {
          $this->logSection('schema', sprintf('  found custom schema %s', $customSchema), null, 'COMMENT');
        }

        $customSchemaArray = sfYaml::load($customSchema);
        if (!isset($customSchemaArray['classes']))
        {
          // Old schema syntax: we convert it
          $customSchemaArray = $dbSchema->convertOldToNewYaml($customSchemaArray);
        }
        $schemaArray = sfToolkit::arrayDeepMerge($schemaArray, $customSchemaArray);
      }

      $dbSchema->loadArray($schemaArray);

      if ($verbose)
      {
        $this->logSection('schema', sprintf('  converting "%s" to XML', $schema), null, 'COMMENT');
      }

      $localprefix = $prefix;

      // change prefix for plugins
      if (preg_match('#plugins[/\\\\]([^/\\\\]+)[/\\\\]#', $schema, $match))
      {
        $localprefix = $prefix.$match[1].'-';
      }

      // save converted xml files in original directories
      $xml_file_name = str_replace('.yml', '.xml', basename($schema));

      $file = str_replace(basename($schema), $localprefix.$xml_file_name,  $schema);
      if ($verbose)
      {
        $this->logSection('schema', sprintf('  putting %s', $file), null, 'COMMENT');
      }
      file_put_contents($file, $dbSchema->asXML());
    }
  }

  protected function copyXmlSchemaFromPlugins($prefix = '')
  {
    if (!$dirs = $this->configuration->getPluginSubPaths('/config'))
    {
      return;
    }

    $schemas = sfFinder::type('file')->name('*schema.xml')->prune('doctrine')->in($dirs);
    foreach ($schemas as $schema)
    {
      // reset local prefix
      $localprefix = '';

      // change prefix for plugins
      if (preg_match('#plugins[/\\\\]([^/\\\\]+)[/\\\\]#', $schema, $match))
      {
        // if the plugin name is not in the schema filename, add it
        if (!strstr(basename($schema), $match[1]))
        {
          $localprefix = $match[1].'-';
        }
      }

      // if the prefix is not in the schema filename, add it
      if (!strstr(basename($schema), $prefix))
      {
        $localprefix = $prefix.$localprefix;
      }

      $this->getFilesystem()->copy($schema, 'config'.DIRECTORY_SEPARATOR.$localprefix.basename($schema));
      if ('' === $localprefix)
      {
        $this->getFilesystem()->remove($schema);
      }
    }
  }

  protected function cleanup($verbose = false)
  {
    if (!$verbose)
    {
      $detachedDispatcher = $this->dispatcher;
      // set the dispatcher to null to avoid logging from sfFilesystem::remove()
      $this->dispatcher = null;
    }
    if (null === $this->commandApplication || !$this->commandApplication->withTrace())
    {
      $finder = sfFinder::type('file')->name('generated-*schema.xml')->name('*schema-transformed.xml');
      $this->getFilesystem()->remove($finder->in(array('config', 'plugins')));
    }
    if (!$verbose)
    {
      $this->dispatcher = $detachedDispatcher;
    }
  }

  protected function callPhing($taskName, $checkSchema, $properties = array())
  {
    $schemas = sfFinder::type('file')->name('*schema.xml')->relative()->follow_link()->in(sfConfig::get('sf_config_dir'));
    if (self::CHECK_SCHEMA === $checkSchema && !$schemas)
    {
      throw new sfCommandException('You must create a schema.yml or schema.xml file.');
    }

    // Call phing targets
    sfToolkit::addIncludePath(array(
      sfConfig::get('sf_symfony_lib_dir'),
      sfConfig::get('sf_propel_generator_path', sfConfig::get('sf_propel_path').'generator/lib'),
    ));

    $args = array();
    $bufferPhingOutput = null === $this->commandApplication || !$this->commandApplication->withTrace();

    $properties = array_merge(array(
      'build.properties'  => 'propel.ini',
      'project.dir'       => sfConfig::get('sf_config_dir'),
      'propel.output.dir' => sfConfig::get('sf_root_dir'),
    ), $properties);
    foreach ($properties as $key => $value)
    {
      $args[] = "-D$key=$value";
    }

    // Build file
    $args[] = '-f';
    $args[] = realpath(sfConfig::get('sf_propel_path').DIRECTORY_SEPARATOR.'generator'.DIRECTORY_SEPARATOR.'build.xml');

    // Logger
    if (DIRECTORY_SEPARATOR != '\\' && (function_exists('posix_isatty') && @posix_isatty(STDOUT)))
    {
      $args[] = '-logger';
      $args[] = 'phing.listener.AnsiColorLogger';
    }

    // Add our listener to detect errors
    $args[] = '-listener';
    $args[] = 'sfPhingListener';

    // Add any arbitrary arguments last
    foreach ($this->additionalPhingArgs as $arg)
    {
      if (in_array($arg, array('verbose', 'debug')))
      {
        $bufferPhingOutput = false;
      }

      $args[] = '-'.$arg;
    }

    $args[] = $taskName;

    // filter arguments through the event dispatcher
    $args = $this->dispatcher->filter(new sfEvent($this, 'propel.filter_phing_args'), $args)->getReturnValue();

    require_once dirname(__FILE__).'/sfPhing.class.php';

    // enable output buffering
    Phing::setOutputStream(new OutputStream(fopen('php://output', 'w')));
    Phing::startup();
    Phing::setProperty('phing.home', getenv('PHING_HOME'));

    $this->logSection('propel', 'Running "'.$taskName.'" phing task');

    if ($bufferPhingOutput)
    {
      ob_start();
    }

    $m = new sfPhing();
    $m->execute($args);
    $m->runBuild();

    if ($bufferPhingOutput)
    {
      ob_end_clean();
    }

    chdir(sfConfig::get('sf_root_dir'));

    // any errors?
    $ret = true;
    if (sfPhingListener::hasErrors())
    {
      $messages = array('Some problems occurred when executing the task:');

      foreach (sfPhingListener::getExceptions() as $exception)
      {
        $messages[] = '';
        $messages[] = preg_replace('/^.*build\-propel\.xml/', 'build-propel.xml', $exception->getMessage());
        $messages[] = '';
      }

      if (count(sfPhingListener::getErrors()))
      {
        $messages[] = 'If the exception message is not clear enough, read the output of the task for';
        $messages[] = 'more information';
      }

      $this->logBlock($messages, 'ERROR_LARGE');

      $ret = false;
    }

    return $ret;
  }

  protected function getPhingPropertiesForConnection($databaseManager, $connection)
  {
    $database = $databaseManager->getDatabase($connection);

    return array(
      'propel.database'          => $database->getParameter('phptype'),
      'propel.database.driver'   => $database->getParameter('phptype'),
      'propel.database.url'      => $database->getParameter('dsn'),
      'propel.database.user'     => $database->getParameter('username'),
      'propel.database.password' => $database->getParameter('password'),
      'propel.database.encoding' => $database->getParameter('encoding'),
    );
  }

  public function getConnections($databaseManager)
  {
    $connections = array();
    foreach ($databaseManager->getNames() as $connectionName)
    {
      $database = $databaseManager->getDatabase($connectionName);
      $connections[$connectionName] = array(
        'adapter'  => $database->getParameter('phptype'),
        'dsn'      => $database->getParameter('dsn'),
        'user'     => $database->getParameter('username'),
        'password' => $database->getParameter('password'),
      );
    }
    return $connections;
  }

  public function getConnection($databaseManager, $connection)
  {
    $database = $databaseManager->getDatabase($connection);
    return array(
      'adapter'  => $database->getParameter('phptype'),
      'dsn'      => $database->getParameter('dsn'),
      'user'     => $database->getParameter('username'),
      'password' => $database->getParameter('password'),
    );
  }

  protected function getPlatform($databaseManager, $connection)
  {
    $params = $this->getConnection($databaseManager, $connection);
    $platformClass = ucfirst($params['adapter']) . 'Platform';
    include_once sfConfig::get('sf_propel_path') . '/generator/lib/platform/' . $platformClass . '.php';
    $platform = new $platformClass();
    $platform->setGeneratorConfig($this->getGeneratorConfig());
    return $platform;
  }

  protected function getParser($databaseManager, $connection, $con)
  {
    $params = $this->getConnection($databaseManager, $connection);
    $parserClass = ucfirst($params['adapter']) . 'SchemaParser';
    include_once sfConfig::get('sf_propel_path') . '/generator/lib/reverse/' . $params['adapter'] . '/' . $parserClass . '.php';
    $parser = new $parserClass();
    $parser->setConnection($con);
    $parser->setGeneratorConfig($this->getGeneratorConfig());
    return $parser;
  }

  protected function getModels($databaseManager, $verbose = false)
  {
    Phing::startup(); // required to locate behavior classes...
    $schemas = sfFinder::type('file')
      ->name('*schema.xml')
      ->follow_link()
      ->in(sfConfig::get('sf_config_dir'));
    if (!$schemas)
    {
      throw new sfCommandException('You must create a schema.yml or schema.xml file.');
    }
    $ads = array();

    foreach ($schemas as $schema)
    {
      if ($verbose)
      {
        $this->logSection('schema', sprintf('  Parsing schema "%s"', $schema), null, 'COMMENT');
      }
      $dom = new DomDocument('1.0', 'UTF-8');
      $dom->load($schema);
      //$this->includeExternalSchemas($dom, sfConfig::get('sf_config_dir'));
      $xmlParser = new XmlToAppData(new DefaultPlatform(), '');
      $generatorConfig = $this->getGeneratorConfig();
      $generatorConfig->setBuildConnections($this->getConnections($databaseManager));
      $xmlParser->setGeneratorConfig($generatorConfig);

      $ad = $xmlParser->parseString($dom->saveXML(), $schema);
      $ads[] = $ad;
      $nbTables = $ad->getDatabase(null, false)->countTables();
      if ($verbose)
      {
        $this->logSection('schema', sprintf('  %d tables processed successfully', $nbTables), null, 'COMMENT');
      }
    }
    if (count($ads)>1) {
      $ad = array_shift($ads);
      $ad->joinAppDatas($ads);
      //$ad = $this->joinDataModels($ads);
      //$this->dataModels = array($ad);
    } else {
      $ad = $ads[0];
    }
    $ad->doFinalInitialization();
    return $ad;
  }

  protected function getGeneratorConfig($params = array())
  {
    $iniFile = sfConfig::get('sf_config_dir'). '/propel.ini';
    if (!$params && file_exists($iniFile))
    {
      $params = parse_ini_file($iniFile);
    }
    $behaviorsMapping = array(
      'timestampable' => 'TimestampableBehavior',
      'alternative_coding_standards' => 'AlternativeCodingStandardsBehavior',
      'soft_delete' => 'SoftDeleteBehavior',
      'auto_add_pk' => 'AutoAddPkBehavior',
      'nested_set' => 'nestedset.NestedSetBehavior',
      'sortable' => 'sortable.SortableBehavior',
      'sluggable' => 'sluggable.SluggableBehavior',
      'concrete_inheritance' => 'concrete_inheritance.ConcreteInheritanceBehavior',
      'query_cache' => 'query_cache.QueryCacheBehavior',
      'aggregate_column' => 'aggregate_column.AggregateColumnBehavior',
      'versionable' => 'versionable.VersionableBehavior',
      'i18n' => 'i18n.I18nBehavior',
    );
    foreach ($behaviorsMapping as $behavior => $value) {
      $key = 'propel.behavior.' . $behavior . '.class';
      if (!isset($params[$key])) {
        $params[$key] = 'behavior.' . $value;
      }
    }

    sfToolkit::addIncludePath(array(
      sfConfig::get('sf_propel_generator_path', realpath(dirname(__FILE__).'/../vendor/propel/generator/lib')),
    ));
    require_once 'config/GeneratorConfig.php';
    return new GeneratorConfig($params);
  }

  protected function getProperties($file)
  {
    $properties = array();

    if (false === $lines = @file($file))
    {
      throw new sfCommandException('Unable to parse contents of the "sqldb.map" file.');
    }

    foreach ($lines as $line)
    {
      $line = trim($line);

      if ('' == $line)
      {
        continue;
      }

      if (in_array($line[0], array('#', ';')))
      {
        continue;
      }

      $pos = strpos($line, '=');
      $properties[trim(substr($line, 0, $pos))] = trim(substr($line, $pos + 1));
    }

    return $properties;
  }

  /**
   * Write an XML file which represents propel.configuration
   *
   * @param $databaseManager
   * @param string $file    Should be 'buildtime-conf.xml'.
   */
  protected function createBuildTimeFile($databaseManager, $file)
  {
    $xml = strtr(<<<EOT
<?xml version="1.0"?>
<config>
    <propel>
        <datasources default="%default_connection%">

EOT
    , array('%default_connection%' => 'propel'));

    foreach ($this->getConnections($databaseManager) as $name => $datasource)
    {
      $xml .= strtr(<<<EOT
            <datasource id="%name%">
                <adapter>%adapter%</adapter>
                <connection>
                    <dsn>%dsn%</dsn>
                    <user>%username%</user>
                    <password>%password%</password>
                </connection>
            </datasource>

EOT
      , array(
        '%name%'     => $name,
        '%adapter%'  => $datasource['adapter'],
        '%dsn%'      => $datasource['dsn'],
        '%username%' => $datasource['user'],
        '%password%' => $datasource['password'],
      ));
    }

    $xml .= <<<EOT
        </datasources>
    </propel>
</config>
EOT;

    file_put_contents($file, $xml);
  }
}
