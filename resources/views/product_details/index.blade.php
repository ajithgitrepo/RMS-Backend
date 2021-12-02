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

@extends('layouts.app', ['activePage' => 'product_details', 'menuParent' => 'Products', 'titlePage' => __('Product Details')])


@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">group</i>
                 </div>
                <h4 class="card-title">{{ __('Product Details') }}</h4>
               </div>
              <div class="card-body">
              
               <div class="row">
                    <div class="col-12 text-right">
                      <a class="btn btn-sm btn-warning" style="color: #fff;" data-toggle="modal" data-target="#modelWindow" >{{ __('Filter') }}</a>
                    </div>
                  </div>
                  
                @canany(['isClient','isTopManagement','isAdmin'],App\User::class)
                  <div class="row">
                    <div class="col-12 text-right">
                      <a href="{{ route('product_details.create') }}" class="btn btn-sm btn-rose">{{ __('Add Product') }}</a>
                    </div>
                  </div>
                @endcan
                <div class="table-responsive">
                  <table id="datatables" class="table table-striped table-no-bordered table-hover" style="display:none">
                    <thead class="text-primary">
                      <th>
                          {{ __('#') }}
                      </th>
                      <th>
                          {{ __('Image') }}
                      </th>
                      <th>
                          {{ __('SKU') }}
                      </th>
                      <th>
                          {{ __('Product Name') }}
                      </th>
                      <th>
                          {{ __('Bar Code') }}
                      </th> 
                    <!--   <th>
                          {{ __('UOM') }}
                      </th>-->
                       <th>
                          {{ __('Zrep Code') }}
                      </th>
                     <th>
                          {{ __('Piece per carton') }}
                      </th>
                       <th>
                          {{ __('Price per piece') }}
                      </th>
                       <th>
                           {{__('Status')}}
                      </th>
                      @canany(['isClient','isTopManagement','isAdmin'],App\User::class)
                      <th >
                          {{ __('Action') }}
                     </th>
                     @endcan
                    </thead>
                    <tbody>
                      @php
                        $i=1
                      @endphp
                     @foreach($product as $prod)
                        <tr>
                        <td>
                             {{$i++}}
                        </td>
                        <td class="sorting_1">

                            <div class="avatar avatar-sm rounded-circle img-circle" style="width:100px; height:100px;overflow: hidden;">

                                @if($prod->Image_url !==null || $prod->Image_url !=="")
                                <img src="/product_image/{{ $prod->Image_url }}" onclick="DoSomething(this.src);" alt="" style="max-width: 100px;">
                                @endif

                                 @if($prod->Image_url ==null || $prod->Image_url =="")
                                <img src="/product_image/no_image.jpg" onclick="DoSomething(this.src);" alt="" style="max-width: 100px;">
                                @endif

                            </div>

                          </td>
                           <td>
                            {{ $prod->sku }}
                          </td>
                           <td>
                            {{ $prod->product_name }}
                          </td>
                           <td> 
                            {{ $prod->barcode }}
                          </td> 
                         <!--  <td>
                            {{ $prod->uom }}
                          </td>-->
                          <td>
                            {{ $prod->zrep_code }}
                          </td>
                          <td>
                            {{ $prod->piece_per_carton }}
                          </td>
                           <td>
                            {{ $prod->price_per_piece }}
                          </td>

                          <td>

                           <select name="status-{{$prod->id}}" class="form-control" id="status-{{$prod->id}}" onchange="update({{$prod->id}})">
                           <option value="" selected disabled>Select Status</option>
                           <option value="1" @if ( $prod->status=="1") {{'selected'}} @endif>Active</option>
                           <option value="0" @if ( $prod->status=="0") {{'selected'}} @endif>Deactivate</option>
                           </select>

                          </td>
                             
                            @canany(['isClient','isTopManagement','isAdmin'],App\User::class)
                            
                            
                            <td class=" td-actions display-block">
                              <form action="{{ route('product_details.destroy', $prod->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                  
                                       <a  rel="tooltip" data-toggle="modal" data-target="#exampleModal"   class="btn btn-info" onclick="view_products('{{$prod->id}}')" title="View">
                                          <i class="material-icons">visibility</i>
                                        </a>

                                     
                                       <a  rel="tooltip" href="{{ route('product_details.edit', $prod->id) }}" class="btn btn-warning" title="Edit">
                                          <i class="material-icons">edit</i>
                                        </a>
                                  

                                       <a onclick="confirm('{{ __("Are you sure you want to delete this employee?") }}') ? this.parentElement.submit() : ''" rel="tooltip" class="btn btn-danger" title="Delete">
                                          <i class="material-icons">close</i>
                                        </a>

                                </form>
                            </td>  


                             @endcan
                        </tr>
                      @endforeach 
                    </tbody>
                  </table>
                   {{-- Pagination --}}
                    <div class="d-flex justify-content-center">
                        {!! $product->links() !!}
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
                <form method="get" action="{{ url('filter_product') }}" class="form-inline" enctype="multipart/form-data" action="" autocomplete="off" style="text-align: right;">
                
                    @csrf
                    @method('get')
                
                
                <div class="row" style="width: 100%;">
                 
                   
                   <div class="col-sm-4">
                     <div class="form-group">

                      <select class="form-control selectpicker" data-style="select-with-transition" title="Select Product" data-size="7" name="product" 
                       id="input-product"  value="{{ old('product') }}" aria-required="true" >
                          <option value="">--All Products--</option>
                         
                            @foreach ($product as $prod)
                       
                           <option value="{{$prod->id}}" > {{  $prod->product_name }} </option> 
         
                           @endforeach
                    
                          </select>
                         
                    </div>
                  </div>

                   <div class="col-sm-4">
                    <div class="form-group">
                   <select class="form-control selectpicker" data-style="select-with-transition" title="Select Brand" data-size="7" name="brand_id" 
                   id="input-brand_id"  value="{{ old('brand_id') }}" aria-required="true" >
                      <option value="">--Select--</option>
                     
                        @foreach ($brands as $bran)
                   
                       <option value="{{$bran->id}}" > {{  $bran->brand_name }} </option> 
     
                       @endforeach
                
                      </select>
                    </div>
                  </div>

                  <div class="col-sm-4">
                     <div class="form-group{{ $errors->has('zrep_code') ? ' has-danger' : '' }}">
                     <input class="form-control {{ $errors->has('zrep_code') ? ' is-invalid' : '' }}" name="zrep_code" id="input-zrep_code" type="text" placeholder="{{ __('zrep code') }}" value="{{ old('zrep_code') }}" >
                     
                    </div>
                  </div>

                  <div class="col-sm-4">
                     <div class="form-group{{ $errors->has('barcode') ? ' has-danger' : '' }}">
                     <input class="form-control {{ $errors->has('barcode') ? ' is-invalid' : '' }}" name="barcode" id="input-barcode" type="text" placeholder="{{ __('Barcode') }}" value="{{ old('barcode') }}" >
                     
                    </div>
                  </div>

                   <div class="col-sm-4">
                     <div class="form-group">
                     <input class="form-control {{ $errors->has('sku') ? ' is-invalid' : '' }}" name="sku" id="input-sku" type="text" placeholder="{{ __('SKU') }}" value="{{ old('sku') }}" >
                      
                     </div>
                   </div>
                  
                   <div class="col-sm-4">
                     <div class="form-group">
                     <!--  <select class="form-control selectpicker" data-style="select-with-transition" title="Select Category" data-size="7" name="product_categories" 
                  id="input-product_categories"  value="{{ old('product_categories') }}" aria-required="true">
                     <option value="">--Select--</option>
                     
                        @foreach ($category as $categ)
                    
                       <option value="{{$categ->id }}"> {{  $categ->category_name  }} </option> 
     
                       @endforeach
                
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
                
@endsection

@push('js')
    
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
                  data: {'id':id,'status':stsvalue, _token:'{{csrf_token()}}'},
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
@endpush
