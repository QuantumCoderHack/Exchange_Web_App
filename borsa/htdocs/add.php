<?php
require 'config.php';

if(isset($_POST['add'])) {

    $symbol = $_POST['symbol'];
    $price = $_POST['price'];
    $date = $_POST['record_date'];

    $stmt = $pdo->prepare("INSERT INTO stocks (symbol, price, record_date) VALUES (?, ?, ?)");
    $stmt->execute([$symbol, $price, $date]);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ZBorsa | Hisse Ekle</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="icon" href="https://cdn-icons-png.flaticon.com/128/893/893078.png">

</head>
<body>

<div class="container mt-5">

<h3>Yeni Hisse Verisi Ekle</h3>

<form method="POST">

<input type="text"
name="symbol"
class="form-control mb-3"
placeholder="Hisse Kodu (örn: THYAO)"
required>

<input type="number"
step="0.01"
name="price"
class="form-control mb-3"
placeholder="Fiyat"
required>

<input type="date"
name="record_date"
class="form-control mb-3"
value="<?= date('Y-m-d') ?>"
required>

<button type="submit" name="add" class="btn btn-success">
Kaydet
</button>

<a href="index.php" class="btn btn-secondary">
Geri
</a>

</form>

</div>

</body>
</html>