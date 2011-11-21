YAML Databases Reference
========================

Master-Slave Configuration
--------------------------

MySQL Master-Slave support is native in Propel 1.5 so all you have to do in
Symfony is to specify slave servers for each connection in config/databases.yml as such:

    [yml]
    all:
      propel:
        class:        sfPropelDatabase
        param:
          classname:  PropelPDO
          dsn:        mysql:dbname=test;host=mysql-master
          username:   root
          password:

          encoding:   utf8
          persistent: true
          pooling:    true

          slaves:
            connection:
              mysql-slave-01:
                dsn:        mysql:dbname=test;host=mysql-slave-01
                username:   root
                password:
              mysql-slave-02:
                dsn:        mysql:dbname=test;host=mysql-slave-02
                username:   root
                password:

The slave connections will be with the same settings (encoding, persustent, pooling, etc) as
the master connection to ensure the same behavior for all.

- [Master-Slave](http://www.propelorm.org/wiki/Documentation/1.5/Master-Slave): Please read more details on Master-Slave in Propel 1.5
