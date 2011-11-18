<?

abstract class BaseNotifier
{
  protected $config;
  protected $name;
  protected $subject;
  protected $parameters;

  function __construct()
  {
    $notifiersConfig = sfConfig::get('app_notifiers_all');
    $this->config = (isset($notifiersConfig[get_class($this)])) ? $notifiersConfig[get_class($this)] : array();
  }

  public function getConfig($eventType)
  {
    return (isset($this->config[$eventType])) ? $this->config[$eventType] : array();
  }

  public function isEnabled($eventType)
  {
    return (isset($this->config[$eventType]['enabled']) && $this->config[$eventType]['enabled']);
  }

  protected function configure(sfEvent $event)
  {
    $this->name       = $event->getName();
    $this->subject    = $event->getSubject();
    $this->arguments  = $event->getParameters();
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
