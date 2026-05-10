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
}