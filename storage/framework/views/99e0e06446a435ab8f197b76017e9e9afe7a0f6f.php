<style>
/*.sorting_disabled {
    display:block !important;
}*/
.display-block{
     display:table-cell !important;
}
.btn-action{
     padding: 0px 0px !important;
}
.view-edit{
  padding: 10px 15px !important;
  margin: 0.3125rem 1px !important;
}

 .borderless tr, .borderless td, .borderless th {
    border: none !important;
   }

   .select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #444;
    line-height: 28px;
    margin-right: 122px;
}

</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css"></link>



<?php $__env->startSection('content'); ?>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">group</i>
                </div>
                <h4 class="card-title"><?php echo e(__('Employee Reporting To')); ?></h4>
              </div>	
              <div class="card-body">


              <div class="row">
                    <div class="col-lg-12">

                    <form method="post" class="form-inline" enctype="multipart/form-data" action="" autocomplete="off" style="text-align: right;">
              <?php echo csrf_field(); ?>
              <?php echo method_field('post'); ?>
                <div class="col-lg-3">
                    
                         <select class="form-control selectpicker"  data-style="select-with-transition" title="Select Employee" data-size="7" name="employee_id" id="input-employee_id"  value="<?php echo e(old('employee_id')); ?>" aria-required="true" >
                    
                        <option value="" selected >Select Type</option>
                        <option value="field_manager" >  Field Manager</option>
                        <option value="merchandiser" >Merchandiser</option>
                        <option value="hr" >Human Resource</option> 
                   
                        <!-- <?php $__currentLoopData = $employee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($emp->employee_id); ?>" >   
                              <?php echo e($emp->employee->first_name); ?>

                              <?php echo e($emp->employee->middle_name); ?> 
                              <?php echo e($emp->employee->surname); ?> 
                              (<?php echo e($emp->employee_id); ?>)</option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> -->
                         
                      </select>
                   
                     
                   </div>
                     <div class="col-lg-7">
                    
                          <select class="abcd"  data-style="select-with-transition" 
                          title="Select Employee Reporting To" data-size="7" name="reporting_to_emp_id" id="input-reporting_to_emp_id"  
                          value="<?php echo e(old('reporting_to_emp_id')); ?>" aria-required="true" >
                    
                        <option value="" selected >Select</option>
                   
                        <!-- <?php $__currentLoopData = $employee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($emp->reporting_to_emp_id); ?>" >   
                              <?php echo e($emp->employee_reporting_to->first_name); ?>

                              <?php echo e($emp->employee_reporting_to->middle_name); ?> 
                              <?php echo e($emp->employee_reporting_to->surname); ?> 
                              (<?php echo e($emp->reporting_to_emp_id); ?>)</option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> -->
                         
                      </select>
                   
                     
                   </div>

                   <div class="col-lg-2">
                    <b><button id="BtnSearch" type ="submit" class="btn btn-info btn-sm ">Filter</button></b>
                 </div> 
                   
                 </div> 
              </form>
                      <!-- <a class="btn btn-sm btn-warning" style="color: #fff;" data-toggle="modal" data-target="#FilterModal" ><?php echo e(__('Filter')); ?></a> -->
                    </div>
                  </div>
                  <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['isHuman_Resource','isAdmin','isTopManagement'],App\User::class)): ?>
                  <div class="row">
                    <div class="col-12 text-right">
                      <a href="<?php echo e(route('employee-reporting.create')); ?>" class="btn btn-sm btn-rose"><?php echo e(__('Add Reporting')); ?></a>
                    </div>
                  </div>
                <?php endif; ?>
                <div class="table-responsive">
                  <table id="datatables" class="table table-striped table-no-bordered table-hover" style="display:none">
                    <thead class="text-primary">
                      <th>
                          <?php echo e(__('Employee')); ?>

                      </th>
                      <th>
                          <?php echo e(__('Reporting_To')); ?>

                      </th>
                     
                       <th>
                          <?php echo e(__('Reporting Date')); ?>

                      </th>
                       <th>
                          <?php echo e(__('Reporting End Date')); ?>

                      </th>
                      
                     
                      <th class="display-block">
                            <?php echo e(__('Action')); ?>

                        </th>

                     
                    </thead>
                    <tbody>

                      <?php

                        $i=0

                      ?>


                    
                      <?php $__currentLoopData = $employee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     
                        <tr>
                         
                        <td>
                        <a rel="tooltip" style="font-size:15px;font-weight:700" class="btn btn-danger btn-action btn-link view-edit" data-toggle="modal" 
                        data-target="#exampleModal" data-original-title="" title="" onclick="view_employee('<?php echo e($emp->employee->employee_id); ?>')">
                       
                          <?php echo e($emp->employee->first_name.' '.$emp->employee->middle_name.' '.$emp->employee->surname); ?>

                          (<?php echo e($emp->employee->employee_id); ?>)
                                          <div class="ripple-container"></div></a>
                          </td>
                          <td>
                          <a rel="tooltip" style="font-size:15px;font-weight:700" class="btn btn-warning btn-action btn-link view-edit" data-toggle="modal" 
                        data-target="#exampleModal" data-original-title="" title="" onclick="view_employee('<?php echo e($emp->employee_reporting_to->employee_id); ?>')">
                            <?php echo e($emp->employee_reporting_to->first_name.' '.$emp->employee_reporting_to->middle_name.
                            ' '.$emp->employee_reporting_to->surname); ?>

                            (<?php echo e($emp->employee_reporting_to->employee_id); ?>)
                            <div class="ripple-container"></div></a>
                          </td>
                         <!-- <td>
                            <?php echo e($emp->employee->designation); ?>

                          </td>
                          <td>
                            <?php echo e($emp->employee->department); ?>

                          </td>
                          <td>
                            <?php echo e($emp->reporting_to_emp_id); ?>

                          </td>-->
                          <td>
                            <?php echo e(date('d-m-Y', strtotime($emp->reporting_date))); ?> 
                          </td>
                          <td>
                            <?php echo e(date('d-m-Y', strtotime($emp->reporting_end_date))); ?> 
                          </td>
                          
                          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['isHuman_Resource','isAdmin','isTopManagement'],App\User::class)): ?>

<td class="display-block">
    <form action="<?php echo e(route('employee-reporting.destroy', $emp->id )); ?>" method="post">
              <?php echo csrf_field(); ?>
              <?php echo method_field('delete'); ?>
              
            <a rel="tooltip" class="btn btn-success btn-action btn-link view-edit" href="<?php echo e(route('employee-reporting.edit', 
              $emp->id )); ?>" data-original-title="" title="">
                  <i class="material-icons">edit</i>
                  <div class="ripple-container"></div>
                </a>
            
                <button type="button" class="btn btn-danger btn-link view-edit" data-original-title="" title="" onclick="confirm('<?php echo e(__("Are you sure you want to delete this leave request?")); ?>') ? this.parentElement.submit() : ''">
                    <i class="material-icons">close</i>
                    <div class="ripple-container"></div>
                </button>
            
          </form>
      </td> 
      <?php endif; ?>


                        </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade bd-example-modal-lg" id="exampleModal"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">More Information</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form>

          <div class="row">
            <div class="col-lg-6">

              <table class="table table-responsive borderless" >
                <tr>
                  <th>Passport Number </th>
                  <td id="passport_no"></td>
                </tr>
                 <tr>
                  <th>Nationality </th>
                  <td id="nationality"></td>
                </tr>
                 <tr>
                  <th>Joining Date  </th>
                  <td id="joining_date"></td>
                </tr>
                 <tr>
                  <th>Passport Expiry Date  </th>
                  <td id="passport_exp_date"></td>
                </tr>
                 <tr>
                  <th>Visa Expiry Date  </th>
                  <td id="visa_exp_date"></td>
                </tr>
               
              </table>

            </div>

             <div class="col-lg-6">
              <table class="table table-responsive borderless">
                <tr>
                  <th>Medical Insurance No. </th>
                  <td id="medical_ins_no"></td>
                </tr>
                <tr>
                  <th>Medical Insurance Expiry Date </th>
                  <td id="medical_ins_exp_date"></td>
                </tr>
                 <tr>
                  <th>Visa Company Name </th>
                  <td id="visa_campany_name"></td>
                </tr>
                 <!-- <tr>
                  <th>Employee Score  </th>
                  <td id="employee_score"></td>
                </tr> -->
               
               
              </table>
            </div>
          </div>


          
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      
      </div>
    </div>
  </div>
</div>

<!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">More Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Passport Number:</label> <span for="recipient-name" class="col-form-label"></span>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Nationality:</label><span for="recipient-name" class="col-form-label"></span>
          </div>
           <div class="form-group">
            <label for="message-text" class="col-form-label">Joining Date:</label><span for="recipient-name" class="col-form-label"></span>
          </div>
           <div class="form-group">
            <label for="message-text" class="col-form-label">Message:</label><span for="recipient-name" class="col-form-label"></span>
          </div>
           <div class="form-group">
            <label for="message-text" class="col-form-label">Message:</label><span for="recipient-name" class="col-form-label"></span>
          </div>
           <div class="form-group">
            <label for="message-text" class="col-form-label">Visa Expiry Date:</label><span for="recipient-name" class="col-form-label"></span>
          </div>
           <div class="form-group">
            <label for="message-text" class="col-form-label">Passport Expiry Date:</label><span for="recipient-name" class="col-form-label"></span>
          </div>
           <div class="form-group">
            <label for="message-text" class="col-form-label">Medical Insurance No.:</label><span for="recipient-name" class="col-form-label"></span>
          </div>
           <div class="form-group">
            <label for="message-text" class="col-form-label">Medical Insurance Expiry Date:</label><span for="recipient-name" class="col-form-label"></span>
          </div>
           <div class="form-group">
            <label for="message-text" class="col-form-label">Visa Company Name:</label><span for="recipient-name" class="col-form-label"></span>
          </div>
           <div class="form-group">
            <label for="message-text" class="col-form-label">Employee Score:</label><span for="recipient-name" class="col-form-label"></span>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      
      </div>
    </div>
  </div>
</div> -->

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.full.min.js"></script>
  <script>

$(function () {
  $("#input-reporting_to_emp_id").select2(
    {
    width: '100%',
    allowClear: false,
    height: '100%',
}
  );
});
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    

    $(document).ready(function() {
      $('#datatables').fadeIn(1100);
      $('#datatables').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
        ],
        responsive: true,
        language: {
          search: "_INPUT_",
          searchPlaceholder: "Search employees",
        }

      });
    });

    function view_employee(id){
      //alert(id);
      var csrf = $('meta[name="csrf-token"]').attr('content');
      $.ajax({
          url: '/view_employee',
          type: 'GET',
          data: {id : id, '_token': csrf},
          dataType: 'json',

          success: function( data ) {
             alert(data);

             // alert(JSON.stringify(data[0]['id']));

            $("#passport_no").html(': '+data[0]['passport_number']);
            $("#nationality").html(': '+data[0]['nationality']);
            $("#joining_date").html(': '+data[0]['joining_date'])
            $("#visa_exp_date").html(': '+data[0]['visa_exp_date'])
            $("#passport_exp_date").html(': '+data[0]['passport_exp_date'])
            $("#medical_ins_no").html(': '+data[0]['medical_ins_no'])
            $("#medical_ins_exp_date").html(': '+data[0]['medical_ins_exp_date'])
            $("#visa_campany_name").html(': '+data[0]['visa_company_name'])
            $("#employee_score").html(': '+data[0]['employee_score'])

          }       
      })

    }
    


    $('#input-employee_id').change(function(e) { 
     // {
        e.preventDefault();
     
      var SITEURL = "<?php echo e(url('/')); ?>";
    
          var emp_type = $('#input-employee_id').val();  
        //  alert(emp_type);
          var csrf = $('meta[name="csrf-token"]').attr('content');
        //  alert(csrf);
            $.ajax({
            url: SITEURL + '/get_merchandiser_for_reportingto', 
            type: 'GET',
            data: { emp_type : emp_type, '_token': csrf },
            dataType: 'json',
        
           success: function( data ) { 
            
             var  response = JSON.stringify(data); 
           //  alert(response);
      $('#input-reporting_to_emp_id').find('option').remove().end().append('<option value="">select</option>');

     //$("#input-reporting_to_emp_id").append('<option value="">select<option>');
         var trHTML = '';
         $.each(data, function (i, item) {  // alert(item.first_name );
             trHTML += '<option value="' + item.employee_id  + '">(' + item.employee_id  + ') ' + item.first_name  + '  ' + item.surname  + ' </option>';
         });

        
//alert(trHTML);
          $("#input-reporting_to_emp_id").append(trHTML);

       
            }       
        })
     });

     $('#BtnSearch').click(function (e)
     {
      e.preventDefault(); //alert();
      var SITEURL = "<?php echo e(url('/')); ?>";
          var Empid = $('#input-reporting_to_emp_id').val();

          var type = $('#input-employee_id').val();
          var csrf = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
            url: SITEURL + '/get_result_for_reportingto', 
            type: 'GET',
            data: {Empid : Empid, type : type, '_token': csrf},
            dataType: 'json',

            success: function( data ) {
              // alert(data);

               $('#datatables tbody').empty();
             var  response = JSON.stringify(data); 
       //   alert(response);
             
               var trHTML = '';
        $.each(data, function (i, item) {  
            trHTML += '<tr><td>(' + item.employee_id  + ') ' + item.employee.first_name  + ' ' + item.employee.surname  + ' </td>';
            trHTML += '<td>(' + item.reporting_to_emp_id  + ') ' + item.employee_reporting_to.first_name  + ' ' + item.employee_reporting_to.surname  + ' </td>';
            trHTML += '<td>' + item.reporting_date  + ' </td>';
            trHTML += '<td>' + item.reporting_end_date  + ' </td>';
          //  trHTML += '<td>';
          //  trHTML += "<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['isHuman_Resource','isAdmin','isTopManagement'],App\User::class)): ?>";

            trHTML +=  '<td class="display-block">';  
                    trHTML += '<form action="<?php echo e(route("employee-reporting.destroy", ' + item.employee_id  + ' )); ?>" method="post">';
                  trHTML +=  '<?php echo csrf_field(); ?>';
                  trHTML +=  '<?php echo method_field('delete'); ?>';
        // alert(item.employee_id);
        var route = SITEURL + "/employee-reporting/" + item.id + "/edit";
                  trHTML += '<a rel="tooltip" class="btn btn-success btn-action btn-link view-edit" href="'+ route +'" data-original-title="" title="">';
                    trHTML +=    '<i class="material-icons">edit</i>';
                    trHTML +=   '<div class="ripple-container"></div>';
                    trHTML +=    '</a>';
          var route_del = SITEURL + "/employee-reporting/" + item.id + "/destroy";
             trHTML +=  '<button rel="tooltip" class="btn btn-success btn-action btn-link view-edit" data-original-title="" title="">';
             trHTML +=   '<i class="material-icons">close</i>';
           //  trHTML +=   '<div class="ripple-container"></div>';
       //      trHTML +=  '<div class="ripple-container"></div></button>';
             // "<button type='button' class='btn btn-danger btn-link view-edit'  />";
             //  "<button type="button" class="btn btn-danger btn-link view-edit" data-original-title="" title="" onclick="confirm("<?php echo e(__("Are you sure you want to delete this leave request?")); ?>") ? this.parentElement.submit() : '">";
                //    trHTML +=    '<i class="material-icons">close</i>';
                    trHTML +=    '<div class="ripple-container"></div>';
                    trHTML +=  '</button>';
            
                    trHTML +=  '</form>';
                    trHTML += "<?php endif; ?>";
          
            trHTML += '</td></tr>';

        });

        $('#datatables').dataTable().fnClearTable();
    $('#datatables').dataTable().fnDraw();
    $('#datatables').dataTable().fnDestroy();



        $("#datatables tbody").append(trHTML);

        $('#datatables').fadeIn(1100);
      $('#datatables').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
        ],
        responsive: true,
        language: {
          search: "_INPUT_",
          searchPlaceholder: "Search employees",
        }

      });
       
            //  swal("Success!", "updated successfully!", "success");
              // alert(JSON.stringify(data[0]['id']));

          //   $("#passport_no").html(': '+data[0]['passport_number']);
            //  $("#nationality").html(': '+data[0]['nationality']);
              
            }       
        })
     });




//      $('#input-employee_id').change(function(e) { 
//      // {
//         e.preventDefault();
     
//       var SITEURL = "<?php echo e(url('/')); ?>";
    
//           var emp_type = $('#input-employee_id').val();  
//          // alert(emp_type);
//           var csrf = $('meta[name="csrf-token"]').attr('content');
//         //  alert(csrf);
//             $.ajax({
//             url: SITEURL + '/get_merchandiser_for_reportingto', 
//             type: 'GET',
//             data: { emp_type : emp_type, '_token': csrf },
//             dataType: 'json',
        
//            success: function( data ) { 
            
//              var  response = JSON.stringify(data); 
//             //  alert(response);
//       $('#input-reporting_to_emp_id').find('option').remove().end().append('<option value="">select</option>');

//      //$("#input-reporting_to_emp_id").append('<option value="">select<option>');
//          var trHTML = '';
//          $.each(data, function (i, item) {  // alert(item.first_name );
//              trHTML += '<option value="' + item.employee_id  + '">(' + item.employee_id  + ') ' + item.first_name  + '  ' + item.surname  + ' </option>';
//          });
// //alert(trHTML);
//           $("#input-reporting_to_emp_id").append(trHTML);

       
//             }       
//         })
//      });


  </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', ['activePage' => 'employee-reporting', 'menuParent' => 'Employee', 'titlePage' => __('Employee Reporting-to')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thethethoughtfactory/Desktop/RMS-2-11-21/resources/views/employee/reporting-to/index.blade.php ENDPATH**/ ?>