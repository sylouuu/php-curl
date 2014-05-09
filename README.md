# PHP REST Client

[![devDependency Status](https://david-dm.org/sylouuu/php-rest-client/dev-status.svg?theme=shields.io)](https://david-dm.org/sylouuu/php-rest-client#info=devDependencies)
[![Build Status](https://travis-ci.org/sylouuu/php-rest-client.png)](https://travis-ci.org/sylouuu/php-rest-client)
[![Latest Stable Version](https://poser.pugx.org/sylouuu/php-rest-client/v/stable.png)](https://packagist.org/packages/sylouuu/php-rest-client)
[![License](https://poser.pugx.org/sylouuu/php-rest-client/license.png)](https://packagist.org/packages/sylouuu/php-rest-client)

## Requirements

* PHP >= 5.4
* [cURL](http://php.net/manual/fr/book.curl.php/) library enabled

## Install

### Composer

```js
{
    "require": {
        "sylouuu/php-rest-client": "0.2.*"
    }
}
```

Include `RESTClient`: `require_once 'vendor/autoload.php';`

### Manually

[Download](https://github.com/sylouuu/php-rest-client/releases) the latest release and include `RESTClient`: `require_once 'path/to/RESTClient.class.php';`

## Usage

```php
<?php
    $rest_client = new RESTClient();
?>
```

`GET`, `POST`, `PUT` and `DELETE` methods are available. For each, you have to specify the `url` option.

You can specify additional headers with the `headers` option, see examples below.

The `data` option is mandatory for  `POST` and `PUT` requests.

### GET

```php
<?php
    $request = $rest_client->get([
        'url' => 'http://api.domain.com/'
    ]);

    // Get JSON result
    $json = $request->getJSON();

    // You have access to the HTTP status code
    $status = $request->getStatus();

    // With header
    $json = $rest_client->get([
        'url'       => 'http://api.domain.com/',
        'headers'   => [
            'Foo: bar'
        ]
    ])->getJSON();
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
    ])->getJSON();
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
    ])->getJSON();
?>
```

### DELETE

```php
<?php
    $json = $rest_client->delete([
        'url'   => 'http://api.domain.com/'
    ])->getJSON();
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

Available for `get`, `post`, `put` and `delete`.

## Tests

On project directory:

* `composer install` to retrieve `phpunit`
* `npm install` to retrieve `gulp` and `gulp-phpunit`
* Type: `gulp` to launch unit tests

## Changelog

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
