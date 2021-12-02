
@extends('layouts.app', ['activePage' => 'category_details', 'menuParent' => 'Products', 'titlePage' => __('Category Details')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">

          <form method="post" action="{{ route('category_details.update',$category[0]->id) }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">Category Details</i>
                </div>
                <h4 class="card-title">{{ __('Edit Category') }}</h4>
              </div>

              
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                    @canany(['isClient','isTopManagement','isAdmin'],App\User::class)
                      <a href="{{ route('category_details.index') }}" class="btn btn-sm btn-rose">{{ __('Back to category') }}</a>
                    @endcan
                  </div>
                </div>
                			
            
                
                
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Category') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('category_name') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="category_name" id="input-category_name" type="text" placeholder="{{ __('Category') }}" value="{{ old('category_name',$category[0]->category_name) }}"  aria-required="true"/>
                      @include('alerts.feedback', ['field' => 'category_name'])
                    </div>
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
