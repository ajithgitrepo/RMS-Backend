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

@extends('layouts.app', ['activePage' => 'emp-update-leave-balance', 'menuParent' => 'Attendance', 'titlePage' => __('leave balance update')])

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
                <h4 class="card-title">{{ __('Leavebalance') }}</h4>
              </div>
              <div class="card-body">
            <!-- <form method="post"  autocomplete="off" class="form-horizontal"> -->
             @csrf
            @method('post')
                  <div class="row">
   
                    <select id="DdlEmployee"  name="employee_id">
                        <option>All</option>
                            @foreach($employee as $emp)
                                     <option value="{{$emp->employee_id}}">
                                       {{$emp->first_name }}{{$emp->middle_name }} {{$emp->surname }} ({{$emp->employee_id}})</option>
                            @endforeach
                 </select> 

                   <!-- <input  name="Annual_Leave" type="text" placeholder="Leavebalance" /> -->
                <button id="BtnSearch" type="submit" class="btn btn-rose text-center">{{ __('Search ') }}</button>

                       </div></div>
                        <!-- </form> -->
                        <div class="table-responsive">
                        <table id="datatables" class="table table-striped table-dark table-bordered" border="1">
        <thead>
            <tr>
            <!-- <th scope="col">  {{ __('#') }}</th> -->
                <th scope="col" style="color:red">  {{ __('Employee') }}</th>
                  <th scope="col" style="color:red">Total Leave</th>

                  <th scope="col" style="color:red">Action</th>
            </tr>
        </thead>
       
        <tbody>
        <tr>

        @php

        $i=1

        @endphp
        @foreach($leave as $lea)

        <td>

          ({{ $lea->employee_id }}) {{$lea->employee->first_name }}  {{$lea->employee->middle_name }}  {{$lea->employee->surname }}
        </td>

        <td  class="leave_cell_value">
          {{ $lea->Annual_Leave }}
        </td>

        <td  contenteditable="false"><button type="button" name="{{ $lea->id }}" class="btn btn-primary editbtn">Edit</button>
        <button id="btncancel" type="button" style="display:none;" class="btn btn-danger btncancel">
        Cancel
        </button>
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

<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script> -->
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>  -->
  <script>

$(document).ready(function() {
      // Initialise Sweet Alert library
      demo.showSwal();
    });


//$('.btncancel').click(function () {
  $(document).on('click', '.btncancel', function(){
     // alert();
    
     $.each(currentTD, function () {
                 // alert(currentTD.text());
                   // alert("second if "+currentTD.html());
                      $(this).prop('contenteditable', false).removeAttr("style");
                  });
                  $(this).parents('tr').find('td').find('button#btncancel').prop("style").display="none";
                 // $(this).html($(this).html() == 'Edit' ? 'Save' : 'Edit');
                 $(this).parents('tr').find('td').find('button.editbtn').html('Edit');
                 $(this).prop('contenteditable',false);
});

//$('.editbtn').click(function () {
  $(document).on('click', '.editbtn', function(){
                  
           //   alert();
           // alert('this '+$(this).html() ); 
              if ($(this).text().trim() == 'Edit') {
                  currentTD = $(this).parents('tr').find($("td").not(":nth-child(1)").not(":nth-child(3)"));
                  //alert("first if "+currentTD.html());
                  $.each(currentTD, function () {
                      $(this).prop('contenteditable', true).css({
                        'background':'#fff',
                        'color':'#000'
                      })
                  });

                 $(this).parents('tr').find('td').find('button#btncancel').prop("style").display="";
                 
              } else {
                var LeaveID = $(this).attr('name');
              //  alert(LeaveID);
               // alert("second if "+currentTD.html());
               var Aleave = $(this).parents('tr').find('td.leave_cell_value').text().trim();

              if(Aleave.match(/^-?\d+$/)){
                //valid integer (positive or negative)
                }else if(Aleave.match(/^\d+\.\d+$/)){
                //valid float
                }else{
                  alert("Please enter valid number");
                  return false;
                }
               
              update_leave(LeaveID,Aleave);
             
             $(this).parents('tr').find('td').find('button#btncancel').prop("style").display="none";
             //  alert(currentTD);
                 $.each(currentTD, function () {
                 /// alert(currentTD.text()); 
                   // alert("second if "+currentTD.html());
                      $(this).prop('contenteditable', false).removeAttr("style");
                  });
              }
    
              $(this).html($(this).html() == 'Edit' ? 'Save' : 'Edit')

              if ($(this).html() == 'Save'){

                $(this).prop('contenteditable',false)
              }
      //  alert($(this).html());
             
    
          });
         // });

         function update_leave(id,value){
     // alert(id);
      var csrf = $('meta[name="csrf-token"]').attr('content');
      $.ajax({
          url: '/update_leave_by_hr', 
          type: 'GET',
          data: {id : id, value : value, '_token': csrf},
          dataType: 'json',

          success: function( data ) {
            // alert(data);
             swal("Success!", "updated successfully!", "success");
             // alert(JSON.stringify(data[0]['id']));

         //   $("#passport_no").html(': '+data[0]['passport_number']);
          //  $("#nationality").html(': '+data[0]['nationality']);
            

          }       
      })

    }
     

     $('#BtnSearch').click(function ()
     {
          var Empid = $('#DdlEmployee').val();
          var csrf = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
            url: 'get_update_leave_by_hr', 
            type: 'GET',
            data: {Empid : Empid, '_token': csrf},
            dataType: 'json',

            success: function( data ) {
              // alert(data);

               $('#datatables tbody').empty();
             var  response = JSON.stringify(data); 
            //  /  alert(response);
             
               var trHTML = '';
        $.each(data, function (i, item) {  
            trHTML += '<tr><td>(' + item.employee_id  + ') ' + item.employee.first_name  + ' ' + item.employee.middle_name  + ' ' + item.employee.surname  + ' </td>';
            trHTML += '<td class="leave_cell_value">' + item.Annual_Leave  + '</td>';
           // alert(trHTML);
            trHTML += '<td  contenteditable="false"><button type="button" name="1" class="btn btn-primary editbtn">Edit</button>';
            trHTML += '<button id="btncancel" type="button" style="display:none;" class="btn btn-danger btncancel"> Cancel</button>';
       
            trHTML += '</td></tr>';

        });

        $("#datatables tbody").append(trHTML);
       
            //  swal("Success!", "updated successfully!", "success");
              // alert(JSON.stringify(data[0]['id']));

          //   $("#passport_no").html(': '+data[0]['passport_number']);
            //  $("#nationality").html(': '+data[0]['nationality']);
              
            }       
        })
     });

  /*  $(document).ready(function() {
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
    });  */

//     $(".leave_cell_value").on("keypress keyup blur", function(event) { //alert(event.which);

//      // var reg = "/^[1-9]\d*(\.\d+)?$/"; //reg pattern<br/>
//   //     var charCode = (e.which) ? e.which : e.keyCode;
//   // if (charCode > 31 && (charCode < 48 || charCode > 57)) {  alert('v');
//   //   return false;
//   // }
//    alert($(this).text());
//           $(this).val(Number($(this).val().replace(/.[^0-9]/g, '')));
//           if ((event.which < 48 || event.which > 57 )) {
//             event.preventDefault();
//           // alert( $(this).text());
//           }
     
// });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
      $('#datatables').fadeIn(1100);
    });

   
  
  </script>
@endpush
