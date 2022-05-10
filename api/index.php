<?php

define('ROOT', dirname(__FILE__));



require_once(ROOT.'/config/app.php');

$api = new Api();
$api->init();