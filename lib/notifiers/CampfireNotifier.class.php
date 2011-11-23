<?php

class CampfireNotifier extends BaseNotifier
{
  public function notifyStatus(sfEvent $event)
  {
    if(!$this->configure($event))
    {
      return true;
    }

    $configEvent          = $this->getEventConfig('status');
    $configCurrentProject = $this->getCurrentProjectConfig();

    if(isset($configCurrentProject['status-type']) && !in_array($this->arguments['type'], $configCurrentProject['status-type']))
    {
      return true;
    }

    switch($this->arguments['type'])
    {
      case 'file':
        $file       = $this->arguments['object'];
        $oldStatus  = $this->arguments['old'];

        if(isset($configEvent['file_message']))
        {
          $message = $configEvent['file_message'];
          $message = str_replace('%file%',        $file->getFilename(), $message);
          $message = str_replace('%branch%',      stringUtils::displayBranchName($file->getBranch()->getName()), $message);
          $message = str_replace('%old-status%',  BranchPeer::getBasecampLabelStatus($oldStatus), $message);
          $message = str_replace('%status%',      BranchPeer::getBasecampLabelStatus($file->getStatus()), $message);
          $message = str_replace('%date%',        date('d/m/Y H:i'), $message);
          $message = str_replace('%author%',      $this->subject->getUser()->__toString(), $message);

          if(isset($configEvent['add-links']) && $configEvent['add-links'])
          {
            sfContext::getInstance()->getConfiguration()->loadHelpers(array('Url', 'Tag'));
            $message .= " : ".url_for('default/file?file='.$file->getId(), true);
          }

          $this->send($message);
        }
        break;

      case 'branch':
        $branch     = $this->arguments['object'];
        $oldStatus  = $this->arguments['old'];

        if(isset($configEvent['branch_message']))
        {
          $message = $configEvent['branch_message'];
          $message = str_replace('%branch%',      stringUtils::displayBranchName($branch->getName()), $message);
          $message = str_replace('%old-status%',  BranchPeer::getBasecampLabelStatus($oldStatus), $message);
          $message = str_replace('%status%',      BranchPeer::getBasecampLabelStatus($branch->getStatus()), $message);
          $message = str_replace('%date%',        date('d/m/Y H:i'), $message);
          $message = str_replace('%author%',      $this->subject->getUser()->__toString(), $message);

          if(isset($configEvent['add-links']) && $configEvent['add-links'])
          {
            sfContext::getInstance()->getConfiguration()->loadHelpers(array('Url', 'Tag'));
            $message .= " : ".url_for('default/fileList?branch='.$branch->getId(), true);
          }

          $this->send($message);
        }
        break;
    }
    return true;
  }

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

    $cmd = sprintf("curl -u %s:X -H 'Content-Type: application/json' -d '%s' %s/room/%s/speak.json", $serviceToken, json_encode(array('message' => array('body' => $message))), $serviceUrl, $roomId);
    exec($cmd);

    return true;
  }
}
