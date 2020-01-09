# php-ready-theatre-systems

PHP API Client for Ready Theatre Systems, LLC – Open Interface API


```php

use SudiptoChoudhury\Rts\Api;

$rts = new Api([
    'theatre' => '<<theatre number>>'
    'username' => '<<password>>',
    'password' => '<<password>>',
]);


$result = $rts->getShowTime(['ShowSales' => 1, 'ShowAvalTickets' => 1, 'ShowSaleLinks' => 1]); 

$result = $rts->checkIfSoldOut([
    'Data' => [
        "Packet" => [
            'PerformanceID' => '018129000023'
        ]
    ]
]);

$result = $rts->getGiftCardInformation([
    'Data' => [
        "Packet" => [
            'GiftCards' => [
                'GiftCard' => '1234510813486422'
            ]
        ]
    ]

]);
 
 
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

All you need to do is to pass theatre id, username and password to the constructor. 
```php

use SudiptoChoudhury\Rts\Api;

new Api([
    'theatre' => '<<theatre number>>'
    'username' => '<<password>>',
    'password' => '<<password>>'
]);
```

Additionally, you can set a logger via `log` property.

- You can set log to `false` to disable logging.
- You can also pass an array with `file` and `path` properties.

```php

use SudiptoChoudhury\Rts\Api;

new Api([
    'theatre' => '<<theatre number>>'
    'username' => '<<password>>',
    'password' => '<<password>>',
    'log' => ['file' => 'rts.log', 'path' => '/your/log/path']
]);
```
- You can also pass a `Monolog\Logger` instance.

```php

use SudiptoChoudhury\Rts\Api;

new Api([
    'theatre' => '<<theatre number>>'
    'username' => '<<password>>',
    'password' => '<<password>>',
    'log' => ['logger' => $monologInstance]
]);
```

You can use `client` property to forward to `GuzzleHttp\Client` constructor. 

```php

use SudiptoChoudhury\Rts\Api;

new Api([
    'theatre' => '<<theatre number>>'
    'username' => '<<password>>',
    'password' => '<<password>>',
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
 

## How to use

Next, call the desired method from the table given below. In most methods you may need to pass parameters. The parameters
are to be passed as an associative array. 

Examples:
```php
$rts = new Api([
    'theatre' => '<<theatre number>>'
    'username' => '<<password>>',
    'password' => '<<password>>',
]);


$result = $rts->getShowTime(['ShowSales' => 1, 'ShowAvalTickets' => 1, 'ShowSaleLinks' => 1]); 

$result = $rts->checkIfSoldOut([
    'Data' => [
        "Packet" => [
            'PerformanceID' => '018129000023'
        ]
    ]
]);

$result = $rts->getGiftCardInformation([
    'Data' => [
        "Packet" => [
            'GiftCards' => [
                'GiftCard' => '1234510813486422'
            ]
        ]
    ]

]);
 
```


### Available API Methods

| Method & Command | Parameters | Description |
|-------------------|------------|-------------|
| `getShowTimes(array)`<br/> \[POST\] ShowTimeXml | `ShowAvalTickets` `ShowSales` `ShowSaleLinks` | Get all Performance Schedule | 
| `getGiftCardInformation(array)`<br/> \[POST\] GiftInformation |  |  |
| `getGiftCardInformationWithPin(array)`<br/> \[POST\] GiftInformationWithPIN |  |  |
| `buyGiftCard(array)`<br/> \[POST\] Buy |  |  |
| `refillGiftCard(array)`<br/> \[POST\] Buy |  |  |
| `registerLoyaltyCard(array)`<br/> \[POST\] GIFTINFORMATION |  |  |
| `checkIfSoldOut(array)`<br/> \[POST\] CheckSoldOut |  |  |
| `hasRedeemed(array)`<br/> \[POST\] CheckRedeem |  |  |
| `verifyTransaction(array)`<br/> \[POST\] VERIFYTRANSACTION |  |  |
| `getTransactionDetails(array)`<br/> \[POST\] TRANSACTIONDETAILS |  |  |
| `refund(array)`<br/> \[POST\] Refund |  |  |
| `reverse(array)`<br/> \[POST\] ReverseTransaction |  |  |
| `payUsingHostedCheckout(array)`<br/> \[POST\] CreatePayment |  |  |
| `buyTicket(array)`<br/> \[POST\] CreatePayment |  |  |
| `getAllSeatLayouts(array)`<br/> \[POST\] GetSeatLayouts |  |  |
| `getSeatLayout(array)`<br/> \[POST\] GETSEATPLANFORPERF |  |  |
| `checkPickedSeat(array)`<br/> \[POST\] CHECKSEATPICKS |  |  |
| `getSeatChart(array)`<br/> \[POST\] SeatChart |  |  |
| `holdSeats(array)`<br/> \[POST\] HoldSeats |  |  |
| `releaseSeats(array)`<br/> \[POST\] HoldSeats |  |  |
| `checkSalesTaxOnConcessionSales(array)`<br/> \[POST\] Buy |  |  |
| `buyConcessionItems(array)`<br/> \[POST\] Buy |  |  |
