<?php

namespace JPOConnect\Controller;

use JPOConnect\Model\UserModel;

class UserController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function signin(){
        $input = json_decode(file_get_contents('php://input'), true);

        if (empty($input['email']) || empty($input['password'])) {
            return json_encode([
                'status' => 'error','message' => 'Email et mot de passe requis'
            ]);
        }

        $result = $this->userModel->signin(
            trim($input['email']),
            trim($input['password'])
        );

        if ($result['success']) {
            return json_encode([
                'status' => 'success','message' => 'Connexion réussie','user' => $result['user']
            ]);
        }

        return json_encode([
            'status' => 'error','message' => $result['message']
        ]);
    }

    public function register()
    {
        if (!isset($_POST['user'])) {
            return json_encode([
                'status' => 'error','message' => 'Données manquantes'
            ]);
        }

        $data = json_decode($_POST['user'], true);

        if (!is_array($data)) {
            return json_encode([
                'status' => 'error','message' => 'Format JSON invalide'
            ]);
        }

        if (
            empty($firstName['nom']) ||
            empty($lastName['prenom']) ||
            empty($email['email']) ||
            empty($password['password'])
        ) {
            return json_encode([
                'status' => 'error','message' => 'Tous les champs sont requis'
            ]);
        }

        

        if ($this->userModel->register($firstName, $lastName, $email, $password)) {
            return json_encode([
                'status' => 'success','message' => 'inscription enregistré avec succès'
            ]);
        }

        return json_encode([
            'status' => 'error','message' => 'Utilisateur enregistré avec succès']);
    }

    public function getUsers()
    {
        return json_encode($this->userModel->getUsers());
    }
}