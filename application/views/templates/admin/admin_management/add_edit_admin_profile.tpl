<div class="content-w">
  <!--------------------
  START - Breadcrumbs
  -------------------->
  <ul class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{$data.admin_url}home">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
      <a href="#">{$data.language_label['Admin_Profile_Management']}</a>
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
		        <form role="form" id="formValidate" method="post" enctype="multipart/form-data">
		          <h5 class="form-header">
		            {$data.language_label['Admin_Profile']}
		          </h5>
		          <div class="form-desc">
		            {if $data.message neq ''}
                        <div class="alert alert-success fade in alert-dismissable" style="margin-top:18px;">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                                {$data.message}
                            </div>
                        </div>
                    {/if}
		          </div>
		          	<input type="hidden" name="iAdminId" value='{$data.admin_detail.iAdminId}'><input type="hidden" id="db_admin_email" value='{$data.admin_detail.vEmail}'>
		          <div class="form-group">
		            <label for="">{$data.language_label['First_Name']}</label><input id="vFirstName" name="vFirstName" value="{$data.admin_detail.vFirstName}"class="form-control" data-error="First Name is required" placeholder="Enter email" required="required" type="text">
		            <div class="help-block form-text with-errors form-control-feedback"></div>
		          </div>
		          <div class="form-group">
		            <label for="">{$data.language_label['Last_Name']}</label><input id="vLastName" name="vLastName" value="{$data.admin_detail.vLastName}"class="form-control" data-error="Last Name is required" placeholder="Enter Last Name" required="required" type="text">
		            <div class="help-block form-text with-errors form-control-feedback"></div>
		          </div>
		          <div class="form-group">
		            <label for="">Email address</label><input class="form-control" id="vEmail" name="vEmail" value="{$data.admin_detail.vEmail}"data-error="Your email address is invalid" placeholder="Enter email" required="required" type="email">
		            <div class="help-block form-text with-errors form-control-feedback"></div>
		          </div>
		          <div class="form-group">
		            <label for="">{$data.language_label['Mobile_No']}</label><input id="vPhone" name="vPhone" value="{$data.admin_detail.vPhone}" maxlength="10"value="{$data.admin_detail.vLastName}"class="form-control" data-error="Mobile is required" placeholder="Enter Mobile" required="required" type="text">
		            <div class="help-block form-text with-errors form-control-feedback"></div>
		          </div>
		          <div class="form-group">
		            <label for="">{$data.language_label['Address']}</label><input id="tAddress" name="tAddress" value="{$data.admin_detail.tAddress}"class="form-control" >
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