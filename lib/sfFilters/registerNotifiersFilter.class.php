<?php

class registerNotifiersFilter extends sfFilter
{
  public function execute($filterChain)
  {
    if($this->isFirstCall())
    {
      $notifiers = sfYaml::load(dirname(__FILE__).'/../../config/notifiers.yml');

      if(!is_null($notifiers) && is_array($notifiers))
      {
        foreach($notifiers as $notifierClassName => $config)
        {
          $notifier = new $notifierClassName($config);
          if($notifier->isEnabled('status'))
          {
            $this->getContext()->getEventDispatcher()->connect('notification.status', array($notifier, 'notifyStatus'));
          }
          if($notifier->isEnabled('comment'))
          {
            $this->getContext()->getEventDispatcher()->connect('notification.comment', array($notifier, 'notifyComment'));
          }
        }
      }
    }
    $filterChain->execute();
  }
}
