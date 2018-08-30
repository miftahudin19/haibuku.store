<?php 
require 'config/config.php';
$tittle = 'data users';
$sql = 'select * from users';
$result	= mysqli_query($con, $sql);

 include_once('header_admin.php');
 //include_once('sidebar.php');
 ?>
 <div class="content_a">
 	<div class="main-kategori">
 		<?php 
 		//echo '<a href="form_kategori.php" class="btn btn-large">Tambah Kategori</a>';
 		 ?>
 		<table>
 		    <th class="jd">Photo Profile</th>
 			<th class="jd">Nama Depan</th>
 			<th class="jd">Nama Belakang</th>
 			<th class="jd">Username</th>
 			<th class="jd">Email</th>
 			<th class="jd">Tanggal Daftar</th>
 			<th class="jd">Aksi</th>
 			<?php while ($row = mysqli_fetch_array($result)):?>
 			<tr>
 			    <td><?php echo "<img src=\"{$row['profile_pic']}\" />";?></td>
 				<td><?php echo $row['first_name']; ?></td>
 				<td><?php echo $row['last_name']; ?></td>
 				<td><?php echo $row['username']; ?></td>
 				<td><?php echo $row['email']; ?></td>
 				<td><?php echo $row['signup_date']; ?></td>
 				<td>
 					<a class="btn btn-default" href="edit_user.php?id=<?php echo $row['id']; ?>">Edit</a>
 					<!--<a class="btn btn-alert" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" href="hapus_user.php?id=<?php //echo $row['id']; ?>">Delete</a>-->
 			</tr>
 		<?php endwhile; ?>
 		</table>
 	</div>
 </div>
 <?php include_once('footer.php'); ?>
 
