<?php
require_once __DIR__.'/../database.php';
require_once __DIR__.'/../model/Task.php';
require_once __DIR__.'/../vendor/autoload.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader(__DIR__.'/../template');
$twig = new Environment($loader);

function delete_task() {
    global $pdo;
    if ($_SERVER['REQUEST_METHOD'] === 'POST' 
        && isset($_POST['task_id']) ){
        $taskId = $_POST['task_id'];
        
        $query = $pdo->prepare("DELETE FROM tasks WHERE id = :task_id");
        $query->bindParam(':task_id', $taskId);

        try {
            $query->execute();
            $loader = new FilesystemLoader(__DIR__.'/../template');
                $twig = new Environment($loader);
                echo $twig->render('task_deleted.twig', ['task_id' => $taskId]);
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
        
    }

}


