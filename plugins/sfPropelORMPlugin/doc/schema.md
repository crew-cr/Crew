YAML Schema Reference
=====================

Attributes
----------

Connections and tables can have specific attributes, set under an `_attributes` key:

    [yml]
    propel:
      # connection attributes
      _attributes:   { noXsd: false, defaultIdMethod: none, package: lib.model }

      blog_article:
        # table attributes
        _attributes: { phpName: Article }

You may want your schema to be validated before code generation takes place. To do that, deactivate the `noXSD` attribute for the connection. The connection also supports the `defaultIdMethod` attribute. If none is provided, then the database's native method of generating IDs will be used--for example, `autoincrement` for MySQL, or `sequences` for PostgreSQL. The other possible value is `none`.

The `package` attribute is like a namespace; it determines the path where the generated classes are stored. It defaults to `lib/model/`, but you can change it to organize your model in subpackages. For instance, if you don't want to mix the core business classes and the classes defining a database-stored statistics engine in the same directory, then define two schemas with `lib.model.business` and `lib.model.stats` packages.

The `phpName` table attribute is used to set the name of the generated class mapping the table.

Tables that contain localized content (that is, several versions of the content, in a related table, for internationalization) also take two additional attributes (see symfony's i18n documentation for details), as shown in the next listing:

    [yml]
    propel:
      blog_article:
        _attributes: { isI18N: true, i18nTable: db_group_i18n }

Dealing with multiple Schemas
-----------------------------

You can have more than one schema per application. Symfony will take into account every file ending with `schema.yml` or `schema.xml` in the `config/` folder. If your application has many tables, or if some tables don't share the same connection, you will find this approach very useful.

Consider these two schemas:

     [yml]
     // In config/business-schema.yml
     propel:
       blog_article:
         _attributes: { phpName: Article }
         id:
         title: varchar(50)

     // In config/stats-schema.yml
     propel:
       stats_hit:
         _attributes: { phpName: Hit }
         id:
         resource: varchar(100)
         created_at:

Both schemas share the same connection (`propel`), and the `Article` and `Hit` classes will be generated under the same `lib/model/` directory. Everything happens as if you had written only one schema.

You can also have different schemas use different connections (for instance, `propel` and `propel_bis`, to be defined in `databases.yml`) and organize the generated classes in subdirectories:

     [yml]
     // In config/business-schema.yml
     propel:
       blog_article:
         _attributes: { phpName: Article, package: lib.model.business }
         id:
         title: varchar(50)

     // In config/stats-schema.yml
     propel_bis:
       stats_hit:
         _attributes: { phpName: Hit, package: lib.model.stat }
         id:
         resource: varchar(100)
         created_at:

Many applications use more than one schema. In particular, some plug-ins have their own schema and package to avoid messing with your own classes.

Column Details
--------------

A table contains columns. The column details can contain three types of definition:

- a simple type definition
- a complete definition
- an empty definition, to let Propel guess the correct settings

You can mix columns with all three types of definitions in a single table.

### Simple Type

If you define only one attribute, it is the column type. Symfony understands the usual column types: `boolean`, `integer`, `float`, `date`, `varchar(size)`, `longvarchar` (converted, for instance, to `text` in MySQL), and so on. For text content over 256 characters, you need to use the `longvarchar` type, which has no size (but cannot exceed 65KB in MySQL).

     [yml]
     // In config/schema.yml
     propel:
       user:
         login:     varchar(50)
         password:  varchar(50)
         age:       integer
         dob:       bu_date

### Complete Column Definition

If you need to define more column attributes than just the type (like default value, required, and so on), you should write the column attributes as a set of `key: value` pairs. For instance:

    [yml]
    propel:
      blog_article:
        id:       { type: integer, required: true, primaryKey: true, autoIncrement: true }
        name:     { type: varchar(50), default: foobar, index: true }
        group_id: { type: integer, foreignTable: db_group, foreignReference: id, onDelete: cascade }

The common column parameters are as follows:

  * `type`: Column type. The choices are `boolean`, `tinyint`, `smallint`, `integer`, `bigint`, `double`, `float`, `real`, `decimal`, `char`, `varchar(size)`, `longvarchar`, `date`, `time`, `timestamp`, `bu_date`, `bu_timestamp`, `blob`, and `clob`.
  * `default`: Default value.
  * `required`: Boolean. Set it to `true` if you want the column to be required.
  * `size`: The size or length of the field for types that support it
  * `scale`: Number of decimal places for use with decimal data type (size must also be specified)
  * `index`: Boolean. Set it to `true` if you want a simple index or to `unique` if you want a unique index to be created on the column.
  * `isCulture`: Boolean. Set it to `true` for culture columns in localized content tables (see i18n section).

Primary key columns accept additional parameters:

  * `primaryKey`: Boolean. Set it to `true` for primary keys.
  * `autoIncrement`: Boolean. Set it to `true` for columns of type `integer` that need to take an auto-incremented value.
  * `sequence`: Sequence name for databases using sequences for `autoIncrement` columns (for example, PostgreSQL and Oracle).

Foreign key columns accept additional parameters:

  * `foreignTable`: A table name, used to create a foreign key to another table.
  * `foreignReference`: The name of the related column if a foreign key is defined via `foreignTable`.
  * `onDelete`: Determines the action to trigger when a record in a related table is deleted. When set to `setnull`, the foreign key column is set to `null`. When set to `cascade`, the record is deleted. If the database engine doesn't support the set behavior, the ORM emulates it.
  * `fkPhpName`: Name of the related object seen from the current object. Propel uses this name to generate filters and accessors (see the 'Relation Names' section below)
  * `fkRefPhpName`: Name of the current object seen from the related object.
  * `fkSkipSql`: Set to true for virtual foreign keys, not translated into SQL

### Empty Column Definition

If you define nothing (`~` in YAML is equivalent to `null` in PHP), symfony will guess the best attributes according to the column name and a few conventions.

    [yml]
    propel:
      blog_read:
        id:         ~
        blog_id:    ~
        created_at: ~
        updated_at: ~

    # symfony fills the blanks using the following rules
    propel:
      blog_read:
        # Empty columns named id are considered primary keys
        id:         { type: integer, required: true, primaryKey: true, autoIncrement: true }
        # Empty columns named XXX_id are considered foreign keys
        blog_id:    { type: integer, foreignTable: blog, foreignReference: id }
        # Empty columns named created_at, updated at, created_on and updated_on
        # are considered dates and automatically take the timestamp type
        created_at: { type: timestamp }
        updated_at: { type: timestamp }

For foreign keys, symfony will look for a table having the same `phpName` as the beginning of the column name, and if one is found, it will take this table name as the `foreignTable`.

Foreign Keys
------------

As an alternative to the `foreignTable` and `foreignReference` column attributes, you can add foreign keys under the `_foreignKeys:` key in a table. The schema in the next listing creates a foreign key on the `user_id` column, matching the `id` column in the `blog_user` table.

    [yml]
    propel:
      blog_article:
        id:      ~
        title:   varchar(50)
        user_id: { type: integer }
        _foreignKeys:
          -
            foreignTable: blog_user
            onDelete:     cascade
            references:
              - { local: user_id, foreign: id }

The alternative syntax is useful for multiple-reference foreign keys and to give foreign keys a name:

    [yml]
        _foreignKeys:
          my_foreign_key:
            foreignTable:  db_user
            onDelete:      cascade
            references:
              - { local: user_id, foreign: id }
              - { local: post_id, foreign: id }

Indexes
-------

As an alternative to the `index` column attribute, you can add indexes under the `_indexes:` key in a table. If you want to define unique indexes, you must use the `_uniques:` header instead. For columns that require a size, because they are text columns, the size of the index is specified the same way as the length of the column using parentheses.

    [yml]
    propel:
      blog_article:
        id:               ~
        title:            varchar(50)
        created_at:
        _indexes:
          my_index:       [title(10), user_id]
        _uniques:
          my_other_index: [created_at]

The alternative syntax is useful only for indexes built on more than one column.

Many-to-Many relationships
--------------------------

Cross-reference tables, used for many-to-many relationships, must declare with an `isCrossRef` attribute set to `true`:

    [yml]
    propel:
      blog_article:
        # columns definition

      blog_author:
        # columns definition

      blog_article_author:
        _attributes: { phpName: ArticleAuthor, isCrossRef: true }
        article_id:  { type: integer, foreignTable: blog_article, foreignReference: id, onDelete: cascade }
        author_id:   { type: integer, foreignTable: blog_author, foreignReference: id, onDelete: cascade }

Declaring a table as a cross reference table leads Propel to generate more methods in the Model and Query classes, including:

    [php]
    Article::getAuthors()
    Article::countAuthors()
    ArticleQuery::filterByAuthor($author)
    Author::getArticles()
    Author::countArticles()
    AuthorQuery::filterByArticle($article)

I18n Tables
-----------

Symfony supports content internationalization in related tables. This means that when you have content subject to internationalization, it is stored in two separate tables: one with the invariable columns and another with the internationalized columns.

In a `schema.yml` file, all that logic is implied when you name a table `foobar_i18n`. For instance, the following schema is automatically completed with columns and table attributes to make the internationalized content mechanism work:

    [yml]
    propel:
      db_group:
        id:          ~
        created_at:  ~

      db_group_i18n:
        name:        varchar(50)

The resulting schema is:

    [yml]
    propel:
      db_group:
        _attributes: { isI18N: true, i18nTable: db_group_i18n }
        id:         ~
        created_at: ~

      db_group_i18n:
        id:       { type: integer, required: true, primaryKey: true,foreignTable: db_group, foreignReference: id, onDelete: cascade }
        culture:  { isCulture: true, type: varchar(7), required: true,primaryKey: true }
        name:     varchar(50)

Note that you can use the second syntax to be able to see the columns in your YAML configuration file.

Propel Behaviors
----------------

Enable native Propel behaviors in your tables by setting the `_propel_behaviors` key. For instance, to turn on `soft_delete` on an `Article` table, write the following schema:

    [yaml]
    propel:
      article:
        _attributes: { phpName: Article }
        id:          ~
        title:       varchar(150)
        body:        longvarchar
        _propel_behaviors:
          soft_delete:

Here is the list of Propel core behaviors available in this plugin:

- [timestampable](http://www.propelorm.org/wiki/Documentation/1.5/Behaviors/timestampable): Keep track of the creation and modification date of each record.
- [sluggable](http://www.propelorm.org/wiki/Documentation/1.5/Behaviors/sluggable): Each row gets a unique slug that you can use to make smart URIs
- [soft_delete]([http://www.propelorm.org/wiki/Documentation/1.5/Behaviors/soft_delete): Keep the deleted rows hidden, so that you can recover them.
- [nested_set](http://www.propelorm.org/wiki/Documentation/1.5/Behaviors/nested_set): Handle hierarchichal data with ease; the nested sets algorithm needs only one query to parse a tree in any way.
- [sortable](http://www.propelorm.org/wiki/Documentation/1.5/Behaviors/sortable): Give rows in a table the ability to be moved up and down of a list, and to retrieve sorted results.
- [concrete_inheritance](http://www.propelorm.org/wiki/Documentation/1.5/Inheritance#ConcreteTableInheritance): Copy the structure of a model class to another; also copy the data back to the parent class, for efficient queries.
- [query_cache](http://www.propelorm.org/wiki/Documentation/1.5/Behaviors/query_cache): Speed up often used queries by skipping the query analysis process. Propel will still query the database for results, only faster.
- [alternative_coding_standards](http://www.propelorm.org/xiki/Documentation/1.5/Behaviors/alternative_coding_standards): Use symfony's coding standards in Propel's generated classes.
- [auto_add_pk](http://www.propelorm.org/wiki/Documentation/1.5/Behaviors/auto_add_pk): Classes that don't have a primary key get one.

You can register more than one behavior and set the parameters of each behaviors:

    [yaml]
    propel:
      article:
        _attributes: { phpName: Article }
        id:          ~
        title:       varchar(150)
        body:        longvarchar
        deleted_on:  timestamp
        _propel_behaviors:
          soft_delete: { deleted_column: deleted_on }
          sluggable:
          timestampable:

You can also register a behavior for all your models right in the `propel.ini`. `sfPropelORMPlugin` already enables the `symfony` and `symfony_i18n` behaviors to support symfony's behavior system and model localization features, but you can easily add your owns:

    [ini]
    propel.behavior.default = symfony,symfony_i18n,alternative_coding_standards,auto_add_pk

**Tip**: Beware not to mix up native propel behaviors, documented in the Propel core, with symfony behaviors for Propel. Native propel behaviors are faster and more powerful, because they are executed at buildtime and not at runtime. Symfony behaviors for Propel, that usually require an additional plugin, are registered under the `_behaviors` key.

Single Table Inheritance
------------------------

To enable single table inheritance in a table, define a type column, and add the `_inheritance` key, as follows:

    [yaml]
    propel:
      person:
        _attributes: { phpName: Person }
        id:          ~
        name:        varchar(100)
        type:        varchar(20)
        _inheritance:
          column:    type
          classes:
            type_1:  Employee
            type_2:  Manager

The keys used in the `classes` hash define the value given to the inheritance column in the database, while the value determine the actual class names.

Such a schema will generate both a Model and a Query class for `Employee` and `Manager`, in addition to the ones generated for `Person`:

    model/
      Person.php
      PersonPeer.php
      PersonQuery.php
      Employee.php
      EmployeeQuery.php
      Manager.php
      ManagerQuery.php

A `PersonQuery` returns mixed results, of class `Person`, `Employee`, and `Manager`, while a `ManagerQuery` returns only objects of class `Manager`:

    [php]
    $person = new Person();
    $person->setName('John');
    $person->save();
    $manager = new Manager();
    $manager->setName('Jack');
    $manager->save();
    echo PersonQuery::create()->count();  // 2
    echo ManagerQuery::create()->count(); // 1

Relation Names
--------------

When you define a foreign key, Propel creates a relationship. Both the objects involved in the relationship see it with a different name. By default, the relation name is the phpName of the related object. For instance, for a `user_id` foreign key in a `book` table:

    [yaml]
    propel:
      user:
        _attributes: { phpName: User }
        id:          ~
        first_name:  varchar(100)
        last_name:   varchar(100)
      book:
        _attributes: { phpName: Book }
        id:          ~
        title:       varchar(150)
        body:        longvarchar
        user_id:     { type: integer, foreignTable: user, foreignReference: id, onDelete: cascade }

Here, Propel creates a `User` relation on the `Book` object, and a `Book` relation on the `User` object. These relations are used to forge the foreign object getters and setters in the Model object, as well as the foreign object filters in the Query object:

    [php]
    $user = $book->getUser();
    $user = UserQuery::create()
      ->filterByBook($book)
      ->findOne();
    $books = $user->getBooks();
    $books = BookQuery::create()
      ->filterByUser($user)
      ->find();

You may want to customize the relation names to qualify the relationship. In the previous example, when related to an `Article`, a `User` would better be called an `Author`. Symmetrically, from the `User` point of view, a `Book` should be named a `Work`. Use the `fkPhpName` and `fkRefPhpName` column attributes to choose custom relation names:

    [yaml]
    propel:
      article:
        _attributes: { phpName: Article }
        id:          ~
        title:       varchar(150)
        body:        longvarchar
        user_id:     { fkPhpName: Author, fkRefPhpName: Work, type: integer, foreignTable: user, foreignReference: id, onDelete: cascade }

Now the generated code looks like this:

    [php]
    $user = $book->getAuthor();
    $user = UserQuery::create()
      ->filterByWork($book)
      ->findOne();
    $books = $user->getWorks();
    $books = BookQuery::create()
      ->filterByAuthor($user)
      ->find();

The ability to name both sides of a relationship becomes very handy when you have to deal with several foreign keys to the same table.

Custom BaseObject
-----------------

By default, the generated Model objects extend BaseObject. You can customize this parent class on a per table basis by overriding the `baseClass` attribute:

    [yaml]
    propel:
      person:
        _attributes: { phpName: Person, baseClass: myBaseObject }
        id:          ~
        name:        varchar(100)
        type:        varchar(20)

A `build-model` will then produce:

    [php]
    class Person extends BasePerson
    abstract class BasePerson extends myBaseObject
