<?php

/**
 * LineComment form.
 *
 * @package    crew
 * @subpackage form
 * @author     Your name here
 */
class LineCommentForm extends BaseLineCommentForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'user_id'   => new sfWidgetFormInputHidden(array(), array('value' => 1)),
      'commit'    => new sfWidgetFormInputHidden(array(), array('value' => $this->getOption('commit'))),
      'file_id'   => new sfWidgetFormInputHidden(array(), array('value' => $this->getOption('file_id'))),
      'position'  => new sfWidgetFormInputHidden(array(), array('value' => $this->getOption('position'))),
      'line'      => new sfWidgetFormInputHidden(array(), array('value' => $this->getOption('line'))),
      'value'     => new sfWidgetFormTextarea()
    ));

    $this->widgetSchema->setNameFormat('comment[%s]');
  }
}
