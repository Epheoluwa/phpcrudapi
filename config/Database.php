<?php 
class Database
{
    protected $conn;

    public function connect()
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
}








?>