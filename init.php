<?php

require_once __DIR__ . '/config/Configuration.php';
include_once __DIR__ . '/vendor/fpdf/fpdf.php';
spl_autoload_register(function ($classname){

    $file = __DIR__ . '/AgriServe/' . $classname . '.php';

    if (file_exists($file)) {
        require_once $file;
    }

});

Session::startSession();
$db = Database::getInstance();

$user = new Authentication();