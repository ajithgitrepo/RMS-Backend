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

@extends('layouts.app', ['activePage' => 'Delete', 'menuParent' => 'Delete', 'titlePage' => __('Delete Details')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="fa fa-copyright"></i>
                </div>
                <h4 class="card-title">{{ __('Delete Timesheet') }}</h4>
              </div>


              <div class="card-body">



               <div class="table-responsive">
                  <table id="datatables" class="table table-striped table-no-bordered table-hover" style="display:none">
                    <thead class="text-primary">
                      <th>
                          {{ __('#') }}
                      </th>
                      <th>
                          {{ __('Employee_id') }}
                      </th>
                      <th>
                          {{ __('Outlet_id') }}
                      </th>
                       <th>
                          {{ __('Date') }}
                      </th>


                       <th>
                          {{ __('Action') }}
                      </th>



                    </thead>

                    <tbody>

                      @php

                        $i=1

                      @endphp

                      @foreach($delete as $del)

                          <td>
                            {{ ++$i }}
                          </td>

                           <td>

                 	     ({{ $del->employee_id }})
                          </td>
                           <td>
                           {{ $del->outlet_id}}
                          </td>
                           <td>
                               {{ date('d-m-Y', strtotime($del->date)) }}

                          </td>


                             <td class="display-block">
                              <form action="{{ route('delete.destroy', $del->id) }}" method="post">
                                        @csrf
                                        @method('delete')

                                  <button type="button" class="btn btn-danger btn-link view-edit" data-original-title="" title=""
                                   onclick="confirm('{{ __("Are you sure you want to delete this time_sheet") }}') ? this.parentElement.submit() : ''">
                                              <i class="material-icons">close</i>
                                              <div class="ripple-container"></div>
                                  </button>

                               </form>
                             </td>


	                </tr>
                      @endforeach

                    </tbody>
                  </table>


{{--                --}}{{-- Pagination --}}
                <div class="d-flex justify-content-center">
                    {{  $delete->links('pagination::bootstrap-4') }}
                </div>

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
        "paging": false,
        "lengthMenu": [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
        ],
        responsive: true,
        language: {
          search: "_INPUT_",
          searchPlaceholder: "Search..",
        },
        "columnDefs": [
          { "orderable": false, "targets": 5 },
        ],
      });
    });






  </script>
@endpush
