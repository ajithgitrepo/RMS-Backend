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
                <h4 class="card-title"><?php echo e(__('Category ')); ?></h4>
              </div>
              
              
              <div class="card-body">
            
    		  <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['isClient','isTopManagement','isAdmin'],App\User::class)): ?>
                  <div class="row">
                    <div class="col-12 text-right">
                      <a href="<?php echo e(route('category_details.create')); ?>" class="btn btn-sm btn-rose"><?php echo e(__('Add Category')); ?></a>
                    </div>
                  </div>
                <?php endif; ?>
	 
                 
              <div class="table-responsive">
                  <table id="datatables" class="table table-striped table-no-bordered table-hover" style="display:none">
                    <thead class="text-primary">
                      <th>
                          <?php echo e(__('S.No')); ?>

                      </th>
                     <!--  <th>
                          <?php echo e(__('Brand')); ?>

                      </th -->
                      <th>
                          <?php echo e(__('Category')); ?>

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
                
                      <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               
                        <tr>
                          
                          <td>
                            <?php echo e(++$i); ?>

                          </td>
                         
                          <td>
                            <?php echo e($cat->category_name); ?>

                          </td>
        
                     	   <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['isClient','isTopManagement','isAdmin'],App\User::class)): ?>
                             <td class="display-block">
                              <form action="<?php echo e(route('category_details.destroy', $cat->id)); ?>" method="post">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('delete'); ?>
                                          <a rel="tooltip" class="btn btn-success btn-action btn-link view-edit" href="<?php echo e(route('category_details.edit', 
                                          $cat->id)); ?>" data-original-title="" title="">
                                          
                                           
                                            <i class="material-icons">edit</i>
                                            <div class="ripple-container"></div>
                                           </a>
                                      
                                          <button type="button" class="btn btn-danger btn-link view-edit" data-original-title="" title="" 		   
                                          onclick="confirm('<?php echo e(__("Are you sure you want to delete this category_details")); ?>') ? this.parentElement.submit() : ''">
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


 
var resetButtons = document.getElementsByClassName('reset');

// Loop through each reset buttons to bind the click event
for(var i=0; i<resetButtons.length; i++){
  resetButtons[i].addEventListener('click', resetForm);
}

/**
 * Function to hard reset the inputs of a form.
 *
 * @param  object event The event object.
 * @return  void
 */
function resetForm(event){

  event.preventDefault();

  var form = event.currentTarget.form;
  var inputs = form.querySelectorAll('input');

  inputs.forEach(function(input, index){
    input.value = null;
  });

}
 </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', ['activePage' => 'category_details', 'menuParent' => 'Products', 'titlePage' => __('Category Details')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thethethoughtfactory/Desktop/RMS-2-11-21/resources/views/category_details/index.blade.php ENDPATH**/ ?>