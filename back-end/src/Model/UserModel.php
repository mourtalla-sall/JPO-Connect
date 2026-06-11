<?php

namespace JPOConnect\Model;

use JPOConnect\Database\Database;
use PDO;

class UserModel
{
    private $pdo;

    public function __construct()
    {
        $db = Database::getInstance();
        $this->pdo = $db->getConnexion();
    }

    private function securityInput($input)
    {
        return trim(htmlspecialchars($input));
    }

    public function signin($email, $password)
    {
        $data = $this->pdo->prepare(
            'SELECT * FROM user WHERE email = :email'
        );

        $data->bindValue(
            ':email',
            $this->securityInput($email),
            PDO::PARAM_STR
        );

        $data->execute();

        $user = $data->fetch(PDO::FETCH_ASSOC);

        if (!$user || !password_verify($password, $user['password'])) {
            return [
                'success' => false,
                'message' => 'Email ou mot de passe incorrect'
            ];
        }

        return [
            'success' => true,
            'message' => 'Connexion réussie',
            'user' => [
                'id' => $user['id'],
                'firstName' => $user['firstName'],
                'lastName' => $user['lastName'],
                'email' => $user['email'],
                'role' => $user['role']
            ]
        ];
    }

    public function register($firstName, $lastName, $email, $password)
    {
        $check = $this->pdo->prepare(
            'SELECT id FROM user WHERE email = :email'
        );

        $check->bindValue(
            ':email',
            $this->securityInput($email),
            PDO::PARAM_STR
        );

        $check->execute();

        if ($check->fetch()) {
            return false;
        }

        $hash = password_hash($password, PASSWORD_BCRYPT);

        $data = $this->pdo->prepare(
            'INSERT INTO user
            (firstName, lastName, email, password, role)
            VALUES
            (:firstName, :lastName, :email, :password, :role)'
        );

        $data->bindValue(
            ':firstName',
            $this->securityInput($firstName),
            PDO::PARAM_STR
        );

        $data->bindValue(
            ':lastName',
            $this->securityInput($lastName),
            PDO::PARAM_STR
        );

        $data->bindValue(
            ':email',
            strtolower($this->securityInput($email)),
            PDO::PARAM_STR
        );

        $data->bindValue(
            ':password',
            $hash,
            PDO::PARAM_STR
        );

        $data->bindValue(
            ':role',
            'visiteur',
            PDO::PARAM_STR
        );

        return $data->execute();
    }

    public function getUsers()
    {
        $data = $this->pdo->prepare(
            'SELECT id, firstName, lastName, email, role
            FROM user'
        );

        $data->execute();

        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $data = $this->pdo->prepare(
            'SELECT * FROM user WHERE id = :id'
        );

        $data->bindValue(':id', $id, PDO::PARAM_INT);

        $data->execute();

        return $data->fetch(PDO::FETCH_ASSOC);
    }

    public function delete($id)
    {
        $data = $this->pdo->prepare(
            'DELETE FROM user WHERE id = :id'
        );

        $data->bindValue(':id', $id, PDO::PARAM_INT);

        return $data->execute();
    }
}