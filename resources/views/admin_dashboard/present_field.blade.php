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

@extends('layouts.app', ['activePage' => 'present_field', 'menuParent' => 'Live_Data', 'titlePage' => __('Live Data')])

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
                <h4 class="card-title">{{ __('Present Field Managers') }}</h4>
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
                                  {{ __('Login Time') }}
                              </th>

                              
                              
                          </tr>
                      </thead>


                          @php

                            $i=1;

                          
                            
                          @endphp

                         
                        <tbody> 
                                

                        @foreach($result as $field)


                            <tr >
                              <td>
                                {{ $i++ }}
                              </td>
                               <td>
                               {{ $field->first_name }} {{ $field->surname }} ({{ $field->employee_id}})
                              </td>

                              <th hidden>
                                   {{ date('d-m-Y', strtotime($field->date)) }}
                              </th>
                           
                             <td>
                                {{ date('h:i A', strtotime($field->checkin_time)) }}
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
                    return 'present_field_managers-' + dt;
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
