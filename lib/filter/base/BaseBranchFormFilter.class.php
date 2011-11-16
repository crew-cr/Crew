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
      'repository_id'         => new sfWidgetFormPropelChoice(array('model' => 'Repository', 'add_empty' => true)),
      'name'                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'commit_reference'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'last_commit'           => new sfWidgetFormFilterInput(),
      'last_commit_desc'      => new sfWidgetFormFilterInput(),
      'is_blacklisted'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'review_request'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'status'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'commit_status_changed' => new sfWidgetFormFilterInput(),
      'user_status_changed'   => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'date_status_changed'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'repository_id'         => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Repository', 'column' => 'id')),
      'name'                  => new sfValidatorPass(array('required' => false)),
      'commit_reference'      => new sfValidatorPass(array('required' => false)),
      'last_commit'           => new sfValidatorPass(array('required' => false)),
      'last_commit_desc'      => new sfValidatorPass(array('required' => false)),
      'is_blacklisted'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'review_request'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'status'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'commit_status_changed' => new sfValidatorPass(array('required' => false)),
      'user_status_changed'   => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'date_status_changed'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
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
      'repository_id'         => 'ForeignKey',
      'name'                  => 'Text',
      'commit_reference'      => 'Text',
      'last_commit'           => 'Text',
      'last_commit_desc'      => 'Text',
      'is_blacklisted'        => 'Number',
      'review_request'        => 'Number',
      'status'                => 'Number',
      'commit_status_changed' => 'Text',
      'user_status_changed'   => 'ForeignKey',
      'date_status_changed'   => 'Date',
    );
  }
}
