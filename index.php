<?php
require ("inc/fungsi.php");

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "login.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "1,2";
$MM_donotCheckaccess = "false";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>

<!DOCTYPE>
<html lang="en">
<head>
<meta charset="utf-8">
<title>e-Perpustakaan</title>
<meta name="description" content="Simple e-Perpustakaan">
<meta name="author" content="PHPBeGO Foundation">

<link href="Bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="Bootstrap/css/style.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="images/favicon.ico" />

<script src="Bootstrap/js/jquery.js" type="text/javascript"></script>
<script src="Bootstrap/js/bootstrap.js" type="text/javascript"></script>
<script src="Bootstrap/js/bootstrap-alert.js" type="text/javascript"></script>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />

</head>

<body>
<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="index.php">e-Perpustakaan</a>
          <p class="navbar-text pull-right">
              Selamat Datang, <a href="#" class="navbar-link"><strong><?php echo $_SESSION['MM_Username']; ?></strong></a> | 
			  <a href="<?php echo $logoutAction ?>" class="navbar-link"><strong>Logout</strong></a>
          </p>
        </div>
      </div>
</div>
<div class="clear"></div>
<div class="container">
            <div class="main-layout">
                <div class="main-header">
                    <div class="title-layout">
                        <img src="images/pln_logo.jpg" width="80" height="100"/>
                        <h1>e-Perpustakaan PLN Belawan - Sumatera Utara</h1>
                        <h4>Alamat : Jln. St Ali Syahbana 11b Kisaran. No Telp : (0623) 4562221. Email : cs@gosoftware.web.id</h4>
                    </div>
                </div>
                <div class="main-menu">
	<ul id="MenuBar1" class="MenuBarHorizontal">
      <li><a href="index.php">Home</a></li>
      <li><a class="MenuBarItemSubmenu" href="index.php?main=show_pinjam">Proses</a>
          <ul>
            <li><a href="index.php?main=show_pinjam">Peminjaman</a></li>
            <li><a href="index.php?main=show_kembali">Pengembalian</a></li>
            <li><a href="index.php?main=show_history">History</a></li>
          </ul>
      </li>
      <li><a href="index.php?main=show_buku" class="MenuBarItemSubmenu">Master</a>
          <ul>
            <li><a href="index.php?main=show_buku">Buku</a></li>
            <li><a href="index.php?main=show_anggota">Anggota</a></li>
            <li><a href="index.php?main=show_denda">Denda</a></li>
          </ul>
      </li>
	  <li><a href="index.php?main=show_buku" class="MenuBarItemSubmenu">Laporan</a>
          <ul>
            <li><a href="index.php?main=lap_pinjam">Buku Keluar</a></li>
            <li><a href="index.php?main=lap_denda">Denda</a></li>
          </ul>
      </li>
      <?php if ($_SESSION['MM_UserGroup']== '1') { ?>
      <li><a class="MenuBarItemSubmenu" href="index.php?main=show_user">Sistem</a>
          <ul>
            <li><a href="index.php?main=show_user">User</a> </li>
          </ul>
      </li>
      <?php } ?>
    </ul>     
	</div>
    <div class="main-konten">
	<?php if(isset($_GET['main'])){ 
		if(file_exists($_GET['main'].".php")) {	
		require_once($_GET['main'].".php"); } 
		else { echo "<h3 align=center><br>Error !!</h3><b>Maaf file <u>$_GET[main].php</u> tidak temukan !!</b>"; } 
		} else require ("main.php");
	?>
	<div class="clearMain">&nbsp;</div>
	</div>
            <div class="footer-layout">
                Copyright &copy; 2014. e-Perpustakaan 4.0 -
                <a href="http://phpbego.wordpress.com" target="_blank">PHPBeGO Foundation </a>
            </div>
        </div>

<script type="text/javascript">
<!--
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
//-->
</script>
</body>
</html>
