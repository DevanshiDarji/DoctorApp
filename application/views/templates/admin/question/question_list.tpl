<div class="content-w">  
  <!--------------------
  START - Breadcrumbs
  -------------------->
  <ul class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{$data.admin_url}home">Home</a>
    </li>
    <li class="breadcrumb-item">
      <a href="#">QuestionList</a>
    </li>
  </ul>
  <!--------------------
  END - Breadcrumbs
  -------------------->
  <div class="content-i">
    <div class="content-box">
      <div class="element-wrapper">
        <h6 class="element-header">
          Question List
        </h6>
        <div class="element-box">
          <div class="form-desc">
            <form name="frmlist" id="frmlist" action="{$data.admin_url}question/action_delete" method="post">
              <input type="hidden" name="action" id="action">
              <input type="hidden" id="eUserType" value='{$data.userlist[0].eUserType}'>
                <div class="form-inline justify-content-sm-end"> 
                  <div class="btn-group mr-1 mb-1">
                    <button aria-expanded="false" aria-haspopup="true" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton1" type="button">Action</button>
                    <div aria-labelledby="dropdownMenuButton1" class="dropdown-menu">
                      <a id="btn-delete" class="dropdown-item">Delete</a>
                    </div>
                  </div>
                </div>
                <div class="table-responsive">
                  <table id="dataTable1" class="table table-striped table-lightfont">
                    <thead>
                      <tr class="headings">
                        <th><center><input type="checkbox" id="check_all" name="check_all" value="1"></center></th>
                        <th>Question</th>
                        <th>name</th>
                        <th class=" no-link last"><center>Action</center></th>
                      </tr>
                    </thead>
                    <tbody>
                    {section name = i loop = $data.questionlist}
                      <tr>
                        <td style="padding-right:8px; width:115.767px;" align="center">
                          <input type="checkbox" name="iId[]" id="iId" class="tableflat" value="{$data.questionlist[i].iQuestionId}" />
                        </td>
                        <td>{$data.questionlist[i].tQuestion}</td>
                        <td>{$data.questionlist[i].vFirstName}
                        <td align="center">
                          <a href="{$data.admin_url}question/detail/{$data.questionlist[i].iQuestionId}" style="cursor:pointer;"><i class="os-icon os-icon-newspaper"></i></a>
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
    </div>
   </div>
 </div>
     