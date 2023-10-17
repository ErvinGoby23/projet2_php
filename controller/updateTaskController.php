<?php

require_once __DIR__.'/../database.php';
require_once __DIR__.'/../model/Task.php';
require_once __DIR__.'/../vendor/autoload.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;


function update_task() {
    global $pdo;
    if ($_SERVER['REQUEST_METHOD'] === 'POST' 
        && isset($_POST['task_id'])
        && isset($_POST['new_title'])) {

        $taskId = $_POST['task_id'];
        $newTitle = $_POST['new_title'];

        $query = $pdo->prepare("UPDATE tasks SET title = :title WHERE id = :task_id");
        $query->bindParam(':task_id', $taskId);
        $query->bindParam(':title', $newTitle);

        try {
            $query->execute();
            $loader = new FilesystemLoader(__DIR__.'/../template');
                $twig = new Environment($loader);
            echo $twig->render('task_updated.twig', ['task_id' => $taskId]);
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
        
    }

}

