<div class="rightside">
	<section class="content-header">
		<h1>{$data.language_label['Email_Templates']}</h1>
		<ol class="breadcrumb">
			<li><a href="{$data.admin_url}home"><i class="fa fa-dashboard"></i> {$data.language_label['Dashboard']}</a></li>
			<li><a href="{$data.admin_url}emailtemplate">{$data.language_label['View_Email_Template']}</a></li>
			<li class="active">{if $data.action eq 'update'}{$data.language_label['Update']}{else}{$data.language_label['Add']}{/if} {$data.language_label['Email_Templates']}</li>
		</ol>
	</section>
	<section class="content">
	<!-- Main row -->
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3>{if $data.action eq 'update'}{$data.language_label['Update']}{else}{$data.language_label['Add']}{/if} {$data.language_label['Email_Templates']}</h3>
					</div>
					<form id="frmemailtemplate" action="{$data.admin_url}emailtemplate/{$data.action}" method="post" enctype="multipart/form-data">
						<input type="hidden" name="iEmailTemplateId" value="{$data.all_emailtemplate.iEmailTemplateId}">
						<div class="box-body">
							<div class="form-group">
								<label for="first-name">{$data.language_label['Email_ID_Title']}<sup><span style="color:#CC2131">*</span></sup></label>
								<input type="text" class="form-control" id="vEmailTitle" name="vEmailTitle" value="{$data.all_emailtemplate.vEmailTitle}">
							</div>
							<div class="form-group">
								<label for="typeahead">{$data.language_label['Email_ID_Code']}<sup><span style="color:#CC2131">*</span></sup></label>
								<input type="text" class="form-control" id="vEmailCode" name="vEmailCode" value="{$data.all_emailtemplate.vEmailCode}">
								
							</div>

							<div class="form-group">
								<label for="typeahead">{$data.language_label['From_Name']}<sup><span style="color:#CC2131">*</span></sup></label>
								<input type="text" class="form-control" id="vFromName" name="vFromName" value="{$data.all_emailtemplate.vFromName}">
							</div>

							<div class="form-group">
								<label class="control-label" for="typeahead">{$data.language_label['From_Email_ID']}<sup><span style="color:#CC2131">*</span></sup></label>
								<input type="text" class="form-control" id="vFromEmail" name="vFromEmail" value="{$data.all_emailtemplate.vFromEmail}">
							</div>
							

							<div class="form-group">
								<label for="typeahead">{$data.language_label['Email_ID_Subject']}<sup><span style="color:#CC2131">*</span></sup> </label>
								<input type="text" class="form-control" id="vEmailSubject" name="vEmailSubject" value="{$data.all_emailtemplate.vEmailSubject}">
							</div>

							<div class="form-group">
								<label for="typeahead">{$data.language_label['Email_ID_Message']}</label>
								<textarea id="tEmailMessage" name="tEmailMessage" cols="10" rows="10">{$data.all_emailtemplate.tEmailMessage}</textarea>
							</div>

							<div class="form-group">
								<label for="typeahead">{$data.language_label['Email_ID_Footer']}<sup><span style="color:#CC2131">*</span></sup> </label>
								<input type="text" class="form-control" id="vEmailFooter" name="vEmailFooter" value="{$data.all_emailtemplate.vEmailFooter}">
							</div>
							
							<div class="form-group">
								<label for="typeahead">{$data.language_label['Send_Type']}<sup><span style="color:#CC2131">*</span></sup> </label>
								<select class="form-control" name="eSendType" id="eSendType">
									<option value="" >-- {$data.language_label['Select_Send_Type']}--</option>
									{section name=i loop =$eSendTypes}
									<option value="{$eSendTypes[i]}" {if $eSendTypes[i] eq $data.all_emailtemplate.eSendType} selected {/if} >{$eSendTypes[i]}</option>
									{/section}
								</select>
							</div>
							
							{if $data.action eq 'update'}
							<div class="form-group">
								<label for="typeahead">{$data.language_label['Status']}<sup><span style="color:#CC2131">*</span></sup></label>
								<select class="form-control" name="eStatus" id="eStatus" >
									<option value="">-- {$data.language_label['Select']} {$data.language_label['Status']} --</option>
									{section name=i loop=$eStatuses}
									<option {if $eStatuses[i] eq $data.all_emailtemplate.eStatus}selected="selected"{/if}value="{$eStatuses[i]}">{$eStatuses[i]}</option>
									{/section}
								</select>
							</div>
							{/if}
							<div class="ln_solid"></div>
							<div class="box-footer">
								{if $data.action eq 'create'}
								<button type="submit" id="btn-save" class="btn btn-success" >{$data.language_label['Save']}</button>
								{else}
									<button type="submit" id="btn-save" class="btn btn-success" >{$data.language_label['Save_changes']}</button>
								{/if}
								<button type="button" class="btn btn-primary" onclick="returnme();">{$data.language_label['Cancel']}</button>
								<span  id="loader" style="float: left;padding-right:15px;display: block;"></span>
							</div>
						</div>
					</form>
			</div>
		</div>
	</div>
</div>
{literal}
<script type="text/javascript">

	$(document).ready(function () {
		$('#frmemailtemplate').bootstrapValidator({
		message: 'This value is not valid',
		icon: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			vEmailTitle: {
				validators: {
					notEmpty: { message: ' {/literal}{$data.language_label["Email_Title_is_required_and_cant_be_empty"]}{literal}' },
					 
				}
			},
			vEmailCode: {
				validators: {
					notEmpty: { message: ' {/literal}{$data.language_label["Email_Code_is_required_and_cant_be_empty"]}{literal}' },
					 
				}
			},
			vFromEmail: {
				validators: {
					notEmpty: {
						message: ' {/literal}{$data.language_label["Email_address_is_required_and_cant_be_empty"]}{literal}'
					},
					emailAddress: {
						message: ' {/literal}{$data.language_label["The_input_is_not_a_valid_email_id"]}{literal}'
					}
				}
			},
			vFromName: {
				validators: {
					notEmpty: {
						message: ' {/literal}{$data.language_label["From_is_required_and_cant_be_empty"]}{literal}'
					},
					 
				}  
			},
			vEmailFooter: {
				validators: {
					notEmpty: {
						message: '{/literal}{$data.language_label["Email_Footer_is_required_and_cant_be_empty"]}{literal}'
					},
					 
				}  
			},
			vEmailSubject: {
				validators: {
					notEmpty: {
						message: ' {/literal}{$data.language_label["Email_Subject_is_required_and_cant_be_empty"]}{literal}'
					},
					 
				}  
			},
			eSendType: {
				validators: {
					notEmpty: {
						message: ' {/literal}{$data.language_label["Send_Type_is_required_and_cant_be_empty"]}{literal}'
					},
					 
				}  
			},
			eStatus: {
				validators: {
					notEmpty: {
						message: ' {/literal}{$data.language_label["Status_is_required_and_cant_be_empty"]}{literal}'
					}
				}
			}
		}
	});
});
function returnme()
{
	window.location.href = base_url+'emailtemplate';
}

$(function () {
    CKEDITOR.replace('tEmailMessage');
});
</script>
{/literal}