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
  margin-top: 20px;
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
  margin-top: 20px;
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
</style>


@extends('layouts.app', ['activePage' => 'promotion', 'menuParent' => 'Promotion', 'titlePage' => __('Promotion')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">

          <form method="post" action="{{ route('promotion.update', $result[0]->id ) }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                 <i class="fa fa-tag"></i>
                </div>
                <h4 class="card-title">{{ __('Edit Promotion') }}</h4>
              </div>
              
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('promotion.index') }}" class="btn btn-sm btn-rose">{{ __('Back to promotion') }}</a>
                  </div>
                </div>
               

                 <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Outlet') }}</label>
                  <div class="col-sm-7">
                   <select class="form-control js-select2" data-style="select-with-transition"  title="Select Month" data-size="7" name="outlet_id" id="input-outlet_id" 
                     value="{{ old('outlet_id') }}" aria-required="true" required >
                      <option value="" selected="">Select Outlet</option>

                        @foreach ($outlets as $out)

                        <option value="{{ $out->outlet_id}}" @if ($result[0]->outlet_id == $out->outlet_id) {{ 'selected' }} @endif ) > {{ $out->store_name }} </option>

                        @endforeach  
                     
                    </select>
                     @include('alerts.feedback', ['field' => 'outlet_id'])
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Sku / Item / Product') }}</label>
                  <div class="col-sm-7">
                    
                   
                    <select class="form-control js-select2 " data-style="select-with-transition"  title="Sku / Item / Product " data-size="7" name="product_id" value="{{ old('product_id') }}" aria-required="true" id="product_add" required>

                        @foreach ($products as $pro)

                            <option value="{{ $pro->product_id}}" @if ($result[0]->product_id == $pro->product_id) {{ 'selected' }} @endif ) > {{ $pro->p_name }} </option>

                        @endforeach 

                      </select>
                      @include('alerts.feedback', ['field' => 'product_id'])
                   
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('From Date') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('from_date') ? ' has-danger' : '' }}">
                    

                    <input class="form-control datepicker {{ $errors->has('from_date') ? ' is-invalid' : '' }}" name="from_date" id="input-from_date" type="text" placeholder="{{ __('') }}" value="{{ old('from_date',date('d-m-Y',strtotime($result[0]->from_date))) }} "   aria-required="true" required>
                    
                      @include('alerts.feedback', ['field' => 'from_date'])
                    </div>
                  </div>
                </div>

                 <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('To Date') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('to_date') ? ' has-danger' : '' }}">
                    

                    <input class="form-control datepicker {{ $errors->has('to_date') ? ' is-invalid' : '' }}" name="to_date" id="input-to_date" type="text" placeholder="{{ __('') }}" value="{{ old('to_date',date('d-m-Y',strtotime($result[0]->to_date))) }} "   aria-required="true" required>
                    
                      @include('alerts.feedback', ['field' => 'to_date'])
                    </div>
                  </div>
                </div>

                 <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Description') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                    

                    <input class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" id="input-description" type="text" placeholder="{{ __('Year') }}" value="{{ old('description',$result[0]->description) }} "   aria-required="true" required>
                    
                      @include('alerts.feedback', ['field' => 'description'])
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Promotion Image') }}</label>
                  <div class="col-sm-7">
                   <input type="file" class="form-control" name="image_url[]"  />
                  
                    </div>
                </div>
                
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-rose mx-auto">{{ __('update') }}</button>
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
    
 $(function () {
                  
                $('.datepicker').datetimepicker({
             format: 'DD-MM-YYYY',
            
      });
  });
  
    $(document).ready(function() {
  
    // initialise Datetimepicker and Sliders
  
      md.initFormExtendedDatetimepickers();
         
      if ($('.slider').length != 0) {
      
        md.initSliders();
      } 
      
    }); 


      $('#select-role').on('change', function() {
      //alert( this.value );

      var role = this.value;

       var csrf = $('meta[name="csrf-token"]').attr('content');
      $.ajax({
          url: '/get_emp_list',
          type: 'GET',
          data: {role : role, '_token': csrf},
          dataType: 'json',

          success: function( data ) {
             //alert(data);
             var sel = $("#input-employee");
             sel.empty();
             sel.append('<option selected disabled value=""> Select Employee </option>'); 

                for (var i=0; i<data.length; i++) {
                  sel.append('<option value="' + data[i].employee_id + '">' + data[i].first_name +" "+ data[i].middle_name +" "+ data[i].surname  + '</option>');
                }
           
          }       
      })

    });

       $('#input-outlet_id').on('change', function(e) {
        //alert( this.value );

        var outlet = $(e.target).val();
        //alert(outlet);

        var csrf = $('meta[name="csrf-token"]').attr('content');
          $.ajax({
              url: '/get_promo_products',
              type: 'GET',
              data: {outlet_id : outlet, '_token': csrf},
              dataType: 'json',

              success: function( data ) {
                 //alert(data);

                var html = '';

                $('#product_add').empty();

                 html = '<option value="" selected>Sku / Item / Product</option>';

                 $('#product_add').append(html);

                 $.each(data, function (i, val) {

                        //alert(data[i]['p_name']);
 
                        html =  '<option value=" '+data[i]['product_id']+' ">'+data[i]['p_name']+'</option>'
                      
                        $('#product_add').append(html);

                 });

                
               
              }       
          })


    });

  </script>
  
 
@endpush

