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
      'id'                      => new sfWidgetFormInputHidden(),
      'branch_id'               => new sfWidgetFormPropelChoice(array('model' => 'Branch', 'add_empty' => false)),
      'state'                   => new sfWidgetFormInputText(),
      'filename'                => new sfWidgetFormInputText(),
      'commit_reference'        => new sfWidgetFormInputText(),
      'review_request'          => new sfWidgetFormInputText(),
      'nb_added_lines'          => new sfWidgetFormInputText(),
      'nb_deleted_lines'        => new sfWidgetFormInputText(),
      'last_change_commit'      => new sfWidgetFormInputText(),
      'last_change_commit_desc' => new sfWidgetFormInputText(),
      'last_change_commit_user' => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'status'                  => new sfWidgetFormInputText(),
      'commit_status_changed'   => new sfWidgetFormInputText(),
      'user_status_changed'     => new sfWidgetFormInputText(),
      'date_status_changed'     => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                      => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'branch_id'               => new sfValidatorPropelChoice(array('model' => 'Branch', 'column' => 'id')),
      'state'                   => new sfValidatorString(array('max_length' => 1)),
      'filename'                => new sfValidatorString(array('max_length' => 255)),
      'commit_reference'        => new sfValidatorString(array('max_length' => 50)),
      'review_request'          => new sfValidatorInteger(array('min' => -128, 'max' => 127)),
      'nb_added_lines'          => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'nb_deleted_lines'        => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'last_change_commit'      => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'last_change_commit_desc' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'last_change_commit_user' => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id', 'required' => false)),
      'status'                  => new sfValidatorInteger(array('min' => -128, 'max' => 127)),
      'commit_status_changed'   => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'user_status_changed'     => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'date_status_changed'     => new sfValidatorDateTime(array('required' => false)),
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
