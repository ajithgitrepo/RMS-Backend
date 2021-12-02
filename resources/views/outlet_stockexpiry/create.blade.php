
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
  /*margin-top: 20px;*/
  outline: none;
  transition: all 0.15s ease-in-out;
}

.select2.select2-container .select2-selection .select2-selection__rendered {
  color: #333;
  line-height: 32px;
  padding-right: 33px;
}

.select2.select2-container .select2-selection .select2-selection__arrow {
  background: #f8f8f8;
  border-left: 1px solid #ccc;
  -webkit-border-radius: 0 3px 3px 0;
  -moz-border-radius: 0 3px 3px 0;
  border-radius: 0 3px 3px 0;
  height: 32px;
  width: 33px;
  /*margin-top: 20px;*/
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

.form-control:disabled, .form-control[readonly] {
    background-color: #ffffff !important;
    opacity: 1;
}

</style>

@extends('layouts.app', ['activePage' => 'journey-plan', 'menuParent' => 'Journey-Plan', 'titlePage' => __('Customer Activity')])


@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('outlet_stockexpiry.store') }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">add_task</i>
                </div>
                <h4 class="card-title">{{ __('Outlet Stock Expiry') }}</h4>
               </div>
              
              <div class="card-body ">

                @php

                    $parameter= Crypt::decrypt(Request::segment(2));

                @endphp
              
                <div class="row">
                  <div class="col-md-12 text-right">
                       <a href="{{ route('c-activity',['id' => $parameter ]) }}" title="Back to Activity" class="btn btn-sm btn-rose"><i class="fa fa-arrow-left"> Back</i></a>
                   </div>
                 </div>
                
                <div class="row" hidden="">
                   <label class="col-sm-2 col-form-label">{{ __('Outlet id') }}</label>
                  <div class="col-sm-4">
                    <div class="form-group{{ $errors->has('timesheet_id') ? ' has-danger' : '' }}">
                     
                    <input class="form-control{{ $errors->has('timesheet_id') ? ' is-invalid' : '' }}" name="timesheet_id" id="input-timesheet_id" type="text" placeholder="{{ __('Timesheet Id') }}" value="{{ old('timesheet_id',$parameter) }}"  aria-required="true"/ readonly="">
                    
                      @include('alerts.feedback', ['field' => 'timesheet_id'])
                    </div>
                   </div>
                 
                </div>

                 <div class="row">

                  <label class="col-sm-2 col-form-label">{{ __('Product') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('product_id') ? ' has-danger' : '' }}">
                    
                      <select class="form-control js-select2" name="product_id" id="input-product_id" 
                        value="{{ old('product_id') }}" >
                             
                               <option value="">Select product / Zrep / Sku / Barcode</option>
                               @foreach ($result as $product)
                            <option value="{{ $product->product_id }}"> {{  $product->p_name  }} / {{  $product->zrep_code  }} / {{  $product->sku  }} / {{  $product->barcode }} </option>
                        @endforeach
                    </select>

                     @include('alerts.feedback', ['field' => 'product_id'])
                
                    </div>
                  </div>

                </div>

                 <div class="row">
                   <label class="col-sm-2 col-form-label">{{ __('BarCode') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('barcode') ? ' has-danger' : '' }}">
                     
                    <input class="form-control{{ $errors->has('barcode') ? ' is-invalid' : '' }}" name="barcode" 
                    id="input-barcode" type="number" step=any placeholder="{{ __('') }}" 
                    value=""  aria-required="true"/ readonly>
                    
                      @include('alerts.feedback', ['field' => 'barcode'])
                    </div>
                   </div>
                 
                </div>
                
              <!--    <div class="row">
                   <label class="col-sm-2 col-form-label">{{ __('Piece Price') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('piece_price') ? ' has-danger' : '' }}">
                     
                    <input class="form-control{{ $errors->has('piece_price') ? ' is-invalid' : '' }}" name="piece_price" 
                    id="input-piece_price" type="number" step=any placeholder="{{ __('') }}" 
                    value="{{ old('piece_price') }}"  aria-required="true"/>
                    
                      @include('alerts.feedback', ['field' => 'piece_price'])
                    </div>
                   </div>
                 
                </div> -->

                <div class="row">
                   <label class="col-sm-2 col-form-label">{{ __('Near Expiry in Pieces') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('near_expiry') ? ' has-danger' : '' }}">
                     
                    <input class="form-control{{ $errors->has('near_expiry') ? ' is-invalid' : '' }}" name="near_expiry" 
                    id="input-near_expiry" type="number" placeholder="{{ __('') }}" 
                    value="{{ old('near_expiry') }}"  aria-required="true"/>
                    
                      @include('alerts.feedback', ['field' => 'near_expiry'])
                    </div>
                   </div>
                 
                </div>

               <!--   <div class="row">
                  
                  <label class="col-sm-2 col-form-label">{{ __('Total Available Cases') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('total_available_cases') ? ' has-danger' : '' }}">
                     
                    <input class="form-control{{ $errors->has('total_available_cases') ? ' is-invalid' : '' }}" name="total_available_cases" 
                    id="input-total_available_cases" type="number" placeholder="{{ __('') }}" 
                    value="{{ old('total_available_cases') }}"  aria-required="true"/>
                    
                      @include('alerts.feedback', ['field' => 'total_available_cases'])
                    </div>
                  </div>
                </div> -->
                
                <!--   <div class="row">
                   <label class="col-sm-2 col-form-label">{{ __('Total Available Pieces') }}</label>
                   <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('total_available_pieces') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('total_available_pieces') ? ' is-invalid' : '' }}" name="total_available_pieces" 
                      id="input-total_available_pieces" type="number" placeholder="{{ __('') }}" 
                      value="{{ old('total_available_pieces') }}"  aria-required="true"/>
                      @include('alerts.feedback', ['field' => 'total_available_pieces'])
                    </div>
                  </div>
                
                </div> -->

                <div class="row">
                 
                    <label class="col-sm-2 col-form-label">{{ __('Expiry Date') }}</label>
                    <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('expiry_date') ? ' has-danger' : '' }}">
                      <input class="form-control datepicker{{ $errors->has('expiry_date') ? ' is-invalid' : '' }}" name="expiry_date" id="input-expiry_date" type="text" placeholder="{{ __('') }}" value="{{ old('expiry_date') }}"  aria-required="true"/>
                      @include('alerts.feedback', ['field' => 'expiry_date'])
                    </div>
                  </div>
                </div>

                 <div class="row">
                   <label class="col-sm-2 col-form-label">{{ __('Exposure Qty (Will Expire)') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('exposure_qty') ? ' has-danger' : '' }}">
                     
                    <input class="form-control{{ $errors->has('exposure_qty') ? ' is-invalid' : '' }}" name="exposure_qty" 
                    id="input-exposure_qty" type="number" placeholder="{{ __('') }}" 
                    value="{{ old('exposure_qty') }}"  aria-required="true"/>
                    
                      @include('alerts.feedback', ['field' => 'exposure_qty'])
                    </div>
                   </div>
                 
                </div>
                
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Remarks') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('remarks') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('remarks') ? ' is-invalid' : '' }}" name="remarks" id="input-remarks" type="text" placeholder="{{ __('') }}" value="{{ old('remarks') }}"  aria-required="true"/>
                      @include('alerts.feedback', ['field' => 'remarks'])
                    </div>
                  </div>
               
                </div>
              
                
              
                
                
               
                
                <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-rose text-center">{{ __('Add') }}</button>
               </div>
              
              </div> 
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection


@push('js')

<script>

    $(".js-select2").select2();
      $(".js-select2-multi").select2();

      $(".large").select2({
        dropdownCssClass: "big-drop",
      });

      $('#input-product_id').on('change', function() {
          //alert( $( "#input-product_id option:selected" ).text() );
          var full_text = $( "#input-product_id option:selected" ).text();
          var last = full_text.substring(full_text.lastIndexOf("/") + 1, full_text.length);
          //alert(last);
          $("#input-barcode").val(parseInt(last));

          
      });

 $(document).ready(function () {
      
      $(".datepicker").datetimepicker({
        format: 'DD-MM-YYYY',
        useCurrent: false
      });

    });
      
       $(document).ready(function() {
  
    // initialise Datetimepicker and Sliders
  
      md.initFormExtendedDatetimepickers();
         
      if ($('.slider').length != 0) {
      
        md.initSliders();
      } 
      
    }); 
    
</script>
@endpush

