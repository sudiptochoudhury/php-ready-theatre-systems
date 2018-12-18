<?php

namespace SudiptoChoudhury\Rts;

use SudiptoChoudhury\Support\Forge\Api\Client as ApiForge;

/**
 * Class Api
 *
 * @method	array	getShowTimes(array $parameters)
 * @method	array	getGiftCardInformation(array $parameters)
 * @method	array	buyGiftCard(array $parameters)
 * @method	array	refillGiftCard(array $parameters)
 * @method	array	registerLoyaltyCard(array $parameters)
 * @method	array	checkIfSoldOut(array $parameters)
 * @method	array	hasRedeemed(array $parameters)
 * @method	array	verifyTransaction(array $parameters)
 * @method	array	refund(array $parameters)
 * @method	array	reverse(array $parameters)
 * @method	array	payUsingHostedCheckout(array $parameters)
 * @method	array	buyTicket(array $parameters)
 * @method	array	getAllSeatLayouts(array $parameters)
 * @method	array	getSeatLayout(array $parameters)
 * @method	array	checkPickedSeat(array $parameters)
 * @method	array	getSeatChart(array $parameters)
 * @method	array	holdSeats(array $parameters)
 * @method	array	releaseSeats(array $parameters)
 * @method	array	checkSalesTaxOnConcessionSales(array $parameters)
 * @method	array	buyConcessionItems(array $parameters)
 * @method	array	_getGiftCardInformation(array $parameters)
 *
 * @inheritdoc
 *
 * @package SudiptoChoudhury\Rts
 */
class Api extends ApiForge
{

    protected $DEFAULT_API_JSON_PATH = './config/rts.json';
    protected $theatre = 5;
    protected $loggerFile = __DIR__ . '/rts-api-calls.log';

    protected $DEFAULTS = [
        'username' => 'test',
        'password' => 'test',
        'theatre' => '5',
        'client' => [
            'base_uri' => 'https://{{theatre}}.formovietickets.com:2235/Data.ASP',
            'decode_content' => 'gzip',
            'auth' => [
                '{{username}}', '{{password}}',
            ],
            'verify' => false,
            'headers' => [
                'Accept-Encoding' => 'gzip',
                'Content-Type' => 'application/xml',
            ],
        ],
        'settings' => [
            'responseHandler' => null,
            'requestHandler' => null,
        ],
        'log' => false

    ];
//
//    protected function requestHandler($request)
//    {
//        $content = (string)$request->getBody();
//        var_dump($content);
//        return $request;
//    }
//
//    protected function responseHandler($response)
//    {
//        $content = (string)$response->getBody();
//        var_dump($content);
//        return $response;
//    }

}