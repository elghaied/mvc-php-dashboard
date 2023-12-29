<?php

namespace Fiveteam\Models;


use PDO;
use Exception;
use PDOException;
class Dbcon {
    private $host;
    private $dbname;
    private $user;
    private $password;
    private $pdo;

    public function __construct() {
        $this->host =  getenv('DB_HOST');
        $this->dbname = getenv('DB_NAME');
        $this->user = getenv('DB_USER');
        $this->password = getenv('DB_PASSWORD');

        
        // phpinfo();
        $dsn = "mysql:host=$this->host;dbname=$this->dbname";
        try {
            $this->pdo = new PDO($dsn, $this->user, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new Exception('Connection failed: ' . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->pdo;
    }

}
