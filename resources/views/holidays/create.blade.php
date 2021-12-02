
@extends('layouts.app', ['activePage' => 'holidays', 'menuParent' => 'laravel', 'titlePage' => __('Holidays')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('holidays.store') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">Holidays</i>
                </div>
                <h4 class="card-title">{{ __('Add Holidays') }}</h4>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('holidays.index') }}" class="btn btn-sm btn-rose">{{ __('Back to Page') }}</a>
                  </div>
                </div>
                 
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Date') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('year') ? ' has-danger' : '' }}">
                       <input class="form-control datepicker{{ $errors->has('date') ? ' is-invalid' : '' }}" name="date" id="input-date" type="text" placeholder="{{ __('Date') }}" value="{{ old('date') }}"  aria-required="true"/>
                      @include('alerts.feedback', ['field' => 'date'])
                    </div>
                  </div>
                </div>
                  
                  
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Description') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" id="input-description" type="text" placeholder="{{ __('Description') }}" value="{{ old('description') }}"  aria-required="true"/>
                      @include('alerts.feedback', ['field' => 'description'])
                    </div>
                  </div>
                </div>
                
               
                
                <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-rose mx-auto">{{ __('Save') }}</button>
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
