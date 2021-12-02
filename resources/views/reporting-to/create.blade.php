
<style>
#email-error {
    height: 30px;
    margin-left: 0px !important;
}
</style>

@extends('layouts.app', ['activePage' => 'employee-management', 'menuParent' => 'employee', 'titlePage' => __('Employee Managementss')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('employee-reporting.store') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">Reporting To</i>
                </div>
                <h4 class="card-title">{{ __('Add Reporting To') }}</h4>
              </div>
              <div class="card-body ">
                
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('employee-reporting.index') }}" class="btn btn-sm btn-rose">{{ __('Back to Reporting To') }}</a>
                  </div>
                </div>
                
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Employee') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('leave_type') ? ' has-danger' : '' }}">
                    
                   
                      <select class="form-control{{ $errors->has('leave_type') ? ' is-invalid' : '' }}" name="employee_id" id="employee_id" 
                     value="{{ old('leave_type') }}" aria-required="true">
                       <option value=" ">Select</option>
					    @foreach($employee as $emp)
						<option value="{{ $emp->employee_id }}">{{ $emp->employee_id }}</option>
						@endforeach
                  		</select>

                   
                      @include('alerts.feedback', ['field' => 'employee_id'])
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Reporting To') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('rule') ? ' has-danger' : '' }}">
                     
                     <select class="form-control{{ $errors->has('rule') ? ' is-invalid' : '' }}" name="reporting_employee_id" id="reporting_employee_id" 
                     value="{{ old('rule') }}" aria-required="true">
                        <option value=" ">Select</option>
					    @foreach($employee as $emp)
						<option value="{{ $emp->employee_id }}">{{ $emp->employee_id }}</option>
						@endforeach
                  		</select>
                    
                      @include('alerts.feedback', ['field' => 'reporting_employee_id'])
                    </div>
                  </div>
                </div>

                  <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Reporting Date') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('requirements') ? ' has-danger' : '' }}">
                    <input type="text" class="form-control datepicker" id="start_month" placeholder="Reporting Date" name="report_date">
                      @include('alerts.feedback', ['field' => 'report_date'])
                    </div>
                  </div>
                </div>

                  <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Reporting End Date') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('remarks') ? ' has-danger' : '' }}">
                    <input type="text" class="form-control datepicker" id="end_month" placeholder="Reporting Date" name="report_end_month">
                      @include('alerts.feedback', ['field' => 'report_end_month'])
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

$('#employee_id').on('change', function () {
  //ways to retrieve selected option and text outside handler
  //alert('Changed option value ' + this.value);
 // console.log('Changed option text ' + $(this).find('option').filter(':selected').text());
 $("#reporting_employee_id option").removeAttr('disabled');
 $("#reporting_employee_id option[value='"+ this.value + "']").attr("disabled", true);;
});

    $(document).ready(function () {
      // $('.datepicker').datetimepicker({
      //   useCurrent: false
      // });

      $(".datepicker").datetimepicker({
        format: 'DD-MM-YYYY',
        useCurrent: false
      });

    });

    $(document).ready(function() {
      // Initialise the wizard
      demo.initMaterialWizard();
      setTimeout(function() {
        $('.card.card-wizard').addClass('active');
      }, 600);
    });
  </script>
  

  <script>
    $(document).ready(function() {
      // initialise Datetimepicker and Sliders
      md.initFormExtendedDatetimepickers();

     
    });
  </script>
@endpush