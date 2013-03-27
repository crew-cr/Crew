<?php

class EmailNotifier extends SimpleNotifier
{
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
    $emailSubject    = $configCurrentProject['email-subject'];
    mail($groupEmail, $emailSubject, $message);

    return true;
  }
}
