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

$maxRows_rec_show_anggota = 10;
$pageNum_rec_show_anggota = 0;
if (isset($_GET['pageNum_rec_show_anggota'])) {
  $pageNum_rec_show_anggota = $_GET['pageNum_rec_show_anggota'];
}
$startRow_rec_show_anggota = $pageNum_rec_show_anggota * $maxRows_rec_show_anggota;

mysql_select_db($database_dbconnect, $dbconnect);
$query_rec_show_anggota = "SELECT * FROM p_anggota";
$query_limit_rec_show_anggota = sprintf("%s LIMIT %d, %d", $query_rec_show_anggota, $startRow_rec_show_anggota, $maxRows_rec_show_anggota);
$rec_show_anggota = mysql_query($query_limit_rec_show_anggota, $dbconnect) or die(mysql_error());
$row_rec_show_anggota = mysql_fetch_assoc($rec_show_anggota);

if (isset($_GET['totalRows_rec_show_anggota'])) {
  $totalRows_rec_show_anggota = $_GET['totalRows_rec_show_anggota'];
} else {
  $all_rec_show_anggota = mysql_query($query_rec_show_anggota);
  $totalRows_rec_show_anggota = mysql_num_rows($all_rec_show_anggota);
}
$totalPages_rec_show_anggota = ceil($totalRows_rec_show_anggota/$maxRows_rec_show_anggota)-1;

$queryString_rec_show_anggota = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rec_show_anggota") == false && 
        stristr($param, "totalRows_rec_show_anggota") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rec_show_anggota = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rec_show_anggota = sprintf("&totalRows_rec_show_anggota=%d%s", $totalRows_rec_show_anggota, $queryString_rec_show_anggota);
?>

<h2>Master Anggota <a class="btn btn-default" href="index.php?main=add_anggota">Tambah Anggota</a> <a class="btn btn-default" href="index.php?main=cari_anggota">Cari Anggota </a></h2>
<table class="gridtable" border="0" cellpadding="2">
  <tr>
    <th>ID</th>
    <th>Nama</th>
    <th>Tempat/Tgl Lahir</th>
    <th>Jenis Kelamin</th>
    <th>Alamat</th>
    <th>No Hp</th>
    <th>deskripsi</th>
    <th>Nonaktif</th>
    <th>Aksi</th>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_rec_show_anggota['a_id']; ?></td>
      <td><?php echo $row_rec_show_anggota['a_nama']; ?></td>
      <td><?php echo $row_rec_show_anggota['a_ttl']; ?></td>
      <td><?php echo $row_rec_show_anggota['a_jk']; ?></td>
      <td><?php echo $row_rec_show_anggota['a_alamat']; ?></td>
      <td><?php echo $row_rec_show_anggota['a_hp']; ?></td>
      <td><?php echo $row_rec_show_anggota['a_ket']; ?></td>
      <td><img src="images/<?php echo $row_rec_show_anggota['a_nonaktif']; ?>.gif" border="0" /></td>
      <td><a href="index.php?main=edit_anggota&amp;a_id=<?php echo $row_rec_show_anggota['a_id']; ?>"><img src="images/edit2.png" border="0" /></a></td>
    </tr>
    <?php } while ($row_rec_show_anggota = mysql_fetch_assoc($rec_show_anggota)); ?>
</table>

<table border="0">
  <tr>
    <td><?php if ($pageNum_rec_show_anggota > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_rec_show_anggota=%d%s", $currentPage, 0, $queryString_rec_show_anggota); ?>"><< First</a>
          <?php } // Show if not first page ?>
    </td>
    <td><?php if ($pageNum_rec_show_anggota > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_rec_show_anggota=%d%s", $currentPage, max(0, $pageNum_rec_show_anggota - 1), $queryString_rec_show_anggota); ?>">< Previous</a>
          <?php } // Show if not first page ?>
    </td>
    <td><?php if ($pageNum_rec_show_anggota < $totalPages_rec_show_anggota) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_rec_show_anggota=%d%s", $currentPage, min($totalPages_rec_show_anggota, $pageNum_rec_show_anggota + 1), $queryString_rec_show_anggota); ?>">Next ></a>
          <?php } // Show if not last page ?>
    </td>
    <td><?php if ($pageNum_rec_show_anggota < $totalPages_rec_show_anggota) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_rec_show_anggota=%d%s", $currentPage, $totalPages_rec_show_anggota, $queryString_rec_show_anggota); ?>">Last >></a>
          <?php } // Show if not last page ?>
    </td>
  </tr>
</table>
<p>
Records : <?php echo ($startRow_rec_show_anggota + 1) ?> to <?php echo min($startRow_rec_show_anggota + $maxRows_rec_show_anggota, $totalRows_rec_show_anggota) ?> of <?php echo $totalRows_rec_show_anggota ?></p>
