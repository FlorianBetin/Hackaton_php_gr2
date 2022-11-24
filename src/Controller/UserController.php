<?php

namespace App\Controller;

use App\Model\RegisterManager;

class RegisterFormController extends AbstractController
{
    private RegisterManager $registerModel;


    public function __construct()
    {
        parent::__construct();
        $this->registerModel = new RegisterManager();
    }


    public function displayRegister(): string
    {
        return $this->twig->render('FormConnect/register.html.twig');
    }


    public function addUser()
    {
        $errors = [];
        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
            $user = array_map('trim', $_POST);
            $user = array_map('htmlentities', $user);

            $errors = $this->validate($user);

            if (empty($errors)) {
                $userId = $this->registerModel->insert($user);
                $_SESSION['user_id'] = $userId;
                header('Location: /epoque');
            }
        }
        return $this->twig->render('register/register.html.twig', [
            'errors' => $errors
        ]);
    }

    private function validate(array $user)
    {
        $errors = [];
        if (empty($user['firstname'])) {
            $errors[] = 'Votre prémon est obligatoire';
        }
        if (empty($user['lastname'])) {
            $errors[] = 'Votre nom de famille est obligatoire';
        }
        $registerManager = new RegisterManager();
        if (!filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Votre email est obligatoire';
        } elseif ($registerManager->selectByOneByEmail($user['email'])) {
            $errors[] = 'Cette adresse email existe déjà';
        }
        return $errors;
    }
}
