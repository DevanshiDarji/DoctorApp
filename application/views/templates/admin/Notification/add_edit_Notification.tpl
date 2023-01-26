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
    	<h1>Manage Location</h1>
        <ol class="breadcrumb">
            <li><a href="{$data.admin_url}home">Dashboard</a></li>
            <li><a href="{$data.admin_url}locationmaster">View Location</a></li>  
            <li class="active">{if $data.action eq 'update'}Update{else}Add{/if} Location</li>
        </ol>
    </section>

    <section class="content">
    	<form role="form" id="frmuser" action="{$data.admin_url}locationmaster/{$data.action}" method="post" enctype="multipart/form-data">
    	<div class="row">
    	    <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
						<h3 class="box-title">{$data.label} Location</h3>
					</div>
                	<div class="box-body">
						<input type="hidden" name="iLocationId" id="iLocationId" value='{$data.location_detail.iLocationId}'>
						<div class="form-group">
							<label>Branch<sup><span style="color:#CC2131">*</span></sup></label>
							<input type="hidden" class="form-control" id="iBranchId" name="iBranchId" value="{$allBranch[0].iBranchId}">
							<input type="text" class="form-control" value="{$allBranch[0].vBranchName}" readonly="">
						</div>
						<div class="form-group">
							<label>Location<sup><span style="color:#CC2131">*</span></sup></label>
							<input type="text" class="form-control" id="vLocationName" name="vLocationName" value="{$data.location_detail.vLocationName}">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					{if $data.action eq 'create'}
					<button type="submit" id="btn-save" class="btn btn-primary" >Save</button>
					{else}
						<button type="submit" id="btn-save" class="btn btn-primary" >Save Change</button>
					{/if}
					<button type="button" class="btn btn-primary" onclick="returnme();">Cancel</button>
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
	function returnme()
	{
	    window.location.href = base_url+'locationmaster';
	}
	$(function(){
        $("#vLocationName").geocomplete({
          	map: ".map_canvas",
          	details: "form",
          	types: ["geocode", "establishment"],
        });

        $("#find").click(function(){
          	$("#vLocationName").trigger("geocode");
        });
    });
</script>
{/literal}