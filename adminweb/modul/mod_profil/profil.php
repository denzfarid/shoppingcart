<?php
$aksi="modul/mod_profil/aksi_profil.php";
switch($_GET[act]){
  // Tampil Profil
  default:
    $sql  = mysql_query("SELECT * FROM modul WHERE id_modul='43'");
    $r    = mysql_fetch_array($sql);
    
    echo breadcrumb("Profil");
    echo rowfluid("Edit Profil");
    

    echo "
          <form method=POST enctype='multipart/form-data' action=$aksi?module=profil&act=update>
          <input type=hidden name=id value=$r[id_modul]>
          <table>  
          <tr><td>
          <textarea name='isi' style='width: 600px; height: 350px;'>$r[static_content]</textarea></td></tr>
          <tr><td><input type=submit class=tombol value=Update></td></tr>
          </table>
          </form>";

    echo endbreadcrumb();
    break;  
}
?>
