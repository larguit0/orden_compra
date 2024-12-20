<?php
const DB_SERVER = "localhost"; 
const DB_NAME = "u115058317_orden"; 
const DB_USER = "u115058317_orden"; 
const DB_PASS = "Acema2024"; 

class Database {
    public static function connect() {
        try {
            $conn = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
            die();
        }
    }
}


