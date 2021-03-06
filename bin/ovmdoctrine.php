<?php

use Symfony\Component\Console\Helper\HelperSet;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

$autoloadFiles = array(__DIR__ . '/../vendor/autoload.php',
    __DIR__ . '/../../../autoload.php');

foreach ($autoloadFiles as $autoloadFile) {
    if (file_exists($autoloadFile)) {
        require_once $autoloadFile;
    }
}

$directories = array(getcwd(), getcwd() . DIRECTORY_SEPARATOR . 'config',
    getcwd() . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'ovm' . DIRECTORY_SEPARATOR   . 'doctrine'
);

$configFile = null;
foreach ($directories as $directory) {
    $configFile = $directory . DIRECTORY_SEPARATOR . 'cli-config.php';

    if (file_exists($configFile)) {
        break;
    }
}

if ( ! file_exists($configFile)) {
    ConsoleRunner::printCliConfigTemplate();
    exit(1);
}

if ( ! is_readable($configFile)) {
    echo 'Configuration file [' . $configFile . '] does not have read permission.' . "\n";
    exit(1);
}

$commands = array();

$helperSet = require $configFile;

if ( ! ($helperSet instanceof HelperSet)) {
    foreach ($GLOBALS as $helperSetCandidate) {
        if ($helperSetCandidate instanceof HelperSet) {
            $helperSet = $helperSetCandidate;
            break;
        }
    }
}

\Doctrine\ORM\Tools\Console\ConsoleRunner::run($helperSet, $commands);