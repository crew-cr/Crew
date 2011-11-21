<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfWidgetFormSchemaDecoratorEscaped wraps an escaped form schema widget string
 * inside a given HTML snippet.
 *
 * @package    symfony
 * @subpackage widget
 * @author     Francois Zaninotto
 */
class sfWidgetFormSchemaDecoratorEscaped extends sfWidgetFormSchemaDecorator
{

  /**
   * @param  string $name        The element name
   * @param  string $value       The value displayed in this widget
   * @param  array  $attributes  An array of HTML attributes to be merged with the default HTML attributes
   * @param  array  $errors      An array of errors for the field
   *
   * @return string An HTML tag string
   *
   * @see sfWidgetForm
   */
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    $widgetString = $this->widget->render($name, $value, $attributes, $errors);
    $widgetString = $this->escape($widgetString);
    return strtr($this->getDecorator($name), array('%content%' => $widgetString));
  }

  /**
   * Escape string for inclusion as a JavaScript string
   *
   * @param String $string the string to escape
   * @return String Escaped string to enclose between double quote.
   */
  protected function escape($string)
  {
    return substr(json_encode($string), 1, -1); // remove first and last double quote
  }

  protected function getDecorator($name)
  {
    return $this->decorator;
  }
}
