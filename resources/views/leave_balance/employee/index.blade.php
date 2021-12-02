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

@extends('layouts.app', ['activePage' => 'leave-balance', 'menuParent' => 'My-Activity', 'titlePage' => __('Leave Balance')])

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
                <h4 class="card-title">{{ __('Leave Balance') }}</h4>
              </div>
              <div class="card-body">
               <!--  @can('create', App\User::class)
                  <div class="row">
                    <div class="col-12 text-right">
                      <a href="{{ route('leave_rule.create') }}" class="btn btn-sm btn-rose">{{ __('Add Leave') }}</a>
                    </div>
                  </div>
                @endcan -->
                <div class="table-responsive">
                  <table id="datatables" class="table table-striped table-no-bordered table-hover" style="display:none">
                    <thead class="text-primary">
                      <th>
                          {{ __('#') }}
                      </th>
                       <th>
                          {{ __('Name') }}
                      </th> 
                     
                      <th>
                          {{ __('Annual Leave') }}
                      </th>
                      <th>
                          {{ __('Sick Leave ') }}
                      </th> 
                      <!-- <th>
                          {{ __('Maternity Leave') }}  
                      </th> -->
                      
                     
                       <!--  <th class="display-block">
                            {{ __('Action') }}
                        </th>
 -->
          
                    </thead>
                    <tbody>

                      @php

                        $i=1

                      @endphp
                      
              	       
                 
                      @foreach($leave_balance as $value)
                     
                        <tr>
                        
                          <td>
                            {{ $i++ }}  
                          </td> 
                       
                           <td>
                          {{ $employee_dtl[0]->first_name }} {{ $employee_dtl[0]->middle_name }} {{ $employee_dtl[0]->surname }}
                           ({{ $employee_dtl[0]->employee_id}})
                           
                          </td> 
     
                          @php
                          $JoinDate = $employee_dtl[0]->joining_date;
                              $startDate = \Carbon\Carbon::now(); 
                              $todate = \Carbon\Carbon::now()->format('Y-m-d');
                              $d1 = new DateTime($todate);
                              $d2 = new DateTime($JoinDate);
                              $diff_month_count = ($d1->diff($d2)->m);
                          @endphp  
                        
                          @if($diff_month_count >= 6)  
                          <td>  {{ $value->Annual_Leave }} </td>
                          @else
                          <td>  N/A </td> 
                          @endif

                          @if($diff_month_count >= 6)  
                          <td>  {{ $value->Sick_Leave }} </td>
                          @else
                          <td>  N/A </td> 
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
