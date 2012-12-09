<?php
$aksi="modul/mod_hubungi/aksi_hubungi.php";
switch($_GET[act]){
  // Tampil Hubungi Kami
  default:

echo breadcrumb("Pesan Masuk");
echo rowfluid("Daftar Pesan Masuk");


    echo "
          <table style='font-size: 13px; line-height: 18px; color: #333;' class='table table-striped'>
          <tr><th>No</th><th>Nama</th><th>Email</th><th>Subjek</th><th>Tanggal</th><th>Aksi</th></tr>";

    $p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);

    $tampil=mysql_query("SELECT * FROM hubungi ORDER BY id_hubungi DESC LIMIT $posisi, $batas");

    $no = $posisi+1;
    while ($r=mysql_fetch_array($tampil)){
      $tgl=tgl_indo($r[tanggal]);
      echo "<tr><td>$no</td>
                <td>$r[nama]</td>
                <td><a href=?module=hubungi&act=balasemail&id=$r[id_hubungi]>$r[email]</a></td>
                <td>$r[subjek]</td>
                <td>$tgl</a></td>
                <td><a href=?module=hubungi&act=balasemail&id=$r[id_hubungi]><b>Baca</b></a> | 
		               <a href=$aksi?module=hubungi&act=hapus&id=$r[id_hubungi]><b>Hapus</b></a></td></tr>";
               
    $no++;
    }
    echo "</table>";
    $jmldata=mysql_num_rows(mysql_query("SELECT * FROM hubungi"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

    echo "<div id=paging>Hal: $linkHalaman</div><br>";

    echo endbreadcrumb();
    break;

  case "balasemail":
    $tampil = mysql_query("SELECT * FROM hubungi WHERE id_hubungi='$_GET[id]'");
    $r      = mysql_fetch_array($tampil);


    echo breadcrumb("Pesan Masuk");
    echo rowfluid("Reply Email");

    echo "
          <form method=POST action='?module=hubungi&act=kirimemail'>
          <table class='table'>
          <tr><td>Kepada</td><td> : <input type=text name='email' size=30 value='$r[email]'></td></tr>
          <tr><td>Subjek</td><td> : <input type=text name='subjek' size=50 value='Re: $r[subjek]'></td></tr>
          <tr><td>Pesan</td><td> <textarea name='pesan' style='width: 600px; height: 350px;'><br><br><br><br>     
  ----------------------------------------------------------------------------------------------------------------------
  $r[pesan]</textarea></td></tr>
          <tr><td colspan=2><input type=submit value=Kirim>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";

          echo endbreadcrumb();
     break;
    
  case "kirimemail":

    mail($_POST[email],$_POST[subjek],$_POST[pesan],"From: e.alzaidi@gmail.com");

    echo breadcrumb("Pesan Masuk");
    echo rowfluid("Status Email");

    echo "
          <p>Email telah sukses terkirim ke tujuan</p>
          <p>[ <a href=javascript:history.go(-2)>Kembali</a> ]</p>";	 		  

          echo endbreadcrumb();
    break;  
}
?>
