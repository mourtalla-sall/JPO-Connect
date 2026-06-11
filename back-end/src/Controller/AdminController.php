<?php

namespace JPOConnect\Controller;

use JPOConnect\Model\AdminModel ;

class AdminController {
    private $JpoModel;

    public function __construct() {
        $this->JpoModel = new AdminModel();
    }

    public function createJpo($nom, $description, $dateDebut, $dateFin, $image,  $date) {
        if (empty($nom) || empty($description) || empty($dateDebut) || empty($dateFin) || empty($image) || empty($date)) {
            return json_encode(['status' => 'error', 'message' => 'Tous les champs sont requis']);
        }

        if ($this->JpoModel->createJpo($nom, $description, $dateDebut, $dateFin, $image, $date)) {
            return json_encode(['status' => 'success', 'message' => 'Journée porte ouvert ajouté avec succès']);
        }

        return json_encode(['status' => 'error', 'message' => "Erreur lors de l'enregistrement Journée porte ouvert"]);
    }

    public function getJpo() {
        return json_encode($this->JpoModel->getAllJpo
        ());
    }

    // public function getCategories() {
    //     return $this->JpoModel->getCategorie();
    // }

    public function getById($id) {
        return json_encode($this->JpoModel->getById($id));
    }

    public function updateJpo($id, $nom, $description, $dateDebut, $dateFin, $image, $date) {
        if (empty($nom) || empty($description) || empty($dateDebut) || empty($dateFin) || empty($image) || empty($image)) {
            return json_encode(['status' => 'error', 'message' => 'Tous les champs sont requis']);
        }

        if ($this->JpoModel->updateJpo($id, $nom, $description, $dateDebut, $dateFin, $image, $date )) {
            return json_encode(['status' => 'success', 'message' => 'Journée porte ouvert mis à jour avec succès']);
        }

        return json_encode(['status' => 'error', 'message' => 'Erreur lors de la mise à jour']);
    }

    public function deleteProduit() {
        $this->JpoModel->deleteJpo((int)$_GET['id']);
    }
}