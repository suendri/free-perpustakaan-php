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
  $insertSQL = sprintf("INSERT INTO p_buku (b_kode, b_judul, b_penulis, b_penerbit, b_tahun, b_stock, b_rak) VALUES (%s, %s, %s, %s, %s, %s, %s)",
  					   GetSQLValueString($_POST['b_kode'], "text"),
                       GetSQLValueString($_POST['b_judul'], "text"),
                       GetSQLValueString($_POST['b_penulis'], "text"),
                       GetSQLValueString($_POST['b_penerbit'], "text"),
                       GetSQLValueString($_POST['b_tahun'], "int"),
                       GetSQLValueString($_POST['b_stock'], "int"),
                       GetSQLValueString($_POST['b_rak'], "text"));

  mysql_select_db($database_dbconnect, $dbconnect);
  $Result1 = mysql_query($insertSQL, $dbconnect) or die(mysql_error());
}
?>
<h2>Tambah Buku</h2>
<form class="well" action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Kode :</td>
      <td><input type="text" name="b_kode" value="" size="20" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Judul :</td>
      <td><input type="text" name="b_judul" value="" size="50" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Penulis :</td>
      <td><input type="text" name="b_penulis" value="" size="50" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Penerbit :</td>
      <td><input type="text" name="b_penerbit" value="" size="50" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Tahun :</td>
      <td><input type="text" name="b_tahun" value="" size="20" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Stock :</td>
      <td><input type="text" name="b_stock" value="" size="10" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Rak :</td>
      <td><input type="text" name="b_rak" value="" size="10" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input class="btn btn-info" type="submit" value="Tambah Buku" />
         <input class="btn btn-info" type="button" name="button" id="button" value="Kembali" onClick="location='index.php?main=show_buku'"/>
      </td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
</body>
</html>
