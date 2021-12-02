@extends('layouts.app', ['activePage' => 'working-days', 'menuParent' => 'Working-days', 'titlePage' => __('Working Days')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
      
          <form method="post" action="{{ route('working_days.update', $working[0]->id ) }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">Working Days</i>
                </div>
                <h4 class="card-title">{{ __('Edit Working Days') }}</h4>
              </div>
              
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('working_days.index') }}" class="btn btn-sm btn-rose">{{ __('Back to work') }}</a>
                  </div>
                </div>
                
                  <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Year') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('year') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('year') ? ' is-invalid' : '' }}" name="year" id="input-year" type="text" placeholder="{{ __('Year') }}" value="{{ old('year', $working[0]->year) }}"  aria-required="true"/>
                      @include('alerts.feedback', ['field' => 'year'])
                    </div>
                  </div>
                </div>
                
                 <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Month') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('month') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('month') ? ' is-invalid' : '' }}" name="month" id="input-month" type="text" placeholder="{{ __('Month') }}" value="{{ old('month',$working[0]->month) }}"  aria-required="true"/>
                      @include('alerts.feedback', ['field' => 'month'])
                    </div>
                  </div>
                </div>
                
                 <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Working_Days') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('working_days') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('working_days') ? ' is-invalid' : '' }}" name="working_days" id="input-working_days" type="text" placeholder="{{ __('Working_Days') }}" value="{{ old('working_days',$working[0]->working_days) }}"  aria-required="true"/>
                      @include('alerts.feedback', ['field' => 'working_days'])
                    </div>
                  </div>
                </div>
                
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-rose mx-auto">{{ __('update') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
