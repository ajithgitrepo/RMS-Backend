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

@extends('layouts.app', ['activePage' => 'store_details', 'menuParent' => 'Store_Details', 'titlePage' => __('Store 
Details')])

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
                <h4 class="card-title">{{ __('Store Details') }}</h4>
              </div>
              <div class="card-body">

                <div class="row">
                    <div class="col-12 text-right">
                      <a class="btn btn-sm btn-warning" style="color: #fff;" data-toggle="modal" data-target="#modelWindow" >{{ __('Filter') }}</a>
                    </div>
                  </div>

               @canany(['isClient','isTopManagement','isAdmin'],App\User::class)
                  <div class="row">
                    <div class="col-12 text-right">
                      <a href="{{ route('store_details.create') }}" class="btn btn-sm btn-rose">{{ __('Add Store details') }}</a>
                    </div>
                  </div>
               @endcan
                <div class="table-responsive">
                  <table id="datatables" class="table table-striped table-no-bordered table-hover" style="display:none">
                    <thead class="text-primary">
                    
                      <th>
                          {{ __('ID') }}
                      </th>
                      
                      <th>
                          {{ __('Store_Code') }}
                      </th>
                      
                      <th>
                          {{ __('Store_Name') }}
                      </th>
                      
                      <th>
                          {{ __('Contact_Number') }}
                      </th>
                      
                      <th>
                          {{ __('Address') }}
                      </th>
                     
                      @canany(['isClient','isTopManagement','isAdmin'],App\User::class)
                        <th>
                            {{ __('Action') }}
                        </th>
                     @endcan
                     
                    </thead>
                    
                    <tbody>

                      @php

                        $i=1

                      @endphp
                      
              	       
                               
                      @foreach($store as $st)
                        <tr>
                        
                          <td>
                            {{ $i++ }}
                          </td>
                          
                          <td>
                            {{ $st->store_code }}
                          </td>
                          
                          <td>
                            {{ $st->store_name }}
                          </td>
                          
                          <td>
                            {{ $st->contact_number }}
                          </td>
                          
                          <td>
                            {{ $st->address }}
                          </td>
                          
                        
                           @canany(['isClient','isTopManagement','isAdmin'],App\User::class)
                           
                           <td class="display-block">
                              <form action="{{ route('store_details.destroy', $st->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                          <a rel="tooltip" class="btn btn-success btn-action btn-link view-edit" href="{{ route('store_details.edit', 
                                           $st->id) }}" data-original-title="" title="">
                                            <i class="material-icons">edit</i>
                                            <div class="ripple-container"></div>
                                           </a>
                                      
                                          <button type="button" class="btn btn-danger btn-link view-edit" data-original-title="" title=""    onclick="confirm('{{ __("Are you sure you want to delete this store_details?") }}') ? this.parentElement.submit() : ''">
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

                   {{-- Pagination --}}
                    <div class="d-flex justify-content-center">
                        {!! $store->links() !!}
                    </div>

                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>



    <!--Model session filter for store--> 
   <div class="modal fade bd-example-modal-lg" id="modelWindow" role="dialog" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" 
          aria-hidden="true">
            <div class="modal-dialog modal-lg vertical-align-center">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title"><b> Filter Options</b></h4>
                </div>
                
                <div class="modal-body">
                <form method="get" action="{{ url('filter_store') }}" class="form-inline" enctype="multipart/form-data" action="" autocomplete="off" style="text-align: right;">
                
                    @csrf
                    @method('get')
                
                
                   <div class="row" style="width: 100%;">

                    <div class="col-sm-8">
                     <div class="form-group">
                      <select class="form-control selectpicker js-select2 " data-style="select-with-transition" title="Select Store" data-size="7" name="store_id" required="" id="input-store_id" value="{{ old('store_id') }}" aria-required="true"  >
                       <option value="" selected="">-- All Stores --</option>
                        @foreach ($use_filter as $st)
                      <option value="{{ $st->id}}"> {{ $st->store_code }} - {{ $st->store_name }} - {{ $st->address }} </option>
                        @endforeach
                      </select>
                  
                     </div>
                   </div>
        
                 
                    <div class="col-sm-4">
                     <div class="form-group">
                     <input class="form-control {{ $errors->has('store_code') ? ' is-invalid' : '' }}" name="store_code" id="input-store_code" type="text" placeholder="{{ __('Store Code') }}" value="{{ old('store_code') }}" >
                      
                     </div>
                   </div>

                   
                     <div class="col-sm-12 text-right">
                     <div class="form-group">
                    

                       <button type ="submit" class="btn btn-info btn-sm mx-auto ">Filter</button>
                    </div>
                  </div>
                 
     
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

    $(".js-select2").select2();

    $('.js-select2').select2({
        dropdownParent: $('#modelWindow')
    });


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
      $('#datatables').fadeIn(1100);
      $('#datatables').DataTable({
        "paging":   false,
        "pagingType": "full_numbers",
        "lengthMenu": [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
        ],
        responsive: true,
        language: {
          search: "_INPUT_",
          searchPlaceholder: "Search Store",
        }
      });
    });

   
 
  </script>
@endpush
