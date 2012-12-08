<script language="javascript">
function validasi(form){
  if (form.nama.value == ""){
    alert("Anda belum mengisikan Nama.");
    form.nama.focus();
    return (false);
  }    
  if (form.alamat.value == ""){
    alert("Anda belum mengisikan Alamat.");
    form.alamat.focus();
    return (false);
  }
  if (form.telpon.value == ""){
    alert("Anda belum mengisikan Telpon.");
    form.telpon.focus();
    return (false);
  }
  if (form.email.value == ""){
    alert("Anda belum mengisikan Email.");
    form.email.focus();
    return (false);
  }
  if (form.jasa.value == 0){
    alert("Anda belum memilih jasa pengiriman barang.");
    form.jasa.focus();
    return (false);
  }
  if (form.kota.value == 0){
    alert("Anda belum mengisikan Kota.");
    form.kota.focus();
    return (false);
  }
  return (true);
}


function harusangka(jumlah){
  var karakter = (jumlah.which) ? jumlah.which : event.keyCode
  if (karakter > 31 && (karakter < 48 || karakter > 57))
    return false;

  return true;
}


$(document).ready(function() {
	$('#jasa').change(function() { 
		var category = $(this).val();
		$.ajax({
			type: 'GET',
			url: 'config/kota.php',
			data: 'perusahaan=' + category, // Untuk data di MySQL dengan menggunakan kata kunci tsb
			dataType: 'html',
			beforeSend: function() {
				$('#kota').html('<tr><td colspan=2>Loading ....</td></tr>');	
			},
			success: function(response) {
				$('#kota').html(response);
			}
		});
    });
});

</script>

<?php
// Halaman utama (Home)
// done
if ($_GET[module]=='store'){
	$view ="<div class='span9'>Slide Show</div>";
	$view .= "<div class='span7 popular_products'>
			<h4>Popular products</h4><br>
			<ul class='thumbnails'>";
			
	$sql=mysql_query("SELECT * FROM produk ORDER BY dibeli DESC LIMIT 9");
	while ($r=mysql_fetch_array($sql)){
		$harga=format_rupiah($r[harga]);
		$disc=($r[diskon]/100)*$r[harga];
		$hargadisc = number_format(($r[harga]-$disc),0,",",".");
		$stok=$r['stok'];
		

		$d=$r['diskon'];
		$hargatetap="IDR. <b>$hargadisc,-</b>";
		$hargadiskon="IDR. <b>$hargadisc,-</b>";
		
		if ($d!= "0"){
			$divharga=$hargadiskon;
		}else{
			$divharga=$hargatetap;
		} 
		  
		$view.="<li class='span2'>
			<div class='thumbnail'>
				<a href='produk-$r[id_produk]-$r[produk_seo].html'><img class='resize' alt='' src='foto_produk/$r[gambar]'></a>
				<div class='caption'>
					<a href='produk-$r[id_produk]-$r[produk_seo].html'><h5>$r[nama_produk]</h5></a>
					 Price: $divharga
				</div>
			</div>
		 </li>";
	}
	  
	$view.="</ul></div>";
	$viewBank =" <div class='roe'><h4>Information</h4><br></div> ";
	$bank = mysql_query("SELECT * FROM mod_bank ORDER BY id_bank ASC");
		while($b=mysql_fetch_array($bank)){
			$viewBank .="<div>$b[nama_bank]</div>
						<div><img src='foto_banner/$b[gambar]' border='0' ></div>
						<div>No. Rek : $b[no_rekening]</div>
						<div>an. $b[pemilik] </div>
						";		  
		}
		  
	$view.="<div class='span2'>$viewBank</div>";
	echo $view;
}

// Modul detail produk
// done
elseif ($_GET[module]=='detailproduk'){
	$detail=mysql_query("SELECT * FROM produk,kategori    
                      WHERE kategori.id_kategori=produk.id_kategori 
                      AND id_produk='$_GET[id]'");
	$d   = mysql_fetch_array($detail);
	$tgl = tgl_indo($d[tanggal]);

	$dstok=$d['stok'];
	
	if ($dstok!= "0"){
			$dAvailability="<span class='content-product-stock1'>Ready Stock</span>";//$dstok;
			$tomboladdcart="<a class='btn btn-primary' href=\"aksi.php?module=keranjang&act=tambah&id=$d[id_produk]\">Add to cart</a>							";
		}else{
			$dAvailability="Out Of Stock";
			$tomboladdcart="<i class='prod_cart_habis_detail'></i>";
		} 	
	
    $harga = format_rupiah($d[harga]);
    $disc     = ($d[diskon]/100)*$d[harga];
	
	$desc = $d[deskripsi];
    $discFormat     = number_format(($disc),0,",",".");
    $hargadisc     = number_format(($d[harga]-$disc),0,",",".");
	
	$viewDetail="<div class='span9'><ul class='breadcrumb'>
				<li>
				<a href='index.php'>Home</a> <span class='divider'>/</span>
				</li>
				<li>
				<a href='kategori-$d[id_kategori]-$d[kategori_seo].html'>$d[nama_kategori]</a> <span class='divider'>/</span>
				</li>
				<li class='active'>
				<a href='#'>$d[nama_produk]</a>
				</li>
				</ul>";
	
	if ($d[gambar]!=''){
		$viewDetailPic = "<img src='foto_produk/$d[gambar]' alt=''/>";
	}
				
	$viewDetail .="<div class='row'><div class='span9'><h1>$d[nama_produk]</h1></div></div><hr>";
	$viewDetail .="<div class='row'> 
						<div class='span3'>
							$viewDetailPic
						</div>
						<div class='span6'>
							<div class='span6'>
								<address>
									<strong>Brand:</strong> <span>$d[nama_produk]</span><br>
									<strong>Availability:</strong> <span>$dAvailability</span><br>
								</address>
							</div>
							<div class='span6'>
								<h2>
									<strong>Price: Rp.$hargadisc,-</strong> <small>Disc: Rp.$discFormat,- </small><br><br>
								</h2>
							</div>
							<div class='span6'>
								$tomboladdcart
							</div>
						</div>
					</div><hr>";

	     
	// Produk Lainnya (random)          
	$sql=mysql_query("SELECT * FROM produk WHERE id_kategori='$d[id_kategori]' ORDER BY rand() LIMIT 4");
      
	$viewOther ="<ul class='thumbnails related_products'>";
	while ($r=mysql_fetch_array($sql)){
		$harga = format_rupiah($r[harga]);
		$disc     = ($r[diskon]/100)*$r[harga];
		$hargadisc     = number_format(($r[harga]-$disc),0,",",".");
		$stok=$r['stok'];
		
		// $tombolbeli="<a class='prod_cart' href=\"aksi.php?module=keranjang&act=tambah&id=$r[id_produk]\">BELI</a>";
		// $tombolhabis="<span class='prod_cart_habis'></span>";
		
		if ($stok!= "0"){
			$tombol=$tombolbeli;
			$Availability="<a class='prod_cart' href=\"aksi.php?module=keranjang&act=tambah&id=$r[id_produk]\"><i class='prod_cart_ada'></i></a>";
		}else{
			$tombol=$tombolhabis;
			$Availability="<i class='prod_cart_habis'></i>";
		} 

		$d=$r['diskon'];
		// $hargatetap="Rp. <b>$hargadisc,-</b>";
		// $hargadiskon="<span style='text-decoration:line-through;' class='price'>Rp. $harga,- <br /></span>&nbsp;Diskon $r[diskon]% 
		// <br />Rp. <b>$hargadisc,-</b>";
     
		$hargatetap="Rp. <b>$hargadisc,-</b>";
		$hargadiskon="Rp. <b>$hargadisc,-</b>";
		
		if ($d!= "0"){
			$divharga=$hargadiskon;
		}else{
			$divharga=$hargatetap;
		} 
		
		$viewOther .="<li class='span2'>
						<div class='thumbnail'>
							$Availability<br>
							<img src='foto_produk/$r[gambar]' border='0'></a>
								<div class='caption'>
									<a href='produk-$r[id_produk]-$r[produk_seo].html' class='prod_details'><h5>$r[nama_produk]</h5></a>   <br>
									Price: $divharga<br><br>
								</div>
						</div></li>";
	}
	
	$viewOther .="</ul>";
	
	$viewDescReviewRelated="<div class='row'>
								<div class='span9'>
									<div class='tabbable'>
										<ul class='nav nav-tabs'>
											<li class='active'><a href='#1' data-toggle='tab'>Description</a></li>
											<li class=''><a href='#2' data-toggle='tab'>Related products</a></li>
										</ul>
										<div class='tab-content'>
											<div class='tab-pane active' id='1'>
											<p>$desc</p>
										</div>  
										<div class='tab-pane' id='2'>
											$viewOther
										</div>
										</div>
									</div>
								</div>
							</div>";
							
	$viewDetail .= $viewDescReviewRelated;
	$viewDetail .= "</div>";
	echo $viewDetail;
}

// Modul produk per kategori
// done
elseif ($_GET[module]=='detailkategori'){
  // Tampilkan nama kategori
  $sq = mysql_query("SELECT nama_kategori from kategori where id_kategori='$_GET[id]'");
  $n = mysql_fetch_array($sq);
  
	$viewCat ="<div class='span9'>
				<ul class='breadcrumb'>
					<li>
						<a href='index.php'>Home</a> <span class='divider'>/</span>
					</li>
					
					<li class='active'>
						<a href='#'>$n[nama_kategori]</a>
					</li>
				</ul>";

	 
	// Tentukan berapa data yang akan ditampilkan per halaman (paging)
	$p      = new Paging3;
	$batas  = 12;
	$posisi = $p->cariPosisi($batas);

	// Tampilkan daftar produk yang sesuai dengan kategori yang dipilih
	$sql = mysql_query("SELECT * FROM produk WHERE id_kategori='$_GET[id]' 
			ORDER BY id_produk DESC LIMIT $posisi,$batas");		 
	$jumlah = mysql_num_rows($sql);

	if ($jumlah > 0){
		while ($r=mysql_fetch_array($sql)){
			$harga = format_rupiah($r[harga]);
			$disc     = ($r[diskon]/100)*$r[harga];
			$hargadisc     = number_format(($r[harga]-$disc),0,",",".");
			$stok=$r['stok'];
			//$tombolbeli="<a class='prod_cart' href=\"aksi.php?module=keranjang&act=tambah&id=$r[id_produk]\">BELI</a>";
			$tombolbeli="<a class='btn btn-primary' href=\"aksi.php?module=keranjang&act=tambah&id=$r[id_produk]\">Add to cart</a>";
			$tombolhabis="<i class='prod_cart_habis_category'></i>";
			  if ($stok!= "0"){
			  $tombol=$tombolbeli;
			  }else{
			  $tombol=$tombolhabis;
			  } 

			$d=$r['diskon'];
			
			// $hargatetap="<div class='prod_price'>Rp. <b>$hargadisc,-</b></div>";
			$hargatetap="<div class='prod_price'><span class='price'> Rp. <b>$hargadisc,-</b></span></div>";
			// $hargadiskon="<span style='text-decoration:line-through;' class='price'>Rp. $harga,- <br /></span>&nbsp;Diskon $r[diskon]% 
			$hargadiskon="<div class='prod_price'><span style='text-decoration:line-through;' class='price'>Rp. $harga,- <br /></span>
					&nbsp;<span class='price3'>Diskon $r[diskon]% 	 <br />
					<span class='price2'>Rp. <b>$hargadisc,-</b></span></div>";
					
			if ($d!= "0"){
				$divharga=$hargadiskon;
			}else{
				$divharga=$hargatetap;
			} 
			
			$viewCatRow .="<div class='row'>
								<div class='span1'><a href='produk-$r[id_produk]-$r[produk_seo].html'><img src='foto_produk/$r[gambar]'></a></div>
								<div class='span4'>
									<a href='produk-$r[id_produk]-$r[produk_seo].html'><h5>$r[nama_produk]</h5></a>
									<p>$r[deskripsi]</p>
								</div>
								<div class='span2'>
									<p>$divharga</p>
								</div>
								<div class='span2'>
									<p>$tombol</p>
								</div>
						  </div><hr>";
			//<a class='btn btn-primary' href=\"aksi.php?module=keranjang&act=tambah&id=$r[id_produk]\">Add to cart</a>
		}
		
		$jmldata     = mysql_num_rows(mysql_query("SELECT * FROM produk WHERE id_kategori='$_GET[id]'"));
		$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
		$linkHalaman = $p->navHalaman($_GET[halkategori], $jmlhalaman);

		//echo "<div class=halaman>Halaman : $linkHalaman </div><br>";
		$viewPage = "<div class=halaman>Halaman : $linkHalaman </div><br>";
		$viewCat .= $viewCatRow;
		$viewCat .= $viewPage;
		$viewCat .= "</div>";
		
		echo $viewCat;
	
	}else{
			echo"<div class='span9'>
					<div class='row'>
						<p align=left><span class='table7'>Belum ada produk pada kategori ini.</p>	
					</div>
				</div>";
	}
}

// Menu utama di header
// Modul profil
// done
if ($_GET['module']=='profilkami'){
  // Data profil mengacu pada id_modul=43
	$profil = mysql_query("SELECT * FROM modul WHERE id_modul='43'");
	$r      = mysql_fetch_array($profil);

	$viewProfile ="<div class='span9'>
				<ul class='breadcrumb'>
					<li>
						<a href='index.php'>Home</a> <span class='divider'>/</span>
					</li>
					
					<li class='active'>
						<a href='#'>Profile</a>
					</li>
				</ul>";
				
	$viewProfile .="$r[static_content]";   
	// $viewProfile .= "<script type='text/javascript'>
		// console.log($('$#main-container'));
        // alert('1');
    // </script>";
	
	$viewProfile .="</div>";
	echo $viewProfile;   		  
}

// Modul cara pembelian
// done
if ($_GET['module']=='carabeli'){
  // Data cara pembelian mengacu pada id_modul=45
	$cara = mysql_query("SELECT * FROM modul WHERE id_modul='45'");
	$r      = mysql_fetch_array($cara);

	$viewHowToBuy ="<div class='span9'>
				<ul class='breadcrumb'>
					<li>
						<a href='index.php'>Home</a> <span class='divider'>/</span>
					</li>
					
					<li class='active'>
						<a href='#'>How To Buy </a>
					</li>
				</ul>";
				
	$viewHowToBuy .="$r[static_content]";   

	$viewHowToBuy .="</div>";
	echo $viewHowToBuy;                           
}

// Modul semua produk
// done
elseif ($_GET[module]=='semuaproduk'){
	// echo "<h4 class='heading colr'>Semua Produk</h4>";\
	// Tentukan berapa data yang akan ditampilkan per halaman (paging)
	
	$viewAllProduct ="<div class='span9'>
				<ul class='breadcrumb'>
					<li>
						<a href='index.php'>Home</a> <span class='divider'>/</span>
					</li>
					
					<li class='active'>
						<a href='#'>All Product</a>
					</li>
				</ul>";
				
	$p      = new Paging2;
	$batas  = 16;
	$posisi = $p->cariPosisi($batas);

	// Tampilkan semua produk
	$sql=mysql_query("SELECT * FROM produk ORDER BY id_produk DESC LIMIT $posisi,$batas");

	while ($r=mysql_fetch_array($sql)){
		$harga = format_rupiah($r[harga]);
		$disc     = ($r[diskon]/100)*$r[harga];
		$hargadisc     = number_format(($r[harga]-$disc),0,",",".");
		$stok=$r['stok'];
		
		// $tombolbeli="<a class='prod_cart' href=\"aksi.php?module=keranjang&act=tambah&id=$r[id_produk]\">BELI</a>";
		// $tombolhabis="<span class='prod_cart_habis'></span>";
		
		$tombolbeli="<a class='btn btn-primary' href=\"aksi.php?module=keranjang&act=tambah&id=$r[id_produk]\">Add to cart</a>";
		$tombolhabis="<i class='prod_cart_habis_category'></i>";
			
		if ($stok!= "0"){
			$tombol=$tombolbeli;
		}else{
			$tombol=$tombolhabis;
		} 

		$d=$r['diskon'];
		$hargatetap="<div class='prod_price'><span class='price'> Rp. <b>$hargadisc,-</b></span></div>";
		$hargadiskon="<div class='prod_price'><span style='text-decoration:line-through;' class='price'>Rp. $harga,- <br /></span>
		&nbsp;<span class='price3'>Diskon $r[diskon]% 	 <br />
		<span class='price2'>Rp. <b>$hargadisc,-</b></span></div>";
		
		
		if ($d!= "0"){
			$divharga=$hargadiskon;
		}else{
			$divharga=$hargatetap;
		} 


		$viewAllProductRow .="<div class='row'>
					<div class='span1'><a href='produk-$r[id_produk]-$r[produk_seo].html'><img src='foto_produk/$r[gambar]'></a></div>
					<div class='span4'>
						<a href='produk-$r[id_produk]-$r[produk_seo].html'><h5>$r[nama_produk]</h5></a>
						<p>$r[deskripsi]</p>
					</div>
					<div class='span2'>
						<p>$divharga</p>
					</div>
					<div class='span2'>
						<p>$tombol</p>
					</div>
			  </div><hr>";
	}  
    
		$jmldata     = mysql_num_rows(mysql_query("SELECT * FROM produk"));
		$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
		$linkHalaman = $p->navHalaman($_GET[halproduk], $jmlhalaman);

		$viewAllProductPage = "<div class='halaman'>Halaman : $linkHalaman </div>";
		
		$viewAllProduct .= $viewAllProductRow;
		$viewAllProduct .= $viewAllProductPage;
		$viewAllProduct .="</div>";
		echo $viewAllProduct;
}

// Modul keranjang belanja
// done
elseif ($_GET[module]=='keranjangbelanja'){
	// Tampilkan produk-produk yang telah dimasukkan ke keranjang belanja
	$sid = session_id();
	$sql = mysql_query("SELECT * FROM orders_temp, produk 
			                WHERE id_session='$sid' AND orders_temp.id_produk=produk.id_produk");
							
	$ketemu=mysql_num_rows($sql);
	if($ketemu < 1){
		echo "<script>window.alert('Keranjang Belanjanya masih kosong. Silahkan Anda berbelanja terlebih dahulu');
        window.location=('index.php')</script>";
    }else
	{
		$no=1;
		while($r=mysql_fetch_array($sql)){
			$disc        = ($r[diskon]/100)*$r[harga];
			$hargadisc   = number_format(($r[harga]-$disc),0,",",".");
			$subtotal    = ($r[harga]-$disc) * $r[jumlah];
			$total       = $total + $subtotal;  
			$subtotal_rp = format_rupiah($subtotal);
			$total_rp    = format_rupiah($total);
			$harga       = format_rupiah($r[harga]);
				
			$viewShoppingcartTableBodyItemRow .="<tr>
			<td class=''>$no <input type=hidden name=id[$no] value=$r[id_orders_temp]></td>
			<td class='muted center_text'>
			<a href='produk-$r[id_produk]-$r[produk_seo].html'>
			<img width=80 class='imgcart' src=foto_produk/$r[gambar] >
			</a>
			</td>
			<td>$r[nama_produk]</td>
			<td><input type='text' name='jml[$no]' placeholder='1' class='input-mini' value=$r[jumlah] size=1 onchange=\"this.form.submit()\" onkeypress=\"return harusangka(event)\"></td>
			<td>$hargadisc</td>
			<td>$subtotal_rp</td>
			<td><a href='aksi.php?module=keranjang&act=hapus&id=$r[id_orders_temp]'><img src=images/kali.png border=0 title=Hapus></a></td>
			</tr>";
			
			$no++; 
		}
	}
				
	$viewShoppingCart = "<div class='span9'>
							<ul class='breadcrumb'>
								<li>
									<a href='index.php'>Home</a> <span class='divider'>/</span>
								</li>
								<li class='active'>
									<a href='#'>Shopping Cart</a>
								</li>
							</ul>
						<h1> Shopping Cart</h1><br>";
	
	$viewShoppingcartTableHeader ="<form method='post' action='aksi.php?module=keranjang&act=update'><table class='table table-bordered table-striped'>
		  <thead>
			  <tr>
				<th>No</th>
				<th>Image</th>
				<th>Product Name</th>
				<th>Quantity</th>
				<th>Unit Price</th>
				<th>Total</th>
				<th>Remove</th>
			  </tr>
			</thead>
			<tbody>";
			
			
	$viewShoppingcartTableBody = $viewShoppingcartTableBodyItemRow;
	$viewShoppingcartTableBody .= "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td colspan='2' style='text-align:right;'><strong>Rp. $total_rp,-</strong></td><td>&nbsp;</td></tr>";
	$viewShoppingcartTableFooter = "</tbody></table></form>";
	$viewShoppingcartTableFooterAction= "<div class='row'>
											<div class='span3'>
												<button class='btn btn-primary' type='submit'>Update</button>
											</div>
											<div class='span3'>
												<a class='btn btn-primary' href=javascript:history.go(-1)>Continue shopping</a>
											</div>
											<div class='span3'>
												<a href='selesai-belanja.html' class='btn btn-primary pull-right'>Checkout</a>
											</div>
										</div>
										<hr>
										<div class='row'>
											<div class='spann9'>
												<p>*   Apabila Anda mengubah jumlah (Qty), jangan lupa tekan tombol <b>Update Keranjang</b><br /></p>
												<p>**  Total harga di atas belum termasuk ongkos kirim yang akan dihitung saat <b>Selesai Belanja</b></p><br /></p>
											</div>
										</div></div>";
	
	$viewShoppingCart .= $viewShoppingcartTableHeader;
	$viewShoppingCart .= $viewShoppingcartTableBody;
	$viewShoppingCart .= $viewShoppingcartTableFooter;
	$viewShoppingCart .= $viewShoppingcartTableFooterAction;		  
		  
	echo $viewShoppingCart;
}

// Modul hubungi kami
// done
elseif ($_GET['module']=='hubungikami'){
	$viewContactUs="<div class='span9'><ul class='breadcrumb'>
					<li>
						<a href='index.php'>Home</a> <span class='divider'>/</span>
					</li>
					
					<li class='active'>
						<a href='#'>Contact</a>
					</li>
				</ul>";
	
	$viewContactUsContain='<div class="span6 no_margin_left">
					<legend>Contact Us</legend>
					<form action=hubungi-aksi.html method=POST>
					  <div class="control-group">
						<label class="control-label">Full Name</label>
						<div class="controls docs-input-sizes">
						  <input type="text" name="nama" placeholder="" class="span4">
						</div>
					  </div>
					  <div class="control-group">
						<label class="control-label">Email Address</label>
						<div class="controls docs-input-sizes">
						  <input type="text" name=email placeholder="" class="span4">
						</div>
					  </div>
					  <div class="control-group">
						<label class="control-label">Subject</label>
						<div class="controls docs-input-sizes">
						  <input type="text" name=subjek placeholder="" class="span4">
						</div>
					  </div>					 

					  <div class="control-group">
						<label class="control-label">Messages</label>
						<div class="controls docs-input-sizes">
						  <input type="text" name=pesan placeholder="" class="span4">
						</div>
					  </div> 
					  
					  <div class="control-group">
						<label class="control-label">Captcha</label>
						<div class="controls docs-input-sizes">
						  <img src="captcha.php"><br><br>
						  <span class=isikomen>(masukkan 6 kode di atas)<br /><input type=text name=kode maxlength=6 class="span4"><br />
						</div>
					  </div>
					  
					  <div class="control-group">
						<div class="controls docs-input-sizes">
							<input type="submit" class="btn btn-primary" value="SEND">
						</div>
					  </div>
					</form>
					</div>';
	
	$viewContactUs .= $viewContactUsContain;	
	$viewContactUs .="</div>";	
	echo $viewContactUs;	
}

// Modul hubungi aksi
// done
elseif ($_GET['module']=='hubungiaksi'){
	// echo "<div id='content'>          
          // <div id='content-detail'>";

	$viewContactUsAction="<div class='span9'><ul class='breadcrumb'>
			<li>
				<a href='index.php'>Home</a> <span class='divider'>/</span>
			</li>
			
			<li class='active'>
				<a href='#'>Contact</a>
			</li>
		</ul>";
		
	$nama=trim($_POST[nama]);
	$email=trim($_POST[email]);
	$subjek=trim($_POST[subjek]);
	$pesan=trim($_POST[pesan]);

	if (empty($nama)){
	  $viewContactUsAction .= "Anda belum mengisikan NAMA<br />
			  <a href=javascript:history.go(-1)><b>Ulangi Lagi!</b>";
	}
	elseif (empty($email)){
	  $viewContactUsAction .= "Anda belum mengisikan EMAIL<br />
			  <a href=javascript:history.go(-1)><b>Ulangi Lagi!</b>";
	}
	elseif (empty($subjek)){
	  $viewContactUsAction .= "Anda belum mengisikan SUBJEK<br />
			  <a href=javascript:history.go(-1)><b>Ulangi Lagi!</b>";
	}
	elseif (empty($pesan)){
	  $viewContactUsAction .= "Anda belum mengisikan PESAN<br />
			  <a href=javascript:history.go(-1)><b>Ulangi Lagi!</b>";
	}
	else{
			if(!empty($_POST['kode'])){
			if($_POST['kode']==$_SESSION['captcha_session']){

				mysql_query("INSERT INTO hubungi(nama,
									   email,
									   subjek,
									   pesan,
									   tanggal) 
							VALUES('$_POST[nama]',
								   '$_POST[email]',
								   '$_POST[subjek]',
								   '$_POST[pesan]',
								   '$tgl_sekarang')");
								   
				// $viewContactUsAction .= "<h4 class='heading colr'>Hubungi Kami</h4></span><br />"; 
				$viewContactUsAction .= "<p align=center><b>Terima kasih telah menghubungi kami. <br /> Kami akan segera meresponnya.</b></p>";
			
			}else{
				$viewContactUsAction .= "Kode yang Anda masukkan tidak cocok<br />
					   <a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>";
			}
		}else{
			$viewContactUsAction .= "Anda belum memasukkan kode<br />
			   <a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>";
		}
	}
	
	// echo "</div>
	// <div class='bottom_prod_box_big9'>
	// </div>";            
	
	$viewContactUsAction .="</div>";
	echo $viewContactUsAction;
}

// Modul hasil pencarian produk 
// done
elseif ($_GET['module']=='hasilcari'){
	  // menghilangkan spasi di kiri dan kanannya
	  $kata = trim($_POST['kata']);
	  // mencegah XSS
	  $kata = htmlentities(htmlspecialchars($kata), ENT_QUOTES);

	  // pisahkan kata per kalimat lalu hitung jumlah kata
	  $pisah_kata = explode(" ",$kata);
	  $jml_katakan = (integer)count($pisah_kata);
	  $jml_kata = $jml_katakan-1;

	  $cari = "SELECT * FROM produk WHERE " ;
		for ($i=0; $i<=$jml_kata; $i++){
		  $cari .= "deskripsi LIKE '%$pisah_kata[$i]%' OR nama_produk LIKE '%$pisah_kata[$i]%'";
		  if ($i < $jml_kata ){
			$cari .= " OR ";
		  }
		}
	  $cari .= " ORDER BY id_produk DESC LIMIT 6";
	  $hasil  = mysql_query($cari);
	  $ketemu = mysql_num_rows($hasil);
	  
	  //echo "<h4 class='heading colr'>Hasil Pencarian</h4>";
	  $viewResultSearch="<div class='span9'>
				<ul class='breadcrumb'>
					<li>
						<a href='index.php'>Home</a> <span class='divider'>/</span>
					</li>
					
					<li class='active'>
						<a href='#'>Search</a>
					</li>
				</ul>";

		if ($ketemu > 0){
		//echo "<div class='table3'>Ditemukan <b>$ketemu</b> produk dengan kata <font style='background-color:#D5F1FF'><b>$kata</b></font> <b>:</b> </div>";
		$viewResultSearch .="Ditemukan <b>$ketemu</b> produk dengan kata <font style='background-color:#D5F1FF'><b>$kata</b></font> <b>:</b><hr>";
		
		while($t=mysql_fetch_array($hasil)){
			// Tampilkan hanya sebagian isi produk
			$isi_produk = htmlentities(strip_tags($t['deskripsi'])); // mengabaikan tag html
			$isi = substr($isi_produk,0,250); // ambil sebanyak 250 karakter
			$isi = substr($isi_produk,0,strrpos($isi," ")); // potong per spasi kalimat
			$viewResultSearch .="<div class='row'>
								<div class='span3'><a href='produk-$t[id_produk]-$t[produk_seo].html'><img src='foto_produk/$t[gambar]'></a></div>
								<div class='span6'>
									<a href='produk-$t[id_produk]-$t[produk_seo].html'><h5>$t[nama_produk]</h5></a>
									<p>$isi</p>
									<p><a href=produk-$t[id_produk]-$t[produk_seo].html><span class='table6'>selengkapnya</a></p>
								</div>
						  </div><hr>";
		  }        
		}                                                          
	  else{
		// echo "<p><div class='table3'>Tidak ditemukan produk dengan kata <font style='background-color:#D5F1FF'><b>$kata</b></p>
		
		 // <div class='bottom_prod_box_big_nocari'></div>";
		$viewResultSearch .="<p>Tidak ditemukan produk dengan kata <font style='background-color:#D5F1FF'><b>$kata</b></p>";
	  }
	  
	  $viewResultSearch .="</div>";
	  echo $viewResultSearch;
}

// Modul selesai belanja
// done
if ($_GET['module']=='selesaibelanja'){
	$sid = session_id();
	$sql = mysql_query("SELECT * FROM orders_temp, produk 
						WHERE id_session='$sid' AND orders_temp.id_produk=produk.id_produk");
	$ketemu=mysql_num_rows($sql);
	if($ketemu < 1){
		echo "<script> alert('Keranjang belanja masih kosong');window.location='index.php'</script>\n";
		exit(0);
	}
	else{
	
		$optCOD="<select name='jasa' id='jasa' class='table5'>
			<option value='0' selected>- Pilih Jenis Jasa Pengiriman -</option>";
		$tampil=mysql_query("SELECT * FROM shop_pengiriman ORDER BY nama_perusahaan");
		while($r=mysql_fetch_array($tampil)){
			// echo "<option value='$r[id_perusahaan]'>$r[nama_perusahaan]</option>";
			$optItem .="<option value='$r[id_perusahaan]'>$r[nama_perusahaan]</option>";
		}

		$optCOD .=$optItem;
		$optCOD .="</select>";
		
 
		
		$viewCheckout="<div class='span9'>
							<ul class='breadcrumb'>
								<li>
									<a href='index.php'>Home</a> <span class='divider'>/</span>
								</li>
								<li>
									<a href='keranjang-belanja.html'>Shopping Cart</a> <span class='divider'>/</span>
								</li>
								<li class='active'>
									<a href='#'>Checkout</a>
								</li>
							</ul>";
		
		
		
		$viewCheckoutAccordion= "<div class='row'>
			<div class='span9'>
				<div class='accordion' id='accordion2'>
					<div class='accordion-group'>
						<div class='accordion-heading'>
							<a class='accordion-toggle' data-toggle='collapse' data-parent='#accordion2' href='#collapseOne'>
								<h3>Billing Details</h3>
							</a>
						</div>
						<div id='collapseOne' class='accordion-body collapse in'>
							<div class='accordion-inner'>
								<form name=form action=simpan-transaksi.html method=POST onSubmit=\"return validasi(this)\">
									<div class='span6 no_margin_left'>
										<legend>Your Personal Details</legend>
											<div class='control-group'>
												<label class='control-label'>Full Name</label>
												<div class='controls docs-input-sizes'>
													<input type='text' name='nama' placeholder='' class='span4'>
												</div>
											</div>
											
											<div class='control-group'>
												<label class='control-label'>Alamat Lengkap</label>
												<div class='controls docs-input-sizes'>
													<input type='text'  name='alamat' placeholder='' class='span4'>
												</div>
											</div>
											
											<div class='control-group'>
												<label class='control-label'>Telpon / Hp</label>
												<div class='controls docs-input-sizes'>
													<input type='text' name='telpon' placeholder='' class='span4'>
												</div>
											</div>								
											<div class='control-group'>
												<label class='control-label'>Email Address</label>
												<div class='controls docs-input-sizes'>
													<input type='text' name='email' placeholder='' class='span4'>
												</div>
											</div>					 
											<div class='control-group'>
												<label class='control-label'>Delivery Service</label>
												<div class='controls docs-input-sizes'>
													$optCOD
												</div>
											</div>
											<div class='control-group'>
												<label class='control-label'>City</label>
												<div class='controls docs-input-sizes'>
													<select name='kota' id='kota' class='table5'><option value='0' selected>Tentukan Jenis Jasa Pengiriman Dahulu</option></select>
												</div>
											</div>
											<div class='control-group'>
												<div class='controls docs-input-sizes'>
													<input type='submit' class='btn btn-primary' value='ORDER'>
												</div>
											</div>
										
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>";
		
		$viewCheckoutTableHeader ="<hr><h4>Items in your Cart</h4><hr><table class='table table-bordered table-striped'>
		  <thead>
			  <tr>
				<th>No</th>
				<th>Image</th>
				<th>Product Name</th>
				<th>Weight</th>
				<th>Quantity</th>
				<th>Unit Price</th>
				<th>Total</th>
			  </tr>
			</thead>
			<tbody>";
		
		$no=1;
		while($r=mysql_fetch_array($sql)){
			//START nampilkan diskon per produk --    
			$disc        = ($r[diskon]/100)*$r[harga];
			$hargadisc   = number_format(($r[harga]-$disc),0,",","."); 
			$subtotal    = ($r[harga]-$disc) * $r[jumlah];
			//END nampilkan diskon per produk --
			$total       = $total + $subtotal;  
			$subtotal_rp = format_rupiah($subtotal);
			$total_rp    = format_rupiah($total);
			$harga       = format_rupiah($r['harga']);
			$subtotalberat = $r['berat'] * $r['jumlah']; // total berat per item produk 
			$totalberat  = $totalberat + $subtotalberat; // grand total berat all produk yang dibeli    
			
			$viewCheckoutTableBodyItemRow .="<tr>
			<td class=''>$no</td>
			<td class='muted center_text'>
			<a href='produk-$r[id_produk]-$r[produk_seo].html'>
			<img width=80 class='imgcart' src=foto_produk/$r[gambar] >
			</a>
			</td>
			<td>$r[nama_produk]</td>
			<td>$r[berat]</td>
			<td>$r[jumlah]</td>
			<td>$hargadisc</td>
			<td>$subtotal_rp</td>
			</tr>";
			
			$no++; 
		}		
		 
		$viewCheckoutTableBody = $viewCheckoutTableBodyItemRow;
		$viewCheckoutTableBody .= "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td colspan='2' style='text-align:right;'><strong>Rp. $total_rp,-</strong></td> </tr>";
		$viewCheckoutTableFooter = "</tbody></table>";
		
		$viewCheckout .= $viewCheckoutAccordion;
		$viewCheckoutShoppingCart .= $viewCheckoutTableHeader;
		$viewCheckoutShoppingCart .= $viewCheckoutTableBody;
		$viewCheckoutShoppingCart .= $viewCheckoutTableFooter;
		$viewCheckoutShoppingCart .= $viewCheckoutTableFooterAction;	
		$viewCheckout .= $viewCheckoutShoppingCart;
		$viewCheckout .= "</div>";
		echo $viewCheckout;
	}
}      

// Modul simpan transaksi
// done
elseif ($_GET[module]=='simpantransaksi'){
	$kar1=strstr($_POST[email], "@");
	$kar2=strstr($_POST[email], ".");

	$viewSimpanTransaksi = "<div class='span9'>
							<ul class='breadcrumb'>
								<li>
									<a href='index.php'>Home</a> <span class='divider'>/</span>
								</li>
								<li>
									<a href='#'>Shopping Cart</a>  <span class='divider'>/</span>
								</li>
								<li>
									<a href='#'>Checkout</a>  <span class='divider'>/</span>
								</li>
								<li class='active'>
									<a href='#'>Finish</a>
								</li>
							</ul>";
							
	if (empty($_POST[nama]) || empty($_POST[alamat]) || empty($_POST[telpon]) || empty($_POST[email]) || empty($_POST[kota])){
		$viewSimpanTransaksi .= "ERROR :: Data yang Anda isikan belum lengkap<br />
		<a href='selesai-belanja.html'><b>Ulangi Lagi</b>";
	}
	elseif (!ereg("[a-z|A-Z]","$_POST[nama]")){
		$viewSimpanTransaksi .= "ERROR :: Nama tidak boleh diisi dengan angka atau simbol.<br />
		<a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>";
	}
	elseif (strlen($kar1)==0 OR strlen($kar2)==0){
		$viewSimpanTransaksi .= "ERROR :: Alamat email Anda tidak valid, mungkin kurang tanda titik (.) atau tanda @.<br />
		<a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>";
	}
	else
	{
		// fungsi untuk mendapatkan isi keranjang belanja
		function isi_keranjang(){
			$isikeranjang = array();
			$sid = session_id();
			$sql = mysql_query("SELECT * FROM orders_temp WHERE id_session='$sid'");
			
			while ($r=mysql_fetch_array($sql)) {
				$isikeranjang[] = $r;
			}
			return $isikeranjang;
		}

		$tgl_skrg = date("Ymd");
		$jam_skrg = date("H:i:s");

		// simpan data pemesanan 
		mysql_query("INSERT INTO orders(nama_kustomer, alamat, telpon, email, tgl_order, jam_order, id_kota) 
					 VALUES('$_POST[nama]','$_POST[alamat]','$_POST[telpon]','$_POST[email]','$tgl_skrg','$jam_skrg','$_POST[kota]')");
		  
		// mendapatkan nomor orders
		$id_orders=mysql_insert_id();

		// panggil fungsi isi_keranjang dan hitung jumlah produk yang dipesan
		$isikeranjang = isi_keranjang();
		$jml          = count($isikeranjang);

		// simpan data detail pemesanan  
		for ($i = 0; $i < $jml; $i++){
		  mysql_query("INSERT INTO orders_detail(id_orders, id_produk, jumlah) 
					   VALUES('$id_orders',{$isikeranjang[$i]['id_produk']}, {$isikeranjang[$i]['jumlah']})");
		}
		  
		// setelah data pemesanan tersimpan, hapus data pemesanan di tabel pemesanan sementara (orders_temp)
		for ($i = 0; $i < $jml; $i++) {
		  mysql_query("DELETE FROM orders_temp
						 WHERE id_orders_temp = {$isikeranjang[$i]['id_orders_temp']}");
		}
		
		$viewSimpanTransaksi .= "<div class='clear'></div>";
		$viewSimpanTransaksi .='<div class="thankyou" style="border-top:1px dashed #ccc">
		<h3>Thank you for Shopping with ...</h3>
		<p>A summary has been dispatched to your email. Please check for further instruction.<br></p>
		</div>';
		
		
		// $viewSimpanTransaksi .= "<h4>Proses Transaksi Selesai</h4>
		// Data pemesan beserta ordernya adalah sebagai berikut: <br />
		// <table class='table'>
		// <tr><td>Nama           </td><td> : <b>$_POST[nama]</b> </td></tr>
		// <tr><td>Alamat Lengkap </td><td> : $_POST[alamat] </td></tr>
		// <tr><td>Telpon         </td><td> : $_POST[telpon] </td></tr>
		// <tr><td>E-mail         </td><td> : $_POST[email] </td></tr></table><br />
      
		// Nomor Order: <b> <span class='table6'>$id_orders</b><br /><br />";

		$daftarproduk=mysql_query("SELECT * FROM orders_detail,produk 
                                 WHERE orders_detail.id_produk=produk.id_produk 
                                 AND id_orders='$id_orders'");

		$viewSimpanTransaksiTableHeader .= "<table class='table'>
		<tr>
			<th>No</th>
			<th>Nama Produk</th>
			<th>Berat(Kg)</th>
			<th>Qty</th>
			<th>Harga</th>
			<th>Sub Total</th>
		</tr>
		
		";
      
		$pesan="Terimakasih telah melakukan pemesanan online di toko kami<br /><br />  
				Nama: $_POST[nama] <br />
				Alamat: $_POST[alamat] <br/>
				Telpon: $_POST[telpon] <br /><hr />
        
        Nomor Order: $id_orders <br />
        Data order Anda adalah sebagai berikut: <br /><br />";
        
		$no=1;
		while ($d=mysql_fetch_array($daftarproduk)){
			$subtotalberat = $d[berat] * $d[jumlah]; // total berat per item produk 
			$totalberat  = $totalberat + $subtotalberat; // grand total berat all produk yang dibeli

		  
			$disc        = ($d[diskon]/100)*$d[harga];
			$hargadisc   = number_format(($d[harga]-$disc),0,",","."); 
			$subtotal    = ($d[harga]-$disc) * $d[jumlah];

			$total       = $total + $subtotal;
			$subtotal_rp = format_rupiah($subtotal);    
			$total_rp    = format_rupiah($total);    
			$harga       = format_rupiah($d['harga']);

			$viewSimpanTransaksiTableItemOrder .= "<tr>
			<td>$no</td>
			<td>$d[nama_produk]</td>
			<td>$d[berat]</td>
			<td>$d[jumlah]</td>
			<td>Rp. $harga,-</td>
			<td>Rp. $subtotal_rp,-</td></tr>";

			$pesan.="$d[jumlah] $d[nama_produk] -> Rp. $harga -> Subtotal: Rp. $subtotal_rp <br />";
			$no++;
		}

		$ongkos=mysql_fetch_array(mysql_query("SELECT ongkos_kirim FROM kota WHERE id_kota='$_POST[kota]'"));
		$ongkoskirim1=$ongkos[ongkos_kirim];
		$ongkoskirim = $ongkoskirim1 * $totalberat;

		$grandtotal    = $total + $ongkoskirim; 

		$ongkoskirim_rp = format_rupiah($ongkoskirim);
		$ongkoskirim1_rp = format_rupiah($ongkoskirim1); 
		$grandtotal_rp  = format_rupiah($grandtotal);  

		$pesan.="<br /><br />Total : Rp. $total_rp,-
				 <br />Ongkos Kirim untuk Tujuan Kota Anda : Rp. $ongkoskirim1_rp/Kg 
				 <br />Total Berat : $totalberat Kg
				 <br />Total Ongkos Kirim  : Rp. $ongkoskirim_rp		 
				 <br />Grand Total : Rp. $grandtotal_rp,-
				 <br /><br />Silahkan lakukan pembayaran ke Bank Mandiri sebanyak Grand Total yang tercantum, nomor rekeningnya <b>0312849389</b> a.n. Niken Sulanjari";

		$subjek="Pemesanan Online Art Furniture";

		// Kirim email dalam format HTML
		$dari = "From: redaksi@artfurniture.com \n";
		$dari .= "Content-type: text/html \r\n";

		// Kirim email ke kustomer
		mail($_POST[email],$subjek,$pesan,$dari);


		// Kirim email ke pengelola toko online
		mail("rizal@artfurniture.com",$subjek,$pesan,$dari);
		
		
		$viewSimpanTransaksiTableFoot ="
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>Total</td>
			<td><b>Rp.$total_rp,-</b></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>Shipping Cost</td>
			<td><b>$ongkoskirim1_rp</b>/Kg</td>
		</tr>		
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>Weight</td>
			<td><b>$totalberat Kg</b></td>
		</tr>		
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>Other Cost</td>
			<td>Rp.<b>$ongkoskirim_rp</b></td>
		</tr>
		<tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>Grand Total</td>
			<td>Rp.<b>$grandtotal_rp</b></td>
		</tr>
		</table>";
		
		$viewSimpanTransaksiTableFoot .="<br /><br /><br /><br />
			<p>- Data order dan nomor rekening transfer sudah terkirim ke email Anda. <br />
			- Apabila Anda tidak melakukan pembayaran dalam 3 hari, maka data order Anda akan terhapus (transaksi batal)</p><br />";
	}
		
	$viewSimpanTransaksi .= '<div class="cart-header" style="padding:10px 15px 10px 0px;">Items in your Cart</div>';
	$viewSimpanTransaksiTable = $viewSimpanTransaksiTableHeader;
	$viewSimpanTransaksiTable .= $viewSimpanTransaksiTableItemOrder;
	$viewSimpanTransaksiTable .= $viewSimpanTransaksiTableFoot;
	
	$viewSimpanTransaksi .= $viewSimpanTransaksiTable;
	$viewSimpanTransaksi .= "</div>";
	echo $viewSimpanTransaksi;
}

?>
