

<?php $__env->startSection('content'); ?>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="<?php echo e(route('bulk_import_employee_csv')); ?>" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">

            <?php echo csrf_field(); ?>
            <?php echo method_field('post'); ?>

            <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">add_task</i>
                </div>
                <h4 class="card-title"><?php echo e(__('Import Employees')); ?></h4>
               </div>
              
              <div class="card-body">
              
                <div class="row">
                  <div class="col-md-12 text-right">
                   
                    <a href="<?php echo e(route('employee.index')); ?>" class="btn btn-sm btn-rose"><?php echo e(__('Back to employee details')); ?></a>
                    
                  </div>
                </div>
                
                <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Excel / Csv')); ?></label>
                  <div class="col-sm-7">
                   <input class="form-control<?php echo e($errors->has('employee_import') ? ' is-invalid' : ''); ?>" type="file" name="employee_import"   >
                   <a  download href="<?php echo e(URL::to('/')); ?>/dl_copy/Copy_of_Employee_Details.xlsx"  rel="tooltip"
                   data-original-title="Download" >Download Sample Format</a>
                      <?php echo $__env->make('alerts.feedback', ['field' => 'employee_import'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                      
                    </div>
                  </div>
                </div> 
               
              
                <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-danger text-center"><?php echo e(__('Import')); ?></button>
               </div>
              
              </div> 
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', ['activePage' => 'outlets', 'menuParent' => 'Outlets', 'titlePage' => __('Outlet')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thethethoughtfactory/Desktop/RMS-2-11-21/resources/views/employee/management/import.blade.php ENDPATH**/ ?>