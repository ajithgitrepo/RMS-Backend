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
                <h4 class="card-title">{{ __('Promotion Check') }}</h4>
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

    
         
               <div class="table-responsive">
               <form method="post" action="{{ route('update_promotion') }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
                  <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />   
               
                  <table id="datatables" class="table table-striped table-no-bordered table-hover" style="display:none">
                 
                    <thead class="text-primary">
                   
                     <!--  <th>
                      {{ __('Image') }}
                      </th> -->
                      <th>
                          {{ __('Product/Description') }}
                      </th>
                      <th>
                      {{ __('Brand') }}
                      </th>
                     <th>
                      {{ __('Category') }}
                      </th>
                      <th>
                          {{ __('Available?') }}
                      </th>
                      <th>
                          {{ __('Image / Reason') }}
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

                            $check = isset($product->is_available);

                        @endphp 
                              
                     <tr> 
                          <!-- <td>
                            {{ ++$i }}  
                          </td> -->
                         
                          
                          <td>
                        
                           
                             {{$product->p_name }} 
            
                          </td>
                          <td>
                        
                            {{ $product->b_name }}
                          </td>

                          <td>
                        
                            {{ $product->category_name }}
                          </td>
                         
                           <td> 
                           <div class="togglebutton">
                              <label>
                          
                             @if($check)
                                 @if($product->is_available ==1)
                                    <input type="checkbox"
                                   
                                     id="{{ $i }}"  
                                   
                                    timesheet_id="{{$product->id}}" product_id="{{$product->product_id}}" 
                                    product_id="{{$product->product_id}}"
                                    brand_name="{{$product->b_name}}"
                                    product_name="{{$product->p_name}}"
                                    outlet_id="{{$product->outlet_id}}" class="checkbox" checked="" >
                                 @endif

                                 @if($product->is_available ==0)
                                    <input type="checkbox"
                                   
                                     id="{{ $i }}"  
                                   
                                    timesheet_id="{{$product->id}}" product_id="{{$product->product_id}}" 
                                    product_id="{{$product->product_id}}"
                                    brand_name="{{$product->b_name}}"
                                    product_name="{{$product->p_name}}"
                                    outlet_id="{{$product->outlet_id}}" class="checkbox" >
                                 @endif
                                @endif

                                 @if(!$check)
                                     <input type="checkbox"
                                   
                                     id="{{ $i }}"  
                                   
                                    timesheet_id="{{$product->id}}" product_id="{{$product->product_id}}" 
                                    product_id="{{$product->product_id}}"
                                    brand_name="{{$product->b_name}}"
                                    product_name="{{$product->p_name}}"
                                    outlet_id="{{$product->outlet_id}}" class="checkbox" checked="" >
                                @endif



                                <span class="toggle" ></span>
                               
                              
                              
                              </label>
                            </div>
                          </td>
                                
                          <td> 
                           <!-- <textarea style="width: 350px;" cols="3" rows="3" name="reason" id="{{ $i }}" class="reason text"></textarea> -->
                         
                          
                        @if($check)
                            @if($product->is_available ==0)
                               <select name="reason"  value="{{ old('reason') }}" style="width:200px;"  id="select{{ $i }}" class="form-control text">
                                   <option value="" selected="">Reason</option>
                                   <option value="Out Of Stock" @if($product->reason == "Out Of Stock") {{'selected'}}  @endif >Out Of Stock</option>
                                   <option value="Expired" @if($product->reason == "Expired") {{'selected'}}  @endif  >Expired</option>
                               </select>
                               <input type="file" name="uploadfile[]" style="display:none;" accept="image/*" id="file{{ $k }}" ></input>
                       
                            @endif
                             @if($product->is_available ==1)
                               <select name="reason"  value="{{ old('reason') }}"  style="width:200px;display:none;" id="select{{ $i }}" class="form-control  text ">
                                   <option value="" selected="">Reason</option>
                                   <option value="Out Of Stock" >Out Of Stock</option>
                                   <option value="Expired">Expired</option>
                               </select>
                                <input type="file" name="uploadfile[]" accept="image/*" id="file{{ $k }}" ></input>
                       
                            @endif
                        @endif

                         @if(!$check)
                                
                             <select name="reason"  value="{{ old('reason') }}"  id="select{{ $i }}" class="form-control text reason" style="width:200px;">
                                   <option value="" selected="">Reason</option>
                                   <option value="Out Of Stock" >Out Of Stock</option>
                                   <option value="Expired">Expired</option>
                               </select>

                               <input type="file"   name="uploadfile[]" accept="image/*" id="file{{ $k }}" ></input>
                               
                            @endif

                          
                         

                          </td>
                          
                          <td class="sorting_1">
                            <div class="avatar avatar-sm rounded-circle img-circle" style="width:100px; height:100px;overflow: hidden;">
                            @if($check)
                               @if($product->is_available ==1)
                                <img class="image_chk" id="img{{ $k }}" src="/promotion_image/{{ $product->image_url }}" onclick="DoSomething(this.src);" alt="" style="max-width: 100px;">
                               @endif
                             @endif
                                <img id="img{{ $k }}" onclick="DoSomething(this.src);" alt="" style="max-width: 100px;">
                            </div>
                           
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

        }

      });


$("#submit").click(function(event){
     
//alert("clicked.");
var rowCount = $('#datatables >tbody >tr').length;

//alert(rowCount);

// var array = $('#datatables tbody tr:eq(0) td').toArray();

var attr = $("#datatables tbody tr:eq(1) td input[class*=checkbox]").attr('product_id');

//alert(attr);
var array = [];

$('#datatables >tbody >tr').each(function(index) {
    //alert(index); 
    var timesheet_id = $("#datatables tbody tr:eq("+index+") td input[class*=checkbox]").attr('timesheet_id');
    //alert(timesheet_id);  

    //var outlet_products_mapping_id = $("#datatables tbody tr:eq("+index+") td input[class*=checkbox]").attr('outlet_products_mapping_id');

    //var brand_id = $("#datatables tbody tr:eq("+index+") td input[class*=checkbox]").attr('brand_id');
   
    var product_id = $("#datatables tbody tr:eq("+index+") td input[class*=checkbox]").attr('product_id');
    //alert(product_id);  

    var outlet_id = $("#datatables tbody tr:eq("+index+") td input[class*=checkbox]").attr('outlet_id');
    //alert(outlet_id); 

    //var jou rny_date = $("#datatables tbody tr:eq("+index+") td input[class*=checkbox]").attr('journy_date');

    var brand_name = $("#datatables tbody tr:eq("+index+") td input[class*=checkbox]").attr('brand_name');

    //var category_name = $("#datatables tbody tr:eq("+index+") td input[class*=checkbox]").attr('category_name');

    var product_name = $("#datatables tbody tr:eq("+index+") td input[class*=checkbox]").attr('product_name');

    var checkbox = $("#datatables tbody tr:eq("+index+") td input[class*=checkbox]").is(':checked');
    //alert(checkbox);

    var image_chk = $("#datatables tbody tr:eq("+index+") td img[class*=image_chk]").attr('src');
   /// alert(image_chk);

    if(checkbox ==true)
        check_value = 1;
    if(checkbox ==false)
        check_value = 0;
 
    //alert(index);
     if( check_value == 0)
     {
       var count = index + 1;
      // alert(count);
       var id = "#select" + (count);
       var reason = $("#datatables tbody tr:eq("+index+") td select[class*=text]").val();
        // (reason);
     // var reason = $(id).val(); //select[class*=text]").val();
      //$("#datatables tbody tr:eq("+index+") td select[class*=text]").val();
     // alert(reason);
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

    var key = '{"timesheet_id": "'+timesheet_id+'","outlet_id": "'+outlet_id+'", "check_value" : "'+check_value+'",  "brand_name" : "'+brand_name+'", "product_name" : "'+product_name+'", "product_id" : "'+product_id+'", "reason" : "'+reason+'", "image_src" : "'+image_chk+'"}';
  
    array.push(key)

    //alert(array);

});

//alert(array);

var value = "["+array.toString()+"]";

//console.log(value);


$('#uploadvisibilityfile').val(value);
//alert($('#uploadvisibilityfile').val());

var csrf = $('meta[name="csrf-token"]').attr('content');

    var formData = new FormData($(this)[0]);
    $.ajax({
        url: '{{ url('/update_product_availability') }}',
        type: 'POST',              
        data: formData,
        success: function(result)
        {
            alert(result);
              // alert(JSON.stringify(data[0]['id']));
        },
        error: function(data)
        {
            console.log(data);
        }
    });


   



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
