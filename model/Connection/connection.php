<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'recoverybutterfly';

try {

    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
