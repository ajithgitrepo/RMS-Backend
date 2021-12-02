
@extends('layouts.app', ['activePage' => 'outlets', 'menuParent' => 'Outlets', 'titlePage' => __('Outlets')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
      
          <form method="post" action="{{ route('outlet-products.update', $result[0]->id ) }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('put')

          <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">Outlet</i>
                </div>
                <h4 class="card-title">{{ __('Edit Outlet Brands') }}</h4>
              </div>
              
             <div class="card-body ">
               <!--  <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('outlet-products.index') }}" class="btn btn-sm btn-rose">{{ __('Back to outlet') }}</a>
                   </div>
                 </div> -->
                
               
              

                 <div class="row"> 
                  <label class="col-sm-2 col-form-label">{{ __('Outlet Name') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('outlet_name') ? ' has-danger' : '' }}">
               
                        <select class="form-control selectpicker" data-style="select-with-transition" title="Select Store" data-size="7" name="outlet_name" id="input_days" 
                     value="{{ old('outlet_name') }}" aria-required="true" >
                     
                      <option value="" disabled>Select Outlet</option>
                       @foreach ($outlets as $out)
                     <option value="{{$out->outlet_id}}"  @if ($out->outlet_id == $result[0]->outlet_id) {{ 'selected' }} @endif > {{ $out->store[0]->store_name }} </option>
                         @endforeach

                      </select>
                   
                      @include('alerts.feedback', ['field' => 'outlet_name'])
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Brands') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('brand') ? ' has-danger' : '' }}">
                    

                     <select class="form-control selectpicker" data-style="select-with-transition" title="Select Year" data-size="7" name="brand[]" id="input_days" 
                     value="{{ old('brand') }}" aria-required="true">
                     
                      <option value="" disabled>Select Product</option>
                       @foreach ($brands as $brand)
                      <option value="{{$brand->id}}"  @if ($brand->id == $result[0]->brand_id) {{ 'selected' }} @endif  > {{ $brand->brand_name }}</option>
                         @endforeach

                      </select>

                      @include('alerts.feedback', ['field' => 'brand'])
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Shelf (In Meters)') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('shelf') ? ' has-danger' : '' }}">
                    
                    <input type="number" name="shelf" value="{{ old('brand',$result[0]->shelf) }}" class="form-control " placeholder="Share Of Shelf " autocomplete="off" required>

                      @include('alerts.feedback', ['field' => 'shelf'])
                    </div>
                  </div>
                </div>

                 <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Target') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('target') ? ' has-danger' : '' }}">
                    
                    <input type="number" name="target" value="{{ old('brand',$result[0]->target) }}" class="form-control " placeholder="Share Of Shelf " autocomplete="off" required>

                      @include('alerts.feedback', ['field' => 'target'])
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
