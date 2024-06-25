<?php
include_once 'config/config.php';

use Slim\Factory\AppFactory;

require 'vendor/autoload.php';
$app = AppFactory::create();



$app->get('/parser', 'App\Http\Controllers\Parser\IndexController:index');
//$app->get('/parser/{id}', 'App\Http\Controllers\Parser\IndexController:show');
$app->post('/parser', 'App\Http\Controllers\Parser\IndexController:store');
//$app->put('/parser/{id}', 'App\Http\Controllers\Parser\IndexController:update');
//$app->delete('/parser/{id}', 'App\Http\Controllers\Parser\IndexController:delete');

$app->run();

