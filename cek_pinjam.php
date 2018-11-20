<?php
require_once('Connections/dbconnect.php'); 

$op=isset($_GET['op'])?$_GET['op']:null;

if ($op=='getPinjam'){
    $b_kode=$_GET['b_kode'];
    $dt=mysql_query("select * from p_buku where b_kode='$b_kode'");
    $d=mysql_fetch_array($dt);
    echo $d['b_judul']."|".$d['b_penulis']."|".$d['b_penerbit']."|".$d['b_stock']."|".$d['b_rak'];
	}

if ($op=='getAnggota'){
    $a_id=$_GET['a_id'];
    $dt=mysql_query("select * from p_anggota where a_id='$a_id'");
    $d=mysql_fetch_array($dt);
    echo $d['a_nama'];
	}
?>