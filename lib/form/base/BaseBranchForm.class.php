<?php

/**
 * Branch form base class.
 *
 * @method Branch getObject() Returns the current form's model object
 *
 * @package    crew
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseBranchForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                    => new sfWidgetFormInputHidden(),
      'repository_id'         => new sfWidgetFormPropelChoice(array('model' => 'Repository', 'add_empty' => false)),
      'name'                  => new sfWidgetFormInputText(),
      'commit_reference'      => new sfWidgetFormInputText(),
      'is_blacklisted'        => new sfWidgetFormInputText(),
      'review_request'        => new sfWidgetFormInputText(),
      'status'                => new sfWidgetFormInputText(),
      'commit_status_changed' => new sfWidgetFormInputText(),
      'user_status_changed'   => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'date_status_changed'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                    => new sfValidatorPropelChoice(array('model' => 'Branch', 'column' => 'id', 'required' => false)),
      'repository_id'         => new sfValidatorPropelChoice(array('model' => 'Repository', 'column' => 'id')),
      'name'                  => new sfValidatorString(array('max_length' => 255)),
      'commit_reference'      => new sfValidatorString(array('max_length' => 50)),
      'is_blacklisted'        => new sfValidatorInteger(array('min' => -128, 'max' => 127)),
      'review_request'        => new sfValidatorInteger(array('min' => -128, 'max' => 127)),
      'status'                => new sfValidatorInteger(array('min' => -128, 'max' => 127)),
      'commit_status_changed' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'user_status_changed'   => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id', 'required' => false)),
      'date_status_changed'   => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('branch[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Branch';
  }


}
