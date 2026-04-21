<?php

namespace App\Models;

use Core\Model;
use PDO;

class Category extends Model {
    public function getAll() {
        $stmt = $this->db->prepare("SELECT * FROM categories");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}