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

</style>

@extends('layouts.app', ['activePage' => 'dailyattendance', 'menuParent' => 'Attendance', 'titlePage' => __('Dailyattendance Report')])

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
                <h4 class="card-title">{{ __('Daily Attendance Report') }}</h4>
              </div>
              <div class="card-body">
              
              <div class="col-12 text-right">
  		 <a  class="btn btn-sm btn-warning" id="btn">{{ __('Filter') }}</a>
     		</div>  

     		 <div class="table-responsive">
                  <table id="datatables" class="table table-striped table-no-bordered table-hover" style="display:none">
                    <thead class="text-primary">
                     <th>
                          {{ __('Date') }}
                      </th>
                      
                      <th>
                          {{ __('User Name') }}
                      </th>
                      <th>
                          {{ __('EOT_Start Time') }}
                      </th>
                      <th>
                           {{ __('EOT_End Time') }}
                      </th>
                      <th>
                          {{ __('CheckIn_Time') }}
                      </th>
                      <th>
                           {{ __('CheckOut_Time') }}
                      </th>
                      
                      <th class ="display:block">
                          {{ __('Total Working Hours') }}
                      </th>
               
                      
                        
                    </thead>
                    
                    <tbody>

                      @php

                        $i=0

                      @endphp
                 
                      @foreach($dailyattendance as $daily)


   
                        <tr>
                        
                          <td>
                            {{ date('d-m-Y',strtotime($daily->date)) }}
                          </td>
                          <td>
                           
                            {{ $daily->first_name}}
                            {{ $daily->middle_name}}
                            {{ $daily->surname}}
                            
                          </td>
                     
                          <td>
                            {{ '8.00 AM' }}
                          </td>
                          
                          <td>
                            {{ 'N/A' }}
                          </td>

                            @if ($daily->is_present == "1" )
                           <td>
                            {{ $start_time = date('g:i a', strtotime($daily->checkin_time)) }}
                           </td>
                            @endif
                           
                            @if ($daily->is_present == "1"  && $daily->checkout_time !== null  )
                           <td>
                             {{ $end_time = date('g:i a', strtotime($daily->checkout_time)) }}
                           </td>
                           @else
                            <td>
                                {{ $end_time = '' }}
                                {{ _('-') }} 
                           </td>
                           @endif
                       
                          <td>
                            @php
                                $start  = \Carbon\Carbon::parse($start_time);
                                $end    = \Carbon\Carbon::parse($end_time);   
                            @endphp
                                               
                            {{ $start->diff($end)->format('%H:%I') }}    
               
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
  
  
  <!--Model session--> 

 
          <div class="modal fade" id="modelWindow" role="dialog">
            <div class="modal-dialog modal-lg vertical-align-center">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title"><b> Filter Options</b></h4>
                </div>
                <div class="modal-body">
                
                 <form method="post" enctype="multipart/form-data" action="{{ url('filter') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')
                
                
                <div class="row">
                  <div class="col-sm-3">
                     <div class="form-group">
                          <label for="" class="bmd-label-floating">Employee ID </label>
                          <input type="text" class="form-control" id="" name="employee_id" value="{{ old('employee_id') }}" >
                           @include('alerts.feedback', ['field' => 'employee_id'])
                     </div>
                   </div>
                  
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('role') ? ' has-danger' : '' }}">
                 
                       <select class="form-control{{ $errors->has('role') ? ' is-invalid' : '' }}" name="position" id="input-role" 
                        value="{{ old('role') }}" >
                     
                       <option>Select</option>
                       @foreach ($position as $pos)
                   	<option value="{{ $pos->id }}"> {{  $pos->name  }}</option>
    			@endforeach
			</select>
                   
                     @include('alerts.feedback', ['field' => 'role'])
                    </div>
                  </div>
                  
                  
                  
                  <div class="col-sm-2">
                    <div class="form-group{{ $errors->has('startdate') ? ' has-danger' : '' }}">
                     <input class="form-control datepicker{{ $errors->has('startdate') ? ' is-invalid' : '' }}" name="startdate" id="input-startdate" type="text" placeholder="{{ __('startdate') }}" value="{{ old('startdate') }}" >
                     
                    </div>
                  </div>
                  
                  <div class="col-sm-2">
                    <div class="form-group{{ $errors->has('enddate') ? ' has-danger' : '' }}">
                     <input class="form-control datepicker{{ $errors->has('enddate') ? ' is-invalid' : '' }}" name="enddate" id="input-enddate" type="text" placeholder="{{ __('enddate') }}" value="{{ old('enddate') }}"  >
                    
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

     $(".datepicker").datetimepicker({
        format: 'DD-MM-YYYY',
        useCurrent: false
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
          searchPlaceholder: "Search leave request",
        }
      });
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
     
 
  </script>
@endpush
