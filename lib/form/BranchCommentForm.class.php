<?php

/**
 * BranchComment form.
 *
 * @package    crew
 * @subpackage form
 * @author     Your name here
 */
class BranchCommentForm extends BaseBranchCommentForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'user_id'   => new sfWidgetFormInputHidden(array(), array('value' => 1)),
      'branch_id' => new sfWidgetFormInputHidden(array(), array('value' => $this->getOption('branch'))),
      'value'     => new sfWidgetFormTextarea(),
      'date'      => new sfWidgetFormInputHidden(array(), array('value' => time())),
    ));

    $this->widgetSchema->setNameFormat('comment[%s]');
  }
}
