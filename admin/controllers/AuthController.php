<?php

namespace Admin\Controllers;

use Admin\Controllers\BaseController;
use App\Models\User;

class AuthController extends BaseController
{
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {

            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            $user = new User();
            $userData = $user->login($email, $password);


            if (!$userData) {
                $this->view('auth/login', [
                    'errors' => ['login' => 'Invalid email or password']
                ]);
                return;
            }

            if ($userData['role'] !== 'admin') {
                $this->view('auth/login', [
                    'errors' => ['login' => 'Access denied']
                ]);
                return;
            }

            $_SESSION['admin'] = $userData;
            header("Location: /waggy/admin/dashboard");
            exit;

        } else {
            $this->view('auth/login', ['errors' => []]);
        }
    }
}