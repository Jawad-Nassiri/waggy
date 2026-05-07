<?php

namespace App\Models;

use Core\Model;
use PDO;

class User extends Model
{
    public function register($name, $email, $password, $confirmPassword)
    {

        if ($this->emailExists($email))
            return false;

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
    public function findUserByEmail($email)
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function login($email, $password)
    {
        $user = $this->findUserByEmail($email);

        if (!$user)
            return false;
        if (!password_verify($password, $user['password']))
            return false;

        return $user;
    }

    public function getLatestUsers($limit = 6)
    {
        $stmt = $this->db->prepare('SELECT * FROM users ORDER BY id DESC LIMIT :limit');
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countAll() {
        $stmt = $this->db->prepare('SELECT COUNT(*) FROM users');
        $stmt->execute();
        return $stmt->fetchColumn();
    }
}
