<?php

define('RTS_CLI_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Register The Composer Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader
| for our application. We just need to utilize it! We'll require it
| into the script here so that we do not have to worry about the
| loading of any our classes "manually". Feels great to relax.
|
*/

$searchDepth = 10;
$thisDir = __DIR__;
$possibleAutoLoaders = array(
    '/vendor/autoload.php',
    '/autoload.php',
);

$autoLoaderPath = "";
$autoLoaderPathFound = false;
foreach ($possibleAutoLoaders as $autoLoader) {
    $depth = 0;
    do {

        $autoLoaderPath = $thisDir . str_repeat('/..', $depth) . $autoLoader;
        $autoLoaderPathFound = file_exists($autoLoaderPath);
        $depth++;

    } while (!$autoLoaderPathFound && $depth <= $searchDepth);

    if ($autoLoaderPathFound) {
        break;
    }
}

if ($autoLoaderPathFound) {
    require_once $autoLoaderPath;
} else {
    echo "Unable to find autoloader! Terminating";
    exit(1);
}

