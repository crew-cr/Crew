<?php

class CampfireNotifier extends SimpleNotifier
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

    $serviceUrl   = $configCurrentProject['base-url'];
    $serviceToken = $configCurrentProject['api-token'];
    $roomId       = $configCurrentProject['room-id'];

    $cmd = sprintf("curl -u %s:X -H 'Content-Type: application/json' -d %s %s/room/%s/speak.json", $serviceToken, escapeshellarg(json_encode(array('message' => array('body' => $message)))), $serviceUrl, $roomId);
    exec($cmd);

    return true;
  }
}
