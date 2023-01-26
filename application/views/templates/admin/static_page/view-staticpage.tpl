<section class="content-header">
	<h1>CMS Pages </h1>
	<ol class="breadcrumb">
		<li><a href="{$data.admin_url}/home"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Static Pages</li>
	</ol>
</section>
<section class="content">
	<div class="row">
        <div class="col-md-12">
        	<div class="box">
                <div class="box-header">
                    <h3 class="box-title">Static pages</h3>
                </div>
                <form name="frmlist" id="frmlist" action="{$data.admin_url}static_page/action_update" method="post">
                	<input type="hidden" name="action" id="action">
                	<div class="box-body">
                		{if $data.message neq ''}
                        <div class="span12">
                            <div class="alert alert-info">
                                {$data.message}
                            </div>
                        </div>
                        {/if}
                        
                        <div class="margin">
                            <div class="pull-right" style="margin-bottom: 15px;">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default">Action</button>
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a id="btn-active" >Make Active</a></li>
                                        <li><a id="btn-inactive">Make Inactive</a></li>
                                        <li><a  id="btn-delete" >Delete</a></li>
                                    </ul>
                                </div>
                            <button type="button" id="btn-add" onclick="addme('{$data.admin_url}static_page/create');"  class="btn btn-primary btnuser newadbtn"> Add New</button>

                            </div>
                            
                        <div style="clear:both"></div>
                            <table id="static_page" class="table table-bordered table-striped">
                            <thead>
                                <tr class="headings">
                                    <th style="padding-right: 8px; width: 115.767px;"><center><input type="checkbox" id="check_all" name="check_all" value="1"></center></th>
                                    <th>Page Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {section name=i loop=$data.AllPages}
                                    <tr>
                                        <td align="center"><input type="checkbox" name="iId[]" value="{$data.AllPages[i].iSPageId}"/></td>
                                        <td>{$data.AllPages[i].vPageName}</td>
                                        <td>{$data.AllPages[i].eStatus}</td>
                                        

                                        <td align="center">
                                            <a href="{$data.base_url}admin/static_page/update/{$data.AllPages[i].iSPageId}" style="cursor:pointer;"><i class="fa fa-fw fa-pencil-square-o"></i></a>
                                        </td>

                                    </tr>
                                {/section}
                            </tbody>
                        </table>
                        </div>
                	</div>
                </form>
            </div>
        </div>
    </div>
</section>
{literal}
<script type="text/javascript">
    $('#static_page').dataTable( {
        "aoColumns": [
        { "bSortable": false },
        null,
        null,
        { "bSortable": false }
        ]
    }); 
</script>
{/literal}