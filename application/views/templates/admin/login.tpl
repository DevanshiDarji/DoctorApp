<!DOCTYPE html>
<html>
  <head>
    <title>Doctor App | Login</title>
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
          Login Form
        </h4>
        <form action="{$data.admin_url}authentication" method="post">
          <div class="form-group">
            <label for="">Username</label><input class="form-control" name="vEmail" id="vEmail" placeholder="E-mail" type="text">
            <div class="pre-icon os-icon os-icon-user-male-circle"></div>
          </div>
          <div class="form-group">
            <label for="">Password</label><input class="form-control" placeholder="Enter your password" type="password" name="vPassword" id="vPassword"  >
            <div class="pre-icon os-icon os-icon-fingerprint"></div>
          </div>
           <div class="form-group has-feedback" hidden>
              <select class="form-control" name="slug" id="slug" >
                  {section name=i loop=$data.language}
                  <option value="{$data.language[i].language_directory}" {if $data.language[i].slug eq 'sa'}selected{/if}>{$data.language[i].language_name}</option>
                  {/section}
              </select>
              <span class="glyphicon form-control-feedback"></span>
          </div>
          <div class="buttons-w">
            <button class="btn btn-primary">Log me in</button>
            <div class="form-check-inline">
              <!-- <label class="form-check-label"><input class="form-check-input" type="checkbox">Remember Me</label> -->
               <a style="color:#666;" href="{$data.admin_url}authentication/forgotpassword">Forgot your password?</a><br>
            </div>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
