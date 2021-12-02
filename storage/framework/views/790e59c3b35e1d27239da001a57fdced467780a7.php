<?php $__env->startSection('content'); ?>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
         
        <form method="post" action="<?php echo e(route('product_details.store')); ?>" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('post'); ?>

            <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">Product Details</i>
                </div>
                <h4 class="card-title"><?php echo e(__('Add Product')); ?></h4>
              </div>
              
              <div class="card-body ">
             <div class="row">
                  <div class="col-md-12 text-right">
                    <a href="/import_product_csv" class="btn btn-sm btn-info"><?php echo e(__('Import CSV / EXCEL')); ?></a>
                    
                  </div>
                </div>
                
		

                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="<?php echo e(route('product_details.index')); ?>" class="btn btn-sm btn-rose"><?php echo e(__('Back to Product')); ?></a>
                  </div>
                </div>
   
           <!--  <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Brand_Id')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('brand_id') ? ' has-danger' : ''); ?>">
                      <input class="form-control<?php echo e($errors->has('brand_id') ? ' is-invalid' : ''); ?>" name="brand_id" id="input-brand_id" type="text" placeholder="<?php echo e(__('Brand_Id')); ?>" value="<?php echo e(old('brand_id')); ?>"  aria-required="true"/>
                      <?php echo $__env->make('alerts.feedback', ['field' => 'brand_id'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div>-->
                
             
              
               
                <div class="row">

                 <label class="col-sm-2 col-form-label"><?php echo e(__('SKU :')); ?></label>
                  <div class="col-sm-4">
                    <div class="form-group<?php echo e($errors->has('sku') ? ' has-danger' : ''); ?>">
                      <input class="form-control<?php echo e($errors->has('sku') ? ' is-invalid' : ''); ?>" name="sku" id="input-sku" type="text" placeholder="<?php echo e(__('Sku')); ?>"
                       value="<?php echo e(old('sku')); ?>"  aria-required="true"/>
                      <?php echo $__env->make('alerts.feedback', ['field' => 'sku'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
               

                  <label class="col-sm-2 col-form-label"><?php echo e(__('Zrep code :')); ?></label>
                  <div class="col-sm-4">
                    <div class="form-group<?php echo e($errors->has('zrep_code') ? ' has-danger' : ''); ?>">
                      <input class="form-control<?php echo e($errors->has('zrep_code') ? ' is-invalid' : ''); ?>" name="zrep_code" id="" type="text"
                       placeholder="<?php echo e(__('Zrep code')); ?>" value="<?php echo e(old('zrep_code')); ?>"  aria-required="true"/>
                      <?php echo $__env->make('alerts.feedback', ['field' => 'zrep_code'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>

                  

                 </div> 
                
                
                <div class="row">
                
                   <label class="col-sm-2 col-form-label"><?php echo e(__('Product Name :')); ?></label>
                  <div class="col-sm-4">
                    <div class="form-group<?php echo e($errors->has('product_name') ? ' has-danger' : ''); ?>">
                      <input class="form-control<?php echo e($errors->has('product_name') ? ' is-invalid' : ''); ?>" name="product_name" id="input-product_name" type="text"
                       placeholder="<?php echo e(__('Product Name / Zrep Description')); ?>" value="<?php echo e(old('product_name')); ?>"  aria-required="true"/>
                      <?php echo $__env->make('alerts.feedback', ['field' => 'product_name'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                  
               
            
                 <label class="col-sm-2 col-form-label"><?php echo e(__('Type :')); ?></label>
                  <div class="col-sm-4">
                    <div class="form-group<?php echo e($errors->has('type') ? ' has-danger' : ''); ?>">

                    
                         <select class="form-control selectpicker" data-style="select-with-transition"  title="Select Type" data-size="7" name="type" id="input-type" 
                     value="<?php echo e(old('type')); ?>" aria-required="true" >
                     
                            <option selected="" value="">Select Type</option>
                            <option value="Regular">Regular</option>
                            <option value="Promo">Promo</option>
                            <option value="NPI">NPI</option>
                            <option value="LE-SLCI">LE-SLCI</option>

                        </select>


                      <?php echo $__env->make('alerts.feedback', ['field' => 'type'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>

                   

                </div>

               
              
            
             
                <div class="row">
               
               
                 <label class="col-sm-2 col-form-label"><?php echo e(__('Brand Name :')); ?></label>
                  <div class="col-sm-4">
                    <div class="form-group<?php echo e($errors->has('brand_id') ? ' has-danger' : ''); ?>">
                 
                      
                        <select class="form-control selectpicker" data-style="select-with-transition"  title="Select Brand" data-size="7" name="brand_id" id="input-brand_id" 
                     value="<?php echo e(old('brand_id')); ?>" aria-required="true" >
                     
                           <option value="" selected="" disabled="">Select Brand</option>
                           <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bran): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           	<option value="<?php echo e($bran->id); ?>"> <?php echo e($bran->brand_name); ?></option>
            			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			         </select>
			          <?php echo $__env->make('alerts.feedback', ['field' => 'brand_id'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                     </div>
                   </div>

                    <label class="col-sm-2 col-form-label"><?php echo e(__('Product Category :')); ?></label>
                   <div class="col-sm-4">
                    <div class="form-group<?php echo e($errors->has('product_categories') ? ' has-danger' : ''); ?>">
                 

                         <select class="form-control selectpicker" data-style="select-with-transition"  title="Select Category" data-size="7" name="product_categories" id="input-product_categories" 
                     value="<?php echo e(old('product_categories')); ?>" aria-required="true" >
                     
                       <option value="" selected="" disabled="">Select Category</option>
                       <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categ): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($categ->id); ?>"> <?php echo e($categ->category_name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
                    <?php echo $__env->make('alerts.feedback', ['field' => 'product_categories'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                   </div>

                  </div>
                 

                    <div class="row">
                
                 <label class="col-sm-2 col-form-label"><?php echo e(__('Piece per carton :')); ?></label>
                  <div class="col-sm-4">
                    <div class="form-group<?php echo e($errors->has('piece_per_carton') ? ' has-danger' : ''); ?>">
                      <input class="form-control<?php echo e($errors->has('piece_per_carton') ? ' is-invalid' : ''); ?>" name="piece_per_carton" id="" type="text"
                       placeholder="<?php echo e(__('Piece per carton')); ?>" value="<?php echo e(old('piece_per_carton')); ?>"  aria-required="true"/>
                      <?php echo $__env->make('alerts.feedback', ['field' => 'piece_per_carton'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>

                    <label class="col-sm-2 col-form-label"><?php echo e(__('Price per piece :')); ?></label>
                  <div class="col-sm-4">
                    <div class="form-group<?php echo e($errors->has('price_per_piece') ? ' has-danger' : ''); ?>">
                      <input class="form-control<?php echo e($errors->has('price_per_piece') ? ' is-invalid' : ''); ?>" name="price_per_piece" id="" type="text"
                       placeholder="<?php echo e(__('Price per piece')); ?>" value="<?php echo e(old('price_per_piece')); ?>"  aria-required="true"/>
                      <?php echo $__env->make('alerts.feedback', ['field' => 'price_per_piece'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>

                </div>
             
            

                 <div class="row">
                  

            <!--        <label class="col-sm-2 col-form-label"><?php echo e(__('Client id :')); ?></label>
                   <div class="col-sm-4">
                    <div class="form-group<?php echo e($errors->has('client_id') ? ' has-danger' : ''); ?>">
                    

                         <select class="form-control selectpicker" data-style="select-with-transition"  title="Select Client" data-size="7" name="client_id" id="input-client_id" 
                     value="<?php echo e(old('client_id')); ?>" aria-required="true" >
                     
                           <option value="" selected="">Select Client</option>
                           <?php $__currentLoopData = $client; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cli): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($cli->employee_id); ?>"> <?php echo e($cli->first_name); ?> <?php echo e($cli->middle_name); ?> <?php echo e($cli->surname); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     </select>
                      <?php echo $__env->make('alerts.feedback', ['field' => 'client_id'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            
                    </div>
                  </div>-->
                 
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Range :')); ?></label>
                  <div class="col-sm-4">
                    <div class="form-group<?php echo e($errors->has('range') ? ' has-danger' : ''); ?>">

                    
                         <select class="form-control selectpicker" data-style="select-with-transition"  title="Select Type" data-size="7" name="range" id="input-range" 
                     value="<?php echo e(old('range')); ?>" aria-required="true" >
                     
                            <option selected="" value="">Select Range</option>
                            <option value="minis">Minis</option>
                            <option value="multipacks">Multipacks</option>
                            <option value="one_plus_one">1+1</option>
                            <option value="ten_twinty">10.20</option>
                            <option value="other">Other</option>

                        </select>


                      <?php echo $__env->make('alerts.feedback', ['field' => 'range'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                  
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Bar code :')); ?></label>
                  <div class="col-sm-4">
                    <div class="form-group<?php echo e($errors->has('barcode') ? ' has-danger' : ''); ?>">
                      <input class="form-control<?php echo e($errors->has('barcode') ? ' is-invalid' : ''); ?>" name="barcode" id="" type="number"
                       placeholder="<?php echo e(__('Bar Code')); ?>" value="<?php echo e(old('barcode')); ?>"  aria-required="true"/>
                      <?php echo $__env->make('alerts.feedback', ['field' => 'barcode'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>

                   
                  </div>


                  <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Product Image')); ?></label>
                  <div class="col-sm-4">
                   <input type="file" class="form-control" name="ProductImageFile[]"  />
                    <!--  <input class="form-control<?php echo e($errors->has('supportingdocument') ? ' is-invalid' : ''); ?>" name="supportingdocument" id="input-supportingdocument" type="text" placeholder="<?php echo e(__('supportingdocument')); ?>" value="<?php echo e(old('supportingdocument')); ?>"  aria-required="true"/>-->
                      <?php echo $__env->make('alerts.feedback', ['field' => 'ProductImageFile'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>

                     <label class="col-sm-2 col-form-label"><?php echo e(__('Remarks :')); ?></label>
                   <div class="col-sm-4">
                    <div class="form-group<?php echo e($errors->has('remarks') ? ' has-danger' : ''); ?>">
                      <input class="form-control<?php echo e($errors->has('remarks') ? ' is-invalid' : ''); ?>" name="remarks" id="" type="text"
                       placeholder="<?php echo e(__('Remarks')); ?>" value="<?php echo e(old('remarks')); ?>"  aria-required="true"/>
                      <?php echo $__env->make('alerts.feedback', ['field' => 'remarks'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
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
            
        });
  });
  
 
    $(document).ready(function() {
  
    // initialise Datetimepicker and Sliders
  
      md.initFormExtendedDatetimepickers();
         
      if ($('.slider').length != 0) {
      
        md.initSliders();
      } 
      
    }); 


// $("#input-brand_id").change(function() {
//    var brand_id = $(this).val();
//   //alert(id);
//   var csrf = $('meta[name="csrf-token"]').attr('content');
//   $.ajax({
//            url: '/get_category_details',
//           type: 'GET',
//           data: {brand_id : brand_id, '_token': csrf},
//           dataType: 'json',
//         success: function( data ) {
//        var myJSON = JSON.stringify(data);
// $('#input-product_categories').find('option').remove().end().append('<option selected="selected" value="">Select</option>');
//           $.each($.parseJSON(myJSON), function(key,value){
//             var $bar = $('#input-product_categories'); 
//             $bar.append($("<option></option>")
//                     .attr("value", value.id)
//                     .text(value.category_name));
//             });

//         }         
//     })
// });



  </script>
  
 
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', ['activePage' => 'product_details', 'menuParent' => 'Products', 'titlePage' => __('Product Details')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thethethoughtfactory/Desktop/RMS-2-11-21/resources/views/product_details/create.blade.php ENDPATH**/ ?>