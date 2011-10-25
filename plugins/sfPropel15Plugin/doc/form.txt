Form Extensions
===============

The `sfPropel15Plugin` provides two widgets and three validators, to help build and validate forms bound to a Model object.

`sfWidgetPropelChoice` and `sfValidatorPropelChoice`
----------------------------------------------------

Editing a foreign key columns is often a matter of choosing the related object to relate. For instance, editing the `author_id` field of an `Article` model means choosing an element in the list of existing Authors. `sfPropel15Plugin` provides an extension of the `sfWidgetFormChoice` class that takes care of populating the list of options based on a related table. It is called `sfWidgetPropelChoice`, and is associated witha validator called `sfValidatorPropelChoice`.

### Generated Configuration

Most of the time, the configuration of this widget and validator is already done in the generated forms and filter forms. Using the previous example model, Propel would generate the following Base form:

    [php]
    abstract class BaseArticleForm extends BaseFormPropel
    {
      public function setup()
      {
        // ...
    
        $this->setWidgets(array(
          // ...
          'author_id' => new sfWidgetFormPropelChoice(array(
            'model' => 'Author',
            'add_empty' => true)
          ),
        ));
    
        $this->setValidators(array(
          // ...
          'author_id' => new sfValidatorPropelChoice(array(
            'model' => 'Author',
            'column' => 'id',
            'required' => false)
          ),
        ));
      }
    }

Based on the `model` setting, the plugin generates the list of possible choices for the widget and the validator.

### Additional Query Methods

You can set the widget to execute additional query methods on the related Model Query object. For instance, if a `Section` model uses the `nested_set` behavior, you probably want to display a section selection widget in hierarchical order. This is easily achived by executing the `SectionQuery::orderByBranch()` query method, and you can register it as follows:

    [php]
    class ContentForm extends BaseContentForm
    {
      public function configure()
      {
        $this->widgetSchema['section'] = new sfWidgetFormPropelChoice(array(
          'model'         => 'Section',
          'query_methods' => array('orderByBranch')
          'add_empty'     => true,
        ));
      }
    }


You can also enable the `query_method` option on an existing widget. For instance, to display only the list of active authors, customize the form as follows:

    [php]
    class ArticleForm extends BaseArticleForm
    {
      public function configure()
      { 
        $this->widgetSchema['author_id']->setOption('query_methods', array('active'));
      }
    }
    
    class ArticleQuery extends BaseArticleQuery
    {
      public function active()
      {
        return $this->filterByIsActive(true);
      }
    }

Of course, to allow the validation of the user's choice, the `query_methods` option is also available in the `sfValidatorPropelChoice` validator. Always remember to apply the same filters in the validator as in the widget.

So if you display a selection of items using a query method, you can validate this selection, too:

   [php]
   class ContentForm extends BaseContentForm
   {
     public function configure()
     {
       $this->widgetSchema['section']->setOption('query_methods', array('published'));
       $this->validatorSchema['section']->setOption('query_methods', array('published'));
     }
   }

### Using A Custom Query Object

Alternatively, build the query yourself in the form, and pass it to the widget in the `criteria` option:

    [php]
    class ArticleForm extends BaseArticleForm
    {
      public function configure()
      { 
        $query = ArticleQuery::create()->filterByIsActive(true);
        $this->widgetSchema['author_id']->setOption('criteria', $query);
      }
    }

The `criteria` option is also available in `sfValidatorPropelChoice`.

### Full Options List

The `sfWidgetFormPropelChoice` widget supports the following options:

* `model`: The model class (required)
* `add_empty`: Whether to add a first empty value or not (false by default). If the option is not a Boolean, the value will be used as the text value
* `method`: The method to use to display object values (__toString by default)
* `key_method`: The method to use to display the object keys (getPrimaryKey by default) 
* `order_by`: An array composed of two fields:
  * The column to order by the results (must be in the PhpName format)
  * asc or desc
* `query_methods`: An array of method names listing the methods to execute on the model's query object
* `criteria`: A criteria to use when retrieving objects
* `connection`: The Propel connection to use (null by default)
* `multiple`: true if the select tag must allow multiple selections

The `sfValidatorPropelChoice` validator accepts almost the same options:

* `model`: The model class (required)
* `query_methods`: An array of method names listing the methods to execute on the model's query object
* `criteria`: A criteria to use when retrieving objects
* `column`: The column name (null by default which means we use the primary key) must be in field name format
* `connection`: The Propel connection to use (null by default)
* `multiple`: true if the select tag must allow multiple selections
* `min`: The minimum number of values that need to be selected (this option is only active if multiple is true)
* `max`: The maximum number of values that need to be selected (this option is only active if multiple is true)

`sfValidatorPropelUnique`
-------------------------

In a blog application, two articles can not have the same slug; to ensure this constraint, the schema definition features a uniqueness constraint. This constraint on the database level is reflected in the ArticleForm form using the `sfValidatorPropelUnique` validator. This validator can check the uniqueness of any form field. It is helpful among other things to check the uniqueness of an email address of a login for instance. The next listing shows how to use it in the ArticleForm  form.

    [php]
    class ArticleForm extends BaseArticleForm
    {
      public function configure()
      {
        // ...
     
        $this->validatorSchema->setPostValidator(
          new sfValidatorPropelUnique(array(
            'model' => 'Article',
            'column' => array('slug')))
        );
      }
    }

The sfValidatorPropelUnique validator is a postValidator running on the whole data after the individual validation of each field. In order to validate the slug uniqueness, the validator must be able to access, not only the slug value, but also the value of the primary key(s). Validation rules are indeed different throughout the creation and the edition since the slug can stay the same during the update of an article.

This validator supports the following options:

* `model`: The model class (required)
* `column`: The unique column name in Propel field name format (required). If the uniquess is for several columns, you can pass an array of fiel names
* `query_methods`: An array of method names listing the methods to executeon the model's query object
* `field`: Field name used by the form, other than the column name
* `primary_key`: The primary key column name in Propel field name format (optional, will be introspected if not provided). You can also pass an array if the table has several primary keys
* `connection`: The Propel connection to use (null by default)
* `throw_global_error`: Whether to throw a global error (false by default) or an error tied to the first field related to the column option array

`sfWidgetFormPlain` and `sfValidatorSchemaRemove`
-------------------------------------------------

To display a field without any possiblity to change its value, no need to use a partial field. Just use the `sfWidgetFormPlain` widget to display the value in a div. Don't forget to disable the validator on that field, too, using the `sfValidatorPass` validator. 

But symfony expects to receive all form fields for binding, including plain fields. If the field is not present in the request, symfony uses a null value, which may erase the data in the column you want to display. To avoid erasing data, use the new `sfValidatorSchemaRemove` to remove plain fields from the binding process. This is a post validator, and it expects an array of field names in the `fields` option.

Here is an example for `created_at` and `updated_at` columns, that you may want to display without allowing their edition:

    [php]
    class ArticleForm extends BaseArticleForm
    {
      public function configure()
      {
        // ...
        $this->setWidget('created_at', new sfWidgetFormPlain());
        $this->setWidget('updated_at', new sfWidgetFormPlain());
        $this->setValidator('created_at', new sfValidatorPass(array('required' => false)));
        $this->setValidator('updated_at', new sfValidatorPass(array('required' => false)));
        $this->mergePostValidator(
          new sfValidatorSchemaRemove(array('fields' => array('created_at', 'updated_at')))
        );
      }
    }

**Tip**: If you use the admin generator, setting a field with `type: plain` produces the same effect, only in much less code.

    [yaml]
    edit:
      fields:
        created_at: { type: plain }
        updated_at: { type: plain }

`sfFormPropelCollection`
------------------------

If you need to build a form based on a collection of objects rather than on a single object, then the `sfFormPropelCollection` class will help you. To create such a form, just pass a PropelObjectcollection instance to its constructor, and you can use the form as a regular Propel object form:

    [php]
    $collection = new PropelObjectCollection();
    $collection->setModel('Book');
    $collection[]= new Book();
    $collection[]= new Book();
    $collection[]= new Book();
    $form = new sfFormPropelCollection($collection);
    echo $form; // displays a list of 3 BookForms, bound to each element in the collection
    
Embedding A Relation Form
-------------------------

Since one-to-many relationships return `PropelCollection` objects, the ability to create a collection form, added to the ability to merge two forms together, makes the edition of related objects very straightforward.

`sfPropelForm` provides a method called `embedRelation($relationName)`, which fetches a collection for a given relation, creates a `sfFormPropelCollection` instance based on the collection, and embeds this form into the main form. This allows,for instance, to edit an author together with all its books:

    [php]
    class ArticleForm extends BaseArticleForm
    {
      public function configure()
      {
        $this->embedRelation('Book');
      }
    }

Now the Article form displays the list of related books for each author, together with controls to add or remove Books for a given Author. No need to add code to the form object, it just works.

**Tip**: `sfPropelForm` also supports `mergeRelation()`, which merges the individual forms from the colleciton form into the parent form. As for embedded forms, merged relation forms support addition and removal of related objects.

`embedRelation()` offers many options to customize the embedded relation form:

* `title`: The title of the collection form once embedded. Defaults to the relation name.
* `embedded_form_class`: The class name of the forms to embed. Uses the model name by default (a form based on a collection of Book objects embeds BookForm objects).
* `collection_form_class`: Class of the collection form to return. Defaults to sfFormPropelCollection.
* `hide_on_new`: If true, the relation form does not appear for new objects. Defaults to false.
* `add_empty`: Whether to allow the user to add new objects to the collection. Defaults to true.
* `add_delete`: Whether to add a delete widget for each object. Defaults to true.
* `remove_fields`: The list of fields to remove from the embedded object forms
* `item_pattern`: The pattern used to name each embedded form. Defaults to '%index%'.

If `add_empty` is set to `true`, the following additional options are available:

* `empty_label`: The label of the empty form. Defaults to 'new' + the relation name.
* `add_link`: The text of the JavaScript link that displays the empty form. Defaults to `Ann new`
* `max_additions`: The max number of additions accepted on the client side. Defaults to 0 (no limit)

If `add_delete` is set to `true`, the following additional options are available:

* `delete_name`: Name of the delete widget. Defaults to 'delete'.
* `delete_widget`: Optional delete widget object. If left null, uses a `sfWidgetFormDelete` instance, which is a checkbox widget with a Javascript confirmation.
* `alert_text`: The text of the Javascript alert to show.
* `hide_parent`: Whether to hide the deleted form when clicking the checkbox. Defaults to true.
* `parent_level`: The number of times parentNode must be called to reach the parent to hide. As a widget doesn't know if it's merged or embedded, this setting allows the JavaScript code used to hide the parent to find it. Recommended values: 6 for embedded form (default), 7 for merged form.