<?php

namespace App\Models;
use Core\Model;

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
}
