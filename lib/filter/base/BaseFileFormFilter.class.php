<?php

/**
 * File filter form base class.
 *
 * @package    crew
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseFileFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'branch_id'               => new sfWidgetFormPropelChoice(array('model' => 'Branch', 'add_empty' => true)),
      'state'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'filename'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'commit_reference'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'review_request'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nb_added_lines'          => new sfWidgetFormFilterInput(),
      'nb_deleted_lines'        => new sfWidgetFormFilterInput(),
      'last_change_commit'      => new sfWidgetFormFilterInput(),
      'last_change_commit_desc' => new sfWidgetFormFilterInput(),
      'last_change_commit_user' => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'status'                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'commit_status_changed'   => new sfWidgetFormFilterInput(),
      'user_status_changed'     => new sfWidgetFormFilterInput(),
      'date_status_changed'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'branch_id'               => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Branch', 'column' => 'id')),
      'state'                   => new sfValidatorPass(array('required' => false)),
      'filename'                => new sfValidatorPass(array('required' => false)),
      'commit_reference'        => new sfValidatorPass(array('required' => false)),
      'review_request'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'nb_added_lines'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'nb_deleted_lines'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'last_change_commit'      => new sfValidatorPass(array('required' => false)),
      'last_change_commit_desc' => new sfValidatorPass(array('required' => false)),
      'last_change_commit_user' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'status'                  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'commit_status_changed'   => new sfValidatorPass(array('required' => false)),
      'user_status_changed'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'date_status_changed'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('file_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'File';
  }

  public function getFields()
  {
    return array(
      'id'                      => 'Number',
      'branch_id'               => 'ForeignKey',
      'state'                   => 'Text',
      'filename'                => 'Text',
      'commit_reference'        => 'Text',
      'review_request'          => 'Number',
      'nb_added_lines'          => 'Number',
      'nb_deleted_lines'        => 'Number',
      'last_change_commit'      => 'Text',
      'last_change_commit_desc' => 'Text',
      'last_change_commit_user' => 'ForeignKey',
      'status'                  => 'Number',
      'commit_status_changed'   => 'Text',
      'user_status_changed'     => 'Number',
      'date_status_changed'     => 'Date',
    );
  }
}
