<?php

/**
 * sfGuardPermission filter form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 */
abstract class BasesfGuardPermissionFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'                           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description'                    => new sfWidgetFormFilterInput(),
      'sf_guard_user_permission_list'  => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'sf_guard_group_permission_list' => new sfWidgetFormPropelChoice(array('model' => 'sfGuardGroup', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'name'                           => new sfValidatorPass(array('required' => false)),
      'description'                    => new sfValidatorPass(array('required' => false)),
      'sf_guard_user_permission_list'  => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'required' => false)),
      'sf_guard_group_permission_list' => new sfValidatorPropelChoice(array('model' => 'sfGuardGroup', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sf_guard_permission_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function addsfGuardUserPermissionListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(sfGuardUserPermissionPeer::PERMISSION_ID, sfGuardPermissionPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(sfGuardUserPermissionPeer::USER_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(sfGuardUserPermissionPeer::USER_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function addsfGuardGroupPermissionListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(sfGuardGroupPermissionPeer::PERMISSION_ID, sfGuardPermissionPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(sfGuardGroupPermissionPeer::GROUP_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(sfGuardGroupPermissionPeer::GROUP_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'sfGuardPermission';
  }

  public function getFields()
  {
    return array(
      'id'                             => 'Number',
      'name'                           => 'Text',
      'description'                    => 'Text',
      'sf_guard_user_permission_list'  => 'ManyKey',
      'sf_guard_group_permission_list' => 'ManyKey',
    );
  }
}
