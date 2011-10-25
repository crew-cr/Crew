<?php

/**
 * BranchComment form base class.
 *
 * @method BranchComment getObject() Returns the current form's model object
 *
 * @package    crew
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseBranchCommentForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'user_id'   => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'branch_id' => new sfWidgetFormPropelChoice(array('model' => 'Branch', 'add_empty' => false)),
      'value'     => new sfWidgetFormTextarea(),
      'date'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorPropelChoice(array('model' => 'BranchComment', 'column' => 'id', 'required' => false)),
      'user_id'   => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id', 'required' => false)),
      'branch_id' => new sfValidatorPropelChoice(array('model' => 'Branch', 'column' => 'id')),
      'value'     => new sfValidatorString(),
      'date'      => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('branch_comment[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'BranchComment';
  }


}
