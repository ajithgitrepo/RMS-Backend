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

@extends('layouts.app', ['activePage' => 'brand_details', 'menuParent' => 'Products', 'titlePage' => __('Brand Details')])

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
                <h4 class="card-title">{{ __('Brand Details') }}</h4>
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
                      <a href="{{ route('brand_details.create') }}" class="btn btn-sm btn-rose">{{ __(' Add Brand ') }}</a>
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
                          {{ __('Brand') }}
                      </th>
                      <th>
                          {{ __('Client') }}
                      </th>
                       <th>
                          {{ __('Field Manager') }}
                      </th>
                      <th>
                          {{ __('Sales Manager') }}
                      </th>
                     @canany(['isClient','isTopManagement','isAdmin'],App\User::class)
                       <th>
                          {{ __('Action') }}
                      </th>
                    @endcan
                   
                      
                    </thead>
                    
                    <tbody>

                      @php

                        $i=0

                      @endphp
                 
                      @foreach($branddetails as $brand)
             
                          <td>
                            {{ ++$i }}
                          </td>
                          <td>
                            {{ $brand->brand_name }}
                          </td>
                           <td>
                           {{ $brand->employee_client[0]->first_name.' '. $brand->employee_client[0]->middle_name .' '. $brand->employee_client[0]->surname }}
                            
                 	     ({{ $brand->client_id }})
                          </td>
                           <td>
                           {{ $brand->employee_field[0]->first_name .' '. $brand->employee_field[0]->middle_name .' '. $brand->employee_field[0]->surname }}
                            ({{ $brand->field_manager_id}})
                          </td>
                           <td>
                            {{ $brand->employee_sales[0]->first_name .' '. $brand->employee_sales[0]->middle_name .' '. $brand->employee_sales[0]->surname }}
                            ({{ $brand->sales_manager_id}})
                          </td>

                      	    @canany(['isClient','isTopManagement','isAdmin'],App\User::class)
                             <td class="display-block">
                              <form action="{{ route('brand_details.destroy', $brand->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                          <a rel="tooltip" class="btn btn-success btn-action btn-link view-edit" href="{{ route('brand_details.edit', 
                                          $brand->id) }}" data-original-title="" title="">
                                          <i class="material-icons">edit</i>
                                            <div class="ripple-container"></div>
                                          </a>
                                      
                                  <button type="button" class="btn btn-danger btn-link view-edit" data-original-title="" title="" 		 
                                   onclick="confirm('{{ __("Are you sure you want to delete this brand_details") }}') ? this.parentElement.submit() : ''">
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
                    {{  $branddetails->links('pagination::bootstrap-4') }}
                </div>

                </div>
              </div>
            </div>
            
        </div>
      </div>
    </div>
  </div>


    <!--Model session filter for brand--> 
   <div class="modal fade bd-example-modal-lg" id="modelWindow" role="dialog" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" 
          aria-hidden="true">
            <div class="modal-dialog modal-lg vertical-align-center">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title"><b> Filter Options</b></h4>
                </div>
                
                <div class="modal-body">
                <form method="get" action="{{ url('filter_brand') }}" class="form-inline" enctype="multipart/form-data" action="" autocomplete="off" style="text-align: right;">
                
                    @csrf
                    @method('get')
                
                
                   <div class="row" style="width: 100%;">
                   
                   <div class="col-sm-4">
                    <div class="form-group">
                     <input class="form-control {{ $errors->has('brand_name') ? ' is-invalid' : '' }}" name="brand_name" 
                    id="input-brand_name" type="text" placeholder="{{ __('Brand Name') }}" value="{{ old('brand_name') }}" >
                      
                    </div>
                   </div>
         
                <div class="col-sm-4">
                 <div class="form-group">

                  <select class="form-control selectpicker" data-style="select-with-transition"  title="Select Field Manager" data-size="7" name="field_manager_id" id="input-field_manager_id" 
                     value="{{ old('field_manager_id') }}" aria-required="true" >
 
                    <option value="" selected="">Select Field Manager</option>
                    @foreach ($employ_field as $employ2)
                    <option value="{{ $employ2->employee_id }}" @if ( old('field_manager_id') == $employ2->employee_id) 
                    {{ 'selected' }} @endif > {{  $employ2->first_name  }} {{  $employ2->middle_name }}{{  $employ2->surname  }}
                    ({{ $employ2->employee_id}})</option>
                    @endforeach
          
                    </select>    
                  </div>
                </div>
                
                <div class="col-sm-4">
                 <div class="form-group">

                   <select class="form-control selectpicker" data-style="select-with-transition"  title="Select Sales Manager" data-size="7" name="sales_manager_id" id="input-sales_manager_id" 
                     value="{{ old('sales_manager_id') }}" aria-required="true" >
 
 
                        <option value="" selected="">Select Sales Manager</option>
                        @foreach ($employ_sales as $employ3)
                        <option value="{{ $employ3->employee_id }}" @if ( old('sales_manager_id') ==  $employ3->employee_id) {{ 'selected' }} @endif > {{  $employ3->first_name  }} {{  $employ3->middle_name  }} {{  $employ3->surname  }}
                        ({{ $employ3->employee_id}})</option>
                        @endforeach
                      
                    </select>
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


function store_brand(id) {
 
    $( '#frm' ).submit( function( e ) {
    
        e.preventDefault();
        var select = $( this ).serialize();
       
        // POST to php script
        $.ajax( {
            type: 'POST',
            url: '/store_brand',
            data: select,
          
            
        }).then( function( data ) {
      // console.log(data);
       // alert(JSON.stringify(data[0]['id']));
        alert(JSON.stringify(data));          
        } );
        return false;
    } );
}

$(document).ready(function()
{
    store_brand();
});



  </script>
@endpush
