<?php

// Root path for inclusion.
define('INC_ROOT', dirname(__DIR__));

require_once('database.php'); 

spl_autoload_register(function ($classname) {
    if (file_exists(__DIR__ . '/'. $classname . '.php')) {
        require_once($classname . '.php'); 
    }
    if (file_exists(__DIR__ . '/core/' . $classname . '.php')) {
        require_once('core/' . $classname . '.php');
    }
    if (file_exists(__DIR__ . '/controllers/' . $classname . '.php')) {
        require_once('controllers/' . $classname . '.php');
    }
});

// Root URL 
define('URL',
    'http://'.$_SERVER['HTTP_HOST'].
    str_replace(
        $_SERVER['DOCUMENT_ROOT'],
        '',
        str_replace('\\', '/', INC_ROOT).'/public'
    )
);

// Root path for assets
define('ASSET_ROOT',
    'http://'.$_SERVER['HTTP_HOST'].
    str_replace(
        $_SERVER['DOCUMENT_ROOT'],
        '',
        str_replace('\\', '/', INC_ROOT).'/public'
    )
);
