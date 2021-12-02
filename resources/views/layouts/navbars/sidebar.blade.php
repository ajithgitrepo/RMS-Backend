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

<meta name="csrf-token" content="{{ csrf_token() }}" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="sidebar" data-color="rose" data-background-color="black" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
    Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

    Tip 2: you can also add an image using data-image tag
-->
  <div class="logo">
    
    <!-- <a href="http://www.creative-tim.com" class="simple-text logo-normal">
      {{ __('Creative Tim') }}
    </a> -->
    <img src="{{ asset('material') }}/img/logo/rsz_rmslogo.png" style="margin-left: 15px;" >
  </div>
  <div class="sidebar-wrapper">
    <div class="user">
      <div class="photo">
        @if (auth()->user()->picture)
            <img src="{{ auth()->user()->profilePicture() }}" alt="...">
        @else
            <img src="{{ asset('material') }}/img/placeholder.jpg" alt="...">
        @endif
      </div>
      <div class="user-info">
        <a data-toggle="collapse" href="#collapseExample" class="username">
          <span>
            {{ auth()->user()->name }}
            <b class="caret"></b>
          </span>
        </a>
        <div class="collapse" id="collapseExample">
          <ul class="nav">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('profile.edit') }}">
                <span class="sidebar-mini"> MP </span>
                <span class="sidebar-normal"> My Profile </span>
              </a>
            </li>
           <!--  <li class="nav-item">
              <a class="nav-link" href="{{ route('profile.edit') }}">
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
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
		
      <li class="nav-item {{ ($menuParent == 'laravel' || $activePage == 'dashboard') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#UserExample" {{ ($menuParent == 'laravel' || $activePage == 'dashboard') ? ' aria-expanded="true"' : '' }}>
           <i class="material-icons">account_circle</i>
          <p>{{ __('Profile') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($menuParent == 'dashboard' || $menuParent == 'laravel') ? ' show' : '' }}" id="UserExample">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('profile.edit') }}">
                <span class="sidebar-mini"> UP </span>
                <span class="sidebar-normal">{{ __('Your Profile') }} </span>
              </a>
            </li>

            <!--  {{Auth::user()->role_id}} -->


             @canany(['isAdmin','isTopManagement','manage-users'],App\User::class)
              <li class="nav-item{{ $activePage == 'role-management' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('role.index') }}">
                  <span class="sidebar-mini"> RM </span>
                  <span class="sidebar-normal"> {{ __('Role Management') }} </span>
                </a>
              </li>

               <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('user.index') }}">
                  <span class="sidebar-mini"> UM </span>
                  <span class="sidebar-normal"> {{ __('User Management') }} </span>
                </a>
              </li>
			  
			  
            @endcan
          
           
            <!-- @can('manage-items', App\User::class)
              <li class="nav-item{{ $activePage == 'category-management' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('category.index') }}">
                  <span class="sidebar-mini"> CM </span>
                  <span class="sidebar-normal"> {{ __('Category Management') }} </span>
                </a>
              </li>
            @endcan
            @can('manage-items', App\User::class)
              <li class="nav-item{{ $activePage == 'tag-management' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('tag.index') }}">
                  <span class="sidebar-mini"> TM </span>
                  <span class="sidebar-normal"> {{ __('Tag Management') }} </span>
                </a>
              </li>
            @endcan
            @can('manage-items', App\User::class)
              <li class="nav-item{{ $activePage == 'item-management' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('item.index') }}">
                  <span class="sidebar-mini"> IM </span>
                  <span class="sidebar-normal"> {{ __('Item Management') }} </span>
                </a>
              </li>
            @else
              <li class="nav-item{{ $activePage == 'item-management' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('item.index') }}">
                  <span class="sidebar-mini"> IM </span>
                  <span class="sidebar-normal"> {{ __('Items') }} </span>
                </a>
              </li>
            @endcan -->
          </ul>
        </div>
      </li>

<!--       @canany(['isAdmin'],App\User::class)
      <li class="nav-item {{ ($menuParent == 'Employee' || $activePage == 'employee' || $activePage == 'attendance-report' ) ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#Employee" {{ ($menuParent == 'employee' || $activePage == 'dashboard' || $activePage == 'attendance-report') ? ' aria-expanded="true"' : '' }}>
          <i class="material-icons">account_box</i>
          <p>{{ __('Employee') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($menuParent == 'Employee' || $activePage == 'attendance-report' ) ? ' show' : '' }}" id="Employee">
          <ul class="nav">
           
              <li class="nav-item{{ $activePage == 'employee' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('employee.index') }}">
                  <span class="sidebar-mini"> EM </span>
                  <span class="sidebar-normal"> {{ __('Employees') }} </span>
                </a>
              </li>
        
              
               <li class="nav-item{{ ($activePage == 'employee-attendance' || $activePage == 'attendance-report') ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('attendance.index') }}">
                  <span class="sidebar-mini"> AT </span>
                  <span class="sidebar-normal"> {{ __('Attendance Report') }} </span>
                </a>
               </li>
              
              
          </ul>
        </div>
      </li>


       <li class="nav-item {{ ($menuParent == 'Holidays') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#Holidays" {{ ($menuParent == 'Holidays' || $activePage == 'holidays') ? ' aria-expanded="true"' : '' }}>
          <i class="material-icons">account_box</i>
          <p>{{ __('Holydays') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($menuParent == 'Holidays') ? ' show' : '' }}" id="Holidays">
          <ul class="nav">
           
              <li class="nav-item{{ $activePage == 'holidays' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('holidays.index') }}">
                  <span class="sidebar-mini"> HD </span>
                  <span class="sidebar-normal"> {{ __('Holydays') }} </span>
                </a>
              </li>

             
          </ul>
        </div>
      </li>


      @endcan -->

      @canany(['isMerchandiser','isField_Manager','isAccounts','isHuman_Resource','isCoordianator','isAdmin','isTopManagement'],App\User::class)
      <li class="nav-item {{ ($menuParent == 'My-Activity' ) ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#My-Activity" {{ ($menuParent == 'employee' || $activePage == 'dashboard') ? ' aria-expanded="true"' : '' }}>
          <i class="material-icons">work</i>
          <p>{{ __('My Activity') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($menuParent == 'My-Activity' ) ? ' show' : '' }}" id="My-Activity">
          <ul class="nav">
           
               <li class="nav-item{{ $activePage == 'employee-attendance' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('emp-attendance.index') }}">
                  <span class="sidebar-mini"> AT </span>
                  <span class="sidebar-normal"> {{ __('Attendance') }} </span>
                </a>
              </li>

              <li class="nav-item{{ $activePage == 'leave-request' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('leaverequest.index') }}">
                  <span class="sidebar-mini"> L </span>
                  <span class="sidebar-normal"> {{ __('Leaves') }} </span>
                </a>
              </li>

              <li class="nav-item{{ $activePage == 'leave-balance' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('emp-leave-balance.index') }}">
                  <span class="sidebar-mini"> LB </span>
                  <span class="sidebar-normal"> {{ __('Leave Balance') }} </span>
                </a>
               </li>
          
            <li class="nav-item{{ $activePage == 'leave-rule' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('leave_rule.index') }}">
                  <span class="sidebar-mini"> LB </span>
                  <span class="sidebar-normal"> {{ __('Leave Rule') }} </span>
                </a>
               </li>
				
			  @canany(['isField_Manager'],App\User::class) 
               <li class="nav-item{{ $activePage == 'leaves' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('leaves.index') }}">
                  <span class="sidebar-mini"> LA </span>
                  <span class="sidebar-normal"> {{ __('Leave Approve') }} </span>
                </a>
              </li>
			  
			  @endcan
              
          </ul>
        </div>
      </li>

    
       @endcan

      @canany(['isHuman_Resource'],App\User::class)
      <li class="nav-item {{ ($menuParent == 'Employee') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#Employee" {{ ($menuParent == 'Employee' ) ? ' aria-expanded="true"' : '' }}>
          <i class="material-icons">account_box</i>
          <p>{{ __('Employee') }}
            <b class="caret"></b>
          </p>
        </a>
        
 
        <div class="collapse {{ ($menuParent == 'Employee') ? ' show' : '' }}" id="Employee">
          <ul class="nav">

              <li class="nav-item{{ $activePage == 'employee' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('employee.index') }}">
                  <span class="sidebar-mini"> EM </span>
                  <span class="sidebar-normal"> {{ __('Employees') }} </span>
                </a>
              </li>

              <li class="nav-item{{ $activePage == 'employee-leaves' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('employeeleaves.index') }}">
                  <span class="sidebar-mini"> EL </span>
                  <span class="sidebar-normal"> {{ __('Employee Leaves') }} </span>
                </a>
              </li>

               <li class="nav-item{{ $activePage == 'emp-leave-balance' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('leave-balance.index') }}">
                  <span class="sidebar-mini"> EB </span>
                  <span class="sidebar-normal"> {{ __('Employee Leave Balance') }} </span>
                </a>
               </li>

               <li class="nav-item{{ $activePage == 'employee-reporting' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('employee-reporting.index') }}">
                  <span class="sidebar-mini"> ER </span>
                  <span class="sidebar-normal"> {{ __('employee-reporting') }} </span>
                </a>
              </li>

              
          </ul>
        </div>
      </li>

      <li class="nav-item {{ ($menuParent == 'Attendance') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#Attendance" {{ ($menuParent == 'Attendance' ) ? ' aria-expanded="true"' : '' }}>
          <i class="material-icons">account_box</i>
          <p>{{ __('Attendance') }}
            <b class="caret"></b>
          </p>
        </a>
        
 
        <div class="collapse {{ ($menuParent == 'Attendance') ? ' show' : '' }}" id="Attendance">
          <ul class="nav">  
             
			  <!-- <li class="nav-item{{ $activePage == 'emp-overall-attendance' ? ' active' : '' }}">
                <a class="nav-link" href="{{ url('emp-overall-attendance') }}">
                  <span class="sidebar-mini"> OA </span>
                  <span class="sidebar-normal"> {{ __('Over All Attendance') }} </span>
                </a>
              </li> -->
             
              <li class="nav-item{{ $activePage == 'attendance-report' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('attendance.index') }}">
                  <span class="sidebar-mini"> AR </span>
                  <span class="sidebar-normal"> {{ __('Attendance Report') }} </span>
                </a>
              </li>

              <li class="nav-item{{ $activePage == 'dailyattendance' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('dailyattendance.index') }}">
                  <span class="sidebar-mini"> DA </span>
                  <span class="sidebar-normal"> {{ __('Daily Attendance') }} </span>
                </a>
              </li>

              <li class="nav-item{{ $activePage == 'mannual_attendance' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('mannual_attendance.index') }}">
                  <span class="sidebar-mini"> DA </span>
                  <span class="sidebar-normal"> {{ __('Manual Attendance') }} </span>
                </a>
              </li>
			  
			   <li class="nav-item{{ $activePage == 'mannual_attendance' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('update_leave_balance.index') }}">
                  <span class="sidebar-mini"> DA </span>
                  <span class="sidebar-normal"> {{ __('Update Leave Balance') }} </span>
                </a>
              </li>
         
              
          </ul>
        </div>
      </li>

 
       <li class="nav-item {{ ($menuParent == 'Holidays') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#Holidays" {{ ($menuParent == 'Holidays' || $activePage == 'holidays') ? ' aria-expanded="true"' : '' }}>
          <i class="material-icons">account_box</i>
          <p>{{ __('Holidays') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($menuParent == 'Holidays') ? ' show' : '' }}" id="Holidays">
          <ul class="nav">
           
              <li class="nav-item{{ $activePage == 'holidays' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('holidays.index') }}">
                  <span class="sidebar-mini"> HD </span>
                  <span class="sidebar-normal"> {{ __('Holidays') }} </span>
                </a>
              </li>

          
          </ul>
        </div>
      </li>

    @endcan



      @canany(['isAdmin','isTopManagement'],App\User::class)
		
		 <li class="nav-item{{ $activePage == 'audit_trial_details' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('audit_trial_details.index') }}">
          <i class="material-icons">art_track</i>
            <p>{{ __('Audit Trial') }}</p>
        </a>
      </li>
		
		 <li class="nav-item{{ $activePage == 'manualcheckin' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('manualcheckin.index') }}">
          <i class="material-icons">check_circle_outline</i>
            <p>{{ __('Manual Check In') }}</p>
        </a>
      </li>
		
       <li class="nav-item {{ ($menuParent == 'Live_Data') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#Live_Data" {{ ($menuParent == 'Live_Data' ) ? ' aria-expanded="true"' : '' }}>
          <i class="material-icons">location_on</i>
          <p>{{ __('Live Data') }}
            <b class="caret"></b>
          </p>
        </a>
        
		   
 
        <div class="collapse {{ ($menuParent == 'Live_Data') ? ' show' : '' }}" id="Live_Data">
          <ul class="nav">

              <li class="nav-item{{ $activePage == 'present_field' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('present_field') }}">
                  <span class="sidebar-mini"> PF </span> 
                  <span class="sidebar-normal"> {{ __('Present Field Managers') }} </span>
                </a>
              </li>

              <li class="nav-item{{ $activePage == 'present_merchant' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('present_merchant') }}">
                  <span class="sidebar-mini"> PM </span>
                  <span class="sidebar-normal"> {{ __('Present Merchandisers') }} </span>
                </a>
              </li>

               <li class="nav-item{{ $activePage == 'absent_merchant' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('absent_merchant') }}">
                  <span class="sidebar-mini"> AB </span>
                  <span class="sidebar-normal"> {{ __('Absernt Merchandisers') }} </span>
                </a>
               </li>

               <li class="nav-item{{ $activePage == 'total_timesheets' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('total_timesheets') }}">
                  <span class="sidebar-mini"> TT </span>
                  <span class="sidebar-normal"> {{ __('Total Timesheet') }} </span>
                </a>
              </li>

               <li class="nav-item{{ $activePage == 'today_timesheets' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('today_timesheet') }}">
                  <span class="sidebar-mini"> TT </span>
                  <span class="sidebar-normal"> {{ __('Today Timesheet') }} </span>
                </a>
              </li>

              
          </ul>
        </div>
      </li>
		
		
      <li class="nav-item {{ ($menuParent == 'Employee') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#Employee" {{ ($menuParent == 'Employee' ) ? ' aria-expanded="true"' : '' }}>
          <i class="material-icons">account_box</i>
          <p>{{ __('Employee') }}
            <b class="caret"></b>
          </p>
        </a>
        
 
        <div class="collapse {{ ($menuParent == 'Employee') ? ' show' : '' }}" id="Employee">
          <ul class="nav">

              <li class="nav-item{{ $activePage == 'employee' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('employee.index') }}">
                  <span class="sidebar-mini"> EM </span>
                  <span class="sidebar-normal"> {{ __('Employees') }} </span>
                </a>
              </li>

              <li class="nav-item{{ $activePage == 'employee-leaves' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('employeeleaves.index') }}">
                  <span class="sidebar-mini"> EL </span>
                  <span class="sidebar-normal"> {{ __('Employee Leaves') }} </span>
                </a>
              </li>

               <li class="nav-item{{ $activePage == 'emp-leave-balance' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('leave-balance.index') }}">
                  <span class="sidebar-mini"> EB </span>
                  <span class="sidebar-normal"> {{ __('Employee Leave Balance') }} </span>
                </a>
               </li>

               <li class="nav-item{{ $activePage == 'employee-reporting' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('employee-reporting.index') }}">
                  <span class="sidebar-mini"> ER </span>
                  <span class="sidebar-normal"> {{ __('employee-reporting') }} </span>
                </a>
              </li>

              
          </ul>
        </div>
      </li>
        
      <li class="nav-item {{ ($menuParent == 'Attendance') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#Attendance" {{ ($menuParent == 'Attendance' ) ? ' aria-expanded="true"' : '' }}>
          <i class="material-icons">account_box</i>
          <p>{{ __('Attendance') }}
            <b class="caret"></b>
          </p>
        </a>
        
 
        <div class="collapse {{ ($menuParent == 'Attendance') ? ' show' : '' }}" id="Attendance">
          <ul class="nav">  
             
               <!--<li class="nav-item{{ $activePage == 'emp-overall-attendance' ? ' active' : '' }}">
                <a class="nav-link" href="{{ url('emp-overall-attendance') }}">
                  <span class="sidebar-mini"> OA </span>
                  <span class="sidebar-normal"> {{ __('Over All Attendance') }} </span>
                </a>
              </li>-->
             
              <li class="nav-item{{ $activePage == 'attendance-report' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('attendance.index') }}">
                  <span class="sidebar-mini"> AR </span>
                  <span class="sidebar-normal"> {{ __('Attendance Report') }} </span>
                </a>
              </li>

              <li class="nav-item{{ $activePage == 'dailyattendance' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('dailyattendance.index') }}">
                  <span class="sidebar-mini"> DA </span>
                  <span class="sidebar-normal"> {{ __('Daily Attendance') }} </span>
                </a>
              </li>

              <li class="nav-item{{ $activePage == 'mannual_attendance' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('mannual_attendance.index') }}">
                  <span class="sidebar-mini"> DA </span>
                  <span class="sidebar-normal"> {{ __('Manual Attendance') }} </span>
                </a>
              </li>
          <li class="nav-item{{ $activePage == 'mannual_attendance' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('update_leave_balance.index') }}">
                  <span class="sidebar-mini"> DA </span>
                  <span class="sidebar-normal"> {{ __('Update Leave Balance') }} </span>
                </a>
              </li>
              
          </ul>
        </div>
      </li>

       <li class="nav-item {{ ($menuParent == 'Client') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#Client" {{ ($menuParent == 'Client' || $activePage == 'client') ? ' aria-expanded="true"' : '' }}>
          <i class="material-icons">account_box</i>
          <p>{{ __('Client & CDE') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($menuParent == 'Client') ? ' show' : '' }}" id="Client">
          <ul class="nav">
           
              <li class="nav-item{{ $activePage == 'client' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('client.index') }}">
                  <span class="sidebar-mini"> CL </span>
                  <span class="sidebar-normal"> {{ __('Client') }} </span>
                </a>
              </li>
			  
			   <li class="nav-item{{ $activePage == 'cde_user' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('cde.index') }}">
                  <span class="sidebar-mini"> CDE </span>
                  <span class="sidebar-normal"> {{ __('CDE') }} </span>
                </a>
              </li>

              
          </ul>
        </div>
      </li>

 
       <li class="nav-item {{ ($menuParent == 'Holidays') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#Holidays" {{ ($menuParent == 'Holidays' || $activePage == 'holidays') ? ' aria-expanded="true"' : '' }}>
          <i class="material-icons">account_box</i>
          <p>{{ __('Holidays') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($menuParent == 'Holidays') ? ' show' : '' }}" id="Holidays">
          <ul class="nav">
           
              <li class="nav-item{{ $activePage == 'holidays' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('holidays.index') }}">
                  <span class="sidebar-mini"> HD </span>
                  <span class="sidebar-normal"> {{ __('Holidays') }} </span>
                </a>
              </li>

          
          </ul>
        </div>
		   
		  
      </li>

        <li class="nav-item {{ ($menuParent == 'Store_Details') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#store" {{ ($menuParent == 'Store_Details' || $activePage == 'store_details') ? ' aria-expanded="true"' : '' }}>
          <i class="material-icons">storefront</i>
          <p>{{ __('Stores') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($menuParent == 'Store_Details') ? ' show' : '' }}" id="store">
          <ul class="nav">
              <li class="nav-item{{ $activePage == 'store_details' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('store_details.index') }}">
                  <span class="sidebar-mini">ST </span>
                  <span class="sidebar-normal"> {{ __('Stores') }} </span>
                </a>
              </li>
          </ul>
        </div>
      </li>

       <li class="nav-item {{ ($menuParent == 'Products') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#products" {{ ($menuParent == 'Products' || $activePage == 'brand_details') ? ' aria-expanded="true"' : '' }}>
          <i class="fa fa-product-hunt"></i>
          <p>{{ __('Products') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($menuParent == 'Products') ? ' show' : '' }}" id="products">
         <ul class="nav">
              <li class="nav-item{{ $activePage == 'brand_details' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('brand_details.index') }}">
                  <span class="sidebar-mini">B </span>
                  <span class="sidebar-normal"> {{ __('Brand') }} </span>
                </a>
              </li>

                <li class="nav-item{{ $activePage == 'category_details' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('category_details.index') }}">
                  <span class="sidebar-mini">C </span>
                  <span class="sidebar-normal"> {{ __('Category') }} </span>
                </a>
              </li>

               <li class="nav-item{{ $activePage == 'product_details' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('product_details.index') }}">
                  <span class="sidebar-mini">P </span>
                  <span class="sidebar-normal"> {{ __('Products') }} </span>
                </a>
              </li>
             
          </ul>
        </div>
      </li>

        <li class="nav-item {{ ($menuParent == 'Outlets') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#Outlet" {{ ($menuParent == 'Leave-Rule' || $activePage == 'leave-rule') ? ' aria-expanded="true"' : '' }}>
         <i class="material-icons">outlet</i>
          <p>{{ __('Outlets') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($menuParent == 'Outlets') ? ' show' : '' }}" id="Outlet">
          <ul class="nav">
              <li class="nav-item{{ $activePage == 'outlets' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('admin_outlets') }}">
                  <span class="sidebar-mini">OL </span>
                  <span class="sidebar-normal"> {{ __('Outlet List') }} </span>
                </a>
              </li>
			  
			  <li class="nav-item{{ $activePage == 'admin_outlets_stockexpiry' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('overalloutlet_stockexpiry.index') }}">
                  <span class="sidebar-mini">OSE </span>
                  <span class="sidebar-normal"> {{ __('Outlet Stock Expiry') }} </span>
                </a>
              </li>
             
          </ul>
        </div>
      </li>

       <li class="nav-item {{ ($menuParent == 'Timesheets') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#timesheets" {{ ($menuParent == 'Store_Details' || $activePage == 'store_details') ? ' aria-expanded="true"' : '' }}>
          <i class="material-icons">schedule</i>
          <p>{{ __('Timesheet') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($menuParent == 'Timesheets') ? ' show' : '' }}" id="timesheets">
          <ul class="nav">
              <li class="nav-item{{ $activePage == 'scheduled_outlets' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('schedule-outlets.index') }}">
                  <span class="sidebar-mini">ST </span>
                  <span class="sidebar-normal"> {{ __('Scheduled Timesheet') }} </span>
                </a>
              </li>
               <li class="nav-item{{ $activePage == 'unscheduled_outlets' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('unschedule-outlets.index') }}">
                  <span class="sidebar-mini">UST </span>
                  <span class="sidebar-normal"> {{ __('Unscheduled Timesheet') }} </span>
                </a>
              </li>
			  <li class="nav-item{{ $activePage == 'over_all_journeyplan' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('over_all_journeyplan.index') }}">
                  <span class="sidebar-mini">MJS </span>
                  <span class="sidebar-normal"> {{ __('Monthly Journeyplan Schedule') }} </span>
                </a>
              </li>
          </ul>
        </div>
      </li>



    @endcan


    @canany(['isField_Manager'],App\User::class)

    
       <li class="nav-item {{ ($menuParent == 'Timesheets') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#timesheets" {{ ($menuParent == 'Store_Details' || $activePage == 'store_details') ? ' aria-expanded="true"' : '' }}>
          <i class="material-icons">schedule</i>
          <p>{{ __('Timesheet') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($menuParent == 'Timesheets') ? ' show' : '' }}" id="timesheets">
          <ul class="nav">
              <li class="nav-item{{ $activePage == 'scheduled_outlets' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('schedule-outlets.index') }}">
                  <span class="sidebar-mini">ST </span>
                  <span class="sidebar-normal"> {{ __('Scheduled Timesheet') }} </span>
                </a>
              </li>
               <li class="nav-item{{ $activePage == 'unscheduled_outlets' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('unschedule-outlets.index') }}">
                  <span class="sidebar-mini">UST </span>
                  <span class="sidebar-normal"> {{ __('Unscheduled Timesheet') }} </span>
                </a>
              </li>
			  <li class="nav-item{{ $activePage == 'over_all_journeyplan' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('over_all_journeyplan.index') }}">
                  <span class="sidebar-mini">MJS </span>
                  <span class="sidebar-normal"> {{ __('Monthly Journeyplan Schedule') }} </span>
                </a>
              </li>
          </ul>
        </div>
      </li>


      <li class="nav-item {{ ($menuParent == 'Promotion') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#promotion" {{ ($menuParent == 'Promotion' || $activePage == 'promotion') ? ' aria-expanded="true"' : '' }}>
         <i class="fa fa-tag"></i>
          <p>{{ __('Promotions') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($menuParent == 'Promotion') ? ' show' : '' }}" id="promotion">
          <ul class="nav">
              <li class="nav-item{{ $activePage == 'promotion' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('promotion.index') }}">
                  <span class="sidebar-mini">P </span>
                  <span class="sidebar-normal"> {{ __('Promotions') }} </span>
                </a>
              </li>

               <li class="nav-item{{ $activePage == 'promotion-report' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('report_promo') }}">
                  <span class="sidebar-mini">R </span>
                  <span class="sidebar-normal"> {{ __('Report') }} </span>
                </a>
              </li>
             
          </ul>
        </div>
      </li>

     

      <li class="nav-item {{ ($menuParent == 'Timesheet') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#Timesheet" {{ ($menuParent == 'Timesheet' || $activePage == 'date-timesheet') ? ' aria-expanded="true"' : '' }}>
          <i class="material-icons">place</i>
          <p>{{ __('JourneyPlan') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($menuParent == 'Timesheet') ? ' show' : '' }}" id="Timesheet">
          <ul class="nav">
             <li class="nav-item{{ $activePage == 'day_jouney_plan' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('defined-outlets.index') }}">
                  <span class="sidebar-mini">SJ </span>
                  <span class="sidebar-normal"> {{ __('Scheduled JourneyPlan') }} </span>
                </a>
              </li>
              <li class="nav-item{{ $activePage == 'date-timesheet' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('merchant-timesheet.index') }}">
                  <span class="sidebar-mini">UJ </span>
                  <span class="sidebar-normal"> {{ __('UnScheduled JourneyPlan') }} </span>
                </a>
              </li>
              <!--   <li class="nav-item{{ $activePage == 'scheduled_report' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('scheduled_report.index') }}">
                  <span class="sidebar-mini">SJPR </span>
                  <span class="sidebar-normal"> {{ __('Scheduled JP Report') }} </span>
                </a>
              </li> -->
          </ul>
        </div>
      </li>

       <li class="nav-item {{ ($menuParent == 'Stock_Expiry') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#stock_report" {{ ($menuParent == 'Stock_Expiry' || $activePage == 'outlet_stockexpiry') ? ' aria-expanded="true"' : '' }}>
          <i class="material-icons">schedule</i>
          <p>{{ __('Stock Expiry') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($menuParent == 'Stock_Expiry') ? ' show' : '' }}" id="stock_report">
          <ul class="nav">
              <li class="nav-item{{ $activePage == 'outlet_stockexpiry' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('stock_report') }}">
                  <span class="sidebar-mini">ST </span>
                  <span class="sidebar-normal"> {{ __('Stock Expiry Report') }} </span>
                </a>
              </li>
             
          </ul>
        </div>
      </li>


      <li class="nav-item {{ ($menuParent == 'Field_Manager_Report') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#f_outlet_report" {{ ($menuParent == 'Field_Manager_Report' || $activePage == 'field_outlet_report') ? ' aria-expanded="true"' : '' }}>
         <i class="material-icons">book</i>
          <p>{{ __('Outlet Report') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($menuParent == 'Field_Manager_Report') ? ' show' : '' }}" id="f_outlet_report">
          <ul class="nav">
              <li class="nav-item{{ $activePage == 'field_outlet_report' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('f_outlet_report') }}">
                  <span class="sidebar-mini">RE </span>
                  <span class="sidebar-normal"> {{ __('Report') }} </span>
                </a>
              </li>

          </ul>
        </div>
      </li>
		
		 <li class="nav-item {{ ($menuParent == 'Cde_Reporting') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#cde_reporting" {{ ($menuParent == 'Cde_Reporting' || $activePage == 'cde_reporting') ? ' aria-expanded="true"' : '' }}>
         <i class="material-icons">book</i>
          <p>{{ __('CDE Reporting') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($menuParent == 'Cde_Reporting') ? ' show' : '' }}" id="cde_reporting">
          <ul class="nav">
              <li class="nav-item{{ $activePage == 'cde_reporting' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('cde_reporting.index') }}">
                  <span class="sidebar-mini">CDE </span>
                  <span class="sidebar-normal"> {{ __('Reporting') }} </span>
                </a>
              </li>

          </ul>
        </div>
      </li>


       <li class="nav-item {{ ($menuParent == 'weekoff') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#weekoff" {{ ($menuParent == 'WeekOff' || $activePage == 'WeekOff') ? ' aria-expanded="true"' : '' }}>
          <i class="material-icons">calendar_today</i>
          <p>{{ __('Week Off') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($menuParent == 'weekoff') ? ' show' : '' }}" id="weekoff">
          <ul class="nav">
           
              <li class="nav-item{{ $activePage == 'WeekOff' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('weekoff.index') }}">
                  <span class="sidebar-mini"> WO </span>
                  <span class="sidebar-normal"> {{ __('Week Off') }} </span>
                </a>
              </li>

          </ul>
        </div>
      </li>

		<li class="nav-item {{ ($menuParent == 'Reliever') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#Reliever" {{ ($menuParent == 'Reliever' || $activePage == 'reliever') ? ' aria-expanded="true"' : '' }}>
          <i class="material-icons">swipe</i>
          <p>{{ __('Reliever') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($menuParent == 'Reliever') ? ' show' : '' }}" id="Reliever">
          <ul class="nav">
           
              <li class="nav-item{{ $activePage == 'reliever' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('reliever.index') }}">
                  <span class="sidebar-mini"> R </span>
                  <span class="sidebar-normal"> {{ __('Reliever') }} </span>
                </a>
              </li>

          </ul>
        </div>
      </li>


       @endcan

      @canany(['isMerchandiser'],App\User::class)
      <li class="nav-item {{ ($menuParent == 'Journey-Plan') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#Journey" {{ ($menuParent == 'Journey-Plan' || $activePage == 'journey-plan') ? ' aria-expanded="true"' : '' }}>
          <i class="material-icons">location_on</i>
          <p>{{ __('Journey Plan') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($menuParent == 'Journey-Plan') ? ' show' : '' }}" id="Journey">
          <ul class="nav">
              <li class="nav-item{{ $activePage == 'journey-plan' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('journey-plan.index') }}">
                  <span class="sidebar-mini">JP </span>
                  <span class="sidebar-normal"> {{ __('Journey Plan') }} </span>
                </a>
              </li>
          </ul>
        </div>
      </li>

       <li class="nav-item {{ ($menuParent == 'Timesheet') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#timesheet" {{ ($menuParent == 'Journey-Plan' || $activePage == 'journey-plan') ? ' aria-expanded="true"' : '' }}>
          <i class="material-icons">schedule</i>
          <p>{{ __('TimeSheet') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($menuParent == 'Timesheet') ? ' show' : '' }}" id="timesheet">
          <ul class="nav">
               <li class="nav-item{{ $activePage == 'day-timesheet' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('timesheet.index') }}">
                  <span class="sidebar-mini">ST </span>
                  <span class="sidebar-normal"> {{ __('Scheduled Timesheet') }} </span>
                </a>
              </li>
              <li class="nav-item{{ $activePage == 'date-timesheet' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('date_timesheet') }}">
                  <span class="sidebar-mini">UST </span>
                  <span class="sidebar-normal"> {{ __('UnScheduled Timesheet') }} </span>
                </a>
              </li>
          </ul>
        </div>
      </li>

     
       @endcan


     @canany(['isClient'],App\User::class)

      <li class="nav-item {{ ($menuParent == 'Store_Details') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#store" {{ ($menuParent == 'Store_Details' || $activePage == 'store_details') ? ' aria-expanded="true"' : '' }}>
          <i class="material-icons">storefront</i>
          <p>{{ __('Stores') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($menuParent == 'Store_Details') ? ' show' : '' }}" id="store">
          <ul class="nav">
              <li class="nav-item{{ $activePage == 'store_details' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('store_details.index') }}">
                  <span class="sidebar-mini">ST </span>
                  <span class="sidebar-normal"> {{ __('Stores') }} </span>
                </a>
              </li>
          </ul>
        </div>
      </li>

       <li class="nav-item {{ ($menuParent == 'Products') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#products" {{ ($menuParent == 'Products' || $activePage == 'brand_details') ? ' aria-expanded="true"' : '' }}>
          <i class="fa fa-product-hunt"></i>
          <p>{{ __('Products') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($menuParent == 'Products') ? ' show' : '' }}" id="products">
          <ul class="nav">
              <li class="nav-item{{ $activePage == 'brand_details' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('brand_details.index') }}">
                  <span class="sidebar-mini">B </span>
                  <span class="sidebar-normal"> {{ __('Brand') }} </span>
                </a>
              </li>

                <li class="nav-item{{ $activePage == 'category_details' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('category_details.index') }}">
                  <span class="sidebar-mini">C </span>
                  <span class="sidebar-normal"> {{ __('Category') }} </span>
                </a>
              </li>

               <li class="nav-item{{ $activePage == 'product_details' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('product_details.index') }}">
                  <span class="sidebar-mini">P </span>
                  <span class="sidebar-normal"> {{ __('Products') }} </span>
                </a>
              </li>
             
          </ul>
        </div>
      </li>

       <li class="nav-item {{ ($menuParent == 'Outlets') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#Outlet" {{ ($menuParent == 'Leave-Rule' || $activePage == 'leave-rule') ? ' aria-expanded="true"' : '' }}>
         <i class="material-icons">outlet</i>
          <p>{{ __('Outlets') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($menuParent == 'Outlets') ? ' show' : '' }}" id="Outlet">
          <ul class="nav">
              <li class="nav-item{{ $activePage == 'outlets' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('outlet.index') }}">
                  <span class="sidebar-mini">OL </span>
                  <span class="sidebar-normal"> {{ __('Outlet List') }} </span>
                </a>
              </li>

               <li class="nav-item{{ $activePage == 'client_outlet' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('client_report.index') }}">
                  <span class="sidebar-mini">OT </span>
                  <span class="sidebar-normal"> {{ __('Outlet Timesheets') }} </span>
                </a>
              </li>

               <li class="nav-item{{ $activePage == 'client_outlet_report' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('client_outlet_report') }}">
                  <span class="sidebar-mini">OR </span>
                  <span class="sidebar-normal"> {{ __('Outlet Report') }} </span>
                </a>
              </li>
			  
			    <li class="nav-item{{ $activePage == 'trade_stock_report' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('trade_stock_report') }}">
                  <span class="sidebar-mini">TR </span>
                  <span class="sidebar-normal"> {{ __('Trade Report') }} </span>
                </a>
              </li>
             
          </ul>
        </div>
      </li>
      
    

    @endcan



    @canany(['isSalesman'],App\User::class)

      <li class="nav-item {{ ($menuParent == 'TimeSheet-Approval') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#timeSheet-approval" {{ ($menuParent == 'TimeSheet-Approval' || $activePage == 'timeSheet-approval') ? ' aria-expanded="true"' : '' }}>
          <i class="material-icons">schedule</i>
          <p>{{ __('TimeSheet Approval') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($menuParent == 'TimeSheet-Approval') ? ' show' : '' }}" id="timeSheet-approval">
          <ul class="nav">
              <li class="nav-item{{ $activePage == 'timesheet-approval' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('timesheet-approval.index') }}">
                  <span class="sidebar-mini">OL </span>
                  <span class="sidebar-normal"> {{ __('TimeSheets') }} </span>
                </a>
              </li>
          </ul>
        </div>
      </li>

     
       @endcan

       @canany(['isCDE'],App\User::class)

    
      <li class="nav-item {{ ($menuParent == 'Timesheets') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#timesheets" {{ ($menuParent == 'Store_Details' || $activePage == 'store_details') ? ' aria-expanded="true"' : '' }}>
          <i class="material-icons">schedule</i>
          <p>{{ __('Timesheet') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($menuParent == 'Timesheets') ? ' show' : '' }}" id="timesheets">
          <ul class="nav">
              <li class="nav-item{{ $activePage == 'scheduled_outlets' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('schedule-outlets.index') }}">
                  <span class="sidebar-mini">ST </span>
                  <span class="sidebar-normal"> {{ __('Scheduled Timesheet') }} </span>
                </a>
              </li>
               <li class="nav-item{{ $activePage == 'unscheduled_outlets' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('unschedule-outlets.index') }}">
                  <span class="sidebar-mini">UST </span>
                  <span class="sidebar-normal"> {{ __('Unscheduled Timesheet') }} </span>
                </a>
              </li>
          </ul>
        </div>
      </li>


      <!--<li class="nav-item {{ ($menuParent == 'Promotion') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#promotion" {{ ($menuParent == 'Promotion' || $activePage == 'promotion') ? ' aria-expanded="true"' : '' }}>
         <i class="fa fa-tag"></i>
          <p>{{ __('Promotions') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($menuParent == 'Promotion') ? ' show' : '' }}" id="promotion">
          <ul class="nav">
              <li class="nav-item{{ $activePage == 'promotion' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('promotion.index') }}">
                  <span class="sidebar-mini">P </span>
                  <span class="sidebar-normal"> {{ __('Promotions') }} </span>
                </a>
              </li>

               <li class="nav-item{{ $activePage == 'promotion-report' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('report_promo') }}">
                  <span class="sidebar-mini">R </span>
                  <span class="sidebar-normal"> {{ __('Report') }} </span>
                </a>
              </li>
             
          </ul>
        </div>
      </li>-->

     

      <li class="nav-item {{ ($menuParent == 'Timesheet') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#Timesheet" {{ ($menuParent == 'Timesheet' || $activePage == 'date-timesheet') ? ' aria-expanded="true"' : '' }}>
          <i class="material-icons">place</i>
          <p>{{ __('JourneyPlan') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($menuParent == 'Timesheet') ? ' show' : '' }}" id="Timesheet">
          <ul class="nav">
             <li class="nav-item{{ $activePage == 'day_jouney_plan' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('defined-outlets.index') }}">
                  <span class="sidebar-mini">SJ </span>
                  <span class="sidebar-normal"> {{ __('Scheduled JourneyPlan') }} </span>
                </a>
              </li>
              <li class="nav-item{{ $activePage == 'date-timesheet' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('merchant-timesheet.index') }}">
                  <span class="sidebar-mini">UJ </span>
                  <span class="sidebar-normal"> {{ __('UnScheduled JourneyPlan') }} </span>
                </a>
              </li>
           
          </ul>
        </div>
      </li>

       <li class="nav-item {{ ($menuParent == 'Stock_Expiry') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#stock_report" {{ ($menuParent == 'Stock_Expiry' || $activePage == 'outlet_stockexpiry') ? ' aria-expanded="true"' : '' }}>
          <i class="material-icons">schedule</i>
          <p>{{ __('Stock Expiry') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($menuParent == 'Stock_Expiry') ? ' show' : '' }}" id="stock_report">
          <ul class="nav">
              <li class="nav-item{{ $activePage == 'outlet_stockexpiry' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('stock_report') }}">
                  <span class="sidebar-mini">ST </span>
                  <span class="sidebar-normal"> {{ __('Stock Expiry Report') }} </span>
                </a>
              </li>
             
          </ul>
        </div>
      </li>


      <li class="nav-item {{ ($menuParent == 'Field_Manager_Report') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#f_outlet_report" {{ ($menuParent == 'Field_Manager_Report' || $activePage == 'field_outlet_report') ? ' aria-expanded="true"' : '' }}>
         <i class="material-icons">book</i>
          <p>{{ __('Outlet Report') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($menuParent == 'Field_Manager_Report') ? ' show' : '' }}" id="f_outlet_report">
          <ul class="nav">
              <li class="nav-item{{ $activePage == 'field_outlet_report' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('f_outlet_report') }}">
                  <span class="sidebar-mini">RE </span>
                  <span class="sidebar-normal"> {{ __('Report') }} </span>
                </a>
              </li>

          </ul>
        </div>
      </li>



      <!-- <li class="nav-item {{ ($menuParent == 'weekoff') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#weekoff" {{ ($menuParent == 'WeekOff' || $activePage == 'WeekOff') ? ' aria-expanded="true"' : '' }}>
          <i class="material-icons">calendar_today</i>
          <p>{{ __('Week Off') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($menuParent == 'weekoff') ? ' show' : '' }}" id="weekoff">
          <ul class="nav">
           
              <li class="nav-item{{ $activePage == 'WeekOff' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('weekoff.index') }}">
                  <span class="sidebar-mini"> WO </span>
                  <span class="sidebar-normal"> {{ __('Week Off') }} </span>
                </a>
              </li>

          </ul>
        </div>
      </li>-->


    @endcan
   

     <!--  <li class="nav-item {{ $menuParent == 'pages' ? 'active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#pagesExamples" {{ $menuParent == 'Pages' ? 'aria-expanded="true"' : '' }}>
          <i class="material-icons">image</i>
          <p> {{ __('Pages') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse{{ $menuParent == 'pages' ? ' show' : '' }}" id="pagesExamples">
          <ul class="nav">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('page.pricing') }}">
                <span class="sidebar-mini"> P </span>
                <span class="sidebar-normal"> {{ __('Pricing') }} </span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('page.rtl-support') }}">
                <span class="sidebar-mini"> RS </span>
                <span class="sidebar-normal"> {{ __('RTL Support') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'timeline' ? ' active' : '' }} ">
              <a class="nav-link" href="{{ route('page.timeline') }}">
                <span class="sidebar-mini"> T </span>
                <span class="sidebar-normal"> {{ __('Timeline') }} </span>
              </a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="{{ route('page.lock') }}">
                <span class="sidebar-mini"> LSP </span>
                <span class="sidebar-normal"> {{ __('Lock Screen Page') }} </span>
              </a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="{{ route('profile.edit') }}">
                <span class="sidebar-mini"> UP </span>
                <span class="sidebar-normal"> User Profile </span>
              </a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="{{ route('page.error') }}">
                <span class="sidebar-mini"> E </span>
                <span class="sidebar-normal"> Error Page </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item {{ $menuParent == 'compoments' ? 'active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#componentsExamples" {{ $menuParent == 'components' ? 'aria-expanded="true"' : '' }}>
          <i class="material-icons">apps</i>
          <p> Components
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ $menuParent == 'components' ? ' show' : '' }}" id="componentsExamples">
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
            <li class="nav-item{{ $activePage == 'buttons' ? ' active' : '' }} ">
              <a class="nav-link" href="{{ route('page.buttons') }}">
                <span class="sidebar-mini"> B </span>
                <span class="sidebar-normal"> {{ __('Buttons') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'grid' ? ' active' : '' }} ">
              <a class="nav-link" href="{{ route('page.grid') }}">
                <span class="sidebar-mini"> GS </span>
                <span class="sidebar-normal"> {{ __('Grid System') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'panels' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('page.panels') }}">
                <span class="sidebar-mini"> P </span>
                <span class="sidebar-normal"> {{ __('Panels') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'sweet-alert' ? ' active' : '' }} ">
              <a class="nav-link" href="{{ route('page.sweet-alert') }}">
                <span class="sidebar-mini"> SA </span>
                <span class="sidebar-normal"> {{ __('Sweet Alert') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'notifications' ? ' active' : '' }} ">
              <a class="nav-link" href="{{ route('page.notifications') }}">
                <span class="sidebar-mini"> N </span>
                <span class="sidebar-normal"> {{ __('Notifications') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'icons' ? ' active' : '' }} ">
              <a class="nav-link" href="{{ route('page.icons') }}">
                <span class="sidebar-mini"> I </span>
                <span class="sidebar-normal"> {{ __('Icons') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'typography' ? ' active' : '' }} ">
              <a class="nav-link" href="{{ route('page.typography') }}">
                <span class="sidebar-mini"> T </span>
                <span class="sidebar-normal"> {{ __('Typography') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item {{ $menuParent == 'forms' ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#formsExamples" {{ $menuParent == 'forms' ? 'aria-expanded="true"' : '' }}>
          <i class="material-icons">content_paste</i>
          <p> Forms
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ $menuParent == 'forms' ? 'show' : '' }}" id="formsExamples">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'form_regular' ? ' active' : '' }} ">
              <a class="nav-link" href="{{ route('page.regular_forms') }}">
                <span class="sidebar-mini"> RF </span>
                <span class="sidebar-normal"> {{ __('Regular Forms') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'form_extended' ? ' active' : '' }} ">
              <a class="nav-link" href="{{ route('page.extended_forms') }}">
                <span class="sidebar-mini"> EF </span>
                <span class="sidebar-normal"> {{ __('Extended Forms') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'form_validation' ? ' active' : '' }} ">
              <a class="nav-link" href="{{ route('page.validation_forms') }}">
                <span class="sidebar-mini"> VF </span>
                <span class="sidebar-normal"> {{ __('Validation Forms') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'form_wizard' ? ' active' : '' }} ">
              <a class="nav-link" href="{{ route('page.wizard_forms') }}">
                <span class="sidebar-mini"> W </span>
                <span class="sidebar-normal"> {{ __('Wizard') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item {{ $menuParent == 'tables' ? 'active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#tablesExamples" {{ $menuParent == 'tables' ? 'aria-expanded="true"' : '' }}>
          <i class="material-icons">grid_on</i>
          <p> {{ __('Tables') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ $menuParent == 'tables' ? 'show' : '' }}" id="tablesExamples">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'regular' ? ' active' : '' }}  ">
              <a class="nav-link" href="{{ route('page.regular_tables') }}">
                <span class="sidebar-mini"> RT </span>
                <span class="sidebar-normal"> {{ __('Regular Tables') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'extended' ? ' active' : '' }}  ">
              <a class="nav-link" href="{{ route('page.extended_tables') }}">
                <span class="sidebar-mini"> ET </span>
                <span class="sidebar-normal"> {{ __('Extended Tables') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'datatables' ? ' active' : '' }} ">
              <a class="nav-link" href="{{ route('page.datatable_tables') }}">
                <span class="sidebar-mini"> DT </span>
                <span class="sidebar-normal"> {{ __('DataTables.net') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item {{ $menuParent == 'maps' ? 'active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#mapsExamples" {{ $menuParent == 'maps' ? 'aria-expanded="true"' : '' }}>
          <i class="material-icons">place</i>
          <p> Maps
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ $menuParent == 'maps' ? 'show' : '' }}" id="mapsExamples">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'google_maps' ? ' active' : '' }} ">
              <a class="nav-link" href="{{ route('page.google_maps') }}">
                <span class="sidebar-mini"> GM </span>
                <span class="sidebar-normal"> {{ __('Google Maps') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'fullscreen_maps' ? ' active' : '' }} ">
              <a class="nav-link" href="{{ route('page.fullscreen_maps') }}">
                <span class="sidebar-mini"> FSM </span>
                <span class="sidebar-normal"> {{ __('Full Screen Map') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'vector_maps' ? ' active' : '' }} ">
              <a class="nav-link" href="{{ route('page.vector_maps') }}">
                <span class="sidebar-mini"> VM </span>
                <span class="sidebar-normal"> {{ __('Vector Map') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item{{ $activePage == 'widgets' ? ' active' : '' }} ">
        <a class="nav-link" href="{{ route('page.widgets') }}">
          <i class="material-icons">widgets</i>
          <p> Widgets </p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'charts' ? ' active' : '' }} ">
        <a class="nav-link" href="{{ route('page.charts') }}">
          <i class="material-icons">timeline</i>
          <p> Charts </p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'calendar' ? ' active' : '' }} ">
        <a class="nav-link" href="{{ route('page.calendar') }}">
          <i class="material-icons">date_range</i>
          <p> Calendar </p>
        </a>
      </li> -->

    </ul>

  </div>
</div>




