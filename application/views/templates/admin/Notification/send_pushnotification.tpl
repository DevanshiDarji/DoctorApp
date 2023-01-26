
    <section class="content-header">
    	<h1>{$data.language_label['Send_Push_Notification']}</h1>
        <ol class="breadcrumb">
            <li><a href="{$data.admin_url}home">{$data.language_label['Dashboard']}</a></li>
            <li><a href="{$data.admin_url}pushnotification">{$data.language_label['View_Notification_Management']}</a></li>  
            <li class="active">{$data.language_label['Send_Push_Notification']}</li>
        </ol>
    </section>

    <section class="content">
    	<form role="form" id="Pushnotificationaddfrm" action='{$data.admin_url}pushnotification/create' method="post" enctype="multipart/form-data">
        <div class="row">
    	    <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
						<h3 class="box-title">{$data.language_label['Send_Push_Notification']}</h3>
					</div>
                	<div class="box-body">
                		<div class="form-group">
							<label>{$data.language_label['Users_Type']} <sup><span style="color:#CC2131">*</span></sup></label>
							<select class="form-control" id='userType' name="userType">
	 							<option value=''>--- {$data.language_label['Select']} {$data.language_label['Users_Type']} ---</option>
	 							<option value='all'>All</option>
								{section name=i loop=$userType}
								<option value='{$userType[i].iUserTypeId}'>{$userType[i].vType}</option>
								{/section}
							</select><br>
						</div>
						
						<div class="form-group">
							<label>{$data.language_label['Title']} </label>
							<input type="text" class="form-control" name="tTitle" id='tTitle'>
							<label><span style='color:#D4645D;font-family:HelveticaNeue-Light;font-size:11px;display:none;' id='callusertitleval'>Please enter title</label>
						</div>
						<div class="form-group">
                            <label class="control-label" for="typeahead">{$data.language_label['Message']} <sup><span style="color:#CC2131">*</span></sup></label>
                            <div class="controls">
                                <textarea class="form-control" id="tMessage" name="tMessage"></textarea>
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<button type="submit" id="btn-save" class="btn btn-primary">{$data.language_label['Send']}</button>
					<span  id="loader" style="float: left;padding-right:15px;display: block;"></span>
				</div>
			</div>
		</div>
		</form>
	</section>
{literal}
<script type="text/javascript">
	$(document).ready(function() {
	    $('#Pushnotificationaddfrm').bootstrapValidator({
	        message: 'This value is not valid',
	        icon: {
	            valid: 'glyphicon glyphicon-ok',
	            invalid: 'glyphicon glyphicon-remove',
	            validating: 'glyphicon glyphicon-refresh'
	        },
	        fields: {
	            iBranchId: {
	                validators: {
	                    notEmpty: { message: ' {/literal}{$data.language_label["Branch_Name_is_required_and_cant_be_empty"]}{literal}' },
	                     
	                }
	            },userType: {
	                validators: {
	                    notEmpty: { message: ' {/literal}{$data.language_label["User_Type_is_required_and_cant_be_empty"]}{literal}' },
	                     
	                }
	            },
	            tTitle: {
	                validators: {
	                    notEmpty: { message: ' {/literal}{$data.language_label["Title_is_required_and_cant_be_empty"]}{literal}' },
	                     
	                }
	            },
	            tMessage: {
	                validators: {
	                    notEmpty: { message: ' {/literal}{$data.language_label["Message_is_required_and_cant_be_empty"]}{literal}' },
	                     
	                }
	            }
	        }
	    });

	     /*$("#userType").change(function(){
	     	var userType = $("#userType").val();
	     	var url = base_url;
	     	$.ajax({
			 	type: "POST",
		 		url: url+"pushnotification/getAllUserByType",
		 		data: {'userType': userType},
		        dataType: "text",  
		        success: function(data){
		        	alert(data);return false;
		        	$('#iBillStateId').html(data);
		        }
		    });
	     });*/
	});
	function returnme()
	{
	    window.location.href = base_url+'pushnotification';
	}
</script>
{/literal}