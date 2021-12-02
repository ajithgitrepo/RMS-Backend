<?php $__env->startSection('content'); ?>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="<?php echo e(route('category_details.store')); ?>" autocomplete="off" class="form-horizontal">
            <?php echo csrf_field(); ?>
            <?php echo method_field('post'); ?>

            <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">Category Details</i>
                </div>
                <h4 class="card-title"><?php echo e(__('Add Category')); ?></h4>
              </div>
              
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="<?php echo e(route('category_details.index')); ?>" class="btn btn-sm btn-rose"><?php echo e(__('Back to Category')); ?></a>
                  </div>
                </div>
              
              <!--   <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Brand')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('brand_id') ? ' has-danger' : ''); ?>">
                       <select class="form-control<?php echo e($errors->has('brand_id') ? ' is-invalid' : ''); ?>" name="brand_id" id="input-brand_id" 
                        value="<?php echo e(old('brand_id')); ?>" >
                     
                       <option>Select</option>
                       <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bran): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   	<option value="<?php echo e($bran->id); ?>"> <?php echo e($bran->brand_name); ?></option>
    			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</select>
                     
                    </div>
                  </div>
                </div> -->
                
                
                <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Category')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('category_name') ? ' has-danger' : ''); ?>">
                      <input class="form-control<?php echo e($errors->has('category_name') ? ' is-invalid' : ''); ?>" name="category_name" id="input-category_name" type="text" placeholder="<?php echo e(__('category')); ?>" value="<?php echo e(old('category_name')); ?>"  aria-required="true"/>
                      <?php echo $__env->make('alerts.feedback', ['field' => 'category_name'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div>
                 
                 
              
       
                <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-rose mx-auto"><?php echo e(__('Save')); ?></button>
               </div>
              
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
 
 $(function () {
                  
              $('.datepicker').datetimepicker({
              format: 'DD-MM-YYYY',
              minDate:new Date(),
              showTodayButton: true,
      });
  });
  
    $(document).ready(function() {
  
    // initialise Datetimepicker and Sliders
  
      md.initFormExtendedDatetimepickers();
         
      if ($('.slider').length != 0) {
      
        md.initSliders();
      } 
      
    }); 
     
    
  </script>
  
 
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', ['activePage' => 'category_details', 'menuParent' => 'Products', 'titlePage' => __('Category Details')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thethethoughtfactory/Desktop/RMS-2-11-21/resources/views/category_details/create.blade.php ENDPATH**/ ?>