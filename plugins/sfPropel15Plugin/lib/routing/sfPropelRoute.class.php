<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfPropelRoute represents a route that is bound to a Propel class.
 *
 * A Propel route can represent a single Propel object or a list of objects.
 *
 * @package    symfony
 * @subpackage routing
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfPropelRoute.class.php 21924 2009-09-11 14:59:26Z fabien $
 */
class sfPropelRoute extends sfObjectRoute
{
  protected
    $criteria = null;

  public function setListCriteria(Criteria $criteria)
  {
    if (!$this->isBound())
    {
      throw new LogicException('The route is not bound.');
    }

    $this->criteria = $criteria;
  }

  protected function getObjectForParameters($parameters)
  {
    $this->fixOptions();

    if (!isset($this->options['method']))
    {
      $this->options['method'] = isset($this->options['method_for_criteria']) ? $this->options['method_for_criteria'] : 'doSelectOne';

      $className = $this->options['model'];
      $criteria = new Criteria();
      $variables = $this->getRealVariables();
      if (!count($variables))
      {
        return false;
      }

      foreach ($variables as $variable)
      {
        try
        {
          $constant = call_user_func(array($className, 'translateFieldName'), $variable, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
          $criteria->add($constant, $parameters[$variable]);
        }
        catch (Exception $e)
        {
          // don't add Criteria if the variable cannot be mapped to a column
        }
      }

      $parameters = $criteria;
    }

    return parent::getObjectForParameters($parameters);
  }

  protected function getObjectsForParameters($parameters)
  {
    $this->fixOptions();

    if (!isset($this->options['method']))
    {
      $this->options['method'] = isset($this->options['method_for_criteria']) ? $this->options['method_for_criteria'] : 'doSelect';
      $parameters = new Criteria();
    }

    if (null !== $this->criteria)
    {
      $parameters = $this->criteria;
    }

    return parent::getObjectForParameters($parameters);
  }

  protected function doConvertObjectToArray($object)
  {
    $this->fixOptions();

    if (isset($this->options['convert']) || method_exists($object, 'toParams'))
    {
      return parent::doConvertObjectToArray($object);
    }

    $className = $this->options['model'];

    $parameters = array();
    foreach ($this->getRealVariables() as $variable)
    {
      try
      {
        $method = 'get'.call_user_func(array($className, 'translateFieldName'), $variable, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_PHPNAME);
      }
      catch (Exception $e)
      {
        $method = 'get'.sfInflector::camelize($variable);
      }

      $parameters[$variable] = $object->$method();
    }

    return $parameters;
  }

  protected function fixOptions()
  {
    if (!isset($this->options['object_model']))
    {
      $this->options['object_model'] = $this->options['model'];
      $this->options['model'] = constant($this->options['model'].'::PEER');
    }
  }
}
