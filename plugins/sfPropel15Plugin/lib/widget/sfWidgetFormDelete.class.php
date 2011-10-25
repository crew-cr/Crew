<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfWidgetFormDelete represents a delete widget for an embedded object form
 *
 * @package    symfony
 * @subpackage widget
 * @author     Francois Zaninotto
 */
class sfWidgetFormDelete extends sfWidgetFormInputCheckbox
{
  /**
   * Constructor.
   *
   * Available options:
   *
   *  - alert_text: The text of the Javascript alert to show
   *  - hide_parent: Whether to hide the parent form when clicking the checkbox
   *  - parent_level: The number of times parentNode must be called to reach the parent to hide.
   *                  Recommended values: 6 for embedded form, 7 for merged form
   *
   * @param array  $options     An array of options
   * @param array  $attributes  An array of default HTML attributes
   *
   * @see sfWidgetFormInput
   */
  public function __construct($options = array(), $attributes = array())
  {
    parent::__construct($options, $attributes);
    
    if ($this->getOption('hide_parent'))
    {
      $hideParentCode = 'this' . str_repeat('.parentNode', $this->getOption('parent_level')) . '.style.display="none";';
    }
    else
    {
      $hideParentCode = '';
    }
    if ($this->getOption('alert_text'))
    {
      $this->setAttribute('onclick', sprintf('if(confirm("%s")) { %s } else return false;', $this->translate($this->getOption('alert_text')), $hideParentCode));
    }
    else
    {
      $this->setAttribute('onclick', $hideParentCode);
    }
  }

  protected function configure($options = array(), $attributes = array())
  {
    parent::configure($options, $attributes);

    $this->addOption('alert_text', 'Are you sure you want to delete this item?\nThe deletion will be complete once the form is saved.');
    $this->addOption('hide_parent', true);
    $this->addOption('parent_level', 6);
  }
}