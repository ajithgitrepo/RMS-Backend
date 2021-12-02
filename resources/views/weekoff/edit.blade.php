
@extends('layouts.app', ['activePage' => 'WeekOff', 'menuParent' => 'weekoff', 'titlePage' => __('WeekOff')])


@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">


          <form method="post" action="{{ route('weekoff.update', $result[0]->id ) }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">calendar_today</i>
                </div>
                <h4 class="card-title">{{ __('Edit WeekOff') }}</h4>
              </div>
              
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('weekoff.index') }}" class="btn btn-sm btn-rose">{{ __('Back to WeekOff') }}</a>
                  </div>
                </div>
               

                <!--  <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Role') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                       <select class="form-control" name="select-role" id="select-role" 
                     value="{{ old('select-role ') }}">

                       <option value="" selected disabled>Select Role</option>
                       <option value="5">Field Manager</option>
                       <option value="6">Merchandiser</option>

                      </select>
                   
                      @include('alerts.feedback', ['field' => 'select-role'])
                    </div>
                  </div>
                </div> -->

                 <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Merchandiser') }}</label>
                  <div class="col-sm-7">
                    
                       <select class="form-control{{ $errors->has('employee') ? ' is-invalid' : '' }}" name="employee" id="input-employee" 
                     value="{{ old('employee',$result[0]->employee_id) }}" aria-required="true">


                     <option value="" disabled="" selected="">Select Merchandiser</option>
                        @foreach ($employees as $merchants)
                        <option value="{{ $merchants->employee_id}}" @if ( $merchants->employee_id == $result[0]->employee_id) {{ 'selected' }} @endif> {{ $merchants->first_name }} {{ $merchants->middle_name }} {{ $merchants->surname }} ({{ $merchants->employee_id}})</option>
                        @endforeach

                     
                      </select>
                   
                    @include('alerts.feedback', ['field' => 'employee'])
                  </div>
                </div>

                @php

                   
                    $db_months = $result[0]->month;

                    $months = explode(",",$db_months)

                @endphp

                 <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Month') }}</label>
                  <div class="col-sm-7">
                   <select class="form-control selectpicker" data-style="select-with-transition" title="Select Months" data-size="7" name="month" id="input-outlet" 
                     value="{{ old('month') }}" aria-required="true" >

                      <option value="" disabled> Multiple Options</option>
                      <option value="January" @if (in_array('January', $months)) {{ 'selected' }} @endif >January</option>
                      <option value="February" @if (in_array('February', $months)) {{ 'selected' }} @endif  >February</option>
                      <option value="March" @if (in_array('March', $months)) {{ 'selected' }} @endif >March</option>
                      <option value="April" @if (in_array('April', $months)) {{ 'selected' }} @endif >April</option>
                      <option value="May" @if (in_array('May', $months)) {{ 'selected' }} @endif >May</option>
                      <option value="June" @if (in_array('June', $months)) {{ 'selected' }} @endif >June</option>
                      <option value="July" @if (in_array('July', $months)) {{ 'selected' }} @endif >July</option>
                      <option value="August" @if (in_array('August', $months)) {{ 'selected' }} @endif >August</option>
                      <option value="September" @if (in_array('September', $months)) {{ 'selected' }} @endif >September</option>
                      <option value="October" @if (in_array('October', $months)) {{ 'selected' }} @endif >October</option>
                      <option value="November" @if (in_array('November', $months)) {{ 'selected' }} @endif >November</option>
                      <option value="December" @if (in_array('December', $months)) {{ 'selected' }} @endif >December</option>    
                     
                    </select>
                     @include('alerts.feedback', ['field' => 'month'])
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Day') }}</label>
                  <div class="col-sm-7">
                    
                        <select class="form-control selectpicker" data-style="select-with-transition"  title="Select Month" data-size="7" name="day" id="day" 
                     value="{{ old('day') }}" aria-required="true" >

                       <option value="" selected disabled>Select Day</option>
                       <option value="Sunday" @if ($result[0]->day == "Sunday") {{ 'selected' }} @endif >Sunday</option>
                       <option value="Monday" @if ($result[0]->day == "Monday") {{ 'selected' }} @endif>Monday</option>
                       <option value="Tuesday" @if ($result[0]->day == "Tuesday") {{ 'selected' }} @endif>Tuesday</option>
                       <option value="Wednesday" @if ($result[0]->day == "Wednesday") {{ 'selected' }} @endif>Wednesday</option>
                       <option value="Thursday" @if ($result[0]->day == "Thursday") {{ 'selected' }} @endif>Thursday</option>
                       <option value="Friday" @if ($result[0]->day == "Friday") {{ 'selected' }} @endif>Friday</option>
                       <option value="Saturday" @if ($result[0]->day == "Saturday") {{ 'selected' }} @endif>Saturday</option>

                      </select>
                      @include('alerts.feedback', ['field' => 'day'])
                   
                  </div>
                </div>
                 

                  <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Year') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('year') ? ' has-danger' : '' }}">
                    


                     <select class="form-control selectpicker" data-style="select-with-transition"  title="Select Year" data-size="7" name="year" id="input-year" 
                     value="{{ old('year') }}" aria-required="true">
                      <option value="" disabled> Select Year</option>
                      <option value="2021" @if ($result[0]->year == "2021") {{ 'selected' }} @endif >2021</option>
                      <option value="2022" @if ($result[0]->year == "2022") {{ 'selected' }} @endif >2022</option>
                     
                    </select>
                    
                      @include('alerts.feedback', ['field' => 'year'])
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


      $('#select-role').on('change', function() {
      //alert( this.value );

      var role = this.value;

       var csrf = $('meta[name="csrf-token"]').attr('content');
      $.ajax({
          url: '/get_emp_list',
          type: 'GET',
          data: {role : role, '_token': csrf},
          dataType: 'json',

          success: function( data ) {
             //alert(data);
             var sel = $("#input-employee");
             sel.empty();
             sel.append('<option selected disabled value=""> Select Employee </option>'); 

                for (var i=0; i<data.length; i++) {
                  sel.append('<option value="' + data[i].employee_id + '">' + data[i].first_name +" "+ data[i].middle_name +" "+ data[i].surname  + '</option>');
                }
           
          }       
      })

    });

  </script>
  
 
@endpush

