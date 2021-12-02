@extends('layouts.app', ['activePage' => 'journey-plan', 'menuParent' => 'Journey-Plan', 'titlePage' => __('Customer Activity')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
      
        <div class="col-md-12">
          <div class="card ">
            <div class="card-header ">
              <h4 class="card-title">Competitor Info 
              </h4>
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


              <div class="row">
                <div class="col-lg-2 col-md-6">
                  <!--
                            color-classes: "nav-pills-primary", "nav-pills-info", "nav-pills-success", "nav-pills-warning","nav-pills-danger"
                        -->
                  <ul class="nav nav-pills nav-pills-rose nav-pills-icons flex-column" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" data-toggle="tab" href="#link110" role="tablist">
                        <i class="fa fa-tag fa-lg"></i> Promotion
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#link111" role="tablist">
                        <i class="material-icons">visibility</i> Visibility
                      </a>
                    </li>
                  </ul>
                </div>
                <div class="col-md-10">
                  <div class="tab-content">
                    <div class="tab-pane active" id="link110">
                      
          <form method="post" action="{{ route('competition.update', Request::segment(2) ) }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            @method('put')

          <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
              <!--   <div class="card-icon">
                  <i class="material-icons">P</i>
                </div> -->
                <h4 class="card-title">{{ __('Promotion') }}</h4>
              </div>
              
             <div class="card-body ">

                <!-- <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('competition.index') }}" class="btn btn-sm btn-rose">{{ __('Back to promotion') }}</a>
                   </div>
                 </div> -->
                
                 <div class="row">
                   <label class="col-sm-2 col-form-label">{{ __('Company Name') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('company_name') ? ' has-danger' : '' }}">
                     
                    <input class="form-control{{ $errors->has('company_name') ? ' is-invalid' : '' }}" name="company_name" id="input-company_name" type="text" placeholder="{{ __('') }}" value="{{ old('company_name',$competitor[0]->company_name)}}"  aria-required="true"/>
                    
                      @include('alerts.feedback', ['field' => 'company_name'])
                    </div>
                   </div>
                  </div>
                
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Brand Name') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('brand_name') ? ' has-danger' : '' }}">
                        
                     <input class="form-control{{ $errors->has('brand_name') ? ' is-invalid' : '' }}" name="brand_name" id="input-brand_name" type="text" placeholder="{{ __('') }}" value="{{ old('brand_name',$competitor[0]->brand_name)}}"  aria-required="true"/>

                    
                    </div>
                  </div>
                </div>

                <div class="row">
                   <label class="col-sm-2 col-form-label">{{ __('Category') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('category') ? ' has-danger' : '' }}">
                    
                    <select class="form-control selectpicker" data-style="select-with-transition"  title="Select Category" data-size="7" name="category_name" id="input-category_name" 
                     value="{{ old('category_name') }}" aria-required="true" >
                    <option value="" disabled>Select Category</option>

                   @foreach ($categories as $cat)

                        <option value="{{$cat->category_name}}" @if ($competitor[0]->category_name == $cat->category_name) {{ 'selected' }} @endif > {{ $cat->category_name }} </option>

                     @endforeach

                 </select>
                    
                      @include('alerts.feedback', ['field' => 'category'])
                    </div>
                   </div>
                </div>
                    
                        
                 <div class="row">
                   <label class="col-sm-2 col-form-label">{{ __('Item Name') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('item_name') ? ' has-danger' : '' }}">
                     
                    <input class="form-control{{ $errors->has('item_name') ? ' is-invalid' : '' }}" name="item_name" id="input-item_name" type="text" placeholder="{{ __('') }}" value="{{ old('item_name',$competitor[0]->item_name)}}"  aria-required="true"/>
                    
                      @include('alerts.feedback', ['field' => 'item_name'])
                    </div>
                   </div>
                  </div>
                
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Promotion Type') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('promotion_type') ? ' has-danger' : '' }}">
                    
             <input class="form-control{{ $errors->has('promotion_type') ? ' is-invalid' : '' }}" name="promotion_type" id="input-promotion_type" type="text" placeholder="{{ __('') }}" value="{{ old('promotion_type',$competitor[0]->promotion_type)}}"  aria-required="true"/>
                      
                      @include('alerts.feedback', ['field' => 'promotion_type'])
                    </div>
                  </div>
                </div>
                
                  <div class="row">
                   <label class="col-sm-2 col-form-label">{{ __('Promotion Description') }}</label>
                   <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('promotion_description') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('promotion_description') ? ' is-invalid' : '' }}" name="promotion_description"
                       id="input-promotion_description" type="text" placeholder="{{ __('') }}" value="{{ old('promotion_description',$competitor[0]->promotion_description)}}"  aria-required="true"/>
                      @include('alerts.feedback', ['field' => 'promotion_description'])
                    </div>
                  </div>
                </div>
                
                  <div class="row">
                    <label class="col-sm-2 col-form-label">{{ __('Regular Price') }}</label>
                   <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('mrp') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('mrp') ? ' is-invalid' : '' }}" name="mrp" id="input-mrp" type="text" placeholder="{{ __('') }}" value="{{ old('mrp',$competitor[0]->mrp) }}"  aria-required="true"/>
                      @include('alerts.feedback', ['field' => 'mrp'])
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Selling Price') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('selling_price') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('selling_price') ? ' is-invalid' : '' }}" name="selling_price" id="input-selling_price" type="text" placeholder="{{ __('') }}" value="{{ old('selling_price',$competitor[0]->selling_price) }}"  aria-required="true"/>
                      @include('alerts.feedback', ['field' => 'selling_price'])
                    </div>
                  </div>
                </div>
                
        
                
                 <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Capture Image') }}</label>
                  <div class="col-sm-7">
                  
                    <input class="form-control{{ $errors->has('capture_image') ? ' is-invalid' : '' }}" type="file" id="input-capture_image"
                       name="capture_image[]" accept="image/*"  value="{{ old('case_picture') }}"  multiple/>
                   
                      @include('alerts.feedback', ['field' => 'capture_image'])
                  
                   </div>
                  </div>
                  
              <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-rose">{{ __('update') }}</button>
              </div>


             </div>
            </div>
          </form>

                    </div>
                    <div class="tab-pane" id="link111">
                      <form method="post" action="{{ route('competitor_visibility', Request::segment(2) ) }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            @method('post')

          <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
              <!--   <div class="card-icon">
                  <i class="material-icons">P</i>
                </div> -->
                <h4 class="card-title">{{ __('Visibility') }}</h4>
              </div>
              
             <div class="card-body ">

                <!-- <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('competition.index') }}" class="btn btn-sm btn-rose">{{ __('Back to promotion') }}</a>
                   </div>
                 </div> -->
                
                 <div class="row">
                   <label class="col-sm-2 col-form-label">{{ __('Company Name') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('company_name') ? ' has-danger' : '' }}">
                     
                    <input class="form-control{{ $errors->has('company_name') ? ' is-invalid' : '' }}" name="company_name" id="input-company_name" type="text" placeholder="{{ __('') }}" value="{{ old('company_name',$competitor[0]->company_name)}}"  aria-required="true"/>
                    
                      @include('alerts.feedback', ['field' => 'company_name'])
                    </div>
                   </div>
                  </div>
                
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Brand Name') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('brand_name') ? ' has-danger' : '' }}">
                        
                     <input class="form-control{{ $errors->has('brand_name') ? ' is-invalid' : '' }}" name="brand_name" id="input-brand_name" type="text" placeholder="{{ __('') }}" value="{{ old('brand_name',$competitor[0]->brand_name)}}"  aria-required="true"/>

                    
                    </div>
                  </div>
                </div>
                    
                
                
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Visibility Type') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('visibility_type') ? ' has-danger' : '' }}">
                    
                     <input class="form-control{{ $errors->has('visibility_type') ? ' is-invalid' : '' }}" name="visibility_type" id="input-visibility_type" type="text" placeholder="{{ __('') }}" value="{{ old('visibility_type',$competitor[0]->visibility_type)}}"  aria-required="true"/>
                      
                      @include('alerts.feedback', ['field' => 'visibility_type'])
                    </div>
                  </div>
                </div>
                
               
                
                 <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Capture Image') }}</label>
                  <div class="col-sm-7">
                  
                    <input class="form-control{{ $errors->has('promotion_image') ? ' is-invalid' : '' }}" type="file" id="input-promotion_image"
                       name="promotion_image[]" accept="image/*" value="{{ old('promotion_image') }}"  multiple/>
                   
                      @include('alerts.feedback', ['field' => 'promotion_image'])
                  
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
            </div>
          </div>
        </div>

        </div>
      </div>
    </div>
  </div>
@endsection
