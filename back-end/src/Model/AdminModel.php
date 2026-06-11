<?php

namespace JPOConnect\Model;

use JPOConnect\Database\Database;

use \PDO;

class AdminModel{

    private $pdo;

    public function __construct() {
        $db = Database::getInstance();
        $this->pdo = $db->getConnexion();
    }

    private function securityInput($input) {
        return trim(htmlspecialchars($input));
    }

    public function createJpo($name, $description, $heureDebut, $heureFin, $image, $date ) {
        $data = $this->pdo->prepare('INSERT INTO jpo (name, description, heureDebut, heureFin, image, date ) VALUES (:name, :description, :heureDebut, :heureFin, :image, :date)');
        $data->bindValue(':name', $this->securityInput($name), PDO::PARAM_STR);
        $data->bindValue(':description', $this->securityInput($description), PDO::PARAM_STR);
        $data->bindValue(':heureDebut', $this->securityInput($heureDebut), PDO::PARAM_STR);
        $data->bindValue(':heureFin', $this->securityInput($heureFin), PDO::PARAM_STR);
        $data->bindValue(':image', $this->securityInput($image), PDO::PARAM_STR);
         $data->bindValue(':date', $this->securityInput( $date), PDO::PARAM_STR);
   
        return $data->execute();
    }
    // public function createCommentaire($name, $description, $heureDebut, $heureFin, $image ) {
    //     $data = $this->pdo->prepare('INSERT INTO jpo (name, description, heureDebut, heureFin, image ) VALUES (:name, :description, :heureDebut, :heureFin, :image)');
    //     $data->bindValue(':name', $this->securityInput($name), PDO::PARAM_STR);
    //     $data->bindValue(':description', $this->securityInput($description), PDO::PARAM_STR);
    //     $data->bindValue(':heureDebut', $this->securityInput($heureDebut), PDO::PARAM_STR);
    //     $data->bindValue(':heureFin', $this->securityInput($heureFin), PDO::PARAM_STR);
    //     $data->bindValue(':image', $this->securityInput($image), PDO::PARAM_STR);

   
    //     return $data->execute();
    // }

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

    public function updateJpo($id, $name, $description, $heureDebut, $heureFin, $image, $date ) {
        $data = $this->pdo->prepare('UPDATE jpo SET name=:name, description=:description, heureDebut=:heureDebut, heureFin=:heureFin, image=:image date=:date WHERE id=:id');
        $data->bindValue(':name', $this->securityInput($name), PDO::PARAM_STR);
        $data->bindValue(':description', $this->securityInput($description), PDO::PARAM_STR);
        $data->bindValue(':heureDebut', $this->securityInput($heureDebut), PDO::PARAM_STR);
        $data->bindValue(':heureFin', $this->securityInput( $heureFin), PDO::PARAM_INT);
        $data->bindValue(':image', $this->securityInput( $image), PDO::PARAM_INT);
        $data->bindValue(':date', $this->securityInput( $date), PDO::PARAM_INT);
        $data->bindValue(':id', $id,PDO::PARAM_INT);
        return $data->execute();
    }
    // public function updateCommentaire($id, $name, $description, $heureDebut, $heureFin, $image ) {
    //     $data = $this->pdo->prepare('UPDATE jpo SET name=:name, description=:description, heureDebut=:heureDebut, heureFin=:heureFin, image=:image WHERE id=:id');
    //     $data->bindValue(':name', $this->securityInput($name), PDO::PARAM_STR);
    //     $data->bindValue(':description', $this->securityInput($description), PDO::PARAM_STR);
    //     $data->bindValue(':heureDebut', $this->securityInput($heureDebut), PDO::PARAM_STR);
    //     $data->bindValue(':heureFin', $this->securityInput( $heureFin), PDO::PARAM_INT);
    //     $data->bindValue(':image', $this->securityInput( $image), PDO::PARAM_INT);
    //     $data->bindValue(':id', $id,PDO::PARAM_INT);
    //     return $data->execute();
    // }

    public function deleteJpo($id) {
        $data = $this->pdo->prepare('DELETE FROM jpo WHERE id = :id');
        $data->bindValue(':id', $id, PDO::PARAM_INT);
        return $data->execute();
    }
    public function deleteCommentaire($id) {
        $data = $this->pdo->prepare('DELETE FROM commentaire WHERE id = :id');
        $data->bindValue(':id', $id, PDO::PARAM_INT);
        return $data->execute();
    }

    public function countJpo() {
        return $this->pdo->query('SELECT COUNT(*) FROM jpo')->fetchColumn();
    }
    public function countCommentaire() {
        return $this->pdo->query('SELECT COUNT(*) FROM commentaire')->fetchColumn();
    }
}
?>