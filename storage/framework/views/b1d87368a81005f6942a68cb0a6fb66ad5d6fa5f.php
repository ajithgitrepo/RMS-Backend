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
    /*margin: -.5rem;
    padding: .5rem;*/
   
  }
  .open .parent i {
    transform: rotate(180deg)
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
                  <i class="material-icons">schedule</i>
                </div>
                <h4 class="card-title"><?php echo e(__(' Scheduled Timesheet')); ?></h4>
              </div>
              <div class="card-body">

            <form method="post" action="<?php echo e(url('filter_timesheet')); ?>" class="form-inline" enctype="multipart/form-data" action="" autocomplete="off" style="text-align: right;">
              <?php echo csrf_field(); ?>
              <?php echo method_field('post'); ?>
          
               <div class="col-lg-3">
                
               </div>
               <div class="col-lg-4">
                
               </div>


                <div class="col-lg-3">
                     <input type="text" class="form-control datepicker" value="<?php echo e($date); ?>" id="date" placeholder="Start Date" name="date">
               </div>

                 <button type="submit"  class="btn btn-finish btn-fill ml-auto btn-rose btn-wd d-block" name="Filter" value="Filter"><?php echo e(__('Filter')); ?></button>

                <!--  <a href="<?php echo e(url('/')); ?>/export/xlsx" class="btn btn-info ml-auto">Export to Excel</a>
 -->

            </form>

                <div class="table-responsive">

                 <table id="datatables" class="table table-no-bordered">    
                        <thead>
                         <tr>
                         <!--  <th>
                             <?php echo e(__('#')); ?>

                          </th>
                          <th>
                              <?php echo e(__('Outlet Id')); ?>

                          </th> -->
                           <th>
                              <?php echo e(__('Date')); ?>

                          </th>
                          <th>
                              <?php echo e(__('Outlet Name')); ?>  
                          </th>
                          <th>
                              <?php echo e(__('Outlet Area')); ?>

                          </th>
                          <th>
                              <?php echo e(__('Outlet City')); ?>

                          </th>
                          <th>
                              <?php echo e(__('Outlet State ')); ?>

                          </th>
                          <th>
                              <?php echo e(__('Outlet Country')); ?>

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

                          ?>
                               
                        <tbody>            

                        <?php $__currentLoopData = $outlets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          
                           
                            <tr class="parent">
                             <!--  <td>
                                <?php echo e($i++); ?>

                              </td>
                               <td>
                            
                                <?php echo e($parent->outlet_id); ?>


                              </td> -->
                             
                             <td>  
                                <?php echo e(date('d-m-Y', strtotime($parent->date))); ?> 
                            </td>
                            <td>
                               <?php echo e($parent->store_name); ?>

                              </td>
                              <td>
                                <?php echo e($parent->outlet->outlet_area); ?>

                              </td>
                              <td>
                                <?php echo e($parent->outlet->outlet_city); ?>

                              </td>
                              <td>
                                <?php echo e($parent->outlet->outlet_state); ?>

                              </td>
                              <td>
                                <?php echo e($parent->outlet->outlet_country); ?>

                              </td>
                              
                               
                                  <?php if($parent->is_completed =='1'): ?>
                                   <td style="color: green;">
                                      <?php echo e(__('Completed')); ?>

                                    </td>
                                 <?php endif; ?>
                               
                                 <?php if($parent->is_completed =='0'): ?>
                                   <td style="color: red;">
                                      <?php echo e(__('Pending')); ?>

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

  

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
  <script>

     $('.datepicker').datetimepicker({
          format : 'DD-MM-YYYY',
          useCurrent: true,
    }); 

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('table').on('click', 'tr.parent .expand', function(){
      $(this).closest('tbody').toggleClass('open');
    });

    $(document).ready(function() {
      $('#datatables').fadeIn(1100);

      // $('#datatables').DataTable({
      //   "pagingType": "full_numbers",
      //   "lengthMenu": [
      //     [10, 25, 50, -1],
      //     [10, 25, 50, "All"]
      //   ],
      //   responsive: true,
      //   language: {
      //     search: "_INPUT_",
      //     searchPlaceholder: "Search",
      //   }
      // });

        var collapsedGroups = {};

        var table = $('#datatables').DataTable({
          order: [[0, 'asc']],
          rowGroup: {
            // Uses the 'row group' plugin
            dataSrc: 0,
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
     


  </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', ['activePage' => 'day-timesheet', 'menuParent' => 'Timesheet', 'titlePage' => __('TimeSheet')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thethethoughtfactory/Desktop/RMS-2-11-21/resources/views/timesheet/index.blade.php ENDPATH**/ ?>