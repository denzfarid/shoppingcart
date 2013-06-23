<?php
$sql = mysql_query("select nama_produk from produk where id_produk='".intval($_GET[id])."'");
$j   = mysql_fetch_array($sql);

if (ISSET($_GET[id])){
		echo htmlentities("$j[nama_produk]");
}
else{
		echo ".::GriyaGaya - Ekspresikan Gaya Anda::.";
}
?>
