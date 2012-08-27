<?php

/**
 * @property GitCommand $gitCommand
 */
abstract class crewAction extends sfAction
{
  public function preExecute()
  {
    $this->gitCommand = new GitCommand(new GitDBLogger(PropelPDOFactory::instanciate('logger')));
  }
}
