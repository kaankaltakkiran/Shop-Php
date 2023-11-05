<?php
require_once('db.php');
require 'loginControl.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tekil Ürün Sayfası</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
  <?php
$sql = "SELECT * FROM products   WHERE productid = :id";
$SORGU = $DB->prepare($sql);
$SORGU->bindParam(':id',$_GET['id']);
$SORGU->execute();
$products = $SORGU->fetchAll(PDO::FETCH_ASSOC);

echo "
<div class='container'>
<div class='row text-center'>
  <h3 class='alert alert-primary mt-3'>{$products[0]['productname']}</h3>
</div>
</div>
";
echo "
<div class='container'>
<div class='row text-center'>
  <p class=''>Product Description: {$products[0]['productdescription']}</p>
  <p class=''>Product Price: {$products[0]['price']}</p>
  <p class=''> Product Stock: {$products[0]['stock']}</p>
</div>
</div>
";
echo "
<div class='container'>
<div class='row text-center'>
<img src='uploads/{$products[0]['productimg']}' class='card-img-top' alt='...'>
</div>
</div>
";

/* echo nl2br($DUYURU[0]['announcement']); */
echo "<br><hr>";
echo "
<div class='container'>
<div class='row text-center'>
<i class='text-muted'>" . date("d.m.Y", strtotime($products[0]['productdate'])) . " Published on.</i>
</div>
</div>
";
/* echo "<i class='text-muted'>" . date("d.m.Y", strtotime($DUYURU[0]['startingdate'])) . " Tarihinde yayınlanmıştır.</i>"; */
?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>


