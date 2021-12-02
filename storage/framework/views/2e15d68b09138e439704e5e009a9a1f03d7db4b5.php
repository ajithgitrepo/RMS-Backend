<?php $__env->startSection('content'); ?>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="<?php echo e(route('store_details.store')); ?>" autocomplete="off" class="form-horizontal">
            <?php echo csrf_field(); ?>
            <?php echo method_field('post'); ?>

            <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">add_task</i>
                </div>
                <h4 class="card-title"><?php echo e(__('Store_Details')); ?></h4>
               </div>
              
              <div class="card-body ">
              
                <div class="row">
                  <div class="col-md-12 text-right">
                    <a href="/import_store" class="btn btn-sm btn-info"><?php echo e(__('Import CSV / EXCEL')); ?></a>
                      <a href="<?php echo e(route('store_details.index')); ?>" class="btn btn-sm btn-rose"><?php echo e(__('Back to store details')); ?></a>
                  </div>
                </div>
                
                <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Store Code')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('store_code') ? ' has-danger' : ''); ?>">
                    
                   <input class="form-control<?php echo e($errors->has('store_code') ? ' is-invalid' : ''); ?>" name="store_code" id="input-store_code" type="text" placeholder="<?php echo e(__('Store Code')); ?>" value="<?php echo e(old('store_code')); ?>"  aria-required="true"/>
                   
                      <?php echo $__env->make('alerts.feedback', ['field' => 'store_code'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div>
                
                 <div class="row">
                   <label class="col-sm-2 col-form-label"><?php echo e(__('Store Name')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('store_name') ? ' has-danger' : ''); ?>">
                     
                    <input class="form-control<?php echo e($errors->has('store_name') ? ' is-invalid' : ''); ?>" name="store_name" id="input-store_name" type="text" placeholder="<?php echo e(__('Store Name')); ?>" value="<?php echo e(old('store_name')); ?>"  aria-required="true"/>
                    
                      <?php echo $__env->make('alerts.feedback', ['field' => 'store_name'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                   </div>
                  </div>
                
                <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Contact Number')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('contact_number') ? ' has-danger' : ''); ?>">
                     
                    <input class="form-control<?php echo e($errors->has('contact_number') ? ' is-invalid' : ''); ?>" name="contact_number" id="input-contact_number" type="text" placeholder="<?php echo e(__('Contact Number')); ?>" value="<?php echo e(old('contact_number')); ?>"  aria-required="true"/>
                    
                      <?php echo $__env->make('alerts.feedback', ['field' => 'contact_number'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div>
                
                  <div class="row">
                   <label class="col-sm-2 col-form-label"><?php echo e(__('Address')); ?></label>
                   <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('address') ? ' has-danger' : ''); ?>">
                      <input class="form-control<?php echo e($errors->has('address') ? ' is-invalid' : ''); ?>" name="address" id="input-address" type="text" placeholder="<?php echo e(__('Address')); ?>" value="<?php echo e(old('address')); ?>"  aria-required="true"/>
                      <?php echo $__env->make('alerts.feedback', ['field' => 'address'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div>
                
                 
                <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-rose text-center"><?php echo e(__('Save')); ?></button>
               </div>
              
              </div> 
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', ['activePage' => 'store_details', 'menuParent' => 'Store_Details', 'titlePage' => __('Store 
Details')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thethethoughtfactory/Desktop/RMS-2-11-21/resources/views/store_details/create.blade.php ENDPATH**/ ?>