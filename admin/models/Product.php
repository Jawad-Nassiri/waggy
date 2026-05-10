<?php

namespace Admin\Models;

use Core\Model;
use PDO;

class Product extends Model
{

    public function getAllProducts()
    {
        $stmt = $this->db->prepare('SELECT * FROM products');
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getLatestProducts($limit = 6)
    {
        $stmt = $this->db->prepare('SELECT * FROM products ORDER BY id DESC LIMIT :limit');
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countAll()
    {
        $stmt = $this->db->prepare('SELECT COUNT(*) FROM products');
        $stmt->execute();

        return $stmt->fetchColumn();
    }
}