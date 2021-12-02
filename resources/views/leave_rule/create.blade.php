@extends('layouts.app', ['activePage' => 'leave-rule', 'menuParent' => 'My-Activity',  'titlePage' => __('Leave Rule')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('leave_rule.store') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">event</i>
                </div>
                <h4 class="card-title">{{ __('Add Leave') }}</h4>
              </div>
              <div class="card-body ">
                
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('leave_rule.index') }}" class="btn btn-sm btn-rose">{{ __('Back to leave') }}</a>
                  </div>
                </div>
                
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Leave_Type') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('leave_type') ? ' has-danger' : '' }}">
                    
                    <select class="form-control{{ $errors->has('leave_type') ? ' is-invalid' : '' }}" name="leave_type" id="input-leave_type" 
                     value="{{ old('leave_type') }}" aria-required="true">
                       <option value=" ">Select</option>
                  			<option value="Annual_Leave">Annual Leave</option>
                  			<option value="Sick_Leave">Sick Leave</option>
                  			<option value="Maternity_Leave">Maternity Leave</option>
                  			<option value="Loss_of_Pay">Loss of Pay</option>
                    </select>
                   
                      @include('alerts.feedback', ['field' => 'leave_type'])
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Total Days') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('total_days') ? ' has-danger' : '' }}">
                    

                    <input class="form-control{{ $errors->has('total_days') ? ' is-invalid' : '' }}" name="total_days" id="input-name" type="number" placeholder="{{ __('Total Days') }}" value="{{ old('total_days') }}"  aria-required="true"/>
                    
                      @include('alerts.feedback', ['field' => 'total_days'])
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Year') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('year') ? ' has-danger' : '' }}">
                    

                    <input class="form-control datepicker {{ $errors->has('year') ? ' is-invalid' : '' }}" name="year" id="input-year" type="text" placeholder="{{ __('Year') }}" value="{{ old('year') }}"  aria-required="true"/>
                    
                      @include('alerts.feedback', ['field' => 'year'])
                    </div>
                  </div>
                </div>

                  <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Requirements') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('requirements') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('requirements') ? ' is-invalid' : '' }}" name="requirements" id="input-name" type="text" placeholder="{{ __('Requirements') }}" value="{{ old('requirements') }}"  aria-required="true"/>
                      @include('alerts.feedback', ['field' => 'requirements'])
                    </div>
                  </div>
                </div>

                  <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Remarks') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('remarks') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('remarks') ? ' is-invalid' : '' }}" name="remarks" id="input-name" type="text" placeholder="{{ __('Remarks') }}" value="{{ old('remarks') }}"  aria-required="true"/>
                      @include('alerts.feedback', ['field' => 'remarks'])
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
        format: 'YYYY',
        minDate:new Date(),
        showTodayButton: true,
    });
});

   
    
  </script>
  
 
@endpush

