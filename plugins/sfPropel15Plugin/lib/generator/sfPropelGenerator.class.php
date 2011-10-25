<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Propel generator.
 *
 * @package    symfony
 * @subpackage propel
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfPropelGenerator.class.php 22943 2009-10-12 12:04:19Z Kris.Wallsmith $
 */
class sfPropelGenerator extends sfModelGenerator
{
  protected
    $tableMap = null,
    $dbMap    = null;

  /**
   * Initializes the current sfGenerator instance.
   *
   * @param sfGeneratorManager $generatorManager A sfGeneratorManager instance
   */
  public function initialize(sfGeneratorManager $generatorManager)
  {
    parent::initialize($generatorManager);

    $this->setGeneratorClass('sfPropelModule');
  }

  /** 
   * Configures this generator.
   */
  public function configure()
  {
    // get some model metadata
    $this->loadMapBuilderClasses();

    // load all primary keys
    $this->loadPrimaryKeys();
  }

  /**
   * Gets the table map for the current model class.
   *
   * @return TableMap A TableMap instance
   */
  public function getTableMap()
  {
    return $this->tableMap;
  }

  /**
   * Returns an array of tables that represents a many to many relationship.
   *
   * A table is considered to be a m2m table if it has 2 foreign keys that are also primary keys.
   *
   * @return array An array of tables.
   */
  public function getManyToManyTables()
  {
    $tables = array();

    // go through all tables to find m2m relationships
    foreach ($this->dbMap->getTables() as $tableName => $table)
    {
      // load this table's relations and related tables
      $table->getRelations();

      foreach ($table->getColumns() as $column)
      {
        if ($column->isForeignKey() && $column->isPrimaryKey() && $this->getTableMap()->getClassname() == $this->dbMap->getTable($column->getRelatedTableName())->getClassname())
        {
          // we have a m2m relationship
          // find the other primary key
          foreach ($table->getColumns() as $relatedColumn)
          {
            if ($relatedColumn->isForeignKey() && $relatedColumn->isPrimaryKey() && $this->getTableMap()->getClassname() != $this->dbMap->getTable($relatedColumn->getRelatedTableName())->getClassname())
            {
              // we have the related table
              $tables[] = array(
                'middleTable'   => $table,
                'relatedTable'  => $this->dbMap->getTable($relatedColumn->getRelatedTableName()),
                'column'        => $column,
                'relatedColumn' => $relatedColumn,
              );

              break 2;
            }
          }
        }
      }
    }

    return $tables;
  }

  /**
   * Loads primary keys.
   *
   * @throws sfException
   */
  protected function loadPrimaryKeys()
  {
    $this->primaryKey = array();
    foreach ($this->tableMap->getPrimaryKeys() as $column)
    {
      $this->primaryKey[] = $column->getPhpName();
    }

    if (!count($this->primaryKey))
    {
      throw new sfException(sprintf('Cannot generate a module for a model without a primary key (%s)', $this->modelClass));
    }
  }

  /**
   * Loads map builder classes.
   *
   * @throws sfException
   */
  protected function loadMapBuilderClasses()
  {
    $this->dbMap = Propel::getDatabaseMap();
    $this->tableMap = call_user_func(array($this->modelClass . 'Peer', 'getTableMap'));
    // load all related table maps, 
    // and all tables related to the related table maps (for m2m relations)
    foreach ($this->tableMap->getRelations() as $relation)
    {
      $relation->getForeignTable()->getRelations();
    }
  }

  /**
   * Returns HTML code for a field.
   *
   * @param sfModelGeneratorConfigurationField $field The field
   *
   * @return string HTML code
   */
  public function renderField($field)
  {
    if ($field->isLink() && ($module = $field->getConfig('link_module', false, false)))
    {
      $field->setLink(false);
      $html = parent::renderField($field);
      $field->setLink(true);
      $html = sprintf("link_to(%s, '%s', %s)", $html, $module . '_edit', $html);
      return $html;
    }
    else
    {
      return parent::renderField($field);
    }
  }
  
  /**
   * Returns the getter either non-developped: 'getFoo' or developped: '$class->getFoo()'.
   *
   * @param string  $column     The column name
   * @param boolean $developed  true if you want developped method names, false otherwise
   * @param string  $prefix     The prefix value
   *
   * @return string PHP code
   */
  public function getColumnGetter($column, $developed = false, $prefix = '')
  {
    try
    {
      $getter = 'get'.call_user_func(array(constant($this->getModelClass().'::PEER'), 'translateFieldName'), $column, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_PHPNAME);
    }
    catch (PropelException $e)
    {
      // not a real column
      $getter = 'get'.sfInflector::camelize($column);
    }

    if (!$developed)
    {
      return $getter;
    }

    return sprintf('$%s%s->%s()', $prefix, $this->getSingularName(), $getter);
  }

  /**
   * Returns the type of a column.
   *
   * @param  object $column A column object
   *
   * @return string The column type
   */
  public function getType($column)
  {
    if ($column->isForeignKey())
    {
      return 'ForeignKey';
    }

    switch ($column->getType())
    {
      case PropelColumnTypes::BOOLEAN:
      case PropelColumnTypes::BOOLEAN_EMU:
        return 'Boolean';
      case PropelColumnTypes::DATE:
      case PropelColumnTypes::TIMESTAMP:
        return 'Date';
      case PropelColumnTypes::TIME:
        return 'Time';
      default:
        return 'Text';
    }
  }

  /**
   * Returns the default configuration for fields.
   *
   * @return array An array of default configuration for all fields
   */
  public function getDefaultFieldsConfiguration()
  {
    $fields = array();

    $names = array();
    foreach ($this->getTableMap()->getColumns() as $column)
    {
      $name = $this->translateColumnName($column);
      $names[] = $name;
      $fields[$name] = array_merge(array(
        'is_link'      => (Boolean) $column->isPrimaryKey(),
        'is_real'      => true,
        'is_partial'   => false,
        'is_component' => false,
        'type'         => $this->getType($column),
      ), isset($this->config['fields'][$name]) ? $this->config['fields'][$name] : array());
    }

    foreach ($this->getManyToManyTables() as $tables)
    {
      $name = sfInflector::underscore($tables['middleTable']->getClassname()).'_list';
      $names[] = $name;
      $fields[$name] = array_merge(array(
        'is_link'      => false,
        'is_real'      => false,
        'is_partial'   => false,
        'is_component' => false,
        'type'         => 'Text',
      ), isset($this->config['fields'][$name]) ? $this->config['fields'][$name] : array());
    }

    if (isset($this->config['fields']))
    {
      foreach ($this->config['fields'] as $name => $params)
      {
        if (in_array($name, $names))
        {
          continue;
        }

        $fields[$name] = array_merge(array(
          'is_link'      => false,
          'is_real'      => false,
          'is_partial'   => false,
          'is_component' => false,
          'type'         => 'Text',
        ), is_array($params) ? $params : array());
      }
    }

    unset($this->config['fields']);

    return $fields;
  }

  /**
   * Returns the configuration for fields in a given context.
   *
   * @param  string $context The Context
   *
   * @return array An array of configuration for all the fields in a given context 
   */
  public function getFieldsConfiguration($context)
  {
    $fields = array();

    $names = array();
    foreach ($this->getTableMap()->getColumns() as $column)
    {
      $name = $this->translateColumnName($column);
      $names[] = $name;
      $fields[$name] = isset($this->config[$context]['fields'][$name]) ? $this->config[$context]['fields'][$name] : array();
    }

    foreach ($this->getManyToManyTables() as $tables)
    {
      $name = sfInflector::underscore($tables['middleTable']->getClassname()).'_list';
      $names[] = $name;
      $fields[$name] = isset($this->config[$context]['fields'][$name]) ? $this->config[$context]['fields'][$name] : array();
    }

    if (isset($this->config[$context]['fields']))
    {
      foreach ($this->config[$context]['fields'] as $name => $params)
      {
        if (in_array($name, $names))
        {
          continue;
        }

        $fields[$name] = is_array($params) ? $params : array();
      }
    }

    unset($this->config[$context]['fields']);

    return $fields;
  }

  /**
   * Gets all the fields for the current model.
   *
   * @param  Boolean $withM2M Whether to include m2m fields or not
   *
   * @return array   An array of field names
   */
  public function getAllFieldNames($withM2M = true)
  {
    $names = array();
    foreach ($this->getTableMap()->getColumns() as $column)
    {
      $names[] = $this->translateColumnName($column);
    }

    if ($withM2M)
    {
      foreach ($this->getManyToManyTables() as $tables)
      {
        $names[] = sfInflector::underscore($tables['middleTable']->getClassname()).'_list';
      }
    }

    return $names;
  }

  public function translateColumnName($column, $related = false, $to = BasePeer::TYPE_FIELDNAME)
  {
    $peer = $related ? constant($column->getTable()->getDatabaseMap()->getTable($column->getRelatedTableName())->getPhpName().'::PEER') : constant($column->getTable()->getPhpName().'::PEER');
    $field = $related ? $column->getRelatedName() : $column->getFullyQualifiedName();

    return call_user_func(array($peer, 'translateFieldName'), $field, BasePeer::TYPE_COLNAME, $to);
  }
  
  /**
   * Get the code to modify a form object based on fields configuration.
   *
   * Configuration attributes considered for customization:
   *  * type
   *  * widgetClass
   *  * widgetOptions
   *  * widgetAttributes (same effect as the 'attributes' attribute)
   *  * validatorClass
   *  * validatorOptions
   *  * validatorMessages
   *
   * This also removes unused fields from the display list.
   *
   * <code>
   * form:
   *   display: [foo1, foo2]
   *   fields:
   *     foo1: { widgetOptions: { bar: baz } }
   *     foo2: { widgetClass: sfWidgetFormInputText, validatorClass: sfValidatorPass }
   *     foo3: { type: plain }  
   * $form->getWidget('foo1')->setOption('bar', 'baz');
   * $form->setWidget('foo2', new sfWidgetFormInputText());
   * $form->setValidator('foo2', new sfValidatorPass());
   * $form->setWidget('foo3', new sfWidgetFormPlain());
   * $form->setValidator('foo3', new sfValidatorPass(array('required' => false)));
   * $form->mergePostValidator(new sfValidatorSchemaRemove(array('fields' => array('foo3'))));
   * unset($form['foo']);
   * </code>
   *
   * @param string $view Choices are 'edit', 'new', or 'filter'
   * @param string $formVariableName The name of the variable referencing the form.
   *                                 Choices are 'form', or 'filters'
   *
   * @return string the form customization code
   */
  public function getFormCustomization($view, $formVariableName = 'form')
  {
    $customization = '';
    $form = $this->configuration->getForm(); // fallback field definition
    $defaultFieldNames = array_keys($form->getWidgetSchema()->getFields());
    $unusedFields = array_combine($defaultFieldNames, $defaultFieldNames);
    $fieldsets = ($view == 'filter') ? array('NONE' => $this->configuration->getFormFilterFields($form)) : $this->configuration->getFormFields($form, $view);
    $plainFields = array();
    
    foreach ($fieldsets as $fieldset => $fields)
    {
      foreach ($fields as $fieldName => $field) 
      {
        // plain widget
        if ($field->getConfig('type', false) == 'plain')
        {
          $plainFields[]= $fieldName;
          $customization .= "    \$this->" . $formVariableName . "->setWidget('$fieldName', new sfWidgetFormPlain());
";
          $customization .= "    \$this->" . $formVariableName . "->setValidator('$fieldName', new sfValidatorPass(array('required' => false)));
";
        }
        
        // widget customization
        if (!$widgetConfig = $field->getConfig('widget', array()))
        {
          if ($widgetClass = $field->getConfig('widgetClass', false))
          {
            $widgetConfig['class'] = $widgetClass;
          }
          if ($widgetOptions = $field->getConfig('widgetOptions', false))
          {
            $widgetConfig['options'] = $widgetOptions;
          }
          if ($widgetAttributes = $field->getConfig('widgetAttributes', false))
          {
            $widgetConfig['attributes'] = $widgetAttributes;
          }
        }
        if ($widgetConfig) 
        {
          $options = (isset($widgetConfig['options'])) ? $widgetConfig['options'] : array();
          $attributes = (isset($widgetConfig['attributes'])) ? $widgetConfig['attributes'] : array();
          if (isset($widgetConfig['class']))
          {
            $class = $widgetConfig['class'];
            $customization .= "    \$this->" . $formVariableName . "->setWidget('$fieldName', new $class(" . $this->asPhp($options) . ", " . $this->asPhp($attributes) . "));
";
          }
          else
          {
            foreach ($options as $name => $value)
            {
              $customization .= "    \$this->" . $formVariableName . "->getWidget('$fieldName')->setOption('$name', " . $this->asPhp($value) . ");
";
            }
            foreach ($attributes as $name => $value)
            {
              $customization .= "    \$this->" . $formVariableName . "->getWidget('$fieldName')->setAttribute('$name', " . $this->asPhp($value) . ");
";
            }
          }
        }
        
        // validator configuration
        if (!$validatorConfig = $field->getConfig('validator', array()))
        {
          if ($validatorClass = $field->getConfig('validatorClass', false))
          {
            $validatorConfig['class'] = $validatorClass;
          }
          if ($validatorOptions = $field->getConfig('validatorOptions', false))
          {
            $validatorConfig['options'] = $validatorOptions;
          }
          if ($validatorMessages = $field->getConfig('validatorMessages', false))
          {
            $validatorConfig['messages'] = $validatorMessages;
          }
        }
        if ($validatorConfig) 
        {
          $options = (isset($validatorConfig['options'])) ? $validatorConfig['options'] : array();
          $messages = (isset($validatorConfig['messages'])) ? $validatorConfig['messages'] : array();
          if (isset($validatorConfig['class']))
          {
            $class = $validatorConfig['class'];
            $customization .= "    \$this->" . $formVariableName . "->setValidator('$fieldName', new $class(" . $this->asPhp($options) . ", " . $this->asPhp($messages) . "));
";
          }
          else
          {
            foreach ($options as $name => $value)
            {
              $customization .= "    \$this->" . $formVariableName . "->getValidator('$fieldName')->setOption('$name', " . $this->asPhp($value) . ");
";
            }
            foreach ($messages as $name => $value)
            {
              $customization .= "    \$this->" . $formVariableName . "->getValidator('$fieldName')->setMessage('$name', " . $this->asPhp($value) . ");
";
            }
          }
        }

        // this field is used
        if (isset($unusedFields[$fieldName]))
        {
          unset($unusedFields[$fieldName]);
        }
      }
    }
    
    // remove plain fields from validation
    if (!empty($plainFields))
    {
      $customization .= "    \$this->" . $formVariableName . "->mergePostValidator(new sfValidatorSchemaRemove(array('fields' => " . $this->asPhp($plainFields) .  ")));
";
    }
    
    // remove unused fields
    if (!empty($unusedFields))
    {
      foreach ($unusedFields as $field)
      {
        // ignore primary keys, CSRF, and embedded forms
        if ($form->getWidget($field) instanceof sfWidgetFormInputHidden 
         || $form->getWidget($field) instanceof sfWidgetFormSchemaDecorator)
        {
          continue;
        }
        $customization .= "    unset(\$this->" . $formVariableName . "['$field']);
";
      }
    }
    
    return $customization;
  }
}
