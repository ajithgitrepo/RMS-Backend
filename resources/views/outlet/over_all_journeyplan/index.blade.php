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


table {
  font-family: Arial, Helvetica, sans-serif;
  width: 600px;
  /* border-collapse;
  collapse; */
}
 td,
 th {
  font-size: 12x; 
  border: 1px solid #4D365B;
  padding: 3px 7px 2px 7px;
}
 th {
  font-size: 14px;
  text-align: left;
  padding-top: px;
  padding-bottom: 4px;
  background-color: #4D365B;
  color: #918CB5;
}
 td {
  color: #000000;
  /* background-color: #979BCA; */
}
.highlight {
    background: #ccc !important;
    border: 10px solid !important;
    outline: #E8EB07 solid 5px;
  
}

</style>

@extends('layouts.app', ['activePage' => 'over_all_journeyplan', 'menuParent' => 'My-Timesheets', 'titlePage' => __('over_all_journeyplan')])

@section('content')
  <div class="content">
    <div class="container-fluid">
    <div class="row">
          <!-- <div class="col-lg-3">
        <span style="color:#990000;font-weight: bold;"> AL </span> -  ANNUAL LEAVE	

          </div> -->
          <div class="col-lg-3"></div>
          <div class="col-lg-3">
        	<span style="color:green;font-weight: bold;">Green </span> - Scheduled Plan	 	

          </div>
          <div class="col-lg-3">
          <span style="color:red;font-weight: bold;">Red </span>- Not Yet Schedule.		

          </div>
          <!--  <div class="col-lg-3">
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
       
          </div>-->


          </div> 
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">group</i>
                </div>
                <h4 class="card-title">{{ __('over_all_journeyplan') }}</h4>
              </div>
              <div class="card-body">
             
                <!--<div class="row">
                    <div class="col-12 text-right">
                      <a href="{{ route('attendance.create') }}" class="btn btn-sm btn-rose">{{ __('Employee Attendance ') }}</a>
                    </div>
                  </div>-->
                 

<!-- <table class="table table-striped table-no-bordered table-hover">
    

</table> --> 
<form method="post" enctype="multipart/form-data" action="{{ url('overall_journey_details') }}" autocomplete="off" class="form-horizontal">
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
                  <table cellpadding="10" id="datatables" class="table table-striped table-no-bordered table-hover" style="display:none">
                   
                  {!! html_entity_decode($joureytable['table']) !!}

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

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.2/select2.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.2/select2.js"></script>
  <script>





 $(document).ready(function () {
   
   
       });

//        $("input[type=checkbox]").change(function() {
//         alert('$el');
//     var $el = $(this);
//     $('input[type=checkbox]').attr("disabled", $(this).is(":checked"));
//     $(this).attr('disabled', 'false'); 
//     // if ($el.is(":checked")) {
//     //     $el.siblings().prop("disabled",true);
//     // }
//     // else {
//     //     $el.siblings().prop("disabled",false);
//     // }
// });
       
       $('table.table input[type=checkbox]').click(function () { //alert();
    $(this).closest('tr').toggleClass("highlight", this.checked);

   
    //$('input[type=checkbox]').attr("disabled", $(this).is(":checked"));
        // $(this).attr('disabled', 'false'); 
});
        


// setTimeout(function() {
//   //
//   // $('.material-icons').click();
//   }, 100);



md = {
  misc: {
    navbar_menu_visible: 0,
    active_collapse: true,
    disabled_collapse_init: 0,
  },

  
  showNotification: function(from, align, message) {  //alert();
    type = ['secondary', 'info', 'danger', 'success', 'warning', 'rose', 'primary','dark',];

    color = Math.floor((Math.random() * 6) + 1);

    $.notify({
      icon: "add_alert",
      message: message

    }, {
      type: type[color],
      timer: 10,
      placement: {
        from: from,
        align: align
      }
    });
  },

}

$(".jSelectbox").select2({
  containerCssClass: "error",
  dropdownCssClass: "test"
});

   $(document).ready(function() { //md.showNotification('top','right');
      //init DateTimePickers
     // md.initFormExtendedDatetimepickers();
     Bind_Employees(); 
    });

    // function myFunction(out_id,date,ths)
    // {
    // $test =  $(ths).find('td:eq(0)').text();

    //    alert($test); 
    //   ///  md.showNotification('top','r ight');

    // } 
  $('.tr').on('click',function(event){ 
          

      if(event.target.type != "checkbox")
      {
         var value = $(event.target).closest('td').attr('class'); 
      //   alert();
          if (typeof value === "undefined" || value == "t_outlet sorting_1" || value == "sorting_1" ) {
               return false;
          }
            
       /*   $(this).find('td').each( function( index, element ) {
            if($(element).closest('td').attr('class') == "bg-success")
            {
                  //  alert('v');
                  $(element).closest('td').removeClass('bg-success');
                  $(element).closest('td').addClass('bg-danger');

         //  $(this).find('td:eq(1)').append('<select class="jSelectbox employeeddl"><option value=''>Add Merchandiser &nbsp;&nbsp;&nbsp;</option><select>');
            }
      //  $(element).closest('td').removeClass('bg-success');
      //  $(element).closest('td').addClass('bg-danger');
    } );   */
 ///   $(element).closest('td').addClass('bg-danger');

         // $(event.target).find('td').removeClass('bg-success').addClass( 'bg-danger' );  
              //alert('v');  
        //  return true; 
        //  alert(event.target);
      //  event.target.type = ""
         // cell = $(this).closest("td").val(),
        //   alert(cell);
        if($(event.target).closest('td').find('a#BtnDelete').attr('id') == "BtnDelete")
        {
               var checkstr =  confirm('are you sure you want to remove this?');
          if(checkstr == true){
            var outlet_id =  ($(this).find('td:eq(1) input[type=hidden]').val());

           var emp_id = ($(this).find('td:eq(2) input[type=hidden]').val());

           var month = $('#input-month').val();
          var year = $('#input-year').val();

           var csrf = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/remove_over_journey_plan', 
                type: 'post',
                data: {outlet_id : outlet_id, emp_id : emp_id, month : month,  year : year, '_token': csrf},
                dataType: 'json',
                success: function( data ) {
               //  alert(data);
                //  swal("Success!", "updated successfully!", "success");
                
                md.showNotification('top','right',"removed Successfully");
                location.reload();
                return false;
                }       
            })


         //  alert(outlet_id);
          }else{
          return false;
          }
          return false;
        }
         if(event.target.type != "select-one")
         {

          var day = $(event.target).closest('td').html();
          if(day.toString().length < 2)
          day = "0"+day;

          var month = $('#input-month').val();
          var year = $('#input-year').val();
          outletDate = year + "-" + month + "-" + day; //alert(outletDate);

          var dateString = outletDate;

        var myDate = new Date(dateString);
        var today = new Date();
        if ( myDate < today ) { 
            alert('You can not change past journey plan!');
            return false;
        }
       
         var tdcolor = $(event.target).closest('td').attr('class');
         
         //.css("background-color");
      // alert(tdcolor);
           var outlet_id =  ($(this).find('td:eq(1) input[type=hidden]').val());

           var emp_id = ($(this).find('td:eq(2) input[type=hidden]').val());
            
            if(emp_id == "")
            {
              emp_id = ($(this).find('td:eq(2) select.employeeddl').val());
             
            }
         //   alert(emp_id);
            if(emp_id == "")
            {
            alert('Please select merchandiser');
            return false;
            }
            else
            $(this).find('td:eq(2) select.employeeddl').prop('disabled', true);

            if(tdcolor == "bg-danger")
          $(event.target).closest('td').removeClass('bg-danger').addClass( 'bg-success' );
          if(tdcolor == "bg-success")
          $(event.target).closest('td').removeClass('bg-success').addClass( 'bg-danger' );

          var csrf = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/add_over_journey_plan', 
                type: 'GET',
                data: {outlet_id : outlet_id, emp_id : emp_id, outletDate : outletDate, '_token': csrf},
                dataType: 'json',
                success: function( data ) {
               //  alert(data);
                //  swal("Success!", "updated successfully!", "success");
                if(tdcolor == "bg-danger")
                md.showNotification('top','right',"Added Successfully");
                if(tdcolor == "bg-success")
                md.showNotification('top','right',"removed Successfully");

                }       
            })

         }

       } // $('#incidentId').val($(this).find('td').first().text());
    })
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    function Bind_Employees()
    {
     
      var csrf = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
            url: 'get_all_employees', 
            type: 'GET',
            data: {'_token': csrf},
            dataType: 'json',
          success: function( data ) {
              // alert(data);
          //   $('#datatables tbody').empty();
             var  response = JSON.stringify(data); 
            //  /  alert(response);
             var trHTML = '';
        $.each(data, function (i, item) {  
            trHTML += '<option value="'+ item.employee_id  +'">(' + item.employee_id  + ') ' + item.first_name  + '   </td>';
          //  trHTML += '<td class="leave_cell_value">' + item.Annual_Leave  + '</td>'; ' + item.surname  + '
           // alert(trHTML);
           
            trHTML += '</option>';

        });

        $("select.employeeddl").append(trHTML);
       
            //  swal("Success!", "updated successfully!", "success");
              // alert(JSON.stringify(data[0]['id']));

          //   $("#passport_no").html(': '+data[0]['passport_number']);
            //  $("#nationality").html(': '+data[0]['nationality']);
              
            }       
        })

    }

//     $(document).ready(function() {
//   var targeOffsetTop = $('[role="target"]').offset().top;
//   alert(targeOffsetTop);
//   $( document ).scrollTop(targeOffsetTop)();
// });

    
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
    searching: true,
    
    buttons: [
    /*{  
      //  extend: 'excelHtml5',
      //  className: 'btn-info',
       // text: 'Export',
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
    } */
  ],
    responsive: true,
    aaSorting: [[1, "asc"]]
  });
});

  
  

function daysInMonth(anyDateInMonth) {
    return new Date(anyDateInMonth.getFullYear(), 
                    anyDateInMonth.getMonth()+1, 
                    0).getDate();}
   
     


  </script>
@endpush
