<?php

abstract class crewAction extends sfAction
{
  public function preExecute()
  {
    $this->gitCommand = new GitCommand(new GitDBLogger(Propel::getConnection()));
  }
}
