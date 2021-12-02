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

@extends('layouts.app', ['activePage' => 'leave-request', 'menuParent' => 'My-Activity', 'titlePage' => __('Leaves')])

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
             
                  <div class="row">
                    <div class="col-12 text-right">
                      <a href="{{ route('leaverequest.create') }}" class="btn btn-sm btn-rose">{{ __(' Request Leave ') }}</a>
                    </div>
                  </div>
               
                <div class="table-responsive">
                
                  <table id="datatables" class="table table-striped table-no-bordered table-hover" style="display:none">
                    <thead class="text-primary">
                    
                     <!--  <th>
                          {{ __('LRID') }}
                      </th> -->
                      <th>
                          {{ __('#') }}
                      </th>
                      <th style="width: 100px;">
                          {{ __('Leave Type') }}
                      </th>
                      <th  style="width: 100px;">
                          {{ __(' Start Date') }}
                      </th>
                      <th  style="width: 100px;">
                          {{ __(' End Date') }}
                      </th>
                      <th>
                          {{ __('Reason') }}
                      </th>
                      <th>
                          {{ __('Supporting Documents') }}
                      </th>
                      <th>
                          {{ __('Status') }}
                      </th>
                     <!--   <th>
                          {{ __('Action_By') }}
                      </th> -->
                        
                    </thead>
                    
                    <tbody>
                    @php

                        $i=1

                      @endphp
                  

	                   	@foreach($leaverequest as $leave)
   
                        <tr>
                         <!--  <td>
                            {{ $leave->lrid }}
                          </td> -->
                          <td>
                            {{ $i++ }}
                          </td>
                          <td>
                          @php

                          $res = "";
                          if($leave->leavetype == "Sick_Leave")
                          $res = "Sick Leave";
                          if( $leave->leavetype == "Loss_Of_Pay")
                          $res = "Loss of Pay";
                          if( $leave->leavetype == "Maternity_Leave")
                          $res = "Maternity Leave";
                          if( $leave->leavetype == "Annual_Leave")
                          $res = "Annual Leave";
                            
                          @endphp

                          {{ $res }}
                            
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
                        <!--   <td> 
                            
                            <a onclick="show_documents('{{$leave->lrid}}')" class="btn btn-sm btn-info">{{ __('Show Documents') }}</a>
                         
                          </td>   -->


                           <td class="td-actions text-center"> 

                              @if($leave->supportingdocument == null || $leave->supportingdocument =="" )

                                 {{__('-')}}

                             @endif

                             @if(($leave->supportingdocument !== null))

                                 <a  rel="tooltip" onclick="show_documents('{{$leave->lrid}}')"  class="btn btn-info" title="View">
                                  <i class="material-icons">visibility</i>
                                </a>

                             @endif


                          </td>

                           @if(($leave->is_approved =="0" && $leave->is_rejected == "0") || ($leave->is_approved =="1" && $leave->is_rejected != "1"))
                            
                       				 <td style="color:#0000ff">{{ __('Processing') }}</td>         
                  			     
                  			   @endif

                            @if ($leave->is_approved == "2")
                            
                        				 <td style="color:#46b99c">{{ __('Approved') }}</td>  

                  			   @endif
                           
                          
                           @if ($leave->is_rejected == "1")
                            
                     				 <td style="color:#ff0000">{{ __('Rejected') }}</td>         
                			      
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
             <!--  <object data="/leavedocuments/Merchandising solution.pdf" type="application/pdf" width="300" height="200">
                <a href="/leavedocuments/Merchandising solution.pdf">test.pdf</a>
              </object> -->
             
              <!--   <div class="col-lg-6">
                <embed style="margin-bottom: 10px;" src="/leavedocuments/Merchandising solution.pdf" width="300" height="200" /><br>

                 <a style="font-size: 30px;" href="/leavedocuments/Merchandising solution.pdf" target="_blank"><i class="fa fa-download"></i></a>
               </div>

               <div class="col-lg-6">
                 <embed style="margin-bottom: 10px;" src="/leavedocuments/Webp.net-resizeimage.png" width="300" height="200" /><br>

                 <a style="font-size: 30px;" href="/leavedocuments/Webp.net-resizeimage.png" target="_blank"><i class="fa fa-download"></i></a>
              </div> -->



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

//       $(document).ready(function () { 
//       var oTable = $('#datatables').dataTable({
//             stateSave: true
//       });

//       var allPages = oTable.fnGetNodes();

//       $('body').on('click', '#selectAll', function () {
//             if ($(this).hasClass('allChecked')) {
//                   $('input[type="checkbox"]', allPages).prop('checked', false);
//             } else {
//                   $('input[type="checkbox"]', allPages).prop('checked', true);
//             }
//             $(this).toggleClass('allChecked');
//       })
//       });    

//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });
   

    $(document).ready(function() {
    
    // ajax();
    
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
          searchPlaceholder: "Search leave request",
        },
      });
    });

   
      function show_documents(id){
     // alert(id);
      var csrf = $('meta[name="csrf-token"]').attr('content');
      $.ajax({
          url: '/show_leave_documents',
          type: 'GET',
          data: {id : id, '_token': csrf},
          dataType: 'json',

          success: function( data ) {
             //alert(data);

            var documents = data[0]['supportingdocument'];
            
            var array = documents.split(',');

            var html = '';

                $.each(array, function (key, val) {
                   // alert(val);

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

  
 // function ajax()
 //    {
  
 //     var csrf = $('meta[name="csrf-token"]').attr('content');
   
 //      //alert('exist');
 //    $.ajax({
 //    method: 'GET',
 //    url: '/ajax',
 //    data: {'_token': csrf},
 
 //    success: function( response ){
    
 //     $.each(response, function(i, item) {  //for each loop for jquery
     
 // $("#example").html("<tr>"+"<td>" + item.lrid +"</td>"+"<td>"+ item.employeeid + "</td>"+"<td>"+item.leavetype +"</td>"+"<td>"+ item.leavestartdate +
 // "</td>"+"<td>"+ item.leaveenddate + "</td>"+"<td>"+ item.reason +
 // "</td>"+"<td>"+ item.supportingdocuments +"</td>"+"</tr>");

 //        });
 //    },
 
 //    error: function( e ) {
 //        console.log(e);
 //    }
 //    });
    
 //    }
 
  </script>
@endpush
