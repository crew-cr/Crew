<?php

/**
 * sfGuardPermission form.
 *
 * @package    form
 * @subpackage sf_guard_permission
 * @version    SVN: $Id: sfGuardPermissionForm.class.php 12896 2008-11-10 19:02:34Z fabien $
 */
class sfGuardPermissionForm extends BasesfGuardPermissionForm
{
  public function configure()
  {
    unset($this['sf_guard_user_permission_list']);

    $this->widgetSchema['sf_guard_group_permission_list']->setLabel('Groups');
  }
}
