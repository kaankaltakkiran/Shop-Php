<?php
@session_start();
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
  <nav class="navbar navbar-expand-lg navbar bg-primary" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Home</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <?php
      require 'db.php';
      $user_id = $_SESSION['id'];
      $SORGU = $DB->prepare("SELECT * FROM favorites WHERE userid = :id ");
      $SORGU->bindParam(':id', $user_id);
      $SORGU->execute();
      $favorites = $SORGU->fetchAll(PDO::FETCH_ASSOC);

      ?>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
      <?php if ($_SESSION['isLogin'] == 1) { ?>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($activePage == 'favorite') ? 'active':''; ?>" href="favorite.php">Favorites <span class="badge text-bg-danger"><?php echo count($favorites) ?></span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>
        <?php } ?>
        <?php if ($_SESSION['isLogin'] == 0) { ?>
        <li class="nav-item">
          <a class="nav-link  <?= ($activePage == 'register') ? 'active':''; ?>" href="register.php">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link  <?= ($activePage == 'login') ? 'active':''; ?>" href="login.php">Login</a>
        </li>
        <?php } ?>
      </ul>
    </div>
  </div>
</nav>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>
