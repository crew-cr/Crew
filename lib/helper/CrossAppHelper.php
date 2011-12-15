<?php

/**
 * return an url for a given symfony application and an internal url
 *
 * @author Olivier Mansour
 *
 * @param string  $app
 * @param string  $url
 * @param boolean $absolute
 * @param string  $env
 *
 * @return string
 */
function cross_app_url_for($app, $url, $absolute = false, $env = null)
{
  return crossAppRouting::genUrl($app, $url, $absolute, $env);
}

/**
 * Cette fonction est un infame copier coller de link_to1 avec un zeste de modif pour la rendre cross app
 *
 * @param string $name
 * @param string $app l'application
 * @param string $internalUri
 * @param string $env
 * @param array  $options
 *
 * @see link_to1
 *
 *
 * @return string
 */
function cross_app_link_to($name, $app, $internalUri, $env = null, $options = array())
{
  sfProjectConfiguration::getActive()->loadHelpers(array('Url'));

  $crossUrl = cross_app_url_for($app, $internalUri, true, $env);

  return link_to($name, $crossUrl, $options);
}
