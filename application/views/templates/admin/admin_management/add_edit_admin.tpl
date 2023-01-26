<section class="content-header">
	<h1>{$data.language_label['Admin_Management']}</h1>
    <ol class="breadcrumb">
        <li><a href="{$data.admin_url}home">{$data.language_label['Dashboard']}</a></li>
        <li><a href="{$data.admin_url}admin_management">{$data.language_label['View_Admins']}</a></li>
        <li class="active">{if $data.action eq 'update'}{$data.language_label['Update']}{else}{$data.language_label['Add']}{/if} {$data.language_label['Admin']}</li>
    </ol>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">{if $data.action eq 'update'}{$data.language_label['Update']}{else}{$data.language_label['Add']}{/if} {$data.language_label['Admin']}</h2>
				</div>

				<form role="form" id="frmadmin" action="{$data.admin_url}admin_management/{$data.action}" method="post" enctype="multipart/form-data">
					<div class="box-body">
						<div class="col-md-6">
							<input type="hidden" name="iAdminId" value='{$data.admin.iAdminId}'>
							<input type="hidden" id="db_admin_email" value='{$data.admin.vEmail}'>
							<div class="form-group">
								<label>{$data.language_label['First_Name']}<sup><span style="color:#CC2131">*</span></sup></label>
								<input type="text" class="form-control" id="vFirstName" name="vFirstName" value="{$data.admin.vFirstName}">
							</div>

							<div class="form-group">
								<label>{$data.language_label['Last_Name']}<sup><span style="color:#CC2131">*</span></sup></label>
								<input type="text" class="form-control" id="vLastName" name="vLastName" value="{$data.admin.vLastName}">
							</div>

							<div class="form-group">
								<label>{$data.language_label['Email_ID']}<sup><span style="color:#CC2131">*</span></sup></label>
								<input type="text" class="form-control" id="vEmail" name="vEmail" value="{$data.admin.vEmail}">
							</div>

							{if $data.action eq 'create'}
								<div class="form-group">
									<label>{$data.language_label['Password']}<sup><span style="color:#CC2131">*</span></sup></label>
									<input type="password" class="form-control" id="vPassword" name="vPassword" value="" data-minlength="6">
								</div>
							{/if}

							<div class="form-group">
								<label>{$data.language_label['Mobile_No']}<sup><span style="color:#CC2131">*</span></sup> </label>
								<input type="text" class="form-control" id="vPhone" name="vPhone" value="{$data.admin.vPhone}">
							</div>

							<div class="form-group">
								<label>{$data.language_label['Address']}</label>
								<textarea class="form-control" name="tAddress" id="tAddress">{$data.admin.tAddress}</textarea>
							</div>
							<input type="hidden" value="2" name="iAdminTypeId" id="iAdminTypeId">

							<div class="form-group">
								<label>{$data.language_label['Status']}<sup><span style="color:#CC2131">*</span></sup></label>
								<select class="form-control" name="eStatus" id="eStatus" >
									<option value="">-- {$data.language_label['Select']} {$data.language_label['Status']} --</option>
									{section name=i loop=$eStatuses}
									<option {if $eStatuses[i] eq $data.admin['eStatus']}selected="selected"{/if} value="{$eStatuses[i]}" {if $data.action eq 'create' && {$eStatuses[i]}=='Active'} selected="" {/if} >{$eStatuses[i]}</option>
									{/section}
								</select>
							</div>
							<div class="form-group">
								{if $data.action eq 'create'}
									<button type="submit" id="btn-save" class="btn btn-primary">{$data.language_label['Save']}</button>
								{else}
									<button type="submit" id="btn-save" class="btn btn-primary">{$data.language_label['Save_changes']}</button>
								{/if}
								<button type="button" class="btn btn-primary" onclick="returnme();">{$data.language_label['Cancel']}</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
{literal}
<script type="text/javascript">
var iAdminId = "{/literal}{$data.iAdminId}{literal}";
	$(document).ready(function() {
	    $("#Listingcheck_all").change(function(){ $(':checkbox.ListingiId').prop('checked', this.checked); });
	    $("#Addcheck_all").change(function(){ $(':checkbox.AddiId').prop('checked', this.checked); });
	    $("#Updatecheck_all").change(function(){ $(':checkbox.UpdateiId').prop('checked', this.checked); });
	    $("#Deletecheck_all").change(function(){ $(':checkbox.DeleteiId').prop('checked', this.checked); });
	    $("#Activecheck_all").change(function(){ $(':checkbox.ActiveiId').prop('checked', this.checked); });
	    $("#Inactivecheck_all").change(function(){ $(':checkbox.InactiveiId').prop('checked', this.checked); });
	    
	});

	function returnme()
	{
	    window.location.href = base_url+'admin_management';
	}

	$(document).ready(function() {
	    $('#frmadmin').bootstrapValidator({
	        message: 'This value is not valid',
	        icon: {
	            valid: 'glyphicon glyphicon-ok',
	            invalid: 'glyphicon glyphicon-remove',
	            validating: 'glyphicon glyphicon-refresh'
	        },
	        fields: {
	            vFirstName: {
	                validators: {
	                    notEmpty: { message: ' {/literal}{$data.language_label["First_Name_is_required_and_cant_be_empty"]}{literal}' },
	                     
	                }
	            },
	            vLastName: {
	                validators: {
	                    notEmpty: { message: ' {/literal}{$data.language_label["Last_Name_is_required_and_cant_be_empty"]}{literal}' },
	                     
	                }
	            },
	            vEmail: {
	                validators: {
	                    notEmpty: {
	                        message: ' {/literal}{$data.language_label["Email_id_is_required_and_cant_be_empty"]}{literal}'
	                    },
	                    emailAddress: {
	                        message: ' {/literal}{$data.language_label["The_input_is_not_a_valid_email_id"]}{literal}'
	                    },remote: {
	                        url: '{/literal}{$data.admin_url}{literal}admin_management/checkEmailExist/'+iAdminId,
	                        type: 'POST',
	                        message: ' {/literal}{$data.language_label["Email_id_is_Already_Exist"]}{literal}'
	                    } 
	                }
	            },
	            vPassword: {
	                validators: {
	                    notEmpty: {
	                    	noSpace: true,
	                    	message: ' {/literal}{$data.language_label["Password_is_required_and_cant_be_empty"]}{literal}'
	                    },
	                    stringLength: { min: 5,
                        	message: ' {/literal}{$data.language_label["The_Password_must_be_greater_than_five_characters"]}{literal}'
                    	}
	                     
	                }  
	            },
	            vPhone: {
	                validators: {
	                    notEmpty: {
	                        message: ' {/literal}{$data.language_label["Phone_Number_is_required_and_cant_be_empty"]}{literal}'
	                    },
	                    integer: {
	                        message: ' {/literal}{$data.language_label["The_value_is_not_an_number"]}{literal}'
	                    }
	                }  
	            },
	            eStatus: {
	                validators: {
	                    notEmpty: {
	                        message: '{/literal}{$data.language_label["Status_is_required_and_cant_be_empty"]}{literal}'
	                    }
	                }
	            }
	        }
	    });
	});

				/*,	
	            iAdminTypeId: {
	                validators: {
	                    notEmpty: {
	                        message: 'Admin Type is required and can\'t be empty'
	                    },
	                }  
	            },*/
</script>
{/literal}