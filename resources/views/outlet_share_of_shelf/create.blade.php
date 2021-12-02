@extends('layouts.app', ['activePage' => 'availabilty', 'menuParent' => 'Availabilty', 'titlePage' => __('Availabilty')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('brand_details.store') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">Product Availabilty</i>
                </div>
               <!--  <h4 class="card-title">{{ __('Add Brand Details') }}</h4> -->
              </div>
              
              <div class="card-body ">
               <!--  <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('brand_details.index') }}" class="btn btn-sm btn-rose">{{ __('Back to brand') }}</a>
                  </div>
                </div> -->
              
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Brand Name') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('brand_name') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('brand_name') ? ' is-invalid' : '' }}" name="brand_name" id="input-brand_name" type="text" placeholder="{{ __('Brand Name') }}" value="{{ old('brand_name') }}"  aria-required="true"/>
                      @include('alerts.feedback', ['field' => 'brand_name'])
                    </div>
                  </div>
                </div>
                 
                 <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('client') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('client_id') ? ' has-danger' : '' }}">
                    
                     <select class="form-control{{ $errors->has('client_id') ? ' is-invalid' : '' }}" name="client_id" id="input-client_id" 
                        value="{{ old('client_id') }}" >
 
                       <option value="" selected="">Select</option>
                       @foreach ($employ_client as $employ1)
                   	<option value="{{ $employ1->employee_id }}"> {{  $employ1->first_name  }}{{  $employ1->middle_name  }}{{  $employ1->surname  }}
                   	({{ $employ1->employee_id}})</option>
    			@endforeach
    			
			</select>
			
                      @include('alerts.feedback', ['field' => 'client_id'])
                    </div>
                  </div>
                </div>
             
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Field Manager') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('field_manager_id') ? ' has-danger' : '' }}">
                    
                       <select class="form-control{{ $errors->has('field_manager_id') ? ' is-invalid' : '' }}" name="field_manager_id" id="input-field_manager_id" 
                        value="{{ old('field_manager_id') }}" >
 
                       <option value="" selected="">Select</option>
                       @foreach ($employ_field as $employ2)
                   	<option value="{{ $employ2->employee_id }}"> {{  $employ2->first_name  }}{{  $employ2->middle_name }}{{  $employ2->surname  }}
                   	({{ $employ2->employee_id}})</option>
    			@endforeach
    			
			</select>
                      @include('alerts.feedback', ['field' => 'field_manager_id'])
                    </div>
                  </div>
                </div>
                
               
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Sales Manager') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('sales_manager_id') ? ' has-danger' : '' }}">
                    
                      <select class="form-control{{ $errors->has('sales_manager_id') ? ' is-invalid' : '' }}" name="sales_manager_id" id="input-sales_manager_id" 
                        value="{{ old('sales_manager_id') }}" >
 
                       <option value="" selected="">Select</option>
                           @foreach ($employ_sales as $employ3)
                       	<option value="{{ $employ3->employee_id }}"> {{  $employ3->first_name  }}{{  $employ3->middle_name  }}{{  $employ3->surname  }}
                       	({{ $employ3->employee_id}})</option>
                    		@endforeach
                			
            			</select>
                      @include('alerts.feedback', ['field' => 'sales_manager_id'])
                    </div>
                  </div>
                </div>
          
              
       
                <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-rose mx-auto">{{ __('Add') }}</button>
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
              minDate:new Date(),
              showTodayButton: true,
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
