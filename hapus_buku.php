<?php
require 'config/config.php';
//include('login_session.php');

$id =  $_GET['id'];
$sql = "DELETE FROM buku WHERE id_buku ='{$id}'";
$result = mysqli_query($con, $sql);
header('location: data_buku.php');
?>