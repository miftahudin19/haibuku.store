<?php
$q="";
if(isset($_GET['submit'])&& !empty($_GET['q'])){
  $q= $_GET['q'];
  $sql_where = " WHERE nama_buku LIKE '{$q}%'";
}
$title = 'data buku';
include_once 'config/config.php';
$sql = 'SELECT b.id_buku,
				b.id_kategori,
				b.gambar,
				b.nama_buku,
				k.nama_kategori,
				b.harga_jual,
				b.harga_beli,
				b.stok,
				b.deskripsi 
				FROM buku b 
				JOIN kategori k 
				on b.id_kategori = k.id_kategori';
$sql_count = "SELECT COUNT(*) FROM buku";
if(isset($sql_where)) {
	$sql .= $sql_where;
	$sql_count .= $sql_where;
}
$result_count = mysqli_query($con, $sql_count);
$count = 0;
if($result_count) {
	$r_data = mysqli_fetch_row($result_count);
	$count = $r_data[0];
}
$per_page = 4;
$num_page = ceil($count / $per_page);
$limit = $per_page;
if(isset($_GET['page'])) {
	$page = $_GET['page'];
	$offset = ($page - 1) * $per_page;
} else {
	$offset = 0;
	$page = 1;
}
$sql .= " LIMIT {$offset}, {$limit}";
$result = mysqli_query($con, $sql);
include 'header_admin.php';
//include 'sidebar.php';
?>

<div class="content_b">
	<div class="main">
	<form action="" method="get">
	<label for="q">Cari Data : </label>
	<input type="text" id="q" name="q" class="input-q" value="<?php echo $q ?>">
	<input type="submit" name="submit" value="Cari Buku" class="btn btn-primary">
	<?php echo '<a href="form_buku.php?id=" class="btn btn-large">Tambah Buku</a>'; ?>
	</form>
	<?php
	if ($result): ?>
	<table>
		<tr>
			<th>Gambar</th>
			<th>Nama Barang</th>
			<th>Kategori</th>
			<th>Harga Jual</th>
			<th>Harga Beli</th>
			<th>Stok</th>
			<th>Deskripsi</th>
			<th>Aksi</th>
		</tr>
		<?php while($row = mysqli_fetch_array($result)): ?>
		<tr>
			<td><?php echo "<img src=\"{$row['gambar']}\" />";?></td>
			<td><?php echo $row['nama_buku']; ?></td>
			<td><?php echo $row['nama_kategori']; ?></td>
			<td class="right"><?php echo number_format($row['harga_jual'],2,',','.'); ?></td>
			<td class="right"><?php echo number_format($row['harga_beli'],2,',','.'); ?></td>
			<td class="right"><?php echo $row['stok']; ?></td>
			<td> <?php echo $row['deskripsi']; ?></td>
			<td class="center"> 
				<a class="btn btn-default" href="edit_buku.php?id=<?php echo $row['id_buku']; ?>"> Edit <a/>
				<a class="btn btn-alert" onclick="return confirm('Yakin ingin menghapus data ini ?');" href="hapus_buku.php?id=<?php echo $row['id_buku']; ?>"> Delete <a/></td>
		</tr>
		<?php endwhile; ?>
	</table>
	<ul class="pagination">
		<li><a href="data_buku.php?page=<?php echo $page-1; ?>">&laquo;</a></li>
			<?php for ($i=1;$i <= $num_page; $i++) {
			$link = "?page={$i}";
			if (!empty($q)) $link .="&q={$q}";
			$class =($page == $i ? 'active':'');
			echo "<li><a class=\"{$class}\" href=\"{$link}\">{$i}</a></li>";
			} ?>
		<li>
			<a href="">...</a>
			<a href="">9</a>
			<a href="">10</a>
			<a href="">11</a></li>
		<li><a href="data_buku.php?page=<?php echo $page+1;?>">&raquo;</a></li>
			<?php for ($i=1; $i <= $num_page; $i++) {
				$link = "?page={$i}";
				if (!empty ($sql)) $link .="&q{$q}";
				$class =($page == $i ? 'active':'');
			} ?>
	</ul>
		<?php endif; ?>
	</div>
</div>
<?php include_once 'footer.php'; ?>