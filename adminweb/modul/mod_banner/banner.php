<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_banner/aksi_banner.php";
switch($_GET[act]){
  // Tampil Banner
  default:

    echo breadcrumb("Link Terkait");
    echo rowfluid("Daftar Link Terkait");
    

    echo "
          <input type='button'  class='btn btn-primary' value='Tambahkan Banner' onclick=location.href='?module=banner&act=tambahbanner'>
          <table style='font-size: 13px; line-height: 18px; color: #333;' class='table table-striped'>
          <tr><th>No</th><th>Judul</th><th>URL</th><th>Tgl. Posting</th><th>Aksi</th></tr>";
    $tampil=mysql_query("SELECT * FROM banner ORDER BY id_banner DESC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
      $tgl=tgl_indo($r[tgl_posting]);
      echo "<tr><td>$no</td>
                <td>$r[judul]</td>
                <td><a href=$r[url] target=_blank>$r[url]</a></td>
                <td>$tgl</td>
                <td><a class='btn btn-info' href=?module=banner&act=editbanner&id=$r[id_banner]><i class='icon-edit icon-white'></i> Edit</a> 
	                  <a class='btn btn-danger' href=$aksi?module=banner&act=hapus&id=$r[id_banner]><i class='icon-trash icon-white'></i> Hapus</a>
		        </tr>";
    $no++;
    }
    echo "</table>";
    echo endbreadcrumb();
    break;
  
  case "tambahbanner":
    echo breadcrumb("Link Terkait");
    echo rowfluid("Tambah Banner");
    echo "
          <form method=POST action='$aksi?module=banner&act=input' enctype='multipart/form-data'>
          <table class='table'>
          <tr><td class='span2'>Judul</td><td>  : <input type=text name='judul' class='span4'></td></tr>
          <tr><td class='span2'>Url</td><td>   : <input type=text name='url' class='span4' value='http://'></td></tr>
          <tr><td class='span2'>Gambar</td><td> : <input type=file name='fupload' class='span4'></td></tr>
          <tr><td colspan=2><input type=submit class=tombol value=Simpan>
                            <input type=button class=tombol value=Batal onclick=self.history.back()></td></tr>
          </table></form><br><br><br>";
    echo endbreadcrumb();
    
     break;
    
  case "editbanner":
    $edit = mysql_query("SELECT * FROM banner WHERE id_banner='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo breadcrumb("Link Terkait");
    echo rowfluid("Edit Banner");
    echo "
          <form method=POST enctype='multipart/form-data' action=$aksi?module=banner&act=update>
          <input type=hidden name=id value=$r[id_banner]>
          <table class='table'>
          <tr><td class='span2'>Judul</td><td>     : <input type=text name='judul' class='span4' value='$r[judul]'></td></tr>
          <tr><td class='span2'>Url</td><td>      : <input type=text name='url' class='span4' value='$r[url]'></td></tr>
          <tr><td class='span2'>Gambar</td><td>    : <img src='../foto_banner/$r[gambar]'></td></tr>
          <tr><td class='span2'>Ganti Gambar</td><td> : <input type=file name='fupload' class='span4'> *)</td></tr>
          <tr><td colspan=2>*) Apabila gambar tidak diubah, dikosongkan saja.</td></tr>
          <tr><td colspan=2><input type=submit class=tombol value=Update>
                            <input type=button class=tombol value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;  
}
}
?>
