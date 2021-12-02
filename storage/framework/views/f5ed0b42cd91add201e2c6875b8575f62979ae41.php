<style>
#email-error {
    height: 30px;
    margin-left: 0px !important;
}
</style>



<?php $__env->startSection('content'); ?>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="<?php echo e(route('employee-reporting.store')); ?>" autocomplete="off" class="form-horizontal">
            <?php echo csrf_field(); ?>
            <?php echo method_field('post'); ?>

            <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">event</i>
                </div>
                <h4 class="card-title"><?php echo e(__('Add Reporting To')); ?></h4>
              </div>
              <div class="card-body ">
                
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="<?php echo e(route('employee-reporting.index')); ?>" class="btn btn-sm btn-rose"><?php echo e(__('Back to Reporting To')); ?></a>
                  </div>
                </div>
                
                <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Employee')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('leave_type') ? ' has-danger' : ''); ?>">
                    
                   
                      <select class="form-control<?php echo e($errors->has('leave_type') ? ' is-invalid' : ''); ?> js-select2" name="employee_id" id="employee_id" 
                     value="<?php echo e(old('leave_type')); ?>" aria-required="true">
                       <option value=" ">Select</option>
              					 <?php $__currentLoopData = $employee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              						<option value="<?php echo e($emp->employee_id); ?>"><?php echo e($emp->first_name); ?> <?php echo e($emp->middle_name); ?> <?php echo e($emp->surname); ?> (<?php echo e($emp->employee_id); ?>) </option>
              						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  		</select>

                   
                      <?php echo $__env->make('alerts.feedback', ['field' => 'employee_id'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Reporting To')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('rule') ? ' has-danger' : ''); ?>">
                     
                     <select class="form-control js-select2" name="reporting_employee_id" id="reporting_employee_id" 
                     value="<?php echo e(old('rule')); ?>" aria-required="true">
                        <option value=" ">Select</option>
					    <?php $__currentLoopData = $non_merchant; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $merchant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<option value="<?php echo e($merchant->employee_id); ?>"><?php echo e($merchant->first_name); ?> <?php echo e($merchant->middle_name); ?> <?php echo e($merchant->surname); ?> (<?php echo e($merchant->employee_id); ?>) </option>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  		</select>
                    
                      <?php echo $__env->make('alerts.feedback', ['field' => 'reporting_employee_id'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div>

                  <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Reporting Date')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('requirements') ? ' has-danger' : ''); ?>">
                    <input type="text" class="form-control datepicker" id="start_month" placeholder="Reporting Date" name="report_date">
                      <?php echo $__env->make('alerts.feedback', ['field' => 'report_date'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div>

                  <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Reporting End Date')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('remarks') ? ' has-danger' : ''); ?>">
                    <input type="text" class="form-control datepicker" id="end_month" placeholder="Reporting Date" name="report_end_month">
                      <?php echo $__env->make('alerts.feedback', ['field' => 'report_end_month'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div>
                
                <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-rose mx-auto"><?php echo e(__('Save')); ?></button>
              </div>
              
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>

  <script>

    $(".js-select2").select2();

$('#employee_id').on('change', function () {
  //ways to retrieve selected option and text outside handler
  //alert('Changed option value ' + this.value);
 // console.log('Changed option text ' + $(this).find('option').filter(':selected').text());
 $("#reporting_employee_id option").removeAttr('disabled');
 $("#reporting_employee_id option[value='"+ this.value + "']").attr("disabled", true);;
});

    $(document).ready(function () {
      // $('.datepicker').datetimepicker({
      //   useCurrent: false
      // });

      $(".datepicker").datetimepicker({
        format: 'DD-MM-YYYY',
        useCurrent: false
      });

    });

    $(document).ready(function() {
      // Initialise the wizard
      demo.initMaterialWizard();
      setTimeout(function() {
        $('.card.card-wizard').addClass('active');
      }, 600);
    });
  </script>
  

  <script>
    $(document).ready(function() {
      // initialise Datetimepicker and Sliders
      md.initFormExtendedDatetimepickers();

     
    });
  </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', ['activePage' => 'employee-reporting', 'menuParent' => 'Employee', 'titlePage' => __('Employee Reporting-to')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thethethoughtfactory/Desktop/RMS-2-11-21/resources/views/employee/reporting-to/create.blade.php ENDPATH**/ ?>