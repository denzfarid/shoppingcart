<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_submenu/aksi_submenu.php";
switch($_GET[act]){
  // Tampil Sub Menu
  default:

    echo breadcrumb("Sub Menu");
    echo rowfluid("Daftar Sub Menu");
    

    echo "
          <input type=button class='btn btn-primary' value='Tambahkan Sub Menu' onclick=\"window.location.href='?module=submenu&act=tambahsubmenu';\">
          <table class='table table-striped' style='font-size: 13px; line-height: 18px; color: #333;'>
          <tr><th>No</th><th>Sub Menu</th><th>Menu Utama</th><th>Link Submenu</th><th>Aksi</th></tr>";

    $tampil = mysql_query("SELECT * FROM submenu,mainmenu WHERE submenu.id_main=mainmenu.id_main");
  
    $no = 1;
    while($r=mysql_fetch_array($tampil)){
      echo "<tr><td>$no</td>
                <td>$r[nama_sub]</td>
                <td>$r[nama_menu]</td>
                <td>$r[link_sub]</td>
		            <td><a href=?module=submenu&act=editsubmenu&id=$r[id_sub]><b>Edit</b></a> | 
		                <a href=$aksi?module=submenu&act=hapus&id=$r[id_sub]><b>Hapus</b></a></td>
		        </tr>";
      $no++;
    }
    echo "</table>";
    echo endbreadcrumb();
    break;
  
  case "tambahsubmenu":
    echo breadcrumb("Sub Menu");
    echo rowfluid("Tambah Sub Menu");
    echo "
          <form method=POST action='$aksi?module=submenu&act=input'>
          <table class='table'>
          <tr><td class='span2'>Sub Menu</td>     <td> : <input type=text name='nama_sub' class='span4'></td></tr>
          <tr><td class='span2'>Menu Utama</td>  <td> : 
          <select class='span4' name='menu_utama'>
            <option value=0 selected>- Pilih Menu Utama -</option>";
            $tampil=mysql_query("SELECT * FROM mainmenu ORDER BY nama_menu");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value=$r[id_main]>$r[nama_menu]</option>";
            }
    echo "</select></td></tr>
          <tr><td class='span2'>Link Sub Menu</td><td> : <input type=text name='link_sub' class='span4'></td></tr>
          <tr><td colspan=2><input type=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
      echo endbreadcrumb();
     break;
    
  case "editsubmenu":
    $edit = mysql_query("SELECT * FROM submenu WHERE id_sub='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo breadcrumb("Sub Menu");
    echo rowfluid("Edit Sub Menu");
    echo "
          <form method=POST action=$aksi?module=submenu&act=update>
          <input type=hidden name=id value=$r[id_sub]>
          <table class='table'>
          <tr><td class='span2'>Sub Menu</td>     <td> : <input type=text name='nama_sub' value='$r[nama_sub]' class='span4'></td></tr>
          <tr><td class='span2'>Menu Utama</td>  <td> : <select class='span4' name='menu_utama'>";
 
          $tampil=mysql_query("SELECT * FROM mainmenu ORDER BY nama_menu");
          if ($r[id_main]==0){
            echo "<option value=0 selected>- Pilih Menu Utama -</option>";
          }   

          while($w=mysql_fetch_array($tampil)){
            if ($r[id_main]==$w[id_main]){
              echo "<option value=$w[id_main] selected>$w[nama_menu]</option>";
            }
            else{
              echo "<option value=$w[id_main]>$w[nama_menu]</option>";
            }
          }
    echo "</select></td></tr>
          <tr><td class='span2'>Link Sub Menu</td><td> : <input type=text name='link_sub' value='$r[link_sub]' class='span4'></td></tr>
          <tr><td colspan=2><input type=submit class='tombol' value=Update>
                            <input type=button class='tombol' value=Batal onclick=self.history.back()></td></tr>
         </table></form>";
    echo endbreadcrumb();
    break;  
}
}
?>
