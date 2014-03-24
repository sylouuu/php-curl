## PHP requirements

* PHP >= 5.4
* cURL enabled

## Usage

```php
<?php
    /**
    * Including library
    */
    include('path/to/RESTClient.class.php');

    /**
    * Instanciating
    */
    $rest_client = new RESTClient('http://api.domain.com/');
?>
```

### GET

```php
<?php
    /**
    * Querying server (GET)
    */
    $json = $rest_client->get('users/1');
?>
```

### POST

```php
<?php
    $data = [
        'name' => 'Syl',
        'url' => 'http://chez-syl.fr/'
    ];

    /**
    * Querying server (POST)
    */
    $json = $rest_client->post('users', $data);
?>
```

### PUT

```php
<?php
    $data = [
        'name' => 'Syl',
        'url' => 'http://chez-syl.fr/'
    ];

    /**
    * Querying server (PUT)
    */
    $json = $rest_client->put('users/1', $data);
?>
```

### DELETE

```php
<?php
    /**
    * Querying server (DELETE)
    */
    $json = $rest_client->delete('users/1');
?>
```

## Changelog

2014-03-24 - **0.0.2**

* added $api_url as a constructor parameter

2014-02-05 - **0.0.1**

* Initial release
