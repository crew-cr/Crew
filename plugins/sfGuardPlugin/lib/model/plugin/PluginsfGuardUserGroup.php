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
 * @version    SVN: $Id: PluginsfGuardUserGroup.php 11426 2008-09-10 06:34:47Z fabien $
 */
class PluginsfGuardUserGroup extends BasesfGuardUserGroup
{
  public function save(PropelPDO $con = null)
  {
    parent::save($con);

    $this->getsfGuardUser($con)->reloadGroupsAndPermissions();
  }
}
