# Eye4web\SiteConfig
[![Build Status](https://travis-ci.org/Eye4web/zf2-site-config.svg)](https://travis-ci.org/Eye4web/zf2-site-config)
[![Code Climate](https://codeclimate.com/github/Eye4web/zf2-site-config/badges/gpa.svg)](https://codeclimate.com/github/Eye4web/zf2-site-config)
[![Test Coverage](https://codeclimate.com/github/Eye4web/zf2-site-config/badges/coverage.svg)](https://codeclimate.com/github/Eye4web/zf2-site-config/coverage)
[![Latest Stable Version](https://poser.pugx.org/eye4web/zf2-site-config/v/stable)](https://packagist.org/packages/eye4web/zf2-site-config)
[![License](https://poser.pugx.org/eye4web/zf2-site-config/license)](https://packagist.org/packages/eye4web/zf2-site-config)
[![Total Downloads](https://poser.pugx.org/eye4web/zf2-site-config/downloads)](https://packagist.org/packages/eye4web/zf2-site-config)

## Introduction
This modules allows you to easily get site config in all of your files. 
The module can, out-of-the-box, read config values from the following:

* DoctrineORM
* Files(supported by `\Zend\Config\Reader`)
    * ini
    * json
    * xml
    * yaml
    * javaproperties
    * php array
    
_Note: This module does not help you write the config, you have to take care of that yourself._

## Installation
1. Add this project composer.json:

    ```json
    "require": {
        "eye4web/zf2-site-config": "dev-master"
    }
    ```

2. Now tell composer to download the module by running the command:

    ```bash
    $ php composer.phar update
    ```

3. Enable it in your `application.config.php` file.

    ```php
    <?php
    return array(
        'modules' => array(
            // ...
            'Eye4web\SiteConfig'
        ),
        // ...
    );
    ```

4. Copy `config/eye4web.siteconfig.global.php.dist` to `config/autoload/eye4web.siteconfig.global.php`

5. Edit the config to fit your needs

## Usage
It is very easy to get config values, anywhere in your files.
### View
To get a config value in a view-file(or layout): `$this->siteConfig($configKey, $default)`
`$default` is optional
### Controller
To get a config value in a controller: `$this->siteConfig($configKey, $default)`
`$default` is optional
### Any file from service-manager
This module comes with an initializer, so to get the `SiteConfigService` into a file, all you have to do is

+ Make your file implement `Eye4web\SiteConfig\Service\SiteConfigAwareInterface`
+ Use the trait `Eye4web\SiteConfig\Service\SiteConfigAwareTrait`

```php
namespace YourModule\Service;

use Eye4web\SiteConfig\Service\SiteConfigAwareTrait;

class YourAwesomeService
{
    use SiteConfigAwareTrait;
}
```

+ Now you can do `$this->getSiteConfigService()->get($configKey, $default)`, `$default` is optional

## Configuration
See `config/eye4web.siteconfig.global.php.dist` for configurable values
### Readers
The modules supports many different readers, by deault it uses `DoctrineORMReader`
#### DoctrineORM
This reader reads config values from your database. This module is setup to use DoctrineORM by default, so all you have to do is  
1. Create schema
    * Use the doctrine script: `php ./vendor/bin/doctrine-module orm:schema-tool:update --force` or
    * Create the table yourself, see `data/sql` folder for schema  
2. Add your config values to the database. You only have to fill `key` and `value`, the rest of the fields are just convenience fields
#### Files
This module uses `Zend\Config` to read config from files. It can read config from the following file types:
* ini
* json
* xml
* yaml
* javaproperties
* php array
To read config from a file, all you have to do is:
1. Create your file and add your config values  
2. Edit `eye4web.siteconfig.global.php` and set the path to your config file  
_You can read config from a single file, but you can also read from multiple files, just use an array of file names instead of a single string_    

#### Create-your-own
It is very easy to create your own reader, just follow these steps: 
1. Create your reader. It must implement `Eye4web\SiteConfig\Reader\ReaderInterface`  
2. Add your reader to the service-manager  
3. Edit `eye4web.siteconfig.global.php` and set the name of your reader  
4. Make a pull-request so others can benefit from your reader ;)  
