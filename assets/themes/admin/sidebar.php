<div class="pcoded-inner-navbar main-menu">
    <div class="pcoded-navigation-label">Navigation</div>

    <ul class="pcoded-item pcoded-left-item">

        <?php if (in_array('dashboard_view', $this->permissions)): ?>
        
        <!-- dashbaord -->
        <li class="<?php echo (uri_string() == 'dashboard') ? 'active' : ''; ?> ">
            <a href="<?=base_url()?>/dashboard" class="waves-effect waves-dark">
            <span class="pcoded-micon"><i class="feather icon-home"></i></span>
            <span class="pcoded-mtext"> <?php echo $this->user['groupName']  ?> Dashboard </span>
            </a>
        </li>

        <?php endif ?>


        <?php if (in_array('category_view', $this->permissions)): ?>
        <!-- category -->
        <li class="<?php echo (uri_string() == 'admin/category') ? 'active' : ''; ?> ">
            <a href="<?=base_url()?>/admin/category" class="waves-effect waves-dark">
            <span class="pcoded-micon"><i class="feather icon-home"></i></span>
            <span class="pcoded-mtext">Category </span>
            </a>
        </li>


        <?php endif; ?>


        <?php if (in_array('user_view', $this->permissions)): ?>
        <!-- users list -->
        <li class="pcoded-hasmenu <?php echo (uri_string() == 'admin/users') ? 'active' : ''; ?> <?php echo (uri_string() == 'admin/users/add') ? 'active' : ''; ?>">
            <a href="javascript:void(0)" class="waves-effect waves-dark">
            <span class="pcoded-micon"><i class="feather icon-users"></i></span>
            <span class="pcoded-mtext">Users</span>
            </a>
            <ul class="pcoded-submenu">
                <li class=" ">
                    <a href="<?=base_url()?>admin/users" class="waves-effect waves-dark">
                    <span class="pcoded-mtext">List</span>
                    </a>
                </li>
                <li class="">
                    <a href="<?=base_url()?>admin/users/add" class="waves-effect waves-dark">
                    <span class="pcoded-mtext">Add</span>
                    </a>
                </li>
            </ul>
        </li>

        <?php endif; ?>


        <?php if (in_array('acl_view', $this->permissions)): ?>
        <!-- acl    -->
        <li class="pcoded-hasmenu <?php echo (uri_string() == 'admin/acl/groups') ? 'active' : ''; ?> <?php echo (uri_string() == 'admin/users/add') ? 'active' : ''; ?>">
            <a href="javascript:void(0)" class="waves-effect waves-dark">
            <span class="pcoded-micon"><i class="feather icon-users"></i></span>
            <span class="pcoded-mtext">Role Based Access</span>
            </a>
            <ul class="pcoded-submenu">
                <li class="<?php echo (uri_string() == 'admin/acl/groups' ) ? 'active' : ''; ?>">
                    <a href="<?=base_url()?>admin/acl/groups" class="waves-effect waves-dark">
                    <span class="pcoded-mtext"> User Roles</span>
                    </a>
                </li>
                <li class="<?php echo (uri_string() == 'admin/acl/permissions' ) ? 'active' : ''; ?>">
                    <a href="<?=base_url()?>admin/acl/permissions" class="waves-effect waves-dark">
                    <span class="pcoded-mtext">Permission List</span>
                    </a>
                </li>
                <li class="<?php echo (uri_string() == 'admin/acl' ) ? 'active' : ''; ?>">
                    <a href="<?=base_url()?>admin/acl" class="waves-effect waves-dark">
                    <span class="pcoded-mtext">Role Permissions</span>
                    </a>
                </li>
            </ul>
        </li>

        <?php endif; ?>


        <?php if (in_array('settings_view', $this->permissions)): ?>
        <!-- settings -->
        <div class="pcoded-navigation-label">Settings</div>

        <li class="pcoded-hasmenu <?php echo (uri_string() == 'admin/settings') ? 'active' : ''; ?> <?php echo (uri_string() == 'admin/users/add') ? 'active' : ''; ?>">
            <a href="javascript:void(0)" class="waves-effect waves-dark">
            <span class="pcoded-micon"><i class="feather icon-users"></i></span>
            <span class="pcoded-mtext">Site Setting</span>
            </a>
            <ul class="pcoded-submenu">
                <li class=" ">
                    <a href="<?=base_url()?>admin/settings" class="waves-effect waves-dark">
                     <i class="fa fa-cog"></i>

                      Settings

                    </a>
                </li>
                <li class="">
                    <a href="<?=base_url()?>admin/trash" class="waves-effect waves-dark">
                     
                      <i class="fa fa-trash"></i>
                        Trash
                    </a>
                </li>
                <li class="">
                    <a href="<?=base_url()?>admin/dashboard/backup_db">
                        <i class="fa fa-save"></i>
                        Download DB Backup
                  </a>
                </li>
            </ul>
        </li>



        <?php endif ?>


        <?php if (in_array('email_test_view', $this->permissions)): ?>
        <!-- test email -->
        <li class=" ">
              <a target="_blank" href="<?=base_url()?>admin/dashboard/test_email" class="waves-effect waves-dark">
              <span class="pcoded-micon">
              <i class="feather icon-trash"></i>
              </span>
              <span class="pcoded-mtext"> Test Email</span>
              </a>
        </li>

        
        <?php endif; ?>

        <li class=" ">
              <a target="_blank" href="<?=base_url()?>admin/dashboard/demo" class="waves-effect waves-dark">
              <span class="pcoded-micon">
              <i class="feather icon-trash"></i>
              </span>
              <span class="pcoded-mtext"> Demo forms</span>
              </a>
        </li>

    </ul>

</div>
