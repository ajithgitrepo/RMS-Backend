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

@extends('layouts.app', ['activePage' => 'emp-leave-balance', 'menuParent' => 'Employee', 'titlePage' => __('Employee Leave Balance')])

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
                <h4 class="card-title">{{ __('Employee Leave Balance') }}</h4>
              </div>
              <div class="card-body">
               <!--  @can('create', App\User::class)
                  <div class="row">
                    <div class="col-12 text-right">
                      <a href="{{ route('leave_rule.create') }}" class="btn btn-sm btn-rose">{{ __('Add Leave') }}</a>
                    </div>
                  </div>
                @endcan -->
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
                          {{ __('Employee Id') }}
                      </th>
                      <th>
                          {{ __('Annual Leave') }}
                      </th>
                       <th>
                          {{ __('Sick Leave ') }}
                      </th> 
                      <!-- <th>
                          {{ __('Maternity Leave') }}  
                      </th>
                      
                      <th>
                          {{ __('Loss of Pay') }}
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
                          {{ !empty($value->employee->first_name) ? $value->employee->first_name:'' }}
                          {{ !empty($value->employee->surname) ? $value->employee->surname:'' }}
                          ({{ !empty($value->employee_id) ? $value->employee_id:'' }})                         
                          </td>
                          <td>
                            {{ $value->Annual_Leave }}
                          </td>
                          <td>
                            {{ $value->Sick_Leave }}
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
           <form method="post" action="{{ url('filter_empleave_balance') }}" class="form-inline" enctype="multipart/form-data" action="" autocomplete="off" style="text-align: right;">
              @csrf
              @method('post')

                 
                  <div class="col-lg-4">
                    
                          <select class="form-control selectpicker"  data-style="select-with-transition" title="Select Employee" data-size="7" name="employee_id" id="input-employee_id"  value="{{ old('employee_id') }}" aria-required="true" >
                    
                        <option value="" selected >Select Employee</option>

                   
                        @foreach ($leave_balance as $lb)
                            <option value="{{$lb->employee_id}}" > 
                            {{ !empty($lb->employee->first_name) ? $lb->employee->first_name:'' }}  
                            {{ !empty($lb->employee->surname) ? $lb->employee->surname:'' }}  
                           ( {{ !empty($lb->employee_id) ? $lb->employee_id:'' }} )

                             </option>
                        @endforeach
                         
                      </select>
                   
                     
                   </div>

                    <b><button type ="submit" class="btn btn-info btn-sm ">Filter</button></b>
                   
                 </div> 
              </form>
    
      <div class="modal-footer">
     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
