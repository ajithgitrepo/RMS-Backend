

    
@extends('layouts.app', ['activePage' => 'mannual_attendance', 'menuParent' => 'Attendance', 'titlePage' => __('Edit Mannual Attendance')])


@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('mannual_attendance.update',$attendance[0]->id) }}" autocomplete="off" class="form-horizontal"
           enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">schedule</i>
                </div>
                <h4 class="card-title">{{ __('Edit Mannual Attendance') }}</h4>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('mannual_attendance.index') }}" class="btn btn-sm btn-rose">{{ __('Back to Manual Attendance') }}</a>
                  </div>
                </div>
                
           
                
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Employee Name') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('employee_id') ? ' has-danger' : '' }}">
          

             <select class="form-control selectpicker" data-style="select-with-transition"  title="Select Employee" data-size="7" name="employee_id" id="employee_id" 
                     value="{{ old('employee_id') }}" aria-required="true" >

                       <option value="">Select</option>
                       
        	              @foreach($employee as $emp)
        						
                             <option value="{{ $emp->employee_id }}" {{$attendance[0]->employee_id == $emp->employee_id  ? 'selected' : ''}}>
                                 {{ $emp->first_name }} {{$emp->middle_name }} {{$emp->surname }}
                            	 ({{ $emp->employee_id}})</option>
        		     @endforeach
		    </select>
             
                    </div>
                  </div>
                </div>

          
     		 <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Date') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('date') ? ' has-danger' : '' }}">
                    
              
                      <input class="form-control datepicker" name="date" id="input-date" type="text" placeholder="{{ __('Date') }}" 
                      value="{{ old('date',$attendance[0]->date) }}"  aria-required="true"/>
                      
                      @include('alerts.feedback', ['field' => 'date'])
                    </div>
                  </div>
                </div>          
              

                  <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Check In') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('checkin_time') ? ' has-danger' : '' }}">
                    
                    <input type="text" name="checkin_time" class="form-control timepicker" value="{{ old('checkin_time',$attendance[0]->checkin_time) }}" >
               
                     
                      @include('alerts.feedback', ['field' => 'checkin_time'])
                    </div>
                  </div>
                </div>     
                
                 <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Check Out') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('checkout_time') ? ' has-danger' : '' }}">
                    
                 <input type="text" name="checkout_time" class="form-control timepicker" value="{{ old('checkout_time',$attendance[0]->checkout_time) }}" >
                      
                      @include('alerts.feedback', ['field' => 'checkout_time'])
                    </div>
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
             
      });
  });
  
    $(document).ready(function() {
  
    // initialise Datetimepicker and Sliders
  
      md.initFormExtendedDatetimepickers();
         
      if ($('.slider').length != 0) {
      
        md.initSliders();
      } 
      
    }); 
    
   
     $(function () {
    $('.datetimepicker').datetimepicker();
});
     
   
  </script>
  
 
@endpush
