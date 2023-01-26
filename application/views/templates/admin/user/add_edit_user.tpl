<div class="content-w">
	<!--------------------
	START - Breadcrumbs
	-------------------->
	<ul class="breadcrumb">
		<li class="breadcrumb-item">
			<a href="{$data.admin_url}home">{$data.language_label['Dashboard']}</a>
    	</li>
    	<li class="breadcrumb-item">
      		<a href="{$data.admin_url}user?eUserType=Doctor">View Users</a>
    	</li>
     	<li class="breadcrumb-item">
      		<a href="#">{if $data.action eq 'update'}Update{else}Add{/if} User</a>
    	</li>
  	</ul>
  	<!--------------------
  	END - Breadcrumbs
  	-------------------->
   	<div class="content-i">
    	<div class="content-box">
     		<div class="row">
		  		<div class="col-sm-12">
		    		<div class="element-wrapper">
		      			<div class="element-box">
		      			<form role="form" id="formValidate" action="" method="post" enctype="multipart/form-data">
        					<div class="row">
            					<div class="col-md-12">
                					<div class="box box-primary">
                    					<div class="box-header with-border">
                        					<h3 class="box-title">{$data.label} User</h3>
                    					</div>
		          					</div>
									<div class="form-desc">
			            				{if $data.message neq ''}
	                        			<div class="alert alert-success fade in alert-dismissable" style="margin-top:18px;">
	                            			<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
	                                	{$data.message}
	                            		</div>
	                        		</div>
	                    			{/if}
		          				</div>
                   				<div class="box-body">
                        			<input type="hidden" name="iUserId" id="iUserId" value='{$data.user_detail.iUserId}'>
                        			<input type="hidden" id="db_admin_email" value='{$data.user_detail.vEmail}'>
                        	
									<div class="form-group">
		                        		<label>First Name<sup><span style="color:#CC2131">*</span></sup></label>
		                        		<input type="text" class="form-control" id="vFirstName" name="vFirstName" data-error="Firstname is required" placeholder="Enter FirstName" required="required"  value="{$data.user_detail.vFirstName}">
		                       			<div class="help-block form-text with-errors form-control-feedback"></div>
		                    		</div>
		                    		
		                    		<div class="form-group">
		                        		<label>Last Name<sup><span style="color:#CC2131">*</span></sup></label>
		                        		<input type="text" class="form-control" id="vLastName" name="vLastName" data-error="Lastname is required" placeholder="Enter LastName" required="required" value="{$data.user_detail.vLastName}">
		                        		<div class="help-block form-text with-errors form-control-feedback"></div>
		                    		</div>
		                    		<div class="form-group">
		                        		<label>Degree<sup><span style="color:#CC2131">*</span></sup></label>
		                        		<input type="text" class="form-control" id="vDegree" name="vDegree" data-error="Degree is required" placeholder="Enter Degree" required="required" value="{$data.user_detail.vDegree}">
		                        		<div class="help-block form-text with-errors form-control-feedback"></div>
		                    		</div>
		                    		<div class="form-group">
		                        		<label>Clinic<sup></sup></label>
		                        		<input type="text" class="form-control" id="tClinic" name="tClinic" data-error="Degree is required" placeholder="Enter Clinic"   value="{$data.user_detail.tClinic}">
		                        		 
		                    		</div>
									
									<!--<div class="form-group">
		                        		<label>Email ID<sup><span style="color:#CC2131">*</span></sup></label>
		                        		<input type="email" class="form-control" id="vEmail" name="vEmail" placeholder="Enter Email" required = "required" value="{$data.user_detail.vEmail}" onfocusout="validate();">
		                       			<div class="help-block form-text with-errors form-control-feedback" id="errorMsgEmail"></div>
		                    		</div>-->
		                  			
		                  			<div class="form-group">
		                        		<label>Email ID<sup><span style="color:#CC2131">*</span></sup></label>
		                        		<input type="email" class="form-control" id="vEmail" name="vEmail" placeholder="Enter Email" required="required" value="{$data.user_detail.vEmail}" onfocusout="validate()">
		                       			<div class="help-block form-text with-errors form-control-feedback" id="errorMsgEmail"></div>
		                    		</div>

		                  			{if $data.action eq 'create'}
		                    		<div class="form-group">
		                    			<label>Password<sup><span style="color:#CC2131">*</span></sup></label>
		                        		<input type="password" class="form-control" id="vPassword" name="vPassword" data-error="Password is required" placeholder="Enter Password" required="required" value="{$data.user_detail.vPassword}">
		                       			<div class="help-block form-text with-errors form-control-feedback"></div>
		                    		</div>
	                        		{/if}
	                        		
	                        		<div class="form-group">
	                            		<label>Phone<sup><span style="color:#CC2131">*</span></sup> </label>
	                            		<input type="number" class="form-control" id="vPhone" name="vPhone" data-error="Phone is required" placeholder="Enter Phone" required="required" value="{$data.user_detail.vPhone}">
	                           			<div class="help-block form-text with-errors form-control-feedback"></div>
	                        		</div>
		                        	
		                        	<div class="form-group">
		                        		<label>Gender<sup><span style="color:#CC2131">*</span></sup></label>
		                        		<select class="form-control" name="eGender" id="eGender" data-error="Gender is required"  required="required">
		                        			<option value="">-- Select Gender --</option>
		                        			{section name=i loop=$eGender}
		                        			<option {if $eGender[i] eq $data.user_detail['eGender']} selected="selected" {/if}  value="{$eGender[i]}" {if $eGender[i] eq 'Active' } selected="" {/if}>{$eGender[i]}</option>
		                        			{/section}
		                        		</select>
		                      			<div class="help-block form-text with-errors form-control-feedback"></div>
		                   			</div>
		                        
		                    		<div class="form-group">
		                       			<label>Address</label>
		                        		<textarea class="form-control" name="tAddress" data-error="Address is required" placeholder="Enter Address" required="required">{$data.user_detail.tAddress} </textarea>
		                      			<div class="help-block form-text with-errors form-control-feedback"></div>
		                    		</div>	

		                   			<div class="form-group">
		                    			<label>Profile</label>
										<input type="file" name="vImage" size=""><img alt=""  width="50px" src="{$data.base_url}uploads/user/{$data.user_detail.iUserId}/{$data.user_detail.vImage}" style="border: 1px solid #ddd">
		                    		</div>
		                        
									<div class="form-group">
		                            	<label>Status<sup><span style="color:#CC2131">*</span></sup></label>
		                            	<select class="form-control" name="eStatus" id="eStatus" >
		                                	<option value="">-- Select Status --</option>
		                                	{section name=i loop=$eStatuses}
		                                	<option {if $eStatuses[i] eq $data.user_detail['eStatus']} selected="selected" {/if} {if $data.action eq 'create' && $eStatuses[i] eq 'Active'} selected="" {/if} value="{$eStatuses[i]}" {if $eStatuses[i] eq 'Active' } selected="" {/if}>{$eStatuses[i]}</option>
		                                	{/section}
		                            	</select>
		                            	<div class="help-block form-text with-errors form-control-feedback"></div>
		                        	</div>
                    			</div>
                			</div>
				        	<div class="row">
				            	<div class="col-md-12">
				                	<div class="form-group">
				                    	{if $data.action eq 'create'}
				                    	<button type="submit" id="btn-save" class="btn btn-primary" onclick="validate();">Save</button> 
				                    	{else}
				                        <button type="submit" id="btn-save" class="btn btn-primary" onclick="validate();">Save Change</button>
				                    	{/if}
				                    	<button type="button" class="btn btn-primary" onclick="returnme();">Cancel</button>
				                    	<span  id="loader" style="float: left;padding-right:15px;display: block;"></span>
				                	</div>
				            	</div>
				        	</div>
        				</form>
		      		</div>
		    	</div>
		  	</div>
		</div>
    </div>
</div>
</div>

{literal}
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script type="text/javascript">
		function validate(){
			var vEmail = document.getElementById("vEmail").value;
			var db_admin_email=$('#db_admin_email').val();
			if(vEmail!=db_admin_email){
				$.ajax
					({
				    	type: 'POST',
				    	url: "{/literal}{$data.admin_url}{literal}user/check_Email?email="+db_admin_email,
				    	data:'vEmail='+vEmail,
				    	datatype:'json',
				    	cache: false,
				    	success: function(response)
				    	{
				    		console.log(response);
				        	response = JSON.parse(response);
				        	if(response.valid) {
								$("#errorMsgEmail").text();
		                		$("#errorMsgEmail").css({'color':'#CC2131'});
		                	}else{
		                		$("#errorMsgEmail").text('Email already exist');
		                		$("#errorMsgEmail").css({'color':'#CC2131'});
		                		//document.getElementById("vEmail").setCustomValidity("email valid");
		            		}
		        		}
					});
			}
		}	
		function returnme()
		{
			window.location.href = '{/literal}{$data.admin_url}{literal}user?eUserType=Doctor';
		}	
	</script>
{/literal}
