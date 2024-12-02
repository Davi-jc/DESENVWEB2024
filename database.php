<?php
// backend/config/database.php

$host = '127.0.0.1';
$db   = 'trabalho_semestral';
$user = 'postgres';
$pass = '123';
$port = "5432";
$dsn = "pgsql:host=$host;port=$port;dbname=$db;";

try {
    $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $e) {
    echo 'Conexão falhou: ' . $e->getMessage();
    exit;
}
?>