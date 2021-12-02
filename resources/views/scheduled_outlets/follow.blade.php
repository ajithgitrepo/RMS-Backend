

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

@extends('layouts.app', ['activePage' => 'scheduled_outlets', 'menuParent' => 'Timesheets', 'titlePage' => __('Scheduled Outlets')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ url('add_follow_timesheet') }}" autocomplete="off" class="form-horizontal follow" enctype="multipart/form-data">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">schedule</i>
                </div>
                <h4 class="card-title">{{ __('Follow Timesheet') }}</h4>
              </div>
              <div class="card-body ">
                 
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('schedule-outlets.index') }}" class="btn btn-sm btn-rose">{{ __('Back to Scheduled Timesheet') }}</a>
                  </div>
                </div>
                
         
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Merchandiser') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('merchandiser') ? ' has-danger' : '' }}">
                    
                   <select class="form-control js-select2-multi" data-style="select-with-transition" title="Select Merchandiser" data-size="7" name="merchandiser[]" id="merchandiser" 
                     value="{{ old('merchandiser') }}" placeholder="Select Outlets" aria-required="true" required multiple="multiple" >
                     
                    <option value="" disabled="">Select Multiple</option>
                        @foreach ($merchandisers as $merchants)
                      <option value="{{ $merchants->employee_id}}"> {{ $merchants->first_name }} {{ $merchants->middle_name }} {{ $merchants->surname }} ({{ $merchants->employee_id}})</option>
                        @endforeach

                    </select>

                  
                     @include('alerts.feedback', ['field' => 'merchandiser'])

                    </div>
                  </div>
                </div>

                
                <div class="row select_margin">
                  <label class="col-sm-2 col-form-label">{{ __('Months') }}</label>
                  <div class="col-sm-7">
                   <select class="form-control selectpicker" data-style="select-with-transition" title="Select Months" data-size="7" name="month[]" id="select-month" 
                     value="{{ old('month') }}" aria-required="true" required multiple="multiple" >
                      <option value="" disabled> Select Multiple</option>

                      <option value="1" @if (old('month')=="1") {{ 'selected' }} @endif >January</option>
                      <option value="2" @if (old('month')=="2")) {{ 'selected' }} @endif  >February</option>
                      <option value="3" @if (old('month')=="3")) {{ 'selected' }} @endif >March</option>
                      <option value="4" @if (old('month')=="4")) {{ 'selected' }} @endif >April</option>
                      <option value="5" @if (old('month')=="5")) {{ 'selected' }} @endif >May</option>
                      <option value="6" @if (old('month')=="6")) {{ 'selected' }} @endif >June</option>
                      <option value="7" @if (old('month')=="7")) {{ 'selected' }} @endif >July</option>
                      <option value="8" @if (old('month')=="8")) {{ 'selected' }} @endif >August</option>
                      <option value="9" @if (old('month')=="9")) {{ 'selected' }} @endif >September</option>
                      <option value="10" @if (old('month')=="10")) {{ 'selected' }} @endif >October</option>
                      <option value="11" @if (old('month')=="11")) {{ 'selected' }} @endif >November</option>
                      <option value="12" @if (old('month')=="12")) {{ 'selected' }} @endif >December</option>    

                    </select>
                     @include('alerts.feedback', ['field' => 'month'])
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

    // var currentMonth = new Date().getMonth() + 1;
    // alert(currentMonth);

      // $(".selectpicker option").each(function() {
      //   if ($(this).val() <= currentMonth) {
      //       $(this).prop("disabled",true);
      //       // if($(this).val() == 12){
      //       //     $(this).prop("disabled",true);
      //       // }

      //   }
      // });


      $(".follow").on("submit", function(){
        return confirm("Are you sure you want to follow current month timesheets to your selected months?");
    });

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

      var employee_id = $("#merchandiser").val();
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
