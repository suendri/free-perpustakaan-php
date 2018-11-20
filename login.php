<?php 
require ("inc/fungsi.php");

// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['username'])) {
  $loginUsername=$_POST['username'];
  $password=$_POST['password'];
  $MM_fldUserAuthorization = "p_level";
  $MM_redirectLoginSuccess = "index.php";
  $MM_redirectLoginFailed = "login.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_dbconnect, $dbconnect);
  	
  $LoginRS__query=sprintf("SELECT p_uname, p_password, p_level FROM p_user WHERE p_uname=%s AND p_password=%s AND p_nonaktif='N'",
  GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $dbconnect) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
    
    $loginStrGroup  = mysql_result($LoginRS,0,'p_level');
    
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE>
<html>
<head>
<meta charset=utf-8" />
<title>Login Sistem Simple e-Perpustakaan</title>
<meta name="description" content="Simple e-Perpustakaan">
<meta name="author" content="PHPBeGO Foundation">

<link rel="shortcut icon" href="images/favicon.ico" />
<link href="Bootstrap/css/style.css" rel="stylesheet" type="text/css" />
<link href="Bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="clear">&nbsp;</div>
<form id="form1" name="form1" method="POST" action="<?php echo $loginFormAction; ?>">
  <table width="550" height="458" border="0" align="center" cellpadding="2" background="images/bglogin.png">
    <tr>
      <td width="218" height="299">&nbsp;</td>
      <td width="318">&nbsp;</td>
    </tr>
    <tr>
      <td height="33" align="right">Username :</td>
      <td><input type="text" name="username" id="username" /></td>
    </tr>
    <tr>
      <td height="37" align="right">Password :</td>
      <td><input type="password" name="password" id="password" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td valign="top"><input class="btn btn-info" type="submit" name="button" id="button" value="Login" /></td>
    </tr>
  </table>
</form>
</body>
</html>
