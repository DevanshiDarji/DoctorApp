<!DOCTYPE html>
<html>
<head>
    <title> ::: Doctor App ::: </title>
    <!-- Bootstrap -->
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta content="template language" name="keywords">
    <meta content="Tamerlan Soziev" name="author">
    <meta content="Admin dashboard html template" name="description">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="favicon.png" rel="shortcut icon">
    <link href="apple-touch-icon.png" rel="apple-touch-icon">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500" rel="stylesheet" type="text/css">
    <link href="{$data.admin_css_path}select2/dist/css/select2.min.css" rel="stylesheet">
    <link href="{$data.admin_css_path}bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <link href="{$data.admin_css_path}dropzone/dist/dropzone.css" rel="stylesheet">
    <link href="{$data.admin_css_path}datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="{$data.admin_css_path}fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
    <link href="{$data.admin_css_path}perfect-scrollbar/css/perfect-scrollbar.min.css" rel="stylesheet">
    <link href="{$data.base_url}assets/css/main.css?version=3.7.0" rel="stylesheet">
     {literal}
     <script type="text/javascript">
        //var base_image = '{$data.admin_image_path}';
        var base_url = '{$data.admin_url}';
    </script>   
    {/literal}
 </head>
 <body>
    <div class="all-wrapper menu-side with-side-panel">
      <div class="layout-x">
        {include file="admin/left_sidemenu.tpl"}
        <div class="content-w content-w2">
          <!--------------------
          START - Breadcrumbs
          -------------------->
           {include file=$data.tpl_name}
          <!--------------------
          END - Breadcrumbs
          -------------------->
          <div class="content-panel-toggler">
            <i class="os-icon os-icon-grid-squares-22"></i><span>Sidebar</span>
          </div>
         </div>
      </div>
      <div class="display-type"></div>

      <div aria-hidden="true" id="ModalForm" aria-labelledby="myLargeModalLabel" class="modal fade bd-example-modal-lg" role="dialog" tabindex="-1">
	      <div class="modal-dialog modal-lg">
	        <div class="modal-content">
	          <div class="modal-header">
 	            <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true"> &times;</span></button>
	          </div>
	          <div class="modal-body">
	            {$data.language_label['Please_Select_Atleast_One_Record']}
	          </div>
	          <div class="modal-footer">
	            <button class="btn btn-secondary" data-dismiss="modal" type="button"> {$data.language_label['Close']}</button> 
	          </div>
	        </div>
	      </div>
	    </div> 
      {include file="admin/footer.tpl"}
		
    </div>

    <script src="{$data.admin_css_path}jquery/dist/jquery.min.js"></script>

    <script src="{$data.admin_css_path}moment/moment.js"></script>
    <script src="{$data.admin_css_path}chart.js/dist/Chart.min.js"></script>
    <script src="{$data.admin_css_path}select2/dist/js/select2.full.min.js"></script>
    <script src="{$data.admin_css_path}jquery-bar-rating/dist/jquery.barrating.min.js"></script>
    <script src="{$data.admin_css_path}ckeditor/ckeditor.js"></script>
    <script src="{$data.admin_css_path}bootstrap-validator/dist/validator.min.js"></script>
    <script src="{$data.admin_css_path}bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="{$data.admin_css_path}ion.rangeSlider/js/ion.rangeSlider.min.js"></script>
    <script src="{$data.admin_css_path}dropzone/dist/dropzone.js"></script>
    <script src="{$data.admin_css_path}editable-table/mindmup-editabletable.js"></script>
    <script src="{$data.admin_css_path}datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{$data.admin_css_path}datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="{$data.admin_css_path}fullcalendar/dist/fullcalendar.min.js"></script>
    <script src="{$data.admin_css_path}perfect-scrollbar/js/perfect-scrollbar.jquery.min.js"></script>
    <script src="{$data.admin_css_path}tether/dist/js/tether.min.js"></script>
    <script src="{$data.admin_css_path}bootstrap/js/dist/util.js"></script>
    <script src="{$data.admin_css_path}bootstrap/js/dist/alert.js"></script>
    <script src="{$data.admin_css_path}bootstrap/js/dist/button.js"></script>
    <script src="{$data.admin_css_path}bootstrap/js/dist/carousel.js"></script>
    <script src="{$data.admin_css_path}bootstrap/js/dist/collapse.js"></script>
    <script src="{$data.admin_css_path}bootstrap/js/dist/dropdown.js"></script>
    <script src="{$data.admin_css_path}bootstrap/js/dist/modal.js"></script>
    <script src="{$data.admin_css_path}bootstrap/js/dist/tab.js"></script>
    <script src="{$data.admin_css_path}bootstrap/js/dist/tooltip.js"></script>
    <script src="{$data.admin_css_path}bootstrap/js/dist/popover.js"></script>
    <script src="{$data.base_url}assets/js/main.js?version=3.7.0"></script>
     <script src="{$data.base_url}assets/js/dataTables.bootstrap4.min.js"></script>
     <script src="{$data.base_url}assets/js/common.js"></script>
 
{literal}
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
      
      ga('create', 'UA-XXXXXXXX-9', 'auto');
      ga('send', 'pageview');
    </script>
    {/literal}
    {literal}
            <script type="text/javascript">
               $('#dataTable2').dataTable();
            </script>
            {/literal}
  </body>
</html>
