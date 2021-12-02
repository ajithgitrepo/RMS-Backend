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

</style>

@extends('layouts.app', ['activePage' => 'employee-attendance', 'menuParent' => 'My-Activity', 'titlePage' => __('Employee Attendance')])

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
                <h4 class="card-title">{{ __('Employee Attendance') }}</h4>
              </div>
              <div class="card-body">
             
              <div class="row">
                    <div class="col-12 text-right">
                      <a class="btn btn-sm btn-warning" style="color: #fff;" data-toggle="modal" data-target="#FilterModal" >{{ __('Filter') }}</a>
                    </div>
                  </div>
                 


               
                <div class="table-responsive">
                  <table id="datatables" class="table table-striped table-no-bordered table-hover" style="display:none">
                    <thead class="text-primary">
                      <th>
                          {{ __('#') }}
                      </th>
                       <th>
                          {{ __('Date') }}
                      </th>
                       <th>
                          {{ __('IS_Present') }}
                      </th>
                      <th>
                          {{ __('IS_Leave') }}
                      </th>
                      <th>
                          {{ __('CheckIn_Time') }}
                      </th>
                      <th>
                           {{ __('CheckOut_Time') }}
                      </th>
                      <th>
                           {{ __('Is_Leave_Approved') }}
                      </th>
                      <th>
                           {{ __('Leave_Approved_By') }}
                      </th>
                     
                     <!--  <th>
                          {{ __('Remarks') }}
                      </th> -->
                        
                    </thead>
                    
                    <tbody>

                      @php

                        $i=1

                      @endphp
                 
                      @foreach($attendance as $leave)
   
                        <tr>

                          <td>
                            {{ $i++ }}
                          </td>

                          <td>
                            {{ date('d-m-Y',strtotime($leave->date)) }}
                          </td>
                          
                          <td>
                            @if($leave->is_present == 1)
                              {{ __('Present') }}
                            @endif 
                             @if($leave->is_present == 0)
                              {{ __('-') }}
                            @endif 
                          </td>

                          <td>
                            @if($leave->is_leave == 0)
                              {{ __('-') }}
                            @endif 
                             @if($leave->is_leave == 1)
                              {{ __('Absent') }}
                            @endif 
                          </td>

                          <td>
                            @if($leave->checkin_time)

                             {{ date('h:i A', strtotime($leave->checkin_time)) }}

                            @endif

                            @if($leave->checkin_time =="")
                             {{ __('-') }}
                            @endif
                            
                          </td>

                           <td>
                            @if($leave->checkout_time)
                             {{ date('h:i A', strtotime($leave->checkout_time)) }}
                            @endif

                            @if($leave->checkout_time =="")
                             {{ __('-') }}
                            @endif

                           
                           </td>

                          <td>
                            @if($leave->is_leave_approved == 0)
                              {{ __('-') }}
                            @endif 
                             @if($leave->is_leave_approved == 1)
                              {{ __('Approved') }}
                            @endif 
                          </td>

                          <td>
                             @if($leave->leave_approved_by == "")
                              {{ __('-') }}
                            @endif 

                            @if($leave->leave_approved_by)
                             {{$leave->leave_approved_by }}
                            @endif

                            
                          </td>
                          <!-- <td>
                            {{ $leave->remarks }}
                          </td> -->
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

<!--Filter Emp Attn -->



<div class="modal fade bd-example-modal-lg" id="FilterModal"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Filter</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
           <form method="post" action="{{ url('filter_emp_attn') }}" class="form-inline" enctype="multipart/form-data" action="" autocomplete="off" style="text-align: right;">
              @csrf
              @method('post')

                 <div class="col-lg-4">
                 <input type="text" class="form-control datepicker" value="{{ $startdate }}" id="startdate" placeholder="Start Date" name="startdate">
               </div> 



                <div class="col-lg-2">
                 <input type="text" class="form-control datepicker" value="{{ $enddate }}" id="enddate" placeholder="End Date" name="enddate">
               </div> 
                  
                    <b><button type ="submit" class="btn btn-info btn-sm ">Filter</button></b>
                   
                 </div> 
              </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@push('js')
  <script>

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
          searchPlaceholder: "Search Attendance",
        },
        "columnDefs": [
          { "orderable": false, "targets": 5 },
        ],
      });
    });

   
     


  </script>
@endpush
