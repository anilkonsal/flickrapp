Flickr Search App
============================

Flickr Search App is a project based on Yii 2(http://www.yiiframework.com/) application best for
rapidly creating small projects.

On the homepage, you will see a button saying 'Search photos on Flickr', 

![Home Page](http://shoposm.com/flickrapp/s1.jpg)


when you click this button, you will be taken to Login page

![Login Page](http://shoposm.com/flickrapp/s2.jpg)


and asked to login. If you do not have a login, there is a Link to Register on site, clicking which you will be taken to registration page

![Signup Page](http://shoposm.com/flickrapp/s3.jpg)


Once you register with valid data, you will be auto logged in and redirected to Search Index page where you can see a search form.

![Search Form Page](http://shoposm.com/flickrapp/s4.jpg)


Input any Keywords in the search test box and click Search button. You will be taken to search result page where the results will
be shown. There is pagination shown below the thumbnails.

![Search Results Page](http://shoposm.com/flickrapp/s5.jpg)


Clicking on a thumbnail, Original image is shown in a new Page.

![Full Photo Page](http://shoposm.com/flickrapp/s6.jpg)


The recent Searches are recorded in System and shown below the search form

![Recent Searches](http://shoposm.com/flickrapp/s7.jpg)


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
