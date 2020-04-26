<?php
// load vendor
require_once('vendor/autoload.php');

//class directories
$directories = [
    'util',
    'provider',
    'base',
    'model',
    'repository',
    'service',
    'database',
    'http',
    'controller',
    'routes'
];
//for each directory
function autoload($directories){
    foreach ($directories as $directory) {
        load($directory);
    }
}

function load($directory){
    foreach (glob("$directory/*.php") as $filename) {
        include $filename;
    }

    $subDirectories = glob("$directory/*", GLOB_ONLYDIR);
    if(count($subDirectories) > 0) {
        foreach ($subDirectories as $subDirectory) {
            load($subDirectory);
        }
    }
}
autoload($directories);
