  <div class="menu-mobile menu-activated-on-click color-scheme-dark">
    <div class="mm-logo-buttons-w">
      <a class="mm-logo" href="{$data.admin_url}"><img src="{$data.base_url}assets/img/logo.png"><span>Admin</span></a>
      <div class="mm-buttons">
        <div class="content-panel-open">
          <div class="os-icon os-icon-grid-circles"></div>
        </div>
        <div class="mobile-menu-trigger">
          <div class="os-icon os-icon-hamburger-menu-1"></div>
        </div>
      </div>
    </div>
    <div class="menu-and-user">
      <div class="logged-user-w">
        <div class="avatar-w">
          <img alt="" src="{$data.base_url}assets/img/avatar1.jpg">
        </div>
        <div class="logged-user-info-w">
          <div class="logged-user-name">
            {$data.happy_admin_info.vFirstName} {$data.happy_admin_info.vLastName}
          </div>
          <div class="logged-user-role">
            Administrator
          </div>
        </div>
      </div>
      <!--------------------
      START - Mobile Menu List
      -------------------->
      <ul class="main-menu">
        <li class="has-sub-menu {if $data.menuAction eq 'home' || $data.menuAction eq 'question' || $data.menuAction eq 'notification' || $data.menuAction eq 'blog'}active{/if}">
          <a href="{$data.admin_url}">
            <div class="icon-w">
              <div class="os-icon os-icon-window-content"></div>
            </div>
            <span>Dashboard</span></a>
          <ul class="sub-menu">
            <li class="{if $data.menuAction eq 'home'}activesub{/if}">
               <a href="{$data.admin_url}home"> Home </a>
            </li>
            <li class="{if $data.menuAction eq 'question'}activesub{/if}">
               <a href="{$data.admin_url}question">Question</a>
            </li>
            <!-- <li class="{if $data.menuAction eq 'notification'}activesub{/if}">
              <a href="{$data.admin_url}notification">Notification</a>
            </li> -->
            <li class="{if $data.menuAction eq 'blog'}activesub{/if}">
              <a href="{$data.admin_url}blog">Blogs</a>
            </li>
          </ul>
        </li>

        <li class="has-sub-menu {if $data.menuAction eq 'Doctor' || $data.menuAction eq 'Patient'}active{/if}">
          <a href="#">
            <div class="icon-w">
              <div class="os-icon os-icon-user-male-circle"></div>
            </div>
            <span>Users</span>
          </a>
          <ul class="sub-menu">
            <li class="{if $data.menuAction eq 'Doctor'}activesub{/if}">
              <a href="{$data.admin_url}user?eUserType=Doctor">Doctor</a>
            </li>
            <li class="{if $data.menuAction eq 'Patient'}activesub{/if}">
              <a href="{$data.admin_url}user?eUserType=Patient">Patient</a>
            </li>

          </ul>
        </li>
      </ul>
      <!--------------------
      END - Mobile Menu List
      -------------------->
     
    </div>
  </div>
  <!--------------------
  END - Mobile Menu
  --------------------><!--------------------
  START - Menu side 
  -------------------->
  <div class="desktop-menu menu-side-w menu-activated-on-click">
    <div class="logo-w">
      <a class="logo" href="{$data.admin_url}"><img src="{$data.base_url}assets/img/logo.png"><span>Admin</span></a>
    </div>
    <div class="menu-and-user">
      <div class="logged-user-w">
        <div class="logged-user-i">
          <div class="avatar-w">
            <img alt="" src="{$data.base_url}assets/img/avatar1.jpg">
          </div>
          <div class="logged-user-info-w">
            <div class="logged-user-name">
              {$data.happy_admin_info.vFirstName} {$data.happy_admin_info.vLastName}
            </div>
            <div class="logged-user-role">
              Administrator
            </div>
          </div>
          <div class="logged-user-menu">
            <div class="logged-user-avatar-info">
              <div class="avatar-w">
                <img alt="" src="{$data.base_url}assets/img/avatar1.jpg">
              </div>
              <div class="logged-user-info-w">
                <div class="logged-user-name">
                  Maria Gomez
                </div>
                <div class="logged-user-role">
                  Administrator
                </div>
              </div>
            </div>
            <div class="bg-icon">
              <i class="os-icon os-icon-wallet-loaded"></i>
            </div>
            <ul>
            <!--<li>
              <a href="apps_email.html"><i class="os-icon os-icon-mail-01"></i><span>Incoming Mail</span></a>
            </li>-->

              <li>
                <a href="{$data.admin_url}admin_management/update_profile/{$data.happy_admin_info.iAdminId}"><i class="os-icon os-icon-user-male-circle2"></i><span>Profile</span></a>
              </li>
              <li>
                <a href="{$data.admin_url}admin_management/changepassword/{$data.happy_admin_info.iAdminId}"><i class="os-icon os-icon-coins-4"></i><span>Change Password</span></a>
              </li>
              <li>
                <a href="{$data.admin_url}authentication/logout"><i class="os-icon os-icon-signs-11"></i><span>Logout</span></a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <ul class="main-menu">
        <li class="has-sub-menu {if $data.menuAction eq 'home' || $data.menuAction eq 'question' || $data.menuAction eq 'notification' || $data.menuAction eq 'blog' }active{/if}">
          <a href="{$data.admin_url}">
            <div class="icon-w">
              <div class="os-icon os-icon-window-content"></div>
            </div>
            <span>Dashboard</span></a>
          <ul class="sub-menu">
            <li class="{if $data.menuAction eq 'home'}activesub{/if}">
               <a href="{$data.admin_url}home"> Home </a>
            </li>
            <li class="{if $data.menuAction eq 'question'}activesub{/if}">
               <a href="{$data.admin_url}question">Question</a>
            </li>
            <!-- <li class="{if $data.menuAction eq 'notification'}activesub{/if}">
              <a href="{$data.admin_url}notification">Notification</a>
            </li> -->
            <li class="{if $data.menuAction eq 'blog'}activesub{/if}">
              <a href="{$data.admin_url}blog">Blogs</a>
            </li>
          </ul>
        </li>

        <li class="has-sub-menu {if $data.menuAction eq 'Doctor' || $data.menuAction eq 'Patient'}active{/if}">
          <a href="#">
            <div class="icon-w">
              <div class="os-icon os-icon-user-male-circle"></div>
            </div>
            <span>Users</span>
          </a>
          <ul class="sub-menu">
            <li class="{if $data.menuAction eq 'Doctor'}activesub{/if}">
              <a href="{$data.admin_url}user?eUserType=Doctor">Doctor</a>
            </li>
            <li class="{if $data.menuAction eq 'Patient'}activesub{/if}">
              <a href="{$data.admin_url}user?eUserType=Patient">Patient</a>
            </li>

          </ul>
        </li>
      </ul>
    </div>
  </div><!--------------------
        END - Menu side 
        -------------------->