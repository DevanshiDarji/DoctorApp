<div class="rightside">
	<section class="content-header">
		<h1>Notification Templates</h1>
		<ol class="breadcrumb">
			<li><a href="{$data.admin_url}home"><i class="fa fa-dashboard"></i> {$data.language_label['Dashboard']}</a></li>
			<li class="active">Notification Templates</li>    
		</ol>
	</section>
</div>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header">
		              	<h3 class="box-title">Notification Templates</h3>
		            </div>
					<form name="frmlist" id="frmlist" action="{$data.admin_url}notificationtemplate/action_update" method="post">
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
                            <!-- <div class="pull-right" style="margin-bottom: 15px;">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default">{$data.language_label['Action']}</button>
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a id="btn-active" >{$data.language_label['Make_Active']}</a></li>
                                        <li><a id="btn-inactive">{$data.language_label['Make_Inactive']}</a></li>
                                        <li><a  id="btn-delete" >{$data.language_label['Delete']}</a></li>
                                    </ul>
                                </div>
                            <button type="button" id="btn-add" onclick="addme('{$data.admin_url}notificationtemplate/create');"  class="btn btn-primary btnuser newadbtn"> {$data.language_label['Add_New']}</button>

                            </div> -->
                            

							<div style='clear:both;'></div>
							<table id="notification_table" class="table table-bordered table-striped">
								<thead>
									<tr class="headings">
										<!-- <th style="padding-right: 8px; width: 115.767px;"><center><input type="checkbox" id="check_all" name="check_all" value="1"></center></th> -->
 										<th>Notification Text</th>
  										<th class="no-link last"><center>{$data.language_label['Action']}</center></th>
									</tr>
								</thead>
								<tbody>
									{section name = i  loop=$data.all_notificationtemplate}
									<tr>
										<!-- <td align="center">
											<input type="checkbox" name="iId[]" id="iId" class="tableflat" value="{$data.all_notificationtemplate[i].iPushNotificationId}"/>
										</td> -->
 										<td>{$data.all_notificationtemplate[i].tText}</td>
 										
										<td align="center">
                                            <a href="{$data.admin_url}notificationtemplate/update/{$data.all_notificationtemplate[i].iPushNotificationId}" style="cursor:pointer;"><i class="fa fa-fw fa-pencil-square-o"></i></a>
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
</div>
{literal}
<script type="text/javascript"> 
	var slug = "{/literal}{if $data.slug neq 'english'}sa{/if}{literal}";
    if(slug == 'sa'){
    	$('#notification_table').dataTable( {
			"language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json"
            },
		  	"aoColumns": [
		  	{ "bSortable": false }, 
 		  	{ "bSortable": false }
		  	]
		});
	}else{
		$('#notification_table').dataTable( {
		  	"aoColumns": [
		  	{ "bSortable": false }, 
		  	{ "bSortable": false }
		  	]
		});
	}
</script>
{/literal}