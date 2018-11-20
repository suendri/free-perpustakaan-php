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

if ((isset($_GET['b_id'])) && ($_GET['b_id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM p_buku WHERE b_id=%s",
                       GetSQLValueString($_GET['b_id'], "int"));

  mysql_select_db($database_dbconnect, $dbconnect);
  $Result1 = mysql_query($deleteSQL, $dbconnect) or die(mysql_error());
}

$maxRows_rec_show_buku = 10;
$pageNum_rec_show_buku = 0;
if (isset($_GET['pageNum_rec_show_buku'])) {
  $pageNum_rec_show_buku = $_GET['pageNum_rec_show_buku'];
}
$startRow_rec_show_buku = $pageNum_rec_show_buku * $maxRows_rec_show_buku;

mysql_select_db($database_dbconnect, $dbconnect);
$query_rec_show_buku = "SELECT * FROM p_buku ORDER BY b_judul ASC";
$query_limit_rec_show_buku = sprintf("%s LIMIT %d, %d", $query_rec_show_buku, $startRow_rec_show_buku, $maxRows_rec_show_buku);
$rec_show_buku = mysql_query($query_limit_rec_show_buku, $dbconnect) or die(mysql_error());
$row_rec_show_buku = mysql_fetch_assoc($rec_show_buku);

if (isset($_GET['totalRows_rec_show_buku'])) {
  $totalRows_rec_show_buku = $_GET['totalRows_rec_show_buku'];
} else {
  $all_rec_show_buku = mysql_query($query_rec_show_buku);
  $totalRows_rec_show_buku = mysql_num_rows($all_rec_show_buku);
}
$totalPages_rec_show_buku = ceil($totalRows_rec_show_buku/$maxRows_rec_show_buku)-1;

$queryString_rec_show_buku = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rec_show_buku") == false && 
        stristr($param, "totalRows_rec_show_buku") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rec_show_buku = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rec_show_buku = sprintf("&totalRows_rec_show_buku=%d%s", $totalRows_rec_show_buku, $queryString_rec_show_buku);
?>

<h2>Master Buku <a class="btn btn-default" href="index.php?main=add_buku">Tambah Buku</a>
<a class="btn btn-default" href="index.php?main=cari_buku">Cari Buku</a></h2>
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
    <th colspan="2">Aksi</th>
  </tr>
  <?php $no=0; do { $no++;?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $row_rec_show_buku['b_kode']; ?></td>
      <td><?php echo $row_rec_show_buku['b_judul']; ?></td>
      <td><?php echo $row_rec_show_buku['b_penulis']; ?></td>
      <td><?php echo $row_rec_show_buku['b_penerbit']; ?></td>
      <td><?php echo $row_rec_show_buku['b_tahun']; ?></td>
      <td><?php echo $row_rec_show_buku['b_jumlah']; ?></td>
      <td><?php echo $row_rec_show_buku['b_stock']; ?></td>
      <td><?php echo $row_rec_show_buku['b_rak']; ?></td>
      <td><a href="index.php?main=edit_buku&amp;b_id=<?php echo $row_rec_show_buku['b_id']; ?>"><img src="images/edit2.png" border="0" /></a></td>
      <td><a href="index.php?main=show_buku&amp;b_id=<?php echo $row_rec_show_buku['b_id']; ?>"><img src="images/delete2.png" width="16" height="16" border="0" /></a></td>
    </tr>
    <?php } while ($row_rec_show_buku = mysql_fetch_assoc($rec_show_buku)); ?>
</table>

<table border="0">
  <tr>
    <td><?php if ($pageNum_rec_show_buku > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_rec_show_buku=%d%s", $currentPage, 0, $queryString_rec_show_buku); ?>"><< First</a>
          <?php } // Show if not first page ?>
    </td>
    <td><?php if ($pageNum_rec_show_buku > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_rec_show_buku=%d%s", $currentPage, max(0, $pageNum_rec_show_buku - 1), $queryString_rec_show_buku); ?>">< Previous</a>
          <?php } // Show if not first page ?>
    </td>
    <td><?php if ($pageNum_rec_show_buku < $totalPages_rec_show_buku) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_rec_show_buku=%d%s", $currentPage, min($totalPages_rec_show_buku, $pageNum_rec_show_buku + 1), $queryString_rec_show_buku); ?>">Next ></a>
          <?php } // Show if not last page ?>
    </td>
    <td><?php if ($pageNum_rec_show_buku < $totalPages_rec_show_buku) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_rec_show_buku=%d%s", $currentPage, $totalPages_rec_show_buku, $queryString_rec_show_buku); ?>">Last >></a>
          <?php } // Show if not last page ?>
    </td>
  </tr>
</table>
<p>Records : <?php echo ($startRow_rec_show_buku + 1) ?> to <?php echo min($startRow_rec_show_buku + $maxRows_rec_show_buku, $totalRows_rec_show_buku) ?> of <?php echo $totalRows_rec_show_buku ?></p>
