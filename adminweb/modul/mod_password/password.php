<?php
echo breadcrumb("Password");
echo rowfluid("Ganti Password");

    echo "<h2></h2>
          <form method=POST action=modul/mod_password/aksi_password.php>
          <table class='table'>
          <tr><td class='span4'>Masukkan Password Lama</td><td> : <input type=text name='pass_lama' class='span4'></td></tr>
          <tr><td class='span4'>Masukkan Password Baru</td><td> : <input type=text name='pass_baru' class='span4'></td></tr>
          <tr><td class='span4'>Masukkan Lagi Password Baru</td><td> : <input type=text name='pass_ulangi' class='span4'></td></tr>
          <tr><td colspan=2><input type=submit class='tombol' value=Proses>
                            <input type=button class='tombol' value=Batalkan onclick=self.history.back()></td></tr>
          </table></form>";
echo endbreadcrumb();
?>
