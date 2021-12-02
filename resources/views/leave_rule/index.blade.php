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

@extends('layouts.app', ['activePage' => 'leave-rule', 'menuParent' => 'My-Activity', 'titlePage' => __('Leave Rule')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">event</i>
                </div>
                <h4 class="card-title">{{ __('Leave Rules') }}</h4>
              </div>
              <div class="card-body">
                @canany(['isHuman_Resource'],App\User::class)
                  <!-- <div class="row">
                    <div class="col-12 text-right">
                      <a href="{{ route('leave_rule.create') }}" class="btn btn-sm btn-rose">{{ __('Add Leave') }}</a>
                    </div>
                  </div> -->
                @endcan
                <div class="table-responsive">
                  <table id="datatables" class="table table-striped table-no-bordered table-hover" style="display:none">
                    <thead class="text-primary">
                      <th>
                          {{ __('#') }}
                      </th>
                      <th>
                          {{ __('Leave Type') }}
                      </th>
                      <th>
                          {{ __('Total Days Count') }}
                      </th>
                      <!-- <th>
                          {{ __('Year') }}
                      </th> -->
                      <!-- <th>
                          {{ __('Requirements') }}
                      </th> -->
                      <th>
                          {{ __('Remarks') }}
                      </th>
                     
                        <th class="display-block">
                            {{ __('Action') }}
                        </th>

          
                     
                    </thead>
                    <tbody>

                      @php

                        $i=1

                      @endphp
                      
              	       
                 
                      @foreach($leave_rule as $leave)
                     
                        <tr>
                        
                          <td>
                            {{ $i++ }}
                          </td>
                          <td>
                                @if($leave->leave_type == "Annual_Leave")
                                {{ "Annual Leave"}}
                                @endif
                                @if($leave->leave_type == "Maternity_Leave")
                                {{ "Maternity Leave" }}
                                @endif
                                @if($leave->leave_type == "Sick_Leave")
                                {{ "Sick Leave" }}
                                @endif
                           
                          </td>
                          <td>
                            {{ $leave->total_days }}
                          </td>
                          <!-- <td>
                            {{ $leave->year }}
                          </td> -->
                          <!-- <td>
                            {{ $leave->requirements }}
                          </td>-->
                          <td>
                            {{ $leave->remarks }}
                          </td> 
                           

                            @canany(['isHuman_Resource'],App\User::class)

                          <td class="display-block">
                              <form action="{{ route('leave_rule.destroy', $leave->leave_rule_id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        
                                      <a rel="tooltip" class="btn btn-success btn-action btn-link view-edit" href="{{ route('leave_rule.edit', 
                                          $leave->leave_rule_id) }}" data-original-title="" title="">
                                            <i class="material-icons">edit</i>
                                            <div class="ripple-container"></div>
                                          </a>
                                      
                                        <button type="button" class="btn btn-danger btn-link view-edit" data-original-title="" title="" onclick="confirm('{{ __("Are you sure you want to delete this leave rule?") }}') ? this.parentElement.submit() : ''">
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
          { "orderable": false, "targets": 2 },
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
