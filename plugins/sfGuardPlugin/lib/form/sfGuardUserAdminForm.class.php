<?php

/**
 * sfGuardUser form for admin.
 *
 * @package    form
 * @subpackage sf_guard_user
 * @version    SVN: $Id: sfGuardUserAdminForm.class.php 13000 2008-11-14 10:44:57Z noel $
 */
class sfGuardUserAdminForm extends BasesfGuardUserForm
{
  protected
    $pkName = null;

  public function configure()
  {
    unset(
      $this['last_login'],
      $this['created_at'],
      $this['salt'],
      $this['algorithm']
    );

    $this->widgetSchema['sf_guard_user_group_list']->setLabel('Groups');
    $this->widgetSchema['sf_guard_user_permission_list']->setLabel('Permissions');

    $this->widgetSchema['password'] = new sfWidgetFormInputPassword();
    $this->validatorSchema['password']->setOption('required', false);
    $this->widgetSchema['password_again'] = new sfWidgetFormInputPassword();
    $this->validatorSchema['password_again'] = clone $this->validatorSchema['password'];

    $this->widgetSchema->moveField('password_again', 'after', 'password');

    $this->mergePostValidator(new sfValidatorSchemaCompare('password', sfValidatorSchemaCompare::EQUAL, 'password_again', array(), array('invalid' => 'The two passwords must be the same.')));

    // profile form?
    $profileFormClass = sfConfig::get('app_sf_guard_plugin_profile_class', 'sfGuardUserProfile').'Form';
    if (class_exists($profileFormClass))
    {
      $profileForm = new $profileFormClass();
      unset($profileForm[$this->getPrimaryKey()]);
      unset($profileForm[sfConfig::get('app_sf_guard_plugin_profile_field_name', 'user_id')]);

      $this->mergeForm($profileForm);
    }
  }

  public function updateObject($values = null)
  {
    parent::updateObject($values);

    // update defaults for profile
    if (!is_null($profile = $this->getProfile()))
    {
      $values = $this->getValues();
      unset($values[$this->getPrimaryKey()]);

      $profile->fromArray($values, BasePeer::TYPE_FIELDNAME);
      $profile->save();
    }

    return $this->object;
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    // update defaults for profile
    if (!is_null($profile = $this->getProfile()))
    {
      $values = $profile->toArray(BasePeer::TYPE_FIELDNAME);
      unset($values[$this->getPrimaryKey()]);

      // update defaults for the main object
      if ($this->isNew)
      {
        $this->setDefaults(array_merge($values, $this->getDefaults()));
      }
      else
      {
        $this->setDefaults(array_merge($this->getDefaults(), $values));
      }
    }
  }

  protected function getProfile()
  {
    try
    {
      return $this->object->getProfile();
    }
    catch (sfException $e)
    {
      // no profile
      return null;
    }
  }

  protected function getPrimaryKey()
  {
    if (!is_null($this->pkName))
    {
      return $this->pkName;
    }

    $profileClass = sfConfig::get('app_sf_guard_plugin_profile_class', 'sfGuardUserProfile');
    if (class_exists($profileClass))
    {
      $tableMap = call_user_func(array($profileClass.'Peer', 'getTableMap'));
      foreach ($tableMap->getColumns() as $column)
      {
        if ($column->isPrimaryKey())
        {
          return $this->pkName = call_user_func(array($profileClass.'Peer', 'translateFieldname'), $column->getPhpName(), BasePeer::TYPE_PHPNAME, BasePeer::TYPE_FIELDNAME);
        }
      }
    }
  }
}
