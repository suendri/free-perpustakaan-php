<?php 
/*------------------------------------------------------------------------------
 * Program ini adalah program Donasi http://phpbego.wordpress.com
 * Anda hanya saya minta sedikit donasi untuk program ini, tidak lebih.
 * Jika anda menghargai program saya, silakan anda hubungi saya di 

 * -------------------------------------------------------------------
 * SMS : 085263616901 atau email phpbego@yahoo.co.id, phpbego@gmail.com
 * -------------------------------------------------------------------
 *
 *------------------------------------------------------------------------------
*/

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rec_show_pinjam = 10;
$pageNum_rec_show_pinjam = 0;
if (isset($_GET['pageNum_rec_show_pinjam'])) {
  $pageNum_rec_show_pinjam = $_GET['pageNum_rec_show_pinjam'];
}
$startRow_rec_show_pinjam = $pageNum_rec_show_pinjam * $maxRows_rec_show_pinjam;

mysql_select_db($database_dbconnect, $dbconnect);
$query_rec_show_pinjam = "SELECT p_transaksi.t_idanggota as AA,p_transaksi.t_kdbuku as AB, p_buku.b_kode as AC, p_buku.b_judul as AD, p_buku.b_penerbit as AE, p_transaksi.t_jumlah as AF, p_transaksi.t_tgl1 as AH, p_transaksi.t_tgl2 as AI, p_anggota.a_id as AJ, p_anggota.a_nama as AK FROM p_transaksi,p_anggota,p_buku WHERE p_transaksi.t_idanggota=p_anggota.a_id AND p_buku.b_kode=p_transaksi.t_kdbuku AND p_transaksi.t_kembali='N'";
$query_limit_rec_show_pinjam = sprintf("%s LIMIT %d, %d", $query_rec_show_pinjam, $startRow_rec_show_pinjam, $maxRows_rec_show_pinjam);
$rec_show_pinjam = mysql_query($query_limit_rec_show_pinjam, $dbconnect) or die(mysql_error());
$row_rec_show_pinjam = mysql_fetch_assoc($rec_show_pinjam);

if (isset($_GET['totalRows_rec_show_pinjam'])) {
  $totalRows_rec_show_pinjam = $_GET['totalRows_rec_show_pinjam'];
} else {
  $all_rec_show_pinjam = mysql_query($query_rec_show_pinjam);
  $totalRows_rec_show_pinjam = mysql_num_rows($all_rec_show_pinjam);
}
$totalPages_rec_show_pinjam = ceil($totalRows_rec_show_pinjam/$maxRows_rec_show_pinjam)-1;

$queryString_rec_show_pinjam = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rec_show_pinjam") == false && 
        stristr($param, "totalRows_rec_show_pinjam") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rec_show_pinjam = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rec_show_pinjam = sprintf("&totalRows_rec_show_pinjam=%d%s", $totalRows_rec_show_pinjam, $queryString_rec_show_pinjam);

//$totalPeminjam = "SELECT SUM(
?>

<h2>Daftar Buku Keluar </h2> 
<?php if ($totalRows_rec_show_pinjam > 0) { // Show if recordset not empty ?>
  <table class="gridtable" border="0" cellpadding="2">
    <tr>
      <th>No</th>
      <th>Peminjam</th>
      <th>Kode Buku</th>
      <th>Judul Buku</th>
      <th>Penerbit</th>
      <th>Jumlah</th>
      <th>Tanggal Pinjam</th>
      <th>Tanggal Kembali</th>
    </tr>
    <?php $no=0; do { $no++;?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $row_rec_show_pinjam['AK']; ?></td>
      <td><?php echo $row_rec_show_pinjam['AB']; ?></td>
      <td><?php echo $row_rec_show_pinjam['AD']; ?></td>
      <td><?php echo $row_rec_show_pinjam['AE']; ?></td>
      <td><?php echo $row_rec_show_pinjam['AF']; ?></td>
      <td><?php echo $row_rec_show_pinjam['AH']; ?></td>
      <td><?php echo $row_rec_show_pinjam['AI']; ?></td>
      </tr>
    <?php } while ($row_rec_show_pinjam = mysql_fetch_assoc($rec_show_pinjam)); ?>
  </table>
  <?php } // Show if recordset not empty ?>
<table border="0">
  <tr>
    <td><?php if ($pageNum_rec_show_pinjam > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_rec_show_pinjam=%d%s", $currentPage, 0, $queryString_rec_show_pinjam); ?>"><< First |</a>
          <?php } // Show if not first page ?>
    </td>
    <td><?php if ($pageNum_rec_show_pinjam > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_rec_show_pinjam=%d%s", $currentPage, max(0, $pageNum_rec_show_pinjam - 1), $queryString_rec_show_pinjam); ?>"> < Previous</a>
          <?php } // Show if not first page ?>
    </td>
    <td><?php if ($pageNum_rec_show_pinjam < $totalPages_rec_show_pinjam) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_rec_show_pinjam=%d%s", $currentPage, min($totalPages_rec_show_pinjam, $pageNum_rec_show_pinjam + 1), $queryString_rec_show_pinjam); ?>"> | Next ></a>
          <?php } // Show if not last page ?>
    </td>
    <td><?php if ($pageNum_rec_show_pinjam < $totalPages_rec_show_pinjam) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_rec_show_pinjam=%d%s", $currentPage, $totalPages_rec_show_pinjam, $queryString_rec_show_pinjam); ?>"> | Last >></a>
          <?php } // Show if not last page ?>
    </td>
  </tr>
</table>
<p>Total Peminjam : </p>
<p>Total Buku Keluar :</p>

<?php if ($totalRows_rec_show_pinjam == 0) { // Show if recordset empty ?>
  <p><img src="images/warning.png" border="0" /> Tidak Ada Data Peminjam!</p>
  <?php } // Show if recordset empty ?>
