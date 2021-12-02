


@extends('layouts.app', ['activePage' => 'outlets', 'menuParent' => 'Outlets', 'titlePage' => __('Outlets')])


@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
           <form method="post" action="{{ route('outlet_share', Request::segment(3)) }}" autocomplete="off" class="form-horizontal " enctype="multipart/form-data">
            @csrf
            @method('post')   

            <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">add_task</i>
                </div>
                <h4 class="card-title">{{ __('Add Share Of Shelf') }}</h4>
               </div>
              
              <div class="card-body ">
              
                <div class="row">
                  <div class="col-md-12 text-right">
                    <a href="{{ url('outlet-products/view_edit',Crypt::decrypt(Request::segment(2))) }}"  class="btn btn-sm btn-rose">{{ __('Back to Outlet Category') }}</a>
                    
                  </div>
                </div> 

            <div class="row" hidden="" >
              <label class="col-sm-2 col-form-label">{{ __('Outlet Id') }}</label>
              <div class="col-sm-">
                <div class="form-group{{ $errors->has('outlet_id') ? ' has-danger' : '' }}">

                <input class="form-control {{ $errors->has('outlet_id') ? ' is-invalid' : '' }}" name="outlet_id" id="input-outlet_id" type="text" placeholder="{{ __('Outlet ID') }}" value="{{ Request::segment(3) }} " readonly="" aria-required="true"/>
                
                  @include('alerts.feedback', ['field' => 'outlet_id'])
                </div>
              </div>
            </div>
          
        
            <div class="row"> 
              <label class="col-sm-2 col-form-label">{{ __('Outlet') }}</label>
              <div class="col-sm-6">
                <div class="form-group{{ $errors->has('outlet_name') ? ' has-danger' : '' }}">
           

                    <select class="form-control selectpicker" data-style="select-with-transition" title="Select Outlet" data-size="7" name="outlet_name" id="input_outlet" 
                 value="{{ old('outlet_name') }}" aria-required="true" >
                 
                  <option value="" disabled>Select Outlet</option>
                   @foreach ($outlets as $out)
                 <option value="{{$out->outlet_id}}" selected="">{{ $out->store[0]->store_code }} - {{ $out->store[0]->store_name }} - {{ $out->store[0]->address }}</option>
                     @endforeach

                  </select>
               
                  @include('alerts.feedback', ['field' => 'outlet_name'])
                </div>
              </div>
            </div>

           
            <div class="row"> 
              <label class="col-sm-2 col-form-label">{{ __('Categories') }}</label>
              <div class="col-sm-6">
                <div class="form-group{{ $errors->has('categories') ? ' has-danger' : '' }}">
           

                    <select class="form-control selectpicker select_category" data-style="select-with-transition" title="Select Category" data-size="7" name="categories[]" id="select_category" 
                 value="{{ old('categories') }}" aria-required="true" required="" multiple="" >
                 
                  <option value="" disabled>Select Category</option>

                   @foreach ($categories as $cat)

                   @if($cat->target)

                 <option value="{{$cat->id}}-{{ $cat->category_name }}-{{ $cat->category_id }}" selected="" > {{ $cat->category_name }} </option>

                 @endif

                  @if(!$cat->target)

                 <option value="{{$cat->id}}-{{ $cat->category_name }}-{{ $cat->category_id }}" > {{ $cat->category_name }} </option>

                 @endif

                     @endforeach

                  </select>
               
                  @include('alerts.feedback', ['field' => 'categories'])
                </div>
              </div>
            </div>

             <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Share Of Shelf And Target') }}</label>
                  <div class="col-sm-6" style="margin-top: 10px;">
                    <div id="newRow" class="form-group{{ $errors->has('shelf') ? ' has-danger' : '' }}">


                     @foreach ($categories as $old)

                        @if($old->target)

                            <div class="input-group mb-3" id="cat_id{{$old->id}}">

                                <div class="col-lg-4">
                                    <h6> {{ $old->category_name }} </h6>
                                </div>
                            

                               <!--  <div class="col-lg-4">
                                    <input type="number" name="shelf[]" class="form-control" value="{{ $old->shelf }}" placeholder="Shelf " autocomplete="off" required>
                                </div> -->

                                <div class="col-lg-4">
                                    <input type="number" name="target[]" class="form-control " value="{{ $old->target }}"  placeholder="Target" autocomplete="off" required>
                                </div>

                                <div class="col-lg-4" hidden="">
                                    <input type="number" name="mapping_id[]" class="form-control " value="{{ $old->id }}"  placeholder="" autocomplete="off" required>
                                </div>

                                <div class="col-lg-4" hidden="">
                                    <input type="number" name="category_id[]"  value="{{ $old->category_id }}"  class="form-control "placeholder="" autocomplete="off" >
                                </div>

                           </div>

                        @endif

                     @endforeach
                    
                      @include('alerts.feedback', ['field' => 'shelf'])
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
    
    $('.select_category').change(function()
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


         $.each($('#select_category option'), function (key, value) {

            if (!$(this).prop('selected')) {
                //noselected[key] = $(this).val();
                //alert($(this).val());

                var array = $(this).val().split('-');

                //alert(array[0]);

                if ($("#cat_id"+array[0]).length){
                   // alert($(this).val());
                    check = true;
                    $("#cat_id"+array[0]).remove();
                }

            } 
            else 
            {
                selected[key] = $(this).val();
                //alert($(this).val());
            }

        });



            var arr = $(this).val();
            //alert(arr);

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

                        var array = arr[i].split('-');
                        //alert(array[1]);

                        //alert(array[0]);

                        if ($("#cat_id"+array[0]).length)
                        {
                            //alert(array[0]);
                        }

                        else
                        {
                            html += '<div class="input-group mb-3 " id="cat_id'+array[0]+'">';

                            html += '<div class="col-lg-4">';
                            html += '<h6> '+array[1]+' </h6>';
                            html += '</div>';
                            
                            // html += '<div class="col-lg-4">';
                            // html += '<input type="number" id="'+array[0]+'shelf"  name="shelf[]" brand="'+array[1]+'" class="form-control " placeholder="Shelf" autocomplete="off" required>';
                            // html += '</div>';

                            html += '<div class="col-lg-4">';
                            html += '<input type="number" id="'+array[0]+'target" name="target[]" brand="'+array[1]+'" class="form-control " placeholder=" Target" autocomplete="off" required>';
                            html += '</div>'; 

                            html += '<div class="col-lg-4" hidden>';
                            html += '<input type="number" name="mapping_id[]"  value="'+array[0]+'"  class="form-control" placeholder="" autocomplete="off" required>';
                            html += '</div>'; 

                            html += '<div class="col-lg-4" hidden="">';
                            html += '<input type="number" name="category_id[]"  value="'+array[2]+'" class="form-control " placeholder="" autocomplete="off" >';
                            html += '</div>';


                            html += '</div>';



                            // html1 += '<div class="input-group mb-3 " id="file'+array[0]+'">';

                            // html1 += '<div class="col-lg-4">';
                            // html1 += '<h6> '+array[1]+' </h6>';
                            // html1 += '</div>';
                            
                            // html1 += '<div class="col-lg-8">';
                            // html1 += '<input type="file" name="myfile[]" accept="image/*" class="form-control " required >';
                            // html1 += '</div>';

                            // html1 += '<div class="col-lg-4">';
                            // html1 += '<input type="number" id="'+array[0]+'target" name="target[]" brand="'+array[1]+'" class="form-control " placeholder=" Target" autocomplete="off" required>';
                            // html1 += '</div>'; 

                            // html1 += '<div class="col-lg-4" hidden>';
                            // html1 += '<input type="number" name="brand_id[]"  value="'+array[0]+'"  class="form-control " placeholder="Target" autocomplete="off" required>';
                            // html1 += '</div>'; 

                            //html1 += '</div>';
                        }

                    }
                    
                }

           $('#newRow').append(html);
           //$('#planogram').append(html1);

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
