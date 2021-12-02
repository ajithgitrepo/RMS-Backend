
@extends('layouts.app', ['activePage' => 'outlets', 'menuParent' => 'Outlets', 'titlePage' => __('Outlets')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
      
          <form method="post" action="{{ route('outlet.update', $outlet[0]->outlet_id ) }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('put')

          <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">outlet</i>
                </div>
                <h4 class="card-title">{{ __('Edit Outlet') }}</h4>
              </div>
              
             <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('outlet.index') }}" class="btn btn-sm btn-rose">{{ __('Back to outlet') }}</a>
                   </div>
                 </div>
                
               
              

                 <div class="row"> 
                  <label class="col-sm-2 col-form-label">{{ __('Outlet Name') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('outlet_name') ? ' has-danger' : '' }}">
               
                        <select class="form-control selectpicker" data-style="select-with-transition" title="Select Store" data-size="7" name="outlet_name" id="input_days" 
                     value="{{ old('outlet_name') }}" aria-required="true" >
                     
                      <option value="" selected disabled>Select Store</option>
                       @foreach ($store as $str)
                     <option value="{{$str->id}}"  @if ($str->id == $outlet[0]->outlet_name) {{ 'selected' }} @endif > {{ $str->store_name }}</option>
                         @endforeach

                      </select>
                   
                      @include('alerts.feedback', ['field' => 'outlet_name'])
                    </div>
                  </div>
                </div>

               
                 <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Outlet Lat') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('outlet_lat') ? ' has-danger' : '' }}">
                     
                    <input class="form-control{{ $errors->has('outlet_lat') ? ' is-invalid' : '' }}" name="outlet_lat" id="input-outlet_lat" type="text" placeholder="{{ __('outlet_lat') }}" value="{{ old('outlet_lat',$outlet[0]->outlet_lat) }}"  aria-required="true"/>
                    
                      @include('alerts.feedback', ['field' => 'outlet_lat'])
                    </div>
                  </div>
                 </div>
                
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Outlet Long') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('outlet_long') ? ' has-danger' : '' }}">
                     
                    <input class="form-control{{ $errors->has('outlet_long') ? ' is-invalid' : '' }}" name="outlet_long" id="input-outlet_long" type="text" placeholder="{{ __('outlet_long') }}" value="{{ old('outlet_long',$outlet[0]->outlet_long) }}"  aria-required="true"/>
                    
                      @include('alerts.feedback', ['field' => 'outlet_long'])
                    </div>
                  </div>
                </div>
                
                  <div class="row">
                    <label class="col-sm-2 col-form-label">{{ __('Outlet Area') }}</label>
                   <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('outlet_area') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('outlet_area') ? ' is-invalid' : '' }}" name="outlet_area" id="input-outlet_area" type="text" placeholder="{{ __('outlet_area') }}" value="{{ old('outlet_area',$outlet[0]->outlet_area) }}"  aria-required="true"/>
                      @include('alerts.feedback', ['field' => 'outlet_area'])
                    </div>
                  </div>
                </div>
                
                  <div class="row">
                    <label class="col-sm-2 col-form-label">{{ __('Outlet City') }}</label>
                   <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('outlet_city') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('outlet_city') ? ' is-invalid' : '' }}" name="outlet_city" id="input-outlet_city" type="text" placeholder="{{ __('outlet_city') }}" value="{{ old('outlet_city',$outlet[0]->outlet_city) }}"  aria-required="true"/>
                      @include('alerts.feedback', ['field' => 'outlet_city'])
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Outlet Emirate') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('outlet_state') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('outlet_state') ? ' is-invalid' : '' }}" name="outlet_state" id="input-outlet_state" type="text" placeholder="{{ __('outlet_state') }}" value="{{ old('outlet_city',$outlet[0]->outlet_state) }}"  aria-required="true"/>
                      @include('alerts.feedback', ['field' => 'outlet_state'])
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Outlet Country') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('outlet_country') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('outlet_country') ? ' is-invalid' : '' }}" name="outlet_country" id="input-outlet_country" type="text" placeholder="{{ __('outlet_country') }}" value="{{ old('outlet_country',$outlet[0]->outlet_country) }}"  aria-required="true"/>
                      @include('alerts.feedback', ['field' => 'outlet_country'])
                    </div>
                  </div>
                </div>
                
              <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-rose">{{ __('update') }}</button>
              </div>
              
            </div>
           </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
