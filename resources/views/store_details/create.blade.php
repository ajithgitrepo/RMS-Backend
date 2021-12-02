
@extends('layouts.app', ['activePage' => 'store_details', 'menuParent' => 'Store_Details', 'titlePage' => __('Store 
Details')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('store_details.store') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">add_task</i>
                </div>
                <h4 class="card-title">{{ __('Store_Details') }}</h4>
               </div>
              
              <div class="card-body ">
              
                <div class="row">
                  <div class="col-md-12 text-right">
                    <a href="/import_store" class="btn btn-sm btn-info">{{ __('Import CSV / EXCEL') }}</a>
                      <a href="{{ route('store_details.index') }}" class="btn btn-sm btn-rose">{{ __('Back to store details') }}</a>
                  </div>
                </div>
                
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Store Code') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('store_code') ? ' has-danger' : '' }}">
                    
                   <input class="form-control{{ $errors->has('store_code') ? ' is-invalid' : '' }}" name="store_code" id="input-store_code" type="text" placeholder="{{ __('Store Code') }}" value="{{ old('store_code') }}"  aria-required="true"/>
                   
                      @include('alerts.feedback', ['field' => 'store_code'])
                    </div>
                  </div>
                </div>
                
                 <div class="row">
                   <label class="col-sm-2 col-form-label">{{ __('Store Name') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('store_name') ? ' has-danger' : '' }}">
                     
                    <input class="form-control{{ $errors->has('store_name') ? ' is-invalid' : '' }}" name="store_name" id="input-store_name" type="text" placeholder="{{ __('Store Name') }}" value="{{ old('store_name') }}"  aria-required="true"/>
                    
                      @include('alerts.feedback', ['field' => 'store_name'])
                    </div>
                   </div>
                  </div>
                
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Contact Number') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('contact_number') ? ' has-danger' : '' }}">
                     
                    <input class="form-control{{ $errors->has('contact_number') ? ' is-invalid' : '' }}" name="contact_number" id="input-contact_number" type="text" placeholder="{{ __('Contact Number') }}" value="{{ old('contact_number') }}"  aria-required="true"/>
                    
                      @include('alerts.feedback', ['field' => 'contact_number'])
                    </div>
                  </div>
                </div>
                
                  <div class="row">
                   <label class="col-sm-2 col-form-label">{{ __('Address') }}</label>
                   <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('address') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" id="input-address" type="text" placeholder="{{ __('Address') }}" value="{{ old('address') }}"  aria-required="true"/>
                      @include('alerts.feedback', ['field' => 'address'])
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


