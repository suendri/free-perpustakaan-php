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
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE p_buku SET b_judul=%s, b_penulis=%s, b_penerbit=%s, b_tahun=%s, b_stock=%s, b_rak=%s WHERE b_id=%s",
                       GetSQLValueString($_POST['b_judul'], "text"),
                       GetSQLValueString($_POST['b_penulis'], "text"),
                       GetSQLValueString($_POST['b_penerbit'], "text"),
                       GetSQLValueString($_POST['b_tahun'], "int"),
                       GetSQLValueString($_POST['b_stock'], "int"),
                       GetSQLValueString($_POST['b_rak'], "text"),
                       GetSQLValueString($_POST['b_id'], "int"));

  mysql_select_db($database_dbconnect, $dbconnect);
  $Result1 = mysql_query($updateSQL, $dbconnect) or die(mysql_error());
}

$colname_rec_edit_buku = "-1";
if (isset($_GET['b_id'])) {
  $colname_rec_edit_buku = $_GET['b_id'];
}
mysql_select_db($database_dbconnect, $dbconnect);
$query_rec_edit_buku = sprintf("SELECT * FROM p_buku WHERE b_id = %s", GetSQLValueString($colname_rec_edit_buku, "int"));
$rec_edit_buku = mysql_query($query_rec_edit_buku, $dbconnect) or die(mysql_error());
$row_rec_edit_buku = mysql_fetch_assoc($rec_edit_buku);
$totalRows_rec_edit_buku = mysql_num_rows($rec_edit_buku);
?>

<h2>Edit Buku</h2>
<form class="well" action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Kode :</td>
      <td><b><?php echo htmlentities($row_rec_edit_buku['b_kode'], ENT_COMPAT, 'utf-8'); ?></b></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Judul :</td>
      <td><input type="text" name="b_judul" value="<?php echo htmlentities($row_rec_edit_buku['b_judul'], ENT_COMPAT, 'utf-8'); ?>" size="50" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Penulis :</td>
      <td><input type="text" name="b_penulis" value="<?php echo htmlentities($row_rec_edit_buku['b_penulis'], ENT_COMPAT, 'utf-8'); ?>" size="50" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Penerbit :</td>
      <td><input type="text" name="b_penerbit" value="<?php echo htmlentities($row_rec_edit_buku['b_penerbit'], ENT_COMPAT, 'utf-8'); ?>" size="50" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Tahun :</td>
      <td><input type="text" name="b_tahun" value="<?php echo htmlentities($row_rec_edit_buku['b_tahun'], ENT_COMPAT, 'utf-8'); ?>" size="10" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Jumlah :</td>
      <td><input type="text" name="b_stock" value="<?php echo htmlentities($row_rec_edit_buku['b_stock'], ENT_COMPAT, 'utf-8'); ?>" size="10" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Rak :</td>
      <td><input type="text" name="b_rak" value="<?php echo htmlentities($row_rec_edit_buku['b_rak'], ENT_COMPAT, 'utf-8'); ?>" size="10" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input class="btn btn-info" name="Submit" type="submit" value="Simpan" />
      <input class="btn btn-info" type="button" name="button" id="button" value="Kembali" onClick="location='index.php?main=show_buku'"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="b_id" value="<?php echo $row_rec_edit_buku['b_id']; ?>" />
</form>
