<?php
@session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">
  </head>
  <body>
  <?php
require_once('navbar.php');
?>
<?php
//!Silme işlemi
if(isset($_GET['remove'])){
require('db.php');

$remove_id = $_GET['remove'];
$sql = "DELETE FROM favorites WHERE productid = :remove";
$SORGU = $DB->prepare($sql);
 $SORGU->bindParam(':remove', $remove_id); 
 $SORGU->execute();
 header('location:favorite.php');
};
//!Toplu silme işlemi
if(isset($_GET['delete_all'])){
require('db.php');

$sql = "DELETE FROM favorites";
$SORGU = $DB->prepare($sql);
 $SORGU->execute();
 header('location:favorite.php');
}
?>
    <div class="container">
    <h1 class="text-center mt-2 text-danger"><?php echo $_SESSION['adsoyad'] ?> Favorites List</h1>
    
    <table class="table table-striped mt-2 cell-border">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Image</th>
      <th scope="col">Name</th>
      <th scope="col">Price</th>
      <th scope="col">Delete</th>
    
    </tr>
  </thead>
  <tbody>
  </div>
    <?php
    $SORGU = $DB->prepare("SELECT * FROM favorites");
    $SORGU->execute();
    $favorites = $SORGU->fetchAll(PDO::FETCH_ASSOC);
    //echo '<pre>'; print_r($users);
  
    foreach($favorites as $favorite) {
      echo "
      <tr>
      <td>{$favorite['productid']}</td>
      <td><img src='uploads/{$favorite['productimage']}' class='rounded-circle' width='100' height='100'></td>
      <td>{$favorite['productname']}</td>
      <td>{$favorite['productprice']}</td>
      <td><a href='favorite.php?remove={$favorite['productid']}' onclick='return confirm(\"Remove Item From Favorite?\")' class='btn btn-danger'>Delete Favorite</a></td>
    </tr>    
      ";
    }
    ?>
  </tbody>
</table>
<p class="text-center">
<a type="button" href="favorite.php?delete_all"  onclick="return confirm('Are You Sure You Want To Delete All?')" class="btn btn-primary">Delete All</a>
</p>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" ></script>
  <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
  <script>
  $(document).ready( function () {
		$('.table').DataTable();
  });
  </script>
  </body>
</html>