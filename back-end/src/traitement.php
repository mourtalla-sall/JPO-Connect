<?php

use JPOConnect\Controller\AdminController;

header("Access-Control-Allow-Origin: http://localhost:5173");
header('Content-Type: application/json; charset=utf-8');

// Précisez les méthodes de requête autorisées.
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');

// En-têtes supplémentaires pouvant être envoyés avec la requête CORS
header('Access-Control-Allow-Headers: X-Requested-With,Authorization,Content-Type');

require_once(__DIR__ . '/../../back-end/vendor/autoload.php');

// appler le controller 
$newJPO = new AdminController();



if (isset($_GET['id']) && empty($_POST)) {
    echo $newJPO->getById($_GET['id']);
    exit;
}
if (empty($_POST)) {
    // var_dump($newProduit->getProduits());
    echo ($newJPO->getJpo());
    exit;
}



$nom = htmlspecialchars(trim($_POST['name']));
$description = htmlspecialchars(trim($_POST['description']));
$dateDebut = htmlspecialchars(trim($_POST['heureDebut']));
$dateFin = htmlspecialchars(trim($_POST['heureFin']));
$date = htmlspecialchars(trim($_POST['date']));
var_dump($_POST);
// fonction pour ajour un image
if (!isset($_FILES['image'])) {
    echo json_encode(['status' => 'error', 'message' => 'Image manquante']);
    exit;
}
$nomFichier = basename($_FILES['image']['name']);
$destination = __DIR__ . '/../../front-end/public/images/' . $nomFichier;

if (!move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
    echo json_encode(['status' => 'error', 'message' => 'Upload échoué']);
    exit;
}

// UPDATE si id en POST
if (isset($_POST['id']) && !empty($_POST['id'])) {
    $id = (int) $_POST['id'];
    $UpdateJpo = $newJPO->updateJpo($id, $nom, $description, $dateDebut, $dateFin, $nomFichier, $date);
    echo $UpdateJpo;
    exit;
}

//ajouter un JPO 
$AddJpo = $newJPO->createJpo( $nom, $description, $dateDebut, $dateFin, $nomFichier, $date);
echo $AddJpo;
exit;

exit
?>