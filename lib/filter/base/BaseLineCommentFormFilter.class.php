<?php

/**
 * LineComment filter form base class.
 *
 * @package    crew
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseLineCommentFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'          => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'commit_reference' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'file_id'          => new sfWidgetFormPropelChoice(array('model' => 'File', 'add_empty' => true)),
      'position'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'line'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'value'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'date'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'user_id'          => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'commit_reference' => new sfValidatorPass(array('required' => false)),
      'file_id'          => new sfValidatorPropelChoice(array('required' => false, 'model' => 'File', 'column' => 'id')),
      'position'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'line'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'value'            => new sfValidatorPass(array('required' => false)),
      'date'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('line_comment_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'LineComment';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'user_id'          => 'ForeignKey',
      'commit_reference' => 'Text',
      'file_id'          => 'ForeignKey',
      'position'         => 'Number',
      'line'             => 'Number',
      'value'            => 'Text',
      'date'             => 'Date',
    );
  }
}
