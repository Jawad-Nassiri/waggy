<?php

namespace App\Models;

use Core\Model;
use PDO;

class Cart extends Model
{
    public function addToCart($userId, $productId, $quantity)
    {
        $stmt = $this->db->prepare("
            SELECT quantity 
            FROM cart 
            WHERE user_id = :userId AND product_id = :productId
        ");

        $stmt->execute([
            ':userId' => $userId,
            ':productId' => $productId
        ]);

        $existing = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existing) {
            return 'exists';
        } else {
            $stmt = $this->db->prepare("
            INSERT INTO cart (user_id, product_id, quantity)
            VALUES (:userId, :productId, :quantity)
        ");

            $stmt->execute([
                ':userId' => $userId,
                ':productId' => $productId,
                ':quantity' => $quantity
            ]);
        }

        return true;
    }

    public function getCartItems($userId)
    // takes the user id
    // returns all products in that user’s cart
    {
        $stmt = $this->db->prepare("
            SELECT 
                cart.quantity,
                products.id,
                products.name,
                products.price,
                products.image
            FROM cart
            JOIN products ON cart.product_id = products.id
            WHERE cart.user_id = :userId
        ");

        $stmt->execute([
            ':userId' => $userId
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateQuantity($userId, $productId, $quantity)
    {
        $stmt = $this->db->prepare("UPDATE cart SET quantity = :quantity WHERE product_id = :productId AND user_id = :userId");

        $stmt->execute([
            ':userId' => $userId,
            ':productId' => $productId,
            ':quantity' => $quantity
        ]);

        return true;
    }

    public function removeItem($userId, $productId)
    {
        $stmt = $this->db->prepare("DELETE FROM cart WHERE user_id = :userId AND product_id = :productId");

        $stmt->execute([
            ':userId' => $userId,
            ':productId' => $productId
        ]);

        return true;
    }

    public function clearCart($userId)
    {
        $stmt = $this->db->prepare('DELETE FROM cart WHERE user_id = :userId');
        $stmt->execute([':userId' => $userId]);
        return true;
    }

    public function countCartItems($userId)
    {
        $stmt = $this->db->prepare('SELECT COUNT(*) FROM cart WHERE user_id = :userId');
        $stmt->execute([':userId' => $userId]);

        return $stmt->fetchColumn();
    }
}
