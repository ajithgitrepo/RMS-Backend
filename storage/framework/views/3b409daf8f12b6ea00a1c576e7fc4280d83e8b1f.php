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
  .parent {
    cursor: pointer;
  }
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

  .table .td-actions .btn {
    margin: 0px;
    padding: 1px !important;
}

 .dt-buttons {
        float: right !important;
        margin-left: 20px;
        margin-right: 0px;
      }

  button.dt-button.buttons-excel.buttons-html5.btn-primary {
      border-radius: 5px;
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
                <h4 class="card-title"><?php echo e(__('Scheduled Timesheets')); ?></h4>
              </div>

              <div class="card-body">

                 <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['isField_Manager','isAdmin','isTopManagement','isCDE'],App\User::class)): ?>
                 <div class="row">
                    <div class="col-12 text-right">
                      <a class="btn btn-sm btn-warning" style="color: #fff;" data-toggle="modal" data-target="#FilterModal" ><?php echo e(__('Filter')); ?></a>
                    </div>
                  </div>
                  <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['isField_Manager','isCDE'],App\User::class)): ?>
                    <div class="row">
                 
                        <div class="col-12 text-right">
            
                          <a href="<?php echo e(route('schedule-outlets.create')); ?>" class="btn btn-sm btn-rose"><?php echo e(__(' Add Scheduled Timesheet ')); ?></a>
                           
                        </div>
                  </div>
                <?php endif; ?>

                 <!--   <a onclick="export_timesheet('xlsx')" class="btn btn-info ml-auto float-right">Send To Approval</a>
 -->
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

                               <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['isAdmin','isTopManagement'],App\User::class)): ?>
                                <th>
                                  <?php echo e(__('Field Manager')); ?>

                                </th>
                               <?php endif; ?> 

                                <th>
                                  <?php echo e(__('Store Code')); ?>

                              </th>

                                <th>
                                  <?php echo e(__('Location')); ?>

                              </th>



                              <th>
                                  <?php echo e(__('Date')); ?>

                              </th>

                               <th>
                                  <?php echo e(__('Start Time')); ?>

                              </th>

                               <th>
                                  <?php echo e(__('End Time')); ?>

                              </th>

                              <th>
                                  <?php echo e(__('Total Working Time')); ?>

                              </th>
                            
                             

                               <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['isField_Manager','isCDE'],App\User::class)): ?>
                               <th>
                                  <?php echo e(__('Action')); ?>

                              </th>
                               <?php endif; ?>
                              
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
                               <?php echo e($parent->employee->first_name); ?> <?php echo e($parent->employee->middle_name); ?> <?php echo e($parent->employee->surname); ?> (<?php echo e($parent->employee_id); ?>)
                              </td>

                              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['isAdmin','isTopManagement'],App\User::class)): ?>

                                <?php if(!empty($parent->employee_field)): ?>

                                    <td>
                                        <?php echo e($parent->employee_field->first_name); ?> <?php echo e($parent->employee_field->middle_name); ?> <?php echo e($parent->employee_field->surname); ?> 
                                    </td>

                                <?php else: ?>

                                     <td>
                                       
                                        <?php echo e(__('Unknown')); ?>


                                    </td>

                                <?php endif; ?>

                            <?php endif; ?>

                             <td>
                                <?php echo e($parent->store_code); ?>

                            </td>

                            <td>
                               <?php echo e($parent->store_name); ?>-<?php echo e($parent->address); ?>

                            </td>

                            <td>
                                <?php echo e(date('d-m-Y', strtotime($parent->date))); ?>

                            </td>

                            <?php if($parent->checkin_time): ?>
                              <td>
                                <?php echo e(date('h:i A', strtotime($parent->checkin_time))); ?>

                              </td>
                            <?php else: ?>
                                <td>
                                <?php echo e('-'); ?>

                              </td>
                            <?php endif; ?>

                            <?php if($parent->checkout_time): ?>
                              <td>
                                <?php echo e(date('h:i A', strtotime($parent->checkout_time))); ?>

                              </td>
                              <?php else: ?>
                                <td>
                                <?php echo e('-'); ?>

                              </td>
                            <?php endif; ?>

                            <?php if($parent->checkin_time && $parent->checkout_time ): ?>
                              <td>
                                <?php
                                 $start = \Carbon\Carbon::createFromFormat('Y-m-d h:i A', $parent->date.date('h:i A', strtotime($parent->checkin_time)));
                                    $end = \Carbon\Carbon::createFromFormat('Y-m-d h:i A', date('Y-m-d', strtotime($parent->updated_at)).date('h:i A', strtotime($parent->checkout_time)));
                                ?>
                                <?php echo e($start->diff($end)->format('%H:%I')); ?>  
                              </td>
                                <?php else: ?>
                                <td>
                                    <?php echo e('-'); ?>

                                </td>
                            <?php endif; ?>

                          

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['isField_Manager','isCDE'],App\User::class)): ?>
                              
                        <td class="td-actions">
                            

                             <form action="<?php echo e(route('schedule-outlets.destroy', $parent->id)); ?>" method="post">
                                  <?php echo csrf_field(); ?>
                                  <?php echo method_field('delete'); ?>
                             
                                 <a onclick="confirm('<?php echo e(__("Are you sure you want to delete this timesheet?")); ?>') ? this.parentElement.submit() : ''"  class="btn btn-danger" title="Delete">
                                  <i class="material-icons">close</i>
                                </a>
                                      
                                        
                                      
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

  <div class="modal fade bd-example-modal-lg" id="FilterModal"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Filter</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

           <form method="get" action="<?php echo e(url('filter_scheduled_outlet')); ?>" class="form-inline" enctype="multipart/form-data" action="" autocomplete="off" style="text-align: right;">
              <?php echo csrf_field(); ?>
              <?php echo method_field('get'); ?>
          
               <div class="col-lg-6">

                 <select class="form-control js-select2" data-style="select-with-transition" title="Select Merchandiser" data-size="7" name="employee_id" id="employee_id" 
                     value="<?php echo e(old('employee_id')); ?>" aria-required="true" style="margin-bottom:10px;">

                     <option value="" selected disabled>Select Merchandiser</option>
                        <?php $__currentLoopData = $merchandisers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $merchants): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($merchants->employee_id); ?>" <?php if($employee_id == "$merchants->employee_id" ): ?> <?php echo e('selected'); ?> <?php endif; ?>  > <?php echo e($merchants->first_name); ?> <?php echo e($merchants->middle_name); ?> <?php echo e($merchants->surname); ?> (<?php echo e($merchants->employee_id); ?>)</option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                       
                    </select>
              
               
                    

               </div>

             
                 <div class="col-lg-6">

                 <select class="form-control js-select2" data-style="select-with-transition" title="Select Status" data-size="7" name="status" id="status" 
                     value="<?php echo e(old('status')); ?>" aria-required="true" style="margin-bottom:10px;">

                    <option value="" selected disabled>Select Status</option>
                    <option value="1">Completed</option>
                    <option value="0">Pending</option>
                  
                    </select>
              
               </div>


                <div class="col-lg-6">
                 <input type="text" style="float: left; margin-top: 30px;width: 344px;" class="datepicker" value="<?php echo e($startdate); ?>" id="startdate" placeholder="Start Date" name="startdate">
               </div> 

              
               
                <div class="col-lg-6">
                 <input type="text" style="float: left; margin-top: 30px;width: 344px;" class=" datepicker" value="<?php echo e($enddate); ?>" id="enddate" placeholder="End Date" name="enddate">
               </div> 

              
                 <button type="submit" style="margin-top: 30px;"  class="btn btn-finish btn-fill btn-rose btn-wd mx-auto d-block" name="Filter" value="Filter"><?php echo e(__('Filter')); ?></button>

            </form>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      
      </div>
    </div>
  </div>
</div>


<?php $__env->stopSection(); ?>

 

<?php $__env->startPush('js'); ?>
  <script>

    
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

      $(".js-select2").select2();

    $('.js-select2').select2({
        dropdownParent: $('#FilterModal')
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

      var Role = "<?php echo e((Auth::user()->role->name)); ?>"

      //alert(isAdmin);
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

    if(Role == "Top Management" || Role == "Admin")  
      {
           var table = $('#datatables').DataTable({

          "order": [[0, 'asc'], [3, 'asc']],
          "paging":   true, 
          dom: 'lBfrtip',
       
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
                    columns: [0, 1, 2, 3,4,5,6,7],
                },
              

            }],

          rowGroup: {
            // Uses the 'row group' plugin
            dataSrc: [0][3],
            startRender: function (rows, group) {
                var collapsed = !!collapsedGroups[group];

                rows.nodes().each(function (r) {
                    r.style.display = collapsed ? 'none' : '';
                });    

                //Add category name to the <tr>. NOTE: Hardcoded colspan
                return $('<tr/>')
                    .append('<td colspan="8" style="cursor:pointer;">' + group + ' (' + rows.count() + ')</td>')
                    .attr('data-name', group)
                    .toggleClass('collapsed', collapsed);
            }
          }
        });
      }

    if(Role == "Field Manager" || Role == "CDE")  
      {
            var table = $('#datatables').DataTable({

          "order": [[2, 'asc'], [3, 'asc']],
          "paging":   true, 

           dom: 'lBfrtip',
       
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
                    columns: [0, 1, 2, 3,4,5,6],
                },
              

            }],

          rowGroup: {
            // Uses the 'row group' plugin
            dataSrc: 2,
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
      }

     

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

         var specific_date = $("#specific_date").val();

         var specific_month = $("#specific_month").val();

         var year = $("#year").val();

          $.ajax({
              url: '/export-timesheet',
              type: 'POST',
              data: {type : type, employee_id : emp_id, specific_date : specific_date, specific_month : specific_month, year : year, '_token': csrf},
              dataType: 'json',

              success: function( data ) {
                 alert(data);

                
              }       
          })
     }


  </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', ['activePage' => 'scheduled_outlets', 'menuParent' => 'Timesheets', 'titlePage' => __(' Timesheets')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thethethoughtfactory/Desktop/RMS-2-11-21/resources/views/scheduled_outlets/index.blade.php ENDPATH**/ ?>