<?php
$host = "sql308.infinityfree.com";
$dbname = "if0_41281162_borsa_db";
$username = "if0_41281162";
$password = "mxOpBLXjZguQhb";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Bağlantı hatası: " . $e->getMessage());
}
?>