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
if (!isset($_SESSION)) {
  session_start();
}

require_once('Connections/dbconnect.php'); 

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

define('ENVIRONMENT', 'production');

if (defined('ENVIRONMENT'))
{
	switch (ENVIRONMENT)
	{
		case 'development':
			error_reporting(E_ALL);
		break;
	
		case 'testing':
		case 'production':
			error_reporting(0);
		break;

		default:
			exit('The application environment is not set correctly.');
	}
}

/*---------------------------------------------------------------------------------------------
 * Fungsi AlertYes
 *
 *---------------------------------------------------------------------------------------------
 */
function alertYes($title) {
echo "<div class='alert alert-success'>
	  <button type='button' class='close' data-dismiss='alert'>&times;</button>
      ".$title."
    </div>";
}

/*---------------------------------------------------------------------------------------------
 * Fungsi AlertNo
 *
 *---------------------------------------------------------------------------------------------
 */
function alertNo($title) {
echo "<div class='alert alert-error'>
	  <button type='button' class='close' data-dismiss='alert'>&times;</button>
      ".$title."
    </div>";
}

date_default_timezone_set('Asia/Jakarta');

function  tanggal_indonesia1($tgl){
	$tanggal  =  substr($tgl,8,2);
	$bulan  =  substr($tgl,5,2);
	$tahun  =  substr($tgl,0,4);
return  $tanggal.'-'.$bulan.'-'.$tahun;
}

function  tanggal_indonesia2($tgl){
	$tanggal  =  substr($tgl,8,2);
	$bulan  =  getBulan(substr($tgl,5,2));
	$tahun  =  substr($tgl,0,4);
return  $tanggal.''.$bulan.''.$tahun;
}
 
function  getBulan($bln){
	switch  ($bln){
		case  1:
		return  "Januari";
		break;
		case  2:
		return  "Februari";
		break;
		case  3:
		return  "Maret";
		break;
		case  4:
		return  "Maret";
		break;
		case  5:
		return  "Mei";
		break;
		case  6:
		return  "Juni";
		break;
		case  7:
		return  "Juli";
		break;
		case  8:
		return  "Agustus";
		break;
		case  9:
		return  "September";
		break;
		case  10:
		return  "Oktober";
		break;
		case  11:
		return  "November";
		break;
		case  12:
		return  "Desember";
		break;
	}
}


?>