<?php


require_once __DIR__.'/../database.php';
require_once __DIR__.'/../model/Task.php';
require_once __DIR__.'/../vendor/autoload.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

function display_create_task_form() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    global $pdo;

        if (isset($_POST['title'])) {
            $title = $_POST['title'];
            
            $query = $pdo->prepare("INSERT INTO tasks (title) VALUES (:title)");
            $query->bindParam(':title', $title);

            try {
                $query->execute();
                $loader = new FilesystemLoader(__DIR__.'/../template');
                $twig = new Environment($loader);
                echo $twig->render('task_created.twig', ['title' => $title]);
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            echo "Le champ 'title' n'est pas défini dans les données POST.";
        }
    }else{
        $loader = new FilesystemLoader(__DIR__.'/../template');
        $twig = new Environment($loader);
        echo $twig->render('create_task_form.twig', ['title' => $title]);
    
    }   

}
