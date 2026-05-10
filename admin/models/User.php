<?php

namespace Admin\Models;

use Core\Model;
use PDO;

class User extends Model
{
    public function getUsers()
    {
        $stmt = $this->db->prepare('SELECT * FROM users');
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getUserById($id)
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->execute([':id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getLatestUsers($limit = 6)
    {
        $stmt = $this->db->prepare('SELECT * FROM users ORDER BY id DESC LIMIT :limit');
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function countAll()
    {
        $stmt = $this->db->prepare('SELECT COUNT(*) FROM users');
        $stmt->execute();
        return $stmt->fetchColumn();
    }
}