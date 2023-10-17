<?php

require_once __DIR__.'/controller/createTaskController.php';
require_once __DIR__.'/controller/listTasksController.php';
require_once __DIR__.'/controller/updateTaskController.php';
require_once __DIR__.'/controller/deleteTaskController.php';
require_once __DIR__.'/controller/indexTaskController.php';

require_once __DIR__.'/vendor/autoload.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

function route_request() {
    $route = $_SERVER['REQUEST_URI'];
    if ($route === '/liste') {
        list_tasks();
    } elseif ($route === '/create') {
        display_create_task_form();
    } elseif ($route === '/update') {
        update_task();
    }  elseif ($route === '/delete') {
        delete_task();
    } elseif ($route === '/index') {
        index(); 
    } else {
        http_response_code(404);
        echo "<h1>404 NOT FOUND</h1>";
    }
}

route_request();
