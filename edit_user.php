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
  $updateSQL = sprintf("UPDATE p_user SET p_uname=%s, p_password=%s, p_level=%s, p_nonaktif=%s WHERE p_id=%s",
                       GetSQLValueString($_POST['p_uname'], "text"),
                       GetSQLValueString($_POST['p_password'], "text"),
                       GetSQLValueString($_POST['p_level'], "int"),
                       GetSQLValueString($_POST['p_nonaktif'], "text"),
                       GetSQLValueString($_POST['p_id'], "int"));

  mysql_select_db($database_dbconnect, $dbconnect);
  $Result1 = mysql_query($updateSQL, $dbconnect) or die(mysql_error());
}

$colname_rec_edit_user = "-1";
if (isset($_GET['p_id'])) {
  $colname_rec_edit_user = $_GET['p_id'];
}
mysql_select_db($database_dbconnect, $dbconnect);
$query_rec_edit_user = sprintf("SELECT * FROM p_user WHERE p_id = %s", GetSQLValueString($colname_rec_edit_user, "int"));
$rec_edit_user = mysql_query($query_rec_edit_user, $dbconnect) or die(mysql_error());
$row_rec_edit_user = mysql_fetch_assoc($rec_edit_user);
$totalRows_rec_edit_user = mysql_num_rows($rec_edit_user);
?>

<h2>Edit User</h2>
<form class="well" action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Username :</td>
      <td><input type="text" name="p_uname" value="<?php echo htmlentities($row_rec_edit_user['p_uname'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Password :</td>
      <td><input type="password" name="p_password" value="<?php echo htmlentities($row_rec_edit_user['p_password'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Level :</td>
      <td><input name="p_level" type="text" value="<?php echo htmlentities($row_rec_edit_user['p_level'], ENT_COMPAT, 'utf-8'); ?>" size="5" maxlength="1" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nonaktif :</td>
      <td><select name="p_nonaktif" id="p_nonaktif">
        <option value="Y" <?php if (!(strcmp("Y", $row_rec_edit_user['p_nonaktif']))) {echo "selected=\"selected\"";} ?>>Y</option>
        <option value="N" <?php if (!(strcmp("N", $row_rec_edit_user['p_nonaktif']))) {echo "selected=\"selected\"";} ?>>N</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input class="btn btn-info" type="submit" value="Simpan" />
      <input class="btn btn-info" type="button" name="button" id="button" value="Kembali" onClick="location='index.php?main=show_user'"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="p_id" value="<?php echo $row_rec_edit_user['p_id']; ?>" />
</form>
