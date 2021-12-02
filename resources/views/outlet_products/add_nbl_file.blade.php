@extends('layouts.app', ['activePage' => 'outlets', 'menuParent' => 'Outlets', 'titlePage' => __('Outlets')])


@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('update_nbl_file') }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">

            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                 <i class="material-icons">outlet</i>
                </div>
                <h4 class="card-title">{{ __('Add NBL File') }}</h4>
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

                    <input class="form-control {{ $errors->has('outlet_id') ? ' is-invalid' : '' }}" name="outlet_id" id="input-outlet_id" type="text" placeholder="{{ __('Outlet ID') }}" value="{{ Request::segment(2) }} " readonly="" aria-required="true"/>
                    
                      @include('alerts.feedback', ['field' => 'outlet_id'])
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('NBL FILE') }}</label>
                  <div class="col-sm-7">
                   <input class="form-control{{ $errors->has('nbl_file') ? ' is-invalid' : '' }}" type="file" name="nbl_file[]" multiple required="" >
                   
                    
                      @include('alerts.feedback', ['field' => 'nbl_file'])
                      
                    </div>
                  </div>
                </div> 
               
              
                <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-rose text-center">{{ __('Add') }}</button>

               </div>
              
              </div> 
            </div>


                 @if ($message = Session::get('warning'))
                  <div class="alert alert-warning alert-block" style="margin:auto;">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                          <strong>{{ $message }}</strong>
                  </div>
                  @endif
                

          </form>

        </div>
      </div>
    </div>
  </div>
@endsection


