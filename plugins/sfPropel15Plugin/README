sfPropel15Plugin
================

Replaces symfony's core Propel plugin by the latest version of Propel, in branch 1.5.

Installation
------------

Install the plugin via the subversion repository:

    > svn co http://svn.symfony-project.com/plugins/sfPropel15Plugin/trunk plugins/sfPropel15Plugin

from the project root directory or by using the command:

    > ./symfony plugin:install sfPropel15Plugin

Right after the installation of the plugin, you should update plugin assets:

    > ./symfony plugin:publish-assets

Disable the core Propel plugin and enable the `sfPropel15Plugin` instead:

    [php]
    class ProjectConfiguration extends sfProjectConfiguration
    {
      public function setup()
      {
        $this->enablePlugins('sfPropel15Plugin');
      }
    }

Change the path of the symfony behaviors in the `config/propel.ini` file of your project:

    [ini]
    propel.behavior.symfony.class                  = plugins.sfPropel15Plugin.lib.behavior.SfPropelBehaviorSymfony
    propel.behavior.symfony_i18n.class             = plugins.sfPropel15Plugin.lib.behavior.SfPropelBehaviorI18n
    propel.behavior.symfony_i18n_translation.class = plugins.sfPropel15Plugin.lib.behavior.SfPropelBehaviorI18nTranslation
    propel.behavior.symfony_behaviors.class        = plugins.sfPropel15Plugin.lib.behavior.SfPropelBehaviorSymfonyBehaviors
    propel.behavior.symfony_timestampable.class    = plugins.sfPropel15Plugin.lib.behavior.SfPropelBehaviorTimestampable

(Re)Build the model:

    > ./symfony propel:build --all-classes

What's New In Propel 1.5
------------------------

Propel 1.5 is a **backwards compatible** evolution of Propel 1.4 (the version bundled with symfony 1.3 and 1.4), which adds some very interesting features. Among these features, you will find the **new Propel Query API**, which is essentially a Criteria on steroids: 

    [php]
    // find the 10 latest books published by authror 'Leo'
    $books = BookQuery::create()
      ->useAuthorQuery()
        ->filterByFirstName('Leo')
      ->endUse()
      ->orderByPublishedAt('desc')
      ->limit(10)
      ->find($con);

Propel 1.5 also supports **many-to-many relationships**, **collections**, **on-demand hydration**, **new core behaviors** (see below), better Oracle support, and is now licensed under the MIT license.

Check out the [WHATS_NEW](http://propel.phpdb.org/trac/wiki/Users/Documentation/1.5/WhatsNew) page in the Propel trac to see the full list of changes.

Core Propel Behaviors
---------------------

Propel 1.5 bundles most common behaviors in a new, robust buildtime implementation. These core behaviors provide faster runtime execution and the ability to modify the data model:

- [timestampable](http://www.propelorm.org/wiki/Documentation/1.5/Behaviors/timestampable)
- [sluggable](http://www.propelorm.org/wiki/Documentation/1.5/Behaviors/sluggable)
- [soft_delete]([http://www.propelorm.org/wiki/Documentation/1.5/Behaviors/soft_delete)
- [nested_set](http://www.propelorm.org/wiki/Documentation/1.5/Behaviors/nested_set)
- [sortable](http://www.propelorm.org/wiki/Documentation/1.5/Behaviors/sortable)
- [concrete_inheritance](http://www.propelorm.org/wiki/Documentation/1.5/Inheritance#ConcreteTableInheritance)
- [query_cache](http://www.propelorm.org/wiki/Documentation/1.5/Behaviors/query_cache)
- [alternative_coding_standards](http://www.propelorm.org/xiki/Documentation/1.5/Behaviors/alternative_coding_standards)
- [auto_add_pk](http://www.propelorm.org/wiki/Documentation/1.5/Behaviors/auto_add_pk)

`sfPropel15Plugin` allows you to register core propel behaviors right from your `schema.yml`. For instance, to create a tree structure from a `Section` model:

    [yaml]
    propel:
      section:
        _attributes: { phpName: Section }
        _propel_behaviors:
          - nested_set
        id: ~
        title: { type: varchar(100), required: true primaryString: true }

**Tip**: Check the [`doc/schema.txt`](http://trac.symfony-project.org/browser/plugins/sfPropel15Plugin/trunk/doc/schema.txt) file in this plugin source code for a complete reference of the YAML schema format.

You can also register a behavior for all your models right in the `propel.ini` configuration file. `sfPropel15Plugin` already enables the `symfony` and `symfony_i18n` behaviors to support symfony's behavior system and model localization features, but you can easily add your owns:

    [ini]
    propel.behavior.default = symfony,symfony_i18n,alternative_coding_standards,auto_add_pk

Admin Generator Extensions
--------------------------

The plugin comes bundled with a new admin generator theme named 'admin15'. This theme is backwards compatible with sfPropelPlugin's admin generator theme, and provides additional features based on the new Propel 1.5 query objects:

### List view enhancements

- **Easy related objects hydration**: You don't need to write custom `doSelectJoinXXX()` methods to hydrate related objects. The `with` setting is much more poxwerful that the previous `peer_method` and `peer_count_method` settings, and much easier to use.
- **Custom query methods**: You can refine the query executed to display the list view by by setting the `query_methods` parameter. This allows to hydrate an additional column wit hno additional query, or to pre-filter the list to hide rows that the user shouldn't see.
- **All columns are sortable**: Virtual columns and foreign key columns are now sortable in the list view. You'll need to set the sort method to use for that, but it's a one-liner. No more lists with column headers that can't be clicked for sorting!
- **Easy links to filtered lists**: A link to a fitlered list view is very easy to write with the new theme. Just add GET parameter, the same way you used to do with the admin generator in symfony 1.2, and it works
- **Links to another admin module**: To make a foreign key column link to the edit view of the related object in another module, you no longer need to create a partial. Just define the `link_module` setting in the foreign key field configuration, and you're good to go:
- **Easy custom filters**: Adding custom filters becomes very easy once you can take advantage of the generated Propel query classes. This allows your, for instance, to setup a full-text search input in two minutes, replacing many text filters by a single one for better usability.

### Filter and Edit forms enhancement

- **YAML widget customization**: The `generator.yml` format was extended to allow widget and validator customization directly in YAML, without the need to edit a form object. You can also safely omit a field from a `display` list in a form definition, without any risk to loose data.
- **Plain text field**: If you want to display some data in a form without allowing the user to edit it, use the `type: plain` attribute, just like in the old days of symfony 1.2. This is very useful for columns managed by the model, like `created_at` and `updated_at` columns.

The new options for the `admin15` generator theme are fully documented, and illustrated by real life examples, in the [`doc/admin_generator.txt`](http://trac.symfony-project.org/browser/plugins/sfPropel15Plugin/trunk/doc/admin_generator.txt) file in this plugin source code.

Form Subframework Modifications
-------------------------------

- **Updated `sfWidgetFormPropelChoice` widget**: The widget now uses the new Query API. You can customize the list of choices more easily by executing custom query methods, using the new `query_methods` option. 
- **Updated Propel validators**: Both the `sfValidatorPropelChoice` and the `sfValidatorPropelUnique` were updated to use the new PropelQuery objects, and to accept a `query_methods` option similar to the one of `sfWidgetFormPropelChoice`.
- **Plain text widget and validator**: This new widget allows a field to be displayed in a form, without letting the use change it.
- **Easy Relation Embed**: Editing related objects together with the main objects (e.g., editing `Comments` in a `Post` form) is a piece of cake. The new `sfFormPropel::embedRelation()` method does all the work to fetch related objects, build the forms for each of them, and embed the related object forms into the main form. Embdeded relation forms allow to **edit**, **add**, and **delete** a related objects with no additional code.

        [php]
        class ArticleForm extends BaseArticleForm
        {
          public function configure()
          {
            $this->embedRelation('Book');
          }
        }

The Propel widgets, validators, and form classes are fully documented in the [`doc/form.txt`](http://trac.symfony-project.org/browser/plugins/sfPropel15Plugin/trunk/doc/form.txt) file in this plugin source code.

Routing Modifications
---------------------

The plugin offer two new routing classes, `sfPropel15Route` and `sfPropel15RouteCollection`. These classes are used by default in the models build with the propel admin generator. They behave just like the previous `sfPropelRoute` class - except they don't use the `methods` option anymore. Instead, use the `query_methods` option to execute a list of arbitrary query methods when calling `getObject()` and `getObjects()`.

    author:
      class: sfPropel15RouteCollection
      options:
        model:                author
        module:               author
        prefix_path:          /author
        column:               id
        query_methods:        
          object: [filterByIsPublished]
          list:   [filterByIsPublished, orderByLastName]
        with_wildcard_routes: true

`sfPropel15Route` also makes your code a little easier to read in the action. Instead of calling `getObject()`, you can actually call a getter using the class name of the object's route:

    [php]
    public function executeShow(sfWebRequest $request)
    {
      // using sfPropel15Route with 'Author' as model
      $this->author = $this->getRoute()->getAuthor();
    }
