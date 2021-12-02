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
  /*.table.dataTable thead {
    background-color:green;
    color: #fff;
  }*/
  .dt-buttons {
      float: right;
      margin-left: 20px;
      border-radius: 5px;
    }
</style>

@extends('layouts.app', ['activePage' => 'mannual_attendance', 'menuParent' => 'Attendance', 'titlePage' => __('Mannual Attendance')])
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">book</i>
                </div>
                <h4 class="card-title">{{ __('Mannual Attendance') }}</h4>
              </div>
              
              <div class="card-body">
            
    		   @canany(['isHuman_Resource','isAdmin','isTopManagement'],App\User::class)
                  <div class="row">
                    <div class="col-12 text-right">
                      <a href="{{ route('mannual_attendance.create') }}" class="btn btn-sm btn-rose">{{ __('Add Mannual ttendance') }}</a>
                    </div>
                  </div>
                @endcan
              
               
                <div class="table-responsive">
                  <table id="datatables" class="table table-striped table-no-bordered table-hover" style="display:none">
                    <thead class="text-primary">
                    
                      <th>
                          {{ __('#') }}
                      </th>
                      <th>
                          {{ __('Employee') }}
                      </th>
                      
                       <th>
                          {{ __('Date') }}
                      </th>
                       <th>
                          {{ __('Check In') }}
                      </th>
                      <th>
                          {{ __('Check Out') }}
                      </th>
                     
                       <th>
                          {{ __('Action') }}
                      </th>
                    
                    </thead>
                    
                    <tbody>
                      @php
                        $i=1
                      @endphp
                      
                      @foreach($attendance as $present)
                        <tr>
                           <td>
                            {{ $i++ }}
                          </td>
                          <td>
                            {{ $present->employee_id }}
                         
                            {{ $present->first_name }} {{ $present->middle_name }} {{ $present->surname }}
                          </td>
                          <td>
                           {{ date('d-m-Y', strtotime($present->date)) }}
                          </td>
                          <td>
                          {{ $start_time = date('g:i a', strtotime($present->checkin_time)) }}
                          </td>
                          <td>
                             @if($present->checkout_time != "")
                           {{ $end_time = date('g:i a', strtotime($present->checkout_time)) }}
                          @endif
                          </td>
                          
                          
                          @canany(['isHuman_Resource','isAdmin','isTopManagement'],App\User::class)
                             <td class="display-block">
                              <form action="{{ route('mannual_attendance.destroy', $present->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                          <a rel="tooltip" class="btn btn-success btn-action btn-link view-edit" href="{{ route('mannual_attendance.edit', 
                                         $present->id) }}" data-original-title="" title="">
                                          
                                           
                                            <i class="material-icons">edit</i>
                                            <div class="ripple-container"></div>
                                           </a>
                                      
                                          <button type="button" class="btn btn-danger btn-link view-edit" data-original-title="" title="" 		   
                                 onclick="confirm('{{ __("Are you sure you want to delete this mannual attendance") }}') ? this.parentElement.submit() : ''">
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
          searchPlaceholder: "Search mannual attendance",
        }
      });
    });
    
  
    
  </script>
  
@endpush
