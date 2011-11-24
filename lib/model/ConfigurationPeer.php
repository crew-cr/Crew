<?php



/**
 * Skeleton subclass for performing query and update operations on the 'configuration' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.lib.model
 */
class ConfigurationPeer extends BaseConfigurationPeer {
  
  /**
   * @static
   * @param $name
   * @return Configuration
   */
  public static function retrieveByName($name)
  {
    $c = new Criteria();
    $c->add(self::NAME, $name);
    return self::doSelectOne($c);
  }

} // ConfigurationPeer
