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
          <form method="post" action="<?php echo e(route('schedule-outlets.store')); ?>" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('post'); ?>

            <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">schedule</i>
                </div>
                <h4 class="card-title"><?php echo e(__('Scheduled Timesheet')); ?></h4>
              </div>
              <div class="card-body ">

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['isField_Manager'],App\User::class)): ?>
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="<?php echo e(url('follow_timesheet')); ?>" class="btn btn-sm btn-warning"><?php echo e(__('Follow Timesheet')); ?></a>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="<?php echo e(route('import_timesheet')); ?>" class="btn btn-sm btn-info"><?php echo e(__('Import Timesheet')); ?></a>
                  </div>
                </div>
                <?php endif; ?>

                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="<?php echo e(route('schedule-outlets.index')); ?>" class="btn btn-sm btn-rose"><?php echo e(__('Back to Scheduled Timesheet')); ?></a>
                  </div>
                </div>
                
            <!--      <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('EmployeeId')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('employeeid') ? ' has-danger' : ''); ?>">
                      <input class="form-control<?php echo e($errors->has('employeeid') ? ' is-invalid' : ''); ?>" name="employeeid" id="input-employeeid" type="text" placeholder="<?php echo e(__('Employeeid')); ?>" value="<?php echo e(old('employeeid')); ?>"  aria-required="true"/>
                      <?php echo $__env->make('alerts.feedback', ['field' => 'employeeid'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div>-->
                
                <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Merchandiser')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('merchandiser') ? ' has-danger' : ''); ?>">
		            

                   <select class="form-control js-select2" data-style="select-with-transition" title="Select Merchandiser" data-size="7" name="merchandiser" id="merchandiser" 
                     value="<?php echo e(old('merchandiser')); ?>" aria-required="true" required >
                     
                    <option value="">Select</option>
                        <?php $__currentLoopData = $merchandisers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $merchants): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($merchants->employee_id); ?>"> <?php echo e($merchants->first_name); ?> <?php echo e($merchants->middle_name); ?> <?php echo e($merchants->surname); ?> (<?php echo e($merchants->employee_id); ?>)</option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </select>
                    
                    
                     <?php echo $__env->make('alerts.feedback', ['field' => 'merchandiser'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    </div>
                  </div>
                </div>

                 <!-- <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Type')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('type') ? ' has-danger' : ''); ?>">
                    
                  <select class="form-control<?php echo e($errors->has('type') ? ' is-invalid' : ''); ?>" name="type" id="input-type" value="<?php echo e(old('type')); ?>" aria-required="true"  >
                       <option value="" disabled selected>Select</option>
                       <option value="1">Scheduled</option>
                       <option value="0">Unscheduled</option>
                  </select>
                   
                     <?php echo $__env->make('alerts.feedback', ['field' => 'type'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div>  -->

                <div class="row select_margin">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Year')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('year') ? ' has-danger' : ''); ?>">
                    

                     <select class="form-control selectpicker" data-style="select-with-transition" title="Select Year" data-size="7" name="year" id="year" 
                     value="<?php echo e(old('year')); ?>" aria-required="true" required >
                     
                     <option value="" disabled> Select Year</option>
                     
                      <option  value="2021"> 2021 </option>
                      <!-- <option  value="Mon"> Monday </option> -->
                    </select>
                    
                      <?php echo $__env->make('alerts.feedback', ['field' => 'year'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div>          
              
                
                <div class="row select_margin">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Month')); ?></label>
                  <div class="col-sm-7">
                   <select class="form-control selectpicker" data-style="select-with-transition" title="Select Month" data-size="7" name="month[]" id="select-month" 
                     value="<?php echo e(old('month')); ?>" aria-required="true" required multiple="multiple">
                      <option value="" disabled> Select Multiple</option>

                      <option value="January" <?php if(old('month')=="January"): ?> <?php echo e('selected'); ?> <?php endif; ?> >January</option>
                      <option value="February" <?php if(old('month')=="February"): ?>) <?php echo e('selected'); ?> <?php endif; ?>  >February</option>
                      <option value="March" <?php if(old('month')=="March"): ?>) <?php echo e('selected'); ?> <?php endif; ?> >March</option>
                      <option value="April" <?php if(old('month')=="April"): ?>) <?php echo e('selected'); ?> <?php endif; ?> >April</option>
                      <option value="May" <?php if(old('month')=="May"): ?>) <?php echo e('selected'); ?> <?php endif; ?> >May</option>
                      <option value="June" <?php if(old('month')=="June"): ?>) <?php echo e('selected'); ?> <?php endif; ?> >June</option>
                      <option value="July" <?php if(old('month')=="July"): ?>) <?php echo e('selected'); ?> <?php endif; ?> >July</option>
                      <option value="August" <?php if(old('month')=="August"): ?>) <?php echo e('selected'); ?> <?php endif; ?> >August</option>
                      <option value="September" <?php if(old('month')=="September"): ?>) <?php echo e('selected'); ?> <?php endif; ?> >September</option>
                      <option value="October" <?php if(old('month')=="October"): ?>) <?php echo e('selected'); ?> <?php endif; ?> >October</option>
                      <option value="November" <?php if(old('month')=="November"): ?>) <?php echo e('selected'); ?> <?php endif; ?> >November</option>
                      <option value="December" <?php if(old('month')=="December"): ?>) <?php echo e('selected'); ?> <?php endif; ?> >December</option>    

                    </select>
                     <?php echo $__env->make('alerts.feedback', ['field' => 'month'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                  </div>
                </div>
                
            
     		    <div class="row select_margin" >
                <label class="col-sm-2 col-form-label"><?php echo e(__('Days')); ?></label>
                 <div class="col-lg-7 col-md-6 col-sm-3">
                    <select class="form-control selectpicker" data-style="select-with-transition" multiple title="Select days" data-size="7" name="days[]" id="input_days" 
                     value="<?php echo e(old('days')); ?>" aria-required="true" multiple="multiple" required>
                      <option value="" disabled> Multiple Days</option>
                     
                      <option id="sunday" value="Sun"> Sunday </option>
                      <option id="monday" value="Mon"> Monday </option>
                      <option id="tuesday" value="Tue"> Tuesday </option>
                      <option id="wednesday" value="Wed"> Wednesday </option>
                      <option id="thusday" value="Thu"> Thursday </option>
                      <option id="friday" value="Fri"> Friday </option>
                      <option id="saturday" value="Sat" > Saturday </option>
                       
                    </select>
                     <?php echo $__env->make('alerts.feedback', ['field' => 'days'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                  </div>
                </div> 

              
                 <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Outlets')); ?></label>
                 <div class="col-lg-7 col-md-6 col-sm-3">
                    
                     <select class="form-control js-select2-multi" data-style="select-with-transition"  title="Select Outlet" data-size="7" name="outlets[]" id="input_outlets" 
                     value="<?php echo e(old('outlets')); ?>" placeholder="Select Outlets" aria-required="true" required multiple >

                      <option value="" disabled=""> Select Outlets</option>
                      <?php $__currentLoopData = $outlets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $outlet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($outlet->outlet_id); ?>"> <?php echo e($outlet->store[0]->store_code); ?> - <?php echo e($outlet->store[0]->store_name); ?> - <?php echo e($outlet->outlet_area); ?> - <?php echo e($outlet->outlet_city); ?> </option> 
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                     <?php echo $__env->make('alerts.feedback', ['field' => 'outlets'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                  </div>
                </div> 

                  

              </div> 
                
         
                <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-rose"><?php echo e(__('Save')); ?></button>
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

    $(".js-select2-multi").select2({
        placeholder: "Select Outlets"
    });

 $(function () {
                  
    $('.datepicker').datetimepicker({
         // viewMode : 'week',
          format : 'ddd',
          toolbarPlacement: "top",
          allowInputToggle: true,
          useCurrent: false,
    }); 


  });
  
    $(document).ready(function() {
  
    // initialise Datetimepicker and Sliders
  
      md.initFormExtendedDatetimepickers();
         
      if ($('.slider').length != 0) {
      
        md.initSliders();
      } 
      
    }); 


      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


  //   $('#select-month').on('change', function(e) {
  //    // alert( this.value );

  //    var month = $(e.target).val();

  //    //alert(month);

  //     var employee_id = $("#merchandiser").val();

  //     var year = $("#year").val();
  //    // var month = this.value;
  //      var csrf = $('meta[name="csrf-token"]').attr('content');

  //     if(employee_id !=="" && year !=="" && month !=="") 
  //     {
  //       //alert();
  //     $.ajax({
  //         url: '/get_weekoff_days',
  //         type: 'GET',
  //         data: {month : month, year : year, emp_id : employee_id, '_token': csrf},
  //         dataType: 'json',

  //         success: function( data ) {
  //            //alert(data);

  //            $('#sunday').prop('disabled', false);
  //            $('#monday').prop('disabled', false);
  //            $('#tuesday').prop('disabled', false);
  //            $('#wednesday').prop('disabled', false);
  //            $('#thusday').prop('disabled', false);
  //            $('#friday').prop('disabled', false);
  //            $('#saturday').prop('disabled', false);


  //          var day = data[0].day; 

  //           if(data[0].day == "Sunday")
  //           {

  //               $('#sunday').prop('disabled', true);

  //           }

  //           if(data[0].day == "Monday")
  //           {
                
  //              $("#monday").attr( "disabled", "disabled" );

  //           }

  //           if(data[0].day == "Tuesday")
  //           {
                
  //              $("#tuesday").attr( "disabled", "disabled" );
 
  //           }

  //           if(data[0].day == "Wednesday")
  //           {
                
  //              $("#wednesday").attr( "disabled", "disabled" );

  //           }

  //           if(data[0].day == "Thursday")
  //           {
                
  //              $("#thusday").attr( "disabled", "disabled" );

  //           }

  //           if(data[0].day == "Friday")
  //           {
                
  //              $("#friday").attr( "disabled", "disabled" );

  //           }

  //           if(data[0].day == "Saturday")
  //           {
                
  //              $("#saturday").attr( "disabled", "disabled" );

  //           }

          
            
  //         }       
  //     })

  // }

  //   });

     
    
  </script>
  
 
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', ['activePage' => 'scheduled_outlets', 'menuParent' => 'Timesheets', 'titlePage' => __('Scheduled Timesheet')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thethethoughtfactory/Desktop/RMS-2-11-21/resources/views/scheduled_outlets/create.blade.php ENDPATH**/ ?>