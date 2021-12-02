
@extends('layouts.app', ['activePage' => 'product_details', 'menuParent' => 'Products', 'titlePage' => __('Product Details')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
         
        <form method="post" action="{{ route('product_details.store') }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">Product Details</i>
                </div>
                <h4 class="card-title">{{ __('Add Product') }}</h4>
              </div>
              
              <div class="card-body ">
             <div class="row">
                  <div class="col-md-12 text-right">
                    <a href="/import_product_csv" class="btn btn-sm btn-info">{{ __('Import CSV / EXCEL') }}</a>
                    
                  </div>
                </div>
                
		

                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('product_details.index') }}" class="btn btn-sm btn-rose">{{ __('Back to Product') }}</a>
                  </div>
                </div>
   
           <!--  <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Brand_Id') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('brand_id') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('brand_id') ? ' is-invalid' : '' }}" name="brand_id" id="input-brand_id" type="text" placeholder="{{ __('Brand_Id') }}" value="{{ old('brand_id') }}"  aria-required="true"/>
                      @include('alerts.feedback', ['field' => 'brand_id'])
                    </div>
                  </div>
                </div>-->
                
             
              
               
                <div class="row">

                 <label class="col-sm-2 col-form-label">{{ __('SKU :') }}</label>
                  <div class="col-sm-4">
                    <div class="form-group{{ $errors->has('sku') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('sku') ? ' is-invalid' : '' }}" name="sku" id="input-sku" type="text" placeholder="{{ __('Sku') }}"
                       value="{{ old('sku') }}"  aria-required="true"/>
                      @include('alerts.feedback', ['field' => 'sku'])
                    </div>
                  </div>
               

                  <label class="col-sm-2 col-form-label">{{ __('Zrep code :') }}</label>
                  <div class="col-sm-4">
                    <div class="form-group{{ $errors->has('zrep_code') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('zrep_code') ? ' is-invalid' : '' }}" name="zrep_code" id="" type="text"
                       placeholder="{{ __('Zrep code') }}" value="{{ old('zrep_code') }}"  aria-required="true"/>
                      @include('alerts.feedback', ['field' => 'zrep_code'])
                    </div>
                  </div>

                  

                 </div> 
                
                
                <div class="row">
                
                   <label class="col-sm-2 col-form-label">{{ __('Product Name :') }}</label>
                  <div class="col-sm-4">
                    <div class="form-group{{ $errors->has('product_name') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('product_name') ? ' is-invalid' : '' }}" name="product_name" id="input-product_name" type="text"
                       placeholder="{{ __('Product Name / Zrep Description') }}" value="{{ old('product_name') }}"  aria-required="true"/>
                      @include('alerts.feedback', ['field' => 'product_name'])
                    </div>
                  </div>
                  
               
            
                 <label class="col-sm-2 col-form-label">{{ __('Type :') }}</label>
                  <div class="col-sm-4">
                    <div class="form-group{{ $errors->has('type') ? ' has-danger' : '' }}">

                    
                         <select class="form-control selectpicker" data-style="select-with-transition"  title="Select Type" data-size="7" name="type" id="input-type" 
                     value="{{ old('type') }}" aria-required="true" >
                     
                            <option selected="" value="">Select Type</option>
                            <option value="Regular">Regular</option>
                            <option value="Promo">Promo</option>
                            <option value="NPI">NPI</option>
                            <option value="LE-SLCI">LE-SLCI</option>

                        </select>


                      @include('alerts.feedback', ['field' => 'type'])
                    </div>
                  </div>

                   

                </div>

               
              
            
             
                <div class="row">
               
               
                 <label class="col-sm-2 col-form-label">{{ __('Brand Name :') }}</label>
                  <div class="col-sm-4">
                    <div class="form-group{{ $errors->has('brand_id') ? ' has-danger' : '' }}">
                 
                      
                        <select class="form-control selectpicker" data-style="select-with-transition"  title="Select Brand" data-size="7" name="brand_id" id="input-brand_id" 
                     value="{{ old('brand_id') }}" aria-required="true" >
                     
                           <option value="" selected="" disabled="">Select Brand</option>
                           @foreach ($brands as $bran)
                           	<option value="{{ $bran->id }}"> {{  $bran->brand_name  }}</option>
            			@endforeach
			         </select>
			          @include('alerts.feedback', ['field' => 'brand_id'])
                     </div>
                   </div>

                    <label class="col-sm-2 col-form-label">{{ __('Product Category :') }}</label>
                   <div class="col-sm-4">
                    <div class="form-group{{ $errors->has('product_categories') ? ' has-danger' : '' }}">
                 

                         <select class="form-control selectpicker" data-style="select-with-transition"  title="Select Category" data-size="7" name="product_categories" id="input-product_categories" 
                     value="{{ old('product_categories') }}" aria-required="true" >
                     
                       <option value="" selected="" disabled="">Select Category</option>
                       @foreach ($category as $categ)
                    <option value="{{ $categ->id }}"> {{  $categ->category_name  }}</option>
                @endforeach
            </select>
                    @include('alerts.feedback', ['field' => 'product_categories'])
                    </div>
                   </div>

                  </div>
                 

                    <div class="row">
                
                 <label class="col-sm-2 col-form-label">{{ __('Piece per carton :') }}</label>
                  <div class="col-sm-4">
                    <div class="form-group{{ $errors->has('piece_per_carton') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('piece_per_carton') ? ' is-invalid' : '' }}" name="piece_per_carton" id="" type="text"
                       placeholder="{{ __('Piece per carton') }}" value="{{ old('piece_per_carton') }}"  aria-required="true"/>
                      @include('alerts.feedback', ['field' => 'piece_per_carton'])
                    </div>
                  </div>

                    <label class="col-sm-2 col-form-label">{{ __('Price per piece :') }}</label>
                  <div class="col-sm-4">
                    <div class="form-group{{ $errors->has('price_per_piece') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('price_per_piece') ? ' is-invalid' : '' }}" name="price_per_piece" id="" type="text"
                       placeholder="{{ __('Price per piece') }}" value="{{ old('price_per_piece') }}"  aria-required="true"/>
                      @include('alerts.feedback', ['field' => 'price_per_piece'])
                    </div>
                  </div>

                </div>
             
            

                 <div class="row">
                  

            <!--        <label class="col-sm-2 col-form-label">{{ __('Client id :') }}</label>
                   <div class="col-sm-4">
                    <div class="form-group{{ $errors->has('client_id') ? ' has-danger' : '' }}">
                    

                         <select class="form-control selectpicker" data-style="select-with-transition"  title="Select Client" data-size="7" name="client_id" id="input-client_id" 
                     value="{{ old('client_id') }}" aria-required="true" >
                     
                           <option value="" selected="">Select Client</option>
                           @foreach ($client as $cli)
                            <option value="{{ $cli->employee_id }}"> {{  $cli->first_name  }} {{  $cli->middle_name  }} {{  $cli->surname  }}</option>
                        @endforeach
                     </select>
                      @include('alerts.feedback', ['field' => 'client_id'])
            
                    </div>
                  </div>-->
                 
                  <label class="col-sm-2 col-form-label">{{ __('Range :') }}</label>
                  <div class="col-sm-4">
                    <div class="form-group{{ $errors->has('range') ? ' has-danger' : '' }}">

                    
                         <select class="form-control selectpicker" data-style="select-with-transition"  title="Select Type" data-size="7" name="range" id="input-range" 
                     value="{{ old('range') }}" aria-required="true" >
                     
                            <option selected="" value="">Select Range</option>
                            <option value="minis">Minis</option>
                            <option value="multipacks">Multipacks</option>
                            <option value="one_plus_one">1+1</option>
                            <option value="ten_twinty">10.20</option>
                            <option value="other">Other</option>

                        </select>


                      @include('alerts.feedback', ['field' => 'range'])
                    </div>
                  </div>
                  
                  <label class="col-sm-2 col-form-label">{{ __('Bar code :') }}</label>
                  <div class="col-sm-4">
                    <div class="form-group{{ $errors->has('barcode') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('barcode') ? ' is-invalid' : '' }}" name="barcode" id="" type="number"
                       placeholder="{{ __('Bar Code') }}" value="{{ old('barcode') }}"  aria-required="true"/>
                      @include('alerts.feedback', ['field' => 'barcode'])
                    </div>
                  </div>

                   
                  </div>


                  <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Product Image') }}</label>
                  <div class="col-sm-4">
                   <input type="file" class="form-control" name="ProductImageFile[]"  />
                    <!--  <input class="form-control{{ $errors->has('supportingdocument') ? ' is-invalid' : '' }}" name="supportingdocument" id="input-supportingdocument" type="text" placeholder="{{ __('supportingdocument') }}" value="{{ old('supportingdocument') }}"  aria-required="true"/>-->
                      @include('alerts.feedback', ['field' => 'ProductImageFile'])
                    </div>

                     <label class="col-sm-2 col-form-label">{{ __('Remarks :') }}</label>
                   <div class="col-sm-4">
                    <div class="form-group{{ $errors->has('remarks') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('remarks') ? ' is-invalid' : '' }}" name="remarks" id="" type="text"
                       placeholder="{{ __('Remarks') }}" value="{{ old('remarks') }}"  aria-required="true"/>
                      @include('alerts.feedback', ['field' => 'remarks'])
                    </div>
                  </div>


                  </div>

                  

                </div>


                
               
                <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-rose mx-auto">{{ __('Save') }}</button>
                </div>
              
               </div>
               
            </div>
          </form>
          
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js')
 <script>
 $(function () {
                  
        $('.datepicker').datetimepicker({
            format: 'DD-MM-YYYY',
            
        });
  });
  
 
    $(document).ready(function() {
  
    // initialise Datetimepicker and Sliders
  
      md.initFormExtendedDatetimepickers();
         
      if ($('.slider').length != 0) {
      
        md.initSliders();
      } 
      
    }); 


// $("#input-brand_id").change(function() {
//    var brand_id = $(this).val();
//   //alert(id);
//   var csrf = $('meta[name="csrf-token"]').attr('content');
//   $.ajax({
//            url: '/get_category_details',
//           type: 'GET',
//           data: {brand_id : brand_id, '_token': csrf},
//           dataType: 'json',
//         success: function( data ) {
//        var myJSON = JSON.stringify(data);
// $('#input-product_categories').find('option').remove().end().append('<option selected="selected" value="">Select</option>');
//           $.each($.parseJSON(myJSON), function(key,value){
//             var $bar = $('#input-product_categories'); 
//             $bar.append($("<option></option>")
//                     .attr("value", value.id)
//                     .text(value.category_name));
//             });

//         }         
//     })
// });



  </script>
  
 
@endpush
