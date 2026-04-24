<?php

namespace App\Models;

use Core\Model;

class User extends Model
{
    public function register($name, $email, $password, $confirmPassword)
    {

        if ($this->emailExists($email)) return false;

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $role = 'user';

        $stmt = $this->db->prepare(
            'INSERT INTO users (name, email, password, role) 
            VALUES (:name, :email, :password, :role)'
        );

        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':password', $hashedPassword);
        $stmt->bindValue(':role', $role);

        return $stmt->execute();
    }


    public function emailExists($email)
    {
        $stmt = $this->db->prepare('SELECT id FROM users WHERE email = :email');
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        // If a row is found → returns true
        // If no row → returns false
        return $stmt->fetch() !== false;
    }


}
