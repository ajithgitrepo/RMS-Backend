@extends('layouts.app', ['activePage' => 'outlets', 'menuParent' => 'Outlets', 'titlePage' => __('Outlet')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('bulk_import_employee_csv') }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">

            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">add_task</i>
                </div>
                <h4 class="card-title">{{ __('Import Employees') }}</h4>
               </div>
              
              <div class="card-body">
              
                <div class="row">
                  <div class="col-md-12 text-right">
                   
                    <a href="{{ route('employee.index') }}" class="btn btn-sm btn-rose">{{ __('Back to employee details') }}</a>
                    
                  </div>
                </div>
                
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Excel / Csv') }}</label>
                  <div class="col-sm-7">
                   <input class="form-control{{ $errors->has('employee_import') ? ' is-invalid' : '' }}" type="file" name="employee_import"   >
                   <a  download href="{{URL::to('/')}}/dl_copy/Copy_of_Employee_Details.xlsx"  rel="tooltip"
                   data-original-title="Download" >Download Sample Format</a>
                      @include('alerts.feedback', ['field' => 'employee_import'])
                      
                    </div>
                  </div>
                </div> 
               
              
                <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-danger text-center">{{ __('Import') }}</button>
               </div>
              
              </div> 
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection


