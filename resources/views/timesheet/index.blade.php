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
    /*margin: -.5rem;
    padding: .5rem;*/
   
  }
  .open .parent i {
    transform: rotate(180deg)
  }

</style>

@extends('layouts.app', ['activePage' => 'day-timesheet', 'menuParent' => 'Timesheet', 'titlePage' => __('TimeSheet')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">schedule</i>
                </div>
                <h4 class="card-title">{{ __(' Scheduled Timesheet') }}</h4>
              </div>
              <div class="card-body">

            <form method="post" action="{{ url('filter_timesheet') }}" class="form-inline" enctype="multipart/form-data" action="" autocomplete="off" style="text-align: right;">
              @csrf
              @method('post')
          
               <div class="col-lg-3">
                
               </div>
               <div class="col-lg-4">
                
               </div>


                <div class="col-lg-3">
                     <input type="text" class="form-control datepicker" value="{{ $date }}" id="date" placeholder="Start Date" name="date">
               </div>

                 <button type="submit"  class="btn btn-finish btn-fill ml-auto btn-rose btn-wd d-block" name="Filter" value="Filter">{{ __('Filter') }}</button>

                <!--  <a href="{{ url('/') }}/export/xlsx" class="btn btn-info ml-auto">Export to Excel</a>
 -->

            </form>

                <div class="table-responsive">

                 <table id="datatables" class="table table-no-bordered">    
                        <thead>
                         <tr>
                         <!--  <th>
                             {{ __('#') }}
                          </th>
                          <th>
                              {{ __('Outlet Id') }}
                          </th> -->
                           <th>
                              {{ __('Date') }}
                          </th>
                          <th>
                              {{ __('Outlet Name') }}  
                          </th>
                          <th>
                              {{ __('Outlet Area') }}
                          </th>
                          <th>
                              {{ __('Outlet City') }}
                          </th>
                          <th>
                              {{ __('Outlet State ') }}
                          </th>
                          <th>
                              {{ __('Outlet Country') }}
                          </th>
                          <th>
                              {{ __('Status') }}
                          </th>
                          
                              
                        </tr>
                        </thead>

                          @php

                            $i=1;

                            $k = 1;

                            $array_parent = [];

                            $array_child = [];



                            $result = '';

                          @endphp
                               
                        <tbody>            

                        @foreach($outlets as $parent)
                          
                           
                            <tr class="parent">
                             <!--  <td>
                                {{ $i++ }}
                              </td>
                               <td>
                            
                                {{ $parent->outlet_id }}

                              </td> -->
                             
                             <td>  
                                {{ date('d-m-Y', strtotime($parent->date)) }} 
                            </td>
                            <td>
                               {{ $parent->store_name }}
                              </td>
                              <td>
                                {{ $parent->outlet->outlet_area }}
                              </td>
                              <td>
                                {{ $parent->outlet->outlet_city }}
                              </td>
                              <td>
                                {{ $parent->outlet->outlet_state }}
                              </td>
                              <td>
                                {{ $parent->outlet->outlet_country }}
                              </td>
                              
                               
                                  @if($parent->is_completed =='1')
                                   <td style="color: green;">
                                      {{ __('Completed') }}
                                    </td>
                                 @endif
                               
                                 @if($parent->is_completed =='0')
                                   <td style="color: red;">
                                      {{ __('Pending') }}
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

  

@endsection

@push('js')
  <script>

     $('.datepicker').datetimepicker({
          format : 'DD-MM-YYYY',
          useCurrent: true,
    }); 

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('table').on('click', 'tr.parent .expand', function(){
      $(this).closest('tbody').toggleClass('open');
    });

    $(document).ready(function() {
      $('#datatables').fadeIn(1100);

      // $('#datatables').DataTable({
      //   "pagingType": "full_numbers",
      //   "lengthMenu": [
      //     [10, 25, 50, -1],
      //     [10, 25, 50, "All"]
      //   ],
      //   responsive: true,
      //   language: {
      //     search: "_INPUT_",
      //     searchPlaceholder: "Search",
      //   }
      // });

        var collapsedGroups = {};

        var table = $('#datatables').DataTable({
          order: [[0, 'asc']],
          rowGroup: {
            // Uses the 'row group' plugin
            dataSrc: 0,
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
     


  </script>
@endpush
