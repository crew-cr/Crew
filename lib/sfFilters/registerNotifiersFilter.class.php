<?php

class registerNotifiersFilter extends sfFilter
{
  public function execute($filterChain)
  {
    if ($this->isFirstCall())
    {
      if(!$this->getContext()->getEventDispatcher()->hasListeners('notification.status'))
      {
        $this->getContext()->getEventDispatcher()->connect('notification.status', array(new DatabaseNotifier(), 'notifyStatus'));
      }
    }
    $filterChain->execute();
  }
}
