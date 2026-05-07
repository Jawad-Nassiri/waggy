<?php

spl_autoload_register(function($class) {

    $class = str_replace('\\', '/', $class);

    $file = $class . '.php';

    $locations = [
        '',
        'app/',
        'core/',
        'admin/'
    ];

    foreach ($locations as $location) {
        if (file_exists($location . $file)) {
            require_once $location . $file;
            return;
        }
    }
});
