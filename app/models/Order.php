<?php

namespace App\Models;
use Core\Model;
use PDO;

class Order extends Model
{
    public function createOrder($userId, $total)
    {
        $stmt = $this->db->prepare('INSERT INTO orders (user_id, total) VALUES (:userId, :total)');
        $stmt->execute([':userId' => $userId, 'total' => $total]);
        return $this->db->lastInsertId();
    }

    public function createOrderItems($orderId, $productId, $quantity, $price)
    {
        $stmt = $this->db->prepare('INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (:orderId, :productId, :quantity, :price)');

        $stmt->execute([
            ':orderId' => $orderId,
            ':productId' => $productId,
            ':quantity' => $quantity,
            ':price' => $price
        ]);

        return true;
    }

    public function getLastOrder($userId)
    {
        $stmt = $this->db->prepare('SELECT * FROM orders WHERE user_id = :userId ORDER BY id DESC LIMIT 1');
        $stmt->execute([':userId' => $userId]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getOrderItems($orderId)
    {
        $stmt = $this->db->prepare('
        SELECT oi.*, p.name, p.image
        FROM order_items oi
        JOIN products p ON oi.product_id = p.id
        WHERE oi.order_id = :orderId
    ');

        $stmt->execute([
            ':orderId' => $orderId
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
