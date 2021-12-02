<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css">


<style>
#email-error {
    height: 30px;
    margin-left: 0px !important;
}
</style>



<?php $__env->startSection('content'); ?>
<div class="content">
  <div class="container-fluid">
    <div class="col-md-12 col-12 mr-auto ml-auto">
      <!--      Wizard container        -->
      <div class="wizard-container">
        <div class="card card-wizard" data-color="rose" id="wizardProfile">
           <form method="post" enctype="multipart/form-data" action="<?php echo e(route('employee.store')); ?>" autocomplete="off" class="form-horizontal">
            <?php echo csrf_field(); ?>
            <?php echo method_field('post'); ?>
            <div class="card-header text-center">
              <h3 class="card-title">
                Build Employee Profile
              </h3>
              <h5 class="card-description">This information will let us know more about employee.</h5>
               <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="<?php echo e(route('employee.index')); ?>" class="btn btn-sm btn-rose"><?php echo e(__('Back to list')); ?></a>
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
                          <input type="text" class="form-control" id="" name="employee_id" value="<?php echo e(old('employee_id')); ?>" required>
                           <?php echo $__env->make('alerts.feedback', ['field' => 'employee_id'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                          <input type="text" class="form-control" id="" name="first_name" value="<?php echo e(old('first_name')); ?>" required>
                           <?php echo $__env->make('alerts.feedback', ['field' => 'first_name'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                          <label for="" class="bmd-label-floating">Middle Name</label>
                          <input type="text" class="form-control" id="" name="middle_name" value="<?php echo e(old('middle_name')); ?>" >
                          
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
                          <input type="text" class="form-control" id="" name="surname" value="<?php echo e(old('surname')); ?>" required>
                            <?php echo $__env->make('alerts.feedback', ['field' => 'surname'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                          
                           <select class="form-control" id="nationality" name="nationality" value="<?php echo e(old('nationality')); ?>">
                            <option value="Afghanistan" id="AF" data-capital="Kabul">Afghanistan</option>
                          
                            <option value="Albania" id="AL" data-capital="Tirana">Albania</option>
                            <option value="Algeria" id="DZ" data-capital="Algiers">Algeria</option>
                            <option value="American Samoa" id='AS' data-capital="Pago Pago">American Samoa</option>
                            <option value="Andorra" id='AD' data-capital="Andorra la Vella">Andorra</option>
                            <option value="Angola" id='AO' data-capital="Luanda">Angola</option>
                            <option value="Anguilla" id='AI' data-capital="The Valley">Anguilla</option>
                            <option value="Antigua and Barbuda" id='AG' data-capital="St. John's">Antigua and Barbuda</option>
                            <option value="Argentina" id='AR' data-capital="Buenos Aires">Argentina</option>
                            <option value="Armenia" id='AM' data-capital="Yerevan">Armenia</option>
                            <option value="Aruba" id='AW' data-capital="Oranjestad">Aruba</option>
                            <option value="Australia" id='AU' data-capital="Canberra">Australia</option>
                            <option value="Austria" id='AT' data-capital="Vienna">Austria</option>
                            <option value="Azerbaijan" id='AZ' data-capital="Baku">Azerbaijan</option>
                            <option value="Bahamas" id='BS' data-capital="Nassau">Bahamas</option>
                            <option value="Bahrain" id='BH' data-capital="Manama">Bahrain</option>
                            <option value="Bangladesh" id='BD' data-capital="Dhaka">Bangladesh</option>
                            <option value="Barbados" id='BB' data-capital="Bridgetown">Barbados</option>
                            <option value="Belarus" id='BY' data-capital="Minsk">Belarus</option>
                            <option value="Belgium" id='BE' data-capital="Brussels">Belgium</option>
                            <option value="Belize" id='BZ' data-capital="Belmopan">Belize</option>
                            <option value="Benin" id='BJ' data-capital="Porto-Novo">Benin</option>
                            <option value="Bermuda" id='BM' data-capital="Hamilton">Bermuda</option>
                            <option value="Bhutan" id='BT' data-capital="Thimphu">Bhutan</option>
                            <option value="Bolivia" id='BO' data-capital="Sucre">Bolivia</option>
                            <option value="Bonaire, Sint Eustatius and Saba" data-capital="Kralendijk">Bonaire, Sint Eustatius and Saba</option>
                            <option value="Bosnia and Herzegovina" id='BA' data-capital="Sarajevo">Bosnia and Herzegovina</option>
                            <option value="Botswana" id='BW' data-capital="Gaborone">Botswana</option>
                            <option value="Brazil" id='BR' data-capital="Brasília">Brazil</option>
                            <option value="British Indian Ocean Territory" id='IO' data-capital="Diego Garcia">British Indian Ocean Territory</option>
                            <option value="Brunei Darussalam" id='BN' data-capital="Bandar Seri Begawan">Brunei Darussalam</option>
                            <option value="Bulgaria" id='BG' data-capital="Sofia">Bulgaria</option>
                            <option value="Burkina Faso" id='BF' data-capital="Ouagadougou">Burkina Faso</option>
                            <option value="Burundi" id='BI' data-capital="Bujumbura">Burundi</option>
                            <option value="Cabo Verde" data-capital="Praia">Cabo Verde</option>
                            <option value="Cambodia" id='KH' data-capital="Phnom Penh">Cambodia</option>
                            <option value="Cameroon" id='CM' data-capital="Yaoundé">Cameroon</option>
                            <option value="Canada" id='CA' data-capital="Ottawa">Canada</option>
                            <option value="Cayman Islands" id='KY' data-capital="George Town">Cayman Islands</option>
                            <option value="Central African Republic" id='CF' data-capital="Bangui">Central African Republic</option>
                            <option value="Chad" id='TD' data-capital="N'Djamena">Chad</option>
                            <option value="Chile" id='CL' data-capital="Santiago">Chile</option>
                            <option value="China" id='CN' data-capital="Beijing">China</option>
                            <option value="Christmas Island" id='CX' data-capital="Flying Fish Cove">Christmas Island</option>
                            <option value="Cocos (Keeling) Islands" id='CC' data-capital="West Island">Cocos (Keeling) Islands</option>
                            <option value="Colombia" id='CO' data-capital="Bogotá">Colombia</option>
                            <option value="Comoros" id='KM' data-capital="Moroni">Comoros</option>
                            <option value="Cook Islands" id='CK' data-capital="Avarua">Cook Islands</option>
                            <option value="Costa Rica" id='CR' data-capital="San José">Costa Rica</option>
                            <option value="Croatia"  id='HR' data-capital="Zagreb">Croatia</option>
                            <option value="Cuba" id='CU' data-capital="Havana">Cuba</option>
                            <option value="Curaçao" data-capital="Willemstad">Curaçao</option>
                            <option value="Cyprus" id='CY' data-capital="Nicosia">Cyprus</option>
                            <option value="Czech Republic" id='CZ' data-capital="Prague">Czech Republic</option>
                            <option value="Côte d'Ivoire" id='CI' data-capital="Yamoussoukro">Côte d'Ivoire</option>
                            <option value="Democratic Republic of the Congo" id='CD' data-capital="Kinshasa">Democratic Republic of the Congo</option>
                            <option value="Denmark" id='DK' data-capital="Copenhagen">Denmark</option>
                            <option value="Djibouti" id= 'DJ' data-capital="Djibouti">Djibouti</option>
                            <option value="Dominica" id= 'DM' data-capital="Roseau">Dominica</option>
                            <option value="Dominican Republic" id= 'DO' data-capital="Santo Domingo">Dominican Republic</option>
                            <option value="Ecuador" id= 'EC' data-capital="Quito">Ecuador</option>
                            <option value="Egypt" id= 'EG' data-capital="Cairo">Egypt</option>
                            <option value="El Salvador" id: 'SV' data-capital="San Salvador">El Salvador</option>
                            <option value="Equatorial Guinea" id: 'GQ' data-capital="Malabo">Equatorial Guinea</option>
                            <option value="Eritrea" id: 'ER' data-capital="Asmara">Eritrea</option>
                            <option value="Estonia" id: 'EE' data-capital="Tallinn">Estonia</option>
                            <option value="Ethiopia" id: 'ET' data-capital="Addis Ababa">Ethiopia</option>
                            <option value="Falkland Islands" id: 'FK' data-capital="Stanley">Falkland Islands</option>
                            <option value="Faroe Islands" id: 'FO' data-capital="Tórshavn">Faroe Islands</option>
                            <option value="Federated States of Micronesia" data-capital="Palikir">Federated States of Micronesia</option>
                            <option value="Fiji" id: 'FJ' data-capital="Suva">Fiji</option>
                            <option value="Finland" id: 'FI' data-capital="Helsinki">Finland</option>
                            <option value="Former Yugoslav Republic of Macedonia" data-capital="Skopje">Former Yugoslav Republic of Macedonia</option>
                            <option value="France" id: 'FR' data-capital="Paris">France</option>
                            <option value="French Guiana" id: 'GF' data-capital="Cayenne">French Guiana</option>
                            <option value="French Polynesia" id: 'PF' data-capital="Papeete">French Polynesia</option>
                            <option value="French Southern Territories" id: 'TF' data-capital="Saint-Pierre, Réunion">French Southern Territories</option>
                            <option value="Gabon" id: 'GA' data-capital="Libreville">Gabon</option>
                            <option value="Gambia" id: 'GM' data-capital="Banjul">Gambia</option>
                            <option value="Georgia" id: 'GE' data-capital="Tbilisi">Georgia</option>
                            <option value="Germany" id: 'DE' data-capital="Berlin">Germany</option>
                            <option value="Ghana" id: 'GH' data-capital="Accra">Ghana</option>
                            <option value="Gibraltar" id: 'GI' data-capital="Gibraltar">Gibraltar</option>
                            <option value="Greece" id: 'GR' data-capital="Athens">Greece</option>
                            <option value="Greenland" id: 'GL' data-capital="Nuuk">Greenland</option>
                            <option value="Grenada" id: 'GD' data-capital="St. George's">Grenada</option>
                            <option value="Guadeloupe" id: 'GP' data-capital="Basse-Terre">Guadeloupe</option>
                            <option value="Guam" id: 'GU' data-capital="Hagåtña">Guam</option>
                            <option value="Guatemala" id: 'GT' data-capital="Guatemala City">Guatemala</option>
                            <option value="Guernsey" id: 'GG' data-capital="Saint Peter Port">Guernsey</option>
                            <option value="Guinea" id: 'GN' data-capital="Conakry">Guinea</option>
                            <option value="Guinea-Bissau" data-capital="Bissau">Guinea-Bissau</option>
                            <option value="Guyana" data-capital="Georgetown">Guyana</option>
                            <option value="Haiti" data-capital="Port-au-Prince">Haiti</option>
                            <option value="Holy See" data-capital="Vatican City">Holy See</option>
                            <option value="Honduras" data-capital="Tegucigalpa">Honduras</option>
                            <option value="Hong Kong" data-capital="Hong Kong">Hong Kong</option>
                            <option value="Hungary" data-capital="Budapest">Hungary</option>
                            <option value="Iceland" data-capital="Reykjavik">Iceland</option>
                            <option value="India" data-capital="New Delhi">India</option>
                            <option value="Indonesia" data-capital="Jakarta">Indonesia</option>
                            <option value="Iran" data-capital="Tehran">Iran</option>
                            <option value="Iraq" data-capital="Baghdad">Iraq</option>
                            <option value="Ireland" data-capital="Dublin">Ireland</option>
                            <option value="Isle of Man" data-capital="Douglas">Isle of Man</option>
                            <option value="Israel" data-capital="Jerusalem">Israel</option>
                            <option value="Italy" data-capital="Rome">Italy</option>
                            <option value="Jamaica" data-capital="Kingston">Jamaica</option>
                            <option value="Japan" data-capital="Tokyo">Japan</option>
                            <option value="Jersey" data-capital="Saint Helier">Jersey</option>
                            <option value="Jordan" data-capital="Amman">Jordan</option>
                            <option value="Kazakhstan" data-capital="Astana">Kazakhstan</option>
                            <option value="Kenya" data-capital="Nairobi">Kenya</option>
                            <option value="Kiribati" data-capital="South Tarawa">Kiribati</option>
                            <option value="Kuwait" data-capital="Kuwait City">Kuwait</option>
                            <option value="Kyrgyzstan" data-capital="Bishkek">Kyrgyzstan</option>
                            <option value="Laos" data-capital="Vientiane">Laos</option>
                            <option value="Latvia" data-capital="Riga">Latvia</option>
                            <option value="Lebanon" data-capital="Beirut">Lebanon</option>
                            <option value="Lesotho" data-capital="Maseru">Lesotho</option>
                            <option value="Liberia" data-capital="Monrovia">Liberia</option>
                            <option value="Libya" data-capital="Tripoli">Libya</option>
                            <option value="Liechtenstein" data-capital="Vaduz">Liechtenstein</option>
                            <option value="Lithuania" data-capital="Vilnius">Lithuania</option>
                            <option value="Luxembourg" data-capital="Luxembourg City">Luxembourg</option>
                            <option value="Macau" data-capital="Macau">Macau</option>
                            <option value="Madagascar" data-capital="Antananarivo">Madagascar</option>
                            <option value="Malawi" data-capital="Lilongwe">Malawi</option>
                            <option value="Malaysia" data-capital="Kuala Lumpur">Malaysia</option>
                            <option value="Maldives" data-capital="Malé">Maldives</option>
                            <option value="Mali" data-capital="Bamako">Mali</option>
                            <option value="Malta" data-capital="Valletta">Malta</option>
                            <option value="Marshall Islands" data-capital="Majuro">Marshall Islands</option>
                            <option value="Martinique" data-capital="Fort-de-France">Martinique</option>
                            <option value="Mauritania" data-capital="Nouakchott">Mauritania</option>
                            <option value="Mauritius" data-capital="Port Louis">Mauritius</option>
                            <option value="Mayotte" data-capital="Mamoudzou">Mayotte</option>
                            <option value="Mexico" data-capital="Mexico City">Mexico</option>
                            <option value="Moldova" data-capital="Chișinău">Moldova</option>
                            <option value="Monaco" data-capital="Monaco">Monaco</option>
                            <option value="Mongolia" data-capital="Ulaanbaatar">Mongolia</option>
                            <option value="Montenegro" data-capital="Podgorica">Montenegro</option>
                            <option value="Montserrat" data-capital="Little Bay, Brades, Plymouth">Montserrat</option>
                            <option value="Morocco" data-capital="Rabat">Morocco</option>
                            <option value="Mozambique" data-capital="Maputo">Mozambique</option>
                            <option value="Myanmar" data-capital="Naypyidaw">Myanmar</option>
                            <option value="Namibia" data-capital="Windhoek">Namibia</option>
                            <option value="Nauru" data-capital="Yaren District">Nauru</option>
                            <option value="Nepal" data-capital="Kathmandu">Nepal</option>
                            <option value="Netherlands" data-capital="Amsterdam">Netherlands</option>
                            <option value="New Caledonia" data-capital="Nouméa">New Caledonia</option>
                            <option value="New Zealand" data-capital="Wellington">New Zealand</option>
                            <option value="Nicaragua" data-capital="Managua">Nicaragua</option>
                            <option value="Niger" data-capital="Niamey">Niger</option>
                            <option value="Nigeria" data-capital="Abuja">Nigeria</option>
                            <option value="Niue" data-capital="Alofi">Niue</option>
                            <option value="Norfolk Island" data-capital="Kingston">Norfolk Island</option>
                            <option value="North Korea" data-capital="Pyongyang">North Korea</option>
                            <option value="Northern Mariana Islands" data-capital="Capitol Hill">Northern Mariana Islands</option>
                            <option value="Norway" data-capital="Oslo">Norway</option>
                            <option value="Oman" data-capital="Muscat">Oman</option>
                            <option value="Pakistan" data-capital="Islamabad">Pakistan</option>
                            <option value="Palau" data-capital="Ngerulmud">Palau</option>
                            <option value="Panama" data-capital="Panama City">Panama</option>
                            <option value="Papua New Guinea" data-capital="Port Moresby">Papua New Guinea</option>
                            <option value="Paraguay" data-capital="Asunción">Paraguay</option>
                            <option value="Peru" data-capital="Lima">Peru</option>
                            <option value="Philippines" data-capital="Manila">Philippines</option>
                            <option value="Pitcairn" data-capital="Adamstown">Pitcairn</option>
                            <option value="Poland" data-capital="Warsaw">Poland</option>
                            <option value="Portugal" data-capital="Lisbon">Portugal</option>
                            <option value="Puerto Rico" data-capital="San Juan">Puerto Rico</option>
                            <option value="Qatar" data-capital="Doha">Qatar</option>
                            <option value="Republic of the Congo" data-capital="Brazzaville">Republic of the Congo</option>
                            <option value="Romania" data-capital="Bucharest">Romania</option>
                            <option value="Russia" data-capital="Moscow">Russia</option>
                            <option value="Rwanda" data-capital="Kigali">Rwanda</option>
                            <option value="Réunion" data-capital="Saint-Denis">Réunion</option>
                            <option value="Saint Barthélemy" data-capital="Gustavia">Saint Barthélemy</option>
                            <option value="Saint Helena, Ascension and Tristan da Cunha" data-capital="Jamestown">Saint Helena, Ascension and Tristan da Cunha</option>
                            <option value="Saint Kitts and Nevis" data-capital="Basseterre">Saint Kitts and Nevis</option>
                            <option value="Saint Lucia" data-capital="Castries">Saint Lucia</option>
                            <option value="Saint Martin" data-capital="Marigot">Saint Martin</option>
                            <option value="Saint Pierre and Miquelon" data-capital="Saint-Pierre">Saint Pierre and Miquelon</option>
                            <option value="Saint Vincent and the Grenadines" data-capital="Kingstown">Saint Vincent and the Grenadines</option>
                            <option value="Samoa" data-capital="Apia">Samoa</option>
                            <option value="San Marino" data-capital="San Marino">San Marino</option>
                            <option value="Sao Tome and Principe" data-capital="São Tomé">Sao Tome and Principe</option>
                            <option value="Saudi Arabia" data-capital="Riyadh">Saudi Arabia</option>
                            <option value="Senegal" data-capital="Dakar">Senegal</option>
                            <option value="Serbia" data-capital="Belgrade">Serbia</option>
                            <option value="Seychelles" data-capital="Victoria">Seychelles</option>
                            <option value="Sierra Leone" data-capital="Freetown">Sierra Leone</option>
                            <option value="Singapore" data-capital="Singapore">Singapore</option>
                            <option value="Sint Maarten" data-capital="Philipsburg">Sint Maarten</option>
                            <option value="Slovakia" data-capital="Bratislava">Slovakia</option>
                            <option value="Slovenia" data-capital="Ljubljana">Slovenia</option>
                            <option value="Solomon Islands" data-capital="Honiara">Solomon Islands</option>
                            <option value="Somalia" data-capital="Mogadishu">Somalia</option>
                            <option value="South Africa" data-capital="Pretoria">South Africa</option>
                            <option value="South Georgia and the South Sandwich Island" data-capital="King Edward Point">South Georgia and the South Sandwich Islands</option>
                            <option value="South Korea" data-capital="Seoul">South Korea</option>
                            <option value="South Sudan" data-capital="Juba">South Sudan</option>
                            <option value="Spain" data-capital="Madrid">Spain</option>
                            <option value="Sri Lanka" data-capital="Sri Jayawardenepura Kotte, Colombo">Sri Lanka</option>
                            <option value="State of Palestine" data-capital="Ramallah">State of Palestine</option>
                            <option value="Sudan" data-capital="Khartoum">Sudan</option>
                            <option value="Suriname" data-capital="Paramaribo">Suriname</option>
                            <option value="Svalbard and Jan Mayen" data-capital="Longyearbyen">Svalbard and Jan Mayen</option>
                            <option value="Swaziland" data-capital="Lobamba, Mbabane">Swaziland</option>
                            <option value="Sweden" data-capital="Stockholm">Sweden</option>
                            <option value="Switzerland" data-capital="Bern">Switzerland</option>
                            <option value="Syrian Arab Republic" data-capital="Damascus">Syrian Arab Republic</option>
                            <option value="Taiwan" data-capital="Taipei">Taiwan</option>
                            <option value="Tajikistan" data-capital="Dushanbe">Tajikistan</option>
                            <option value="Tanzania" data-capital="Dodoma">Tanzania</option>
                            <option value="Thailand" data-capital="Bangkok">Thailand</option>
                            <option value="Timor-Leste" data-capital="Dili">Timor-Leste</option>
                            <option value="Togo" data-capital="Lomé">Togo</option>
                            <option value="Tokelau" data-capital="Nukunonu, Atafu,Tokelau">Tokelau</option>
                            <option value="Tonga" data-capital="Nukuʻalofa">Tonga</option>
                            <option value="Trinidad and Tobago" data-capital="Port of Spain">Trinidad and Tobago</option>
                            <option value="Tunisia" data-capital="Tunis">Tunisia</option>
                            <option value="Turkey" data-capital="Ankara">Turkey</option>
                            <option value="Turkmenistan" data-capital="Ashgabat">Turkmenistan</option>
                            <option value="Turks and Caicos Islands" data-capital="Cockburn Town">Turks and Caicos Islands</option>
                            <option value="Tuvalu" data-capital="Funafuti">Tuvalu</option>
                            <option value="Uganda" data-capital="Kampala">Uganda</option>
                            <option value="Ukraine" data-capital="Kiev">Ukraine</option>
                            <option value="United Arab Emirates" data-capital="Abu Dhabi">United Arab Emirates</option>
                            <option value="United Kingdom" data-capital="London">United Kingdom</option>
                            <option value="United States Minor Outlying Islands" data-capital="Washington, D.C.">United States Minor Outlying Islands</option>
                            <option value="United States of America" data-capital="Washington, D.C.">United States of America</option>
                            <option value="Uruguay" data-capital="Montevideo">Uruguay</option>
                            <option value="Uzbekistan" data-capital="Tashkent">Uzbekistan</option>
                            <option value="Vanuatu" data-capital="Port Vila">Vanuatu</option>
                            <option value="Venezuela" data-capital="Caracas">Venezuela</option>
                            <option value="Vietnam" data-capital="Hanoi">Vietnam</option>
                            <option value="Virgin Islands (British)" data-capital="Road Town">Virgin Islands (British)</option>
                            <option value="Virgin Islands (U.S.)" data-capital="Charlotte Amalie">Virgin Islands (U.S.)</option>
                            <option value="Wallis and Futuna" data-capital="Mata-Utu">Wallis and Futuna</option>
                            <option value="Western Sahara" data-capital="Laayoune">Western Sahara</option>
                            <option value="Yemen" data-capital="Sana'a">Yemen</option>
                            <option value="Zambia" data-capital="Lusaka">Zambia</option>
                            <option value="Zimbabwe" data-capital="Harare">Zimbabwe</option>
                          </select>
    
                    <?php echo $__env->make('alerts.feedback', ['field' => 'Nationality'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>      
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
                          <input type="email" class="form-control" id="" name="email" value="<?php echo e(old('email')); ?>" required>
                           <?php echo $__env->make('alerts.feedback', ['field' => 'email'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                           
                         <select name="codes" id="codes" value="<?php echo e(old('codes')); ?>" required>
              
                    		<option data-countryCode="DZ" value="213">Algeria (+213)</option>
                    		<option data-countryCode="AD" value="376">Andorra (+376)</option>
                    		<option data-countryCode="AO" value="244">Angola (+244)</option>
                    		<option data-countryCode="AI" value="1264">Anguilla (+1264)</option>
                    		<option data-countryCode="AG" value="1268">Antigua &amp; Barbuda (+1268)</option>
                    		<option data-countryCode="AR" value="54">Argentina (+54)</option>
                    		<option data-countryCode="AM" value="374">Armenia (+374)</option>
                    		<option data-countryCode="AW" value="297">Aruba (+297)</option>
                    		<option data-countryCode="AU" value="61">Australia (+61)</option>
                    		<option data-countryCode="AT" value="43">Austria (+43)</option>
                    		<option data-countryCode="AZ" value="994">Azerbaijan (+994)</option>
                    		<option data-countryCode="BS" value="1242">Bahamas (+1242)</option>
                    		<option data-countryCode="BH" value="973">Bahrain (+973)</option>
                    		<option data-countryCode="BD" value="880">Bangladesh (+880)</option>
                    		<option data-countryCode="BB" value="1246">Barbados (+1246)</option>
                    		<option data-countryCode="BY" value="375">Belarus (+375)</option>
                    		<option data-countryCode="BE" value="32">Belgium (+32)</option>
                    		<option data-countryCode="BZ" value="501">Belize (+501)</option>
                    		<option data-countryCode="BJ" value="229">Benin (+229)</option>
                    		<option data-countryCode="BM" value="1441">Bermuda (+1441)</option>
                    		<option data-countryCode="BT" value="975">Bhutan (+975)</option>
                    		<option data-countryCode="BO" value="591">Bolivia (+591)</option>
                    		<option data-countryCode="BA" value="387">Bosnia Herzegovina (+387)</option>
                    		<option data-countryCode="BW" value="267">Botswana (+267)</option>
                    		<option data-countryCode="BR" value="55">Brazil (+55)</option>
                    		<option data-countryCode="BN" value="673">Brunei (+673)</option>
                    		<option data-countryCode="BG" value="359">Bulgaria (+359)</option>
                    		<option data-countryCode="BF" value="226">Burkina Faso (+226)</option>
                    		<option data-countryCode="BI" value="257">Burundi (+257)</option>
                    		<option data-countryCode="KH" value="855">Cambodia (+855)</option>
                    		<option data-countryCode="CM" value="237">Cameroon (+237)</option>
                    		<option data-countryCode="CA" value="1">Canada (+1)</option>
                    		<option data-countryCode="CV" value="238">Cape Verde Islands (+238)</option>
                    		<option data-countryCode="KY" value="1345">Cayman Islands (+1345)</option>
                    		<option data-countryCode="CF" value="236">Central African Republic (+236)</option>
                    		<option data-countryCode="CL" value="56">Chile (+56)</option>
                    		<option data-countryCode="CN" value="86">China (+86)</option>
                    		<option data-countryCode="CO" value="57">Colombia (+57)</option>
                    		<option data-countryCode="KM" value="269">Comoros (+269)</option>
                    		<option data-countryCode="CG" value="242">Congo (+242)</option>
                    		<option data-countryCode="CK" value="682">Cook Islands (+682)</option>
                    		<option data-countryCode="CR" value="506">Costa Rica (+506)</option>
                    		<option data-countryCode="HR" value="385">Croatia (+385)</option>
                    		<option data-countryCode="CU" value="53">Cuba (+53)</option>
                    		<option data-countryCode="CY" value="90392">Cyprus North (+90392)</option>
                    		<option data-countryCode="CY" value="357">Cyprus South (+357)</option>
                    		<option data-countryCode="CZ" value="42">Czech Republic (+42)</option>
                    		<option data-countryCode="DK" value="45">Denmark (+45)</option>
                    		<option data-countryCode="DJ" value="253">Djibouti (+253)</option>
                    		<option data-countryCode="DM" value="1809">Dominica (+1809)</option>
                    		<option data-countryCode="DO" value="1809">Dominican Republic (+1809)</option>
                    		<option data-countryCode="EC" value="593">Ecuador (+593)</option>
                    		<option data-countryCode="EG" value="20">Egypt (+20)</option>
                    		<option data-countryCode="SV" value="503">El Salvador (+503)</option>
                    		<option data-countryCode="GQ" value="240">Equatorial Guinea (+240)</option>
                    		<option data-countryCode="ER" value="291">Eritrea (+291)</option>
                    		<option data-countryCode="EE" value="372">Estonia (+372)</option>
                    		<option data-countryCode="ET" value="251">Ethiopia (+251)</option>
                    		<option data-countryCode="FK" value="500">Falkland Islands (+500)</option>
                    		<option data-countryCode="FO" value="298">Faroe Islands (+298)</option>
                    		<option data-countryCode="FJ" value="679">Fiji (+679)</option>
                    		<option data-countryCode="FI" value="358">Finland (+358)</option>
                    		<option data-countryCode="FR" value="33">France (+33)</option>
                    		<option data-countryCode="GF" value="594">French Guiana (+594)</option>
                    		<option data-countryCode="PF" value="689">French Polynesia (+689)</option>
                    		<option data-countryCode="GA" value="241">Gabon (+241)</option>
                    		<option data-countryCode="GM" value="220">Gambia (+220)</option>
                    		<option data-countryCode="GE" value="7880">Georgia (+7880)</option>
                    		<option data-countryCode="DE" value="49">Germany (+49)</option>
                    		<option data-countryCode="GH" value="233">Ghana (+233)</option>
                    		<option data-countryCode="GI" value="350">Gibraltar (+350)</option>
                    		<option data-countryCode="GR" value="30">Greece (+30)</option>
                    		<option data-countryCode="GL" value="299">Greenland (+299)</option>
                    		<option data-countryCode="GD" value="1473">Grenada (+1473)</option>
                    		<option data-countryCode="GP" value="590">Guadeloupe (+590)</option>
                    		<option data-countryCode="GU" value="671">Guam (+671)</option>
                    		<option data-countryCode="GT" value="502">Guatemala (+502)</option>
                    		<option data-countryCode="GN" value="224">Guinea (+224)</option>
                    		<option data-countryCode="GW" value="245">Guinea - Bissau (+245)</option>
                    		<option data-countryCode="GY" value="592">Guyana (+592)</option>
                    		<option data-countryCode="HT" value="509">Haiti (+509)</option>
                    		<option data-countryCode="HN" value="504">Honduras (+504)</option>
                    		<option data-countryCode="HK" value="852">Hong Kong (+852)</option>
                    		<option data-countryCode="HU" value="36">Hungary (+36)</option>
                    		<option data-countryCode="IS" value="354">Iceland (+354)</option>
                    		<option data-countryCode="IN" value="91">India (+91)</option>
                    		<option data-countryCode="ID" value="62">Indonesia (+62)</option>
                    		<option data-countryCode="IR" value="98">Iran (+98)</option>
                    		<option data-countryCode="IQ" value="964">Iraq (+964)</option>
                    		<option data-countryCode="IE" value="353">Ireland (+353)</option>
                    		<option data-countryCode="IL" value="972">Israel (+972)</option>
                    		<option data-countryCode="IT" value="39">Italy (+39)</option>
                    		<option data-countryCode="JM" value="1876">Jamaica (+1876)</option>
                    		<option data-countryCode="JP" value="81">Japan (+81)</option>
                    		<option data-countryCode="JO" value="962">Jordan (+962)</option>
                    		<option data-countryCode="KZ" value="7">Kazakhstan (+7)</option>
                    		<option data-countryCode="KE" value="254">Kenya (+254)</option>
                    		<option data-countryCode="KI" value="686">Kiribati (+686)</option>
                    		<option data-countryCode="KP" value="850">Korea North (+850)</option>
                    		<option data-countryCode="KR" value="82">Korea South (+82)</option>
                    		<option data-countryCode="KW" value="965">Kuwait (+965)</option>
                    		<option data-countryCode="KG" value="996">Kyrgyzstan (+996)</option>
                    		<option data-countryCode="LA" value="856">Laos (+856)</option>
                    		<option data-countryCode="LV" value="371">Latvia (+371)</option>
                    		<option data-countryCode="LB" value="961">Lebanon (+961)</option>
                    		<option data-countryCode="LS" value="266">Lesotho (+266)</option>
                    		<option data-countryCode="LR" value="231">Liberia (+231)</option>
                    		<option data-countryCode="LY" value="218">Libya (+218)</option>
                    		<option data-countryCode="LI" value="417">Liechtenstein (+417)</option>
                    		<option data-countryCode="LT" value="370">Lithuania (+370)</option>
                    		<option data-countryCode="LU" value="352">Luxembourg (+352)</option>
                    		<option data-countryCode="MO" value="853">Macao (+853)</option>
                    		<option data-countryCode="MK" value="389">Macedonia (+389)</option>
                    		<option data-countryCode="MG" value="261">Madagascar (+261)</option>
                    		<option data-countryCode="MW" value="265">Malawi (+265)</option>
                    		<option data-countryCode="MY" value="60">Malaysia (+60)</option>
                    		<option data-countryCode="MV" value="960">Maldives (+960)</option>
                    		<option data-countryCode="ML" value="223">Mali (+223)</option>
                    		<option data-countryCode="MT" value="356">Malta (+356)</option>
                    		<option data-countryCode="MH" value="692">Marshall Islands (+692)</option>
                    		<option data-countryCode="MQ" value="596">Martinique (+596)</option>
                    		<option data-countryCode="MR" value="222">Mauritania (+222)</option>
                    		<option data-countryCode="YT" value="269">Mayotte (+269)</option>
                    		<option data-countryCode="MX" value="52">Mexico (+52)</option>
                    		<option data-countryCode="FM" value="691">Micronesia (+691)</option>
                    		<option data-countryCode="MD" value="373">Moldova (+373)</option>
                    		<option data-countryCode="MC" value="377">Monaco (+377)</option>
                    		<option data-countryCode="MN" value="976">Mongolia (+976)</option>
                    		<option data-countryCode="MS" value="1664">Montserrat (+1664)</option>
                    		<option data-countryCode="MA" value="212">Morocco (+212)</option>
                    		<option data-countryCode="MZ" value="258">Mozambique (+258)</option>
                    		<option data-countryCode="MN" value="95">Myanmar (+95)</option>
                    		<option data-countryCode="NA" value="264">Namibia (+264)</option>
                    		<option data-countryCode="NR" value="674">Nauru (+674)</option>
                    		<option data-countryCode="NP" value="977">Nepal (+977)</option>
                    		<option data-countryCode="NL" value="31">Netherlands (+31)</option>
                    		<option data-countryCode="NC" value="687">New Caledonia (+687)</option>
                    		<option data-countryCode="NZ" value="64">New Zealand (+64)</option>
                    		<option data-countryCode="NI" value="505">Nicaragua (+505)</option>
                    		<option data-countryCode="NE" value="227">Niger (+227)</option>
                    		<option data-countryCode="NG" value="234">Nigeria (+234)</option>
                    		<option data-countryCode="NU" value="683">Niue (+683)</option>
                    		<option data-countryCode="NF" value="672">Norfolk Islands (+672)</option>
                    		<option data-countryCode="NP" value="670">Northern Marianas (+670)</option>
                    		<option data-countryCode="NO" value="47">Norway (+47)</option>
                    		<option data-countryCode="OM" value="968">Oman (+968)</option>
                    		<option data-countryCode="PW" value="680">Palau (+680)</option>
                    		<option data-countryCode="PA" value="507">Panama (+507)</option>
                    		<option data-countryCode="PG" value="675">Papua New Guinea (+675)</option>
                    		<option data-countryCode="PY" value="595">Paraguay (+595)</option>
                    		<option data-countryCode="PE" value="51">Peru (+51)</option>
                    		<option data-countryCode="PH" value="63">Philippines (+63)</option>
                    		<option data-countryCode="PL" value="48">Poland (+48)</option>
                    		<option data-countryCode="PT" value="351">Portugal (+351)</option>
                    		<option data-countryCode="PR" value="1787">Puerto Rico (+1787)</option>
                    		<option data-countryCode="QA" value="974">Qatar (+974)</option>
                    		<option data-countryCode="RE" value="262">Reunion (+262)</option>
                    		<option data-countryCode="RO" value="40">Romania (+40)</option>
                    		<option data-countryCode="RU" value="7">Russia (+7)</option>
                    		<option data-countryCode="RW" value="250">Rwanda (+250)</option>
                    		<option data-countryCode="SM" value="378">San Marino (+378)</option>
                    		<option data-countryCode="ST" value="239">Sao Tome &amp; Principe (+239)</option>
                    		<option data-countryCode="SA" value="966">Saudi Arabia (+966)</option>
                    		<option data-countryCode="SN" value="221">Senegal (+221)</option>
                    		<option data-countryCode="CS" value="381">Serbia (+381)</option>
                    		<option data-countryCode="SC" value="248">Seychelles (+248)</option>
                    		<option data-countryCode="SL" value="232">Sierra Leone (+232)</option>
                    		<option data-countryCode="SG" value="65">Singapore (+65)</option>
                    		<option data-countryCode="SK" value="421">Slovak Republic (+421)</option>
                    		<option data-countryCode="SI" value="386">Slovenia (+386)</option>
                    		<option data-countryCode="SB" value="677">Solomon Islands (+677)</option>
                    		<option data-countryCode="SO" value="252">Somalia (+252)</option>
                    		<option data-countryCode="ZA" value="27">South Africa (+27)</option>
                    		<option data-countryCode="ES" value="34">Spain (+34)</option>
                    		<option data-countryCode="LK" value="94">Sri Lanka (+94)</option>
                    		<option data-countryCode="SH" value="290">St. Helena (+290)</option>
                    		<option data-countryCode="KN" value="1869">St. Kitts (+1869)</option>
                    		<option data-countryCode="SC" value="1758">St. Lucia (+1758)</option>
                    		<option data-countryCode="SD" value="249">Sudan (+249)</option>
                    		<option data-countryCode="SR" value="597">Suriname (+597)</option>
                    		<option data-countryCode="SZ" value="268">Swaziland (+268)</option>
                    		<option data-countryCode="SE" value="46">Sweden (+46)</option>
                    		<option data-countryCode="CH" value="41">Switzerland (+41)</option>
                    		<option data-countryCode="SI" value="963">Syria (+963)</option>
                    		<option data-countryCode="TW" value="886">Taiwan (+886)</option>
                    		<option data-countryCode="TJ" value="7">Tajikstan (+7)</option>
                    		<option data-countryCode="TH" value="66">Thailand (+66)</option>
                    		<option data-countryCode="TG" value="228">Togo (+228)</option>
                    		<option data-countryCode="TO" value="676">Tonga (+676)</option>
                    		<option data-countryCode="TT" value="1868">Trinidad &amp; Tobago (+1868)</option>
                    		<option data-countryCode="TN" value="216">Tunisia (+216)</option>
                    		<option data-countryCode="TR" value="90">Turkey (+90)</option>
                    		<option data-countryCode="TM" value="7">Turkmenistan (+7)</option>
                    		<option data-countryCode="TM" value="993">Turkmenistan (+993)</option>
                    		<option data-countryCode="TC" value="1649">Turks &amp; Caicos Islands (+1649)</option>
                    		<option data-countryCode="TV" value="688">Tuvalu (+688)</option>
                    		<option data-countryCode="UG" value="256">Uganda (+256)</option>
                    		<option data-countryCode="GB" value="44">UK (+44)</option> 
                    		<option data-countryCode="UA" value="380">Ukraine (+380)</option>
                    		<option data-countryCode="AE" value="971">United Arab Emirates (+971)</option>
                    		<option data-countryCode="UY" value="598">Uruguay (+598)</option>
                    		<option data-countryCode="US" value="1">USA (+1)</option>
                    		<option data-countryCode="UZ" value="7">Uzbekistan (+7)</option>
                    		<option data-countryCode="VU" value="678">Vanuatu (+678)</option>
                    		<option data-countryCode="VA" value="379">Vatican City (+379)</option>
                    		<option data-countryCode="VE" value="58">Venezuela (+58)</option>
                    		<option data-countryCode="VN" value="84">Vietnam (+84)</option>
                    		<option data-countryCode="VG" value="84">Virgin Islands - British (+1284)</option>
                    		<option data-countryCode="VI" value="84">Virgin Islands - US (+1340)</option>
                    		<option data-countryCode="WF" value="681">Wallis &amp; Futuna (+681)</option>
                    		<option data-countryCode="YE" value="969">Yemen (North)(+969)</option>
                    		<option data-countryCode="YE" value="967">Yemen (South)(+967)</option>
                    		<option data-countryCode="ZM" value="260">Zambia (+260)</option>
                    		<option data-countryCode="ZW" value="263">Zimbabwe (+263)</option>
                    	
                    	</select>

                		    <input class="mobile_number" placeholder="Phone" value="<?php echo e(old('mobile_number')); ?>" type=text name="mobile_number" required="" />
                		    
                	        <?php echo $__env->make('alerts.feedback', ['field' => 'mobile_number'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                           
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
                           
                                <input type="radio" name="gender" value="male" checked="checked"> Male
      			                <input type="radio" name="gender" value="female"> Female<br>
                              
                            </div>
                           <?php echo $__env->make('alerts.feedback', ['field' => 'gender'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                          <input type="text" class="form-control" id="emirates_id" name="emirates_id" value="<?php echo e(old('emirates_id')); ?>" required>
                           <?php echo $__env->make('alerts.feedback', ['field' => 'emirates_id'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                          <!-- <label for="" class="bmd-label-floating">Designation (required)</label> -->
                         <!--  <input type="text" class="form-control" id="" name="designation" value="<?php echo e(old('designation')); ?>" required>-->

                     <select class="bmd-label-floating form-control<?php echo e($errors->has('leavetype') ? ' is-invalid' : ''); ?>" name="designation" id="input-designation" 
                             value="<?php echo e(old('designation')); ?>" required aria-required="true">
                               <option value="">Select Designation (required)</option>
                               <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $designation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($designation->id); ?>"  <?php if(old('designation') == $designation->id ): ?> selected <?php endif; ?> > <?php echo e($designation->name); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </select>

                         

                           <?php echo $__env->make('alerts.feedback', ['field' => 'designation'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                          <input type="text" class="form-control" id="" name="department" value="<?php echo e(old('department')); ?>" required>
                           <?php echo $__env->make('alerts.feedback', ['field' => 'required'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                          <label for="" class="bmd-label-floating date-height">Joining Date (required)</label>
                          <input type="text" class="form-control datepicker" id="" name="joining_date" value="<?php echo e(old('joining_date')); ?>" required >
                           <?php echo $__env->make('alerts.feedback', ['field' => 'joining_date'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                      </div>
                    </div>

                   <!--  <div class="col-lg-10 mt-3">
                      <div class="input-group form-control-lg">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="material-icons">star_rate</i>
                          </span>
                        </div>
                        <div class="form-group">
                          <label for="" class="bmd-label-floating">Employee_Score</label>
                          <input type="text" class="form-control" id="" name="employee_score" value="<?php echo e(old('employee_score')); ?>" >
                           <?php echo $__env->make('alerts.feedback', ['field' => 'employee_score'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                      </div>
                    </div>
 -->
                  
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
                            <input type="text" class="form-control" id="" name="passport_number" value="<?php echo e(old('passport_number')); ?>" required>
                             <?php echo $__env->make('alerts.feedback', ['field' => 'passport_number'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                            <input type="text" class="form-control datepicker" id="" name="passport_exp_date" value="<?php echo e(old('passport_exp_date')); ?>" required>
                             <?php echo $__env->make('alerts.feedback', ['field' => 'passport_exp_date'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                            <input type="text" class="form-control datepicker" id="" name="visa_exp_date" value="<?php echo e(old('visa_exp_date')); ?>" required>
                             <?php echo $__env->make('alerts.feedback', ['field' => 'visa_exp_date'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                            <label for="" class="bmd-label-floating"> Medical Insurance No.</label>
                            <input type="text" class="form-control " id="" name="medical_ins_no" value="<?php echo e(old('medical_ins_no')); ?>" >

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
                            <label for="" class="bmd-label-floating date-height">Medical Insurance Expiry Date</label>
                            <input type="text" class="form-control datepicker" id="" name="medical_ins_exp_date" value="<?php echo e(old('medical_ins_exp_date')); ?>" >
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
                            <input type="text" class="form-control" id="" name="visa_company_name" value="<?php echo e(old('visa_company_name')); ?>" required>
                             <?php echo $__env->make('alerts.feedback', ['field' => 'visa_company_name'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                <button type="submit"  class="btn btn-finish btn-fill btn-rose btn-wd" name="finish" value="Finish"><?php echo e(__('Add Employee')); ?></button>

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


  <!-- <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" enctype="multipart/form-data" action="<?php echo e(route('employee.store')); ?>" autocomplete="off" class="form-horizontal">
            <?php echo csrf_field(); ?>
            <?php echo method_field('post'); ?>

            <div class="card ">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">person</i>
                </div>
                <h4 class="card-title"><?php echo e(__('Add Employee')); ?></h4>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="<?php echo e(route('employee.index')); ?>" class="btn btn-sm btn-rose"><?php echo e(__('Back to list')); ?></a>
                  </div>
                </div> -->
               <!--  <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Profile photo')); ?></label>
                  <div class="col-sm-7">
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail img-circle">
                        <img src="<?php echo e(asset('material')); ?>/img/placeholder.jpg" alt="...">
                      </div>
                      <div class="fileinput-preview fileinput-exists thumbnail img-circle"></div>
                      <div>
                        <span class="btn btn-rose btn-file ">
                          <span class="fileinput-new"><?php echo e(__('Select image')); ?></span>
                          <span class="fileinput-exists"><?php echo e(__('Change')); ?></span>
                          <input type="file" name="picture" id = "input-picture" />
                        </span>
                          <a href="#pablo" class="btn btn-danger fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> <?php echo e(__('Remove')); ?></a>
                      </div>
                      <?php echo $__env->make('alerts.feedback', ['field' => 'picture'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div> -->

                 <!-- <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Employee ID')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('employee_id') ? ' has-danger' : ''); ?>">
                      <input class="form-control<?php echo e($errors->has('employee_id') ? ' is-invalid' : ''); ?>" name="employee_id" id="input-employee_id" type="text" placeholder="<?php echo e(__('Employee ID')); ?>" value="<?php echo e(old('employee_id')); ?>"  aria-required="true"/>
                      <?php echo $__env->make('alerts.feedback', ['field' => 'employee_id'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('First Name')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('first_name') ? ' has-danger' : ''); ?>">
                      <input class="form-control<?php echo e($errors->has('first_name') ? ' is-invalid' : ''); ?>" name="first_name" id="input-name" type="text" placeholder="<?php echo e(__('First Name')); ?>" value="<?php echo e(old('first_name')); ?>"  aria-required="true"/>
                      <?php echo $__env->make('alerts.feedback', ['field' => 'first_name'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div>

                 <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Middle Name')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('middle_name') ? ' has-danger' : ''); ?>">
                      <input class="form-control<?php echo e($errors->has('middle_name') ? ' is-invalid' : ''); ?>" name="middle_name" id="input-name" type="text" placeholder="<?php echo e(__('Middle Name')); ?>" value="<?php echo e(old('middle_name')); ?>"  aria-required="true"/>
                      <?php echo $__env->make('alerts.feedback', ['field' => 'middle_name'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Surname')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('surname') ? ' has-danger' : ''); ?>">
                      <input class="form-control<?php echo e($errors->has('surname') ? ' is-invalid' : ''); ?>" name="surname" id="input-name" type="text" placeholder="<?php echo e(__('Surname')); ?>" value="<?php echo e(old('surname')); ?>"  aria-required="true"/>
                      <?php echo $__env->make('alerts.feedback', ['field' => 'surname'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Passport Number')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('passport_number') ? ' has-danger' : ''); ?>">
                      <input class="form-control<?php echo e($errors->has('passport_number') ? ' is-invalid' : ''); ?>" name="passport_number" id="input-name" type="text" placeholder="<?php echo e(__('Passport Number')); ?>" value="<?php echo e(old('passport_number')); ?>"  aria-required="true"/>
                      <?php echo $__env->make('alerts.feedback', ['field' => 'passport_number'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div>

                 <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Nationality')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('nationality') ? ' has-danger' : ''); ?>">
                      <input class="form-control<?php echo e($errors->has('nationality') ? ' is-invalid' : ''); ?>" name="nationality" id="input-name" type="text" placeholder="<?php echo e(__('Nationality')); ?>" value="<?php echo e(old('nationality')); ?>"  aria-required="true"/>
                      <?php echo $__env->make('alerts.feedback', ['field' => 'nationality'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div>

                 <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Mobile Number')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('mobile_number') ? ' has-danger' : ''); ?>">
                      <input class="form-control<?php echo e($errors->has('mobile_number') ? ' is-invalid' : ''); ?>" name="mobile_number" id="input-name" type="text" placeholder="<?php echo e(__('Mobile Number')); ?>" value="<?php echo e(old('mobile_number')); ?>"  aria-required="true"/>
                      <?php echo $__env->make('alerts.feedback', ['field' => 'mobile_number'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Email')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('email') ? ' has-danger' : ''); ?>">
                      <input class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" id="input-email" type="email" placeholder="<?php echo e(__('Email')); ?>" value="<?php echo e(old('email')); ?>"  />
                      <?php echo $__env->make('alerts.feedback', ['field' => 'email'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Designation')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('designation') ? ' has-danger' : ''); ?>">
                      <input class="form-control<?php echo e($errors->has('designation') ? ' is-invalid' : ''); ?>" name="designation" id="input-phone" type="text" placeholder="<?php echo e(__('Designation')); ?>" value="<?php echo e(old('designation')); ?>" aria-required="true"/>
                      <?php echo $__env->make('alerts.feedback', ['field' => 'designation'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div>

                 <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Department')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('department') ? ' has-danger' : ''); ?>">
                      <input class="form-control<?php echo e($errors->has('department') ? ' is-invalid' : ''); ?>" name="department" id="input-phone" type="text" placeholder="<?php echo e(__('Department')); ?>" value="<?php echo e(old('department')); ?>" aria-required="true"/>
                      <?php echo $__env->make('alerts.feedback', ['field' => 'department'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div>
                
                 <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Joining Date')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('joining_date') ? ' has-danger' : ''); ?>">
                      <input class="form-control datepicker<?php echo e($errors->has('joining_date') ? ' is-invalid' : ''); ?>" name="joining_date" id="input-joining_date" type="text" placeholder="<?php echo e(__('Joining Date')); ?>" value="<?php echo e(old('joining_date')); ?>"  aria-required="true"/>
                      <?php echo $__env->make('alerts.feedback', ['field' => 'joining_date'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Visa Expiry Date')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('visa_exp_date') ? ' has-danger' : ''); ?>">
                      <input class="form-control datepicker<?php echo e($errors->has('visa_exp_date') ? ' is-invalid' : ''); ?>" name="visa_exp_date" id="input-visa_exp_date" type="text" placeholder="<?php echo e(__('Visa Expiry Date')); ?>" value="<?php echo e(old('visa_exp_date')); ?>"  aria-required="true"/>
                      <?php echo $__env->make('alerts.feedback', ['field' => 'visa_exp_date'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Passport Expiry Date')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('passport_exp_date') ? ' has-danger' : ''); ?>">
                      <input class="form-control datepicker<?php echo e($errors->has('passport_exp_date') ? ' is-invalid' : ''); ?>" name="passport_exp_date" id="input-passport_exp_date" type="text" placeholder="<?php echo e(__('Passport Expiry Date')); ?>" value="<?php echo e(old('passport_exp_date')); ?>"  aria-required="true"/>
                      <?php echo $__env->make('alerts.feedback', ['field' => 'passport_exp_date'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div>

                 <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Medical Insurance No.')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('medical_ins_no') ? ' has-danger' : ''); ?>">
                      <input class="form-control <?php echo e($errors->has('medical_ins_no') ? ' is-invalid' : ''); ?>" name="medical_ins_no" id="input-medical_ins_no" type="text" placeholder="<?php echo e(__('Medical Insurance No.')); ?>" value="<?php echo e(old('medical_ins_no')); ?>"  aria-required="true"/>
                      <?php echo $__env->make('alerts.feedback', ['field' => 'medical_ins_no'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div>

                 <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Medical Insurance Expiry Date')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('medical_ins_exp_date') ? ' has-danger' : ''); ?>">
                      <input class="form-control datepicker <?php echo e($errors->has('medical_ins_exp_date') ? ' is-invalid' : ''); ?>" name="medical_ins_exp_date" id="input-medical_ins_exp_date" type="text" placeholder="<?php echo e(__('Medical Insurance Expiry Date')); ?>" value="<?php echo e(old('medical_ins_exp_date')); ?>"  aria-required="true"/>
                      <?php echo $__env->make('alerts.feedback', ['field' => 'medical_ins_exp_date'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div>

                 <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Visa Company Name')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('visa_company_name') ? ' has-danger' : ''); ?>">
                      <input class="form-control <?php echo e($errors->has('visa_company_name') ? ' is-invalid' : ''); ?>" name="visa_company_name" id="input-visa_company_name" type="text" placeholder="<?php echo e(__('Visa Company Name')); ?>" value="<?php echo e(old('visa_company_name')); ?>"  aria-required="true"/>
                      <?php echo $__env->make('alerts.feedback', ['field' => 'visa_company_name'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div>

                 <div class="row">
                  <label class="col-sm-2 col-form-label"><?php echo e(__('Employee Score')); ?></label>
                  <div class="col-sm-7">
                    <div class="form-group<?php echo e($errors->has('employee_score') ? ' has-danger' : ''); ?>">
                      <input class="form-control <?php echo e($errors->has('employee_score') ? ' is-invalid' : ''); ?>" name="employee_score" id="input-employee_score" type="text" placeholder="<?php echo e(__('Employee Score')); ?>" value="<?php echo e(old('employee_score')); ?>"  aria-required="true"/>
                      <?php echo $__env->make('alerts.feedback', ['field' => 'employee_score'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div>
                
              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-rose"><?php echo e(__('Add Employee')); ?></button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div> -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', ['activePage' => 'employee', 'menuParent' => 'Employee', 'titlePage' => __('Add Employee')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thethethoughtfactory/Desktop/RMS-2-11-21/resources/views/employee/management/create.blade.php ENDPATH**/ ?>