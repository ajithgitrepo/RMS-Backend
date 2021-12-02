
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
/*.view-edit{
  padding: 10px 15px !important;
  margin: 0.3125rem 1px !important;
}*/
 .borderless tr, .borderless td, .borderless th {
    border: none !important;
   }

.table .td-actions .btn {
    margin: 0px;
    padding: 1px !important;
}

.td-actions i.material-icons {
    color: #fff;
}

.accordion .card-header:after {
    font-family: 'FontAwesome';  
    content: "\f068";
    float: right; 
}
.accordion .card-header.collapsed:after {
    /* symbol for "collapsed" panels */
    content: "\f067"; 
}

</style>
      
@extends('layouts.app', ['activePage' => 'cde_user', 'menuParent' => 'Client', 'titlePage' => __('CDE USER')])

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
                <h4 class="card-title">{{ __('CDE') }}</h4>
              </div>

              <div class="card-body">

           <!--     <div class="row">
                    <div class="col-12 text-right">
                      <a class="btn btn-sm btn-warning" style="color: #fff;" data-toggle="modal" data-target="#modelWindow" >{{ __('Filter') }}</a>
                    </div>
                  </div>-->
                 
                @canany(['isTopManagement','isAdmin'],App\User::class)
                  <div class="row">
                    <div class="col-12 text-right">
                      <a href="{{ route('cde.create') }}" class="btn btn-sm btn-rose">{{ __('Add CDE') }}</a>
                    </div>
                  </div>
                @endcan
                <div class="table-responsive">
                  <table id="datatables" class="table table-striped table-no-bordered table-hover" style="display:none">
                    <thead class="text-primary">
                       <th>
                          {{ __('#') }}
                      </th>
                      <th>
                          {{ __('Emp ID') }}
                      </th>
                      <th>
                          {{ __('Name') }}
                      </th>
                      <th>
                          {{ __('Nationality') }}
                      </th>
                      <th>
                          {{ __('Mobile_Number') }}
                      </th>
                      <th>
                          {{ __('Email') }}
                      </th>
                     
                      @canany(['isTopManagement','isAdmin'],App\User::class)

                        <th class="display-block" style="text-align: center;">
                            {{ __('Action') }}
                        </th>

                      @endcan
          
                     
                    </thead>
                    <tbody>

                      @php

                        $i=1

                      @endphp


                      @foreach($employee as $emp)
                     
                        <tr>
                          <td>
                           {{ $i++ }}
                          </td>
                          <td>
                            {{ $emp->employee_id }}
                          </td>
                          <td>
                            {{ $emp->first_name.' '.$emp->middle_name.' '.$emp->surname }}
                          </td>

                           <td>
                            {{ $emp->nationality}}
                          </td>
                          <td>
                          {{__('+')}} {{ $emp->codes }} {{ $emp->mobile_number }}
                          </td>
                           
                           <td>
                            {{ $emp->email }}
                          </td>
                         
                        


                          @canany(['isTopManagement','isAdmin'],App\User::class)

                          <td class=" td-actions display-block">
                              <form action="{{ route('cde.destroy', $emp->employee_id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                  
                                      
                                     
                                       <a href="{{ route('cde.edit', $emp) }}" class="btn btn-warning" title="Edit">
                                          <i class="material-icons">edit</i>
                                        </a>
                                  
                                      

                                     <a onclick="confirm('{{ __("Are you sure you want to delete this CDE?") }}') ? this.parentElement.submit() : ''"  class="btn btn-danger" title="Delete">
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
  
<!--View employee
  <div class="modal fade bd-example-modal-lg" id="exampleModal"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Employee More Information</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form>

          <div class="row">
            <div class="col-lg-12">

              <table class="table table-responsive borderless" >
                <tr>
                  <th>Passport Number </th>
                  <td id="passport_no"></td>
                </tr>
                 <tr>
                  <th>Nationality </th>
                  <td id="nationality"></td>
                </tr>
                 <tr>
                  <th>Joining Date  </th>
                  <td id="joining_date"></td>
                </tr>
                 <tr>
                  <th>Passport Expiry Date  </th>
                  <td id="passport_exp_date"></td>
                </tr>
                 <tr>
                  <th>Visa Expiry Date  </th>
                  <td id="visa_exp_date"></td>
                </tr>
               
              </table>

            </div>

             <div class="col-lg-6">
              <table class="table table-responsive borderless">
                <tr>
                  <th>Medical Insurance No. </th>
                  <td id="medical_ins_no"></td>
                </tr>
                <tr>
                  <th>Medical Insurance Expiry Date </th>
                  <td id="medical_ins_exp_date"></td>
                </tr>
                 <tr>
                  <th>Visa Company Name </th>
                  <td id="visa_campany_name"></td>
                </tr>
                 <tr>
                  <th>Employee Score  </th>
                  <td id="employee_score"></td>
                </tr>
                <tr>
                  <th>Emirates ID  </th>
                  <td id="emirates_id"></td>
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

Document fields view

  <div class="modal fade bd-example-modal-lg" id="documentfieldsModal"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Employee Document Information</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
   
  <div class="modal-dialog vertical-align-center">   
        <form>

          <div class="row">
            <div class="col-lg-12">

              <table class="table table-responsive borderless" >
                  <tr>  
                   <th>Employee_Id</th>
                  <td id="employee_id"></td>
                  </tr>
      
                  <tr>  
                  <th>Passport_Expiry</th>
                  <td id="passport_expiry"></td>
                  </tr>
                
                <tr>
                  <th>DL_Expiry </th>
                  <td id="dl_expiry"></td>
                 </tr>
                 
                 <tr>
                  <th>Emirate_Id </th>
                  <td id="emirate_id"></td>
                 </tr>
                 
                 <tr>
                  <th>Lab_Expiry </th>
                  <td id="lab_expiry"></td>
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


View document

 <div class="modal fade bd-example-modal-lg" id="documentModal"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel"><b>Employee Documents Soft Copy</b></h4>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
         </button>
      </div>
   
    <div class="modal-body">

      <div class="container">
    <div id="accordion" class="accordion">
        <div class="card mb-0" id="documents">
            
        </div>
    </div>
</div>
        
         <div class="row" id="passport_photo">
         </div>
          
          
          <div class="row" id="passport_copy">
         </div>
          
   
         <div class="row" id="visa_copy" >

        </div>
          
  
          <div class="row" id="dl_copy">
         </div>
          
          
           <div class="row" id="edu_certificate">
           </div>
          
          
           <div class="row" id="emi_certificate">
           </div>
          
          
           <div class="row" id="exp_certificate">
           </div>
          
          <div class="row" id="lab_certificate">
          </div> 
        
       <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       </div>
      
     </div>
    </div>
  </div>
</div>-->


<!--Model session for employee role and nationality using filter

 
          <div class="modal fade bd-example-modal-lg" id="modelWindow" role="dialog" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" 
          aria-hidden="true">
            <div class="modal-dialog modal-lg vertical-align-center">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title"><b> Filter Options</b></h4>
                </div>
                
                <div class="modal-body">

                 <form method="post" action="{{ url('filter_employee') }}" class="form-inline" enctype="multipart/form-data" action="" autocomplete="off" style="text-align: right;">
                
            @csrf
            @method('post')
                
                
            
                  <div class="col-sm-4">
                     
                     
                          <select class="form-control selectpicker" data-style="select-with-transition" title="Select Designation" data-size="7" name="designation" id="input-designation"  value="{{ old('designation') }}" aria-required="true" >
                    
                          <option value="" selected>Select Designation</option>
                          @foreach ($employee as $designation)
                          <option value="{{ $designation->id }}"  @if(old('designation') == $designation->id ) selected @endif > {{  $designation->name }}</option>
                          @endforeach
                         </select>
                   
                     
                   </div>
     
                 <div class="col-sm-4">
                    

                 <select class="form-control selectpicker" id="nationality" data-style="select-with-transition" name="nationality"  value="{{ old('nationality') }}">
                        <option value="" selected>Select Country</option>
                        <option value="Afghanistan">Afghanistan</option>
                        <option value="India" id="AX">India</option>
                        <option value="United Arab Emirates">United Arab Emirates</option>
                        <option value="Philippines">Philippines</option>
                        <option value="Pakistan">Pakistan</option>
                        <option value="Sri Lanka">Sri Lanka</option>
                        <option value="Qatar">Qatar</option>
                 </select>
 
                  
                </div>
                  

                 <button type ="submit" class="btn btn-info btn-sm mx-auto ">Filter
                 </button></b>
                   

                </form>
               
                </div>

                <div class="modal-footer">
         <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
                </div>
              </div>
            </div>
          </div>

 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">More Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Passport Number:</label> <span for="recipient-name" class="col-form-label"></span>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Nationality:</label><span for="recipient-name" class="col-form-label"></span>
          </div>
           <div class="form-group">
            <label for="message-text" class="col-form-label">Joining Date:</label><span for="recipient-name" class="col-form-label"></span>
          </div>
           <div class="form-group">
            <label for="message-text" class="col-form-label">Message:</label><span for="recipient-name" class="col-form-label"></span>
          </div>
           <div class="form-group">
            <label for="message-text" class="col-form-label">Message:</label><span for="recipient-name" class="col-form-label"></span>
          </div>
           <div class="form-group">
            <label for="message-text" class="col-form-label">Visa Expiry Date:</label><span for="recipient-name" class="col-form-label"></span>
          </div>
           <div class="form-group">
            <label for="message-text" class="col-form-label">Passport Expiry Date:</label><span for="recipient-name" class="col-form-label"></span>
          </div>
           <div class="form-group">
            <label for="message-text" class="col-form-label">Medical Insurance No.:</label><span for="recipient-name" class="col-form-label"></span>
          </div>
           <div class="form-group">
            <label for="message-text" class="col-form-label">Medical Insurance Expiry Date:</label><span for="recipient-name" class="col-form-label"></span>
          </div>
           <div class="form-group">
            <label for="message-text" class="col-form-label">Visa Company Name:</label><span for="recipient-name" class="col-form-label"></span>
          </div>
           <div class="form-group">
            <label for="message-text" class="col-form-label">Employee Score:</label><span for="recipient-name" class="col-form-label"></span>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      
      </div>
    </div>
  </div>
</div> -->

@endsection

@push('js')

  <script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
      //alert();
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
          searchPlaceholder: "Search employees",
        },
        
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
            if(data[0]['medical_ins_no'] !== null)
            $("#medical_ins_no").html(': '+data[0]['medical_ins_no'])
            $("#medical_ins_exp_date").html(': '+data[0]['medical_ins_exp_date'])
            $("#visa_campany_name").html(': '+data[0]['visa_company_name'])
            if(data[0]['employee_score '] !== null)
            $("#employee_score").html(': '+data[0]['employee_score'])
            $("#emirates_id").html(': '+data[0]['emirates_id'])

          }       
      })

    }

 
    function view_documents(id){
 //alert(id);
      var csrf = $('meta[name="csrf-token"]').attr('content');
      $.ajax({
           url: '/view_documents',
          type: 'GET',
          data: {id : id, '_token': csrf},
          dataType: 'json',

          success: function( data ) {
         
        //alert(JSON.stringify(data)); 

             var documents0  = data[0]['passport_photo'];
             var documents  = data[0]['passport_copy'];
             var documents1 = data[0]['visa_copy'];
             var documents2 = data[0]['dl_copy'];
             var documents3 = data[0]['edu_certificate'];
             var documents4 = data[0]['emi_certificate'];
             var documents5 = data[0]['exp_certificate'];
             var documents6 = data[0]['lab_certificate'];
            
               var array0 = documents0.split(',');
               var array  = documents .split(',');
               var array1 = documents1.split(',');
               var array2 = documents2.split(',');
               var array3 = documents3.split(',');
               var array4 = documents4.split(',');
               var array5 = documents5.split(',');
               var array6 = documents6.split(',');

           // alert(array2);

            var html  = '';
      
     
     

             if(array0 !="")
             {
                  html += '<div class="card-header collapsed" data-toggle="collapse" href="#collapseOne">';
                         html += '<a class="card-title">Passport Photo';
                         html += '</a>';
                     html += '</div>';

                    html += ' <div id="collapseOne" class="card-body collapse" data-parent="#accordion" >';
                    html += ' <div class="row" >';

                $.each(array0, function (key, val) {
                  //alert(val);
                  
                       html += ' <div class="col-lg-6">';
                         html += '<embed style="margin-bottom: 10px;" src="/passport_photo/'+val+'" width="250" height="200" />';
                           html += '<a style="font-size: 30px;" href="/passport_photo/'+val+'" target="_blank"><i class="fa fa-download"></i></a>';
                           html += ' </div>';
               
              });
                 html += '</div>';
                 html += '</div>';

             }
              

             if(array !="")
             {
                html += '<div class="card-header collapsed" data-toggle="collapse" href="#collapseTwo">';
                     html += '<a class="card-title">Passport Copy';
                     html += '</a>';
                 html += '</div>';

                  html += ' <div id="collapseTwo" class="card-body collapse" data-parent="#accordion" >';
                    html += ' <div class="row" >';

               $.each(array, function (key, val) {
                  //alert(val);

                 
                       html += ' <div class="row-lg-6">';
                         html += '<embed style="margin-bottom: 10px;" src="/passport_copy/'+val+'" width="250" height="200" />';
                           html += '<a style="font-size: 30px;" href="/passport_copy/'+val+'" target="_blank"><i class="fa fa-download"></i></a>';
                           html += ' </div>';
                

               });

               html += '</div>';
               html += '</div>';

            }

             if(array1 !="")
             {
                 html += '<div class="card-header collapsed" data-toggle="collapse" href="#collapseThree">';
                     html += '<a class="card-title">Visa Copy';
                     html += '</a>';
                 html += '</div>';

                  html += ' <div id="collapseThree" class="card-body collapse" data-parent="#accordion" >';
                    html += ' <div class="row" >';

               $.each(array1, function (key, val) {
                  //alert(val);
              
                
                       html += ' <div class="row-lg-6">';
                         html += '<embed style="margin-bottom: 10px;" src="/visa_copy/'+val+'" width="250" height="200" />';
                           html += '<a style="font-size: 30px;" href="/visa_copy/'+val+'" target="_blank"><i class="fa fa-download"></i></a>';
                           html += ' </div>';
               });

                html += '</div>';
               html += '</div>';

            }

             if(array2 !="")
             {

                 html += '<div class="card-header collapsed" data-toggle="collapse" href="#collapseFour">';
                     html += '<a class="card-title">DL Copy';
                     html += '</a>';
                 html += '</div>';

                  html += ' <div id="collapseFour" class="card-body collapse" data-parent="#accordion" >';
                    html += ' <div class="row" >';

               $.each(array2, function (key, val) {
                  //alert(val);
              
                 
                       html += ' <div class="row-lg-6">';
                         html += '<embed style="margin-bottom: 10px;" src="/dl_copy/'+val+'" width="250" height="200" />';
                           html += '<a style="font-size: 30px;" href="/dl_copy/'+val+'" target="_blank"><i class="fa fa-download"></i></a>';
                           html += ' </div>';

               });
                html += '</div>';
               html += '</div>';
            }
            else{
                 html += '<div class="card-header collapsed" data-toggle="collapse" href="#collapseFour">';
                         html += '<a class="card-title">DL Copy';
                         html += '</a>';
                     html += '</div>';
                   html += ' <div id="collapseFour" class="card-body collapse" data-parent="#accordion" >';
                       html += ' <div class="row-lg-4">';
                         html += '<h3>DL Copy not uploaded..';
                          
                           html += ' </div>';
                 html += '</div>';
            }

            if(array3 !="")
             {

                 html += '<div class="card-header collapsed" data-toggle="collapse" href="#collapseFive">';
                     html += '<a class="card-title">Educational Certificate';
                     html += '</a>';
                 html += '</div>';

                  html += ' <div id="collapseFive" class="card-body collapse" data-parent="#accordion" >';
                    html += ' <div class="row" >';

               $.each(array3, function (key, val) {
                  //alert(val);
              
                  
                       html += ' <div class="row-lg-6">';
                         html += '<embed style="margin-bottom: 10px;" src="/education_certificate/'+val+'" width="250" height="200" />';
                           html += '<a style="font-size: 30px;" href="/education_certificate/'+val+'" target="_blank"><i class="fa fa-download"></i></a>';
                           html += ' </div>';

               });
                html += '</div>';
               html += '</div>';
            }


            if(array4 !="")
             {

                  html += '<div class="card-header collapsed" data-toggle="collapse" href="#collapseSix">';
                     html += '<a class="card-title">Emirates Certificate';
                     html += '</a>';
                 html += '</div>';

                  html += ' <div id="collapseSix" class="card-body collapse" data-parent="#accordion" >';
                    html += ' <div class="row" >';


               $.each(array4, function (key, val) {
                  //alert(val);
              
                   
                       html += ' <div class="row-lg-6">';
                         html += '<embed style="margin-bottom: 10px;" src="/emirates_certificate/'+val+'" width="250" height="200" />';
                           html += '<a style="font-size: 30px;" href="/emirates_certificate/'+val+'" target="_blank"><i class="fa fa-download"></i></a>';
                           html += ' </div>';

               });
                html += '</div>';
               html += '</div>';
            }
            

             if(array5 !="")
             {

                 html += '<div class="card-header collapsed" data-toggle="collapse" href="#collapseSeven">';
                     html += '<a class="card-title">Experience Certificate';
                     html += '</a>';
                 html += '</div>';

                  html += ' <div id="collapseSeven" class="card-body collapse" data-parent="#accordion" >';
                    html += ' <div class="row" >';

               $.each(array5, function (key, val) {
                  //alert(val);
              
                       html += ' <div class="row-lg-6">';
                         html += '<embed style="margin-bottom: 10px;" src="/exp_certificate/'+val+'" width="250" height="200" />';
                           html += '<a style="font-size: 30px;" href="/exp_certificate/'+val+'" target="_blank"><i class="fa fa-download"></i></a>';
                           html += ' </div>';

               });

               html += '</div>';
               html += '</div>';
            }
            else{
                 html += '<div class="card-header collapsed" data-toggle="collapse" href="#collapseSeven">';
                         html += '<a class="card-title">Experience Certificate';
                         html += '</a>';
                     html += '</div>';
                   html += ' <div id="collapseSeven" class="card-body collapse" data-parent="#accordion" >';
                       html += ' <div class="row-lg-6">';
                         html += '<h3>Experience certificate not uploaded..';
                          
                           html += ' </div>';
                 html += '</div>';
            }


            if(array6 !="")
             {

                  html += '<div class="card-header collapsed" data-toggle="collapse" href="#collapseEight">';
                     html += '<a class="card-title">Labour Certificate';
                     html += '</a>';
                 html += '</div>';

                  html += ' <div id="collapseEight" class="card-body collapse" data-parent="#accordion" >';
                    html += ' <div class="row" >';


               $.each(array6, function (key, val) {
                  //alert(val);
              
                  
                       html += ' <div class="row-lg-6">';
                         html += '<embed style="margin-bottom: 10px;" src="/labour_certificate/'+val+'" width="250" height="200" />';
                           html += '<a style="font-size: 30px;" href="/labour_certificate/'+val+'" target="_blank"><i class="fa fa-download"></i></a>';
                           html += ' </div>';

               });
                html += '</div>';
               html += '</div>';
            }
            


     
     
             $("#documents").html(html);
            
            $('#documentModal').modal('show'); 

             
           }       
      })
    
    }


function view_documentsfields(id){
      //alert(id);
      var csrf = $('meta[name="csrf-token"]').attr('content');
      $.ajax({
          url: '/view_documentsfields',
          type: 'GET',
          data: {id : id, '_token': csrf},
          dataType: 'json',

          success: function( data ) {
             //alert(data);

             // alert(JSON.stringify(data[0]['id']));

            $("#employee_id").html(':'+data[0]['employee_id']);
            $("#passport_expiry").html(':'+data[0]['passport_exp_date']);
            $("#dl_expiry").html(':'+data[0]['dl_expiry']);
            $("#emirate_id").html(':'+data[0]['emirates_id']);

            if(data[0]['lab_expiry'] !==null){
                 $("#lab_expiry").html(':'+data[0]['lab_expiry']);
            }

            if(data[0]['lab_expiry'] ==null){
                 $("#lab_expiry").html(':  -');
            }
           

          }       
      })

    }

  </script>
@endpush
