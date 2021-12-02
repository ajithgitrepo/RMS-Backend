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

@extends('layouts.app', ['activePage' => 'promotion-report', 'menuParent' => 'Promotion', 'titlePage' => __('Promotion')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
        
            <div class="card">
             
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="fa fa-tag"></i>
                 </div>
                <h4 class="card-title">{{ __('Promotion Report') }}</h4>
               </div>
               
              <div class="card-body">
            <!--   
               @canany(['isHuman_Resource','isField_Manager'],App\User::class)
                  <div class="row">
                    <div class="col-12 text-right">
                      <a href="{{ route('promotion.create') }}" class="btn btn-sm btn-rose">{{ __('Add Promotion') }}</a>
                    </div>
                  </div>
                @endcan -->
                
                <div class="table-responsive">
                  <table id="datatables" class="table table-striped table-no-bordered table-hover" >
                  
                    <thead class="text-primary">
                    
                      <th>
                          {{ __('S.No') }}
                      </th>

                      <th>
                          {{ __('Date') }}
                      </th>
                      
                      <th>
                          {{ __('Outlet') }}
                      </th>
                      
                      <th>
                          {{ __('Product / SKU') }}
                      </th>
                      
                      <th>
                          {{ __('Available?') }}
                     </th>

                     <th>
                          {{ __('Image / Reason') }}
                     </th>

                     <th hidden="">
                          {{ __('Image_url / Reason') }}
                     </th>

                    </thead>
                    
                    <tbody>

                      @php

                        $i=0

                      @endphp


                       @foreach($result as $report)
                     
                        <tr>
                        
                          <td>
                            {{ ++$i }}
                          </td>

                        <td>
                            {{ date('d-m-Y', strtotime($report->created_at)) }}
                          </td>
                          
                          <td>
                             {{ $report->store_code }} - {{ $report->store_name  }} - {{ $report->address }} - {{ $report->outlet_city }}
                          </td>
                          
                          <td>
                            {{ $report->product_name  }}
                          </td>


                            @if($report->is_available ==1)
                               <td>
                                {{ __('Available')  }}
                               </td>
                                <td>
                                 <img id="" src="/promotion_image/{{ $report->image_url }}"  onclick="DoSomething(this.src);" alt="" style="width: 80px;height: 60px;">
                               </td>
                            @endif

                            @if($report->is_available ==0)
                               <td>
                                {{ __('Not Available')  }}
                               </td>
                               <td>
                                {{ $report->reason }}
                               </td>
                            @endif

                            @if($report->is_available ==1)
                               
                            <td  hidden="true">
                                <a href="https://rms2.rhapsody.ae/promotion_image/{{ $report->image_url }}" target="_blank">https://rms2.rhapsody.ae/promotion_image/{{ $report->image_url }}</a>
                            </td>
                            @endif

                              @if($report->is_available ==0)
                              
                               <td hidden="true">
                                {{ $report->reason }}
                               </td>
                            @endif


                          
                          
              
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


  <!-- Classic Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"> Image View</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <i class="material-icons">clear</i>
          </button>
        </div>
        <div class="modal-body">
         
            <img style="height:330px;width:450px;" src="" id="FullImage"> </img>
        </div>
        <div class="modal-footer">
        
          <button type="button" class="btn btn-danger btn-link" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!--  End Modal -->

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
                return 'promotion-report' + dt;
            },
            //title: 'alpin_excel',
            exportOptions: {
                modifier: {
                    page: 'all'
                },
                columns: [2, 1, 3, 4, 6 ],
            },

        responsive: true,
          

        }],
      });
    });


    function DoSomething(data)
    {
     // alert(data);
      $('#FullImage').attr('src',data );
      $('#myModal').modal('show');

    }
    
   
     
  </script>
@endpush
