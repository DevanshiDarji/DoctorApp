<ul class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{$data.admin_url}question">question</a>
  </li>
</ul>
<div class="content-i">
  <div class="content-box">
    <div class="element-wrapper">
      <h6 class="element-header"> Question Detail </h6>
      <div class="element-box">
        <h5 class="form-header">
          Question
        </h5>
        <div class="row">
          <div class="col-md-2">
            <div class="logged-user-w">
              <div class="avatar-w">
                {if $data.question.vImage eq '' }
                 <img alt="" src="{$data.base_url}assets/img/avatar1.jpg">
                {else}
                <img alt="" src="{$data.base_url}uploads/user/{$data.question.iUserId}/thumbnail_{$data.question.vImage}">
                {/if}
              </div>
            </div>
          </div>
          
          <div class="col-md-10">
            <div class="table-responsive">
              <table class="table table-striped">
                <tbody>
                  <tr>
                    <th>tQuestion</th>
                    <td style="text-align:left">{$data.question.tQuestion}</td>
                  </tr>
                  <tr>
                    <th>Name</th>
                    <td style="text-align:left">{$data.question.vFirstName}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="element-box">
        <h5 class="form-header">
          Answer
        </h5>
        <div class="row">
          <div class="col-md-12">
            <div class="table-responsive">
              <table id="dataTable1" class="table table-striped table-lightfont">
                <thead>
                  <tr class="headings">
                    <th>Profile</th>
                    <th>Name</th> 
                    <th>Answer</th>
                  </tr>
                </thead>
                <tbody>
                  {section name = i loop = $data.answer}
                  <tr>
                    <td style="padding-right:8px; width:115.767px;" align="center">
                      <div class="logged-user-w">
                        <div class="avatar-w">
                          {if $data.answer[i].vImage eq '' }
                          <img alt="" src="{$data.base_url}assets/img/avatar1.jpg">
                          {else}
                          <img alt="" src="{$data.base_url}uploads/user/{$data.answer[i].iUserId}/thumbnail_{$data.answer[i].vImage}">
                          {/if}
                        </div> 
                      </div>
                    </td>
                    <td>{$data.answer[i].vFirstName}</td>
                    <td>{$data.answer[i].tAnswer}</td>
                  </tr>
                  {/section}
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>