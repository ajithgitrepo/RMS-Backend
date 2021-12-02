<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
	<!-- <link href="{{asset('assets/css/components.min.css')}}" rel="stylesheet" type="text/css">	
	<script type="text/javascript" src="{{asset('assets/js/jquery.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>	 -->
	<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.1.2/echarts.min.js"></script> -->

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



  .table .td-actions .btn {
    margin: 0px;
    padding: 1px !important;
}

 .dt-buttons {
        float: right !important;
        margin-left: 20px;
        margin-right: 0px;
      }

  button.dt-button.buttons-excel.buttons-html5.btn-primary {
      border-radius: 5px;
  }

  .boxrow
  {
    border: 2px solid;
    width: 950px;
    position: relative;
    right: -20px;
    height: 75px;
    color: orange;
  }

  .select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #444;
    line-height: 28px;
    margin-right: 122px;
}

</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css"></link>



@extends('layouts.app', ['activePage' => 'audit_trial_details', 'menuParent' => 'audit_trial_details', 'titlePage' => __('audit_trial_details')])

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
                <h4 class="card-title">{{ __('Audit Trial ') }}</h4>
              </div>
              <br>
                <div class="row boxrow">
                    <form method="post" action="{{ url('filter_audit') }}" class="form-inline" enctype="multipart/form-data"  action="" autocomplete="off"  style="text-align: right;">
                   @csrf
                      @method('post')
                 
                       <div class="col-md-2 ">
                         <input type="text"  value = "@if(isset($start_date)){{ $start_date}} @endif" class="form-control datepicker" id="start_date" placeholder="Start Date" name="start_date">
                       </div>
                        <div class="col-md-2">
                         <input type="text"   value = "@if(isset($end_date)){{ $end_date }} @endif"  class="form-control datepicker" id="end_date" placeholder="End Date" name="end_date">
                       </div>

                       <!-- <div class="col-md-2">
                         <select id="input-employee_id" value="{{old('role_id')}}"  class="form-control {{ $errors->has('role_id') ? ' is-invalid' : '' }}" style="width: 100%" name="role_id">
                        <option value="" >Filter By Role</option>
                        <option value="6" @if(isset($role_id) && $role_id=="6"){{"selected"}} @endif >Merchandiser</option>
                        <option value="5" @if(isset($role_id) && $role_id=="5"){{"selected"}} @endif >Field Manager</option>
                        <option value="3" @if(isset($role_id) && $role_id=="3"){{"selected"}} @endif >Human Resource</option>
                         
                 </select> 
                       </div> -->
                   

                       <div class="col-lg-5">
                    
                          <select class="abcd"  data-style="select-with-transition" 
                          title="Select Employee Reporting To" data-size="7" name="reporting_to_emp_id" id="input-reporting_to_emp_id"  
                          value="{{ old('reporting_to_emp_id') }}" aria-required="true" >
                    
                        <option value="" selected >Select Employee</option>
                   
                      
                      </select>
                   
                     
                   </div>
                   <!-- {{ $errors->has('filter_type') ? ' is-invalid' : '' }} -->
                       <div class="col-md-2">
                         <select   class="form-control" style="width: 100%" name="filter_type">
                         <option value="">Filter By Type</option>
                         <option value="Log_In" @if(isset($filter_type) && $filter_type=="Log_In"){{"selected"}} @endif  >Log_In</option>
                        <option value="Log_Out" @if(isset($filter_type) && $filter_type=="Log_Out"){{"selected"}} @endif  >Log_Out</option>
                        <option value="Check_In" @if(isset($filter_type) && $filter_type=="Check_In"){{"selected"}} @endif  >Check_In</option>
                        <option value="Check_Out" @if(isset($filter_type) && $filter_type=="Check_Out"){{"selected"}} @endif  >Check_Out</option>
                        <option value="Visibility" @if(isset($filter_type) && $filter_type=="Visibility"){{"selected"}} @endif  >Visibility</option>
                        <option value="Availability" @if(isset($filter_type) && $filter_type=="Availability"){{"selected"}} @endif  >Availability</option>
                        <option value="share_of_shelf" @if(isset($filter_type) && $filter_type=="share_of_shelf"){{"selected"}} @endif  >share_of_shelf</option>
                        <option value="promotion" @if(isset($filter_type) && $filter_type=="promotion"){{"selected"}} @endif  >promotion</option>
                        <option value="Expiry_Stock" @if(isset($filter_type) && $filter_type=="Expiry_Stock"){{"selected"}} @endif  >Expiry_Stock</option>
                        <option value="Planogram" @if(isset($filter_type) && $filter_type=="Planogram"){{"selected"}} @endif  >Planogram</option>
                        <option value="outlet" @if(isset($filter_type) && $filter_type=="outlet"){{"selected"}} @endif  >outlet</option>
                        <option value="Expiry_Stock" @if(isset($filter_type) && $filter_type=="Expiry_Stock"){{"selected"}} @endif  >Expiry_Stock</option>
                        <option value="Leave_status" @if(isset($filter_type) && $filter_type=="Leave_status"){{"selected"}} @endif  >Leave_status</option>
                        <option value="Leave_Request" @if(isset($filter_type) && $filter_type=="Leave_Request"){{"selected"}} @endif  >Leave_Request</option>
                        <option value="journey_plan" @if(isset($filter_type) && $filter_type=="journey_plan"){{"selected"}} @endif  >journey_plan</option>
                        <option value="compititor" @if(isset($filter_type) && $filter_type=="compititor"){{"selected"}} @endif  >compititor</option>

                            
                 </select> 
                       </div>
                       <div class="col-md-1">
                         <button type="submit"  class="btn btn-finish btn-fill btn-danger btn-wd" name="Filter" value="Filter">{{ __('Filter') }}</button>

                       </div>
                    </form>
                    </div>
              
                 <br>
              
                <div class="table-responsive">
                  <table id="datatables" class="table table-striped table-no-bordered table-hover" style="display:none">
                    <thead class="text-primary">
                    
                     <th>
                       {{__('#')}}
                     </th>

                      <th style="width: 100px;">
                          {{ __('Date') }}
                      </th>
                      
                      <th style="width: 100px;">
                          {{ __('Sync Time') }}
                      </th>

                      <!-- <th>
                          {{ __('Ip_address') }}
                      </th> -->

                      <!-- <th>
                          {{ __('Country') }}
                      </th> -->

                       <th align="center">
                        <center>  {{ __('Description') }} </center>
                      </th>
  
                     
                          
                        <!-- <th>
                          {{ __('Status') }}
                      </th> -->


                       <th>
                          {{ __('Device') }}
                      </th>

                      
                      
                     <th class="display-block">
                            {{ __('Action') }}
                        </th>
                     
                    </thead>
                    
                    <tbody>

                      @php

                        $i=1
                       
                      @endphp
                      
              	       
                               
                      @foreach($audit as $audi)
                     
                        <tr>
                        <td>
                          {{$i}}
                        </td>
                         
                          @php 
                          $i++;
                          @endphp

                         <td>
                        
                       {{  date('d-m-Y', strtotime($audi->date))  }}
                        </td>
                         <td>
                         {{ date('g:i a', strtotime($audi->time)) }}
                         
                        </td>

                         <!-- <td>
                          {{$audi->ip_address}}
                        </td> -->

                         <!-- <td>
                          {{$audi->country}}
                        </td>                          -->

                         <td>
                          {{$audi->description}}
                        </td>

                        

                         <!-- <td>
                          {{$audi->status}}
                        </td> -->
                           
                           <td>
                          {{$audi->device}}
                        </td>

                       
                           
                           <td class="display-block">
                              <form action="{{ route('audit_trial_details.destroy', $audi->id) }}" method="post">
                                        @csrf
                                        @method('delete') 
                                         
                                      
                                          <button type="button" class="btn btn-danger btn-link view-edit" data-original-title="" title="" 
                                          onclick="confirm('{{ __("Are you sure you want to delete this audit details?") }}') ? this.parentElement.submit() : ''" >
                                              <i class="material-icons">close</i>
                                              <div class="ripple-container"></div>
                                          </button>
                                      
                               </form>
                           </td> 
              
                          
                          
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

  

@endsection

@push('js')

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
  //$("#input-reporting_to_emp_id").val('6').trigger('change');
});

//$('#input-reporting_to_emp_id').change(function(e) { 
      $(document).ready(function() {
     // {
      //  e.preventDefault();
     
      var SITEURL = "{{ url('/') }}";
    
         // var emp_type = $('#input-employee_id').val();  
          res = "merchandiser";
      //     if(emp_type == 6)
      //     res = "merchandiser";
      //     if(emp_type == 5)
      //     res = "field_manager";
      //     if(emp_type == 3)
      //     res = "hr";

        //  alert(emp_type);
          var csrf = $('meta[name="csrf-token"]').attr('content');
        //  alert(csrf);
            $.ajax({
            url: SITEURL + '/get_merchandiser_for_reportingto', 
            type: 'GET',
            data: { emp_type : res, '_token': csrf },
            dataType: 'json',
        
           success: function( data ) { 
          //  alert(data);
             var  response = JSON.stringify(data); 
           //  alert(response);
      $('#input-reporting_to_emp_id').find('option').remove().end().append('<option value="">select Employee</option>');

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
        dom: 'lBfrtip',
         buttons: [{
            extend: 'excelHtml5',
            className: 'btn-primary',
            text: 'Export',
            filename: function(){
                var dt = new Date();
                dt.getDate() + "/" + (dt.getMonth() + 1) + "/" + dt.getFullYear();
                return 'audit_trial_details-' + dt;
            },
            //title: 'alpin_excel',
            exportOptions: {
                modifier: {
                    page: 'all'
                },
                columns: [0, 1, 2, 3, 4, 5, 6, 7],
            },
          

        }],
       
       select: true,
        responsive: true,
        language: {
          search: "_INPUT_",
          searchPlaceholder: "Search Audit",
        },
        "columnDefs": [
          { "orderable": false, "targets": 5 },
        ],
      });

       
      var myDate = new Date();
var prettyDate = myDate.getDate() + '/' + (myDate.getMonth()+1) + '/' + myDate.getFullYear();
// alert($(".datepicker").val());
 if($(".datepicker").val() != "" )
 {
           // $(".datepicker").val(prettyDate);
            $(".datepicker").datetimepicker({
                  
            format: 'DD-MM-YYYY',
            useCurrent: false,
             defaultDate: false,
            // todayBtn: true,
            // todayHighlight: true,
            });
      }
      else
      {

      //       $(".datepicker").val(''),
           
      //       $(".datepicker").datetimepicker({
                  
      //       format: 'DD-MM-YYYY',
      //      // useCurrent: true,
      //      //  defaultDate:  $(".datepicker").val(),
      //       // todayBtn: true,
      //       // todayHighlight: true,
      //       });

      }
        }); 
   

   
// var bars_basic_element = document.getElementById('bars_basic');
// if (bars_basic_element) {
//     var bars_basic = echarts.init(bars_basic_element);
//     bars_basic.setOption({ 
//         color: ['#3398DB'],
//         tooltip: {
//             trigger: 'axis',
//             axisPointer: {            
//                 type: 'shadow'
//             }
//         },
//         grid: {    
//             left: '3%',
//             right: '4%',
//             bottom: '3%',
//             containLabel: true
//         },
//         xAxis: [
//             {
//                 type: 'category',
//                 data: ['Fruit', 'Vegitable','Grains'],
//                 axisTick: {
//                     alignWithLabel: true
//                 }
//             }
//         ],
//         yAxis: [
//             {
//                 type: 'value'
//             }
//         ],
//         series: [
//             {
//                 name: 'Total Products',
//                 type: 'bar',
//                 barWidth: '20%',
//                 data: [
//                     {{"10"}},
//                     {{"20"}}, 
//                     {{"30"}}
//                 ]
//             }
//         ]
//     });
//     //var tes = JSON.Stringify
//     alert(bars_basic);
// }

  
  </script>
@endpush
