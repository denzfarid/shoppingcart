<?php 
session_start(); 
if(empty($_SESSION['namauser'])) 
{ 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script language="javascript">
function validasi(form){
  if (form.username.value == ""){
    alert("Anda belum mengisikan Username.");
    form.username.focus();
    return (false);
  }
     
  if (form.password.value == ""){
    alert("Anda belum mengisikan Password.");
    form.password.focus();
    return (false);
  }
  return (true);
}
</script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="description"  content=""/>
<meta name="keywords" content=""/>
<meta name="robots" content="ALL,FOLLOW"/>
<meta name="Author" content="AIT"/>
<meta http-equiv="imagetoolbar" content="no"/>
<title>.::Halaman Administrator::.</title>
<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
<!--<link rel="stylesheet" href="css/reset.css" type="text/css"/>-->
<!--<link rel="stylesheet" href="css/screen.css" type="text/css"/>-->

<link rel="stylesheet" href="css/login.css" type="text/css"/>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/cufon.js"></script>
<script type="text/javascript" src="js/Geometr231_Hv_BT_400.font.js"></script>
<script type="text/javascript" src="js/script.js"></script>

</head>

<body>
  <div id="wrapper">
    <div class="site clearfix">
      <div class="container">
        <div id="login" class="login_form">
          <form name="login" action="cek_login.php" method="POST" onSubmit="return validasi(this)" accept-charset="utf-8">         
            <h1>Login</h1>
              <div class="formbody">
                <label for="login_field"> Nama pengguna<br>
                <input type="text" name="username" value="" autocapitalize="off" tabindex="1" id="login_field" class="text" style="width: 21em;"></label> 
                <label for="password"> Kata kunci<br> 
                  <input type="password" name="password" value="" autocomplete="disabled" class="text" id="password" style="width: 21em;" tabindex="2" size="20"></label> 
                <label class="submit_btn"> <input type="submit" name="commit" value="Masuk" tabindex="3"></label>
              </div>
          </form>       
        </div>
      </div>
    </div>
    <div class="context-overlay"></div>
  </div>
</body>
</html>	
<?php
} 
else
{
	header('location:media.php?module=home');
}
?>
