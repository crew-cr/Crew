<?php

/**
 * Comment form base class.
 *
 * @method Comment getObject() Returns the current form's model object
 *
 * @package    crew
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseCommentForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'user_id'    => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'branch_id'  => new sfWidgetFormPropelChoice(array('model' => 'Branch', 'add_empty' => true)),
      'file_id'    => new sfWidgetFormPropelChoice(array('model' => 'File', 'add_empty' => true)),
      'position'   => new sfWidgetFormInputText(),
      'line'       => new sfWidgetFormInputText(),
      'type'       => new sfWidgetFormChoice(array('choices' => array(''=>'','branch'=>'branch','file'=>'file','line'=>'line',))),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'user_id'    => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id', 'required' => false)),
      'branch_id'  => new sfValidatorPropelChoice(array('model' => 'Branch', 'column' => 'id', 'required' => false)),
      'file_id'    => new sfValidatorPropelChoice(array('model' => 'File', 'column' => 'id', 'required' => false)),
      'position'   => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'line'       => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'type'       => new sfValidatorChoice(array('choices' => array(0=>'branch',1=>'file',2=>'line',), 'required' => false)),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('comment[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Comment';
  }


}
