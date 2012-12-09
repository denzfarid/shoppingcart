<?php
include "../config/koneksi.php";

if ($_SESSION[leveluser]=='admin'){
  $sql=mysql_query("select * from modul where aktif='Y' order by urutan");
}

if ($m=mysql_fetch_array($sql)){  
//echo "<li><a href='?module=menuutama'><i class='icon-edit'></i> Menu Utama</a></li>";
//echo "<li><a href='?module=submenu'><i class='icon-edit'></i> Sub Menu</a></li>";
echo "<li><a href='?module=profil'><i class='icon-edit'></i> Profil</a></li>"; 
echo "<li><a href='?module=welcome'><i class='icon-edit'></i> Selamat Datang</a></li>"; 
echo "<li><a href='?module=carabeli'><i class='icon-edit'></i> Cara Pembelian</a></li>"; 
echo "<li><a href='?module=kategori'><i class='icon-edit'></i> Kategori Produk</a></li>"; 
echo "<li><a href='?module=produk'><i class='icon-edit'></i> Produk</a></li>"; 
echo "<li><a href='?module=order'><i class='icon-list'></i> Lihat Order Masuk</a></li>"; 
echo "<li><a href='?module=hubungi'><i class='icon-list'></i> Lihat Pesan Masuk</a></li>"; 
echo "<li><a href='?module=ongkoskirim'><i class='icon-edit'></i> Ongkos Kirim</a></li>"; 
echo "<li><a href='?module=jasapengiriman'><i class='icon-edit'></i> Jasa Pengiriman</a></li>"; 
echo "<li><a href='?module=laporan'><i class='icon-list'></i> Lihat Laporan Transaksi</a></li>";   
}
?>
