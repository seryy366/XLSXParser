<?php
function writeToLog($data, $title = '') {
    $log = "\n------------------------\n";
    $log .= date("Y.m.d G:i:s") . "\n";
    $log .= (strlen($title) > 0 ? $title : 'DEBUG') . "\n";
    $log .= print_r($data, 1);
    $log .= "\n------------------------\n";
    file_put_contents(getcwd() . '/'.date('d-m-Y').'.log', $log,FILE_APPEND);
    return true;
}


/*
 * Autoloader
 * */
spl_autoload_register(function ($class_name) {
    $arPaths = [
        '/api/',
        '/api/classes/',
        '/api/services/',
    ];

    foreach ($arPaths as $path) {
        $path = ROOT . $path . $class_name . '.php';
        if (is_file($path)) {
            include_once $path;
        }
    }
});



