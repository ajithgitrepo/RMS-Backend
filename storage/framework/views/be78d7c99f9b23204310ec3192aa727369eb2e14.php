<style type="text/css">
    .form-control-file {
        opacity: 1 !important;
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 0 !important; 
    }
     .form-control-nbl {
        opacity: 1 !important;
        position: relative !important;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 0 !important; 
    }
</style>




<?php $__env->startSection('content'); ?>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
           <form method="post" action="<?php echo e(route('outlet_categories', Request::segment(3))); ?>" autocomplete="off" class="form-horizontal " enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('post'); ?>   

            <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">add_task</i>
                </div>
                <h4 class="card-title"><?php echo e(__('Add Category')); ?></h4>
               </div>
              
              <div class="card-body ">
              
                <div class="row">
                  <div class="col-md-12 text-right">
                    <a href="<?php echo e(url('outlet-products/view_edit',Crypt::decrypt(Request::segment(2)))); ?>"  class="btn btn-sm btn-rose"><?php echo e(__('Back to Outlet Category')); ?></a>
                    
                  </div>
                </div> 

            <div class="row" hidden="" >
              <label class="col-sm-2 col-form-label"><?php echo e(__('Outlet Id')); ?></label>
              <div class="col-sm-">
                <div class="form-group<?php echo e($errors->has('outlet_id') ? ' has-danger' : ''); ?>">

                <input class="form-control <?php echo e($errors->has('outlet_id') ? ' is-invalid' : ''); ?>" name="outlet_id" id="input-outlet_id" type="text" placeholder="<?php echo e(__('Outlet ID')); ?>" value="<?php echo e(Request::segment(3)); ?> " readonly="" aria-required="true"/>
                
                  <?php echo $__env->make('alerts.feedback', ['field' => 'outlet_id'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
              </div>
            </div>
          
        
            <div class="row"> 
              <label class="col-sm-2 col-form-label"><?php echo e(__('Outlet')); ?></label>
              <div class="col-sm-8">
                <div class="form-group<?php echo e($errors->has('outlet_name') ? ' has-danger' : ''); ?>">
           

                    <select class="form-control selectpicker" data-style="select-with-transition" title="Select Outlet" data-size="7" name="outlet_name" id="input_outlet" 
                 value="<?php echo e(old('outlet_name')); ?>" aria-required="true" >
                 
                  <option value="" disabled>Select Outlet</option>
                   <?php $__currentLoopData = $outlets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $out): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                 <option value="<?php echo e($out->outlet_id); ?>" selected=""><?php echo e($out->store[0]->store_code); ?> - <?php echo e($out->store[0]->store_name); ?> - <?php echo e($out->store[0]->address); ?></option>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                  </select>
               
                  <?php echo $__env->make('alerts.feedback', ['field' => 'outlet_name'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
              </div>
            </div>

            <div class="row"> 
              <label class="col-sm-2 col-form-label"><?php echo e(__('NBL(Canvas)')); ?></label>
              <div class="col-sm-5">
                <div class="form-group<?php echo e($errors->has('outlet_name') ? ' has-danger' : ''); ?>">
           
                     <input type="file" title="Choose NBL File" name="nbl_file[]" accept=".doc, .docx,.ppt, .pptx,.txt,.pdf" class="form-control form-control-nbl" >

                  <?php echo $__env->make('alerts.feedback', ['field' => 'nbl_file'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
              </div>



              <?php if($nbl_file->isNotEmpty()): ?>

              <div class="col-sm-3" style="margin-top: 10px;">
                    
                    <a href="/nbl_file/<?php echo e($nbl_file[0]->file_url); ?>" target="_blank" >Click here to view uploaded NBL</a>

                       <!--  <img id="" title="View" src="/planogram_image/1620218996.mars_planogram.jpg" onclick="DoSomething(this.src);" alt="" style="max-width: 70px;"> -->
                        
              </div>

              <?php endif; ?>

            </div>

          

            <div class="row"> 
              <label class="col-sm-2 col-form-label"><?php echo e(__('Categories')); ?></label>
              <div class="col-sm-8">
                <div class="form-group<?php echo e($errors->has('categories') ? ' has-danger' : ''); ?>">
           

                    <select class="form-control selectpicker select_category" data-style="select-with-transition" title="Select Category" data-size="7" name="categories[]" id="select_category" 
                 value="<?php echo e(old('categories')); ?>" aria-required="true" required="" multiple="" >
                 
                  <option value="" disabled>Select Category</option>
                   <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <!--  <option value="<?php echo e($cat->id); ?>" > <?php echo e($cat->category_name); ?> </option> -->

                    <?php if($cat->target): ?>

                     <option value="<?php echo e($cat->id); ?>-<?php echo e($cat->category_name); ?>-<?php echo e($cat->category_id); ?>" selected="" > <?php echo e($cat->category_name); ?> </option>

                     <?php endif; ?>

                      <?php if(!$cat->target): ?>

                     <option value="<?php echo e($cat->id); ?>-<?php echo e($cat->category_name); ?>-<?php echo e($cat->category_id); ?>" > <?php echo e($cat->category_name); ?> </option>

                     <?php endif; ?>

                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                  </select>
               
                  <?php echo $__env->make('alerts.feedback', ['field' => 'categories'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
              </div>
            </div>


             <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Target And Planogram')); ?></label>
                  <div class="col-sm-8" style="margin-top: 10px;">
                    <div id="newRow" class="form-group<?php echo e($errors->has('shelf') ? ' has-danger' : ''); ?>">


                     <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $old): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <?php if($old->target): ?>

                            <div class="input-group mb-3" id="cat_id<?php echo e($old->id); ?>">

                                <div class="col-lg-3">
                                    <h6> <?php echo e($old->category_name); ?> </h6>
                                </div>
                            

                                <div class="col-lg-2">
                                    <input type="number" name="target[]" class="form-control " value="<?php echo e($old->target); ?>"  placeholder="Target" autocomplete="off" required>
                                </div>

                                <div class="col-lg-2" hidden="">
                                    <input type="number" name="mapping_id[]" class="form-control " value="<?php echo e($old->id); ?>"  placeholder="" autocomplete="off" required>
                                </div>

                                <div class="col-lg-2" hidden="">
                                    <input type="number" name="category_id[]"  value="<?php echo e($old->category_id); ?>"  class="form-control "placeholder="" autocomplete="off" >
                                </div>

                                <div class="col-lg-4">
                                    <input type="file" title="Choose planogram image" name="myfile[]" accept="image/*" class="form-control-file" >
                                </div>

                                 <?php if($old->planogram_img): ?>

                                    <div class="col-lg-2">
                                        <div class="avatar avatar-sm " style="width:70px; height:70px;overflow: hidden;">
                                      
                                            <img id="" title="View" src="/planogram_image/<?php echo e($old->planogram_img); ?>" onclick="DoSomething(this.src);" alt="" style="max-width: 70px;">
                                            
                                        </div>
                                    </div>

                                 <?php endif; ?>

                                 <hr>

                           </div>

                            

                        <?php endif; ?>



                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                      <?php echo $__env->make('alerts.feedback', ['field' => 'shelf'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div>

            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-rose text-center"><?php echo e(__('Save')); ?></button>
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
          <h4 class="modal-title">Planogram Image</h4>
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

    // $('#select_brand').selectpicker();

    var selected = [];
    var noselected = [];
    
    $('.select_category').change(function()
    { 
         var check = false;

         //alert($(this).val());

         $.each($('#select_category option'), function (key, value) {

            if (!$(this).prop('selected')) {
                //noselected[key] = $(this).val();
                //alert($(this).val());

                var array = $(this).val().split('-');

                //alert(array[0]);

                if ($("#cat_id"+array[0]).length){
                   // alert($(this).val());
                    check = true;
                    $("#cat_id"+array[0]).remove();
                }

            } 
            else 
            {
                selected[key] = $(this).val();
                //alert($(this).val());
            }

        });



            var arr = $(this).val();
            //alert(arr);

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

                        var array = arr[i].split('-');
                        //alert(array[1]);

                        //alert(array[0]);

                        if ($("#cat_id"+array[0]).length)
                        {
                            //alert(array[0]);
                        }

                        else
                        {
                            html += '<div class="input-group mb-3 " id="cat_id'+array[0]+'">';

                            html += '<div class="col-lg-3">';
                            html += '<h6> '+array[1]+' </h6>';
                            html += '</div>';
                       
                            html += '<div class="col-lg-2">';
                            html += '<input type="number" id="'+array[0]+'target" name="target[]" brand="'+array[1]+'" class="form-control " placeholder=" Target" autocomplete="off" required>';
                            html += '</div>'; 

                            html += '<div class="col-lg-2" hidden>';
                            html += '<input type="number" name="mapping_id[]"  value="'+array[0]+'"  class="form-control" placeholder="" autocomplete="off" required>';
                            html += '</div>'; 

                            html += '<div class="col-lg-2" hidden="">';
                            html += '<input type="number" name="category_id[]"  value="'+array[2]+'" class="form-control " placeholder="" autocomplete="off" >';
                            html += '</div>';

                            html += '<div class="col-lg-4">';
                            html += '<input type="file" title="Choose planogram image" name="myfile[]" accept="image/*" class="form-control-file" >';
                            html += '</div>';

                            html += '</div>';

                        }

                    }
                    
                }

           $('#newRow').append(html);
           //$('#planogram').append(html1);

           }
            

        });

    function DoSomething(data)
    {

       $('#FullImage').attr('src',data );
       $('#myModal').modal('show');

    }

 
  </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', ['activePage' => 'outlets', 'menuParent' => 'Outlets', 'titlePage' => __('Outlets')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thethethoughtfactory/Desktop/RMS-2-11-21/resources/views/outlet_products/create_category.blade.php ENDPATH**/ ?>