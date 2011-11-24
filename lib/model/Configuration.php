<?php



/**
 * Skeleton subclass for representing a row from the 'configuration' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.lib.model
 */
class Configuration extends BaseConfiguration {
  
  /**
   * @static
   * @param $name
   * @param null $default
   * @return null|string
   */
  public static function get($name, $default = null)
  {
    $configuration = ConfigurationPeer::retrieveByName($name);
    
    return $configuration ? $configuration->getValue() : $default;
  }
  
  /**
   * @static
   * @param $name
   * @param $value
   * @return void
   */
  public static function set($name, $value)
  {
    $configuration = ConfigurationPeer::retrieveByName($name);
    
    if (!$configuration)
    {
      $configuration = new Configuration();
      $configuration->setName($name);
    }
    
    $configuration->setValue($value);
    $configuration->save();
  }

} // Configuration
