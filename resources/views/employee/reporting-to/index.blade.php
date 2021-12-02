
<style>
/*.sorting_disabled {
    display:block !important;
}*/
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

   .select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #444;
    line-height: 28px;
    margin-right: 122px;
}

</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css"></link>

@extends('layouts.app', ['activePage' => 'employee-reporting', 'menuParent' => 'Employee', 'titlePage' => __('Employee Reporting-to')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">group</i>
                </div>
                <h4 class="card-title">{{ __('Employee Reporting To') }}</h4>
              </div>	
              <div class="card-body">


              <div class="row">
                    <div class="col-lg-12">

                    <form method="post" class="form-inline" enctype="multipart/form-data" action="" autocomplete="off" style="text-align: right;">
              @csrf
              @method('post')
                <div class="col-lg-3">
                    
                         <select class="form-control selectpicker"  data-style="select-with-transition" title="Select Employee" data-size="7" name="employee_id" id="input-employee_id"  value="{{ old('employee_id') }}" aria-required="true" >
                    
                        <option value="" selected >Select Type</option>
                        <option value="field_manager" >  Field Manager</option>
                        <option value="merchandiser" >Merchandiser</option>
                        <option value="hr" >Human Resource</option> 
                   
                       
                         
                      </select>
                   
                     
                   </div>
                     <div class="col-lg-7">
                    
                          <select class="abcd"  data-style="select-with-transition" 
                          title="Select Employee Reporting To" data-size="7" name="reporting_to_emp_id" id="input-reporting_to_emp_id"  
                          value="{{ old('reporting_to_emp_id') }}" aria-required="true" >
                    
                        <option value="" selected >Select</option>
                   
                        <!-- @foreach ($employee as $emp)
                            <option value="{{$emp->reporting_to_emp_id}}" >   
                              {{$emp->employee_reporting_to->first_name }}
                              {{$emp->employee_reporting_to->middle_name }} 
                              {{$emp->employee_reporting_to->surname }} 
                              ({{$emp->reporting_to_emp_id}})</option>
                        @endforeach -->
                         
                      </select>
                   
                     
                   </div>

                   <div class="col-lg-2">
                    <b><button id="BtnSearch" type ="submit" class="btn btn-info btn-sm ">Filter</button></b>
                 </div> 
                   
                 </div> 
              </form>
                      <!-- <a class="btn btn-sm btn-warning" style="color: #fff;" data-toggle="modal" data-target="#FilterModal" >{{ __('Filter') }}</a> -->
                    </div>
                  </div>
                  @canany(['isHuman_Resource','isAdmin','isTopManagement'],App\User::class)
                  <div class="row">
                    <div class="col-12 text-right">
                      <a href="{{ route('employee-reporting.create') }}" class="btn btn-sm btn-rose">{{ __('Add Reporting') }}</a>
                    </div>
                  </div>
                @endcan
                <div class="table-responsive">
                  <table id="datatables" class="table table-striped table-no-bordered table-hover" style="display:none">
                    <thead class="text-primary">
                      <th>
                          {{ __('Employee') }}
                      </th>
                      <th>
                          {{ __('Reporting_To') }}
                      </th>
                     
                       <th>
                          {{ __('Reporting Date') }}
                      </th>
                       <th>
                          {{ __('Reporting End Date') }}
                      </th>
                      
                     
                      <th class="display-block">
                            {{ __('Action') }}
                        </th>

                     
                    </thead>
                    <tbody>

                      @php

                        $i=0

                      @endphp


                    
                      @foreach($employee as $emp)
                     
                        <tr>
                         
                        <td>
                        <a rel="tooltip" style="font-size:15px;font-weight:700" class="btn btn-danger btn-action btn-link view-edit" data-toggle="modal" 
                        data-target="#exampleModal" data-original-title="" title="" onclick="view_employee('{{$emp->employee->employee_id}}')">
                       
                          {{ $emp->employee->first_name.' '.$emp->employee->middle_name.' '.$emp->employee->surname }}
                          ({{$emp->employee->employee_id}})
                                          <div class="ripple-container"></div></a>
                          </td>
                          <td>
                          <a rel="tooltip" style="font-size:15px;font-weight:700" class="btn btn-warning btn-action btn-link view-edit" data-toggle="modal" 
                        data-target="#exampleModal" data-original-title="" title="" onclick="view_employee('{{$emp->employee_reporting_to->employee_id}}')">
                            {{ $emp->employee_reporting_to->first_name.' '.$emp->employee_reporting_to->middle_name.
                            ' '.$emp->employee_reporting_to->surname }}
                            ({{$emp->employee_reporting_to->employee_id}})
                            <div class="ripple-container"></div></a>
                          </td>
                         <!-- <td>
                            {{ $emp->employee->designation}}
                          </td>
                          <td>
                            {{ $emp->employee->department}}
                          </td>
                          <td>
                            {{ $emp->reporting_to_emp_id }}
                          </td>-->
                          <td>
                            {{ date('d-m-Y', strtotime($emp->reporting_date)) }} 
                          </td>
                          <td>
                            {{ date('d-m-Y', strtotime($emp->reporting_end_date)) }} 
                          </td>
                          
                          @canany(['isHuman_Resource','isAdmin','isTopManagement'],App\User::class)

<td class="display-block">
    <form action="{{ route('employee-reporting.destroy', $emp->id ) }}" method="post">
              @csrf
              @method('delete')
              
            <a rel="tooltip" class="btn btn-success btn-action btn-link view-edit" href="{{ route('employee-reporting.edit', 
              $emp->id ) }}" data-original-title="" title="">
                  <i class="material-icons">edit</i>
                  <div class="ripple-container"></div>
                </a>
            
                <button type="button" class="btn btn-danger btn-link view-edit" data-original-title="" title="" onclick="confirm('{{ __("Are you sure you want to delete this leave request?") }}') ? this.parentElement.submit() : ''">
                    <i class="material-icons">close</i>
                    <div class="ripple-container"></div>
                </button>
            
          </form>
      </td> 
      @endcan


                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade bd-example-modal-lg" id="exampleModal"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">More Information</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form>

          <div class="row">
            <div class="col-lg-6">

              <table class="table table-responsive borderless" >
                <tr>
                  <th>Passport Number </th>
                  <td id="passport_no"></td>
                </tr>
                 <tr>
                  <th>Nationality </th>
                  <td id="nationality"></td>
                </tr>
                 <tr>
                  <th>Joining Date  </th>
                  <td id="joining_date"></td>
                </tr>
                 <tr>
                  <th>Passport Expiry Date  </th>
                  <td id="passport_exp_date"></td>
                </tr>
                 <tr>
                  <th>Visa Expiry Date  </th>
                  <td id="visa_exp_date"></td>
                </tr>
               
              </table>

            </div>

             <div class="col-lg-6">
              <table class="table table-responsive borderless">
                <tr>
                  <th>Medical Insurance No. </th>
                  <td id="medical_ins_no"></td>
                </tr>
                <tr>
                  <th>Medical Insurance Expiry Date </th>
                  <td id="medical_ins_exp_date"></td>
                </tr>
                 <tr>
                  <th>Visa Company Name </th>
                  <td id="visa_campany_name"></td>
                </tr>
                 <!-- <tr>
                  <th>Employee Score  </th>
                  <td id="employee_score"></td>
                </tr> -->
               
               
              </table>
            </div>
          </div>


          
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      
      </div>
    </div>
  </div>
</div>

<!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">More Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Passport Number:</label> <span for="recipient-name" class="col-form-label"></span>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Nationality:</label><span for="recipient-name" class="col-form-label"></span>
          </div>
           <div class="form-group">
            <label for="message-text" class="col-form-label">Joining Date:</label><span for="recipient-name" class="col-form-label"></span>
          </div>
           <div class="form-group">
            <label for="message-text" class="col-form-label">Message:</label><span for="recipient-name" class="col-form-label"></span>
          </div>
           <div class="form-group">
            <label for="message-text" class="col-form-label">Message:</label><span for="recipient-name" class="col-form-label"></span>
          </div>
           <div class="form-group">
            <label for="message-text" class="col-form-label">Visa Expiry Date:</label><span for="recipient-name" class="col-form-label"></span>
          </div>
           <div class="form-group">
            <label for="message-text" class="col-form-label">Passport Expiry Date:</label><span for="recipient-name" class="col-form-label"></span>
          </div>
           <div class="form-group">
            <label for="message-text" class="col-form-label">Medical Insurance No.:</label><span for="recipient-name" class="col-form-label"></span>
          </div>
           <div class="form-group">
            <label for="message-text" class="col-form-label">Medical Insurance Expiry Date:</label><span for="recipient-name" class="col-form-label"></span>
          </div>
           <div class="form-group">
            <label for="message-text" class="col-form-label">Visa Company Name:</label><span for="recipient-name" class="col-form-label"></span>
          </div>
           <div class="form-group">
            <label for="message-text" class="col-form-label">Employee Score:</label><span for="recipient-name" class="col-form-label"></span>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      
      </div>
    </div>
  </div>
</div> -->

@endsection

@push('js')

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.full.min.js"></script>
  <script>

$(function () {
  $("#input-reporting_to_emp_id").select2(
    {
    width: '100%',
    allowClear: false,
    height: '100%',
}
  );
});
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    

    $(document).ready(function() {
      $('#datatables').fadeIn(1100);
      $('#datatables').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
        ],
        responsive: true,
        language: {
          search: "_INPUT_",
          searchPlaceholder: "Search employees",
        }

      });
    });

    function view_employee(id){
      //alert(id);
      var csrf = $('meta[name="csrf-token"]').attr('content');
      $.ajax({
          url: '/view_employee',
          type: 'GET',
          data: {id : id, '_token': csrf},
          dataType: 'json',

          success: function( data ) {
             alert(data);

             // alert(JSON.stringify(data[0]['id']));

            $("#passport_no").html(': '+data[0]['passport_number']);
            $("#nationality").html(': '+data[0]['nationality']);
            $("#joining_date").html(': '+data[0]['joining_date'])
            $("#visa_exp_date").html(': '+data[0]['visa_exp_date'])
            $("#passport_exp_date").html(': '+data[0]['passport_exp_date'])
            $("#medical_ins_no").html(': '+data[0]['medical_ins_no'])
            $("#medical_ins_exp_date").html(': '+data[0]['medical_ins_exp_date'])
            $("#visa_campany_name").html(': '+data[0]['visa_company_name'])
            $("#employee_score").html(': '+data[0]['employee_score'])

          }       
      })

    }
    


    $('#input-employee_id').change(function(e) { 
     // {
        e.preventDefault();
     
      var SITEURL = "{{ url('/') }}";
    
          var emp_type = $('#input-employee_id').val();  
        //  alert(emp_type);
          var csrf = $('meta[name="csrf-token"]').attr('content');
        //  alert(csrf);
            $.ajax({
            url: SITEURL + '/get_merchandiser_for_reportingto', 
            type: 'GET',
            data: { emp_type : emp_type, '_token': csrf },
            dataType: 'json',
        
           success: function( data ) { 
            
             var  response = JSON.stringify(data); 
           //  alert(response);
      $('#input-reporting_to_emp_id').find('option').remove().end().append('<option value="">select</option>');

     //$("#input-reporting_to_emp_id").append('<option value="">select<option>');
         var trHTML = '';
         $.each(data, function (i, item) {  // alert(item.first_name );
             trHTML += '<option value="' + item.employee_id  + '">(' + item.employee_id  + ') ' + item.first_name  + '  ' + item.surname  + ' </option>';
         });

        
//alert(trHTML);
          $("#input-reporting_to_emp_id").append(trHTML);

       
            }       
        })
     });

     $('#BtnSearch').click(function (e)
     {
      e.preventDefault(); //alert();
      var SITEURL = "{{ url('/') }}";
          var Empid = $('#input-reporting_to_emp_id').val();

          var type = $('#input-employee_id').val();
          var csrf = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
            url: SITEURL + '/get_result_for_reportingto', 
            type: 'GET',
            data: {Empid : Empid, type : type, '_token': csrf},
            dataType: 'json',

            success: function( data ) {
              // alert(data);

               $('#datatables tbody').empty();
             var  response = JSON.stringify(data); 
       //   alert(response);
             
               var trHTML = '';
        $.each(data, function (i, item) {  
            trHTML += '<tr><td>(' + item.employee_id  + ') ' + item.employee.first_name  + ' ' + item.employee.surname  + ' </td>';
            trHTML += '<td>(' + item.reporting_to_emp_id  + ') ' + item.employee_reporting_to.first_name  + ' ' + item.employee_reporting_to.surname  + ' </td>';
            trHTML += '<td>' + item.reporting_date  + ' </td>';
            trHTML += '<td>' + item.reporting_end_date  + ' </td>';
          //  trHTML += '<td>';
          //  trHTML += "@canany(['isHuman_Resource','isAdmin','isTopManagement'],App\User::class)";

            trHTML +=  '<td class="display-block">';  
                    trHTML += '<form action="{{ route("employee-reporting.destroy", ' + item.employee_id  + ' ) }}" method="post">';
                  trHTML +=  '@csrf';
                  trHTML +=  '@method('delete')';
        // alert(item.employee_id);
        var route = SITEURL + "/employee-reporting/" + item.id + "/edit";
                  trHTML += '<a rel="tooltip" class="btn btn-success btn-action btn-link view-edit" href="'+ route +'" data-original-title="" title="">';
                    trHTML +=    '<i class="material-icons">edit</i>';
                    trHTML +=   '<div class="ripple-container"></div>';
                    trHTML +=    '</a>';
          var route_del = SITEURL + "/employee-reporting/" + item.id + "/destroy";
             trHTML +=  '<button rel="tooltip" class="btn btn-success btn-action btn-link view-edit" data-original-title="" title="">';
             trHTML +=   '<i class="material-icons">close</i>';
           //  trHTML +=   '<div class="ripple-container"></div>';
       //      trHTML +=  '<div class="ripple-container"></div></button>';
             // "<button type='button' class='btn btn-danger btn-link view-edit'  />";
             //  "<button type="button" class="btn btn-danger btn-link view-edit" data-original-title="" title="" onclick="confirm("{{ __("Are you sure you want to delete this leave request?") }}") ? this.parentElement.submit() : '">";
                //    trHTML +=    '<i class="material-icons">close</i>';
                    trHTML +=    '<div class="ripple-container"></div>';
                    trHTML +=  '</button>';
            
                    trHTML +=  '</form>';
                    trHTML += "@endcan";
          
            trHTML += '</td></tr>';

        });

        $('#datatables').dataTable().fnClearTable();
    $('#datatables').dataTable().fnDraw();
    $('#datatables').dataTable().fnDestroy();



        $("#datatables tbody").append(trHTML);

        $('#datatables').fadeIn(1100);
      $('#datatables').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
        ],
        responsive: true,
        language: {
          search: "_INPUT_",
          searchPlaceholder: "Search employees",
        }

      });
       
            //  swal("Success!", "updated successfully!", "success");
              // alert(JSON.stringify(data[0]['id']));

          //   $("#passport_no").html(': '+data[0]['passport_number']);
            //  $("#nationality").html(': '+data[0]['nationality']);
              
            }       
        })
     });




//      $('#input-employee_id').change(function(e) { 
//      // {
//         e.preventDefault();
     
//       var SITEURL = "{{ url('/') }}";
    
//           var emp_type = $('#input-employee_id').val();  
//          // alert(emp_type);
//           var csrf = $('meta[name="csrf-token"]').attr('content');
//         //  alert(csrf);
//             $.ajax({
//             url: SITEURL + '/get_merchandiser_for_reportingto', 
//             type: 'GET',
//             data: { emp_type : emp_type, '_token': csrf },
//             dataType: 'json',
        
//            success: function( data ) { 
            
//              var  response = JSON.stringify(data); 
//             //  alert(response);
//       $('#input-reporting_to_emp_id').find('option').remove().end().append('<option value="">select</option>');

//      //$("#input-reporting_to_emp_id").append('<option value="">select<option>');
//          var trHTML = '';
//          $.each(data, function (i, item) {  // alert(item.first_name );
//              trHTML += '<option value="' + item.employee_id  + '">(' + item.employee_id  + ') ' + item.first_name  + '  ' + item.surname  + ' </option>';
//          });
// //alert(trHTML);
//           $("#input-reporting_to_emp_id").append(trHTML);

       
//             }       
//         })
//      });


  </script>
@endpush
