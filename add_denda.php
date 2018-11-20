<?php require_once('Connections/dbconnect.php');

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO p_denda (d_kategori, d_juml, d_aktif) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['d_kategori'], "text"),
                       GetSQLValueString($_POST['d_juml'], "int"),
                       GetSQLValueString($_POST['d_aktif'], "text"));

  mysql_select_db($database_dbconnect, $dbconnect);
  $Result1 = mysql_query($insertSQL, $dbconnect) or die(mysql_error());
}
?>
<h2>Tambah Denda</h2>
<form class="well" action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Kategori</td>
      <td><input type="text" name="d_kategori" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Jumlah</td>
      <td><input type="text" name="d_juml" value="" size="32" /> / Hari</td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Aktif</td>
      <td><select name="d_aktif" id="d_aktif">
        <option value="Y">Y</option>
        <option value="N">N</option>
      </select>
      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input class="btn btn-info" name="Submit" type="submit" value="Simpan" />
      <input class="btn btn-info" type="button" name="button" id="button" value="Kembali" onClick="location='index.php?main=show_denda'" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
</body>
</html>
