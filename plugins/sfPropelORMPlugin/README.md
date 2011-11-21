sfPropelORMPlugin
=================

Replaces symfony's core Propel plugin by the latest version of Propel, in branch 1.6.

## Installation

### The Git way

Clone the plugin from Github:

    git clone git://github.com/propelorm/sfPropelORMPlugin.git plugins/sfPropelORMPlugin
    cd plugins/sfPropelORMPlugin
    git submodule update --init

If you use Git as a VCS for your project, it should be better to add the plugin as a submodule:

    git submodule add git://github.com/propelorm/sfPropelORMPlugin.git plugins/sfPropelORMPlugin
    git submodule update --init --recursive

As both Phing and Propel libraries are bundled with the plugin, you have to initialize submodules for the plugin.

### The SVN way

Install the plugin via the subversion repository:

    svn checkout http://svn.github.com/propelorm/sfPropelORMPlugin.git plugins/sfPropelORMPlugin

Install `Phing` and `Propel`:

    svn checkout http://phing.mirror.svn.symfony-project.com/tags/2.3.3/classes/phing lib/vendor/phing
    svn checkout http://svn.github.com/propelorm/Propel.git lib/vendor/propel

### Final step

Disable the core Propel plugin and enable the `sfPropelORMPlugin` instead:

``` php
// config/ProjectConfiguration.class.php

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    // If you're following the SVN way, uncomment the next two lines
    //sfConfig::set('sf_phing_path', sfConfig::get('sf_root_dir').'/lib/vendor/phing');
    //sfConfig::set('sf_propel_path', sfConfig::get('sf_root_dir').'/lib/vendor/propel');

    $this->enablePlugins('sfPropelORMPlugin');
  }
}
```

**Optional:** update references to the `propel` and `phing` folders in the test project.

``` php
// plugins/sfPropelORMPlugin/test/functional/fixtures/config/ProjectConfiguration.class.php

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    $this->enablePlugins(array('sfPropelORMPlugin'));
    $this->setPluginPath('sfPropelORMPlugin', realpath(dirname(__FILE__) . '/../../../..'));

    // SVN way
    //sfConfig::set('sf_propel_path', SF_DIR.'/../lib/vendor/propel');
    //sfConfig::set('sf_phing_path', SF_DIR.'/../lib/vendor/phing');

    // Git way
    sfConfig::set('sf_propel_path', realpath(dirname(__FILE__) . '/../../../../lib/vendor/propel'));
    sfConfig::set('sf_phing_path', realpath(dirname(__FILE__) . '/../../../../lib/vendor/phing'));
  }
```

Right after the installation of the plugin, you should update plugin assets:

    php symfony plugin:publish-assets

Change the path of the symfony behaviors in the `config/propel.ini` file of your project:

``` ini
// config/propel.ini

propel.behavior.symfony.class                  = plugins.sfPropelORMPlugin.lib.behavior.SfPropelBehaviorSymfony
propel.behavior.symfony_i18n.class             = plugins.sfPropelORMPlugin.lib.behavior.SfPropelBehaviorI18n
propel.behavior.symfony_i18n_translation.class = plugins.sfPropelORMPlugin.lib.behavior.SfPropelBehaviorI18nTranslation
propel.behavior.symfony_behaviors.class        = plugins.sfPropelORMPlugin.lib.behavior.SfPropelBehaviorSymfonyBehaviors
propel.behavior.symfony_timestampable.class    = plugins.sfPropelORMPlugin.lib.behavior.SfPropelBehaviorTimestampable
```

(Re)Build the model:

    php symfony propel:build --all-classes


## What's New In Propel 1.6

Propel 1.6 is a **backwards compatible** evolution of Propel 1.4 (the version bundled with symfony 1.3 and 1.4), which adds some very interesting features. Among these features, you will find the **new Propel Query API**, which is essentially a Criteria on steroids:

``` php
// find the 10 latest books published by authror 'Leo'
$books = BookQuery::create()
    ->useAuthorQuery()
    ->filterByFirstName('Leo')
    ->endUse()
    ->orderByPublishedAt('desc')
    ->limit(10)
    ->find($con);
```

Propel 1.6 also supports **many-to-many relationships**, **collections**, **on-demand hydration**, **new core behaviors** (see below), better Oracle support, and is now licensed under the MIT license.


## Core Propel Behaviors

Propel 1.6 bundles most common behaviors in a new, robust buildtime implementation. These core behaviors provide faster runtime execution and the ability to modify the data model:

- [timestampable](http://www.propelorm.org/wiki/Documentation/1.6/Behaviors/timestampable)
- [sluggable](http://www.propelorm.org/wiki/Documentation/1.6/Behaviors/sluggable)
- [soft_delete]([http://www.propelorm.org/wiki/Documentation/1.6/Behaviors/soft_delete)
- [nested_set](http://www.propelorm.org/wiki/Documentation/1.6/Behaviors/nested_set)
- [sortable](http://www.propelorm.org/wiki/Documentation/1.6/Behaviors/sortable)
- [concrete_inheritance](http://www.propelorm.org/wiki/Documentation/1.6/Inheritance#ConcreteTableInheritance)
- [query_cache](http://www.propelorm.org/wiki/Documentation/1.6/Behaviors/query_cache)
- [alternative_coding_standards](http://www.propelorm.org/wiki/Documentation/1.6/Behaviors/alternative_coding_standards)
- [auto_add_pk](http://www.propelorm.org/wiki/Documentation/1.6/Behaviors/auto_add_pk)

`sfPropelORMPlugin` allows you to register core propel behaviors right from your `schema.yml`. For instance, to create a tree structure from a `Section` model:

``` yaml
propel:
    section:
    _attributes: { phpName: Section }
    _propel_behaviors:
        - nested_set
    id: ~
    title: { type: varchar(100), required: true primaryString: true }
```

**Tip**: Check the [`doc/schema.md`](https://raw.github.com/propelorm/sfPropelORMPlugin/master/doc/schema.md) file in this plugin source code for a complete reference of the YAML schema format.

You can also register a behavior for all your models right in the `propel.ini` configuration file. `sfPropelORMPlugin` already enables the `symfony` and `symfony_i18n` behaviors to support symfony's behavior system and model localization features, but you can easily add your owns:

``` ini
propel.behavior.default = symfony,symfony_i18n,alternative_coding_standards,auto_add_pk
```

## Admin Generator Extensions

The plugin comes bundled with a new admin generator theme named 'admin15'. This theme is backwards compatible with sfPropelPlugin's admin generator theme, and provides additional features based on the new Propel 1.6 query objects:

### List view enhancements

- **Easy related objects hydration**: You don't need to write custom `doSelectJoinXXX()` methods to hydrate related objects. The `with` setting is much more poxwerful that the previous `peer_method` and `peer_count_method` settings, and much easier to use.
- **Custom query methods**: You can refine the query executed to display the list view by by setting the `query_methods` parameter. This allows to hydrate an additional column wit hno additional query, or to pre-filter the list to hide rows that the user shouldn't see.
- **All columns are sortable**: Virtual columns and foreign key columns are now sortable in the list view. You'll need to set the sort method to use for that, but it's a one-liner. No more lists with column headers that can't be clicked for sorting!
- **Easy links to filtered lists**: A link to a fitlered list view is very easy to write with the new theme. Just add GET parameter, the same way you used to do with the admin generator in symfony 1.2, and it works
- **Links to another admin module**: To make a foreign key column link to the edit view of the related object in another module, you no longer need to create a partial. Just define the `link_module` setting in the foreign key field configuration, and you're good to go:
- **Easy custom filters**: Adding custom filters becomes very easy once you can take advantage of the generated Propel query classes. This allows your, for instance, to setup a full-text search input in two minutes, replacing many text filters by a single one for better usability.
- **Automatic sortable links**: If a module is generated on a model with sortable behavior, actions for moving records up and down are automatically added.

### Filter and Edit forms enhancement

- **YAML widget customization**: The `generator.yml` format was extended to allow widget and validator customization directly in YAML, without the need to edit a form object. You can also safely omit a field from a `display` list in a form definition, without any risk to loose data.
- **Plain text field**: If you want to display some data in a form without allowing the user to edit it, use the `type: plain` attribute, just like in the old days of symfony 1.2. This is very useful for columns managed by the model, like `created_at` and `updated_at` columns.

The new options for the `admin15` generator theme are fully documented, and illustrated by real life examples, in the [`doc/admin_generator.md`](https://raw.github.com/propelorm/sfPropelORMPlugin/master/doc/admin_generator.md) file in this plugin source code.

## Form Subframework Modifications

- **Updated `sfWidgetFormPropelChoice` widget**: The widget now uses the new Query API. You can customize the list of choices more easily by executing custom query methods, using the new `query_methods` option.
- **Updated Propel validators**: Both the `sfValidatorPropelChoice` and the `sfValidatorPropelUnique` were updated to use the new PropelQuery objects, and to accept a `query_methods` option similar to the one of `sfWidgetFormPropelChoice`.
- **Plain text widget and validator**: This new widget allows a field to be displayed in a form, without letting the use change it.
- **Easy Relation Embed**: Editing related objects together with the main objects (e.g., editing `Comments` in a `Post` form) is a piece of cake. The new `sfFormPropel::embedRelation()` method does all the work to fetch related objects, build the forms for each of them, and embed the related object forms into the main form. Embdeded relation forms allow to **edit**, **add**, and **delete** a related objects with no additional code.

``` php
class ArticleForm extends BaseArticleForm
{
  public function configure()
  {
    $this->embedRelation('Book');
  }
}
```

The Propel widgets, validators, and form classes are fully documented in the [`doc/form.md`](https://raw.github.com/propelorm/sfPropelORMPlugin/master/doc/form.md) file in this plugin source code.

## Routing Modifications

The plugin offer two new routing classes, `sfPropelORMRoute` and `sfPropelORMRouteCollection`. These classes are used by default in the models build with the propel admin generator. They behave just like the previous `sfPropelRoute` class - except they don't use the `methods` option anymore. Instead, use the `query_methods` option to execute a list of arbitrary query methods when calling `getObject()` and `getObjects()`.

``` yaml
author:
    class: sfPropelORMRouteCollection
    options:
    model:                author
    module:               author
    prefix_path:          /author
    column:               id
    query_methods:
        object: [filterByIsPublished]
        list:   [filterByIsPublished, orderByLastName]
    with_wildcard_routes: true
```

Array of additional parameters are also possible for `query_methods`:

``` yaml
author:
    class: sfPropelORMRouteCollection
    options:
    model:                author
    module:               author
    prefix_path:          /author
    column:               id
    query_methods:
        object:
        filterByIsPublished: [false]
        list:
        filterByIsPublished: []
        orderBy:             [LastName]
    with_wildcard_routes: true
```

`sfPropelORMRoute` also makes your code a little easier to read in the action. Instead of calling `getObject()`, you can actually call a getter using the class name of the object's route:

``` php
public function executeShow(sfWebRequest $request)
{
    // using sfPropelORMRoute with 'Author' as model
    $this->author = $this->getRoute()->getAuthor();
}
```
