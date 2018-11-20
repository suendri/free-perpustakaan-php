<?php require_once('Connections/dbconnect.php'); 

$colname_rec_cari_anggota = "-1";
if (isset($_GET['katakunci'])) {
  $colname_rec_cari_anggota = $_GET['katakunci'];
}
mysql_select_db($database_dbconnect, $dbconnect);
$query_rec_cari_anggota = sprintf("SELECT * FROM p_anggota WHERE a_nama LIKE %s", GetSQLValueString("%" . $colname_rec_cari_anggota . "%", "text"));
$rec_cari_anggota = mysql_query($query_rec_cari_anggota, $dbconnect) or die(mysql_error());
$row_rec_cari_anggota = mysql_fetch_assoc($rec_cari_anggota);
$totalRows_rec_cari_anggota = mysql_num_rows($rec_cari_anggota);
?>

<h2>Pencarian Anggota</h2>
<div class="well">Masukkan Nama Anggota dan Klik Cari</div>
<form class="well" id="form1" name="form1" method="get" action="">
<input type="hidden" name="main" value="cari_anggota">
  Cari Nama : <input type="text" name="katakunci" id="katakunci" />
  <input type="submit" class="btn btn-primary" name="button" id="button" value="Cari" />
</form>

<?php if ($totalRows_rec_cari_anggota > 0) { // Show if recordset not empty ?>
  <table class="gridtable" border="1">
    <tr>
     <th>ID</th>
    <th>Nama</th>
    <th>Tempat/Tgl Lahir</th>
    <th>Jenis Kelamin</th>
    <th>Alamat</th>
    <th>No Hp</th>
    <th>deskripsi</th>
    <th>Nonaktif</th>
    </tr>
    <?php do { ?>
        <tr>
          <td><?php echo $row_rec_cari_anggota['a_id']; ?></td>
          <td><?php echo $row_rec_cari_anggota['a_nama']; ?></td>
          <td><?php echo $row_rec_cari_anggota['a_ttl']; ?></td>
          <td><?php echo $row_rec_cari_anggota['a_jk']; ?></td>
          <td><?php echo $row_rec_cari_anggota['a_alamat']; ?></td>
          <td><?php echo $row_rec_cari_anggota['a_hp']; ?></td>
          <td><?php echo $row_rec_cari_anggota['a_ket']; ?></td>
          <td><?php echo $row_rec_cari_anggota['a_nonaktif']; ?></td>
        </tr>
        <?php } while ($row_rec_cari_anggota = mysql_fetch_assoc($rec_cari_anggota)); ?>
  </table>
  <?php } // Show if recordset not empty ?>
<?php if ($totalRows_rec_cari_anggota == 0) { // Show if recordset empty ?>
    <div style="color:red">Anggota Tidak Ditemukan!</div>
  <?php } // Show if recordset empty ?>
</body>
</html>
<?php
mysql_free_result($rec_cari_anggota);
?>
