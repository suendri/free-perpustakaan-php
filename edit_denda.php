<?php require_once('Connections/dbconnect.php'); 

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE p_denda SET d_kategori=%s, d_juml=%s, d_aktif=%s WHERE d_ID=%s",
                       GetSQLValueString($_POST['d_kategori'], "text"),
                       GetSQLValueString($_POST['d_juml'], "int"),
                       GetSQLValueString($_POST['d_aktif'], "text"),
                       GetSQLValueString($_POST['d_ID'], "int"));

  mysql_select_db($database_dbconnect, $dbconnect);
  $Result1 = mysql_query($updateSQL, $dbconnect) or die(mysql_error());
}

$colname_rec_edit_denda = "-1";
if (isset($_GET['d_ID'])) {
  $colname_rec_edit_denda = $_GET['d_ID'];
}
mysql_select_db($database_dbconnect, $dbconnect);
$query_rec_edit_denda = sprintf("SELECT * FROM p_denda WHERE d_ID = %s", GetSQLValueString($colname_rec_edit_denda, "int"));
$rec_edit_denda = mysql_query($query_rec_edit_denda, $dbconnect) or die(mysql_error());
$row_rec_edit_denda = mysql_fetch_assoc($rec_edit_denda);
$totalRows_rec_edit_denda = mysql_num_rows($rec_edit_denda);
?>

<h2>Edit Denda</h2>
<form class="well" action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">ID</td>
      <td><?php echo $row_rec_edit_denda['d_ID']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Kategori</td>
      <td><input type="text" name="d_kategori" value="<?php echo htmlentities($row_rec_edit_denda['d_kategori'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Jumlah</td>
      <td><input type="text" name="d_juml" value="<?php echo htmlentities($row_rec_edit_denda['d_juml'], ENT_COMPAT, 'utf-8'); ?>" size="32" /> / Hari</td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Aktif</td>
      <td><select name="d_aktif" id="d_aktif">
        <option value="Y" <?php if (!(strcmp("Y", $row_rec_edit_denda['d_aktif']))) {echo "selected=\"selected\"";} ?>>Y</option>
        <option value="N" <?php if (!(strcmp("N", $row_rec_edit_denda['d_aktif']))) {echo "selected=\"selected\"";} ?>>N</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input class="btn btn-info" name="Submit" type="submit" value="Simpan" />
      <input class="btn btn-info" type="button" name="button" id="button" value="Kembali" onClick="location='index.php?main=show_denda'" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="d_ID" value="<?php echo $row_rec_edit_denda['d_ID']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rec_edit_denda);
?>
