<div class="rightside">
    <section class="content-header">
        <h1>{$data.language_label['Notification_Message_Management']}</h1>
        <ol class="breadcrumb">
            <li><a href="{$data.admin_url}home">{$data.language_label['Dashboard']}</a></li>
            <li class="active">{$data.language_label['View_Notification']}</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{$data.language_label['View_Notification_Management']}</h3>
                    </div>
                    <form name="frmlist" id="frmlist" action="{$data.admin_url}notification/action_update" method="post">
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
                                        <button type="button" class="btn btn-default">{$data.language_label['Action']}</button>
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a id="btn-active" >{$data.language_label['Make_Active']}</a></li>
                                            <li><a id="btn-inactive">{$data.language_label['Make_Inactive']}</a></li>
                                            <li><a  id="btn-delete" >{$data.language_label['Delete']}</a></li>
                                        </ul>
                                    </div>
                                    <button type="button" id="btn-add" onclick="addme('{$data.admin_url}notification/create');"  class="btn btn-primary btnuser newadbtn"> {$data.language_label['Add_New']}</button>
                                </div>
                            <div style='clear:both;'></div>
                            <table id="user_listing" class="table table-bordered table-striped">
                              <thead>
                                    <tr class="headings">
                                        <th style="padding-right: 8px; width: 115.767px; "><center><input type="checkbox" id="check_all" name="check_all" value="1"></center></th>
                                        <th>{$data.language_label['Text']}</th>
                                        <th>{$data.language_label['Message_Code']}</th>
                                        <th>{$data.language_label['Status']}</th>
                                        <th class=" no-link last"><center>{$data.language_label['Action']}</center></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {section name = i loop = $data.notificationmsglist}
                                    <tr>
                                        <td style="padding-right:8px; width:115.767px;" align="center">
                                            <input type="checkbox" name="iId[]" id="iId" class="tableflat" value="{$data.notificationmsglist[i].iPushNotificationId}" />
                                        </td>
                                        <td>{$data.notificationmsglist[i].tText}</td>
                                        <td>{$data.notificationmsglist[i].vMsgCode}</td>
                                        <td>{$data.notificationmsglist[i].eStatus}</td>
                                         <td align="center">
                                            <a href="{$data.admin_url}notification/update/{$data.notificationmsglist[i].iPushNotificationId}" style="cursor:pointer;"><i class="fa fa-fw fa-pencil-square-o"></i></a>
                                        </td>
                                    </tr>
                                    {/section}
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
{literal}
<script type="text/javascript">
    var slug = "{/literal}{if $data.slug neq 'english'}sa{/if}{literal}";
    if(slug == 'sa'){
        $('#user_listing').dataTable( {
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json"
            },
            "aoColumns": [
            { "bSortable": false },
            null,
            null,
            null,

            { "bSortable": false }
            ]
        });
    }else{
        $('#user_listing').dataTable( {
            "aoColumns": [
            { "bSortable": false },
            null,
            null,
            null,
            { "bSortable": false }
            ]
        });
    } 
</script>
{/literal}