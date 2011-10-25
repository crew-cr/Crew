<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Processes the "remember me" cookie.
 * 
 * This filter should be added to the application filters.yml file **above**
 * the security filter:
 * 
 *    remember_me:
 *      class: sfGuardRememberMeFilter
 * 
 *    security: ~
 * 
 * @package    symfony
 * @subpackage plugin
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfGuardRememberMeFilter.class.php 15757 2009-02-24 21:15:40Z Kris.Wallsmith $
 */
class sfGuardRememberMeFilter extends sfFilter
{
  /**
   * @see sfFilter
   */
  public function execute($filterChain)
  {
    $cookieName = sfConfig::get('app_sf_guard_plugin_remember_cookie_name', 'sfRemember');

    if (
      $this->isFirstCall()
      &&
      $this->context->getUser()->isAnonymous()
      &&
      $cookie = $this->context->getRequest()->getCookie($cookieName)
    )
    {
      $criteria = new Criteria();
      $criteria->add(sfGuardRememberKeyPeer::REMEMBER_KEY, $cookie);

      if ($rk = sfGuardRememberKeyPeer::doSelectOne($criteria))
      {
        $this->context->getUser()->signIn($rk->getsfGuardUser());
      }
    }

    $filterChain->execute();
  }
}
