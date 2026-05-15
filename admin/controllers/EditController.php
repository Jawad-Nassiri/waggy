<?php

namespace Admin\Controllers;

use Admin\Controllers\BaseController;
use Admin\Models\User;

class EditController extends BaseController
{
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
            return $this->view('users/editUser', ['error' => 'User not found']);
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