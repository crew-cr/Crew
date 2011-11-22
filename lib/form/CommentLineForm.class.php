<?php

/**
 * Comment form.
 *
 * @package    crew
 * @subpackage form
 * @author     Your name here
 */
class CommentLineForm extends BaseCommentForm
{
  public function configure()
  {
    $fileId = $this->getOption('file_id');
    if (null === $fileId)
    {
      throw new Exception('File Id has not been awarded to the form.');
    }

    $commit = $this->getOption('commit');
    if (null === $commit)
    {
      throw new Exception('Commit hash has not been awarded to the form.');
    }

    $position = $this->getOption('position');
    if (null === $position)
    {
      throw new Exception('Position has not been awarded to the form.');
    }

    $line = $this->getOption('line');
    if (null === $line)
    {
      throw new Exception('Line has not been awarded to the form.');
    }

    $user = $this->getOption('user_id');
    if (null === $user)
    {
      throw new Exception('User Id has not been awarded to the form.');
    }

    $this->setWidgets(array(
      'file_id'   => new sfWidgetFormInputHidden(array(), array('value' => $fileId)),
      'position'  => new sfWidgetFormInputHidden(array(), array('value' => $position)),
      'line'      => new sfWidgetFormInputHidden(array(), array('value' => $line)),
      'user_id'   => new sfWidgetFormInputHidden(array(), array('value' => $user)),
      'commit'    => new sfWidgetFormInputHidden(array(), array('value' => $commit)),
      'value'     => new sfWidgetFormTextarea(),
      'id'        => new sfWidgetFormInputHidden(),
    ));

    $this->widgetSchema->setNameFormat('comment[%s]');
  }
}
