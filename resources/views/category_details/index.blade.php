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


@extends('layouts.app', ['activePage' => 'category_details', 'menuParent' => 'Products', 'titlePage' => __('Category Details')])

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
                <h4 class="card-title">{{ __('Category ') }}</h4>
              </div>
              
              
              <div class="card-body">
            
    		  @canany(['isClient','isTopManagement','isAdmin'],App\User::class)
                  <div class="row">
                    <div class="col-12 text-right">
                      <a href="{{ route('category_details.create') }}" class="btn btn-sm btn-rose">{{ __('Add Category') }}</a>
                    </div>
                  </div>
                @endcan
	 
                 
              <div class="table-responsive">
                  <table id="datatables" class="table table-striped table-no-bordered table-hover" style="display:none">
                    <thead class="text-primary">
                      <th>
                          {{ __('S.No') }}
                      </th>
                     <!--  <th>
                          {{ __('Brand') }}
                      </th -->
                      <th>
                          {{ __('Category') }}
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
                
                      @foreach($category as $cat)
               
                        <tr>
                          
                          <td>
                            {{ ++$i }}
                          </td>
                         
                          <td>
                            {{ $cat->category_name }}
                          </td>
        
                     	   @canany(['isClient','isTopManagement','isAdmin'],App\User::class)
                             <td class="display-block">
                              <form action="{{ route('category_details.destroy', $cat->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                          <a rel="tooltip" class="btn btn-success btn-action btn-link view-edit" href="{{ route('category_details.edit', 
                                          $cat->id) }}" data-original-title="" title="">
                                          
                                           
                                            <i class="material-icons">edit</i>
                                            <div class="ripple-container"></div>
                                           </a>
                                      
                                          <button type="button" class="btn btn-danger btn-link view-edit" data-original-title="" title="" 		   
                                          onclick="confirm('{{ __("Are you sure you want to delete this category_details") }}') ? this.parentElement.submit() : ''">
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
          searchPlaceholder: "Search..",
        },
        "columnDefs": [
          { "orderable": false, "targets": 5 },
        ],
      });
    });


 
var resetButtons = document.getElementsByClassName('reset');

// Loop through each reset buttons to bind the click event
for(var i=0; i<resetButtons.length; i++){
  resetButtons[i].addEventListener('click', resetForm);
}

/**
 * Function to hard reset the inputs of a form.
 *
 * @param object event The event object.
 * @return void
 */
function resetForm(event){

  event.preventDefault();

  var form = event.currentTarget.form;
  var inputs = form.querySelectorAll('input');

  inputs.forEach(function(input, index){
    input.value = null;
  });

}
 </script>
@endpush
