<ul class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{$data.admin_url}home">Home</a>
    </li>
    <li class="breadcrumb-item">
      <a href="{$data.admin_url}user">Chat List</a>
    </li>
    <li class="breadcrumb-item">
      <a href="#"> Chat Detail</a>
    </li>
</ul>

<div class="content-i">
    <div class="content-box">
      <div class="element-wrapper">
        <h6 class="element-header"> Chat Detail </h6>
        <div class="element-box">
          <h5 class="form-header">
            Detail
          </h5>
          <div class="row">
            <div class="table-responsive">
                <table id="conversation" class="table table-striped table-lightfont">
                  <thead>
                    <tr class="headings">
                      <th hidden></th>
                      <th>DoctorName</th>
                      <th>UserType</th>
                      <th>Message</th>
                    </tr>
                    </thead>
                      <tbody>
                        {section name = i loop = $data.chatDetail}
                        <tr> 
                          <td hidden></td>
                          <td>{$data.chatDetail[i].vFirstName} {$data.chatDetail[i].vLastName}</td>
                          <td>{$data.chatDetail[i].eUserType}</td>
                          <td>{$data.chatDetail[i].tMessage}</td>
                        </tr>
                        {/section}
                      </tbody>
                </table>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

{literal}
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script type="text/javascript">
      /*$('#dataTable1').dataTable({
       aaSorting: [[1, 'asc']]
});*/
$(document).ready(function(){
    $('#conversation').dataTable({
     /*aaSorting: [
            [1, 'asc']
        ]*/
    });
  });
</script>
{/literal}