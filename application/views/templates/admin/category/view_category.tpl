   <!--------------------
  START - Breadcrumbs
  -------------------->
  <ul class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{$data.admin_url}home">Home</a>
    </li>
    <li class="breadcrumb-item">
      <a href="#">Category List</a>
    </li>
  </ul>
  <!--------------------
  END - Breadcrumbs
  -------------------->
  <div class="content-i">
    <div class="content-box">
      <div class="element-wrapper">
        <h6 class="element-header">Category List</h6>
        <div class="element-box">
          <h5 class="form-header">
            Category
          </h5>
          <div class="table-responsive">
            {if $data.message neq ''}
              <div class="alert alert-success fade in alert-dismissable"  >
                  <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                      {$data.message} 
              </div>
            {/if}
            <div class="form-desc">
              <form  name="frmlist" id="frmlist" action="{$data.admin_url}category/action_update" method="post">
                <input type="hidden" name="action" id="action">
                <div class="box-body">
                  <div class="form-inline justify-content-sm-end">
                    <div class="btn-group mr-1 mb-0">
                      <a href="{$data.admin_url}category/create"><button class="mr-2 mb-2 btn btn-info" type="button">Add</button></a>
                    </div>
                    <div class="btn-group mr-1 mb-2">
                      <button aria-expanded="false" aria-haspopup="true" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton1" type="button">Action</button>
                      <div aria-labelledby="dropdownMenuButton1" class="dropdown-menu">
                        <a id="btn-active" class="dropdown-item">Make Active</a>
                        <a id="btn-inactive" class="dropdown-item">Make Inactive</a>
                        <a id="btn-delete" class="dropdown-item">Delete</a>
                      </div>
                    </div>
                  </div>
                 
                 <table id="dataTable1" class="table table-striped table-lightfont">
                      <thead>
                            <tr class="headings">
                                <th><center><input type="checkbox" id="check_all" name="check_all" value="1"></center></th>
                                <th> Category Name</th>
                                 <th>Status</th>
                                <th class="no-link last"><center>Action</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            {section name = i loop = $data.categorylist}
                            <tr>
                                <td  align="center">
                                    <input type="checkbox" name="iId[]" id="iId" class="tableflat" value="{$data.categorylist[i].iCategoryId}" />
                                </td>
                                <td>{$data.categorylist[i].vCategoryName}  </td> 
                                <td>{$data.categorylist[i].eStatus}</td>
                                <td align="center">
                                  <a href="{$data.admin_url}category/update/{$data.categorylist[i].iCategoryId}" style="cursor:pointer;"><i class="os-icon os-icon-pencil-12"></i></a> 
                                </td>
                            </tr>
                            {/section}
                        </tbody>
                      </table>
                    </div>
                  </form>
                 </div>
            </div>
        </div>
    </div>
   </div>
 </div>
     