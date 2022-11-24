<?php

namespace App\Controller;

use App\Model\UserManager;

class UserController extends AbstractController
{
    private UserManager $userModel;


    public function __construct()
    {
        parent::__construct();
        $this->userModel = new UserManager();
    }


    public function addUser()
    {
        $errors = [];
        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
            $user = array_map('trim', $_POST);
            $user = array_map('htmlentities', $user);

            $errors = $this->validateregister($user);

            if (empty($errors)) {
                $userId = $this->userModel->insert($user);
                $_SESSION['user_id'] = $userId;
                header('Location: /epoque');
            }
        }
        return $this->twig->render('register/register.html.twig', [
            'errors' => $errors
        ]);
    }

    private function validateregister(array $user)
    {
        $errors = [];
        if (empty($user['firstname'])) {
            $errors[] = 'Votre prémon est obligatoire';
        }
        if (empty($user['lastname'])) {
            $errors[] = 'Votre nom de famille est obligatoire';
        }
        $userManager = new UserManager();
        if (!filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Votre email est obligatoire';
        } elseif ($userManager->selectByOneByEmail($user['email'])) {
            $errors[] = 'Cette adresse email existe déjà';
        }
        return $errors;
    }

    public function login()
    {
        $errors = [];
        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
            $userLog = array_map('trim', $_POST);
            $userLog = array_map('htmlentities', $userLog);

            $errors = $this->validateconnect($userLog);


            if (empty($errors)) {
                $userCheck = $this->userModel->selectByOneByEmail($userLog['email']);
                if ($userCheck) {
                    $_SESSION['user_id'] = $userCheck['id'];
                    header('Location: /epoque');
                } else {
                    $errors[] = 'Votre email est éronné';
                    return $this->twig->render('register/connect.html.twig', [
                        'errors' => $errors
                    ]);
                }
            }
        } else {
            return $this->twig->render('register/connect.html.twig', [
                'errors' => $errors
            ]);
        }
    }

    public function validateconnect(array $userLog): array
    {
        $errors = [];
        if (!filter_var($userLog['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Votre email est obligatoire';
        }
        return $errors;
    }


    public function logout()
    {
        unset($_SESSION['user_id']);
        header('Location: /connexion');
    }
}
