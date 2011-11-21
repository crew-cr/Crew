Admin Generator Extensions
==========================

sfPropelORMPlugin comes bundled with a new admin generator theme named 'admin15'. This theme provides additional features based on the new Propel 1.5 query objects, and is backwards compatible with sfPropelPlugin's admin generator theme.

To enable this theme, edit your `generator.yml` and change the `theme` property from `admin` to `admin15`, as follows:

    [yaml]
    generator:
      class: sfPropelGenerator
      param:
        model_class:           Book
        theme:                 admin15
        non_verbose_templates: true
        with_show:             false
        singular:              Book
        plural:                Books
        route_prefix:          book
        with_propel_route:     1
        actions_base_class:    sfActions

You can now use the additional features listed below.

Hydrating Related Objects
-------------------------

The `admin15` theme doesn't use the Peer classes anymore, therefore settings referencing the Peer classes are ignored in this theme. This includes `peer_method`, and `peer_count_method`. The new theme provides a simple alternative for these settings, called `with`. Add each of the objects to hydrate together with the main object in the `with` setting list:

    [yaml]
    list:
      display: [title, Author]
      with: [Author]

The admin generator will then execute the following query to display the list, effectively executing a single query instead of 1+n queries:

    [php]
    $books = BookQuery::create()
      ->joinWithAuthor()
      ->paginate();

Of course, you can add as many `with` names as you want, to hydrate multiple objects:

    [yaml]
    list:
      display: [title, Author, Publisher]
      with:    [Author, Publisher]

**Tip**: Before adding relations to the `with` setting, check that you don't already have a filter on the foreign key column that already makes the query to list all the related objects. If it's the case, then Propel's Instance Pooling will make the `with` superfluous, as each call to a related object will not trigger an additional query anyway.

Additional Query Methods
------------------------

You can execute additional query methods in the list by setting the `query_methods` parameter. For instance, in a list of `Books`, to limit the list of published books, setup your `list` view as follows:

    [yaml]
    list:
      display:       [title]
      query_methods: [filterByAlreadyPublished]

The admin generator will then execute the following query to display the list:

    [php]
    $books = BookQuery::create()
      ->filterByAlreadyPublished()
      ->paginate();

You must implement each `query_method` in the main object's query class. In this exemple, here is how you can implement `Bookquery::filterByAlreadyPublished()`:

    [php]
    class BookQuery extends BaseBookQuery
    {
      public function filterByAlreadyPublished()
      {
        return $this->filterByPublishedAt(array('min' => time()));
      }
    }

You can use this feature to add calculated columns to the list without additional queries:

    [yaml]
    list:
      display:       [title]
      query_methods: [withNbReviews]

For this to work, add the following method to the query class:

    [php]
    class BookQuery extends BaseBookQuery
    {
      public function withNbReviews()
      {
        return $this
          ->leftJoin('Book.Review')
          ->withColumn('COUNT(Review.Id)', 'NbReviews');
      }
    }

Now you can add a partial column and use the virtual `NbReviews` column in the list:

    [php]
    <?php echo $book->getVirtualColumn('NbReviews') ?>

Sometimes you may want to add additional parameter(s) to `query_method`. You can do that by adding array to specific `query_method`. This example does the same as previous but shows how to pass parameters:

    [yaml]
    list:
      display:       [title]
      query_methods:
        leftJoin:    ['Book.Review']
        withColumn:  ['COUNT(Review.Id)', 'NbReviews']

Sorting On A Virtual Column
---------------------------

The new theme provides an easy way to make virtual columns and foreign key columns sortable in the list view. Just declare the corresponding fields with `is_sortable` to `true`, and the generated module will look for an `orderByXXX()` method in the generated query. For instance, to allow a book list to be sortable on the author name:

    [yaml]
    # in generator.yml
    list:
      display:       [title, Author]
      query_methods: [joinWithAuthor]
      fields:
        - Author:    { is_sortable: true }

Then the generator will try to execute `BookQuery::orderByAuthor()` whenever the user clicks on the `Author` header to sort on this column. The method must be implemented as follows:

    [php]
    class BookQuery extends BaseBookQuery
    {
      public function orderByAuthor($order = Criteria::ASC)
      {
        return $this
          ->useAuthorQuery()
            ->orderByLastName($order)
          ->endUse();
      }
    }

You can override the default sorting method name for a field by setting the `sort_method` parameter:

    [yaml]
    # in generator.yml
    list:
      display:       [title, Author]
      query_methods: [joinWithAuthor]
      fields:
        - Author:    { is_sortable: true, sort_method: orderByAuthorLastName }

The generator will execute `BookQuery::orderByAuthorLastName()` instead of `BookQuery::orderByAuthor()` in that case.

Filtering The List With GET Parameters
--------------------------------------

The admin generator doesn't allow to filter the list using GET parameters. This neat feature used to be supported in previous versions of the generator, and is supported again in the `admin15` theme.

All you have to do to filter a list view is to prepend a query string to the URL, describing the filters in a `filters` array. For instance, to link to the book list view filtered by Author, try the following link:

    [php]
    <?php echo link_to($author->getName(), 'book', array(), array('query_string' => 'filters[author_id]=' . $author->getId())) ?>

This is very useful for partial lists, to link admin modules together.

Cross-Linking Admin Modules
---------------------------

In lists, related object columns often have to link to another admin generator module. For instance, in a list of `Books`, a column showing the `Author` name usually needs to link to the `edit` view in the `author` module for the current book author. You can implement this feature using a partial column:

    [yaml]
    # in generator.yml
    list:
      display: [title, _author]

The partial column code is a one-liner, but it's quite tedious to repeat it many times:

    [php]
    // in modules/book/templates/_author.php
    <?php echo link_to($book->getAuthor(), 'author_edit', $book->getAuthor()) ?>

The `admin15` theme provides a shortcut for this situation. Just define the `link_module` setting in the `Author` field configuration to point the `author` module, and you're good to go:

    [yaml]
    # in generator.yml
    list:
      display:  [title, =Author]
      fields:
        Author: { link_module: author }

You no longer need a partial for such simple cases. This should unclutter the `templates/` directory of your admin generator modules.

Easy Custom Filter
------------------

Adding custom filters becomes very easy once you can take advantage of the generated Propel query classes. For example, in a list of `Books`, the default filters offer one text input for the book title, and a second one for the book ISBN. In order to replace them with a single text input, here is what you need to do:

    [php]
    // in lib/filter/BookFormFilter.php
    class BookFormFilter extends BaseBookFormFilter
    {
      public function configure()
      {
        $this->widgetSchema['full_text'] = new sfWidgetFormFilterInput(array('with_empty' => false));
        $this->validatorSchema['full_text'] = new sfValidatorPass(array('required' => false));
      }
    }

    // in lib/model/Bookquery.php
    class BookQuery extends BaseBookQuery
    {
      public function filterByFullText($value)
      {
        if (isset($value['text'])) {
          $pattern = '%' . $value['text'] . '%';
          $this
            ->condition('condTitle', 'Book.Title LIKE ?', $pattern)
            ->condition('condISBN', 'Book.ISBN LIKE ?', $pattern)
            ->combine(array('condTitle', 'condISBN'), Criteria::LOGICAL_OR);
        }
        return $this;
      }
    }

Now just modify the `filter.display` setting in the `generator.yml` to remove the `title` and `isbn` filters, and replace them with the new `full_text` filter:

    [yaml]
    # in modules/book/config/generator.yml
    config:
      filter:
        display: [full_text]

The amdin generator looks for a `filterByXXX()` method in the query class, where `XXX` is the CamelCase version of the custom filter you add.

YAML Form Customization
-----------------------

You can now modify, add or remove widgets and validators directly from within the `generator.yml`, for all generator forms. That means you no longer need to edit a form object for basic widget customization.

This is made possible by five new field attributes that you can customize: `widgetClass`, `widgetOptions`, `validatorClass`, `validatorOptions`, and `validatorMessages`. Of course, you can still modify the HTML attributes of a widget by setting the `attributes` attribute.

**Tip**: You can also safely omit one of the form fields in the `display` list. The `admin15` generator theme takes care of unsetting the field in the form for you.

For instance, to replace an input filter on a text column by a choice list, try the following:

    [php]
    filter:
      fields:
        sex:
          widgetClass:   sfWidgetFormChoice
          widgetOptions: { choices: { '': '' , male: Male, female: Female } }

To remove the "is empty" checkbox for a given filter, just set the relevant widget option in YAML:

    [php]
    filter:
      fields:
        title:
          widgetOptions: { with_empty: false }

To replace a text input by a textarea in the edit form, change the widget class:

    [php]
    form:
      fields:
        body:
          widgetClass:   sfWidgetFormTextarea

The configuration cascade works as usual for these attributes, so a field customization defined under the `form` key affects both the `new` and `edit` forms, and a field customization defined under the main `field` key affects all forms, including the filter form.

Plain fields
------------

If you want to display some data in a form without allowing the user to edit it, use the `type: plain` attribute, just like in the old days of symfony 1.2. This is very useful for columns managed by the model, like `created_at` and `updated_at` columns:

    [yaml]
    # in modules/book/config/generator.yml
    config:
      edit:
        display:      [title, author_id, created_at, updated_at]
        fields:
          created_at: { type: plain }
          updated_at: { type: plain }

This displays the field in the edit view, but not in a form input. Submitting the form will leave these fields unchanged - or, in the previous example, will let the model take care of their values.
