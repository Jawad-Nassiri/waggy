<?php

namespace Admin\Controllers;

use Admin\Controllers\BaseController;
use App\Models\User;


class UsersController extends BaseController
{
     public function index()
    {
        $userModel = new User();
        $users = $userModel->getUsers();

        if (!$users) {
            return $this->view('users/index', ['error' => 'No users found !']);
        }

        return $this->view('users/index', ['users' => $users]);
    }
}