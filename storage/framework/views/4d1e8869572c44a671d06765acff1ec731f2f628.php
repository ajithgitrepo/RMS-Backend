<style type="text/css">

.card-stats{
  height: 100px;
}

.card-stats .card-header.card-header-icon i {
    font-size: 56px !important;
    line-height: 56px;
    width: 56px;
    height: 56px;
    text-align: center;
}

/* This css is for normalizing styles. You can skip this. */
*,
*:before,
*:after {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

.new {
  padding: 50px;
}

.form-group {
  display: block;
  margin-bottom: 15px;
}

.form-group input {
  padding: 0;
  height: initial;
  width: initial;
  margin-bottom: 0;
  display: none;
  cursor: pointer;
}

.form-group label {
  position: relative;
  cursor: pointer;
}

.form-group label:before {
  content: "";
  -webkit-appearance: none;
  background-color: transparent;
  border: 2px solid #0079bf;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05),
    inset 0px -15px 10px -12px rgba(0, 0, 0, 0.05);
  padding: 10px;
  display: inline-block;
  position: relative;
  vertical-align: middle;
  cursor: pointer;
  margin-right: 5px;
}

.form-group input:checked + label:after {
  content: "";
  display: block;
  position: absolute;
  top: 2px;
  left: 9px;
  width: 6px;
  height: 14px;
  border: solid #0079bf;
  border-width: 0 2px 2px 0;
  transform: rotate(45deg);
}



</style>



<?php $__env->startSection('content'); ?>
<div class="content">
  <div class="content">
    <div class="container-fluid">

      <div class="row">

        <div class="col-lg-12 col-md-12 col-sm-12">
			
			
			
			  <?php if($nbl_file->isNotEmpty()): ?>
            <a name="submit" href="/nbl_file/<?php echo e($nbl_file[0]->file_url); ?> " target="_blank" id="check_out" class="btn btn-success " style="margin-bottom: 15px;color: #fff;">NBL File</a>
            <?php endif; ?>

            <button name="submit" id="check_out" class="btn btn-danger float-right"  value="<?php echo e(Request::segment(2)); ?>" onclick="check_model(this.value)" style="margin-bottom: 15px;">Check Out</button>
                   
             
          <div class="card card-stats title-card">
            <div class="card-header cards-header card-header-warning card-header-icon">
             <!--  <div class="card-icon">
                <i class="material-icons">emoji_events</i>
              </div> -->

                   <h2 class="text-center" style="color: #827e7e;"><i class="material-icons">store_front</i></h2>
             
                    <h5 class="text-center" style="color: #827e7e;" ><?php echo e('[' .$result[0]->store_code. ']'); ?> <?php echo e($result[0]->store_name .','); ?> <?php echo e($result[0]->address .','); ?> <?php echo e($result[0]->outlet_city .','); ?> <?php echo e($result[0]->outlet_state); ?> </h5>
            </div>
         
          </div>
        </div>

       
       <div class="col-lg-6 col-md-6 col-sm-6">
          <div class="card card-stats cards">
            <div class="card-header cards-header card-header-warning card-header-icon">
             <!--  <div class="card-icon">
                <i class="material-icons">emoji_events</i>
              </div> -->
              <a href="<?php echo e(url('p-availabity',['id' => Crypt::encrypt(Request::segment(2)) ])); ?> "> 
                <h5 class="text-center" style="color: #827e7e;" >
                    <i class="material-icons">inventory_2</i>
                    <?php if($availability == true): ?>
                    <span class="material-icons" title="Completed" style="float:right;color: #3b9d40;">done</span>
                    <?php endif; ?>
                    <?php if($availability == false): ?>
                    <span class="fa fa-times" title="Pending" style="float:right;color: red;"></span>
                   <?php endif; ?>
                </h5>
              <h4 class="text-center" style="color: #827e7e;">Availability</h4> </a>

            </div>
            
          </div>
        </div>

         <div class="col-lg-6 col-md-6 col-sm-6">
          <div class="card card-stats cards">
            <div class="card-header cards-header card-header-warning card-header-icon">
             <!--  <div class="card-icon">
                <i class="material-icons">emoji_events</i>
              </div> -->
             <a href="<?php echo e(url('p-visibility',['id' => Crypt::encrypt(Request::segment(2)) ])); ?>"> <h5 class="text-center" style="color: #827e7e;" ><i class="material-icons">visibility</i>

               <?php if($visibility == true): ?>
                <span class="material-icons" title="Completed" style="float:right;color: #3b9d40;">done</span>
                <?php endif; ?>
                <?php if($visibility == false): ?>
                <span class="fa fa-times" title="Pending" style="float:right;color: red;"></span>
               <?php endif; ?>  

             </h5>
              <h4 class="text-center" style="color: #827e7e;">Visibility</h4> </a>
            </div>
         
          </div>
        </div>
         <div class="col-lg-6 col-md-6 col-sm-6">
          <div class="card card-stats cards">
            <div class="card-header cards-header card-header-warning card-header-icon">
             <!--  <div class="card-icon">
                <i class="material-icons">emoji_events</i>
              </div> -->
           <a href="<?php echo e(url('share_of_shelf',['id' => Crypt::encrypt(Request::segment(2)) ])); ?> ">  <h5 class=
            "text-center" style="color: #827e7e;" ><i class="material-icons">assessment</i>
                <?php if($shareof_shelf == true): ?>
                <span class="material-icons" title="Completed" style="float:right;color: #3b9d40;">done</span>
                <?php endif; ?>
                <?php if($shareof_shelf == false): ?>
                <span class="fa fa-times" title="Pending" style="float:right;color: red;"></span>
               <?php endif; ?>  

           </h5>
              <h4 class="text-center" style="color: #827e7e;">Share Of Shelf</h4> </a>
            </div>
         
          </div>
        </div>
       

         <div class="col-lg-6 col-md-6 col-sm-6">
          <div class="card card-stats cards">
            <div class="card-header cards-header card-header-warning card-header-icon">
             <!--  <div class="card-icon">
                <i class="material-icons">emoji_events</i>
              </div> -->
             <a href="<?php echo e(url('promotion_check',['id' => Crypt::encrypt(Request::segment(2)) ])); ?>"> <h5 class="text-center" style="color: #827e7e;" ><i class="fa fa-percent"></i>

                 <?php if($promotion_check == true): ?>
                <span class="material-icons" title="Completed" style="float:right;color: #3b9d40;">done</span>
                <?php endif; ?>
                <?php if($promotion_check == false): ?>
                <span class="fa fa-times" title="Pending" style="float:right;color: red;"></span>
               <?php endif; ?> 

            </h5>
              <h4 class="text-center" style="color: #827e7e;">Promotion Check</h4> </a>
            </div>
         
          </div>
        </div>
         <div class="col-lg-6 col-md-6 col-sm-6">
          <div class="card card-stats cards">
            <div class="card-header cards-header card-header-warning card-header-icon">
             <!--  <div class="card-icon">
                <i class="material-icons">emoji_events</i>
              </div> -->
             <a href="<?php echo e(url('p-planogramCheck',['id' => Crypt::encrypt(Request::segment(2)) ])); ?>"> <h5 class="text-center" style="color: #827e7e;" ><i class="material-icons">receipt_long</i>


                 <?php if($planogram_checks == true): ?>
                <span class="material-icons" title="Completed" style="float:right;color: #3b9d40;">done</span>
                <?php endif; ?>
                <?php if($planogram_checks == false): ?>
                <span class="fa fa-times" title="Pending" style="float:right;color: red;"></span>
               <?php endif; ?>  

             </h5>
              <h4 class="text-center" style="color: #827e7e;">Planogram Check</h4> </a>
            </div>
         
          </div>
        </div>
        <!--  <div class="col-lg-6 col-md-6 col-sm-6">
          <div class="card card-stats cards">
            <div class="card-header cards-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="material-icons">emoji_events</i>
              </div>
             <a href=""> <h5 class="text-center" style="color: #827e7e;" ><i class="material-icons">filter_list</i></h5>
              <h4 class="text-center" style="color: #827e7e;">Share Of Assortment</h4> </a>
            </div>
         
          </div>
        </div> -->
         <div class="col-lg-6 col-md-6 col-sm-6">
          <div class="card card-stats cards">
            <div class="card-header cards-header card-header-warning card-header-icon">
             <!--  <div class="card-icon">
                <i class="material-icons">emoji_events</i>
              </div> -->
            <a href="<?php echo e(url('competitor_info',['id' => Crypt::encrypt(Request::segment(2)) ])); ?>"> <h5 class="text-center" style="color: #827e7e;" ><i class="material-icons">info</i>

               <?php if($competitor == true): ?>
                <span class="material-icons" title="Completed" style="float:right;color: #3b9d40;">done</span>
                <?php endif; ?>
                <?php if($competitor == false): ?>
                <span class="fa fa-times" title="Pending" style="float:right;color: red;"></span>
               <?php endif; ?> 

            </h5>
              <h4 class="text-center" style="color: #827e7e;">Compitetor info Capture</h4> </a>
            </div>
         
          </div>
        </div>

         <div class="col-lg-6 col-md-6 col-sm-6">
          <div class="card card-stats cards">
            <div class="card-header cards-header card-header-warning card-header-icon">
             <!--  <div class="card-icon">
                <i class="material-icons">emoji_events</i>
              </div> -->
            <a href="<?php echo e(url('outlet_stockexpiry',['id' => Crypt::encrypt(Request::segment(2)) ])); ?>"> <h5 class="text-center" style="color: #827e7e;" ><i class="material-icons">insert_invitation</i>

                <?php if($outlet_stockexpiry == true): ?>
                <span class="material-icons" title="Completed" style="float:right;color: #3b9d40;">done</span>
                <?php endif; ?>
                <?php if($outlet_stockexpiry == false): ?>
                <span class="fa fa-times" title="Pending" style="float:right;color: red;"></span>
               <?php endif; ?> 

            </h5>
              <h4 class="text-center" style="color: #827e7e;">Stock Expiry</h4> </a>
            </div>
         
          </div>
        </div>

        <!-- <div class="col-lg-6 col-md-6 col-sm-6">
          <div class="card card-stats cards">
            <div class="card-header cards-header card-header-warning card-header-icon">
             
             <a onclick="check_model();"> <h5 class="text-center" style="color: #827e7e;" ><i class="material-icons">done</i></h5>
              <h4 class="text-center" style="color: #827e7e;">Category Check</h4> </a>
            </div>
         
          </div>
        </div> -->

       
       
      </div>


    </div>
  </div>
</div>



<div class="modal fade tableSettings" id="check_model" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="text-center">Check List</h4>
        </div>
         <form method="post" action="<?php echo e(route('update_category_check')); ?> " autocomplete="off" class="form-horizontal" enctype="multipart/form-data">

            <input type="hidden" name="_token" id="csrf-token" value="<?php echo e(Session::token()); ?>" />   
               
           
        <div class="modal-body" id="category_checkbox">
           
             <!-- <div class="checkbox">
              <label>
                <input type="checkbox"/> Check me out
              </label>
            </div> -->
           
        </div>
        <input  type="hidden" id="uploadvisibilityfile" name="uploadvisibilityfile[]"  />  
         <div class="col text-center">
            <button type="submit" value="<?php echo e(Request::segment(2)); ?>" id="update_category" class="btn btn-rose">Check Out</button>
          </div>
         </form>
    </div>
  </div>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      
      md.initVectorMap();

      demo.initCharts();

    

      md.initDashboardPageCharts();

      

    });

  
       $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      var csrf = $('meta[name="csrf-token"]').attr('content');


    
function check_out(id)
{
    //alert(id);

    var csrf = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
          url: '/outlet_check_out',
          type: 'POST',
          data: {id : id, _token: csrf},
          dataType: 'json',

          success: function( data ) {
             
             if(data ==0)
             {
                alert('Please login..');
                return false;
             }

             if(data ==1)
             {
                alert("Check Out Successfully..");
                window.location.href = '/journey-plan/';
             }

          }       
      })

}


function check_model(){

    
    var csrf = $('meta[name="csrf-token"]').attr('content');

    var url = window.location.href;
    var arr = url.split('/');

    var timesheet_id = arr[4];

    //alert(a);

     $.ajax({
          url: '/get_category_check',
          type: 'GET',
          data: {timesheet_id : timesheet_id, _token: csrf},
          dataType: 'json',

          success: function( data ) {
             
             //alert(data);

             var html = '';

             $.each(data, function (key, val) {

                html += '<div class="checkbox">';
                  html += '<label><input type="checkbox" name="check_confirm[]" required timesheet="'+timesheet_id+'" value="'+data[key].id+'" /> '+data[key].task_list+' </label>';
                  html += '<input type="file" name=task_file[] accept="image/*" style="margin-left:30px;" required > ';
                html += '</div>';

             });

             $("#category_checkbox").html(html);

          }       
      })

     $('#check_model').modal('show');

}

    $('#update_category').click(function() {

        var timesheet_id = $(this).val();

        var checkboxes = $("input[name='check_confirm[]']").length;
        //alert(checkboxes);

        var checked = $("input[name='check_confirm[]']:checked" ).length;
        //alert(checked);

        if(checked < checkboxes)
        {
            Swal.fire(
              'Please complete all tasks..',
              '',
              'error'
            ) 

            return false;
        }

        var array = [];
        $("input[name='check_confirm[]']").each( function () {
            //alert($(this).val());

            var timesheet_id = $(this).attr("timesheet");

            var task_id = $(this).val();

            if ($(this).prop('checked')==true)
            { 
                //alert($(this).val());
                var key = '{"timesheet_id": "'+timesheet_id+'", "task_id" : "'+task_id+'","checked" : "1"}';
      
                array.push(key)
            }

            if ($(this).prop('checked')==false)
            { 
                //alert($(this).val());
                var key = '{"timesheet_id": "'+timesheet_id+'", "task_id" : "'+task_id+'","checked" : "0"}';
      
                array.push(key)
            }


        });

        //alert(array);

        if(array == "")
        {
            var array = '{"timesheet_id": "'+timesheet_id+'"}';
        }

        //alert(array);

        var value = "["+array.toString()+"]";

        console.log(value);

        $('#uploadvisibilityfile').val(value);

        // Swal.fire({
        //   title: 'Are you sure?',
        //   text: "You can't able to revert this!",
        //   icon: 'warning',
        //   showCancelButton: true,
        //   confirmButtonColor: '#3085d6',
        //   cancelButtonColor: '#d33',
        //   confirmButtonText: 'Yes, logout!'
        // }).then((result) => {
        //   if (result.isConfirmed) {

        //      $.ajax({
        //           url: '/update_category_check',
        //           type: 'POST',
        //           data: {'value' : value, '_token': csrf},
        //           dataType: 'json',

        //           success: function( data ) {
        //              //alert(data);

        //             if(data ==1)
        //              {
        //                Swal.fire(
        //                   'Logout Successfully',
        //                   '',
        //                   'success'
        //                 ).then(function() {
        //                     window.location.href = '/journey-plan/';
        //                 });

                        
        //              }

                      

        //           }       
        //       })

           
        //   }
        // })


    })
    


  </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', ['activePage' => 'journey-plan', 'menuParent' => 'Journey-Plan', 'titlePage' => __('Customer Activity')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thethethoughtfactory/Desktop/RMS-2-11-21/resources/views/customer_activity/index.blade.php ENDPATH**/ ?>