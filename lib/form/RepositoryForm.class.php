<?php

/**
 * Repository form.
 *
 * @package    crew
 * @subpackage form
 * @author     Your name here
 */
class RepositoryForm extends BaseRepositoryForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'name'    => new sfWidgetFormInputText(),
      'remote'   => new sfWidgetFormInputText()
    ));

    $this->widgetSchema->setLabels(array(
      'name'    => 'Project name',
      'remote' => 'Read-Only remote url',
    ));

    $this->setValidators(array(
      'name'    => new sfValidatorString(array('trim' => true), array('required' => 'The name field is required.')),
      'remote' => new sfValidatorUrl(array('trim' => true), array('required' => 'The remote url field is required.', 'invalid' => 'The remote url field is not an url')),
    ));

    $this->widgetSchema->setFormFormatterName('custom');
  }
}
