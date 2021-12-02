@extends('layouts.app', ['activePage' => 'merchant-timesheet', 'menuParent' => 'Merchant-Timesheet', 'titlePage' => __('Merchandiser Timesheet')])


@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('merchant-timesheet.store') }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">schedule</i>
                </div>
                <h4 class="card-title">{{ __('Create Merchandiser Timesheet') }}</h4>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('merchant-timesheet.index') }}" class="btn btn-sm btn-rose">{{ __('Back to outlets') }}</a>
                  </div>
                </div>
                
            <!--      <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('EmployeeId') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('employeeid') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('employeeid') ? ' is-invalid' : '' }}" name="employeeid" id="input-employeeid" type="text" placeholder="{{ __('Employeeid') }}" value="{{ old('employeeid') }}"  aria-required="true"/>
                      @include('alerts.feedback', ['field' => 'employeeid'])
                    </div>
                  </div>
                </div>-->
                
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Merchandiser') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('merchandiser') ? ' has-danger' : '' }}">
                    
		            	<select class="form-control{{ $errors->has('merchandiser') ? ' is-invalid' : '' }}" name="merchandiser" id="input-merchandiser" value="{{ old('merchandiser') }}" aria-required="true"  >
                       <option value="">Select</option>
                        @foreach ($merchandisers as $merchants)
                    	<option value="{{ $merchants->employee_id}}"> {{ $merchants->first_name }} {{ $merchants->middle_name }} {{ $merchants->surname }} ({{ $merchants->employee_id}})</option>
    			              @endforeach
		            	</select>
                   
                     @include('alerts.feedback', ['field' => 'merchandiser'])
                    </div>
                  </div>
                </div> 
                
                
            
     		        <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Date') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('date') ? ' has-danger' : '' }}">
                    
                 
                      <input class="form-control datepicker{{ $errors->has('date') ? ' is-invalid' : '' }}" name="date" id="input-leavestartdate" type="text" placeholder="{{ __('Date') }}" value="{{ old('date') }}"  aria-required="true"/>
                      @include('alerts.feedback', ['field' => 'date'])
                    </div>
                  </div>
                </div>          
              

                 <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Outlet') }}</label>
                 <div class="col-lg-7 col-md-6 col-sm-3">
                    <select class="form-control selectpicker" data-style="select-with-transition" multiple title="Choose Outlets" data-size="7" name="outlet[]" id="input-outlet" 
                     value="{{ old('outlet') }}" aria-required="true" multiple="multiple">
                      <option value="" disabled> Multiple Options</option>
                      @foreach ($outlets as $outlet)
                      <option value="{{ $outlet->outlet_id}}"> {{ $outlet->outlet_name }} ({{ $outlet->outlet_id }}) </option>
                        @endforeach
                    </select>
                  </div>
                </div>  
                
                
              
              </div> 
                
         
                <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-rose">{{ __('Save') }}</button>
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
