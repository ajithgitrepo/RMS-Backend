<style type="text/css">
    .bcBar .legend_div ul li p {
   
        color: #000;
    }
    .bcBar .legend_div {
        margin-bottom: 10px;
        margin-top: 15px;
    }
    .dt-buttons {
        float: right !important;
        margin-left: 20px;
        margin-right: 0px;
    }
    button.dt-button.buttons-excel.buttons-html5.btn-primary {
        border-radius: 5px;
    }
</style>

 <link href="<?php echo e(asset('material')); ?>/dist/pie_chart/components.min.css" rel="stylesheet">
 
<?php $__env->startSection('content'); ?>
<div class="content">
  <div class="content">
    <div class="container-fluid">

     <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['isHuman_Resource'],App\User::class)): ?>
      <div class="row">

        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="material-icons">account_box</i>
              </div>
              <h2 class="text-center" style="color: #827e7e;"><?php echo e($total_employees); ?></h2>
              <h5 class="text-center" style="color: #827e7e;" >Total Employees</h5>
            </div>
          </div>
        </div>

         <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">account_box</i>
              </div>
              <h2 class="text-center" style="color: #827e7e;"><?php echo e($today_present); ?></h2>
              <h5 class="text-center" style="color: #827e7e;" >Present Employees</h5>
            </div>
        
          </div>
        </div>

         <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">account_box</i>
              </div>
              <h2 class="text-center" style="color: #827e7e;"><?php echo e($today_absent); ?></h2>
              <h5 class="text-center" style="color: #827e7e;" >Absent Employees</h5>
            </div>
         
          </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="material-icons">account_box</i>
              </div>
              <h2 class="text-center" style="color: #827e7e;"><?php echo e($total_field_managers); ?></h2>
              <h5 class="text-center" style="color: #827e7e;" >Field Managers</h5>
            </div>
          </div>
        </div>

         <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">account_box</i>
              </div>
              <h2 class="text-center" style="color: #827e7e;"><?php echo e($present_field_managers); ?></h2>
              <h5 class="text-center" style="color: #827e7e;" >Present Field Managers</h5>
            </div>
         
          </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">account_box</i>
              </div>
              <h2 class="text-center" style="color: #827e7e;"><?php echo e($absent_field_managers); ?></h2>
              <h5 class="text-center" style="color: #827e7e;" >Absent Field Managers</h5>
            </div>
         
          </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="material-icons">account_box</i>
              </div>
              <h2 class="text-center" style="color: #827e7e;"><?php echo e($total_merchandisers); ?></h2>
              <h5 class="text-center" style="color: #827e7e;" >Merchandisers</h5>
            </div>
        
          </div>
        </div>

       

         <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">account_box</i>
              </div>
              <h2 class="text-center" style="color: #827e7e;"><?php echo e($present_merchandisers); ?></h2>
              <h5 class="text-center" style="color: #827e7e;" >Present Merchandiser</h5>
            </div>
         
          </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">account_box</i>
              </div>
              <h2 class="text-center" style="color: #827e7e;"><?php echo e($absent_merchandiesers); ?></h2>
              <h5 class="text-center" style="color: #827e7e;" >Absent Merchandisers</h5>
            </div>
         
          </div>
        </div>
      </div>

      <?php endif; ?>


     <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['isMerchandiser'],App\User::class)): ?>
     

        <h2 class="text-center">Monthly Report</h2>

        <div class="row">

        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="material-icons">account_box</i>
              </div>
              <h2 class="text-center" style="color: #827e7e;"><?php echo e($SheduleCalls); ?></h2>
              <h5 class="text-center" style="color: #827e7e;" >Sheduled Outlets</h5>
            </div>
          </div>
        </div>

         <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">account_box</i>
              </div>
              <h2 class="text-center" style="color: #827e7e;"><?php echo e($UnSheduleCalls); ?></h2>
              <h5 class="text-center" style="color: #827e7e;" >UnSheduled Outlets</h5>
            </div>
        
          </div>
        </div>

         <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">account_box</i>
              </div>
              <h2 class="text-center" style="color: #827e7e;"><?php echo e($SheduleCallsDone); ?></h2>
              <h5 class="text-center" style="color: #827e7e;" >Shedule Outlets Done</h5>
            </div>
         
          </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="material-icons">account_box</i>
              </div>
              <h2 class="text-center" style="color: #827e7e;"><?php echo e($UnSheduleCallsDone); ?></h2>
              <h5 class="text-center" style="color: #827e7e;" >UnShedule Outlets Done</h5>
            </div>
          </div>
        </div>

         <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">account_box</i>
              </div>
              <h2 class="text-center" style="color: #827e7e;"><?php echo e($Attendance); ?></h2>
              <h5 class="text-center" style="color: #827e7e;" >Attendance</h5>
            </div>
         
          </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">account_box</i>
              </div>
              <h2 class="text-center" style="color: #827e7e;"><?php echo e($WorkingTime); ?></h2>
              <h5 class="text-center" style="color: #827e7e;" >Working Time</h5>
            </div>
         
          </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">account_box</i>
              </div>
              <h2 class="text-center" style="color: #827e7e;"><?php echo e($EffectiveTime); ?></h2>
              <h5 class="text-center" style="color: #827e7e;" >Effective Time</h5>
            </div>
        
          </div>
        </div>

       

         <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">account_box</i>
              </div>
              <h2 class="text-center" style="color: #827e7e;"><?php echo e($TravelTime); ?></h2>
              <h5 class="text-center" style="color: #827e7e;" >Travel Time</h5>
            </div>
         
          </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">account_box</i>
              </div>
              <h2 class="text-center" style="color: #827e7e;"><?php echo e($JourneyPlanpercentage); ?></h2>
              <h5 class="text-center" style="color: #827e7e;" >Journey Plan percentage</h5>
            </div>
          </div>
        </div>
      </div>

      <h2 class="text-center">Today Report</h2>

      <div class="row">

         <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="material-icons">account_box</i>
              </div>
              <h2 class="text-center" style="color: #827e7e;"><?php echo e($today_outlets); ?></h2>
              <h5 class="text-center" style="color: #827e7e;" >Today Outlets</h5>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">account_box</i>
              </div>
              <h2 class="text-center" style="color: #827e7e;"><?php echo e($today_completed); ?></h2>
              <h5 class="text-center" style="color: #827e7e;" >Today Completed Outlets</h5>
            </div>
          </div>
        </div>

         <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">account_box</i>
              </div>
              <h2 class="text-center" style="color: #827e7e;"><?php echo e($today_pending); ?></h2>
              <h5 class="text-center" style="color: #827e7e;" >Today Pending Outlets</h5>
            </div>
          </div>
        </div>

    </div>


     <?php endif; ?> 


     <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['isField_Manager'],App\User::class)): ?>

        <div class="row">

        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="material-icons">account_box</i>
              </div>
              <h2 class="text-center" style="color: #827e7e;"><?php echo e($total_merchandisers); ?></h2>
              <h5 class="text-center" style="color: #827e7e;" >Total Merchandisers</h5>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">account_box</i>
              </div>
              <h2 class="text-center" style="color: #827e7e;"><?php echo e($present_merchandisers); ?></h2>
              <h5 class="text-center" style="color: #827e7e;" >Present Merchandisers</h5>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">account_box</i>
              </div>
              <h2 class="text-center" style="color: #827e7e;"><?php echo e($absent_merchandisers); ?></h2>
              <h5 class="text-center" style="color: #827e7e;" >Absent Merchandisers</h5>
            </div>
          </div>
        </div>

         <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="material-icons">book</i>
              </div>
              <h2 class="text-center" style="color: #827e7e;"><?php echo e($total_outlets); ?></h2>
              <h5 class="text-center" style="color: #827e7e;" >Total Timesheet</h5>
            </div>
          </div>
        </div>

         <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">schedule</i>
              </div>
              <h2 class="text-center" style="color: #827e7e;"><?php echo e($completed_outlets); ?></h2>
              <h5 class="text-center" style="color: #827e7e;" >Completed Timesheet</h5>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">schedule</i>
              </div>
              <h2 class="text-center" style="color: #827e7e;"><?php echo e($pending_outlets); ?></h2>
              <h5 class="text-center" style="color: #827e7e;" >Pending Timesheet</h5>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="material-icons">book</i>
              </div>
              <h2 class="text-center" style="color: #827e7e;"><?php echo e($today_outlets); ?></h2>
              <h5 class="text-center" style="color: #827e7e;" >Today Timesheet</h5>
            </div>
          </div>
        </div>

         <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">schedule</i>
              </div>
              <h2 class="text-center" style="color: #827e7e;"><?php echo e($today_completed); ?></h2>
              <h5 class="text-center" style="color: #827e7e;" >Today Completed Timesheet</h5>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">schedule</i>
              </div>
              <h2 class="text-center" style="color: #827e7e;"><?php echo e($today_pending); ?></h2>
              <h5 class="text-center" style="color: #827e7e;" >Today Pending Timesheet</h5>
            </div>
          </div>
        </div>

        <div class="col-lg-12 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <!-- <div class="card-icon">
                <i class="material-icons">schedule</i>
              </div> -->

              <h3 class="text-left" style="color: #827e7e;" >Monthly Timesheet</h3>

                <div class="row justify-content-center" style="margin-bottom: 20px;">
                    <form method="post" action="<?php echo e(url('filter')); ?>" class="form-inline justify-content-center" enctype="multipart/form-data" action="" autocomplete="off" style="text-align: right;">
                      <?php echo csrf_field(); ?>
                      <?php echo method_field('post'); ?>

                    <!--   <div class="col-lg-4">
                         <input type="text" class="form-control datepicker" id="start_date" placeholder="Start Date" name="start_date">
                       </div> -->
                    
                     <div class="col-lg-6">
                       <!--  <input type="text" class="form-control " id="filter_result" placeholder="Filter By Result" name="filter_result"> -->
                        <select class="selectpicker" data-style="select-with-transition"  title="Select Merchandiser" data-size="7"  id="filter_result_field" name="filter_result" value="<?php echo e(old('filter_result')); ?>" style="width: 185px;">

                          <option value="">-- All --</option>

                        <?php $__currentLoopData = $merchandisers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($emp->employee_id); ?>" >  <?php echo e($emp->first_name); ?> <?php echo e($emp->middle_name ? $emp->middle_name : ''); ?> <?php echo e($emp->surname ? $emp->surname : ''); ?> </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                         
                          </select>

                      </div>
                   
                     
                    <!--<div class="col-lg-2">
                         <input type="text" class="form-control datepicker" id="start_date" placeholder="Start Date" name="start_date">
                       </div> -->
                       
                       <!-- <div class="col-lg-2">
                         <button type="submit"  class="btn btn-finish btn-fill btn-rose btn-wd" name="Filter" value="Filter"><?php echo e(__('Filter')); ?></button>

                     </div> -->

                        </form>
                    </div>

                    <div id="chtAnimatedBarChart" class="bcBar"></div>
          </div>
        </div>

       
      </div>

     <?php endif; ?>


    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['isCDE'],App\User::class)): ?>

        <div class="row">

        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="material-icons">account_box</i>
              </div>
              <h2 class="text-center" style="color: #827e7e;"><?php echo e($total_merchandisers); ?></h2>
              <h5 class="text-center" style="color: #827e7e;" >Total Merchandisers</h5>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">account_box</i>
              </div>
              <h2 class="text-center" style="color: #827e7e;"><?php echo e($present_merchandisers); ?></h2>
              <h5 class="text-center" style="color: #827e7e;" >Present Merchandisers</h5>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">account_box</i>
              </div>
              <h2 class="text-center" style="color: #827e7e;"><?php echo e($absent_merchandisers); ?></h2>
              <h5 class="text-center" style="color: #827e7e;" >Absent Merchandisers</h5>
            </div>
          </div>
        </div>

         <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="material-icons">book</i>
              </div>
              <h2 class="text-center" style="color: #827e7e;"><?php echo e($total_outlets); ?></h2>
              <h5 class="text-center" style="color: #827e7e;" >Total Timesheet</h5>
            </div>
          </div>
        </div>

         <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">schedule</i>
              </div>
              <h2 class="text-center" style="color: #827e7e;"><?php echo e($completed_outlets); ?></h2>
              <h5 class="text-center" style="color: #827e7e;" >Completed Timesheet</h5>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">schedule</i>
              </div>
              <h2 class="text-center" style="color: #827e7e;"><?php echo e($pending_outlets); ?></h2>
              <h5 class="text-center" style="color: #827e7e;" >Pending Timesheet</h5>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="material-icons">book</i>
              </div>
              <h2 class="text-center" style="color: #827e7e;"><?php echo e($today_outlets); ?></h2>
              <h5 class="text-center" style="color: #827e7e;" >Today Timesheet</h5>
            </div>
          </div>
        </div>

         <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">schedule</i>
              </div>
              <h2 class="text-center" style="color: #827e7e;"><?php echo e($today_completed); ?></h2>
              <h5 class="text-center" style="color: #827e7e;" >Today Completed Timesheet</h5>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">schedule</i>
              </div>
              <h2 class="text-center" style="color: #827e7e;"><?php echo e($today_pending); ?></h2>
              <h5 class="text-center" style="color: #827e7e;" >Today Pending Timesheet</h5>
            </div>
          </div>
        </div>

        <div class="col-lg-12 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <!-- <div class="card-icon">
                <i class="material-icons">schedule</i>
              </div> -->

              <h3 class="text-left" style="color: #827e7e;" >Monthly Timesheet</h3>

                <div class="row justify-content-center" style="margin-bottom: 20px;">
                    <form method="post" action="<?php echo e(url('filter')); ?>" class="form-inline justify-content-center" enctype="multipart/form-data" action="" autocomplete="off" style="text-align: right;">
                      <?php echo csrf_field(); ?>
                      <?php echo method_field('post'); ?>

                    <!--   <div class="col-lg-4">
                         <input type="text" class="form-control datepicker" id="start_date" placeholder="Start Date" name="start_date">
                       </div> -->
                    
                     <div class="col-lg-6">
                       <!--  <input type="text" class="form-control " id="filter_result" placeholder="Filter By Result" name="filter_result"> -->
                        <select class="selectpicker" data-style="select-with-transition"  title="Select Merchandiser" data-size="7"  id="filter_result_cde" name="filter_result" value="<?php echo e(old('filter_result')); ?>" style="width: 185px;">

                          <option value="">-- All --</option>

                        <?php $__currentLoopData = $merchandisers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($emp->employee_id); ?>" >  <?php echo e($emp->first_name); ?> <?php echo e($emp->middle_name ? $emp->middle_name : ''); ?> <?php echo e($emp->surname ? $emp->surname : ''); ?> </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                         
                          </select>

                      </div>
                   
                     
                    <!--<div class="col-lg-2">
                         <input type="text" class="form-control datepicker" id="start_date" placeholder="Start Date" name="start_date">
                       </div> -->
                       
                       <!-- <div class="col-lg-2">
                         <button type="submit"  class="btn btn-finish btn-fill btn-rose btn-wd" name="Filter" value="Filter"><?php echo e(__('Filter')); ?></button>

                     </div> -->

                        </form>
                    </div>

                    <div id="chtAnimatedBarChart_cde" class="bcBar"></div>
          </div>
        </div>

       
      </div>

     <?php endif; ?>

    <?php

        $date = date('Y-m-d')


     ?>



    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['isAdmin','isTopManagement'],App\User::class)): ?>

    <div class="row">


        <div class="col-lg-4 col-md-6 col-sm-6">
            <a href="/employee">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="material-icons">account_box</i>
              </div>
              <h2 class="text-center" style="color: #827e7e;"><?php echo e($total_employees); ?></h2>
              <h5 class="text-center" style="color: #827e7e;" >Total Employees</h5>
            </div>
          </div>
      </a>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6">
            <a href="/filter_employee?_token=6vax0o6aBGRZoDtytJ2PVxJfYuDpeMZH7gqsgQVG&_method=get&designation=5&nationality=&emp_id=">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">account_box</i>
              </div>
              <h2 class="text-center" style="color: #827e7e;"><?php echo e($total_field_managers); ?></h2>
              <h5 class="text-center" style="color: #827e7e;" >Total Field Managers</h5>
            </div>
          </div>
      </a>
        </div>  

        <div class="col-lg-4 col-md-6 col-sm-6">
            <a href="/filter_employee?_token=6vax0o6aBGRZoDtytJ2PVxJfYuDpeMZH7gqsgQVG&_method=get&designation=6&nationality=&emp_id=">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">account_box</i>
              </div>
              <h2 class="text-center" style="color: #827e7e;"><?php echo e($total_merchandisers); ?></h2>
              <h5 class="text-center" style="color: #827e7e;" >Total Merchandisers</h5>
            </div>
          </div>
      </a>
        </div>

    </div>

     <div class="row">

         <div class="col-lg-4 col-md-6 col-sm-6">
            <a href="/present_field">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="material-icons">account_box</i>
              </div>
              <h2 class="text-center" style="color: #827e7e;"><?php echo e($present_field_managers); ?></h2>
              <h5 class="text-center" style="color: #827e7e;" >Present Field Managers</h5>
            </div>
          </div>
      </a>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6">
        <a href="/present_merchant">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">account_box</i>
              </div>
              <h2 class="text-center" style="color: #827e7e;"><?php echo e($present_merchandisers); ?></h2>
              <h5 class="text-center" style="color: #827e7e;" >Present Merchandisers</h5>
            </div>
          </div>
         </a>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6">
        <a href="/absent_merchant">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">account_box</i>
              </div>
              <h2 class="text-center" style="color: #827e7e;"><?php echo e($absent_merchandiesers); ?></h2>
              <h5 class="text-center" style="color: #827e7e;" >Absent Merchandisers</h5>
            </div>
          </div>
         </a>
        </div>

    </div>

     <div class="row">

        <div class="col-lg-4 col-md-6 col-sm-6">
         <a href="/total_timesheets">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="material-icons">schedule</i>
              </div>
              <h2 class="text-center" style="color: #827e7e;"><?php echo e($total_outlets); ?></h2>
              <h5 class="text-center" style="color: #827e7e;" >Total Timesheets</h5>
            </div>
          </div>
        </a>
        </div>

         <div class="col-lg-4 col-md-6 col-sm-6">
            <a href="/filter_total_timesheet?_token=5hnG63qBOOKh2hlX2RSheuIlybq66YCfT3WLTOnK&_method=get&status=1&startdate=&enddate=&Filter=Filter">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">schedule</i>
              </div>
              <h2 class="text-center" style="color: #827e7e;"><?php echo e($completed_outlets); ?></h2>
              <h5 class="text-center" style="color: #827e7e;" >Completed Timesheets</h5>
            </div>
          </div>
         </a>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6">
            <a href="http://127.0.0.1:8000/filter_total_timesheet?_token=5hnG63qBOOKh2hlX2RSheuIlybq66YCfT3WLTOnK&_method=get&status=0&startdate=&enddate=&Filter=Filter">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">schedule</i>
              </div>
              <h2 class="text-center" style="color: #827e7e;"><?php echo e($pending_outlets); ?></h2>
              <h5 class="text-center" style="color: #827e7e;" >Pending Timesheets</h5>
            </div>
          </div>
      </a>
        </div>

    </div>

    <div class="row">

        <div class="col-lg-4 col-md-6 col-sm-6">
        <a href="/today_timesheet">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="material-icons">book</i>
              </div>
              <h2 class="text-center" style="color: #827e7e;"><?php echo e($today_outlets); ?></h2>
              <h5 class="text-center" style="color: #827e7e;" >Today Timesheets</h5>
            </div>
          </div>
        </a>
        </div>

         <div class="col-lg-4 col-md-6 col-sm-6">
        <a href="/filter_today_timesheet?_token=5hnG63qBOOKh2hlX2RSheuIlybq66YCfT3WLTOnK&_method=get&status=1&startdate=<?php echo e($date); ?>&enddate=<?php echo e($date); ?>&Filter=Filter">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">schedule</i>
              </div>
              <h2 class="text-center" style="color: #827e7e;"><?php echo e($today_completed); ?></h2>
              <h5 class="text-center" style="color: #827e7e;" >Today Completed Timesheets</h5>
            </div>
          </div>
        </a>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6">
        <a href="/filter_today_timesheet?_token=5hnG63qBOOKh2hlX2RSheuIlybq66YCfT3WLTOnK&_method=get&status=0&startdate=<?php echo e($date); ?>&enddate=<?php echo e($date); ?>&Filter=Filter">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">schedule</i>
              </div>
              <h2 class="text-center" style="color: #827e7e;"><?php echo e($today_pending); ?></h2>
              <h5 class="text-center" style="color: #827e7e;" >Today Pending Timesheets</h5>
            </div>
          </div>
         </a>
        </div>


            <div class="col-lg-12 col-md-12 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-danger card-header-icon">
                  <!-- <div class="card-icon">
                    <i class="material-icons">schedule</i>
                  </div> -->

                  <h3 class="text-left" style="color: #827e7e;" >Monthly Timesheet</h3>

                   <div class="row justify-content-center" style="margin-bottom: 20px;">
                    <form method="post" action="<?php echo e(url('filter')); ?>" class="form-inline justify-content-center" enctype="multipart/form-data" action="" autocomplete="off" style="text-align: right;">
                      <?php echo csrf_field(); ?>
                      <?php echo method_field('post'); ?>

                    <!--   <div class="col-lg-4">
                         <input type="text" class="form-control datepicker" id="start_date" placeholder="Start Date" name="start_date">
                       </div> -->
                    
                     <div class="col-lg-6">
                       <!--  <input type="text" class="form-control " id="filter_result" placeholder="Filter By Result" name="filter_result"> -->
                        <select class="selectpicker filter_by_admin" data-style="select-with-transition"  title="Select Field Manager" data-size="7"  id="filter_field_manager" name="filter_result_admin" value="<?php echo e(old('filter_result_admin')); ?>" style="width: 185px;">

                          <option value="">-- All --</option>

                        <?php $__currentLoopData = $field_managers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($emp->employee_id); ?>" >  <?php echo e($emp->first_name); ?> <?php echo e($emp->middle_name ? $emp->middle_name : ''); ?> <?php echo e($emp->surname ? $emp->surname : ''); ?> </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                         
                          </select>

                      </div>

                      <div class="col-lg-6">
                       <!--  <input type="text" class="form-control " id="filter_result" placeholder="Filter By Result" name="filter_result"> -->
                        <select class="selectpicker filter_by_admin" data-style="select-with-transition"  title="Select Merchandiser" data-size="7"  id="filter_merchandiser" name="filter_result_admin" value="<?php echo e(old('filter_result_admin')); ?>" style="width: 185px;">

                          <option value="">-- All --</option>

                        <?php $__currentLoopData = $merchandisers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($emp->employee_id); ?>" >  <?php echo e($emp->first_name); ?> <?php echo e($emp->middle_name ? $emp->middle_name : ''); ?> <?php echo e($emp->surname ? $emp->surname : ''); ?> </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                         
                          </select>

                      </div>
                   
                        </form>
                    </div>


                  <div id="chtAnimatedBarChart_admin" class="bcBar"></div>

                </div>
              </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6">
            
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-left" style="color: #827e7e;">Pie Chart - Field Manager Wise</h3>
                        <div class="row col-lg-4 col-md-4 col-sm-4" style="position: relative;margin-left: auto;">
                            <select id="filter_pie_monthly" class="form-control selectpicker">
                                <option value="Monthly">Monthly</option>
                                <option value="Year">Year</option>
                                <option value="Today" selected="">Today</option>
                            </select>
                        </div>
                        <div class="chart-container">
                            <div class="chart has-fixed-height" id="pie_basic"></div>
                        </div>
                    </div>
                </div>
                 
            </div>

                    <div class="col-md-6">
                        <div class="card card-min-height">
                            <div class="card-header card-header-success card-header-icon">
<!--                                 <div class="card-icon">
                                    <i class="material-icons">schedule</i>
                                </div> -->
                                <h4 class="card-title">Check In and Check Out </h4>
                            </div>
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table id="datatables_report"  class="table table-striped table-no-bordered table-hover" style="display:none" >
                                                <thead class="text-primary">
                                                <th>#</th>
                                                <th>Field Manager</th>
                                                <th>Merchandisers</th>
                                                <th>Checked In </th>
                                                <th>Not Check In</th>
                                                </thead>
                                                <tbody>
                                                <?php
                                                    $i=1
                                                ?>


                                                <?php $__currentLoopData = $attendance; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $merch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td><?php echo e($i++); ?></td>
                                                        <td><?php echo e($merch->first_name); ?> <?php echo e($merch->surname); ?></td>
                                                        <td><?php echo e($merch->merchandisers); ?></td>
                                                        <td><?php echo e($merch->present); ?></td>
                                                        <td><?php echo e(($merch->merchandisers)-($merch->present)); ?></td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


   
        <div class="col-md-12">
        <div class="card card-min-height">
            <div class="card-header card-header-success card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">schedule</i>
                </div>
                <h4 class="card-title">Check In and Check Out (Timesheet Wise) </h4>
            </div>
            <div class="card-body ">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="datatables"  class="table table-striped table-no-bordered table-hover" style="display:none" >
                                <thead class="text-primary">
                                <th>#</th>
                                <th>Field Manager</th>
                                <th>Total Timesheets</th>
                                <th>Checked In Timesheets </th>
                                <th>Checked Out Timesheets</th>
                                <th>Not Checked In Timesheets</th>
                                </thead>
                                <tbody>
                                <?php
                                    $i=1
                                ?>
                                <?php $__currentLoopData = $form; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $for): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($i++); ?></td>
                                        <td><?php echo e($for->first_name); ?> <?php echo e($for->surname); ?></td>
                                        <td><?php echo e($for->num); ?></td>
                                        <td><?php echo e($for->checkin); ?></td>
                                        <td><?php echo e($for->checkout); ?></td>
                                        <td><?php echo e(($for->num)-($for->checkin)); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

               

    </div>


    <?php endif; ?>


     <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['isClient'],App\User::class)): ?>

        <div class="row">

            <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">store</i>
                  </div>
                  <h2 class="text-center" style="color: #827e7e;"><?php echo e($total_stores); ?></h2>
                  <h5 class="text-center" style="color: #827e7e;" >Total Stores</h5>
                </div>
              </div>
            </div>

             <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">inventory_2</i>
                  </div>
                  <h2 class="text-center" style="color: #827e7e;"><?php echo e($total_products->count()); ?></h2>
                  <h5 class="text-center" style="color: #827e7e;" >Total Products</h5>
                </div>
              </div>
            </div>

             <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">outlet</i>
                  </div>
                  <h2 class="text-center" style="color: #827e7e;"><?php echo e($total_outlets->count()); ?></h2>
                  <h5 class="text-center" style="color: #827e7e;" >Total Outlets</h5>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">schedule</i>
                  </div>
                  <h2 class="text-center" style="color: #827e7e;"><?php echo e($total_scheduled_timesheet); ?></h2>
                  <h5 class="text-center" style="color: #827e7e;" >Total Scheduled Timesheet</h5>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">schedule</i>
                  </div>
                  <h2 class="text-center" style="color: #827e7e;"><?php echo e($total_s_completed); ?></h2>
                  <h5 class="text-center" style="color: #827e7e;" >Competed Scheduled Timesheet</h5>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-danger card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">schedule</i>
                  </div>
                  <h2 class="text-center" style="color: #827e7e;"><?php echo e($total_s_pending); ?></h2>
                  <h5 class="text-center" style="color: #827e7e;" >Pending Scheduled Timesheet</h5>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">schedule</i>
                  </div>
                  <h2 class="text-center" style="color: #827e7e;"><?php echo e($total_unscheduled_timesheet); ?></h2>
                  <h5 class="text-center" style="color: #827e7e;" >Total UnScheduled Timesheet</h5>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">schedule</i>
                  </div>
                  <h2 class="text-center" style="color: #827e7e;"><?php echo e($total_uns_completed); ?></h2>
                  <h5 class="text-center" style="color: #827e7e;" >Completed UnScheduled Timesheet</h5>
                </div>
              </div>
            </div>

             <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-danger card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">schedule</i>
                  </div>
                  <h2 class="text-center" style="color: #827e7e;"><?php echo e($total_uns_pending); ?></h2>
                  <h5 class="text-center" style="color: #827e7e;" >Pending UnScheduled Timesheet</h5>
                </div>
              </div>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-danger card-header-icon">
                  <!-- <div class="card-icon">
                    <i class="material-icons">schedule</i>
                  </div> -->

                  <h3 class="text-left" style="color: #827e7e;" >Monthly Timesheet</h3>

                   <div class="row justify-content-center" style="margin-bottom: 20px;">
                    <form method="post" action="<?php echo e(url('filter')); ?>" class="form-inline justify-content-center" enctype="multipart/form-data" action="" autocomplete="off" style="text-align: right;">
                      <?php echo csrf_field(); ?>
                      <?php echo method_field('post'); ?>

                    <!--   <div class="col-lg-4">
                         <input type="text" class="form-control datepicker" id="start_date" placeholder="Start Date" name="start_date">
                       </div> -->
                    
                     <div class="col-lg-6">
                       <!--  <input type="text" class="form-control " id="filter_result" placeholder="Filter By Result" name="filter_result"> -->
                        <select class="selectpicker" data-style="select-with-transition"  title="Select Field Manager" data-size="7"  id="filter_result" name="filter_result" value="<?php echo e(old('filter_result')); ?>" style="width: 185px;">

                          <option value="">-- All --</option>

                        <?php $__currentLoopData = $field_managers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($emp->employee_id); ?>" >  <?php echo e($emp->first_name); ?> <?php echo e($emp->middle_name ? $emp->middle_name : ''); ?> <?php echo e($emp->surname ? $emp->surname : ''); ?> </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                         
                          </select>

                      </div>
                   
                     
                    <!--<div class="col-lg-2">
                         <input type="text" class="form-control datepicker" id="start_date" placeholder="Start Date" name="start_date">
                       </div> -->
                       
                       <!-- <div class="col-lg-2">
                         <button type="submit"  class="btn btn-finish btn-fill btn-rose btn-wd" name="Filter" value="Filter"><?php echo e(__('Filter')); ?></button>

                     </div> -->

                        </form>
                    </div>


                  <div id="chtAnimatedBarChart_client" class="bcBar"></div>

                </div>
              </div>
            </div>

        </div>

        

     <?php endif; ?>


      <!-- <button type="button" class="btn btn-round btn-default dropdown-toggle btn-link" data-toggle="dropdown">
  7 days
  </button> -->

   <!--    <div class="row">
        <div class="col-md-4">
          <div class="card card-chart">
            <div class="card-header card-header-rose" data-header-animation="true">
              <div class="ct-chart" id="websiteViewsChart"></div>
            </div>
            <div class="card-body">
              <div class="card-actions">
                <button type="button" class="btn btn-danger btn-link fix-broken-card">
                  <i class="material-icons">build</i> Fix Header!
                </button>
                <button type="button" class="btn btn-info btn-link" rel="tooltip" data-placement="bottom" title="Refresh">
                  <i class="material-icons">refresh</i>
                </button>
                <button type="button" class="btn btn-default btn-link" rel="tooltip" data-placement="bottom" title="Change Date">
                  <i class="material-icons">edit</i>
                </button>
              </div>
              <h4 class="card-title">Website Views</h4>
              <p class="card-category">Last Campaign Performance</p>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i> campaign sent 2 days ago
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card card-chart">
            <div class="card-header card-header-success" data-header-animation="true">
              <div class="ct-chart" id="dailySalesChart"></div>
            </div>
            <div class="card-body">
              <div class="card-actions">
                <button type="button" class="btn btn-danger btn-link fix-broken-card">
                  <i class="material-icons">build</i> Fix Header!
                </button>
                <button type="button" class="btn btn-info btn-link" rel="tooltip" data-placement="bottom" title="Refresh">
                  <i class="material-icons">refresh</i>
                </button>
                <button type="button" class="btn btn-default btn-link" rel="tooltip" data-placement="bottom" title="Change Date">
                  <i class="material-icons">edit</i>
                </button>
              </div>
              <h4 class="card-title">Daily Sales</h4>
              <p class="card-category">
                <span class="text-success"><i class="fa fa-long-arrow-up"></i> 55% </span> increase in today sales.</p>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i> updated 4 minutes ago
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card card-chart">
            <div class="card-header card-header-info" data-header-animation="true">
              <div class="ct-chart" id="completedTasksChart"></div>
            </div>
            <div class="card-body">
              <div class="card-actions">
                <button type="button" class="btn btn-danger btn-link fix-broken-card">
                  <i class="material-icons">build</i> Fix Header!
                </button>
                <button type="button" class="btn btn-info btn-link" rel="tooltip" data-placement="bottom" title="Refresh">
                  <i class="material-icons">refresh</i>
                </button>
                <button type="button" class="btn btn-default btn-link" rel="tooltip" data-placement="bottom" title="Change Date">
                  <i class="material-icons">edit</i>
                </button>
              </div>
              <h4 class="card-title">Completed Tasks</h4>
              <p class="card-category">Last Campaign Performance</p>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i> campaign sent 2 days ago
              </div>
            </div>
          </div>
        </div>
      </div> -->
    <!--   <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="material-icons">weekend</i>
              </div>
              <p class="card-category">Bookings</p>
              <h3 class="card-title">184</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons text-danger">warning</i>
                <a href="#pablo">Get More Space...</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-rose card-header-icon">
              <div class="card-icon">
                <i class="material-icons">equalizer</i>
              </div>
              <p class="card-category">Website Visits</p>
              <h3 class="card-title">75.521</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">local_offer</i> Tracked from Google Analytics
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">store</i>
              </div>
              <p class="card-category">Revenue</p>
              <h3 class="card-title">$34,245</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">date_range</i> Last 24 Hours
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="fa fa-twitter"></i>
              </div>
              <p class="card-category">Followers</p>
              <h3 class="card-title">+245</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">update</i> Just Updated
              </div>
            </div>
          </div>
        </div>
      </div> -->
     <!--  <h3>Manage Listings</h3>
      <br>
      <div class="row">
        <div class="col-md-4">
          <div class="card card-product">
            <div class="card-header card-header-image" data-header-animation="true">
              <a href="#pablo">
                <img class="img" src="<?php echo e(asset('material')); ?>/img/card-2.jpg">
              </a>
            </div>
            <div class="card-body">
              <div class="card-actions text-center">
                <button type="button" class="btn btn-danger btn-link fix-broken-card">
                  <i class="material-icons">build</i> Fix Header!
                </button>
                <button type="button" class="btn btn-default btn-link" rel="tooltip" data-placement="bottom" title="View">
                  <i class="material-icons">art_track</i>
                </button>
                <button type="button" class="btn btn-success btn-link" rel="tooltip" data-placement="bottom" title="Edit">
                  <i class="material-icons">edit</i>
                </button>
                <button type="button" class="btn btn-danger btn-link" rel="tooltip" data-placement="bottom" title="Remove">
                  <i class="material-icons">close</i>
                </button>
              </div>
              <h4 class="card-title">
                <a href="#pablo">Cozy 5 Stars Apartment</a>
              </h4>
              <div class="card-description">
                The place is close to Barceloneta Beach and bus stop just 2 min by walk and near to "Naviglio" where you can enjoy the main night life in Barcelona.
              </div>
            </div>
            <div class="card-footer">
              <div class="price">
                <h4>$899/night</h4>
              </div>
              <div class="stats">
                <p class="card-category"><i class="material-icons">place</i> Barcelona, Spain</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card card-product">
            <div class="card-header card-header-image" data-header-animation="true">
              <a href="#pablo">
                <img class="img" src="<?php echo e(asset('material')); ?>/img/card-3.jpg">
              </a>
            </div>
            <div class="card-body">
              <div class="card-actions text-center">
                <button type="button" class="btn btn-danger btn-link fix-broken-card">
                  <i class="material-icons">build</i> Fix Header!
                </button>
                <button type="button" class="btn btn-default btn-link" rel="tooltip" data-placement="bottom" title="View">
                  <i class="material-icons">art_track</i>
                </button>
                <button type="button" class="btn btn-success btn-link" rel="tooltip" data-placement="bottom" title="Edit">
                  <i class="material-icons">edit</i>
                </button>
                <button type="button" class="btn btn-danger btn-link" rel="tooltip" data-placement="bottom" title="Remove">
                  <i class="material-icons">close</i>
                </button>
              </div>
              <h4 class="card-title">
                <a href="#pablo">Office Studio</a>
              </h4>
              <div class="card-description">
                The place is close to Metro Station and bus stop just 2 min by walk and near to "Naviglio" where you can enjoy the night life in London, UK.
              </div>
            </div>
            <div class="card-footer">
              <div class="price">
                <h4>$1.119/night</h4>
              </div>
              <div class="stats">
                <p class="card-category"><i class="material-icons">place</i> London, UK</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card card-product">
            <div class="card-header card-header-image" data-header-animation="true">
              <a href="#pablo">
                <img class="img" src="<?php echo e(asset('material')); ?>/img/card-1.jpg">
              </a>
            </div>
            <div class="card-body">
              <div class="card-actions text-center">
                <button type="button" class="btn btn-danger btn-link fix-broken-card">
                  <i class="material-icons">build</i> Fix Header!
                </button>
                <button type="button" class="btn btn-default btn-link" rel="tooltip" data-placement="bottom" title="View">
                  <i class="material-icons">art_track</i>
                </button>
                <button type="button" class="btn btn-success btn-link" rel="tooltip" data-placement="bottom" title="Edit">
                  <i class="material-icons">edit</i>
                </button>
                <button type="button" class="btn btn-danger btn-link" rel="tooltip" data-placement="bottom" title="Remove">
                  <i class="material-icons">close</i>
                </button>
              </div>
              <h4 class="card-title">
                <a href="#pablo">Beautiful Castle</a>
              </h4>
              <div class="card-description">
                The place is close to Metro Station and bus stop just 2 min by walk and near to "Naviglio" where you can enjoy the main night life in Milan.
              </div>
            </div>
            <div class="card-footer">
              <div class="price">
                <h4>$459/night</h4>
              </div>
              <div class="stats">
                <p class="card-category"><i class="material-icons">place</i> Milan, Italy</p>
              </div>
            </div>
          </div>
        </div>
      </div> -->
    </div>
  </div>
</div>

<?php

$today_present = DB::table('attendance')
                ->whereDate('date', date('Y-m-d'))
                ->where('is_present', '1')
                ->where('employee_id', Auth::user()->emp_id)
                ->count(); 

?>



      <input type="hidden" id="HidCheckCount" value=<?php echo e($today_present); ?>>
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog" >
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>Employee Checking</b></h4>
        </div>
        <div class="modal-body">
          <center>  <p id="HeadText">If already login,Please ignore </p></center>
        </div>
        <div class="modal-footer">
         <div class="row">
          <div class="col-sm-6 text-left">
          <a id="BtnCheckin" href="<?php echo e(url('checkin')); ?>" class="btn btn-sm btn-success"><b><?php echo e(__('Check In')); ?></b></a>  
          <a id="BtnCheckout" href="<?php echo e(url('checkout')); ?>" class="btn btn-sm btn-danger"><b><?php echo e(__('Check Out')); ?></b></a>  
          </div>
          <div class="col-sm-6 text-left">        
          <a class="btn btn-sm btn-default" data-dismiss="modal" style="color:#FFFFFF"><b><?php echo e(__('Ignore')); ?></b></a>
          </div>
      </div>
    </div>
  </div>
 </div>



<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>

  
<script type="text/javascript">

$(document).ready(function(){
    $("#submitButton").click(function(){ alert();
        $(".myModalnn").modal();
    });
});
    $(document).ready(function() {
    $("#BtnCheckin").show();
    $("#BtnCheckout").hide();
    var chk = $('#HidCheckCount').val();
    $('#HeadText').html('If already login, Please ignore');
    $("#myModal").modal("show");
  // alert(chk);
    if(chk == 1){
      $('#HeadText').html('If already logout,Please ignore');
      $("#BtnCheckin").hide();
      $("#BtnCheckout").show();
    
    }

    $(document).ready(function() {

        $('#datatables').fadeIn(1100);
        $('#datatables').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            dom: 'lBfrtip',
            buttons: [{
                extend: 'excelHtml5',
                className: 'btn-primary',
                text: 'Export',
                filename: function(){
                    var dt = new Date();
                    dt.getDate() + "/" + (dt.getMonth() + 1) + "/" + dt.getFullYear();
                    return 'Today -Checkin-&-Checkout-' + dt;
                },
                //title: 'alpin_excel',
                exportOptions: {
                    modifier: {
                        page: 'all'
                    },
                    columns: [0, 1, 2, 3, 4, 5],
                },
            }],
            select: true,
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search",
            },
            "columnDefs": [
                { "orderable": false, "targets": 5 },
            ],
    });



            $('#datatables_report').fadeIn(1100);
            $('#datatables_report').DataTable({
                "pagingType": "full_numbers",
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                dom: 'lBfrtip',
                buttons: [{
                    extend: 'excelHtml5',
                    className: 'btn-primary',
                    text: 'Export',
                    filename: function(){
                        var dt = new Date();
                        dt.getDate() + "/" + (dt.getMonth() + 1) + "/" + dt.getFullYear();
                        return 'Today -Checkin-&-Checkout-' + dt;
                    },
                    //title: 'alpin_excel',
                    exportOptions: {
                        modifier: {
                            page: 'all'
                        },
                        columns: [0, 1, 2, 3, 4],
                    },
                }],
                select: true,
                responsive: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search",
                },
                "columnDefs": [
                    { "orderable": false, "targets": 4 },
                ],
            });

    });

    var role = "<?php echo e(Auth::user()->role->name); ?>";

    //alert(user);

    if(role == "Field Manager" )
    {
        barchart_field();
    }

    if(role == "Client" )
    {
        barchart_client();
    }

    if(role == "Admin" || role == "Top Management" )
    {
        barchart_admin();
        piechart_field();
    }

    if(role == "CDE" )
    {
        barchart_cde();
    }
    

    // Javascript method's body can be found in assets/js/demos.js
    md.initDashboardPageCharts();

    md.initVectorMap();

    });


    // $(function() {
    //   var chart_data = getData();
    //   $('#chtAnimatedBarChart').animatedBarChart({ data: chart_data });
    // });

    function barchart_field(){

        var csrf = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
              url: '/monthly_bar_chart_field',
              type: 'GET',
              data: {'_token': csrf},
              dataType: 'json',

              success: function( data ) {
                 //alert(data);

                var labels = new Array();
                var series = new Array();

                 var html ='';

                 var t_obj = [];
                 var c_obj = [];

                 var month_number = [];

               
                const month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                const month_no = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'];

                $.each(data, function(i, item) {
                    
                    var total = item.total;
                    var completed = item.completed;
                    

                     var total_obj = { "group_name": "Total", "name": item.month.substring(0,3), "value": item.total , "month":item.month_number  };
                     var completed_obj = { "group_name": "Completed", "name": item.month.substring(0,3), "value": item.completed, "month":item.month_number };

                     //alert(total_obj)

                    t_obj.push(total_obj);
                    c_obj.push(completed_obj);

                    month_number.push(item.month_number);


                });

                 //alert(month_number);

                var missing = arr_diff(month_no, month_number);
                //alert(missing.length);

                for(i=0; i<missing.length; i++)
                {
                    //alert(missing[i]);
                    var total_obj = { "group_name": "Total", "name": month[missing[i] - 1], "value": 0, "month":missing[i] };
                    var completed_obj = { "group_name": "Completed", "name": month[missing[i] - 1], "value": 0, "month":missing[i] };

                     //alert(total_obj)

                    t_obj.push(total_obj);
                    c_obj.push(completed_obj);

                }


                 var arr_merge = jQuery.merge( t_obj, c_obj );
                 //alert(JSON.stringify(arr_merge));

                var arr_merge = arr_merge.sort(function(a, b){
                    return a.month - b.month;
                    //return parseFloat(a.month) - parseFloat(b.month);
                });

                arr_merge.sort(function (a, b) {
                    return b.group_name.localeCompare(a.group_name);
                });

                //alert(JSON.stringify(arr_merge));

                $('#chtAnimatedBarChart').animatedBarChart({ data: arr_merge });

                
              }       
        });

    }

    function barchart_client(){

        var csrf = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
              url: '/monthly_bar_chart_client',
              type: 'GET',
              data: {'_token': csrf},
              dataType: 'json',

              success: function( data ) {
                 //alert(data);

                var labels = new Array();
                var series = new Array();

                 var html ='';

                 var t_obj = [];
                 var c_obj = [];

                 var month_number = [];

               
                const month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                const month_no = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'];

                $.each(data, function(i, item) {
                    
                    var total = item.total;
                    var completed = item.completed;
                    

                     var total_obj = { "group_name": "Total", "name": item.month.substring(0,3), "value": item.total , "month":item.month_number  };
                     var completed_obj = { "group_name": "Completed", "name": item.month.substring(0,3), "value": item.completed, "month":item.month_number };

                     //alert(total_obj)

                    t_obj.push(total_obj);
                    c_obj.push(completed_obj);

                    month_number.push(item.month_number);


                });

                 //alert(month_number);

                var missing = arr_diff(month_no, month_number);
                //alert(missing.length);

                for(i=0; i<missing.length; i++)
                {
                    //alert(missing[i]);
                    var total_obj = { "group_name": "Total", "name": month[missing[i] - 1], "value": 0, "month":missing[i] };
                    var completed_obj = { "group_name": "Completed", "name": month[missing[i] - 1], "value": 0, "month":missing[i] };

                     //alert(total_obj)

                    t_obj.push(total_obj);
                    c_obj.push(completed_obj);

                }


                 var arr_merge = jQuery.merge( t_obj, c_obj );
                 //alert(JSON.stringify(arr_merge));

                var arr_merge = arr_merge.sort(function(a, b){
                    return a.month - b.month;
                    //return parseFloat(a.month) - parseFloat(b.month);
                });

                arr_merge.sort(function (a, b) {
                    return b.group_name.localeCompare(a.group_name);
                });

                //alert(JSON.stringify(arr_merge));

                $('#chtAnimatedBarChart_client').animatedBarChart({ data: arr_merge });

                
              }       
        });

    }


    function barchart_admin(){

        var csrf = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
              url: '/monthly_bar_chart_admin',
              type: 'GET',
              data: {'_token': csrf},
              dataType: 'json',

              success: function( data ) {
                 //alert(data);

                var labels = new Array();
                var series = new Array();

                 var html ='';

                 var t_obj = [];
                 var c_obj = [];

                 var month_number = [];

               
                const month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                const month_no = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'];

                $.each(data, function(i, item) {
                    
                    var total = item.total;
                    var completed = item.completed;
                    

                     var total_obj = { "group_name": "Total", "name": item.month.substring(0,3), "value": item.total , "month":item.month_number  };
                     var completed_obj = { "group_name": "Completed", "name": item.month.substring(0,3), "value": item.completed, "month":item.month_number };

                     //alert(total_obj)

                    t_obj.push(total_obj);
                    c_obj.push(completed_obj);

                    month_number.push(item.month_number);


                });

                 //alert(month_number);

                var missing = arr_diff(month_no, month_number);
                //alert(missing.length);

                for(i=0; i<missing.length; i++)
                {
                    //alert(missing[i]);
                    var total_obj = { "group_name": "Total", "name": month[missing[i] - 1], "value": 0, "month":missing[i] };
                    var completed_obj = { "group_name": "Completed", "name": month[missing[i] - 1], "value": 0, "month":missing[i] };

                     //alert(total_obj)

                    t_obj.push(total_obj);
                    c_obj.push(completed_obj);

                }


                 var arr_merge = jQuery.merge( t_obj, c_obj );
                 //alert(JSON.stringify(arr_merge));

                var arr_merge = arr_merge.sort(function(a, b){
                    return a.month - b.month;
                    //return parseFloat(a.month) - parseFloat(b.month);
                });

                arr_merge.sort(function (a, b) {
                    return b.group_name.localeCompare(a.group_name);
                });

                //alert(JSON.stringify(arr_merge));

                $('#chtAnimatedBarChart_admin').animatedBarChart({ data: arr_merge });

                
              }       
        });

    }

    function piechart_field(){

        var csrf = $('meta[name="csrf-token"]').attr('content');


        $.ajax({
              url: '/pie_chart_field',
              type: 'GET',
              data: {'_token': csrf},
              dataType: 'json',

              success: function( data ) {
               // alert(JSON.stringify(data[0]['employee_field']['employee_id']));

              
                var html ='';

                 var count = [];
                 var name = [];

                 $.each(data, function(i, item) {

                    //alert(data[i]['employee_field']['employee_id']);

                    var count_obj = { value: data[i]['total'], name: data[i]['employee_field']['first_name'] +' '+data[i]['employee_field']['surname'] };

                    var name_obj = data[i]['employee_field']['first_name']+' '+data[i]['employee_field']['surname'];

                     //alert(total_obj)

                    count.push(count_obj);
                    name.push(name_obj);

                 });

                 //alert(JSON.stringify(name_obj));


                    var pie_basic_element = document.getElementById('pie_basic');
                    if (pie_basic_element) {
                        //alert();
                        var pie_basic = echarts.init(pie_basic_element);
                        pie_basic.setOption({
                            color: [
                                '#2ec7c9','#b6a2de','#5ab1ef','#ffb980','#d87a80',
                                '#8d98b3','#e5cf0d','#97b552','#95706d','#dc69aa',
                                '#07a2a4','#9a7fd1','#588dd5','#f5994e','#c05050',
                                '#59678c','#c9ab00','#7eb00a','#6f5553','#c14089'
                            ],          
                            
                            textStyle: {
                                fontFamily: 'Roboto, Arial, Verdana, sans-serif',
                                fontSize: 13
                            },
                            title: {
                                text: '',
                                left: 'left',
                                textStyle: {
                                    fontSize: 17,
                                    fontWeight: 500
                                },
                                subtextStyle: {
                                    fontSize: 12
                                }
                            },
                            tooltip: {
                                trigger: 'item',
                                backgroundColor: 'rgba(0,0,0,0.75)',
                                padding: [10, 15],
                                textStyle: {
                                    fontSize: 13,
                                    fontFamily: 'Roboto, sans-serif'
                                },
                                formatter: "{a} <br/>{b}: {c} ({d}%)"
                            },
                            legend: {
                                orient: 'horizontal',
                                bottom: '0%',
                                left: 'center',                   
                                data: name,
                                itemHeight: 8,
                                itemWidth: 8
                            },
                            series: [{
                                name: 'Field Manager',
                                type: 'pie',
                                radius: '70%',
                                center: ['50%', '50%'],
                                itemStyle: {
                                    normal: {
                                        borderWidth: 1,
                                        borderColor: '#fff'
                                    }
                                },
                                data: count
                            }]
                        });
                    }

             }

         })
    }


    function barchart_cde(){

        var csrf = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
              url: '/monthly_bar_chart_cde',
              type: 'GET',
              data: {'_token': csrf},
              dataType: 'json',

              success: function( data ) {
                 //alert(data);

                var labels = new Array();
                var series = new Array();

                 var html ='';

                 var t_obj = [];
                 var c_obj = [];

                 var month_number = [];

               
                const month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                const month_no = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'];

                $.each(data, function(i, item) {
                    
                    var total = item.total;
                    var completed = item.completed;
                    

                     var total_obj = { "group_name": "Total", "name": item.month.substring(0,3), "value": item.total , "month":item.month_number  };
                     var completed_obj = { "group_name": "Completed", "name": item.month.substring(0,3), "value": item.completed, "month":item.month_number };

                     //alert(total_obj)

                    t_obj.push(total_obj);
                    c_obj.push(completed_obj);

                    month_number.push(item.month_number);


                });

                 //alert(month_number);

                var missing = arr_diff(month_no, month_number);
                //alert(missing.length);

                for(i=0; i<missing.length; i++)
                {
                    //alert(missing[i]);
                    var total_obj = { "group_name": "Total", "name": month[missing[i] - 1], "value": 0, "month":missing[i] };
                    var completed_obj = { "group_name": "Completed", "name": month[missing[i] - 1], "value": 0, "month":missing[i] };

                     //alert(total_obj)

                    t_obj.push(total_obj);
                    c_obj.push(completed_obj);

                }


                 var arr_merge = jQuery.merge( t_obj, c_obj );
                 //alert(JSON.stringify(arr_merge));

                var arr_merge = arr_merge.sort(function(a, b){
                    return a.month - b.month;
                    //return parseFloat(a.month) - parseFloat(b.month);
                });

                arr_merge.sort(function (a, b) {
                    return b.group_name.localeCompare(a.group_name);
                });

                //alert(JSON.stringify(arr_merge));

                $('#chtAnimatedBarChart_cde').animatedBarChart({ data: arr_merge });

                
              }       
        });

    }

      
      //   var chart_data = [
      //    { "group_name": "Total", "name": "Jan", "value": 38367 },
      //    { "group_name": "Total", "name": "Feb", "value": 32684 },
      //    { "group_name": "Total", "name": "Mar", "value": 28236 },
      //    { "group_name": "Total", "name": "Apr", "value": 44205 },
      //    { "group_name": "Total", "name": "May", "value": 3357 },
      //    { "group_name": "Total", "name": "Jun", "value": 3511 },
      //    { "group_name": "Total", "name": "Jul", "value": 10372 },
      //    { "group_name": "Total", "name": "Aug", "value": 15565 },
      //    { "group_name": "Total", "name": "Sep", "value": 23752 },
      //    { "group_name": "Total", "name": "Oct", "value": 28927 },
      //    { "group_name": "Total", "name": "Nov", "value": 21795 },
      //    { "group_name": "Total", "name": "Dec", "value": 50000 },

      //    { "group_name": "Compelted", "name": "Jan", "value": 28827 },
      //    { "group_name": "Compelted", "name": "Feb", "value": 13671 },
      //    { "group_name": "Compelted", "name": "Mar", "value": 27670 },
      //    { "group_name": "Compelted", "name": "Apr", "value": 6274 },
      //    { "group_name": "Compelted", "name": "May", "value": 12563 },
      //    { "group_name": "Compelted", "name": "Jun", "value": 31263 },
      //    { "group_name": "Compelted", "name": "Jul", "value": 24848 },
      //    { "group_name": "Compelted", "name": "Aug", "value": 41199 },
      //    { "group_name": "Compelted", "name": "Sep", "value": 18952 },
      //    { "group_name": "Compelted", "name": "Oct", "value": 30701 },
      //    { "group_name": "Compelted", "name": "Nov", "value": 16554 },
      //    { "group_name": "Compelted", "name": "Dec", "value": 36399 }

      // ];

     $('#filter_result').on('change', function() {
      //alert( this.value );

      var csrf = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
              url: '/filter_bar_chart_client',
              type: 'GET',
              data: {'_token': csrf, 'emp_id': this.value},
              dataType: 'json',

              success: function( data ) {
                 //alert(data);

                var labels = new Array();
                var series = new Array();

                 var html ='';

                 var t_obj = [];
                 var c_obj = [];

                 var month_number = [];

               
                const month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                const month_no = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'];

                $.each(data, function(i, item) {
                    
                    var total = item.total;
                    var completed = item.completed;
                    

                     var total_obj = { "group_name": "Total", "name": item.month.substring(0,3), "value": item.total , "month":item.month_number  };
                     var completed_obj = { "group_name": "Completed", "name": item.month.substring(0,3), "value": item.completed, "month":item.month_number };

                     //alert(total_obj)

                    t_obj.push(total_obj);
                    c_obj.push(completed_obj);

                    month_number.push(item.month_number);


                });

                 //alert(month_number);

                var missing = arr_diff(month_no, month_number);
                //alert(missing.length);

                for(i=0; i<missing.length; i++)
                {
                    //alert(missing[i]);
                    var total_obj = { "group_name": "Total", "name": month[missing[i] - 1], "value": 0, "month":missing[i] };
                    var completed_obj = { "group_name": "Completed", "name": month[missing[i] - 1], "value": 0, "month":missing[i] };

                     //alert(total_obj)

                    t_obj.push(total_obj);
                    c_obj.push(completed_obj);

                }


                 var arr_merge = jQuery.merge( t_obj, c_obj );
                 //alert(JSON.stringify(arr_merge));

                var arr_merge = arr_merge.sort(function(a, b){
                    return a.month - b.month;
                    //return parseFloat(a.month) - parseFloat(b.month);
                });

                arr_merge.sort(function (a, b) {
                    return b.group_name.localeCompare(a.group_name);
                });

                //alert(JSON.stringify(arr_merge));

                $('#chtAnimatedBarChart_client').html('');

                $('#chtAnimatedBarChart_client').animatedBarChart({ data: arr_merge });

                
              }       
        });

    });


    $('#filter_result_field').on('change', function() {
      //alert( this.value );

      var csrf = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
              url: '/filter_bar_chart_field',
              type: 'GET',
              data: {'_token': csrf, 'emp_id': this.value},
              dataType: 'json',

              success: function( data ) {
                 //alert(data);

                var labels = new Array();
                var series = new Array();

                 var html ='';

                 var t_obj = [];
                 var c_obj = [];

                 var month_number = [];

               
                const month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                const month_no = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'];

                $.each(data, function(i, item) {
                    
                    var total = item.total;
                    var completed = item.completed;
                    

                     var total_obj = { "group_name": "Total", "name": item.month.substring(0,3), "value": item.total , "month":item.month_number  };
                     var completed_obj = { "group_name": "Completed", "name": item.month.substring(0,3), "value": item.completed, "month":item.month_number };

                     //alert(total_obj)

                    t_obj.push(total_obj);
                    c_obj.push(completed_obj);

                    month_number.push(item.month_number);


                });

                 //alert(month_number);

                var missing = arr_diff(month_no, month_number);
                //alert(missing.length);

                for(i=0; i<missing.length; i++)
                {
                    //alert(missing[i]);
                    var total_obj = { "group_name": "Total", "name": month[missing[i] - 1], "value": 0, "month":missing[i] };
                    var completed_obj = { "group_name": "Completed", "name": month[missing[i] - 1], "value": 0, "month":missing[i] };

                     //alert(total_obj)

                    t_obj.push(total_obj);
                    c_obj.push(completed_obj);

                }


                 var arr_merge = jQuery.merge( t_obj, c_obj );
                 //alert(JSON.stringify(arr_merge));

                var arr_merge = arr_merge.sort(function(a, b){
                    return a.month - b.month;
                    //return parseFloat(a.month) - parseFloat(b.month);
                });

                arr_merge.sort(function (a, b) {
                    return b.group_name.localeCompare(a.group_name);
                });

                //alert(JSON.stringify(arr_merge));

                $('#chtAnimatedBarChart').html('');

                $('#chtAnimatedBarChart').animatedBarChart({ data: arr_merge });

                
              }       
        });

    });



     $('#filter_field_manager').on('change', function() {
      //alert( this.value );
      var csrf = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
              url: '/filter_bar_chart_admin',
              type: 'GET',
              data: {'_token': csrf, 'emp_id': this.value, 'type': 'field_manager' },
              dataType: 'json',

              success: function( data ) {
                 //alert(data);

                var labels = new Array();
                var series = new Array();

                 var html ='';

                 var t_obj = [];
                 var c_obj = [];

                 var month_number = [];

               
                const month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                const month_no = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'];

                $.each(data, function(i, item) {
                    
                    var total = item.total;
                    var completed = item.completed;
                    

                     var total_obj = { "group_name": "Total", "name": item.month.substring(0,3), "value": item.total , "month":item.month_number  };
                     var completed_obj = { "group_name": "Completed", "name": item.month.substring(0,3), "value": item.completed, "month":item.month_number };

                     //alert(total_obj)

                    t_obj.push(total_obj);
                    c_obj.push(completed_obj);

                    month_number.push(item.month_number);


                });

                 //alert(month_number);

                var missing = arr_diff(month_no, month_number);
                //alert(missing.length);

                for(i=0; i<missing.length; i++)
                {
                    //alert(missing[i]);
                    var total_obj = { "group_name": "Total", "name": month[missing[i] - 1], "value": 0, "month":missing[i] };
                    var completed_obj = { "group_name": "Completed", "name": month[missing[i] - 1], "value": 0, "month":missing[i] };

                     //alert(total_obj)

                    t_obj.push(total_obj);
                    c_obj.push(completed_obj);

                }


                 var arr_merge = jQuery.merge( t_obj, c_obj );
                 //alert(JSON.stringify(arr_merge));

                var arr_merge = arr_merge.sort(function(a, b){
                    return a.month - b.month;
                    //return parseFloat(a.month) - parseFloat(b.month);
                });

                arr_merge.sort(function (a, b) {
                    return b.group_name.localeCompare(a.group_name);
                });

                //alert(JSON.stringify(arr_merge));

                $('#chtAnimatedBarChart_admin').html('');

                $('#chtAnimatedBarChart_admin').animatedBarChart({ data: arr_merge });

                
              }       
        });

    });


     $('#filter_merchandiser').on('change', function() {
      //alert( this.value );
      var csrf = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
              url: '/filter_bar_chart_admin',
              type: 'GET',
              data: {'_token': csrf, 'emp_id': this.value, 'type': 'merchandiser'},
              dataType: 'json',

              success: function( data ) {
                 //alert(data);

                var labels = new Array();
                var series = new Array();

                 var html ='';

                 var t_obj = [];
                 var c_obj = [];

                 var month_number = [];

               
                const month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                const month_no = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'];

                $.each(data, function(i, item) {
                    
                    var total = item.total;
                    var completed = item.completed;
                    

                     var total_obj = { "group_name": "Total", "name": item.month.substring(0,3), "value": item.total , "month":item.month_number  };
                     var completed_obj = { "group_name": "Completed", "name": item.month.substring(0,3), "value": item.completed, "month":item.month_number };

                     //alert(total_obj)

                    t_obj.push(total_obj);
                    c_obj.push(completed_obj);

                    month_number.push(item.month_number);


                });

                 //alert(month_number);

                var missing = arr_diff(month_no, month_number);
                //alert(missing.length);

                for(i=0; i<missing.length; i++)
                {
                    //alert(missing[i]);
                    var total_obj = { "group_name": "Total", "name": month[missing[i] - 1], "value": 0, "month":missing[i] };
                    var completed_obj = { "group_name": "Completed", "name": month[missing[i] - 1], "value": 0, "month":missing[i] };

                     //alert(total_obj)

                    t_obj.push(total_obj);
                    c_obj.push(completed_obj);

                }


                 var arr_merge = jQuery.merge( t_obj, c_obj );
                 //alert(JSON.stringify(arr_merge));

                var arr_merge = arr_merge.sort(function(a, b){
                    return a.month - b.month;
                    //return parseFloat(a.month) - parseFloat(b.month);
                });

                arr_merge.sort(function (a, b) {
                    return b.group_name.localeCompare(a.group_name);
                });

                //alert(JSON.stringify(arr_merge));

                $('#chtAnimatedBarChart_admin').html('');

                $('#chtAnimatedBarChart_admin').animatedBarChart({ data: arr_merge });

                
              }       
        });

    });


     $('#filter_result_cde').on('change', function() {
      //alert( this.value );
      var csrf = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
              url: '/filter_bar_chart_cde',
              type: 'GET',
              data: {'_token': csrf, 'emp_id': this.value },
              dataType: 'json',

              success: function( data ) {
                 //alert(data);

                var labels = new Array();
                var series = new Array();

                 var html ='';

                 var t_obj = [];
                 var c_obj = [];

                 var month_number = [];

               
                const month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                const month_no = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'];

                $.each(data, function(i, item) {
                    
                    var total = item.total;
                    var completed = item.completed;
                    

                     var total_obj = { "group_name": "Total", "name": item.month.substring(0,3), "value": item.total , "month":item.month_number  };
                     var completed_obj = { "group_name": "Completed", "name": item.month.substring(0,3), "value": item.completed, "month":item.month_number };

                     //alert(total_obj)

                    t_obj.push(total_obj);
                    c_obj.push(completed_obj);

                    month_number.push(item.month_number);


                });

                 //alert(month_number);

                var missing = arr_diff(month_no, month_number);
                //alert(missing.length);

                for(i=0; i<missing.length; i++)
                {
                    //alert(missing[i]);
                    var total_obj = { "group_name": "Total", "name": month[missing[i] - 1], "value": 0, "month":missing[i] };
                    var completed_obj = { "group_name": "Completed", "name": month[missing[i] - 1], "value": 0, "month":missing[i] };

                     //alert(total_obj)

                    t_obj.push(total_obj);
                    c_obj.push(completed_obj);

                }


                 var arr_merge = jQuery.merge( t_obj, c_obj );
                 //alert(JSON.stringify(arr_merge));

                var arr_merge = arr_merge.sort(function(a, b){
                    return a.month - b.month;
                    //return parseFloat(a.month) - parseFloat(b.month);
                });

                arr_merge.sort(function (a, b) {
                    return b.group_name.localeCompare(a.group_name);
                });

                //alert(JSON.stringify(arr_merge));

                $('#chtAnimatedBarChart_cde').html('');

                $('#chtAnimatedBarChart_cde').animatedBarChart({ data: arr_merge });

                
              }       
        });

    });


     $('#filter_pie_monthly').on('change', function() {
      //alert( this.value );
      var csrf = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
              url: '/filter_pie_monthly',
              type: 'GET',
              data: {'_token': csrf, 'value': this.value },
              dataType: 'json',

              success: function( data ) {
                 //alert(data);

                
                var html ='';

                 var count = [];
                 var name = [];

                 $.each(data, function(i, item) {

                    //alert(data[i]['employee_field']['employee_id']);

                    var count_obj = { value: data[i]['total'], name: data[i]['employee_field']['first_name'] +' '+data[i]['employee_field']['surname'] };

                    var name_obj = data[i]['employee_field']['first_name']+' '+data[i]['employee_field']['surname'];

                     //alert(total_obj)

                    count.push(count_obj);
                    name.push(name_obj);

                 });

                 //alert(JSON.stringify(name_obj));


                    var pie_basic_element = document.getElementById('pie_basic');
                    if (pie_basic_element) {
                        //alert();
                        var pie_basic = echarts.init(pie_basic_element);
                        pie_basic.setOption({
                            color: [
                                '#2ec7c9','#b6a2de','#5ab1ef','#ffb980','#d87a80',
                                '#8d98b3','#e5cf0d','#97b552','#95706d','#dc69aa',
                                '#07a2a4','#9a7fd1','#588dd5','#f5994e','#c05050',
                                '#59678c','#c9ab00','#7eb00a','#6f5553','#c14089'
                            ],          
                            
                            textStyle: {
                                fontFamily: 'Roboto, Arial, Verdana, sans-serif',
                                fontSize: 13
                            },
                            title: {
                                text: '',
                                left: 'left',
                                textStyle: {
                                    fontSize: 17,
                                    fontWeight: 500
                                },
                                subtextStyle: {
                                    fontSize: 12
                                }
                            },
                            tooltip: {
                                trigger: 'item',
                                backgroundColor: 'rgba(0,0,0,0.75)',
                                padding: [10, 15],
                                textStyle: {
                                    fontSize: 13,
                                    fontFamily: 'Roboto, sans-serif'
                                },
                                formatter: "{a} <br/>{b}: {c} ({d}%)"
                            },
                            legend: {
                                orient: 'horizontal',
                                bottom: '0%',
                                left: 'center',                   
                                data: name,
                                itemHeight: 8,
                                itemWidth: 8
                            },
                            series: [{
                                name: 'Field Manager',
                                type: 'pie',
                                radius: '70%',
                                center: ['50%', '50%'],
                                itemStyle: {
                                    normal: {
                                        borderWidth: 1,
                                        borderColor: '#fff'
                                    }
                                },
                                data: count
                            }]
                        });
                    }

              }       
        });

    });



    function arr_diff(a1, a2) {

        var a = [], diff = [];

        for (var i = 0; i < a1.length; i++) {
            a[a1[i]] = true;
        }

        for (var i = 0; i < a2.length; i++) {
            if (a[a2[i]]) {
                delete a[a2[i]];
            } else {
                a[a2[i]] = true;
            }
        }

        for (var k in a) {
            diff.push(k);
        }

        return diff;
    }


  </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', ['activePage' => 'dashboard', 'menuParent' => 'dashboard', 'titlePage' => __('Dashboard')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thethethoughtfactory/Desktop/RMS-2-11-21/resources/views/pages/dashboard.blade.php ENDPATH**/ ?>