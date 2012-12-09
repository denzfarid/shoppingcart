<?php

function breadcrumb($value)
  {
    $result = '<div>
        <ul class="breadcrumb">
          <li>
            <a href="index.html">Administrator</a> <span class="divider">/</span>
          </li>
          <li class="active">'.$value.'</li>
        </ul>
      </div>';

    return $result;
  }

  function rowfluid($value)
  {
    $result = '<!-- Table -->
                <div class="row-fluid">
                  <div class="span12">
                    <!-- Portlet: Member List -->
                      <div class="box" id="box-0">
                        <h4 class="box-header round-top">'.$value.'</h4>         
                          <div class="box-container-toggle">
                            <div class="box-content">
                              <div id="datatable_wrapper" class="dataTables_wrapper" role="grid">
                                <div class="row-fluid">';
    return $result;
  }

  function endbreadcrumb()
  {
      $result ='
                </div>            
                </div>
                </div>
                </div><!--/span-->
                </div>
                </div>';
      return $result;
  }
?>