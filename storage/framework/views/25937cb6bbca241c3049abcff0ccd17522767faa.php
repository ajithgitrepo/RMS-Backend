<?php $__env->startSection('content'); ?>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
         
             <form method="post"  action="<?php echo e(route('product_details.update',$product[0]->id)); ?>"  autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
          
            <?php echo csrf_field(); ?>
            <?php echo method_field('put'); ?>

            <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">product_details</i>
                </div>
                <h4 class="card-title"><?php echo e(__('Edit Product_details')); ?></h4>
              </div>
              
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['isClient','isTopManagement','isAdmin'],App\User::class)): ?>
                      <a href="<?php echo e(route('product_details.index')); ?>" class="btn btn-sm btn-rose"><?php echo e(__('Back to Product')); ?></a>
                    <?php endif; ?>
                  </div>
                </div>
                
                  <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('SKU')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('sku') ? ' has-danger' : ''); ?>">
                      <input class="form-control<?php echo e($errors->has('sku') ? ' is-invalid' : ''); ?>" name="sku" id="input-sku" type="number" placeholder="<?php echo e(__('Sku')); ?>" value="<?php echo e(old('sku',$product[0]->sku)); ?>"  aria-required="true"/>
                      <?php echo $__env->make('alerts.feedback', ['field' => 'sku'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div>
                
                <div class="row">
                 
                   <label class="col-sm-2 col-form-label"><?php echo e(__('Zrep code ')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('zrep_code') ? ' has-danger' : ''); ?>">
                      <input class="form-control<?php echo e($errors->has('zrep_code') ? ' is-invalid' : ''); ?>" name="zrep_code" id="" type="text"
                       placeholder="<?php echo e(__('Zrep code')); ?>" value="<?php echo e(old('zrep_code',$product[0]->zrep_code)); ?>"  aria-required="true"/>
                      <?php echo $__env->make('alerts.feedback', ['field' => 'zrep_code'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>

                </div>

                  <div class="row">
                 
                   <label class="col-sm-2 col-form-label"><?php echo e(__('Product Name ')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('product_name') ? ' has-danger' : ''); ?>">
                      <input class="form-control<?php echo e($errors->has('product_name') ? ' is-invalid' : ''); ?>" name="product_name" id="" type="text"
                       placeholder="<?php echo e(__('Zrep code')); ?>" value="<?php echo e(old('product_name',$product[0]->product_name)); ?>"  aria-required="true"/>
                      <?php echo $__env->make('alerts.feedback', ['field' => 'product_name'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>

                </div>

                <div class="row">
                 <label class="col-sm-2 col-form-label"><?php echo e(__('Type ')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('type') ? ' has-danger' : ''); ?>">

                    
                         <select class="form-control selectpicker" data-style="select-with-transition"  title="Select Type" data-size="7" name="type" id="input-type" 
                     value="<?php echo e(old('type')); ?>" aria-required="true" >
                     
                            <option selected="" value="">Select Type</option>
                            <option value="Regular" <?php if( $product[0]->type == "Regular"): ?> <?php echo e('selected'); ?> <?php endif; ?> >Regular</option>
                            <option value="Promo" <?php if( $product[0]->type == "Promo"): ?> <?php echo e('selected'); ?> <?php endif; ?> >Promo</option>
                            <option value="NPI" <?php if( $product[0]->type == "NPI"): ?> <?php echo e('selected'); ?> <?php endif; ?> >NPI</option>
                            <option value="LE-SLCI" <?php if( $product[0]->type == "LE-SLCI"): ?> <?php echo e('selected'); ?> <?php endif; ?> >LE-SLCI</option>

                        </select>

                      <?php echo $__env->make('alerts.feedback', ['field' => 'type'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
              </div>

              <div class="row">
              <label class="col-sm-2 col-form-label"><?php echo e(__('Range ')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('range') ? ' has-danger' : ''); ?>">

                    
                         <select class="form-control selectpicker" data-style="select-with-transition"  title="Select Type" data-size="7" name="range" id="input-range" 
                     value="<?php echo e(old('range')); ?>" aria-required="true" >
                     
                            <option selected="" value="">Select Range</option>
                            <option value="minis" <?php if( $product[0]->range == "minis"): ?> <?php echo e('selected'); ?> <?php endif; ?> >Minis</option>
                            <option value="multipacks"  <?php if( $product[0]->range == "multipacks"): ?> <?php echo e('selected'); ?> <?php endif; ?> >Multipacks</option>
                            <option value="one_plus_one"  <?php if( $product[0]->range == "one_plus_one"): ?> <?php echo e('selected'); ?> <?php endif; ?>  >1+1</option>
                            <option value="ten_twinty"  <?php if( $product[0]->range == "ten_twinty"): ?> <?php echo e('selected'); ?> <?php endif; ?> >10.20</option>
                            <option value="other"  <?php if( $product[0]->range == "other"): ?> <?php echo e('selected'); ?> <?php endif; ?> >Other</option>

                        </select>


                      <?php echo $__env->make('alerts.feedback', ['field' => 'range'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
              </div>
              
              <div class="row">
 
                <label class="col-sm-2 col-form-label"><?php echo e(__('Bar code :')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('barcode') ? ' has-danger' : ''); ?>">
                      <input class="form-control<?php echo e($errors->has('barcode') ? ' is-invalid' : ''); ?>" name="barcode" id="" type="text"
                       placeholder="<?php echo e(__('Bar Code')); ?>" value="<?php echo e(old('barcode',$product[0]->barcode)); ?>"  aria-required="true"/>
                      <?php echo $__env->make('alerts.feedback', ['field' => 'barcode'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div>
                   
                  

                 <div class="row">
                <label class="col-sm-2 col-form-label"><?php echo e(__('Brand_Name')); ?></label>
                 <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('brand_id') ? ' has-danger' : ''); ?>">
                 
                       <select class="form-control<?php echo e($errors->has('brand_id') ? ' is-invalid' : ''); ?>" name="brand_id" id="input-brand_id" 
                        value="<?php echo e(old('brand_id')); ?>" >
              
                       <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bran): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   
                    <option value="<?php echo e($bran->id); ?>" <?php if( $bran->id == $product[0]->brand_id): ?> <?php echo e('selected'); ?> <?php endif; ?> >
                      
                        <?php echo e($bran->brand_name); ?> </option> 
     
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
            </select>
            <?php echo $__env->make('alerts.feedback', ['field' => 'brand_id'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
         
                    </div>
                   </div>
                  </div>
            
                   <div class="row">
                <label class="col-sm-2 col-form-label"><?php echo e(__('Product_Categories')); ?></label>
                 <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('product_categories') ? ' has-danger' : ''); ?>">
                 
                       <select class="form-control<?php echo e($errors->has('product_categories') ? ' is-invalid' : ''); ?>" name="product_categories" 
                       id="input-product_categories"  value="<?php echo e(old('product_categories')); ?>" >
                     
                        <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categ): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    
                       <option value="<?php echo e($categ->id); ?>" <?php if($categ->id == $product[0]->product_categories): ?> <?php echo e('selected'); ?> <?php endif; ?>>
                      
                        <?php echo e($categ->category_name); ?> </option> 
     
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
              </select>
               <?php echo $__env->make('alerts.feedback', ['field' => 'product_categories'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                   </div>
                  </div>


               <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Piece_per_carton')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('piece_per_carton') ? ' has-danger' : ''); ?>">
                      <input class="form-control<?php echo e($errors->has('piece_per_carton') ? ' is-invalid' : ''); ?>" name="piece_per_carton" id="" type="text" placeholder="<?php echo e(__('Piece_per_carton')); ?>" value="<?php echo e(old('piece_per_carton',$product[0]->piece_per_carton)); ?>"  aria-required="true"/>
                      <?php echo $__env->make('alerts.feedback', ['field' => 'piece_per_carton'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div>
                
                 <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Price_per_piece')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('price_per_piece') ? ' has-danger' : ''); ?>">
                      <input class="form-control<?php echo e($errors->has('price_per_piece') ? ' is-invalid' : ''); ?>" name="price_per_piece" id="" type="text"
                       placeholder="<?php echo e(__('Price_per_piece')); ?>" value="<?php echo e(old('price_per_piece',$product[0]->price_per_piece)); ?>"  aria-required="true"/>
                      <?php echo $__env->make('alerts.feedback', ['field' => 'price_per_piece'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div>
          
             
                  
              
             <!--       <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Client_id')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('client_id') ? ' has-danger' : ''); ?>">
                     
                          <select class="form-control selectpicker" data-style="select-with-transition"  title="Select Client" data-size="7" name="client_id" id="input-client_id" 
                     value="<?php echo e(old('client_id')); ?>" aria-required="true" >
                     
                           <option value="" selected="">Select</option>
                            <?php $__currentLoopData = $client; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cli): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                               <option value="<?php echo e($cli->employee_id); ?>"  <?php if( $cli->employee_id == $product[0]->client_id): ?> <?php echo e('selected'); ?> <?php endif; ?> > <?php echo e($cli->first_name); ?> <?php echo e($cli->middle_name); ?> <?php echo e($cli->surname); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>

                      <?php echo $__env->make('alerts.feedback', ['field' => 'client_id'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    </div>
                  </div>
                </div>-->
                
                 <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Remarks')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('remarks') ? ' has-danger' : ''); ?>">
                      <input class="form-control<?php echo e($errors->has('remarks') ? ' is-invalid' : ''); ?>" name="remarks" id="" type="text" placeholder="<?php echo e(__('Remarks')); ?>" value="<?php echo e(old('remarks',$product[0]->remarks)); ?>"  aria-required="true"/>
                      <?php echo $__env->make('alerts.feedback', ['field' => 'remarks'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Product Image')); ?></label>
                  <div class="col-sm-7">
                   <input type="file" class="form-control" name="ProductImageFile[]"  />
                    <!--  <input class="form-control<?php echo e($errors->has('supportingdocument') ? ' is-invalid' : ''); ?>" name="supportingdocument" id="input-supportingdocument" type="text" placeholder="<?php echo e(__('supportingdocument')); ?>" value="<?php echo e(old('supportingdocument')); ?>"  aria-required="true"/>-->
                      <?php echo $__env->make('alerts.feedback', ['field' => 'ProductImageFile'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
            
               <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-rose mx-auto"><?php echo e(__('update')); ?></button>
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

<?php echo $__env->make('layouts.app', ['activePage' => 'product_details', 'menuParent' => 'Products', 'titlePage' => __('Product Details')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thethethoughtfactory/Desktop/RMS-2-11-21/resources/views/product_details/edit.blade.php ENDPATH**/ ?>