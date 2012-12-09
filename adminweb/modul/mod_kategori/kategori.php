<?php
$aksi="modul/mod_kategori/aksi_kategori.php";
switch($_GET[act]){
  // Tampil Kategori
  default:
  
    echo breadcrumb("Kategori Produk");
    echo rowfluid("Daftar Kategori Produk");

    echo "
          <input type='button' class='btn btn-primary' value='Tambah Kategori' 
          onclick=\"window.location.href='?module=kategori&act=tambahkategori';\">
          <table style='font-size: 13px; line-height: 18px; color: #333;' class='table table-striped'>
          <tr><th>No</th><th>Nama Kategori</th><th>Aksi</th></tr>"; 

    $tampil=mysql_query("SELECT * FROM kategori ORDER BY id_kategori DESC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr><td>$no</td>
             <td>$r[nama_kategori]</td>
             <td><a href=?module=kategori&act=editkategori&id=$r[id_kategori]><b>Edit</b></a> | 
	               <a href=$aksi?module=kategori&act=hapus&id=$r[id_kategori]><b>Hapus</b></a>
             </td></tr>";
      $no++;
    }
    echo "</table>";

    echo endbreadcrumb();
    break;
  
  // Form Tambah Kategori
  case "tambahkategori":
    echo breadcrumb("Kategori Produk");
    echo rowfluid("Tambah Kategori");

    echo "
          <form method=POST action='$aksi?module=kategori&act=input'>
          <table class='table'>
          <tr><td class='span2'>Nama Kategori</td><td> : <input type=text name='nama_kategori' class='span4'></td></tr>
          <tr><td colspan=2><input type=submit name=submit class='tombol'  value=Simpan>
                            <input type=button class='tombol'  value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    echo endbreadcrumb();
    break;
  
  // Form Edit Kategori  
  case "editkategori":
    $edit=mysql_query("SELECT * FROM kategori WHERE id_kategori='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo breadcrumb("Kategori Produk");
    echo rowfluid("Edit  Kategori");


    echo "
          <form method=POST action=$aksi?module=kategori&act=update>
          <input type=hidden name=id value='$r[id_kategori]'>
          <table class='table'>
          <tr><td class='span2'>Nama Kategori</td><td> : <input type=text name='nama_kategori' value='$r[nama_kategori]' class='span4'></td></tr>
          <tr><td colspan=2><input type=submit class='tombol' value=Update>
                            <input type=button class='tombol' value=Batal onclick=self.history.back()></td></tr>
          </table></form>";

      echo endbreadcrumb();


    break;  
}
?>
