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
  margin-top: 20px;
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
  margin-top: 20px;
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
                <h4 class="card-title"><?php echo e(__('Client Outlet Report')); ?></h4>
              </div>

              <div class="card-body">


                <!--  <div class="row">
                    <div class="col-12 text-right">
                      <a class="btn btn-sm btn-warning" style="color: #fff;" data-toggle="modal" data-target="#FilterModal" ><?php echo e(__('Filter')); ?></a>
                    </div>
                  </div> -->

                  <!--   <div class="row">
                      <a id="export_timesheet" onclick="export_timesheet('xlsx')" style="color: #fff;" class="btn btn-sm btn-info ml-auto float-right" >Send To Approval</a>
                  </div> -->

                 <!--  <div class="row">
                     <span id="mail_sending" class="ml-auto float-right" style="color: red;" >Sending please wait..</span>

                  </div> -->

            <form method="" action="" autocomplete="off" class="form-horizontal">
           
                  <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Outlet')); ?></label>
                  <div class="col-sm-7">
                   <select class="form-control js-select2" data-style="select-with-transition"  title="Select Outlet" data-size="7" name="outlet_id" id="input_outlet_id" 
                     value="<?php echo e(old('outlet_id')); ?>" aria-required="true" required >
                      <option value="" selected="" >-- All Outlets --</option>

                      <?php $__currentLoopData = $outlets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $out): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <option value="<?php echo e($out->outlet_id); ?>"> <?php echo e($out->store[0]->store_code); ?> - <?php echo e($out->store[0]->store_name); ?> - <?php echo e($out->store[0]->address); ?> - <?php echo e($out->outlet_city); ?> </option>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  

                     
                    </select>
                     <?php echo $__env->make('alerts.feedback', ['field' => 'outlet_id'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Activity')); ?></label>
                  <div class="col-sm-7">
                    
                   
                    <select class="form-control js-select2" data-style="select-with-transition"  title="Sku / Item / Product " data-size="7" name="activity[]" value="<?php echo e(old('activity')); ?>" aria-required="true" id="activity" required>

                        <option value="" selected="" >Select Activity</option>

                        <option value="Availabity" >Availabity</option>

                        <option value="Visibility" >Visibility</option>

                        <option value="Share_Of_Shelf" >Share Of Shelf</option>

                        <option value="Promotion_Check" >Promotion Check</option>

                        <option value="Planogram" >Planogram</option>

                        <option value="Competitor_Info" >Competitor Info</option>

                        <option value="Stock_Report" >Stock Report</option>

                       

                      </select>
                      <?php echo $__env->make('alerts.feedback', ['field' => 'product_id'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                   
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('From Date')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('from_date') ? ' has-danger' : ''); ?>">
                    

                    <input class="form-control datepicker <?php echo e($errors->has('from_date') ? ' is-invalid' : ''); ?>" name="from_date" id="input_from_date" type="text" placeholder="<?php echo e(__('')); ?>" value="<?php echo e(old('from_date')); ?> "   aria-required="true" required>
                    
                      <?php echo $__env->make('alerts.feedback', ['field' => 'from_date'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div>

                 <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('To Date')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('to_date') ? ' has-danger' : ''); ?>">
                    

                    <input class="form-control datepicker <?php echo e($errors->has('to_date') ? ' is-invalid' : ''); ?>" name="to_date" id="input_to_date" type="text" placeholder="<?php echo e(__('')); ?>" value="<?php echo e(old('to_date')); ?> "   aria-required="true" required>
                    
                      <?php echo $__env->make('alerts.feedback', ['field' => 'to_date'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div>

               

            <div class="card-footer ml-auto mr-auto">
                <button type="submit" id="get_report" class="btn btn-rose mx-auto"><?php echo e(__('Get Report')); ?></button>

            </div>

              <div class="text-center"> 

               <span style="color:red;" id="just_wait" class="hidden">just wait..</span>

              </div>

              

            </form>

                   
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
               

                    <table id="" class="table table-no-bordered datatables_availability" style="display: none;">    
                        <thead class="text-primary">
                         <tr>
                              <th>
                                  <?php echo e(__('#')); ?>

                              </th>
                             <th>
                                  <?php echo e(__('Outlet')); ?>

                              </th>
                              <th>
                                  <?php echo e(__('Product')); ?>

                              </th>
                              <th>
                                  <?php echo e(__('Date')); ?>

                              </th>
                           
                              <th>
                                  <?php echo e(__('Merchandiser')); ?>

                              </th>
                               <th>
                                  <?php echo e(__('Status')); ?>

                              </th>
                               <th>
                                  <?php echo e(__('Reason')); ?>

                              </th>
                             
                          </tr>
                      </thead>

                        <tbody id="availability_data">       

                       
                        </tbody>

                    </table>

                     <table id="" class="table table-no-bordered datatables_visibility" style="display: none;">    
                        <thead class="text-primary">
                         <tr>
                              <th>
                                  <?php echo e(__('#')); ?>

                              </th>
                             <th>
                                  <?php echo e(__('Outlet')); ?>

                              </th>
                              <th>
                                  <?php echo e(__('Date')); ?>

                              </th>
                           
                              <th>
                                  <?php echo e(__('Merchandiser')); ?>

                              </th>
                              <th>
                                <?php echo e(__('Category')); ?>

                              </th>
                              <th hidden="">
                                  <?php echo e(__('Visibility')); ?>

                              </th>
                               <th>
                                  <?php echo e(__('Visibility')); ?>

                              </th>
                               <th>
                                  <?php echo e(__('Reason')); ?>

                              </th>
                             
                          </tr>
                      </thead>

                        <tbody id="visibility_data">       

                       
                        </tbody>

                    </table>

                     <table id="" class="table table-no-bordered datatables_share_of_shelf" style="display: none;">    
                        <thead class="text-primary">
                         <tr>
                              <th>
                                  <?php echo e(__('#')); ?>

                              </th>
                             <th>
                                  <?php echo e(__('Outlet')); ?>

                              </th>
                              <th>
                                  <?php echo e(__('Date')); ?>

                              </th>
                           
                              <th>
                                  <?php echo e(__('Merchandiser')); ?>

                              </th>
                               <th>
                                  <?php echo e(__('Total Shelf(M)')); ?>

                              </th>
                               <th>
                                  <?php echo e(__('Actual Shelf(M)')); ?>

                              </th>
                               <th>
                                  <?php echo e(__('Total Target(%)')); ?>

                              </th>
                               <th>
                                  <?php echo e(__('Actual Target(%)')); ?>

                              </th>
                               <th>
                                  <?php echo e(__('Reason')); ?>

                              </th>
                             
                          </tr>
                      </thead>

                        <tbody id="share_of_shelf_data">       

                       
                        </tbody>

                    </table>


                    <table id="" class="table table-no-bordered datatables_planogram" style="display: none;">    
                        <thead class="text-primary">
                         <tr>
                              <th>
                                  <?php echo e(__('#')); ?>

                              </th>
                             <th>
                                  <?php echo e(__('Outlet')); ?>

                              </th>
                              <th>
                                  <?php echo e(__('Date')); ?>

                              </th>
                           
                              <th>
                                  <?php echo e(__('Merchandiser')); ?>

                              </th>
                              <th>
                                <?php echo e(__('Category')); ?>

                              </th>
                              <th hidden="">
                                  <?php echo e(__('Before Image')); ?>

                              </th>
                              <th hidden="">
                                  <?php echo e(__('After Image')); ?>

                              </th>

                               <th>
                                  <?php echo e(__('Before Image')); ?>

                              </th>
                              <th>
                                  <?php echo e(__('After Image')); ?>

                              </th>
                              
                             
                          </tr>
                      </thead>

                        <tbody id="planogram_data">       

                       
                        </tbody>

                    </table>

                    <table id="" class="table table-no-bordered datatables_promotion" style="display: none;">    
                        <thead class="text-primary">
                         <tr>
                              <th>
                                  <?php echo e(__('#')); ?>

                              </th>
                             <th>
                                  <?php echo e(__('Outlet')); ?>

                              </th>
                              <th>
                                  <?php echo e(__('Date')); ?>

                              </th>
                           
                              <th>
                                  <?php echo e(__('Merchandiser')); ?>

                              </th>
                               <th>
                                  <?php echo e(__('Available ?')); ?>

                              </th>
                               <th>
                                  <?php echo e(__('Reason')); ?>

                              </th>
                               <th hidden="">
                                  <?php echo e(__('Image')); ?>

                              </th>
                              
                             
                          </tr>
                      </thead>

                        <tbody id="promotion_data">       

                       
                        </tbody>

                    </table>

                    <table id="" class="table table-no-bordered datatables_competitor" style="display: none;">    
                        <thead class="text-primary">
                         <tr>
                              <th>
                                  <?php echo e(__('#')); ?>

                              </th>
                             <th>
                                  <?php echo e(__('Outlet')); ?>

                              </th>
                              <th>
                                  <?php echo e(__('Date')); ?>

                              </th>
                           
                              <th>
                                  <?php echo e(__('Merchandiser')); ?>

                              </th>
                               <th>
                                  <?php echo e(__('Company Name')); ?>

                              </th>
                               <th>
                                  <?php echo e(__('Brand Name')); ?>

                              </th>
                              <th>
                                  <?php echo e(__('Category Name')); ?>

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

                               <th hidden="">
                                  <?php echo e(__('Image')); ?>

                              </th>
                              
                             
                          </tr>
                      </thead>

                        <tbody id="competitor_data">       

                       
                        </tbody>

                    </table>

                     <table id="" class="table table-no-bordered datatables_stock_expiry" style="display: none;">    
                        <thead class="text-primary">
                         <tr>
                              <th>
                                  <?php echo e(__('#')); ?>

                              </th>
                             <th>
                                  <?php echo e(__('Outlet')); ?>

                              </th>
                              <th>
                                  <?php echo e(__('Date')); ?>

                              </th>
                           
                              <th>
                                  <?php echo e(__('Merchandiser')); ?>

                              </th>
                              
                               <th>
                                  <?php echo e(__('Brand Name')); ?>

                              </th>
                              <th>
                                  <?php echo e(__('Product Name')); ?>

                              </th>
                              <th>
                                  <?php echo e(__('Type')); ?>

                              </th>
                            
                              <th>
                                  <?php echo e(__('Price')); ?>

                              </th>
                              <th>
                                  <?php echo e(__('Expiry Date')); ?>

                              </th>
                              <th>
                                  <?php echo e(__('Near Expire QTY')); ?>

                              </th>
                              <th>
                                  <?php echo e(__('Near Exp Value')); ?>

                              </th>
                              <th>
                                  <?php echo e(__('Exposure QTY')); ?>

                              </th>
                              <th>
                                  <?php echo e(__('Estimate Exposure Value')); ?>

                              </th>
                              <th>
                                  <?php echo e(__('Period')); ?>

                              </th>

                             
                          </tr>
                      </thead>

                        <tbody id="stock_expiry_data">       

                       
                        </tbody>

                    </table>

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
  
           <form method="post" action="<?php echo e(url('filter_defined_journey')); ?>" class="form-inline" enctype="multipart/form-data" action="" autocomplete="off" style="text-align: right;">
              <?php echo csrf_field(); ?>
              <?php echo method_field('post'); ?>
          
               <div class="col-lg-4">

                 <select class="form-control selectpicker" data-style="select-with-transition" title="Select Merchandiser" data-size="7" name="employee_id" id="employee_id" 
                     value="<?php echo e(old('employee_id')); ?>" aria-required="true">
 
                     <option value="" selected disabled>Select Merchandiser</option>
                       
                       
                    </select>
              

               </div>

             
                <div class="col-lg-4">
                 <input type="text" class="form-control datepicker" value="" id="startdate" placeholder="Start Date" name="startdate">
               </div> 



                <div class="col-lg-2">
                 <input type="text" class="form-control datepicker" value="" id="enddate" placeholder="End Date" name="enddate">
               </div> 

                <div class="col-lg-4">
                    

                    <select class="form-control selectpicker" data-style="select-with-transition" title="Select Outlet" data-size="7" name="outlet_id" id="outlet_idoutlet_id" 
                     value="<?php echo e(old('outlet_id')); ?>" aria-required="true">

                      <option value="" disabled=""> Select Outlets</option>
                     
                    </select>
                </div> 

                 <div class="col-lg-2">
                    
                 
                       <select class="form-control<?php echo e($errors->has('status') ? ' is-invalid' : ''); ?>" name="status" id="status" value="<?php echo e(old('status')); ?>" >
                     
                       <option value="">Select</option>
                       <option value="1" >Completed</option>
                       <option value="0" >Pending</option>
                      </select>
                   
                    
                    
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

 

<!-- Classic Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"> Visibility Image</h4>
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
      $(".js-select2-multi").select2();

      $(".large").select2({
        dropdownCssClass: "big-drop",
      });

    $("#mail_sending").hide();
    
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


    $(document).ready(function() {

     // $('.datatables_availability').fadeIn(1100);

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

        // var table = $('.datatables_availability').DataTable({


        // targets: [10,11],
        // dom: 'lBfrtip',
        // // buttons: [
        // //             'excel'
        // //         ],

        // buttons: [{
        //     extend: 'excelHtml5',
        //     className: 'btn-primary',
        //     text: 'Export',
        //     filename: function(){
        //         var dt = new Date();
        //         dt.getDate() + "/" + (dt.getMonth() + 1) + "/" + dt.getFullYear();
        //         return 'availability_report-' + dt;
        //     },
        //     //title: 'alpin_excel',
        //     exportOptions: {
        //         modifier: {
        //             page: 'all'
        //         },
        //         columns: [0, 1, 2, 3, 4],
        //     },
          

        // }],

        // select: true,

        // responsive: true,
        // language: {
        //   search: "_INPUT_",
        //   searchPlaceholder: "Search Availabity",
        // },


        //   order: [[1, 'asc']],
        //   rowGroup: {
        //     // Uses the 'row group' plugin
        //     dataSrc: 1,
        //     startRender: function (rows, group) {
        //         var collapsed = !!collapsedGroups[group];

        //         rows.nodes().each(function (r) {
        //             r.style.display = collapsed ? 'none' : '';
        //         });    

        //         // Add category name to the <tr>. NOTE: Hardcoded colspan
        //         return $('<tr/>')
        //             .append('<td colspan="8" style="cursor:pointer;">' + group + ' (' + rows.count() + ')</td>')
        //             .attr('data-name', group)
        //             .toggleClass('collapsed', collapsed);
        //     }
        //   }
        // });

       $('#datatables tbody').on('click', 'tr.group-start', function () {
            var name = $(this).data('name');
            collapsedGroups[name] = !collapsedGroups[name];
            table.draw(false);
        });  

    });
  

    $('table').on('click', 'tr.parent .expand', function(){
      $(this).closest('tbody').toggleClass('open');
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
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

            $("#mail_sending").show();
            $('#export_timesheet').css("pointer-events","none");

          $.ajax({
              url: '/export_schedule',
              type: 'POST',
              data: {type : type, employee_id : emp_id, start_date : startdate, end_date : enddate, '_token': csrf},
              dataType: 'json',

              success: function( data ) {

                $("#mail_sending").hide();
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

   

    function DoSomething(data)
      {
     // alert(data);
      $('#FullImage').attr('src',data );
      $('#myModal').modal('show');

      }


    $("#get_report").click(function(e) { 

        $("#just_wait").removeClass("hidden");

        e.preventDefault(); // avoid to execute the actual submit of the form.
        //alert();

        var csrf = $('meta[name="csrf-token"]').attr('content');

        var outlet_id = $("#input_outlet_id").val();
        var activity = $("#activity").val();
        var from_date = $("#input_from_date").val();
        var to_date = $("#input_to_date").val();

        //alert(activity);

        $('.datatables_availability').hide();
        $('.datatables_visibility').hide();
        $('.datatables_share_of_shelf').hide();
        $('.datatables_planogram').hide();
        $('.datatables_promotion').hide();
        $(".datatables_competitor").hide();
        $(".datatables_stock_expiry").hide();

        $.ajax({
          url: '/get_client_report',
          type: 'POST',
          data: {outlet_id : outlet_id, activity : activity, from_date : from_date, to_date : to_date, '_token': csrf},
          dataType: 'json',

          success: function( data ) {

                $("#just_wait").addClass("hidden");

                var html = "";
                var i = 1;
                //alert(data);
                if(activity =="Availabity")
                {
                        $('.datatables_availability').DataTable().destroy();
                         $('.datatables_visibility').DataTable().destroy();
                         $('.datatables_planogram').DataTable().destroy();
                        $('.datatables_share_of_shelf').DataTable().destroy();
                        $('.datatables_promotion').DataTable().destroy();
                        $('.datatables_competitor').DataTable().destroy();
                        $('.datatables_stock_expiry').DataTable().destroy();
                
                        $.each(data, function (key, val) {
                            //alert(data[key].product_id);

                            html += '<tr>';
                            html += '<td>' + i++ + '</td>';
                            html += '<td>' + data[key].store_code +'-'+ data[key].store_name +'-'+ data[key].address + '</td>';

                            html += '<td>' + data[key].product_name + '</td>';
                            
                            html += '<td>' + data[key].date + '</td>';
                           
                            html += '<td>' +data[key].first_name +' '+ data[key].surname +  '</td>';

                            if(data[key].is_available == 0)
                            {
                                html += '<td> Not Available </td>';
                            }

                            if(data[key].is_available == 1)
                            {
                                html += '<td> Available </td>';
                            }

                            if(data[key].is_available == 0)
                            {
                                html += '<td>' + data[key].reason + '</td>';
                            }

                            if(data[key].is_available == 1)
                            {
                                html += '<td> - </td>';
                            }

                            html += ' </tr>';
                       
                        });


                $(".datatables_availability").show();

                $("#availability_data").html(html);

                //$('.datatables_availability').fadeIn(1100);
                
                $('.datatables_availability').DataTable({

                    targets: [10,11],
                    dom: 'lBfrtip',
                  
                    buttons: [{
                        extend: 'excelHtml5',
                        className: 'btn-primary',
                        text: 'Export',
                        filename: function(){
                            var dt = new Date();
                            dt.getDate() + "/" + (dt.getMonth() + 1) + "/" + dt.getFullYear();
                            return 'availability_report-' + dt;
                        },
                        //title: 'alpin_excel',
                        exportOptions: {
                            modifier: {
                                page: 'all'
                            },
                            columns: [0, 1, 2, 3, 4, 5,6],
                        },
                      

                    }],

                    select: true,

                    responsive: true,
                    language: {
                      search: "_INPUT_",
                      searchPlaceholder: "Search Availabity",
                    },


                      order: [[1, 'asc']],
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
                }).reload();
             }

                if(activity =="Visibility") 
                {
                        $('.datatables_availability').DataTable().destroy();
                        $('.datatables_visibility').DataTable().destroy();
                        $('.datatables_share_of_shelf').DataTable().destroy();
                        $('.datatables_planogram').DataTable().destroy();
                        $('.datatables_promotion').DataTable().destroy();
                        $('.datatables_competitor').DataTable().destroy();
                        $('.datatables_stock_expiry').DataTable().destroy();
                
                        $.each(data, function (key, val) {
                            //alert(data[key].product_id);

                            html += '<tr>';
                            html += '<td>' + i++ + '</td>';
                            html += '<td>' + data[key].store_code +'-'+ data[key].store_name +'-'+ data[key].address + '</td>';
                            
                            html += '<td>' + data[key].date + '</td>';
                           
                            html += '<td>' +data[key].first_name +' '+ data[key].surname +  '</td>';

                            html += '<td>' +data[key].category_name +'</td>';

                            if(data[key].is_available == 0)
                            {
                                html += '<td hidden> Not Available </td>';
                            }

                            if(data[key].is_available == 1)
                            {
                                html += '<td hidden> https://rms2.rhapsody.ae/visibility_image/'+data[key].image_url+' </td>';
                            }

                            if(data[key].is_available == 0)
                            {
                                html += '<td > Not Available </td>';
                            }

                            if(data[key].is_available == 1)
                            {
                                html += '<td> <a href="/visibility_image/'+data[key].image_url+' " target="_blank">View</a> </td>';
                            }

                            if(data[key].is_available == 0)
                            {
                                html += '<td>' + data[key].reason + '</td>';
                            }

                            if(data[key].is_available == 1)
                            {
                                html += '<td> - </td>';
                            }

                            html += ' </tr>';
                       
                        });


                $(".datatables_visibility").show();

                $("#visibility_data").html(html);

                //$('.datatables_availability').fadeIn(1100);
                
                $('.datatables_visibility').DataTable({

                    targets: [10,11],
                    dom: 'lBfrtip',
                  
                    buttons: [{
                        extend: 'excelHtml5',
                        className: 'btn-primary',
                        text: 'Export',
                        filename: function(){
                            var dt = new Date();
                            dt.getDate() + "/" + (dt.getMonth() + 1) + "/" + dt.getFullYear();
                            return 'visibility_report-' + dt;
                        },
                        //title: 'alpin_excel',
                        exportOptions: {
                            modifier: {
                                page: 'all'
                            },
                            columns: [0, 1, 2, 3, 4, 5,7],
                        },
                      

                    }],

                    select: true,

                    responsive: true,
                    language: {
                      search: "_INPUT_",
                      searchPlaceholder: "Search visibility",
                    },


                      order: [[1, 'asc']],
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
                }).reload();
            }

            if(activity =="Share_Of_Shelf")
            {

                    $('.datatables_availability').DataTable().destroy();
                    $('.datatables_visibility').DataTable().destroy();
                    $('.datatables_share_of_shelf').DataTable().destroy();
                    $('.datatables_planogram').DataTable().destroy();
                    $('.datatables_promotion').DataTable().destroy();
                    $('.datatables_competitor').DataTable().destroy();
                    $('.datatables_stock_expiry').DataTable().destroy();
                
                        $.each(data, function (key, val) {
                            //alert(data[key].product_id);

                            html += '<tr>';
                            html += '<td>' + i++ + '</td>';
                            html += '<td>' + data[key].store_code +'-'+ data[key].store_name +'-'+ data[key].address + '</td>';
                            
                            html += '<td>' + data[key].date + '</td>';
                           
                            html += '<td>' +data[key].first_name +' '+ data[key].surname +  '</td>';

                           
                            html += '<td>' + data[key].total_share + '</td>';

                            html += '<td>' + data[key].share + '</td>';

                            html += '<td>' + data[key].target + '</td>';

                            html += '<td>' + data[key].actual + '</td>';
                           
                           
                            if(data[key].reason)
                            {
                                html += '<td>' + data[key].reason + '</td>';
                            }
                            else
                            {
                                html += '<td> - </td>';
                            }

                           
                            html += ' </tr>';
                       
                        });


                $(".datatables_share_of_shelf").show();

                $("#share_of_shelf_data").html(html);

                //$('.datatables_availability').fadeIn(1100);

                $('.datatables_share_of_shelf').DataTable({

                    targets: [10,11],
                    dom: 'lBfrtip',
                  
                    buttons: [{
                        extend: 'excelHtml5',
                        className: 'btn-primary',
                        text: 'Export',
                        filename: function(){
                            var dt = new Date();
                            dt.getDate() + "/" + (dt.getMonth() + 1) + "/" + dt.getFullYear();
                            return 'share_of_shelf_report-' + dt;
                        },
                        //title: 'alpin_excel',
                        exportOptions: {
                            modifier: {
                                page: 'all'
                            },
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                        },
                      

                    }],

                    select: true,

                    responsive: true,
                    language: {
                      search: "_INPUT_",
                      searchPlaceholder: "Search Share Of Shelf",
                    },

                      order: [[1, 'asc']],
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
                }).reload();


            }


            if(activity =="Planogram")
            {

                    $('.datatables_availability').DataTable().destroy();
                    $('.datatables_visibility').DataTable().destroy();
                    $('.datatables_share_of_shelf').DataTable().destroy();
                    $('.datatables_planogram').DataTable().destroy();
                    $('.datatables_promotion').DataTable().destroy();
                    $('.datatables_competitor').DataTable().destroy();
                    $('.datatables_stock_expiry').DataTable().destroy();
                
                        $.each(data, function (key, val) {
                            //alert(data[key].product_id);

                            html += '<tr>';
                            html += '<td>' + i++ + '</td>';
                            html += '<td>' + data[key].store_code +'-'+ data[key].store_name +'-'+ data[key].address + '</td>';
                            
                            html += '<td>' + data[key].date + '</td>';
                           
                            html += '<td>' +data[key].first_name +' '+ data[key].surname +  '</td>';

                            html += '<td>' +data[key].category_name +'</td>';

                          
                            html += '<td hidden> planogram_image/'+data[key].before_image+' </td>';

                            html += '<td hidden> planogram_image/'+data[key].after_image+' </td>';
                           
                            
                            html += '<td><a href="/planogram_image/'+data[key].before_image+' " target="_blank">View</a> </td>';

                            html += '<td><a href="/planogram_image/'+data[key].after_image+' " target="_blank">View</a> </td>';
                            
                           

                            html += ' </tr>';
                       
                        });


                $(".datatables_planogram").show();

                $("#planogram_data").html(html);

                //$('.datatables_availability').fadeIn(1100);

                $('.datatables_planogram').DataTable({

                    targets: [10,11],
                    dom: 'lBfrtip',
                  
                    buttons: [{
                        extend: 'excelHtml5',
                        className: 'btn-primary',
                        text: 'Export',
                        filename: function(){
                            var dt = new Date();
                            dt.getDate() + "/" + (dt.getMonth() + 1) + "/" + dt.getFullYear();
                            return 'planogram_report-' + dt;
                        },
                        exportOptions: {
                            modifier: {
                                page: 'all'
                            },
                            columns: [0, 1, 2, 3, 4, 5, 6],
                        },
                      

                    }],

                    select: true,

                    responsive: true,
                    language: {
                      search: "_INPUT_",
                      searchPlaceholder: "Search Planogram",
                    },

                      order: [[1, 'asc']],
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
                }).reload();


            }


            if(activity =="Promotion_Check")
            {

                    $('.datatables_availability').DataTable().destroy();
                     $('.datatables_visibility').DataTable().destroy();
                    $('.datatables_share_of_shelf').DataTable().destroy();
                    $('.datatables_planogram').DataTable().destroy();
                    $('.datatables_promotion').DataTable().destroy();
                    $('.datatables_competitor').DataTable().destroy();
                    $('.datatables_stock_expiry').DataTable().destroy();
                
                        $.each(data, function (key, val) {
                            //alert(data[key].product_id);

                            html += '<tr>';
                            html += '<td>' + i++ + '</td>';
                            html += '<td>' + data[key].store_code +'-'+ data[key].store_name +'-'+ data[key].address + '</td>';
                            
                            html += '<td>' + data[key].date + '</td>';
                           
                            html += '<td>' +data[key].first_name +' '+ data[key].surname +  '</td>';

                           
                            if(data[key].is_available == 0)
                            {
                                html += '<td> Not Available </td>';
                            }

                            if(data[key].is_available == 1)
                            {
                                html += '<td> Available </td>';
                            }


                            if(data[key].is_available == 0)
                            {
                                html += '<td>' + data[key].reason + '</td>';
                            }

                            if(data[key].is_available == 1)
                            {
                                html += '<td> - </td>';
                            }

                            html += '<td hidden>' +"http://rms2.rhapsody.ae/promotion_image/" + data[key].image_url + '</td>';

                           
                            html += ' </tr>';


                       
                        });


                $(".datatables_promotion").show();

                $("#promotion_data").html(html);

                //$('.datatables_availability').fadeIn(1100);

                $('.datatables_promotion').DataTable({

                    targets: [10,11],
                    dom: 'lBfrtip',
                  
                    buttons: [{
                        extend: 'excelHtml5',
                        className: 'btn-primary',
                        text: 'Export',
                        filename: function(){
                            var dt = new Date();
                            dt.getDate() + "/" + (dt.getMonth() + 1) + "/" + dt.getFullYear();
                            return 'promotion_report-' + dt;
                        },
                        //title: 'alpin_excel',
                        exportOptions: {
                            modifier: {
                                page: 'all'
                            },
                            columns: [0, 1, 2, 3, 4, 5, 6],
                        },
                      

                    }],

                    select: true,

                    responsive: true,
                    language: {
                      search: "_INPUT_",
                      searchPlaceholder: "Search Promotion",
                    },

                      order: [[1, 'asc']],
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
                }).reload();


            }

            if(activity =="Competitor_Info")
            {

                    $('.datatables_availability').DataTable().destroy();
                     $('.datatables_visibility').DataTable().destroy();
                    $('.datatables_share_of_shelf').DataTable().destroy(); 
                    $('.datatables_planogram').DataTable().destroy();
                    $('.datatables_promotion').DataTable().destroy();
                    $('.datatables_competitor').DataTable().destroy();
                    $('.datatables_stock_expiry').DataTable().destroy();
                
                        $.each(data, function (key, val) {
                            //alert(data[key].product_id);

                            html += '<tr>';
                            html += '<td>' + i++ + '</td>';
                            html += '<td>' + data[key].store_code +'-'+ data[key].store_name +'-'+ data[key].address + '</td>';
                            
                            html += '<td>' + data[key].date + '</td>';
                           
                            html += '<td>' +data[key].first_name +' '+ data[key].surname +  '</td>';

                            html += '<td> '+ data[key].company_name +' </td>';
                       
                            html += '<td> '+ data[key].brand_name +' </td>';

                            html += '<td> '+ data[key].category_name +' </td>';
                            html += '<td> '+ data[key].item_name +' </td>';
                            html += '<td> '+ data[key].promotion_type +' </td>';
                            html += '<td> '+ data[key].mrp +' </td>';
                            html += '<td> '+ data[key].selling_price +' </td>';
                          
                            html += '<td hidden>' +"http://rms2.rhapsody.ae/promotion_image/" + data[key].capture_image + '</td>';

                           
                            html += ' </tr>';


                       
                        });


                $(".datatables_competitor").show();

                $("#competitor_data").html(html);

                //$('.datatables_availability').fadeIn(1100);

                $('.datatables_competitor').DataTable({

                    targets: [10,11],
                    dom: 'lBfrtip',
                  
                    buttons: [{
                        extend: 'excelHtml5',
                        className: 'btn-primary',
                        text: 'Export',
                        filename: function(){
                            var dt = new Date();
                            dt.getDate() + "/" + (dt.getMonth() + 1) + "/" + dt.getFullYear();
                            return 'competitor_report-' + dt;
                        },
                        //title: 'alpin_excel',
                        exportOptions: {
                            modifier: {
                                page: 'all'
                            },
                            columns: [0, 1, 2, 3, 4, 5, 6,7,8,9,10,11],
                        },
                      

                    }],

                    select: true,

                    responsive: true,
                    language: {
                      search: "_INPUT_",
                      searchPlaceholder: "Search Competitor",
                    },

                      order: [[1, 'asc']],
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
                }).reload();


            }


            if(activity =="Stock_Report")
            {

                    $('.datatables_availability').DataTable().destroy();
                     $('.datatables_visibility').DataTable().destroy();
                    $('.datatables_share_of_shelf').DataTable().destroy(); 
                    $('.datatables_planogram').DataTable().destroy();
                    $('.datatables_promotion').DataTable().destroy();
                    $('.datatables_competitor').DataTable().destroy();
                    $('.datatables_stock_expiry').DataTable().destroy();
                
                        $.each(data, function (key, val) {
                            //alert(data[key].product_id);

                            html += '<tr>';
                            html += '<td>' + i++ + '</td>';
                            html += '<td>' + data[key].store_code +'-'+ data[key].store_name +'-'+ data[key].address + '</td>';
                            
                            html += '<td>' + data[key].date + '</td>';
                           
                            html += '<td>' +data[key].first_name +' '+ data[key].surname +  '</td>';

                            html += '<td> '+ data[key].brand_name +' </td>';
                       
                            html += '<td> '+ data[key].product_name +' </td>';

                            html += '<td> '+ data[key].type +' </td>';
                            html += '<td> '+ data[key].piece_price +' </td>';
                            html += '<td> '+ data[key].expiry_date +' </td>';
                            html += '<td> '+ data[key].near_expiry +' </td>';
                            html += '<td> '+ data[key].near_expiry_value +' </td>';
                            html += '<td> '+ data[key].exposure_qty +' </td>';
                            html += '<td> '+ data[key].extimate_expire_value +' </td>';
                            html += '<td> '+'P'+ data[key].period +' </td>';
                          
                           
                            html += ' </tr>';


                       
                        });


                $(".datatables_stock_expiry").show();

                $("#stock_expiry_data").html(html);

                //$('.datatables_availability').fadeIn(1100);

                $('.datatables_stock_expiry').DataTable({

                    targets: [10,11],
                    dom: 'lBfrtip',
                  
                    buttons: [{
                        extend: 'excelHtml5',
                        className: 'btn-primary',
                        text: 'Export',
                        filename: function(){
                            var dt = new Date();
                            dt.getDate() + "/" + (dt.getMonth() + 1) + "/" + dt.getFullYear();
                            return 'stock_report-' + dt;
                        },
                        //title: 'alpin_excel',
                        exportOptions: {
                            modifier: {
                                page: 'all'
                            },
                            columns: [0, 1, 2, 3, 4, 5, 6,7,8,9,10,11,12,13],
                        },
                      

                    }],

                    select: true,

                    responsive: true,
                    language: {
                      search: "_INPUT_",
                      searchPlaceholder: "Search Stock",
                    },

                      order: [[1, 'asc']],
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
                }).reload();


            }

            
             
          }       
      });

      
    });



  </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', ['activePage' => 'client_outlet_report', 'menuParent' => 'Outlets', 'titlePage' => __('Client Report')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thethethoughtfactory/Desktop/RMS-2-11-21/resources/views/client_outlet_report/report/index.blade.php ENDPATH**/ ?>