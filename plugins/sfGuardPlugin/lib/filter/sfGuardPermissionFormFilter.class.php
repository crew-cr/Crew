<?php

/**
 * sfGuardPermission filter form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfGuardPermissionFormFilter.class.php 12896 2008-11-10 19:02:34Z fabien $
 */
class sfGuardPermissionFormFilter extends BasesfGuardPermissionFormFilter
{
  public function configure()
  {
    unset($this['sf_guard_user_permission_list']);

    $this->widgetSchema['sf_guard_group_permission_list']->setLabel('Groups');
  }
}
