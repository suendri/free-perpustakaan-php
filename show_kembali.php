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

$maxRows_rec_show_kembali = 10;
$pageNum_rec_show_kembali = 0;
if (isset($_GET['pageNum_rec_show_kembali'])) {
  $pageNum_rec_show_kembali = $_GET['pageNum_rec_show_kembali'];
}
$startRow_rec_show_kembali = $pageNum_rec_show_kembali * $maxRows_rec_show_kembali;

mysql_select_db($database_dbconnect, $dbconnect);
$query_rec_show_kembali = "SELECT p_transaksi.t_id as AA, p_transaksi.t_idanggota, p_transaksi.t_kdbuku as AB, p_buku.b_kode as AC, p_buku.b_judul as AD, p_buku.b_penerbit as AE, p_transaksi.t_jumlah as AF, p_transaksi.t_tgl1 as AH, p_transaksi.t_tgl2 as AI,p_transaksi.t_kembali as AJ, p_transaksi.t_jmlDenda as AL, p_anggota.a_id, p_anggota.a_nama as AK FROM p_transaksi,p_anggota,p_buku WHERE p_transaksi.t_idanggota=p_anggota.a_id AND p_buku.b_kode=p_transaksi.t_kdbuku AND p_transaksi.t_kembali='N' ORDER BY p_transaksi.t_id DESC";
$query_limit_rec_show_kembali = sprintf("%s LIMIT %d, %d", $query_rec_show_kembali, $startRow_rec_show_kembali, $maxRows_rec_show_kembali);
$rec_show_kembali = mysql_query($query_limit_rec_show_kembali, $dbconnect) or die(mysql_error());
$row_rec_show_kembali = mysql_fetch_assoc($rec_show_kembali);

if (isset($_GET['totalRows_rec_show_kembali'])) {
  $totalRows_rec_show_kembali = $_GET['totalRows_rec_show_kembali'];
} else {
  $all_rec_show_kembali = mysql_query($query_rec_show_kembali);
  $totalRows_rec_show_kembali = mysql_num_rows($all_rec_show_kembali);
}
$totalPages_rec_show_kembali = ceil($totalRows_rec_show_kembali/$maxRows_rec_show_kembali)-1;

$queryString_rec_show_kembali = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rec_show_kembali") == false && 
        stristr($param, "totalRows_rec_show_kembali") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rec_show_kembali = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rec_show_kembali = sprintf("&totalRows_rec_show_kembali=%d%s", $totalRows_rec_show_kembali, $queryString_rec_show_kembali);
?>

<h2>Pengembalian</h2>
<div class="well">Daftar berikut merupakan Buku yang belum kembali, klik tanda <img src="images/proses.png" width="16" height="16" border="0" /> untuk Proses pengembalian.</div>
<table class="gridtable" border="0" cellpadding="2">
  <tr>
    <th>No</th>
  	<th>Peminjam</th>
    <th>Kode Buku</th>
    <th>Nama Buku</th>
    <th>Penerbit</th>
    <th>Jumlah</th>
    <th>Tanggal Pinjam</th>
    <th>Tanggal Kembali</th>
    <th>Proses</th>
    <th>Detail</th>
  </tr>
  <?php $no=0; do { $no++;?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $row_rec_show_kembali['AK']; ?></td>
      <td><?php echo $row_rec_show_kembali['AB']; ?></td>
      <td><?php echo $row_rec_show_kembali['AD']; ?></td>
      <td><?php echo $row_rec_show_kembali['AE']; ?></td>
      <td><?php echo $row_rec_show_kembali['AF']; ?></td>
      <td><?php echo $row_rec_show_kembali['AH']; ?></td>
      <td><?php echo $row_rec_show_kembali['AI']; ?></td>
      <td><a href="index.php?main=edit_kembali&amp;t_id=<?php echo $row_rec_show_kembali['AA']; ?>"><img src="images/proses.png" width="16" height="16" border="0" /></a></td>
      <td>
	  <?php $kembali=$row_rec_show_kembali['AJ'];
	  	echo "<img src='images/t_".$kembali.".png' border='0' />";
	  ?>
	  </td>
    </tr>
    <?php } while ($row_rec_show_kembali = mysql_fetch_assoc($rec_show_kembali)); ?>
</table>

<table border="0">
  <tr>
    <td><?php if ($pageNum_rec_show_kembali > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_rec_show_kembali=%d%s", $currentPage, 0, $queryString_rec_show_kembali); ?>"><< First |</a>
          <?php } // Show if not first page ?>
    </td>
    <td><?php if ($pageNum_rec_show_kembali > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_rec_show_kembali=%d%s", $currentPage, max(0, $pageNum_rec_show_kembali - 1), $queryString_rec_show_kembali); ?>"> < Previous |</a>
          <?php } // Show if not first page ?>
    </td>
    <td><?php if ($pageNum_rec_show_kembali < $totalPages_rec_show_kembali) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_rec_show_kembali=%d%s", $currentPage, min($totalPages_rec_show_kembali, $pageNum_rec_show_kembali + 1), $queryString_rec_show_kembali); ?>"> Next > |</a>
          <?php } // Show if not last page ?>
    </td>
    <td><?php if ($pageNum_rec_show_kembali < $totalPages_rec_show_kembali) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_rec_show_kembali=%d%s", $currentPage, $totalPages_rec_show_kembali, $queryString_rec_show_kembali); ?>"> Last >></a>
          <?php } // Show if not last page ?>
    </td>
  </tr>
</table>
<p><img src="images/t_N.png" width="16" height="16" /> Belum Kembali</p>
