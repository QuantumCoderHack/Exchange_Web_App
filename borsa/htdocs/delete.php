<?php
require 'config.php';

$id = $_GET['id'] ?? 0;

$stmt = $pdo->prepare("DELETE FROM stocks WHERE id=?");
$stmt->execute([$id]);

header("Location: index.php");
exit;