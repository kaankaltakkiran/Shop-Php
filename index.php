<?php
@session_start();
require 'loginControl.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>

    <?php
require_once('navbar.php');
require_once('db.php');


$SORGU = $DB->prepare("SELECT * FROM products");
$SORGU->execute();
$products = $SORGU->fetchAll(PDO::FETCH_ASSOC);
//echo '<pre>'; print_r($users);

foreach($products as $product) {
    echo "
    <div class='container mt-5'>
    <div class='row row-cols-1 row-cols-md-3 g-4'>
    <div class='col'>
      <div class='card h-100'>
        <img src='uploads/{$product['productimg']}' class='card-img-top' alt='...'>
        <div class='card-body'>
          <h5 class='card-title'>{$product['productname']}</h5>
          <p class='card-text'>Product Name: {$product['productdescription']}</p>
          <p class='card-text'>Product Price: {$product['price']}</p>
          <p class='card-text'>Product Stock: {$product['stock']}</p>
        </div>
        <div class='card-footer'>
        <small class='text-body-secondary'>{$product['productdate']}</small>
      </div>
      </div>
    </div>
    </div>
    </div>
    
    ";
}
?>
<div class="container">
  <div class="row justify-content-center mt-3">
  <div class="col-6">

<form action="upload.php"
           method="POST"
           enctype="multipart/form-data">

           <div class="form-floating mb-3">
  <input type="text" name="form_productname" class="form-control">
  <label>Product Name</label>
</div>
<div class="form-floating mb-3">
  <input type="text" name="form_productdescription" class="form-control">
  <label>Product Description</label>
</div>
<div class="form-floating mb-3">
  <input type="text" name="form_price" class="form-control">
  <label>Price</label>
</div>
<div class="form-floating mb-3">
  <input type="text" name="form_stock" class="form-control">
  <label>Stock</label>
</div>

           <input type="file" 
                  name="my_image" class="mb-5">

                  <button type="submit" name="submit" class="btn btn-primary">Save Product</button>   	
     </form>
     </div>
</div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>


