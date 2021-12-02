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

 .form-container{
      /*padding:10px;
      padding-bottom:25px;
      margin:0 auto;
      margin-top:20px;*/
      width:125%;
      /*border-radius:20px;
      background-color: #ececec;*/
    }

    .add-one{
      color:green;
      /*text-align:right;*/
      font-weigth:bolder;
      cursor:pointer;
      margin-top:10px;
    }

    .delete{
      color:white;
      background-color:rgb(231, 76, 60);
      text-align:center;
      margin-top:6px;
      font-weight:700;
      border-radius:5px;
      min-width:20px;
      cursor:pointer;
    }

    #singlebutton{
      width:100%;
      margin-top:20px;
    }

    .title{
      text-align:center;
      font-size:40px;
      margin-bottom:40px;
    }

    .dynamic-element{
      margin-bottom:0px;
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
                <h4 class="card-title">{{ __('Product Visibility') }}</h4>
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

         <!--   <div class="card-header card-header-text card-header-warning">
            <div class="card-text">
           
            @foreach($Store_result as $str)
            <center>
                <h4 class="card-title">  [{{ $str->store_code }}] {{ $str->store_name }}</h4>
                <p class="card-category">{{ $str->contact_number }} - {{ $str->address }}  </p>
                </center>
              @endforeach 
            </div>
          </div> -->
    
            <!-- {{ route('update_product_visibility') }} -->
         
               <div class="table-responsive">
               <form method="post" action="{{ route('update_product_visibility') }} " autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
                  <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />   
               
                  <table id="datatables" class="table table-striped table-no-bordered table-hover" style="display:none">
                 
                    <thead class="text-primary">
                   
                      <th>
                      {{ __('S.No') }}
                      </th>

                      <th>
                      {{ __('Category') }}
                      </th>
                      <th>
                          {{ __('Available?') }}
                      </th>
                      <th>
                          {{ __('Reason / Image') }}
                      </th>
                       <th>
                          {{ __('Area / SOS / POIs') }}
                      </th>
                       

                   <th></th>
                      
                    </thead>
                    
                    <tbody>

                      @php

                        $i=0;
                        $k=0;
                      
                      @endphp
                 
                      @foreach($result as $product)
                           

                        @php

                            if(isset($product->g_area))
                            {
                                $arr_g_area = explode(",",$product->g_area);
                                $arr_m_aisle = explode(",",$product->main_aisle);
                                $arr_pois = explode(",",$product->pois);

                            }

                               
                        @endphp

                             
                     <tr> 
                         
                          <td>
                            {{ ++$i }}  
                          </td>
                        
                          <td>
                        
                            {{ $product->category_name }}
                            
                          </td>

                           <td> 
                           <div class="togglebutton">
                              <label>
                          
                              @if( $product->is_available == "1" || $product->is_available == "is_available" || $product->is_available == null) 
                              <!-- <input type="hidden" name="{{ $i }}" value="0"> -->
                                <input type="checkbox" checked
                               
                                 id="{{ $i }}"  
                               
                                outlet_products_mapping_id="{{$product->opm}}"  
                                timesheet_id="{{$product->id}}" 
                                journy_date="{{$product->date}}"
                                category_name="{{$product->category_name}}"
                                category_id="{{$product->c_id}}"
                                outlet_id="{{$product->outlet_id}}" class="checkbox" >
                                <span class="toggle" ></span>



                               @else 
                                <input type="checkbox" 
                                 outlet_products_mapping_id="{{$product->opm}}"  
                                timesheet_id="{{$product->id}}"
                                journy_date="{{$product->date}}"
                                category_name="{{$product->category_name}}"
                                category_id="{{$product->c_id}}"
                                outlet_id="{{$product->outlet_id}}" class="checkbox" >
                                <span class="toggle"></span>
                                
                                @endif
                              
                              </label>
                            </div>
                          </td>
                                
                          <td> 
                           <!-- <textarea style="width: 350px;" cols="3" rows="3" name="reason" id="{{ $i }}" class="reason text"></textarea> -->
                         
                        @if( $product->is_available == "0") 
                          
                           <select name="reason" style="width:200px;" id="select{{ $i }}" class="form-control text">
                           <option value="Out Of Stock" @if( $product->reason  == 'Out Of Stock') ? selected : null @endif>Out Of Stock</option>
                           <option value="Expired" @if( $product->reason  == 'Expired') ? selected : null @endif>Expired</option>
                           
                               <!-- <option value="Out Of Stock" >Out Of Stock</option>
                               <option value="Expired">Expired</option> -->
                           </select>
                           <input type="file" style="display:none;"  name="uploadfile[]" accept="image/*" id="file{{ $k }}" ></input>
                           @endif
                           @if( $product->is_available == "1" ||  $product->is_available == "is_available" || $product->is_available == null) 
                           <select name="reason"  value="{{ old('reason') }}"  style="width:200px;display:none;" id="select{{ $i }}" class="form-control text">
                               <option value="" selected="">Reason</option>
                               <option value="Out Of Stock" >Out Of Stock</option>
                               <option value="Expired">Expired</option>
                           </select>
                           <input type="file"   name="uploadfile[]" accept="image/*" id="file{{ $k }}" ></input>
                       
                            


                           @endif

                          </td>


                          <td>

                            <div class="form-container">
                              <form class="form-horizontal">

                              <!-- Form Name -->
                             
                              <div class="dynamic-stuff">

                                @if(isset($product->g_area))

                                @foreach($arr_g_area as $key=> $g_area)

                                    <div class="form-group dynamic-element">
                                      <div class="row">
                                         <div class="col-md-3">
                                              
                                              <input type="text" name="g_area[]" class="form-control g_area" placeholder=" G Area" value="{{ $g_area }}" required>

                                         </div>
                                         
                                         <div class="col-md-3">

                                            <input type="text" name="main_aisle[]" class="form-control main_aisle" placeholder=" Main Aisle" value="{{ $arr_m_aisle[$key] }}" required>

                                          </div>
                                          <div class="col-md-3">
                                           
                                            <input type="text" name="pois[]" class="form-control pois" placeholder=" POIs" value="{{ $arr_pois[$key] }}" required>

                                          </div>
                                            
                                            <div class="col-md-1">
                                              <p class="delete">x</p>
                                            </div>
                                     </div>

                                    </div>

                                @endforeach

                                @endif

                              
                                
                              </div>
                              
                              <!-- Button -->
                              <div class="form-group">
                                <div class="row">
                                  <div class="col-md-12">
                                    @if( $product->is_available == "1") 
                                      <p class="add-one">+ Add</p>
                                    @endif
                                    @if( $product->is_available == "0") 
                                      <p class="add-one" style="display: none;">+ Add</p>
                                    @endif
                                    @if( $product->is_available == "is_available") 
                                      <p class="add-one" >+ Add</p>
                                    @endif
                                  </div>
                               
                                </div>
                              </div>

                             </form>
                            </div>

                          </td>
                          
                          <td class="sorting_1">
                            <!-- <div class="avatar avatar-sm img-circle" style="width:70px; height:50px;overflow: hidden;">
                              
                               @if( $product->category_name == "")
                                <img id="img{{ $k }}"  onclick="DoSomething(this.src);" alt="" style="max-width: 70px;">
                                @else
                                <img id="img{{ $k }}" src="/visibility_image/{{ $product->image_url }}"  onclick="DoSomething(this.src);" alt="" style="max-width: 70px;">
                                @endif
                            </div> -->
                           
                            </td>



                    </tr>
                           
                  @php
                  $k++;;
                  @endphp
                             

                       @endforeach 
                         
                    </tbody> 
                  </table>

                  <input  type="hidden" id="uploadvisibilityfile" name="uploadvisibilityfile[]"  />  
                  
                  <button id="submit" type="submit" class="btn btn-rose float-right">{{ __('Submit') }}</button>
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
                <th>Brand Name</th>
                <td id="brand_id"></td>
               </tr>
              
               <tr>
                <th>Client</th>
                <td id="client_id"></td>
               </tr>
              
               <tr>
                <th>Product Categories </th>
                <td id="product_categories"></td>
               </tr>
          
              <tr>
                <th>Remarks </th>
                <td id="remarks"></td>
               </tr>
               
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

@endsection



@push('js')
  <script>


    var html = '';

        html +='<div class="form-group dynamic-element">';
          html +='<div class="row">';
              html +='<div class="col-md-3">';
                  
                  html +='<input type="text" name="g_area[]" class="form-control g_area" placeholder="Area" required>';

              html +='</div>';
             
              html +='<div class="col-md-3">';

                    html +='<input type="text" name="main_aisle[]" class="form-control main_aisle" placeholder="SOS" required>';

              html +='</div>';
              html +='<div class="col-md-3">';
               
                    html +='<input type="text" name="pois[]" class="form-control pois" placeholder=" POIs" required>';

              html +='</div>';
                
                html +='<div class="col-md-1">';
                  html +='<p class="delete">x</p>';
                html +='</div>';
          html +='</div>';

        html +='</div>';
     
    $('.add-one').click(function(){

        $(this).closest('td').find('.dynamic-stuff').append(html);
       
        attach_delete();
    });


    //Attach functionality to delete buttons

   $('.delete').click(function(){

        attach_delete();
   });


    function attach_delete(){
      $('.delete').off();
       $('.delete').click(function(){
        //alert("click");
        $(this).closest('.form-group').remove();
    });
      
    }


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
     // alert(id);
      var csrf = $('meta[name="csrf-token"]').attr('content');
      $.ajax({
           url: '/view_products',
          type: 'GET',
          data: {id : id, '_token': csrf},
          dataType: 'json',

          success: function( data ) {
          // 
         //  alert(data);
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
            $("#client_id").html(': '+data[0]['first_name'] +" " +data[0]['middle_name'] +" " +data[0]['surname']);
            $("#product_categories").html(': '+data[0]['category_name']);
            $("#remarks").html(': '+data[0]['remarks']);

            $('#exampleModalview').modal('show');
          }         
      })

    }

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
          searchPlaceholder: "Search product / brand",
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

    //  $('select').hide();
      // $('#datatables').DataTable({
      //   "pagingType": "full_numbers",
      //   "lengthMenu": [
      //     [10, 25, 50, -1],
      //     [10, 25, 50, "All"]
      //   ],
      //   responsive: true,
      //   language: {
      //     search: "_INPUT_",
      //     searchPlaceholder: "Search products",
      //   }
      // });
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
  readURL(this,newid);
});


    $('.checkbox').change(function()
      {  
        $(this).closest('td').next('td').find('select').hide();
        $(this).closest('td').next('td').find('input').hide();
        $(this).closest('td').next('td').next('td').find('img').show();
        if (!$(this).is(':checked')) {
        //  $(this).prop('checked', false);
       // $(this).removeAttr('checked');
          var id = $(this).closest('td').next('td').find('select').attr('id');
            $(this).closest('td').next('td').find('select').show();
            $(this).closest('td').next('td').find('input').hide();

            $(this).closest('td').next('td').next('td').find('img').hide();
          //  alert(id);

            $(this).closest('table').find("tr td #"+id+" ").show();

          
            $(this).closest('tr').find('.add-one').hide();

            $(this).closest('tr').find(".dynamic-element ").remove();

           

        }
        else
        { //alert('v');
        //  $(this).addAttr('checked');
      //  $(this).attr('checked',"");
       // $(this).prop('checked', true);
        }


        if ($(this).is(':checked')) {
          
            var id = $(this).closest('td').next('td').find('select').attr('id');

           // alert(id);
           $(this).closest('td').next('td').find('select').hide();
           $(this).closest('td').next('td').find('input').show();

           $(this).closest('table').find("tr td #"+id+" ").hide();
          $(this).closest('tr').find('.add-one').show();

        }

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

    // var brand_id = $("#datatables tbody tr:eq("+index+") td input[class*=checkbox]").attr('brand_id');
   
    //  var product_id = $("#datatables tbody tr:eq("+index+") td input[class*=checkbox]").attr('product_id');
  
     var outlet_id = $("#datatables tbody tr:eq("+index+") td input[class*=checkbox]").attr('outlet_id');
    
    var journy_date = $("#datatables tbody tr:eq("+index+") td input[class*=checkbox]").attr('journy_date');

    //var brand_name = $("#datatables tbody tr:eq("+index+") td input[class*=checkbox]").attr('brand_name');

    var category_name = $("#datatables tbody tr:eq("+index+") td input[class*=checkbox]").attr('category_name');

    var category_id = $("#datatables tbody tr:eq("+index+") td input[class*=checkbox]").attr('category_id');

    //var product_name = $("#datatables tbody tr:eq("+index+") td input[class*=checkbox]").attr('product_name');

    var checkbox = $("#datatables tbody tr:eq("+index+") td input[class*=checkbox]").is(':checked');
    //alert(checkbox);

    var g_area = [];
    var main_aisle = [];
    var g_area = [];
    var pois = [];
    
    $("#datatables tbody tr:eq("+index+") td input[class*=g_area]").each(function(loop) {

        //var g_area = $("#datatables tbody tr:eq("+loop+") td input[class*=g_area]").val();

       // alert(index);

        g_area.push($(this).val());

        //alert($(this).val());

    });

    $("#datatables tbody tr:eq("+index+") td input[class*=main_aisle]").each(function(loop) {

       
        main_aisle.push($(this).val());

        //alert($(this).val());

    });

    $("#datatables tbody tr:eq("+index+") td input[class*=pois]").each(function(loop) {

       
        pois.push($(this).val());

        //alert($(this).val());

    });

    //alert(pois);

    if(checkbox ==true)
        check_value = 1;
    if(checkbox ==false)
        check_value = 0;
 
    //alert(index);
     if( check_value == 0)
     {
       var count = index + 1;
       var id = "#select" + (count);
      //var reason = $(id).val(); //select[class*=text]").val();
      var reason = $("#datatables tbody tr:eq("+index+") td select[class*=text]").val();
      //alert(reason);
     }
      if( check_value == 1)
      {
        var reason = $("#datatables tbody tr:eq("+index+") td input[type=file]").val();
        var text = reason;
        reason = text.substring(text.lastIndexOf("\\") + 1, text.length);
    
      }
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

    var key = '{"timesheet_id": "'+timesheet_id+'",  "outlet_products_mapping_id" : "'+outlet_products_mapping_id+'","outlet_id": "'+outlet_id+'", "check_value" : "'+check_value+'",  "journy_date" : "'+journy_date+'", "category_name" : "'+category_name+'","category_id" : "'+category_id+'", "reason" : "'+reason+'", "g_area" : "'+g_area+'", "main_aisle" : "'+main_aisle+'", "pois" : "'+pois+'"}';
  
    array.push(key)

});

//alert(array);

var value = "["+array.toString()+"]";

//alert(value);

//alert(value);

$('#uploadvisibilityfile').val(value);
//alert($('#uploadvisibilityfile').val());

// var csrf = $('meta[name="csrf-token"]').attr('content');

//     var formData = new FormData($(this)[0]);
//     $.ajax({
//         url: '{{ url('/update_product_availability') }}',
//         type: 'POST',              
//         data: formData,
//         success: function(result)
//         {
//             alert(result);
//               // alert(JSON.stringify(data[0]['id']));
//         },
//         error: function(data)
//         {
//             console.log(data);
//         }
//     });


   



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


$('.bleu').click(function(e) {
   var $id = ($(this).attr('id'));
    view_products($id);
    return false;
})


  

    

  </script>
@endpush
