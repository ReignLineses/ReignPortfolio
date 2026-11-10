<?php
// Database connection settings (XAMPP defaults).
const dbHost = 'localhost';
const dbPort = 3307;
const dbName = 'reign';
const dbUser = 'root';
const dbPassword = '';

function getDatabase(): PDO
{
    static $database = null;

    if ($database === null) {
        try {
            $database = new PDO(
                'mysql:host=' . dbHost . ';port=' . dbPort . ';dbname=' . dbName . ';charset=utf8mb4',
                dbUser,
                dbPassword,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]
            );
        } catch (PDOException $exception) {
            // A fresh exception, because the original stack trace would print the password.
            throw new RuntimeException('Database connection failed: ' . $exception->getMessage());
        }
    }

    return $database;
}
