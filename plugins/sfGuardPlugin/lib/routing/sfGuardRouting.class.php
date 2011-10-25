<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 *
 * @package    symfony
 * @subpackage plugin
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfGuardRouting.class.php 15757 2009-02-24 21:15:40Z Kris.Wallsmith $
 */
class sfGuardRouting
{
  /**
   * Listens to the routing.load_configuration event.
   *
   * @param sfEvent An sfEvent instance
   */
  static public function listenToRoutingLoadConfigurationEvent(sfEvent $event)
  {
    $r = $event->getSubject();

    // preprend our routes
    $r->prependRoute('sf_guard_signin', new sfRoute('/login', array('module' => 'sfGuardAuth', 'action' => 'signin')));
    $r->prependRoute('sf_guard_signout', new sfRoute('/logout', array('module' => 'sfGuardAuth', 'action' => 'signout')));
    $r->prependRoute('sf_guard_password', new sfRoute('/request_password', array('module' => 'sfGuardAuth', 'action' => 'password')));
  }

  static public function addRouteForAdminUser(sfEvent $event)
  {
    $event->getSubject()->prependRoute('sf_guard_user', new sfPropelRouteCollection(array(
      'name'                 => 'sf_guard_user',
      'model'                => 'sfGuardUser',
      'module'               => 'sfGuardUser',
      'prefix_path'          => 'sf_guard_user',
      'with_wildcard_routes' => true,
      'requirements'         => array(),
    )));
  }

  static public function addRouteForAdminGroup(sfEvent $event)
  {
    $event->getSubject()->prependRoute('sf_guard_group', new sfPropelRouteCollection(array(
      'name'                 => 'sf_guard_group',
      'model'                => 'sfGuardGroup',
      'module'               => 'sfGuardGroup',
      'prefix_path'          => 'sf_guard_group',
      'with_wildcard_routes' => true,
      'requirements'         => array(),
    )));
  }

  static public function addRouteForAdminPermission(sfEvent $event)
  {
    $event->getSubject()->prependRoute('sf_guard_permission', new sfPropelRouteCollection(array(
      'name'                 => 'sf_guard_permission',
      'model'                => 'sfGuardPermission',
      'module'               => 'sfGuardPermission',
      'prefix_path'          => 'sf_guard_permission',
      'with_wildcard_routes' => true,
      'requirements'         => array(),
    )));
  }
}
