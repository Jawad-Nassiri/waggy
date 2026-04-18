<?php

namespace App\Models;

use Core\Model;
use PDO;

class Product extends Model
{
    public function getByCategory($categoryId)
    {
        $stmt = $this->db->prepare('SELECT * FROM products WHERE category_id = :category_id');
        $stmt->execute([':category_id' => $categoryId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
