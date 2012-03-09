<?php
 
class authLDAP
{
  /**
   * @static
   * @param $username
   * @param $password
   * @return bool
   */
  public static function checkPassword($username, $password)
  {
    $ldapHost   = Configuration::get('ldap_host', false);
    $ldapVersion = Configuration::get('ldap_version', 2);
    $ldapRDNFormat  = Configuration::get('ldap_rdn_format', false);

    $ldap = new LDAP();
    $ldap->setHost($ldapHost);
    $ldap->setVersion($ldapVersion);
    $ldap->setRDNFormat($ldapRDNFormat);
        
    return $ldap->checkPassword($username, $password);
  }
}
