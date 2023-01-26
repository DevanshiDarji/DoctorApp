
<style type="text/css">
	.btn.btn-file {
	position: relative;
	width: 120px;
	height: 35px;
	overflow: hidden;
}
.btn.btn-file > input[type='file'] {
	display: block!important;
	width: 100%!important;
	height: 35px!important;
	opacity: 0!important;
	position: absolute;
	top: -10px;
	cursor: pointer;
}
</style>
	<div class="map_canvas"></div>
    <section class="content-header">
    	<h1>{$data.language_label['Notification_Message_Management']}</h1>
        <ol class="breadcrumb">
            <li><a href="{$data.admin_url}home">{$data.language_label['Dashboard']}</a></li>
            <li><a href="{$data.admin_url}notification">{$data.language_label['View_Notification']}</a></li>  
            <li class="active">{if $data.action eq 'update'}{$data.language_label['Update']}{else}{$data.language_label['Add']}{/if} {$data.language_label['Notification']}</li>
        </ol>
    </section>
	
	<section class="content">
		{if $data.action eq 'create'}
    		<form role="form" id="frmnotification" action="{$data.admin_url}notification/{$data.action}" method="post">
    	{else}
    		<form role="form" id="frmnotification1" action="{$data.admin_url}notification/{$data.action}" method="post">
    	{/if}
    		
        <div class="row">
    	    <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
						<h3 class="box-title">{if $data.action eq 'update'}{$data.language_label['Update']}{else}{$data.language_label['Add']}{/if} {$data.language_label['Notification']}</h3>
					</div>
                	<div class="box-body">
						<input type="hidden" name="iPushNotificationId" id="iPushNotificationId" value="{$data.notificationDetail.iPushNotificationId}">
						<input type="hidden" id="db_msgcode" value='{$data.notificationDetail.vMsgCode}'>
						
						<div class="form-group">
							<label>{$data.language_label['Text']}<sup><span style="color:#CC2131">*</span></sup></label>
							<input type="text" class="form-control" id="tText" name="tText" value="{$data.notificationDetail['tText']}">
						</div>
						<div class="form-group">
							<label>{$data.language_label['Message_Code']}<sup><span style="color:#CC2131">*</span></sup></label>
							{if $data.action eq 'create'}
								<input type="text" class="form-control" id="vMsgCode" name="vMsgCode"  value="{$data.notificationDetail['vMsgCode']}" maxlength="4">
							{else}
								<input type="text" class="form-control" id="vMsgCode" name="vMsgCode"  value="{$data.notificationDetail['vMsgCode']}" maxlength="4" readonly>
							{/if}
						</div>
						<div class="form-group">
							<label>{$data.language_label['Status']}<sup><span style="color:#CC2131">*</span></sup></label>
							<select class="form-control" name="eStatus" id="eStatus" >
								<option value="">-- {$data.language_label['Select']} {$data.language_label['Status']} --</option>
								{section name=i loop=$eStatuses}
								<option {if $eStatuses[i] eq $data.notificationDetail['eStatus']} selected="selected" {/if} {if $data.action eq 'create' && $eStatuses[i] eq 'Active'} selected="" {/if} value="{$eStatuses[i]}" {if $eStatuses[i] eq 'Active'} selected="" {/if} >{$eStatuses[i]}</option>
								{/section}
							</select>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					{if $data.action eq 'create'}
						<button type="submit" id="btn-save" class="btn btn-primary" onclick="validate();">{$data.language_label['Save']}</button>
					{else}
						<button type="submit" id="btn-save" class="btn btn-primary" onclick="validate();">{$data.language_label['Save_changes']}</button>
					{/if}
					<button type="button" class="btn btn-primary" onclick="returnme();">{$data.language_label['Cancel']}</button>
					<span  id="loader" style="float: left;padding-right:15px;display: block;"></span>
				</div>
			</div>
		</div>
		</form>
	</section>
	<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places&amp;key=AIzaSyDGT3cNTtpq0Y3FeJyWJHi7yu4vfM6ncT0"></script>
<script src="{$data.admin_js_path}js/jquery.geocomplete.js"></script>
{literal}
<script type="text/javascript">

$(document).ready(function () {
	$('#vMsgCode').keyup(function(){
	    this.value = this.value.toUpperCase();
	});
	$('#vMsgCode').bind('keydown', function(event) {
	  var key = event.which;
	  if (key >=48 && key <= 57) {
	    event.preventDefault();
	  }
	});
});


	$(document).ready(function () {
		$('#frmnotification').bootstrapValidator({
	        message: 'This value is not valid',
	        icon: {
	            valid: 'glyphicon glyphicon-ok',
	            invalid: 'glyphicon glyphicon-remove',
	            validating: 'glyphicon glyphicon-refresh'
	        },
	        fields: {
	            tText: {
	                validators: {
	                    notEmpty: { message: ' {/literal}{$data.language_label["Text_is_required_and_cant_be_empty"]}{literal}' },
	                }
	            },
	            vMsgCode: {
			        validators: {
			            notEmpty: {
			                message: '{/literal}{$data.language_label["Message_Code_is_required_and_cant_be_empty"]}{literal}'
			            },
			            remote: {
			                url: '{/literal}{$data.admin_url}{literal}notification/check_Msgcode?vMsgCode='+db_msgcode,
			                type: 'POST',
			                message: 'Message Code is Already Exist '
			            } 
			        }
			    },

	            eStatus: {
	                validators: {
	                    notEmpty: {
	                        message: ' {/literal}{$data.language_label["Status_is_required_and_cant_be_empty"]}{literal}'
	                    }
	                }
	            },
	        }
	    });
		$('#frmnotification1').bootstrapValidator({
	        message: 'This value is not valid',
	        icon: {
	            valid: 'glyphicon glyphicon-ok',
	            invalid: 'glyphicon glyphicon-remove',
	            validating: 'glyphicon glyphicon-refresh'
	        },
	        fields: {
	            tText: {
	                validators: {
	                    notEmpty: { message: ' {/literal}{$data.language_label["Text_is_required_and_cant_be_empty"]}{literal}' },
	                }
	            },
	           
	            vMsgCode: {
			        validators: {
			            notEmpty: {
			                message: ' {/literal}{$data.language_label["Message_Code_is_required_and_cant_be_empty"]}{literal}'
			            },
			        }
			    },
	            eStatus: {
	                validators: {
	                    notEmpty: {
	                        message: ' {/literal}{$data.language_label["Status_is_required_and_cant_be_empty"]}{literal}'
	                    }
	                }
	            },
	        }
	    });

    });
    
	function returnme()
	{
	    window.location.href = base_url+'notification';
	}
		
</script>
{/literal}