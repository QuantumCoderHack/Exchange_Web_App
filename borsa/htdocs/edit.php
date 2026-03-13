<?php
require 'config.php';

$id = $_GET['id'] ?? 0;

$stmt = $pdo->prepare("SELECT * FROM stocks WHERE id=?");
$stmt->execute([$id]);
$data = $stmt->fetch();

if(!$data) die("Kayıt bulunamadı");

if(isset($_POST['update'])) {
    $symbol = $_POST['symbol'];
    $price = $_POST['price'];
    $date = $_POST['record_date'];

    $stmt = $pdo->prepare("UPDATE stocks SET symbol=?, price=?, record_date=? WHERE id=?");
    $stmt->execute([$symbol, $price, $date, $id]);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>ZBorsa | Hisse Düzenle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/128/893/893078.png">
</head>
<body>

<div class="container mt-5">
    <h3>Veri Güncelle</h3>

    <form method="POST">
        <input type="text" name="symbol" value="<?= htmlspecialchars($data['symbol']) ?>" class="form-control mb-3" required>
        <input type="number" step="0.01" name="price" value="<?= $data['price'] ?>" class="form-control mb-3" required>
        <input type="date" name="record_date" value="<?= $data['record_date'] ?>" class="form-control mb-3" required>
        <button type="submit" name="update" class="btn btn-primary">Güncelle</button>
        <a href="index.php" class="btn btn-secondary">Geri</a>
    </form>
</div>

</body>
</html>