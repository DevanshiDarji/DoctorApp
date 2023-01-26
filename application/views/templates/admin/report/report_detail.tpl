<script src="{$data.base_url}assets/admin/krajee/jssor.slider-25.2.0.min.js"></script>
{literal}
<style>
    .jssorl-004-double-tail-spin img {
        animation-name: jssorl-004-double-tail-spin;
        animation-duration: 1.2s;
        animation-iteration-count: infinite;
        animation-timing-function: linear;
    }

    @keyframes jssorl-004-double-tail-spin {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }
    .jssorb052 .i {position:absolute;cursor:pointer;}
    .jssorb052 .i .b {fill:#000;fill-opacity:0.3;stroke:#fff;stroke-width:400;stroke-miterlimit:10;stroke-opacity:0.7;}
    .jssorb052 .i:hover .b {fill-opacity:.7;}
    .jssorb052 .iav .b {fill-opacity: 1;}
    .jssorb052 .i.idn {opacity:.3;}
    .jssora053 {display:block;position:absolute;cursor:pointer;}
    .jssora053 .a {fill:none;stroke:#fff;stroke-width:640;stroke-miterlimit:10;}
    .jssora053:hover {opacity:.8;}
    .jssora053.jssora053dn {opacity:.5;}
    .jssora053.jssora053ds {opacity:.3;pointer-events:none;}
</style>
{/literal}
<section class="content-header">
    <h1>{$data.language_label['Report_Detail']}</h1>
    <ol class="breadcrumb">
        <li><a href="{$data.admin_url}home"><i class="fa fa-dashboard"></i> {$data.language_label['Dashboard']}</a></li>
        <li class="current"><a href="{$data.admin_url}report">{$data.language_label['View_Report']}</a></li>
        <li class="current">{$data.language_label['Report_Detail']}</li>
    </ol>
</section>
<div class="col-xs-12">
</div>
<section class="invoice">
  <div class="row">
        <div class="col-xs-12 table-responsive">
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">{$data.language_label['Report_Detail']}</a>
                        </h4>
                    </div>
                    <div id="collapse2" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="col-xs-10 table-responsive">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <th>{$data.language_label['Trip_No']}</th>
                                            <td style="text-align:left">{$data.tripDetails.vTripNum}</td>
                                        </tr>
                                        <tr>
                                            <th>{$data.language_label['Driver_Name']}</th>
                                            <td style="text-align:left">{$data.tripDetails.driverFirstName} {$data.tripDetails.driverLastName}</td>
                                        </tr>
                                        <tr>
                                            <th>{$data.language_label['Supervisor_Name']}</th>
                                            <td style="text-align:left">{$data.tripDetails.supervisorFirstName} {$data.tripDetails.supervisorLastName}</td>
                                        </tr>
                                         <tr>
                                            <th>{$data.language_label['Start_Time']}</th>
                                            <td style="text-align:left">{$data.tripDetails.dStartDate} {$data.tripDetails.dStartTime}</td>
                                        </tr>
                                        <tr>
                                            <th>{$data.language_label['End_Time']}</th>
                                            <td style="text-align:left">{$data.tripDetails.dEndDate} {$data.tripDetails.dEndTime}</td>
                                        </tr> 
                                        <tr>
                                            <th>{$data.language_label['Start_Location']}</th>
                                            <td style="text-align:left">{$data.tripDetails.vStartLocation} </td>
                                        </tr>
                                        <tr>
                                            <th>{$data.language_label['End_Location']}</th>
                                            <td style="text-align:left">{$data.tripDetails.vEndLocation} </td>
                                        </tr>
                                        <tr>
                                            <th>{$data.language_label['Bus_Name']}</th>
                                            <td style="text-align:left">{$data.tripDetails.vBus}</td>
                                        </tr>
                                        <tr>
                                            <th>{$data.language_label['Plate_Number']}</th>
                                            <td style="text-align:left">{$data.tripDetails.vLicensePlate}</td>
                                        </tr>
                                        <tr>
                                            <th>{$data.language_label['School']}</th>
                                            <td style="text-align:left">{$data.tripDetails.vSchoolName}</td>
                                        </tr>
                                        <tr>
                                            <th>{$data.language_label['Branch']}</th>
                                            <td style="text-align:left">{$data.tripDetails.vBranchName}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">{$data.language_label['Student_Attendance_Details']}</a>
                        </h4>
                    </div>
                    <div id="collapse3" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="col-xs-10 table-responsive">
                               <table id="user_listing" class="table table-bordered table-striped">
                              <thead>
                                    <tr class="headings">
                                        <th>{$data.language_label['Student_Name']}</th>
                                        <th>{$data.language_label['Attendance_Date']}</th>
                                        <th>{$data.language_label['Pick_Up_Date']}</th>
                                        <th>{$data.language_label['Drop_Off_Date']}</th>
                                        <th>{$data.language_label['Attendance']}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {section name = i loop = $data.attendanceDetail}
                                    <tr>
                                        <td>{$data.attendanceDetail[i].vStudentName}</td>
                                        <td>{$data.attendanceDetail[i].dAttendanceDate} {$data.attendanceDetail[i].dAttendanceTime}</td>
                                        <td>{if $data.attendanceDetail[i].dPickupTime neq '00:00:00'}
                                                {$data.attendanceDetail[i].dPickupDate} {$data.attendanceDetail[i].dPickupTime}
                                            {else}-
                                            {/if}
                                        </td>
                                        <td>
                                            {if $data.attendanceDetail[i].dDropTime neq '00:00:00'}
                                                {$data.attendanceDetail[i].dDropDate} {$data.attendanceDetail[i].dDropTime}
                                            {else}-
                                            {/if}
                                        </td>
                                        <td>{$data.attendanceDetail[i].eAttendance}</td>
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
        
    </div>
</section>
{literal}
    <script type="text/javascript">

     var slug = "{/literal}{if $data.slug neq 'english'}sa{/if}{literal}";
    if(slug == 'sa'){
        $('#user_listing').dataTable( {
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json"
            },
            "aoColumns": [
        null,
        null,
        null,
        null,
        null
        ]
        });
    }else{
        $('#user_listing').dataTable( {
            "aoColumns": [
        null,
        null,
        null,
        null,
        null
        ]
        });
    }

           
    </script>
{/literal}