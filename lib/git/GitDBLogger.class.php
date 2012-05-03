<?php

class GitDBLogger implements GitLogger
{
  protected $connection;
  
  public function __construct(PDO $con)
  {
    $this->connection = $con;
  }
  
  public function log($command, $code, $message)
  {
    $log = new LogGit();

    $this->connection->beginTransaction();
    try
    {
      $log->setCommand($command)->setCode($code)->setMessage($message)->save($this->connection);
      $this->connection->commit();
    }
    catch (Exception $e)
    {
      $this->connection->rollBack();
    }
  }
}
