<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 *
 * @package    symfony
 * @subpackage plugin
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfGuardSecurityUser.class.php 30260 2010-07-16 13:55:09Z fabien $
 */
class sfGuardSecurityUser extends sfBasicSecurityUser
{
  protected
    $user = null;

  public function initialize(sfEventDispatcher $dispatcher, sfStorage $storage, $options = array())
  {
    parent::initialize($dispatcher, $storage, $options);

    if (!$this->isAuthenticated())
    {
      // remove user if timeout
      $this->getAttributeHolder()->removeNamespace('sfGuardSecurityUser');
      $this->user = null;
    }
  }

  public function getReferer($default)
  {
    $referer = $this->getAttribute('referer', $default);
    $this->getAttributeHolder()->remove('referer');

    return $referer ? $referer : $default;
  }

  public function setReferer($referer)
  {
    $this->setAttribute('referer', $referer);
  }

  public function hasCredential($credential, $useAnd = true)
  {
    if (empty($credential))
    {
      return true;
    }

    if (!$this->getGuardUser())
    {
      return false;
    }

    if ($this->getGuardUser()->getIsSuperAdmin())
    {
      return true;
    }

    return parent::hasCredential($credential, $useAnd);
  }

  public function isSuperAdmin()
  {
    return $this->getGuardUser() ? $this->getGuardUser()->getIsSuperAdmin() : false;
  }

  public function isAnonymous()
  {
    return !$this->isAuthenticated();
  }

  public function signIn($user, $remember = false, $con = null)
  {
    // signin
    $this->setAttribute('user_id', $user->getId(), 'sfGuardSecurityUser');
    $this->setAuthenticated(true);
    $this->clearCredentials();
    $this->addCredentials($user->getAllPermissionNames());

    // save last login
    $user->setLastLogin(time());
    $user->save($con);

    // remember?
    if ($remember)
    {
      // remove old keys
      $c = new Criteria();
      $expiration_age = sfConfig::get('app_sf_guard_plugin_remember_key_expiration_age', 15 * 24 * 3600);
      $c->add(sfGuardRememberKeyPeer::CREATED_AT, time() - $expiration_age, Criteria::LESS_THAN);
      sfGuardRememberKeyPeer::doDelete($c, $con);

      // remove other keys from this user
      $c = new Criteria();
      $c->add(sfGuardRememberKeyPeer::USER_ID, $user->getId());
      sfGuardRememberKeyPeer::doDelete($c, $con);

      // generate new keys
      $key = $this->generateRandomKey();

      // save key
      $rk = new sfGuardRememberKey();
      $rk->setRememberKey($key);
      $rk->setSfGuardUser($user);
      $rk->setIpAddress($_SERVER['REMOTE_ADDR']);
      $rk->save($con);

      // make key as a cookie
      $remember_cookie = sfConfig::get('app_sf_guard_plugin_remember_cookie_name', 'sfRemember');
      sfContext::getInstance()->getResponse()->setCookie($remember_cookie, $key, time() + $expiration_age);
    }
  }

  protected function generateRandomKey($len = 20)
  {
    return base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
  }

  public function signOut()
  {
    $this->getAttributeHolder()->removeNamespace('sfGuardSecurityUser');
    $this->user = null;
    $this->clearCredentials();
    $this->setAuthenticated(false);
    $expiration_age = sfConfig::get('app_sf_guard_plugin_remember_key_expiration_age', 15 * 24 * 3600);
    $remember_cookie = sfConfig::get('app_sf_guard_plugin_remember_cookie_name', 'sfRemember');
    sfContext::getInstance()->getResponse()->setCookie($remember_cookie, '', time() - $expiration_age);
  }

  public function getGuardUser()
  {
    if (!$this->user && $id = $this->getAttribute('user_id', null, 'sfGuardSecurityUser'))
    {
      $this->user = sfGuardUserPeer::retrieveByPk($id);

      if (!$this->user)
      {
        // the user does not exist anymore in the database
        $this->signOut();

        throw new sfException('The user does not exist anymore in the database.');
      }
    }

    return $this->user;
  }

  // add some proxy method to the sfGuardUser instance

  public function __toString()
  {
    return $this->getGuardUser()->__toString();
  }

  public function getUsername()
  {
    return $this->getGuardUser()->getUsername();
  }

  public function getEmail()
  {
    return $this->getGuardUser()->getEmail();
  }

  public function setPassword($password, $con = null)
  {
    $this->getGuardUser()->setPassword($password);
    $this->getGuardUser()->save($con);
  }

  public function checkPassword($password)
  {
    return $this->getGuardUser()->checkPassword($password);
  }

  public function hasGroup($name)
  {
    return $this->getGuardUser() ? $this->getGuardUser()->hasGroup($name) : false;
  }

  public function getGroups()
  {
    return $this->getGuardUser() ? $this->getGuardUser()->getGroups() : array();
  }

  public function getGroupNames()
  {
    return $this->getGuardUser() ? $this->getGuardUser()->getGroupNames() : array();
  }

  public function hasPermission($name)
  {
    return $this->getGuardUser() ? $this->getGuardUser()->hasPermission($name) : false;
  }

  public function getPermissions()
  {
    return $this->getGuardUser()->getPermissions();
  }

  public function getPermissionNames()
  {
    return $this->getGuardUser() ? $this->getGuardUser()->getPermissionNames() : array();
  }

  public function getAllPermissions()
  {
    return $this->getGuardUser() ? $this->getGuardUser()->getAllPermissions() : array();
  }

  public function getAllPermissionNames()
  {
    return $this->getGuardUser() ? $this->getGuardUser()->getAllPermissionNames() : array();
  }

  public function getProfile()
  {
    return $this->getGuardUser() ? $this->getGuardUser()->getProfile() : null;
  }

  public function addGroupByName($name, $con = null)
  {
    return $this->getGuardUser()->addGroupByName($name, $con);
  }

  public function addPermissionByName($name, $con = null)
  {
    return $this->getGuardUser()->addPermissionByName($name, $con);
  }
}
