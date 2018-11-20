<link href="Bootstrap/css/datepicker.css" rel="stylesheet" type="text/css">
<script src="Bootstrap/js/bootstrap-datepicker.js" type="text/javascript"></script>

<script type="text/javascript" charset="utf-8">
		$(function(){
			window.prettyPrint && prettyPrint();
			$('#dp1').datepicker();
			$('#dp2').datepicker();
		});
</script>

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
if (isset($_GET['tgl_awal']) AND isset($_GET['tgl_akhir'])) {

  $colname_rec_show_lap_awal = $_GET['tgl_awal'];
  $colname_rec_show_lap_akhir = $_GET['tgl_akhir'];
  
  //$_SESSION['tgl_awal'] = $colname_rec_show_lap_awal;
  //$_SESSION['tgl_akhir'] = $colname_rec_show_lap_akhir;
  
mysql_select_db($database_dbconnect, $dbconnect);
$query_rec_show_denda = "SELECT p_transaksi.t_idanggota, p_transaksi.t_jnsDenda, p_transaksi.t_tgl1, p_transaksi.t_tgl2, p_transaksi.t_tgl3, p_transaksi.t_kembali, p_transaksi.t_jmlDenda, p_anggota.a_id, p_anggota.a_nama, p_denda.d_ID, p_denda.d_juml FROM p_transaksi, p_anggota, p_denda WHERE p_transaksi.t_idanggota=p_anggota.a_id AND p_transaksi.t_jnsDenda=p_denda.d_ID AND p_transaksi.t_jmlDenda>0 AND p_transaksi.t_tgl3>='".$colname_rec_show_lap_awal."' AND p_transaksi.t_tgl3<='".$colname_rec_show_lap_akhir."'";
$rec_show_denda = mysql_query($query_rec_show_denda, $dbconnect) or die(mysql_error());
$row_rec_show_denda = mysql_fetch_assoc($rec_show_denda);
$totalRows_rec_show_denda = mysql_num_rows($rec_show_denda);
}
else $totalRows_rec_show_denda = "-1";
?>
<h2>Laporan Denda</h2>
<form class="well" id="form1" name="form1" method="GET" action="">
  <input type="hidden" name="main" value="lap_denda" />
     <div class="input-append date" id="dp1" data-date-format="yyyy-mm-dd">
      <input type="text" name="tgl_awal" placeholder="Tanggal Awal" readonly/><span class="add-on"><i class="icon-th"></i></span></div> s/d 
       <div class="input-append date" id="dp2" data-date-format="yyyy-mm-dd">
      <input type="text" name="tgl_akhir" placeholder="Tanggal Akhir" readonly/><span class="add-on"><i class="icon-th"></i></span></div>
  <input class="btn btn-info" type="submit" name="button" id="button" value="Buat Laporan" />
</form>
<?php if ($totalRows_rec_show_denda > 0) { ?>
<p>Daftar Denda tanggal<b> <?php echo $colname_rec_show_lap_awal; ?></b> s/d <b><?php echo $colname_rec_show_lap_akhir; ?></b></p>
<table class="gridtable">
  <tr>
  	<th>#</th>
    <th>Nama Anggota</th>
    <th>Tanggal Kembali</th>
    <th>Tanggal Proses</th>
    <th>Denda</th>
    <th>Jumlah Denda</th>

  </tr>
  <?php $no=0; do { $no++;?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $row_rec_show_denda['a_nama']; ?></td>
      <td><?php echo $row_rec_show_denda['t_tgl2']; ?></td>
      <td><?php echo $row_rec_show_denda['t_tgl3']; ?></td>
      <td><?php echo $row_rec_show_denda['d_juml']; ?> / Hari</td>
      <td><?php echo $row_rec_show_denda['t_jmlDenda']; ?></td>

    </tr>
    <?php } while ($row_rec_show_denda = mysql_fetch_assoc($rec_show_denda)); ?>
</table>

<?php } 
else alertNo('Data Tidak ditemukan !');?>