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
  margin-top: 5px;
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
  margin-top: 5px;
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

.select_margin{
    margin-bottom: 10px;
}

</style>



<?php $__env->startSection('content'); ?>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="<?php echo e(route('outlet.store')); ?>" autocomplete="off" class="form-horizontal">
            <?php echo csrf_field(); ?>
            <?php echo method_field('post'); ?>

            <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">outlet</i>
                </div>
                <h4 class="card-title"><?php echo e(__('Add outlet')); ?></h4>
               </div>
              
              <div class="card-body ">
              
                <div class="row">
                  <div class="col-md-12 text-right">
                    <a href="/import_csv" class="btn btn-sm btn-info"><?php echo e(__('Import CSV / EXCEL')); ?></a>
                    <a href="<?php echo e(route('outlet.index')); ?>" class="btn btn-sm btn-rose"><?php echo e(__('Back to outlet')); ?></a>
                    
                  </div>
                </div>
                
                <div class="row"> 
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Outlet Name')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('outlet_name') ? ' has-danger' : ''); ?>">
               

                        <select class="form-control js-select2" data-style="select-with-transition" title="Select Store" data-size="7" name="outlet_name" id="input_days" 
                     value="<?php echo e(old('outlet_name')); ?>" aria-required="true" >
                     
                      <option value="" selected disabled>Select Store</option>
                       <?php $__currentLoopData = $store; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $str): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <option value="<?php echo e($str->id); ?>"><?php echo e($str->store_code); ?> - <?php echo e($str->store_name); ?> - <?php echo e($str->address); ?></option>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                      </select>
                   
                      <?php echo $__env->make('alerts.feedback', ['field' => 'outlet_name'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div>



               <!--  <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Product')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('product') ? ' has-danger' : ''); ?>">
                    

                     <select class="form-control selectpicker" data-style="select-with-transition" title="Select Products" data-size="7" name="product" id="input_days" 
                     value="<?php echo e(old('product')); ?>" aria-required="true" multiple="" >
                     
                      <option value="" disabled>Select Product</option>
                       <?php $__currentLoopData = $product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($pro->id); ?>"> <?php echo e($pro->product_name); ?></option>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                      </select>

                      <?php echo $__env->make('alerts.feedback', ['field' => 'product'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div> -->
                
                 <div class="row">
                   <label class="col-sm-2 col-form-label"><?php echo e(__('Outlet Latitude')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('outlet_lat') ? ' has-danger' : ''); ?>">
                     
                    <input class="form-control<?php echo e($errors->has('outlet_lat') ? ' is-invalid' : ''); ?>" name="outlet_lat" id="input-outlet_lat" type="text" placeholder="<?php echo e(__('')); ?>" value="<?php echo e(old('outlet_lat')); ?>"  aria-required="true"/>
                    
                      <?php echo $__env->make('alerts.feedback', ['field' => 'outlet_lat'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                   </div>
                  </div>
                
                <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Outlet Longtitude')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('outlet_long') ? ' has-danger' : ''); ?>">
                     
                    <input class="form-control<?php echo e($errors->has('outlet_long') ? ' is-invalid' : ''); ?>" name="outlet_long" id="input-outlet_long" type="text" placeholder="<?php echo e(__('')); ?>" value="<?php echo e(old('outlet_long')); ?>"  aria-required="true"/>
                    
                      <?php echo $__env->make('alerts.feedback', ['field' => 'outlet_long'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div>
                
                  <div class="row">
                   <label class="col-sm-2 col-form-label"><?php echo e(__('Outlet Area')); ?></label>
                   <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('outlet_area') ? ' has-danger' : ''); ?>">
                      <input class="form-control<?php echo e($errors->has('outlet_area') ? ' is-invalid' : ''); ?>" name="outlet_area" id="input-outlet_area" type="text" placeholder="<?php echo e(__('')); ?>" value="<?php echo e(old('outlet_area')); ?>"  aria-required="true"/>
                      <?php echo $__env->make('alerts.feedback', ['field' => 'outlet_area'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div>
                
                  <div class="row">
                    <label class="col-sm-2 col-form-label"><?php echo e(__('Outlet City')); ?></label>
                   <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('outlet_city') ? ' has-danger' : ''); ?>">
                      
                      <select class="form-control js-select2" data-style="select-with-transition" title="Select City" data-size="7" name="outlet_city" id="input_days" 
                     value="<?php echo e(old('outlet_city')); ?>" aria-required="true" >
                     
                      <option value="" selected disabled>Select City</option>
                      <option value="ABU DHABI">ABU DHABI </option>
                      <option value="AL AIN">AL AIN </option>
                      <option value="AL AWDAH">AL AWDAH </option>
                      <option value="AL FAHLAYN">AL FAHLAYN </option>
                      <option value="AL FULAYYAH">AL FULAYYAH </option>
                      <option value="AL FARA">AL FARA' </option>
                      <option value="AL GHABAH">AL GHABAH </option>
                      <option value="AL GHABAM">AL GHABAM </option>
                      <option value="AL GHASHBAN">AL GHASHBAN </option>
                      <option value="AL HAMRANIYAH">AL HAMRANIYAH </option>
                      <option value="AL HAMRIYAH">AL HAMRIYAH </option>
                      <option value="AL HAYBAH">AL HAYBAH </option>
                      <option value="AL HAYL">AL HAYL </option>
                      <option value="AL HAYR">AL HAYR </option>
                      <option value="AL HAYRAH">AL HAYRAH </option>
                      <option value="AL HULAYLAH">AL HULAYLAH </option>
                      <option value="AL JADDAH">AL JADDAH </option>
                      <option value="AL KHARI">AL KHARI </option>
                      <option value="AL KHASHFAH">AL KHASHFAH </option>
                      <option value="AL MAHAMM">AL MAHAMM </option>
                      <option value="AL MASAFIRAH">AL MASAFIRAH </option>
                      <option value="AL MATAF">AL MATAF </option>
                      <option value="AL MU'AMURAH">AL MU'AMURAH </option>
                      <option value="AL NASLAH">AL NASLAH </option>
                      <option value="AL QIR">AL QIR </option>
                      <option value="AL QUWAYZ">AL QUWAYZ </option>
                      <option value="AL USAYLI">AL USAYLI </option>
                      <option value="AL YAHAR">AL YAHAR </option>
                      <option value="Ar RAFA'AH">Ar RAFA'AH </option>
                      <option value="ARTHABAN">ARTHABAN </option>
                      <option value="ATHABAT">ATHABAT </option>
                      <option value="ASH SHA'M">ASH SHA'M </option>
                      <option value="AS SUR">AS SUR </option>
                      <option value="AWANAT, RAS AL-KHAIMAH">AWANAT, RAS AL-KHAIMAH </option>
                      <option value="BAQAL">BAQAL </option>
                      <option value="BIDIYAH">BIDIYAH </option>
                      <option value="DAFTAH">DAFTAH </option>
                      <option value="DHADNA">DHADNA </option>
                      <option value="DIBBA AL-FUJAIRAH">DIBBA AL-FUJAIRAH </option>
                      <option value="DIBBA AL-HISN">DIBBA AL-HISN </option>
                      <option value="DUBAI">DUBAI </option>
                      <option value="FUJAIRAH">FUJAIRAH </option>
                      <option value="KALBA">KALBA </option>
                      <option value="Kawr Fakkān">Kawr Fakkān </option>
                      <option value="Mīnā' Jabal 'Alī">Mīnā' Jabal 'Alī </option>
                      <option value="Mīnā' Şaqr">Mīnā' Şaqr </option>
                      <option value="Mīnā' Zāyid">Mīnā' Zāyid </option>
                      <option value="RAS AL-KHAIMAH">RAS AL-KHAIMAH </option>
                      <option value="UMM AL-QAIWAIN">UMM AL-QAIWAIN </option>
                      <option value="Quţūf">Quţūf </option>
                      <option value="RUWAIS">RUWAIS </option>
                      <option value="SHARJAH">SHARJAH </option>
                      <option value="SILA">SILA </option>


                      
                      </select>


                      <?php echo $__env->make('alerts.feedback', ['field' => 'outlet_city'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Outlet Emirate')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('outlet_state') ? ' has-danger' : ''); ?>">
                    
                      <select class="form-control js-select2" data-style="select-with-transition" title="Select Emirate" data-size="7" name="outlet_state" id="input_days" 
                     value="<?php echo e(old('outlet_state')); ?>" aria-required="true" >
                     
                      <option value="" selected disabled>Select Emirate</option>
                      <option value="ABU DHABI">ABU DHABI </option>
                      <option value="AJMAN">AJMAN </option>
					  <option value="AL AIN">AL AIN </option>
                      <option value="DUBAI">DUBAI </option>
                      <option value="FUJAIRAH">FUJAIRAH </option>
                      <option value="RAS AL KHAIMAH">RAS AL KHAIMAH </option>
                      <option value="SHARJAH">SHARJAH </option>
                      <option value="UMM AL QUAWIN">UMM AL QUAWIN </option>
                   
                      
                      </select>

                      <?php echo $__env->make('alerts.feedback', ['field' => 'outlet_state'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Outlet Country')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('outlet_country') ? ' has-danger' : ''); ?>">
                      <input class="form-control<?php echo e($errors->has('outlet_country') ? ' is-invalid' : ''); ?>" name="outlet_country" id="input-outlet_country" type="text" placeholder="<?php echo e(__('')); ?>" value="<?php echo e(old('outlet_country')); ?>"  aria-required="true"/>
                      <?php echo $__env->make('alerts.feedback', ['field' => 'outlet_country'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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


<?php $__env->startPush('js'); ?>
 <script>

    $(".js-select2").select2();

  </script>
  
 
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', ['activePage' => 'outlets', 'menuParent' => 'Outlets', 'titlePage' => __('Outlets')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thethethoughtfactory/Desktop/RMS-2-11-21/resources/views/outlet/create.blade.php ENDPATH**/ ?>