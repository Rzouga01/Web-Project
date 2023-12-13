<?php

class Config
{
    private static $pdo = null;

    private static $servername = 'localhost';
    private static $username = 'root';
    private static $password = '';
    private static $dbname = 'recoverybutterfly';

    public static function getConnexion()
    {
        if (!isset(self::$pdo)) {
            try {
                self::$pdo = new PDO("mysql:host=" . self::$servername . ";dbname=" . self::$dbname, self::$username, self::$password, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]);
            } catch (Exception $e) {
                die('Erreur: ' . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}
