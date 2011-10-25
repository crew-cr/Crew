<?php

/**
 * sfGuardGroupPermission form base class.
 *
 * @method sfGuardGroupPermission getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 */
abstract class BasesfGuardGroupPermissionForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'group_id'      => new sfWidgetFormInputHidden(),
      'permission_id' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'group_id'      => new sfValidatorPropelChoice(array('model' => 'sfGuardGroup', 'column' => 'id', 'required' => false)),
      'permission_id' => new sfValidatorPropelChoice(array('model' => 'sfGuardPermission', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sf_guard_group_permission[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfGuardGroupPermission';
  }


}
