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
    $config = array();
    if(isset($this->config['projects'][$this->arguments['project-id']]))
    {
        $config = $this->config['projects'][$this->arguments['project-id']];
    }
    elseif(isset($this->config['projects']['*']))
    {
        $config = $this->config['projects']['*'];
    }
    return $config;
  }

  protected function isEnabledForCurrentProject()
  {
    $enabled = isset($this->config['projects'][$this->arguments['project-id']]) || !isset($this->config['projects']);
    if(!$enabled)
    {
	$enabled = isset($this->config['projects']['*']) || !isset($this->config['projects']);
    }
    return $enabled;
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
    $anchor = null;

    if(isset($params['anchor']))
    {
      $anchor = $params['anchor'];
      unset($params['anchor']);
    }

    $url = crossAppRouting::genUrl('front', array('module' => 'default', 'action' => $action) + $params, $absolute);

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
