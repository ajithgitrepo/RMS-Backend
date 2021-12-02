@extends('layouts.app', ['activePage' => 'outlet_stockexpiry', 'menuParent' => 'laravel', 'titlePage' => __('Outlet_stockexpiry')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
      
          <form method="post" action="{{ route('outlet_stockexpiry.update', $outlet_stock[0]->id ) }}" autocomplete="off" class="form-horizontal"
           enctype="multipart/form-data" files="true">
            @csrf
            @method('put')

          <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">Outlet_stockexpiry</i>
                </div>
                <h4 class="card-title">{{ __('Edit Outlet_stockexpiry') }}</h4>
              </div>
              
             <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('outlet_stockexpiry.index') }}" class="btn btn-sm btn-rose">{{ __('Back to Outlet_stockexpiry') }}</a>
                   </div>
                 </div>
                
           
                <div class="row">
                   <label class="col-sm-2 col-form-label">{{ __('Outlet_id') }}</label>
                  <div class="col-sm-4">
                    <div class="form-group{{ $errors->has('outlet_id') ? ' has-danger' : '' }}">
                     
                    <input class="form-control{{ $errors->has('outlet_id') ? ' is-invalid' : '' }}" name="outlet_id" id="input-outlet_id" type="text" placeholder="{{ __('Outlet_id') }}" value="{{ old('outlet_id', $outlet_stock[0]->outlet_id) }}"  aria-required="true"/>
                    
                      @include('alerts.feedback', ['field' => 'outlet_id'])
                    </div>
                   </div>
                  
                  <label class="col-sm-2 col-form-label">{{ __('Product_id') }}</label>
                  <div class="col-sm-4">
                    <div class="form-group{{ $errors->has('product_id') ? ' has-danger' : '' }}">
                    
                      <select class="form-control{{ $errors->has('product_id') ? ' is-invalid' : '' }}" name="product_id" id="input-product_id" 
                        value="{{ old('product_id') }}">
                    			
			 @foreach ($product as $pd)
                	
                       <option value="{{ $pd->id }}" @if ($pd->id == $outlet_stock[0]->product_id) {{ 'selected' }} @endif>
                      
                        {{ $pd->product_name }} </option> 
     
 		
    		 	 @endforeach
    		 	 </select>
				
                    </div>
                  </div>
                </div>
                
                 <div class="row">
                   <label class="col-sm-2 col-form-label">{{ __('Total_available_carton') }}</label>
                  <div class="col-sm-4">
                    <div class="form-group{{ $errors->has('total_available_carton') ? ' has-danger' : '' }}">
                     
                    <input class="form-control{{ $errors->has('total_available_carton') ? ' is-invalid' : '' }}" name="total_available_carton" 
                    id="input-total_available_carton" type="text" placeholder="{{ __('Total_available_carton') }}" 
                    value="{{ old('total_available_carton',$outlet_stock[0]->total_available_carton) }}"  aria-required="true"/>
                    
                      @include('alerts.feedback', ['field' => 'total_available_carton'])
                    </div>
                   </div>
                 
                  <label class="col-sm-2 col-form-label">{{ __('Total_available_cases') }}</label>
                  <div class="col-sm-4">
                    <div class="form-group{{ $errors->has('total_available_cases') ? ' has-danger' : '' }}">
                     
                    <input class="form-control{{ $errors->has('total_available_cases') ? ' is-invalid' : '' }}" name="total_available_cases" 
                    id="input-total_available_cases" type="text" placeholder="{{ __('Total_available_cases') }}" 
                    value="{{ old('total_available_cases',$outlet_stock[0]->total_available_cases) }}"  aria-required="true"/>
                    
                      @include('alerts.feedback', ['field' => 'total_available_cases'])
                    </div>
                  </div>
                </div>
                
                  <div class="row">
                   <label class="col-sm-2 col-form-label">{{ __('Total_available_pieces') }}</label>
                   <div class="col-sm-4">
                    <div class="form-group{{ $errors->has('total_available_pieces') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('total_available_pieces') ? ' is-invalid' : '' }}" name="total_available_pieces" 
                      id="input-total_available_pieces" type="text" placeholder="{{ __('Total_available_pieces') }}" 
                      value="{{ old('total_available_pieces',$outlet_stock[0]->total_available_pieces) }}"  aria-required="true"/>
                      @include('alerts.feedback', ['field' => 'total_available_pieces'])
                    </div>
                  </div>
               
                    <label class="col-sm-2 col-form-label">{{ __('Expiry_date') }}</label>
                   <div class="col-sm-4">
                    <div class="form-group{{ $errors->has('expiry_date') ? ' has-danger' : '' }}">
                      <input class="form-control datepicker{{ $errors->has('expiry_date') ? ' is-invalid' : '' }}" name="expiry_date" id="input-expiry_date" type="text" placeholder="{{ __('Expiry_date') }}" value="{{ old('expiry_date',$outlet_stock[0]->expiry_date) }}"  aria-required="true"/>
                      @include('alerts.feedback', ['field' => 'expiry_date'])
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Remarks') }}</label>
                  <div class="col-sm-4">
                    <div class="form-group{{ $errors->has('remarks') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('remarks') ? ' is-invalid' : '' }}" name="remarks" id="input-remarks" type="text" placeholder="{{ __('Remarks') }}" value="{{ old('remarks',$outlet_stock[0]->remarks) }}"  aria-required="true"/>
                      @include('alerts.feedback', ['field' => 'remarks'])
                    </div>
                  </div>
               
                  <label class="col-sm-2 col-form-label">{{ __('Carton_picture') }}</label>
                  <div class="col-sm-4">
                 
                  <input class="form-control{{ $errors->has('carton_picture') ? ' is-invalid' : '' }}" type="file" id="input-carton_picture"
                       name="carton_picture[]"  value="{{ old('carton_picture',$outlet_stock[0]->carton_picture) }}"  multiple/>
                   
                   
                      @include('alerts.feedback', ['field' => 'carton_picture'])
                  
                  </div>
                </div>
                
                 <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Case_picture') }}</label>
                  <div class="col-sm-4">
                  
                    <input class="form-control{{ $errors->has('case_picture') ? ' is-invalid' : '' }}" type="file" id="input-case_picture"
                       name="case_picture[]"  value="{{ old('case_picture',$outlet_stock[0]->case_picture) }}"  multiple/>
                   
                      @include('alerts.feedback', ['field' => 'case_picture'])
                  
                  </div>
               
                  <label class="col-sm-2 col-form-label">{{ __('Piece_picture') }}</label>
                  <div class="col-sm-4">
                  
                     <input class="form-control{{ $errors->has('piece_picture') ? ' is-invalid' : '' }}" type="file" id="input-piece_picture"
                       name="piece_picture[]"  value="{{ old('piece_picture',$outlet_stock[0]->piece_picture) }}"  multiple/>
                       
                      @include('alerts.feedback', ['field' => 'piece_picture'])
                   
                  </div>
                </div>
                
                 
                 <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Sales_man_id') }}</label>
                  <div class="col-sm-4">
                    <div class="form-group{{ $errors->has('sales_man_id') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('sales_man_id') ? ' is-invalid' : '' }}" name="sales_man_id" id="input-sales_man_id" type="text" placeholder="{{ __('Sales_man_id') }}" value="{{ old('sales_man_id',$outlet_stock[0]->sales_man_id) }}"  aria-required="true"/>
                      @include('alerts.feedback', ['field' => 'sales_man_id'])
                    </div>
                  </div>
                </div>
                
              <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-rose">{{ __('update') }}</button>
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
  $(document).ready(function () {
      
      $(".datepicker").datetimepicker({
        format: 'DD-MM-YYYY',
        useCurrent: false
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
