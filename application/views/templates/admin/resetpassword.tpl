<!DOCTYPE html>
<html>
  <head>
    <title>Doctor App | Reset Password</title>
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
          <a href=""><img alt="" src="{$data.base_url}assets/img/logo-big.png"></a>
        </div>
        <h4 class="auth-header">
         Change Password
        </h4>
        <form class="form-horizontal" id="changepwd" action="{$data.admin_url}authentication/reset_password" method="post">
        	<input type="hidden" name="vActivationCode" value='{$vActivationCode}'>
          <div class="form-group">
            <label for="">New Password</label><input type="password" class="form-control" id="vPassword" name="vPassword" placeholder="New Password">
             <div class="pre-icon os-icon os-icon-fingerprint"></div>
          </div>
          <div class="form-group">
            <label for="">Confirm Password</label><input  type="password" class="form-control" id="confirmpwd" name="confirmpwd" placeholder="Confirm Password" >
            <div class="pre-icon os-icon os-icon-fingerprint"></div>
          </div>
           
          <div class="buttons-w">
            <button type="submit" id="btn-save" class="btn btn-primary bottom-buffer" >Save Change</button>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
