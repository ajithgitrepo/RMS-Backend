@extends('layouts.app', ['activePage' => 'day_jouney_plan', 'menuParent' => 'Timesheet', 'titlePage' => __('Scheduled JourneyPlan')])


@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('defined-outlets.store') }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">schedule</i>
                </div>
                <h4 class="card-title">{{ __('Scheduled JourneyPlan') }}</h4>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('defined-outlets.index') }}" class="btn btn-sm btn-rose">{{ __('Back to Scheduled JourneyPlan') }}</a>
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

                 <!-- <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Type') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('type') ? ' has-danger' : '' }}">
                    
                  <select class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" name="type" id="input-type" value="{{ old('type') }}" aria-required="true"  >
                       <option value="" disabled selected>Select</option>
                       <option value="1">Scheduled</option>
                       <option value="0">Unscheduled</option>
                  </select>
                   
                     @include('alerts.feedback', ['field' => 'type'])
                    </div>
                  </div>
                </div>  -->
                
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Month') }}</label>
                  <div class="col-sm-7">
                   <select class="form-control selectpicker" data-style="select-with-transition" title="Select Month" data-size="7" name="month" id="select-month" 
                     value="{{ old('month') }}" aria-required="true" >
                      <option value="" disabled> Select Month</option>

                      <option value="January" @if (old('month')=="January") {{ 'selected' }} @endif >January</option>
                      <option value="February" @if (old('month')=="February")) {{ 'selected' }} @endif  >February</option>
                      <option value="March" @if (old('month')=="March")) {{ 'selected' }} @endif >March</option>
                      <option value="April" @if (old('month')=="April")) {{ 'selected' }} @endif >April</option>
                      <option value="May" @if (old('month')=="May")) {{ 'selected' }} @endif >May</option>
                      <option value="June" @if (old('month')=="June")) {{ 'selected' }} @endif >June</option>
                      <option value="July" @if (old('month')=="July")) {{ 'selected' }} @endif >July</option>
                      <option value="August" @if (old('month')=="August")) {{ 'selected' }} @endif >August</option>
                      <option value="September" @if (old('month')=="September")) {{ 'selected' }} @endif >September</option>
                      <option value="October" @if (old('month')=="October")) {{ 'selected' }} @endif >October</option>
                      <option value="November" @if (old('month')=="November")) {{ 'selected' }} @endif >November</option>
                      <option value="December" @if (old('month')=="December")) {{ 'selected' }} @endif >December</option>    

                    </select>
                     @include('alerts.feedback', ['field' => 'month'])
                  </div>
                </div>
                
            
     		    <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Days') }}</label>
                 <div class="col-lg-7 col-md-6 col-sm-3">
                    <select class="form-control selectpicker" data-style="select-with-transition" multiple title="Select days" data-size="7" name="days[]" id="input_days" 
                     value="{{ old('days') }}" aria-required="true" multiple="multiple">
                      <option value="" disabled> Multiple Days</option>
                     
                      <option id="sunday" value="Sun"> Sunday </option>
                      <option id="monday" value="Mon"> Monday </option>
                      <option id="tuesday" value="Tue"> Tuesday </option>
                      <option id="wednesday" value="Wed"> Wednesday </option>
                      <option id="thusday" value="Thu"> Thursday </option>
                      <option id="friday" value="Fri"> Friday </option>
                      <option id="saturday" value="Sat" > Saturday </option>
                       
                    </select>
                     @include('alerts.feedback', ['field' => 'days'])
                  </div>
                </div> 

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Year') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('year') ? ' has-danger' : '' }}">
                    

                     <select class="form-control selectpicker" data-style="select-with-transition" title="Select Year" data-size="7" name="year" id="input_days" 
                     value="{{ old('year') }}" aria-required="true" >
                     
                     <option value="" disabled> Select Year</option>
                     
                      <option  value="2021"> 2021 </option>
                      <!-- <option  value="Mon"> Monday </option> -->
                    </select>
                    
                      @include('alerts.feedback', ['field' => 'year'])
                    </div>
                  </div>
                </div>          
              

                 <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Outlets') }}</label>
                 <div class="col-lg-7 col-md-6 col-sm-3">
                    <select class="form-control selectpicker" data-style="select-with-transition" multiple title="Choose Outlets" data-size="7" name="outlets[]" id="input_days" 
                     value="{{ old('outlets') }}" aria-required="true" multiple="multiple">
                      <option value="" disabled> Multiple  Options</option>
                      @foreach ($outlets as $outlet)
                        <option value="{{ $outlet->outlet_id}}"> {{ $outlet->store[0]->store_name }} ({{ $outlet->outlet_id }}) </option>
                        @endforeach
                    </select>
                     @include('alerts.feedback', ['field' => 'outlets'])
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
         // viewMode : 'week',
          format : 'ddd',
          toolbarPlacement: "top",
          allowInputToggle: true,
          useCurrent: false,
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


    $('#select-month').on('change', function(e) {
     // alert( this.value );

     var month = $(e.target).val();

     //alert(month);

      var employee_id = $("#input-merchandiser").val();
     // var month = this.value;

       var csrf = $('meta[name="csrf-token"]').attr('content');
      $.ajax({
          url: '/get_weekoff_days',
          type: 'GET',
          data: {month : month, emp_id : employee_id, '_token': csrf},
          dataType: 'json',

          success: function( data ) {
             //alert(data);

             $('#sunday').prop('disabled', false);
             $('#monday').prop('disabled', false);
             $('#tuesday').prop('disabled', false);
             $('#wednesday').prop('disabled', false);
             $('#thusday').prop('disabled', false);
             $('#friday').prop('disabled', false);
             $('#saturday').prop('disabled', false);


           var day = data[0].day; 

            if(data[0].day == "Sunday")
            {

                $('#sunday').prop('disabled', true);

            }

            if(data[0].day == "Monday")
            {
                
               $("#monday").attr( "disabled", "disabled" );

            }

            if(data[0].day == "Tuesday")
            {
                
               $("#tuesday").attr( "disabled", "disabled" );
 
            }

            if(data[0].day == "Wednesday")
            {
                
               $("#wednesday").attr( "disabled", "disabled" );

            }

            if(data[0].day == "Thursday")
            {
                
               $("#thusday").attr( "disabled", "disabled" );

            }

            if(data[0].day == "Friday")
            {
                
               $("#friday").attr( "disabled", "disabled" );

            }

            if(data[0].day == "Saturday")
            {
                
               $("#saturday").attr( "disabled", "disabled" );

            }

           

            // var html = '';
            // html += '<option selected disabled value=""> Select Days </option>';

                // for (var i=0; i<data.length; i++) {
                //   sel.append('<option value="' + data[i].employee_id + '">' + data[i].first_name +" "+ data[i].middle_name +" "+ data[i].surname  + '</option>');
                // }


             //sel.append(html);
            
          }       
      })

    });

     
    
  </script>
  
 
@endpush
