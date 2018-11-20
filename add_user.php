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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO p_user (p_uname, p_password, p_level, p_nonaktif) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['p_uname'], "text"),
                       GetSQLValueString($_POST['p_password'], "text"),
                       GetSQLValueString($_POST['p_level'], "int"),
                       GetSQLValueString($_POST['p_nonaktif'], "text"));

  mysql_select_db($database_dbconnect, $dbconnect);
  $Result1 = mysql_query($insertSQL, $dbconnect) or die(mysql_error());
}
?>

<h2>Tambah User</h2>
<form class="well" action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Username :</td>
      <td><input type="text" name="p_uname" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Password :</td>
      <td><input type="password" name="p_password" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Level :</td>
      <td><input type="text" name="p_level" value="" size="5" maxlength="1" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nonaktif :</td>
      <td><select name="p_nonaktif" id="select">
        <option value="Y">Y</option>
        <option value="N" selected="selected">N</option>
      </select>
      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input class="btn btn-info" type="submit" value="Tambah User" />
      <input class="btn btn-info" type="button" name="button" id="button" value="Kembali" onClick="location='index.php?main=show_user'"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
