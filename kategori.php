<?php 
require 'config/config.php';
$tittle = 'data kategori';
$sql = 'select * from kategori';
$result	= mysqli_query($con, $sql);

 include_once('header_admin.php');
 //include_once('sidebar.php');
 ?>
 <div class="content_a">
 	<div class="main-kate">
 		<?php 
 		echo '<a href="form_kategori.php" class="btn btn-large">Tambah Kategori</a>';
 		 ?>
 		<table>
 			<th class="jd">Nama Kategori</th>
 			<th class="jd">Aksi</th>
 			<?php while ($row = mysqli_fetch_array($result)):?>
 			<tr>
 				<td><?php echo $row['nama_kategori']; ?></td>
 				<td>
 					<a class="btn btn-default" href="edit_kategori.php?id=<?php echo $row['id_kategori']; ?>">Edit</a>
 					<a class="btn btn-alert" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" href="hapus_kategori.php?id=<?php echo $row['id_kategori']; ?>">Delete</a>
 			</tr>
 		<?php endwhile; ?>
 		</table>
 	</div>
 </div>
 <?php 
 include('footer.php'); ?>