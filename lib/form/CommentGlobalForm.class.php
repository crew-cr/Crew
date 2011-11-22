<?php

/**
 * Comment form.
 *
 * @package    crew
 * @subpackage form
 * @author     Your name here
 */
class CommentGlobalForm extends BaseCommentForm
{
  public function configure()
  {
    $type = $this->getOption('type');
    if (null === $type)
    {
      throw new Exception('Type has not been awarded to the form.');
    }

    $id = $this->getOption('id');
    if (null === $id)
    {
      throw new Exception('Id has not been awarded to the form.');
    }
    
    switch ($type)
    {
      case CommentPeer::TYPE_BRANCH:
        $merged = array('branch_id' => new sfWidgetFormInputHidden(array(), array('value' => $id)));
        break;

      case CommentPeer::TYPE_FILE:
        $merged = array('file_id' => new sfWidgetFormInputHidden(array(), array('value' => $id)));
        break;

      default:
        $merged = array();
    }

    $this->setWidgets(array_merge(array(
      'id'        => new sfWidgetFormInputHidden(),
      'user_id'   => new sfWidgetFormInputHidden(array(), array('value' => 1)),
      'value'     => new sfWidgetFormTextarea()
    )), $merged);

    $this->widgetSchema->setNameFormat('comment[%s]');
  }
}
