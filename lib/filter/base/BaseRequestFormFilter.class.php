<?php

/**
 * Request filter form base class.
 *
 * @package    crew
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseRequestFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'branch_id'  => new sfWidgetFormPropelChoice(array('model' => 'Branch', 'add_empty' => true)),
      'commit'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'branch_id'  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Branch', 'column' => 'id')),
      'commit'     => new sfValidatorPass(array('required' => false)),
      'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('request_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Request';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'branch_id'  => 'ForeignKey',
      'commit'     => 'Text',
      'created_at' => 'Date',
    );
  }
}
