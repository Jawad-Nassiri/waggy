<?php

namespace Admin\Models;

use Core\Model;
use PDO;

class Order extends Model
{
    public function countAll()
    {
        $stmt = $this->db->prepare('SELECT COUNT(*) from orders');
        $stmt->execute();

        return $stmt->fetchColumn();
    }

    public function totalRevenue()
    {
        $stmt = $this->db->prepare('SELECT SUM(total) AS total FROM orders');
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['total'];
    }
}