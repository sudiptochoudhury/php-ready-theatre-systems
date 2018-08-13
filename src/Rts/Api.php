<?php

namespace SudiptoChoudhury\Rts;

use SudiptoChoudhury\Support\Forge\Api\Client as ApiForge;

/**
 * Class Api
 *
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