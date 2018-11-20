<?php require_once('Connections/dbconnect.php'); 

$colname_rec_cari_buku = "-1";
if (isset($_GET['katakunci'])) {
  $colname_rec_cari_buku = $_GET['katakunci'];
}
mysql_select_db($database_dbconnect, $dbconnect);
$query_rec_cari_buku = sprintf("SELECT * FROM p_buku WHERE b_kode LIKE %s", GetSQLValueString("%" . $colname_rec_cari_buku . "%", "text"));
$rec_cari_buku = mysql_query($query_rec_cari_buku, $dbconnect) or die(mysql_error());
$row_rec_cari_buku = mysql_fetch_assoc($rec_cari_buku);
$totalRows_rec_cari_buku = mysql_num_rows($rec_cari_buku);
?>
<h2>Pencarian Buku</h2>
<div class="well">Masukkan Kode Buku dan Klik Cari</div>
<form class="well" id="form1" name="form1" method="get" action="">
  <input type="hidden" name="main" value="cari_buku">
  Kode Buku : <input type="text" name="katakunci" id="katakunci" />
  <input type="submit" class="btn btn-primary" name="button" id="button" value="cari" />
</form>

<?php if ($totalRows_rec_cari_buku > 0) { // Show if recordset not empty ?>
  <table class="gridtable" border="1">
    <tr>
    <th>No</th>
    <th>Kode</th>
    <th>Judul</th>
    <th>Penulis</th>
    <th>Penerbit</th>
    <th>Tahun</th>
    <th>Jumlah</th>
    <th>Stock</th>
    <th>Rak</th>
    </tr>
    <?php $no=0; do { $no++?>
        <tr>
          <td><?php echo $no; ?></td>
          <td><?php echo $row_rec_cari_buku['b_kode']; ?></td>
          <td><?php echo $row_rec_cari_buku['b_judul']; ?></td>
          <td><?php echo $row_rec_cari_buku['b_penulis']; ?></td>
          <td><?php echo $row_rec_cari_buku['b_penerbit']; ?></td>
          <td><?php echo $row_rec_cari_buku['b_tahun']; ?></td>
          <td><?php echo $row_rec_cari_buku['b_jumlah']; ?></td>
          <td><?php echo $row_rec_cari_buku['b_stock']; ?></td>
          <td><?php echo $row_rec_cari_buku['b_rak']; ?></td>
        </tr>
        <?php } while ($row_rec_cari_buku = mysql_fetch_assoc($rec_cari_buku)); ?>
  </table>
  <?php } // Show if recordset not empty ?>
<?php if ($totalRows_rec_cari_buku == 0) { // Show if recordset empty ?>
  <div style="color:red">Kode Buku Tidak Ditemukan!</div>
  <?php } // Show if recordset empty ?>

<?php
mysql_free_result($rec_cari_buku);
?>
