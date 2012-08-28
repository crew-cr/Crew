<?php

/**
 * @property GitCommand $gitCommand
 */
abstract class crewAction extends sfAction
{
  public function preExecute()
  {
    $this->gitCommand = $this->getContext()->getGitCommand();
  }
}
