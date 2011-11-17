<?

abstract class BaseNotifier
{
  protected $name;
  protected $subject;
  protected $parameters;
  
  protected function configure(sfEvent $event)
  {
    $this->name       = $event->getName();
    $this->subject    = $event->getSubject();
    $this->arguments  = $event->getParameters();
  }
  
  abstract public function notifyComment(sfEvent $event);
  abstract public function notifyStatus(sfEvent $event);
}
