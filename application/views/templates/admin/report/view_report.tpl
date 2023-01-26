<div class="rightside">
    <section class="content-header">
        <h1>{$data.language_label['Report_Managment']}</h1>
        <ol class="breadcrumb">
            <li><a href="{$data.admin_url}home">{$data.language_label['Dashboard']}</a></li>
            <li class="active">{$data.language_label['View_Report']}</li>    
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{$data.language_label['View_Report']}</h3>
                    </div>
                    <form name="frmlist" id="frmlist" action="{$data.admin_url}report" method="post">
                        <input type="hidden" name="action" id="action">
                        <div class="box-body">
                            {if $data.message neq ''}
                            <div class="alert alert-success fade in alert-dismissable" style="margin-top:18px;">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                                    {$data.message}
                                </div>
                            </div>
                            {/if}

                            <div class="margin">
                                <div class="pull-left" style="margin-bottom: 15px;">
                                    {if $data.busapp_admin_info.vType eq 'Admin'}
                                     <div class="form-group" style=" padding-left:20px;float:left;" id="monthdisplay">
                                        <label>{$data.language_label['Branch_Name']}</label>
                                        <select class="form-control" name="iAdminId" id="iAdminId">
                                            <option value="">{$data.language_label['Select']} {$data.language_label['Branch_Name']}</option>
                                            {section name=i loop=$data.branchList}
                                             
                                            <option value="{$data.branchList[i]['iAdminId']}"  {if $selectedData["iAdminId"] eq $data.branchList[i]['iAdminId']} selected {/if}>{$data.branchList[i]['vBranchName']}</option>
                                             
                                            {/section}
                                        </select>
                                        
                                    </div>
                                    {/if}
                                    <div class="form-group" style=" padding-left:20px;float:left;" id="monthdisplay">
                                        <label>{$data.language_label['From_Date']}</label>
                                        <input class="form-control datepicker" name="dAttendanceDateFrom" id="dAttendanceDateFrom" value='{$selectedData["dAttendanceDateFrom"]}'>
                                        
                                    </div>
                                    <div class="form-group" style=" padding-left:20px;float:left;" id="monthdisplay">
                                        <label>{$data.language_label['To_Date']}</label>
                                        <input class="form-control datepicker" name="dAttendanceDateTo" id="dAttendanceDateTo" value='{$selectedData["dAttendanceDateTo"]}'>
                                        
                                    </div> 
                                    <div class="form-group" style=" padding-left:20px;float:left;" id="monthdisplay"><br>
                                         <button type="submit" id="btn-add"  class="btn btn-primary btnuser newadbtn" style="margin-top:5px"> {$data.language_label['Generate_Report']}</button>
                                        
                                    </div> 
                                   
                                </div> 
                            <div style='clear:both;'></div>
                            <table id="user_listing" class="table table-bordered table-striped">
                              <thead>
                                    <tr class="headings">
                                          <th>{$data.language_label['Trip_No']}</th>
                                        <th>{$data.language_label['Driver_Name']}</th>
                                        <th>{$data.language_label['Supervisor_Name']}</th>
                                        <th>{$data.language_label['Attendance_Date']}</th>
                                        <th>{$data.language_label['Start_Time']}</th>
                                        <th>{$data.language_label['End_Time']}</th>
                                        <th>{$data.language_label['Action']}</th>

                                      
                                    </tr>
                                </thead>
                                <tbody>
                                    {section name = i loop = $data.triplist}
                                    <tr>
                                         
                                        <td>{$data.triplist[i].vTripNum}</td>
                                        <td>{$data.triplist[i].driverFirstName} {$data.triplist[i].driverLastName}</td>
                                        <td>{$data.triplist[i].supervisorFirstName} {$data.triplist[i].supervisorLastName}</td>
                                        <td>{$data.triplist[i].dAttendanceDate|date_format:'%Y %b %d'}</td>
                                        <td>{$data.triplist[i].dStartDateTime}</td>
                                        <td>
                                            {if $data.triplist[i].dEndDateTime neq '0000-00-00 00:00:00'}
                                                {$data.triplist[i].dEndDateTime}
                                            {else}-
                                            {/if}
                                        </td>
                                        <td align="center">
                                            <a href="{$data.admin_url}report/detail/{$data.triplist[i].iAttendanceId}/{$data.triplist[i].iTripId}" style="cursor:pointer;"><i class="fa fa-fw fa-list"></i></a>
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
    </section>
</div>  <script src="{$data.admin_js_path}plugins/datepicker/bootstrap-datepicker.js"></script>

{literal}
<script type="text/javascript">
    var slug = "{/literal}{if $data.slug neq 'english'}sa{/if}{literal}";
    //alert(slug);
    if(slug == 'sa'){
        $('#user_listing').dataTable( {
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json"
            },
            "aoColumns": [
            { "bSortable": false },
            null,
            null,
            null,
            null,
             null,
            { "bSortable": false }
            ]
        });
    }else{
        $('#user_listing').dataTable( {
            "aoColumns": [
            { "bSortable": false },
            null,
            null,
             null,
             null,
            null,
            { "bSortable": false }
            ]
        });
    }
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
    });

    $(document).ready(function(){
        $("#btn-sdelete").click(function() {
            $("#action").val("Delete");
            var atLeastOneIsChecked = $('input[name="iId[]"]:checked').length > 0;
            if(atLeastOneIsChecked == false){
                //$(".modal-body").html( "<p>Please Select Atleast One Record </p>" );
                $("#ModalForm").modal('show');
                return false;
            }
            $('#frmlist').submit();
        });
        
    }); 
</script>
{/literal}