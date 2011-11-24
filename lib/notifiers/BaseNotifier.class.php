<?php

abstract class BaseNotifier
{
  protected $context;
  protected $config;
  protected $name;
  protected $subject;
  protected $parameters;

  function __construct($config, sfContext $context)
  {
    $this->config = $config;
    $this->context = $context;
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

  protected function generateUrl($action, $params = array(), $absolute = true)
  {
    $anchor = isset($params['anchor']) ? $params['anchor'] : null;
    $url = $this->context->getRouting()->generate('' , array('module' => 'default', 'action' => $action) + $params, $absolute);
    $url = str_replace('api.php', 'index.php', $url);
    if(!is_null($anchor))
    {
      $url .= sprintf('#%s', urlencode($anchor));
    }
    return $url;
  }

  public function notifyComment(sfEvent $event)
  {
    return true;
  }

  public function notifyStatus(sfEvent $event)
  {
    return true;
  }

  public function notifyReviewRequest(sfEvent $event)
  {
    return true;
  }
}
