Flickr Search App
============================

Flickr Search App is a project based on Yii 2(http://www.yiiframework.com/) application best for
rapidly creating small projects.

The project contains the basic features including user login/logout and a contact page.
It includes all commonly used configurations that would allow you to focus on adding new
features to your application.


DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources



REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 5.4.0.




CONFIGURATION
-------------

### Database

Create the database named flickrapp on your system and Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=flickrapp',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```

You can then access the application through the following URL:

~~~
http://localhost/flickrapp/web/
~~~

TESTS
------

Tests are written using Codeception in this project.