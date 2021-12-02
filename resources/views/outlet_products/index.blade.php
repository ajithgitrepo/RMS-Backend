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

@extends('layouts.app', ['activePage' => 'outlets', 'menuParent' => 'Outlets', 'titlePage' => __('Outlets')])


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
                <h4 class="card-title">{{ __('Outlets Brands') }}</h4>
              </div>
              <div class="card-body">
               @canany(['isClient'],App\User::class)
                  <div class="row">
                    <div class="col-12 text-right">
                      <a href="{{ route('outlet-products.create') }}" class="btn btn-sm btn-rose">{{ __('Add Products To Outlet') }}</a>
                    </div>
                  </div>
               @endcan
                <div class="table-responsive">
                  <table id="datatables" class="table table-striped table-no-bordered table-hover" style="display:none">
                    <thead class="text-primary">
                    
                      <th>
                          {{ __('S.No') }}
                      </th>
                      
                      <th>
                          {{ __('Outlet Name') }}
                      </th>

                    
                      
                     <th >
                            {{ __('Action') }}
                        </th>
                     
                    </thead>
                    
                    <tbody>

                      @php

                        $i=1

                      @endphp
                      
              	       
                               
                      @foreach($outlet as $out)
                     
                        <tr>
                        
                          <td>
                            {{ $i++ }}
                          </td>
                          
                          <td>
                            {{ $out->store_name }} {{ '('.$out->outlet_id. ')' }}
                          </td>

                        
                           @canany(['isClient'],App\User::class)
                           
                           <td class="display-block">
                              <form action="{{ route('outlet-products.destroy', $out->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                          <a rel="tooltip" title="Edit" class="btn btn-success btn-action btn-link view-edit" href="{{ route('outlet-products.edit', 
                                           $out->id ) }}" data-original-title="" title="">
                                            <i class="material-icons">edit</i>
                                            <div class="ripple-container"></div>
                                           </a>
                                      
                                          <button type="button" class="btn btn-danger btn-link view-edit" data-original-title="" title="Delete"  onclick="confirm('{{ __("Are you sure you want to delete this leave request?") }}') ? this.parentElement.submit() : ''">
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
          searchPlaceholder: "Search leave",
        }
      });
    });

   
  </script>
@endpush
