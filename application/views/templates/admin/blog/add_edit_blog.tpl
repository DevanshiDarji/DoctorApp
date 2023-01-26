
<div class="content-w">
  <!--------------------
  START - Breadcrumbs
  -------------------->
  <ul class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{$data.admin_url}home">{$data.language_label['Dashboard']}</a>
      </li>
      <li class="breadcrumb-item">
          <a href="#">{if $data.action eq 'update'}Update{else}Add{/if} Blog</a>
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
                <form role="form" id="formValidate" action="" method="post" enctype="multipart/form-data">
                  <div class="row">
                      <div class="col-md-12">
                          <div class="box box-primary">
                              <div class="box-header with-border">
                                  <h3 class="box-title">{$data.label} Blogs</h3>
                              </div>
                        </div>
                  <div class="form-desc">
                          {if $data.message neq ''}
                                <div class="alert alert-success fade in alert-dismissable" style="margin-top:18px;">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                                    {$data.message}
                                  </div>
                              </div>
                            {/if}
                      </div>
                          <div class="box-body">
                              <input type="hidden" name="iBlogId" id="iBlogId" value='{$data.blog_detail.iBlogId}'>
                          
                  <div class="form-group">
                                <label>Blog Link<sup><span style="color:#CC2131">*</span></sup></label>
                                <input type="text" class="form-control" id="BlogLink" name="BlogLink" data-error="BlogLink is required" placeholder="Enter BlogLink" required="required"  value="{$data.blog_detail.BlogLink}">
                                <div class="help-block form-text with-errors form-control-feedback"></div>
                            </div>
                          </div>
                      </div>
                  <div class="row">
                      <div class="col-md-12">
                          <div class="form-group">
                              {if $data.action eq 'create'}
                              <button type="submit" id="btn-save" class="btn btn-primary">Save</button> 
                              {else}
                                <button type="submit" id="btn-save" class="btn btn-primary">Save Change</button>
                              {/if}
                              <button type="button" class="btn btn-primary" onclick="returnme();">Cancel</button>
                              <span  id="loader" style="float: left;padding-right:15px;display: block;"></span>
                          </div>
                      </div>
                  </div>
                </form>
              </div>
          </div>
        </div>
    </div>
    </div>
</div>
</div>

{literal}
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script type="text/javascript">
    function returnme()
    {
      window.location.href = '{/literal}{$data.admin_url}{literal}blog';
    } 
  </script>
{/literal}
