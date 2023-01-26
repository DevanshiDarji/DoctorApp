   <!--------------------
  START - Breadcrumbs
  -------------------->
<ul class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{$data.admin_url}home">Home</a>
  </li>
  <li class="breadcrumb-item">
    <a href="">User List</a>
  </li>
</ul>
  <!--------------------
  END - Breadcrumbs
  -------------------->
<div class="content-i">
  <div class="content-box">
    <div class="element-wrapper">
      <h6 class="element-header">
        User List
      </h6>
      <div class="element-box">
        <h5 class="form-header">
          {$data.userlist[0].eUserType}
        </h5>
        <div class="form-desc">
          <form name="frmlist" id="frmlist" action="{$data.admin_url}user/action_update" method="post">
            <input type="hidden" name="action" id="action">
            <input type="hidden" id="eUserType" name="eUserType" value='{$data.userlist[0].eUserType}'>
            <div class="box-body">
               {if $data.message neq ''}
                <div class="alert alert-success fade in alert-dismissable" style="margin-top:18px;">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                    {$data.message}
                </div>
                {/if}
                <div class="form-inline justify-content-sm-end"> 
                  <div class="btn-group mr-1 mb-1">
                    <button aria-expanded="false" aria-haspopup="true" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton1" type="button">Action</button>
                    <div aria-labelledby="dropdownMenuButton1" class="dropdown-menu">
                      <a id="btn-active" class="dropdown-item">Make Active</a>
                      <a id="btn-inactive" class="dropdown-item">Make Inactive</a>
                      <a id="btn-delete" class="dropdown-item">Delete</a>
                    </div>
                  </div>
                  {if $data.userlist[0].eUserType neq 'Patient'}
                    <button type="button" id="btn-add" onclick="addme('{$data.admin_url}user/create');"  class="btn btn-primary btnuser newadbtn">Add New</button> 
                  {/if}
                </div>
                <div class="table-responsive">
                  <table id="dataTable1" class="table table-striped table-lightfont">
                    <thead>
                      <tr class="headings">
                        <th><center><input type="checkbox" id="check_all" name="check_all" value="1"></center></th>
                        <th>Name</th>
                        <th>Email ID</th>
                        <th>User Type</th>
                        <th>Status</th>
                        <th class=" no-link last"><center>Action</center></th>
                      </tr>
                    </thead>
                    <tbody>
                      {section name = i loop = $data.userlist}
                        <tr>
                          <td style="padding-right:8px; width:115.767px;" align="center">
                            <input type="checkbox" name="iId[]" id="iId" class="tableflat" value="{$data.userlist[i].iUserId}" />
                          </td>
                          <td>{$data.userlist[i].vFirstName} {$data.userlist[i].vLastName}</td>
                          <td>{$data.userlist[i].vEmail}</td>
                          <td>{$data.userlist[i].eUserType}</td>
                          <td>{$data.userlist[i].eStatus}</td>
                          <td align="center">
                            {if $data.userlist[i].eUserType neq 'Patient'}
                              <a href="{$data.admin_url}user/update/{$data.userlist[i].iUserId}" style="cursor:pointer;"><i class="os-icon os-icon-pencil-12"></i></a>
                            {/if}
                            <a href="{$data.admin_url}user/detail/{$data.userlist[i].iUserId}" style="cursor:pointer;"><i class="os-icon os-icon-newspaper"></i></a>
                            <a href="{$data.admin_url}history/historyList/{$data.userlist[i].iUserId}" style="cursor:pointer;"><i class="os-icon os-icon-link-3"></i></a>
                          </td>
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

     