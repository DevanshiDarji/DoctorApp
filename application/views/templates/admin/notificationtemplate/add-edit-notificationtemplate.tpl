<div class="rightside">
	<section class="content-header">
		<h1>Notification Template</h1>
		<ol class="breadcrumb">
			<li><a href="{$data.admin_url}home"><i class="fa fa-dashboard"></i> {$data.language_label['Dashboard']}</a></li>
			<li><a href="{$data.admin_url}notificationtemplate">View Notification Template</a></li>
			<li class="active">{if $data.action eq 'update'}{$data.language_label['Update']}{else}{$data.language_label['Add']}{/if} Notification Template</li>
		</ol>
	</section>
	<section class="content">
	<!-- Main row -->
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3>{if $data.action eq 'update'}{$data.language_label['Update']}{else}{$data.language_label['Add']}{/if} Template</h3>
					</div>
					<form id="frmnotificationtemplate" action="{$data.admin_url}notificationtemplate/{$data.action}" method="post" enctype="multipart/form-data">
						<input type="hidden" name="iPushNotificationId" value="{$data.all_notificationtemplate.iPushNotificationId}">
						<div class="box-body">
							<div class="form-group">
								<label for="first-name">Notification Text<sup><span style="color:#CC2131">*</span></sup></label>
								<input type="text" class="form-control" id="tText" name="tText" value="{$data.all_notificationtemplate.tText}">
 							</div>
 						</div>
 						<div class="ln_solid"></div>
							<div class="box-footer">
								{if $data.action eq 'create'}
								<button type="submit" id="btn-save" class="btn btn-success" >{$data.language_label['Save']}</button>
								{else}
									<button type="submit" id="btn-save" class="btn btn-success" >{$data.language_label['Save_changes']}</button>
								{/if}
								<button type="button" class="btn btn-primary" onclick="returnme();">{$data.language_label['Cancel']}</button>
								<span  id="loader" style="float: left;padding-right:15px;display: block;"></span>
								<br><br><span style="color:#CC2131">Note : Don't change word with # keyword.</span>
							</div>
 					</form>
			</div>
		</div>
	</div>
</div>
{literal}
<script type="text/javascript">

	$(document).ready(function () {
		$('#frmnotificationtemplate').bootstrapValidator({
		message: 'This value is not valid',
		icon: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			tText: {
				validators: {
					notEmpty: { message: ' {/literal}{$data.language_label["Notification_Title_is_required_and_cant_be_empty"]}{literal}' },
					 
				}
			}
 		}
	});
});
function returnme()
{
	window.location.href = base_url+'Notificationtemplate';
}
 
</script>
{/literal}