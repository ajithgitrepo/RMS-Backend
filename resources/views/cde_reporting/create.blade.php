<style>
#email-error {
    height: 30px;
    margin-left: 0px !important;
}
</style>

@extends('layouts.app', ['activePage' => 'cde_reporting', 'menuParent' => 'Cde_Reporting', 'titlePage' => __('CDE Reporting')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('cde_reporting.store') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">event</i>
                </div>
                <h4 class="card-title">{{ __('Add CDE Reporting') }}</h4>
              </div>
              <div class="card-body ">
                
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('cde_reporting.index') }}" class="btn btn-sm btn-rose">{{ __('Back To List') }}</a>
                  </div>
                </div>
                
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Merchandiser') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('leave_type') ? ' has-danger' : '' }}">
                    
                   
                      <select class="form-control{{ $errors->has('leave_type') ? ' is-invalid' : '' }} js-select2" name="merchant_id" id="merchant_id" 
                     value="{{ old('leave_type') }}" aria-required="true">
                       <option value=" ">Select</option>
              					 @foreach($merchant as $emp)
              						<option value="{{ $emp->employee_id }}">{{ $emp->first_name }} {{ $emp->middle_name }} {{ $emp->surname }} ({{ $emp->employee_id }}) </option>
              						@endforeach
                  		</select>

                   
                      @include('alerts.feedback', ['field' => 'merchant_id'])
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Reporting CDE') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('rule') ? ' has-danger' : '' }}">
                     
                     <select class="form-control js-select2" name="cde_id" id="cde_id" 
                     value="{{ old('rule') }}" aria-required="true">
                        <option value=" ">Select</option>
					    @foreach($cde as $emp)
						<option value="{{ $emp->employee_id }}">{{ $emp->first_name }} {{ $emp->middle_name }} {{ $emp->surname }} ({{ $emp->employee_id }}) </option>
						@endforeach
                  		</select>
                    
                      @include('alerts.feedback', ['field' => 'cde_id'])
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

    $(".js-select2").select2();

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