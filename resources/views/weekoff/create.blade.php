
@extends('layouts.app', ['activePage' => 'WeekOff', 'menuParent' => 'weekoff', 'titlePage' => __('WeekOff')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('weekoff.store') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">calendar_today</i>
                </div>
                <h4 class="card-title">{{ __('Add WeekOff') }}</h4>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('weekoff.index') }}" class="btn btn-sm btn-rose">{{ __('Back to Page') }}</a>
                  </div>
                </div>

                <!--  <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Role') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                       <select class="form-control" name="select-role" id="select-role" 
                     value="{{ old('select-role ') }}">

                       <option value="" selected disabled>Select Role</option>
                       <option value="6">Merchandiser</option>

                      </select>
                   
                      @include('alerts.feedback', ['field' => 'select-role'])
                    </div>
                  </div>
                </div> -->
                 
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Merchandiser') }}</label>
                  <div class="col-sm-7">
                    
                    
                     <select class="form-control selectpicker" data-style="select-with-transition"  title="Select Merchandiser" data-size="7" name="employee" id="input-outlet" 
                     value="{{ old('employee') }}" aria-required="true">

                       <option value="" disabled="" selected="">Select Merchandiser</option>
                        @foreach ($employees as $merchants)
                        <option value="{{ $merchants->employee_id}}"> {{ $merchants->first_name }} {{ $merchants->middle_name }} {{ $merchants->surname }} ({{ $merchants->employee_id}})</option>
                        @endforeach

                    </select>
                   
                    @include('alerts.feedback', ['field' => 'employee'])
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Month') }}</label>
                  <div class="col-sm-7">
                   <select class="form-control selectpicker" data-style="select-with-transition"  title="Select Month" data-size="7" name="month[]" id="input-outlet" 
                     value="{{ old('month') }}" aria-required="true" multiple="">
                      <option value="" disabled> Multiple Options</option>
                      <option value="January">January</option>
                      <option value="February">February</option>
                      <option value="March">March</option>
                      <option value="April">April</option>
                      <option value="May">May</option>
                      <option value="June">June</option>
                      <option value="July">July</option>
                      <option value="August">August</option>
                      <option value="September">September</option>
                      <option value="October">October</option>
                      <option value="November">November</option>
                      <option value="December">December</option>    
                     
                    </select>
                     @include('alerts.feedback', ['field' => 'month'])
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Day') }}</label>
                  <div class="col-sm-7">
                    
                   
                    <select class="form-control selectpicker" data-style="select-with-transition"  title="Select Day" data-size="7" name="day" id="day" 
                     value="{{ old('day') }}" aria-required="true" >

                       <option value="" selected disabled>Select Day</option>
                       <option value="Sunday">Sunday</option>
                       <option value="Monday">Monday</option>
                       <option value="Tuesday">Tuesday</option>
                       <option value="Wednesday">Wednesday</option>
                       <option value="Thursday">Thursday</option>
                       <option value="Friday">Friday</option>
                       <option value="Saturday">Saturday</option>

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
                      <option value="2021">2021</option>
                      <option value="2022">2022</option>
                     
                    </select>
                    
                      @include('alerts.feedback', ['field' => 'year'])
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

     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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
