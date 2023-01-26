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
    <h1>Notification Detail</h1>
    <ol class="breadcrumb">
        <li><a href="{$data.admin_url}home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="current"><a href="{$data.admin_url}pushnotification">View Notification</a></li>
        <li class="current">Notification Details</li>
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
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Notification Detail</a>
                        </h4>
                    </div>
                    <div id="collapse2" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="col-xs-10 table-responsive">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <th>First Name</th>
                                            <td style="text-align:left">{$data.notificationDetails.vFirstName}</td>
                                        </tr>
                                        <tr>
                                            <th>Last Name</th>
                                            <td style="text-align:left">{$data.notificationDetails.vLastName}</td>
                                        </tr>
                                        <tr>
                                            <th>Text</th>
                                            <td style="text-align:left">{$data.notificationDetails.tText} </td>
                                        </tr>
                                         <tr>
                                            <th>Date Time</th>
                                            <td style="text-align:left">{$data.notificationDetails.eDateTime}</td>
                                        </tr>
                                        <tr>
                                            <th>Type</th>
                                            <td style="text-align:left">{$data.notificationDetails.vType}</td>
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
</section>
{literal}
   <script type="text/javascript">
          $('#user_listing').dataTable( {
        "aoColumns": [
        null,
        null,
        null,
        null,
        null
        ]
    });   
    </script>
{/literal}