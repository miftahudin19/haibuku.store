<?php
error_reporting(E_ALL);
include('config/config.php');

$title = 'Data Buku';
$id = $_GET['id'];
$sql = "SELECT * FROM buku WHERE id_buku = '{$id}'";
$result = mysqli_query($con, $sql);
if (!$result) die('Error : Data tidak tersedia');
$data = mysqli_fetch_array($result);

function is_select($var, $val) {
    if ($var == $val) return 'selected="selected"';
    return false;
}

include('header.php')

?>

<div class="content_b">


    <div class="main">
    <table>
        <tr>
            <th>Gambar</th>
            <th>Judul Buku</th>
            <th>Harga Jual</th>
            <th>Stok</th>
            <th>Deskripsi</th>
        </tr>
        <tr>
            <td><?php echo "<img src=\"{$data['gambar']}\"/>";?></th>
            <td><?php echo $data['nama_buku']; ?></td>
			<td class="right"><?php echo number_format($data['harga_jual'],2,',','.'); ?></td>
			<td class="right"><?php echo $data['stok']; ?></td>
			<td> <?php echo $data['deskripsi']; ?></td>
        </tr>
    </table>
    <hr/>
        <div class="daftar">
        <h3>SILAHKAN ORDER</h3>
            <hr> <br/>
        <p>
        Nama : Miftahudin <br>
        No Telp : 081319309310 <br>
        No Rekening : (Mandiri) 1560010546655 <br>
        a/n Miftahudin <br>
        </p>
        </div>
    </div>
</div>
<?php include_once('footer.php') ?>