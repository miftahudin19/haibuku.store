<!-- membuat content -->
<?php
  include_once 'config/config.php';
  //include('login_session.php');
 $q="";
if(isset($_GET['submit']) && !empty($_GET['q'])) {
	$q=$_GET['q'];
	$sql_where = "WHERE nama_buku LIKE'{$q}%'";
}
  $title = 'kategori';
  $sql = 'SELECT * FROM buku';
  $result = mysqli_query($con, $sql);
$sql = 'SELECT b.id_buku,
				b.id_kategori,
				b.gambar,
				b.nama_buku,
				k.nama_kategori,
				b.harga_jual,
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

$per_page = 6;
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
 ?>


<div class="content">
  <div class="row">
    <?php while($row = mysqli_fetch_array($result)): ?>
      <div class="box">
          <img src="<?php echo "{$row['gambar']}" ?>"  />
          <h3><?php echo $row['nama_buku']; ?></h3>
          <p>Harga : <?php echo number_format($row['harga_jual'], 2, ',', '.');?></p>
          <p><?php
              $text = $row['deskripsi'];
              $potong_text=substr($text, 0, 100);
              echo $potong_text;?>
          </p>
          <a href="view.php?id=<?php echo $row['id_buku'];?>" class="btn btn-default">View detail</a>
      </div>
      <?php endwhile; ?>
     	<div id="centerp">
	      <ul class="pagination centerpg">
			<li><a href="content.php?page=<?php echo $page-1; ?>">&laquo;</a></li>
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
			<li><a href="content.php?page=<?php echo $page+1;?>">&raquo;</a></li>
				<?php for ($i=1; $i <= $num_page; $i++) {
					$link = "?page={$i}";
					if (!empty ($sql)) $link .="&q{$q}";
					$class =($page == $i ? 'active':'');
				} ?>
			</ul>
		</div>
  </div>
</div>
