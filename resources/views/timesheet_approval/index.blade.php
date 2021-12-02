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

@extends('layouts.app', ['activePage' => 'timesheet-approval', 'menuParent' => 'TimeSheet-Approval', 'titlePage' => __('TimeSheet Approval')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">schedule</i>
                </div>
                <h4 class="card-title">{{ __('Timesheets') }}</h4>
              </div>
              <div class="card-body">

            <form method="post" action="{{ url('filter_timesheet') }}" class="form-inline" enctype="multipart/form-data" action="" autocomplete="off" style="text-align: right;">
              @csrf
              @method('post')
          
              <div class="col-lg-4">
                
               </div>

               <div class="col-lg-3">
                 <input type="text" class="form-control datepicker" id="date" placeholder="Date" name="date">
               </div>

                <div class="col-lg-3">
                     <select style="width: 215px;" class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" name="status" id="input-status" 
                     value="{{ old('status') }}" aria-required="true">
                       <option value="" selected disabled>Select</option>
                        <option value="1">Completed</option>
                        <option value="0">Pending</option>
                           

                     </select>
               </div>

                 <button type="submit"  class="btn btn-finish btn-fill ml-auto btn-rose btn-wd d-block" name="Filter" value="Filter">{{ __('Filter') }}</button>


            </form>

                <div class="table-responsive">
                  <table id="datatables" class="table table-striped table-no-bordered table-hover" style="display:none">
                    <thead class="text-primary">
                      <th>
                          {{ __('#') }}
                      </th>
                     <!--  <th>
                          {{ __('Employee Id') }}
                      </th> -->
                      <th>
                          {{ __('Outlet Id') }}
                      </th>
                       <th>
                          {{ __('Date') }}
                      </th>
                      <th>
                          {{ __('Outlet Name') }}  
                      </th>
                      <th>
                          {{ __('Outlet Area') }}
                      </th>
                      <th>
                          {{ __('Outlet City') }}
                      </th>
                      <th>
                          {{ __('Outlet State ') }}
                      </th>
                      <th>
                          {{ __('Outlet Country') }}
                      </th>
                      <th>
                          {{ __('Status') }}
                      </th>
                     
                     
                    </thead>
                    <tbody>

                      @php

                        $i=1

                      @endphp
                      
              	       
                 
                      @foreach($outlets as $value)
                     
                        <tr>
                        
                          <td>
                            {{ $i++ }}
                          </td>
                         <!--  <td>
                            {{ $value->employee_id}}
                          </td> -->
                          <td>
                            {{ $value->outlet_id }}
                          </td>
                           <td>
                            {{ date('d - m - Y',strtotime($value->date)) }} 
                          </td>
                          <td>
                            {{ $value->outlet->outlet_name }}
                          </td>
                          <td>
                            {{ $value->outlet->outlet_area }}
                          </td>
                          <td>
                            {{ $value->outlet->outlet_city }}
                          </td>
                           <td>
                            {{ $value->outlet->outlet_state }}
                          </td>
                           <td>
                            {{ $value->outlet->outlet_country }}
                          </td>

                          @if($value->is_completed =='1')
                             <td style="color: green;">
                                {{ __('Completed') }}
                              </td>
                          @endif  

                           @if($value->is_completed =='0')
                             <td style="color: red;">
                                {{ __('Pending') }}
                              </td>
                          @endif  
              
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
  <script>

     $('.datepicker').datetimepicker({
          format : 'DD-MM-YYYY',
          toolbarPlacement: "top",
          allowInputToggle: true,
          useCurrent: true,
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
          searchPlaceholder: "Search",
        },
        "columnDefs": [
          { "orderable": false, "targets": 5 },
        ],
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
             //alert(data);

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
     


  </script>
@endpush
