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
    $ldapDomain = Configuration::get('ldap_domain', false);

    $ldap = new LDAP();
    $ldap->setHost($ldapHost);
    $ldap->setDomain($ldapDomain);
        
    return $ldap->checkPassword($username, $password);
  }
}
