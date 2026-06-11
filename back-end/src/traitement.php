<?php

use JPOConnect\Controller\UserController;

header("Access-Control-Allow-Origin: http://localhost:5173");
header('Content-Type: application/json charset=utf-8');
// header('Content-Type: application/json charset=utf-8');

// Specify which request methods are allowed
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');

// Additional headers which may be sent along with the CORS request
header('Access-Control-Allow-Headers: X-Requested-With,Authorization,Content-Type');
$user = new UserController();

if(isset($_GET['allUsers'])){
    $result = $user->getUsers();
    echo json_encode($result);
}


if(isset($_GET['signin'])){  
    $signin = json_decode($_POST['signin'], true);
    $result = $user->signin($signin['email'],$signin['password']);
    echo json_encode($result);
}

if(isset($_POST['user'])){
    $userArray = json_decode($_POST['user'], true);
    // ajouter les arguments  
    $result = $user->register($userArray);
    echo json_encode($result);
}



?>