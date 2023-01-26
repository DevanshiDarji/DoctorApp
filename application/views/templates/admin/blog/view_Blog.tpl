<ul class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{$data.admin_url}home">Home</a>
  </li>
  <li class="breadcrumb-item">
    <a href="">Blog List</a>
  </li>
</ul>
<div class="content-i">
  <div class="content-box">
    <div class="element-wrapper">
        <h6 class="element-header">
          Blog List
        </h6>
        <div class="element-box">
          <div class="form-desc">
            <form name="frmlist" id="frmlist" action="{$data.admin_url}blog/action_update" method="post">
                <input type="hidden" name="action" id="action">
                  <input type="hidden" id="iBlogId" name="iBlogId" value='{$data.bloglist[0].iBlogId}'>
                  <div class="form-inline justify-content-sm-end"> 
                    <div class="btn-group mr-1 mb-1">
                      <button aria-expanded="false" aria-haspopup="true" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton1" type="button">Action</button>
                      <div aria-labelledby="dropdownMenuButton1" class="dropdown-menu">
                        <a id="btn-delete" class="dropdown-item">Delete</a>
                      </div>
                    </div>
                    <button type="button" id="btn-add" onclick="addme('{$data.admin_url}blog/create');"  class="btn btn-primary btnuser newadbtn">Add New</button>
                  </div> 
                  <div class="table-responsive">
                      <table id="dataTable1" class="table table-striped table-lightfont">
                        <thead>
                          <tr class="headings">
                             <th><center><input type="checkbox" id="check_all" name="check_all" value="1"></center></th>
                            <th>BlogId</th>
                            <th>BlogLinks</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          {section name = i loop = $data.bloglist}
                          <tr>
                            <td style="padding-right:8px; width:115.767px;" align="center">
                              <input type="checkbox" name="iId[]" id="iId" class="tableflat" value="{$data.bloglist[i].iBlogId}" />
                            </td>
                            <td>{$data.bloglist[i].iBlogId}</td>
                            <td>{$data.bloglist[i].BlogLink}</td>
                            <td align="center">
                              <a href="{$data.admin_url}blog/update/{$data.bloglist[i].iBlogId}" style="cursor:pointer;"><i class="os-icon os-icon-pencil-12"></i></a>
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
