
@extends('layouts.app', ['activePage' => 'working-days', 'menuParent' => 'Working-days', 'titlePage' => __('Working Days')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('working_days.store') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">Working Days</i>
                </div>
                <h4 class="card-title">{{ __('Add Working Days') }}</h4>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('working_days.index') }}" class="btn btn-sm btn-rose">{{ __('Back to Page') }}</a>
                  </div>
                </div>
                
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Year') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('year') ? ' has-danger' : '' }}">
                    
                    <select class="form-control{{ $errors->has('year') ? ' is-invalid' : '' }}" name="year" id="input-year" 
                     value="{{ old('year') }}" aria-required="true">
                       <option value=" ">Select</option>
  			<option value="2021">2021</option>
  			<option value="2022">2022</option>
 			<option value="2023">2023</option>
  			<option value="2024">2024</option>
  			<option value="2025">2025</option>
  			<option value="2026">2026</option>
  			<option value="2027">2027</option>
  			<option value="2028">2028</option>
  			<option value="2029">2029</option>
  			<option value="2030">2030</option>

			</select>
                   
                      @include('alerts.feedback', ['field' => 'year'])
                    </div>
                  </div>
                </div>
                  
                  <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Month') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('month') ? ' has-danger' : '' }}">
                    
                    <select class="form-control{{ $errors->has('month') ? ' is-invalid' : '' }}" name="month" id="input-year" 
                     value="{{ old('month') }}" aria-required="true">
                       <option value=" ">Select</option>
  			<option value="Janaury">Janaury</option>
  			<option value="February">February</option>
 			<option value="March">March</option>
  			<option value="April">April</option>
  			<option value="May">May</option>
  			<option value="June">June</option>
  			<option value="July">July</option>
  			<option value="August">August</option>
  			<option value="September">September</option>
  			<option value="October">October</option>
  			<option value="November">November</option>
  			<option value="December">December</option>

			</select>
                   
                      @include('alerts.feedback', ['field' => 'year'])
                    </div>
                  </div>
                </div>
              
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Working_Days') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('working_days') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('working_days') ? ' is-invalid' : '' }}" name="working_days" id="input-working_days" type="text" placeholder="{{ __('Working_Days') }}" value="{{ old('working_days') }}"  aria-required="true"/>
                      @include('alerts.feedback', ['field' => 'working_days'])
                    </div>
                  </div>
                </div>
                
               
                
                <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-rose mx-auto">{{ __('Save') }}</button>
              </div>
              
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
