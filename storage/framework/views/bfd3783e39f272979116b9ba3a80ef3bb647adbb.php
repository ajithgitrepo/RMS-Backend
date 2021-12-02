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

.span_total{
    margin-left: 50px;
    font-size: 20px;
}

.span_tot{
    margin-left: 10px;
    font-size: 20px;
}

.table-responsive {
    display: block;
    width: 100%;
    overflow-x: hidden !important;
    -webkit-overflow-scrolling: touch;
    -ms-overflow-style: -ms-autohiding-scrollbar;
}

.form-control:disabled, .form-control[readonly] {
     background-color: #fff !important; 
   
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
                <h4 class="card-title"><?php echo e(__('Share Of Shelf')); ?></h4>
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
                      <th>
                          <?php echo e(__('S.No')); ?>

                      </th>
                    
                      <th>
                          <?php echo e(__('Category')); ?>

                      </th>

                      <th>
                          <?php echo e(__('Total Shelf')); ?> <?php echo e(__('(In Meters)')); ?>

                      </th>
                     
                      <th>
                          <?php echo e(__('Actual Shelf')); ?> <?php echo e(__('(In Meters)')); ?>

                      </th>
                   
                      <th >
                          <?php echo e(__('Actual (In Percentage) ')); ?>

                      </th>

                      <th >
                          <?php echo e(__('Reason')); ?>

                      </th>

                      

                      
                      
                    </thead>
                    
                    <tbody>


                      <?php

                        $i=0    

                      ?>
                 
                      <?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                      <?php

                        $share = isset($product->share);

                        $actual = isset($product->actual); 

                        $target = isset($product->target);

                        $total_share = isset($product->total_share);

                        $reason = isset($product->reason);

                     ?>
                        
                     <tr>
                       
                        <td class="brand_name">
                            <?php echo e(++$i); ?>

                          </td>

                          <td class="brand_name">
                            <?php echo e($product->category_name); ?>

                          </td>
                         
                          <td>

                             <?php if($total_share): ?>
                               <input class="form-control total_shelf" style="max-width: 300px;"  timesheet_id="<?php echo e($product->id); ?>" opm="<?php echo e($product->opm); ?>" outlet_id="<?php echo e($product->outlet_id); ?>" category_id="<?php echo e($product->c_id); ?>"  name="share" id="<?php echo e($product->c_id); ?>" type="text" placeholder="<?php echo e(__('In Meters')); ?>" value="<?php echo e($product->total_share); ?>"  aria-required="true" required="" onclick="get_share_details(<?php echo e($product->id); ?>,<?php echo e($product->c_id); ?>, <?php echo e($product->outlet_id); ?>) "/>
                             <?php endif; ?>

                            <?php if(!$total_share): ?>
                                 <input class="form-control total_shelf" style="max-width: 300px;"  timesheet_id="<?php echo e($product->id); ?>" opm="<?php echo e($product->opm); ?>" outlet_id="<?php echo e($product->outlet_id); ?>" category_id="<?php echo e($product->c_id); ?>"  name="share" id="<?php echo e($product->c_id); ?>" type="text" placeholder="<?php echo e(__('In Meters')); ?>" value=""  aria-required="true" required="" onclick="get_share_details(<?php echo e($product->id); ?>,<?php echo e($product->c_id); ?>, <?php echo e($product->outlet_id); ?>) "/>
                            <?php endif; ?>
                               
                          </td>

                           <td >
                             <?php if($share): ?>
                               <input class="form-control total_share share" name="total_share" type="text"   aria-required="true" placeholder="<?php echo e(__('In Meters')); ?>"  required="" value="<?php echo e($product->share); ?>" onclick="get_share_details(<?php echo e($product->id); ?>,<?php echo e($product->c_id); ?>, <?php echo e($product->outlet_id); ?>) " />
                            <?php endif; ?>

                            <?php if(!$share): ?>
                               <input class="form-control total_share share" name="total_share" type="text"  aria-required="true" placeholder="<?php echo e(__('In Meters')); ?>"  required="" onclick="get_share_details(<?php echo e($product->id); ?>,<?php echo e($product->c_id); ?>, <?php echo e($product->outlet_id); ?>) " />
                             <?php endif; ?>
                            
                           
                          </td>

                           <td >

                            <?php if($actual): ?>
                               <input class="form-control actual_shelf" name="actual_shelf" type="text"  aria-required="true" value="<?php echo e($product->actual); ?>"  required="" readonly="" />
                            <?php endif; ?>

                            <?php if(!$actual): ?>
                               <input class="form-control actual_shelf" name="actual_shelf" type="text"  aria-required="true"  required="" readonly="" />
                            <?php endif; ?>
                               
                          </td>

                           <td hidden="">
                             <?php if($target): ?>
                               <input class="form-control target" name="target" type="text"  aria-required="true"  required="" value="<?php echo e($product->target); ?>" readonly="" />
                            <?php endif; ?>

                              <?php if(!$target): ?>
                               <input class="form-control target" name="target" type="text"  aria-required="true"  required="" readonly="" />
                            <?php endif; ?>
                           
                          </td>

                          <td>

                        <?php if($reason): ?>

                            <select name="reason" id="id_<?php echo e($i); ?>" class="form-control text" >
                               <option value="" selected="" disabled="">Reason</option>
                               <option value="Out Of Stock"  <?php if($product->reason == "Out Of Stock"): ?> <?php echo e('selected'); ?> <?php endif; ?>>Out Of Stock</option>
                               <option value="Expired" <?php if($product->reason == "Expired"): ?> <?php echo e('selected'); ?> <?php endif; ?> >Expired</option>
                               <option value="Delivery Pending" <?php if($product->reason == "Delivery Pending"): ?> <?php echo e('selected'); ?> <?php endif; ?>>Delivery Pending</option>
                           </select>

                        <?php endif; ?>

                        <?php if(!$reason): ?>

                            <select name="reason" id="id_<?php echo e($i); ?>" class="form-control reason text" >
                               <option value="" selected="" disabled="">Reason</option>
                               <option value="Out Of Stock">Out Of Stock</option>
                               <option value="Expired">Expired</option>
                               <option value="Delivery Pending">Delivery Pending</option>
                           </select>

                        <?php endif; ?>


                          </td>

                         
                           
                    </tr>

                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 

                    </tbody>
                  </table> 

                  <div class="row" id="shelf_append">
                   
                     <div class="col-lg-4">
                      <span class="span_total">Target:</span>  <span class="span_tot" id="target"></span>
                    </div>

                     <div class="col-lg-4">
                      <span class="span_total">Actual:</span>  <span class="span_tot" id="actual"></span>
                    </div>
                     
                  </div>

                </div>
                  <button id="submit" type="submit" class="btn btn-rose float-right mx-auto"><?php echo e(__('Submit')); ?></button>
                   
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
        "bInfo" : false,
       // responsive: true,
        language: {
          search: "_INPUT_",
          searchPlaceholder: "Search Brand",
        }
      });
    });



     $('.share').keyup(function()
      {
       
        //alert();

       var input = $(this).closest('tr').find(" td .share ").val();

       //alert(input);

       var total = $(this).closest('td').prev('td').find('input').val(); 
       //alert(total);

        //var total = $("#total").text();
        var target = $("#target").text();
       
        var total_share = total.match(/\d+/); 
        //alert(total_share);

        var suffix = target.match(/\d+/); 
        //alert(suffix);

       
        var input_value = input;

        var actual = input_value / total * 100;
        //alert(actual.toFixed(2));
        var actual1 = actual.toFixed(0);
        //alert(actual1);

        if(actual1 >100){
            alert("Actual percentage can't greater than 100.. ");
            $(this).val(''); 
            return false;
        }

        $(this).closest('td').next('td').find('input').val(actual1); 

        $(this).closest('tr').find('td .target').val(suffix);

       
        $('#actual').html(actual1+'%');

        if(actual >= suffix || actual == 100)
        {
            //alert('greater');
            var id = $(this).closest('tr').find('select').attr('id');
            //alert(id);

            $(this).closest('tr').find('select').prop('selectedIndex',0);

            $(this).closest('table').find("tr td #"+id+" ").hide();
            $("#actual").css("color", "green");
        }
        else
        {
            //alert('lesser');
            var id = $(this).closest('tr').find('select').attr('id');
            //alert(id);

            $(this).closest('table').find("tr td #"+id+" ").show();
            $("#actual").css("color", "red");
        }

      
      });


// function store_brand(id) {
 
//     $( '#frm' ).submit( function( e ) {
    
//         e.preventDefault();
//         var select = $( this ).serialize();
       
//         // POST to php script
//         $.ajax( {
//             type: 'POST',
//             url: '/store_brand',
//             data: select,
          
            
//         }).then( function( data ) {
//       // console.log(data);
//        // alert(JSON.stringify(data[0]['id']));
//       //  alert(JSON.stringify(data));          
//         } );
//         return false;
//     } );
// }

// $(document).ready(function()
// {
//     store_brand();
// });


$("#submit").click(function(){

    //alert("clicked.");
    var rowCount = $('#datatables >tbody >tr').length;
  
    //alert(rowCount); 
  
    var array = [];

    $('#datatables >tbody >tr').each(function(index) {  
       // alert(index); 
        var timesheet_id = $("#datatables tbody tr:eq("+index+") td input[class*=total_shelf]").attr('timesheet_id');
        //alert(timesheet_id);

        var outlet_id = $("#datatables tbody tr:eq("+index+") td input[class*=total_shelf]").attr('outlet_id');
        //alert(outlet_id);

        var category_id = $("#datatables tbody tr:eq("+index+") td input[class*=total_shelf]").attr('category_id');  
        //alert(brand_id);

        var opm = $("#datatables tbody tr:eq("+index+") td input[class*=total_shelf]").attr('opm');  
        //alert(brand_id);

        var target = $("#datatables tbody tr:eq("+index+") td input[class*=target]").val();  
        //alert(target); 

        var shelf_val = $("#datatables tbody tr:eq("+index+") td input[class*=share]").val();  
        //alert(shelf_val);  

        var actual_shelf_val = $("#datatables tbody tr:eq("+index+") td input[class*=actual_shelf]").val();  
        //alert(actual_shelf_val);  

        //var total_share = $("#datatables tbody tr:eq("+index+") td input[class*=total_share]").val(); 

         var total_shelf = $("#datatables tbody tr:eq("+index+") td input[class*=total_shelf]").val();   
        //alert(total_share);  
        
         var reason = $("#datatables tbody tr:eq("+index+") td select[class*=text]").val();
         //alert(reason);

        var key = '{"timesheet_id": "'+timesheet_id+'","opm": "'+opm+'", "outlet_id" : "'+outlet_id+'","category_id" : "'+category_id+'","shelf_val" : "'+shelf_val+'","actual_shelf_val" : "'+actual_shelf_val+'", "target" : "'+target+'", "total_shelf" : "'+total_shelf+'", "reason" : "'+reason+'"}';
      
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
              url: '/update_shareof_shelf',
              type: 'POST',
              data: {'value' : value, '_token': csrf},
              dataType: 'json',

              success: function( data ) {
                 //alert(data);

                 if(data == 0){
                    alert('Please Enter Share Of Shelf..');
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



function get_share_details(id, category_id, outlet_id)
{
    
    var csrf = $('meta[name="csrf-token"]').attr('content');

     $.ajax({
          url: '/get_share_details',
          type: 'POST',
          data: {'t_id' : id, 'category_id' : category_id, 'outlet_id' : outlet_id, '_token': csrf},
          dataType: 'json',

          success: function( data ) {
            //alert(data[0].shelf);

            var html = '';

            // html += '<div class="col-lg-4">';
            // html += '<span class="span_total">Total:</span>  <span class="span_tot" id="total">'+data[0].shelf+' Meters'+'</span>';
            // html += '</div>';
            html += '<div class="col-lg-4">';
            html += '<span class="span_total">Target:</span>  <span class="span_tot" id="target">'+data[0].target+'%'+ '</span>';
            html += '</div>';
            html += '<div class="col-lg-4">';
            html += ' <span class="span_total">Actual:</span>  <span class="span_tot" id="actual"></span>';
            html += '</div>';

             //$('#total').html(data[0].shelf+' Meters');
             //$('#target').html(data[0].target+'%');

             // if(data == 0){
             //    alert('Please select reason..');
             //    return false;
             // }

             //  Swal.fire(
             //      'Updated!',
             //      'Product data has been updated.',
             //      'success'
             //    );

             $("#shelf_append").html(html);

          }       
    })
}

function get_actual(id, brand_id, outlet_id)
{
  
    //alert(brand_id);

    var total = $("#total").text();
    var target = $("#target").text();
   
    var suffix = target.match(/\d+/); 
    //alert(suffix);
    var array_total = total.split(" ");
    //alert(array[0]);

    var array_target = total.split(" ");
    //alert(array[0]);

    var input_value = $("#"+brand_id).val();

    var actual = input_value / array_total[0] * 100;
    //alert(actual.toFixed(2));
    actual = actual.toFixed(0);
    //alert(actual);

    console.log($(e.target).closest("tr").attr("id"));

    $('#actual').html(actual+'%');

    if(actual >= suffix || actual == 100)
    {
        //alert('greater');
        $("#actual").css("color", "green");
    }
    else
    {
        //alert('lesser');
        $("#actual").css("color", "red");
    }

}


$("#submit").click(function(){

    //alert("clicked.");
    var rowCount = $('#datatables >tbody >tr').length;
   
   // var array = $('#datatables tbody tr:eq(0) td').toArray();

    var attr = $("#datatables tbody tr:eq(1) td input[class*=checkbox]").attr('product_id');

    //alert(attr);
    var array = [];

    $('#datatables >tbody >tr').each(function(index) {
       // alert(index); 
        var actual = $("#datatables tbody tr:eq("+index+") td input[class*=share]").val();
        //alert(actual);

       //   var product_id = $("#datatables tbody tr:eq("+index+") td input[class*=checkbox]").attr('product_id');
       //  //alert(product_id);

       //  var brand_name = $("#datatables tbody tr:eq("+index+") td[class*=brand_name]").text();  
        
       //  var b_name = brand_name.trim();

       //  var category_name = $("#datatables tbody tr:eq("+index+") td[class*=category_name]").text();  
        
       //  var c_name = category_name.trim();

       //  var product_name = $("#datatables tbody tr:eq("+index+") td[class*=product_name]").text();  
        
       //  var p_name = product_name.trim();

       // // alert(p_name);

       //  var outlet_id = $("#datatables tbody tr:eq("+index+") td input[class*=checkbox]").attr('outlet_id');
       //  //alert(outlet_id);

       //  var checkbox = $("#datatables tbody tr:eq("+index+") td input[class*=checkbox]").is(':checked');
       //  //alert(checkbox);

       //  if(checkbox ==true)
       //      check_value = 1;
       //  if(checkbox ==false)
       //      check_value = 0;

       //  //alert(check_value);

       //  var reason = $("#datatables tbody tr:eq("+index+") td select[class*=text]").val();
       //  // (reason);

       // // var key = '{"timesheet_id"' + ":" +'"' + timesheet_id +'"' + "," + "product_id" + ":" +'"' + product_id +'"' + "," + "outlet_id" + ":" +'"' + outlet_id +'"' + "," + "check_value" + ":" +'"' + check_value +'"' + "," + "reason" + ":" +'"' + reason +'"' + "}";

       //  var key = '{"timesheet_id": "'+timesheet_id+'", "product_id" : "'+product_id+'","brand_name" : "'+b_name+'","category_name" : "'+c_name+'","product_name" : "'+p_name+'","outlet_id": "'+outlet_id+'", "check_value" : "'+check_value+'", "reason" : "'+reason+'"}';
      
       //  array.push(key)

    });


    // var value = "["+array.toString()+"]";

    // console.log(value);

    // var csrf = $('meta[name="csrf-token"]').attr('content');

    // Swal.fire({
    //   title: 'Are you sure?',
    //   text: "You can able to revert this!",
    //   icon: 'warning',
    //   showCancelButton: true,
    //   confirmButtonColor: '#3085d6',
    //   cancelButtonColor: '#d33',
    //   confirmButtonText: 'Yes, update it!'
    // }).then((result) => {
    //   if (result.isConfirmed) {

    //      $.ajax({
    //           url: '/update_product_availability',
    //           type: 'POST',
    //           data: {'value' : value, '_token': csrf},
    //           dataType: 'json',

    //           success: function( data ) {
    //              //alert(data);

    //              if(data == 0){
    //                 alert('Please select reason..');
    //                 return false;
    //              }

    //               Swal.fire(
    //                   'Updated!',
    //                   'Product data has been updated.',
    //                   'success'
    //                 );

    //           }       
    //       })

       
    //   }
    // })


});

  </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', ['activePage' => 'journey-plan', 'menuParent' => 'Journey-Plan', 'titlePage' => __('Customer Activity')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thethethoughtfactory/Desktop/RMS-2-11-21/resources/views/share_of_shelf/index.blade.php ENDPATH**/ ?>