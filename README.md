# PHP cURL [![Build Status](https://travis-ci.org/sylouuu/php-curl.svg)](https://travis-ci.org/sylouuu/php-curl) [![GitHub version](https://badge.fury.io/gh/sylouuu%2Fphp-curl.svg)](http://badge.fury.io/gh/sylouuu%2Fphp-curl)

## Requirements

* PHP >= 5.4
* [cURL](http://php.net/manual/fr/book.curl.php/) library enabled

## Install

### Composer

```js
{
    "require": {
        "sylouuu/php-curl": "0.5.*"
    }
}
```

```php
require_once './vendor/autoload.php';
```

## Usage

```php
// Create a request
$request = new \sylouuu\Curl\Get(['url' => 'http://domain.com']);

// Send this request
$request->send();

// Show the response
echo $request->getResponse();
```

### Constructor options

```php
[
    'url' => 'http://domain.com',   // The resource to call (mandatory)
    'data' => [                     // Data to send, available for `Post` `Put` and `Patch` (mandatory)
        'foo' => 'bar'
    ],
    'headers' => [                  // Additional headers (optional)
        'Authorization: foobar'  
    ],
    'ssl' => '/path/to/cacert.ext', // Use it for SSL (optional)
    'autoclose' => true/false       // Is the request must be automatically closed (optional)
]
```

### Public methods

```php
// Send a request
$request->send();

// HTTP status code
$request->getStatus();

// HTTP header
$request->getHeader();

// HTTP body response
$request->getResponse();

// Used cURL options
$request->getCurlOptions();

// Set a cURL option
$request->setCurlOptions(CURLOPT_*);

//----------------------------------------

// Set `autoclose` option to `false`
$request = new \sylouuu\Curl\Get([
    'url' => 'http://domain.com'
    'autoclose' => false
]);

// Now you can retrieve a cURL info
$request->getCurlInfo(CURLINFO_SOMETHING);

// Manually close the handle
$request->close();
```

As `Get`, here are the HTTP supported verbs: `Head`, `Options`, `Post`, `Put`, `Patch` and `Delete`.

## Tests

On project directory:

* `composer install` to retrieve `phpunit`
* Type: `phpunit` to run tests

## Changelog

2014-05-20 - **0.5.0** (BC break)

* renamed repository from `php-rest-client` to `php-curl`
* refactored all code
* added `autoclose` option
* added the way to get/set cURL options
* added the way to get cURL info
* sources are now psr-2 compliant

2014-05-13 - **0.4.0** (BC break)

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
