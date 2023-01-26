<script src="{$data.admin_js_path}configurations.js"></script>
	
	<div class="rightside">
		<section class="content-header">
			<h1>{$data.language_label['Configurations']}</h1>
			<ol class="breadcrumb">
				<li><a href="{$data.admin_url}home"><i class="fa fa-dashboard"></i> {$data.language_label['Home']}</a></li>
				<li class="active">{$data.language_label['Edit_Settings']}</li>    
			</ol>
		</section>
		<section class="content">
			<div class="row">
				<div class="col-md-12">
					<div class="box box-primary">
						<div class="box-header with-border">
							{if $data.message neq ''}
								<div class="span12">
									<div class="alert alert-info">
										{$data.message}
									</div>
								</div>
							{/if}	
							<div style='clear:both;'></div>
							<form  id="frmcategory" action="{$data.admin_url}configuration/update" method="post" enctype="multipart/form-data" role="form">
								<input type="hidden" name="data[iSettingId]" value="{$data.configurations.iSettingId}">
								{section name=i loop=$db_config}
								<div class="box-body">
									<div class="form-group">
										<label>
											<span>{if  $db_config[i]->tDescription eq 'Fb Appsec' || $db_config[i]->tDescription eq 'Fb Appid'||$db_config[i]->tDescription eq 'Facebook Link' || $db_config[i]->tDescription eq 'Pinterest Link' || $db_config[i]->tDescription eq 'Twitter Link'}{''}{else}{/if}</span> 
											{$data.language_label[{$db_config[i]->tDescription|replace:' ':'_'}]}
											
										</label>
										{if $db_config[i]->tDescription eq 'Admin Email Id'||$db_config[i]->tDescription eq 'Mail Footer' ||$db_config[i]->tDescription eq 'Company Name'}
											<input type="text"  id="{$db_config[i]->vName}" name="Data[{$db_config[i]->vName}]" class="span2 form-control" value="{$db_config[i]->vValue}" title="{$db_config[i]->tDescription}"/>
										
										{else if $db_config[i]->tDescription eq 'Site Name'}
											<input type="text"  id="{$db_config[i]->vName}" name="Data[{$db_config[i]->vName}]" class="span2 form-control" value="{$db_config[i]->vValue}" title="{$db_config[i]->tDescription}" />
											
										{else if $db_config[i]->tDescription eq 'Site Url'}
											<input type="text"  id="{$db_config[i]->vName}" name="Data[{$db_config[i]->vName}]" class="span2 form-control" value="{$data.Site_Url}" title="{$db_config[i]->tDescription}" disabled="disable;" />
														
										{else}
											<input type="text"  id="{$db_config[i]->vName}" name="Data[{$db_config[i]->vName}]" class="span2 form-control" value="{$db_config[i]->vValue}" title="{$db_config[i]->tDescription}"/>
										
										{/if}

									</div>
								</div>
								{/section}
								<div class="box-footer">
									<button type="submit" id="btn-save" class="btn btn-primary" >{$data.language_label['Edit_Configurations']}</button>
									<button type="button" class="btn btn-primary" onclick="returnme();">{$data.language_label['Cancel']}</button>
								</div>
							</form>				
						</div>
					</div>	
				</div>
			</div>
		</section>	
	</div>	

{literal}
<script type="text/javascript">
	function returnme()
	{
		window.location.href = base_url;
	}

</script>
{/literal}