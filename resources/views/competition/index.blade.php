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

@extends('layouts.app', ['activePage' => 'Promotion', 'menuParent' => 'Promotion', 'titlePage' => __('Competitor Info')])

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
                <h4 class="card-title">{{ __('Promotion') }}</h4>
              </div>
              <div class="card-body">
               @canany(['isHuman_Resource','isField_Manager'],App\User::class)
                  <div class="row">
                    <div class="col-12 text-right">
                      <a href="{{ route('competition.create') }}" class="btn btn-sm btn-rose">{{ __('Add Promotion') }}</a>
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
                          {{ __('Company_Name') }}
                      </th>
                      
                      <th>
                          {{ __('Brand_Name') }}
                      </th>
                      
                      <th>
                          {{ __('Item_Name') }}
                      </th>
                      
                      <th>
                          {{ __('Promotion_Type') }}
                      </th>
                     
                      
                      
                     <th class="display-block">
                            {{ __('Action') }}
                        </th>
                     
                    </thead>
                    
                    <tbody>

                      @php

                        $i=1

                      @endphp
                   
              	               
                      @foreach($promotion as $promo)
         
                        <tr>
                        
                          <td>
                            {{ $i++ }}
                          </td>
                           <td>
                            {{ $promo->company_name }}
                           </td>
                           <td>
                            {{ $promo->brand[0]->brand_name }}
                          </td>
                          
                          <td>
                            {{ $promo->item_name }}
                          </td>
                          
                          <td>
                            {{ $promo->promotion_type }}
                          </td>
                          
                         
                          
                          
                           @canany(['isHuman_Resource','isField_Manager'],App\User::class)
                           
                           <td class="display-block">
                              <form action="{{ route('competition.destroy', $promo->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        
                                         <a rel="tooltip" class="btn btn-info btn-action btn-link view-edit" data-toggle="modal" data-target="#exampleModal" 
                                         data-original-title="" title="" onclick="view_promotion('{{$promo->id }}')" >   
                                            <i class="fa fa-eye" aria-hidden="true">view</i>
                                        </a>  
                                          <a rel="tooltip" class="btn btn-success btn-action btn-link view-edit" href="{{ route('competition.edit', 
                                           $promo->id) }}" data-original-title="" title="">
                                            <i class="material-icons">edit</i>
                                            <div class="ripple-container"></div>
                                           </a>
                                      
                                          <button type="button" class="btn btn-danger btn-link view-edit" data-original-title="" title="" 
                                            onclick="confirm('{{ __("Are you sure you want to delete this promotion?") }}') ? this.parentElement.submit() : ''">
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

   <!-- Model for Promotion_details_view -->
  
 <div class="modal fade bd-example-modal-lg" id="exampleModal"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">

  <div class="modal-dialog modal-lg">
  
   
    <div class="modal-content">
    
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">More Information</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
   
      <div class="modal-body">
      
         <div class="row" id="capture" >
         
         </div>
   
      <div class="panel-heading">
       <div class="modal-dialog modal-dialog-center">
       
        <form>
       
           <div class="row">
            <div class="col-lg-6">

              <table class="table table-responsive borderless" >
      
                 <tr>  
                  <th>Promotion_Description</th>
                  <td id="promotion_description"></td>
                 </tr>
                
                 <tr>
                  <th>MPR </th>
                  <td id="mpr"></td>
                 </tr>
                
                 <tr>
                  <th>Selling_Price </th>
                  <td id="selling_price"></td>
                 </tr>
            
            	 
                 
              </table>

            	
		
           </div>
         </div>

      </form>
      
     </div>
    </div>    
         
         
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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

   
      function view_promotion(id)
      {
     //alert(id);
      var csrf = $('meta[name="csrf-token"]').attr('content');
      $.ajax({
          url: '/view_promotion',
          type: 'GET',
          data: {id : id, '_token': csrf},
          dataType: 'json',

          success: function( data )
           {
             //alert(data);

             // alert(JSON.stringify(data[0]['id']));
             
               var documents  = data[0]['capture_image'];
                var array = documents.split(',');
                 var html = '';
                 
                html += ' <div>';
              	html += 'capture_image';
               html += ' <div class="row-lg-4">' ;
             
              $.each(array, function (key, val) {
                  //alert(val);
         	    
                   html += ' <embed style="margin-bottom: 10px;" src="/capture_image/'+val+' " width="250" height="200" />';
                   html += ' <a style="font-size: 30px;" href="/capture_image/'+val+'" target="_blank"><i class="fa fa-download"></i></a>';

            });
          	html += ' </div>';
          	html += ' </div>';
          	
            $("#capture").html(html);
            

            $('#exampleModal').modal('show'); 
            

            $("#promotion_description").html(': '+data[0]['promotion_description']);
            $("#mpr").html(': '+data[0]['mpr']);
            $("#selling_price").html(': '+data[0]['selling_price'])
           
           

          }       
      })

    }
 
  </script>
@endpush
