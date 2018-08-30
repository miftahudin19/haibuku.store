<?php
require 'config/config.php';
error_reporting(E_ALL);
$title	='data kategori';
if (isset($_POST['submit'])) {
	$kategori = $_POST['kategori'];
	$sql = 'INSERT INTO kategori (nama_kategori)';
	$sql .="VALUE ('{$kategori}')";
	$result = mysqli_query($con, $sql);
	if (!$result){
	die(mysqli_error($con));
	}
	header('location: kategori.php');
	}
	include('header_admin.php');
    //include_once('sidebar.php');
 ?>
 <div class="content_a">
 	<div class="main">
 		<h2>Tambah Kategori</h2>
 		<form action="form_kategori.php" method="post" enctype="multipart/form-data">
 			<div class="input-kategori">
 				<label for="">Nama Kategori : </label>
 				<input type="text" name="kategori">
 				<input type="submit" class="btn btn-default kate" name="submit" value="Simpan"/>
 			</div>
 		</form> 		
 	</div> 	
 </div>
 <?php 
 include ('footer.php'); ?>