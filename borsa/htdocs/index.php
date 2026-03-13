<?php require 'config.php'; ?>

<?php
$selectedSymbol = $_GET['symbol'] ?? '';

$chartLabels = [];
$datasets = [];

$colors = [
"#ff6384",
"#36a2eb",
"#4bc0c0",
"#ff9f40",
"#9966ff",
"#8bc34a",
"#e91e63",
"#00acc1"
];

if($selectedSymbol){

if($selectedSymbol == "all"){

$stmtChart = $pdo->query("SELECT symbol, record_date, price FROM stocks ORDER BY record_date ASC");

$temp = [];

while($row = $stmtChart->fetch()){
$temp[$row['symbol']]['labels'][] = $row['record_date'];
$temp[$row['symbol']]['data'][] = $row['price'];
}

$i=0;

foreach($temp as $symbol => $data){

$datasets[] = [
'label'=>$symbol,
'data'=>$data['data'],
'borderColor'=>$colors[$i % count($colors)],
'backgroundColor'=>$colors[$i % count($colors)],
'stepped'=>true,
'pointRadius'=>4,
'fill'=>false
];

$chartLabels = $data['labels'];

$i++;
}

}else{

$stmtChart = $pdo->prepare("SELECT record_date, price FROM stocks WHERE symbol=? ORDER BY record_date ASC");
$stmtChart->execute([$selectedSymbol]);

$chartData=[];

while($row=$stmtChart->fetch()){
$chartLabels[]=$row['record_date'];
$chartData[]=$row['price'];
}

$datasets[]=[
'label'=>$selectedSymbol,
'data'=>$chartData,
'borderColor'=>"#36a2eb",
'backgroundColor'=>"#36a2eb",
'stepped'=>true,
'pointRadius'=>5,
'fill'=>false
];

}

}

$stmt=$pdo->query("SELECT * FROM stocks ORDER BY record_date DESC");

$symbols=$pdo->query("SELECT DISTINCT symbol FROM stocks")->fetchAll(PDO::FETCH_COLUMN);

?>

<!DOCTYPE html>
<html lang="tr">
<head>

<meta charset="UTF-8">
<title>ZBorsa | Ana Sayfa</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<link rel="icon" href="https://cdn-icons-png.flaticon.com/128/893/893078.png">

</head>

<body>

<div class="container mt-5">

<h2 class="mb-4">📈 Günlük Borsa Takip</h2>

<a href="add.php" class="btn btn-success mb-3">+ Yeni Veri Ekle</a>

<div class="card shadow mb-4">

<div class="card-body">

<h5 class="mb-3">📊 Grafik Analizi</h5>

<form method="GET" class="mb-4">

<div class="row">

<div class="col-md-4">

<select name="symbol" class="form-select" required>

<option value="">Hisse Seç</option>

<option value="all" <?=($selectedSymbol=="all")?'selected':''?>>
Tümü
</option>

<?php foreach($symbols as $symbol): ?>

<option value="<?=$symbol?>" <?=($selectedSymbol==$symbol)?'selected':''?>>
<?=$symbol?>
</option>

<?php endforeach; ?>

</select>

</div>

<div class="col-md-2">

<button class="btn btn-primary">
Grafik Göster
</button>

</div>

</div>

</form>

<?php if($selectedSymbol && count($datasets)>0): ?>

<canvas id="stockChart" height="100"></canvas>

<?php elseif($selectedSymbol): ?>

<div class="alert alert-warning">
Bu hisse için veri bulunamadı
</div>

<?php endif; ?>

</div>

</div>


<table class="table table-bordered table-striped">

<thead class="table-dark">

<tr>

<th>ID</th>
<th>Hisse</th>
<th>Fiyat</th>
<th>Tarih</th>
<th>İşlem</th>

</tr>

</thead>

<tbody>

<?php while($row=$stmt->fetch()): ?>

<tr>

<td><?=$row['id']?></td>

<td><strong><?=htmlspecialchars($row['symbol'])?></strong></td>

<td><?=$row['price']?> ₺</td>

<td><?=$row['record_date']?></td>

<td>

<a href="edit.php?id=<?=$row['id']?>" class="btn btn-warning btn-sm">
Düzenle
</a>

<a href="delete.php?id=<?=$row['id']?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Silinsin mi?')">
Sil
</a>

</td>

</tr>

<?php endwhile; ?>

</tbody>

</table>

</div>


<?php if($selectedSymbol && count($datasets)>0): ?>

<script>

const ctx=document.getElementById('stockChart');

new Chart(ctx,{

type:'line',

data:{

labels:<?=json_encode($chartLabels)?>,

datasets:<?=json_encode($datasets)?>

},

options:{

responsive:true,

interaction:{
mode:'index',
intersect:false
},

plugins:{
legend:{
display:true
}
},

scales:{
y:{
beginAtZero:false
}
}

}

});

</script>

<?php endif; ?>

</body>
</html>