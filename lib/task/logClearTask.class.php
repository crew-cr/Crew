<?php

/**
 * Clears log files.
 *
 * @package    symfony
 * @subpackage task
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfLogClearTask.class.php 23922 2009-11-14 14:58:38Z fabien $
 */
class logClearTask extends sfBaseTask
{
  /**
   * @see sfTask
   */
  protected function configure()
  {
    $this->namespace = 'crew';
    $this->name = 'clear-log';
    $this->aliases = array('ccl');
    $this->briefDescription = 'Complete removal of log files (.gitignore file is not erased)';
  }

  /**
   * @see sfTask
   */
  protected function execute($arguments = array(), $options = array())
  {
    if (!sfConfig::get('sf_log_dir') || !is_dir(sfConfig::get('sf_log_dir')))
    {
      throw new sfException(sprintf('Log directory "%s" does not exist.', sfConfig::get('sf_log_dir')));
    }
    
    try
    {
      $this->getFilesystem()->remove(sfFinder::type('any')
        ->discard('.gitignore')
        ->in(sfConfig::get('sf_log_dir'))
      );
    }
    catch(Exception $e)
    {
      return 1;
    }

    return 0;
  }
}
