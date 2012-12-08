<?php
  error_reporting(0);
  session_start();
  include "config/koneksi.php";
  include "config/fungsi_indotgl.php";
  include "config/class_paging.php";
  include "config/fungsi_combobox.php";
  include "config/library.php";
  include "config/fungsi_autolink.php";
  include "config/fungsi_rupiah.php";
  include "hapus_orderfiktif.php";
?>

<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Bootstrap Shopping Cart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="bootstrap/css/bootstrap.main.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/jquery.rating.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
	
	<!-- Le javascript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="js/jquery.min.js"></script>
	<script src="bootstrap/js/bootstrap.js"></script>
	<script src="js/jquery.rating.pack.js"></script>
	<script>
	$(function() {
		
	});
	</script>
  <body>

    <div class="container">
		<div class="row"><!-- start header -->
			<div class="span4 logo">
			<a href="index.php">
				<h1>Bootstrap Cart</h1>
			</a>
			</div>
			<div class="span8">

				<div class="row">
					<div class="span2">&nbsp;</div>
					<div class="span3">
						<?php require_once "item.php"; ?>
						 
					</div>
					<div class="span3 customer_service">
						<h4>FREE delivery on ALL orders</h4>
						<h4><small>Customer service: 0800 8475 548</small></h4>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="links pull-right">
						<a href="index.php">Home</a> |
						<a href="selesai-belanja.html">Checkout</a> |
						<a href="profil-kami.html">About</a> |
						<a href="hubungi-kami.html">Contact</a>
					</div>

				</div>
			</div>
		</div><!-- end header -->

		<div class="row"><!-- start nav -->
			<div class="span12">
			  <div class="navbar">
					<div class="navbar-inner">
					  <div class="container" style="width: auto;">
						<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						  <span class="icon-bar"></span>

						  <span class="icon-bar"></span>
						  <span class="icon-bar"></span>
						</a>
						<div class="nav-collapse">
						  <ul class="nav">
							<li><a href="index.php">Home</a></li>
							<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Product <b class="caret"></b></a>
								<ul class="dropdown-menu">
								<li><a href="semua-produk.html">All Product</a></li>
								<li class="divider"></li>
									<?php
									$kategori=mysql_query("select nama_kategori, kategori.id_kategori, kategori_seo,
														  count(produk.id_produk) as jml
														  from kategori left join produk
														  on produk.id_kategori=kategori.id_kategori
														  group by nama_kategori");
									$no=1;
									while($k=mysql_fetch_array($kategori)){
									  if(($no % 2)==0){
										echo "<li><a href='kategori-$k[id_kategori]-$k[kategori_seo].html'> $k[nama_kategori] ($k[jml])</a></li>";
									  }
									  else{
										echo "<li><a href='kategori-$k[id_kategori]-$k[kategori_seo].html'> $k[nama_kategori] ($k[jml])</a></li>";
									  }
									  $no++;
									}
									?>
								</ul>
							</li>
							<li><a href="profil-kami.html">Profil</a></li>
							<li><a href="selesai-belanja.html">Checkout</a></li>
							<li><a href="cara-pembelian.html">How to Buy</a></li>
							<li><a href="hubungi-kami.html">Contact Us</a></li>
						  </ul>

						  <ul class="nav pull-right">
						   <li class="divider-vertical"></li>
							<form class="navbar-search" method="POST" action="hasil-pencarian.html">
								<input name="kata" type="text" class="search-query span2"  placeholder="Search">
								<button class="btn btn-primary btn-small search_btn" type="submit">Go</button>
							</form>
						  </ul>
						</div><!-- /.nav-collapse -->
					  </div>
					</div><!-- /navbar-inner -->
				</div><!-- /navbar -->
			</div>
		</div><!-- end nav -->
		<div class="row" id="main-container">
		<div class="span3">
			<!-- start sidebar -->
			<ul class="breadcrumb">
				<li>Categories</li>
			</ul>
				<div class="span3 product_list">
					<ul class="nav">
						<?php
							$kategori=mysql_query("select nama_kategori, kategori.id_kategori, kategori_seo,
												  count(produk.id_produk) as jml
												  from kategori left join produk
												  on produk.id_kategori=kategori.id_kategori
												  group by nama_kategori");
							$no=1;
							while($k=mysql_fetch_array($kategori)){
							  if(($no % 2)==0){
								echo "<li><a href='kategori-$k[id_kategori]-$k[kategori_seo].html'> $k[nama_kategori] ($k[jml])</a></li>";
							  }
							  else{
								echo "<li><a href='kategori-$k[id_kategori]-$k[kategori_seo].html'> $k[nama_kategori] ($k[jml])</a></li>";
							  }
							  $no++;
							}
							?>
							</li>
					</ul>
				</div>
		<!-- end sidebar -->
		</div>
        
		<?php include "tengah.php";?>
		
      </div>
	  <footer>
	<hr>
	<div class="row well no_margin_left">
		<div class="span12">
			<h4>Information</h4>
			<p>Copyright ©2012 Develoved by: developer </p>
		</div>
	</div>
</footer>

</div> <!-- /container -->




</body></html>
