<?php

class PropelPDOFactory
{
  /**
   * @static
   * @param string $connectionName
   * @return PropelPDO
   */
  public static function instanciate($connectionName)
  {
    $propelConfiguration = Propel::getConfiguration();

    if(isset($propelConfiguration['datasources'][$connectionName]['connection']))
    {
      $parameters = $propelConfiguration['datasources'][$connectionName]['connection'];
    }
    else if(isset($propelConfiguration['datasources'][Propel::getDefaultDB()]))
    {
      $propelConfiguration['datasources'][$connectionName] = $propelConfiguration['datasources'][Propel::getDefaultDB()];
      Propel::setConfiguration(new PropelConfiguration($propelConfiguration));

      $parameters = $propelConfiguration['datasources'][$connectionName]['connection'];
    }
    else
    {
      throw new Exception(sprintf("Unable to find connection parameters for connection '%s'", $connectionName));
    }

    return Propel::initConnection($parameters, $connectionName);
  }
}
