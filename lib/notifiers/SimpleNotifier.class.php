<?php

abstract class SimpleNotifier extends BaseNotifier
{

  /**
   * @abstract
   *
   * @param int $statusId
   */
  abstract protected function getLabelStatus($statusId);

  /**
   * @abstract
   *
   * @param string $message
   *
   * @return $this
   */
  abstract protected function send($message);

  /**
   * @param sfEvent $event
   *
   * @return bool
   */
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

    if (in_array($this->arguments['type'], array('file', 'branch')) && isset($configEvent[$this->arguments['type'].'_message']))
    {
      $oldStatus  = $this->arguments['old'];
      $message    = $configEvent[$this->arguments['type'].'_message'];

      $messageFields = array(
        '%old-status%' => $this->getLabelStatus($oldStatus),
        '%status%'     => $this->getLabelStatus($this->arguments['object']->getStatus()),
        '%date%'       => $this->getLabelStatus(date('d/m/Y H:i')),
        '%author%'     => (string)$this->subject->getUser(),
      );

      $linkConfig = null;
      
      if ('file' == $this->arguments['type'])
      {
        $file = $this->arguments['object'];
        
        $messageFields['%file%']    = $file->getFilename();
        $messageFields['%branch%']  = (string)$file->getBranch();
        $messageFields['%project%'] = (string)$file->getBranch()->getRepository();

        $linkConfig = array(
          'action' => 'file',
          'params' => array('file' => $file->getId()),
        );
      }
      elseif('branch' == $this->arguments['type'])
      {
        $branch = $this->arguments['object'];

        $messageFields['%branch%']  = (string)$branch;
        $messageFields['%project%'] = (string)$branch->getRepository();

        $linkConfig = array(
          'action' => 'fileList',
          'params' => array('branch' => $branch->getId()),
        );
      }
      
      $message = str_replace(array_keys($messageFields), array_values($messageFields), $message);
      
      if(isset($configEvent['add-links']) && $configEvent['add-links'] && $linkConfig !== null)
      {
        $message .= " : ".$this->generateUrl($linkConfig['action'], $linkConfig['params']);
      }
      
      $this->send($message);
    }
    
    return true;
  }

  /**
   * @param sfEvent $event
   *
   * @return bool
   */
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

  /**
   * @param sfEvent $event
   *
   * @return bool
   */
  public function notifyReviewRequest(sfEvent $event)
  {
    if(!$this->configure($event))
    {
      return true;
    }

    $configEvent = $this->getEventConfig('review-request');
    $branch      = $this->arguments['object'];

    $message = $configEvent['message'];

    $messageFields = array(
      '%project%' => (string)$branch->getRepository(),
      '%branch%'  => (string)$branch,
      '%date%'    => date('d/m/Y H:i'),
    );

    $message = str_replace(array_keys($messageFields), array_values($messageFields), $message);

    if(isset($configEvent['add-links']) && $configEvent['add-links'])
    {
      $message .= " : ".$this->generateUrl('fileList', array('branch' => $branch->getId()));
    }

    $this->send($message);

    return true;
  }

  /**
   * @param $type
   * @param $comment
   * @return mixed|string
   */
  protected function createCommentNotificationMessage($type, $comment)
  {
    $configEvent = $this->getEventConfig('comment');
    
    $message = '';

    if(isset($configEvent[$type.'_message']))
    {
      $message = $configEvent[$type.'_message'];
      
      $maxLength = 40;
      if (isset($configEvent['message-max-length']))
      {
        $maxLength = (int)$configEvent['message-max-length'];
      }

      $messageFields = array(
        '%branch%'  => (string)$comment->getBranch(),
        '%message%' => $maxLength ? stringUtils::shorten($comment->getValue(), $maxLength, '...', true) : $comment->getValue(),
        '%date%'    => date('d/m/Y H:i'),
        '%author%'  => (string)$this->subject->getUser(),
        '%project%' => (string)$comment->getBranch()->getRepository(),
      );

      $linkConfig = null;

      switch($type)
      {
        case 'line':
          $messageFields['%line%']    = $comment->getLine();

          $linkConfig = array(
            'action' => 'file',
            'params' => array('file' => $comment->getFileId()),
          );
          break;

        case 'file':
          $messageFields['%file%'] = $comment->getFile()->getFilename();

          $linkConfig = array(
            'action' => 'file',
            'params' => array('file' => $comment->getFileId()),
          );
          break;

        case 'branch':
          $linkConfig = array(
            'action' => 'fileList',
            'params' => array('branch' => $comment->getBranch()->getId()),
          );
          break;
      }
      
      if (null !== $linkConfig)
      {
        $linkConfig['params']['anchor'] = 'comment-'.$comment->getId();
      }
      
      $message = str_replace(array_keys($messageFields), array_values($messageFields), $message);

      if(isset($configEvent['add-links']) && $configEvent['add-links'] && null !== $linkConfig)
      {
        $message .= " : ".$this->generateUrl($linkConfig['action'], $linkConfig['params']);
      }
    }

    return $message;
  }
}
