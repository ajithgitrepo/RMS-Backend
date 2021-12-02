
@extends('layouts.app', ['activePage' => 'Promotion', 'menuParent' => 'laravel', 'titlePage' => __('Competitor Info')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('competition.store') }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">add_task</i>
                </div>
                <h4 class="card-title">{{ __('Competitor Info') }}</h4>
               </div>
              
              <div class="card-body ">
              
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('competition.index') }}" class="btn btn-sm btn-rose">{{ __('Back to promotion') }}</a>
                  </div>
                </div>
              
                 <div class="row">
                   <label class="col-sm-2 col-form-label">{{ __('Company_Name') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('company_name') ? ' has-danger' : '' }}">
                     
                    <input class="form-control{{ $errors->has('company_name') ? ' is-invalid' : '' }}" name="company_name" id="input-company_name" type="text" placeholder="{{ __('') }}" value="{{ old('company_name') }}"  aria-required="true"/>
                    
                      @include('alerts.feedback', ['field' => 'company_name'])
                    </div>
                   </div>
                  </div>
                
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Brand_Name') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('brand_id') ? ' has-danger' : '' }}">
                    
                      <select class="form-control{{ $errors->has('brand_id') ? ' is-invalid' : '' }}" name="brand_id" id="input-brand_id" 
                        value="{{ old('brand_id') }}" >
                     
                       <option>Select</option>
                       @foreach ($brand as $bran)
                   	<option value="{{ $bran->id }}"> {{  $bran->brand_name  }}</option>
    			@endforeach
			</select>
			
  

			
                    </div>
                  </div>
                </div>
                
                 <div class="row">
                   <label class="col-sm-2 col-form-label">{{ __('Item_Name') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('item_name') ? ' has-danger' : '' }}">
                     
                    <input class="form-control{{ $errors->has('item_name') ? ' is-invalid' : '' }}" name="item_name" id="input-item_name" type="text" placeholder="{{ __('') }}" value="{{ old('item_name') }}"  aria-required="true"/>
                    
                      @include('alerts.feedback', ['field' => 'item_name'])
                    </div>
                   </div>
                  </div>
                
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Promotion_Type') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('promotion_type') ? ' has-danger' : '' }}">
                    
                       <select class="form-control{{ $errors->has('promotion_type') ? ' is-invalid' : '' }}" name="promotion_type" id="input-promotion_type" 
                     value="{{ old('promotion_type') }}" aria-required="true">
                      
                        		<option value=" ">Select</option>
                  			<option value="Very nice to use this product">Very nice to use this product</option>
                  			<option value="I like this product">I like this product</option>
                  		
                      </select>
                    
                 
                    </div>
                  </div>
                </div>
                
                  <div class="row">
                   <label class="col-sm-2 col-form-label">{{ __('Promotion_Description') }}</label>
                   <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('promotion_description') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('promotion_description') ? ' is-invalid' : '' }}" name="promotion_description"
                       id="input-promotion_description" type="text" placeholder="{{ __('') }}" value="{{ old('promotion_description') }}"  aria-required="true"/>
                      @include('alerts.feedback', ['field' => 'promotion_description'])
                    </div>
                  </div>
                </div>
                
                  <div class="row">
                    <label class="col-sm-2 col-form-label">{{ __('Regular Price') }}</label>
                   <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('mpr') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('mpr') ? ' is-invalid' : '' }}" name="mpr" id="input-mpr" type="text" placeholder="{{ __('') }}" value="{{ old('mpr') }}"  aria-required="true"/>
                      @include('alerts.feedback', ['field' => 'mpr'])
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Selling_Price') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('selling_price') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('selling_price') ? ' is-invalid' : '' }}" name="selling_price" id="input-selling_price" type="text" placeholder="{{ __('') }}" value="{{ old('selling_price') }}"  aria-required="true"/>
                      @include('alerts.feedback', ['field' => 'selling_price'])
                    </div>
                  </div>
                </div>
                
            
                
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Capture_Image') }}</label>
                  <div class="col-sm-7">
                   <input class="form-control{{ $errors->has('capture_image') ? ' is-invalid' : '' }}" type="file" name="capture_image[]" multiple/>
                  
                    </div>
                  </div>
                
                
                <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-rose text-center">{{ __('Save') }}</button>
               </div>
              
             
            </div>
          </form>
          
        </div>
      </div>
    </div>
  </div>
@endsection


