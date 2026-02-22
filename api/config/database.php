<?php
class Database
{
    public static function getConnection(): PDO
    {
        $pdo = new PDO(
            "mysql:host=localhost;dbname=EcoStrava",
            "user",
            "user"
        );
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
}
