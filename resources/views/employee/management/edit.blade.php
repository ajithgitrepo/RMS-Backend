<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css">
<style>
#email-error {
    height: 30px;
    margin-left: 0px !important;
}
</style>

@extends('layouts.app', ['activePage' => 'employee', 'menuParent' => 'Employee', 'titlePage' => __('Manage Employee')])

@section('content')

<div class="content">
  <div class="container-fluid">
    <div class="col-md-12 col-12 mr-auto ml-auto">
      <!--      Wizard container        -->
      <div class="wizard-container">
        <div class="card card-wizard" data-color="rose" id="wizardProfile">
           <form method="post" enctype="multipart/form-data" action="{{ route('employee.update', $employee[0]->employee_id) }}" autocomplete="off" 
           class="form-horizontal">
            @csrf
            @method('put')
            <!--        You can switch " data-color="primary" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->
            <div class="card-header text-center">
              <h3 class="card-title">
                Update Employee Profile
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
                  <a class="nav-link active" href="#about" data-toggle="tab" role="tab">
                    About
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#designation" data-toggle="tab" role="tab">
                    Designation
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#visa" data-toggle="tab" role="tab">
                    Visa / Passport
                  </a>
                </li>
                
              </ul>
            </div>
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane active" id="about">
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
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="material-icons">account_circle</i>
                          </span>
                        </div>
                        <div class="form-group">
                          <label for="" class="bmd-label-floating">Employee ID (required)</label>
                   <input type="text" class="form-control" id="" name="employee_id" value="{{ old('employee_id',$employee[0]->employee_id) }}" required readonly>
                           @include('alerts.feedback', ['field' => 'employee_id'])
                        </div>
                      </div>
                    </div>

                   <div class="col-lg-10 mt-3">
                      <div class="input-group form-control-lg">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="material-icons">face</i>
                          </span>
                        </div>
                        <div class="form-group">
                          <label for="" class="bmd-label-floating">First Name (required)</label>
             <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name',$employee[0]->first_name) }}" required>
                           @include('alerts.feedback', ['field' => 'first_name'])
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-10 mt-3">
                      <div class="input-group form-control-lg">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="material-icons">face</i>
                          </span>
                        </div>
                        <div class="form-group">
                          <label for="" class="bmd-label-floating">Middle Name </label>
                          <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{ old('middle_name',$employee[0]->middle_name) }}" >
                          
                        </div>
                      </div>
                    </div>

                    

                    <div class="col-lg-10 mt-3">
                      <div class="input-group form-control-lg">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="material-icons">face</i>
                          </span>
                        </div>
                        <div class="form-group">
                          <label for="" class="bmd-label-floating">Surname (required)</label>
                          <input type="text" class="form-control" id="surname" name="surname" value="{{ old('surname',$employee[0]->surname) }}" required>
                          @include('alerts.feedback', ['field' => 'surname'])
                           
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-10 mt-3">
                      <div class="input-group form-control-sm">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="material-icons">flag</i>
                          </span>
                        </div>
                        <div class="form-group">
                          <label for="" class="bmd-label-floating">Nationality (required)</label>
                         
                         <select class="form-control" id="nationality" name="nationality" value="{{ old('nationality') }}">
    <option value="Afghanistan"  @if ($employee[0]->nationality == "Afghanistan") {{ 'selected' }} @endif>Afghanistan</option>
   
    <option value="Albania" @if ($employee[0]->nationality == "Albania") {{ 'selected' }} @endif>Albania</option>
    <option value="Algeria" @if ($employee[0]->nationality == "Algeria") {{ 'selected' }} @endif>Algeria</option>
    <option value="American Samoa"  @if ($employee[0]->nationality == "American Samoa") {{ 'selected' }} @endif>American Samoa</option>
    <option value="Andorra" @if ($employee[0]->nationality == "Andorra") {{ 'selected' }} @endif>Andorra</option>
    <option value="Angola" @if ($employee[0]->nationality == "Angola") {{ 'selected' }} @endif>Angola</option>
    <option value="Anguilla" @if ($employee[0]->nationality == "Anguilla") {{ 'selected' }} @endif>Anguilla</option>
    <option value="Antigua and Barbuda" @if ($employee[0]->nationality == "Antigua and Barbuda") {{ 'selected' }} @endif>Antigua and Barbuda</option>
    <option value="Argentina" @if ($employee[0]->nationality == "Argentina") {{ 'selected' }} @endif>Argentina</option>
    <option value="Armenia" @if ($employee[0]->nationality == "Armenia") {{ 'selected' }} @endif">Armenia</option>
    <option value="Aruba"@if ($employee[0]->nationality == "Aruba") {{ 'selected' }} @endif>Aruba</option>
    <option value="Australia" @if ($employee[0]->nationality == "Australia") {{ 'selected' }} @endif>Australia</option>
    <option value="Austria" @if ($employee[0]->nationality == "Austria") {{ 'selected' }} @endif>Austria</option>
    <option value="Azerbaijan" @if ($employee[0]->nationality == "Azerbaijan") {{ 'selected' }} @endif>Azerbaijan</option>
    <option value="Bahamas" @if ($employee[0]->nationality == "Bahamas") {{ 'selected' }} @endif>Bahamas</option>
    <option value="Bahrain"@if ($employee[0]->nationality == "Bahrain") {{ 'selected' }} @endif>Bahrain</option>
    <option value="Bangladesh" @if ($employee[0]->nationality == "Bangladesh") {{ 'selected' }} @endif>Bangladesh</option>
    <option value="Barbados" @if ($employee[0]->nationality == "Barbados") {{ 'selected' }} @endif>Barbados</option>
    <option value="Belarus" @if ($employee[0]->nationality == "Belarus") {{ 'selected' }} @endif>Belarus</option>
    <option value="Belgium" @if ($employee[0]->nationality == "Belgium") {{ 'selected' }} @endif>Belgium</option>
    <option value="Belize" @if ($employee[0]->nationality == "Belize") {{ 'selected' }} @endif>Belize</option>
    <option value="Benin" @if ($employee[0]->nationality == "Bangladesh") {{ 'selected' }} @endif>Benin</option>
    <option value="Bermuda" @if ($employee[0]->nationality == "Bermuda") {{ 'selected' }} @endif>Bermuda</option>
    <option value="Bhutan" @if ($employee[0]->nationality == "Bhutan") {{ 'selected' }} @endif>Bhutan</option>
    <option value="Bolivia" @if ($employee[0]->nationality == "Bolivia") {{ 'selected' }} @endif>Bolivia</option>
    <option value="Bonaire, Sint Eustatius and Saba" @if ($employee[0]->nationality == "Bonaire, Sint Eustatius and Saba") {{ 'selected' }} @endif>
    Bonaire, Sint Eustatius and Saba</option>
    <option value="Bosnia and Herzegovina" @if ($employee[0]->nationality == "Bosnia and Herzegovina") {{ 'selected' }} @endif>Bosnia and Herzegovina</option>
    <option value="Botswana" @if ($employee[0]->nationality == "Botswana") {{ 'selected' }} @endif>Botswana</option>
    <option value="Brazil" @if ($employee[0]->nationality == "Brazil") {{ 'selected' }} @endif>Brazil</option>
    <option value="British Indian Ocean Territory" @if ($employee[0]->nationality == "British Indian Ocean Territory") {{ 'selected' }} @endif>
    British Indian Ocean Territory</option>
    <option value="Brunei Darussalam" @if ($employee[0]->nationality == "Brunei Darussalam") {{ 'selected' }} @endif>Brunei Darussalam</option>
    <option value="Bulgaria"@if ($employee[0]->nationality == "Bulgaria") {{ 'selected' }} @endif>Bulgaria</option>
    <option value="Burkina Faso" @if ($employee[0]->nationality == "Burkina Faso") {{ 'selected' }} @endif>Burkina Faso</option>
    <option value="Burundi" @if ($employee[0]->nationality == "Burundi") {{ 'selected' }} @endif>Burundi</option>
    <option value="Cabo Verde" @if ($employee[0]->nationality == "Cabo Verde") {{ 'selected' }} @endif>Cabo Verde</option>
    <option value="Cambodia" @if ($employee[0]->nationality == "Cambodia") {{ 'selected' }} @endif>Cambodia</option>
    <option value="Cameroon" @if ($employee[0]->nationality == "Cameroon") {{ 'selected' }} @endif>Cameroon</option>
    <option value="Canada" @if ($employee[0]->nationality == "Canada") {{ 'selected' }} @endif>Canada</option>
    <option value="Cayman Islands" @if ($employee[0]->nationality == "Cayman Islands") {{ 'selected' }} @endif>Cayman Islands</option>
    <option value="Central African Republic" @if ($employee[0]->nationality == "Central African Republic") {{ 'selected' }} @endif>Central African Republic
    </option>
    <option value="Chad" @if ($employee[0]->nationality == "Chad") {{ 'selected' }} @endif>Chad</option>
    <option value="Chile" @if ($employee[0]->nationality == "Chile") {{ 'selected' }} @endif>Chile</option>
    <option value="China" @if ($employee[0]->nationality == "China") {{ 'selected' }} @endif">China</option>
    <option value="Christmas Island" @if ($employee[0]->nationality == "Christmas Island") {{ 'selected' }} @endif">Christmas Island</option>
    <option value="Cocos (Keeling) Islands"@if ($employee[0]->nationality == "Cocos (Keeling) Islands") {{ 'selected' }} @endif">Cocos (Keeling) Islands</option>
    <option value="Colombia" @if ($employee[0]->nationality == "Colombia") {{ 'selected' }} @endif">Colombia</option>
    <option value="Comoros" @if ($employee[0]->nationality == "Comoros") {{ 'selected' }} @endif">Comoros</option>
    <option value="Cook Islands" @if ($employee[0]->nationality == "Cook Islands") {{ 'selected' }} @endif">Cook Islands</option>
    <option value="Costa Rica" @if ($employee[0]->nationality == "Costa Rica") {{ 'selected' }} @endif">Costa Rica</option>
    <option value="Croatia" @if ($employee[0]->nationality == "Croatia") {{ 'selected' }} @endif">Croatia</option>
    <option value="Cuba" @if ($employee[0]->nationality == "Cuba") {{ 'selected' }} @endif">Cuba</option>
    <option value="Curaçao" @if ($employee[0]->nationality == "Curaçao") {{ 'selected' }} @endif">Curaçao</option>
    <option value="Cyprus" @if ($employee[0]->nationality == "Cyprus") {{ 'selected' }} @endif">Cyprus</option>
    <option value="Czech Republic" @if ($employee[0]->nationality == "Czech Republic") {{ 'selected' }} @endif">Czech Republic</option>
    <option value="Côte d'Ivoire" @if ($employee[0]->nationality == "Côte d'Ivoire") {{ 'selected' }} @endif">Côte d'Ivoire</option>
    <option value="Democratic Republic of the Congo" @if ($employee[0]->nationality == "Democratic Republic of the Congo") {{ 'selected' }} @endif">
    Democratic Republic of the Congo</option>
    <option value="Denmark" @if ($employee[0]->nationality == "Denmark") {{ 'selected' }} @endif">Denmark</option>
    <option value="Djibouti" @if ($employee[0]->nationality == "Djibouti") {{ 'selected' }} @endif">Djibouti</option>
    <option value="Dominica" @if ($employee[0]->nationality == "Dominica") {{ 'selected' }} @endif">Dominica</option>
    <option value="Dominican Republic" @if ($employee[0]->nationality == "Dominican Republic<") {{ 'selected' }} @endif">Dominican Republic</option>
    <option value="Ecuador" @if ($employee[0]->nationality == "Ecuador") {{ 'selected' }} @endif">Ecuador</option>
    <option value="Egypt"@if ($employee[0]->nationality == "Egypt") {{ 'selected' }} @endif">Egypt</option>
    <option value="El Salvador" @if ($employee[0]->nationality == "El Salvador") {{ 'selected' }} @endif">El Salvador</option>
    <option value="Equatorial Guinea" @if ($employee[0]->nationality == "Equatorial Guinea") {{ 'selected' }} @endif">Equatorial Guinea</option>
    <option value="Eritrea" @if ($employee[0]->nationality == "Eritrea") {{ 'selected' }} @endif">Eritrea</option>
    <option value="Estonia" @if ($employee[0]->nationality == "Estonia") {{ 'selected' }} @endif">Estonia</option>
    <option value="Ethiopia" @if ($employee[0]->nationality == "Ethiopia") {{ 'selected' }} @endif">Ethiopia</option>
    <option value="Falkland Islands" @if ($employee[0]->nationality == "Falkland Islands") {{ 'selected' }} @endif">Falkland Islands</option>
    <option value="Faroe Islands" @if ($employee[0]->nationality == "Faroe Islands") {{ 'selected' }} @endif">Faroe Islands</option>
    <option value="Federated States of Micronesia" @if ($employee[0]->nationality == "Federated States of Micronesia") {{ 'selected' }} @endif">Federated States of Micronesia</option>
    <option value="Fiji" @if ($employee[0]->nationality == "Fiji") {{ 'selected' }} @endif">Fiji</option>
    <option value="Finland" @if ($employee[0]->nationality == "Finland") {{ 'selected' }} @endif">Finland</option>
    <option value="Former Yugoslav Republic of Macedonia" @if ($employee[0]->nationality == "Former Yugoslav Republic of Macedonia") {{ 'selected' }} @endif">Former Yugoslav Republic of Macedonia</option>
    <option value="France" @if ($employee[0]->nationality == "France") {{ 'selected' }} @endif">France</option>
    <option value="French Guiana" @if ($employee[0]->nationality == "French Guiana") {{ 'selected' }} @endif">French Guiana</option>
    <option value="French Polynesia" @if ($employee[0]->nationality == "French Polynesia") {{ 'selected' }} @endif">French Polynesia</option>
    <option value="French Southern Territories" @if ($employee[0]->nationality == "French Southern Territories") {{ 'selected' }} @endif">French Southern Territories</option>
    <option value="Gabon" @if ($employee[0]->nationality == "Gabon") {{ 'selected' }} @endif">Gabon</option>
    <option value="Gambia" @if ($employee[0]->nationality == "Gambia") {{ 'selected' }} @endif">Gambia</option>
    <option value="Georgia" @if ($employee[0]->nationality == "Georgia") {{ 'selected' }} @endif">Georgia</option>
    <option value="Germany"@if ($employee[0]->nationality == "Germany") {{ 'selected' }} @endif">Germany</option>
    <option value="Ghana" @if ($employee[0]->nationality == "Ghana") {{ 'selected' }} @endif">Ghana</option>
    <option value="Gibraltar" @if ($employee[0]->nationality == "Gibraltar") {{ 'selected' }} @endif">Gibraltar</option>
    <option value="Greece" @if ($employee[0]->nationality == "Greece") {{ 'selected' }} @endif">Greece</option>
    <option value="Greenland" @if ($employee[0]->nationality == "Greenland") {{ 'selected' }} @endif">Greenland</option>
    <option value="Grenada"@if ($employee[0]->nationality == "Grenada") {{ 'selected' }} @endif">Grenada</option>
    <option value="Guadeloupe" @if ($employee[0]->nationality == "Guadeloupe") {{ 'selected' }} @endif">Guadeloupe</option>
    <option value="Guam" @if ($employee[0]->nationality == "Guam") {{ 'selected' }} @endif">Guam</option>
    <option value="Guatemala"@if ($employee[0]->nationality == "Guatemala") {{ 'selected' }} @endif">Guatemala</option>
    <option value="Guernsey" @if ($employee[0]->nationality == "Guernsey") {{ 'selected' }} @endif">Guernsey</option>
    <option value="Guinea" @if ($employee[0]->nationality == "Guinea") {{ 'selected' }} @endif">Guinea</option>
    <option value="Guinea-Bissau" @if ($employee[0]->nationality == "Guinea-Bissau") {{ 'selected' }} @endif">Guinea-Bissau</option>
    <option value="Guyana" @if ($employee[0]->nationality == "Guyana") {{ 'selected' }} @endif">Guyana</option>
    <option value="Haiti"@if ($employee[0]->nationality == "Haiti") {{ 'selected' }} @endif">Haiti</option>
    <option value="Holy See" @if ($employee[0]->nationality == "Holy See") {{ 'selected' }} @endif">Holy See</option>
    <option value="Honduras" @if ($employee[0]->nationality == "Honduras") {{ 'selected' }} @endif">Honduras</option>
    <option value="Hong Kong" @if ($employee[0]->nationality == "Hong Kong") {{ 'selected' }} @endif">Hong Kong</option>
    <option value="Hungary" @if ($employee[0]->nationality == "Hungary") {{ 'selected' }} @endif">Hungary</option>
    <option value="Iceland" @if ($employee[0]->nationality == "Holy See") {{ 'selected' }} @endif">Iceland</option>
    <option value="India" @if ($employee[0]->nationality == "India") {{ 'selected' }} @endif>India</option>
    <option value="Indonesia" @if ($employee[0]->nationality == "Indonesia") {{ 'selected' }} @endif">Indonesia</option>
    <option value="Iran" @if ($employee[0]->nationality == "Iran") {{ 'selected' }} @endif">Iran</option>
    <option value="Iraq" @if ($employee[0]->nationality == "Iraq") {{ 'selected' }} @endif">Iraq</option>
    <option value="Ireland" @if ($employee[0]->nationality == "Ireland") {{ 'selected' }} @endif">Ireland</option>
    <option value="Isle of Man" @if ($employee[0]->nationality == "Isle of Man") {{ 'selected' }} @endif">Isle of Man</option>
    <option value="Israel" @if ($employee[0]->nationality == "Israel") {{ 'selected' }} @endif">Israel</option>
    <option value="Italy" @if ($employee[0]->nationality == "Italy") {{ 'selected' }} @endif>Italy</option>
    <option value="Jamaica" @if ($employee[0]->nationality == "Jamaica") {{ 'selected' }} @endif">Jamaica</option>
    <option value="Japan" @if ($employee[0]->nationality == "Japan") {{ 'selected' }} @endif">Japan</option>
    <option value="Jersey" @if ($employee[0]->nationality == "Jersey") {{ 'selected' }} @endif">Jersey</option>
    <option value="Jordan" @if ($employee[0]->nationality == "Jordan") {{ 'selected' }} @endif">Jordan</option>
    <option value="Kazakhstan" @if ($employee[0]->nationality == "Kazakhstan") {{ 'selected' }} @endif">Kazakhstan</option>
    <option value="Kenya" @if ($employee[0]->nationality == "Kenya") {{ 'selected' }} @endif">Kenya</option>
    <option value="Kiribati" @if ($employee[0]->nationality == "Kiribati") {{ 'selected' }} @endif">Kiribati</option>
    <option value="Kuwait" @if ($employee[0]->nationality == "Kuwait") {{ 'selected' }} @endif">Kuwait</option>
    <option value="Kyrgyzstan" @if ($employee[0]->nationality == "Kyrgyzstan") {{ 'selected' }} @endif">Kyrgyzstan</option>
    <option value="Laos" @if ($employee[0]->nationality == "Laos") {{ 'selected' }} @endif">Laos</option>
    <option value="Latvia" @if ($employee[0]->nationality == "Latvia") {{ 'selected' }} @endif">Latvia</option>
    <option value="Lebanon" @if ($employee[0]->nationality == "Lebanon") {{ 'selected' }} @endif">Lebanon</option>
    <option value="Lesotho" @if ($employee[0]->nationality == "Lesotho") {{ 'selected' }} @endif">Lesotho</option>
    <option value="Liberia" @if ($employee[0]->nationality == "Liberia") {{ 'selected' }} @endif">Liberia</option>
    <option value="Libya" @if ($employee[0]->nationality == "Libya") {{ 'selected' }} @endif">Libya</option>
    <option value="Liechtenstein" @if ($employee[0]->nationality == "Liechtenstein") {{ 'selected' }} @endif">Liechtenstein</option>
    <option value="Lithuania" @if ($employee[0]->nationality == "Lithuania") {{ 'selected' }} @endif">Lithuania</option>
    <option value="Luxembourg" @if ($employee[0]->nationality == "Luxembourg") {{ 'selected' }} @endif">Luxembourg</option>
    <option value="Macau" @if ($employee[0]->nationality == "Macau") {{ 'selected' }} @endif">Macau</option>
    <option value="Madagascar" @if ($employee[0]->nationality == "Madagascar") {{ 'selected' }} @endif">Madagascar</option>
    <option value="Malawi" @if ($employee[0]->nationality == "Malawi") {{ 'selected' }} @endif">Malawi</option>
    <option value="Malaysia" @if ($employee[0]->nationality == "Malaysia") {{ 'selected' }} @endif">Malaysia</option>
    <option value="Maldives" @if ($employee[0]->nationality == "Maldives") {{ 'selected' }} @endif">Maldives</option>
    <option value="Mali" @if ($employee[0]->nationality == "Mali") {{ 'selected' }} @endif">Mali</option>
    <option value="Malta" @if ($employee[0]->nationality == "Malta") {{ 'selected' }} @endif">Malta</option>
    <option value="Marshall Islands" @if ($employee[0]->nationality == "Marshall Islands") {{ 'selected' }} @endif">Marshall Islands</option>
    <option value="Martinique" @if ($employee[0]->nationality == "Martinique") {{ 'selected' }} @endif">Martinique</option>
    <option value="Mauritania" @if ($employee[0]->nationality == "Mauritania") {{ 'selected' }} @endif">Mauritania</option>
    <option value="Mauritius" @if ($employee[0]->nationality == "Mauritius") {{ 'selected' }} @endif">Mauritius</option>
    <option value="Mayotte" @if ($employee[0]->nationality == "Mayotte") {{ 'selected' }} @endif">Mayotte</option>
    <option value="Mexico" @if ($employee[0]->nationality == "Mexico") {{ 'selected' }} @endif">Mexico</option>
    <option value="Moldova" @if ($employee[0]->nationality == "Moldova") {{ 'selected' }} @endif">Moldova</option>
    <option value="Monaco" @if ($employee[0]->nationality == "Monaco") {{ 'selected' }} @endif">Monaco</option>
    <option value="Mongolia" @if ($employee[0]->nationality == "Mongolia") {{ 'selected' }} @endif">Mongolia</option>
    <option value="Montenegro" @if ($employee[0]->nationality == "Montenegro") {{ 'selected' }} @endif">Montenegro</option>
    <option value="Montserrat" @if ($employee[0]->nationality == "Montserrat") {{ 'selected' }} @endif">Montserrat</option>
    <option value="Morocco" @if ($employee[0]->nationality == "Morocco") {{ 'selected' }} @endif">Morocco</option>
    <option value="Mozambique" @if ($employee[0]->nationality == "Mozambique") {{ 'selected' }} @endif">Mozambique</option>
    <option value="Myanmar" @if ($employee[0]->nationality == "Myanmar") {{ 'selected' }} @endif">Myanmar</option>
    <option value="Namibia" @if ($employee[0]->nationality == "Namibia") {{ 'selected' }} @endif">Namibia</option>
    <option value="Nauru" @if ($employee[0]->nationality == "Nauru") {{ 'selected' }} @endif">Nauru</option>
    <option value="Nepal" @if ($employee[0]->nationality == "Nepal") {{ 'selected' }} @endif">Nepal</option>
    <option value="Netherlands" @if ($employee[0]->nationality == "Netherlands") {{ 'selected' }} @endif">Netherlands</option>
    <option value="New Caledonia" @if ($employee[0]->nationality == "New Caledonia") {{ 'selected' }} @endif">New Caledonia</option>
    <option value="New Zealand" @if ($employee[0]->nationality == "New Zealand") {{ 'selected' }} @endif">New Zealand</option>
    <option value="Nicaragua" @if ($employee[0]->nationality == "Nicaragua") {{ 'selected' }} @endif">Nicaragua</option>
    <option value="Niger" @if ($employee[0]->nationality == "Niger") {{ 'selected' }} @endif">Niger</option>
    <option value="Nigeria" @if ($employee[0]->nationality == "Nigeria") {{ 'selected' }} @endif">Nigeria</option>
    <option value="Niue" @if ($employee[0]->nationality == "Niue") {{ 'selected' }} @endif">Niue</option>
    <option value="Norfolk Island" @if ($employee[0]->nationality == "Niue") {{ 'selected' }} @endif">Norfolk Island</option>
    <option value="North Korea" @if ($employee[0]->nationality == "Niue") {{ 'selected' }} @endif">North Korea</option>
    <option value="Northern Mariana Islands" @if ($employee[0]->nationality == "Niue") {{ 'selected' }} @endif">Northern Mariana Islands</option>
    <option value="Norway" @if ($employee[0]->nationality == "Norway") {{ 'selected' }} @endif">Norway</option>
    <option value="Oman" @if ($employee[0]->nationality == "Oman") {{ 'selected' }} @endif">Oman</option>
    <option value="Pakistan" @if ($employee[0]->nationality == "Pakistan") {{ 'selected' }} @endif">Pakistan</option>
    <option value="Palau" @if ($employee[0]->nationality == "Palau") {{ 'selected' }} @endif">Palau</option>
    <option value="Panama" @if ($employee[0]->nationality == "Panama") {{ 'selected' }} @endif">Panama</option>
    <option value="Papua New Guinea" @if ($employee[0]->nationality == "Papua New Guinea") {{ 'selected' }} @endif">Papua New Guinea</option>
    <option value="Paraguay"@if ($employee[0]->nationality == "Paraguay") {{ 'selected' }} @endif">Paraguay</option>
    <option value="Peru" @if ($employee[0]->nationality == "Peru") {{ 'selected' }} @endif">Peru</option>
    <option value="Philippines" @if ($employee[0]->nationality == "Philippines") {{ 'selected' }} @endif">Philippines</option>
    <option value="Pitcairn" @if ($employee[0]->nationality == "Pitcairn") {{ 'selected' }} @endif">Pitcairn</option>
    <option value="Poland" @if ($employee[0]->nationality == "Poland") {{ 'selected' }} @endif">Poland</option>
    <option value="Portugal" @if ($employee[0]->nationality == "Portugal") {{ 'selected' }} @endif">Portugal</option>
    <option value="Puerto Rico" @if ($employee[0]->nationality == "Puerto Rico") {{ 'selected' }} @endif">Puerto Rico</option>
    <option value="Qatar" @if ($employee[0]->nationality == "Qatar") {{ 'selected' }} @endif">Qatar</option>
    <option value="Republic of the Congo"  @if ($employee[0]->nationality == "Republic of the Congo") {{ 'selected' }} @endif>Republic of the Congo</option>
    <option value="Romania"  @if ($employee[0]->nationality == "Romania") {{ 'selected' }} @endif>Romania</option>
    <option value="Russia"  @if ($employee[0]->nationality == "Russia") {{ 'selected' }} @endif>Russia</option>
    <option value="Rwanda"  @if ($employee[0]->nationality == "Rwanda") {{ 'selected' }} @endif>Rwanda</option>
    <option value="Réunion"  @if ($employee[0]->nationality == "Réunion") {{ 'selected' }} @endif>Réunion</option>
    <option value="Saint Barthélemy"  @if ($employee[0]->nationality == "Saint Barthélemy") {{ 'selected' }} @endif>Saint Barthélemy</option>
    <option value="Saint Helena, Ascension and Tristan da Cunha" @if ($employee[0]->nationality == "Saint Helena, Ascension and Tristan da Cunha")
     {{ 'selected' }} @endif>Saint Helena, Ascension and Tristan da Cunha</option>
    <option value="Saint Kitts and Nevis" @if ($employee[0]->nationality == "Saint Kitts and Nevis") {{ 'selected' }} @endif>Saint Kitts and Nevis</option>
    <option value="Saint Lucia" @if ($employee[0]->nationality == "Saint Lucia") {{ 'selected' }} @endif>Saint Lucia</option>
    <option value="Saint Martin" @if ($employee[0]->nationality == "Saint Martin") {{ 'selected' }} @endif>Saint Martin</option>
    <option value="Saint Pierre and Miquelon" @if ($employee[0]->nationality == "Saint Pierre and Miquelon") {{ 'selected' }} @endif>Saint Pierre and Miquelon
    </option>
    <option value="Saint Vincent and the Grenadines" @if ($employee[0]->nationality == "Saint Vincent and the Grenadines") {{ 'selected' }} @endif>
    Saint Vincent and the Grenadines</option>
    <option value="Samoa" @if ($employee[0]->nationality == "Samoa") {{ 'selected' }} @endif>Samoa</option>
    <option value="San Marino" @if ($employee[0]->nationality == "San Marino") {{ 'selected' }} @endif>San Marino</option>
    <option value="Sao Tome and Principe" @if ($employee[0]->nationality == "Sao Tome and Principe") {{ 'selected' }} @endif>Sao Tome and Principe</option>
    <option value="Saudi Arabia" @if ($employee[0]->nationality == "Saudi Arabia") {{ 'selected' }} @endif>Saudi Arabia</option>
    <option value="Senegal" @if ($employee[0]->nationality == "Senegal") {{ 'selected' }} @endif>Senegal</option>
    <option value="Serbia" @if ($employee[0]->nationality == "Serbia") {{ 'selected' }} @endif>Serbia</option>
    <option value="Seychelles" @if ($employee[0]->nationality == "Seychelles") {{ 'selected' }} @endif>Seychelles</option>
    <option value="Sierra Leone" @if ($employee[0]->nationality == "Sierra Leone") {{ 'selected' }} @endif>Sierra Leone</option>
    <option value="Singapore" @if ($employee[0]->nationality == "Singapore") {{ 'selected' }} @endif>Singapore</option>
    <option value="Sint Maarten" @if ($employee[0]->nationality == "Sint Maarten") {{ 'selected' }} @endif>Sint Maarten</option>
    <option value="Slovakia" @if ($employee[0]->nationality == "Slovakia") {{ 'selected' }} @endif>Slovakia</option>
    <option value="Slovenia" @if ($employee[0]->nationality == "Slovenia") {{ 'selected' }} @endif>Slovenia</option>
    <option value="Solomon Islands" @if ($employee[0]->nationality == "Solomon Islands") {{ 'selected' }} @endif>Solomon Islands</option>
    <option value="Somalia" @if ($employee[0]->nationality == "Russia") {{ 'selected' }} @endif>Somalia</option>
    <option value="South Africa" @if ($employee[0]->nationality == "South Africa") {{ 'selected' }} @endif>South Africa</option>
    <option value="South Georgia and the South Sandwich Island" @if ($employee[0]->nationality == "South Georgia and the South Sandwich Islands") 
    {{ 'selected' }} @endif> South Georgia and the South Sandwich Islands</option>
   
    <option value="South Korea" @if ($employee[0]->nationality == "South Korea") {{ 'selected' }} @endif>South Korea</option>
    <option value="South Sudan" @if ($employee[0]->nationality == "South Sudan") {{ 'selected' }} @endif>South Sudan</option>
    <option value="Spain" @if ($employee[0]->nationality == "Spain") {{ 'selected' }} @endif>Spain</option>
    <option value="Sri Lanka" @if ($employee[0]->nationality == "Sri Lanka") {{ 'selected' }} @endif>Sri Lanka</option>
    <option value="State of Palestine" @if ($employee[0]->nationality == "State of Palestine") {{ 'selected' }} @endif>State of Palestine</option>
    <option value="Sudan" @if ($employee[0]->nationality == "Sudan") {{ 'selected' }} @endif>Sudan</option>
    <option value="Suriname" @if ($employee[0]->nationality == "Suriname") {{ 'selected' }} @endif>Suriname</option>
    <option value="Svalbard and Jan Mayen" @if ($employee[0]->nationality == "Svalbard and Jan Mayen") {{ 'selected' }} @endif>Svalbard and Jan Mayen</option>
    <option value="Swaziland" @if ($employee[0]->nationality == "Swaziland") {{ 'selected' }} @endif>Swaziland</option>
    <option value="Sweden" @if ($employee[0]->nationality == "Sweden") {{ 'selected' }} @endif>Sweden</option>
    <option value="Switzerland" @if ($employee[0]->nationality == "Switzerland") {{ 'selected' }} @endif>Switzerland</option>
    <option value="Syrian Arab Republic" @if ($employee[0]->nationality == "Syrian Arab Republic") {{ 'selected' }} @endif>Syrian Arab Republic</option>
    <option value="Taiwan" @if ($employee[0]->nationality == "Taiwan") {{ 'selected' }} @endif>Taiwan</option>
    <option value="Tajikistan" @if ($employee[0]->nationality == "Tajikistan") {{ 'selected' }} @endif>Tajikistan</option>
    <option value="Tanzania" @if ($employee[0]->nationality == "Tanzania") {{ 'selected' }} @endif>Tanzania</option>
    <option value="Thailand" @if ($employee[0]->nationality == "Thailand") {{ 'selected' }} @endif>Thailand</option>
    <option value="Timor-Leste" @if ($employee[0]->nationality == "Timor-Leste") {{ 'selected' }} @endif>Timor-Leste</option>
    <option value="Togo"@if ($employee[0]->nationality == "Togo") {{ 'selected' }} @endif>Togo</option>
    <option value="Tokelau" @if ($employee[0]->nationality == "Tokelau") {{ 'selected' }} @endif>Tokelau</option>
    <option value="Tonga" @if ($employee[0]->nationality == "Tonga") {{ 'selected' }} @endif>Tonga</option>
    <option value="Trinidad and Tobago" @if ($employee[0]->nationality == "Trinidad and Tobago") {{ 'selected' }} @endif>Trinidad and Tobago</option>
    <option value="Tunisia" @if ($employee[0]->nationality == "Tunisia") {{ 'selected' }} @endif>Tunisia</option>
    <option value="Turkey" @if ($employee[0]->nationality == "Turkey") {{ 'selected' }} @endif>Turkey</option>
    <option value="Turkmenistan" @if ($employee[0]->nationality == "Turkmenistan") {{ 'selected' }} @endif>Turkmenistan</option>
    <option value="Turks and Caicos Islands" @if ($employee[0]->nationality == "Turks and Caicos Islands") {{ 'selected' }} @endif>Turks and Caicos Islands
    </option>
    <option value="Tuvalu" @if ($employee[0]->nationality == "Tuvalu") {{ 'selected' }} @endif>Tuvalu</option>
    <option value="Uganda" @if ($employee[0]->nationality == "Uganda") {{ 'selected' }} @endif>Uganda</option>
    <option value="Ukraine" @if ($employee[0]->nationality == "Ukraine") {{ 'selected' }} @endif>Ukraine</option>
    <option value="United Arab Emirates" @if ($employee[0]->nationality == "United Arab Emirates") {{ 'selected' }} @endif>United Arab Emirates</option>
    <option value="United Kingdom" @if ($employee[0]->nationality == "United Kingdom") {{ 'selected' }} @endif>United Kingdom</option>
    <option value="United States Minor Outlying Islands" data-capital="Washington, D.C.">United States Minor Outlying Islands</option>
    <option value="United States of America"  @if ($employee[0]->nationality == "United States of America") {{ 'selected' }} @endif>United States of America
    </option>
 
                      
    <option value="Uruguay"  @if ($employee[0]->nationality == "Uruguay") {{ 'selected' }} @endif>Uruguay</option>
    <option value="Uzbekistan" @if ($employee[0]->nationality == "Uzbekistan") {{ 'selected' }} @endif>Uzbekistan</option>
    <option value="Vanuatu" @if ($employee[0]->nationality == "Vanuatu") {{ 'selected' }} @endif>Vanuatu</option>
    <option value="Venezuela" @if ($employee[0]->nationality == "Venezuela") {{ 'selected' }} @endif>Venezuela</option>
    <option value="Vietnam" @if ($employee[0]->nationality == "Vietnam") {{ 'selected' }} @endif>Vietnam</option>
    <option value="Virgin Islands (British)" @if ($employee[0]->nationality == "Virgin Islands (British)") {{ 'selected' }} @endif>Virgin Islands (British)
    </option>
    <option value="Virgin Islands (U.S.)" @if ($employee[0]->nationality == "Virgin Islands (U.S.)") {{ 'selected' }} @endif>Virgin Islands (U.S.)</option>
    <option value="Wallis and Futuna" @if ($employee[0]->nationality == "Wallis and Futuna") {{ 'selected' }} @endif>Wallis and Futuna</option>
    <option value="Western Sahara" @if ($employee[0]->nationality == "Wallis and Futuna") {{ 'selected' }} @endif>Western Sahara</option>
    <option value="Yemen" @if ($employee[0]->nationality == "Yemen") {{ 'selected' }} @endif>Yemen</option>
    <option value="Zambia" @if ($employee[0]->nationality == "Zambia") {{ 'selected' }} @endif>Zambia</option>
    <option value="Zimbabwe"@if ($employee[0]->nationality == "Zimbabwe") {{ 'selected' }} @endif>Zimbabwe</option>
  </select>
    
                           @include('alerts.feedback', ['field' => 'nationality'])
                        </div>
                      </div>
                    </div>

                     <div class="col-lg-10 mt-3">
                      <div class="input-group form-control-lg">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="material-icons">email</i>
                          </span>
                        </div>
                        <div class="form-group">
                          <label for="" class="bmd-label-floating">Email (required)</label>
                          <input type="email" class="form-control" id="email" name="email" value="{{ old('email',$employee[0]->email) }}" required>
                           @include('alerts.feedback', ['field' => 'email'])
                        </div>
                      </div>
                    </div>

                     <div class="col-lg-10 mt-3">
                      <div class="input-group form-control-sm">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="material-icons">phone</i>
                          </span>
                        </div>
                        <div class="form-group">
                           <label for="" class="bmd-label-floating">Phone (required)</label><br>
                           
                           <select name="codes" id="codes" value="{{ old('codes') }}" required>
              
		<option data-countryCode="DZ" value="213"  @if ($employee[0]->codes == "213") {{ 'selected' }} @endif>Algeria (+213)</option>
		<option data-countryCode="AD" value="376"  @if ($employee[0]->codes == "376") {{ 'selected' }} @endif>Andorra (+376)</option>
		<option data-countryCode="AO" value="244"  @if ($employee[0]->codes == "244") {{ 'selected' }} @endif>Angola (+244)</option>
		<option data-countryCode="AI" value="1264" @if ($employee[0]->codes == "1264") {{ 'selected' }} @endif>Anguilla (+1264)</option>
<option data-countryCode="AG" value="1268"  @if ($employee[0]->codes == "1268") {{ 'selected' }} @endif>Antigua &amp; Barbuda (+1268)</option>
		<option data-countryCode="AR" value="54"  @if ($employee[0]->codes == "54") {{ 'selected' }} @endif>Argentina (+54)</option>
		<option data-countryCode="AM" value="374"  @if ($employee[0]->codes == "374") {{ 'selected' }} @endif>Armenia (+374)</option>
		<option data-countryCode="AW" value="297"  @if ($employee[0]->codes == "297") {{ 'selected' }} @endif>Aruba (+297)</option>
		<option data-countryCode="AU" value="61" @if ($employee[0]->codes == "61") {{ 'selected' }} @endif>Australia (+61)</option>
		<option data-countryCode="AT" value="43" @if ($employee[0]->codes == "43") {{ 'selected' }} @endif>Austria (+43)</option>
		<option data-countryCode="AZ" value="994" @if ($employee[0]->codes == "994") {{ 'selected' }} @endif>Azerbaijan (+994)</option>
		<option data-countryCode="BS" value="1242" @if ($employee[0]->codes == "1242") {{ 'selected' }} @endif>Bahamas (+1242)</option>
		<option data-countryCode="BH" value="973" @if ($employee[0]->codes == "973") {{ 'selected' }} @endif>Bahrain (+973)</option>
		<option data-countryCode="BD" value="880" @if ($employee[0]->codes == "880") {{ 'selected' }} @endif>Bangladesh (+880)</option>
		<option data-countryCode="BB" value="1246" @if ($employee[0]->codes == "1246") {{ 'selected' }} @endif>Barbados (+1246)</option>
		<option data-countryCode="BY" value="375" @if ($employee[0]->codes == "375") {{ 'selected' }} @endif>Belarus (+375)</option>
		<option data-countryCode="BE" value="32" @if ($employee[0]->codes == "32") {{ 'selected' }} @endif>Belgium (+32)</option>
		<option data-countryCode="BZ" value="501" @if ($employee[0]->codes == "501") {{ 'selected' }} @endif>Belize (+501)</option>
		<option data-countryCode="BJ" value="229" @if ($employee[0]->codes == "229") {{ 'selected' }} @endif>Benin (+229)</option>
		<option data-countryCode="BM" value="1441" @if ($employee[0]->codes == "1441") {{ 'selected' }} @endif>Bermuda (+1441)</option>
		<option data-countryCode="BT" value="975" @if ($employee[0]->codes == "975") {{ 'selected' }} @endif>Bhutan (+975)</option>
		<option data-countryCode="BO" value="591" @if ($employee[0]->codes == "591") {{ 'selected' }} @endif>Bolivia (+591)</option>
		<option data-countryCode="BA" value="387" @if ($employee[0]->codes == "387") {{ 'selected' }} @endif>Bosnia Herzegovina (+387)</option>
		<option data-countryCode="BW" value="267" @if ($employee[0]->codes == "267") {{ 'selected' }} @endif>Botswana (+267)</option>
		<option data-countryCode="BR" value="55" @if ($employee[0]->codes == "55") {{ 'selected' }} @endif>Brazil (+55)</option>
		<option data-countryCode="BN" value="673" @if ($employee[0]->codes == "673") {{ 'selected' }} @endif>Brunei (+673)</option>
		<option data-countryCode="BG" value="359" @if ($employee[0]->codes == "359") {{ 'selected' }} @endif>Bulgaria (+359)</option>
		<option data-countryCode="BF" value="226" @if ($employee[0]->codes == "226") {{ 'selected' }} @endif>Burkina Faso (+226)</option>
		<option data-countryCode="BI" value="257" @if ($employee[0]->codes == "257") {{ 'selected' }} @endif>Burundi (+257)</option>
		<option data-countryCode="KH" value="855" @if ($employee[0]->codes == "855") {{ 'selected' }} @endif>Cambodia (+855)</option>
		<option data-countryCode="CM" value="237" @if ($employee[0]->codes == "237") {{ 'selected' }} @endif>Cameroon (+237)</option>
		<option data-countryCode="CA" value="1" @if ($employee[0]->codes == "1") {{ 'selected' }} @endif>Canada (+1)</option>
		<option data-countryCode="CV" value="238" @if ($employee[0]->codes == "238") {{ 'selected' }} @endif>Cape Verde Islands (+238)</option>
		<option data-countryCode="KY" value="1345" @if ($employee[0]->codes == "1345") {{ 'selected' }} @endif>Cayman Islands (+1345)</option>
		<option data-countryCode="CF" value="236" @if ($employee[0]->codes == "236") {{ 'selected' }} @endif>Central African Republic (+236)</option>
		<option data-countryCode="CL" value="56" @if ($employee[0]->codes == "56") {{ 'selected' }} @endif>Chile (+56)</option>
		<option data-countryCode="CN" value="86" @if ($employee[0]->codes == "86") {{ 'selected' }} @endif>China (+86)</option>
		<option data-countryCode="CO" value="57" @if ($employee[0]->codes == "57") {{ 'selected' }} @endif>Colombia (+57)</option>
		<option data-countryCode="KM" value="269" @if ($employee[0]->codes == "269") {{ 'selected' }} @endif>Comoros (+269)</option>
		<option data-countryCode="CG" value="242" @if ($employee[0]->codes == "242") {{ 'selected' }} @endif>Congo (+242)</option>
		<option data-countryCode="CK" value="682" @if ($employee[0]->codes == "682") {{ 'selected' }} @endif>Cook Islands (+682)</option>
		<option data-countryCode="CR" value="506" @if ($employee[0]->codes == "506") {{ 'selected' }} @endif>Costa Rica (+506)</option>
		<option data-countryCode="HR" value="385" @if ($employee[0]->codes == "385") {{ 'selected' }} @endif>Croatia (+385)</option>
		<option data-countryCode="CU" value="53" @if ($employee[0]->codes == "53") {{ 'selected' }} @endif>Cuba (+53)</option>
		<option data-countryCode="CY" value="90392" @if ($employee[0]->codes == "90392") {{ 'selected' }} @endif>Cyprus North (+90392)</option>
		<option data-countryCode="CY" value="357" @if ($employee[0]->codes == "357") {{ 'selected' }} @endif>Cyprus South (+357)</option>
		<option data-countryCode="CZ" value="42" @if ($employee[0]->codes == "42") {{ 'selected' }} @endif>Czech Republic (+42)</option>
		<option data-countryCode="DK" value="45" @if ($employee[0]->codes == "45") {{ 'selected' }} @endif>Denmark (+45)</option>
		<option data-countryCode="DJ" value="253" @if ($employee[0]->codes == "253") {{ 'selected' }} @endif>Djibouti (+253)</option>
		<option data-countryCode="DM" value="1809" @if ($employee[0]->codes == "1809") {{ 'selected' }} @endif>Dominica (+1809)</option>
		<option data-countryCode="DO" value="1809" @if ($employee[0]->codes == "1809") {{ 'selected' }} @endif> Dominican Republic (+1809)</option>
		<option data-countryCode="EC" value="593" @if ($employee[0]->codes == "593") {{ 'selected' }} @endif>Ecuador (+593)</option>
		<option data-countryCode="EG" value="20" @if ($employee[0]->codes == "20") {{ 'selected' }} @endif>Egypt (+20)</option>
		<option data-countryCode="SV" value="503" @if ($employee[0]->codes == "503") {{ 'selected' }} @endif>El Salvador (+503)</option>
		<option data-countryCode="GQ" value="240" @if ($employee[0]->codes == "240") {{ 'selected' }} @endif>Equatorial Guinea (+240)</option>
		<option data-countryCode="ER" value="291" @if ($employee[0]->codes == "291") {{ 'selected' }} @endif>Eritrea (+291)</option>
		<option data-countryCode="EE" value="372" @if ($employee[0]->codes == "372") {{ 'selected' }} @endif>Estonia (+372)</option>
		<option data-countryCode="ET" value="251" @if ($employee[0]->codes == "251") {{ 'selected' }} @endif>Ethiopia (+251)</option>
		<option data-countryCode="FK" value="500" @if ($employee[0]->codes == "500") {{ 'selected' }} @endif>Falkland Islands (+500)</option>
		<option data-countryCode="FO" value="298" @if ($employee[0]->codes == "298") {{ 'selected' }} @endif>Faroe Islands (+298)</option>
		<option data-countryCode="FJ" value="679" @if ($employee[0]->codes == "679") {{ 'selected' }} @endif>Fiji (+679)</option>
		<option data-countryCode="FI" value="358" @if ($employee[0]->codes == "358") {{ 'selected' }} @endif>Finland (+358)</option>
		<option data-countryCode="FR" value="33" @if ($employee[0]->codes == "33") {{ 'selected' }} @endif>France (+33)</option>
		<option data-countryCode="GF" value="594" @if ($employee[0]->codes == "594") {{ 'selected' }} @endif>French Guiana (+594)</option>
		<option data-countryCode="PF" value="689" @if ($employee[0]->codes == "689") {{ 'selected' }} @endif>French Polynesia (+689)</option>
		<option data-countryCode="GA" value="241" @if ($employee[0]->codes == "241") {{ 'selected' }} @endif>Gabon (+241)</option>
		<option data-countryCode="GM" value="220" @if ($employee[0]->codes == "220") {{ 'selected' }} @endif>Gambia (+220)</option>
		<option data-countryCode="GE" value="7880" @if ($employee[0]->codes == "7880") {{ 'selected' }} @endif>Georgia (+7880)</option>
		<option data-countryCode="DE" value="49" @if ($employee[0]->codes == "49") {{ 'selected' }} @endif>Germany (+49)</option>
		<option data-countryCode="GH" value="233" @if ($employee[0]->codes == "233") {{ 'selected' }} @endif>Ghana (+233)</option>
		<option data-countryCode="GI" value="350" @if ($employee[0]->codes == "350") {{ 'selected' }} @endif>Gibraltar (+350)</option>
		<option data-countryCode="GR" value="30" @if ($employee[0]->codes == "30") {{ 'selected' }} @endif>Greece (+30)</option>
		<option data-countryCode="GL" value="299" @if ($employee[0]->codes == "299") {{ 'selected' }} @endif>Greenland (+299)</option>
		<option data-countryCode="GD" value="1473" @if ($employee[0]->codes == "1473") {{ 'selected' }} @endif>Grenada (+1473)</option>
		<option data-countryCode="GP" value="590" @if ($employee[0]->codes == "590") {{ 'selected' }} @endif>Guadeloupe (+590)</option>
		<option data-countryCode="GU" value="671" @if ($employee[0]->codes == "671") {{ 'selected' }} @endif>Guam (+671)</option>
		<option data-countryCode="GT" value="502" @if ($employee[0]->codes == "502") {{ 'selected' }} @endif>Guatemala (+502)</option>
		<option data-countryCode="GN" value="224" @if ($employee[0]->codes == "224") {{ 'selected' }} @endif>Guinea (+224)</option>
		<option data-countryCode="GW" value="245" @if ($employee[0]->codes == "245") {{ 'selected' }} @endif>Guinea - Bissau (+245)</option>
		<option data-countryCode="GY" value="592" @if ($employee[0]->codes == "592") {{ 'selected' }} @endif>Guyana (+592)</option>
		<option data-countryCode="HT" value="509" @if ($employee[0]->codes == "509") {{ 'selected' }} @endif>Haiti (+509)</option>
		<option data-countryCode="HN" value="504" @if ($employee[0]->codes == "504") {{ 'selected' }} @endif>Honduras (+504)</option>
		<option data-countryCode="HK" value="852" @if ($employee[0]->codes == "852") {{ 'selected' }} @endif>Hong Kong (+852)</option>
		<option data-countryCode="HU" value="36" @if ($employee[0]->codes == "36") {{ 'selected' }} @endif>Hungary (+36)</option>
		<option data-countryCode="IS" value="354" @if ($employee[0]->codes == "354") {{ 'selected' }} @endif>Iceland (+354)</option>
		<option data-countryCode="IN" value="91" @if ($employee[0]->codes == "91") {{ 'selected' }} @endif>India (+91)</option>
		<option data-countryCode="ID" value="62" @if ($employee[0]->codes == "62") {{ 'selected' }} @endif>Indonesia (+62)</option>
		<option data-countryCode="IR" value="98" @if ($employee[0]->codes == "291") {{ 'selected' }} @endif>Iran (+98)</option>
		<option data-countryCode="IQ" value="964" @if ($employee[0]->codes == "291") {{ 'selected' }} @endif>Iraq (+964)</option>
		<option data-countryCode="IE" value="353" @if ($employee[0]->codes == "353") {{ 'selected' }} @endif>Ireland (+353)</option>
		<option data-countryCode="IL" value="972" @if ($employee[0]->codes == "972") {{ 'selected' }} @endif>Israel (+972)</option>
		<option data-countryCode="IT" value="39"  @if ($employee[0]->codes == "39") {{ 'selected' }} @endif>Italy (+39)</option>
		
		<option data-countryCode="JM" value="1876" @if ($employee[0]->codes == "1876") {{ 'selected' }} @endif>Jamaica (+1876)</option>
		<option data-countryCode="JP" value="81" @if ($employee[0]->codes == "81") {{ 'selected' }} @endif>Japan (+81)</option>
		<option data-countryCode="JO" value="962" @if ($employee[0]->codes == "962") {{ 'selected' }} @endif>Jordan (+962)</option>
		<option data-countryCode="KZ" value="7" @if ($employee[0]->codes == "962") {{ 'selected' }} @endif>Kazakhstan (+7)</option>
		<option data-countryCode="KE" value="254" @if ($employee[0]->codes == "962") {{ 'selected' }} @endif>Kenya (+254)</option>
		<option data-countryCode="KI" value="686" @if ($employee[0]->codes == "962") {{ 'selected' }} @endif>Kiribati (+686)</option>
		<option data-countryCode="KP" value="850"@if ($employee[0]->codes == "850") {{ 'selected' }} @endif>Korea North (+850)</option>
		<option data-countryCode="KR" value="82" @if ($employee[0]->codes == "82") {{ 'selected' }} @endif>Korea South (+82)</option>
		<option data-countryCode="KW" value="965" @if ($employee[0]->codes == "965") {{ 'selected' }} @endif>Kuwait (+965)</option>
		<option data-countryCode="KG" value="996" @if ($employee[0]->codes == "996") {{ 'selected' }} @endif>Kyrgyzstan (+996)</option>
		<option data-countryCode="LA" value="856" @if ($employee[0]->codes == "856") {{ 'selected' }} @endif>Laos (+856)</option>
		<option data-countryCode="LV" value="371" @if ($employee[0]->codes == "371") {{ 'selected' }} @endif>Latvia (+371)</option>
		<option data-countryCode="LB" value="961" @if ($employee[0]->codes == "961") {{ 'selected' }} @endif>Lebanon (+961)</option>
		<option data-countryCode="LS" value="266" @if ($employee[0]->codes == "266") {{ 'selected' }} @endif>Lesotho (+266)</option>
		<option data-countryCode="LR" value="231" @if ($employee[0]->codes == "231") {{ 'selected' }} @endif>Liberia (+231)</option>
		<option data-countryCode="LY" value="218"@if ($employee[0]->codes == "218") {{ 'selected' }} @endif>Libya (+218)</option>
		<option data-countryCode="LI" value="417" @if ($employee[0]->codes == "962") {{ 'selected' }} @endif>Liechtenstein (+417)</option>
		<option data-countryCode="LT" value="370"@if ($employee[0]->codes == "370") {{ 'selected' }} @endif>Lithuania (+370)</option>
		<option data-countryCode="LU" value="352" @if ($employee[0]->codes == "352") {{ 'selected' }} @endif>Luxembourg (+352)</option>
		<option data-countryCode="MO" value="853" @if ($employee[0]->codes == "853") {{ 'selected' }} @endif>Macao (+853)</option>
		<option data-countryCode="MK" value="389" @if ($employee[0]->codes == "389") {{ 'selected' }} @endif>Macedonia (+389)</option>
		<option data-countryCode="MG" value="261" @if ($employee[0]->codes == "261") {{ 'selected' }} @endif>Madagascar (+261)</option>
		<option data-countryCode="MW" value="265" @if ($employee[0]->codes == "265") {{ 'selected' }} @endif>Malawi (+265)</option>
		<option data-countryCode="MY" value="60" @if ($employee[0]->codes == "60") {{ 'selected' }} @endif>Malaysia (+60)</option>
		<option data-countryCode="MV" value="960"@if ($employee[0]->codes == "960") {{ 'selected' }} @endif>Maldives (+960)</option>
		<option data-countryCode="ML" value="223"@if ($employee[0]->codes == "223") {{ 'selected' }} @endif>Mali (+223)</option>
		<option data-countryCode="MT" value="356" @if ($employee[0]->codes == "356") {{ 'selected' }} @endif>Malta (+356)</option>
		<option data-countryCode="MH" value="692" @if ($employee[0]->codes == "692") {{ 'selected' }} @endif>Marshall Islands (+692)</option>
		<option data-countryCode="MQ" value="596" @if ($employee[0]->codes == "596") {{ 'selected' }} @endif>Martinique (+596)</option>
		<option data-countryCode="MR" value="222" @if ($employee[0]->codes == "222") {{ 'selected' }} @endif>Mauritania (+222)</option>
		<option data-countryCode="YT" value="269" @if ($employee[0]->codes == "269") {{ 'selected' }} @endif>Mayotte (+269)</option>
		<option data-countryCode="MX" value="52" @if ($employee[0]->codes == "52") {{ 'selected' }} @endif>Mexico (+52)</option>
		<option data-countryCode="FM" value="691" @if ($employee[0]->codes == "691") {{ 'selected' }} @endif>Micronesia (+691)</option>
		<option data-countryCode="MD" value="373" @if ($employee[0]->codes == "373") {{ 'selected' }} @endif>Moldova (+373)</option>
		<option data-countryCode="MC" value="377" @if ($employee[0]->codes == "377") {{ 'selected' }} @endif>Monaco (+377)</option>
		<option data-countryCode="MN" value="976" @if ($employee[0]->codes == "976") {{ 'selected' }} @endif>Mongolia (+976)</option>
		<option data-countryCode="MS" value="1664" @if ($employee[0]->codes == "1664") {{ 'selected' }} @endif>Montserrat (+1664)</option>
		<option data-countryCode="MA" value="212" @if ($employee[0]->codes == "212") {{ 'selected' }} @endif>Morocco (+212)</option>
		<option data-countryCode="MZ" value="258" @if ($employee[0]->codes == "258") {{ 'selected' }} @endif>Mozambique (+258)</option>
		<option data-countryCode="MN" value="95" @if ($employee[0]->codes == "95") {{ 'selected' }} @endif>Myanmar (+95)</option>
		<option data-countryCode="NA" value="264" @if ($employee[0]->codes == "264") {{ 'selected' }} @endif>Namibia (+264)</option>
		<option data-countryCode="NR" value="674" @if ($employee[0]->codes == "674") {{ 'selected' }} @endif>Nauru (+674)</option>
		<option data-countryCode="NP" value="977" @if ($employee[0]->codes == "977") {{ 'selected' }} @endif>Nepal (+977)</option>
		<option data-countryCode="NL" value="31" @if ($employee[0]->codes == "31") {{ 'selected' }} @endif>Netherlands (+31)</option>
		<option data-countryCode="NC" value="687" @if ($employee[0]->codes == "687") {{ 'selected' }} @endif>New Caledonia (+687)</option>
		<option data-countryCode="NZ" value="64" @if ($employee[0]->codes == "64") {{ 'selected' }} @endif>New Zealand (+64)</option>
		<option data-countryCode="NI" value="505" @if ($employee[0]->codes == "505") {{ 'selected' }} @endif>Nicaragua (+505)</option>
		<option data-countryCode="NE" value="227" @if ($employee[0]->codes == "227") {{ 'selected' }} @endif>Niger (+227)</option>
		<option data-countryCode="NG" value="234" @if ($employee[0]->codes == "234") {{ 'selected' }} @endif>Nigeria (+234)</option>
		<option data-countryCode="NU" value="683" @if ($employee[0]->codes == "683") {{ 'selected' }} @endif>Niue (+683)</option>
		<option data-countryCode="NF" value="672" @if ($employee[0]->codes == "672") {{ 'selected' }} @endif>Norfolk Islands (+672)</option>
		<option data-countryCode="NP" value="670" @if ($employee[0]->codes == "670") {{ 'selected' }} @endif>Northern Marianas (+670)</option>
		<option data-countryCode="NO" value="47" @if ($employee[0]->codes == "47") {{ 'selected' }} @endif>Norway (+47)</option>
		<option data-countryCode="OM" value="968" @if ($employee[0]->codes == "968") {{ 'selected' }} @endif>Oman (+968)</option>
		<option data-countryCode="PW" value="680" @if ($employee[0]->codes == "680") {{ 'selected' }} @endif>Palau (+680)</option>
		<option data-countryCode="PA" value="507" @if ($employee[0]->codes == "507") {{ 'selected' }} @endif>Panama (+507)</option>
		<option data-countryCode="PG" value="675" @if ($employee[0]->codes == "675") {{ 'selected' }} @endif>Papua New Guinea (+675)</option>
		<option data-countryCode="PY" value="595" @if ($employee[0]->codes == "595") {{ 'selected' }} @endif>Paraguay (+595)</option>
		<option data-countryCode="PE" value="51" @if ($employee[0]->codes == "51") {{ 'selected' }} @endif> Peru (+51)</option>
		<option data-countryCode="PH" value="63" @if ($employee[0]->codes == "63") {{ 'selected' }} @endif>Philippines (+63)</option>
		<option data-countryCode="PL" value="48" @if ($employee[0]->codes == "48") {{ 'selected' }} @endif>Poland (+48)</option>
		<option data-countryCode="PT" value="351" @if ($employee[0]->codes == "968") {{ 'selected' }} @endif>Portugal (+968)</option>
		<option data-countryCode="PR" value="1787" @if ($employee[0]->codes == "1787") {{ 'selected' }} @endif>Puerto Rico (+1787)</option>
		<option data-countryCode="QA" value="974" @if ($employee[0]->codes == "974") {{ 'selected' }} @endif>Qatar (+974)</option>
		<option data-countryCode="RE" value="262" @if ($employee[0]->codes == "262") {{ 'selected' }} @endif>Reunion (+262)</option>
		<option data-countryCode="RO" value="40" @if ($employee[0]->codes == "40") {{ 'selected' }} @endif>Romania (+40)</option>
		<option data-countryCode="RU" value="7" @if ($employee[0]->codes == "7") {{ 'selected' }} @endif>Russia (+7)</option>
		<option data-countryCode="RW" value="250" @if ($employee[0]->codes == "250") {{ 'selected' }} @endif>Rwanda (+250)</option>
		<option data-countryCode="SM" value="378" @if ($employee[0]->codes == "378") {{ 'selected' }} @endif>San Marino (+378)</option>
		<option data-countryCode="ST" value="239" @if ($employee[0]->codes == "239") {{ 'selected' }} @endif>Sao Tome &amp; Principe (+239)</option>
		<option data-countryCode="SA" value="966" @if ($employee[0]->codes == "966") {{ 'selected' }} @endif>Saudi Arabia (+966)</option>
		<option data-countryCode="SN" value="221" @if ($employee[0]->codes == "221") {{ 'selected' }} @endif>Senegal (+221)</option>
		<option data-countryCode="CS" value="381" @if ($employee[0]->codes == "381") {{ 'selected' }} @endif>Serbia (+381)</option>
		<option data-countryCode="SC" value="248" @if ($employee[0]->codes == "248") {{ 'selected' }} @endif>Seychelles (+248)</option>
		<option data-countryCode="SL" value="232" @if ($employee[0]->codes == "232") {{ 'selected' }} @endif>Sierra Leone (+232)</option>
		<option data-countryCode="SG" value="65" @if ($employee[0]->codes == "65") {{ 'selected' }} @endif>Singapore (+65)</option>
		<option data-countryCode="SK" value="421" @if ($employee[0]->codes == "421") {{ 'selected' }} @endif>Slovak Republic (+421)</option>
		<option data-countryCode="SI" value="386" @if ($employee[0]->codes == "386") {{ 'selected' }} @endif>Slovenia (+386)</option>
		<option data-countryCode="SB" value="677" @if ($employee[0]->codes == "677") {{ 'selected' }} @endif>Solomon Islands (+677)</option>
		<option data-countryCode="SO" value="252" @if ($employee[0]->codes == "252") {{ 'selected' }} @endif>Somalia (+252)</option>
		<option data-countryCode="ZA" value="27" @if ($employee[0]->codes == "27") {{ 'selected' }} @endif>South Africa (+27)</option>
		<option data-countryCode="ES" value="34" @if ($employee[0]->codes == "34") {{ 'selected' }} @endif>Spain (+34)</option>
		<option data-countryCode="LK" value="94" @if ($employee[0]->codes == "94") {{ 'selected' }} @endif>Sri Lanka (+94)</option>
		<option data-countryCode="SH" value="290" @if ($employee[0]->codes == "290") {{ 'selected' }} @endif>St. Helena (+290)</option>
		<option data-countryCode="KN" value="1869" @if ($employee[0]->codes == "1869") {{ 'selected' }} @endif>St. Kitts (+1869)</option>
		<option data-countryCode="SC" value="1758" @if ($employee[0]->codes == "1758") {{ 'selected' }} @endif>St. Lucia (+1758)</option>
		<option data-countryCode="SD" value="249" @if ($employee[0]->codes == "249") {{ 'selected' }} @endif>Sudan (+249)</option>
		<option data-countryCode="SR" value="597" @if ($employee[0]->codes == "597") {{ 'selected' }} @endif>Suriname (+597)</option>
		<option data-countryCode="SZ" value="268" @if ($employee[0]->codes == "268") {{ 'selected' }} @endif>Swaziland (+268)</option>
		<option data-countryCode="SE" value="46" @if ($employee[0]->codes == "46") {{ 'selected' }} @endif>Sweden (+46)</option>
		<option data-countryCode="CH" value="41" @if ($employee[0]->codes == "41") {{ 'selected' }} @endif>Switzerland (+41)</option>
		<option data-countryCode="SI" value="963" @if ($employee[0]->codes == "963") {{ 'selected' }} @endif>Syria (+963)</option>
		<option data-countryCode="TW" value="886" @if ($employee[0]->codes == "886") {{ 'selected' }} @endif>Taiwan (+886)</option>
		<option data-countryCode="TJ" value="7" @if ($employee[0]->codes == "7") {{ 'selected' }} @endif>Tajikstan (+7)</option>
		<option data-countryCode="TH" value="66" @if ($employee[0]->codes == "66") {{ 'selected' }} @endif>Thailand (+66)</option>
		<option data-countryCode="TG" value="228" @if ($employee[0]->codes == "228") {{ 'selected' }} @endif>Togo (+228)</option>
		<option data-countryCode="TO" value="676" @if ($employee[0]->codes == "676") {{ 'selected' }} @endif>Tonga (+676)</option>
		<option data-countryCode="TT" value="1868" @if ($employee[0]->codes == "1868") {{ 'selected' }} @endif>Trinidad &amp; Tobago (+1868)</option>
		<option data-countryCode="TN" value="216" @if ($employee[0]->codes == "216") {{ 'selected' }} @endif>Tunisia (+216)</option>
		<option data-countryCode="TR" value="90" @if ($employee[0]->codes == "90") {{ 'selected' }} @endif>Turkey (+90)</option>
		<option data-countryCode="TM" value="7" @if ($employee[0]->codes == "7") {{ 'selected' }} @endif>Turkmenistan (+7)</option>
		<option data-countryCode="TM" value="993"@if ($employee[0]->codes == "993") {{ 'selected' }} @endif>Turkmenistan (+993)</option>
		<option data-countryCode="TC" value="1649" @if ($employee[0]->codes == "1649") {{ 'selected' }} @endif>Turks &amp; Caicos Islands (+1649)</option>
		<option data-countryCode="TV" value="688" @if ($employee[0]->codes == "688") {{ 'selected' }} @endif>Tuvalu (+688)</option>
		<option data-countryCode="UG" value="256" @if ($employee[0]->codes == "256") {{ 'selected' }} @endif>Uganda (+256)</option>
		<option data-countryCode="GB" value="44" @if ($employee[0]->codes == "44") {{ 'selected' }} @endif>UK (+44)</option> 
		<option data-countryCode="UA" value="380" @if ($employee[0]->codes == "380") {{ 'selected' }} @endif>Ukraine (+380)</option>
		<option data-countryCode="US" value="1" @if ($employee[0]->codes == "1") {{ 'selected' }} @endif>United States Of America (+1)</option>
		<option data-countryCode="AE" value="971" @if ($employee[0]->codes == "971") {{ 'selected' }} @endif>United Arab Emirates (+971)</option>
		<option data-countryCode="UY" value="598" @if ($employee[0]->codes == "598") {{ 'selected' }} @endif>Uruguay (+598)</option>
		<option data-countryCode="US" value="1" @if ($employee[0]->codes == "1") {{ 'selected' }} @endif>USA (+1)</option>
		<option data-countryCode="UZ" value="7" @if ($employee[0]->codes == "7") {{ 'selected' }} @endif>Uzbekistan (+7)</option>
		<option data-countryCode="VU" value="678" @if ($employee[0]->codes == "678") {{ 'selected' }} @endif>Vanuatu (+678)</option>
		<option data-countryCode="VA" value="379" @if ($employee[0]->codes == "379") {{ 'selected' }} @endif>Vatican City (+379)</option>
		<option data-countryCode="VE" value="58" @if ($employee[0]->codes == "58") {{ 'selected' }} @endif>Venezuela (+58)</option>
		<option data-countryCode="VN" value="84" @if ($employee[0]->codes == "84") {{ 'selected' }} @endif>Vietnam (+84)</option>
		<option data-countryCode="VG" value="1284" @if ($employee[0]->codes == "1284") {{ 'selected' }} @endif>Virgin Islands - British (+1284)</option>
		<option data-countryCode="VI" value="1340" @if ($employee[0]->codes == "1340") {{ 'selected' }} @endif>Virgin Islands - US (+1340)</option>
		<option data-countryCode="WF" value="681" @if ($employee[0]->codes == "681") {{ 'selected' }} @endif>Wallis &amp; Futuna (+681)</option>
		<option data-countryCode="YE" value="969" @if ($employee[0]->codes == "969") {{ 'selected' }} @endif>Yemen (North)(+969)</option>
		<option data-countryCode="YE" value="967" @if ($employee[0]->codes == "967") {{ 'selected' }} @endif>Yemen (South)(+967)</option>
		<option data-countryCode="ZM" value="260" @if ($employee[0]->codes == "260") {{ 'selected' }} @endif>Zambia (+260)</option>
		<option data-countryCode="ZW" value="263" @if ($employee[0]->codes == "263") {{ 'selected' }} @endif>Zimbabwe (+263)</option>
	
	</select>
	
           <input type="number" class="mobile_number" placeholder="Phone No." id="mobile_number" name="mobile_number" value="{{ old('mobile_number',$employee[0]->mobile_number) }}" required>

           @include('alerts.feedback', ['field' => 'mobile_number'])
                          
                        </div>
                      </div>
                    </div>

                

 		<div class="col-lg-10 mt-3">
                      <div class="input-group form-control-sm">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="material-icons">face</i>
                          </span>
                        </div>
                       
                        <div class="form-group">
                           <label for="" class="bmd-label-floating">Gender (required)</label>
                        
                         <div class="col-lg-10 mt-3">
                    
                            <input type="radio" name="gender" value="male" @if ($employee[0]->gender == "male") {{ 'checked' }} @endif>Male
                                	
                      		<input type="radio" name="gender" value="female" @if ($employee[0]->gender == "female") {{ 'checked' }} @endif>Female

                            </div>
                           
                        </div>
                      </div>
                    </div>
                     
   
                    
                    <div class="col-lg-10 mt-3">
                      <div class="input-group form-control-lg">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="material-icons">face</i>
                          </span>
                        </div>
                        <div class="form-group">
                          <label for="" class="bmd-label-floating">	Emirates ID (required)</label>
                  <input type="text" class="form-control" id="emirates_id" name="emirates_id" value="{{old('emirates_id',$employee[0]->emirates_id) }}" required>
                           @include('alerts.feedback', ['field' => 'emirates_id'])
                        </div>
                      </div>
                    </div>
                    
 		   </div>
                 </div>
        
        
                 <div class="tab-pane" id="designation">
                  <div class="row justify-content-center">
                    <div class="col-sm-12">
                       <h5 class="info-text"> Let's start with the designation information</h5>
                    </div>

                     <div class="col-lg-10 mt-3">
                      <div class="input-group form-control-lg">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="material-icons">work</i>
                          </span>
                        </div>
                        <div class="form-group">
                          <label for="" class="bmd-label-floating"></label>
           <select class="bmd-label-floating form-control{{ $errors->has('designation') ? ' is-invalid' : '' }}" name="designation" id="input-designation" 
                             value="{{ old('designation') }}" required aria-required="true">
                          @foreach ($roles as $desig)
             <option value="{{ $desig->id}}"  @if($desig->id == $employee[0]->designation ) selected @endif > {{  $desig->name }}</option>
                              @endforeach
                          </select>
                           @include('alerts.feedback', ['field' => 'middle_name'])
                        </div>
                      </div>
                    </div>





                     <div class="col-lg-10 mt-3">
                      <div class="input-group form-control-lg">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="material-icons">work</i>
                          </span>
                        </div>
                        <div class="form-group">
                          <label for="" class="bmd-label-floating">Department (required)</label>
                          <input type="text" class="form-control" id="" name="department" value="{{ old('department',$employee[0]->department) }}" required>
                           @include('alerts.feedback', ['field' => 'required'])
                        </div>
                      </div>
                    </div>
                    
                     <div class="col-lg-10 mt-3">
                      <div class="input-group form-control-lg">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="material-icons">today</i>
                          </span>
                        </div>
                        <div class="form-group">
                          <label for="" class="bmd-label-floating">Joining Date (required)</label>
    <input type="text" class="form-control datepicker" id="joining_date" name="joining_date" value="{{ old('joining_date',$employee[0]->joining_date) }}" required readonly="">
                           @include('alerts.feedback', ['field' => 'joining_date'])
                        </div>
                      </div>
                    </div>

                  
                  
                  </div>
                </div>

                <div class="tab-pane" id="visa">
                   <h5 class="info-text"> Let's start with the visa information</h5>
                  <div class="row justify-content-center">
                     <!--  <div class="row">
                        <div class="col-sm-4">
                          <div class="choice" data-toggle="wizard-checkbox">
                            <input type="checkbox" name="jobb" value="Design">
                            <div class="icon">
                              <i class="fa fa-pencil"></i>
                            </div>
                            <h6>Design</h6>
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="choice" data-toggle="wizard-checkbox">
                            <input type="checkbox" name="jobb" value="Code">
                            <div class="icon">
                              <i class="fa fa-terminal"></i>
                            </div>
                            <h6>Code</h6>
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="choice" data-toggle="wizard-checkbox">
                            <input type="checkbox" name="jobb" value="Develop">
                            <div class="icon">
                              <i class="fa fa-laptop"></i>
                            </div>
                            <h6>Develop</h6>
                          </div>
                          <select class="selectpicker" data-style="btn btn-primary btn-round" title="Single Select" data-size="7">
                            <option disabled selected>Choose city</option>
                            <option value="2">Foobar</option>
                            <option value="3">Is great</option>
                          </select>
                        </div>
                      </div> -->

                      <div class="col-lg-10 mt-3">
                         <div class="input-group form-control-lg">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="material-icons">face</i>
                            </span>
                          </div>
                          <div class="form-group">
                            <label for="" class="bmd-label-floating">Passport Number (required)</label>
 <input type="text" class="form-control" id="passport_number" name="passport_number" value="{{ old('passport_number',$employee[0]->passport_number) }}" required>
                             @include('alerts.feedback', ['field' => 'passport_number'])
                          </div>
                         </div>
                       </div>

                         <div class="col-lg-10 mt-3">
                         <div class="input-group form-control-lg">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="material-icons">today</i>
                            </span>
                          </div>
                          <div class="form-group">
                            <label for="" class="bmd-label-floating date-height">Passport Expiry Date (required)</label>
        <input type="text" class="form-control datepicker" id="passport_exp_date" name="passport_exp_date" value="{{ old('passport_exp_date',
        $employee[0]->passport_exp_date) }}" required>
                             @include('alerts.feedback', ['field' => 'passport_exp_date'])
                          </div>
                         </div>
                       </div>

                        <div class="col-lg-10 mt-3">
                         <div class="input-group form-control-lg">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="material-icons">today</i>
                            </span>
                          </div>
                          <div class="form-group">
                            <label for="" class="bmd-label-floating date-height">Visa Expiry Date (required)</label>
 <input type="text" class="form-control datepicker" id="visa_exp_date" name="visa_exp_date" value="{{ old('visa_exp_date',$employee[0]->visa_exp_date) }}" required>
                             @include('alerts.feedback', ['field' => 'visa_exp_date'])
                          </div>
                         </div>
                       </div>

                      

                        <div class="col-lg-10 mt-3">
                         <div class="input-group form-control-lg">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="material-icons">face</i>
                            </span>
                          </div>
                          <div class="form-group">
                          <label for="" class="bmd-label-floating date-height">Medical Insurance No.</label>
 <input type="text" class="form-control" id="medical_ins_no" name="medical_ins_no" value="{{ old('medical_ins_no',$employee[0]->medical_ins_no) }}" >

                          </div>
                         </div>
                       </div>

                        <div class="col-lg-10 mt-3">
                         <div class="input-group form-control-lg">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="material-icons">today</i>
                            </span>
                          </div>
                          <div class="form-group">
     <label for="" class="bmd-label-floating date-height">Medical Insurance Expiry Date</label> <input type="text" class="form-control datepicker" id="medical_ins_exp_date" name="medical_ins_exp_date" value="{{ old('medical_ins_exp_date',$employee[0]->medical_ins_exp_date) }}" >
                          </div>
                         </div>
                       </div>

                        <div class="col-lg-10 mt-3">
                         <div class="input-group form-control-lg">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="material-icons">face</i>
                            </span>
                          </div>
                          <div class="form-group">
                            <label for="" class="bmd-label-floating">Visa Company Name (required)</label>
  <input type="text" class="form-control" id="visa_company_name" name="visa_company_name" value="{{ old('visa_company_name',$employee[0]->visa_company_name) }}" required>
                             @include('alerts.feedback', ['field' => 'visa_company_name'])
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
                <button type="submit"  class="btn btn-finish btn-fill btn-rose btn-wd" name="finish" value="Finish">{{ __('Update Employee') }}</button>

              </div>
              <div class="clearfix"></div>
            </div>
          </form>
        </div>
      </div>
      <!-- wizard container -->
    </div>
  </div>
</div>


@endsection

@push('js')
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/intlTelInput.min.js"></script>
 
  <script>

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
 
    $(document).ready(function() {
      // initialise Datetimepicker and Sliders
      md.initFormExtendedDatetimepickers();
 });

function format(item, state) {
  if (!item.id) {
    return item.text;
  }
   var countryUrl = "../material/flags/small/";
  var stateUrl = "https://oxguy3.github.io/flags/svg/us/";
  var url = state ? stateUrl : countryUrl;
  var img = $("<img>", {
    class: "img-flag",
    width: 26,
    src: url + item.element.value.toLowerCase() + ".png"
  });
  var span = $("<span>", {
    text: " " + item.text
  });
  span.prepend(img);
  return span;
}

$(document).ready(function() {
  $("#nationality").select2({
    templateResult: function(item) {
      return format(item, false);
    }
  });
  
});

$(document).ready(function() {

  $("#codes").select2({
   
  });

});

onload =function(){ 
  var ele = document.querySelectorAll('.mobile_number')[0];
  ele.onkeypress = function(e) {
     if(isNaN(this.value+""+String.fromCharCode(e.charCode)))
        return false;
  }
  ele.onpaste = function(e){
     e.preventDefault();
  }
}

</script>
@endpush
