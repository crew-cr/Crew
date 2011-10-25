<?php

/**
 * Repository form base class.
 *
 * @method Repository getObject() Returns the current form's model object
 *
 * @package    crew
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseRepositoryForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'    => new sfWidgetFormInputHidden(),
      'name'  => new sfWidgetFormInputText(),
      'value' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'    => new sfValidatorPropelChoice(array('model' => 'Repository', 'column' => 'id', 'required' => false)),
      'name'  => new sfValidatorString(array('max_length' => 50)),
      'value' => new sfValidatorString(array('max_length' => 255)),
    ));

    $this->widgetSchema->setNameFormat('repository[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Repository';
  }


}
