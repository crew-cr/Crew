<?php

/**
 * BranchComment filter form base class.
 *
 * @package    crew
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseBranchCommentFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'   => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'branch_id' => new sfWidgetFormPropelChoice(array('model' => 'Branch', 'add_empty' => true)),
      'value'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'date'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'user_id'   => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'branch_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Branch', 'column' => 'id')),
      'value'     => new sfValidatorPass(array('required' => false)),
      'date'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('branch_comment_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'BranchComment';
  }

  public function getFields()
  {
    return array(
      'id'        => 'Number',
      'user_id'   => 'ForeignKey',
      'branch_id' => 'ForeignKey',
      'value'     => 'Text',
      'date'      => 'Date',
    );
  }
}
