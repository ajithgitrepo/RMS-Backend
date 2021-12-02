 
<style>
#email-error {
    height: 30px;
    margin-left: 0px !important;
}
.form-file{
  min-height: 46px;
}
.fileinput-remove,
.fileinput-upload{
  display: none;
}

.btn.btn-rose {
  
    margin-top: 100px;
}
input.btn.btn-previous.btn-fill.btn-default.btn-wd {
    margin-top: 100px;
}

.file-caption.icon-visible .file-caption-name {
    padding-left: 30px !important;
}



</style>

@extends('layouts.app', ['activePage' => 'employee', 'menuParent' => 'Employee', 'titlePage' => __('Employees')])


@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
         <!--  <form method="post" id="documents_form" enctype="multipart/form-data" action="{{ route('documents.store') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">person</i>
                </div>
                <h4 class="card-title">{{ __('Add Documents') }}</h4>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('user.index') }}" class="btn btn-sm btn-rose">{{ __('Back to list') }}</a>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Passport photo') }}</label>
                  <div class="col-sm-7">
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail img-circle">
                        <img src="{{ asset('material') }}/img/placeholder.jpg" alt="...">
                      </div>
                      <div class="fileinput-preview fileinput-exists thumbnail img-circle"></div>
                      <div>
                        <span class="btn btn-rose btn-file">
                          <span class="fileinput-new">{{ __('Select image') }}</span>
                          <span class="fileinput-exists">{{ __('Change') }}</span>
                          <input type="file" name="passport_photo" id = "passport_photo" required data-parsley-required-message="Please select passport photo" />
                        </span>
                          <a href="#pablo" class="btn btn-danger fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> {{ __('Remove') }}</a>
                      </div>
                      @include('alerts.feedback', ['field' => 'passport_photo'])
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-password-confirmation">{{ __('Employee ID ') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <input class="form-control" name="employee_id" id="employee_id" type="input" placeholder="{{ __('Employee ID') }}"  value="{{ old('employee_id') }}" required data-parsley-required-message="Please enter employee id"/>
                      @include('alerts.feedback', ['field' => 'employee_id'])
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Passport copy') }}</label>
                  <div class="col-sm-7">
                    <div class="bmd-form-group form-file">
                 
                      <input class="form-control" type="file" id="passport_copy" name="passport_copy[]"  multiple required data-parsley-required-message="Please select passport copy">

                      @include('alerts.feedback', ['field' => 'passport_copy'])
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Visa copy') }}</label>
                  <div class="col-sm-7">
                    <div class="bmd-form-group form-file">
                 
                      <input class="form-control" type="file" id="visa_copy" name="visa_copy[]" required multiple data-parsley-required-message="Please select visa copy">

                      @include('alerts.feedback', ['field' => 'visa_copy'])
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('DL copy') }}</label>
                  <div class="col-sm-7">
                    <div class="bmd-form-group form-file">
                 
                      <input class="form-control" type="file" id="dl_copy" name="dl_copy[]" required multiple data-parsley-required-message="Please select DL copy">

                      @include('alerts.feedback', ['field' => 'dl_copy'])
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-password-confirmation">{{ __('DL Expiry') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <input class="form-control datepicker" name="dl_expiry" id="dl_expiry" type="input" placeholder="{{ __('DL Expiry') }}"  value="{{ old('dl_expiry') }}" required data-parsley-required-message="Please select DL expiry date"/>
                    </div>
                  </div>
                </div>

                 <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-password-confirmation">{{ __('Passport Expiry') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <input class="form-control datepicker" name="passport_expiry" id="passport_expiry" type="input" placeholder="{{ __('Passport Expiry') }}"  value="{{ old('passport_expiry') }}"data-parsley-required-message="Please select passport expiry date" required/>
                    </div>
                  </div>
                </div>

                 <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Higest Education Certificate') }}</label>
                  <div class="col-sm-7">
                    <div class="bmd-form-group form-file">
                 
                      <input class="form-control" type="file" id="edu_certificate" name="edu_certificate[]" multiple required data-parsley-required-message="Please select education certificate">

                      @include('alerts.feedback', ['field' => 'education_certificate'])
                    </div>
                  </div>
                </div>

                 <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Experience Certificate') }}</label>
                  <div class="col-sm-7">
                    <div class="bmd-form-group form-file">
                 
                      <input class="form-control" type="file" id="exp_certificate" name="exp_certificate[]" multiple required data-parsley-required-message="Please select experience copy">

                      @include('alerts.feedback', ['field' => 'exp_certificate'])
                    </div>
                  </div>
                </div>

              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-rose">{{ __('Add Document') }}</button>
              </div>
            </div>
          </form> -->


      <div class="wizard-container">
        <div class="card card-wizard" data-color="rose" id="wizardProfile">
           <form method="post" id="documents_form" enctype="multipart/form-data" action="{{ route('documents.update', $documents[0]->document_id ) }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('put')
            <div class="card-header text-center">
              <h3 class="card-title">
                Update Employee Documents
              </h3>
              <h5 class="card-description">This information will let us know more about employee.</h5>
               <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('employee.index') }}" class="btn btn-sm btn-rose">{{ __('Back to list') }}</a>
                  </div>
                </div> 
            </div>
            <div class="wizard-navigation">
              <ul class="nav nav-pills">
                <li class="nav-item">
                  <a class="nav-link active" href="#photo" data-toggle="tab" role="tab">
                    Photo
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#passport" data-toggle="tab" role="tab">
                    Passport
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#visa" data-toggle="tab" role="tab">
                    Visa
                  </a>
                </li>
                 <li class="nav-item">
                  <a class="nav-link" href="#dl" data-toggle="tab" role="tab">
                    DL
                  </a>
                </li>
                 <li class="nav-item">
                  <a class="nav-link " href="#education" data-toggle="tab" role="tab">
                    Education
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#emirates" data-toggle="tab" role="tab">
                  Emirates
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#labour" data-toggle="tab" role="tab">
                  labour card 
                  </a>
                </li>
                </li>
                 <li class="nav-item">
                  <a class="nav-link" href="#experience" data-toggle="tab" role="tab">
                    Experience
                  </a>
                </li>
                
              </ul>
            </div>
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane active" id="photo">
                  <h5 class="info-text"> Let's start with the basic information</h5>
                  <div class="row justify-content-center">

                   <!--  <div class="col-sm-4">
                      <div class="picture-container">
                        <div class="picture">
                          <img src="../../assets/img/default-avatar.png" class="picture-src" id="wizardPicturePreview" title="" />
                          <input type="file" id="wizard-picture">
                        </div>
                        <h6 class="description">Choose Picture</h6>
                      </div>
                    </div> -->
                  
                    
                    <div class="col-lg-10 mt-3">  
                      <div class="input-group form-control-lg">
                        <div class="form-group">
                          <label for="" class="bmd-label-floating">Employee ID</label>
                          <input class="form-control" name="employee_id" id="employee_id" type="input" value=" {{ request()->id,old('employee_id') }} " readonly />
                          @include('alerts.feedback', ['field' => 'employee_id'])
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-10 mt-3">
                      <div class="input-group form-control-lg">
                        <div class="form-group">
                          <label for="" class="bmd-label-floating">Passport Photo(required)</label>
                           <div class="file-loading">
                              <input id="passport_photo" name="passport_photo" type="file" required class="file" data-browse-on-zone-click="true" value="" data-overwrite-initial="false" data-min-file-count="2">
                          </div>
                          
                          @include('alerts.feedback', ['field' => 'passport_photo'])
                        </div>
                      </div>
                    </div>

                  <!-- 
                    <div class="col-lg-10">
                        <div class="form-group">
                         <label>Passport Photo (required)</label>
                          <div class="file-loading">
                              <input id="passport_photo" name="passport_photo" type="file" required multiple class="file" data-overwrite-initial="false" data-min-file-count="2">
                          </div>
                        </div>
                    </div> -->

                  </div>
                </div>

                 <div class="tab-pane" id="passport">
                  <div class="row justify-content-center">
                    <div class="col-sm-12">
                       <h5 class="info-text"> Let's start with the passport document</h5>
                    </div>

                    <div class="col-lg-10 mt-3">
                      <div class="input-group form-control-lg">
                        <div class="form-group">
                          <label for="" class="bmd-label-floating date-height">Passport Expiry (required)</label>
                          <input  class="form-control datepicker " name="passport_expiry" id="passport_expiry" type="input" value="{{ old('passport_expiry', date('d-m-Y',strtotime($documents[0]->passport_exp_date) ))}}" required data-parsley-required-message="Please select passport e xpiry date"/>
                          @include('alerts.feedback', ['field' => 'passport_expiry'])
                        </div>
                      </div>
                    </div>

                   
                     <div class="col-lg-10 mt-3">
                      <div class="input-group form-control-lg">
                        <div class="form-group">
                          <label for="" class="bmd-label-floating">Passport Copy (required)</label>
                           <div class="file-loading">
                              <input id="passport_copy" name="passport_copy[]" type="file" required class="file_multiple" data-browse-on-zone-click="true" data-overwrite-initial="false" multiple>
                          </div>
                          
                          @include('alerts.feedback', ['field' => 'passport_copy'])
                        </div>
                      </div>
                    </div>

                  </div>
                </div>

                <div class="tab-pane" id="visa">
                   <h5 class="info-text"> Let's start with the visa document</h5>
                  <div class="row justify-content-center">
                    
                      <div class="col-lg-10 mt-3">
                        <div class="input-group form-control-lg">
                          <div class="form-group">
                            <label for="" class="bmd-label-floating">Visa Copy (required)</label>
                             <div class="file-loading">
                                <input id="visa_copy" name="visa_copy[]" type="file" required class="file_multiple" data-browse-on-zone-click="true" data-overwrite-initial="false" multiple>
                            </div>
                            
                            @include('alerts.feedback', ['field' => 'visa_copy'])
                          </div>
                        </div>
                      </div>

                  </div>
                </div>

                <div class="tab-pane" id="dl">
                   <h5 class="info-text"> Let's start with the Driving License document</h5>
                  <div class="row justify-content-center">

                     <div class="col-lg-10 mt-3">
                      <div class="input-group form-control-lg">
                        <div class="form-group">
                          <label for="" class="bmd-label-floating date-height">Dl Expiry </label>
                          <input class="form-control datepicker " name="dl_expiry" id="dl_expiry" type="input" value="{{ old('dl_expiry') }}"  data-parsley-required-message="Please select DL expiry date"/>
                         <!-- @include('alerts.feedback', ['field' => 'dl_expiry'])-->
                        </div>
                      </div>
                    </div>
                    
                      <div class="col-lg-10 mt-3">
                        <div class="input-group form-control-lg">
                          <div class="form-group">
                            <label for="" class="bmd-label-floating">DL Copy </label>
                             <div class="file-loading">
                                <input id="dl_copy" name="dl_copy[]" type="file"  class="file_multiple" data-browse-on-zone-click="true" data-overwrite-initial="false" multiple>
                            </div>
                            
                            <!-- @include('alerts.feedback', ['field' => 'dl_copy']) -->
                          </div>
                        </div>
                      </div>

                  </div>
                </div>

                 <div class="tab-pane" id="education">
                   <h5 class="info-text"> Let's start with the education document</h5>
                  <div class="row justify-content-center">
                    
                      <div class="col-lg-10 mt-3">
                        <div class="input-group form-control-lg">
                          <div class="form-group">
                            <label for="" class="bmd-label-floating">Education Copy (required)</label>
                             <div class="file-loading">
                                <input id="edu_certificate" name="edu_certificate[]" type="file" required class="file_multiple" data-browse-on-zone-click="true" data-overwrite-initial="false" multiple>
                            </div>
                             @include('alerts.feedback', ['field' => 'edu_certificate'])
                          </div>
                        </div>
                      </div>
                  </div>
                </div>

                <div class="tab-pane" id="emirates">
                 <h5 class="info-text"> Let's start with the emirates document</h5>
                  <div class="row justify-content-center">
                    <div class="col-lg-10 mt-3">
                      <div class="input-group form-control-lg">  
                        <div class="form-group">
                          <label for="" class="bmd-label-floating date-height">Emirates ID (required)</label>
                          <input   class="form-control" name="emirate_id" id="emirate_id" type="input" value="{{old('emirate_id',$documents[0]->employees->emirates_id) }}" required data-parsley-required-message="Please enter emirates id"/>
                          @include('alerts.feedback', ['field' => 'emirate_id'])
                        </div>
                      </div>
                    </div>

                     <div class="col-lg-10 mt-3">
                        <div class="input-group form-control-lg">
                          <div class="form-group"> 
                            <label for="" class="bmd-label-floating">Emirates Copy (required)</label>
                             <div class="file-loading">
                                <input id="emi_certificate" name="emi_certificate[]" type="file" required class="file_multiple" data-browse-on-zone-click="true" data-overwrite-initial="false" multiple>
                            </div>
                            @include('alerts.feedback', ['field' => 'emi_certificate'])
                          </div>
                        </div>
                      </div>
                   </div>
                </div>

                <div class="tab-pane" id="labour">
                  <div class="row justify-content-center">
                    <div class="col-sm-12">
                       <h5 class="info-text"> Let's start with the labour card document</h5>
                    </div>

                    <div class="col-lg-10 mt-3">
                      <div class="input-group form-control-lg">
                        <div class="form-group">
                          <label for="" class="bmd-label-floating date-height">labour card  Expiry (required)</label>
                          <input class="form-control datepicker " name="lab_expiry" id="lab_expiry" type="input" value="{{ old('lab_expiry') }}" required data-parsley-required-message="Please select labour card expiry date"/>
                          @include('alerts.feedback', ['field' => 'lab_expiry'])
                        </div>
                      </div>
                    </div>

                   
                     <div class="col-lg-10 mt-3">
                      <div class="input-group form-control-lg">
                        <div class="form-group">
                          <label for="" class="bmd-label-floating">labour card  Copy (required)</label>
                           <div class="file-loading">
                              <input id="lab_certificate" name="lab_certificate[]" type="file" required class="file_multiple" data-browse-on-zone-click="true" data-overwrite-initial="false" multiple>
                          </div>
                          
                          @include('alerts.feedback', ['field' => 'lab_certificate'])
                        </div>
                      </div>
                    </div>

                  </div>
                </div>

                <div class="tab-pane" id="experience">
                   <h5 class="info-text"> Let's start with the experience certificate</h5>
                  <div class="row justify-content-center">
                    
                      <div class="col-lg-10 mt-3">
                        <div class="input-group form-control-lg">
                          <div class="form-group">
                            <label for="" class="bmd-label-floating">Experience certificate </label>
                             <div class="file-loading">
                                <input id="exp_certificate" name="exp_certificate[]" type="file"  class="file_multiple" data-browse-on-zone-click="true" data-overwrite-initial="false" multiple>
                            </div>
                            
                            <!-- @include('alerts.feedback', ['field' => 'exp_certificate']) -->
                          </div>
                        </div>
                      </div>

                  </div>
                </div>

              </div>
            </div>
            <div class="card-footer">
              <div class="mr-auto">
                <input type="button" class="btn btn-previous btn-fill btn-default btn-wd disabled" name="previous" value="Previous">
              </div>
              <div class="ml-auto">
                <input type="button" class="btn btn-next btn-fill btn-rose btn-wd" name="next" value="Next">
               <!--  <input type="button" class="btn btn-finish btn-fill btn-rose btn-wd" name="finish" value="Finish" style="display: none;">
 -->
                <button type="submit"  class="btn btn-finish btn-fill btn-rose btn-wd" name="finish" value="Finish">{{ __('Update Documents') }}</button>

              </div>
              <div class="clearfix"></div>
            </div>
          </form>
        </div>
      </div>
      <!-- wizard container -->

          <!--  <form>
                <input type="file" accept=".xlsx,.xls,image/*,.doc,audio/*,.docx,video/*,.ppt,.pptx,.txt,.pdf" multiple>
            </form> -->

        </div>
      </div>
    </div>
  </div>


@endsection


@push('js')


  <script>

     $("#passport_photo").change(function () {
        var fileExtension = ['jpeg', 'jpg', 'png', 'pdf'];
        //alert($(this).val());
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            alert("Only formats are allowed : "+fileExtension.join(', '));
            $("#passport_photo").val('');
            return false;
        }
    });

     $("#passport_copy").change(function () {
        var fileExtension = ['jpeg', 'jpg', 'png', 'pdf'];
        //alert($(this).val());
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            alert("Only formats are allowed : "+fileExtension.join(', '));
            $("#passport_copy").val('');
            return false;
        }
    });

     $("#emirate_copy").change(function () {
        var fileExtension = ['jpeg', 'jpg', 'png', 'pdf'];
        //alert($(this).val());
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            alert("Only formats are allowed : "+fileExtension.join(', '));
            $("#emirate_copy").val('');
            return false;
        }
    });

     $("#visa_copy").change(function () {
        var fileExtension = ['jpeg', 'jpg', 'png', 'pdf'];
        //alert($(this).val());
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            alert("Only formats are allowed : "+fileExtension.join(', '));
            $("#visa_copy").val('');
            return false;
        }
    });

     $("#dl_copy").change(function () {
        var fileExtension = ['jpeg', 'jpg', 'png', 'pdf'];
        //alert($(this).val());
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            alert("Only formats are allowed : "+fileExtension.join(', '));
            $("#dl_copy").val('');
            return false;
        }
    });

     $("#education_certificate").change(function () {
        var fileExtension = ['jpeg', 'jpg', 'png', 'pdf'];
        //alert($(this).val());
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            alert("Only formats are allowed : "+fileExtension.join(', '));
            $("#education_certificate").val('');
            return false;
        }
    });

     $("#exp_certificate").change(function () {
        var fileExtension = ['jpeg', 'jpg', 'png', 'pdf'];
        //alert($(this).val());
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            alert("Only formats are allowed : "+fileExtension.join(', '));
            $("#exp_certificate").val('');
            return false;
        }
    });



    $(document).ready(function () {
      // $('.datepicker').datetimepicker({
      //   useCurrent: false
      // });

      $(".datepicker").datetimepicker({
        format: 'DD-MM-YYYY',
        useCurrent: false
      });

    });

    $(document).ready(function() {
      // Initialise the wizard
      demo.initMaterialWizard();
      setTimeout(function() {
        $('.card.card-wizard').addClass('active');
      }, 600);
    });
  </script>
  

  <script>
    // $(document).ready(function() {
    //   md.initFormExtendedDatetimepickers();
    //    $('input[type="file"]').imageuploadify();
     
    // });

     

      $(".file_multiple").fileinput({
        theme: 'fa',
        uploadUrl: '#',
        allowedFileExtensions: ['jpeg', 'jpg', 'png','pdf'],
        overwriteInitial: false,
        maxFileSize:10000,
        maxFilesNum: 10,
        required:true,
        showCaption: true,
        showPreview: true,
        showRemove: true,
        showUpload: false,
        showCancel: true,
        showUploadedThumbs: true,
      });

      var querystring=window.location.href;
      var arr = querystring.split('/');
      var result = arr[3];
      //alert(a);

      if(result =="update_documents"){ 
       // alert();
          $("#passport_photo").fileinput({
            theme: 'fa',
            uploadUrl: '#',
            allowedFileExtensions: ['jpeg', 'jpg', 'png', 'pdf'],
            overwriteInitial: false,
            maxFileSize:10000,
            maxFilesNum: 10,
            required:true,    
            showCaption: true,
            showPreview: true,
            showRemove: true,
            showUpload: false,
            showCancel: true,
            showDrag: false,
            initialPreview: [
              "/passport_photo/admin.logo.jpg"
          ],
           initialPreviewAsData: true,
           initialPreviewFileType: 'image',

         });

      }

       if(result =="add_documents"){
       // alert();    
          $("#passport_photo").fileinput({
            theme: 'fa',
            uploadUrl: '#',
            allowedFileExtensions: ['jpeg', 'jpg', 'png', 'pdf'],
            overwriteInitial: false,
            maxFileSize:10000,
            maxFilesNum: 10,
            required:true,
            showCaption: true,
            showPreview: true,
            showRemove: true,
            showUpload: false,
            showCancel: true,
            showDrag: false,
          });
        }


  </script>
@endpush