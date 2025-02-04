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
    padding: 1px !important;
}

</style>


<style type="text/css">
  @import url("https://fonts.googleapis.com/css?family=Open+Sans:400,700");
@import url("https://fonts.googleapis.com/css?family=Pacifico");


.content {
  background: #fff;
  border-radius: 3px;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.075), 0 2px 4px rgba(0, 0, 0, 0.0375);
  padding: 30px 30px 20px;
}



.select2.select2-container {
  width: 100% !important;
}

.select2.select2-container .select2-selection {
  border: 1px solid #ccc !important;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  height: 34px;
  margin-top: 5px;
  outline: none;
  transition: all 0.15s ease-in-out;
}

.select2.select2-container .select2-selection .select2-selection__rendered {
  color: #333;
  line-height: 32px;
  padding-right: 33px;
  text-align: left;
}

.select2.select2-container .select2-selection .select2-selection__arrow {
  background: #f8f8f8;
  border-left: 1px solid #ccc;
  -webkit-border-radius: 0 3px 3px 0;
  -moz-border-radius: 0 3px 3px 0;
  border-radius: 0 3px 3px 0;
  height: 32px;
  width: 33px;
  margin-top: 5px;
}

.select2.select2-container.select2-container--open .select2-selection.select2-selection--single {
  background: #f8f8f8;
}

.select2.select2-container.select2-container--open .select2-selection.select2-selection--single .select2-selection__arrow {
  -webkit-border-radius: 0 3px 0 0;
  -moz-border-radius: 0 3px 0 0;
  border-radius: 0 3px 0 0;
}

.select2.select2-container.select2-container--open .select2-selection.select2-selection--multiple {
  border: 1px solid #34495e;
}

.select2.select2-container.select2-container--focus .select2-selection {
  border: 1px solid #34495e;
}

.select2.select2-container .select2-selection--multiple {
  height: auto;
  min-height: 34px;
}

.select2.select2-container .select2-selection--multiple .select2-search--inline .select2-search__field {
  margin-top: 0;
  height: 32px;
}

.select2.select2-container .select2-selection--multiple .select2-selection__rendered {
  display: block;
  padding: 0 4px;
  line-height: 29px;
}

.select2.select2-container .select2-selection--multiple .select2-selection__choice {
  background-color: #f8f8f8;
  border: 1px solid #ccc;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  margin: 4px 4px 0 0;
  padding: 0 6px 0 22px;
  height: 24px;
  line-height: 24px;
  font-size: 12px;
  position: relative;
}

.select2.select2-container .select2-selection--multiple .select2-selection__choice .select2-selection__choice__remove {
  position: absolute;
  top: 0;
  left: 0;
  height: 22px;
  width: 22px;
  margin: 0;
  text-align: center;
  color: #e74c3c;
  font-weight: bold;
  font-size: 16px;
}

.select2-container .select2-dropdown {
  background: transparent;
  border: none;
  margin-top: -5px;
}

.select2-container .select2-dropdown .select2-search {
  padding: 0;
}

.select2-container .select2-dropdown .select2-search input {
  outline: none;
  border: 1px solid #34495e;
  border-bottom: none;
  padding: 4px 6px;
}

.select2-container .select2-dropdown .select2-results {
  padding: 0;
}

.select2-container .select2-dropdown .select2-results ul {
  background: #fff;
  border: 1px solid #34495e;
}

.select2-container .select2-dropdown .select2-results ul .select2-results__option--highlighted[aria-selected] {
  background-color: #3498db;
}

.big-drop {
  width: 600px !important;
}

.select_margin{
    margin-bottom: 10px;
}

</style>


@extends('layouts.app', ['activePage' => 'outlets', 'menuParent' => 'Outlets', 'titlePage' => __('Outlets')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">outlet</i>
                </div>
                <h4 class="card-title">{{ __('Outlets') }}</h4>
              </div>
              <div class="card-body">
        
                 <div class="row">
                    <div class="col-12 text-right">
                      <a class="btn btn-sm btn-warning" style="color: #fff;" data-toggle="modal" data-target="#modelWindow" >{{ __('Filter') }}</a>
                    </div>
                  </div>
                  
                  
               @canany(['isClient'],App\User::class)
                  <div class="row">
                    <div class="col-12 text-right">
                      <a href="{{ route('outlet.create') }}" class="btn btn-sm btn-rose">{{ __('Add Outlet') }}</a>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-12 text-right">
                      <a href="{{ route('import_task') }}" class="btn btn-sm btn-info">{{ __('Import Task') }}</a>
                    </div>
                  </div>
                  
          
               @endcan
                <div class="table-responsive">
                  <table id="datatables" class="table table-striped table-no-bordered table-hover" style="display:none">
                    <thead class="text-primary">
                    
                      <th>
                          {{ __('S.No') }}
                      </th>
                      
                      <th>
                          {{ __('Outlet Name') }}
                      </th>

                      <th>
                          {{ __('Outlet Lat') }}
                      </th>
                      
                      <th>
                          {{ __('Outlet Long') }}
                      </th>
                      
                      <th>
                          {{ __('Outlet Area') }}
                      </th>
                     
                       <th>
                          {{ __('Outlet City') }}
                      </th>
                      
                   <th>
                          {{ __('Outlet Emirates') }}
                      </th>
                      
                      <th>
                          {{ __('Outlet Country') }}
                      </th>

                      <th>
                          {{ __('Categories') }}
                      </th>

                     
                     <th>
                          {{ __('Action') }}
                      </th>
                     
                    </thead>
                    
                    <tbody>

                      @php

                        $i=1

                      @endphp
                      
                       
                               
                      @foreach($outlet as $out)

                        <tr>
                        
                          <td>
                            {{ $i++ }}
                          </td>
                          
                          <td>
                           @if(!empty($out->store[0]->store_name))
                            {{ $out->store[0]->store_code }} - {{ $out->store[0]->store_name }} - {{ $out->outlet_area }} - {{ $out->outlet_city }}
                          @endif
                        </td>

                          <td>
                            {{ $out->outlet_lat }}
                          </td>
                          
                          <td>
                            {{ $out->outlet_long }}
                          </td>
                          
                          <td>
                            {{ $out->outlet_area }}
                          </td>
                          
                           <td>
                            {{ $out->outlet_city}}
                          </td>
                          
                           <td>
                            {{ $out->outlet_state }}
                          </td>
                          
                           <td>
                            {{ $out->outlet_country}}
                          </td>

                            <td class="td-actions">
                             @if($out->outlet_product->count() <= 0)
                              <a href="{{ url('outlet-products/view_edit',$out->outlet_id) }}" class="btn btn-success" title="Add">
                              <i class="material-icons">add</i>
                            </a>
                             @endif

                             @if($out->outlet_product->count() > 0)
                               <a  href="{{ url('outlet-products/view_edit',$out->outlet_id) }}" class="btn btn-warning" title="Edit">
                                  <i class="material-icons">edit</i>
                                </a>

                             @endif

                          </td>

                    
                          
                           @canany(['isClient','isAdmin','isTopManagement'],App\User::class)
                           
                           <td class="td-actions">
                              <form action="{{ route('outlet.destroy', $out->outlet_id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                         
                                           <a   href="{{ route('outlet.edit', 
                                           $out->outlet_id) }}" class="btn btn-warning" title="Edit">
                                          <i class="material-icons">edit</i>
                                        </a>
                                      
                                           <a onclick="confirm('{{ __("Are you sure you want to delete this outlet?") }}') ? this.parentElement.submit() : ''"  class="btn btn-danger" title="Delete">
                                          <i class="material-icons">close</i>
                                        </a>

                                         <a   href="{{ url('task/create',$out->outlet_id) }}" class="btn btn-info" title="Task">
                                          <i class="material-icons">edit</i>
                                        </a>


                                      
                               </form>
                           </td> 
              
                            @endcan
                          
                     </tr>
                      @endforeach 

                    </tbody>
                  </table>

                   {{-- Pagination --}}
                    <div class="d-flex justify-content-center">
                        {!! $outlet->links() !!}
                    </div>

                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>

   <!--Model session for outlet--> 

 
          <div class="modal fade bd-example-modal-lg" id="modelWindow" role="dialog" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" 
          aria-hidden="true">
            <div class="modal-dialog modal-lg vertical-align-center">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title"><b> Filter Options</b></h4>
                </div>
                
                <div class="modal-body">
                 <form method="get" action="{{ url('filter_outlet') }}" class="form-inline" enctype="multipart/form-data" action="" autocomplete="off" style="text-align: right;">
                
                    @csrf
                    @method('get')
                
                
                <div class="row">
                  <div class="col-sm-6">
                     <div class="form-group">
                     
                         
                    <select class="form-control js-select2" data-style="select-with-transition" title="Select Outlet" data-size="7" name="outlet_name" id="input-outlet_name" 
                     value="{{ old('outlet_name') }}" aria-required="true" >
                    
                        <option value="" selected >Select Outlet</option>
                   
                       @foreach ($store as $str)
                            <option value="{{$str->id}}" >  {{ $str->store_code }} - {{ $str->store_name }} - {{ $str->address }}</option>
                        @endforeach
                         
                      </select>
                   
                     </div>
                   </div>
     
              
                  <div class="col-sm-6">
                    <div class="form-group{{ $errors->has('outlet_city') ? ' has-danger' : '' }}">
                      <select class="form-control js-select2" data-style="select-with-transition" title="Select City" data-size="7" name="outlet_city" id="outlet_city" 
                     value="{{ old('outlet_city') }}" aria-required="true" >
                     
                      <option value="" selected disabled>Select City</option>
                      <option value="Abu Dhabi">Abu Dhabi </option>
                      <option value="Al Ain">Al Ain </option>
                      <option value="Al Awdah">Al Awdah </option>
                      <option value="Al Fahlayn">Al Fahlayn </option>
                      <option value="Al Fulayyah">Al Fulayyah </option>
                      <option value="Al Fara">Al Fara' </option>
                      <option value="Al Ghabah">Al Ghabah </option>
                      <option value="Al Ghabam">Al Ghabam </option>
                      <option value="Al Ghashban">Al Ghashban </option>
                      <option value="Al Hamraniyah">Al Hamraniyah </option>
                      <option value="Al Hamriyah">Al Hamriyah </option>
                      <option value="Al Haybah">Al Haybah </option>
                      <option value="Al Hayl">Al Hayl </option>
                      <option value="Al Hayr">Al Hayr </option>
                      <option value="Al Hayrah">Al Hayrah </option>
                      <option value="Al Hulaylah">Al Hulaylah </option>
                      <option value="Al Jaddah">Al Jaddah </option>
                      <option value="Al Khari">Al Khari </option>
                      <option value="Al Khashfah">Al Khashfah </option>
                      <option value="Al Mahamm">Al Mahamm </option>
                      <option value="Al Masafirah">Al Masafirah </option>
                      <option value="Al Mataf">Al Mataf </option>
                      <option value="Al Mu'amurah">Al Mu'amurah </option>
                      <option value="Al Naslah">Al Naslah </option>
                      <option value="Al Qir">Al Qir </option>
                      <option value="Al Quwayz">Al Quwayz </option>
                      <option value="Al Usayli">Al Usayli </option>
                      <option value="Al Yahar">Al Yahar </option>
                      <option value="Ar Rafa'ah">Ar Rafa'ah </option>
                      <option value="Arthaban">Arthaban </option>
                      <option value="Athabat">Athabat </option>
                      <option value="Ash Sha'm">Ash Sha'm </option>
                      <option value="As Sur">As Sur </option>
                      <option value="Awanat, Ras al-Khaimah">Awanat, Ras al-Khaimah </option>
                      <option value="Baqal">Baqal </option>
                      <option value="Bidiyah">Bidiyah </option>
                      <option value="Daftah">Daftah </option>
                      <option value="Dhadna">Dhadna </option>
                      <option value="Dibba Al-Fujairah">Dibba Al-Fujairah </option>
                      <option value="Dibba Al-Hisn">Dibba Al-Hisn </option>
                      <option value="Dubai">Dubai </option>
                      <option value="Fujairah">Fujairah </option>
                      <option value="Kalba">Kalba </option>
                      <option value="Kawr Fakkān">Kawr Fakkān </option>
                      <option value="Mīnā' Jabal 'Alī">Mīnā' Jabal 'Alī </option>
                      <option value="Mīnā' Şaqr">Mīnā' Şaqr </option>
                      <option value="Mīnā' Zāyid">Mīnā' Zāyid </option>
                      <option value="Ras al-Khaimah">Ras al-Khaimah </option>
                      <option value="Umm al-Qaiwain">Umm al-Qaiwain </option>
                      <option value="Quţūf">Quţūf </option>
                      <option value="Ruwais">Ruwais </option>
                      <option value="Sharjah">Sharjah </option>
                      <option value="Sila">Sila </option>


                      
                      </select>
                    
                    </div>
                  </div> 
                  
                   <div class="col-sm-6">
                    <div class="form-group{{ $errors->has('outlet_state') ? ' has-danger' : '' }}">
                   
                      <select class="form-control js-select2" data-style="select-with-transition" title="Select Emirate" data-size="7" name="outlet_state" id="outlet_state" 
                     value="{{ old('outlet_state') }}" aria-required="true" >
                     
                      <option value="" selected disabled>Select Emirate</option>
                      <option value="Abu Dhabi">Abu Dhabi </option>
                      <option value="Ajman">Ajman </option>
                      <option value="AL AIN">AL AIN </option>
                      <option value="Dubai">Dubai </option>
                      <option value="Fujairah">Fujairah </option>
                      <option value="Ras Al Khaimah">Ras Al Khaimah </option>
                      <option value="Sharjah">Sharjah </option>
                      <option value="Umm Al Quwain">Umm Al Quwain </option>
                   
                      
                      </select>
                    
                    </div>
                  </div> 

                    <div class="col-sm-6">
                    <div class="form-group{{ $errors->has('outlet_area') ? ' has-danger' : '' }}">
                     <input class="filter-min-with" style="margin-top: 5px;" name="outlet_area" id="input-outlet_area" type="text" placeholder="{{ __('outlet area') }}" value="{{ old('outlet_area') }}" >
                     
                    </div>
                  </div>
                  
                  
                 <!--  <div class="col-sm-6">
                    <div class="form-group{{ $errors->has('outlet_country') ? ' has-danger' : '' }}">
                     <input class="filter-min-with" name="outlet_country" id="input-outlet_country" type="text" placeholder="{{ __('outlet country') }}" value="{{ old('outlet_country') }}"  >
                    
                    </div>
                  </div>  -->
                  
                 </div>    

                 <button type ="submit" class="btn btn-warning mx-auto ">Filter</button></b>
                   

               </form>
               
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
                </div>
              </div>
            </div>
          </div>

@endsection

@push('js')
  <script>

    $(".js-select2").select2();

    $('.js-select2').select2({
        dropdownParent: $('#modelWindow')
    });



    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {

        // $('#datatables thead tr').clone(true).appendTo( '#datatables thead' );
        // $('#datatables thead tr:eq(1) th').each( function (i) {
        //     var title = $(this).text();
        //     $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
     
        //     $( 'input', this ).on( 'keyup change', function () {
        //         if ( table.column(i).search() !== this.value ) {
        //             table
        //                 .column(i)
        //                 .search( this.value )
        //                 .draw();
        //         }
        //     } );
        // } );


      $('#datatables').fadeIn(1100);
     var table =  $('#datatables').DataTable({
        "pagingType": "full_numbers",
        "paging":   false,
        "lengthMenu": [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
        ],
        responsive: true,
        // orderCellsTop: true,
        // fixedHeader: true,
        language: {
          search: "_INPUT_",
          searchPlaceholder: "Search outlet..",
        }
      });


    });

    $('#btn').click(function() {
        $('#modelWindow').modal('show');
    });

 
  </script>
@endpush
