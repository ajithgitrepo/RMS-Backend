
<style type="text/css">
    .form-group input[type=file] {
        opacity: 1 !important;
        position: initial !important;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1;
    }
</style>


@extends('layouts.app', ['activePage' => 'outlets', 'menuParent' => 'Outlets', 'titlePage' => __('Outlets')])



@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('outlet-products.store') }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">add_task</i>
                </div>
                <h4 class="card-title">{{ __('Add Brands To Outlet') }}</h4>
               </div>
              
              <div class="card-body ">
              
                <div class="row">
                  <div class="col-md-12 text-right">
                   <!--  <a href="/import_csv" class="btn btn-sm btn-info">{{ __('Import CSV / EXCEL') }}</a> -->
<!--                     <a href="{{ route('outlet-products.index') }}" class="btn btn-sm btn-rose">{{ __('Back to outlet products') }}</a> -->
                    
                  </div>
                </div>

                <div class="row" hidden="">
                  <label class="col-sm-2 col-form-label">{{ __('Outlet Id') }}</label>
                  <div class="col-sm-6">
                    <div class="form-group{{ $errors->has('outlet_id') ? ' has-danger' : '' }}">

                    <input class="form-control {{ $errors->has('outlet_id') ? ' is-invalid' : '' }}" name="outlet_id" id="input-outlet_id" type="text" placeholder="{{ __('Outlet ID') }}" value="{{ Request::segment(3) }} " readonly="" aria-required="true"/>
                    
                      @include('alerts.feedback', ['field' => 'year'])
                    </div>
                  </div>
                </div>
                  
                
                <div class="row"> 
                  <label class="col-sm-2 col-form-label">{{ __('Outlet') }}</label>
                  <div class="col-sm-6">
                    <div class="form-group{{ $errors->has('outlet_name') ? ' has-danger' : '' }}">
               

                        <select class="form-control selectpicker" data-style="select-with-transition" title="Select Outlet" data-size="7" name="outlet_name" id="input_outlet" 
                     value="{{ old('outlet_name') }}" aria-required="true" >
                     
                       @foreach ($outlets as $out)
                     <option value="{{$out->outlet_id}}" selected=""> {{ $out->store[0]->store_name }}</option>
                         @endforeach

                      </select>
                   
                      @include('alerts.feedback', ['field' => 'outlet_name'])
                    </div>
                  </div>
                </div>



                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Brands') }}</label>
                  <div class="col-sm-6">
                    <div class="form-group{{ $errors->has('brand') ? ' has-danger' : '' }}">
                    

                   <!--   <select class="form-control selectpicker" data-style="select-with-transition" title="Select Brands" data-size="7" name="brand[]" id="input_days" 
                     value="{{ old('brand') }}" aria-required="true" multiple="" >
                     
                      <option value="" disabled>Select Brands</option>
                       @foreach ($brands as $brand)
                      <option value="{{$brand->id}}"> {{ $brand->brand_name }}</option>
                      @endforeach

                      </select> -->

                    @php

                        $array_push = [];

                    @endphp

                      <select class="form-control select_brand selectpicker" data-container="body" data-style="select-with-transition" title="Select Brands" data-size="7" name="brand[]" id="select_brand" 
                     value="{{ old('brand') }}" aria-required="true" multiple="" required="">

                       
                          @foreach ($brands as $brand)

                           @if(!in_array($brand->client_id, $array_push))
                              <optgroup label="{{$brand->first_name}} {{$brand->middle_name}} {{$brand->surname}}">
                            @endif

                            <option value="{{$brand->id}},{{ $brand->brand_name }}" > {{ $brand->brand_name }}</option>

                                @php

                                    $array_push[] = $brand->client_id;

                                @endphp

                          @endforeach

                   
                    </select>

                      @include('alerts.feedback', ['field' => 'brand']) 
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Share Of Shelf And Target') }}</label>
                  <div class="col-sm-6" style="margin-top: 10px;">
                    <div id="newRow" class="form-group{{ $errors->has('shelf') ? ' has-danger' : '' }}">

                        <!--  <div class="input-group mb-3" id="1">
                                <div class="col-lg-6">
                                    <input type="text" name="shelf[]" class="form-control"  autocomplete="off" required>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" name="target[]" class="form-control "  autocomplete="off" required>
                                </div>
                           </div>
                            <div class="input-group mb-3" id="2">
                                <div class="col-lg-6">
                                    <input type="text" name="shelf[]" class="form-control"  autocomplete="off" required>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" name="target[]" class="form-control "  autocomplete="off" required>
                                </div>
                           </div>
                            <div class="input-group mb-3" id="3">
                                <div class="col-lg-6">
                                    <input type="text" name="shelf[]" class="form-control"  autocomplete="off" required>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" name="target[]" class="form-control " autocomplete="off" required>
                                </div>
                           </div> -->
                    
                      @include('alerts.feedback', ['field' => 'shelf'])
                    </div>
                  </div>
                </div>

                 <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Planogram Image') }}</label>
                  <div class="col-sm-6" style="margin-top: 10px;">
                    <div id="planogram" class="form-group{{ $errors->has('myfile') ? ' has-danger' : '' }}">


                      @include('alerts.feedback', ['field' => 'myfile'])
                    </div>
                  </div>
                </div>
                
                
                <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-rose text-center">{{ __('Save') }}</button>
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

    // $('#select_brand').selectpicker();

    var selected = [];
    var noselected = [];
    
    $('.select_brand').change(function()
    { 
         var check = false;

         // if ($("#select_brand option:selected").length) {
         //    //alert('you have select ' + $("#select_brand option:selected").last().val() );
         //  }
         //  else
         //  {
         //    //alert('you have Unselect' + $(this).val());
         //  }
            

        // if(!$(this).is(':selected'))
        //     alert('you have select' + $(this).val());
        // else
        //     alert('you have Unselect' + $(this).val());


          $.each($('#select_brand option'), function (key, value) {

                if (!$(this).prop('selected')) {
                   // noselected[key] = $(this).val();
                    //alert($(this).val());

                    var array = $(this).val().split(',');

                     //alert(array[0]);
                    
                    if ($("#"+array[0]).length){
                       // alert($(this).val());
                        check = true;
                        $("#"+array[0]).remove();
                        $("#file"+array[0]).remove();
                    }


                } else {
                    //selected[key] = $(this).val();
                    //alert($(this).val());
                }
            });
            

            var arr = $(this).val();

            var html = '';

            var html1 = '';

           
           if(check === false)
           {
              // $('#newRow').html('');

                for(i=0; i<=arr.length; i++)
                {
                    //alert(arr[i]);
                    
                     
                    if(arr[i] !== undefined)
                    {

                        var array = arr[i].split(',');
                        //alert(array[1]);

                        //alert(array[0]);

                        if ($("#"+array[0]).length)
                        {
                            //alert(array[0]);
                        }

                        else
                        {
                            html += '<div class="input-group mb-3 " id="'+array[0]+'">';

                            html += '<div class="col-lg-4">';
                            html += '<h6> '+array[1]+' </h6>';
                            html += '</div>';
                            
                            html += '<div class="col-lg-4">';
                            html += '<input type="number" id="'+array[0]+'shelf"  name="shelf[]" brand="'+array[1]+'" class="form-control " placeholder="Shelf" autocomplete="off" required>';
                            html += '</div>';

                            html += '<div class="col-lg-4">';
                            html += '<input type="number" id="'+array[0]+'target" name="target[]" brand="'+array[1]+'" class="form-control " placeholder=" Target" autocomplete="off" required>';
                            html += '</div>'; 

                            html += '<div class="col-lg-4" hidden>';
                            html += '<input type="number" name="brand_id[]"  value="'+array[0]+'"  class="form-control" placeholder="Target" autocomplete="off" required>';
                            html += '</div>'; 

                            html += '</div>';

                            html1 += '<div class="input-group mb-3 " id="file'+array[0]+'">';

                            html1 += '<div class="col-lg-4">';
                            html1 += '<h6> '+array[1]+' </h6>';
                            html1 += '</div>';
                            
                            html1 += '<div class="col-lg-8">';
                            html1 += '<input type="file" name="myfile[]" accept="image/*" class="form-control " required >';
                            html1 += '</div>';

                            // html1 += '<div class="col-lg-4">';
                            // html1 += '<input type="number" id="'+array[0]+'target" name="target[]" brand="'+array[1]+'" class="form-control " placeholder=" Target" autocomplete="off" required>';
                            // html1 += '</div>'; 

                            // html1 += '<div class="col-lg-4" hidden>';
                            // html1 += '<input type="number" name="brand_id[]"  value="'+array[0]+'"  class="form-control " placeholder="Target" autocomplete="off" required>';
                            // html1 += '</div>'; 

                            html1 += '</div>';
                        }

                    }
                    
                }

           $('#newRow').append(html);
           $('#planogram').append(html1);

           }
            

        });

    // var myChoices = new Array();
    // $('#select_brand').on('changed.bs.select', function(e, clickedIndex, isSelected, previousValue) {
    //   var selected = document.getElementById("select_brand").options[clickedIndex].value;
    //   if (myChoices.indexOf(selected) == -1) {
    //     myChoices.push(selected);
    //   } else {
    //     myChoices.splice(myChoices.indexOf(selected), 1);
    //   }
    //   console.log(myChoices);
    // });

    // $('#select_brand').on('change.bs.select', function() {

    //     $('#select_brand option:selected').prependTo('#select_brand');
    //     $(this).selectpicker('refresh');

    // });


 
  </script>
@endpush
