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
  private $version;
  
  /**
   * @var
   */
  private $RDNFormat;
  
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

    $handle = @ldap_connect(sprintf('ldap://%s/', $this->getHost()));
    if (!$handle)
    {
      throw new sfException(sprintf("Unable to connect to LDAP server %s", $this->getHost()));
    }
    
    if (!ldap_set_option($handle, LDAP_OPT_PROTOCOL_VERSION, $this->getVersion())) 
    {
        throw new sfException(sprintf("Unable to set version on LDAP server %s", $this->getHost()));
    }
    
    $rdn = sprintf($this->getRDNFormat(), $username);
    if (!strlen($rdn))
    {
      throw new sfException("Bind RDN value cannot be empty");
    }
    return ldap_bind($handle, $rdn, $password);
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
  
  /**
   * @param $version
   * @return LDAP
   */
  public function setVersion($version)
  {
    $this->version = $version;
    return $this;
  }

  /**
   * @return 
   */
  public function getVersion()
  {
    return $this->version;
  }

    /**
   * @param $RNDFormat
   * @return LDAP
   */
  public function setRDNFormat($RDNFormat)
  {
    $this->RDNFormat = $RDNFormat;
    return $this;
  }

  /**
   * @return 
   */
  public function getRDNFormat()
  {
    return $this->RDNFormat;
  }

}