<?php $__env->startSection('content'); ?>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="<?php echo e(route('brand_details.store')); ?>" autocomplete="off" class="form-horizontal">
            <?php echo csrf_field(); ?>
            <?php echo method_field('post'); ?>

            <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="fa fa-copyright"></i>
                </div>
                <h4 class="card-title"><?php echo e(__('Add Brand Details')); ?></h4>
              </div>
              
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="<?php echo e(route('brand_details.index')); ?>" class="btn btn-sm btn-rose"><?php echo e(__('Back to brand')); ?></a>
                  </div>
                </div>
              
                <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Brand Name')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('brand_name') ? ' has-danger' : ''); ?>">
                      <input class="form-control<?php echo e($errors->has('brand_name') ? ' is-invalid' : ''); ?>" name="brand_name" id="input-brand_name" type="text" placeholder="<?php echo e(__('Brand Name')); ?>" value="<?php echo e(old('brand_name')); ?>"  aria-required="true"/>
                      <?php echo $__env->make('alerts.feedback', ['field' => 'brand_name'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div>
                 
                 <!-- <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('client')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('client_id') ? ' has-danger' : ''); ?>">
                    
                    <select class="form-control selectpicker" data-style="select-with-transition"  title="Select Client" data-size="7" name="client_id" id="input-client_id" 
                     value="<?php echo e(old('client_id')); ?>" aria-required="true" >
 
                       <option value="" selected="">Select</option>
                       <?php $__currentLoopData = $employ_client; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employ1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   	<option value="<?php echo e($employ1->employee_id); ?>" <?php if( old('client_id') == $employ1->employee_id): ?> 
                    <?php echo e('selected'); ?> <?php endif; ?> > <?php echo e($employ1->first_name); ?> <?php echo e($employ1->middle_name); ?> <?php echo e($employ1->surname); ?>

                   	(<?php echo e($employ1->employee_id); ?>)</option>
    			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    			
			</select>
			
                      <?php echo $__env->make('alerts.feedback', ['field' => 'client_id'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div> -->
             
                <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Field Manager')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('field_manager_id') ? ' has-danger' : ''); ?>">
                    
                   
                     <select class="form-control selectpicker" data-style="select-with-transition"  title="Select Field Manager" data-size="7" name="field_manager_id" id="input-field_manager_id" 
                     value="<?php echo e(old('field_manager_id')); ?>" aria-required="true" >
 
                       <option value="" selected="">Select</option>
                       <?php $__currentLoopData = $employ_field; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employ2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   	<option value="<?php echo e($employ2->employee_id); ?>" <?php if( old('field_manager_id') == $employ2->employee_id): ?> 
                    <?php echo e('selected'); ?> <?php endif; ?> > <?php echo e($employ2->first_name); ?> <?php echo e($employ2->middle_name); ?><?php echo e($employ2->surname); ?>

                   	(<?php echo e($employ2->employee_id); ?>)</option>
    			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    			
			</select>
                      <?php echo $__env->make('alerts.feedback', ['field' => 'field_manager_id'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div>
                
               
                <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Sales Manager')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('sales_manager_id') ? ' has-danger' : ''); ?>">
                   
                    <select class="form-control selectpicker" data-style="select-with-transition"  title="Select Sales Manager" data-size="7" name="sales_manager_id" id="input-sales_manager_id" 
                     value="<?php echo e(old('sales_manager_id')); ?>" aria-required="true" >
 
 
                       <option value="" selected="">Select</option>
                           <?php $__currentLoopData = $employ_sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employ3): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       	<option value="<?php echo e($employ3->employee_id); ?>" <?php if( old('sales_manager_id') ==  $employ3->employee_id): ?> <?php echo e('selected'); ?> <?php endif; ?> > <?php echo e($employ3->first_name); ?> <?php echo e($employ3->middle_name); ?> <?php echo e($employ3->surname); ?>

                       	(<?php echo e($employ3->employee_id); ?>)</option>
                    		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                			
            			</select>
                      <?php echo $__env->make('alerts.feedback', ['field' => 'sales_manager_id'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div>
          
              
       
                <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-rose mx-auto"><?php echo e(__('Add')); ?></button>
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

<?php echo $__env->make('layouts.app', ['activePage' => 'brand_details', 'menuParent' => 'Products', 'titlePage' => __('Brand Details')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thethethoughtfactory/Desktop/RMS-2-11-21/resources/views/brand_details/create.blade.php ENDPATH**/ ?>