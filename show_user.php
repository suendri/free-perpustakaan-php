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

if ((isset($_GET['p_id'])) && ($_GET['p_id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM p_user WHERE p_id=%s",
                       GetSQLValueString($_GET['p_id'], "int"));

  mysql_select_db($database_dbconnect, $dbconnect);
  $Result1 = mysql_query($deleteSQL, $dbconnect) or die(mysql_error());
}

$maxRows_rec_show_user = 10;
$pageNum_rec_show_user = 0;
if (isset($_GET['pageNum_rec_show_user'])) {
  $pageNum_rec_show_user = $_GET['pageNum_rec_show_user'];
}
$startRow_rec_show_user = $pageNum_rec_show_user * $maxRows_rec_show_user;

mysql_select_db($database_dbconnect, $dbconnect);
$query_rec_show_user = "SELECT * FROM p_user ORDER BY p_id ASC";
$query_limit_rec_show_user = sprintf("%s LIMIT %d, %d", $query_rec_show_user, $startRow_rec_show_user, $maxRows_rec_show_user);
$rec_show_user = mysql_query($query_limit_rec_show_user, $dbconnect) or die(mysql_error());
$row_rec_show_user = mysql_fetch_assoc($rec_show_user);

if (isset($_GET['totalRows_rec_show_user'])) {
  $totalRows_rec_show_user = $_GET['totalRows_rec_show_user'];
} else {
  $all_rec_show_user = mysql_query($query_rec_show_user);
  $totalRows_rec_show_user = mysql_num_rows($all_rec_show_user);
}
$totalPages_rec_show_user = ceil($totalRows_rec_show_user/$maxRows_rec_show_user)-1;

$queryString_rec_show_user = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rec_show_user") == false && 
        stristr($param, "totalRows_rec_show_user") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rec_show_user = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rec_show_user = sprintf("&totalRows_rec_show_user=%d%s", $totalRows_rec_show_user, $queryString_rec_show_user);

?>

<h2>User <a class="btn btn-default" href="index.php?main=add_user">Tambah User</a></h2>
<table width="50%" border="0" class="gridtable">
  <tr>
    <th>No</th>
    <th>Username</th>
    <th>Level</th>
    <th>Nonaktif</th>
    <th colspan="2">Aksi</th>
  </tr>
  <?php $no=0; do { $no++;?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $row_rec_show_user['p_uname']; ?></td>
      <td><?php echo $row_rec_show_user['p_level']; ?></td>
      <td><img src="images/<?php echo $row_rec_show_user['p_nonaktif']; ?>.gif" border="0" /></td>
      <td><a href="index.php?main=edit_user&amp;p_id=<?php echo $row_rec_show_user['p_id']; ?>"><img src="images/edit2.png" border="0" /></a></td>
      <td><a href="index.php?main=show_user&amp;p_id=<?php echo $row_rec_show_user['p_id']; ?>"><img src="images/delete2.png" border="0" /></a></td>
  </tr>
    <?php } while ($row_rec_show_user = mysql_fetch_assoc($rec_show_user)); ?>
</table>

<table border="0">
  <tr>
    <td><?php if ($pageNum_rec_show_user > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_rec_show_user=%d%s", $currentPage, 0, $queryString_rec_show_user); ?>"><< First</a>
          <?php } // Show if not first page ?>
    </td>
    <td><?php if ($pageNum_rec_show_user > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_rec_show_user=%d%s", $currentPage, max(0, $pageNum_rec_show_user - 1), $queryString_rec_show_user); ?>">< Previous</a>
          <?php } // Show if not first page ?>
    </td>
    <td><?php if ($pageNum_rec_show_user < $totalPages_rec_show_user) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_rec_show_user=%d%s", $currentPage, min($totalPages_rec_show_user, $pageNum_rec_show_user + 1), $queryString_rec_show_user); ?>">Next ></a>
          <?php } // Show if not last page ?>
    </td>
    <td><?php if ($pageNum_rec_show_user < $totalPages_rec_show_user) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_rec_show_user=%d%s", $currentPage, $totalPages_rec_show_user, $queryString_rec_show_user); ?>">Last >></a>
          <?php } // Show if not last page ?>
    </td>
  </tr>
</table>
<p>
Records : <?php echo ($startRow_rec_show_user + 1) ?> to <?php echo min($startRow_rec_show_user + $maxRows_rec_show_user, $totalRows_rec_show_user) ?> of <?php echo $totalRows_rec_show_user ?></p>
