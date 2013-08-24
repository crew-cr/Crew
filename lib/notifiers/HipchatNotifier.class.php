<?php

class HipchatNotifier extends SimpleNotifier
{

  /**
   * @param int $statusId
   *
   * @return string
   */
  protected function getLabelStatus($statusId)
  {
    return BranchPeer::getLabelStatus($statusId);
  }

  /**
   * @param $message
   *
   * @return $this
   */
  protected function send($message)
  {
    $configCurrentProject = $this->getCurrentProjectConfig();

    $token = $configCurrentProject['token'];
    $room  = $configCurrentProject['room'];
    $user  = $configCurrentProject['user'];

    list(,$eventName) = explode('.', $this->name);
    $eventConfig = $this->getEventConfig($eventName);

    $notify = isset($eventConfig['notify']) && $eventConfig['notify'] == '1';

    $color = HipChat\Hipchat::COLOR_YELLOW;
    if (isset($eventConfig['color']))
    {
      $color = $eventConfig['color'];
    }

    $hipChat = new HipChat\HipChat($token);
    $hipChat->message_room($room, $user, $message, $notify, $color, HipChat\Hipchat::FORMAT_TEXT);

    return $this;
  }

}
