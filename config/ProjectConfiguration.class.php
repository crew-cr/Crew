<?php

require_once dirname(__FILE__).'/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    $this->enablePlugins('sfPropelORMPlugin');
    $this->enablePlugins('sfGuardPlugin');
    $this->enablePlugins('crewLessPlugin');
    require_once sfConfig::get('sf_root_dir') . '/lib/vendor/XMPPHP/XMPP.php';
    require_once sfConfig::get('sf_root_dir') . '/lib/vendor/HipChat/HipChat.php';

    $this->dispatcher->connect('context.load_factories', array($this, 'listenLoadFactoriesEvent'));
  }

  /**
   * @param sfEvent $event
   */
  public function listenLoadFactoriesEvent(sfEvent $event)
  {
    /** @var $context sfContext */
    $context = $event->getSubject();
    $context->setGitCommand(new GitCommand(new GitDBLogger(PropelPDOFactory::instanciate('logger'))));
  }
  
}
