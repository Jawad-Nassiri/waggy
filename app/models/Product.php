<?php

namespace App\Models;

use Core\Model;
use PDO;

class Product extends Model
{

    public function countAll()
    {
        $stmt = $this->db->prepare('SELECT COUNT(*) FROM products');
        $stmt->execute();

        return $stmt->fetchColumn();
    }

    public function getByCategory($categoryId, $limit = null, $offset = null)
    {
        $sql = "SELECT * FROM products WHERE category_id = :categoryId";

        if ($limit !== null && $offset !== null) {
            $sql .= " LIMIT :limit OFFSET :offset";
        }

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':categoryId', $categoryId);

        if ($limit !== null && $offset !== null) {
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFiltered($limit, $offset, $categoryId = null, $minPrice = null, $maxPrice = null)
    {
        $sql = "SELECT * FROM products WHERE 1=1";
        $params = [];

        if ($categoryId !== null) {
            $sql .= " AND category_id = :categoryId";
            $params[':categoryId'] = $categoryId;
        }

        if ($minPrice !== null && $maxPrice !== null) {
            $sql .= " AND price BETWEEN :minPrice AND :maxPrice";
            $params[':minPrice'] = $minPrice;
            $params[':maxPrice'] = $maxPrice;
        }

        $sql .= " LIMIT :limit OFFSET :offset";

        $stmt = $this->db->prepare($sql);

        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }

        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countFiltered($categoryId = null, $minPrice = null, $maxPrice = null)
    {
        $sql = "SELECT COUNT(*) FROM products WHERE 1=1";
        $params = [];

        if ($categoryId !== null) {
            $sql .= " AND category_id = :categoryId";
            $params[':categoryId'] = $categoryId;
        }

        if ($minPrice !== null && $maxPrice !== null) {
            $sql .= " AND price BETWEEN :minPrice AND :maxPrice";
            $params[':minPrice'] = $minPrice;
            $params[':maxPrice'] = $maxPrice;
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchColumn();
    }

    public function getProductById($id) {
        $stmt = $this->db->prepare('SELECT * FROM products WHERE id = :id');
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}


