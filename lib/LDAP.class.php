<?php

class LDAP
{
  /**
   * @var 
   */
  private $host;
  
  /**
   * @var 
   */
  private $domain;
  
  /**
   * 
   */
  public function __construct()
  {
  }
  
  /**
   * @throws sfException
   * @param $username
   * @param $password
   * @return bool
   */
  public function checkPassword($username, $password)
  {
    if (!function_exists('ldap_connect'))
    {
      throw new sfException("LDAP enabled in configuration but LDAP PHP extension not available");
    }
    
    if (!$this->getHost())
    {
      throw new sfException("Empty LDAP host");
    }

    if (!$this->getDomain())
    {
      throw new sfException("Empty LDAP domain");
    }

    $handle = @ldap_connect(sprintf('ldap://%s/', $this->getHost()));
    if (!$handle)
    {
      throw new sfException(sprintf("Unable to connect to LDAP server %s", $this->getHost()));
    }

    return @ldap_bind($handle, $username.'@'.$this->getDomain(), $password);
  }

  /**
   * @param $domain
   * @return LDAP
   */
  public function setDomain($domain)
  {
    $this->domain = $domain;
    return $this;
  }

  /**
   * @return 
   */
  public function getDomain()
  {
    return $this->domain;
  }

  /**
   * @param $host
   * @return LDAP
   */
  public function setHost($host)
  {
    $this->host = $host;
    return $this;
  }

  /**
   * @return 
   */
  public function getHost()
  {
    return $this->host;
  }
}