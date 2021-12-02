
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
           <form method="post" action="{{ route('outlet_planogram', Request::segment(3)) }}" autocomplete="off" class="form-horizontal " enctype="multipart/form-data">
            @csrf
            @method('post')   

            <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">add_task</i>
                </div>
                <h4 class="card-title">{{ __('Add Planogram') }}</h4>
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

                   @if($cat->planogram_img)

                 <option value="{{$cat->id}}-{{ $cat->category_name }}-{{ $cat->category_id }}" selected="" > {{ $cat->category_name }} </option>

                 @endif

                  @if(!$cat->planogram_img)

                 <option value="{{$cat->id}}-{{ $cat->category_name }}-{{ $cat->category_id }}" > {{ $cat->category_name }} </option>

                 @endif

                @endforeach

                  </select>
               
                  @include('alerts.feedback', ['field' => 'categories'])
                </div>
              </div>
            </div>

             <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Planogram') }}</label>
                  <div class="col-sm-6" style="margin-top: 10px;">
                    <div id="planogram" class="form-group{{ $errors->has('shelf') ? ' has-danger' : '' }}">


                      @foreach ($categories as $old)

                        @if($old->planogram_img)
                         <div class="input-group mb-3 " id="file{{$old->id}}">
                            <div class="col-lg-4">
                                <h6> {{ $old->category_name }} </h6>
                            </div>
                            
                            <div class="col-lg-4" hidden="">
                                <input type="number" name="mapping_id[]" class="form-control " value="{{ $old->id }}"  placeholder="" autocomplete="off" required>
                            </div>

                            <div class="col-lg-4" hidden="">
                                <input type="number" name="category_id[]" class="form-control " value="{{ $old->category_id }}"  placeholder="" autocomplete="off" required>
                            </div>

                       
                           <div class="col-lg-6">
                                <input type="file" name="myfile[]" accept="image/*" class="form-control " >
                            </div>

                           
                             <div class="col-lg-2">
                                <div class="avatar avatar-sm " style="width:70px; height:100px;overflow: hidden;">
                              
                                  
                                    <img id="" src="/planogram_image/{{ $old->planogram_img }}" onclick="DoSomething(this.src);" alt="" style="max-width: 70px;">
                                  
                                </div>
                            </div>
                        @endif


                        </div>
                         @endforeach
                    
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

   <!-- Classic Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Planogram Image</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <i class="material-icons">clear</i>
          </button>
        </div>
        <div class="modal-body">
         
            <img style="height:330px;width:450px;" src="" id="FullImage"> </img>
        </div>
        <div class="modal-footer">
        
          <button type="button" class="btn btn-danger btn-link" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!--  End Modal -->

@endsection

@push('js')
    
  <script>

    // $('#select_brand').selectpicker();

    var selected = [];
    var noselected = [];
    
    $('.select_category').change(function()
    { 
        //alert();
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

            //alert();

            if (!$(this).prop('selected')) {
                //noselected[key] = $(this).val();
                //alert($(this).val());

                var array = $(this).val().split('-');

                //alert(array[0]);

                if ($("#file"+array[0]).length){
                   // alert($(this).val());
                    check = true;
                    $("#file"+array[0]).remove();
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

              //alert(arr);

                for(i=0; i<=arr.length; i++)
                {
                    //alert(arr[i]);
                    
                     
                    if(arr[i] !== undefined)
                    {

                        var array = arr[i].split('-');
                        //alert(array[1]);

                        //alert(array[0]);

                        if ($("#file"+array[0]).length)
                        {
                            //alert(array[0]);
                        }

                        else
                        {
                            //alert(array[0]);

                            html1 += '<div class="input-group mb-3 " id="file'+array[0]+'">';

                            html1 += '<div class="col-lg-4">';
                            html1 += '<h6> '+array[1]+' </h6>';
                            html1 += '</div>';

                            html1 += '<div class="col-lg-4" hidden>';
                            html1 += '<input type="number" name="mapping_id[]"  value="'+array[0]+'"  class="form-control" placeholder="" autocomplete="off" required>';
                            html1 += '</div>'; 

                            html1 += '<div class="col-lg-4" hidden="">';
                            html1 += '<input type="number" name="category_id[]" class="form-control " value="'+array[2]+'"  placeholder="" autocomplete="off" required>';
                            html1 += '</div>';

                            
                            html1 += '<div class="col-lg-8">';
                            html1 += '<input type="file" name="myfile[]" accept="image/*" class="form-control " required >';
                            html1 += '</div>';
                        }

                    }
                    
                }

           $('#planogram').append(html1);

           }
            

        });

   
    function DoSomething(data)
    {

       $('#FullImage').attr('src',data );
       $('#myModal').modal('show');

    }


 
  </script>
@endpush
