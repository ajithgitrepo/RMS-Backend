@extends('layouts.app', ['activePage' => 'date-timesheet', 'menuParent' => 'Timesheet', 'titlePage' => __('Delete Jouneyplan')])


@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <form method="get" action="{{ url('deleterecords') }}"  enctype="multipart/form-data" autocomplete="off" style="text-align: right;">
            @csrf
            @method('get')

            <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">schedule</i>
                </div>
                <h4 class="card-title">{{ __('Delete Jouneyplan') }}</h4>
              </div>
              <div class="card-body ">




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
                  <label class="col-sm-2 col-form-label">{{ __('From_Date') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('date') ? ' has-danger' : '' }}">


                      <input class="form-control datepicker{{ $errors->has('date') ? ' is-invalid' : '' }}" name="from_date" id="input-leavestartdate" type="text" placeholder="{{ __('From_Date') }}" value="{{ old('date') }}"  aria-required="true"/>
                      @include('alerts.feedback', ['field' => 'date'])
                    </div>
                  </div>
                </div>


                  <div class="row">
                      <label class="col-sm-2 col-form-label">{{ __('To_Date') }}</label>
                      <div class="col-sm-7">
                          <div class="form-group{{ $errors->has('date') ? ' has-danger' : '' }}">


                              <input class="form-control datepicker{{ $errors->has('date') ? ' is-invalid' : '' }}" name="to_date" id="input-leavestartdate" type="text" placeholder="{{ __('To_Date') }}" value="{{ old('date') }}"  aria-required="true"/>
                              @include('alerts.feedback', ['field' => 'date'])
                          </div>
                      </div>
                  </div>


                  <div class="row">
                      <label class="col-sm-2 col-form-label">{{ __('Reason') }}</label>
                      <div class="col-sm-7">
                          <div class="form-group{{ $errors->has('reason') ? ' has-danger' : '' }}">


                              <input class="form-control {{ $errors->has('reason') ? ' is-invalid' : '' }}" name="reason" id="input-reason" type="text" placeholder="{{ __('reason') }}" value="{{ old('reason') }}"  aria-required="true"/>
                              @include('alerts.feedback', ['field' => 'reason'])
                          </div>
                      </div>
                  </div>






              </div>


                <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-rose">

                    {{ __('Delete') }}
                </button>
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
              // minDate:new Date(),
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
