<?php

class registerNotifiersFilter extends sfFilter
{
  public function execute($filterChain)
  {
    if($this->isFirstCall())
    {
      $notifiers = sfConfig::get('app_notifiers_all');

      if(!is_null($notifiers))
      {
        foreach($notifiers as $notifierClassName => $notifierConfig)
        {
          $databaseNotifier = new $notifierClassName();
          if($databaseNotifier->isEnabled('status'))
          {
            $this->getContext()->getEventDispatcher()->connect('notification.status', array($databaseNotifier, 'notifyStatus'));
          }
          if($databaseNotifier->isEnabled('comment'))
          {
            $this->getContext()->getEventDispatcher()->connect('notification.comment', array($databaseNotifier, 'notifyComment'));
          }
        }
      }
    }
    $filterChain->execute();
  }
}
