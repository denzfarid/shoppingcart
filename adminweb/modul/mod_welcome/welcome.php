<?php
$aksi="modul/mod_welcome/aksi_welcome.php";
switch($_GET[act]){
  // Tampil Welcome
  default:
    $sql  = mysql_query("SELECT * FROM modul WHERE id_modul='56'");
    $r    = mysql_fetch_array($sql);

    echo breadcrumb("Selamat Datang");
    echo rowfluid("Edit Selamat Datang");

    echo "
          <form method=POST enctype='multipart/form-data' action=$aksi?module=welcome&act=update>
          <input type=hidden name=id value=$r[id_modul]>
          <table>
          <tr><td><textarea name='isi' style='width: 600px; height: 350px;'>$r[static_content]</textarea></td></tr>
          <tr><td><input type=submit class='tombol' value=Update></td></tr>
          </form></table>";

    echo endbreadcrumb();
    break;  
}
?>
