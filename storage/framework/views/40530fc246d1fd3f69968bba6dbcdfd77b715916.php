


<?php $__env->startSection('content'); ?>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="<?php echo e(route('store_import')); ?>" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">

            <?php echo csrf_field(); ?>
            <?php echo method_field('post'); ?>

            <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                 <i class="material-icons">Store</i>
                </div>
                <h4 class="card-title"><?php echo e(__('Import Store')); ?></h4>
               </div>
              
              <div class="card-body ">
              
                <div class="row">
                  <div class="col-md-12 text-right">
                   
                    <a href="<?php echo e(route('store_details.index')); ?>" class="btn btn-sm btn-rose"><?php echo e(__('Back to store')); ?></a>
                    
                  </div>
                </div>
                
                <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Excel / Csv')); ?></label>
                  <div class="col-sm-7">
                   <input class="form-control<?php echo e($errors->has('store_import') ? ' is-invalid' : ''); ?>" type="file" name="store_import" multiple  >
                   
                    
                      <?php echo $__env->make('alerts.feedback', ['field' => 'store_import'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                      
                    </div>
                  </div>
                </div> 
               
              
                <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-rose text-center"><?php echo e(__('Import')); ?></button>

               </div>
              
              </div> 
            </div>


                 <?php if($message = Session::get('warning')): ?>
                  <div class="alert alert-warning alert-block" style="margin:auto;">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                          <strong><?php echo e($message); ?></strong>
                  </div>
                  <?php endif; ?>
                

          </form>

        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', ['activePage' => 'store_details', 'menuParent' => 'Store_Details', 'titlePage' => __('Store 
Details')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thethethoughtfactory/Desktop/RMS-2-11-21/resources/views/store_details/import.blade.php ENDPATH**/ ?>