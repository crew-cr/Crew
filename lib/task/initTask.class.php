<?php

class initTask extends sfBaseTask
{
  protected function configure()
  {
    // // add your own arguments here
    // $this->addArguments(array(
    //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
    // ));

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

  [php symfony init|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

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

    return 0;
  }
}
