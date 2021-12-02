
<style>
#email-error {
    height: 30px;
    margin-left: 0px !important;
}
label.col-sm-2.col-form-label {
    font-weight: 900;
    color: crimson;
    /* font-variant: petite-caps; */
}

:root {
  --radius: 2px;
  --baseFg: dimgray;
  --baseBg: white;
  --accentFg: #006fc2;
  --accentBg: #bae1ff;
}

.theme-pink {
  --radius: 2em;
  --baseFg: #c70062;
  --baseBg: #ffe3f1;
  --accentFg: #c70062;
  --accentBg: #ffaad4;
}

.theme-construction {
  --radius: 0;
  --baseFg: white;
  --baseBg: black;
  --accentFg: black;
  --accentBg: orange;
}

select {
  font: 400 12px/1.3 sans-serif;
  -webkit-appearance: none;
  appearance: none;
  color: var(--baseFg);
  border: 1px solid var(--baseFg);
  line-height: 1;
  outline: 0;
  padding: 0.65em 2.5em 0.55em 0.75em;
  border-radius: var(--radius);
  background-color: var(--baseBg);
  background-image: linear-gradient(var(--baseFg), var(--baseFg)),
    linear-gradient(-135deg, transparent 50%, var(--accentBg) 50%),
    linear-gradient(-225deg, transparent 50%, var(--accentBg) 50%),
    linear-gradient(var(--accentBg) 42%, var(--accentFg) 42%);
  background-repeat: no-repeat, no-repeat, no-repeat, no-repeat;
  background-size: 1px 100%, 20px 22px, 20px 22px, 20px 100%;
  background-position: right 20px center, right bottom, right bottom, right bottom;   
}

select:hover {
  background-image: linear-gradient(var(--accentFg), var(--accentFg)),
    linear-gradient(-135deg, transparent 50%, var(--accentFg) 50%),
    linear-gradient(-225deg, transparent 50%, var(--accentFg) 50%),
    linear-gradient(var(--accentFg) 42%, var(--accentBg) 42%);
}

/* select:active {
  background-image: linear-gradient(var(--accentFg), var(--accentFg)),
    linear-gradient(-135deg, transparent 50%, var(--accentFg) 50%),
    linear-gradient(-225deg, transparent 50%, var(--accentFg) 50%),
    linear-gradient(var(--accentFg) 42%, var(--accentBg) 42%);
  color: var(--accentBg);
  border-color: var(--accentFg);
  background-color: var(--accentFg);
} */
</style>

@extends('layouts.app', ['activePage' => 'reliever', 'menuParent' => 'Reliever', 'titlePage' => __('Reliever')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" id="form_submit" action="{{ route('reliever.store') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">event</i>
                </div>
                <h4 style="color:blue; font-weight: 900;" class="card-title">{{ __('ADD RELIEVER') }}</h4>
              </div>
              <div class="card-body ">
                
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a id= "btn_back" href="{{ route('reliever.index') }}" class="btn btn-sm btn-rose">{{ __('Back to Reliever') }}</a>
                  </div>
                </div>

                <!-- <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Role') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('role') ? ' has-danger' : '' }}">
                    
                    <select class="form-control{{ $errors->has('role') ? ' is-invalid' : '' }}" name="role" id="input-role" 
                     value="{{ old('role') }}" aria-required="true">
                       <option value=" ">Select</option>
                       
                        <option value="Merchandiser">Merchandiser</option>
                      
                    </select>
                   
                      @include('alerts.feedback', ['field' => 'role'])
                    </div>
                  </div>
                </div> -->
                
                
                <div class="row">
                  <label class="col-sm-2 col-form-label"><b>{{ __('Merchandiser :') }}</b></label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('employee_id') ? ' has-danger' : '' }}">
                    
                   
                      <select required="" class="theme-pinkf{{ $errors->has('employee_id') ? ' is-invalid' : '' }}" name="employee_id" id="employee_id" 
                     value="{{ old('employee_id') }}" aria-required="true">
                       <option value="">Select Merchandiser</option>
              					 @foreach($employee as $emp)
              						<option value="{{ $emp->employee_id }}">{{ $emp->first_name }} {{ $emp->surname }}
                           ({{ $emp->employee_id }}) </option>
              						@endforeach
                  		</select>

                      @include('alerts.feedback', ['field' => 'employee_id'])
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('From Date :') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('from_date') ? ' has-danger' : '' }}">
                    <input required="" type="text" class="form-control datepicker" id="from_date" placeholder="Select From Date" name="from_date">
                      @include('alerts.feedback', ['field' => 'from_date'])
                    </div>
                  </div>
                </div>

                  <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('To Date :') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('to_date') ? ' has-danger' : '' }}">
                    <input required="true" type="text" class="form-control datepicker" id="to_date" placeholder="Select To Date" name="to_date">
                      @include('alerts.feedback', ['field' => 'to_date'])
                    </div>
                  </div>
                </div>

      <center> 
      <button id="BtnSearch" type="submit" class="btn btn-round btn-primary btn-sm">{{ __('Search Reliever') }}</button>
      <div style="color:red;" id="load" style="display:none">
           Please wait... 
    <img src="//s.svgbox.net/loaders.svg?fill=maroon&ic=tail-spin" 
         style="width:24px">
</div>
      </center>   
     
                
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Reliever :') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('reliever_id') ? ' has-danger' : '' }}">
                     
                     <select required="true" class="theme-pinkf{{ $errors->has('reliever_id') ? ' is-invalid' : '' }}" name="reliever_id" id="reliever_id" 
                     value="{{ old('reliever_id') }}" aria-required="true">
                        <option value="">Select Reliever</option>
					                
                         		</select>
                    
                      @include('alerts.feedback', ['field' => 'reliever_id'])
                    </div>
                  </div>
                </div>

                 <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Reason :') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('reason') ? ' has-danger' : '' }}">
                      <textarea required="true" cols="20" rows="2" class="form-control{{ $errors->has('reason') ? ' is-invalid' : '' }}" name="reason" id="input-reason" type="text" placeholder="{{ __('Enter the reason') }}"  aria-required="true">{{ old('reason') }}</textarea>
                      @include('alerts.feedback', ['field' => 'reason'])
                    </div>
                  </div>
                </div>
              
                <div class="card-footer ml-auto mr-auto">
                <button id="Btnsubmit" type="submit" class="btn btn-github mx-auto">{{ __('Save') }}</button>
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
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('#Btnsubmit').click(function (e)  
    { 
      if( $('#reliever_id').val() == "" || $('#input-reason').val() == "" || $('#from_date').val() == "" || $('#to_date').val() == "" || $('#employee_id').val() == "" )
      return true;
      e.preventDefault();
     
      swal({
  title: "Are you sure?",
  text: "Do you want to change reliever.",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes, change it !",
  cancelButtonText: "No, cancel!",
  closeOnConfirm: false,
  closeOnCancel: false
})
.then((willDelete) => {
  
  var  response = JSON.stringify(willDelete); 
  var jsonStr =  "[" + response + "]";            //  '[{"dismiss":"client_id"}]';
  var obj = JSON.parse(jsonStr);
  var check = obj[0].dismiss;
   // redirect with javascript here as per your logic after showing the alert using the urlToRedirect value
  if (check  !=  "cancel" ) {
  
   
    var SITEURL = "{{ url('/') }}";
       var from_date = $('#from_date').val();
       var to_date = $('#to_date').val();
       var emp_merch_id = $('#employee_id').val();
       var reliever_id = $('#reliever_id').val();
       var reason = $('#input-reason').val();
       var csrf = $('meta[name="csrf-token"]').attr('content');
       
            $.ajax({
            url: SITEURL + '/insert_merchandiser_for_reliver', 
            type: 'GET',
            data: { reliever_id : reliever_id, reason : reason, employee_id : emp_merch_id, from_date : from_date, to_date : to_date,'_token': csrf },
            dataType: 'json',
           success: function( data ) {
            
              swal({
               // title: "Wow!",
                text: "Reliever created successfully!",
                type: "success"
            }).then(function() {
              // $('#btn_back').click();
              var SITEURL = "{{ url('/') }}";
              window.location = SITEURL + "/reliever";
            });
           
            }       
        }); 
   
  } else {
    //swal("Cancelled", "Your imaginary file is safe :)", "error");
  
}

});
    });

      $('#BtnSearch').click(function (e) 
     {
      var startDate = new Date($('#from_date').val());
var endDate = new Date($('#to_date').val());

      if (startDate > endDate){
      alert("To date must be greater than start date");
      return false;
      }
       
        if($('#from_date').val() == "" || $('#to_date').val() == "" || $('#employee_id').val() == "" )
         return true;
         e.preventDefault();
    //  $('#BtnSearch').prop('disabled', true);
      $("#load").show();
      var SITEURL = "{{ url('/') }}";
     //  alert();
     //  e.preventDefault();
          var from_date = $('#from_date').val();
          var to_date = $('#to_date').val();
          var emp_merch_id = $('#employee_id').val();
       //   alert(to_date);
          var csrf = $('meta[name="csrf-token"]').attr('content');
        //  alert(csrf);
            $.ajax({
            url: SITEURL + '/get_merchandiser_for_reliver', 
            type: 'GET',
            data: { emp_merch_id : emp_merch_id, from_date : from_date, to_date : to_date,'_token': csrf },
            dataType: 'json',
        
           success: function( data ) { 
              $('#BtnSearch').prop('disabled', false);
            $("#load").hide();
            if(data == "No_Time_sheet"){
            alert("No Time sheet allocated for that specific date for merchandiser " + $('#employee_id option:selected').html());
             return false;
            }
            //  alert(data.length);
            
             var  response = JSON.stringify(data); 
            //  alert(response);
  $('#reliever_id').find('option').remove().end().append('<option value="">select</option>');

    if(data == "")
    alert("No merchandiser available for that specific date");
    else
    alert(data.length + " merchandiser available for that specific date");

  //$("#reliever_id").append('<option value="">select<option>');
         var trHTML = '';
         $.each(data, function (i, item) {  // alert(item.first_name );
             trHTML += '<option value="' + item.employee_id  + '">(' + item.employee_id  + ') ' + item.first_name  + '  ' + item.surname  + ' </option>';
         });

          $("#reliever_id").append(trHTML);

         
       
            }       
        })
     });

// $('#employee_id').on('change', function () {
//   //ways to retrieve selected option and text outside handler
//   //alert('Changed option value ' + this.value);
//  // console.log('Changed option text ' + $(this).find('option').filter(':selected').text());
//  $("#reporting_employee_id option").removeAttr('disabled');
//  $("#reporting_employee_id option[value='"+ this.value + "']").attr("disabled", true);;
// });

    $(document).ready(function (event) {

      // $('.datepicker').datetimepicker({
      //   useCurrent: false
      // });
      var dateToday = new Date();
      $("#load").hide();
      $(".datepicker").datetimepicker({
        minDate: dateToday ,
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