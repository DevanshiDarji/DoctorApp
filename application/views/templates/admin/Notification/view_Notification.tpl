<ul class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{$data.admin_url}home">Home</a>
  </li>
  <li class="breadcrumb-item">
    <a href="">Notification List</a>
  </li>
</ul>
<div class="content-i">
  <div class="content-box">
    <div class="element-wrapper">
        <h6 class="element-header">
          Notification List
        </h6>
        <div class="element-box">
          <div class="form-desc">
            <form name="frmlist" id="frmlist" action="" method="post">
                <input type="hidden" name="action" id="action">
                  <input type="hidden" id="iUserId" name="iUserId" value='{$data.notificationmsglist[0].iUserId}'>
                    <div class="table-responsive">
                        <table id="dataTable1" class="table table-striped table-lightfont">
                            <thead>
                                <tr class="headings">
                                    <th>UserName</th>
                                    <th>Message</th>
                                    <th>DateTime</th>
                                </tr>
                            </thead>
                            <tbody>
                                {section name = i loop = $data.notificationmsglist}
                                <tr>
                                  <!--<td style="padding-right:8px; width:115.767px;" align="center">
                                        <input type="checkbox" name="iId[]" id="iId" class="tableflat" value="{$data.notificationmsglist[i].iPushNotificationId}" />
                                    </td>-->
                                    <td>{$data.notificationmsglist[i].vFirstName} {$data.notificationmsglist[i].vLastName}</td>
                                    <td>{$data.notificationmsglist[i].tMessage}</td>
                                    <td>{$data.notificationmsglist[i].eDateTime}</td>
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
