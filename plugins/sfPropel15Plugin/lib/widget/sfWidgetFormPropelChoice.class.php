<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfWidgetFormPropelChoice represents a choice widget for a model.
 *
 * @package    symfony
 * @subpackage widget
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfWidgetFormPropelChoice.class.php 22261 2009-09-23 05:31:39Z fabien $
 */
class sfWidgetFormPropelChoice extends sfWidgetFormChoice
{
  /**
   * @see sfWidget
   */
  public function __construct($options = array(), $attributes = array())
  {
    $options['choices'] = array();

    parent::__construct($options, $attributes);
  }

  /**
   * Constructor.
   *
   * Available options:
   *
   *  * model:       The model class (required)
   *  * add_empty:   Whether to add a first empty value or not (false by default)
   *                 If the option is not a Boolean, the value will be used as the text value
   *  * method:      The method to use to display object values (__toString by default)
   *  * key_method:  The method to use to display the object keys (getPrimaryKey by default) 
   *  * order_by:    An array composed of two fields:
   *                   * The column to order by the results (must be in the PhpName format)
   *                   * asc or desc
   *  * query_methods: An array of method names listing the methods to execute
   *                 on the model's query object
   *  * criteria:    A criteria to use when retrieving objects
   *  * connection:  The Propel connection to use (null by default)
   *  * multiple:    true if the select tag must allow multiple selections
   *  * peer_method: ignored - only supported for BC purpose
   *
   * @see sfWidgetFormSelect
   */
  protected function configure($options = array(), $attributes = array())
  {
    $this->addRequiredOption('model');
    $this->addOption('add_empty', false);
    $this->addOption('method', '__toString'); 
    $this->addOption('key_method', 'getPrimaryKey');
    $this->addOption('order_by', null);
    $this->addOption('query_methods', array());
    $this->addOption('criteria', null);
    $this->addOption('connection', null);
    $this->addOption('multiple', false);
    // not used anymore
    $this->addOption('peer_method', 'doSelect');

    parent::configure($options, $attributes);
  }

  /**
   * Returns the choices associated to the model.
   *
   * @return array An array of choices
   */
  public function getChoices()
  {
    $choices = array();
    if (false !== $this->getOption('add_empty'))
    {
      $choices[''] = true === $this->getOption('add_empty') ? '' : $this->getOption('add_empty');
    }

    $criteria = PropelQuery::from($this->getOption('model'));
    if ($this->getOption('criteria'))
    {
      $criteria->mergeWith($this->getOption('criteria'));
    }
    foreach ($this->getOption('query_methods') as $method)
    {
      $criteria->$method();
    }
    if ($order = $this->getOption('order_by'))
    {
      $criteria->orderBy($order[0], $order[1]);
    }
    $objects = $criteria->find($this->getOption('connection'));

		$methodKey = $this->getOption('key_method');
    if (!method_exists($this->getOption('model'), $methodKey))
    {
      throw new RuntimeException(sprintf('Class "%s" must implement a "%s" method to be rendered in a "%s" widget', $this->getOption('model'), $methodKey, __CLASS__));
    }

    $methodValue = $this->getOption('method');
    if (!method_exists($this->getOption('model'), $methodValue))
    {
      throw new RuntimeException(sprintf('Class "%s" must implement a "%s" method to be rendered in a "%s" widget', $this->getOption('model'), $methodValue, __CLASS__));
    }

    foreach ($objects as $object)
    {
      $choices[$object->$methodKey()] = $object->$methodValue();
    }
		
		return $choices;
  }
}
