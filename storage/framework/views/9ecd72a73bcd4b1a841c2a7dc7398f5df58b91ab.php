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
                <h4 class="card-title"><?php echo e(__('Task ')); ?></h4>
              </div>
              
             
              <div class="card-body">

                <div class="row">
                  <div class="col-md-12 text-right">
                  
                    <a href="<?php echo e(route('outlet.index')); ?>" class="btn btn-sm btn-rose"><?php echo e(__('Back to outlet')); ?></a>
                    
                  </div>
                </div>
           
                <form class="float-right" action="<?php echo e(route('task.store')); ?>" method="POST">
                    <?php echo e(csrf_field()); ?>

                    <label for="" class="bmd-label-floating">Task Name </label>
                    <input type="text" name="outlet_id" value="<?php echo e(Request::segment(3)); ?>" hidden="">
                    <input class="" type="text" name="task_list" required="">
                    <button class="btn btn-info btn-sm" type="submit">Create</button>
                </form>
                <br>
	 
                 
              <div class="table-responsive">
                  <table id="datatables" class="table table-striped table-no-bordered table-hover" style="display:none">
                    <thead class="text-primary">
                      <th>
                          <?php echo e(__('Id')); ?>

                      </th>
                      <th>
                          <?php echo e(__('Task List')); ?>

                      </th>
                      <th>
                          <?php echo e(__('Action')); ?>

                      </th>

                    </thead>
                    
                    <tbody>

                      <?php

                        $i=0

                      ?>
                
                      <?php $__currentLoopData = $task; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               
                        <tr>
                          
                          <td>
                            <?php echo e(++$i); ?>

                          </td>
                          <td>
                            <?php echo e($ta->task_list); ?>

                          </td>
        
                     	    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['isClient'],App\User::class)): ?>
                             <td class="display-block">
                              <form action="<?php echo e(route('task.destroy', $ta->id)); ?>" method="post">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('delete'); ?>
                                                                              
                                          <button type="button" class="btn btn-danger btn-link view-edit" data-original-title="" title="" 		   
                                          onclick="confirm('<?php echo e(__("Are you sure you want to delete this task?")); ?>') ? this.parentElement.submit() : ''">
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

<?php echo $__env->make('layouts.app', ['activePage' => 'outlets', 'menuParent' => 'Outlets', 'titlePage' => __('Outlets')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thethethoughtfactory/Desktop/RMS-2-11-21/resources/views/task/index.blade.php ENDPATH**/ ?>