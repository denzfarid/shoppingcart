<?php
session_start();
error_reporting(0);

if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
	echo "<link href='css/screen.css' rel='stylesheet' type='text/css'><link href='css/reset.css' rel='stylesheet' type='text/css'> 
	<center><br><br><br><br><br><br>Maaf, untuk masuk <b>Halaman Administrator</b><br>
  	<center>anda harus <b>Login</b> dahulu!<br><br>";
 	echo "<div> <a href='index.php'><img src='images/kunci.png'  height=176 width=143></a></div>";
  	echo "<input type=button class=simplebtn value='LOGIN DI SINI' onclick=location.href='index.php'></a></center>";
}

else{
?>

<html lang="en"><head>
<meta charset="utf-8">
<meta name="description"  content=""/>
<meta name="keywords" content=""/>
<meta name="robots" content="ALL,FOLLOW"/>
<meta name="Author" content="Rizal Faizal"/>
<meta http-equiv="imagetoolbar" content="no"/>
<title>.::Halaman Administrator::.</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="HTML5 Admin Simplenso Template">
<meta name="author" content="ahoekie">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

<!-- Bootstrap -->
<link href="bootstrap/css/bootstrap.css" rel="stylesheet" id="main-theme-script">
<link href="css/themes/default.css" rel="stylesheet" id="theme-specific-script">
<link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

<!-- Simplenso -->
<link href="css/simplenso.css" rel="stylesheet">
<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
<link rel="stylesheet" href="css/fancybox.css" type="text/css"/>
<link rel="stylesheet" href="css/jquery.wysiwyg.css" type="text/css"/>
<link rel="stylesheet" href="css/jquery.ui.css" type="text/css"/>
<link rel="stylesheet" href="css/visualize.css" type="text/css"/>
<link rel="stylesheet" href="css/visualize-light.css" type="text/css"/>

  <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->

</head>
<body id="members">
<!-- Top navigation bar -->
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container-fluid">
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <a class="brand" href="index.html">Simplenso</a>
      <div class="btn-group pull-right">
        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
          <i class="icon-user"></i> <? echo $_SESSION[namalengkap];?>
          <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
          <li><a href="#">Profile</a></li>
          <li><a href="#">Settings</a></li>
          <li><a class="cookie-delete" href="#">Delete Cookies</a></li>
          <li class="divider"></li>
          <li><a href="login.html">Logout</a></li>
        </ul>
      </div>
      <div class="nav-collapse">
        <ul class="nav">
          <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    Messages <span class="label label-info">100</span>
                    <b class="caret"></b>
              </a>
              <ul class="dropdown-menu">
                  <li><a href="#">Message 1</a></li>
                  <li><a href="#">Another message</a></li>
                  <li><a href="#">Something else message</a></li>
                  <li class="divider"></li>
                  <li><a href="#">Older messages...</a></li>
              </ul>
          </li>
          <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      Settings
                      <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#">Personal Info</a></li>
                    <li><a href="#">Preferences</a></li>
                    <li><a href="#">Alerts</a></li>
                    <li><a class="cookie-delete" href="#">Delete Cookies</a></li>
                </ul>
          </li>
          <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      Theme
                      <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                	<li><a class="theme-switch-default" href="#">Default</a></li>
                    <li><a class="theme-switch-amelia" href="#">Amelia</a></li>
                    <li><a class="theme-switch-cerulean" href="#">Cerulean</a></li>
                    <li><a class="theme-switch-journal" href="#">Journal</a></li>                        
                    <li><a class="theme-switch-readable" href="#">Readable</a></li>
                    <li><a class="theme-switch-simplex" href="#">Simplex</a></li>
                    <li><a class="theme-switch-slate" href="#">Slate</a></li>
                    <li><a class="theme-switch-spacelab" href="#">Spacelab</a></li>
                    <li><a class="theme-switch-spruce" href="#">Spruce</a></li>
                    <li><a class="theme-switch-superhero" href="#">Superhero</a></li>
                    <li><a class="theme-switch-united" href="#">United</a></li>
                </ul>
          </li>
          <li><a href="#">Help</a></li>  
        </ul>
      </div><!--/.nav-collapse -->
    </div>
  </div>
</div>
<!-- Main Content Area | Side Nav | Content -->    
<div class="container-fluid">
  <div class="row-fluid">
    <!-- Side Navigation -->
    <div class="span2">
      <div class="member-box round-all"> 
        <a><img src="images/member_ph.png" class="member-box-avatar"></a>
        <span>
            <strong>Administrator</strong><br>
            <a><?echo $_SESSION[namalengkap]; ?></a><br>
            <span class="member-box-links"><a>Settings</a> | <a>Logout</a></span>
        </span>
      </div>          
      <div class="sidebar-nav">
      	<div class="well" style="padding: 8px 0;">
        <ul class="nav nav-list"> 
          <li class="nav-header">Menu Utama</li>
   		  <?php include "menu.php"; ?>        
       
          <li class="nav-header">Modul Web</li>
          <?php include "menu2.php"; ?>
         
          <li class="nav-header">Manajemen Admin</li>
          <?php include "menu3.php"; ?>
         
          <li><a href="logout.php"><i class="icon-off"></i> Logout</a></li>
        </ul>
        </div>
      </div><!--/.well -->
    </div><!--/span-->
    
    <!-- MODAL WINDOW -->
	<div id="modal" class="modal-window">
		<!-- <div class="modal-head clear"><a onclick="$.fancybox.close();" href="javascript:;" class="close-modal">Close</a></div> -->
		
	</div>

    <!-- Bread Crumb Navigation -->
	<div class="span10">
      	<?php include "content.php"; ?>
  	</div>  
 
    </div><!--/span-->
  </div><!--/row-->

  <footer>
    <p class="pull-right">© Simplenso 2012</p>
  </footer>

</div><!--/.fluid-container-->
	<!-- javascript Templates
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->    
    
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- Google API -->
    <script type="text/javascript" src="http://www.google.com/jsapi"></script>
     
    <!-- jQuery -->
    <script src="js/jquery.min.js"></script>

    <!-- Bootstrap -->
    <script src="bootstrap/js/bootstrap.min.js"></script>

    <!--<script type="text/javascript" src="js/jquery.js"></script>-->
	<script type="text/javascript" src="js/jquery.visualize.js"></script>
	<script type="text/javascript" src="js/jquery.wysiwyg.js"></script>
	
	
	<script type="text/javascript" src="js/jquery.fancybox.js"></script>
	<script type="text/javascript" src="js/jquery.idtabs.js"></script>
	<script type="text/javascript" src="js/jquery.datatables.js"></script>
	<script type="text/javascript" src="js/jquery.jeditable.js"></script>
	<script type="text/javascript" src="js/jquery.ui.js"></script>

	<script type="text/javascript" src="js/excanvas.js"></script>
	<script type="text/javascript" src="js/cufon.js"></script>
	<script type="text/javascript" src="js/Geometr231_Hv_BT_400.font.js"></script>

	

	<script language="javascript" type="text/javascript">
	    /*tinyMCE_GZ.init({
	    plugins : 'style,layer,table,save,advhr,advimage, ...',
			themes  : 'simple,advanced',
			languages : 'en',
			disk_cache : true,
			debug : false
		});*/
	</script>

<script language="javascript" type="text/javascript" src="../tinymcpuk/tiny_mce_src.js"></script>
<script type="text/javascript">
	tinyMCE.init({
			mode : "textareas",
			theme : "advanced",
			plugins : "table,youtube,advhr,advimage,advlink,emotions,flash,searchreplace,paste,directionality,noneditable,contextmenu",
			theme_advanced_buttons1_add : "fontselect,fontsizeselect",
			theme_advanced_buttons2_add : "separator,preview,zoom,separator,forecolor,backcolor,liststyle",
			theme_advanced_buttons2_add_before: "cut,copy,paste,separator,search,replace,separator",
			theme_advanced_buttons3_add_before : "tablecontrols,separator,youtube,separator",
			theme_advanced_buttons3_add : "emotions,flash",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "bottom",
			extended_valid_elements : "hr[class|width|size|noshade]",
			file_browser_callback : "fileBrowserCallBack",
			paste_use_dialog : false,
			theme_advanced_resizing : true,
			theme_advanced_resize_horizontal : false,
			theme_advanced_link_targets : "_something=My somthing;_something2=My somthing2;_something3=My somthing3;",
			apply_source_formatting : true
	});

	function fileBrowserCallBack(field_name, url, type, win) {
		var connector = "../../filemanager/browser.html?Connector=connectors/php/connector.php";
		var enableAutoTypeSelection = true;
		
		var cType;
		tinymcpuk_field = field_name;
		tinymcpuk = win;
		
		switch (type) {
			case "image":
				cType = "Image";
				break;
			case "flash":
				cType = "Flash";
				break;
			case "file":
				cType = "File";
				break;
		}
		
		if (enableAutoTypeSelection && cType) {
			connector += "&Type=" + cType;
		}
		
		window.open(connector, "tinymcpuk", "modal,width=600,height=400");
	}
</script>

	<script type="text/javascript">
		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-12958851-7']);
		  _gaq.push(['_trackPageview']);

		  (function() {
		    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();
	</script>

    <!-- The main application script -->
    <!--<script src="scripts/blueimp-jQuery-File-Upload/js/main.js"></script>-->
    <!-- The XDomainRequest Transport is included for cross-domain file deletion for IE8+ -->
    <!--[if gte IE 8]><script src="scripts/blueimp-jQuery-File-Upload/js/cors/jquery.xdr-transport.js"></script><![endif]-->
    
    <!-- Simplenso Scripts -->
    <!--<script src="scripts/simplenso.js"></script>-->
  </body></html>
<?php
}
?>