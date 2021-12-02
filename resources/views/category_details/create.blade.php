
@extends('layouts.app', ['activePage' => 'category_details', 'menuParent' => 'Products', 'titlePage' => __('Category Details')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('category_details.store') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">Category Details</i>
                </div>
                <h4 class="card-title">{{ __('Add Category') }}</h4>
              </div>
              
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('category_details.index') }}" class="btn btn-sm btn-rose">{{ __('Back to Category') }}</a>
                  </div>
                </div>
              
              <!--   <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Brand') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('brand_id') ? ' has-danger' : '' }}">
                       <select class="form-control{{ $errors->has('brand_id') ? ' is-invalid' : '' }}" name="brand_id" id="input-brand_id" 
                        value="{{ old('brand_id') }}" >
                     
                       <option>Select</option>
                       @foreach ($brands as $bran)
                   	<option value="{{ $bran->id }}"> {{  $bran->brand_name  }}</option>
    			@endforeach
			</select>
                     
                    </div>
                  </div>
                </div> -->
                
                
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Category') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('category_name') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="category_name" id="input-category_name" type="text" placeholder="{{ __('category') }}" value="{{ old('category_name') }}"  aria-required="true"/>
                      @include('alerts.feedback', ['field' => 'category_name'])
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
