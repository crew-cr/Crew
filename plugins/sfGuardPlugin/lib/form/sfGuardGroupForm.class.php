<?php

/**
 * sfGuardGroup form.
 *
 * @package    form
 * @subpackage sf_guard_group
 * @version    SVN: $Id: sfGuardGroupForm.class.php 12896 2008-11-10 19:02:34Z fabien $
 */
class sfGuardGroupForm extends BasesfGuardGroupForm
{
  public function configure()
  {
    unset($this['sf_guard_user_group_list']);

    $this->widgetSchema['sf_guard_group_permission_list']->setLabel('Permissions');
  }
}
