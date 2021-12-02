<?php $__env->startSection('content'); ?>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
      
          <form method="post" action="<?php echo e(route('outlet.update', $outlet[0]->outlet_id )); ?>" autocomplete="off" class="form-horizontal">
            <?php echo csrf_field(); ?>
            <?php echo method_field('put'); ?>

          <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">outlet</i>
                </div>
                <h4 class="card-title"><?php echo e(__('Edit Outlet')); ?></h4>
              </div>
              
             <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="<?php echo e(route('outlet.index')); ?>" class="btn btn-sm btn-rose"><?php echo e(__('Back to outlet')); ?></a>
                   </div>
                 </div>
                
               
              

                 <div class="row"> 
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Outlet Name')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('outlet_name') ? ' has-danger' : ''); ?>">
               
                        <select class="form-control selectpicker" data-style="select-with-transition" title="Select Store" data-size="7" name="outlet_name" id="input_days" 
                     value="<?php echo e(old('outlet_name')); ?>" aria-required="true" >
                     
                      <option value="" selected disabled>Select Store</option>
                       <?php $__currentLoopData = $store; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $str): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <option value="<?php echo e($str->id); ?>"  <?php if($str->id == $outlet[0]->outlet_name): ?> <?php echo e('selected'); ?> <?php endif; ?> > <?php echo e($str->store_name); ?></option>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                      </select>
                   
                      <?php echo $__env->make('alerts.feedback', ['field' => 'outlet_name'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div>

               
                 <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Outlet Lat')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('outlet_lat') ? ' has-danger' : ''); ?>">
                     
                    <input class="form-control<?php echo e($errors->has('outlet_lat') ? ' is-invalid' : ''); ?>" name="outlet_lat" id="input-outlet_lat" type="text" placeholder="<?php echo e(__('outlet_lat')); ?>" value="<?php echo e(old('outlet_lat',$outlet[0]->outlet_lat)); ?>"  aria-required="true"/>
                    
                      <?php echo $__env->make('alerts.feedback', ['field' => 'outlet_lat'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                 </div>
                
                <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Outlet Long')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('outlet_long') ? ' has-danger' : ''); ?>">
                     
                    <input class="form-control<?php echo e($errors->has('outlet_long') ? ' is-invalid' : ''); ?>" name="outlet_long" id="input-outlet_long" type="text" placeholder="<?php echo e(__('outlet_long')); ?>" value="<?php echo e(old('outlet_long',$outlet[0]->outlet_long)); ?>"  aria-required="true"/>
                    
                      <?php echo $__env->make('alerts.feedback', ['field' => 'outlet_long'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div>
                
                  <div class="row">
                    <label class="col-sm-2 col-form-label"><?php echo e(__('Outlet Area')); ?></label>
                   <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('outlet_area') ? ' has-danger' : ''); ?>">
                      <input class="form-control<?php echo e($errors->has('outlet_area') ? ' is-invalid' : ''); ?>" name="outlet_area" id="input-outlet_area" type="text" placeholder="<?php echo e(__('outlet_area')); ?>" value="<?php echo e(old('outlet_area',$outlet[0]->outlet_area)); ?>"  aria-required="true"/>
                      <?php echo $__env->make('alerts.feedback', ['field' => 'outlet_area'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div>
                
                  <div class="row">
                    <label class="col-sm-2 col-form-label"><?php echo e(__('Outlet City')); ?></label>
                   <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('outlet_city') ? ' has-danger' : ''); ?>">
                      <input class="form-control<?php echo e($errors->has('outlet_city') ? ' is-invalid' : ''); ?>" name="outlet_city" id="input-outlet_city" type="text" placeholder="<?php echo e(__('outlet_city')); ?>" value="<?php echo e(old('outlet_city',$outlet[0]->outlet_city)); ?>"  aria-required="true"/>
                      <?php echo $__env->make('alerts.feedback', ['field' => 'outlet_city'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Outlet Emirate')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('outlet_state') ? ' has-danger' : ''); ?>">
                      <input class="form-control<?php echo e($errors->has('outlet_state') ? ' is-invalid' : ''); ?>" name="outlet_state" id="input-outlet_state" type="text" placeholder="<?php echo e(__('outlet_state')); ?>" value="<?php echo e(old('outlet_city',$outlet[0]->outlet_state)); ?>"  aria-required="true"/>
                      <?php echo $__env->make('alerts.feedback', ['field' => 'outlet_state'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Outlet Country')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('outlet_country') ? ' has-danger' : ''); ?>">
                      <input class="form-control<?php echo e($errors->has('outlet_country') ? ' is-invalid' : ''); ?>" name="outlet_country" id="input-outlet_country" type="text" placeholder="<?php echo e(__('outlet_country')); ?>" value="<?php echo e(old('outlet_country',$outlet[0]->outlet_country)); ?>"  aria-required="true"/>
                      <?php echo $__env->make('alerts.feedback', ['field' => 'outlet_country'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div>
                
              <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-rose"><?php echo e(__('update')); ?></button>
              </div>
              
            </div>
           </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', ['activePage' => 'outlets', 'menuParent' => 'Outlets', 'titlePage' => __('Outlets')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thethethoughtfactory/Desktop/RMS-2-11-21/resources/views/outlet/edit.blade.php ENDPATH**/ ?>