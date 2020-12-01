<?php
namespace src\models;
use src\Config;
use PDO;
use PDOException;

class ModelPDO extends PDO {
    public static function banco() {
        try {
            $pdo = new PDO(Config::DB_DRIVER.":dbname=".Config::DB_DATABASE.";host=".Config::DB_HOST, Config::DB_USER, Config::DB_PASS);
            return $pdo;
        } catch (PDOException $e) {
            echo "Falhou: ".$e->getMessage();
        }
    }
}