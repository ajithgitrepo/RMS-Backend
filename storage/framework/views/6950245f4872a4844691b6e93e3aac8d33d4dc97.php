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
                  <i class="fa fa-copyright"></i>
                </div>
                <h4 class="card-title"><?php echo e(__('Brand Details')); ?></h4>
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
                      <a href="<?php echo e(route('brand_details.create')); ?>" class="btn btn-sm btn-rose"><?php echo e(__(' Add Brand ')); ?></a>
                    </div>
                  </div>
                  <?php endif; ?>
          
    
               <div class="table-responsive">
                  <table id="datatables" class="table table-striped table-no-bordered table-hover" style="display:none">
                    <thead class="text-primary">
                      <th>
                          <?php echo e(__('S.No')); ?>

                      </th>
                      <th>
                          <?php echo e(__('Brand')); ?>

                      </th>
                      <th>
                          <?php echo e(__('Client')); ?>

                      </th>
                       <th>
                          <?php echo e(__('Field Manager')); ?>

                      </th>
                      <th>
                          <?php echo e(__('Sales Manager')); ?>

                      </th>
                     <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['isClient','isTopManagement','isAdmin'],App\User::class)): ?>
                       <th>
                          <?php echo e(__('Action')); ?>

                      </th>
                    <?php endif; ?>
                   
                      
                    </thead>
                    
                    <tbody>

                      <?php

                        $i=0

                      ?>
                 
                      <?php $__currentLoopData = $branddetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             
                          <td>
                            <?php echo e(++$i); ?>

                          </td>
                          <td>
                            <?php echo e($brand->brand_name); ?>

                          </td>
                           <td>
                           <?php echo e($brand->employee_client[0]->first_name.' '. $brand->employee_client[0]->middle_name .' '. $brand->employee_client[0]->surname); ?>

                            
                 	     (<?php echo e($brand->client_id); ?>)
                          </td>
                           <td>
                           <?php echo e($brand->employee_field[0]->first_name .' '. $brand->employee_field[0]->middle_name .' '. $brand->employee_field[0]->surname); ?>

                            (<?php echo e($brand->field_manager_id); ?>)
                          </td>
                           <td>
                            <?php echo e($brand->employee_sales[0]->first_name .' '. $brand->employee_sales[0]->middle_name .' '. $brand->employee_sales[0]->surname); ?>

                            (<?php echo e($brand->sales_manager_id); ?>)
                          </td>

                      	    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['isClient','isTopManagement','isAdmin'],App\User::class)): ?>
                             <td class="display-block">
                              <form action="<?php echo e(route('brand_details.destroy', $brand->id)); ?>" method="post">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('delete'); ?>
                                          <a rel="tooltip" class="btn btn-success btn-action btn-link view-edit" href="<?php echo e(route('brand_details.edit', 
                                          $brand->id)); ?>" data-original-title="" title="">
                                          <i class="material-icons">edit</i>
                                            <div class="ripple-container"></div>
                                          </a>
                                      
                                  <button type="button" class="btn btn-danger btn-link view-edit" data-original-title="" title="" 		 
                                   onclick="confirm('<?php echo e(__("Are you sure you want to delete this brand_details")); ?>') ? this.parentElement.submit() : ''">
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
                    <?php echo e($branddetails->links('pagination::bootstrap-4')); ?>

                </div>

                </div>
              </div>
            </div>
            
        </div>
      </div>
    </div>
  </div>


    <!--Model session filter for brand--> 
   <div class="modal fade bd-example-modal-lg" id="modelWindow" role="dialog" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" 
          aria-hidden="true">
            <div class="modal-dialog modal-lg vertical-align-center">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title"><b> Filter Options</b></h4>
                </div>
                
                <div class="modal-body">
                <form method="get" action="<?php echo e(url('filter_brand')); ?>" class="form-inline" enctype="multipart/form-data" action="" autocomplete="off" style="text-align: right;">
                
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('get'); ?>
                
                
                   <div class="row" style="width: 100%;">
                   
                   <div class="col-sm-4">
                    <div class="form-group">
                     <input class="form-control <?php echo e($errors->has('brand_name') ? ' is-invalid' : ''); ?>" name="brand_name" 
                    id="input-brand_name" type="text" placeholder="<?php echo e(__('Brand Name')); ?>" value="<?php echo e(old('brand_name')); ?>" >
                      
                    </div>
                   </div>
         
                <div class="col-sm-4">
                 <div class="form-group">

                  <select class="form-control selectpicker" data-style="select-with-transition"  title="Select Field Manager" data-size="7" name="field_manager_id" id="input-field_manager_id" 
                     value="<?php echo e(old('field_manager_id')); ?>" aria-required="true" >
 
                    <option value="" selected="">Select Field Manager</option>
                    <?php $__currentLoopData = $employ_field; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employ2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($employ2->employee_id); ?>" <?php if( old('field_manager_id') == $employ2->employee_id): ?> 
                    <?php echo e('selected'); ?> <?php endif; ?> > <?php echo e($employ2->first_name); ?> <?php echo e($employ2->middle_name); ?><?php echo e($employ2->surname); ?>

                    (<?php echo e($employ2->employee_id); ?>)</option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          
                    </select>    
                  </div>
                </div>
                
                <div class="col-sm-4">
                 <div class="form-group">

                   <select class="form-control selectpicker" data-style="select-with-transition"  title="Select Sales Manager" data-size="7" name="sales_manager_id" id="input-sales_manager_id" 
                     value="<?php echo e(old('sales_manager_id')); ?>" aria-required="true" >
 
 
                        <option value="" selected="">Select Sales Manager</option>
                        <?php $__currentLoopData = $employ_sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employ3): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($employ3->employee_id); ?>" <?php if( old('sales_manager_id') ==  $employ3->employee_id): ?> <?php echo e('selected'); ?> <?php endif; ?> > <?php echo e($employ3->first_name); ?> <?php echo e($employ3->middle_name); ?> <?php echo e($employ3->surname); ?>

                        (<?php echo e($employ3->employee_id); ?>)</option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      
                    </select>
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

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
      $('#datatables').fadeIn(1100);
      $('#datatables').DataTable({
        "pagingType": "full_numbers",
        "paging": false,
        "lengthMenu": [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
        ],
        responsive: true,
        language: {
          search: "_INPUT_",
          searchPlaceholder: "Search..",
        },
        "columnDefs": [
          { "orderable": false, "targets": 5 },
        ],
      });
    });


function store_brand(id) {
 
    $( '#frm' ).submit( function( e ) {
    
        e.preventDefault();
        var select = $( this ).serialize();
       
        // POST to php script
        $.ajax( {
            type: 'POST',
            url: '/store_brand',
            data: select,
          
            
        }).then( function( data ) {
      // console.log(data);
       // alert(JSON.stringify(data[0]['id']));
        alert(JSON.stringify(data));          
        } );
        return false;
    } );
}

$(document).ready(function()
{
    store_brand();
});



  </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', ['activePage' => 'brand_details', 'menuParent' => 'Products', 'titlePage' => __('Brand Details')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thethethoughtfactory/Desktop/RMS-2-11-21/resources/views/brand_details/index.blade.php ENDPATH**/ ?>