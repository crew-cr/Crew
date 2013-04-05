<?php

class EmailNotifier extends SimpleNotifier
{
  protected $emailSubject;

  /**
   * @param int $statusId
   *
   * @return string
   */
  protected function getLabelStatus($statusId)
  {
    return BranchPeer::getBasecampLabelStatus($statusId);
  }

  /**
   * @param sfEvent $event
   */
  public function notifyReviewRequest(sfEvent $event)
  {
    $configCurrentProject = $this->getCurrentProjectConfig();

    if(count($configCurrentProject) == 0)
    {
      return false;
    }

    $this->emailSubject = $configCurrentProject['email-subject'] ." - Review Request";
    
    parent::notifyReviewRequest($event);
  }

  /**
   * @param sfEvent $event
   */
  public function notifyStatus(sfEvent $event)
  {
    $configCurrentProject = $this->getCurrentProjectConfig();

    if(count($configCurrentProject) == 0)
    {
      return false;
    }

    $this->emailSubject = $configCurrentProject['email-subject'] ." - Status Change";

    parent::notifyStatus($event);
  }

  /**
   * @param sfEvent $event
   */
  public function notifyComment(sfEvent $event)
  {
    $configCurrentProject = $this->getCurrentProjectConfig();

    if(count($configCurrentProject) == 0)
    {
      return false;
    }

    $this->emailSubject = $configCurrentProject['email-subject'] ." - Comment";

    parent::notifyComment($event);
  }

  /**
   * @param string $message
   *
   * @return bool
   */
  protected function send($message)
  {
    $configCurrentProject = $this->getCurrentProjectConfig();

    if(count($configCurrentProject) == 0)
    {
      return false;
    }

    $groupEmail      = $configCurrentProject['group-email'];

    mail($groupEmail, $this->emailSubject, $message);

    return true;
  }
}
