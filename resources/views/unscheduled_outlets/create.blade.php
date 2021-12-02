
<style type="text/css">
  @import url("https://fonts.googleapis.com/css?family=Open+Sans:400,700");
@import url("https://fonts.googleapis.com/css?family=Pacifico");


.content {
  background: #fff;
  border-radius: 3px;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.075), 0 2px 4px rgba(0, 0, 0, 0.0375);
  padding: 30px 30px 20px;
}



.select2.select2-container {
  width: 100% !important;
}

.select2.select2-container .select2-selection {
  border: 1px solid #ccc !important;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  height: 34px;
  margin-top: 5px;
  outline: none;
  transition: all 0.15s ease-in-out;
}

.select2.select2-container .select2-selection .select2-selection__rendered {
  color: #333;
  line-height: 32px;
  padding-right: 33px;
}

.select2.select2-container .select2-selection .select2-selection__arrow {
  background: #f8f8f8;
  border-left: 1px solid #ccc;
  -webkit-border-radius: 0 3px 3px 0;
  -moz-border-radius: 0 3px 3px 0;
  border-radius: 0 3px 3px 0;
  height: 32px;
  width: 33px;
  margin-top: 5px;
}

.select2.select2-container.select2-container--open .select2-selection.select2-selection--single {
  background: #f8f8f8;
}

.select2.select2-container.select2-container--open .select2-selection.select2-selection--single .select2-selection__arrow {
  -webkit-border-radius: 0 3px 0 0;
  -moz-border-radius: 0 3px 0 0;
  border-radius: 0 3px 0 0;
}

.select2.select2-container.select2-container--open .select2-selection.select2-selection--multiple {
  border: 1px solid #34495e;
}

.select2.select2-container.select2-container--focus .select2-selection {
  border: 1px solid #34495e;
}

.select2.select2-container .select2-selection--multiple {
  height: auto;
  min-height: 34px;
}

.select2.select2-container .select2-selection--multiple .select2-search--inline .select2-search__field {
  margin-top: 0;
  height: 32px;
}

.select2.select2-container .select2-selection--multiple .select2-selection__rendered {
  display: block;
  padding: 0 4px;
  line-height: 29px;
}

.select2.select2-container .select2-selection--multiple .select2-selection__choice {
  background-color: #f8f8f8;
  border: 1px solid #ccc;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  margin: 4px 4px 0 0;
  padding: 0 6px 0 22px;
  height: 24px;
  line-height: 24px;
  font-size: 12px;
  position: relative;
}

.select2.select2-container .select2-selection--multiple .select2-selection__choice .select2-selection__choice__remove {
  position: absolute;
  top: 0;
  left: 0;
  height: 22px;
  width: 22px;
  margin: 0;
  text-align: center;
  color: #e74c3c;
  font-weight: bold;
  font-size: 16px;
}

.select2-container .select2-dropdown {
  background: transparent;
  border: none;
  margin-top: -5px;
}

.select2-container .select2-dropdown .select2-search {
  padding: 0;
}

.select2-container .select2-dropdown .select2-search input {
  outline: none;
  border: 1px solid #34495e;
  border-bottom: none;
  padding: 4px 6px;
}

.select2-container .select2-dropdown .select2-results {
  padding: 0;
}

.select2-container .select2-dropdown .select2-results ul {
  background: #fff;
  border: 1px solid #34495e;
}

.select2-container .select2-dropdown .select2-results ul .select2-results__option--highlighted[aria-selected] {
  background-color: #3498db;
}

.big-drop {
  width: 600px !important;
}

.select_margin{
    margin-bottom: 10px;
}

</style>

@extends('layouts.app', ['activePage' => 'unscheduled_outlets', 'menuParent' => 'Timesheets', 'titlePage' => __('Unscheduled Outlets')])


@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('unschedule-outlets.store') }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">schedule</i>
                </div>
                <h4 class="card-title">{{ __('Add UnScheduled Outlets') }}</h4>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('unschedule-outlets.index') }}" class="btn btn-sm btn-rose">{{ __('Back to UnScheduled Outlets') }}</a>
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
                    
		            	<select class="form-control js-select2 " name="merchandiser" required="" id="merchandiser" value="{{ old('merchandiser') }}" aria-required="true"  >
                       <option value="" selected="">Select</option>
                        @foreach ($merchandisers as $merchants)
                    	<option value="{{ $merchants->employee_id}}"> {{ $merchants->first_name }} {{ $merchants->middle_name }} {{ $merchants->surname }} ({{ $merchants->employee_id}})</option>
    			              @endforeach
		            	</select>
                    
                     @include('alerts.feedback', ['field' => 'merchandiser'])
                    </div>
                  </div>
                </div>

                 <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Type') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('type') ? ' has-danger' : '' }}">
                    
                  <select class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" name="type" id="input-type" value="{{ old('type') }}" aria-required="true"  >
                       <option value="0" readonly selected>Unscheduled</option>
                     <!--   <option value="1">Scheduled</option> -->
                       <!-- <option value="0">Unscheduled</option> -->
                  </select>
                   
                     @include('alerts.feedback', ['field' => 'type'])
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
                    <select class="form-control js-select2-multi" data-style="select-with-transition" multiple title="Choose Outlets" data-size="7" name="outlet[]" id="input-outlet" 
                     value="{{ old('outlet') }}" aria-required="true" multiple="multiple">
                      <option value="" disabled> Multiple Options</option>
                      @foreach ($outlets as $outlet)
                      <option value="{{ $outlet->outlet_id}}"> {{ $outlet->store[0]->store_name }} ({{ $outlet->outlet_id }}) </option>
                        @endforeach
                    </select>
                    @include('alerts.feedback', ['field' => 'outlet'])
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

    $(".js-select2").select2();

    $(".js-select2-multi").select2({
        placeholder: "Select Outlets"
    });


 
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
