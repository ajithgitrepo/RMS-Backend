<style>


 .dt-buttons {
        float: right !important;
        margin-left: 20px;
        margin-right: 0px;
      }

  button.dt-button.buttons-excel.buttons-html5.btn-primary {
      border-radius: 5px;
  }

</style>

@extends('layouts.app', ['activePage' => 'absent_merchant', 'menuParent' => 'Live_Data', 'titlePage' => __('Live Data')])

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
                <h4 class="card-title">{{ __('Absent Merchandiser') }}</h4>
              </div>

              <div class="card-body">

                
               
                <div class="table-responsive">
               

                    <table id="datatables" class="table table-no-bordered">    
                        
                        <thead class="text-primary">
                         <tr>
                              <th>
                                  {{ __('#') }}
                              </th>
                               <th>
                                  {{ __('Name') }}
                              </th>
                             
                              <th hidden>
                                  {{ __('Date') }}
                              </th>
                               <th>
                                  {{ __('Reason') }}
                              </th>

                              
                              
                              
                          </tr>
                      </thead>


                          @php

                            $i=1;

                          
                            
                          @endphp

                         
                        <tbody> 
                                

                        @foreach($result as $merchant)


                            <tr >
                              <td>
                                {{ $i++ }}
                              </td>
                               <td>
                               {{ $merchant->first_name }} {{ $merchant->surname }} ({{ $merchant->employee_id}})
                              </td>


                              <td hidden>
                                   {{ date('d-m-Y', strtotime($merchant->date)) }}
                              </td>
                            
                                <td>
                                    {{ $merchant->reason }}
                                </td>

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


    $(document).ready(function() {
      $('#datatables').fadeIn(1100);

       var collapsedGroups = {};

       var table = $('#datatables').DataTable({

          "paging":   true, 
          dom: 'lBfrtip',
       
            buttons: [{
                extend: 'excelHtml5',
                className: 'btn-primary',
                text: 'Export',
                filename: function(){
                    var dt = new Date();
                    dt.getDate() + "/" + (dt.getMonth() + 1) + "/" + dt.getFullYear();
                    return 'absent_merchandisers-' + dt;
                },
                //title: 'alpin_excel',
                exportOptions: {
                    modifier: {
                        page: 'all'
                    },
                    columns: [0, 1, 2,3],
                },
              

            }],

        });

   });

   

  </script>
@endpush
