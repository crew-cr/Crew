<?php

class CampfireNotifier extends BaseNotifier
{
  public function notifyStatus(sfEvent $event)
  {
    $this->configure($event);

    switch($this->arguments['type'])
    {
      case 'file':
        $file       = $this->arguments['object'];
        $oldStatus  = $this->arguments['old'];

        if(isset($this->config['status']['file_message']))
        {
          $message = $this->config['status']['file_message'];
          $message = str_replace('%file%',        $file->getFilename(), $message);
          $message = str_replace('%branch%',      stringUtils::displayBranchName($file->getBranch()->getName()), $message);
          $message = str_replace('%old-status%',  BranchPeer::getBasecampLabelStatus($oldStatus), $message);
          $message = str_replace('%status%',      BranchPeer::getBasecampLabelStatus($file->getStatus()), $message);
          $message = str_replace('%date%',        date('d/m/Y H:i'), $message);
          $message = str_replace('%author%',      $this->subject->getUser()->__toString(), $message);

          if(isset($this->config['status']['add-links']) && $this->config['status']['add-links'])
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

        if(isset($this->config['status']['branch_message']))
        {
          $message = $this->config['status']['branch_message'];
          $message = str_replace('%branch%',      stringUtils::displayBranchName($branch->getName()), $message);
          $message = str_replace('%old-status%',  BranchPeer::getBasecampLabelStatus($oldStatus), $message);
          $message = str_replace('%status%',      BranchPeer::getBasecampLabelStatus($branch->getStatus()), $message);
          $message = str_replace('%date%',        date('d/m/Y H:i'), $message);
          $message = str_replace('%author%',      $this->subject->getUser()->__toString(), $message);

          if(isset($this->config['status']['add-links']) && $this->config['status']['add-links'])
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
    $serviceUrl   = $this->config['base-url'];
    $serviceToken = $this->config['api-token'];
    $roomId       = $this->config['room-id'];

    $cmd = sprintf("curl -u %s:X -H 'Content-Type: application/json' -d '%s' %s/room/%s/speak.json", $serviceToken, json_encode(array('message' => array('body' => $message))), $serviceUrl, $roomId);
    exec($cmd);
  }
}
