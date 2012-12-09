<?php
$aksi="modul/mod_ym/aksi_ym.php";
switch($_GET[act]){
  // Tampil YM
  default:
  echo breadcrumb("Yahoo Messenger Status");
  echo rowfluid("Daftar Yahoo Messenger Status");
  

    echo "
          <input type=button class='btn btn-primary' value='Tambahkan User' 
          onclick=\"window.location.href='?module=ym&act=tambahym';\">
          <table style='font-size: 13px; line-height: 18px; color: #333;' class='table table-striped'>
          <tr><th>No</th><th>Nama</th><th>Username</th><th>Aksi</th></tr>"; 
    $tampil=mysql_query("SELECT * FROM mod_ym ORDER BY id DESC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr><td>$no</td>
             <td>$r[nama]</td>
			 <td>$r[username]</td>
             <td>
				<a class='btn btn-info' href=?module=ym&act=editym&id=$r[id]><i class='icon-edit icon-white'></i> Edit</a>
	            <a class='btn btn-danger' href=$aksi?module=ym&act=hapus&id=$r[id]><i class='icon-trash icon-white'></i> Hapus</a>
             </td></tr>";
      $no++;
    }
    echo "</table>";
	//echo "";
  echo endbreadcrumb();
    break;
  
  // Form Tambah YM
  case "tambahym":
  echo breadcrumb("Yahoo Messenger Status");
  echo rowfluid("Tambah Yahoo Messenger Status");

    echo "
          <form method=POST action='$aksi?module=ym&act=input'>
          <table class='table'>
          <tr><td class='span2'>Nama</td><td> : <input type=text name='nama' class='span4'></td></tr>
		      <tr><td class='span2'>Username</td><td> : <input type=text name='username' class='span4'></td></tr>
          <tr><td colspan=2><input type=submit name=submit class=tombol value=Simpan>
                            <input type=button class=tombol value=Batal onclick=self.history.back()></td></tr>
          </table></form>";

       echo   endbreadcrumb();
     break;
  
  // Form Edit YM  
  case "editym":
    $edit=mysql_query("SELECT * FROM mod_ym WHERE id='$_GET[id]'");
    $r=mysql_fetch_array($edit);

  echo breadcrumb("Yahoo Messenger Status");
  echo rowfluid("Edit Yahoo Messenger Status");

    echo "
          <form method=POST action=$aksi?module=ym&act=update>
          <input type=hidden name=id value='$r[id]'>
          <table class='table'>
          <tr><td class='span2'>Nama</td><td> : <input type=text name='nama' value='$r[nama]' class='span4'></td></tr>
		      <tr><td class='span2'>Username</td><td> : <input type=text name='username' value='$r[username]' class='span4'></td></tr>
          <tr><td colspan=2><input type=submit class=tombol value=Update>
                            <input type=button class=tombol value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
          echo endbreadcrumb();
    break;  
}
?>
