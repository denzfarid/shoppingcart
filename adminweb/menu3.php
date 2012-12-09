<?php
include "../config/koneksi.php";

if ($_SESSION[leveluser]=='admin'){
  $sql=mysql_query("select * from modul where aktif='Y' order by urutan");
}

if ($m=mysql_fetch_array($sql)){  
    echo "<li><a href='?module=password'><i class='icon-wrench'></i> Ganti Password</a></li>";
	
	//not use
    //echo "<li><a href='?module=modul'><i class='icon-wrench'></i> Edit Modul Admin</a></li>";
  
}
?>
