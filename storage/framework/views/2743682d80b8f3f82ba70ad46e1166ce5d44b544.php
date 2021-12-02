<style>
.sorting_disabled {
    display:block !important;
}
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

    .parent ~ .cchild {
    display: none;
  }
  .open .parent ~ .cchild {
    display: table-row;
  }
 /* .parent {
    cursor: pointer;
  }*/
  tbody {
    color: #212121;
  }
  .open {
    background-color: #e6e6e6;
  }

  .open .cchild {
    background-color: #999;
    color: white;
  }
  .parent > *:last-child {
    width: 30px;
  }
  .parent i {
    transform: rotate(0deg);
    transition: transform .3s cubic-bezier(.4,0,.2,1);
   /* margin: -.5rem;
    padding: .5rem;*/
   
  }
  .open .parent i {
    transform: rotate(180deg)
  }

.activity {
    padding: 5px 10px !important;

}

 .dt-buttons {
        float: right !important;
        margin-left: 20px;
        margin-right: 0px;
      }

  button.dt-button.buttons-excel.buttons-html5.btn-primary {
      border-radius: 5px;
  }

  .nav-pills .nav-item .nav-link {
  
    max-width: 80px;
}

.hidden
{
   display: none
}

</style>



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
                <h4 class="card-title"><?php echo e(__('Scheduled JourneyPlan')); ?></h4>
              </div>

              <div class="card-body">


                 <div class="row">
                    <div class="col-12 text-right">
                      <a class="btn btn-sm btn-warning" style="color: #fff;" data-toggle="modal" data-target="#FilterModal" ><?php echo e(__('Filter')); ?></a>
                    </div>
                  </div>

                  <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['isField_Manager'],App\User::class)): ?>
                    <div class="row">
                      <a id="export_timesheet" onclick="export_timesheet('xlsx')" style="color: #fff;" class="btn btn-sm btn-info ml-auto float-right" >Send To Approval</a>
                  </div>
                  <?php endif; ?>

                  <div class="row">
                     <span id="mail_sending" class="ml-auto float-right hidden" style="color: red;" >Sending please wait..</span>

                  </div>

                   
                   <?php 

                       $route = \Request::route()->getName();

                       if ($route == "filter_timesheet") 
                       {

                             $emp_id = $employee_id;
                            
                        }

                        else
                        {
                            $emp_id = '';
                        }

                     ?>

                   

                    
               
                <div class="table-responsive">
               

                    <table id="datatables" class="table table-no-bordered">    
                        <thead class="text-primary">
                         <tr>
                              <!-- <th>
                                  <?php echo e(__('#')); ?>

                              </th> -->
                               <th>
                                  <?php echo e(__('Merchandiser')); ?>

                              </th>
                              <th>
                                  <?php echo e(__('Date')); ?>

                              </th>
                             <!--  <th>
                                  <?php echo e(__('Lattitude')); ?>

                              </th>
                              <th>
                                  <?php echo e(__('Longtitude')); ?>

                              </th> -->
                             
                              <th>
                                  <?php echo e(__('Store Code')); ?>

                              </th>

                              <th>
                                  <?php echo e(__('Location')); ?>

                              </th>

                               <th>
                                  <?php echo e(__('Status')); ?>

                              </th>
                             
                          </tr>
                      </thead>

                    

                          <?php

                            $i=1;

                            $k = 1;

                            $array_parent = [];

                            $array_child = [];

                            $result = '';

                            $startDate = '2021-02-01';
                            $endDate = '2021-02-18';

                            $HowManyWeeks = (strtotime(  $endDate ) - strtotime( $startDate )) / 604800;

                            
                          ?>

                        <tbody>       

                        <?php $__currentLoopData = $outlets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                         
                         
                            <tr class="parent">
                             <!--  <td>
                                <?php echo e($i++); ?>

                              </td> -->
                               <td>
                               <?php echo e($parent->first_name); ?> <?php echo e($parent->middle_name); ?> <?php echo e($parent->surname); ?> (<?php echo e($parent->employee_id); ?>)
                              </td>
                              <td>
                                <?php echo e(date('d-m-Y', strtotime($parent->date))); ?>

                              </td>

                               <td>
                                <?php echo e($parent->store_code); ?>

                              </td>
                            
                              <td>
                                <?php echo e($parent->store_name); ?>, <?php echo e($parent->address); ?>

                              </td>
                              
                                 
                                  <?php if($parent->is_completed =='1'): ?>
                                   <td>
                                      <button class="btn btn-success activity" title="View Activity" onclick="view_activity(<?php echo e($parent->id); ?>);"> <?php echo e(__('Completed')); ?></button>
                                    </td>
                                 <?php endif; ?>
                               
                                 <?php if($parent->is_completed =='0'): ?>
                                  <!--  <td style="color: red;">
                                      <?php echo e(__('Pending')); ?>

                                    </td>-->
                                    <td>
                                      <button class="btn btn-danger activity" title="View Activity" onclick="view_activity(<?php echo e($parent->id); ?>);"> <?php echo e(__('Pending')); ?></button>
                                    </td>

                                <?php endif; ?> 
                               

                             
                            </tr>


                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                          </tbody>

                    </table>

                     
                    <div class="d-flex justify-content-center">
                        <?php echo $outlets->links(); ?>

                    </div>

                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade bd-example-modal-lg" id="FilterModal"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Filter</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  
           <form method="get" action="<?php echo e(url('filter_defined_journey')); ?>" class="form-inline" enctype="multipart/form-data" action="" autocomplete="off" style="text-align: right;">
              <?php echo csrf_field(); ?>
              <?php echo method_field('get'); ?>
          
               <div class="col-lg-6">

                 <select class="form-control js-select2" data-style="select-with-transition" title="Select Merchandiser" data-size="7" name="employee_id" id="employee_id" 
                     value="<?php echo e(old('employee_id')); ?>" aria-required="true">
 
                     <option value="" selected disabled>Select Merchandiser</option>
                        <?php $__currentLoopData = $merchandisers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $merchants): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($merchants->employee_id); ?>" <?php if($employee_id == "$merchants->employee_id" ): ?> <?php echo e('selected'); ?> <?php endif; ?>  > <?php echo e($merchants->first_name); ?> <?php echo e($merchants->middle_name); ?> <?php echo e($merchants->surname); ?> (<?php echo e($merchants->employee_id); ?>)</option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                       
                    </select>
              

               </div>

                 <div class="col-lg-6">
                    

                    <select class="form-control js-select2" data-style="select-with-transition" title="Select Outlet" data-size="7" name="outlet_id" id="outlet_id" 
                     value="<?php echo e(old('outlet_id')); ?>" aria-required="true">

                      <option value="" disabled="" selected=""> Select Outlet</option>
                      <?php $__currentLoopData = $out; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $outlet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   <option value="<?php echo e($outlet->outlet_id); ?>" <?php if($filter_outlet == $outlet->outlet_id ): ?> <?php echo e('selected'); ?> <?php endif; ?> > <?php echo e($outlet->store[0]->store_code); ?> - <?php echo e($outlet->store[0]->store_name); ?> - <?php echo e($outlet->outlet_area); ?> - <?php echo e($outlet->outlet_city); ?> </option> 
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div> 


             
                <div class="col-lg-6">
                 <input type="text" class="datepicker filter-min-with" value="<?php echo e($startdate); ?>" id="startdate" placeholder="Start Date" name="startdate">
               </div> 



                <div class="col-lg-6">
                 <input type="text" class="datepicker filter-min-with" value="<?php echo e($enddate); ?>" id="enddate" placeholder="End Date" name="enddate">
               </div> 

              
                 <div class="col-lg-6">
                    
                     <select class="form-control js-select2" data-style="select-with-transition" title="Select Status" data-size="7" name="status" id="status" 
                     value="<?php echo e(old('status')); ?>" aria-required="true">
                     
                       <option value="">Select Status</option>
                       <option value="1"  <?php if($status == "1" ): ?> <?php echo e('selected'); ?> <?php endif; ?>>Completed</option>
                       <option value="0"  <?php if($status == "0" ): ?> <?php echo e('selected'); ?> <?php endif; ?>>Pending</option>

                      </select>
                   
                    
                  </div>

                  <div class="col-lg-6">
                  </div>

            
                 <button type="submit" class="btn btn-finish btn-fill btn-rose btn-wd mx-auto d-block" name="Filter" value="Filter"><?php echo e(__('Filter')); ?></button>
               

            </form>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      
      </div>
    </div>
  </div>
</div>

 <div class="modal fade bd-example-modal-lg" id="ActivityModal"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">View Activity</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


      <div class="modal-body">

        <div class="row">

            <div class="col-lg-4">
                <label>Date:</label> <span id="checkin_date"></span>
            </div>

            <div class="col-lg-4">
                <label>CheckIn Time:</label> <span id="checkin_time"></span>
            </div>

            <div class="col-lg-4">
                <label>CheckOut Time:</label> <span id="checkout_time"></span>
            </div>

            <div class="col-lg-4">
                <label>Working Time:</label> <span id="working_time"></span>
            </div>

            <div class="col-lg-4">
                <label>Breake Time:</label> <span id="break_time"></span>
            </div>
            

        </div>

         <ul class="nav nav-pills nav-pills-warning nav-pills-icons justify-content-center" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#link1" role="tablist">
                  <i class="material-icons">info</i> Availability
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link " data-toggle="tab" href="#link2" role="tablist">
                  <i class="material-icons">visibility</i> Visibility
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#link3" role="tablist">
                  <i class="material-icons">assessment</i> Share Of Shelf
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#link4" role="tablist">
                  <i class="material-icons">receipt_long</i> Planogram
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#link5" role="tablist">
                  <i class="fa fa-percent"></i> Promotion Check
                </a>
              </li>
               <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#link6" role="tablist">
                  <i class="fa fa-copyright"></i> Competitor Info
                </a>
              </li>
            </ul>
            
            <div class="tab-content tab-space tab-subcategories">
              <div class="tab-pane active" id="link1">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">Availability of products</h4>
                    <!-- <p class="card-category">
                      More information here
                    </p> -->
                  </div>
                  <div class="card-body">

                <div class="table-responsive">
                  <table id="" class="table table-striped table-no-bordered table-hover datatable"  >
                    <thead class="text-primary">
                      <th>
                          <?php echo e(__('S.No')); ?>

                      </th>
                      <th>
                          <?php echo e(__('Item/Description')); ?>

                      </th>
                      <th>
                          <?php echo e(__('Time')); ?>

                      </th>    
                      <th>
                          <?php echo e(__('Brand')); ?>

                      </th>
                       <th>
                          <?php echo e(__('Category')); ?>

                      </th>
                      <th>
                          <?php echo e(__('Available?')); ?>

                      </th>
                      <th>
                          <?php echo e(__('Reason')); ?>

                      </th>
                   
                      
                    </thead>
                    
                    <tbody id="availability_data">

                     
                    </tbody>
                  </table>

                </div>
                   
              </div>
            </div>
          </div>

             <div class="tab-pane" id="link2">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">Visibility</h4>
                    <p class="card-category">
                      More information here
                    </p>
                  </div>
                  <div class="card-body">
                   <div class="table-responsive">
                      <table id="" class="table table-striped table-no-bordered table-hover datatable" >
                        <thead class="text-primary">
                          <th>
                              <?php echo e(__('S.No')); ?>

                          </th>
                          <th>
                              <?php echo e(__('Category')); ?>

                          </th>
                          <th>
                              <?php echo e(__('Time')); ?>

                          </th>    
                          <!--  <th>
                              <?php echo e(__('Product')); ?>

                          </th>
                           <th>
                              <?php echo e(__('Category')); ?>

                          </th> -->
                          <th>
                              <?php echo e(__('Available')); ?>

                          </th>
                          <th>
                              <?php echo e(__('Reason / Image')); ?>

                          </th>
                       
                          
                        </thead>
                        
                        <tbody id="visibility">

                         
                        </tbody>
                      </table>

                    </div>
                  </div>
                </div>
              </div>


              <div class="tab-pane" id="link3">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">Share Of Shelf</h4>
                    <p class="card-category">
                      More information here
                    </p>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="" class="table table-striped table-no-bordered table-hover datatable" >
                        <thead class="text-primary">
                          <th>
                              <?php echo e(__('S.No')); ?>

                          </th>
                          <th>
                              <?php echo e(__('Category')); ?>

                          </th>
                          <th>
                              <?php echo e(__('Time')); ?>

                          </th>    
                           <th>
                              <?php echo e(__('Total Shelf')); ?>

                          </th>
                           <th>
                              <?php echo e(__('Actual Shelf')); ?>

                          </th>
                          <th>
                              <?php echo e(__('Total Target')); ?>

                          </th>
                          <th>
                              <?php echo e(__('Actual Target')); ?>

                          </th>
                       
                          
                        </thead>
                        
                        <tbody id="share_of_shelf_data">

                         
                        </tbody>
                      </table>

                    </div>
                  </div>
                </div>
              </div>
             

              <div class="tab-pane " id="link4">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">Planogram</h4>
                    <p class="card-category">
                      More information here
                    </p>
                  </div>
                  <div class="card-body">
                   <div class="table-responsive">
                      <table id="" class="table table-striped table-no-bordered table-hover datatable" >
                        <thead class="text-primary">
                          <th>
                              <?php echo e(__('S.No')); ?>

                          </th>
                          <th>
                              <?php echo e(__('Category')); ?>

                          </th>
                          <th>
                              <?php echo e(__('Time')); ?>

                          </th>    
                           <th>
                              <?php echo e(__('Planogram Image')); ?>

                          </th>
                           <th>
                              <?php echo e(__('Before Image')); ?>

                          </th>
                           <th>
                              <?php echo e(__('After Image')); ?>

                          </th>
                          
                        </thead>
                        
                        <tbody id="planogram_check">

                         
                        </tbody>
                      </table>

                    </div>
                  </div>
                </div>
              </div>

               <div class="tab-pane " id="link5">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">Promotion Check</h4>
                    <p class="card-category">
                      More information here
                    </p>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="" class="table table-striped table-no-bordered table-hover datatable" >
                        <thead class="text-primary">
                          <th>
                              <?php echo e(__('S.No')); ?>

                          </th>
                          <th>
                              <?php echo e(__('Product')); ?>

                          </th>
                          <th>
                              <?php echo e(__('Time')); ?>

                          </th>    
                           <th>
                              <?php echo e(__('Available?')); ?>

                          </th>
                           <th>
                              <?php echo e(__('Reason / Image')); ?>

                          </th>
                          
                        </thead>
                        
                        <tbody id="promotion_check">

                         
                        </tbody>
                      </table>

                    </div>
                  </div>
                </div>
              </div>

              <div class="tab-pane" id="link6">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">Competitor Information</h4>
                    <p class="card-category">
                      More information here
                    </p>
                  </div>
                  <div class="card-body">
                   <div class="table-responsive">
                      <table id="" class="table table-striped table-no-bordered table-hover datatable" >
                        <thead class="text-primary">

                          <th>
                              <?php echo e(__('S.No')); ?>

                          </th>
                         
                          <th>
                              <?php echo e(__('Company Name')); ?>

                          </th>
                          <th>
                              <?php echo e(__('Time')); ?>

                          </th>    
                          <th>
                              <?php echo e(__('Brand Name')); ?>

                          </th>
                           <th>
                              <?php echo e(__('Item Name')); ?>

                          </th>
                          <th>
                              <?php echo e(__('Promotion Type')); ?>

                          </th>
                           
                           <th>
                              <?php echo e(__('Regular Price')); ?>

                          </th>

                          <th>
                              <?php echo e(__('Selling Price')); ?>

                          </th>

                         <th>
                              <?php echo e(__('Competitor_Image')); ?>

                         </th>
                     
                          
                        </thead>
                        
                        <tbody id="competitor_information">

                         
                        </tbody>
                      </table>

                    </div>
                  </div>
                </div>
              </div>

            </div>
         

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      
      </div>
    </div>
  </div>
</div>

<!-- Classic Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"> Image</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <i class="material-icons">clear</i>
          </button>
        </div>
        <div class="modal-body">
         
            <img style="height:330px;width:450px;" src="" id="FullImage"> </img>
        </div>
        <div class="modal-footer">
        
          <button type="button" class="btn btn-danger btn-link" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>
<!--  End Modal -->


<?php $__env->stopSection(); ?>

 

<?php $__env->startPush('js'); ?>

     <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  <script>

    $(".js-select2").select2();

    $('.js-select2').select2({
        dropdownParent: $('#FilterModal')
    });

    
    
      $('.datepicker').datetimepicker({
         // viewMode : 'months',
          format : 'DD-MM-YYYY',
          toolbarPlacement: "top",
          allowInputToggle: true,
          useCurrent: true,
    }); 


     $('.datepicker_year').datetimepicker({
          viewMode : 'years',
          format : 'YYYY',
          toolbarPlacement: "top",
          allowInputToggle: true,
          useCurrent: false,
    }); 

  

    $('table').on('click', 'tr.parent .expand', function(){
      $(this).closest('tbody').toggleClass('open');
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {

      $('#datatables').fadeIn(1100);

      // $('#datatables').DataTable({
      //   "pagingType": "full_numbers",
      //   "lengthMenu": [
      //     [10, 25, 50, -1],
      //     [10, 25, 50, "All"]
      //   ],

      //   searching: true,
      //   paging: true,
      //   info: true,
      //   responsive: true,
      //   language: {
      //     search: "_INPUT_",
      //     searchPlaceholder: "Search",
      //   },
      // });

       var collapsedGroups = {};

        var table = $('#datatables').DataTable({

        "paging":   false,

        targets: [10,11],
        dom: 'lBfrtip',
        // buttons: [
        //             'excel'
        //         ],

        buttons: [{
            extend: 'excelHtml5',
            className: 'btn-primary',
            text: 'Export',
            filename: function(){
                var dt = new Date();
                dt.getDate() + "/" + (dt.getMonth() + 1) + "/" + dt.getFullYear();
                return 'schedule_excel-' + dt;
            },
            //title: 'alpin_excel',
            exportOptions: {
                modifier: {
                    page: 'all'
                },
                columns: [0, 1, 2, 3],
            },
          

        }],

        select: true,

        responsive: true,
        language: {
          search: "_INPUT_",
          searchPlaceholder: "Search Outlet",
        },


          order: [[1, 'asc']],
          rowGroup: {
            // Uses the 'row group' plugin
            dataSrc: 1,
            startRender: function (rows, group) {
                var collapsed = !!collapsedGroups[group];

                rows.nodes().each(function (r) {
                    r.style.display = collapsed ? 'none' : '';
                });    

                // Add category name to the <tr>. NOTE: Hardcoded colspan
                return $('<tr/>')
                    .append('<td colspan="8" style="cursor:pointer;">' + group + ' (' + rows.count() + ')</td>')
                    .attr('data-name', group)
                    .toggleClass('collapsed', collapsed);
            }
          }
        });

       $('#datatables tbody').on('click', 'tr.group-start', function () {
            var name = $(this).data('name');
            collapsedGroups[name] = !collapsedGroups[name];
            table.draw(false);
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
             //alert(data);

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
     

     function export_timesheet(type){
        
         var csrf = $('meta[name="csrf-token"]').attr('content');

         var emp_id = $("#employee_id").val();

         var startdate = $("#startdate").val();

         var enddate = $("#enddate").val();

        var status = $("#status").val();

        var outlet_id = $("#outlet_id").val();

         var year = $("#year").val();
          Swal.fire({
          title: 'Are you sure?',
          text: "You can't able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, send it!'
        }).then((result) => {
          if (result.isConfirmed) {

           $("#mail_sending").removeClass("hidden");
            $('#export_timesheet').css("pointer-events","none");

          $.ajax({
              url: '/export_schedule',
              type: 'POST',
              data: {type : type, employee_id : emp_id, start_date : startdate, end_date : enddate, status : status, outlet_id: outlet_id, '_token': csrf},
              dataType: 'json',

              success: function( data ) {

                $("#mail_sending").addClass("hidden");
                // alert(data);
                $('#export_timesheet').css("pointer-events","auto");

                if(data == 1)
                {
                    Swal.fire(
                      'Sent!',
                      'Mail Send Successfully..',
                      'success'
                    );
                }

                if(data == 0)
                {
                    Swal.fire(
                      'Error!',
                      'Problem in sending mail..',
                      'danger'
                    );
                }

              }       
          });
          }
      });
     }

     function view_activity(id)
     {
       // alert(id);

        var csrf = $('meta[name="csrf-token"]').attr('content');


        $.ajax({
              url: '/view_activity',
              type: 'GET',
              data: {id : id, '_token': csrf},
              dataType: 'json',

              success: function( data ) {
                //alert(JSON.stringify(data.check_in[0].checkin_time));

              
                 var html  = '';
                 var html1  = '';
                 var html2  = '';
                 var html3  = '';
                 var html4  = '';
                 var html5  = '';
                 var i = 1;
                 var j = 1;
                 var k = 1;
                 var l = 1;
                 var m = 1;
                 var n = 1;

                $("#checkin_date").html('');
                $("#checkin_time").html('');
                $("#checkout_time").html('');
                $("#working_time").html('');
                $("#break_time").html('');

                var working_time = 0;
                if(data.check_in[0].checkin_time && data.check_in[0].checkout_time)
                {
                    var dateAr = data.check_in[0].date.split('-');
                    var newDate = dateAr[2] + '-' + dateAr[1] + '-' + dateAr[0];

                    var timeString = data.check_in[0].checkin_time;
                    var H = +timeString.substr(0, 2);
                    var h = (H % 12) || 12;
                    var ampm = H < 12 ? " AM" : " PM";
                    timeString = h + timeString.substr(2, 3) + ampm;

                    var timeString1 = data.check_in[0].checkout_time;
                    var H1 = +timeString1.substr(0, 2);
                    var h1 = (H1 % 12) || 12;
                    var ampm1 = H1 < 12 ? " AM" : " PM";
                    timeString1 = h1 + timeString1.substr(2, 3) + ampm1;

                     $("#checkout_time").html(timeString1);

                     $("#checkin_date").html(newDate);
                     $("#checkin_time").html(timeString);



                     time1 = data.check_in[0].checkin_time ;

                     time2 = data.check_in[0].checkout_time;

                     //create date format          
                    var working_time = ( new Date("1970-1-1 "+  time2 ) - new Date("1970-1-1 "+ time1 ))/1000/60;

                    // var hrs = Math.floor(minites / 60);
                    // // Getting the minutes.
                    // var min = minites % 60;


                }

                //alert(working_time);               

                var break_time = 0; 
                var shipt_time = 0;

                 $.each(data.break_time, function (key, val) {

                    //alert(data.break_time[key].checkin_time);

                    if(data.break_time[key].type == "break")
                    {
                        time1 = data.break_time[key].checkin_time ;

                        time2 = data.break_time[key].checkout_time;

                        //create date format          
                        var minutes = ( new Date("1970-1-1 "+  time2 ) - new Date("1970-1-1 "+ time1 ))/1000/60;

                        break_time += minutes;  
                    }

                    if(data.break_time[key].type == "split_shipt")
                    {
                        shipt_check_in = data.break_time[key].checkin_time;

                        shipt_check_out = data.break_time[key].checkout_time;

                        var minutes = ( new Date("1970-1-1 "+  shipt_check_out ) - new Date("1970-1-1 "+ shipt_check_in ))/1000/60;

                        shipt_time += minutes;  

                    }
                     

                 });
                 //alert(break_time);
                 //alert(shipt_time);

                  var h = Math.floor(break_time / 60);
                  var m = (break_time % 60).toFixed(0);
                  h = h < 10 ? '0' + h : h;
                  m = m < 10 ? '0' + m : m;
                      
                $("#break_time").html(h+' Hr '+' and '+m+" Min");

                working_time = (working_time + shipt_time) - break_time;

                //alert(working_time);

                  var h = Math.floor(working_time / 60);
                  var m = (working_time % 60).toFixed(0);
                  h = h < 10 ? '0' + h : h;
                  m = m < 10 ? '0' + m : m;
                      
                $("#working_time").html(h+' Hr '+' and '+m+" Min");


               
                $.each(data.availability, function (key, val) {
                    //alert(data[key].product_id);

                    var timeString0 = data.availability[key].created_at.split(' ')[1];
                    var H0 = +timeString0.substr(0, 2);
                    var h0 = (H0 % 12) || 12;
                    var ampm0 = H0 < 12 ? " AM" : " PM";
                    timeString0 = h0 + timeString0.substr(2, 3) + ampm0;
                  
                    html += '<tr>';
                    html += '<td>' + i++ + '</td>';
                    html += '<td>' +data.availability[key].product_name + '</td>';
                    html += '<td>' + timeString0 + '</td>';
                    html += '<td>' + data.availability[key].brand_name + '</td>';
                    html += '<td>' + data.availability[key].category_name + '</td>';

                    if(data.availability[key].is_available == 0)
                    {
                        html += '<td> Not Available </td>';
                    }

                    if(data.availability[key].is_available == 1)
                    {
                        html += '<td> Available </td>';
                    }

                    if(data.availability[key].is_available == 0)
                    {
                        html += '<td>' + data.availability[key].reason + '</td>';
                    }

                    if(data.availability[key].is_available == 1)
                    {
                        html += '<td> - </td>';
                    }

                    html += ' </tr>';
               
                });

            
                 $.each(data.shareof_shelf, function (key, val) {
                    //alert(data[key].product_id);

                    var timeString0 = data.shareof_shelf[key].created_at.split(' ')[1];
                    var H0 = +timeString0.substr(0, 2);
                    var h0 = (H0 % 12) || 12;
                    var ampm0 = H0 < 12 ? " AM" : " PM";
                    timeString0 = h0 + timeString0.substr(2, 3) + ampm0;
                  
                    html1 += '<tr>';
                    html1 += '<td>' + j++ + '</td>';
                    html1 += '<td>' +data.shareof_shelf[key].category_name + '</td>';
                    html1 += '<td>' + timeString0 + '</td>';
                    html1 += '<td>' + data.shareof_shelf[key].total_share + ' Meters</td>';
                    html1 += '<td>' + data.shareof_shelf[key].share + ' Meters</td>';
                    html1 += '<td>' + data.shareof_shelf[key].target + ' %</td>';
                    html1 += '<td>' + data.shareof_shelf[key].actual + ' %</td>';

                    html1 += ' </tr>';
               
                });


                  $.each(data.visibility, function (key, val) {
                    //alert(data[key].product_id);

                    var timeString0 = data.visibility[key].created_at.split(' ')[1];
                    var H0 = +timeString0.substr(0, 2);
                    var h0 = (H0 % 12) || 12;
                    var ampm0 = H0 < 12 ? " AM" : " PM";
                    timeString0 = h0 + timeString0.substr(2, 3) + ampm0;
                  
                    html2 += '<tr>';
                    html2 += '<td>' + k++ + '</td>';
                    html2 += '<td>' +data.visibility[key].category_name + '</td>';
                    html2 += '<td>' + timeString0 + '</td>';
                    // html2 += '<td>' + data.visibility[key].product_name +'</td>';
                    // html2 += '<td>' + data.visibility[key].category_name + '</td>';

                    if(data.visibility[key].is_available == 0)
                    {
                        html2 += '<td> Not Available </td>';
                    }

                    if(data.visibility[key].is_available == 1)
                    {
                        html2 += '<td> Available </td>';
                    }

                    if(data.visibility[key].is_available == 0)
                    {
                        html2 += '<td>' + data.visibility[key].reason + '</td>';
                    }

                    if(data.visibility[key].is_available == 1)
                    {
                        
                        html2 += '<td><img id="" src="/visibility_image/'+ data.visibility[key].image_url +'"  onclick="DoSomething(this.src);" alt="" style="max-width: 80px;height: 50px;"></td>';
                    }

                    // html2 += '<td>' + data.visibility[key].target + '</td>';
                    // html2 += '<td>' + data.visibility[key].actual + '</td>';

                    html2 += ' </tr>';
               
                });


                $.each(data.promotion_check, function (key, val) {
                    //alert(data[key].product_id);

                    var timeString0 = data.promotion_check[key].created_at.split(' ')[1];
                    var H0 = +timeString0.substr(0, 2);
                    var h0 = (H0 % 12) || 12;
                    var ampm0 = H0 < 12 ? " AM" : " PM";
                    timeString0 = h0 + timeString0.substr(2, 3) + ampm0;
                  
                    html3 += '<tr>';
                    html3 += '<td>' + l++ + '</td>';
                   
                    html3 += '<td>' + data.promotion_check[key].product_name +'</td>';
                    html3 += '<td>' + timeString0 + '</td>';
                    if(data.promotion_check[key].is_available == 0)
                    {
                        html3 += '<td> Not Available </td>';
                    }

                    if(data.promotion_check[key].is_available == 1)
                    {
                        html3 += '<td> Available </td>';
                    }

                    if(data.promotion_check[key].is_available == 0)
                    {
                        html3 += '<td>' + data.promotion_check[key].reason + '</td>';
                    }

                    if(data.promotion_check[key].is_available == 1)
                    {
                        
                        html3 += '<td><img id="" src="/promotion_image/'+ data.promotion_check[key].image_url +'"  onclick="DoSomething(this.src);" alt="" style="max-width: 80px;height: 50px;"></td>';
                    }

                    // html2 += '<td>' + data.visibility[key].target + '</td>';
                    // html2 += '<td>' + data.visibility[key].actual + '</td>';

                    html3 += ' </tr>';
               
                });

                 $.each(data.planogram_checks, function (key, val) {
                    //alert(data[key].product_id);

                    var timeString0 = data.planogram_checks[key].created_at.split(' ')[1];
                    var H0 = +timeString0.substr(0, 2);
                    var h0 = (H0 % 12) || 12;
                    var ampm0 = H0 < 12 ? " AM" : " PM";
                    timeString0 = h0 + timeString0.substr(2, 3) + ampm0;
                  
                    html4 += '<tr>';

                    html4 += '<td>' + m++ + '</td>';
                   
                    html4 += '<td>' + data.planogram_checks[key].category_name + '</td>';
                    html4 += '<td>' + timeString0 + '</td>';

                    html4 += '<td><img id="" src="/planogram_image/'+ data.planogram_checks[key].default_image +'"  onclick="DoSomething(this.src);" alt="" style="width: 80px;height: 50px;"></td>';
                   
                    html4 += '<td><img id="" src="/planogram_image/'+ data.planogram_checks[key].before_image +'"  onclick="DoSomething(this.src);" alt="" style="width: 80px;height: 50px;"></td>';

                    html4 += '<td><img id="" src="/planogram_image/'+ data.planogram_checks[key].after_image +'"  onclick="DoSomething(this.src);" alt="" style="width: 80px;height: 50px;"></td>';

                    html4 += ' </tr>';
               
                });

                $.each(data.competition_info, function (key, val) {
                    //alert(data[key].company_name);

                    var timeString0 = data.competition_info[key].created_at.split(' ')[1];
                    var H0 = +timeString0.substr(0, 2);
                    var h0 = (H0 % 12) || 12;
                    var ampm0 = H0 < 12 ? " AM" : " PM";
                    timeString0 = h0 + timeString0.substr(2, 3) + ampm0;
                  
                    html5 += '<tr>';
                    html5 += '<td>' + n++ +'</td>';
                    html5 += '<td>' + data.competition_info[key].company_name + '</td>';
                    html5 += '<td>' + timeString0 + '</td>';
                    html5 += '<td>' + data.competition_info[key].brand_name + '</td>';
                    html5 += '<td>' + data.competition_info[key].item_name + ' </td>';
                    html5 += '<td>' + data.competition_info[key].promotion_type + '</td>';
                    html5 += '<td>' + data.competition_info[key].mrp + '</td>';
                    html5 += '<td>' + data.competition_info[key].selling_price + '</td>';
                    html5 += '<td><img id="" src="/competitor/'+ data.competition_info[key].capture_image +'"  onclick="DoSomething(this.src);" alt="" style="max-width: 80px;height: 50px;"></td>';
                    
                    
                 html5 += ' </tr>';
               
                });


                $("#availability_data").html(html);
                $("#share_of_shelf_data").html(html1);
                $("#visibility").html(html2);
                $("#promotion_check").html(html3);
                $("#planogram_check").html(html4);
                $("#competitor_information").html(html5);

                $('#ActivityModal').modal('show'); 

                $('.datatable').DataTable().empty();
                $('.datatable').DataTable({"lengthMenu": [
                      [5, 10, 25, 50, -1],
                      [5, 10, 25, 50, "All"]
                    ],}).reload();
                  
                
              }       
          })
     }

    function DoSomething(data)
      {
     // alert(data);
      $('#FullImage').attr('src',data );
      $('#myModal').modal('show');

      }


  </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', ['activePage' => 'day_jouney_plan', 'menuParent' => 'Timesheet', 'titlePage' => __('Scheduled JourneyPlan')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thethethoughtfactory/Desktop/RMS-2-11-21/resources/views/day_journeyplan/index.blade.php ENDPATH**/ ?>