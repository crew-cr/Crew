<?php

/**
 * FileComment form.
 *
 * @package    crew
 * @subpackage form
 * @author     Your name here
 */
class FileCommentForm extends BaseFileCommentForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'user_id'   => new sfWidgetFormInputHidden(array(), array('value' => 1)),
      'file_id'   => new sfWidgetFormInputHidden(array(), array('value' => $this->getOption('file'))),
      'value'     => new sfWidgetFormTextarea()
    ));

    $this->widgetSchema->setNameFormat('comment[%s]');
  }
}
