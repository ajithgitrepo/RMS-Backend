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




@extends('layouts.app', ['activePage' => 'manualcheckin', 'menuParent' => 'manualcheckin', 'titlePage' => __('manual checkin')])

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
                <h4 class="card-title">{{ __('manual checkin') }}</h4>
              </div>
              <div class="card-body">
              
                  <div class="row">
                    <div class="col-12 text-right">
                      <a href="{{ route('manualcheckin.create') }}" class="btn btn-sm btn-rose">{{ __('Add manualcheckin') }}</a>
                    </div>
                  </div>
              
                <div class="table-responsive">
                  <table id="datatables" class="table table-striped table-no-bordered table-hover" style="display:none">
                    <thead class="text-primary">
                    
                     <th>
                       {{__('#')}}
                     </th>
                     
                       <th style="width:100px;">
                       {{__('Date')}}
                     </th>



                      <th>
                          {{ __('Employee_id') }}
                      </th>
                      
                      <th>
                          {{ __('Outlet_name') }}
                      </th>

                      <th>
                          {{ __('In_time') }}
                      </th>

                      <th>
                          {{ __('Out_time') }}
                      </th>

                      <th>
                          {{ __('In_location') }}
                      </th>

                      <th>
                          {{ __('Out_location') }}
                      </th>
  
                      
<!--                      <th class="display-block">
                            {{ __('Action') }}
                        </th> -->
                     
                    </thead>
                    
                    <tbody>

                      @php

                        $i=1

                      @endphp
                      
              	       
                               
                      @foreach($manual as $man)
                     
                         <tr>
                         <td>
                          {{ $i }}
                         </td>
                            @php

                            $i++;

                            @endphp
                         <td>
                           
                            {{ date('d-m-Y', strtotime($man->date)) }}
                         </td>

                         <td>
                            {{ $man->employee_id . " " . $man->first_name}}
                         </td>
                          
                         <td>
                           {{ $man->store_name}}
                            
                         </td>
                          
                         <td>
                            {{date('H:i:s', strtotime($man->checkin_time))}}
                         </td>
                         <td>
                            {{ date('H:i:s', strtotime($man->checkout_time)) }}

                         </td>
                         <td>
                            {{ $man->checkin_location }}
                            
                         </td>

                         <td>
                            {{ $man->checkout_location }}
                            
                         </td>
    
                           
<!--                            <td class="display-block">
                              <form action="{{ route('manualcheckin.destroy', $man->id) }}" method="put">
                                        @csrf
                                        @method('delete')
                                          
                                      
                                          <button type="button" class="btn btn-danger btn-link view-edit" data-original-title="" title="" 
                                          onclick="confirm('{{ __("Are you sure you want to delete this manual checkin?") }}') ? this.parentElement.submit() : ''" >
                                              <i class="material-icons">close</i>
                                              <div class="ripple-container"></div>
                                          </button>
                                      
                               </form>
                           </td>  -->
              
                          
                          
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

   
  
  </script>
@endpush
