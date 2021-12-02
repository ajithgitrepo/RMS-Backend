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

.togglebutton label input[type=checkbox]:checked+.toggle {
    background-color: rgb(44 176 39) !important;
}

.togglebutton label .toggle, .togglebutton label input[type=checkbox][disabled]+.toggle {
   
    background-color: rgb(246 6 6 / 70%) !important;
   
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
                  <i class="material-icons">shop</i>
                </div>
                <h4 class="card-title"><?php echo e(__('Product Availability')); ?></h4>
              </div>
              
              <div class="card-body">

                 <?php

                    $parameter= Crypt::decrypt(Request::segment(2));

                ?>

                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="<?php echo e(route('c-activity',['id' => $parameter ])); ?>" title="Back to Activity" class="btn btn-sm btn-rose"><i class="fa fa-arrow-left"> Back</i></a>
                   </div>
                 </div>

               
               <div class="table-responsive">
                  <table id="datatables" class="table table-striped table-no-bordered table-hover" style="display:none">
                    <thead class="text-primary">
                     <!--  <th>
                          <?php echo e(__('S.No')); ?>

                      </th> -->
                      <th>
                        <?php echo e(__('Image')); ?>

                      </th>
                      <th>
                          <?php echo e(__('Item/Description')); ?>

                      </th>
                      <th>
                          <?php echo e(__('Brand')); ?>

                      </th>
                      <th>
                          <?php echo e(__('Category')); ?>

                      </th>
                      <th>
                          <?php echo e(__('Available?')); ?>

                      </th>
                      <th>
                          <?php echo e(__('Reason')); ?>

                      </th>
                   
                      
                    </thead>
                    
                    <tbody>


                      <?php

                        $i=0

                      ?>
                 
                    

                      <?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                      <?php

                        $check = isset($product->is_available);
						

                     ?>
						
					
                     <tr>
                         <!--  <td>
                            <?php echo e(++$i); ?>  
                          </td> -->
                            <td class="sorting_1">

                            <div class="avatar avatar-sm rounded-circle img-circle" style="width:100px; height:100px;overflow: hidden;">

                                <?php if($product->Image_url !==null || $product->Image_url !==""): ?>
                                <img src="/product_image/<?php echo e($product->Image_url); ?>" onclick="DoSomething(this.src);" alt="" style="max-width: 100px;">
                                <?php endif; ?>

                                 <?php if($product->Image_url ==null || $product->Image_url ==""): ?>
                                <img src="/product_image/no_image.jpg" onclick="DoSomething(this.src);" alt="" style="max-width: 100px;">
                                <?php endif; ?>

                            </div>

                          </td>
                          <td class="product_name">
                            <?php echo e($product->p_name); ?>

                          </td>
                          <td class="brand_name">
                            <?php echo e($product->b_name); ?>

                          </td>
                          <td class="category_name">
                            <?php echo e($product->c_name); ?>

                          </td>
                           <td>
                           <div class="togglebutton">
                              <label>

                                <?php if($check): ?>
                                    <?php if($product->is_available ==1): ?>
                                    <input type="checkbox" timesheet_id="<?php echo e($product->id); ?>" opm="<?php echo e($product->opm); ?>" product_id="<?php echo e($product->product_id); ?>" outlet_id="<?php echo e($product->outlet_id); ?>" class="checkbox" checked="">
                                    <?php endif; ?>
                                    <?php if($product->is_available ==0): ?>
                                    <input type="checkbox" timesheet_id="<?php echo e($product->id); ?>" opm="<?php echo e($product->opm); ?>"  product_id="<?php echo e($product->product_id); ?>" outlet_id="<?php echo e($product->outlet_id); ?>" class="checkbox" >
                                    <?php endif; ?>
                                <?php endif; ?>

                                 <?php if(!$check): ?>
                                    <input type="checkbox" timesheet_id="<?php echo e($product->id); ?>" opm="<?php echo e($product->opm); ?>"  product_id="<?php echo e($product->product_id); ?>" outlet_id="<?php echo e($product->outlet_id); ?>" class="checkbox" checked="">
                                <?php endif; ?>

                               
                                <span class="toggle"></span>
                               
                              </label>
                            </div>
                          </td>

                          <td>
                           <!-- <textarea style="width: 350px;" cols="3" rows="3" name="reason" id="<?php echo e($i); ?>" class="reason text"></textarea> -->
                             <?php if($check): ?>
                                <?php if($product->is_available ==1): ?>
                                   <select name="reason" id="<?php echo e($i); ?>" class="form-control reason text" >
                                       <option value="" selected="" disabled="">Reason</option>
                                       <option value="Out Of Stock">Out Of Stock</option>
                                       <option value="Expired">Expired</option>
                                   </select>
                                <?php endif; ?>
                                <?php if($product->is_available ==0): ?>
                                   <select name="reason" id="<?php echo e($i); ?>" class="form-control text">
                                       <option value="" selected="" disabled="">Reason</option>
                                       <option value="Out Of Stock"  <?php if($product->reason == "Out Of Stock"): ?> <?php echo e('selected'); ?> <?php endif; ?>  >Out Of Stock</option>
                                       <option value="Expired" <?php if($product->reason == "Expired"): ?> <?php echo e('selected'); ?> <?php endif; ?>  >Expired</option>
                                   </select>
                                <?php endif; ?>
                            <?php endif; ?>

                             <?php if(!$check): ?>
                                
                                   <select name="reason" id="<?php echo e($i); ?>" class="form-control reason text" >
                                       <option value="" selected="" disabled="">Reason</option>
                                       <option value="Out Of Stock">Out Of Stock</option>
                                       <option value="Expired">Expired</option>
                                   </select>
                               
                            <?php endif; ?>

                          </td>
                           
                    </tr>

                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 

                    </tbody>
                  </table>

                  <button id="submit" type="submit" class="btn btn-rose float-right"><?php echo e(__('Submit')); ?></button>
                  
                </div>
              </div>
            </div>
            
        </div>
      </div>
    </div>
  </div>

<!-- <div class="modal fade bd-example-modal-lg" id="myModal"  tabindex="" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Reason for not available</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
   
  <div class="modal-dialog vertical-align-center">   
       <input name="referencia" id="referencia" type="text" class="form-control text-uppercase" placeholder="Descripci&oacute;n" autofocus>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      
      </div>
    </div>
  </div>
</div> -->

<div class="modal fade" role="dialog" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content" >
     <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Reason for not available</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="card-body p-3 pb-5 bg-brand-grey">
        <form method="post" action="<?php echo e(route('brand_details.store')); ?>" autocomplete="off" class="form-horizontal">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="text-white col-md-12" for="usern1">Name</label>
                  <div class="col-md-12">
                     <input name="timesheet_id" id="timesheet_id" hidden="">
                     <input name="product_id" id="product_id" hidden="">
                    <textarea cols="3" rows="3" class="form-control" placeholder="Reason" autofocus></textarea>
 
                  </div>
                </div>
              </div>
            </div>
             <button type="submit" class="btn btn-rose float-right"><?php echo e(__('Add')); ?></button>
        </form>
      </div>
      <!--  <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      
      </div> -->
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>



<?php $__env->startPush('js'); ?>
    
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  <script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".reason").hide();

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
          searchPlaceholder: "Search Item/Brand/Category",
        }
      });
    });

     $('.checkbox').change(function()
      {
        if (!$(this).is(':checked')) {
           //alert('Uncheked...');
           //$('#myModal').modal('show'); 
            //$('#referencia').focus();

           // alert($(this).val());

            //alert($(this).attr("timesheet_id"));

           // var id = $(this).closest('table').find(" td ").attr('id');

            var id = $(this).closest('td').next('td').find('select').attr('id');

           // alert(id);

            $(this).closest('table').find("tr td #"+id+" ").show();

            $(this).closest('table').find("tr td .reason-exist ").css("visibility", "visible");

           
        }

        if ($(this).is(':checked')) {
           //alert('Uncheked...');
           //$('#myModal').modal('show'); 
            //$('#referencia').focus();

            // alert($(this).val());

             var id = $(this).closest('td').next('td').find('select').attr('id');

           // alert(id);

            $(this).closest('table').find("tr td #"+id+" ").hide();



        }

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
      //  alert(JSON.stringify(data));          
        } );
        return false;
    } );
}

$(document).ready(function()
{
    store_brand();
});


$("#submit").click(function(){

    //alert("clicked.");
    var rowCount = $('#datatables >tbody >tr').length;
   
   // var array = $('#datatables tbody tr:eq(0) td').toArray();

    var attr = $("#datatables tbody tr:eq(1) td input[class*=checkbox]").attr('product_id');

    //alert(attr);
    var array = [];

    $('#datatables >tbody >tr').each(function(index) {
       // alert(index); 
        var timesheet_id = $("#datatables tbody tr:eq("+index+") td input[class*=checkbox]").attr('timesheet_id');
        //alert(timesheet_id);

         var product_id = $("#datatables tbody tr:eq("+index+") td input[class*=checkbox]").attr('product_id');
        //alert(product_id);

        var opm = $("#datatables tbody tr:eq("+index+") td input[class*=checkbox]").attr('opm');
        //alert(product_id);

        var brand_name = $("#datatables tbody tr:eq("+index+") td[class*=brand_name]").text();  
        
        var b_name = brand_name.trim();

        var category_name = $("#datatables tbody tr:eq("+index+") td[class*=category_name]").text();  
        
        var c_name = category_name.trim();

        var product_name = $("#datatables tbody tr:eq("+index+") td[class*=product_name]").text();  
        
        var p_name = product_name.trim();

       // alert(p_name);

        var outlet_id = $("#datatables tbody tr:eq("+index+") td input[class*=checkbox]").attr('outlet_id');
        //alert(outlet_id);

        var checkbox = $("#datatables tbody tr:eq("+index+") td input[class*=checkbox]").is(':checked');
        //alert(checkbox);

        if(checkbox ==true)
            check_value = 1;
        if(checkbox ==false)
            check_value = 0;

        //alert(check_value);

        var reason = $("#datatables tbody tr:eq("+index+") td select[class*=text]").val();
        // (reason);

       // var key = '{"timesheet_id"' + ":" +'"' + timesheet_id +'"' + "," + "product_id" + ":" +'"' + product_id +'"' + "," + "outlet_id" + ":" +'"' + outlet_id +'"' + "," + "check_value" + ":" +'"' + check_value +'"' + "," + "reason" + ":" +'"' + reason +'"' + "}";

        var key = '{"timesheet_id": "'+timesheet_id+'", "opm" : "'+opm+'", "product_id" : "'+product_id+'","brand_name" : "'+b_name+'","category_name" : "'+c_name+'","product_name" : "'+p_name+'","outlet_id": "'+outlet_id+'", "check_value" : "'+check_value+'", "reason" : "'+reason+'"}';
      
        array.push(key)

    });


    var value = "["+array.toString()+"]";

    console.log(value);

    var csrf = $('meta[name="csrf-token"]').attr('content');

    Swal.fire({
      title: 'Are you sure?',
      text: "You can able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, update it!'
    }).then((result) => {
      if (result.isConfirmed) {

         $.ajax({
              url: '/update_product_availability',
              type: 'POST',
              data: {'value' : value, '_token': csrf},
              dataType: 'json',

              success: function( data ) {
                 //alert(data);

                 if(data == 0){
                    alert('Please select reason..');
                    return false;
                 }

                  Swal.fire(
                      'Updated!',
                      'Product data has been updated.',
                      'success'
                    );

              }       
          })

       
      }
    })


});


  </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', ['activePage' => 'journey-plan', 'menuParent' => 'Journey-Plan', 'titlePage' => __('Customer Activity')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thethethoughtfactory/Desktop/RMS-2-11-21/resources/views/availability/index.blade.php ENDPATH**/ ?>