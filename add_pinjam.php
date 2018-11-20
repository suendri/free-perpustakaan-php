<script type="text/javascript" charset="utf-8">
	//mengidentifikasikan variabel yang kita gunakan
	var a_id;
	var a_nama;
	var b_kode;
	var b_judul;
	var b_penulis;
	var b_penerbit;
	var b_stock;
	var b_rak;
	$(function(){
	
        
	});
	
	$(function(){
	
		/*---------------------------------------------------------------
		 * jika ada perubahan di ID User
		 *---------------------------------------------------------------
		 */
		$("#a_id").keyup(function(){
		a_id=$("#a_id").val();
		
		//tampilkan status loading dan animasinya
		$("#status0").html("<img src='Bootstrap/img/loading2.gif'>");
		$("#loading").show();
                        
		//lakukan pengiriman data
		$.ajax({
			url:"cek_pinjam.php",
			data:"op=getAnggota&a_id="+a_id,
			cache:false,
			success:function(msg){
				data=msg.split("|");                                
				//masukan isi data ke masing - masing field
				$("#a_nama").val(data[0]);
				
				//hilangkan status animasi dan loading
				$("#status0").html("");
				$("#loading").hide();
				}
			});
		});		        
				
		/*---------------------------------------------------------------
		 * jika ada perubahan di Kode Buku
		 *---------------------------------------------------------------
		 */
		$("#b_kode").keyup(function(){
		b_kode=$("#b_kode").val();
                        
		//tampilkan status loading dan animasinya
		$("#status1").html("<img src='Bootstrap/img/loading2.gif'>");
		$("#loading").show();
                        
		//lakukan pengiriman data
		$.ajax({
			url:"cek_pinjam.php",
			data:"op=getPinjam&b_kode="+b_kode,
			cache:false,
			success:function(msg){
				data=msg.split("|");
                                
				//masukan isi data ke masing - masing field
				$("#b_judul").val(data[0]);
				$("#b_penulis").val(data[1]);
				$("#b_penerbit").val(data[2]);
				$("#b_stock").val(data[3]);
				$("#b_rak").val(data[4]);
                                
				//hilangkan status animasi dan loading
				$("#status1").html("");
				$("#loading").hide();
				}
			});
		});
		
	});
</script>
<link href="Bootstrap/css/datepicker.css" rel="stylesheet" type="text/css">
<script src="Bootstrap/js/bootstrap-datepicker.js" type="text/javascript"></script>
<script type="text/javascript" charset="utf-8">
		$(function(){
			window.prettyPrint && prettyPrint();
			$('#dp1').datepicker();
		});
</script>

<?php require_once('Connections/dbconnect.php'); 
 
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

	$bkode = $_POST['b_kode'];
	$bjumlah = $_POST['t_jumlah'];
	$selectStock = "SELECT b_stock FROM p_buku WHERE b_kode='".$bkode."'";
	$queryStock = mysql_query($selectStock);
	$readyStock = mysql_result($queryStock, 0, 'b_stock');
	
	if ($readyStock > $bjumlah)
	{
	$insertSQL = sprintf("INSERT INTO p_transaksi (t_idanggota, t_kdbuku, t_jumlah, t_tgl2, t_jnsDenda, t_tgl1) VALUES (%s, %s, %s, %s, %s, now())",
                       GetSQLValueString($_POST['a_id'], "text"),
					   GetSQLValueString($_POST['b_kode'], "text"),
                       GetSQLValueString($_POST['t_jumlah'], "int"),
					   GetSQLValueString($_POST['t_tgl2'], "text"),
					   GetSQLValueString($_POST['t_denda'], "int"));

	mysql_select_db($database_dbconnect, $dbconnect);
	$Result1 = mysql_query($insertSQL, $dbconnect) or die(mysql_error());
  
	$updateSQL = "UPDATE p_buku SET b_stock=b_stock-".$_POST['t_jumlah']." WHERE b_kode='".$_POST['b_kode']."' ";
	$query = mysql_query ($updateSQL);
	
	alertYes('Data Berhasil disimpan!');
	}
	else 
	alertNo('Stock Tidak Mencukupi, Pastikan pinjaman anda tidak melewati Stock tersedia !');

}

mysql_select_db($database_dbconnect, $dbconnect);
$query_rec_show_denda = "SELECT * FROM p_denda";
$rec_show_denda = mysql_query($query_rec_show_denda, $dbconnect) or die(mysql_error());
$row_rec_show_denda = mysql_fetch_assoc($rec_show_denda);
$totalRows_rec_show_denda = mysql_num_rows($rec_show_denda);

?>

<h2>Tambah Peminjaman</h2>
<form class="well" action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table cellpadding="4">
     <tr valign="baseline">
      <td nowrap="nowrap" align="right">ID Anggota</td>
      <td><input type="text" name="a_id" id="a_id" placeholder="ID Anggota" required="" autocomplete="off" /> <div id="status0"></div></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nama</td>
      <td><input type="text" name="a_nama" id="a_nama" readonly="readonly" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Kode Buku</td>
      <td><input type="text" name="b_kode" id="b_kode" placeholder="Kode Buku" required="" autocomplete="off" /> <div id="status1"></div></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Judul Buku</td>
      <td><input type="text" name="b_judul" id="b_judul" readonly="readonly"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Penulis Buku</td>
      <td><input type="text" name="b_penulis" id="b_penulis" readonly="readonly"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Penerbit</td>
      <td><input type="text" name="b_penerbit" id="b_penerbit" readonly="readonly"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Stock</td>
      <td><input type="text" name="b_stock" id="b_stock" readonly="readonly"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Rak</td>
      <td><input type="text" name="b_rak" id="b_rak" readonly="readonly"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Jumlah Pinjam</td>
      <td><input type="text" name="t_jumlah" value="" placeholder="Jumlah Pinjam" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Tgl Kembali</td>
      <td>
		<div class="input-append date" id="dp1" data-date-format="yyyy-mm-dd">
		<input type="text" name="t_tgl2" placeholder="Tanggal kembali" readonly/><span class="add-on"><i class="icon-th"></i></span></div></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Denda Keterlambatan</td>
      <td><select name="t_denda" id="t_denda">
        <?php
do {  
?>
        <option value="<?php echo $row_rec_show_denda['d_ID']?>"><?php echo $row_rec_show_denda['d_kategori']?></option>
        <?php
} while ($row_rec_show_denda = mysql_fetch_assoc($rec_show_denda));
  $rows = mysql_num_rows($rec_show_denda);
  if($rows > 0) {
      mysql_data_seek($rec_show_denda, 0);
	  $row_rec_show_denda = mysql_fetch_assoc($rec_show_denda);
  }
?>
      </select>
</td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input class="btn btn-info" type="submit" value="Tambah Peminjam" />
        <input class="btn btn-info" type="button" name="kembali" id="button" value="Kembali" onClick="location='index.php?main=show_pinjam'"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<?php
mysql_free_result($rec_show_denda);
?>
