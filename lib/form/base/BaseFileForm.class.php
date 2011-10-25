<?php

/**
 * File form base class.
 *
 * @method File getObject() Returns the current form's model object
 *
 * @package    crew
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseFileForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                    => new sfWidgetFormInputHidden(),
      'branch_id'             => new sfWidgetFormPropelChoice(array('model' => 'Branch', 'add_empty' => false)),
      'status_id'             => new sfWidgetFormPropelChoice(array('model' => 'Status', 'add_empty' => false)),
      'state'                 => new sfWidgetFormInputText(),
      'filename'              => new sfWidgetFormInputText(),
      'commit_status_changed' => new sfWidgetFormInputText(),
      'user_status_changed'   => new sfWidgetFormInputText(),
      'date_status_changed'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                    => new sfValidatorPropelChoice(array('model' => 'File', 'column' => 'id', 'required' => false)),
      'branch_id'             => new sfValidatorPropelChoice(array('model' => 'Branch', 'column' => 'id')),
      'status_id'             => new sfValidatorPropelChoice(array('model' => 'Status', 'column' => 'id')),
      'state'                 => new sfValidatorString(array('max_length' => 1)),
      'filename'              => new sfValidatorString(array('max_length' => 255)),
      'commit_status_changed' => new sfValidatorString(array('max_length' => 50)),
      'user_status_changed'   => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'date_status_changed'   => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('file[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'File';
  }


}
