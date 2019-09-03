<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE');
header('Content-Type: application/json');

ini_set('display_errors', 1);
error_reporting(E_ALL);


define("ROOT", dirname(__FILE__));
require_once(ROOT . '/components/Router.php');
include_once ROOT . '/components/DB.php';
$router = new Router();
$router->run();