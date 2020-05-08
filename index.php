<?php
require_once 'vendor/autoload.php';
require_once 'routes/web.php';
$action = $_SERVER['REQUEST_URI'];
Config\Routes\Route::dispatch($action);
