<?php

require_once __DIR__ . '/../vendor/autoload.php';

date_default_timezone_set('Europe/Paris');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');

$router = new Bramus\Router\Router();

$router->options('.*', function () {
    http_response_code(200);
});

// Main
$router->get('/', 'Mvc\Controllers\PageController@home');

// Tasks
$router->post('/tasks/', 'Mvc\Controllers\TaskController@create');
$router->get('/tasks/', 'Mvc\Controllers\TaskController@each');
$router->get('/tasks/(\d+)', 'Mvc\Controllers\TaskController@readById');
$router->put('/tasks/(\d+)', 'Mvc\Controllers\TaskController@update');
$router->delete('/tasks/(\d+)', 'Mvc\Controllers\TaskController@delete');

// Steps
$router->post('/tasks/(\d+)/steps/', 'Mvc\Controllers\StepController@create');
$router->get('/tasks/steps/', 'Mvc\Controllers\StepController@each');
$router->get('/tasks/(\d+)/steps/', 'Mvc\Controllers\StepController@eachFromTask');
$router->put('/tasks/(\d+)/steps/(\d+)', 'Mvc\Controllers\StepController@update');
$router->delete('/tasks/(\d+)/steps/(\d+)', 'Mvc\Controllers\StepController@delete');

$router->run();