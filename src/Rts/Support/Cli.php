<?php

namespace SudiptoChoudhury\Rts\Support;

use SudiptoChoudhury\Support\Abstracts\AbstractCli;
use splitbrain\phpcli\Options;

use SudiptoChoudhury\Rts\Api;

class Cli extends AbstractCli
{

    public static $rootPath = __DIR__;
    protected $versionName = 'v1.0.0';
    protected $welcome = 'RTS API CLI tool';
    protected $apiProvider = 'RTS';

    protected $apiServiceDefPath = 'src/Rts/config/rts.json';
    protected $apiService = [];
    protected $config = [];
    protected $commandOptions = []; // API options


    protected $configFile = 'rts.json';
    protected $log = null;
    protected $env = 'dev';
    protected $simulate = false;
    protected $quiet = false;
    protected $skipDefaults = false;
    protected $logdefault = 'debug';

    public function requestHandler($request)
    {
        if (!$this->quiet) {
            $content = (string)$request->getBody();
            $this->debug("\n\nREQUEST: \n$content\n\n");
        }
        return $request;
    }

    public function responseHandler($response)
    {
        if (!$this->quiet) {
            $content = (string)$response->getBody();
            $this->debug("\n\nRESPONSE: \n$content\n\n");
        }
        return $response;
    }

    public function logResult($result)
    {
        if (!$this->quiet) {
            if ($result['code'] ?? -1 == -1) {
                $this->success($result);
            }
            else {
                $this->error($result);
            }
        }
    }

    protected function callApi($command, Options $options)
    {
        $apiConfig = $this->config;
        $this->configureLog($apiConfig, $command, $options);

        $apiConfig['settings'] = $apiConfig['settings'] ?? [];
        $apiConfig['settings']['requestHandler'] = [$this, 'requestHandler'];
        $apiConfig['settings']['responseHandler'] = [$this, 'responseHandler'];

        $api = new Api($apiConfig);
        $payload = $this->getRequestPayload($command, $options);

        $data = $api->$command($payload);

        $this->logResult($data);

        return $data;
    }

    protected function getRequestPayloadDefaults($commandName, Options $opt) {

        $payload = parent::getRequestPayloadDefaults($commandName, $opt);

        $commandOptions = $this->commandOptions[$commandName];

        $orgDefaults = $this->config['defaults'] ?? [];
        $selectedDefaults = [$orgDefaults['cc'], $orgDefaults['customer']];
        $options = $this->getPayloadOptions($opt);

        if (empty($payload)) {
            $payload = [];//$data;
        }
        foreach($selectedDefaults as $defaults) {
            foreach ($defaults as $key => $val) {

                if (isset($commandOptions[$key])) {
                    $path = $commandOptions[$key]['path'];
                    $this->arraySetDotted($payload, $path, $val);
                }
            }
        }
        return $payload;

    }

/*    protected function setup(Options $options)
    {
        parent::setup($options);
    }

    protected function registerCommands(Options $options)
    {
        parent::registerCommands($options);
    }

    protected function main(Options $options)
    {
        $result = parent::main($options);
    }

    protected function loadOptions(Options $options) {
        return parent::loadOptions($options);
    }

*/

}