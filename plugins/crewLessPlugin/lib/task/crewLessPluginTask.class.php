<?php

class crewLessPluginTask extends sfBaseTask
{
  /**
   * @return void
   */
  protected function configure()
  {
    $this->namespace = 'crew';
    $this->name = 'less-compile';
    $this->aliases = array('lessc');
    $this->briefDescription = 'Compile less files';
  }

  /**
   * @param array $arguments
   * @param array $options
   * @return void
   */
  protected function execute($arguments = array(), $options = array())
  {
    $lessc = new less();
    $lessc->compileLessFiles();
  }
}