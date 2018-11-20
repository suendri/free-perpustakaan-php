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
  $insertSQL = sprintf("INSERT INTO p_anggota (a_nama, a_ttl, a_jk, a_alamat, a_hp, a_ket, a_nonaktif) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['a_nama'], "text"),
                       GetSQLValueString($_POST['a_ttl'], "text"),
                       GetSQLValueString($_POST['a_jk'], "text"),
                       GetSQLValueString($_POST['a_alamat'], "text"),
                       GetSQLValueString($_POST['a_hp'], "text"),
                       GetSQLValueString($_POST['a_ket'], "text"),
                       GetSQLValueString($_POST['a_nonaktif'], "text"));

  mysql_select_db($database_dbconnect, $dbconnect);
  $Result1 = mysql_query($insertSQL, $dbconnect) or die(mysql_error());
}
?>
<h2>Tambah Anggota</h2>
<form class="well" action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nama Anggota :</td>
      <td><input type="text" name="a_nama" value="" size="50" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Tempat/Tgl Lahir :</td>
      <td><input type="text" name="a_ttl" value="" size="50" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Jenis Kelamin :</td>
      <td><select name="a_jk" id="a_jk">
        <option value="" selected="selected">--Pilih--</option>
        <option value="Laki-laki">Laki-laki</option>
        <option value="Perempuan">Perempuan</option>
      </select>
      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Alamat :</td>
      <td><input type="text" name="a_alamat" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">No Hp :</td>
      <td><input type="text" name="a_hp" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap="nowrap">Deskripsi :</td>
      <td><textarea name="a_ket" cols="32"></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nonaktif :</td>
      <td><select name="a_nonaktif" id="a_nonaktif">
        <option value="" selected="selected">--Pilih--</option>
        <option value="Y">Y</option>
        <option value="N">N</option>
      </select>
      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input class="btn btn-info" type="submit" value="Tambah Anggota" /> <input class="btn btn-info" type="button" name="button" id="button" value="Kembali" onClick="location='index.php?main=show_anggota'"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
