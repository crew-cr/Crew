<?php

/**
 * LineComment form base class.
 *
 * @method LineComment getObject() Returns the current form's model object
 *
 * @package    crew
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseLineCommentForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'user_id'    => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'commit'     => new sfWidgetFormInputText(),
      'file_id'    => new sfWidgetFormPropelChoice(array('model' => 'File', 'add_empty' => false)),
      'position'   => new sfWidgetFormInputText(),
      'line'       => new sfWidgetFormInputText(),
      'value'      => new sfWidgetFormTextarea(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorPropelChoice(array('model' => 'LineComment', 'column' => 'id', 'required' => false)),
      'user_id'    => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id', 'required' => false)),
      'commit'     => new sfValidatorString(array('max_length' => 50)),
      'file_id'    => new sfValidatorPropelChoice(array('model' => 'File', 'column' => 'id')),
      'position'   => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'line'       => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'value'      => new sfValidatorString(),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('line_comment[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'LineComment';
  }


}
