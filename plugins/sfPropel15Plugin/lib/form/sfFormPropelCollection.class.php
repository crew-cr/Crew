<?php

/**
 * sfFormPropelCollection represents a form based on a collection of Propel objects.
 *
 * @package    symfony
 * @subpackage form
 * @author     Francois Zaninotto
 */
class sfFormPropelCollection extends sfForm
{
  protected $model;
  protected $collection;
  protected $isEmpty = false;
  
  /**
   * Form constructor. 
   *
   * Available options:
   * - embedded_form_class: The class name of the forms to embed. Uses the model name by default.
   *                  (a form based on a collection of Book objects embeds BookForm objects)
   * - item_pattern:  The pattern used to name each embedded form. Defaults to '%index%'.
   * - add_delete:    Whether to add a delete widget for each object. Defaults to true.
   * - delete_name:   Name of the delete widget. Defaults to 'delete'.
   * - delete_widget: Optional delete widget object. If left null, uses a sfWidgetFormDelete instance.
   * - alert_text:    The text of the Javascript alert to show
   * - hide_parent:   Whether to hide the parent form when clicking the checkbox
   * - parent_level:  The number of times parentNode must be called to reach the parent to hide.
   *                  Recommended values: 6 for embedded form, 7 for merged form
   * - remove_fields: The list of fields to remove from the embedded object forms
   *
   * @param PropelCollection $collection A collection of Propel objects 
   *                                     used to initialize default values
   * @param array            $options    An array of options
   * @param string           $CSRFSecret A CSRF secret (false to disable CSRF protection, null to use the global CSRF secret)
   *
   * @see sfForm
   */
  public function __construct($collection = null, $options = array(), $CSRFSecret = null)
  {
    $options = array_merge(array(
      'item_pattern'  => '%index%',
      'add_delete'    => false,
      'delete_name'   => 'delete',
      'delete_widget' => null,
      'remove_fields' => array(),
    ), $options);
    
    if (!$collection)
    {
      $this->model = $options['model'];
      $collection = new PropelObjectcollection();
      $collection->setModel($this->model);
      $this->collection = $collection;
    }
    else
    {
      if (!$collection instanceof PropelObjectCollection)
      {
        throw new sfException(sprintf('The "%s" form only accepts a PropelObjectCollection object.', get_class($this)));
      }
      $this->collection = $collection;
      $this->model = $collection->getModel();
    }
    
    $this->isEmpty = $this->getCollection()->isEmpty();

    parent::__construct(array(), $options, $CSRFSecret);
  }
  
  /**
   * Configures the current form.
   */
  public function configure()
  {
    $formClass = $this->getFormClass();
    $i = 1;
    foreach ($this->getCollection() as $relatedObject)
    {
      $form = new $formClass($relatedObject);
      foreach ($this->getOption('remove_fields') as $field)
      {
        unset($form[$field]);
      }
      if ($this->getOption('add_delete'))
      {
        if (!($deleteWidget = $this->options['delete_widget']))
        {
          $options = array();
          if ($alertText = $this->getOption('alert_text', false))
          {
            $options['alert_text'] = $alertText;
          }
          if ($hideParent = $this->getOption('hide_parent', false))
          {
            $options['hide_parent'] = $hideParent;
          }
          if ($parentLevel = $this->getOption('parent_level', false))
          {
            $options['parent_level'] = $parentLevel;
          }
          $deleteWidget = new sfWidgetFormDelete($options);
        }
        $form->setDeleteWidget($this->getOption('delete_name'), $deleteWidget);
      }
      $name = strtr($this->getOption('item_pattern'), array('%index%' => $i, '%model%' => $this->getModel()));
      $this->embedForm($name, $form);
      $i++;
    }
  }
  
  /**
   * Getter for the internal collection object
   *
   * @return PropelCollection
   */
  public function getCollection()
  {
    return $this->collection;
  }
  
  /**
   * Getter for the name of the Propel model used by the collection
   *
   * @return string
   */
  public function getModel()
  {
    return $this->model;
  }
  
  /**
   * Check whether the embedded colleciton is empty
   *
   * @return boolean
   */
  public function isEmpty()
  {
    return $this->isEmpty;
  }
  
  /**
   * Getter for the embedded form class.
   * Uses the embedded_form_class option if available,
   * or falls back to the default form for the model.
   *
   * @return string
   */
  public function getFormClass()
  {
    if (!$class = $this->getOption('embedded_form_class', false))
    {
      $class = $this->getCollection()->getModel() . 'Form';
    }
    
    return $class;
  }

  /**
   * Embeds an optional sfForm into the current form.
   *
   * @param string $name       The field name
   * @param sfForm $form       A sfForm instance
   * @param string $decorator  A HTML decorator for the embedded form
   * @param array  $options    An array of options passed to the sfWidgetFormSchemaOptional
   */
  public function embedOptionalForm($name, sfForm $form, $decorator = null, $options = array())
  {
    $name = (string) $name;
    if (true === $this->isBound() || true === $form->isBound())
    {
      throw new LogicException('A bound form cannot be embedded');
    }

    $form = clone $form;
    unset($form[self::$CSRFFieldName]);

    $this->setDefault($name, $form->getDefaults());

    $widgetSchema = $form->getWidgetSchema();
    
    $decorator = null === $decorator ? $widgetSchema->getFormFormatter()->getDecoratorFormat() : $decorator;

    $this->widgetSchema[$name] = new sfWidgetFormSchemaOptional($widgetSchema, $decorator, $options);
    
    $this->validatorSchema[$name] = new sfValidatorPass();

    $this->resetFormFields();
  }
}