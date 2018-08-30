<?php
require 'config/config.php';
error_reporting(E_ALL);
$tittle = 'data user';
if (isset($_POST['submit'])) 
{
	$id= $_POST['id'];
    $fnama= $_POST['f_name'];
    $lnama= $_POST['l_name'];
    $username= $_POST['user'];
    $email= $_POST['email'];
    $signup_date= $_POST['signup'];
    $file_gambar= $_FILES['file_gambar'];
    $gambar = null;

	if ($file_gambar['error'] ==0) {
        $filename = str_replace('','_', $file_gambar['name']);
        $destination = dirname(__FILE__).'/bahan/images/profile_pics/defaults/'.$filename;
        if (move_uploaded_file($file_gambar['tmp_name'],$destination)) {
            $gambar ='bahan/images/profile_pics/defaults/'.$filename;
        }
    }
    $sql = 'UPDATE users SET ';
    $sql .="first_name = '{$fnama}', last_name = '{$lnama}', username= '{$username}', email= '{$email}', signup_date= '{$signup_date}'";
        if (!empty($gambar))
        $sql .= ", profile_pic='{$gambar}' ";
        $sql .= "WHERE id ='{$id}'";
        $result = mysqli_query($con, $sql);
        if (!$result) die(mysqli_error($con));
        header ('location: data_user.php');
}
$id = $_GET['id'];
$sql = "SELECT * FROM users WHERE id = '{$id}'";
$result = mysqli_query($con, $sql);
if (!$result) die('Error: Data tidak tersedia');
$data = mysqli_fetch_array($result);
function is_select($var, $val) { 
        if ($var == $val) return 'selected="selected"'; 
        return false;} 
 
 
include('header_admin.php');
//include('sidebar.php');
?> 
 
<div class="content_a"> 
    <div class="daftar"> 
    <div class="main"> 
      <h2>Edit Data Admin</h2> 
        <form action="edit_user.php" method="post" enctype="multipart/form-data"> 
        <div class="input"> 
          <label for="">Nama Depan</label> 
          <input type="text" name="f_name" value="<?php echo $data['first_name'];?>"/><hr>
          <label for="">Nama Belakang</label> 
          <input type="text" name="l_name" value="<?php echo $data['last_name'];?>"/><hr>
          <label for="">Uesername</label> 
          <input type="text" name="user" value="<?php echo $data['username'];?>"/><hr>
          <label for="">Email</label>
          <input type="text" name="email" value="<?php echo $data['email'];?>"/><hr>
          <label for="">Tanggal Daftar</label>
          <input type="date" name="signup" value="<?php echo $data['signup_date'];?>"/><hr>
          <label for="">Photo</label> 
          <input type="file" name="file_gambar" /><hr>
         </div> 
        <div class ="submit"> 
        <input type="hidden" name="id" value="<?php echo $data['id'];?>"/> 
        <input type="submit" class="btn btn-large" name="submit" value="Simpan"/> 
</div> 
</form> 
 
</div> 
</div> 
</div> 
<?php 
include('footer.php'); 
?>