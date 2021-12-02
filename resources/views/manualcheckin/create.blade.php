@extends('layouts.app', ['activePage' => 'manualcheckin', 'menuParent' => 'manualcheckin', 'titlePage' => __('manual checkin')])
<style>
      .col-form-label {
    padding-top: calc(0.4375rem + 1px);
    padding-bottom: calc(0.4375rem + 1px);
    margin-bottom: 0;
    font-size: inherit;
    line-height: 1.5;
    color: black;
    font-weight: 600;
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #444;
    line-height: 28px;
    margin-right: 122px;
}
  </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css"></link>

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('manualcheckin.store') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">add_manualcheckin</i>
                </div>
                <h4 class="card-title">{{ __('Add manual checkin') }}</h4>
               </div>
              
              <div class="card-body ">
              
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('manualcheckin.index') }}" class="btn btn-sm btn-rose">{{ __('Back to manualcheckin') }}</a>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Date') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('date') ? ' has-danger' : '' }}">
                    
                   <input class="form-control datepicker{{ $errors->has('date') ? ' is-invalid' : '' }}" name="date" id="input-date" type="text" placeholder="{{ __('date') }}" value="{{ old('date') }}" aria-required="true"/>
                   
                      @include('alerts.feedback', ['field' => 'date'])
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Employee_id') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('employee_id') ? ' has-danger' : '' }}">
                    
                  <select class="abcd {{ $errors->has('employee_id') ? ' is-invalid' : '' }}" style="width: 100%" name="employee_id">
                        <option value="">select</option>
                            @foreach($merchandiser as $mer)
                                     <option value="{{$mer->employee_id}}">{{$mer->first_name}} {{$mer->middle_name}}{{$mer->surname}}
                                      ( {{$mer->employee_id }} )</option>
                            @endforeach
                 </select>
                   
                      @include('alerts.feedback', ['field' => 'employee_id'])
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Outlet_id') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('outlet_id') ? ' has-danger' : '' }}">
                    
                   <select class="abcd {{ $errors->has('outlet_id') ? ' is-invalid' : '' }}" style="width: 100%" name="outlet_id">
                        <option value="">select</option>
                            @foreach($outlet as $out)
                                     <option value="{{$out->outlet_id}}">
                                     (@if(!empty($out->store[0]->store_name))
                                     {{$out->store[0]->store_name}}
                                       ( {{$out->store[0]->store_code }} )
                              @endif       
                           </option>
                            @endforeach
                 </select>
                   
                      @include('alerts.feedback', ['field' => 'outlet_id'])            
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Checkin_time') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('checkin_time') ? ' has-danger' : '' }}">
                    
                   <input class="form-control timepicker{{ $errors->has('checkin_time') ? ' is-invalid' : '' }}" name="checkin_time" id="input-checkin_time" type="text" placeholder="{{ __('checkin_time') }}" value="{{ old('checkin_time') }}" aria-required="true"/>
                   
                      @include('alerts.feedback', ['field' => 'checkin_time'])
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Checkout_time') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('checkout_time') ? ' has-danger' : '' }}">
                    
                   <input class="form-control timepicker{{ $errors->has('checkout_time') ? ' is-invalid' : '' }}" name="checkout_time" id="input-checkout_time" type="text" placeholder="{{ __('checkout_time') }}" value="{{ old('checkout_time') }}" aria-required="true"/>
                   
                      @include('alerts.feedback', ['field' => 'checkout_time'])
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Checkin_location') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('checkin_location') ? ' has-danger' : '' }}">
                    
                   <input class="form-control {{ $errors->has('checkin_location') ? ' is-invalid' : '' }}" name="checkin_location" id="input-checkin_location" type="text" placeholder="{{ __('checkin_location') }}" value="{{ old('checkin_location') }}" aria-required="true"/>
                   
                      @include('alerts.feedback', ['field' => 'checkin_location'])
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Checkout_location') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('checkout_location') ? ' has-danger' : '' }}">
                    
                  <input class="form-control {{ $errors->has('checkout_location') ? ' is-invalid' : '' }}" name="checkout_location" id="input-checkout_location" type="text" placeholder="{{ __('checkout_location') }}" value="{{ old('checkout_location') }}" aria-required="true"/>
                  
                      @include('alerts.feedback', ['field' => 'checkout_location'])
                    </div>
                  </div>
                </div>
                
                
                
                <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-rose text-center">{{ __('Save') }}</button>
               </div>
              
              </div> 
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection


@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.full.min.js"></script>
<script>

$(function () {
  $("select").select2(
    {
    width: '100%',
    allowClear: false,
    height: '100%',
}
  );
});

 $(function () {
 
         var date=new Date();


        $('.datepicker').datetimepicker({
            format: 'DD-MM-YYYY',
            showTodayButton: true,
            defaultDate: date,




        });

  });



  /*  $(document).ready(function() {
    // initialise Datetimepicker and Sliders
      md.initFormExtendedDatetimepickers();
      if ($('.slider').length != 0) {
        md.initSliders();
      }
    });*/
  </script>

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