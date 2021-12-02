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

    .parent ~ .cchild {
    display: none;
  }
  .open .parent ~ .cchild {
    display: table-row;
  }
  .parent {
    cursor: pointer;
  }
  tbody {
    color: #212121;
  }
  .open {
    background-color: #e6e6e6;
  }

  .open .cchild {
    background-color: #999;
    color: white;
  }
  .parent > *:last-child {
    width: 30px;
  }
  .parent i {
    transform: rotate(0deg);
    transition: transform .3s cubic-bezier(.4,0,.2,1);
   /* margin: -.5rem;
    padding: .5rem;*/
   
  }
  .open .parent i {
    transform: rotate(180deg)
  }

  .table .td-actions .btn {
    margin: 0px;
    padding: 1px !important;
}

  .dt-buttons {
        float: right !important;
        margin-left: 20px;
        margin-right: 0px;
      }

  button.dt-button.buttons-excel.buttons-html5.btn-primary {
      border-radius: 5px;
  }


</style>

@extends('layouts.app', ['activePage' => 'unscheduled_outlets', 'menuParent' => 'Timesheets', 'titlePage' => __('Timesheets')])

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
                <h4 class="card-title">{{ __('Unscheduled Timesheets') }}</h4>
              </div>

              <div class="card-body">

                  @canany(['isField_Manager','isAdmin','isTopManagement','isCDE'],App\User::class)
                 <div class="row">
                    <div class="col-12 text-right">
                      <a class="btn btn-sm btn-warning" style="color: #fff;" data-toggle="modal" data-target="#FilterModal" >{{ __('Filter') }}</a>
                    </div>
                  </div>

                   @endcan

                @canany(['isField_Manager','isCDE'],App\User::class)
                <div class="row">
                
                    <div class="col-12 text-right">
        
                      <a href="{{ route('unschedule-outlets.create') }}" class="btn btn-sm btn-rose">{{ __(' Add Unscheduled Outlets ') }}</a>
                       
                    </div>
                  </div>
                @endcan

                 <!--   <a onclick="export_timesheet('xlsx')" class="btn btn-info ml-auto float-right">Send To Approval</a>
 -->
                   @php 

                       $route = \Request::route()->getName();

                       if ($route == "filter_timesheet") 
                       {

                             $emp_id = $employee_id;
                            
                        }

                        else
                        {
                            $emp_id = '';
                        }

                     @endphp

                   

                    
               
                <div class="table-responsive">
              

                    <table id="datatables" class="table table-no-bordered">    
                        
                        <thead class="text-primary">
                         <tr>
                             <th>
                                  {{ __('Merchandiser') }}
                              </th>

                               @canany(['isAdmin','isTopManagement'],App\User::class)
                                <th>
                                  {{ __('Field Manager') }}
                                </th>
                               @endcan 

                                <th>
                                  {{ __('Store Code') }}
                              </th>

                                <th>
                                  {{ __('Location') }}
                              </th>

                              <th>
                                  {{ __('Date') }}
                              </th>

                               <th>
                                  {{ __('Start Time') }}
                              </th>

                               <th>
                                  {{ __('End Time') }}
                              </th>

                              <th>
                                  {{ __('Total Working Time') }}
                              </th>
                            
                             

                               @canany(['isField_Manager','isCDE'],App\User::class)
                               <th>
                                  {{ __('Action') }}
                              </th>
                               @endcan

                           </tr>
                      </thead>

                          @php

                            $i=1;

                            $k = 1;

                            $array_parent = [];

                            $array_child = [];

                            $result = '';

                            $startDate = '2021-02-01';
                            $endDate = '2021-02-18';

                            $HowManyWeeks = (strtotime(  $endDate ) - strtotime( $startDate )) / 604800;

                            
                          @endphp

                        <tbody>   


                        @foreach($outlets as $parent)

                            <tr class="parent">
                              <!-- <td>
                                {{ $i++ }}
                              </td> -->

                            <td>
                               {{ $parent->m_fname }} {{ $parent->m_mname }} {{ $parent->m_sname }} ({{ $parent->employee_id}})
                            </td>

                               @canany(['isAdmin','isTopManagement'],App\User::class)
                                    <td>
                                        {{ $parent->f_fname }} {{ $parent->f_mname }} {{ $parent->f_sname }}
                                    </td>

                               @endcan 

                                <td>
                                    {{ $parent->store_code }}
                                </td>

                                <td>
                                    {{ $parent->store_name }}-{{ $parent->address }}
                                </td>
                             
                                <td>
                                {{ date('d-m-Y', strtotime($parent->date)) }}
                            </td>

                            @if($parent->checkin_time)
                              <td>
                                {{ date('h:i A', strtotime($parent->checkin_time)) }}
                              </td>
                            @else
                                <td>
                                {{ '-' }}
                              </td>
                            @endif

                            @if($parent->checkout_time)
                              <td>
                                {{ date('h:i A', strtotime($parent->checkout_time)) }}
                              </td>
                              @else
                                <td>
                                {{ '-' }}
                              </td>
                            @endif

                            @if($parent->checkin_time && $parent->checkout_time )
                              <td>
                                @php
                                 $start = \Carbon\Carbon::createFromFormat('Y-m-d h:i A', $parent->date.date('h:i A', strtotime($parent->checkin_time)));
                                    $end = \Carbon\Carbon::createFromFormat('Y-m-d h:i A', date('Y-m-d', strtotime($parent->updated_at)).date('h:i A', strtotime($parent->checkout_time)));
                                @endphp
                                {{ $start->diff($end)->format('%H:%I') }}
                              </td>
                                @else
                                <td>
                                    {{ '-' }}
                                </td>
                            @endif

                     @canany(['isField_Manager','isCDE'],App\User::class)          
                              
                        <td class="td-actions">
                            

                             <form action="{{ route('unschedule-outlets.destroy', $parent->id) }}" method="post">
                                  @csrf
                                  @method('delete')
                             
                                 <a onclick="confirm('{{ __("Are you sure you want to delete this timesheet?") }}') ? this.parentElement.submit() : ''"  class="btn btn-danger" title="Delete">
                                  <i class="material-icons">close</i>
                                </a>
                                      
                                        
                                      
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

  <div class="modal fade bd-example-modal-lg" id="FilterModal"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Filter</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

           <form method="get" action="{{ url('filter_unscheduled_outlet') }}" class="form-inline" enctype="multipart/form-data" action="" autocomplete="off" style="text-align: right;">
              @csrf
              @method('get')
          
               <div class="col-lg-6">

                 <select class="form-control js-select2" data-style="select-with-transition" title="Select Merchandiser" data-size="7" name="employee_id" id="input-days" 
                     value="{{ old('employee_id') }}" aria-required="true">

                     <option value="" selected disabled>Select Merchandiser</option>
                        @foreach ($merchandisers as $merchants)
                      <option value="{{ $merchants->employee_id}}" @if ($employee_id == "$merchants->employee_id" ) {{ 'selected' }} @endif  > {{ $merchants->first_name }} {{ $merchants->middle_name }} {{ $merchants->surname }} ({{ $merchants->employee_id}})</option>
                        @endforeach
                       
                    </select>
              
               
                    

               </div>

             
                <div class="col-lg-3">
                 <input type="text" class="form-control datepicker" value="{{ $startdate }}" id="startdate" placeholder="Start Date" name="startdate">
               </div> 



                <div class="col-lg-3">
                 <input type="text" class="form-control datepicker" value="{{ $enddate }}" id="enddate" placeholder="End Date" name="enddate">
               </div> 

              
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
  <script>

    
      $('.datepicker').datetimepicker({
         // viewMode : 'months',
          format : 'DD-MM-YYYY',
          toolbarPlacement: "top",
          allowInputToggle: true,
          useCurrent: true,
    }); 


     $('.datepicker_year').datetimepicker({
          viewMode : 'years',
          format : 'YYYY',
          toolbarPlacement: "top",
          allowInputToggle: true,
          useCurrent: false,
    }); 

       $(".js-select2").select2();

    $('.js-select2').select2({
        dropdownParent: $('#FilterModal')
    });
  

    $('table').on('click', 'tr.parent .expand', function(){
      $(this).closest('tbody').toggleClass('open');
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
      $('#datatables').fadeIn(1100);

       var Role = "{{ (Auth::user()->role->name) }}"
       //alert(Role);

        var collapsedGroups = {};

     if(Role == "Top Management" || Role == "Admin")  
      {
            var table = $('#datatables').DataTable({

          order: [[2, 'asc']],  
          "paging":   true,  

           dom: 'lBfrtip',
       
            buttons: [{
                extend: 'excelHtml5',
                className: 'btn-primary',
                text: 'Export',
                filename: function(){
                    var dt = new Date();
                    dt.getDate() + "/" + (dt.getMonth() + 1) + "/" + dt.getFullYear();
                    return 'un_schedule_excel-' + dt;
                },
                //title: 'alpin_excel',
                exportOptions: {
                    modifier: {
                        page: 'all'
                    },
                    columns: [0, 1, 2, 3,4,5,6,7],
                },
              

            }],

          rowGroup: {
            // Uses the 'row group' plugin
            dataSrc: 2,
            startRender: function (rows, group) {
                var collapsed = !!collapsedGroups[group];

                rows.nodes().each(function (r) {
                    r.style.display = collapsed ? 'none' : '';
                });    

                // Add category name to the <tr>. NOTE: Hardcoded colspan
                return $('<tr/>')
                    .append('<td colspan="8" style="cursor:pointer;">' + group + ' (' + rows.count() + ')</td>')
                    .attr('data-name', group)
                    .toggleClass('collapsed', collapsed);
            }
          }
        });
      }

    if(Role == "Field Manager" || Role == "CDE")  
      {
            var table = $('#datatables').DataTable({

          order: [[2, 'asc']], 
          "paging":   true,

           dom: 'lBfrtip',
       
            buttons: [{
                extend: 'excelHtml5',
                className: 'btn-primary',
                text: 'Export',
                filename: function(){
                    var dt = new Date();
                    dt.getDate() + "/" + (dt.getMonth() + 1) + "/" + dt.getFullYear();
                    return 'un_schedule_excel-' + dt;
                },
                //title: 'alpin_excel',
                exportOptions: {
                    modifier: {
                        page: 'all'
                    },
                    columns: [0, 1, 2, 3,4,5,6],
                },
              

            }],

          rowGroup: {
            // Uses the 'row group' plugin
            dataSrc: 2,
            startRender: function (rows, group) {
                var collapsed = !!collapsedGroups[group];

                rows.nodes().each(function (r) {
                    r.style.display = collapsed ? 'none' : '';
                });    

                // Add category name to the <tr>. NOTE: Hardcoded colspan
                return $('<tr/>')
                    .append('<td colspan="8" style="cursor:pointer;">' + group + ' (' + rows.count() + ')</td>')
                    .attr('data-name', group)
                    .toggleClass('collapsed', collapsed);
            }
          }
        });
      }

     

       $('#datatables tbody').on('click', 'tr.group-start', function () {
            var name = $(this).data('name');
            collapsedGroups[name] = !collapsedGroups[name];
            table.draw(false);
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

             // alert(JSON.stringify(data[0]['id']));

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
     

     function export_timesheet(type){
        
         var csrf = $('meta[name="csrf-token"]').attr('content');

         var emp_id = $("#employee_id").val();

         var specific_date = $("#specific_date").val();

         var specific_month = $("#specific_month").val();

         var year = $("#year").val();

          $.ajax({
              url: '/export-timesheet',
              type: 'POST',
              data: {type : type, employee_id : emp_id, specific_date : specific_date, specific_month : specific_month, year : year, '_token': csrf},
              dataType: 'json',

              success: function( data ) {
                 alert(data);

                
              }       
          })
     }


  </script>
@endpush
