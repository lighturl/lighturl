# lighturl
Open Source Url Shortener

### Requirements
  - PHP 5.6.4+


### Installation

#### Via Composer Install
```sh
$ composer require lighturl/lighturl
```
#### Database Migration
use [Phinx PHP Database Migrations](https://github.com/robmorgan/phinx)

```sh
edit phinx.yml
$ phinx migrate -e <development - production - testing>
```

### Docs

Coming soon

## Quick Start

``` php
require 'vendor/autoload.php';
use Illuminate\Database\Capsule\Manager as Capsule;
use LightUrl\Light;
```

``` php
$capsule = new Capsule;

        $capsule->addConnection([
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'lighturl',
            'username'  => 'root',
            'password'  => '',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]);

        // Make this Capsule instance available globally via static methods... (optional)
        $capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
        $capsule->bootEloquent();

        $connection=$capsule->getConnection();
``` 

``` php
$light = new Light($connection);

$key = $light->lighten($heavyUrl);

echo $key;
```

## Changelog
Details changes for each release are documented in the [release notes](https://github.com/lighturl/lighturl/releases).


License
----

MIT