<style type="text/css">

  
  .card .card-header-rose .card-icon, .card .card-header-rose .card-text, .card .card-header-rose:not(.card-header-icon):not(.card-header-text), .card.bg-rose, .card.card-rotate.bg-rose .front, .card.card-rotate.bg-rose .back{
        background-color: #ff9047 !important;
  }
  .sidebar .nav li.active>[data-toggle="collapse"] {
    background-color: rgba(200, 200, 200, 0.2) !important;
    color: #3C4858;
    box-shadow: none;
}
  .sidebar[data-color="rose"] li.active>a{
    background-color: #ff9047 !important;
  }

  .date-height
  {
    margin-top: -20px !important;
  }

    table.dataTable thead .sorting_asc {
        background-repeat: no-repeat !important;
        background-size: 0 0 !important;
    }

    table.dataTable thead .sorting_desc {
         background-repeat: no-repeat !important;
         background-size: 0 0 !important;
    }


    
.select2.select2-container {
    width: 100% !important;
    margin-bottom: 10px;
}

.select2.select2-container .select2-selection {
  border: 1px solid #ccc !important;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  height: 34px;
  margin-top: 5px;
  outline: none;
  transition: all 0.15s ease-in-out;
}

.select2.select2-container .select2-selection .select2-selection__rendered {
  color: #333;
  line-height: 32px;
  padding-right: 33px;
  text-align: left;
}

.select2.select2-container .select2-selection .select2-selection__arrow {
  background: #f8f8f8;
  border-left: 1px solid #ccc;
  -webkit-border-radius: 0 3px 3px 0;
  -moz-border-radius: 0 3px 3px 0;
  border-radius: 0 3px 3px 0;
  height: 32px;
  width: 33px;
  margin-top: 5px;
}

.select2.select2-container.select2-container--open .select2-selection.select2-selection--single {
  background: #f8f8f8;
}

.select2.select2-container.select2-container--open .select2-selection.select2-selection--single .select2-selection__arrow {
  -webkit-border-radius: 0 3px 0 0;
  -moz-border-radius: 0 3px 0 0;
  border-radius: 0 3px 0 0;
}

.select2.select2-container.select2-container--open .select2-selection.select2-selection--multiple {
  border: 1px solid #34495e;
}

.select2.select2-container.select2-container--focus .select2-selection {
  border: 1px solid #34495e;
}

.select2.select2-container .select2-selection--multiple {
  height: auto;
  min-height: 34px;
}

.select2.select2-container .select2-selection--multiple .select2-search--inline .select2-search__field {
  margin-top: 0;
  height: 32px;
}

.select2.select2-container .select2-selection--multiple .select2-selection__rendered {
  display: block;
  padding: 0 4px;
  line-height: 29px;
}

.select2.select2-container .select2-selection--multiple .select2-selection__choice {
  background-color: #f8f8f8;
  border: 1px solid #ccc;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  margin: 4px 4px 0 0;
  padding: 0 6px 0 22px;
  height: 24px;
  line-height: 24px;
  font-size: 12px;
  position: relative;
}

.select2.select2-container .select2-selection--multiple .select2-selection__choice .select2-selection__choice__remove {
  position: absolute;
  top: 0;
  left: 0;
  height: 22px;
  width: 22px;
  margin: 0;
  text-align: center;
  color: #e74c3c;
  font-weight: bold;
  font-size: 16px;
}

.select2-container .select2-dropdown {
  background: transparent;
  border: none;
  margin-top: -5px;
}

.select2-container .select2-dropdown .select2-search {
  padding: 0;
}

.select2-container .select2-dropdown .select2-search input {
  outline: none;
  border: 1px solid #34495e;
  border-bottom: none;
  padding: 4px 6px;
}

.select2-container .select2-dropdown .select2-results {
  padding: 0;
}

.select2-container .select2-dropdown .select2-results ul {
  background: #fff;
  border: 1px solid #34495e;
}

.select2-container .select2-dropdown .select2-results ul .select2-results__option--highlighted[aria-selected] {
  background-color: #3498db;
}

.big-drop {
  width: 600px !important;
}

.select_margin{
    margin-bottom: 10px;
}

.table-responsive{
    zoom: 90%;
}

.sidebar .sidebar-wrapper {
    
    zoom: 90%;
}

.filter-min-with{
    float: left;
    margin-top: 30px;
    width: 344px;
    margin-bottom: 30px;
    height: 34px;
}


</style>

<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="sidebar" data-color="rose" data-background-color="black" data-image="<?php echo e(asset('material')); ?>/img/sidebar-1.jpg">
  <!--
    Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

    Tip 2: you can also add an image using data-image tag
-->
  <div class="logo">
    
    <!-- <a href="http://www.creative-tim.com" class="simple-text logo-normal">
      <?php echo e(__('Creative Tim')); ?>

    </a> -->
    <img src="<?php echo e(asset('material')); ?>/img/logo/rsz_rmslogo.png" style="margin-left: 15px;" >
  </div>
  <div class="sidebar-wrapper">
    <div class="user">
      <div class="photo">
        <?php if(auth()->user()->picture): ?>
            <img src="<?php echo e(auth()->user()->profilePicture()); ?>" alt="...">
        <?php else: ?>
            <img src="<?php echo e(asset('material')); ?>/img/placeholder.jpg" alt="...">
        <?php endif; ?>
      </div>
      <div class="user-info">
        <a data-toggle="collapse" href="#collapseExample" class="username">
          <span>
            <?php echo e(auth()->user()->name); ?>

            <b class="caret"></b>
          </span>
        </a>
        <div class="collapse" id="collapseExample">
          <ul class="nav">
            <li class="nav-item">
              <a class="nav-link" href="<?php echo e(route('profile.edit')); ?>">
                <span class="sidebar-mini"> MP </span>
                <span class="sidebar-normal"> My Profile </span>
              </a>
            </li>
           <!--  <li class="nav-item">
              <a class="nav-link" href="<?php echo e(route('profile.edit')); ?>">
                <span class="sidebar-mini"> EP </span>
                <span class="sidebar-normal"> Edit Profile </span>
              </a>
            </li> -->
           <!--  <li class="nav-item">
              <a class="nav-link" href="#">
                <span class="sidebar-mini"> S </span>
                <span class="sidebar-normal"> Settings </span>
              </a>
            </li> -->
          </ul>
        </div>
      </div>
    </div>
    <ul class="nav">
      <li class="nav-item<?php echo e($activePage == 'dashboard' ? ' active' : ''); ?>">
        <a class="nav-link" href="<?php echo e(route('home')); ?>">
          <i class="material-icons">dashboard</i>
            <p><?php echo e(__('Dashboard')); ?></p>
        </a>
      </li>
		
      <li class="nav-item <?php echo e(($menuParent == 'laravel' || $activePage == 'dashboard') ? ' active' : ''); ?>">
        <a class="nav-link" data-toggle="collapse" href="#UserExample" <?php echo e(($menuParent == 'laravel' || $activePage == 'dashboard') ? ' aria-expanded="true"' : ''); ?>>
           <i class="material-icons">account_circle</i>
          <p><?php echo e(__('Profile')); ?>

            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse <?php echo e(($menuParent == 'dashboard' || $menuParent == 'laravel') ? ' show' : ''); ?>" id="UserExample">
          <ul class="nav">
            <li class="nav-item<?php echo e($activePage == 'profile' ? ' active' : ''); ?>">
              <a class="nav-link" href="<?php echo e(route('profile.edit')); ?>">
                <span class="sidebar-mini"> UP </span>
                <span class="sidebar-normal"><?php echo e(__('Your Profile')); ?> </span>
              </a>
            </li>

            <!--  <?php echo e(Auth::user()->role_id); ?> -->


             <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['isAdmin','isTopManagement','manage-users'],App\User::class)): ?>
              <li class="nav-item<?php echo e($activePage == 'role-management' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('role.index')); ?>">
                  <span class="sidebar-mini"> RM </span>
                  <span class="sidebar-normal"> <?php echo e(__('Role Management')); ?> </span>
                </a>
              </li>

               <li class="nav-item<?php echo e($activePage == 'user-management' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('user.index')); ?>">
                  <span class="sidebar-mini"> UM </span>
                  <span class="sidebar-normal"> <?php echo e(__('User Management')); ?> </span>
                </a>
              </li>
			  
			  
            <?php endif; ?>
          
           
            <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage-items', App\User::class)): ?>
              <li class="nav-item<?php echo e($activePage == 'category-management' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('category.index')); ?>">
                  <span class="sidebar-mini"> CM </span>
                  <span class="sidebar-normal"> <?php echo e(__('Category Management')); ?> </span>
                </a>
              </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage-items', App\User::class)): ?>
              <li class="nav-item<?php echo e($activePage == 'tag-management' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('tag.index')); ?>">
                  <span class="sidebar-mini"> TM </span>
                  <span class="sidebar-normal"> <?php echo e(__('Tag Management')); ?> </span>
                </a>
              </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage-items', App\User::class)): ?>
              <li class="nav-item<?php echo e($activePage == 'item-management' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('item.index')); ?>">
                  <span class="sidebar-mini"> IM </span>
                  <span class="sidebar-normal"> <?php echo e(__('Item Management')); ?> </span>
                </a>
              </li>
            <?php else: ?>
              <li class="nav-item<?php echo e($activePage == 'item-management' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('item.index')); ?>">
                  <span class="sidebar-mini"> IM </span>
                  <span class="sidebar-normal"> <?php echo e(__('Items')); ?> </span>
                </a>
              </li>
            <?php endif; ?> -->
          </ul>
        </div>
      </li>

<!--       <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['isAdmin'],App\User::class)): ?>
      <li class="nav-item <?php echo e(($menuParent == 'Employee' || $activePage == 'employee' || $activePage == 'attendance-report' ) ? ' active' : ''); ?>">
        <a class="nav-link" data-toggle="collapse" href="#Employee" <?php echo e(($menuParent == 'employee' || $activePage == 'dashboard' || $activePage == 'attendance-report') ? ' aria-expanded="true"' : ''); ?>>
          <i class="material-icons">account_box</i>
          <p><?php echo e(__('Employee')); ?>

            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse <?php echo e(($menuParent == 'Employee' || $activePage == 'attendance-report' ) ? ' show' : ''); ?>" id="Employee">
          <ul class="nav">
           
              <li class="nav-item<?php echo e($activePage == 'employee' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('employee.index')); ?>">
                  <span class="sidebar-mini"> EM </span>
                  <span class="sidebar-normal"> <?php echo e(__('Employees')); ?> </span>
                </a>
              </li>
        
              
               <li class="nav-item<?php echo e(($activePage == 'employee-attendance' || $activePage == 'attendance-report') ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('attendance.index')); ?>">
                  <span class="sidebar-mini"> AT </span>
                  <span class="sidebar-normal"> <?php echo e(__('Attendance Report')); ?> </span>
                </a>
               </li>
              
              
          </ul>
        </div>
      </li>


       <li class="nav-item <?php echo e(($menuParent == 'Holidays') ? ' active' : ''); ?>">
        <a class="nav-link" data-toggle="collapse" href="#Holidays" <?php echo e(($menuParent == 'Holidays' || $activePage == 'holidays') ? ' aria-expanded="true"' : ''); ?>>
          <i class="material-icons">account_box</i>
          <p><?php echo e(__('Holydays')); ?>

            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse <?php echo e(($menuParent == 'Holidays') ? ' show' : ''); ?>" id="Holidays">
          <ul class="nav">
           
              <li class="nav-item<?php echo e($activePage == 'holidays' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('holidays.index')); ?>">
                  <span class="sidebar-mini"> HD </span>
                  <span class="sidebar-normal"> <?php echo e(__('Holydays')); ?> </span>
                </a>
              </li>

             
          </ul>
        </div>
      </li>


      <?php endif; ?> -->

      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['isMerchandiser','isField_Manager','isAccounts','isHuman_Resource','isCoordianator','isAdmin','isTopManagement'],App\User::class)): ?>
      <li class="nav-item <?php echo e(($menuParent == 'My-Activity' ) ? ' active' : ''); ?>">
        <a class="nav-link" data-toggle="collapse" href="#My-Activity" <?php echo e(($menuParent == 'employee' || $activePage == 'dashboard') ? ' aria-expanded="true"' : ''); ?>>
          <i class="material-icons">work</i>
          <p><?php echo e(__('My Activity')); ?>

            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse <?php echo e(($menuParent == 'My-Activity' ) ? ' show' : ''); ?>" id="My-Activity">
          <ul class="nav">
           
               <li class="nav-item<?php echo e($activePage == 'employee-attendance' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('emp-attendance.index')); ?>">
                  <span class="sidebar-mini"> AT </span>
                  <span class="sidebar-normal"> <?php echo e(__('Attendance')); ?> </span>
                </a>
              </li>

              <li class="nav-item<?php echo e($activePage == 'leave-request' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('leaverequest.index')); ?>">
                  <span class="sidebar-mini"> L </span>
                  <span class="sidebar-normal"> <?php echo e(__('Leaves')); ?> </span>
                </a>
              </li>

              <li class="nav-item<?php echo e($activePage == 'leave-balance' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('emp-leave-balance.index')); ?>">
                  <span class="sidebar-mini"> LB </span>
                  <span class="sidebar-normal"> <?php echo e(__('Leave Balance')); ?> </span>
                </a>
               </li>
          
            <li class="nav-item<?php echo e($activePage == 'leave-rule' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('leave_rule.index')); ?>">
                  <span class="sidebar-mini"> LB </span>
                  <span class="sidebar-normal"> <?php echo e(__('Leave Rule')); ?> </span>
                </a>
               </li>
				
			  <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['isField_Manager'],App\User::class)): ?> 
               <li class="nav-item<?php echo e($activePage == 'leaves' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('leaves.index')); ?>">
                  <span class="sidebar-mini"> LA </span>
                  <span class="sidebar-normal"> <?php echo e(__('Leave Approve')); ?> </span>
                </a>
              </li>
			  
			  <?php endif; ?>
              
          </ul>
        </div>
      </li>

    
       <?php endif; ?>

      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['isHuman_Resource'],App\User::class)): ?>
      <li class="nav-item <?php echo e(($menuParent == 'Employee') ? ' active' : ''); ?>">
        <a class="nav-link" data-toggle="collapse" href="#Employee" <?php echo e(($menuParent == 'Employee' ) ? ' aria-expanded="true"' : ''); ?>>
          <i class="material-icons">account_box</i>
          <p><?php echo e(__('Employee')); ?>

            <b class="caret"></b>
          </p>
        </a>
        
 
        <div class="collapse <?php echo e(($menuParent == 'Employee') ? ' show' : ''); ?>" id="Employee">
          <ul class="nav">

              <li class="nav-item<?php echo e($activePage == 'employee' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('employee.index')); ?>">
                  <span class="sidebar-mini"> EM </span>
                  <span class="sidebar-normal"> <?php echo e(__('Employees')); ?> </span>
                </a>
              </li>

              <li class="nav-item<?php echo e($activePage == 'employee-leaves' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('employeeleaves.index')); ?>">
                  <span class="sidebar-mini"> EL </span>
                  <span class="sidebar-normal"> <?php echo e(__('Employee Leaves')); ?> </span>
                </a>
              </li>

               <li class="nav-item<?php echo e($activePage == 'emp-leave-balance' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('leave-balance.index')); ?>">
                  <span class="sidebar-mini"> EB </span>
                  <span class="sidebar-normal"> <?php echo e(__('Employee Leave Balance')); ?> </span>
                </a>
               </li>

               <li class="nav-item<?php echo e($activePage == 'employee-reporting' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('employee-reporting.index')); ?>">
                  <span class="sidebar-mini"> ER </span>
                  <span class="sidebar-normal"> <?php echo e(__('employee-reporting')); ?> </span>
                </a>
              </li>

              
          </ul>
        </div>
      </li>

      <li class="nav-item <?php echo e(($menuParent == 'Attendance') ? ' active' : ''); ?>">
        <a class="nav-link" data-toggle="collapse" href="#Attendance" <?php echo e(($menuParent == 'Attendance' ) ? ' aria-expanded="true"' : ''); ?>>
          <i class="material-icons">account_box</i>
          <p><?php echo e(__('Attendance')); ?>

            <b class="caret"></b>
          </p>
        </a>
        
 
        <div class="collapse <?php echo e(($menuParent == 'Attendance') ? ' show' : ''); ?>" id="Attendance">
          <ul class="nav">  
             
			  <!-- <li class="nav-item<?php echo e($activePage == 'emp-overall-attendance' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(url('emp-overall-attendance')); ?>">
                  <span class="sidebar-mini"> OA </span>
                  <span class="sidebar-normal"> <?php echo e(__('Over All Attendance')); ?> </span>
                </a>
              </li> -->
             
              <li class="nav-item<?php echo e($activePage == 'attendance-report' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('attendance.index')); ?>">
                  <span class="sidebar-mini"> AR </span>
                  <span class="sidebar-normal"> <?php echo e(__('Attendance Report')); ?> </span>
                </a>
              </li>

              <li class="nav-item<?php echo e($activePage == 'dailyattendance' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('dailyattendance.index')); ?>">
                  <span class="sidebar-mini"> DA </span>
                  <span class="sidebar-normal"> <?php echo e(__('Daily Attendance')); ?> </span>
                </a>
              </li>

              <li class="nav-item<?php echo e($activePage == 'mannual_attendance' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('mannual_attendance.index')); ?>">
                  <span class="sidebar-mini"> DA </span>
                  <span class="sidebar-normal"> <?php echo e(__('Manual Attendance')); ?> </span>
                </a>
              </li>
			  
			   <li class="nav-item<?php echo e($activePage == 'mannual_attendance' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('update_leave_balance.index')); ?>">
                  <span class="sidebar-mini"> DA </span>
                  <span class="sidebar-normal"> <?php echo e(__('Update Leave Balance')); ?> </span>
                </a>
              </li>
         
              
          </ul>
        </div>
      </li>

 
       <li class="nav-item <?php echo e(($menuParent == 'Holidays') ? ' active' : ''); ?>">
        <a class="nav-link" data-toggle="collapse" href="#Holidays" <?php echo e(($menuParent == 'Holidays' || $activePage == 'holidays') ? ' aria-expanded="true"' : ''); ?>>
          <i class="material-icons">account_box</i>
          <p><?php echo e(__('Holidays')); ?>

            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse <?php echo e(($menuParent == 'Holidays') ? ' show' : ''); ?>" id="Holidays">
          <ul class="nav">
           
              <li class="nav-item<?php echo e($activePage == 'holidays' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('holidays.index')); ?>">
                  <span class="sidebar-mini"> HD </span>
                  <span class="sidebar-normal"> <?php echo e(__('Holidays')); ?> </span>
                </a>
              </li>

          
          </ul>
        </div>
      </li>

    <?php endif; ?>



      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['isAdmin','isTopManagement'],App\User::class)): ?>
		
		 <li class="nav-item<?php echo e($activePage == 'audit_trial_details' ? ' active' : ''); ?>">
        <a class="nav-link" href="<?php echo e(route('audit_trial_details.index')); ?>">
          <i class="material-icons">art_track</i>
            <p><?php echo e(__('Audit Trial')); ?></p>
        </a>
      </li>
		
		 <li class="nav-item<?php echo e($activePage == 'manualcheckin' ? ' active' : ''); ?>">
        <a class="nav-link" href="<?php echo e(route('manualcheckin.index')); ?>">
          <i class="material-icons">check_circle_outline</i>
            <p><?php echo e(__('Manual Check In')); ?></p>
        </a>
      </li>
		
       <li class="nav-item <?php echo e(($menuParent == 'Live_Data') ? ' active' : ''); ?>">
        <a class="nav-link" data-toggle="collapse" href="#Live_Data" <?php echo e(($menuParent == 'Live_Data' ) ? ' aria-expanded="true"' : ''); ?>>
          <i class="material-icons">location_on</i>
          <p><?php echo e(__('Live Data')); ?>

            <b class="caret"></b>
          </p>
        </a>
        
		   
 
        <div class="collapse <?php echo e(($menuParent == 'Live_Data') ? ' show' : ''); ?>" id="Live_Data">
          <ul class="nav">

              <li class="nav-item<?php echo e($activePage == 'present_field' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('present_field')); ?>">
                  <span class="sidebar-mini"> PF </span> 
                  <span class="sidebar-normal"> <?php echo e(__('Present Field Managers')); ?> </span>
                </a>
              </li>

              <li class="nav-item<?php echo e($activePage == 'present_merchant' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('present_merchant')); ?>">
                  <span class="sidebar-mini"> PM </span>
                  <span class="sidebar-normal"> <?php echo e(__('Present Merchandisers')); ?> </span>
                </a>
              </li>

               <li class="nav-item<?php echo e($activePage == 'absent_merchant' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('absent_merchant')); ?>">
                  <span class="sidebar-mini"> AB </span>
                  <span class="sidebar-normal"> <?php echo e(__('Absernt Merchandisers')); ?> </span>
                </a>
               </li>

               <li class="nav-item<?php echo e($activePage == 'total_timesheets' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('total_timesheets')); ?>">
                  <span class="sidebar-mini"> TT </span>
                  <span class="sidebar-normal"> <?php echo e(__('Total Timesheet')); ?> </span>
                </a>
              </li>

               <li class="nav-item<?php echo e($activePage == 'today_timesheets' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('today_timesheet')); ?>">
                  <span class="sidebar-mini"> TT </span>
                  <span class="sidebar-normal"> <?php echo e(__('Today Timesheet')); ?> </span>
                </a>
              </li>

              
          </ul>
        </div>
      </li>
		
		
      <li class="nav-item <?php echo e(($menuParent == 'Employee') ? ' active' : ''); ?>">
        <a class="nav-link" data-toggle="collapse" href="#Employee" <?php echo e(($menuParent == 'Employee' ) ? ' aria-expanded="true"' : ''); ?>>
          <i class="material-icons">account_box</i>
          <p><?php echo e(__('Employee')); ?>

            <b class="caret"></b>
          </p>
        </a>
        
 
        <div class="collapse <?php echo e(($menuParent == 'Employee') ? ' show' : ''); ?>" id="Employee">
          <ul class="nav">

              <li class="nav-item<?php echo e($activePage == 'employee' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('employee.index')); ?>">
                  <span class="sidebar-mini"> EM </span>
                  <span class="sidebar-normal"> <?php echo e(__('Employees')); ?> </span>
                </a>
              </li>

              <li class="nav-item<?php echo e($activePage == 'employee-leaves' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('employeeleaves.index')); ?>">
                  <span class="sidebar-mini"> EL </span>
                  <span class="sidebar-normal"> <?php echo e(__('Employee Leaves')); ?> </span>
                </a>
              </li>

               <li class="nav-item<?php echo e($activePage == 'emp-leave-balance' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('leave-balance.index')); ?>">
                  <span class="sidebar-mini"> EB </span>
                  <span class="sidebar-normal"> <?php echo e(__('Employee Leave Balance')); ?> </span>
                </a>
               </li>

               <li class="nav-item<?php echo e($activePage == 'employee-reporting' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('employee-reporting.index')); ?>">
                  <span class="sidebar-mini"> ER </span>
                  <span class="sidebar-normal"> <?php echo e(__('employee-reporting')); ?> </span>
                </a>
              </li>

              
          </ul>
        </div>
      </li>
        
      <li class="nav-item <?php echo e(($menuParent == 'Attendance') ? ' active' : ''); ?>">
        <a class="nav-link" data-toggle="collapse" href="#Attendance" <?php echo e(($menuParent == 'Attendance' ) ? ' aria-expanded="true"' : ''); ?>>
          <i class="material-icons">account_box</i>
          <p><?php echo e(__('Attendance')); ?>

            <b class="caret"></b>
          </p>
        </a>
        
 
        <div class="collapse <?php echo e(($menuParent == 'Attendance') ? ' show' : ''); ?>" id="Attendance">
          <ul class="nav">  
             
               <!--<li class="nav-item<?php echo e($activePage == 'emp-overall-attendance' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(url('emp-overall-attendance')); ?>">
                  <span class="sidebar-mini"> OA </span>
                  <span class="sidebar-normal"> <?php echo e(__('Over All Attendance')); ?> </span>
                </a>
              </li>-->
             
              <li class="nav-item<?php echo e($activePage == 'attendance-report' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('attendance.index')); ?>">
                  <span class="sidebar-mini"> AR </span>
                  <span class="sidebar-normal"> <?php echo e(__('Attendance Report')); ?> </span>
                </a>
              </li>

              <li class="nav-item<?php echo e($activePage == 'dailyattendance' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('dailyattendance.index')); ?>">
                  <span class="sidebar-mini"> DA </span>
                  <span class="sidebar-normal"> <?php echo e(__('Daily Attendance')); ?> </span>
                </a>
              </li>

              <li class="nav-item<?php echo e($activePage == 'mannual_attendance' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('mannual_attendance.index')); ?>">
                  <span class="sidebar-mini"> DA </span>
                  <span class="sidebar-normal"> <?php echo e(__('Manual Attendance')); ?> </span>
                </a>
              </li>
          <li class="nav-item<?php echo e($activePage == 'mannual_attendance' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('update_leave_balance.index')); ?>">
                  <span class="sidebar-mini"> DA </span>
                  <span class="sidebar-normal"> <?php echo e(__('Update Leave Balance')); ?> </span>
                </a>
              </li>
              
          </ul>
        </div>
      </li>

       <li class="nav-item <?php echo e(($menuParent == 'Client') ? ' active' : ''); ?>">
        <a class="nav-link" data-toggle="collapse" href="#Client" <?php echo e(($menuParent == 'Client' || $activePage == 'client') ? ' aria-expanded="true"' : ''); ?>>
          <i class="material-icons">account_box</i>
          <p><?php echo e(__('Client & CDE')); ?>

            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse <?php echo e(($menuParent == 'Client') ? ' show' : ''); ?>" id="Client">
          <ul class="nav">
           
              <li class="nav-item<?php echo e($activePage == 'client' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('client.index')); ?>">
                  <span class="sidebar-mini"> CL </span>
                  <span class="sidebar-normal"> <?php echo e(__('Client')); ?> </span>
                </a>
              </li>
			  
			   <li class="nav-item<?php echo e($activePage == 'cde_user' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('cde.index')); ?>">
                  <span class="sidebar-mini"> CDE </span>
                  <span class="sidebar-normal"> <?php echo e(__('CDE')); ?> </span>
                </a>
              </li>

              
          </ul>
        </div>
      </li>

 
       <li class="nav-item <?php echo e(($menuParent == 'Holidays') ? ' active' : ''); ?>">
        <a class="nav-link" data-toggle="collapse" href="#Holidays" <?php echo e(($menuParent == 'Holidays' || $activePage == 'holidays') ? ' aria-expanded="true"' : ''); ?>>
          <i class="material-icons">account_box</i>
          <p><?php echo e(__('Holidays')); ?>

            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse <?php echo e(($menuParent == 'Holidays') ? ' show' : ''); ?>" id="Holidays">
          <ul class="nav">
           
              <li class="nav-item<?php echo e($activePage == 'holidays' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('holidays.index')); ?>">
                  <span class="sidebar-mini"> HD </span>
                  <span class="sidebar-normal"> <?php echo e(__('Holidays')); ?> </span>
                </a>
              </li>

          
          </ul>
        </div>
		   
		  
      </li>

        <li class="nav-item <?php echo e(($menuParent == 'Store_Details') ? ' active' : ''); ?>">
        <a class="nav-link" data-toggle="collapse" href="#store" <?php echo e(($menuParent == 'Store_Details' || $activePage == 'store_details') ? ' aria-expanded="true"' : ''); ?>>
          <i class="material-icons">storefront</i>
          <p><?php echo e(__('Stores')); ?>

            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse <?php echo e(($menuParent == 'Store_Details') ? ' show' : ''); ?>" id="store">
          <ul class="nav">
              <li class="nav-item<?php echo e($activePage == 'store_details' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('store_details.index')); ?>">
                  <span class="sidebar-mini">ST </span>
                  <span class="sidebar-normal"> <?php echo e(__('Stores')); ?> </span>
                </a>
              </li>
          </ul>
        </div>
      </li>

       <li class="nav-item <?php echo e(($menuParent == 'Products') ? ' active' : ''); ?>">
        <a class="nav-link" data-toggle="collapse" href="#products" <?php echo e(($menuParent == 'Products' || $activePage == 'brand_details') ? ' aria-expanded="true"' : ''); ?>>
          <i class="fa fa-product-hunt"></i>
          <p><?php echo e(__('Products')); ?>

            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse <?php echo e(($menuParent == 'Products') ? ' show' : ''); ?>" id="products">
         <ul class="nav">
              <li class="nav-item<?php echo e($activePage == 'brand_details' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('brand_details.index')); ?>">
                  <span class="sidebar-mini">B </span>
                  <span class="sidebar-normal"> <?php echo e(__('Brand')); ?> </span>
                </a>
              </li>

                <li class="nav-item<?php echo e($activePage == 'category_details' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('category_details.index')); ?>">
                  <span class="sidebar-mini">C </span>
                  <span class="sidebar-normal"> <?php echo e(__('Category')); ?> </span>
                </a>
              </li>

               <li class="nav-item<?php echo e($activePage == 'product_details' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('product_details.index')); ?>">
                  <span class="sidebar-mini">P </span>
                  <span class="sidebar-normal"> <?php echo e(__('Products')); ?> </span>
                </a>
              </li>
             
          </ul>
        </div>
      </li>

        <li class="nav-item <?php echo e(($menuParent == 'Outlets') ? ' active' : ''); ?>">
        <a class="nav-link" data-toggle="collapse" href="#Outlet" <?php echo e(($menuParent == 'Leave-Rule' || $activePage == 'leave-rule') ? ' aria-expanded="true"' : ''); ?>>
         <i class="material-icons">outlet</i>
          <p><?php echo e(__('Outlets')); ?>

            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse <?php echo e(($menuParent == 'Outlets') ? ' show' : ''); ?>" id="Outlet">
          <ul class="nav">
              <li class="nav-item<?php echo e($activePage == 'outlets' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('admin_outlets')); ?>">
                  <span class="sidebar-mini">OL </span>
                  <span class="sidebar-normal"> <?php echo e(__('Outlet List')); ?> </span>
                </a>
              </li>
			  
			  <li class="nav-item<?php echo e($activePage == 'admin_outlets_stockexpiry' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('overalloutlet_stockexpiry.index')); ?>">
                  <span class="sidebar-mini">OSE </span>
                  <span class="sidebar-normal"> <?php echo e(__('Outlet Stock Expiry')); ?> </span>
                </a>
              </li>
             
          </ul>
        </div>
      </li>

       <li class="nav-item <?php echo e(($menuParent == 'Timesheets') ? ' active' : ''); ?>">
        <a class="nav-link" data-toggle="collapse" href="#timesheets" <?php echo e(($menuParent == 'Store_Details' || $activePage == 'store_details') ? ' aria-expanded="true"' : ''); ?>>
          <i class="material-icons">schedule</i>
          <p><?php echo e(__('Timesheet')); ?>

            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse <?php echo e(($menuParent == 'Timesheets') ? ' show' : ''); ?>" id="timesheets">
          <ul class="nav">
              <li class="nav-item<?php echo e($activePage == 'scheduled_outlets' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('schedule-outlets.index')); ?>">
                  <span class="sidebar-mini">ST </span>
                  <span class="sidebar-normal"> <?php echo e(__('Scheduled Timesheet')); ?> </span>
                </a>
              </li>
               <li class="nav-item<?php echo e($activePage == 'unscheduled_outlets' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('unschedule-outlets.index')); ?>">
                  <span class="sidebar-mini">UST </span>
                  <span class="sidebar-normal"> <?php echo e(__('Unscheduled Timesheet')); ?> </span>
                </a>
              </li>
			  <li class="nav-item<?php echo e($activePage == 'over_all_journeyplan' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('over_all_journeyplan.index')); ?>">
                  <span class="sidebar-mini">MJS </span>
                  <span class="sidebar-normal"> <?php echo e(__('Monthly Journeyplan Schedule')); ?> </span>
                </a>
              </li>
          </ul>
        </div>
      </li>



    <?php endif; ?>


    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['isField_Manager'],App\User::class)): ?>

    
       <li class="nav-item <?php echo e(($menuParent == 'Timesheets') ? ' active' : ''); ?>">
        <a class="nav-link" data-toggle="collapse" href="#timesheets" <?php echo e(($menuParent == 'Store_Details' || $activePage == 'store_details') ? ' aria-expanded="true"' : ''); ?>>
          <i class="material-icons">schedule</i>
          <p><?php echo e(__('Timesheet')); ?>

            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse <?php echo e(($menuParent == 'Timesheets') ? ' show' : ''); ?>" id="timesheets">
          <ul class="nav">
              <li class="nav-item<?php echo e($activePage == 'scheduled_outlets' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('schedule-outlets.index')); ?>">
                  <span class="sidebar-mini">ST </span>
                  <span class="sidebar-normal"> <?php echo e(__('Scheduled Timesheet')); ?> </span>
                </a>
              </li>
               <li class="nav-item<?php echo e($activePage == 'unscheduled_outlets' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('unschedule-outlets.index')); ?>">
                  <span class="sidebar-mini">UST </span>
                  <span class="sidebar-normal"> <?php echo e(__('Unscheduled Timesheet')); ?> </span>
                </a>
              </li>
			  <li class="nav-item<?php echo e($activePage == 'over_all_journeyplan' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('over_all_journeyplan.index')); ?>">
                  <span class="sidebar-mini">MJS </span>
                  <span class="sidebar-normal"> <?php echo e(__('Monthly Journeyplan Schedule')); ?> </span>
                </a>
              </li>
          </ul>
        </div>
      </li>


      <li class="nav-item <?php echo e(($menuParent == 'Promotion') ? ' active' : ''); ?>">
        <a class="nav-link" data-toggle="collapse" href="#promotion" <?php echo e(($menuParent == 'Promotion' || $activePage == 'promotion') ? ' aria-expanded="true"' : ''); ?>>
         <i class="fa fa-tag"></i>
          <p><?php echo e(__('Promotions')); ?>

            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse <?php echo e(($menuParent == 'Promotion') ? ' show' : ''); ?>" id="promotion">
          <ul class="nav">
              <li class="nav-item<?php echo e($activePage == 'promotion' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('promotion.index')); ?>">
                  <span class="sidebar-mini">P </span>
                  <span class="sidebar-normal"> <?php echo e(__('Promotions')); ?> </span>
                </a>
              </li>

               <li class="nav-item<?php echo e($activePage == 'promotion-report' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('report_promo')); ?>">
                  <span class="sidebar-mini">R </span>
                  <span class="sidebar-normal"> <?php echo e(__('Report')); ?> </span>
                </a>
              </li>
             
          </ul>
        </div>
      </li>

     

      <li class="nav-item <?php echo e(($menuParent == 'Timesheet') ? ' active' : ''); ?>">
        <a class="nav-link" data-toggle="collapse" href="#Timesheet" <?php echo e(($menuParent == 'Timesheet' || $activePage == 'date-timesheet') ? ' aria-expanded="true"' : ''); ?>>
          <i class="material-icons">place</i>
          <p><?php echo e(__('JourneyPlan')); ?>

            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse <?php echo e(($menuParent == 'Timesheet') ? ' show' : ''); ?>" id="Timesheet">
          <ul class="nav">
             <li class="nav-item<?php echo e($activePage == 'day_jouney_plan' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('defined-outlets.index')); ?>">
                  <span class="sidebar-mini">SJ </span>
                  <span class="sidebar-normal"> <?php echo e(__('Scheduled JourneyPlan')); ?> </span>
                </a>
              </li>
              <li class="nav-item<?php echo e($activePage == 'date-timesheet' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('merchant-timesheet.index')); ?>">
                  <span class="sidebar-mini">UJ </span>
                  <span class="sidebar-normal"> <?php echo e(__('UnScheduled JourneyPlan')); ?> </span>
                </a>
              </li>
              <!--   <li class="nav-item<?php echo e($activePage == 'scheduled_report' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('scheduled_report.index')); ?>">
                  <span class="sidebar-mini">SJPR </span>
                  <span class="sidebar-normal"> <?php echo e(__('Scheduled JP Report')); ?> </span>
                </a>
              </li> -->
          </ul>
        </div>
      </li>

       <li class="nav-item <?php echo e(($menuParent == 'Stock_Expiry') ? ' active' : ''); ?>">
        <a class="nav-link" data-toggle="collapse" href="#stock_report" <?php echo e(($menuParent == 'Stock_Expiry' || $activePage == 'outlet_stockexpiry') ? ' aria-expanded="true"' : ''); ?>>
          <i class="material-icons">schedule</i>
          <p><?php echo e(__('Stock Expiry')); ?>

            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse <?php echo e(($menuParent == 'Stock_Expiry') ? ' show' : ''); ?>" id="stock_report">
          <ul class="nav">
              <li class="nav-item<?php echo e($activePage == 'outlet_stockexpiry' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('stock_report')); ?>">
                  <span class="sidebar-mini">ST </span>
                  <span class="sidebar-normal"> <?php echo e(__('Stock Expiry Report')); ?> </span>
                </a>
              </li>
             
          </ul>
        </div>
      </li>


      <li class="nav-item <?php echo e(($menuParent == 'Field_Manager_Report') ? ' active' : ''); ?>">
        <a class="nav-link" data-toggle="collapse" href="#f_outlet_report" <?php echo e(($menuParent == 'Field_Manager_Report' || $activePage == 'field_outlet_report') ? ' aria-expanded="true"' : ''); ?>>
         <i class="material-icons">book</i>
          <p><?php echo e(__('Outlet Report')); ?>

            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse <?php echo e(($menuParent == 'Field_Manager_Report') ? ' show' : ''); ?>" id="f_outlet_report">
          <ul class="nav">
              <li class="nav-item<?php echo e($activePage == 'field_outlet_report' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('f_outlet_report')); ?>">
                  <span class="sidebar-mini">RE </span>
                  <span class="sidebar-normal"> <?php echo e(__('Report')); ?> </span>
                </a>
              </li>

          </ul>
        </div>
      </li>
		
		 <li class="nav-item <?php echo e(($menuParent == 'Cde_Reporting') ? ' active' : ''); ?>">
        <a class="nav-link" data-toggle="collapse" href="#cde_reporting" <?php echo e(($menuParent == 'Cde_Reporting' || $activePage == 'cde_reporting') ? ' aria-expanded="true"' : ''); ?>>
         <i class="material-icons">book</i>
          <p><?php echo e(__('CDE Reporting')); ?>

            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse <?php echo e(($menuParent == 'Cde_Reporting') ? ' show' : ''); ?>" id="cde_reporting">
          <ul class="nav">
              <li class="nav-item<?php echo e($activePage == 'cde_reporting' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('cde_reporting.index')); ?>">
                  <span class="sidebar-mini">CDE </span>
                  <span class="sidebar-normal"> <?php echo e(__('Reporting')); ?> </span>
                </a>
              </li>

          </ul>
        </div>
      </li>


       <li class="nav-item <?php echo e(($menuParent == 'weekoff') ? ' active' : ''); ?>">
        <a class="nav-link" data-toggle="collapse" href="#weekoff" <?php echo e(($menuParent == 'WeekOff' || $activePage == 'WeekOff') ? ' aria-expanded="true"' : ''); ?>>
          <i class="material-icons">calendar_today</i>
          <p><?php echo e(__('Week Off')); ?>

            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse <?php echo e(($menuParent == 'weekoff') ? ' show' : ''); ?>" id="weekoff">
          <ul class="nav">
           
              <li class="nav-item<?php echo e($activePage == 'WeekOff' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('weekoff.index')); ?>">
                  <span class="sidebar-mini"> WO </span>
                  <span class="sidebar-normal"> <?php echo e(__('Week Off')); ?> </span>
                </a>
              </li>

          </ul>
        </div>
      </li>

		<li class="nav-item <?php echo e(($menuParent == 'Reliever') ? ' active' : ''); ?>">
        <a class="nav-link" data-toggle="collapse" href="#Reliever" <?php echo e(($menuParent == 'Reliever' || $activePage == 'reliever') ? ' aria-expanded="true"' : ''); ?>>
          <i class="material-icons">swipe</i>
          <p><?php echo e(__('Reliever')); ?>

            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse <?php echo e(($menuParent == 'Reliever') ? ' show' : ''); ?>" id="Reliever">
          <ul class="nav">
           
              <li class="nav-item<?php echo e($activePage == 'reliever' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('reliever.index')); ?>">
                  <span class="sidebar-mini"> R </span>
                  <span class="sidebar-normal"> <?php echo e(__('Reliever')); ?> </span>
                </a>
              </li>

          </ul>
        </div>
      </li>


       <?php endif; ?>

      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['isMerchandiser'],App\User::class)): ?>
      <li class="nav-item <?php echo e(($menuParent == 'Journey-Plan') ? ' active' : ''); ?>">
        <a class="nav-link" data-toggle="collapse" href="#Journey" <?php echo e(($menuParent == 'Journey-Plan' || $activePage == 'journey-plan') ? ' aria-expanded="true"' : ''); ?>>
          <i class="material-icons">location_on</i>
          <p><?php echo e(__('Journey Plan')); ?>

            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse <?php echo e(($menuParent == 'Journey-Plan') ? ' show' : ''); ?>" id="Journey">
          <ul class="nav">
              <li class="nav-item<?php echo e($activePage == 'journey-plan' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('journey-plan.index')); ?>">
                  <span class="sidebar-mini">JP </span>
                  <span class="sidebar-normal"> <?php echo e(__('Journey Plan')); ?> </span>
                </a>
              </li>
          </ul>
        </div>
      </li>

       <li class="nav-item <?php echo e(($menuParent == 'Timesheet') ? ' active' : ''); ?>">
        <a class="nav-link" data-toggle="collapse" href="#timesheet" <?php echo e(($menuParent == 'Journey-Plan' || $activePage == 'journey-plan') ? ' aria-expanded="true"' : ''); ?>>
          <i class="material-icons">schedule</i>
          <p><?php echo e(__('TimeSheet')); ?>

            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse <?php echo e(($menuParent == 'Timesheet') ? ' show' : ''); ?>" id="timesheet">
          <ul class="nav">
               <li class="nav-item<?php echo e($activePage == 'day-timesheet' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('timesheet.index')); ?>">
                  <span class="sidebar-mini">ST </span>
                  <span class="sidebar-normal"> <?php echo e(__('Scheduled Timesheet')); ?> </span>
                </a>
              </li>
              <li class="nav-item<?php echo e($activePage == 'date-timesheet' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('date_timesheet')); ?>">
                  <span class="sidebar-mini">UST </span>
                  <span class="sidebar-normal"> <?php echo e(__('UnScheduled Timesheet')); ?> </span>
                </a>
              </li>
          </ul>
        </div>
      </li>

     
       <?php endif; ?>


     <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['isClient'],App\User::class)): ?>

      <li class="nav-item <?php echo e(($menuParent == 'Store_Details') ? ' active' : ''); ?>">
        <a class="nav-link" data-toggle="collapse" href="#store" <?php echo e(($menuParent == 'Store_Details' || $activePage == 'store_details') ? ' aria-expanded="true"' : ''); ?>>
          <i class="material-icons">storefront</i>
          <p><?php echo e(__('Stores')); ?>

            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse <?php echo e(($menuParent == 'Store_Details') ? ' show' : ''); ?>" id="store">
          <ul class="nav">
              <li class="nav-item<?php echo e($activePage == 'store_details' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('store_details.index')); ?>">
                  <span class="sidebar-mini">ST </span>
                  <span class="sidebar-normal"> <?php echo e(__('Stores')); ?> </span>
                </a>
              </li>
          </ul>
        </div>
      </li>

       <li class="nav-item <?php echo e(($menuParent == 'Products') ? ' active' : ''); ?>">
        <a class="nav-link" data-toggle="collapse" href="#products" <?php echo e(($menuParent == 'Products' || $activePage == 'brand_details') ? ' aria-expanded="true"' : ''); ?>>
          <i class="fa fa-product-hunt"></i>
          <p><?php echo e(__('Products')); ?>

            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse <?php echo e(($menuParent == 'Products') ? ' show' : ''); ?>" id="products">
          <ul class="nav">
              <li class="nav-item<?php echo e($activePage == 'brand_details' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('brand_details.index')); ?>">
                  <span class="sidebar-mini">B </span>
                  <span class="sidebar-normal"> <?php echo e(__('Brand')); ?> </span>
                </a>
              </li>

                <li class="nav-item<?php echo e($activePage == 'category_details' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('category_details.index')); ?>">
                  <span class="sidebar-mini">C </span>
                  <span class="sidebar-normal"> <?php echo e(__('Category')); ?> </span>
                </a>
              </li>

               <li class="nav-item<?php echo e($activePage == 'product_details' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('product_details.index')); ?>">
                  <span class="sidebar-mini">P </span>
                  <span class="sidebar-normal"> <?php echo e(__('Products')); ?> </span>
                </a>
              </li>
             
          </ul>
        </div>
      </li>

       <li class="nav-item <?php echo e(($menuParent == 'Outlets') ? ' active' : ''); ?>">
        <a class="nav-link" data-toggle="collapse" href="#Outlet" <?php echo e(($menuParent == 'Leave-Rule' || $activePage == 'leave-rule') ? ' aria-expanded="true"' : ''); ?>>
         <i class="material-icons">outlet</i>
          <p><?php echo e(__('Outlets')); ?>

            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse <?php echo e(($menuParent == 'Outlets') ? ' show' : ''); ?>" id="Outlet">
          <ul class="nav">
              <li class="nav-item<?php echo e($activePage == 'outlets' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('outlet.index')); ?>">
                  <span class="sidebar-mini">OL </span>
                  <span class="sidebar-normal"> <?php echo e(__('Outlet List')); ?> </span>
                </a>
              </li>

               <li class="nav-item<?php echo e($activePage == 'client_outlet' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('client_report.index')); ?>">
                  <span class="sidebar-mini">OT </span>
                  <span class="sidebar-normal"> <?php echo e(__('Outlet Timesheets')); ?> </span>
                </a>
              </li>

               <li class="nav-item<?php echo e($activePage == 'client_outlet_report' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('client_outlet_report')); ?>">
                  <span class="sidebar-mini">OR </span>
                  <span class="sidebar-normal"> <?php echo e(__('Outlet Report')); ?> </span>
                </a>
              </li>
			  
			    <li class="nav-item<?php echo e($activePage == 'trade_stock_report' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('trade_stock_report')); ?>">
                  <span class="sidebar-mini">TR </span>
                  <span class="sidebar-normal"> <?php echo e(__('Trade Report')); ?> </span>
                </a>
              </li>
             
          </ul>
        </div>
      </li>
      
    

    <?php endif; ?>



    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['isSalesman'],App\User::class)): ?>

      <li class="nav-item <?php echo e(($menuParent == 'TimeSheet-Approval') ? ' active' : ''); ?>">
        <a class="nav-link" data-toggle="collapse" href="#timeSheet-approval" <?php echo e(($menuParent == 'TimeSheet-Approval' || $activePage == 'timeSheet-approval') ? ' aria-expanded="true"' : ''); ?>>
          <i class="material-icons">schedule</i>
          <p><?php echo e(__('TimeSheet Approval')); ?>

            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse <?php echo e(($menuParent == 'TimeSheet-Approval') ? ' show' : ''); ?>" id="timeSheet-approval">
          <ul class="nav">
              <li class="nav-item<?php echo e($activePage == 'timesheet-approval' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('timesheet-approval.index')); ?>">
                  <span class="sidebar-mini">OL </span>
                  <span class="sidebar-normal"> <?php echo e(__('TimeSheets')); ?> </span>
                </a>
              </li>
          </ul>
        </div>
      </li>

     
       <?php endif; ?>

       <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['isCDE'],App\User::class)): ?>

    
      <li class="nav-item <?php echo e(($menuParent == 'Timesheets') ? ' active' : ''); ?>">
        <a class="nav-link" data-toggle="collapse" href="#timesheets" <?php echo e(($menuParent == 'Store_Details' || $activePage == 'store_details') ? ' aria-expanded="true"' : ''); ?>>
          <i class="material-icons">schedule</i>
          <p><?php echo e(__('Timesheet')); ?>

            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse <?php echo e(($menuParent == 'Timesheets') ? ' show' : ''); ?>" id="timesheets">
          <ul class="nav">
              <li class="nav-item<?php echo e($activePage == 'scheduled_outlets' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('schedule-outlets.index')); ?>">
                  <span class="sidebar-mini">ST </span>
                  <span class="sidebar-normal"> <?php echo e(__('Scheduled Timesheet')); ?> </span>
                </a>
              </li>
               <li class="nav-item<?php echo e($activePage == 'unscheduled_outlets' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('unschedule-outlets.index')); ?>">
                  <span class="sidebar-mini">UST </span>
                  <span class="sidebar-normal"> <?php echo e(__('Unscheduled Timesheet')); ?> </span>
                </a>
              </li>
          </ul>
        </div>
      </li>


      <!--<li class="nav-item <?php echo e(($menuParent == 'Promotion') ? ' active' : ''); ?>">
        <a class="nav-link" data-toggle="collapse" href="#promotion" <?php echo e(($menuParent == 'Promotion' || $activePage == 'promotion') ? ' aria-expanded="true"' : ''); ?>>
         <i class="fa fa-tag"></i>
          <p><?php echo e(__('Promotions')); ?>

            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse <?php echo e(($menuParent == 'Promotion') ? ' show' : ''); ?>" id="promotion">
          <ul class="nav">
              <li class="nav-item<?php echo e($activePage == 'promotion' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('promotion.index')); ?>">
                  <span class="sidebar-mini">P </span>
                  <span class="sidebar-normal"> <?php echo e(__('Promotions')); ?> </span>
                </a>
              </li>

               <li class="nav-item<?php echo e($activePage == 'promotion-report' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('report_promo')); ?>">
                  <span class="sidebar-mini">R </span>
                  <span class="sidebar-normal"> <?php echo e(__('Report')); ?> </span>
                </a>
              </li>
             
          </ul>
        </div>
      </li>-->

     

      <li class="nav-item <?php echo e(($menuParent == 'Timesheet') ? ' active' : ''); ?>">
        <a class="nav-link" data-toggle="collapse" href="#Timesheet" <?php echo e(($menuParent == 'Timesheet' || $activePage == 'date-timesheet') ? ' aria-expanded="true"' : ''); ?>>
          <i class="material-icons">place</i>
          <p><?php echo e(__('JourneyPlan')); ?>

            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse <?php echo e(($menuParent == 'Timesheet') ? ' show' : ''); ?>" id="Timesheet">
          <ul class="nav">
             <li class="nav-item<?php echo e($activePage == 'day_jouney_plan' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('defined-outlets.index')); ?>">
                  <span class="sidebar-mini">SJ </span>
                  <span class="sidebar-normal"> <?php echo e(__('Scheduled JourneyPlan')); ?> </span>
                </a>
              </li>
              <li class="nav-item<?php echo e($activePage == 'date-timesheet' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('merchant-timesheet.index')); ?>">
                  <span class="sidebar-mini">UJ </span>
                  <span class="sidebar-normal"> <?php echo e(__('UnScheduled JourneyPlan')); ?> </span>
                </a>
              </li>
           
          </ul>
        </div>
      </li>

       <li class="nav-item <?php echo e(($menuParent == 'Stock_Expiry') ? ' active' : ''); ?>">
        <a class="nav-link" data-toggle="collapse" href="#stock_report" <?php echo e(($menuParent == 'Stock_Expiry' || $activePage == 'outlet_stockexpiry') ? ' aria-expanded="true"' : ''); ?>>
          <i class="material-icons">schedule</i>
          <p><?php echo e(__('Stock Expiry')); ?>

            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse <?php echo e(($menuParent == 'Stock_Expiry') ? ' show' : ''); ?>" id="stock_report">
          <ul class="nav">
              <li class="nav-item<?php echo e($activePage == 'outlet_stockexpiry' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('stock_report')); ?>">
                  <span class="sidebar-mini">ST </span>
                  <span class="sidebar-normal"> <?php echo e(__('Stock Expiry Report')); ?> </span>
                </a>
              </li>
             
          </ul>
        </div>
      </li>


      <li class="nav-item <?php echo e(($menuParent == 'Field_Manager_Report') ? ' active' : ''); ?>">
        <a class="nav-link" data-toggle="collapse" href="#f_outlet_report" <?php echo e(($menuParent == 'Field_Manager_Report' || $activePage == 'field_outlet_report') ? ' aria-expanded="true"' : ''); ?>>
         <i class="material-icons">book</i>
          <p><?php echo e(__('Outlet Report')); ?>

            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse <?php echo e(($menuParent == 'Field_Manager_Report') ? ' show' : ''); ?>" id="f_outlet_report">
          <ul class="nav">
              <li class="nav-item<?php echo e($activePage == 'field_outlet_report' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('f_outlet_report')); ?>">
                  <span class="sidebar-mini">RE </span>
                  <span class="sidebar-normal"> <?php echo e(__('Report')); ?> </span>
                </a>
              </li>

          </ul>
        </div>
      </li>



      <!-- <li class="nav-item <?php echo e(($menuParent == 'weekoff') ? ' active' : ''); ?>">
        <a class="nav-link" data-toggle="collapse" href="#weekoff" <?php echo e(($menuParent == 'WeekOff' || $activePage == 'WeekOff') ? ' aria-expanded="true"' : ''); ?>>
          <i class="material-icons">calendar_today</i>
          <p><?php echo e(__('Week Off')); ?>

            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse <?php echo e(($menuParent == 'weekoff') ? ' show' : ''); ?>" id="weekoff">
          <ul class="nav">
           
              <li class="nav-item<?php echo e($activePage == 'WeekOff' ? ' active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('weekoff.index')); ?>">
                  <span class="sidebar-mini"> WO </span>
                  <span class="sidebar-normal"> <?php echo e(__('Week Off')); ?> </span>
                </a>
              </li>

          </ul>
        </div>
      </li>-->


    <?php endif; ?>
   

     <!--  <li class="nav-item <?php echo e($menuParent == 'pages' ? 'active' : ''); ?>">
        <a class="nav-link" data-toggle="collapse" href="#pagesExamples" <?php echo e($menuParent == 'Pages' ? 'aria-expanded="true"' : ''); ?>>
          <i class="material-icons">image</i>
          <p> <?php echo e(__('Pages')); ?>

            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse<?php echo e($menuParent == 'pages' ? ' show' : ''); ?>" id="pagesExamples">
          <ul class="nav">
            <li class="nav-item">
              <a class="nav-link" href="<?php echo e(route('page.pricing')); ?>">
                <span class="sidebar-mini"> P </span>
                <span class="sidebar-normal"> <?php echo e(__('Pricing')); ?> </span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo e(route('page.rtl-support')); ?>">
                <span class="sidebar-mini"> RS </span>
                <span class="sidebar-normal"> <?php echo e(__('RTL Support')); ?> </span>
              </a>
            </li>
            <li class="nav-item<?php echo e($activePage == 'timeline' ? ' active' : ''); ?> ">
              <a class="nav-link" href="<?php echo e(route('page.timeline')); ?>">
                <span class="sidebar-mini"> T </span>
                <span class="sidebar-normal"> <?php echo e(__('Timeline')); ?> </span>
              </a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="<?php echo e(route('page.lock')); ?>">
                <span class="sidebar-mini"> LSP </span>
                <span class="sidebar-normal"> <?php echo e(__('Lock Screen Page')); ?> </span>
              </a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="<?php echo e(route('profile.edit')); ?>">
                <span class="sidebar-mini"> UP </span>
                <span class="sidebar-normal"> User Profile </span>
              </a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="<?php echo e(route('page.error')); ?>">
                <span class="sidebar-mini"> E </span>
                <span class="sidebar-normal"> Error Page </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item <?php echo e($menuParent == 'compoments' ? 'active' : ''); ?>">
        <a class="nav-link" data-toggle="collapse" href="#componentsExamples" <?php echo e($menuParent == 'components' ? 'aria-expanded="true"' : ''); ?>>
          <i class="material-icons">apps</i>
          <p> Components
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse <?php echo e($menuParent == 'components' ? ' show' : ''); ?>" id="componentsExamples">
          <ul class="nav">
            <li class="nav-item ">
              <a class="nav-link" data-toggle="collapse" href="#componentsCollapse">
                <span class="sidebar-mini"> MLT </span>
                <span class="sidebar-normal"> Multi Level Collapse
                  <b class="caret"></b>
                </span>
              </a>
              <div class="collapse" id="componentsCollapse">
                <ul class="nav">
                  <li class="nav-item ">
                    <a class="nav-link" href="#0">
                      <span class="sidebar-mini"> E </span>
                      <span class="sidebar-normal"> Example </span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item<?php echo e($activePage == 'buttons' ? ' active' : ''); ?> ">
              <a class="nav-link" href="<?php echo e(route('page.buttons')); ?>">
                <span class="sidebar-mini"> B </span>
                <span class="sidebar-normal"> <?php echo e(__('Buttons')); ?> </span>
              </a>
            </li>
            <li class="nav-item<?php echo e($activePage == 'grid' ? ' active' : ''); ?> ">
              <a class="nav-link" href="<?php echo e(route('page.grid')); ?>">
                <span class="sidebar-mini"> GS </span>
                <span class="sidebar-normal"> <?php echo e(__('Grid System')); ?> </span>
              </a>
            </li>
            <li class="nav-item<?php echo e($activePage == 'panels' ? ' active' : ''); ?>">
              <a class="nav-link" href="<?php echo e(route('page.panels')); ?>">
                <span class="sidebar-mini"> P </span>
                <span class="sidebar-normal"> <?php echo e(__('Panels')); ?> </span>
              </a>
            </li>
            <li class="nav-item<?php echo e($activePage == 'sweet-alert' ? ' active' : ''); ?> ">
              <a class="nav-link" href="<?php echo e(route('page.sweet-alert')); ?>">
                <span class="sidebar-mini"> SA </span>
                <span class="sidebar-normal"> <?php echo e(__('Sweet Alert')); ?> </span>
              </a>
            </li>
            <li class="nav-item<?php echo e($activePage == 'notifications' ? ' active' : ''); ?> ">
              <a class="nav-link" href="<?php echo e(route('page.notifications')); ?>">
                <span class="sidebar-mini"> N </span>
                <span class="sidebar-normal"> <?php echo e(__('Notifications')); ?> </span>
              </a>
            </li>
            <li class="nav-item<?php echo e($activePage == 'icons' ? ' active' : ''); ?> ">
              <a class="nav-link" href="<?php echo e(route('page.icons')); ?>">
                <span class="sidebar-mini"> I </span>
                <span class="sidebar-normal"> <?php echo e(__('Icons')); ?> </span>
              </a>
            </li>
            <li class="nav-item<?php echo e($activePage == 'typography' ? ' active' : ''); ?> ">
              <a class="nav-link" href="<?php echo e(route('page.typography')); ?>">
                <span class="sidebar-mini"> T </span>
                <span class="sidebar-normal"> <?php echo e(__('Typography')); ?> </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item <?php echo e($menuParent == 'forms' ? ' active' : ''); ?>">
        <a class="nav-link" data-toggle="collapse" href="#formsExamples" <?php echo e($menuParent == 'forms' ? 'aria-expanded="true"' : ''); ?>>
          <i class="material-icons">content_paste</i>
          <p> Forms
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse <?php echo e($menuParent == 'forms' ? 'show' : ''); ?>" id="formsExamples">
          <ul class="nav">
            <li class="nav-item<?php echo e($activePage == 'form_regular' ? ' active' : ''); ?> ">
              <a class="nav-link" href="<?php echo e(route('page.regular_forms')); ?>">
                <span class="sidebar-mini"> RF </span>
                <span class="sidebar-normal"> <?php echo e(__('Regular Forms')); ?> </span>
              </a>
            </li>
            <li class="nav-item<?php echo e($activePage == 'form_extended' ? ' active' : ''); ?> ">
              <a class="nav-link" href="<?php echo e(route('page.extended_forms')); ?>">
                <span class="sidebar-mini"> EF </span>
                <span class="sidebar-normal"> <?php echo e(__('Extended Forms')); ?> </span>
              </a>
            </li>
            <li class="nav-item<?php echo e($activePage == 'form_validation' ? ' active' : ''); ?> ">
              <a class="nav-link" href="<?php echo e(route('page.validation_forms')); ?>">
                <span class="sidebar-mini"> VF </span>
                <span class="sidebar-normal"> <?php echo e(__('Validation Forms')); ?> </span>
              </a>
            </li>
            <li class="nav-item<?php echo e($activePage == 'form_wizard' ? ' active' : ''); ?> ">
              <a class="nav-link" href="<?php echo e(route('page.wizard_forms')); ?>">
                <span class="sidebar-mini"> W </span>
                <span class="sidebar-normal"> <?php echo e(__('Wizard')); ?> </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item <?php echo e($menuParent == 'tables' ? 'active' : ''); ?>">
        <a class="nav-link" data-toggle="collapse" href="#tablesExamples" <?php echo e($menuParent == 'tables' ? 'aria-expanded="true"' : ''); ?>>
          <i class="material-icons">grid_on</i>
          <p> <?php echo e(__('Tables')); ?>

            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse <?php echo e($menuParent == 'tables' ? 'show' : ''); ?>" id="tablesExamples">
          <ul class="nav">
            <li class="nav-item<?php echo e($activePage == 'regular' ? ' active' : ''); ?>  ">
              <a class="nav-link" href="<?php echo e(route('page.regular_tables')); ?>">
                <span class="sidebar-mini"> RT </span>
                <span class="sidebar-normal"> <?php echo e(__('Regular Tables')); ?> </span>
              </a>
            </li>
            <li class="nav-item<?php echo e($activePage == 'extended' ? ' active' : ''); ?>  ">
              <a class="nav-link" href="<?php echo e(route('page.extended_tables')); ?>">
                <span class="sidebar-mini"> ET </span>
                <span class="sidebar-normal"> <?php echo e(__('Extended Tables')); ?> </span>
              </a>
            </li>
            <li class="nav-item<?php echo e($activePage == 'datatables' ? ' active' : ''); ?> ">
              <a class="nav-link" href="<?php echo e(route('page.datatable_tables')); ?>">
                <span class="sidebar-mini"> DT </span>
                <span class="sidebar-normal"> <?php echo e(__('DataTables.net')); ?> </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item <?php echo e($menuParent == 'maps' ? 'active' : ''); ?>">
        <a class="nav-link" data-toggle="collapse" href="#mapsExamples" <?php echo e($menuParent == 'maps' ? 'aria-expanded="true"' : ''); ?>>
          <i class="material-icons">place</i>
          <p> Maps
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse <?php echo e($menuParent == 'maps' ? 'show' : ''); ?>" id="mapsExamples">
          <ul class="nav">
            <li class="nav-item<?php echo e($activePage == 'google_maps' ? ' active' : ''); ?> ">
              <a class="nav-link" href="<?php echo e(route('page.google_maps')); ?>">
                <span class="sidebar-mini"> GM </span>
                <span class="sidebar-normal"> <?php echo e(__('Google Maps')); ?> </span>
              </a>
            </li>
            <li class="nav-item<?php echo e($activePage == 'fullscreen_maps' ? ' active' : ''); ?> ">
              <a class="nav-link" href="<?php echo e(route('page.fullscreen_maps')); ?>">
                <span class="sidebar-mini"> FSM </span>
                <span class="sidebar-normal"> <?php echo e(__('Full Screen Map')); ?> </span>
              </a>
            </li>
            <li class="nav-item<?php echo e($activePage == 'vector_maps' ? ' active' : ''); ?> ">
              <a class="nav-link" href="<?php echo e(route('page.vector_maps')); ?>">
                <span class="sidebar-mini"> VM </span>
                <span class="sidebar-normal"> <?php echo e(__('Vector Map')); ?> </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item<?php echo e($activePage == 'widgets' ? ' active' : ''); ?> ">
        <a class="nav-link" href="<?php echo e(route('page.widgets')); ?>">
          <i class="material-icons">widgets</i>
          <p> Widgets </p>
        </a>
      </li>
      <li class="nav-item<?php echo e($activePage == 'charts' ? ' active' : ''); ?> ">
        <a class="nav-link" href="<?php echo e(route('page.charts')); ?>">
          <i class="material-icons">timeline</i>
          <p> Charts </p>
        </a>
      </li>
      <li class="nav-item<?php echo e($activePage == 'calendar' ? ' active' : ''); ?> ">
        <a class="nav-link" href="<?php echo e(route('page.calendar')); ?>">
          <i class="material-icons">date_range</i>
          <p> Calendar </p>
        </a>
      </li> -->

    </ul>

  </div>
</div>




<?php /**PATH /home/thethethoughtfactory/Desktop/RMS-2-11-21/resources/views/layouts/navbars/sidebar.blade.php ENDPATH**/ ?>