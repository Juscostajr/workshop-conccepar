<?php

use Jusce\WorkshopConccepar\TodoController;
use Slim\Factory\AppFactory;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$app->get('/', function(Request $request, Response $response){
    $response->getBody()->write('Hello World');
    return $response;
});

$app->get('/about',[TodoController::class, 'about']);
$app->post('/todo',[TodoController::class, 'addItem']);
$app->get('/todo',[TodoController::class, 'findAll']);
$app->patch('/todo/edit/{index}',[TodoController::class, 'editItem']);
$app->patch('/todo/check/{index}',[TodoController::class, 'checkItem']);
$app->run();