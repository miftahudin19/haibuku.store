<?php
require 'config/config.php';
error_reporting(E_ALL);
$title	='data buku';
if (isset($_POST['submit'])) {
    $buku = $_POST['nama_buku'];
    $kategori = $_POST['kategori'];
    $jual = $_POST['harga_jual'];
    $beli = $_POST['harga_beli'];
    $stok = $_POST['stok'];
    $deskripsi = $_POST['deskripsi'];
    $file_gambar = $_FILES['file_gambar'];
    $gambar = null;
    if ($file_gambar['error'] ==0) {
        $filename = str_replace('','_', $file_gambar['name']);
        $destination = dirname(__FILE__).'/bahan/images/book/'.$filename;
        if (move_uploaded_file($file_gambar['tmp_name'],$destination)) {
            $gambar ='bahan/images/book/'.$filename;
        }
    }
	$sql = 'INSERT INTO buku (nama_buku,id_kategori,harga_jual,harga_beli,stok,deskripsi,gambar)';
	$sql .="VALUE ('{$buku}','{$kategori}','{$jual}','{$beli}','{$stok}','{$deskripsi}','{$gambar}')";
	$result = mysqli_query($con, $sql);
	if (!$result){
	die(mysqli_error($con));
	}
	header('location: data_buku.php');
	}
	include('header_admin.php');
    //include_once('sidebar.php');
 ?>
<div class="content_a">
    <div class="daftar">
        <div class="main">
            <h2>Tambah Buku</h2>
            <form class="tbuku" action="form_buku.php" method="post" enctype="multipart/form-data" >
            <div class="input">
                <label>Judul Buku</label>
                <input type="text" name="nama_buku" />
            </div>
            <div class="input">
            <label>Kategori</label>
            <select name="kategori">
                <?php
                include_once 'config/config.php';
                $sql = 'SELECT * FROM kategori';
                $result = mysqli_query($con, $sql);
                ?>
                <?php
                while ($row = mysqli_fetch_array($result)):
                ?>
                <option value="<?php echo $row ['id_kategori'];?>"><?php echo $row['nama_kategori'];?> </option>
                <?php endwhile; ?>
            </select>
            </div>
            <div class="input">
                <label>Harga Jual</label>
                <input type="text" name="harga_jual" />
            </div>
            <div class="input">
                <label>Harga Beli</label>
                <input type="text" name="harga_beli" />
            </div>
            <div class="input">
                <label>Stok</label>
                <input type="text" name="stok" />
            </div>
            <div class="input">
                <label>Deskripsi</label>
                <textarea type="text" name="deskripsi"></textarea>
            </div>
            <div class="input">
                <label>File Gambar</label>
                <input type="file" name="file_gambar" />
            </div>
            <div class="submit">
                <input type="submit" class="btn btn-large" name="submit" value="simpan" />
            </div>
            </form>
        </div>
    </div>
</div>
<?php
include ('footer.php');
?>