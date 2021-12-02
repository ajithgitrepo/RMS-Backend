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
                <h4 class="card-title"><?php echo e(__('Store Details')); ?></h4>
              </div>
              <div class="card-body">

                <div class="row">
                    <div class="col-12 text-right">
                      <a class="btn btn-sm btn-warning" style="color: #fff;" data-toggle="modal" data-target="#modelWindow" ><?php echo e(__('Filter')); ?></a>
                    </div>
                  </div>

               <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['isClient','isTopManagement','isAdmin'],App\User::class)): ?>
                  <div class="row">
                    <div class="col-12 text-right">
                      <a href="<?php echo e(route('store_details.create')); ?>" class="btn btn-sm btn-rose"><?php echo e(__('Add Store details')); ?></a>
                    </div>
                  </div>
               <?php endif; ?>
                <div class="table-responsive">
                  <table id="datatables" class="table table-striped table-no-bordered table-hover" style="display:none">
                    <thead class="text-primary">
                    
                      <th>
                          <?php echo e(__('ID')); ?>

                      </th>
                      
                      <th>
                          <?php echo e(__('Store_Code')); ?>

                      </th>
                      
                      <th>
                          <?php echo e(__('Store_Name')); ?>

                      </th>
                      
                      <th>
                          <?php echo e(__('Contact_Number')); ?>

                      </th>
                      
                      <th>
                          <?php echo e(__('Address')); ?>

                      </th>
                     
                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['isClient','isTopManagement','isAdmin'],App\User::class)): ?>
                        <th>
                            <?php echo e(__('Action')); ?>

                        </th>
                     <?php endif; ?>
                     
                    </thead>
                    
                    <tbody>

                      <?php

                        $i=1

                      ?>
                      
              	       
                               
                      <?php $__currentLoopData = $store; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $st): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                        
                          <td>
                            <?php echo e($i++); ?>

                          </td>
                          
                          <td>
                            <?php echo e($st->store_code); ?>

                          </td>
                          
                          <td>
                            <?php echo e($st->store_name); ?>

                          </td>
                          
                          <td>
                            <?php echo e($st->contact_number); ?>

                          </td>
                          
                          <td>
                            <?php echo e($st->address); ?>

                          </td>
                          
                        
                           <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['isClient','isTopManagement','isAdmin'],App\User::class)): ?>
                           
                           <td class="display-block">
                              <form action="<?php echo e(route('store_details.destroy', $st->id)); ?>" method="post">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('delete'); ?>
                                          <a rel="tooltip" class="btn btn-success btn-action btn-link view-edit" href="<?php echo e(route('store_details.edit', 
                                           $st->id)); ?>" data-original-title="" title="">
                                            <i class="material-icons">edit</i>
                                            <div class="ripple-container"></div>
                                           </a>
                                      
                                          <button type="button" class="btn btn-danger btn-link view-edit" data-original-title="" title=""    onclick="confirm('<?php echo e(__("Are you sure you want to delete this store_details?")); ?>') ? this.parentElement.submit() : ''">
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

                   
                    <div class="d-flex justify-content-center">
                        <?php echo $store->links(); ?>

                    </div>

                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>



    <!--Model session filter for store--> 
   <div class="modal fade bd-example-modal-lg" id="modelWindow" role="dialog" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" 
          aria-hidden="true">
            <div class="modal-dialog modal-lg vertical-align-center">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title"><b> Filter Options</b></h4>
                </div>
                
                <div class="modal-body">
                <form method="get" action="<?php echo e(url('filter_store')); ?>" class="form-inline" enctype="multipart/form-data" action="" autocomplete="off" style="text-align: right;">
                
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('get'); ?>
                
                
                   <div class="row" style="width: 100%;">

                    <div class="col-sm-8">
                     <div class="form-group">
                      <select class="form-control selectpicker js-select2 " data-style="select-with-transition" title="Select Store" data-size="7" name="store_id" required="" id="input-store_id" value="<?php echo e(old('store_id')); ?>" aria-required="true"  >
                       <option value="" selected="">-- All Stores --</option>
                        <?php $__currentLoopData = $use_filter; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $st): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($st->id); ?>"> <?php echo e($st->store_code); ?> - <?php echo e($st->store_name); ?> - <?php echo e($st->address); ?> </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                  
                     </div>
                   </div>
        
                 
                    <div class="col-sm-4">
                     <div class="form-group">
                     <input class="form-control <?php echo e($errors->has('store_code') ? ' is-invalid' : ''); ?>" name="store_code" id="input-store_code" type="text" placeholder="<?php echo e(__('Store Code')); ?>" value="<?php echo e(old('store_code')); ?>" >
                      
                     </div>
                   </div>

                   
                     <div class="col-sm-12 text-right">
                     <div class="form-group">
                    

                       <button type ="submit" class="btn btn-info btn-sm mx-auto ">Filter</button>
                    </div>
                  </div>
                 
     
                 </div>  

                  
                           
                </form>
               
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
                </div>
              </div>
            </div>
          </div>

  

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
  <script>

    $(".js-select2").select2();

    $('.js-select2').select2({
        dropdownParent: $('#modelWindow')
    });


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
      $('#datatables').fadeIn(1100);
      $('#datatables').DataTable({
        "paging":   false,
        "pagingType": "full_numbers",
        "lengthMenu": [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
        ],
        responsive: true,
        language: {
          search: "_INPUT_",
          searchPlaceholder: "Search Store",
        }
      });
    });

   
 
  </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', ['activePage' => 'store_details', 'menuParent' => 'Store_Details', 'titlePage' => __('Store 
Details')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thethethoughtfactory/Desktop/RMS-2-11-21/resources/views/store_details/index.blade.php ENDPATH**/ ?>