# php-ready-theatre-systems-sql-api

PHP API Client for Ready Theatre Systems, LLC – SQL API


```php

use SudiptoChoudhury\Rts\SqlApi as Api;

$rts = new Api([
    'theatre' => '<<theatre number>>'
    'data_password' => '<<password>>'
]);


$result = $rts->query('Select * From CustomerInfo.customer'); 

$result = $rts->query('Select * From CustomerInfo.customer', ['asString' => true]);

$result = $rts->query('Select * From CustomerInfo.customer', ['asXML' => true]);

$result = $rts->query('Select * From CustomerInfo.customer', ['asRawArray' => true]);


 
```

## Installation


### Requirements

- Any flavour of PHP 7.1+ should do


### Install With Composer

You can install the library via [Composer](http://getcomposer.org) by adding the following line to the 
**require** block of your *composer.json* file (replace dev-master with latest stable version):

```
"sudiptochoudhury/php-ready-theatre-systems": "dev-master"
```

or run the following command:

```
composer require sudiptochoudhury/php-ready-theatre-systems
```


## Setting up

All you need to do is to pass theatre id, data_password to the constructor. 
```php

use SudiptoChoudhury\Rts\Api;

new Api([
    'theatre' => '<<theatre number>>',
    'data_password' => '<<password>>'
]);
```

Additionally, you can set a logger via `log` property.

- You can set `log` to `false` to disable logging.
- You can also pass an array with `file` and `path` properties.


```php

use SudiptoChoudhury\Rts\Api;

new Api([
    'theatre' => '<<theatre number>>',
    'data_password' => '<<password>>',
    'log' => ['file' => 'rts.log', 'path' => '/your/log/path']
]);
```
- You can also pass a `Monolog\Logger` instance as `['logger' => $instance ]`;

```php

use SudiptoChoudhury\Rts\Api;

new Api([
    'theatre' => '<<theatre number>>',
    'data_password' => '<<password>>',
    'log' => ['logger' => $monologInstance]
]);
```

You can use `client` property to forward to `GuzzleHttp\Client` constructor.

```php

use SudiptoChoudhury\Rts\Api;

new Api([
    'theatre' => '<<theatre number>>',
    'data_password' => '<<password>>',
    'client' => ['timeout' => 5]
]);
```

 If you wish to tap into request and response handler stacks use `settings` instead of using `client`'s `handlers` property.

```php 
'settings' => [
    'responseHandler' => function (ResponseInterface $response) {
        // do something
        return $response;
    },
    'requestHandler' => function (RequestInterface $request) {
        // some action
        return $request;
    },
],
```
 


### Available API Methods

| Method & Command Name | Options | Description |
|-------------------|------------|-------------|
| `query(query:string, options:Array)`<br/> \[POST\] DATATRANSFER | `asXML` `asString`, `asRawArray` | Run SQL query (readonly). Returns an associative array. options (array) argument can have  `asString` to return result as string (XML as string; `asXML` to return result as SimpleXML object;  `asRawArray` to return result as array as converted from SimpleXML object. | 