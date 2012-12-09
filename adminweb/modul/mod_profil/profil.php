<?php
$aksi="modul/mod_profil/aksi_profil.php";
switch($_GET[act]){
  // Tampil Profil
  default:
    $sql  = mysql_query("SELECT * FROM modul WHERE id_modul='43'");
    $r    = mysql_fetch_array($sql);
    echo '
      <div>
        <ul class="breadcrumb">
          <li>
            <a href="index.html">Dashboard</a> <span class="divider">/</span>
          </li>
          <li>
            <a href="#">Members</a> <span class="divider">/</span>
          </li>
          <li class="active">List</li>
        </ul>
      </div>
    ';

    echo '
     <!-- Table -->
      <div class="row-fluid">
      
        <div class="span12">
           <!-- Portlet: Member List -->
             <div class="box" id="box-0">
              <h4 class="box-header round-top">Members List                 
              </h4>         
              <div class="box-container-toggle">
                  <div class="box-content">
                     <div id="datatable_wrapper" class="dataTables_wrapper" role="grid">
                      <div class="row-fluid">
                        <div class="span6">
          ';                

 

    echo "<h2>Edit Profil</h2>
          <form method=POST enctype='multipart/form-data' action=$aksi?module=profil&act=update>
          <input type=hidden name=id value=$r[id_modul]>
          <table>
      
         <tr><td><textarea name='isi' style='width: 600px; height: 350px;'>$r[static_content]</textarea></td></tr>
         <tr><td><input type=submit class=tombol value=Update></td></tr>
         </form></table>";

    echo "</div>
                     </div>            
                  </div>
              </div>
            </div><!--/span-->
         </div>
      </div>";                            

    break;  
}
?>
