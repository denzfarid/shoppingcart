<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_bank/aksi_bank.php";
switch($_GET[act]){
  // Tampil Bank
  default:
    echo breadcrumb("Rekening Bank Pembayaran");
    echo rowfluid("Daftar Rekening Bank Pembayaran");

    echo "
          <input type='button' class='btn btn-primary' value='Tambah Rekening Bank' onclick=location.href='?module=bank&act=tambahbank'>
          <table style='font-size: 13px; line-height: 18px; color: #333;' class='table table-striped'>
          <tr><th>No</th><th>Nama Bank</th><th>Nomer Rekening</th><th>Nama Pemilik</th><th>Aksi</th></tr>";

    $tampil=mysql_query("SELECT * FROM mod_bank ORDER BY id_bank DESC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
      $tgl=tgl_indo($r[tgl_posting]);
      echo "<tr><td align=left>$no</td>
                <td align=left><img src='../foto_banner/$r[gambar]'></td>
                <td>$r[no_rekening]</td>
                <td>$r[pemilik]</td>
                <td align=left><a href=?module=bank&act=editbank&id=$r[id_bank]><b>Edit</b></a> | 
	                  <a href=$aksi?module=bank&act=hapus&id=$r[id_bank]><b>Hapus</b></a>
		        </tr>";
    $no++;
    }
    echo "</table>";
    echo endbreadcrumb();
    break;
  
  case "tambahbank":

    echo breadcrumb("Rekening Bank Pembayaran");
    echo rowfluid("Tambah Rekening Bank");
    
    echo "
          <form method=POST action='$aksi?module=bank&act=input' enctype='multipart/form-data'>
          <table class='table'>
          <tr><td class='span2'>Nama Bank</td><td>  : <input type='text' name='nama_bank' class='span4'></td></tr>
          <tr><td class='span2'>No. Rekening</td><td>   : <input type='text' name='no_rekening' class='span4'></td></tr>
          <tr><td class='span2'>Nama Pemilik</td><td>   : <input type='text' name='pemilik' class='span4'></td></tr>          
          <tr><td class='span2'>Ganti Gambar</td><td> : <input type='file' name='fupload' class='span4'></td></tr>
          <tr><td colspan=2><input type=submit class=tombol value=Simpan>
                            <input type=button class=tombol value=Batal onclick=self.history.back()></td></tr>
          </table></form><br><br><br>";
    
    echo endbreadcrumb();
   break;
    
  case "editbank":
    $edit = mysql_query("SELECT * FROM mod_bank WHERE id_bank='$_GET[id]'");
    $r    = mysql_fetch_array($edit);
    
    echo breadcrumb("Rekening Bank Pembayaran");
    echo rowfluid("Edit Rekening Bank");
    
    echo "
          <form method=POST enctype='multipart/form-data' action=$aksi?module=bank&act=update>
          <input type=hidden name=id value=$r[id_bank]>
          <table class='table'>
          <tr><td class='span2'>Nama Bank</td><td>     : <input type=text name='nama_bank' size=30 value='$r[nama_bank]' class='span4'></td></tr>
          <tr><td class='span2'>No. Rekening</td><td>      : <input type=text name='no_rekening' size=50 value='$r[no_rekening]' class='span4'></td></tr>
          <tr><td class='span2'>Nama Pemilik</td><td>      : <input type=text name='pemilik' size=50 value='$r[pemilik]' class='span4'></td></tr>
          <tr><td class='span2'>Gambar</td><td>    : <img src='../foto_banner/$r[gambar]'></td></tr>
          <tr><td class='span2'>Ganti Gambar</td><td> : <input type=file name='fupload' class='span4'> *)</td></tr>
          <tr><td colspan=2>*) Apabila gambar tidak diubah, dikosongkan saja.</td></tr>
          <tr><td colspan=2><input type=submit class=tombol value=Update>
                            <input type=button class=tombol value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    echo endbreadcrumb();
    break;  
}
}
?>
