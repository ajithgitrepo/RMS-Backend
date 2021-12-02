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

   .card [class*="card-header-"] .card-text .card-title {
    color: #fff;
    margin-top: 0;
    width: 855px;
}

.modal-dialog .modal-body {
    padding-top: 24px;
    padding-right: 24px;
    padding-bottom: 16px;
    padding-left: 24px;
    position: relative;
    top: -20px;
    margin-top: -5px;
}

#palnoModalview {
   
    position: absolute;
    top: -65px;
    height:650px;
  
} 



/* Important part */
.modal-dialog{
 
  overflow: auto;
    overflow-y: initial !important
}
.modal-body{
    height: 80vh;
    overflow-y: auto;
}

</style>


@extends('layouts.app', ['activePage' => 'journey-plan', 'menuParent' => 'Journey-Plan', 'titlePage' => __('Customer Activity')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">shop</i>
                </div>
                <h4 class="card-title">{{ __('Planogram Check') }}</h4>
              </div>
              
              
              <div class="card-body">
                @php

                    $parameter= Crypt::decrypt(Request::segment(2));

                @endphp

                <div class="row">
                  <div class="col-md-12 text-right">
                       <a href="{{ route('c-activity',['id' => $parameter ]) }}" title="Back to Activity" class="btn btn-sm btn-rose"><i class="fa fa-arrow-left"> Back</i></a>
                   </div>
                 </div>

           <br>

          <!--  <div class="card-header card-header-text card-header-warning">
            <div class="card-text">
           
            @foreach($Store_result as $str)
            <center>
                <h4 class="card-title">  [{{ $str->store_code }}] {{ $str->store_name }}</h4>
                <p class="card-category">{{ $str->contact_number }} - {{ $str->address }}  </p>
                </center>
              @endforeach 
            </div>
          </div> -->
    
         
               <div class="table-responsive">
               <form method="post" action="{{ route('update_product_Planogram_Check') }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
                  <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />   
               


               
                  <table id="datatables" class="table table-striped table-no-bordered table-hover" style="display:none">
                 
                    <thead class="text-primary">
                   
                      <th>
                      {{ __('S.No') }}
                      </th>

                      <th>
                          {{ __('Category') }}
                      </th>
                      <!-- <th>
                      {{ __('Brand') }}
                      </th> -->
                      <!-- <th>
                      {{ __('Category') }}
                      </th> -->
                      <th>
                          {{ __('Before_Image') }}
                      </th>
                     
                      <th>
                          {{ __('After_Image') }}
                      </th>
                      <th>
                          {{ __('Check') }}
                      </th> 
                      
                    </thead>
                    
                    <tbody>

                      @php

                        $i=0;
                        $k=0;
                      
                      @endphp
                 
                      @foreach($result as $product)
                           
                              
                     <tr> 
                          <td>
                            {{ ++$i }}  
                          </td>
                         <!--  <td class="sorting_1">
                            <div class="avatar avatar-sm rounded-circle img-circle" style="width:100px; height:100px;overflow: hidden;">
                                @if($product->planogram_img != "")
                                <img src="/planogram_image/{{ $product->planogram_img }}" onclick="DoSomething(this.src);" alt="" style="max-width: 100px;">
                                @else 
                                <img  onclick="DoSomething(this.src);" alt="" style="max-width: 100px;">
                                @endif
                            </div>
                            </td>
                           -->
                          <td>
                        
                         <a href=""  id="{{$product->c_id }}"  class="bleu"  title="" > {{$product->category_name }} </a>  

                            <input type="checkbox" checked
                              id="{{ $i }}"   style="display:none"   plano_image="{{$product->planogram_img}}"
                              outlet_products_mapping_id="{{$product->opm}}"  category_id="{{$product->c_id}}"
                              timesheet_id="{{$product->id}}" 
                              journy_date="{{$product->date}}"
                              category_name="{{$product->category_name}}"
                              default_image="{{$product->planogram_img}}"
                              outlet_id="{{$product->outlet_id}}" class="checkbox" >
                             
                          </td>
                       
                          <td>
                          <input type="file"  name="uploadfile[]" accept="image/*" id="file{{ $k }}" ></input>
                          </td>
                                
                          <td> 
                           <!-- <textarea style="width: 350px;" cols="3" rows="3" name="reason" id="{{ $i }}" class="reason text"></textarea> -->
                         
                           <input type="file" class="secondfile"  name="uploadfile[]" accept="image/*" id="file{{ $k }}" ></input>
                         
                          </td>
                          
                           
                           
                            <td>
                                        <!-- Pending -->  
                         @if(($product->before_image == null && $product->after_image == null ))
                       <a href="javascript:void(0)"  id="{{$product->planlo_id }}" rel="tooltip" data-original-title="Planogram Check"  class=""  title="" > Pending </a>
                             @else
                       <a href="javascript:void(0)"  id="{{$product->planlo_id }}" rel="tooltip" data-original-title="Planogram Check"  class="palnoview"  title="" > view </a>
                             @endif
                           
                            </td>

                    </tr>
                           
                  @php
                  $k++;
                  @endphp
                             

                       @endforeach 
          
                    </tbody> 
                  </table>
                  <input  type="hidden" id="uploadvisibilityfile" name="uploadvisibilityfile[]"  /> 
                  <button id="submit" disabled  type="submit" class="btn btn-rose float-right">{{ __('Submit') }}</button>
                  </form>
                  
                </div>
              </div>
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


                  <!-- Model for Product_details_view -->
  
 <div class="modal fade bd-example-modal-lg" id="exampleModalview"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">

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
                <th>Brand Name :</th>
                <td id="brand_id"></td>
               </tr>
              
               <tr>
                <th>Client :</th>
                <td id="client_id"></td>
               </tr>

               <tr>
                <th>Field Manager : </th>
                <td id="field_id"></td>
               </tr>

               <tr>
                <th>Sales Manager :</th>
                <td id="sales_id"></td>
               </tr>
              
               <!-- <tr>
                <th>Product Categories </th>
                <td id="product_categories"></td>
               </tr> -->
          
              <!-- <tr>
                <th>Remarks </th>
                <td id="remarks"></td>
               </tr> -->
               
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


        <!-- Model for Planl_check_details_view -->
  
        <div class="modal fade bd-example-modal-lg" id="palnoModalview"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">

<div class="modal-dialog modal-lg">


  <div class="modal-content">
  
    <div class="modal-header">
      <h4 class="modal-title" id="exampleModalLabelok">Planogram Check</h4>
     
      <a href="" id="closebutton"   class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </a>
    </div>
 

 
    <div class="modal-body" id="modelbody">
     <div class="modal-dialog1 modal-dialog-center">

       <div class="row">
        <div class="col-md-8 ml-auto mr-auto">
          <div class="page-categories">
            <h3 class="title text-center"></h3>
            <br />
            <ul class="nav nav-pills nav-pills-warning nav-pills-icons justify-content-center" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#link7" role="tablist">
                  <i class="material-icons">photo_size_select_actual</i> Planogram Image
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#link8" role="tablist">
                  <i class="material-icons">panorama</i> Before Image
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#link9" role="tablist">
                  <i class="material-icons">compare</i> After Image
                </a>
              </li>
              <!-- <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#link10" role="tablist">
                  <i class="material-icons">help_outline</i> Help Center
                </a>
              </li> -->
            </ul>
            <div class="tab-content tab-space tab-subcategories">
              <div class="tab-pane active" id="link7">
                <div class="card text-center">
                  <div class="card-header">
                    <h4 class="card-title">Planogram</h4>
                    <!-- <p class="card-category">
                      More information here
                    </p> -->
                  </div>
                  <div class="card-body">
                  <img id="ImgPlano"  onclick="DoSomething(this.src);" alt="" style="max-width: 300px;">
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="link8">
                <div class="card text-center">
                  <div class="card-header">
                    <h4 class="card-title">Before</h4>
                    <!-- <p class="card-category">
                      More information here
                    </p> -->
                  </div>
                  <div class="card-body">
                  <img id="ImgPlano_before"   alt="" style="max-width: 200px;">
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="link9">
                <div class="card text-center">
                  <div class="card-header">
                    <h4 class="card-title">After</h4>
                    <!-- <p class="card-category">
                      More information here
                    </p> -->
                  </div>
                  <div class="card-body">
                  <img id="ImgPlano_after"   alt="" style="max-width: 200px;">
                  </div>
                </div>
              </div>
              
              </div>
            </div>
          </div>
        </div>

   </div>
  </div>    
        
       
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
    
   </div>
  </div>
</div>
</div>


@endsection

@push('js')
  <script>

  function DoSomething(data)
  {
 // alert(data);
  $('#FullImage').attr('src',data );
  $('#myModal').modal('show');

  }

//   $('input[type=file]').change(function(e){
//   $in=$(this);
//   $in.next().html($in.val());
//  /// alert($(this).val());
// });

function view_products(id){
    //  alert(id);
      var csrf = $('meta[name="csrf-token"]').attr('content');
      $.ajax({
           url: '/view_brands',
          type: 'GET',
          data: {id : id, '_token': csrf},
          dataType: 'json',

          success: function( data ) {
          // 
        
          // 
          
          //alert(JSON.stringify(data));
          //alert(test[0].brand);
         // var obj = JSON.parse(data);
          //alert(obj);
         // var val = obj[0].brand_name;
        //  alert(data[0]['employee_client'][0]['first_name']);     

              var test = (JSON.stringify(data));   
                  //  $.each(data,function( index,value){
                  //  alert(value.brand_name);
                //});
         //   $("#brand_id")   .html(': '+test[0].brand_name);
         
            $("#brand_id").html(': '+data[0]['brand_name']);
            $("#client_id").html(': '+data[0]['employee_client'][0]['first_name'] +" " +data[0]['employee_client'][0]['middle_name'] +" " + data[0]['employee_client'][0]['surname']);
           
            $("#field_id").html(': '+data[0]['employee_field'][0]['first_name'] +" " +data[0]['employee_field'][0]['middle_name'] +" " + data[0]['employee_field'][0]['surname']);

            $("#sales_id").html(': '+data[0]['employee_sales'][0]['first_name'] +" " +data[0]['employee_sales'][0]['middle_name'] +" " + data[0]['employee_sales'][0]['surname']);

            $('#exampleModalview').modal('show');
            $( "div.modal-dialog" ).scrollBottom( 300 );
          }         
      })

    }


    function view_palno(id){
     // alert(id);
      var csrf = $('meta[name="csrf-token"]').attr('content');
      $.ajax({
           url: '/view_palno', 
          type: 'GET',
          data: {id : id, '_token': csrf},
          dataType: 'json',

          success: function( data ) {  //alert(data);
            var APP_URL = {!! json_encode(url('/')) !!}
            var planourl = APP_URL + "/planogram_image/" + data[0]['default_image'];
           // alert(planourl); 
            $("#ImgPlano").attr("src", planourl);

            var planourl_before = APP_URL + "/planogram_image/" + data[0]['before_image'];
            $("#ImgPlano_before").attr("src", planourl_before);

            var planourl_afer = APP_URL + "/planogram_image/" + data[0]['after_image'];
            $("#ImgPlano_after").attr("src", planourl_afer);
            //.html(': '+data[0]['brand_name']);
           

            $('#palnoModalview').modal('show');
          //  $('#palnoModalview').scrollTop($('#suggestDetails').offset().top);
 
                  // get the top of the section 
        var sectionOffset = $('#exampleModalLabelok').offset();
        //scroll the container 
        $('#palnoModalview .modal-body').animate({
          scrollTop: sectionOffset.top - 90
        }, "slow");
          }         
      })

    }

    $(document).ready(function() {
      $('#submit').prop('disabled', true);
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
          searchPlaceholder: "Search product",
        }
      });
    }); 


$(document).ready(function() {
      //init DateTimePickers
    //  $('#myModal').modal('show'); 
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".reason").hide();

    $(document).ready(function() {
      $('#datatables').fadeIn(1100);

   
    });

  //   $('input[type=file]').change(function(e){  
  //     var id = ($(this).attr('id'));
  //   var reader = new FileReader();
  //   reader.onload = function(){
  //     var output = id;
  //     output.src = reader.result;
  //   };
  //   reader.readAsDataURL(event.target.files[0]);
  // });

  function readURL(input, id) {
  // alert(id);
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    var newid = "#img" + id;
    reader.onload = function(e) {
      $(newid).attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

$('input[type=file]').change(function(e){  
  var id = ($(this).attr('id'));
  var newid = id.slice(4);
  //alert(newid);
  $('#submit').prop('disabled', false);
  readURL(this,newid);
});


    $("#submit").click(function(event){
     
//alert("clicked.");
var rowCount = $('#datatables >tbody >tr').length;

// var array = $('#datatables tbody tr:eq(0) td').toArray();

var attr = $("#datatables tbody tr:eq(1) td input[class*=checkbox]").attr('product_id');

//alert(attr);
var array = [];

$('#datatables >tbody >tr').each(function(index) {
    //alert(index); 
    var timesheet_id = $("#datatables tbody tr:eq("+index+") td input[class*=checkbox]").attr('timesheet_id');
    //alert(timesheet_id);  

    var outlet_products_mapping_id = $("#datatables tbody tr:eq("+index+") td input[class*=checkbox]").attr('outlet_products_mapping_id');

    var category_id = $("#datatables tbody tr:eq("+index+") td input[class*=checkbox]").attr('category_id');
   
     //var product_id = $("#datatables tbody tr:eq("+index+") td input[class*=checkbox]").attr('product_id');
    //alert(product_id);   

    var plano_image = $("#datatables tbody tr:eq("+index+") td input[class*=checkbox]").attr('plano_image');

     var outlet_id = $("#datatables tbody tr:eq("+index+") td input[class*=checkbox]").attr('outlet_id');
    //alert(outlet_id);  

    var journy_date = $("#datatables tbody tr:eq("+index+") td input[class*=checkbox]").attr('journy_date');

    var category_name = $("#datatables tbody tr:eq("+index+") td input[class*=checkbox]").attr('category_name');

    var default_image = $("#datatables tbody tr:eq("+index+") td input[class*=checkbox]").attr('default_image');
  
    var checkbox = $("#datatables tbody tr:eq("+index+") td input[class*=checkbox]").is(':checked');
    //alert(checkbox);  .next('td').find('input[type=file]')
  //  event.preventDefault();

        var before_image = $("#datatables tbody tr:eq("+index+") td input[type=file]").val();
        var text = before_image;
        before_image = text.substring(text.lastIndexOf("\\") + 1, text.length);
       
        var after_image = $("#datatables tbody tr:eq("+index+") td input[type=file].secondfile").val();
      
        var text = after_image;
        after_image = text.substring(text.lastIndexOf("\\") + 1, text.length);
       
      //  if(check_value == 1 && reason == "")
      //  {
      //   event.preventDefault();
      //  return alert('Image is required');
      //  }

      //  if(check_value == 0 && reason == "")
      //  {
      //   event.preventDefault();
      //   return alert('Reason is required');
      //  }
     
   // var key = '{"timesheet_id"' + ":" +'"' + timesheet_id +'"' + "," + "product_id" + ":" +'"' + product_id +'"' + "," + "outlet_id" + ":" +'"' + outlet_id +'"' + "," + "check_value" + ":" +'"' + journy_date +'"' + "," + "reason" + ":" +'"' + reason +'"' + "}";

    var key = '{"timesheet_id": "'+timesheet_id+'",  "outlet_products_mapping_id" : "'+outlet_products_mapping_id+'","category_id" : "'+ category_id+'","outlet_id": "'+ outlet_id+'",  "journy_date" : "'+journy_date+'",  "category_name" : "'+category_name+'"  , "before_image" : "'+ before_image+'" , "after_image" : "'+after_image+'" , "plano_image" : "'+plano_image+'" , "default_image" : "'+default_image+'" }';
  
    array.push(key)

});


var value = "["+array.toString()+"]";

//alert(value);

console.log(value);

$('#uploadvisibilityfile').val(value);
//alert($('#uploadvisibilityfile').val());

var csrf = $('meta[name="csrf-token"]').attr('content');

    var formData = new FormData($(this)[0]);
    // $.ajax({
    //     url: '{{ url('/update_product_availability') }}',
    //     type: 'POST',              
    //     data: formData,
    //     success: function(result)
    //     {
    //         alert(result);
    //           // alert(JSON.stringify(data[0]['id']));
    //     },
    //     error: function(data)
    //     {
    //         console.log(data);
    //     }
    // });


  // $.ajax({
  //     url: '/update_product_availability',
  //     type: 'POST',
  //     data: {'value' : value, '_token': csrf},
  //     dataType: 'json',

  //     success: function( data ) {
  //        //alert(data);

       

  //     }       
  // })



}); 
$('#closebutton').click(function(e) {
  //alert();
    //return false;
  });

$('.bleu').click(function(e) {
   var $id = ($(this).attr('id'));
    view_products($id);
    return false;
})

$('.palnoview').click(function(e) {
   var $id = ($(this).attr('id'));
    view_palno($id);
    return false;
})

// $(document).ready(function () {
//             @if (session('status'))
//               $.notify({
//                 icon: "done",
//                 message: "{{ session('status') }}"
//               }, {
//                 type: 'danger',
//                 timer: 3000, 
//                 placement: {
//                   from: 'top',
//                   align: 'right'
//                 }
//               });
//             @endif
//           });
  

  </script>
@endpush
