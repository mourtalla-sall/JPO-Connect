<?php

namespace JPOConnect\Model;

use JPOConnect\Database\Database;

use \PDO;

class jpo{

    private $pdo;

    public function __construct() {
        $db = Database::getInstance();
        $this->pdo = $db->getConnexion();
    }

    private function securityInput($input) {
        return trim(htmlspecialchars($input));
    }

    public function createjpo($nom, $description, $dateDebut, $dateFin, $image ) {
        $data = $this->pdo->prepare('INSERT INTO jpo (nom, description, dateDebut, dateFin, image ) VALUES (:nom, :description, :dateDebut, :dateFin, :image)');
        $data->bindValue(':nom', $this->securityInput($nom), PDO::PARAM_STR);
        $data->bindValue(':description', $this->securityInput($description), PDO::PARAM_STR);
        $data->bindValue(':dateDebut', $this->securityInput($dateDebut), PDO::PARAM_STR);
        $data->bindValue(':dateFin', $this->securityInput($dateFin), PDO::PARAM_STR);
        $data->bindValue(':image', $this->securityInput($image), PDO::PARAM_STR);
   
        return $data->execute();
    }

    public function getAllJpo() {
        $data = $this->pdo->prepare('SELECT * FROM jpo ');
        $data->execute();
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }
    // public function getCategorie() {
    //     $data = $this->pdo->prepare('SELECT * FROM Categorie ');
    //     $data->execute();
    //     return $data->fetchAll(PDO::FETCH_ASSOC);
    // }

    public function getById($id) {
        $data = $this->pdo->prepare('SELECT * FROM jpo WHERE id = :id');
        $data->bindValue(':id', $id, PDO::PARAM_INT);
        $data->execute();
        return $data->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $nom, $description, $dateDebut, $dateFin, $image ) {
        $data = $this->pdo->prepare('UPDATE jpo SET nom=:nom, description=:description, dateDebut=:dateDebut, dateFin=:dateFin, image=:image WHERE id=:id');
        $data->bindValue(':nom', $this->securityInput($nom), PDO::PARAM_STR);
        $data->bindValue(':description', $this->securityInput($description), PDO::PARAM_STR);
        $data->bindValue(':dateDebut', $this->securityInput($dateDebut), PDO::PARAM_STR);
        $data->bindValue(':dateFin', $this->securityInput( $dateFin), PDO::PARAM_INT);
        $data->bindValue(':image', $this->securityInput( $image), PDO::PARAM_INT);
        $data->bindValue(':id', $id,PDO::PARAM_INT);
        return $data->execute();
    }

    public function delete($id) {
        $data = $this->pdo->prepare('DELETE FROM jpo WHERE id = :id');
        $data->bindValue(':id', $id, PDO::PARAM_INT);
        return $data->execute();
    }

    public function count() {
        return $this->pdo->query('SELECT COUNT(*) FROM jpo')->fetchColumn();
    }
}
?>