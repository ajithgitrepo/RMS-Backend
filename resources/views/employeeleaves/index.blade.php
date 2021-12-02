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

   .sorting, .sorting_asc, .sorting_desc {
    background : none;
}

</style>

@extends('layouts.app', ['activePage' => 'employee-leaves', 'menuParent' => 'Employee', 'titlePage' => __('Employee Leaves')])

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
                <h4 class="card-title">{{ __('Employee Leaves') }}</h4>
              </div>
              <div class="card-body">
             
                <!--<div class="row">
                    <div class="col-12 text-right">
                      <a href="{{ route('employeeleaves.create') }}" class="btn btn-sm btn-rose">{{ __('Employee Leaves ') }}</a>
                    </div>
                  </div>-->

                  <div class="row">
                    <div class="col-12 text-right">
                       <a  class="btn btn-sm btn-warning" id="btn">{{ __('Select Fileds To Filter') }}</a>
                    </div>
                  </div>

 				@canany(['isHuman_Resource'],App\User::class)   

                  <!-- <a  id="BtnExcel" class="btn btn-primary text-white pull-right"> Send to Approval</a> -->
        <!-- <a  id="BtnApproveAll" class="btn btn-primary text-white pull-right"> Approval All</a> -->

                @endcan
                 
                 
                <div class="table-responsive">
                  <table id="datatables" class="table table-striped table-no-bordered table-hover" style="display:none">
                    <thead class="text-primary">
                    <!-- <th>
          <button type="button" id="selectAll" class="main">
          <span class="sub"></span> Select </button></th>-->
                      <th> 
                          {{ __('#') }}
                      </th>
                      <th style="width: 150px;">
                          {{ __('Employee Name') }}
                      </th>
                      <th style="width: 120px;">
                          {{ __('Leave Type') }}
                      </th>
                      <th style="width: 100px;">
                          {{ __(' Start Date') }}
                      </th>
                      <th style="width: 100px;">
                          {{ __(' End Date') }}
                      </th>
                      <th>
                          {{ __('Reason') }}
                      </th>
                      <th>
                          {{ __('Supporting Documents') }}
                      </th>
                     @canany(['isHuman_Resource'],App\User::class)   
                      <th>
                          {{ __('Action') }}
                      </th>
                    @endcan
                   
                        
                    </thead>
                    
                    <tbody>

                      @php

                        $i=1

                      @endphp
                 
                      @foreach($employeeleaves as $leave)
   
                        <tr>
                    
          <!-- <td><input type="checkbox"/>
             
        </td> -->
                          <td>
                            {{ $i++ }}
                            <input type="hidden" id="HidLeaveID" value="{{$leave->lrid}}"></input>
                          </td>
                          <td>
                            {{ $leave->employee->first_name }} {{ $leave->employee->middle_name }} {{ $leave->employee->surname }} ({{ $leave->employee->employee_id }} )
                          </td>
                          <td>
                             @php

                              $res = ""; 
                             if($leave->leavetype == "") 
                             $res = "no";
                            if($leave->leavetype == "Sick_Leave")
                             $res = "Sick Leave";
                             if($leave->leavetype == "Sick Leave")
                             $res = "Sick Leave";
                             if( $leave->leavetype == "Loss_Of_Pay")
                             $res = "Loss of Pay";
                             if( $leave->leavetype == "Maternity_Leave")
                             $res = "Maternity Leave";
                             if( $leave->leavetype == "Annual_Leave")
                             $res = "Annual Leave";
                             if( $leave->leavetype == "Week OFF")
                             $res = "Week OFF";

                               
                             @endphp
                             
                            <span>{{ $res }} </span>
                           
                          </td>
                          <td>
                           {{ date('d-m-Y', strtotime($leave->leavestartdate)) }}
                         </td>
                           <td>
                             {{ date('d-m-Y', strtotime($leave->leaveenddate)) }}
                           </td>
                          <td>
                            {{ $leave->reason }}
                          </td>
                          
                         <td class="td-actions text-center"> 

                         @if($leave->supportingdocument == null || $leave->supportingdocument == "" )

                             {{__('-')}}

                         @endif

                         @if(($leave->supportingdocument !== null))

                             <a  rel="tooltip" onclick="show_documents('{{$leave->lrid}}')"  class="btn btn-info" title="View">
                              <i class="material-icons">visibility</i>
                            </a>

                         @endif


                          </td>
                          
                           @if(($leave->is_approved=="0" && $leave->is_rejected=="0") || ($leave->is_approved=="1"  && $leave->is_rejected !="1") )
                          
                        
                         <td>

                          
                        <a href="{{ url('approved',  ['pid' => $leave->lrid, 'type' => $leave->leavetype] ) }}" 
                        class="btn btn-sm btn-success">{{ __('Accept') }}</a>

                         <a href="{{ url('rejected',$leave->lrid) }}" class="btn btn-sm btn-danger">{{ __('Reject') }}</a>

      			       </td>  
                              
      			       @endif  

                              
			   			   
                    	 @if( $leave->is_approved=="2" )

                    	<td>
                    	
                             <button type="submit" class="btn btn-sm btn-success" >Accepted</button>

                    	</td>
                    	
                    	 @endif
                    	 
                    	 @if($leave->is_rejected=="1")
                    	
                    	 <td>
                    	 
                             <button type="submit" class="btn btn-sm btn-danger">Rejected</button>

                    	 </td>

                         
	
	                  @endif 
                         
                          @can('update', App\User::class)

                          <td class="display-block">
                              <form action="{{ route('leaverequest.destroy', $leave->lrid) }}" method="post">
                                        @csrf
                                        @method('delete')
                          <a rel="tooltip" class="btn btn-success btn-action btn-link view-edit" href="{{ route('leaverequest.edit',$leave->lrid) }}"
                           data-original-title="" title="">
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

   <div class="modal fade bd-example-modal-lg" id="DocumentModal"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Supporting Documents</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form>

          <div class="row" id="documents">
             <!--  <object data="/leavedocuments/Merchandising solution.pdf" type="application/pdf" width="300" height="200">
                <a href="/leavedocuments/Merchandising solution.pdf">test.pdf</a>
              </object> -->
             
              <!--   <div class="col-lg-6">
                <embed style="margin-bottom: 10px;" src="/leavedocuments/Merchandising solution.pdf" width="300" height="200" /><br>

                 <a style="font-size: 30px;" href="/leavedocuments/Merchandising solution.pdf" target="_blank"><i class="fa fa-download"></i></a>
               </div>

               <div class="col-lg-6">
                 <embed style="margin-bottom: 10px;" src="/leavedocuments/Webp.net-resizeimage.png" width="300" height="200" /><br>

                 <a style="font-size: 30px;" href="/leavedocuments/Webp.net-resizeimage.png" target="_blank"><i class="fa fa-download"></i></a>
              </div> -->



          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      
      </div>
    </div>
  </div>
</div>



 
<div class="modal fade" id="modelWindow" role="dialog">
            <div class="modal-dialog modal-lg vertical-align-center">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title"><b> Filter Options</b></h4>
                </div>
                <div class="modal-body">
                
                 <form method="post" enctype="multipart/form-data" action="{{ url('filtervaluesnew') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')
                
                
                <div class="row">
                  <div class="col-sm-3">
                     <div class="form-group">
                          <label for="" class="bmd-label-floating">Employee ID </label>
                          <input type="text" class="form-control" id="Txtemployee_id" name="employee_id" value="{{ $employee_id }}" >
                           @include('alerts.feedback', ['field' => 'employee_id'])
                     </div>
                   </div>
                  
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('status') ? ' has-danger' : '' }}">
                 
                       <select class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" name="status" id="status" 
                        value="{{ old('status') }}" >
                     
                       <option value="">Select</option>
                       <option value="Approved">Approved</option>
                       <option value="Rejected">Rejected</option>
                      </select>
                   
                     @include('alerts.feedback', ['field' => 'role'])
                    </div>
                  </div>
                  
                  <div class="col-sm-2">
                    <div class="form-group{{ $errors->has('startdate') ? ' has-danger' : '' }}">
                     <input class="form-control datepicker{{ $errors->has('startdate') ? ' is-invalid' : '' }}" name="startdate" id="input-startdate" type="text" placeholder="{{ __('From date') }}" value="{{ $startdate }}" >
                     
                    </div>
                  </div>
                  
                  <div class="col-sm-2">
                    <div class="form-group{{ $errors->has('enddate') ? ' has-danger' : '' }}">
                     <input class="form-control datepicker{{ $errors->has('enddate') ? ' is-invalid' : '' }}" name="enddate" id="input-enddate" type="text" placeholder="{{ __('To date') }}" value="{{ $enddate }}"  >
                    
                    </div>
                  </div>
                  
                    <b><button type ="submit" class="btn btn-info btn-sm ">Filter</button></b>
                   
                 </div>          
               </form>
               
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
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

    $('#BtnExcel').click(function() {   //alert('v');
      $("#BtnExcel").prop("disabled",true);
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
      var base_url = window.location.origin;
    $readValue = $(this).attr('data-value');
    $token     = $('meta[name=csrf-token]').attr("content");
    
    $employee_id = $('#Txtemployee_id').val();
   // alert($employee_id);
    $Status = $('#DdlStatus').val();
    $startdate = $('#startdate').val();
    $enddate = $('#enddate').val();
        $.ajax({
        type: "POST",
        url: "/exportemplyeeleave", 
        data: {employee_id: $employee_id,Status: $Status,startdate: $startdate,enddate: $enddate, _token:"{{csrf_token()}}"},
       dataType: 'JSON',
        success: function (data) {
          $(this).prop("disabled",false);
          if(data.status == true)
          {
              Swal.fire(
              'Attendance Report Send to approval successfully!',
              //'You clicked the button!',
            //  'success'
              );

          }
          else
          {
            Swal.fire(
              'You can not send approvel before add reporting to!',
              //'You clicked the button!',
           //   'error'
              );
            
          }
        
        }
    });
});

/*
$(function () {
        //Assign Click event to Button.
        $("#BtnApproveAll").click(function () {
            var leave_id = "";
 
            //Loop through all checked CheckBoxes in GridView.
            $("#datatables input[type=checkbox]:checked").each(function () {

                  $(this).closest('tr').find("input").each(function() {
                   if(this.value != "on" && this.value != null )
                        leave_id +=  this.value +  ",";
                    });
              
            });
 
            //Display selected Row data in Alert Box.
            if(leave_id != "")
            {
             leave_id = leave_id.substring(0, leave_id.length - 1);
             alert(leave_id);

             var csrf = $('meta[name="csrf-token"]').attr('content');
                  $.ajax({
                  url: '/show_leave_documents',
                  type: 'GET',
                  data: {id : id, '_token': csrf},
                  dataType: 'json',

                  success: function( data ) {
                  //   alert(data);


                  }       
                  })

            }
            return false;
        });
    });  */

/*
$(document).ready(function () { 
      var oTable = $('#datatables').dataTable({
            stateSave: true,
           
            // "pagingType": "full_numbers",
            // "lengthMenu": [
            // [10, 25, 50, -1],
            // [10, 25, 50, "All"]
            // ],
            // responsive: true,
            // language: {
            // search: "_INPUT_",
            // searchPlaceholder: "Search",
            // },
            // "columnDefs": [
            // { "orderable": false, "targets": 6 },
            
            // ],
      });

      var allPages = oTable.fnGetNodes();

      $('body').on('click', '#selectAll', function () {
            if ($(this).hasClass('allChecked')) {
                  $('input[type="checkbox"]', allPages).prop('checked', false);
            } else {
                  $('input[type="checkbox"]', allPages).prop('checked', true);
            }
            $(this).toggleClass('allChecked');
      })

     
      });   
*/


$(document).ready(function() {
      var oTable =  $('#datatables').fadeIn(1100);
      $('#datatables').dataTable({
            stateSave: true,    
        "pagingType": "full_numbers",    
        "lengthMenu": [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
        ],
        responsive: true,
        language: {
          search: "_INPUT_",
          searchPlaceholder: "Search",
        },
        "columnDefs": [
          { "orderable": false, "targets": 6 },
          
        ],
      });
     
      // var allPages = oTable.fnGetNodes();

      // $('body').on('click', '#selectAll', function () {
      //       if ($(this).hasClass('allChecked')) {
      //             $('input[type="checkbox"]', allPages).prop('checked', false);
      //       } else {
      //             $('input[type="checkbox"]', allPages).prop('checked', true);
      //       }
      //       $(this).toggleClass('allChecked');
      // })

    });  

    $(document).ready(function () {
   $('body').on('click', '#selectAll', function () {
      if ($(this).hasClass('allChecked')) {
         $('input[type="checkbox"]', '#datatables').prop('checked', false);
      } else {
       $('input[type="checkbox"]', '#datatables').prop('checked', true);
       }
       $(this).toggleClass('allChecked');
     })
});
   
    $('#btn').click(function() { 
   $('#modelWindow').modal('show');
     });

     $(document).ready(function() {
  
  // initialise Datetimepicker and Sliders

    md.initFormExtendedDatetimepickers();
       
    if ($('.slider').length != 0) {
    
      md.initSliders();
    } 
    
  }); 
   
   function show_documents(id){
      //alert(id);
      var csrf = $('meta[name="csrf-token"]').attr('content');
      $.ajax({
          url: '/show_leave_documents',
          type: 'GET',
          data: {id : id, '_token': csrf},
          dataType: 'json',

          success: function( data ) {
          //   alert(data);

            var documents = data[0]['supportingdocument'];
            
            var array = documents.split(',');

            var html = '';

                $.each(array, function (key, val) {
                    //alert(val);

                   html += ' <div class="col-lg-6">' ;
                   html += ' <embed style="margin-bottom: 10px;" src="/leavedocuments/'+val+' " width="300" height="200" />';
                   html += ' <a style="font-size: 30px;" href="/leavedocuments/'+val+'" target="_blank"><i class="fa fa-download"></i></a>';

                   html += ' </div>';

            });

            $("#documents").html(html);

            $('#DocumentModal').modal('show'); 

          }       
      })

    }
     


  </script>
@endpush
