<?php

namespace SudiptoChoudhury\Support\Abstracts;

// use splitbrain\phpcli\CLI as PHPCLI;
use splitbrain\phpcli\PSR3CLI as PHPCLI;
use splitbrain\phpcli\Options;

abstract class AbstractCli extends PHPCLI
{

    // override the default log level
    public static $rootPath = __DIR__;
    protected $versionName = 'Abstract CLI version 0.1.0';
    protected $welcome = 'CLI Tool for API';
    protected $apiProvider = 'API';

    protected $apiServiceDefPath = __DIR__ . 'config/api.json';
    protected $apiService = [];
    protected $config = []; // load from config file
    protected $commandOptions = []; // API options

    protected $configFile = 'cli-api.json';
    protected $log = null;
    protected $env = 'dev';
    protected $simulate = false;
    protected $quiet = false;
    protected $skipDefaults = false;

    protected $logdefault = 'debug';

    protected $CLIOPTIONS = [
        'config' => ['description' => null, 'short' => 'c', 'arg'=> null, 'property' => 'configFile'],
        'log' => ['description' => 'Log file path', 'short' => 'l', 'arg'=> 'command-name.log'],
        'env' => ['description' => 'Environment - dev or production', 'short' => 'e', 'arg'=> 'dev|prod'],
        'simulate' => ['description' => 'Simulate', 'short' => 's'],
        'quiet' => ['description' => 'Quiet Mode', 'short' => 'q'],
        'skip-defaults' => ['description' => 'Skip Configuration Defaults', 'short' => 'd', 'property' => 'skipDefaults'],
    ];

    abstract protected function callApi($command, Options $options);

    // register options and arguments
    protected function setup(Options $options)
    {
        $options->setHelp($this->welcome);
        $this->registerCommands($options);
        $this->registerCommonOptions($options);
        $options->registerOption('version', 'Show Version', 'v');

    }

    // implement your code
    protected function main(Options $options)
    {
        $this->loadOptions($options);
        $command = $options->getCmd();
        if ($command) {
            if ($options->getOpt('man')) {
                echo $options->help($command);
                exit(0);
            }
            return $this->callApi($command, $options);
        }

        if ($options->getOpt('version')) {
            $this->info($this->versionName);
        } else {
            echo $this->welcome();
        }
        return null;
    }

    protected function welcome()
    {
        return $this->welcome . " - " . $this->versionName . "\nUse --help or -h for help.";
    }

    protected function registerCommonOptions(Options $options, $commandName = '')
    {
        $hook = [
            'config' => ['description' => $this->apiProvider . ' Configuration file - default: ' . $this->configFile,
                'arg' => $this->configFile]
        ];

        foreach ($this->CLIOPTIONS as $longName => $config) {
            $description = $config['description'] ?? $hook[$longName]['description'] ?? '';
            $short = $config['short'] ?? $hook[$longName]['short'] ?? '';
            $arg = $config['arg'] ?? $hook[$longName]['arg'] ?? false;

            if ($commandName != '' || empty($config['skipMain'])) {
                // var_dump(['register', $longName, $description, $short, $arg, $commandName]);
                $options->registerOption($longName, $description, $short, $arg, $commandName);
            }
        }
    }

    protected function registerCommands(Options $options)
    {
        $jsonContent = file_get_contents(realpath(static::$rootPath . $this->apiServiceDefPath));
        $this->apiService = json_decode($jsonContent, true) ?? [];

        foreach ($this->apiService['operations'] as $commandName => $operation) {
            if (!preg_match('/^_/', $commandName)) {
                $this->setupCommand($commandName, $operation, $options);
                $options->registerOption('man', "Show help on this command", 'm',
                    false, $commandName);
            }
        }
    }

    protected function setupCommand($commandName, $operation, Options $options)
    {

        $description = $operation['description'] ?? '';
        $options->registerCommand($commandName, $description);

        $this->commandOptions[$commandName] = $parameters = $this->getCommandParams($operation);
        foreach ($parameters as $name => $data) {
            $paramItem = $data['item'] ?? [];
            $desc = $paramItem['description'] ?? $meta[$name]['description'] ?? '';
            $short = $paramItem['short'] ?? $meta[$name]['short'] ?? null;
            $arg = $paramItem['arg'] ?? $meta[$name]['arg'] ?? $data['slug'];
            $options->registerOption($name, $desc, $short, $arg, $commandName);
        }

        // $this->registerCommonOptions($options, $commandName);

    }

    protected function getRequestPayload($commandName, Options $opt)
    {
        $commandOptions = $this->commandOptions[$commandName];
        $options = $this->getPayloadOptions($opt);
        $payload = $this->getRequestPayloadDefaults($commandName, $opt);
        foreach ($options as $key => $val) {
            $path = $commandOptions[$key]['path'];
            $this->arraySetDotted($payload, $path, $val);
        }

        return $payload;
    }

    protected function getPayloadOptions (Options $opt) {
        $options = $opt->getOpt();
        $skips = array_merge(['version', 'no-colors', 'help', 'loglevel', 'man'], array_keys($this->CLIOPTIONS));

        foreach($skips as $skip) {
            if(isset($options[$skip])) {
                unset($options[$skip]);
            }
        }
        return $options;
    }

    protected function getRequestPayloadDefaults($commandName, Options $opt)
    {
        if ($this->skipDefaults) {
            return [];
        }
        $commandOptions = $this->commandOptions[$commandName];
        $firstItem = reset($commandOptions);
        $defaults = $this->config['defaults'] ?? [];

        $data = $firstItem['data'];
        $payload = [] ;// $data;
        foreach ($commandOptions as $key => $item) {

            if (isset($defaults[$key])) {
                $path = $item['path'];
                $this->arraySetDotted($payload, $path, $defaults[$key]);
            }
        }
        return $payload;
    }

    protected function getCommandParams($operation)
    {
        $source = $this->apiService;
        $data = [];
        $meta = $source['meta'] ?? [];
        $operation['properties'] = $operation['parameters'] ?? [];

        list($pathData, $pathItems) = $this->parseParamPath($operation) + [null, null];
        $pathStrings = $this->dottify($pathData);

        foreach ($pathStrings as $pathString => $value) {

            $pathArray = explode('.', $pathString);
            $reversed = array_reverse($pathArray);
            $pathNames = [];
            $pathItem = $this->arrayGetDotted($pathItems, $pathString);
            do {

                $part = array_shift($reversed);
                if ($part == '*') {
                    continue;
                }
                array_unshift($pathNames, $part);
                $pathName = implode('-', $pathNames);
                $slug = $this->slug($pathName);

            } while (!$pathName || (isset($paths[$pathName]) && !empty($reversed)));


            $data[$pathName] = [
                'value' => $value,
                'slug' => $slug,
                'name' => $pathName,
                'data' => $pathData,
                'item' => $pathItem,
                'meta' => $meta[$pathString] ?? [],
                'path' => $pathString,
                //                'array' => $pathArray,
            ];
        }

//        var_dump(compact('data'));
        return $data;
    }

    protected function parseParamPath($item)
    {
        $repo = $this->apiService;

        if ($item['$ref'] ?? false) {
            $item = array_merge($repo['models'][$item['$ref']], $item);
        }
        if ($item['extends'] ?? false) {
            $item += $repo['operations'][$item['extends']];
        }

        if (!empty($item['default']) && !empty($item['static'])) {
            return [];
        }

        $path = [];
        $relativePath = &$path;
        if (($item['type'] ?? '') == 'array') {
            $item = $item['items'];
            $arrayItemName = '*';//.$item['name'];
            $path[$arrayItemName] = [];
            $relativePath = &$path[$arrayItemName];
        }

        if (empty($item['properties'])) {
            $relativePath = $item['default'] ?? '';
            return [$path, $item];
        }

        $nestedItems = [];
        foreach ($item['properties'] as $itemPropName => $subItem) {
            list($nested, $nestedItem) = $this->parseParamPath($subItem) + [null, null];
            if (!is_null($nested)) {
                $nestedItems[$itemPropName] = $nestedItem;
                $relativePath[$itemPropName] = $nested ? : $nestedItem['default'] ?? '';
            }
        }

        return [$path, $nestedItems];
    }

    protected function loadOptions(Options $options)
    {
        $opts = $options->getOpt();
        foreach ($opts as $name => $value) {
            $propertyName = $this->CLIOPTIONS[$name]['property'] ?? $name;
            if (property_exists($this, $propertyName)) {
                $this->$propertyName = $value;
            }

        }

        $configFile = $this->configFile ?? '/cli-api.json';
        $configFile = static::$rootPath . $configFile;

        $configData = file_get_contents(realpath($configFile)) ?? '';
        $config = json_decode($configData, true) ?? null;

        $this->config = $config ?? $this->config;
    }

    protected function arraySetDotted(&$array, $key, $value, $default = null)
    {
        $value = $value ?? $default;

        if (is_null($key)) {
            return $array = $value;
        }

        $keys = explode('.', $key);

        while (count($keys) > 1) {
            $key = array_shift($keys);

            if (!isset($array[$key]) || !is_array($array[$key])) {
                $array[$key] = [];
            }
            $array = &$array[$key];
        }


        $key = array_shift($keys);

        if ($key == '*') {
            if (isset($array['*'])) {
                $array = [];
            }
            $array[] = $value;
        } else {
            $array[$key] = $value;
        }

        return $array;
    }

    protected function arrayGetDotted($array, $key, $default = null) {

        $key = trim(preg_replace(['/(\.)?\*(\.)?/', '/\.{2,}/', '/\*{2,}/'], ['$1$2', '.', '*'], $key), '.*');
        if (empty($key)) {
            return $default;
        }
        $keys = explode('.', $key);
        $value = $default;
        foreach($keys as $pointer) {
            if (!isset($array[$pointer])) {
                return $value;
            }
            $value = $array[$pointer];
            $array = $value;
        }
        return $value;
    }

    protected function dottify($array, $prepend = '')
    {
        $results = [];

        foreach ($array as $key => $value) {
            if (is_array($value) && !empty($value)) {
                $results = array_merge($results, $this->dottify($value, $prepend . $key . '.'));
            } else {
                $results[$prepend . $key] = $value;
            }
        }

        return $results;
    }

    protected function slug($values)
    {
        if (!is_array($values)) {
            $values = [$values];
        }
        $slug = trim(implode('-', $values), '-');
        $slug = preg_replace(['/([A-Z])/', '/\s+/', '/-{2,}/'], [' $1', '-', '-'], $slug);
        $slug = trim(strtolower($slug), '-');
        return $slug;
    }

    protected function configureLog(&$apiConfig, $command, Options $options) {

        $log = $this->log;

        if ($log === 'false') {
            $apiConfig['log'] = $this->log = false;
        } else {
            if ($log === 'true' || is_null($log)) {
                $log = null;
                $this->log = static::$rootPath . "logs/$command.log";
            }
            if (!isset($apiConfig['log']) || !is_null($log)) {
                $apiConfig['log'] = ['file' => $this->log, 'name' => $command];
            }
        }
    }
}