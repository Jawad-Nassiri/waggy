<?php

namespace Core;
use PDO;
use PDOException;

class Model
{
    // protected means the property can be used in this class and any class that extends it, but not outside.
    protected $db;

    public function __construct()
    {
        try {
            $this->db = new PDO(
                'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8',
                DB_USER,
                DB_PASS
            );

            //             With $this->db we can:

            // SELECT → get data from database
            // INSERT → add new data
            // UPDATE → update existing data
            // DELETE → delete data
            // prepare → secure queries (prevents SQL injection)

            // e.g => $this->db->prepare('SELECT * FROM products');

            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Connection failed: ' . $e->getMessage());
        }
    }
}
