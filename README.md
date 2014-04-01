# PHP REST Client

[![Build Status](https://travis-ci.org/sylouuu/php-rest-client.png)](https://travis-ci.org/sylouuu/php-rest-client)

## PHP requirements

* PHP >= 5.4
* cURL enabled

## Install

### Composer

* Add RESTClient to your ```composer.json``` file: ```composer require sylouuu/php-rest-client```
* Include ```RESTClient```: ```require_once 'vendor/autoload.php';```

### Manually

* [Download](https://github.com/sylouuu/php-rest-client/releases) the latest release.
* Include ```RESTClient```: ```require_once 'path/to/RESTClient.class.php';```

## Usage

```php
<?php
    $rest_client = new RESTClient();
?>
```

```GET```, ```POST```, ```PUT``` and ```DELETE``` methods are available. For each, you have to specify the ```url``` option.

You can specify additional headers with the ```headers``` option, see examples below.

The ```data``` option is mandatory for  ```POST``` and ```PUT``` requests.

### GET

```php
<?php
    $json = $rest_client->get([
        'url' => 'http://api.domain.com/'
    ]);

    // With header
    $json = $rest_client->get([
        'url'       => 'http://api.domain.com/',
        'headers'   => [
            'Foo: bar'
        ]
    ]);
?>
```

### POST

```php
<?php
    $json = $rest_client->post([
        'url'   => 'http://api.domain.com/',
        'data'  => [
            'name'  => 'Syl',
            'url'   => 'http://chez-syl.fr/'
        ]
    ]);
?>
```

### PUT

```php
<?php
    $json = $rest_client->put([
        'url'   => 'http://api.domain.com/',
        'data'  => [
            'name'  => 'Syl',
            'url'   => 'http://chez-syl.fr/'
        ]
    ]);
?>
```

### DELETE

```php
<?php
    $json = $rest_client->delete([
        'url'   => 'http://api.domain.com/'
    ]);
?>
```

## Tests

On project directory:

* ```npm update``` to retrieve ```gulp```
* Type: ```gulp```

## Changelog

2014-04-01 - **0.1.0**

* refactored class
* removed constructor parameter
* added unit tests

2014-03-24 - **0.0.2**

* added ```$api_url``` as a constructor parameter

2014-02-05 - **0.0.1**

* Initial release
