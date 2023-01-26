<ul class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{$data.admin_url}home">Home</a>
  </li>
  <li class="breadcrumb-item">
    <a href="{$data.admin_url}user">User List</a>
  </li>
  <li class="breadcrumb-item">
    <a href="#"> User Detail</a>
  </li>
</ul>
<!--------------------
  END - Breadcrumbs
  -------------------->
<div class="content-i">
  <div class="content-box">
    <div class="element-wrapper">
      <h6 class="element-header"> User Detail </h6>
      <div class="element-box">
        <h5 class="form-header">
            Detail
        </h5>
        <div class="row">
          <div class="col-md-2">
            <div class="logged-user-w">
              <div class="avatar-w">
              {if $data.user_info.vImage eq '' }
                <img alt="" src="{$data.base_url}assets/img/avatar1.jpg">
              {else}
                <img alt="" src="{$data.base_url}uploads/user/{$data.user_info.iUserId}/thumbnail_{$data.user_info.vImage}">
              {/if}
              </div>
            </div>
          </div>
          <div class="col-md-10">
            <div class="table-responsive">
              <table class="table table-striped">
                <tbody>
                  <tr>
                    <th>Name</th>
                    <td style="text-align:left">{$data.user_info.vFirstName} {$data.user_info.vLastName}</td>
                  </tr>
                  <tr>
                    <th>Email ID</th>
                    <td style="text-align:left">{$data.user_info.vEmail}</td>
                  </tr>
                  <tr>
                    <th>User Type</th>
                    <td style="text-align:left">{$data.user_info.eUserType} </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>