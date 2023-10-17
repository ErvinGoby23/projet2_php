<?php


require_once __DIR__.'/../database.php';
require_once __DIR__.'/../model/Task.php';
require_once __DIR__.'/../vendor/autoload.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;


function list_tasks() {
    global $pdo;
    $tasks = []; 

    $query = $pdo->query("SELECT id, title FROM tasks");
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $task = new Task($row['id'], $row['title']);
        $tasks[] = $task;
    }


    $loader = new FilesystemLoader(__DIR__.'/../template');
    $twig = new Environment($loader);
    echo $twig->render('task_list.twig', ['tasks' => $tasks]);


    return $tasks;
}




 