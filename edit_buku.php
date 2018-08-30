<?php
require 'config/config.php';
error_reporting(E_ALL);
$title = 'data buku';
if (isset($_POST['submit'])) 
{
    $id= $_POST['id'];
    $nama= $_POST['nama_buku'];
    $kategori= $_POST['kategori'];
    $harga_jual= $_POST['harga_jual'];
    $harga_beli= $_POST['harga_beli'];
    $stok= $_POST['stok'];
    $deskripsi= $_POST['deskripsi'];
    $file_gambar= $_FILES['file_gambar'];
    $gambar = null;

    if ($file_gambar['error'] ==0) {
        $filename = str_replace('','_', $file_gambar['name']);
        $destination = dirname(__FILE__).'/bahan/images/book/'.$filename;
        if (move_uploaded_file($file_gambar['tmp_name'],$destination)) {
            $gambar ='bahan/images/book/'.$filename;
        }
    }
    $sql = 'UPDATE buku SET ';
    $sql .="nama_buku = '{$nama}', id_kategori = '{$kategori}', deskripsi= '{$deskripsi}',";
    $sql .= "harga_jual='{$harga_jual}', harga_beli='{$harga_beli}', stok='{$stok}'";
        if (!empty($gambar))
        $sql .= ", gambar='{$gambar}' ";
        $sql .= "WHERE id_buku ='{$id}'";
        $result = mysqli_query($con, $sql);
        if (!$result) die(mysqli_error($con));
        header ('location: data_buku.php');
}

$id = ''; 
if( isset( $_GET['id']))
    $id = $_GET['id']; 
$sql = "SELECT * FROM buku WHERE id_buku = '{$id}'";
$result = mysqli_query($con, $sql);
if (!$result) die('Error: Data tidak tersedia');
$data = mysqli_fetch_array($result);
function is_select($var, $val) { 
        if($var == $val) return 'selected="selected"'; 
        return false;}

include ('header_admin.php');
//include ('sidebar.php');
?>
<div class="content_a">
    <div class="daftar">
        <div class="main">
        <h2> Edit Buku</h2>
        <form class="" action="edit_buku.php" method="post" enctype="multipart/form-data" >
            <div class="input">
            <label>Judul Buku</label>
            <input type="text" name="nama_buku" value="<?php echo $data['nama_buku']; ?>" />
            </div>
            <div class="input">
            <label>Kategori</label>
            <select name="kategori">
            <?php
            include_once 'config/config.php';
            $sql = 'SELECT * From kategori';
            $result = mysqli_query($con, $sql);
            ?>
            <?php while ($row = mysqli_fetch_array($result)): ?>
            <option value="<?php echo $row['id_kategori'];?>"> <?php echo $row['nama_kategori'];?></option>
            <?php endwhile; ?></select>
            </div>
            <div class="input">
            <label>Harga Jual</label>
            <input type="text" name="harga_jual" value="<?php echo $data['harga_jual'];?>" />
            </div>
            <div class="input">
            <label>Harga Beli</label>
            <input type="text" name="harga_beli" value="<?php echo $data['harga_beli'];?>" />
            </div>
            <div class="input">
            <label>Deskripsi</label>
            <textarea type="text" name="deskripsi" > <?php echo $data['deskripsi']; ?> </textarea>
            </div>
            <div class="input">
            <label>Stok</label>
            <input type="text" name="stok" value="<?php echo $data['stok'];?> " />
            </div>
            <div class="input">
            <label>File Gambar</label>
            <input type="file" name="file_gambar" />
            </div>
            <div class="submit">
            <input type="hidden" name="id" value="<?php echo $data['id_buku']; ?> " />
            <input type="submit" name="submit" class="btn btn-large" value="Edit" />
            </div>
        </form>
        </div>
    </div>
</div>
<?php include_once ('footer.php'); ?>