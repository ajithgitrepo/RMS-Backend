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

@extends('layouts.app', ['activePage' => 'outlet_stockexpiry', 'menuParent' => 'laravel', 'titlePage' => __('Outlet Stock Expiry')])

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
                <h4 class="card-title">{{ __('Outlet Stock Expiry') }}</h4>
              </div>
              <div class="card-body">
              
               @canany(['isField_Manager'],App\User::class)
                  <div class="row">
                    <div class="col-12 text-right">
                      <a href="{{ route('outlet_stockexpiry.create') }}" class="btn btn-sm btn-rose">{{ __('Add Outlet Stock Expiry') }}</a>
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
                          {{ __('Outlet id') }}
                      </th>
                      
                      <th>
                          {{ __('Product Name') }}
                      </th>
                      
                      <th>
                          {{ __('Total Available Carton') }}
                      </th>
                      
                      <th>
                          {{ __('Total Available Cases') }}
                      </th>
                     
                       <th>
                          {{ __('Total Available Pieces') }}
                      </th>
                      
          		<th>
                          {{ __('Expiry Date') }}
                      </th>
                      
                      
               
                         <th class="display-block">
                            {{ __('Action') }}
                        </th>
                     
                    </thead>
                    
                    <tbody>

                      @php

                        $i=1

                      @endphp
                   
              	               
                      @foreach($outlet_stock as $out)
        
                        <tr>
                        
                          <td>
                            {{ $i++ }}
                          </td>
                          <td>
                            {{ $out->outlet_id }}
                          </td>
                          <td>
                            {{ $out->product->product_name}}
                          </td>
                          
                          <td>
                            {{ $out->total_available_carton }}
                          </td>
                    
                          <td>
                            {{ $out->total_available_cases }}
                          </td>
                          
                          <td>
                            {{ $out->total_available_pieces }}
                          </td>
                          
                          <td>
                            {{ $out->expiry_date }}
                          </td>
                         
                          
                           
                          
                           @canany(['isField_Manager'],App\User::class)
                           
                           <td class="display-block">
                              <form action="{{ route('outlet_stockexpiry.destroy', $out->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <a rel="tooltip" class="btn btn-info btn-action btn-link view-edit" data-toggle="modal" data-target="#exampleModal" data-original-title="" title="" onclick="view_outletstock('{{$out->id}}')" >   
                                            <i class="fa fa-eye" aria-hidden="true">view</i>
                                       </a>  
                                          <a rel="tooltip" class="btn btn-success btn-action btn-link view-edit" href="{{ route('outlet_stockexpiry.edit', 
                                           $out->id) }}" data-original-title="" title="">
                                            <i class="material-icons">edit</i>
                                            <div class="ripple-container"></div>
                                           </a>
                                      
                                          <button type="button" class="btn btn-danger btn-link view-edit" data-original-title="" title=""    onclick="confirm('{{ __("Are you sure you want to delete this outlet_stockexpiry?") }}') ? this.parentElement.submit() : ''">
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

    <!-- Model for outlet_stock view -->
  
 <div class="modal fade bd-example-modal-lg" id="OutletModal"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
   
    
    
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">More Information</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
   
    <div class="modal-body">
          
          
          <div class="row" id="carton">
         
          </div>
   
   	  <div class="row" id="case"data-name="Case_Picture" >
	  
          </div>
  
          <div class="row" id="piece">
      
          </div>
         
      <div class="panel-heading">
      <div class="modal-dialog modal-dialog-center">
        
          
        <form>
                              
           <div class="row">
            <div class="col-lg-6">

              <table class="table table-responsive borderless" >
           
                  <tr>  
                  <th>Remarks</th>
                  <td id="remarks"></td>
                  </tr>
                
            	  <tr>
                  <th>Sales_Man_Id </th>
                  <td id="sales_man_id"></td>
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

            alert(JSON.stringify(data[0]['id']));

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
    
    function view_outletstock(id){
    //alert(id);
      var csrf = $('meta[name="csrf-token"]').attr('content');
      $.ajax({
           url: '/view_outletstock',
          type: 'GET',
          data: {id : id, '_token': csrf},
          dataType: 'json',

          success: function( data ) {
         
   //alert(data[0]); 
            
          var documents  = data[0]['carton_picture'];
           var documents1 = data[0]['case_picture'];
            var documents2 = data[0]['piece_picture'];
            
            var array = documents.split(',');
             var array1 = documents1.split(',');
              var array2 = documents2.split(',');

            	 var html = '';
             	 var html1 = '';
              	 var html2 = '';
              	  
              	html += ' <div>';
              	html += 'carton_picture';
               html += ' <div class="row-lg-4">' ;
             
              $.each(array, function (key, val) {
                  //alert(val);
         	    
                   html += ' <embed style="margin-bottom: 10px;" src="/outletstock/'+val+' " width="250" height="200" />';
                   html += ' <a style="font-size: 30px;" href="/outletstock/'+val+'" target="_blank"><i class="fa fa-download"></i></a>';

            });
          	html += ' </div>';
          	html += ' </div>';
          	
                
              html += ' <div>';
             
              html += 'case_picture';
          
              html += ' <div class="row-lg-4">' ;
              
             
              $.each(array1, function (key1, val1) {
                    //alert(val1);
               html += ' <embed style="margin-bottom: 10px;" src="/outletstock/'+val1+' " width="250" height="200" />';
                   html += ' <a style="font-size: 30px;" href="/outletstock/'+val1+'" target="_blank"><i class="fa fa-download"></i></a>';

             });
              html += ' </div>';
              html += ' </div>';
              
              
              html += ' <div>';
              html += 'piece_picture ';
              html += ' <div class="row-lg-4">' ;
         
             $.each(array2, function (key2, val2) {
                    //alert(val2);
             
                 html += ' <embed style="margin-bottom: 10px;" src="/outletstock/'+val2+' " width="250" height="200" />';
                 html += ' <a style="font-size: 30px;" href="/outletstock/'+val2+'" target="_blank"><i class="fa fa-download"></i></a>';
   
              });
    	   
              html += ' </div>';
      	      html += ' </div>';
     
     
            $("#carton").html(html);
            $("#case").html(html1);
            $("#piece").html(html2);

            $('#OutletModal').modal('show'); 

            
            
            $("#remarks") .html(': '+data[0]['remarks']);
            $("#sales_man_id").html(': '+data[0]['sales_man_id']);
            
          
          }       
      })
    
    }

  </script>
@endpush
