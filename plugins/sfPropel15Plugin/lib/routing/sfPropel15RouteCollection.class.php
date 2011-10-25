<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfPropelRouteCollection represents a collection of routes bound to Propel objects.
 *
 * @package    symfony
 * @subpackage routing
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfPropelRouteCollection.class.php 12755 2008-11-08 09:48:03Z fabien $
 */
class sfPropel15RouteCollection extends sfObjectRouteCollection
{
  protected
    $routeClass = 'sfPropel15Route';

  /**
   * Constructor.
   *
   * @param array $options An array of options
   */
  public function __construct(array $options)
  {
    $options = array_merge(array(
      'query_methods'        => array('list' => null, 'object' => null),
    ), $options);

    parent::__construct($options);
  }

  protected function generateRoutes()
  {
    // collection actions
    if (isset($this->options['collection_actions']))
    {
      foreach ($this->options['collection_actions'] as $action => $methods)
      {
        $this->routes[$this->getRoute($action)] = $this->getRouteForCollection($action, $methods);
      }
    }

    // "standard" actions
    $actions = false === $this->options['actions'] ? $this->getDefaultActions() : $this->options['actions'];
    foreach ($actions as $action)
    {
      $method = 'getRouteFor'.ucfirst($action);
      if (!method_exists($this, $method))
      {
        throw new InvalidArgumentException(sprintf('Unable to generate a route for the "%s" action.', $action));
      }

      $this->routes[$this->getRoute($action)] = $this->$method();
    }

    // object actions
    if (isset($this->options['object_actions']))
    {
      foreach ($this->options['object_actions'] as $action => $methods)
      {
        $this->routes[$this->getRoute($action)] = $this->getRouteForObject($action, $methods);
      }
    }

    if ($this->options['with_wildcard_routes'])
    {
      // wildcard object actions
      $this->routes[$this->getRoute('object')] = $this->getWildcardRouteForObject();

      // wildcard collection actions
      $this->routes[$this->getRoute('collection')] = $this->getWildcardRouteForCollection();
    }
  }

  protected function getRouteForCollection($action, $methods)
  {
    return new $this->routeClass(
      sprintf('%s/%s.:sf_format', $this->options['prefix_path'], $action),
      array_merge(array('module' => $this->options['module'], 'action' => $action, 'sf_format' => 'html'), $this->options['default_params']),
      array_merge($this->options['requirements'], array('sf_method' => $methods)),
      array('model' => $this->options['model'], 'type' => 'list', 'query_methods' => $this->options['query_methods']['list'])
    );
  }

  protected function getRouteForObject($action, $methods)
  {
    return new $this->routeClass(
      sprintf('%s/:%s/%s.:sf_format', $this->options['prefix_path'], $this->options['column'], $action),
      array_merge(array('module' => $this->options['module'], 'action' => $action, 'sf_format' => 'html'), $this->options['default_params']),
      array_merge($this->options['requirements'], array('sf_method' => $methods)),
      array('model' => $this->options['model'], 'type' => 'object', 'query_methods' => $this->options['query_methods']['object'])
    );
  }
  
  protected function getWildcardRouteForCollection()
  {
    return new $this->routeClass(
      sprintf('%s/:action/action.:sf_format', $this->options['prefix_path']),
      array_merge(array('module' => $this->options['module'], 'sf_format' => 'html'), $this->options['default_params']),
      array_merge($this->options['requirements'], array('sf_method' => 'post')),
      array('model' => $this->options['model'], 'type' => 'list', 'query_methods' => $this->options['query_methods']['list'])
    );
  }

  protected function getWildcardRouteForObject()
  {
    return new $this->routeClass(
      sprintf('%s/:%s/:action.:sf_format', $this->options['prefix_path'], $this->options['column']),
      array_merge(array('module' => $this->options['module'], 'sf_format' => 'html'), $this->options['default_params']),
      array_merge($this->options['requirements'], array('sf_method' => 'get')),
      array('model' => $this->options['model'], 'type' => 'object', 'query_methods' => $this->options['query_methods']['object'])
    );
  }

  protected function getRouteForList()
  {
    return new $this->routeClass(
      sprintf('%s.:sf_format', $this->options['prefix_path']),
      array_merge(array('module' => $this->options['module'], 'action' => $this->getActionMethod('list'), 'sf_format' => 'html'), $this->options['default_params']),
      array_merge($this->options['requirements'], array('sf_method' => 'get')),
      array('model' => $this->options['model'], 'type' => 'list', 'query_methods' => $this->options['query_methods']['list'])
    );
  }

  protected function getRouteForShow()
  {
    return new $this->routeClass(
      sprintf('%s/:%s.:sf_format', $this->options['prefix_path'], $this->options['column']),
      array_merge(array('module' => $this->options['module'], 'action' => $this->getActionMethod('show'), 'sf_format' => 'html'), $this->options['default_params']),
      array_merge($this->options['requirements'], array('sf_method' => 'get')),
      array('model' => $this->options['model'], 'type' => 'object', 'query_methods' => $this->options['query_methods']['object'])
    );
  }

  protected function getRouteForEdit()
  {
    return new $this->routeClass(
      sprintf('%s/:%s/%s.:sf_format', $this->options['prefix_path'], $this->options['column'], $this->options['segment_names']['edit']),
      array_merge(array('module' => $this->options['module'], 'action' => $this->getActionMethod('edit'), 'sf_format' => 'html'), $this->options['default_params']),
      array_merge($this->options['requirements'], array('sf_method' => 'get')),
      array('model' => $this->options['model'], 'type' => 'object', 'query_methods' => $this->options['query_methods']['object'])
    );
  }

  protected function getRouteForUpdate()
  {
    return new $this->routeClass(
      sprintf('%s/:%s.:sf_format', $this->options['prefix_path'], $this->options['column']),
      array_merge(array('module' => $this->options['module'], 'action' => $this->getActionMethod('update'), 'sf_format' => 'html'), $this->options['default_params']),
      array_merge($this->options['requirements'], array('sf_method' => 'put')),
      array('model' => $this->options['model'], 'type' => 'object', 'query_methods' => $this->options['query_methods']['object'])
    );
  }

  protected function getRouteForDelete()
  {
    return new $this->routeClass(
      sprintf('%s/:%s.:sf_format', $this->options['prefix_path'], $this->options['column']),
      array_merge(array('module' => $this->options['module'], 'action' => $this->getActionMethod('delete'), 'sf_format' => 'html'), $this->options['default_params']),
      array_merge($this->options['requirements'], array('sf_method' => 'delete')),
      array('model' => $this->options['model'], 'type' => 'object', 'query_methods' => $this->options['query_methods']['object'])
    );
  }

}
