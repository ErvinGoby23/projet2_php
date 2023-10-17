<?php

require_once __DIR__.'/../database.php';
require_once __DIR__.'/../model/Task.php';
require_once __DIR__.'/../vendor/autoload.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;


function index() {
    
    
    $loader = new FilesystemLoader(__DIR__.'/../template');
    $twig = new Environment($loader);
    echo $twig->render('index.twig');

   
    return;
}




 