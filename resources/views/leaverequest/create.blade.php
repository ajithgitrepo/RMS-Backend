
@extends('layouts.app', ['activePage' => 'Leave Request', 'menuParent' => 'laravel', 'titlePage' => __('Leave Request')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('leaverequest.store') }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">leave request</i>
                </div>
                <h4 class="card-title">{{ __('Employee Leave Request') }}</h4>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('leaverequest.index') }}" class="btn btn-sm btn-rose">{{ __('Back to leave request') }}</a>
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
                  <label class="col-sm-2 col-form-label">{{ __('LeaveType') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('leavetype') ? ' has-danger' : '' }}">
                    
           <!--  <select class="form-control{{ $errors->has('leavetype') ? ' is-invalid' : '' }}" name="leavetype" id="input-leavetype" 
                     value="{{ old('leave_type') }}" aria-required="true"/>
                       <option value=" ">Select</option>
  			<option value="public">Public Leave</option>
  			<option value="lop">loss of pay</option>
 			<option value="maternity">Maternity Leave</option>
  			<option value="parental">Parental Leave</option>
  			<option value="sick">Sick Leave</option>
  			<option value="medical">Medical Leave</option>
  			<option value="annual">Annual Leave</option>

			</select>  -->
     
			<select class="form-control{{ $errors->has('leavetype') ? ' is-invalid' : '' }}" name="leavetype" id="input-leavetype" 
                     value="{{ old('leave_type') }}" aria-required="true">
                       <option value="">Select</option>
                     
                    	<option value="Sick_Leave">Sick Leave</option>
                      <option value="Loss_Of_Pay">Loss Of Pay	</option>
                      @if($gender == "female")
                      <option value="Maternity_Leave">Maternity Leave</option>
                      @endif
                    	
                          @if($leavetype == "Anual")
                          <option value="Annual_Leave">Annual Leave</option>
                          @endif
                			</select>
                     @include('alerts.feedback', ['field' => 'leavetype'])
                    </div>
                  </div>
                </div> 
                
            
     		  <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Leavestartdate') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('leavestartdate') ? ' has-danger' : '' }}">
                    <input class="form-control datepicker{{ $errors->has('leavestartdate') ? ' is-invalid' : '' }}" name="leavestartdate" id="input-leavestartdate" type="text" placeholder="{{ __('Leavestartdate') }}" value="{{ old('leavestartdate') }}"  aria-required="true"/>
                      @include('alerts.feedback', ['field' => 'leavestartdate'])
                    </div>
                  </div>
                </div>          
               
              
                  <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Leaveenddate') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('leaveenddate') ? ' has-danger' : '' }}">
                    
                      <input class="form-control datepicker{{ $errors->has('leaveenddate') ? ' is-invalid' : '' }}" name="leaveenddate" id="input-leaveenddate" type="text" placeholder="{{ __('Leaveenddate') }}" value="{{ old('leaveenddate') }}"  aria-required="true"/>
                      @include('alerts.feedback', ['field' => 'leaveenddate'])
                    </div>
                  </div>
                </div>
             
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Reason') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('reason') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('reason') ? ' is-invalid' : '' }}" name="reason" id="input-reason" type="text" placeholder="{{ __('Reason') }}" value="{{ old('reason') }}"  aria-required="true"/>
                      @include('alerts.feedback', ['field' => 'reason'])
                    </div>
                  </div>
                </div>
                
              <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Supportingdocument') }}</label>
                  <div class="col-sm-7">
                   <input type="file" name="supportingdocument[]" multiple/>
                   
                    <!--  <input class="form-control{{ $errors->has('supportingdocument') ? ' is-invalid' : '' }}" name="supportingdocument" id="input-supportingdocument" type="text" placeholder="{{ __('supportingdocument') }}" value="{{ old('supportingdocument') }}"  aria-required="true"/>-->
                    
                      @include('alerts.feedback', ['field' => 'supportingdocument'])
                      
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
