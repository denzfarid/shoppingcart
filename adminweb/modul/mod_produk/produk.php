<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_produk/aksi_produk.php";
switch($_GET[act]){
  // Tampil Produk
  default:

    echo breadcrumb("Produk");
    echo rowfluid("Daftar Produk");

    echo "
          <input type=button class='btn btn-primary' value='Tambahkan Produk' onclick=\"window.location.href='?module=produk&act=tambahproduk';\">
          <table style='font-size: 13px; line-height: 18px; color: #333;' class='table table-striped'>
          <tr><th>No</th><th>Nama Produk</th><th>Berat(kg)</th><th>Harga</th><th>Diskon</th><th>Stok</th><th>Tgl. Masuk</th><th>Aksi</th></tr>";

    $p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);

    $tampil = mysql_query("SELECT * FROM produk ORDER BY id_produk DESC LIMIT $posisi,$batas");
  
    $no = $posisi+1;
    while($r=mysql_fetch_array($tampil)){
      $tanggal=tgl_indo($r[tgl_masuk]);
      $harga=format_rupiah($r[harga]);
      echo "<tr><td>$no</td>
                <td>$r[nama_produk]</td>
                <td align=center>$r[berat]</td>
                <td>$harga</td>
				<td align=center>$r[diskon]</td>
                <td align=center>$r[stok]</td>
                <td>$tanggal</td>
		            <td><a href=?module=produk&act=editproduk&id=$r[id_produk]><b>Edit</b></a> | 
		                <a href=$aksi?module=produk&act=hapus&id=$r[id_produk]><b>Hapus</a></b></td>
		        </tr>";
      $no++;
    }
    echo "</table>";

    $jmldata = mysql_num_rows(mysql_query("SELECT * FROM produk"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

    echo "<div id=paging>Hal: $linkHalaman</div><br>";
    
    echo endbreadcrumb();
     
    break;
  
  case "tambahproduk":
    echo breadcrumb("Produk");
    echo rowfluid("Tambah Produk");

    echo "
          <form method=POST action='$aksi?module=produk&act=input' enctype='multipart/form-data'>
          <table class='table'>
          <tr><td class='span2'>Nama Produk</td>     <td> : <input type=text name='nama_produk' class='span4'></td></tr>
          <tr><td class='span2'>Kategori</td>  <td> : 
          <select class='span4' name='kategori'>
            <option value=0 selected>- Pilih Kategori -</option>";
            $tampil=mysql_query("SELECT * FROM kategori ORDER BY nama_kategori");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value=$r[id_kategori]>$r[nama_kategori]</option>";
            }
    echo "</select></td></tr>
          <tr><td class='span2'>Berat</td>     <td> : <input type=text name='berat' class='span4'></td></tr>
          <tr><td class='span2'>Harga</td>     <td> : <input type=text name='harga' class='span4'></td></tr>
          <tr><td class='span2'>diskon</td>     <td> : <input type=text name='diskon' class='span4'></td></tr>
		      <tr><td class='span2'>Stok</td>     <td> : <input type=text name='stok' class='span4'></td></tr>
          <tr><td class='span2'>Deskripsi</td>  <td> <textarea name='deskripsi' style='width: 600px; height: 350px;'></textarea></td></tr>
          <tr><td class='span2'>Gambar</td>      <td> : <input type=file name='fupload' class='span4'> 
                                          <br>Tipe gambar harus JPG/JPEG dan ukuran lebar maks: 400 px</td></tr>
          <tr><td colspan=2><input type=submit class='tombol' value=Simpan>
                            <input type=button class='tombol' value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
          echo endbreadcrumb();
    
     break;
    
  case "editproduk":
    $edit = mysql_query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo breadcrumb("Produk");
    echo rowfluid("Edit Produk");

    echo "
          <form method=POST enctype='multipart/form-data' action=$aksi?module=produk&act=update>
          <input type=hidden name=id value=$r[id_produk]>
          <table class='table'>
          <tr><td class='span2'>Nama Produk</td>     <td> : <input type=text name='nama_produk' class='span4' value='$r[nama_produk]'></td></tr>
          <tr><td>Kategori</td>  <td> : <select  class='span4' name='kategori'>";
 
          $tampil=mysql_query("SELECT * FROM kategori ORDER BY nama_kategori");
          if ($r[id_kategori]==0){
            echo "<option value=0 selected>- Pilih Kategori -</option>";
          }   

          while($w=mysql_fetch_array($tampil)){
            if ($r[id_kategori]==$w[id_kategori]){
              echo "<option value=$w[id_kategori] selected>$w[nama_kategori]</option>";
            }
            else{
              echo "<option value=$w[id_kategori]>$w[nama_kategori]</option>";
            }
          }
    echo "</select></td></tr>
          <tr><td class='span2'>Berat</td>     <td> : <input type=text name='berat' value=$r[berat] class='span4'></td></tr>
          <tr><td class='span2'>Harga</td>     <td> : <input type=text name='harga' value=$r[harga] class='span4'></td></tr>
	        <tr><td class='span2'>Diskon</td>     <td> : <input type=text name='diskon' value=$r[diskon] class='span4'></td></tr>
          <tr><td class='span2'>Stok</td>     <td> : <input type=text name='stok' value=$r[stok] class='span4'></td></tr>
          <tr><td class='span2'>Deskripsi</td>   <td> <textarea name='deskripsi' style='width: 600px; height: 350px;'>$r[deskripsi]</textarea></td></tr>
          <tr><td class='span2'>Gambar</td>       <td> :  
          <img src='../foto_produk/small_$r[gambar]'></td></tr>
          <tr><td class='span2'>Ganti Gbr</td>    <td> : <input type=file name='fupload' size=30> *)</td></tr>
          <tr><td colspan=2>*) Apabila gambar tidak diubah, dikosongkan saja.</td></tr>
          <tr><td colspan=2><input type=submit class='tombol' value=Update>
                            <input type=button class='tombol' value=Batal onclick=self.history.back()></td></tr>
         </table></form>";

         echo endbreadcrumb();
    
    break;  
}
}
?>
