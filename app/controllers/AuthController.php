<?php



namespace App\Controllers;

use Core\Controller;
use App\Models\User;

class AuthController extends Controller
{
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $errors = [];

            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $confirmPassword = trim($_POST['confirm-password']);

            if (empty($name)) {
                $errors['name'] = 'Name is required';
            } elseif (strlen($name) < 3) {
                $errors['name'] = 'Name must be at least 3 characters';
            }

            if (empty($email)) {
                $errors['email'] = 'Email is required';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Invalid email';
            }

            if (empty($password)) {
                $errors['password'] = 'Password is required';
            } elseif (strlen($password) < 6) {
                $errors['password'] = 'Password must be at least 6 characters';
            }

            if ($password !== $confirmPassword) {
                $errors['confirm-password'] = 'Passwords do not match';
            }

            if (empty($errors)) {
                $user = new User();
                $result = $user->register($name, $email, $password, $confirmPassword);

                if (!$result) {
                    $errors['email'] = 'Email already exists';
                    return $this->view('auth/register', ['errors' => $errors]);
                }

                $_SESSION['toast'] = ['type' => 'success', 'message' => 'You Registered successfully!'];
                header("Location: /waggy/home");
                exit;
            }

            return $this->view('auth/register', [
                'errors' => $errors
            ]);
        } else {
            $this->view('auth/register', ['errors' => []]);
        }
    }
}
