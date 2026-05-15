<?php

namespace Admin\Controllers;

use Admin\Controllers\BaseController;
use Admin\Models\User;

class UsersController extends BaseController
{
    public function index()
    {
        $userModel = new User();
        $users = $userModel->getUsers();

        if (empty($users)) {
            return $this->view('users/index', ['error' => 'No users found !']);
        }

        return $this->view('users/index', ['users' => $users]);
    }

    public function addUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $errors = [];

            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $role = trim($_POST['role']);

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

            if (empty($role)) {
                $errors['role'] = 'Role is required';
            }

            if (empty($errors)) {
                $user = new User();
                $result = $user->addUser($name, $email, $password, $role);

                if (!$result) {
                    $errors['email'] = 'Email already exists';
                    return $this->view('users/addUser', ['errors' => $errors]);
                }

                $_SESSION['toast'] = ['type' => 'success', 'message' => 'User added successfully!'];
                header("Location: /waggy/admin/users");
                exit;
            }

            return $this->view('users/addUser', [
                'errors' => $errors
            ]);

        } else {
            return $this->view('users/addUser', ['errors' => []]);
        }
    }
    public function deleteUser()
    {
        header('Content-Type: application/json');
        $body = json_decode(file_get_contents("php://input"), true);

        $userId = $body['userId'] ?? null;

        if (!isset($userId)) {
            echo json_encode([
                'status' => 'Error',
                'message' => 'User not found'
            ]);
            exit;
        }

        $userModel = new User();
        $result = $userModel->deleteUser($userId);

        if ($result) {
            echo json_encode([
                'status' => 'Success',
                'message' => 'User Deleted successfully !'
            ]);
            exit;
        } else {
            echo json_encode([
                'status' => 'Error',
                'message' => 'Failed to delete user.'
            ]);
            exit;
        }

    }

    public function editUser($userId)
    {
        if (!$userId) {
            return $this->view('users/editUser', ['error' => 'User not found']);
        }

        $userModel = new User();
        $userData = $userModel->getUserById($userId);

        if (!$userData) {
            return $this->view('users/editUser', ['error' => 'User not found']);
        }

        return $this->view('users/editUser', ['user' => $userData]);
    }

    public function updateUser($userId)
    {
        if (!$userId) {
            return $this->view('admin/users/editUser', ['error' => 'User not found']);
        }

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $errors = [];

            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $role = trim($_POST['role']);

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

            if (empty($role)) {
                $errors['role'] = 'Role is required';
            }

            if (empty($errors)) {
                $user = new User();
                $result = $user->updateUser($userId, $name, $email, $role);

                if (!$result) {
                    $errors['error'] = 'Operation failed';
                    return $this->view('admin/edit/editUser', ['errors' => $errors]);
                } else {

                    $_SESSION['toast'] = [
                        'type' => 'success',
                        'title' => 'Success',
                        'message' => 'User updated successfully'
                    ];

                    header("Location: /waggy/admin/users");
                    exit;
                }
            }

            return $this->view('admin/edit/editUser', ['errors' => $errors]);

        } else {
            $this->view('admin/edit/editUser', ['errors' => []]);
        }
    }
}