@extends('layouts.app', ['activePage' => 'product_details', 'menuParent' => 'Products', 'titlePage' => __('Product Details')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
         
             <form method="post"  action="{{ route('product_details.update',$product[0]->id) }}"  autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
          
            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">product_details</i>
                </div>
                <h4 class="card-title">{{ __('Edit Product_details') }}</h4>
              </div>
              
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                    @canany(['isClient','isTopManagement','isAdmin'],App\User::class)
                      <a href="{{ route('product_details.index') }}" class="btn btn-sm btn-rose">{{ __('Back to Product') }}</a>
                    @endcan
                  </div>
                </div>
                
                  <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('SKU') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('sku') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('sku') ? ' is-invalid' : '' }}" name="sku" id="input-sku" type="number" placeholder="{{ __('Sku') }}" value="{{ old('sku',$product[0]->sku) }}"  aria-required="true"/>
                      @include('alerts.feedback', ['field' => 'sku'])
                    </div>
                  </div>
                </div>
                
                <div class="row">
                 
                   <label class="col-sm-2 col-form-label">{{ __('Zrep code ') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('zrep_code') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('zrep_code') ? ' is-invalid' : '' }}" name="zrep_code" id="" type="text"
                       placeholder="{{ __('Zrep code') }}" value="{{ old('zrep_code',$product[0]->zrep_code) }}"  aria-required="true"/>
                      @include('alerts.feedback', ['field' => 'zrep_code'])
                    </div>
                  </div>

                </div>

                  <div class="row">
                 
                   <label class="col-sm-2 col-form-label">{{ __('Product Name ') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('product_name') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('product_name') ? ' is-invalid' : '' }}" name="product_name" id="" type="text"
                       placeholder="{{ __('Zrep code') }}" value="{{ old('product_name',$product[0]->product_name) }}"  aria-required="true"/>
                      @include('alerts.feedback', ['field' => 'product_name'])
                    </div>
                  </div>

                </div>

                <div class="row">
                 <label class="col-sm-2 col-form-label">{{ __('Type ') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('type') ? ' has-danger' : '' }}">

                    
                         <select class="form-control selectpicker" data-style="select-with-transition"  title="Select Type" data-size="7" name="type" id="input-type" 
                     value="{{ old('type') }}" aria-required="true" >
                     
                            <option selected="" value="">Select Type</option>
                            <option value="Regular" @if ( $product[0]->type == "Regular") {{ 'selected' }} @endif >Regular</option>
                            <option value="Promo" @if ( $product[0]->type == "Promo") {{ 'selected' }} @endif >Promo</option>
                            <option value="NPI" @if ( $product[0]->type == "NPI") {{ 'selected' }} @endif >NPI</option>
                            <option value="LE-SLCI" @if ( $product[0]->type == "LE-SLCI") {{ 'selected' }} @endif >LE-SLCI</option>

                        </select>

                      @include('alerts.feedback', ['field' => 'type'])
                    </div>
                  </div>
              </div>

              <div class="row">
              <label class="col-sm-2 col-form-label">{{ __('Range ') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('range') ? ' has-danger' : '' }}">

                    
                         <select class="form-control selectpicker" data-style="select-with-transition"  title="Select Type" data-size="7" name="range" id="input-range" 
                     value="{{ old('range') }}" aria-required="true" >
                     
                            <option selected="" value="">Select Range</option>
                            <option value="minis" @if ( $product[0]->range == "minis") {{ 'selected' }} @endif >Minis</option>
                            <option value="multipacks"  @if ( $product[0]->range == "multipacks") {{ 'selected' }} @endif >Multipacks</option>
                            <option value="one_plus_one"  @if ( $product[0]->range == "one_plus_one") {{ 'selected' }} @endif  >1+1</option>
                            <option value="ten_twinty"  @if ( $product[0]->range == "ten_twinty") {{ 'selected' }} @endif >10.20</option>
                            <option value="other"  @if ( $product[0]->range == "other") {{ 'selected' }} @endif >Other</option>

                        </select>


                      @include('alerts.feedback', ['field' => 'range'])
                    </div>
                  </div>
              </div>
              
              <div class="row">
 
                <label class="col-sm-2 col-form-label">{{ __('Bar code :') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('barcode') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('barcode') ? ' is-invalid' : '' }}" name="barcode" id="" type="text"
                       placeholder="{{ __('Bar Code') }}" value="{{ old('barcode',$product[0]->barcode) }}"  aria-required="true"/>
                      @include('alerts.feedback', ['field' => 'barcode'])
                    </div>
                  </div>
                </div>
                   
                  

                 <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Brand_Name') }}</label>
                 <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('brand_id') ? ' has-danger' : '' }}">
                 
                       <select class="form-control{{ $errors->has('brand_id') ? ' is-invalid' : '' }}" name="brand_id" id="input-brand_id" 
                        value="{{ old('brand_id') }}" >
              
                       @foreach ($brands as $bran)
                   
                    <option value="{{$bran->id}}" @if ( $bran->id == $product[0]->brand_id) {{ 'selected' }} @endif >
                      
                        {{   $bran->brand_name }} </option> 
     
                @endforeach
                
            </select>
            @include('alerts.feedback', ['field' => 'brand_id'])
         
                    </div>
                   </div>
                  </div>
            
                   <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Product_Categories') }}</label>
                 <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('product_categories') ? ' has-danger' : '' }}">
                 
                       <select class="form-control{{ $errors->has('product_categories') ? ' is-invalid' : '' }}" name="product_categories" 
                       id="input-product_categories"  value="{{ old('product_categories') }}" >
                     
                        @foreach ($category as $categ)
                    
                       <option value="{{$categ->id }}" @if ($categ->id == $product[0]->product_categories) {{ 'selected' }} @endif>
                      
                        {{  $categ->category_name  }} </option> 
     
                 @endforeach
                
              </select>
               @include('alerts.feedback', ['field' => 'product_categories'])
                    </div>
                   </div>
                  </div>


               <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Piece_per_carton') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('piece_per_carton') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('piece_per_carton') ? ' is-invalid' : '' }}" name="piece_per_carton" id="" type="text" placeholder="{{ __('Piece_per_carton') }}" value="{{ old('piece_per_carton',$product[0]->piece_per_carton) }}"  aria-required="true"/>
                      @include('alerts.feedback', ['field' => 'piece_per_carton'])
                    </div>
                  </div>
                </div>
                
                 <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Price_per_piece') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('price_per_piece') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('price_per_piece') ? ' is-invalid' : '' }}" name="price_per_piece" id="" type="text"
                       placeholder="{{ __('Price_per_piece') }}" value="{{ old('price_per_piece',$product[0]->price_per_piece) }}"  aria-required="true"/>
                      @include('alerts.feedback', ['field' => 'price_per_piece'])
                    </div>
                  </div>
                </div>
          
             
                  
              
             <!--       <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Client_id') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('client_id') ? ' has-danger' : '' }}">
                     
                          <select class="form-control selectpicker" data-style="select-with-transition"  title="Select Client" data-size="7" name="client_id" id="input-client_id" 
                     value="{{ old('client_id') }}" aria-required="true" >
                     
                           <option value="" selected="">Select</option>
                            @foreach ($client as $cli)
                               <option value="{{ $cli->employee_id }}"  @if ( $cli->employee_id == $product[0]->client_id) {{ 'selected' }} @endif > {{  $cli->first_name  }} {{  $cli->middle_name  }} {{  $cli->surname  }}</option>
                            @endforeach
                        </select>

                      @include('alerts.feedback', ['field' => 'client_id'])

                    </div>
                  </div>
                </div>-->
                
                 <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Remarks') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('remarks') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('remarks') ? ' is-invalid' : '' }}" name="remarks" id="" type="text" placeholder="{{ __('Remarks') }}" value="{{ old('remarks',$product[0]->remarks) }}"  aria-required="true"/>
                      @include('alerts.feedback', ['field' => 'remarks'])
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Product Image') }}</label>
                  <div class="col-sm-7">
                   <input type="file" class="form-control" name="ProductImageFile[]"  />
                    <!--  <input class="form-control{{ $errors->has('supportingdocument') ? ' is-invalid' : '' }}" name="supportingdocument" id="input-supportingdocument" type="text" placeholder="{{ __('supportingdocument') }}" value="{{ old('supportingdocument') }}"  aria-required="true"/>-->
                      @include('alerts.feedback', ['field' => 'ProductImageFile'])
                    </div>
                  </div>
            
               <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-rose mx-auto">{{ __('update') }}</button>
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
  </script>
  
 
@endpush
