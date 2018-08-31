<?php  
require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';
include ('header.php')
?>


<html>
<head>
	<link rel="stylesheet" type="text/css" href="bahan/css/register_style.css">
	<script src="bahan/js/jquery.min.js"></script>
	<script src="bahan/js/register.js"></script>
</head>
<body>
    <?php 
    if(isset($_POST['register_button'])) {
        echo '
        <script>
        $(document).ready(function() {
            $("#first").hide();
            $("#second").show();
        });
        </script>
        ';
    }
    ?>

	<div class="wrapper">
        <div class="login_box">
           <div class="login_header">
               <h1>Haibuku.Store</h1>
               Toko buku online zaman now, ayo manusia-manusia bumi kita membaca buku,<br> dengan membeli terlebih dahulu di Haibuku.Store !
           </div>
            <div id="first">
                <form action="register.php" method="POST">
                    <input type="email" name="log_email" placeholder="Email Address" value="<?php 
                    if(isset($_SESSION['log_email'])) {
                        echo $_SESSION['log_email'];
                    } 
                    ?>" required>
                    <br>
                    <input type="password" name="log_password" placeholder="Password">
                    <br>
                    <?php if(in_array("Email atau Password yang anda masukan salah, Cobalagi Kang!<br>", $error_array)) echo  "Email atau Password yang anda masukan salah, Cobalagi Kang!<br>"; ?>
                    <input type="submit" name="login_button" value="Login">
                    <br>
                    <a href="#" id="signup" class="signup"> Belum punya akun? Ayo daftar disini!</a>
                </form>
            </div>
            <div id="second">
                <form action="register.php" method="POST">
                    <input type="text" name="reg_fname" placeholder="Nama Depan" value="<?php 
                    if(isset($_SESSION['reg_fname'])) {
                        echo $_SESSION['reg_fname'];
                    } 
                    ?>" required>
                    <br>
                    <?php if(in_array("Nama depan kamu harus antara 2 atau 25 karakter<br>", $error_array)) echo "Nama depan kamu harus antara 2 atau 25 karakter<br>"; ?>




                    <input type="text" name="reg_lname" placeholder="Nama Belakang" value="<?php 
                    if(isset($_SESSION['reg_lname'])) {
                        echo $_SESSION['reg_lname'];
                    } 
                    ?>" required>
                    <br>
                    <?php if(in_array("Nama belakang kamu harus antara 2 atau 25 karakter<br>", $error_array)) echo "Nama belakang kamu harus antara 2 atau 25 karakter<br>"; ?>

                    <input type="email" name="reg_email" placeholder="Email" value="<?php 
                    if(isset($_SESSION['reg_email'])) {
                        echo $_SESSION['reg_email'];
                    } 
                    ?>" required>
                    <br>

                    <input type="email" name="reg_email2" placeholder="Confirm Email" value="<?php 
                    if(isset($_SESSION['reg_email2'])) {
                        echo $_SESSION['reg_email2'];
                    } 
                    ?>" required>
                    <br>
                    <?php if(in_array("Email telah terpakai<br>", $error_array)) echo "Email telah terpakai<br>"; 
                    else if(in_array("Format email salah<br>", $error_array)) echo "Format email salah<br>";
                    else if(in_array("Email tidak sama<br>", $error_array)) echo "Email tidak sama<br>"; ?>


                    <input type="password" name="reg_password" placeholder="Password" required>
                    <br>
                    <input type="password" name="reg_password2" placeholder="Confirm Password" required>
                    <br>
                    <?php if(in_array("Passwords yang dimasukan tidak sama<br>", $error_array)) echo "Passwords yang dimasukan tidak sama<br>"; 
                    else if(in_array("Passwords hanya bisa karakter huruf dan angka<br>", $error_array)) echo "Passwords hanya bisa karakter huruf dan angka<br>"; ?>


                    <input type="submit" name="register_button" value="Register">
                    <br>


                    <?php if(in_array("<span style='color: #14C800;'>Registrasi berhasil, Data anda sudah terdaftar!</span><br>", $error_array)) echo "<span style='color: #14C800;'>Registrasi berhasil, Data anda sudah terdaftar!</span><br>"; ?>

                    <a href="#" id="signin" class="signin">Sudah punya akun? Login disini!</a>
                </form>
            </div>
        </div>
	</div>


</body>
</html>
