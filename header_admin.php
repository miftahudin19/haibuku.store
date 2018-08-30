<?php
require 'config/config.php';

if (isset($_SESSION['username'])) {
    $userLoggedIn = $_SESSION['username'];
    $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
    $user = mysqli_fetch_array($user_details_query);
}
else {
    header("Location: register.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Haibuku.Store</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="bahan/css/style.css" rel="stylesheet">
  <link href="bahan/css/bootstrap.css" rel="stylesheet">
  <link href="bahan/css/ionicons.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbare navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="admin.php">Haibuku.Store</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="dropdown"><a href="data_user.php">Data Admin</a></li>
      <li class="dropdown"><a href="form_kategori.php">Tambah Kategori</a></li>
      <li class="dropdown"><a href="kategori.php">Data Kategori</a></li>
      <li class="dropdown"><a href="form_buku.php">Tambah Buku</a></li>
      <li class="dropdown"><a href="data_buku.php">Data Buku</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
     <li><a href="admin.php"><span class="ion-person"></span> Admin : <?php echo $user['first_name'] . " " . $user['last_name']; ?> (online)</a></li>
      <li><a href="index.php"><span class="ion-power"></span> Log Out/Home</a></li>
    </ul>
  </div>
</nav>
</body>
</html>