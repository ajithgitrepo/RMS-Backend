<style type="text/css">
  @import  url("https://fonts.googleapis.com/css?family=Open+Sans:400,700");
@import  url("https://fonts.googleapis.com/css?family=Pacifico");


.content {
  background: #fff;
  border-radius: 3px;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.075), 0 2px 4px rgba(0, 0, 0, 0.0375);
  padding: 30px 30px 20px;
}



.select2.select2-container {
  width: 100% !important;
}

.select2.select2-container .select2-selection {
  border: 1px solid #ccc !important;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  height: 34px;
  /*margin-top: 20px;*/
  outline: none;
  transition: all 0.15s ease-in-out;
}

.select2.select2-container .select2-selection .select2-selection__rendered {
  color: #333;
  line-height: 32px;
  padding-right: 33px;
}

.select2.select2-container .select2-selection .select2-selection__arrow {
  background: #f8f8f8;
  border-left: 1px solid #ccc;
  -webkit-border-radius: 0 3px 3px 0;
  -moz-border-radius: 0 3px 3px 0;
  border-radius: 0 3px 3px 0;
  height: 32px;
  width: 33px;
  /*margin-top: 20px;*/
}

.select2.select2-container.select2-container--open .select2-selection.select2-selection--single {
  background: #f8f8f8;
}

.select2.select2-container.select2-container--open .select2-selection.select2-selection--single .select2-selection__arrow {
  -webkit-border-radius: 0 3px 0 0;
  -moz-border-radius: 0 3px 0 0;
  border-radius: 0 3px 0 0;
}

.select2.select2-container.select2-container--open .select2-selection.select2-selection--multiple {
  border: 1px solid #34495e;
}

.select2.select2-container.select2-container--focus .select2-selection {
  border: 1px solid #34495e;
}

.select2.select2-container .select2-selection--multiple {
  height: auto;
  min-height: 34px;
}

.select2.select2-container .select2-selection--multiple .select2-search--inline .select2-search__field {
  margin-top: 0;
  height: 32px;
}

.select2.select2-container .select2-selection--multiple .select2-selection__rendered {
  display: block;
  padding: 0 4px;
  line-height: 29px;
}

.select2.select2-container .select2-selection--multiple .select2-selection__choice {
  background-color: #f8f8f8;
  border: 1px solid #ccc;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  margin: 4px 4px 0 0;
  padding: 0 6px 0 22px;
  height: 24px;
  line-height: 24px;
  font-size: 12px;
  position: relative;
}

.select2.select2-container .select2-selection--multiple .select2-selection__choice .select2-selection__choice__remove {
  position: absolute;
  top: 0;
  left: 0;
  height: 22px;
  width: 22px;
  margin: 0;
  text-align: center;
  color: #e74c3c;
  font-weight: bold;
  font-size: 16px;
}

.select2-container .select2-dropdown {
  background: transparent;
  border: none;
  margin-top: -5px;
}

.select2-container .select2-dropdown .select2-search {
  padding: 0;
}

.select2-container .select2-dropdown .select2-search input {
  outline: none;
  border: 1px solid #34495e;
  border-bottom: none;
  padding: 4px 6px;
}

.select2-container .select2-dropdown .select2-results {
  padding: 0;
}

.select2-container .select2-dropdown .select2-results ul {
  background: #fff;
  border: 1px solid #34495e;
}

.select2-container .select2-dropdown .select2-results ul .select2-results__option--highlighted[aria-selected] {
  background-color: #3498db;
}

.big-drop {
  width: 600px !important;
}

.form-control:disabled, .form-control[readonly] {
    background-color: #ffffff !important;
    opacity: 1;
}

</style>




<?php $__env->startSection('content'); ?>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="<?php echo e(route('outlet_stockexpiry.store')); ?>" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('post'); ?>

            <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">add_task</i>
                </div>
                <h4 class="card-title"><?php echo e(__('Outlet Stock Expiry')); ?></h4>
               </div>
              
              <div class="card-body ">

                <?php

                    $parameter= Crypt::decrypt(Request::segment(2));

                ?>
              
                <div class="row">
                  <div class="col-md-12 text-right">
                       <a href="<?php echo e(route('c-activity',['id' => $parameter ])); ?>" title="Back to Activity" class="btn btn-sm btn-rose"><i class="fa fa-arrow-left"> Back</i></a>
                   </div>
                 </div>
                
                <div class="row" hidden="">
                   <label class="col-sm-2 col-form-label"><?php echo e(__('Outlet id')); ?></label>
                  <div class="col-sm-4">
                    <div class="form-group<?php echo e($errors->has('timesheet_id') ? ' has-danger' : ''); ?>">
                     
                    <input class="form-control<?php echo e($errors->has('timesheet_id') ? ' is-invalid' : ''); ?>" name="timesheet_id" id="input-timesheet_id" type="text" placeholder="<?php echo e(__('Timesheet Id')); ?>" value="<?php echo e(old('timesheet_id',$parameter)); ?>"  aria-required="true"/ readonly="">
                    
                      <?php echo $__env->make('alerts.feedback', ['field' => 'timesheet_id'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                   </div>
                 
                </div>

                 <div class="row">

                  <label class="col-sm-2 col-form-label"><?php echo e(__('Product')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('product_id') ? ' has-danger' : ''); ?>">
                    
                      <select class="form-control js-select2" name="product_id" id="input-product_id" 
                        value="<?php echo e(old('product_id')); ?>" >
                             
                               <option value="">Select product / Zrep / Sku / Barcode</option>
                               <?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($product->product_id); ?>"> <?php echo e($product->p_name); ?> / <?php echo e($product->zrep_code); ?> / <?php echo e($product->sku); ?> / <?php echo e($product->barcode); ?> </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>

                     <?php echo $__env->make('alerts.feedback', ['field' => 'product_id'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                
                    </div>
                  </div>

                </div>

                 <div class="row">
                   <label class="col-sm-2 col-form-label"><?php echo e(__('BarCode')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('barcode') ? ' has-danger' : ''); ?>">
                     
                    <input class="form-control<?php echo e($errors->has('barcode') ? ' is-invalid' : ''); ?>" name="barcode" 
                    id="input-barcode" type="number" step=any placeholder="<?php echo e(__('')); ?>" 
                    value=""  aria-required="true"/ readonly>
                    
                      <?php echo $__env->make('alerts.feedback', ['field' => 'barcode'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                   </div>
                 
                </div>
                
              <!--    <div class="row">
                   <label class="col-sm-2 col-form-label"><?php echo e(__('Piece Price')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('piece_price') ? ' has-danger' : ''); ?>">
                     
                    <input class="form-control<?php echo e($errors->has('piece_price') ? ' is-invalid' : ''); ?>" name="piece_price" 
                    id="input-piece_price" type="number" step=any placeholder="<?php echo e(__('')); ?>" 
                    value="<?php echo e(old('piece_price')); ?>"  aria-required="true"/>
                    
                      <?php echo $__env->make('alerts.feedback', ['field' => 'piece_price'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                   </div>
                 
                </div> -->

                <div class="row">
                   <label class="col-sm-2 col-form-label"><?php echo e(__('Near Expiry in Pieces')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('near_expiry') ? ' has-danger' : ''); ?>">
                     
                    <input class="form-control<?php echo e($errors->has('near_expiry') ? ' is-invalid' : ''); ?>" name="near_expiry" 
                    id="input-near_expiry" type="number" placeholder="<?php echo e(__('')); ?>" 
                    value="<?php echo e(old('near_expiry')); ?>"  aria-required="true"/>
                    
                      <?php echo $__env->make('alerts.feedback', ['field' => 'near_expiry'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                   </div>
                 
                </div>

               <!--   <div class="row">
                  
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Total Available Cases')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('total_available_cases') ? ' has-danger' : ''); ?>">
                     
                    <input class="form-control<?php echo e($errors->has('total_available_cases') ? ' is-invalid' : ''); ?>" name="total_available_cases" 
                    id="input-total_available_cases" type="number" placeholder="<?php echo e(__('')); ?>" 
                    value="<?php echo e(old('total_available_cases')); ?>"  aria-required="true"/>
                    
                      <?php echo $__env->make('alerts.feedback', ['field' => 'total_available_cases'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div> -->
                
                <!--   <div class="row">
                   <label class="col-sm-2 col-form-label"><?php echo e(__('Total Available Pieces')); ?></label>
                   <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('total_available_pieces') ? ' has-danger' : ''); ?>">
                      <input class="form-control<?php echo e($errors->has('total_available_pieces') ? ' is-invalid' : ''); ?>" name="total_available_pieces" 
                      id="input-total_available_pieces" type="number" placeholder="<?php echo e(__('')); ?>" 
                      value="<?php echo e(old('total_available_pieces')); ?>"  aria-required="true"/>
                      <?php echo $__env->make('alerts.feedback', ['field' => 'total_available_pieces'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                
                </div> -->

                <div class="row">
                 
                    <label class="col-sm-2 col-form-label"><?php echo e(__('Expiry Date')); ?></label>
                    <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('expiry_date') ? ' has-danger' : ''); ?>">
                      <input class="form-control datepicker<?php echo e($errors->has('expiry_date') ? ' is-invalid' : ''); ?>" name="expiry_date" id="input-expiry_date" type="text" placeholder="<?php echo e(__('')); ?>" value="<?php echo e(old('expiry_date')); ?>"  aria-required="true"/>
                      <?php echo $__env->make('alerts.feedback', ['field' => 'expiry_date'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div>

                 <div class="row">
                   <label class="col-sm-2 col-form-label"><?php echo e(__('Exposure Qty (Will Expire)')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('exposure_qty') ? ' has-danger' : ''); ?>">
                     
                    <input class="form-control<?php echo e($errors->has('exposure_qty') ? ' is-invalid' : ''); ?>" name="exposure_qty" 
                    id="input-exposure_qty" type="number" placeholder="<?php echo e(__('')); ?>" 
                    value="<?php echo e(old('exposure_qty')); ?>"  aria-required="true"/>
                    
                      <?php echo $__env->make('alerts.feedback', ['field' => 'exposure_qty'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                   </div>
                 
                </div>
                
                <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Remarks')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('remarks') ? ' has-danger' : ''); ?>">
                      <input class="form-control<?php echo e($errors->has('remarks') ? ' is-invalid' : ''); ?>" name="remarks" id="input-remarks" type="text" placeholder="<?php echo e(__('')); ?>" value="<?php echo e(old('remarks')); ?>"  aria-required="true"/>
                      <?php echo $__env->make('alerts.feedback', ['field' => 'remarks'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
               
                </div>
              
                
              
                
                
               
                
                <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-rose text-center"><?php echo e(__('Add')); ?></button>
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

    $(".js-select2").select2();
      $(".js-select2-multi").select2();

      $(".large").select2({
        dropdownCssClass: "big-drop",
      });

      $('#input-product_id').on('change', function() {
          //alert( $( "#input-product_id option:selected" ).text() );
          var full_text = $( "#input-product_id option:selected" ).text();
          var last = full_text.substring(full_text.lastIndexOf("/") + 1, full_text.length);
          //alert(last);
          $("#input-barcode").val(parseInt(last));

          
      });

 $(document).ready(function () {
      
      $(".datepicker").datetimepicker({
        format: 'DD-MM-YYYY',
        useCurrent: false
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


<?php echo $__env->make('layouts.app', ['activePage' => 'journey-plan', 'menuParent' => 'Journey-Plan', 'titlePage' => __('Customer Activity')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thethethoughtfactory/Desktop/RMS-2-11-21/resources/views/outlet_stockexpiry/create.blade.php ENDPATH**/ ?>