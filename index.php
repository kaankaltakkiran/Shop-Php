<?php
@session_start();
require 'loginControl.php';
$activePage="index";
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
<?php
require_once('navbar.php');
require_once('db.php');
?>

<?php
require('db.php');
//!Favoriye ekle butonına basıldığında
if(isset($_POST['add_to_fav'])){
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $user_id = $_SESSION['id'];

   //!Ürün ismine göre veritabanında arama yap
  $sql = "SELECT * FROM favorites WHERE productname = '$product_name'AND userid = :id";
  $SORGU = $DB->prepare($sql);
  $SORGU->bindParam(':id', $user_id); 
  $SORGU->execute();
  $favorites= $SORGU->fetchAll(PDO::FETCH_ASSOC);
   //!Eğer ürün varsa 1 yoksa 0 
   if(count($favorites) == 1){
      $message[] = 'Product Already Added To Favorite';
   }else{
    //!Ürün yoksa veritabanına ekle
      $sql = "INSERT INTO favorites (productname, productprice, productimage,userid) VALUES(:product_name, :product_price, :product_image,:id)";
      $SORGU = $DB->prepare($sql);

      $SORGU->bindParam(':product_name',  $product_name);
      $SORGU->bindParam(':product_price',  $product_price);
      $SORGU->bindParam(':product_image',  $product_image);
      $SORGU->bindParam(':id', $user_id); 
      $SORGU->execute();
      $message[] = 'Product Added To Favorite Succesfully';
      //!İndex sayfasında sekronizasyonu sağlamak için sayfayı yenile
      header("Refresh:0");
    }
}
?>
<?php
//!Mesajları ekrana yazdır
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="container">  
  <div class="alert mt-3 text-center alert-info alert-dismissible fade show" role="alert">
  '.$message.'
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  </div>
  ';
   };
};
?>
  <div class='container mt-5'>
    <div class='row g-4'>
<?php
$SORGU = $DB->prepare("SELECT * FROM products");
$SORGU->execute();
$products = $SORGU->fetchAll(PDO::FETCH_ASSOC);
//echo '<pre>'; print_r($users);

foreach($products as $product) {
    echo "
    <div class='col-md-4'>
    <form action='' method='post'>
      <div class='card h-100'>
      <a href='product.php?id={$product['productid']}'><img src='uploads/{$product['productimg']}' class='card-img-top' alt='...'></a>
      <input type='hidden' name='product_image' value='{$product['productimg']}'>
        <div class='card-body'>
          <h5 class='card-title'>{$product['productname']}</h5>
          <input type='hidden' name='product_name' value='{$product['productname']}'>
          <p class='card-text'>Product Name: {$product['productdescription']}</p>
          <input type='hidden' value='{$product['productdescription']}'>
          <p class='card-text'>Product Price: {$product['price']}</p>
          <input type='hidden' name='product_price' value='{$product['price']}'>
          <p class='card-text'>Product Stock: {$product['stock']}</p>
          <input type='hidden' name='product_stock' value='{$product['stock']}'>
           <input type='submit' class='btn btn-danger' value='Add To Favorite' name='add_to_fav'>
        </div>
        </form>
        <div class='card-footer'>
        <small class='text-body-secondary'>{$product['productdate']}</small>
      </div>
      </div>
    </div> 
    ";
}
?>
 </div>
    </div>
<?php if ($_SESSION['rol'] == 2) { ?>
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
<?php } ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>


