<?php
session_start();

  

if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
    echo "<link href='style.css' rel='stylesheet' type='text/css'> <center>Untuk mengakses modul, Anda harus login <br>";  
    echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else
{
    $aksi="modul/mod_menuutama/aksi_menuutama.php";
    switch($_GET[act]){
      // Tampil Menu Utama
      default:
        echo breadcrumb("Menu Utama");
        echo rowfluid("Daftar Menu Utama");

        echo "<input type=button class='btn btn-primary' value='Tambahkan Menu Utama' 
              onclick=\"window.location.href='?module=menuutama&act=tambahmenuutama';\">
              <table style='font-size: 13px; line-height: 18px; color: #333;' class='table table-striped'>
                        <tr><th>No</th><th>Menu Utama</th><th>Link</th><th>Aktif</th><th>Aksi</th></tr>"; 

        $tampil=mysql_query("SELECT * FROM mainmenu");
        $no=1;

        while ($r=mysql_fetch_array($tampil)){
           echo "<tr><td>$no</td>
                 <td>$r[nama_menu]</td>
                 <td>$r[link]</td>
                 <td align=left>$r[aktif]</td>
                 <td><a href=?module=menuutama&act=editmenuutama&id=$r[id_main] class='btn btn-info'> <i class='icon-edit icon-white'></i> Edit</a>
                 </td></tr>";
          $no++;
        }
        echo "</table>";
        echo "<div id=paging>*) Data pada Menu tidak bisa dihapus, tapi bisa di non-aktifkan melalui Edit Menu Utama.</div><br>";
        echo endbreadcrumb();
      break;
      
      // Form Tambah Menu Utama
      case "tambahmenuutama":
        echo breadcrumb("Menu Utama");
        echo rowfluid("Tambah Menu Utama");
        echo "
          <form method=POST action='$aksi?module=menuutama&act=input'>
          <table class='table'>
          <tr><td class='span2'>Nama Menu</td><td> : <input type='text' name='nama_menu' class='span4'></td></tr>
          <tr><td class='span2'>Link</td><td> : <input type='text' name='link' class='span4'></td></tr>
          <tr><td colspan=2><input type='submit' name='submit' class='btn btn-primary' value=Simpan>
                            <input type='button' class='btn btn-primary' value='Batal' onclick=self.history.back()></td></tr>
          </table></form>";

        echo endbreadcrumb();
      break;
      
      // Form Edit Menu Utama
      case "editmenuutama":
        $edit=mysql_query("SELECT * FROM mainmenu WHERE id_main='$_GET[id]'");
        $r=mysql_fetch_array($edit);
        echo breadcrumb("Menu Utama");
        echo rowfluid("Edit Menu Utama");  
 
        echo "
              <form method=POST action=$aksi?module=menuutama&act=update>
              <input type=hidden name=id value='$r[id_main]'>
              <table class='table smallfont'>
              <tr><td class='span2'>Nama Menu</td><td> : <input type='text' name='nama_menu' value='$r[nama_menu]' class='span4'></td></tr>
              <tr><td class='span2'>Link</td><td> : <input type='text' name='link' value='$r[link]' class='span4'></td></tr>";
              
              if ($r[aktif]=='Y'){
                echo "<tr><td>Aktif</td> <td> : <input type='radio' name='aktif' value='Y' checked>Y  
                                                <input type='radio' name='aktif' value='N'> N</td></tr>";
              }
              else{
                echo "<tr><td>Aktif</td> <td> : <input type='radio' name='aktif' value='Y'>Y  
                                                <input type='radio' name='aktif' value='N' checked>N</td></tr>";
              }

        echo "<tr><td colspan=2><input type='submit' class='tombol'  value=Update>
                                <input type='button' class='tombol' value=Batal onclick=self.history.back()></td></tr>
              </table></form>";
        

        echo endbreadcrumb();      
      break;  
    }
  
  }
?>
