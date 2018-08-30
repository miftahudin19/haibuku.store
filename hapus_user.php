<?php
require 'config/config.php';
//include('login_session.php');

$id =  $_GET['id'];
$sql = "DELETE FROM users WHERE id ='{$id}'";
$result = mysqli_query($con, $sql);
header('location: data_user.php');
?>