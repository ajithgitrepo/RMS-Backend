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

@extends('layouts.app', ['activePage' => 'leaves', 'menuParent' => 'Employee', 'titlePage' => __('Leaves')])

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
                <h4 class="card-title">{{ __('Leaves') }}</h4>
              </div>
              
              
              <div class="card-body">
             
              
               
                <div class="table-responsive">
                  <table id="datatables" class="table table-striped table-no-bordered table-hover" style="display:none">
                    <thead class="text-primary">
                    
                      
                      <th>
                          {{ __('Employee Id') }}
                      </th>
                      <th>
                          {{ __('Leave Type') }}
                      </th>
                      <th>
                          {{ __('Leave Start Date') }}
                      </th>
                      <th>
                          {{ __('Leave End Date') }}
                      </th>
                      <th>
                          {{ __('Reason') }}
                      </th>
                      <th>
                          {{ __('Documents') }}
                      </th>
                      <th>
                          {{ __('Status') }}
                      </th>
                        
                    </thead>
                    
                    <tbody>

                      @php

                        $i=0

                      @endphp
                 
                      @foreach($leaves as $leave)
   
                        <tr>
                          
                          <td>
                            {{ $leave->employee_id.' -  '.$leave->employee->first_name }}
                          </td>
                          <td>
                            {{ $leave->leavetype }}
                          </td>
                          <td>
                           {{ date('d-m-Y', strtotime($leave->leavestartdate)) }}
                         </td>
                           <td>
                             {{ date('d-m-Y', strtotime($leave->leaveenddate)) }}
                           </td>
                          <td>
                            {{ $leave->reason }}
                          </td>
                          <td> 
                          @if($leave->leavetype == "Sick_Leave" )
                            <a rel="tooltip" onclick="show_documents('{{$leave->lrid}}')" title="" data-original-title="View">
                                  <i class="material-icons">visibility</i>
                                <div class="ripple-container"></div></a>
                          @else
                           {{ __('Nil') }}

                           @endif
                          </td> 
                         


  
             
   
	 @if($leave->is_approved=="0" && $leave->is_rejected=="0")

	<td>  
          
          <a href="{{ url('approvedfield',  [
             'pid' => $leave->lrid, 
             'type' => $leave->leavetype
          ] ) }}" class="btn btn-sm btn-success">{{ __('Accepted') }}</a>

	</td>
	
	 <td>
          <a href="{{ url('rejectedfield',$leave->lrid) }}" class="btn btn-sm btn-danger">{{ __('Rejected') }}</a>

	</td>
	
	@endif

  @if(($leave->is_approved=="1" || $leave->is_approved=="2") && ($leave->is_rejected != "1"))

<td>

       <button type="submit" class="btn btn-sm btn-success" >Accepted</button>

</td>

 @endif 
 
 @if($leave->is_rejected=="1" )

 <td>
 
       <button type="submit" class="btn btn-sm btn-danger">Rejected</button>

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


  <div class="modal fade bd-example-modal-lg" id="DocumentModal"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Supporting Documents</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form>

          <div class="row" id="documents">
            


          </div>

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
          searchPlaceholder: "Search leaves",
        },
        "columnDefs": [
          { "orderable": false, "targets": 5 },
        ],
      });
    });

   
    function show_documents(id){
     // alert(id);
      var csrf = $('meta[name="csrf-token"]').attr('content');
      $.ajax({
          url: '/show_documents',
          type: 'GET',
          data: {id : id, '_token': csrf},
          dataType: 'json',

          success: function( data ) {
             //alert(data);

            var documents = data[0]['supportingdocument'];
            
            var array = documents.split(',');

            var html = '';

                $.each(array, function (key, val) {
                    //alert(val);

                   html += ' <div class="col-lg-6">' ;
                   html += ' <embed style="margin-bottom: 10px;" src="/leavedocuments/'+val+' " width="300" height="200" />';
                 //  html += ' <a style="font-size: 30px;" href="/leavedocuments/'+val+'" target="_blank"><i class="fa fa-download"></i></a>';

                   html += ' </div>';

            });

            $("#documents").html(html);

            $('#DocumentModal').modal('show'); 

          }       
      })

    }

     


  </script>
@endpush
