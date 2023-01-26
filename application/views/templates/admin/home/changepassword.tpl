<div class="content-w">
  <!--------------------
  START - Breadcrumbs
  -------------------->
  <ul class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{$data.admin_url}home">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
      <a href="#">{$data.language_label['Admin_Management']}</a>
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
		          <form role="form" id="formValidate" action="{$data.admin_url}admin_management/changepassword" method="post">
                <input type="hidden" name="iAdminId" value='{$iAdminId}'>
		            <h5 class="form-header">
		              Change Passowrd
		            </h5>
		            <div class="form-desc">
		            {if $data.message neq ''}
                  <div class="alert alert-success fade in alert-dismissable" style="margin-top:18px;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                      {$data.message}
                  </div>
                </div>
                {/if}
     		        <div class="form-group">
    		          <label for="">{$data.language_label['New_Password']}</label><input id="vPassword" name="vPassword"  class="form-control" data-minlength="6" placeholder="Password" required="required" type="password">
    		          <div class="help-block form-text text-muted form-control-feedback">
    	              Minimum of 6 characters
    	            </div>
    		        </div>
    		        <div class="form-group">
    		          <label for="">{$data.language_label['Confirm_Password']}</label><input type="password" class="form-control" id="confirmpwd" name="confirmpwd" data-error="Password do not match" placeholder="Confirm Password" required="required" type="text">
    		          <div class="help-block form-text with-errors form-control-feedback"></div>
    		        </div>
       		      <div class="form-buttons-w">
    		          <button class="btn btn-primary" type="submit"> {$data.language_label['Save_changes']}</button>
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
	<script type="text/javascript">
		var password = document.getElementById("vPassword")
  , confirm_password = document.getElementById("confirmpwd");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
	</script>
{/literal}