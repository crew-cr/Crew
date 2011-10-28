<?php

/**
 * StatusAction filter form base class.
 *
 * @package    crew
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseStatusActionFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'       => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'repository_id' => new sfWidgetFormPropelChoice(array('model' => 'Repository', 'add_empty' => true)),
      'branch_id'     => new sfWidgetFormPropelChoice(array('model' => 'Branch', 'add_empty' => true)),
      'file_id'       => new sfWidgetFormPropelChoice(array('model' => 'File', 'add_empty' => true)),
      'message'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'old_status'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'new_status'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'user_id'       => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'repository_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Repository', 'column' => 'id')),
      'branch_id'     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Branch', 'column' => 'id')),
      'file_id'       => new sfValidatorPropelChoice(array('required' => false, 'model' => 'File', 'column' => 'id')),
      'message'       => new sfValidatorPass(array('required' => false)),
      'old_status'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'new_status'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('status_action_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'StatusAction';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'user_id'       => 'ForeignKey',
      'repository_id' => 'ForeignKey',
      'branch_id'     => 'ForeignKey',
      'file_id'       => 'ForeignKey',
      'message'       => 'Text',
      'old_status'    => 'Number',
      'new_status'    => 'Number',
      'created_at'    => 'Date',
    );
  }
}
