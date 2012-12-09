<?php
include "../config/koneksi.php";

if ($_SESSION[leveluser]=='admin'){
  $sql=mysql_query("select * from modul where aktif='Y' order by urutan");
}

if ($m=mysql_fetch_array($sql)){  
 //echo "<li><a href='?module=header'><i class='icon-edit'></i> Header</a></li>";
  echo "<li><a href='?module=ym'><i class='icon-edit'></i> Costumer Online</a></li>";
   echo "<li><a href='?module=bank'><i class='icon-edit'></i> Rekening Bank</a></li>";
    echo "<li><a href='?module=banner'><i class='icon-edit'></i> Link Terkait</a></li>";
  
  
}
?>
