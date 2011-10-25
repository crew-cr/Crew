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
 * @version    SVN: $Id: PluginsfGuardGroupPeer.php 12075 2008-10-08 16:15:03Z noel $
 */
class PluginsfGuardGroupPeer extends BasesfGuardGroupPeer
{
  public static function retrieveByName($name)
  {
    $c = new Criteria();
    $c->add(self::NAME, $name);

    return self::doSelectOne($c);
  }

  // TBB (tom@punkave.com): we implement our own criteria for the
  // groups filter. But the admin generator still has nonfunctional code 
  // for it in the base class, code that wants to see a GROUPS constant here. 
  // We prevent that code from actually executing by temporarily unsetting 
  // $filter['groups'], and in PHP 5.2.x, that is sufficient. However, 
  // a future version of PHP might refuse to compile code that refers to a 
  // nonexistent constant at all, even if it never runs. So let's be thorough 
  // and define the GROUPS constant that the base class code is looking for.

  const GROUPS = 'dummy';
}
