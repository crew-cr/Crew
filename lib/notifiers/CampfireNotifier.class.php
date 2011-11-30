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
          $message = str_replace('%branch%',      $file->getBranch()->__toString(), $message);
          $message = str_replace('%old-status%',  BranchPeer::getBasecampLabelStatus($oldStatus), $message);
          $message = str_replace('%status%',      BranchPeer::getBasecampLabelStatus($file->getStatus()), $message);
          $message = str_replace('%date%',        date('d/m/Y H:i'), $message);
          $message = str_replace('%author%',      $this->subject->getUser()->__toString(), $message);

          if(isset($configEvent['add-links']) && $configEvent['add-links'])
          {
            $message .= " : ".$this->generateUrl('file', array('file' => $file->getId()));
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
          $message = str_replace('%branch%',      $branch->__toString(), $message);
          $message = str_replace('%old-status%',  BranchPeer::getBasecampLabelStatus($oldStatus), $message);
          $message = str_replace('%status%',      BranchPeer::getBasecampLabelStatus($branch->getStatus()), $message);
          $message = str_replace('%date%',        date('d/m/Y H:i'), $message);
          $message = str_replace('%author%',      $this->subject->getUser()->__toString(), $message);

          if(isset($configEvent['add-links']) && $configEvent['add-links'])
          {
            $message .= " : ".$this->generateUrl('fileList', array('branch' => $branch->getId()));
          }

          $this->send($message);
        }
        break;
    }
    return true;
  }

  public function notifyComment(sfEvent $event)
  {
    if(!$this->configure($event))
    {
      return true;
    }

    $configCurrentProject = $this->getCurrentProjectConfig();

    if(isset($configCurrentProject['comment-type']) && !in_array($this->arguments['type'], $configCurrentProject['comment-type']))
    {
      return true;
    }

    $message = $this->createCommentNotificationMessage($this->arguments['type'], $this->arguments['object']);
    $this->send($message);

    return true;
  }

  public function notifyReviewRequest(sfEvent $event)
  {
    if(!$this->configure($event))
    {
      return true;
    }

    $configEvent = $this->getEventConfig('review-request');
    $branch      = $this->arguments['object'];

    $message = $configEvent['message'];
    $message = str_replace('%branch%',      $branch->__toString(), $message);
    $message = str_replace('%date%',        date('d/m/Y H:i'), $message);

    if(isset($configEvent['add-links']) && $configEvent['add-links'])
    {
      $message .= " : ".$this->generateUrl('fileList', array('branch' => $branch->getId()));
    }

    $this->send($message);

    return true;
  }

  protected function createCommentNotificationMessage($type, $comment)
  {
    $configEvent = $this->getEventConfig('comment');

    if(isset($configEvent[$type.'_message']))
    {
      $message = $configEvent[$type.'_message'];
      $message = str_replace('%branch%',  $comment->getBranch()->__toString(), $message);
      $message = str_replace('%message%', stringUtils::shorten($comment->getValue(), 40), $message);
      $message = str_replace('%date%',    date('d/m/Y H:i'), $message);
      $message = str_replace('%author%',  $this->subject->getUser()->__toString(), $message);

      switch($type)
      {
        case 'line':
          $message = str_replace('%line%', $comment->getLine(), $message);

        case 'file':
          $message = str_replace('%file%', $comment->getFile()->getFilename(), $message);
      }

      if(isset($configEvent['add-links']) && $configEvent['add-links'])
      {
        switch($type)
        {
          case 'branch':
            $link = " : ".$this->generateUrl('fileList', array('branch' => $comment->getBranch()->getId(), 'anchor' => 'comment-'.$comment->getId()));
            break;

          case 'file':
          case 'line':
            $link = " : ".$this->generateUrl('file', array('file' => $comment->getFileId(), 'anchor' => 'comment-'.$comment->getId()));
            break;
        }

        $message .= $link;
      }

      $this->send($message);
    }
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
