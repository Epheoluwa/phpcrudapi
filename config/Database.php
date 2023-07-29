<?php 

namespace Config;

use PDO;
use PDOException;
use Exception;

class Database
{
    protected $conn;
    protected $stmt;

    public function __construct()
    {
        $config = require 'configuration.php';
        $dbConfig = $config['database'];

        try {
            $this->conn = new PDO(
                'mysql:host=' . $dbConfig['host'] . ';dbname=' . $dbConfig['db_name'],
                $dbConfig['username'],
                $dbConfig['password']
            );

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new Exception('Connection Error: ' . $e->getMessage());
        }

        return $this->conn;
    }

    public function queryproduct($query)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_OBJ);
        // $products = $stmt->fetch(PDO::FETCH_ASSOC);

        return json_encode($products);
    }

    public function query($query)
    {
        $this->stmt = $this->conn->prepare($query);
    }

    public function execute()
    {
        return $this->stmt->execute();
    }

    public function bind($param, $value)
    {
        $this->stmt->bindValue($param, $value);
    }
}








?>