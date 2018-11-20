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
  $updateSQL = sprintf("UPDATE p_transaksi SET t_tgl3=now(), t_kembali=%s, t_jmlDenda=%s WHERE t_id=%s",

                       GetSQLValueString($_POST['t_kembali'], "text"),
					   GetSQLValueString($_POST['t_jmlDenda'], "int"),
                       GetSQLValueString($_POST['t_id'], "int"));

  mysql_select_db($database_dbconnect, $dbconnect);
  $Result1 = mysql_query($updateSQL, $dbconnect) or die(mysql_error());
  
  $updateSQL = "UPDATE p_buku SET b_stock=b_stock+".$_POST['t_jumlah']." WHERE b_kode='".$_POST['b_kode']."' ";
  $query = mysql_query ($updateSQL);
	
  alertYes('Data Pengembalian berhasil diproses, Buku telah dikembalikan!');
}

$colname_rec_edit_kembali = "-1";
if (isset($_GET['t_id'])) {
  $colname_rec_edit_kembali = $_GET['t_id'];
}
mysql_select_db($database_dbconnect, $dbconnect);
$query_rec_edit_kembali = sprintf("SELECT p_transaksi.t_kdbuku as AA, 
									p_transaksi.t_jumlah as AD, 
									p_transaksi.t_tgl1 as AF, 
									p_transaksi.t_tgl2 as AG, 
									p_transaksi.t_kembali as AH,
									p_transaksi.t_jmlDenda as AK,
									p_transaksi.t_jnsDenda,
									p_denda.d_ID,
									p_denda.d_juml as AJ,									
									p_buku.b_kode, 
									p_buku.b_judul as AB, 
									p_buku.b_penerbit as AC, 
									p_transaksi.t_id as AI									
									FROM p_transaksi,p_denda,p_buku 
									WHERE p_transaksi.t_kdbuku=p_buku.b_kode 
									AND p_transaksi.t_jnsDenda=p_denda.d_ID
									AND	p_transaksi.t_id = %s", GetSQLValueString($colname_rec_edit_kembali, "int"));
$rec_edit_kembali = mysql_query($query_rec_edit_kembali, $dbconnect) or die(mysql_error());
$row_rec_edit_kembali = mysql_fetch_assoc($rec_edit_kembali); 
$totalRows_rec_edit_kembali = mysql_num_rows($rec_edit_kembali);
$hrgDenda = $row_rec_edit_kembali['AJ'];

$tgl_kembali = $row_rec_edit_kembali['AG'];
$tgl_sekarang = date('Y-m-d');
$selisih = strtotime($tgl_sekarang) - strtotime($tgl_kembali);
$tgl_telat = $selisih/(60*60*24);

// Hitung denda keterlambatan

$denda = $hrgDenda * $tgl_telat;

?>

<h2>Proses Pengembalian</h2>
<form class="well" action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table cellpadding="4">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Kode Buku :</td>
      <td><strong><?php echo htmlentities($row_rec_edit_kembali['AA'], ENT_COMPAT, 'utf-8'); ?></strong></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Judul Buku :</td>
      <td><strong><?php echo htmlentities($row_rec_edit_kembali['AB'], ENT_COMPAT, 'utf-8'); ?></strong></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Penerbit :</td>
      <td><strong><?php echo htmlentities($row_rec_edit_kembali['AC'], ENT_COMPAT, 'utf-8'); ?></strong></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Jumlah :</td>
      <td><strong><?php echo htmlentities($row_rec_edit_kembali['AD'], ENT_COMPAT, 'utf-8'); ?></strong></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Tgl Pinjam :</td>
      <td><strong><?php echo htmlentities($row_rec_edit_kembali['AF'], ENT_COMPAT, 'utf-8'); ?></strong></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Tgl kembali :</td>
      <td><strong><?php echo htmlentities($row_rec_edit_kembali['AG'], ENT_COMPAT, 'utf-8'); ?></strong></td>
    </tr>
	<tr valign="baseline">
      <td nowrap="nowrap" align="right">Tgl Sekarang :</td>
      <td><strong><?php echo $tgl_sekarang; ?></strong></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Keterlambatan :</td>
      <td><strong><?php echo $tgl_telat; ?> Hari</strong></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Denda :</td>
      <td><input type="text" name="t_denda" id="t_denda" value="<?php echo $denda; ?>" readonly/> Rupiah</td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Bayar :</td>
      <td><input type="text" name="t_jmlDenda" id="t_jmlDenda" value="<?php echo htmlentities($row_rec_edit_kembali['AK'], ENT_COMPAT, 'utf-8'); ?>"> Rupiah</td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Proses Pengembalian :</td>
      <td><label>
        <select name="t_kembali" id="select">
          <option value="Y" <?php if (!(strcmp("Y", $row_rec_edit_kembali['AH']))) {echo "selected=\"selected\"";} ?>>Y</option>
          <option value="N" <?php if (!(strcmp("N", $row_rec_edit_kembali['AH']))) {echo "selected=\"selected\"";} ?>>N</option>
        </select>
      </label></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input class="btn btn-info" type="submit" value="Proses" />
        <input class="btn btn-info" type="button" name="button" id="button" value="Kembali" onClick="location='index.php?main=show_kembali'"/>
	</td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="t_id" value="<?php echo $row_rec_edit_kembali['AI']; ?>" />
  <input type="hidden" name="t_jumlah" value="<?php echo $row_rec_edit_kembali['AD']; ?>" />
  <input type="hidden" name="b_kode" value="<?php echo $row_rec_edit_kembali['AA']; ?>" />
</form>
