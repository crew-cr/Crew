<?php

class crossAppRouting
{
  protected static $urls = array();

  /**
   * Récupération du tableau d'urls cache static for test purpose
   * @static
   * @return void
   */
  public static function getUrls()
  {
    return static::$urls;
  }

  /**
   * Génération d'une url cross application, et mise en cache de l'url
   *
   * @static
   * @param string $app
   * @param string $url
   * @param bool $absolute
   * @param string $env
   * @param string $initialInstanceName for test purpose
   * @return string
   */
  public static function genUrl($app, $url, $absolute = false, $env = null, $initialInstanceName = null)
  {
    $cacheKey = static::getCacheKey($app, $url, $absolute, $env);

    // test du tableau statique
    if(array_key_exists($cacheKey, static::$urls))
    {
      return static::$urls[$cacheKey];
    }

    $crossUrl = static::buildUrl($app, $url, $absolute, $env, $initialInstanceName);

    //cache dans le tableau statique
    static::$urls[$cacheKey] = $crossUrl;

    return $crossUrl;
  }

  /**
   * Génération brute de l'url cross app, passer par la fonction genUrl de préference (gestion du cache)
   *
   * @static
   * @throws Exception
   * @param string $app
   * @param string $url
   * @param bool $absolute
   * @param string $env
   * @param string $initialInstanceName for test purpose
   * @return mixed
   */
  public static function buildUrl($app, $url, $absolute = false, $env = null, $initialInstanceName = null)
  {
    $initialApp = sfConfig::get('sf_app');
    if($initialInstanceName == null)
    {
      $initialInstanceName = $initialApp;
    }
    $initialScriptName      = $_SERVER['SCRIPT_NAME'];
    $initialFrontController = basename($initialScriptName);
    $initialConfig          = sfConfig::getAll();
    $debug                  = sfConfig::get('sf_debug');

    //environnement par défaut
    if($env == null)
    {
      $env = $initialConfig['sf_environment'];
    }

    //création du contexte
    if(!sfContext::hasInstance($app))
    {
      sfConfig::set('sf_factory_storage', 'sfNoStorage'); // la config de base est restaurée à la fin de la fonction
      sfConfig::set('sf_use_database', false);
      $configuration = ProjectConfiguration::getApplicationConfiguration($app, $env, $debug);
      $context       = sfContext::createInstance($configuration, $app);
      unset($configuration);
    }
    else
    {
      $context = sfContext::getInstance($app);
    }

    //détermination du front controller
    $finalFrontController = $app;

    if($env != 'prod')
    {
      $finalFrontController .= '_'.$env;
    }

    $finalFrontController.='.php';

    $crossUrl = $context->getController()->genUrl($url, $absolute);
    unset($context);

    //vérrification de l'existence du front controller
    if (!file_exists(sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.$finalFrontController))
    {
      throw new Exception('Le front controller '.$finalFrontController.' est introuvable.');
    }

    $crossUrl = str_replace($initialFrontController, $finalFrontController, $crossUrl);

    //retour au context initial
    if($app !== $initialInstanceName)
    {
      sfContext::switchTo($initialInstanceName);
      sfConfig::clear();
      sfConfig::add($initialConfig);
    }

    return $crossUrl;
  }

  /**
   * retourne la clef, différente pour chaque url selon l'environnement
   *
   * @static
   * @param string $app
   * @param string $url
   * @param bool $absolute
   * @param string $env
   * @param string $sfRootDir for test purpose
   * @return string
   */
  public static function getCacheKey($app, $url, $absolute = false, $env = null, $sfRootDir = null)
  {
    //for test purpose
    if($sfRootDir == null)
    {
      $sfRootDir = sfConfig::get('sf_root_dir');
    }

    $key = $sfRootDir. //pour différencier deux instances de la même appli
      $_SERVER['SERVER_NAME'].
      $app.$url.sfConfig::get('sf_environment').
      ($env ? $env : '').
      ($absolute ? 'abs' : '');

    // md5 pour éviter d'avoir une clef supérieure à 250 caractères.
    return md5($key);
  }
}