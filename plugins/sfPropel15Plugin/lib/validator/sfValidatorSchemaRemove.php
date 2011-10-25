<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfValidatorSchemaRemove removes some values from the input.
 * This validator can only be used as a post validator.
 *
 * @package    symfony
 * @subpackage validator
 * @author     François Zaninotto
 */
class sfValidatorSchemaRemove extends sfValidatorSchema
{

  /**
   * Constructor.
   *
   * @param array  $options   An array of options
   * @param array  $messages  An array of error messages
   *
   * @see sfValidatorSchema
   */
  public function __construct($options = array(), $messages = array())
  {
    $this->addRequiredOption('fields');
    $this->addOption('throw_global_error', false);
    
    parent::__construct(null, $options, $messages);
  }

  /**
   * @see sfValidatorBase
   */
  protected function doClean($values)
  {
    if (null === $values)
    {
      $values = array();
    }

    if (!is_array($values))
    {
      throw new InvalidArgumentException('You must pass an array parameter to the clean() method');
    }
    
    foreach ($this->getOption('fields') as $field)
    {
      // isset() doesn't work here since the value is null
      if (array_key_exists($field, $values))
      {
        // remove the (empty) value from the list to avoid erasing data
        unset($values[$field]);
      }
    }

    return $values;
  }

}
