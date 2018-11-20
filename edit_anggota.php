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
  $updateSQL = sprintf("UPDATE p_anggota SET a_nama=%s, a_ttl=%s, a_jk=%s, a_alamat=%s, a_hp=%s, a_ket=%s, a_nonaktif=%s WHERE a_id=%s",
                       GetSQLValueString($_POST['a_nama'], "text"),
                       GetSQLValueString($_POST['a_ttl'], "text"),
                       GetSQLValueString($_POST['a_jk'], "text"),
                       GetSQLValueString($_POST['a_alamat'], "text"),
                       GetSQLValueString($_POST['a_hp'], "text"),
                       GetSQLValueString($_POST['a_ket'], "text"),
                       GetSQLValueString($_POST['a_nonaktif'], "text"),
                       GetSQLValueString($_POST['a_id'], "int"));

  mysql_select_db($database_dbconnect, $dbconnect);
  $Result1 = mysql_query($updateSQL, $dbconnect) or die(mysql_error());
}

$colname_rec_edit_anggota = "-1";
if (isset($_GET['a_id'])) {
  $colname_rec_edit_anggota = $_GET['a_id'];
}
mysql_select_db($database_dbconnect, $dbconnect);
$query_rec_edit_anggota = sprintf("SELECT * FROM p_anggota WHERE a_id = %s", GetSQLValueString($colname_rec_edit_anggota, "int"));
$rec_edit_anggota = mysql_query($query_rec_edit_anggota, $dbconnect) or die(mysql_error());
$row_rec_edit_anggota = mysql_fetch_assoc($rec_edit_anggota);
$totalRows_rec_edit_anggota = mysql_num_rows($rec_edit_anggota);
?>

<h2>Edit Anggota</h2>
<form class="well" action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nama Anggota :</td>
      <td><input type="text" name="a_nama" value="<?php echo htmlentities($row_rec_edit_anggota['a_nama'], ENT_COMPAT, 'utf-8'); ?>" size="50" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Tempat/Tgl Lahir :</td>
      <td><input type="text" name="a_ttl" value="<?php echo htmlentities($row_rec_edit_anggota['a_ttl'], ENT_COMPAT, 'utf-8'); ?>" size="50" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Jenis Kelamin :</td>
      <td><select name="a_jk" id="a_jk">
        <option value="" <?php if (!(strcmp("", $row_rec_edit_anggota['a_jk']))) {echo "selected=\"selected\"";} ?>>--pilih--</option>
        <option value="Laki-laki" <?php if (!(strcmp("Laki-laki", $row_rec_edit_anggota['a_jk']))) {echo "selected=\"selected\"";} ?>>Laki-laki</option>
        <option value="Perempuan" <?php if (!(strcmp("Perempuan", $row_rec_edit_anggota['a_jk']))) {echo "selected=\"selected\"";} ?>>Perempuan</option>
      </select>
</td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Alamat :</td>
      <td><input type="text" name="a_alamat" value="<?php echo htmlentities($row_rec_edit_anggota['a_alamat'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">No Hp :</td>
      <td><input type="text" name="a_hp" value="<?php echo htmlentities($row_rec_edit_anggota['a_hp'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap="nowrap">Deskripsi :</td>
      <td><textarea name="a_ket" cols="32"><?php echo htmlentities($row_rec_edit_anggota['a_ket'], ENT_COMPAT, 'utf-8'); ?></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nonaktif :</td>
      <td><select name="a_nonaktif" id="a_nonaktif">
        <option value="" <?php if (!(strcmp("", $row_rec_edit_anggota['a_nonaktif']))) {echo "selected=\"selected\"";} ?>>--pilih--</option>
        <option value="Y" <?php if (!(strcmp("Y", $row_rec_edit_anggota['a_nonaktif']))) {echo "selected=\"selected\"";} ?>>Y</option>
        <option value="N" <?php if (!(strcmp("N", $row_rec_edit_anggota['a_nonaktif']))) {echo "selected=\"selected\"";} ?>>N</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input class="btn btn-info" type="submit" value="Simpan Data" />
      <input class="btn btn-info" type="button" name="button" id="button" value="Kembali" onClick="location='index.php?main=show_anggota'"/>
     </td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="a_id" value="<?php echo $row_rec_edit_anggota['a_id']; ?>" />
</form>
