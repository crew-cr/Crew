<?php

class configTask extends sfBaseTask
{
  /**
   * @return void
   */
  protected function configure()
  {
    $this->namespace = 'crew';
    $this->name      = 'config';
    $this->briefDescription = "Configuration setter/getter";

    $this->addArguments(array(
      new sfCommandArgument('mode', sfCommandArgument::REQUIRED, 'Configuration mode (set, get or remove)'),
      new sfCommandArgument('name', sfCommandArgument::REQUIRED, 'Configuration name'),
      new sfCommandArgument('value', sfCommandArgument::OPTIONAL, 'Configuration value', null),
    ));
  }

  /**
   * @param array $arguments
   * @param array $options
   * @return int
   */
  protected function execute($arguments = array(), $options = array())
  {
    $databaseManager = new sfDatabaseManager($this->configuration);
    
    $validModes = array('get', 'set', 'remove');
    
    switch($arguments['mode'])
    {
      case 'get':
        $configValue = Configuration::get($arguments['name']);
        $this->logSection('config', sprintf("Configuration %s value: %s", $arguments['name'], null === $configValue ? 'NULL' : sprintf('"%s"', $configValue)));
        break;
          
      case 'set':
        $configValue = $arguments['value'];
        Configuration::set($arguments['name'], $arguments['value']);
        $this->logSection('config+', sprintf("Configuration %s set to: %s", $arguments['name'], null === $configValue ? 'NULL' : sprintf('"%s"', $configValue)));
        break;
          
      case 'remove':
        Configuration::remove($arguments['name']);
        $this->logSection('config-', sprintf("Configuration %s removed", $arguments['name']));
        break;
      
      default:
        throw new InvalidArgumentException(sprintf("Invalid value for mode argument (%s). One of the following values is accepted: %s", $arguments['mode'], implode(', ', $validModes)));
        break;
    }

    return 0;
  }
}
