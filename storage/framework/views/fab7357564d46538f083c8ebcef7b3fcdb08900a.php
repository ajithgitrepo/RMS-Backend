
<style type="text/css">
    .form-group input[type=file] {
        opacity: 1 !important;
        position: initial !important;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1;
    }

    .table .td-actions .btn {
    padding: 1px !important;
}

</style>





<?php $__env->startSection('content'); ?>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <!-- <form method="post" action="<?php echo e(route('outlet-products.update', Request::segment(3))); ?>" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('put'); ?> -->

            <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">add_task</i>
                </div>
                <h4 class="card-title"><?php echo e(__('Outlet Activities')); ?></h4>
               </div>
              
              <div class="card-body ">
              
             <!--  
                <ul class="nav nav-pills nav-pills-warning nav-pills-icons justify-content-center" role="tablist">
                        
                      <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#link1" role="tablist">
                          <i class="material-icons">category</i> Category
                        </a>
                      </li> 

                      <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#link2" role="tablist">
                          <i class="material-icons">picture_as_pdf</i> NBL
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

                   
                </ul> -->

                <div class="tab-content tab-space tab-subcategories">
                  <div class="tab-pane active" id="link1">
                    <div class="card">
                      <div class="card-header">
                        <h4 class="card-title">Categories & NBL</h4>
                        <!-- <p class="card-category">
                          More information here
                        </p> -->
                      </div>

                    <div class="row">
                      <div class="col-md-12 text-right">
                        <a href="<?php echo e(route('add_outlet_categories',['id' => Crypt::encrypt(Request::segment(3)) ])); ?>" class="btn btn-sm btn-rose"><?php echo e(__('Add Category & NBL')); ?></a>
                        
                      </div>
                    </div>



                <div class="table-responsive">
                  <table id="datatables" class="table table-striped table-no-bordered table-hover datatable"  >
                    <thead class="text-primary">
                      <th>
                          <?php echo e(__('S.No')); ?>

                      </th>
                     <!--  <th>
                          <?php echo e(__('Client')); ?>

                      </th> -->
                     
                       <th>
                          <?php echo e(__('Category')); ?>

                       </th>

                       <th>
                          <?php echo e(__('Target(Percentage)')); ?>

                       </th>

                        <th>
                          <?php echo e(__('Planogram')); ?>

                       </th>

                       <th>
                          <?php echo e(__('Action')); ?>

                       </th>
                     
                      
                    </thead>

                    <?php

                        $i=1;


                    ?>
                    
                    <tbody id="availability_data">

                         <?php $__currentLoopData = $old_category_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $old_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <tr class="parent">
                              <td>
                                <?php echo e($i++); ?>

                              </td>
                            
                            <!--   <td>
                                <?php echo e($old_category->first_name); ?> <?php echo e($old_category->middle_name); ?> <?php echo e($old_category->surname); ?>

                              </td> -->

                              
                              <td>
                                <?php echo e($old_category->category_name); ?>


                              </td>

                               <td>
                                <?php echo e($old_category->target); ?>


                              </td>

                              <td>
                                   <div class="avatar avatar-sm " style="width:70px; height:70px;overflow: hidden;">
                                      
                                            <img id="" title="View" src="/planogram_image/<?php echo e($old_category->planogram_img); ?>" onclick="DoSomething(this.src);" alt="" style="max-width: 70px;">
                                            
                                        </div>
                              </td>
                            


                           <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['isClient','isAdmin','isTopManagement'],App\User::class)): ?>
                           
                           <td class="td-actions">
                              <form action="<?php echo e(route('remove_outlet_categories', $old_category->id)); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('post'); ?>
                                 
                              
                                   <a onclick="confirm('<?php echo e(__("Are you sure you want to delete this category?")); ?>') ? this.parentElement.submit() : ''" class="btn btn-danger" title="Delete">
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
          </form>
        </div>
      </div>
    </div>
  </div>


  <!-- Classic Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"> Image View</h4>
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
    
  <script>

     $(document).ready(function() {

      $('#datatables').fadeIn(1100);

      $('#datatables').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
        ],

        searching: true,
        paging: true,
        info: true,
        responsive: true,
        language: {
          search: "_INPUT_",
          searchPlaceholder: "Search",
        },
      });

      $('#datatables-nbl').fadeIn(1100);

          $('#datatables-nbl').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [
              [10, 25, 50, -1],
              [10, 25, 50, "All"]
            ],

            searching: true,
            paging: true,
            info: true,
            responsive: true,
            language: {
              search: "_INPUT_",
              searchPlaceholder: "Search",
            },
          });

    });

    $('#datatables-share').fadeIn(1100);

          $('#datatables-share').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [
              [10, 25, 50, -1],
              [10, 25, 50, "All"]
            ],

            searching: true,
            paging: true,
            info: true,
            responsive: true,
            language: {
              search: "_INPUT_",
              searchPlaceholder: "Search",
            },
          });


         $('#datatables-plan').fadeIn(1100);

          $('#datatables-plan').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [
              [10, 25, 50, -1],
              [10, 25, 50, "All"]
            ],

            searching: true,
            paging: true,
            info: true,
            responsive: true,
            language: {
              search: "_INPUT_",
              searchPlaceholder: "Search",
            },
          });

  

    var selected = [];
    var noselected = [];
    
    $('.select_brand').change(function()
    { 
         var check = false;

         // if ($("#select_brand option:selected").length) {
         //    alert('you have select ' + $("#select_brand option:selected").last().val() );
         //  }
         //  else
         //  {
         //    //alert('you have Unselect' + $(this).val());
         //  }
            

        // if(!$(this).is(':selected'))
        //     alert('you have select' + $(this).val());
        // else
        //     alert('you have Unselect' + $(this).val());


          $.each($('#select_brand option'), function (key, value) {

                if (!$(this).prop('selected')) {
                   // noselected[key] = $(this).val();
                    //alert($(this).val());

                     var array = $(this).val().split(',');

                     //alert(array[0]);
                    
                    if ($("#"+array[0]).length){
                        //alert("#"+$(this).val().length);
                        check = true;
                        $("#"+array[0]).remove();
                        $("#file"+array[0]).remove();
                    }


                } else {
                    //selected[key] = $(this).val();
                    //alert($(this).val());
                }
            });
            

            var arr = $(this).val();

            var html = '';

            var html1 = '';

           
           if(check === false)
           {
              // $('#newRow').html('');

                for(i=0; i<=arr.length; i++)
                {
                    //alert(arr[i]);
                    
                     
                    if(arr[i] !== undefined)
                    {

                        var array = arr[i].split(',');
                        //alert(array[1]);

                        //alert(array[0]);

                        if ($("#"+array[0]).length){
                            //alert(array[0]);
                        }
                        
                        else
                        {
                            html += '<div class="input-group mb-3 " id="'+array[0]+'">';

                            html += '<div class="col-lg-4">';
                            html += '<h6> '+array[1]+' </h6>';
                            html += '</div>';
                            
                            html += '<div class="col-lg-4">';
                            html += '<input type="number" id="'+array[0]+'shelf"  name="shelf[]" brand="'+array[1]+'" class="form-control " placeholder="Shelf" autocomplete="off" required>';
                            html += '</div>';

                            html += '<div class="col-lg-4">';
                            html += '<input type="number" id="'+array[0]+'target" name="target[]" brand="'+array[1]+'" class="form-control " placeholder=" Target" autocomplete="off" required>';
                            html += '</div>'; 

                            html += '<div class="col-lg-4" hidden>';
                            html += '<input type="number" name="brand_id[]"  value="'+array[0]+'"  class="form-control " placeholder="Target" autocomplete="off" required>';
                            html += '</div>'; 

                            html += '</div>';


                            html1 += '<div class="input-group mb-3 " id="file'+array[0]+'">';

                            html1 += '<div class="col-lg-4">';
                            html1 += '<h6> '+array[1]+' </h6>';
                            html1 += '</div>';
                            
                            html1 += '<div class="col-lg-8">';
                            html1 += '<input type="file" name="myfile[]" accept="image/*" class="form-control " required >';
                            html1 += '</div>';
                        }

                    }
                    
                }

                

           $('#newRow').append(html);
           $('#planogram').append(html1);
           

           }

        });

        // $('#select_brand').on('change.bs.select', function() {

        //     $('#select_brand option:selected').prependTo('#select_brand');
        //     $(this).selectpicker('refresh');

        // });

         function DoSomething(data)
          {
         // alert(data);
          $('#FullImage').attr('src',data );
          $('#myModal').modal('show');

          }

 
  </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', ['activePage' => 'outlets', 'menuParent' => 'Outlets', 'titlePage' => __('Outlets')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thethethoughtfactory/Desktop/RMS-2-11-21/resources/views/outlet_products/view_edit.blade.php ENDPATH**/ ?>