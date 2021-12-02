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

     .dt-buttons {
          float: right !important;
          margin-left: 20px;
          margin-right: 20px;
      }

    
      button.dt-button.buttons-excel.buttons-html5.btn-primary {
          border-radius: 5px;
          background-color: #2196f3 !important;
          color: #2196f3 !important;
      }


     
</style>

@extends('layouts.app', ['activePage' => 'outlet_stockexpiry', 'menuParent' => 'Stock_Expiry', 'titlePage' => __('Outlet Stock Report')])

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
                <h4 class="card-title">{{ __('Outlet Stock Report') }}</h4>
              </div>
              <div class="card-body">
              
                 <div class="row">
                    <div class="col-12 text-right">
                      <a class="btn btn-sm btn-warning ml-auto float-right" style="color: #fff;" data-toggle="modal" data-target="#FilterModal" >{{ __('Filter') }}</a>
                    </div>
                  </div>

                   @canany(['isField_Manager'],App\User::class)
                       <div class="row">
                          <a id="export_stock" onclick="export_stock('xlsx')" style="color: #fff;" class="btn btn-sm btn-info ml-auto float-right" >Send To Approval</a>
                      </div>
                  @endcan

                  <div class="row">
                     <span id="mail_sending" class="ml-auto float-right" style="color: red;">Sending please wait..</span>

                  </div>
                  
                <div class="table-responsive">
                  <table id="datatables" class="table table-striped table-no-bordered table-hover">
                    <thead class="text-primary">
                   
                      <th>
                          {{ __('S.No') }}
                      </th>

                      <th>
                          {{ __('Date') }}
                      </th>

                      <th hidden="">
                          {{ __('Customer Code') }}
                      </th>
                      
                      <th hidden="">
                          {{ __('Salesman') }}
                      </th>
                      
                      <th hidden="">
                          {{ __('Account') }}
                      </th>
                      
                      <th>
                          {{ __('Customer Name') }}
                      </th>
                     
                       <th>
                          {{ __('ZREP') }}
                      </th>
                      
          		       <th>
                          {{ __('Description') }}
                      </th>

                      <th>
                          {{ __('Copack / Regular') }}
                      </th>

                      <th>
                          {{ __('Peice Price') }}
                      </th>

                      <th>
                          {{ __('Near Expiry in peices') }}
                      </th>

                      <th>
                          {{ __('Near Expiry Value') }}
                      </th>

                      <th>
                          {{ __('Expire Date') }}
                      </th>

                      <th>
                          {{ __('Period') }}
                      </th>

                       <th>
                          {{ __('Exposure QTY') }}
                      </th>

                       <th>
                          {{ __('Estimate Exposure Value') }}
                      </th>

                       <th hidden="">
                          {{ __('Action By') }}
                      </th>

                       <th>
                          {{ __('View') }}
                      </th>

                      
                     
                    </thead>
                    
                    <tbody>

                      @php

                        $i=1

                      @endphp
                   
              	               
                      @foreach($result as $out)
        
                        <tr>
                        
                          <td>
                            {{ $i++ }}
                          </td>
                          <td>
                            {{  date('d-m-Y', strtotime($out->date)) }}
                          </td>
                          <td hidden="">
                            {{ $out->customer_code }}
                          </td>
                          <td hidden="">
                            {{ $out->salesman_name}}
                          </td>
                          
                          <td hidden="">
                            {{ $out->account }}
                          </td>
                    
                          <td>
                            {{ $out->customer_name }}
                          </td>
                          
                          <td>
                            {{ $out->zrep }}
                          </td>
                          
                          <td>
                            {{ $out->description }}
                          </td>

                           <td>
                            {{ $out->type }}
                          </td>

                           <td>
                            {{ number_format($out->piece_price, 2, '.', ',') }} 
                          </td>

                           <td>
                            {{ $out->near_expiry }}
                          </td>

                           <td>
                            {{ number_format($out->near_expiry_value, 2, '.', ',') }}
                          </td>

                           <td>
                            {{  date('d-m-Y', strtotime($out->expiry_date)) }}
                          </td>

                           <td>
                            {{ 'P' .$out->period }}
                          </td>

                           <td>
                            {{ $out->exposure_qty }}
                          </td>

                            <td>
                            {{ number_format($out->extimate_expire_value, 2, '.', ',') }}
                          </td>

                            <td hidden="">
                            {{ $out->merchandiser_name }}
                          </td>

                           @canany(['isField_Manager','isCDE'],App\User::class)

                          <td class=" td-actions display-block">
                                  
                               <a  rel="tooltip" data-toggle="modal" data-target="#exampleModal"   class="btn btn-info" onclick="view_outletstock_report('{{$out->id}}')" title="View">
                                  <i class="material-icons">visibility</i>
                                </a>      

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

        <form>

          <div class="row">
            <div class="col-lg-6">

              <table class="table table-responsive borderless" >
                      <tr>
                      <th>ZREP</th>
                      <td id="zrep"></td>
                      </tr>

                      <tr>
                      <th>Description</th>
                      <td id="description"></td>
                      <tr>

                      <tr>
                      <th>Copack / Regular</th>
                      <td id="type"></td>
                      </tr> 

                      <tr>
                      <th>Near Expiry Value</th>
                      <td id="near_expiry"></td>
                      </tr>

                      <tr>  
                      <th>Expire Date</th>
                      <td id="expiry_date"></td>
                      </tr>

                      <tr>
                      <th>Period</th>
                      <td id="period"></td>
                      </tr>

                       
                        
                  <!--     <tr>
                       <th>Time Sheet ID</th>
                       <td id="timesheet_id"></td>
                       </tr>

                       
                       <tr>
                       <th>Outlet ID</th>
                       <td id="outlet_id"></td>
                       </tr>-->

                 </table>

            </div>

             <div class="col-lg-6">
              <table class="table table-responsive borderless">
                
                      <!--<tr>
                      <th>Product ID</th>
                      <td id="product_id"></td>
                      </tr>
                      
                      <tr>
                      <th>Merchandiser ID</th>
                      <td id="merchandiser_id"></td>
                      </tr>

                      <tr>
                      <th>Field_Manager_ID</th>
                      <td id="field_manager_id"></td>
                      </tr> 
                      
                      <tr>
                      <th>Sales_Man_ID</th>
                      <td id="sales_man_id"></td>
                      </tr>
                      
                      <tr>
                      <th>Client_ID</th>
                      <td id="client_id"></td>
                      </tr>-->
                       <tr>
                       <th>Exposure QTY</th>
                       <td id="exposure_qty"></td>
                       </tr>

                       <tr>
                       <th>Time</th>
                       <td id="time"></td>
                       </tr>

                      <tr>
                      <th>Field Manager Name</th>
                      <td id="fieldmanager_name"></td>
                      </tr>

                       <tr>
                       <th>Merchandiser_Name</th>
                       <td id="merchandiser_name"></td>
                       </tr>
                       
                       <tr>
                       <th>Client Name</th>
                       <td id="client_name"></td>
                       </tr>

                        <tr>
                        <th>Remarks</th>
                        <td id="remarks"></td>
                        </tr>
                  
                
               
               
              </table>
            </div>
          </div>


          
        </form>
      </div>     
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      
     </div>
    </div>
  </div>
</div>


  <div class="modal fade bd-example-modal-lg" id="FilterModal"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Filter</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  
           <form method="post" action="{{ url('filter_stock_report') }}" class="form-inline" enctype="multipart/form-data" action="" autocomplete="off" style="text-align: right;">
              @csrf
              @method('post')
          
                
                <div class="col-lg-3">
                    

                    <select class="form-control selectpicker" data-style="select-with-transition" title="Select Outlet" data-size="7" name="outlet_id" id="outlet_id" 
                     value="{{ old('outlet_id') }}" aria-required="true">

                      <option value="" disabled=""> Select Outlets</option>
                      @foreach ($outer as $outlet)
                     
                      <option value="{{ $outlet->outlet_id}}" @if ($outlet_id == "$outlet->outlet_id" ) {{ 'selected' }} @endif > {{ $outlet->store[0]->store_code }} - {{ $outlet->store
                     [0]->store_name }} - {{ $outlet->outlet_area }} - {{ $outlet->outlet_city }} </option> 
                        @endforeach
                     </select>

                </div> 



              <div class="col-lg-3">

                 <select class="form-control selectpicker" data-style="select-with-transition" title="Select Merchandiser" data-size="7" name="merchandiser_id" id="merchandiser_id" 
                     value="{{ old('merchandiser_id') }}" aria-required="true">

                     <option value="" selected disabled>Select Merchandiser</option>
                        @foreach ($merchandisers as $merchants)
                      <option value="{{ $merchants->employee_id}}" @if ($employee_id == "$merchants->employee_id" ) {{ 'selected' }} @endif  > {{ $merchants->first_name }} {{ $merchants->middle_name }} {{ $merchants->surname }} ({{ $merchants->employee_id}})</option>
                        @endforeach
                       
                    </select>       

               </div>


                <div class="col-lg-3">
                 <input type="text" class="form-control" value="{{ $zrep_code }}" id="zrep_code" placeholder="Zrep Code" name="zrep_code">
               </div> 



                <div class="col-lg-3">
                 <input type="text" class="form-control datepicker" value="{{ $date }}" id="date" placeholder="Date" name="date">
               </div> <br>

              
                 <button type="submit" style="margin-top: 30px;"  class="btn btn-finish btn-fill btn-rose btn-wd mx-auto d-block" name="Filter" value="Filter">{{ __('Filter') }}</button>

            </form>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      
      </div>
    </div>
  </div>
</div>

@endsection

@push('js')
    
     <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  <script>

    $("#mail_sending").hide();

     $('.datepicker').datetimepicker({
         // viewMode : 'months',
          format : 'DD-MM-YYYY',
          toolbarPlacement: "top",
          allowInputToggle: true,
          useCurrent: true,
    }); 


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
        dom: 'lBfrtip',
        language: {
          search: "_INPUT_",
          searchPlaceholder: "Search..",
        },
        buttons: [{
            extend: 'excelHtml5',
            className: 'btn-primary',
            text: 'Export',
            filename: function(){
                var dt = new Date();
                dt.getDate() + "/" + (dt.getMonth() + 1) + "/" + dt.getFullYear();
                return 'stock-report-' + dt;
            },
            //title: 'alpin_excel',
            exportOptions: {
                modifier: {
                    page: 'all'
                },
                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 12, 13, 14, 15, 16],
            },

        responsive: true,
          

        }],
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

            //alert(JSON.stringify(data[0]['id']));

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
           url: '/view_outletstock_report',
          type: 'POST',
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

    function view_outletstock_report(id){
      //alert(id);
      var csrf = $('meta[name="csrf-token"]').attr('content');
      $.ajax({
          url: '/view_outletstock',
          type: 'GET',
          data: {id : id, '_token': csrf},
          dataType: 'json',

          success: function( data ) {
                //alert(data);


           //alert(JSON.stringify(data[0]['id']));

            $("#zrep").html(': '+data[0]['zrep']);
            $("#description").html(': '+data[0]['description']);
            $("#type").html(': '+data[0]['type']);
            $("#near_expiry").html(': '+data[0]['near_expiry']);
            $("#expiry_date").html(': '+data[0]['expiry_date']);
            $("#period").html(': '+data[0]['period']);
            $("#exposure_qty").html(': '+data[0]['exposure_qty']);
            $("#time").html(': '+data[0]['time']);
            $("#timesheet_id").html(': '+data[0]['timesheet_id']);
            $("#outlet_id").html(': '+data[0]['outlet_id']);


            $("#product_id").html(': '+data[0]['product_id']);
            $("#merchandiser_id").html(': '+data[0]['merchandiser_id']);
            $("#field_manager_id").html(': '+data[0]['field_manager_id']);
            $("#sales_man_id").html(': '+data[0]['sales_man_id']);
            $("#client_id").html(': '+data[0]['client_id']);
            $("#fieldmanager_name").html(': '+data[0]['fieldmanager_name']);
            $("#merchandiser_name").html(': '+data[0]['merchandiser_name']);
            $("#client_name").html(': '+data[0]['client_name']);
            $("#remarks").html(': '+data[0]['remarks']);
            

          }       
      })

    }


    function export_stock(type){

         var csrf = $('meta[name="csrf-token"]').attr('content');

         var customer_code = $("#customer_code").val();

         var zrep_code = $("#zrep_code").val();

         var date = $("#date").val();

          Swal.fire({
          title: 'Are you sure?',
          text: "You can't able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, send it!'
        }).then((result) => {
          if (result.isConfirmed) {

            $("#mail_sending").show();

            //$('#export_stock').attr("disabled","disabled");

            $('#export_stock').css("pointer-events","none");

          $.ajax({
              url: '/export-stock',
              type: 'GET',
              data: {customer_code : customer_code, zrep_code : zrep_code, date : date, type : type, '_token': csrf},
              dataType: 'json',

              success: function( data ) {

                 $("#mail_sending").hide();
                // alert(data);
                $('#export_stock').css("pointer-events","auto");

                if(data == 1)
                {
                    Swal.fire(
                      'Sent!',
                      'Mail Send Successfully..',
                      'success'
                    );
                }

                if(data == 0)
                {
                    Swal.fire(
                      'Error!',
                      'Problem in sending mail..',
                      'danger'
                    );
                }
                   

              }       
          });
        }
     });

 }


  </script>
@endpush
