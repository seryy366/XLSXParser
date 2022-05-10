<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);

ini_set('display_errors',1);
error_reporting(E_ALL);

require '../vendor/autoload.php';
require_once('helpers.php');
require_once('db.php');