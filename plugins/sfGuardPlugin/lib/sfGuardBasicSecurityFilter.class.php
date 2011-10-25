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
 * @package    symfony
 * @subpackage plugin
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfGuardBasicSecurityFilter.class.php 15757 2009-02-24 21:15:40Z Kris.Wallsmith $
 * 
 * @deprecated Use {@link sfGuardRememberMeFilter} instead
 */
class sfGuardBasicSecurityFilter extends sfBasicSecurityFilter
{
  /**
   * @see sfFilter
   */
  public function execute($filterChain)
  {
    $cookieName = sfConfig::get('app_sf_guard_plugin_remember_cookie_name', 'sfRemember');

    if ($this->isFirstCall())
    {
      // deprecated notice
      $this->context->getEventDispatcher()->notify(new sfEvent($this, 'application.log', array(sprintf('The filter "%s" is deprecated. Use "sfGuardRememberMeFilter" instead.', __CLASS__), 'priority' => sfLogger::NOTICE)));

      if (
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
    }

    parent::execute($filterChain);
  }
}
