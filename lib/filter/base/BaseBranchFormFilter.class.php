<?php

/**
 * Branch filter form base class.
 *
 * @package    crew
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseBranchFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'status_id'             => new sfWidgetFormPropelChoice(array('model' => 'Status', 'add_empty' => true)),
      'user_status_changed'   => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'repository_id'         => new sfWidgetFormPropelChoice(array('model' => 'Repository', 'add_empty' => true)),
      'name'                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'commit_reference'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'commit_status_changed' => new sfWidgetFormFilterInput(),
      'date_status_changed'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'is_blacklisted'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'review_request'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'status_id'             => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Status', 'column' => 'id')),
      'user_status_changed'   => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'repository_id'         => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Repository', 'column' => 'id')),
      'name'                  => new sfValidatorPass(array('required' => false)),
      'commit_reference'      => new sfValidatorPass(array('required' => false)),
      'commit_status_changed' => new sfValidatorPass(array('required' => false)),
      'date_status_changed'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'is_blacklisted'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'review_request'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('branch_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Branch';
  }

  public function getFields()
  {
    return array(
      'id'                    => 'Number',
      'status_id'             => 'ForeignKey',
      'user_status_changed'   => 'ForeignKey',
      'repository_id'         => 'ForeignKey',
      'name'                  => 'Text',
      'commit_reference'      => 'Text',
      'commit_status_changed' => 'Text',
      'date_status_changed'   => 'Date',
      'is_blacklisted'        => 'Number',
      'review_request'        => 'Number',
    );
  }
}
