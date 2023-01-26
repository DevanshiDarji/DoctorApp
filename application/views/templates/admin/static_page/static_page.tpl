<div class="rightside">
    <section class="content-header">
    	<h1>CMS Pages</h1>
		<ol class="breadcrumb">
			<li><a href="{$data.admin_url}dashboard">Dashboard</a></li>
			<li><a href="{$data.admin_url}static_page">CMS Page</a></li>
			<li class="current">{if $data.action eq 'create'}Add{else}Update{/if} CMS Page</li>
		</ol>
	</section>
    <section class="content">
    	<div class="row">
    		<div class="col-md-12">
    			<div class="box box-primary">
    				<div class="box-header with-border">
						<h3>{if $data.action eq 'update'}Update{else}Add{/if} CMS Page</h3>
					</div>
					<form id="frmemailtemplate" action="#" method="post" enctype="multipart/form-data">
						<input type="hidden" name="iSPageId" id="iSPageId" value="{$data.page.iSPageId}" />
						<input type="hidden" name="action" id="action" value="add" />
						<div class="box-body">
							<div class="form-group">
								<label for="textfield">Name<sup><span style="color:#CC2131">*</span></sup></label>
								<input type="text" id="vPageName" name="vPageName" class="form-control" value="{$data.page.vPageName}"/>
							</div>

							<div class="form-group">
								<label  for="textarea" style="width:180px;"><span class="red_star"></span> Content</label>
								<textarea id="tContent_{$language_data[0]->vLangCode}" class="content_lang" name="tContent" class="form-control" title="Content_en" value="">{$data.page.tContent_en}</textarea>
							</div>
							{literal}
							<script type="text/javascript">
							var id = '{/literal}{$language_data[0]->vLangCode}{literal}';	
								var editor1=CKEDITOR.replace('tContent_'+id);
								editor1.config.allowedContent = true;
								
							</script>
							{/literal}
						    
						    <div class="form-group">
								<label for="textfield">Status</label>
								<select id="eStatus" class="form-control" name="eStatus">
									<option value="Active" {if $operation neq 'add'} {if $data->eStatus eq Active}selected{/if}{/if}>Active</option>
									<option value="Inactive" {if $operation neq 'add'} {if $data->eStatus eq Inactive}selected{/if}{/if} >Inactive</option>
								</select>
						    </div>       
			                <div class="clear"></div><br>
						    
						    <div class="box-footer">
							    {if $data.label eq 'Add'}
							    <input type="submit" value=Save class="btn btn-success"/>
							    {else}
							    <input type="submit" value=SaveChanges class="btn btn-success"/>
							    {/if}
							    <a href="{$data.admin_url}static_page" class="btn btn-primary">Cancel</a>
						    </div>
						</div>
					</form>
    			</div>
    		</div>
    	</div>
    </section>  
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
	            vPageName: {
	                validators: {
	                    notEmpty: { message: 'Page Name is required and can\'t be empty' },
	                     
	                }
	            },
				eStatus: {
	                validators: {
	                    notEmpty: {
	                        message: 'Status is required and can\'t be empty'
	                    }
	                }
	            }
	        }
	    });
    });

</script>
{/literal}    