<?php
	$sid = session_id();
	$sql = mysql_query("SELECT SUM(jumlah*harga) as total,SUM(jumlah) as totaljumlah FROM orders_temp, produk 
			                WHERE id_session='$sid' AND orders_temp.id_produk=produk.id_produk");
			                
	while($r=mysql_fetch_array($sql)){
	
	
		if ($r['totaljumlah'] != ""){
			$total_rp    = format_rupiah($r['total']);
 
			$viewShoppingCart="<a href='keranjang-belanja.html'><h4>Shopping Cart ($r[totaljumlah])</h4></a>
								<a href='keranjang-belanja.html'>$r[totaljumlah] item(s) - Rp.$total_rp,-</a>";
		}
		else{ 
			
			$viewShoppingCart="<a href='keranjang-belanja.html'><h4>Shopping Cart (0)</h4></a>
								<a href='keranjang-belanja.html'>0 item(s) - Rp.0,-</a>";
		}
  
	echo $viewShoppingCart;
  }
?>
