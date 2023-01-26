<div class="content-w">
  <!--------------------
  START - Breadcrumbs
  -------------------->
  <ul class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="">Dashboard</a>
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
	          <h6 class="element-header">
	            Dashboard
	          </h6>
	          <div class="element-content">
	            <div class="row">
	              <div class="col-sm-4">
	                <a class="element-box el-tablo" href="{$data.admin_url}user?eUserType=Doctor">
  	                <div class="label">
  	                    Doctor
  	                </div>
  	                <div class="value">
  	                  {$data.doctor}
  	                </div>
 	                </a>
	              </div>
	              <div class="col-sm-4">
	                <a class="element-box el-tablo" href="{$data.admin_url}user?eUserType=Patient">
	                  <div class="label">
	                    Patient
	                  </div>
	                  <div class="value">
	                    {$data.patient}
	                  </div> 
	                </a>
	              </div>
                <div class="col-sm-4">
                  <a class="element-box el-tablo" href="{$data.admin_url}question">
                    <div class="label">
                      Question
                    </div>
                    <div class="value">
                      {$data.question}
                    </div> 
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
		
		
