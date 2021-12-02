<style>
.sorting_disabled {
    display:block !important;
}
.display-block{
     display:table-cell !important;
}
.btn-action{
     padding: 0px 0px !important;
}
.view-edit{
  padding: 10px 15px !important;
  margin: 0.3125rem 1px !important;
}

 .borderless tr, .borderless td, .borderless th {
    border: none !important;
   }

td
{
    white-space:nowrap !important;
}
table#datatables {
  text-align: center !important;
}

.dt-buttons {
    float: right;
}

</style>

@extends('layouts.app', ['activePage' => 'emp-overall-attendance', 'menuParent' => 'Attendance', 'titlePage' => __('Employee Attendance')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
          <div class="col-lg-3">
        <span style="color:#990000;font-weight: bold;"> AL </span> -  ANNUAL LEAVE	

	
          </div>
          <div class="col-lg-3">
        	<span style="color:#ff0000;font-weight: bold;">SL </span> - SICK LEAVE	 	

	
          </div>
          <div class="col-lg-3">
          <span style="color:red;font-weight: bold;">LOP </span>- LOSS OF PAY		

          </div>
          <div class="col-lg-3">
        	<span style="color:blue;font-weight: bold;">WD </span>- WORKING DAY   
         
          </div><br>
          <div class="col-lg-3">
          <span style="color:green;font-weight: bold;"> WF </span> - WEEKLY OFF
          
          </div>
          <div class="col-lg-3">
          <span style="color:orange;font-weight: bold;"> PH  </span>- PUBLIC HOLIDAY
        
            </div>

          <div class="col-lg-3">
          <span style="color:gray;font-weight: bold;">ML  </span>- MATERNITY LEAVE
        
          </div>

          <div class="col-lg-3">
          <span style="color:pink;font-weight: bold;">AB  </span>- ABSENT
        
          </div>


          </div>
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">group</i>
                </div>
                <h4 class="card-title">{{ __('Employee Over All Attendance') }}</h4>
              </div>
              <div class="card-body">
             
                <!--<div class="row">
                    <div class="col-12 text-right">
                      <a href="{{ route('attendance.create') }}" class="btn btn-sm btn-rose">{{ __('Employee Attendance ') }}</a>
                    </div>
                  </div>-->
                 

<!-- <table class="table table-striped table-no-bordered table-hover">
    

</table> -->
<form method="post" enctype="multipart/form-data" action="{{ url('overall_atterndance_details') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')
                
         <div class="row">
         <label  class="col-sm-2 col-form-label">{{ __('Month :') }}</label>
                  <div class="col-sm-2">
                    <div class="form-group{{ $errors->has('month') ? ' has-danger' : '' }}">
                   
                      <select class="form-control{{ $errors->has('month') ? ' is-invalid' : '' }}" name="month" id="input-month" 
                      value="{{ old('month') }}" aria-required="true">
                      <!-- <option value="">Select</option> -->
                      <option @if($Month=='01'){{'selected'}} @endif value="01">Janaury</option>
                      <option @if($Month=='02'){{'selected'}} @endif value="02">February</option>
                      <option @if($Month=='03'){{'selected'}} @endif value="03">March</option>
                      <option @if($Month=='04'){{'selected'}} @endif value="04">April</option>
                      <option @if($Month=='05'){{'selected'}} @endif value="05">May</option>
                      <option @if($Month=='06'){{'selected'}} @endif value="06">June</option>
                      <option @if($Month=='07'){{'selected'}} @endif value="07">July</option>
                      <option @if($Month=='08'){{'selected'}} @endif value="08">August</option>
                      <option @if($Month=='09'){{'selected'}} @endif value="09">September</option>
                      <option @if($Month=='10'){{'selected'}} @endif value="10">October</option>
                      <option @if($Month=='11'){{'selected'}} @endif value="11">November</option>
                      <option @if($Month=='12'){{'selected'}} @endif value="12">December</option>
                   
                      </select>
                   
                      @include('alerts.feedback', ['field' => 'year'])
                    </div>
                  </div>
                  <label class="col-sm-2 col-form-label">{{ __('Year :') }}</label>
                  <div class="col-sm-2"> 
                   
                    <select class="form-control{{ $errors->has('year') ? ' is-invalid' : '' }}" name="year" id="input-year" 
                    value="{{ old('year') }}" aria-required="true">
                    <!-- <option value=" ">Select</option> -->
                    <option  @if($Year=='2021'){{'selected'}} @endif value="2021">2021</option>
                    <option  @if($Year=='2022'){{'selected'}} @endif value="2022">2022</option>
                    <option  @if($Year=='2023'){{'selected'}} @endif value="2023">2023</option>
                    <!-- <option  @if($Year=='2024'){{'selected'}} @endif value="2024">2024</option>
                    <option  @if($Year=='2025'){{'selected'}} @endif value="2025">2025</option>
                    <option  @if($Year=='2026'){{'selected'}} @endif value="2026">2026</option>
                    <option  @if($Year=='2027'){{'selected'}} @endif value="2027">2027</option>
                    <option  @if($Year=='2028'){{'selected'}} @endif value="2028">2028</option>
                    <option @if($Year=='2029'){{'selected'}} @endif value="2029">2029</option>
                    <option @if($Year=='2030'){{'selected'}} @endif value="2030">2030</option> -->
                     </select>
                  </div>

                  <div class="col-sm-2">
                <!-- <a href="/overall_atterndance_details" class="btn btn-rose mx-auto">{{ __('Submit') }}</a> -->
                <b><button type ="submit" class="btn btn-info btn-sm ">Submit</button></b>
                </div>

         </div>
     </form>


               <div class="table-responsive">
                  <table id="datatables" class="table table-striped table-no-bordered table-hover" style="display:none">
                   
                  {!! html_entity_decode($attendancetable) !!}

                  </table>
                </div>
              </div>
            </div>
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

    $(document).ready(function() {
        var month = $('#input-month').val();
        var year = $('#input-year').val();

        var days = Getdays(month, year);
      function Getdays(month,year) {
         return new Date(year, month, 0).getDate();
      }

     var exportcount = "";
     
      var TotDays = days + 9;
     
      for(i=0;i<TotDays; i++)
      {
       // if(i != 0)
        exportcount += i + ", ";
      }
     //  alert(exportcount);

$('#datatables').fadeIn(1100);
  $('#datatables').DataTable({
    "pagingType": "full_numbers",
    "lengthMenu": [
      [10, 25, 50, -1],
      [10, 25, 50, "All"]
    ],
    targets: [10,11],
    dom: 'lBfrtip',
    // buttons: [
    //             'excel'
    //         ],
    searching: false,
    buttons: [
    {  
        extend: 'excelHtml5',
        className: 'btn-info',
        text: 'Export',
        filename: function(){
            var dt = new Date();
            dt.getDate() + "/" + (dt.getMonth() + 1) + "/" + dt.getFullYear();
            return 'attn-report-' + dt;
        },
        //title: 'alpin_excel',
        exportOptions: {
            modifier: {
                page: 'all'
            },
            columns: [ exportcount ],
            //[0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39],
        }
    }
  ],
    responsive: true,
  });
});

  
  

function daysInMonth(anyDateInMonth) {
    return new Date(anyDateInMonth.getFullYear(), 
                    anyDateInMonth.getMonth()+1, 
                    0).getDate();}
   
     


  </script>
@endpush
