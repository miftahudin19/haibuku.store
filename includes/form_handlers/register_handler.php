<?php

$fname = "";
$lname = ""; 
$em = ""; 
$em2 = ""; 
$password = ""; 
$password2 = ""; 
$date = ""; 
$error_array = array(); 

if(isset($_POST['register_button'])){

	//First name
	$fname = strip_tags($_POST['reg_fname']); 
	$fname = str_replace(' ', '', $fname); 
	$fname = ucfirst(strtolower($fname)); 
	$_SESSION['reg_fname'] = $fname; 

	//Last name
	$lname = strip_tags($_POST['reg_lname']); 
	$lname = str_replace(' ', '', $lname); 
	$lname = ucfirst(strtolower($lname));
	$_SESSION['reg_lname'] = $lname;

	//email
	$em = strip_tags($_POST['reg_email']);
	$em = str_replace(' ', '', $em);
	$em = ucfirst(strtolower($em));
	$_SESSION['reg_email'] = $em;

	//email 2
	$em2 = strip_tags($_POST['reg_email2']);
	$em2 = str_replace(' ', '', $em2);
	$em2 = ucfirst(strtolower($em2));
	$_SESSION['reg_email2'] = $em2;

	//Password
	$password = strip_tags($_POST['reg_password']);
	$password2 = strip_tags($_POST['reg_password2']);

	$date = date("Y-m-d");

	if($em == $em2) {
		
		if(filter_var($em, FILTER_VALIDATE_EMAIL)) {

			$em = filter_var($em, FILTER_VALIDATE_EMAIL);
			
			$e_check = mysqli_query($con, "SELECT email FROM users WHERE email='$em'");

			$num_rows = mysqli_num_rows($e_check);

			if($num_rows > 0) {
				array_push($error_array, "Email telah terpakai<br>");
			}

		}
		else {
			array_push($error_array, "Format email salah<br>");
		}


	}
	else {
		array_push($error_array, "Email tidak sama<br>");
	}


	if(strlen($fname) > 25 || strlen($fname) < 2) {
		array_push($error_array, "Nama depan kamu harus antara 2 atau 25 karakter<br>");
	}

	if(strlen($lname) > 25 || strlen($lname) < 2) {
		array_push($error_array,  "Nama belakang kamu harus antara 2 atau 25 karakter<br>");
	}

	if($password != $password2) {
		array_push($error_array,  "Passwords yang dimasukan tidak sama<br>");
	}
	else {
		if(preg_match('/[^A-Za-z0-9]/', $password)) {
			array_push($error_array, "Passwords hanya bisa karakter huruf dan angka<br>");
		}
	}

	if(empty($error_array)) {
		$password = md5($password); 

		$username = strtolower($fname . "_" . $lname);
		$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");


		$i = 0; 
		while(mysqli_num_rows($check_username_query) != 0) {
			$i++; 
			$username = $username . "_" . $i;
			$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
		}


		$rand = rand(1, 2); 

		if($rand == 1)
			$profile_pic = "bahan/images/profile_pics/defaults/head_deep_blue.png";
		else if($rand == 2)
			$profile_pic = "bahan/images/profile_pics/defaults/head_emerald.png";


		$sql = 'INSERT INTO users (first_name, last_name, username, email, password, signup_date, profile_pic)';
                $sql .="VALUE ('{$fname}','{$lname}','{$username}','{$em}','{$password}','{$date}','{$profile_pic}')";
                $result = mysqli_query($con, $sql);
                if (!$result){
                die(mysqli_error($con));
                }
                

		array_push($error_array, "<span style='color: #14C800;'>Registrasi berhasil, Data anda sudah terdaftar!</span><br>");

		//Pembersihan session variables 
		$_SESSION['reg_fname'] = "";
		$_SESSION['reg_lname'] = "";
		$_SESSION['reg_email'] = "";
		$_SESSION['reg_email2'] = "";
	}
}
?>
