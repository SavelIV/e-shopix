<?php

/**
 * Function for automatically load classes
 */
spl_autoload_register(function ($class_name) {

    // Array of files, that may content needed classes
    $array_paths = array(
        '/models/',
        '/components/',
        '/controllers/',
    );

    foreach ($array_paths as $path) {

        $path = ROOT . $path . $class_name . '.php';

        if (file_exists($path)) {
            include_once $path;
        }
    }
});

