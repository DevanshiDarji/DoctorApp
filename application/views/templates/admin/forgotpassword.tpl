<!DOCTYPE html>
<html>
  <head>
    <title>Wanted Addz | Forgot Password</title>
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
  </head>
  <body class="auth-wrapper">

    <div class="all-wrapper menu-side with-pattern">
        {if $data.message neq ''}
                <div class="alert alert-warning no-radius no-margin padding-md"><i class="fa fa-info-circle"></i> {$data.message}</div>
            {/if}
      <div class="auth-box-w">
        
        <div class="logo-w">
          <a href="index.html"><img alt="" src="{$data.base_url}assets/img/logo-big.png"></a>
        </div>
        <h4 class="auth-header">
           Forgot your password ?
        </h4>
        <form id="forgotform" method="post" action="{$data.base_url}admin/authentication/forgotpassword">
          <div class="form-group">
            <label for="">Email</label><input type="text" name="vEmail" id="vEmail" class="form-control" placeholder="E-mail"/">
            <div class="pre-icon os-icon os-icon-user-male-circle"></div>
          </div>
         <div class="buttons-w">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Send</button>
           </div>
          <div class="buttons-w">
               
             <a href="{$data.base_url}admin/authentication"><span class="btn btn-primary btn-block btn-left btn-dddd">Back</span></a>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
