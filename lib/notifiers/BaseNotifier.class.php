<?php

abstract class BaseNotifier
{
  protected $config;
  protected $name;
  protected $subject;
  protected $parameters;

  function __construct($config)
  {
    $this->config = $config;
  }

  public function isEnabled($eventType)
  {
    return (isset($this->config[$eventType]['enabled']) && $this->config[$eventType]['enabled']);
  }

  public function getEventConfig($eventType)
  {
    return (isset($this->config[$eventType])) ? $this->config[$eventType] : array();
  }

  public function getCurrentProjectConfig()
  {
    return (isset($this->config['projects'][$this->arguments['project-id']])) ? $this->config['projects'][$this->arguments['project-id']] : array();
  }

  protected function isEnabledForCurrentProject()
  {
    return isset($this->config['projects'][$this->arguments['project-id']]) || !isset($this->config['projects']);
  }

  protected function configure(sfEvent $event)
  {
    $this->name       = $event->getName();
    $this->subject    = $event->getSubject();
    $this->arguments  = $event->getParameters();

    if(!$this->isEnabledForCurrentProject())
    {
      return false;
    }

    return true;
  }

  public function notifyComment(sfEvent $event)
  {
    return true;
  }

  public function notifyStatus(sfEvent $event)
  {
    return true;
  }
}
