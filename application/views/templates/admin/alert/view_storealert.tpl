   <!--------------------
  START - Breadcrumbs
  -------------------->
  <ul class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{$data.admin_url}home">Home</a>
    </li>
    <li class="breadcrumb-item">
      <a href="#">Store Alert</a>
    </li>
   </ul>
  <!--------------------
END - Breadcrumbs
-------------------->
<div class="content-i">
  <div class="content-box">
    <div class="element-wrapper">
      <h6 class="element-header">
        Store Alert List
      </h6>
      <div class="element-box">
        <h5 class="form-header">
          Store Alerts
        </h5>
        <div class="form-desc">
          <form name="frmlist" id="frmlist" action="{$data.admin_url}alert/action_update" method="post">
            <input type="hidden" name="action" id="action">
            <div class="box-body">
              {if $data.message neq ''}
                <div class="alert alert-success fade in alert-dismissable" style="margin-top:18px;">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                      {$data.message}
                </div>
              {/if}
             <!--  <div class="form-inline justify-content-sm-end"> 
                <div class="btn-group mr-1 mb-1">
                  <button aria-expanded="false" aria-haspopup="true" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton1" type="button">Action</button>
                  <div aria-labelledby="dropdownMenuButton1" class="dropdown-menu">
                    <a id="btn-active" class="dropdown-item">Make Active</a>
                    <a id="btn-inactive" class="dropdown-item">Make Inactive</a>
                    <a id="btn-delete" class="dropdown-item">Delete</a>
                  </div>
                </div>
              </div> -->
              <div class="table-responsive">
                <table id="dataTable1" class="table table-striped table-lightfont">
                  <thead>
                    <tr class="headings"> 
                      <th>Store Name</th>
                      <th>Customer Name</th>
                    </tr>
                  </thead>
                  <tbody>
                    {section name = i loop = $data.storeAlert}
                    <tr> 
                      <td><a href="{$data.admin_url}store/detail/{$data.storeAlert[i].iStoreId}">{$data.storeAlert[i].vStoreName}</a> </td>
                      <td><a href="{$data.admin_url}user/detail/{$data.storeAlert[i].iUserId}">{$data.storeAlert[i].vFirstName} {$data.storeAlert[i].vLastName}</a></td> 
                    </tr>
                    {/section}
                  </tbody>
                </table>
              </div>
            </div>  
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
     