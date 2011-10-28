<?php

/**
 * StatusAction form base class.
 *
 * @method StatusAction getObject() Returns the current form's model object
 *
 * @package    crew
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseStatusActionForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'user_id'       => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'repository_id' => new sfWidgetFormPropelChoice(array('model' => 'Repository', 'add_empty' => false)),
      'branch_id'     => new sfWidgetFormPropelChoice(array('model' => 'Branch', 'add_empty' => true)),
      'file_id'       => new sfWidgetFormPropelChoice(array('model' => 'File', 'add_empty' => true)),
      'message'       => new sfWidgetFormInputText(),
      'old_status'    => new sfWidgetFormInputText(),
      'new_status'    => new sfWidgetFormInputText(),
      'created_at'    => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorPropelChoice(array('model' => 'StatusAction', 'column' => 'id', 'required' => false)),
      'user_id'       => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id', 'required' => false)),
      'repository_id' => new sfValidatorPropelChoice(array('model' => 'Repository', 'column' => 'id')),
      'branch_id'     => new sfValidatorPropelChoice(array('model' => 'Branch', 'column' => 'id', 'required' => false)),
      'file_id'       => new sfValidatorPropelChoice(array('model' => 'File', 'column' => 'id', 'required' => false)),
      'message'       => new sfValidatorString(array('max_length' => 255)),
      'old_status'    => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'new_status'    => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'created_at'    => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('status_action[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'StatusAction';
  }


}
