# PHP REST Client [![Build Status](https://travis-ci.org/sylouuu/php-rest-client.svg)](https://travis-ci.org/sylouuu/php-rest-client) [![GitHub version](https://badge.fury.io/gh/sylouuu%2Fphp-rest-client.svg)](http://badge.fury.io/gh/sylouuu%2Fphp-rest-client) [![devDependency Status](https://david-dm.org/sylouuu/php-rest-client/dev-status.svg?theme=shields.io)](https://david-dm.org/sylouuu/php-rest-client#info=devDependencies)

## Requirements

* PHP >= 5.4
* [cURL](http://php.net/manual/fr/book.curl.php/) library enabled

## Install

### Composer

```js
{
    "require": {
        "sylouuu/php-rest-client": "0.4.*"
    }
}
```

```php
<?php
    require_once 'vendor/sylouuu/php-rest-client/src/RESTClient.php';
?>
```

## Usage

```php
<?php
    $rest_client = new \sylouuu\RESTClient();
?>
```

`HEAD`, `OPTIONS`, `GET`, `POST`, `PUT`, `PATCH` and `DELETE` methods are available. For each, you have to specify the `url` option.

You can specify additional headers with the `headers` option, see examples below.

The `data` option is mandatory for  `POST`, `PUT` and `PATCH` requests.

### GET

```php
<?php
    $request = $rest_client->get([
        'url' => 'http://api.domain.com/'
    ]);

    // Get response
    $json = $request->getResponse();

    // You have access to the HTTP status code
    $status = $request->getStatus();

    // You have access to the HTTP header
    $header = $request->getHeader();

    // You can also pass your headers
    $json = $rest_client->get([
        'url'       => 'http://api.domain.com/',
        'headers'   => [
            'Foo: bar'
        ]
    ])->getResponse();
?>
```

### POST

```php
<?php
    $json = $rest_client->post([
        'url'   => 'http://api.domain.com/',
        'data'  => [
            'name'  => 'Syl',
            'url'   => 'http://sylouuu.github.io/'
        ]
    ])->getResponse();
?>
```

### PUT

```php
<?php
    $json = $rest_client->put([
        'url'   => 'http://api.domain.com/',
        'data'  => [
            'name'  => 'Syl',
            'url'   => 'http://sylouuu.github.io/'
        ]
    ])->getResponse();
?>
```

### DELETE

```php
<?php
    $json = $rest_client->delete([
        'url'   => 'http://api.domain.com/'
    ])->getResponse();
?>
```

### HEAD

```php
<?php
    $json = $rest_client->head([
        'url'   => 'http://api.domain.com/'
    ])->getResponse();
?>
```

### OPTIONS

```php
<?php
    $json = $rest_client->options([
        'url'   => 'http://api.domain.com/'
    ])->getResponse();
?>
```

### SSL

If you need to authenticate requests by a certificate, use the `ssl` option:

```php
<?php
    $request = $rest_client->get([
        'url'   => 'http://api.domain.com/',
        'ssl'   => '/relative/path/to/certificate/file'
    ]);
?>
```

## Tests

On project directory:

* `composer install` to retrieve `phpunit`
* `npm install` to retrieve `gulp` and `gulp-phpunit`
* Type: `gulp` to launch unit tests

## Changelog

2014-05-13 - **0.4.0**

* renamed `RESTClient.class.php` to `RESTClient.php`
* renamed `RESTClient.class.php` to `RESTClient.php`
* moved `RESTClient.php` to `/src`
* moved `RESTClientTest.php` to `/tests`
* added `HEAD`, `OPTIONS` and `PATCH` support
* added `getHeader` method
* renamed `getJSON` to `getResponse`
* removed JSON validation
* added `sylouuu` namespace
* removed `gulp`

2014-05-09 - **0.3.0**

* added `ssl` option

2014-04-06 - **0.2.1**

* added exception if invalid JSON format returned

2014-04-04 - **0.2.0**

* new way to retrieve result
* added HTTP status code

2014-04-01 - **0.1.0**

* refactored class
* removed constructor parameter
* added unit tests

2014-03-24 - **0.0.2**

* added `$api_url` as a constructor parameter

2014-02-05 - **0.0.1**

* Initial release
