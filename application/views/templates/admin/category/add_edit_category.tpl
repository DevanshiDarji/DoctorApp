<div class="content-w">
  <!--------------------
  START - Breadcrumbs
  -------------------->
  <ul class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{$data.admin_url}home">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
      <a href="{$data.admin_url}category">Category List</a>
    </li>
     <li class="breadcrumb-item">
      <a href="#">{if $data.action eq 'update'}Update{else}Add{/if} Category</a>
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
		            {if $data.action eq 'update'}Update{else}Add{/if} Category
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
		          	<input type="hidden" name="iCategoryId" value='{$data.category.iCategoryId}'>
		          <div class="form-group">
		            <label for="">Category Name</label><input id="vCategoryName" name="vCategoryName" value="{$data.category.vCategoryName}"class="form-control" data-error="Category is required" placeholder="Enter Category" required="required" type="text">
		            <div class="help-block form-text with-errors form-control-feedback"></div>
		          </div>
		        <div class="form-group">
						<label>Status<sup><span style="color:#CC2131">*</span></sup></label>
						<select class="form-control" name="eStatus" id="eStatus"  data-error="Status is required" required>
							<option value="">Select Status</option>
 							<option {if  $data.category.eStatus eq 'Active'}selected="selected"{/if}  >Active</option>
 							<option {if  $data.category.eStatus eq 'Inactive'}selected="selected"{/if}  >Inactive</option>
 						</select>
 						<div class="help-block form-text with-errors form-control-feedback"></div>
					</div>
  		          <div class="form-buttons-w">
		            <button class="btn btn-primary" type="submit"> {if $data.action eq 'create'}Save{else}Save Changes{/if}</button>
		          </div>
		        </form>
		      </div>
		    </div>
		  </div>
		</div>
    </div>
   </div>
</div>