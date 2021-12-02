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

.table .td-actions .btn {
    margin: 0px;
    padding: 1px !important;
}

.td-actions i.material-icons {
    color: #fff;
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
                <h4 class="card-title"><?php echo e(__('Product Details')); ?></h4>
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
                      <a href="<?php echo e(route('product_details.create')); ?>" class="btn btn-sm btn-rose"><?php echo e(__('Add Product')); ?></a>
                    </div>
                  </div>
                <?php endif; ?>
                <div class="table-responsive">
                  <table id="datatables" class="table table-striped table-no-bordered table-hover" style="display:none">
                    <thead class="text-primary">
                      <th>
                          <?php echo e(__('#')); ?>

                      </th>
                      <th>
                          <?php echo e(__('Image')); ?>

                      </th>
                      <th>
                          <?php echo e(__('SKU')); ?>

                      </th>
                      <th>
                          <?php echo e(__('Product Name')); ?>

                      </th>
                      <th>
                          <?php echo e(__('Bar Code')); ?>

                      </th> 
                    <!--   <th>
                          <?php echo e(__('UOM')); ?>

                      </th>-->
                       <th>
                          <?php echo e(__('Zrep Code')); ?>

                      </th>
                     <th>
                          <?php echo e(__('Piece per carton')); ?>

                      </th>
                       <th>
                          <?php echo e(__('Price per piece')); ?>

                      </th>
                       <th>
                           <?php echo e(__('Status')); ?>

                      </th>
                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['isClient','isTopManagement','isAdmin'],App\User::class)): ?>
                      <th >
                          <?php echo e(__('Action')); ?>

                     </th>
                     <?php endif; ?>
                    </thead>
                    <tbody>
                      <?php
                        $i=1
                      ?>
                     <?php $__currentLoopData = $product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                        <td>
                             <?php echo e($i++); ?>

                        </td>
                        <td class="sorting_1">

                            <div class="avatar avatar-sm rounded-circle img-circle" style="width:100px; height:100px;overflow: hidden;">

                                <?php if($prod->Image_url !==null || $prod->Image_url !==""): ?>
                                <img src="/product_image/<?php echo e($prod->Image_url); ?>" onclick="DoSomething(this.src);" alt="" style="max-width: 100px;">
                                <?php endif; ?>

                                 <?php if($prod->Image_url ==null || $prod->Image_url ==""): ?>
                                <img src="/product_image/no_image.jpg" onclick="DoSomething(this.src);" alt="" style="max-width: 100px;">
                                <?php endif; ?>

                            </div>

                          </td>
                           <td>
                            <?php echo e($prod->sku); ?>

                          </td>
                           <td>
                            <?php echo e($prod->product_name); ?>

                          </td>
                           <td> 
                            <?php echo e($prod->barcode); ?>

                          </td> 
                         <!--  <td>
                            <?php echo e($prod->uom); ?>

                          </td>-->
                          <td>
                            <?php echo e($prod->zrep_code); ?>

                          </td>
                          <td>
                            <?php echo e($prod->piece_per_carton); ?>

                          </td>
                           <td>
                            <?php echo e($prod->price_per_piece); ?>

                          </td>

                          <td>

                           <select name="status-<?php echo e($prod->id); ?>" class="form-control" id="status-<?php echo e($prod->id); ?>" onchange="update(<?php echo e($prod->id); ?>)">
                           <option value="" selected disabled>Select Status</option>
                           <option value="1" <?php if( $prod->status=="1"): ?> <?php echo e('selected'); ?> <?php endif; ?>>Active</option>
                           <option value="0" <?php if( $prod->status=="0"): ?> <?php echo e('selected'); ?> <?php endif; ?>>Deactivate</option>
                           </select>

                          </td>
                             
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['isClient','isTopManagement','isAdmin'],App\User::class)): ?>
                            
                            
                            <td class=" td-actions display-block">
                              <form action="<?php echo e(route('product_details.destroy', $prod->id)); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('delete'); ?>
                                  
                                       <a  rel="tooltip" data-toggle="modal" data-target="#exampleModal"   class="btn btn-info" onclick="view_products('<?php echo e($prod->id); ?>')" title="View">
                                          <i class="material-icons">visibility</i>
                                        </a>

                                     
                                       <a  rel="tooltip" href="<?php echo e(route('product_details.edit', $prod->id)); ?>" class="btn btn-warning" title="Edit">
                                          <i class="material-icons">edit</i>
                                        </a>
                                  

                                       <a onclick="confirm('<?php echo e(__("Are you sure you want to delete this employee?")); ?>') ? this.parentElement.submit() : ''" rel="tooltip" class="btn btn-danger" title="Delete">
                                          <i class="material-icons">close</i>
                                        </a>

                                </form>
                            </td>  


                             <?php endif; ?>
                        </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                    </tbody>
                  </table>
                   
                    <div class="d-flex justify-content-center">
                        <?php echo $product->links(); ?>

                    </div>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
  
  
  <!-- Model for Product_details_view -->
 <div class="modal fade bd-example-modal-lg" id="exampleModal"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">More Information</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="modal-dialog modal-dialog-center">
        <form>
           <div class="row">
            <div class="col-lg-12">
              <table class="table table-responsive borderless" >
                 <tr>  
                  <th>Brand Name</th>
                  <td id="brand_id"></td>
                 </tr>
                 <tr>
                <!--  <th>Client</th>
                  <td id="client_id"></td>
                 </tr>-->
                 <tr>
                  <th>Product Categories </th>
                  <td id="product_categories"></td>
                 </tr>
                <tr>
                  <th>Remarks </th>
                  <td id="remarks"></td>
                <tr>
                 <tr>
                  <th>Type </th>
                  <td id="type"></td>
                <tr>
                 <tr>
                  <th>Range </th>
                  <td id="range"></td>
                <tr>
              </table>
           </div>
         </div>
      </form>
     </div>
    </div>    
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
     </div>
    </div>
  </div>
</div>


<!-- Classic Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Product Image View</h4>
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
                  
                  
  <!--Model session for product--> 
   <div class="modal fade bd-example-modal-lg" id="modelWindow" role="dialog" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" 
          aria-hidden="true">
            <div class="modal-dialog modal-lg vertical-align-center">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title"><b> Filter Options</b></h4>
                </div>
                
                <div class="modal-body">
                <form method="get" action="<?php echo e(url('filter_product')); ?>" class="form-inline" enctype="multipart/form-data" action="" autocomplete="off" style="text-align: right;">
                
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('get'); ?>
                
                
                <div class="row" style="width: 100%;">
                 
                   
                   <div class="col-sm-4">
                     <div class="form-group">

                      <select class="form-control selectpicker" data-style="select-with-transition" title="Select Product" data-size="7" name="product" 
                       id="input-product"  value="<?php echo e(old('product')); ?>" aria-required="true" >
                          <option value="">--All Products--</option>
                         
                            <?php $__currentLoopData = $product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       
                           <option value="<?php echo e($prod->id); ?>" > <?php echo e($prod->product_name); ?> </option> 
         
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                          </select>
                         
                    </div>
                  </div>

                   <div class="col-sm-4">
                    <div class="form-group">
                   <select class="form-control selectpicker" data-style="select-with-transition" title="Select Brand" data-size="7" name="brand_id" 
                   id="input-brand_id"  value="<?php echo e(old('brand_id')); ?>" aria-required="true" >
                      <option value="">--Select--</option>
                     
                        <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bran): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   
                       <option value="<?php echo e($bran->id); ?>" > <?php echo e($bran->brand_name); ?> </option> 
     
                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
                      </select>
                    </div>
                  </div>

                  <div class="col-sm-4">
                     <div class="form-group<?php echo e($errors->has('zrep_code') ? ' has-danger' : ''); ?>">
                     <input class="form-control <?php echo e($errors->has('zrep_code') ? ' is-invalid' : ''); ?>" name="zrep_code" id="input-zrep_code" type="text" placeholder="<?php echo e(__('zrep code')); ?>" value="<?php echo e(old('zrep_code')); ?>" >
                     
                    </div>
                  </div>

                  <div class="col-sm-4">
                     <div class="form-group<?php echo e($errors->has('barcode') ? ' has-danger' : ''); ?>">
                     <input class="form-control <?php echo e($errors->has('barcode') ? ' is-invalid' : ''); ?>" name="barcode" id="input-barcode" type="text" placeholder="<?php echo e(__('Barcode')); ?>" value="<?php echo e(old('barcode')); ?>" >
                     
                    </div>
                  </div>

                   <div class="col-sm-4">
                     <div class="form-group">
                     <input class="form-control <?php echo e($errors->has('sku') ? ' is-invalid' : ''); ?>" name="sku" id="input-sku" type="text" placeholder="<?php echo e(__('SKU')); ?>" value="<?php echo e(old('sku')); ?>" >
                      
                     </div>
                   </div>
                  
                   <div class="col-sm-4">
                     <div class="form-group">
                     <!--  <select class="form-control selectpicker" data-style="select-with-transition" title="Select Category" data-size="7" name="product_categories" 
                  id="input-product_categories"  value="<?php echo e(old('product_categories')); ?>" aria-required="true">
                     <option value="">--Select--</option>
                     
                        <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categ): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    
                       <option value="<?php echo e($categ->id); ?>"> <?php echo e($categ->category_name); ?> </option> 
     
                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
                     </select> -->
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
    
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
  function DoSomething(data)
  {
    $('#FullImage').attr('src',data );
    $('#myModal').modal('show');
}
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function() {
      $('#datatables').fadeIn(1100);
      $('#datatables').DataTable({
        "pagingType": "full_numbers",
        "paging":   false,
        "lengthMenu": [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
        ],
        responsive: true,
        language: {
          search: "_INPUT_",
          searchPlaceholder: "Search product",
        }
      });
    }); 
 function view_products(id){
      //alert(id);
      var csrf = $('meta[name="csrf-token"]').attr('content');
      $.ajax({
           url: '/view_products',
          type: 'GET',
          data: {id : id, '_token': csrf},
          dataType: 'json',
          success: function( data ) {
          // 
          // alert(data);
          //
          //alert(JSON.stringify(data));
          //alert(test[0].brand);
         // var obj = JSON.parse(data); 
          //alert(obj);
         // var val = obj[0].brand_name;
         // alert(val);
              //var test = (JSON.stringify(data));
                  //  $.each(data,function(index,value){
                  //  alert(value.brand_name);
                //});
         //   $("#brand_id")   .html(': '+test[0].brand_name);
            $("#brand_id").html(': '+data[0]['brand_name']); 
           // $("#client_id").html(': '+data[0]['first_name'] +" " +data[0]['middle_name'] +" " +data[0]['surname']);
            $("#product_categories").html(': '+data[0]['category_name']);
            $("#remarks").html(': '+data[0]['remarks']);
            $("#type").html(': '+data[0]['type']);
            $("#range").html(': '+data[0]['range']);
          }       
      })
    }


     function update(id){

        var stsvalue = document.getElementById("status-"+id).value;

        Swal.fire({
          title: 'Are you sure?',
          text: "You can able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, change it!'
        }).then((result) => {
          if (result.isConfirmed) {

             $.ajax({
                  url: '/getStatus',
                  type: 'POST',
                  data: {'id':id,'status':stsvalue, _token:'<?php echo e(csrf_token()); ?>'},
                  dataType: 'json',

                  success: function( data ) {
                     //alert(data);

                     if(data == 1){
                        Swal.fire(
                          'Updated!',
                          'Product data has been updated.',
                          'success'
                        );
                        return false;
                     }

                      Swal.fire(
                          'Error!',
                          'Something went wrong.',
                          'warning'
                        );

                  }       
              })

           
          }
        })


    }


  </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', ['activePage' => 'product_details', 'menuParent' => 'Products', 'titlePage' => __('Product Details')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thethethoughtfactory/Desktop/RMS-2-11-21/resources/views/product_details/index.blade.php ENDPATH**/ ?>