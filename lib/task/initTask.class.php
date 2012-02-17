<?php

class initTask extends sfBaseTask
{
  protected function configure()
  {
    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'propel'),
      // add your own options here
    ));

    $this->namespace        = 'crew';
    $this->name             = 'init';
    $this->briefDescription = 'Initialization of the Crew project';
    $this->detailedDescription = <<<EOF
The [init|INFO] task does things.
Call it with:

  [php symfony crew:init|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    ini_set('memory_limit', '64M');
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();
    
    // delete previous tables
    $deleteTablesTask = new deleteTablesTask($this->dispatcher, $this->formatter);
    $return = $deleteTablesTask->run(array(), array('no-confirmation', 'connection' => $options['connection']));
    if ($return)
    {
      return $return;
    }

    // generates Propel model and form classes, SQL and initializes the database
    $propelBuildAllTask = new sfPropelBuildAllTask($this->dispatcher, $this->formatter);
    $return = $propelBuildAllTask->run(array(), array('no-confirmation'));
    if ($return)
    {
      return $return;
    }

    // loads YAML fixture data
    $propelDataLoadTask = new sfPropelDataLoadTask($this->dispatcher, $this->formatter);
    $return = $propelDataLoadTask->run(array(), array());
    if ($return)
    {
      return $return;
    }

    // clear cache
    $clearCacheTask = new cacheClearTask($this->dispatcher, $this->formatter);
    $return = $clearCacheTask->run(array(), array());
    if ($return)
    {
      return $return;
    }

    // clear log
    $clearLogTask = new logClearTask($this->dispatcher, $this->formatter);
    $return = $clearLogTask->run(array(), array());
    if ($return)
    {
      return $return;
    }

    // permission
    $permissionsTask = new sfProjectPermissionsTask($this->dispatcher, $this->formatter);
    $return = $permissionsTask->run(array(), array());
    if ($return)
    {
      return $return;
    }

    return 0;
  }
}
