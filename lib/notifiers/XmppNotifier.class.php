<?php

class XmppNotifier extends SimpleNotifier
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

    $host      = $configCurrentProject['host'];
    $port      = $configCurrentProject['port'];
    $user      = $configCurrentProject['user'];
    $password  = $configCurrentProject['password'];
    $ressource = $configCurrentProject['ressource'];
    $server    = $configCurrentProject['server'];
    $to        = $configCurrentProject['to'];
    $type      = $configCurrentProject['groupchat'];

    $xmpp = new XMPPHP_XMPP($host, $port, $user, $password, $ressource, $server, false, 4);
    $xmpp->connect();
    $xmpp->processUntil('session_start');
    $xmpp->presence(null, 'available', $to);
    $xmpp->message($to, $message, $type);
    $xmpp->presence(null, 'unavailable', $to);
    $xmpp->disconnect();

    return $this;
  }

}
