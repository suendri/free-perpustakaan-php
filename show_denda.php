<?php require_once('Connections/dbconnect.php'); 

$maxRows_rec_show_denda = 10;
$pageNum_rec_show_denda = 0;
if (isset($_GET['pageNum_rec_show_denda'])) {
  $pageNum_rec_show_denda = $_GET['pageNum_rec_show_denda'];
}
$startRow_rec_show_denda = $pageNum_rec_show_denda * $maxRows_rec_show_denda;

mysql_select_db($database_dbconnect, $dbconnect);
$query_rec_show_denda = "SELECT * FROM p_denda";
$query_limit_rec_show_denda = sprintf("%s LIMIT %d, %d", $query_rec_show_denda, $startRow_rec_show_denda, $maxRows_rec_show_denda);
$rec_show_denda = mysql_query($query_limit_rec_show_denda, $dbconnect) or die(mysql_error());
$row_rec_show_denda = mysql_fetch_assoc($rec_show_denda);

if (isset($_GET['totalRows_rec_show_denda'])) {
  $totalRows_rec_show_denda = $_GET['totalRows_rec_show_denda'];
} else {
  $all_rec_show_denda = mysql_query($query_rec_show_denda);
  $totalRows_rec_show_denda = mysql_num_rows($all_rec_show_denda);
}
$totalPages_rec_show_denda = ceil($totalRows_rec_show_denda/$maxRows_rec_show_denda)-1;
?>

<h2>Master Denda <a class="btn btn-default" href="index.php?main=add_denda">Tambah Denda</a></h2>
<table class="gridtable" border="0">
  <tr>
    <th>#</th>
    <th>Kategori</th>
    <th>Jumlah Denda</th>
    <th>Aktif</th>
    <th colspan="2">Aksi</th>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_rec_show_denda['d_ID']; ?></td>
      <td><?php echo $row_rec_show_denda['d_kategori']; ?></td>
      <td><?php echo $row_rec_show_denda['d_juml']; ?></td>
      <td><img src="images/<?php echo $row_rec_show_denda['d_aktif']; ?>.gif" border="0" alt="[IMG]" /></td>
      <td><a href="index.php?main=edit_denda&amp;d_ID=<?php echo $row_rec_show_denda['d_ID']; ?>"><img src="images/edit2.png" width="16" height="16" /></a></td>
      <td><img src="images/delete2.png" width="16" height="16" /></td>
    </tr>
    <?php } while ($row_rec_show_denda = mysql_fetch_assoc($rec_show_denda)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($rec_show_denda);
?>
