<?php
class deleteTablesTask extends sfBaseTask 
{
  protected function configure()
  {
    $this->namespace = 'crew';
    $this->name = 'delete-tables';
    $this->briefDescription = "Drop every table in the configured database";

    $this->addOptions(array(
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'propel'),
      new sfCommandOption('no-confirmation', null, sfCommandOption::PARAMETER_NONE, "No confirmation before dropping tables"),
    ));
  }

  protected function execute($arguments = array(), $options = array())
  {
    $databaseManager = new sfDatabaseManager($this->configuration);
    $con = $databaseManager->getDatabase($options['connection'])->getConnection();
    
    if (!$options['no-confirmation'] && !$this->askConfirmation(array("This task will drop every table in the project", 'Do you want to continue ? (y/N)'), null, false))
    {
      $this->logSection('Task cancelled', '');
      return 1;
    }
    
    $con = Propel::getConnection();
    $con->exec("SET FOREIGN_KEY_CHECKS = 0");
    foreach($con->query("SHOW TABLES") as $row)
    {
      $con->exec(sprintf("DROP TABLE `%s`", $row[0]));
      $this->logSection('table-', sprintf("Table %s dropped", $row[0]));
    }
    $con->exec("SET FOREIGN_KEY_CHECKS = 1");

    return 0;
  }
}
