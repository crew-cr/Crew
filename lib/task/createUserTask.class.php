<?php

class createUserTask extends sfPropelBaseTask
{
  /**
   * @see sfTask
   */
  protected function configure()
  {
    $this->namespace = 'crew';
    $this->name = 'create-user';
    $this->briefDescription = 'Creates a Crew user';

    $this->addArguments(array(
      new sfCommandArgument('username', sfCommandArgument::REQUIRED, 'The user name'),
      new sfCommandArgument('password', sfCommandArgument::REQUIRED, 'The password'),
      new sfCommandArgument('nickname', sfCommandArgument::OPTIONAL, 'The nickname', ''),
      new sfCommandArgument('email', sfCommandArgument::OPTIONAL, 'The email', ''),
    ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_OPTIONAL, 'The application name', null),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'propel'),
    ));
  }

  /**
   * @see sfTask
   */
  protected function execute($arguments = array(), $options = array())
  {
    $databaseManager = new sfDatabaseManager($this->configuration);

    $user = new sfGuardUser();
    $user->setUsername($arguments['username']);
    $user->setPassword($arguments['password']);
    $user->save();

    $profile = new Profile();
    $profile->setNickname($arguments['nickname']);
    $profile->setEmail($arguments['email']);
    $profile->setSfGuardUserId($user->getId());
    $profile->save();
    
    $this->logSection('crew', sprintf('Create user "%s"', $arguments['username']));
  }
}
