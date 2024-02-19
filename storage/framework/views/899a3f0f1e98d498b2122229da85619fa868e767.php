
<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/libs/select2/dist/css/select2.min.css')); ?>">

    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice{
            background-color: #4798e8;
        }
        .select2-selection--single{
            height: 37px !important;
            border: 1px solid #e9ecef !important;
        }
        span.select2.select2-container.select2-container--default.select2-container {
            width: 100% !important;
        }
        span.select2-selection.select2-selection--single {
            width: 100%;
        }
        select {
            width: 100% !important;
        }
    </style>

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">MY PROFILE & VEHICLE DETAILS</h4>
                <div class="d-flex align-items-center">

                </div>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex no-block justify-content-end align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="<?php echo e(url('home')); ?>">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">MY PROFILE & VEHICLE DETAILS</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card-group">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <form id="edit_instructor">
                                <div id="instrutor-profile-container">
                                        <div class="row">
                                            <div class="col-md-6 small-margin-top-5">
                                                <div class="img-circle img-featured small-width-200px small-margin-auto">
                                                    <?php if( auth()->user()->avatar == ''): ?>
                                                        <img src="<?php echo e(url('assets/images/users/default.png')); ?>" alt="user" class="rounded-circle" width="200">
                                                    <?php else: ?>
                                                        <img src="<?php echo e(url('assets/images/users/'.auth()->user()->avatar)); ?>" alt="user" class="rounded-circle" width="200">
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="row field-wrap text optional instructor_user_instructor_bio">
                                                        <label class="text optional" for="instructor_user_instructor_bio">Instructor bio <i data-toggle="tooltip" class="fa fa-info-circle" title="This is an opportunity to talk about yourself and stand out"></i> </label>

                                                    <div class="input-group">
                                                        <textarea maxlength="1600" rows="8" class="form-control" name="bio" spellcheck="false"> <?php echo e(@$user->user_meta->bio); ?> </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="">
                                                    <label class="" for="instructor_user_language_spoken">Spoken Language(s)</label>
                                                    <div class="input-group">
                                                        <?php
                                                        $lang=[];
                                                        if(@$user->user_meta->language!=""){
                                                            $lang = json_decode(@$user->user_meta->language,true);
                                                        }
                                                        ?>
                                                        <select name="language[]" id="language" multiple="" class="form-control select2">
                                                            <option <?php if( in_array('Afrikaans', $lang) ): ?> selected <?php endif; ?> value="Afrikaans">Afrikaans</option>
                                                            <option <?php if( in_array('Akan', $lang) ): ?> selected <?php endif; ?> value="Akan">Akan</option>
                                                            <option <?php if( in_array('Albanian', $lang) ): ?> selected <?php endif; ?> value="Albanian">Albanian</option>
                                                            <option <?php if( in_array('Amharic', $lang) ): ?> selected <?php endif; ?> value="Amharic">Amharic</option>
                                                            <option <?php if( in_array('Arabic', $lang) ): ?> selected <?php endif; ?> value="Arabic">Arabic</option>
                                                            <option <?php if( in_array('Armenian', $lang) ): ?> selected <?php endif; ?> value="Armenian">Armenian</option>
                                                            <option <?php if( in_array('Assamese', $lang) ): ?> selected <?php endif; ?> value="Assamese">Assamese</option>
                                                            <option <?php if( in_array('Azerbaijani', $lang) ): ?> selected <?php endif; ?> value="Azerbaijani">Azerbaijani</option>
                                                            <option <?php if( in_array('Balochi', $lang) ): ?> selected <?php endif; ?> value="Balochi">Balochi</option>
                                                            <option <?php if( in_array('Basque', $lang) ): ?> selected <?php endif; ?> value="Basque">Basque</option>
                                                            <option <?php if( in_array('Belarusian', $lang) ): ?> selected <?php endif; ?> value="Belarusian">Belarusian</option>
                                                            <option <?php if( in_array('Bengali', $lang) ): ?> selected <?php endif; ?> value="Bengali">Bengali</option>
                                                            <option <?php if( in_array('Bhojpuri', $lang) ): ?> selected <?php endif; ?> value="Bhojpuri">Bhojpuri</option>
                                                            <option <?php if( in_array('Bulgarian', $lang) ): ?> selected <?php endif; ?> value="Bulgarian">Bulgarian</option>
                                                            <option <?php if( in_array('Burmese', $lang) ): ?> selected <?php endif; ?> value="Burmese">Burmese</option>
                                                            <option <?php if( in_array('Cantonese', $lang) ): ?> selected <?php endif; ?> value="Cantonese">Cantonese</option>
                                                            <option <?php if( in_array('Catalan', $lang) ): ?> selected <?php endif; ?> value="Catalan">Catalan</option>
                                                            <option <?php if( in_array('Central', $lang) ): ?> selected <?php endif; ?> value="Central Khmer">Central Khmer</option>
                                                            <option <?php if( in_array('Chaldean', $lang) ): ?> selected <?php endif; ?> value="Chaldean">Chaldean</option>
                                                            <option <?php if( in_array('Chewa', $lang) ): ?> selected <?php endif; ?> value="Chewa">Chewa</option>
                                                            <option <?php if( in_array('Chhattisgarhi', $lang) ): ?> selected <?php endif; ?> value="Chhattisgarhi">Chhattisgarhi</option>
                                                            <option <?php if( in_array('Chinese', $lang) ): ?> selected <?php endif; ?> value="Chinese">Chinese</option>
                                                            <option <?php if( in_array('Chittagonian', $lang) ): ?> selected <?php endif; ?> value="Chittagonian">Chittagonian</option>
                                                            <option <?php if( in_array('Croatian', $lang) ): ?> selected <?php endif; ?> value="Croatian">Croatian</option>
                                                            <option <?php if( in_array('Czech', $lang) ): ?> selected <?php endif; ?> value="Czech">Czech</option>
                                                            <option <?php if( in_array('Danish', $lang) ): ?> selected <?php endif; ?> value="Danish">Danish</option>
                                                            <option <?php if( in_array('Dari', $lang) ): ?> selected <?php endif; ?> value="Dari">Dari</option>
                                                            <option <?php if( in_array('Deccan', $lang) ): ?> selected <?php endif; ?> value="Deccan">Deccan</option>
                                                            <option <?php if( in_array('Dhundhari', $lang) ): ?> selected <?php endif; ?> value="Dhundhari">Dhundhari</option>
                                                            <option <?php if( in_array('Dutch', $lang) ): ?> selected <?php endif; ?> value="Dutch">Dutch</option>
                                                            <option <?php if( in_array('English', $lang) ): ?> selected <?php endif; ?> value="English">English</option>
                                                            <option <?php if( in_array('Estonian', $lang) ): ?> selected <?php endif; ?> value="Estonian">Estonian</option>
                                                            <option <?php if( in_array('Fijian', $lang) ): ?> selected <?php endif; ?> value="Fijian">Fijian</option>
                                                            <option <?php if( in_array('Filipino', $lang) ): ?> selected <?php endif; ?> value="Filipino">Filipino</option>
                                                            <option <?php if( in_array('Finnish', $lang) ): ?> selected <?php endif; ?> value="Finnish">Finnish</option>
                                                            <option <?php if( in_array('French', $lang) ): ?> selected <?php endif; ?> value="French">French</option>
                                                            <option <?php if( in_array('Fula', $lang) ): ?> selected <?php endif; ?> value="Fula">Fula</option>
                                                            <option <?php if( in_array('Georgian', $lang) ): ?> selected <?php endif; ?> value="Georgian">Georgian</option>
                                                            <option <?php if( in_array('German', $lang) ): ?> selected <?php endif; ?> value="German">German</option>
                                                            <option <?php if( in_array('Gujarati', $lang) ): ?> selected <?php endif; ?> value="Gujarati">Gujarati</option>
                                                            <option <?php if( in_array('Hakka', $lang) ): ?> selected <?php endif; ?> value="Hakka">Hakka</option>
                                                            <option <?php if( in_array('Haryanvi', $lang) ): ?> selected <?php endif; ?> value="Haryanvi">Haryanvi</option>
                                                            <option <?php if( in_array('Hausa', $lang) ): ?> selected <?php endif; ?> value="Hausa">Hausa</option>
                                                            <option <?php if( in_array('Hebrew', $lang) ): ?> selected <?php endif; ?> value="Hebrew">Hebrew</option>
                                                            <option <?php if( in_array('Hindi', $lang) ): ?> selected <?php endif; ?> value="Hindi">Hindi</option>
                                                            <option <?php if( in_array('Hmong', $lang) ): ?> selected <?php endif; ?> value="Hmong">Hmong</option>
                                                            <option <?php if( in_array('Hungarian', $lang) ): ?> selected <?php endif; ?> value="Hungarian">Hungarian</option>
                                                            <option <?php if( in_array('Icelandic', $lang) ): ?> selected <?php endif; ?> value="Icelandic">Icelandic</option>
                                                            <option <?php if( in_array('Indonesian', $lang) ): ?> selected <?php endif; ?> value="Indonesian">Indonesian</option>
                                                            <option <?php if( in_array('Irish', $lang) ): ?> selected <?php endif; ?> value="Irish">Irish</option>
                                                            <option <?php if( in_array('Italian', $lang) ): ?> selected <?php endif; ?> value="Italian">Italian</option>
                                                            <option <?php if( in_array('Japanese', $lang) ): ?> selected <?php endif; ?> value="Japanese">Japanese</option>
                                                            <option <?php if( in_array('Javanese', $lang) ): ?> selected <?php endif; ?> value="Javanese">Javanese</option>
                                                            <option <?php if( in_array('Kannada', $lang) ): ?> selected <?php endif; ?> value="Kannada">Kannada</option>
                                                            <option <?php if( in_array('Kazakh', $lang) ): ?> selected <?php endif; ?> value="Kazakh">Kazakh</option>
                                                            <option <?php if( in_array('Kinyarwanda', $lang) ): ?> selected <?php endif; ?> value="Kinyarwanda">Kinyarwanda</option>
                                                            <option <?php if( in_array('Konkani', $lang) ): ?> selected <?php endif; ?> value="Konkani">Konkani</option>
                                                            <option <?php if( in_array('Korean', $lang) ): ?> selected <?php endif; ?> value="Korean">Korean</option>
                                                            <option <?php if( in_array('Kurdish', $lang) ): ?> selected <?php endif; ?> value="Kurdish">Kurdish</option>
                                                            <option <?php if( in_array('Latin', $lang) ): ?> selected <?php endif; ?> value="Latin">Latin</option>
                                                            <option <?php if( in_array('Latvian', $lang) ): ?> selected <?php endif; ?> value="Latvian">Latvian</option>
                                                            <option <?php if( in_array('Lebanese', $lang) ): ?> selected <?php endif; ?> value="Lebanese">Lebanese</option>
                                                            <option <?php if( in_array('Lithuanian', $lang) ): ?> selected <?php endif; ?> value="Lithuanian">Lithuanian</option>
                                                            <option <?php if( in_array('Macedonian', $lang) ): ?> selected <?php endif; ?> value="Macedonian">Macedonian</option>
                                                            <option <?php if( in_array('Madurese', $lang) ): ?> selected <?php endif; ?> value="Madurese">Madurese</option>
                                                            <option <?php if( in_array('Magahi', $lang) ): ?> selected <?php endif; ?> value="Magahi">Magahi</option>
                                                            <option <?php if( in_array('Maithili', $lang) ): ?> selected <?php endif; ?> value="Maithili">Maithili</option>
                                                            <option <?php if( in_array('Malay', $lang) ): ?> selected <?php endif; ?> value="Malay">Malay</option>
                                                            <option <?php if( in_array('Malayalam', $lang) ): ?> selected <?php endif; ?> value="Malayalam">Malayalam</option>
                                                            <option <?php if( in_array('Maltese', $lang) ): ?> selected <?php endif; ?> value="Maltese">Maltese</option>
                                                            <option <?php if( in_array('Maori', $lang) ): ?> selected <?php endif; ?> value="Maori">Maori</option>
                                                            <option <?php if( in_array('Marathi', $lang) ): ?> selected <?php endif; ?> value="Marathi">Marathi</option>
                                                            <option <?php if( in_array('Marwari', $lang) ): ?> selected <?php endif; ?> value="Marwari">Marwari</option>
                                                            <option <?php if( in_array('Modern', $lang) ): ?> selected <?php endif; ?> value="Modern Greek (1453-)">Modern Greek (1453-)</option>
                                                            <option <?php if( in_array('Mongolian', $lang) ): ?> selected <?php endif; ?> value="Mongolian">Mongolian</option>
                                                            <option <?php if( in_array('Mossi', $lang) ): ?> selected <?php endif; ?> value="Mossi">Mossi</option>
                                                            <option <?php if( in_array('Nepali', $lang) ): ?> selected <?php endif; ?> value="Nepali">Nepali</option>
                                                            <option <?php if( in_array('Norwegian', $lang) ): ?> selected <?php endif; ?> value="Norwegian">Norwegian</option>
                                                            <option <?php if( in_array('Odia', $lang) ): ?> selected <?php endif; ?> value="Odia">Odia</option>
                                                            <option <?php if( in_array('Panjabi', $lang) ): ?> selected <?php endif; ?> value="Panjabi">Panjabi</option>
                                                            <option <?php if( in_array('Pashto', $lang) ): ?> selected <?php endif; ?> value="Pashto">Pashto</option>
                                                            <option <?php if( in_array('Persian', $lang) ): ?> selected <?php endif; ?> value="Persian">Persian</option>
                                                            <option <?php if( in_array('Polish', $lang) ): ?> selected <?php endif; ?> value="Polish">Polish</option>
                                                            <option <?php if( in_array('Portuguese', $lang) ): ?> selected <?php endif; ?> value="Portuguese">Portuguese</option>
                                                            <option <?php if( in_array('Punjabi', $lang) ): ?> selected <?php endif; ?> value="Punjabi">Punjabi</option>
                                                            <option <?php if( in_array('Quechua', $lang) ): ?> selected <?php endif; ?> value="Quechua">Quechua</option>
                                                            <option <?php if( in_array('Romanian', $lang) ): ?> selected <?php endif; ?> value="Romanian">Romanian</option>
                                                            <option <?php if( in_array('Russian', $lang) ): ?> selected <?php endif; ?> value="Russian">Russian</option>
                                                            <option <?php if( in_array('Samoan', $lang) ): ?> selected <?php endif; ?> value="Samoan">Samoan</option>
                                                            <option <?php if( in_array('Serbian', $lang) ): ?> selected <?php endif; ?> value="Serbian">Serbian</option>
                                                            <option <?php if( in_array('Shona', $lang) ): ?> selected <?php endif; ?> value="Shona">Shona</option>
                                                            <option <?php if( in_array('Sindhi', $lang) ): ?> selected <?php endif; ?> value="Sindhi">Sindhi</option>
                                                            <option <?php if( in_array('Sinhalese', $lang) ): ?> selected <?php endif; ?> value="Sinhalese">Sinhalese</option>
                                                            <option <?php if( in_array('Slovak', $lang) ): ?> selected <?php endif; ?> value="Slovak">Slovak</option>
                                                            <option <?php if( in_array('Slovenian', $lang) ): ?> selected <?php endif; ?> value="Slovenian">Slovenian</option>
                                                            <option <?php if( in_array('Somali', $lang) ): ?> selected <?php endif; ?> value="Somali">Somali</option>
                                                            <option <?php if( in_array('Spanish', $lang) ): ?> selected <?php endif; ?> value="Spanish">Spanish</option>
                                                            <option <?php if( in_array('Sundanese', $lang) ): ?> selected <?php endif; ?> value="Sundanese">Sundanese</option>
                                                            <option <?php if( in_array('Swahili', $lang) ): ?> selected <?php endif; ?> value="Swahili">Swahili</option>
                                                            <option <?php if( in_array('Swedish', $lang) ): ?> selected <?php endif; ?> value="Swedish">Swedish</option>
                                                            <option <?php if( in_array('Tagalog', $lang) ): ?> selected <?php endif; ?> value="Tagalog">Tagalog</option>
                                                            <option <?php if( in_array('Taiwanese', $lang) ): ?> selected <?php endif; ?> value="Taiwanese">Taiwanese</option>
                                                            <option <?php if( in_array('Tamil', $lang) ): ?> selected <?php endif; ?> value="Tamil">Tamil</option>
                                                            <option <?php if( in_array('Tatar', $lang) ): ?> selected <?php endif; ?> value="Tatar">Tatar</option>
                                                            <option <?php if( in_array('Telugu', $lang) ): ?> selected <?php endif; ?> value="Telugu">Telugu</option>
                                                            <option <?php if( in_array('Thai', $lang) ): ?> selected <?php endif; ?> value="Thai">Thai</option>
                                                            <option <?php if( in_array('Tibetan', $lang) ): ?> selected <?php endif; ?> value="Tibetan">Tibetan</option>
                                                            <option <?php if( in_array('Tonga', $lang) ): ?> selected <?php endif; ?> value="Tonga (Tonga Islands)">Tonga (Tonga Islands)</option>
                                                            <option <?php if( in_array('Turkish', $lang) ): ?> selected <?php endif; ?> value="Turkish">Turkish</option>
                                                            <option <?php if( in_array('Turkmen', $lang) ): ?> selected <?php endif; ?> value="Turkmen">Turkmen</option>
                                                            <option <?php if( in_array('Ukrainian', $lang) ): ?> selected <?php endif; ?> value="Ukrainian">Ukrainian</option>
                                                            <option <?php if( in_array('Urdu', $lang) ): ?> selected <?php endif; ?> value="Urdu">Urdu</option>
                                                            <option <?php if( in_array('Uyghur', $lang) ): ?> selected <?php endif; ?> value="Uyghur">Uyghur</option>
                                                            <option <?php if( in_array('Uzbek', $lang) ): ?> selected <?php endif; ?> value="Uzbek">Uzbek</option>
                                                            <option <?php if( in_array('Vietnamese', $lang) ): ?> selected <?php endif; ?> value="Vietnamese">Vietnamese</option>
                                                            <option <?php if( in_array('Visayan', $lang) ): ?> selected <?php endif; ?> value="Visayan">Visayan</option>
                                                            <option <?php if( in_array('Welsh', $lang) ): ?> selected <?php endif; ?> value="Welsh">Welsh</option>
                                                            <option <?php if( in_array('Xhosa', $lang) ): ?> selected <?php endif; ?> value="Xhosa">Xhosa</option>
                                                            <option <?php if( in_array('Yoruba', $lang) ): ?> selected <?php endif; ?> value="Yoruba">Yoruba</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="" for="">Member of a driving instructor association?</label>
                                                <div class="input-group">
                                                    <select class="form-control" required="required" name="association_member" id="association_member">
                                                        <option <?php echo e(@$user->user_meta->association_member == "No"? 'selected' : ''); ?> value="No">No</option>
                                                        <option <?php echo e(@$user->user_meta->association_member == "Australia Driver Trainers Association (NSW & QLD)"? 'selected' : ''); ?> value="Australia Driver Trainers Association (NSW &amp; QLD)">Australia Driver Trainers Association (NSW &amp; QLD)</option>
                                                        <option <?php echo e(@$user->user_meta->association_member == "NSW Driver Trainers Association"? 'selected' : ''); ?> value="NSW Driver Trainers Association">NSW Driver Trainers Association</option>
                                                        <option <?php echo e(@$user->user_meta->association_member == "Australian Driver Trainers Association (Victoria) Inc"? 'selected' : ''); ?> value="Australian Driver Trainers Association (Victoria) Inc">Australian Driver Trainers Association (Victoria) Inc</option>
                                                        <option <?php echo e(@$user->user_meta->association_member == "Other"? 'selected' : ''); ?> value="Other">Other</option>
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="col-md-6" id="member_input" style="display: none;">
                                                <div class="field-wrap">
                                                    <div class="">
                                                        <label class="" for="instructor_user_instructor_association_member">Name of your association</label>
                                                    </div>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" value="<?php echo e(@$user->user_meta->association_name); ?>" name="association_name" id="association_member">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6" style="display:none;">
                                                <label>Are you accredited for the 'Keys2Drive' program?</label>
                                                <div class="input-group ">
                                                    <select class="form-control" required="required" name="keys2drive">
                                                        <option <?php echo e(@$user->user_meta->keys2drive == "true"? 'selected' : ''); ?> value="true">Yes</option>
                                                        <option <?php echo e(@$user->user_meta->keys2drive == "false"? 'selected' : ''); ?> value="false">No</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label>How long have you been a licensed driving instructor?</label>
                                                    <div class="input-group">
                                                        <input class="form-control" required="required" placeholder="No. of years" type="number" value="<?php echo e(@$user->user_meta->years_for_instructing); ?>" name="years_for_instructing" >
                                                    </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 m-t-5">
                                                <label>Services &amp; Accreditation</label>

                                                <div class="input-group">
                                                    <?php

                                                        $services_accreditation=[];
                                                        if(@$user->user_meta->services_accreditation!=""){
                                                            $services_accreditation = json_decode(@$user->user_meta->services_accreditation);
                                                        }
                                                    ?>
                                                    <label for="instructor_user_1">
                                                        <input type="checkbox" <?php if( @in_array(1, $services_accreditation)): ?> checked <?php endif; ?> value="1" name="services_accreditation[]" id="instructor_user_1"> Driving test package: existing customers</label>
                                                    </div>
                                                <div class="input-group">
                                                <label for="instructor_user_12">
                                                    <input type="checkbox" <?php if( @in_array(3, $services_accreditation)): ?>  checked <?php endif; ?> value="3" name="services_accreditation[]" id="instructor_user_12"> Manual Instructor accredited - no vehicle</label>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <hr>
                                                <h3>VEHICLES</h3>

                                                <label>Which transmission(s) do you offer?</label>
                                                <div class="input-group ">
                                                    <div class="radio m-r-5">
                                                        <label for="ansmission_type_0">
                                                            <input class="radio_buttons optional" type="radio" <?php if(@$user->user_meta->transmission_type == "auto"): ?> checked <?php endif; ?> value="auto" name="transmission_type" id="ansmission_type_0"> Auto </label>
                                                    </div>
                                                    <div class="radio m-r-5">
                                                        <label for="ansmission_type_1">
                                                            <input class="radio_buttons optional" type="radio" <?php if(@$user->user_meta->transmission_type == "manual"): ?> checked <?php endif; ?> value="manual" name="transmission_type" id="ansmission_type_1"> Manual </label>
                                                    </div>
                                                    <div class="radio m-r-5">
                                                        <label for="ansmission_type_2">
                                                            <input class="radio_buttons optional" type="radio" <?php if(@$user->user_meta->transmission_type == "both"): ?> checked <?php endif; ?> value="both" name="transmission_type" id="ansmission_type_2"> Both Transmissions </label>
                                                    </div>
                                                </div>

                                                <div class="nested-field-blocks bordered d-none" id="instructor_user_vehicle_auto" >
                                                    <div class="fields" style="display: block;">
                                                        <center>
                                                            <h4>Vehicle for Auto</h4>
                                                            <hr>
                                                        </center>
                                                        <div class="vehicle_container" style="display: block;">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label class="" for="">
                                                                        ANCAP safety rating</label>

                                                                    <div class="input-group">
                                                                        <select class="form-control" name="ancap_rating_vehicle_auto" id="">
                                                                            <option <?php if(@$user->user_vehicle_auto->ancap_rating =="1"): ?> selected <?php endif; ?> value="1">1 Star</option>
                                                                            <option <?php if(@$user->user_vehicle_auto->ancap_rating =="2"): ?> selected <?php endif; ?> value="2">2 Stars</option>
                                                                            <option <?php if(@$user->user_vehicle_auto->ancap_rating =="3"): ?> selected <?php endif; ?> value="3">3 Stars</option>
                                                                            <option <?php if(@$user->user_vehicle_auto->ancap_rating =="4"): ?> selected <?php endif; ?> value="4">4 Stars</option>
                                                                            <option <?php if(@$user->user_vehicle_auto->ancap_rating =="5"): ?> selected <?php endif; ?> value="5">5 Stars</option>
                                                                        </select>
                                                                    </div>

                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="" for="">
                                                                       Do you instruct with 'dual controls'?</label>
                                                                        <div class="input-group ">
                                                                            <select class="form-control"  name="dual_controls_vehicle_auto" id="">
                                                                                <option <?php if(@$user->user_vehicle_auto->dual_controls =="true"): ?> selected <?php endif; ?> value="true">Yes</option>
                                                                                <option <?php if(@$user->user_vehicle_auto->dual_controls =="false"): ?> selected <?php endif; ?> value="false">No</option>
                                                                            </select>
                                                                        </div>
                                                                </div>
                                                            </div>

                                                            <div class="row m-t-10">
                                                                <div class="col-md-6">
                                                                    <label class="" for="">Vehicle registration number</label>

                                                                    <div class="input-group">
                                                                        <input class=" form-control"  type="text" value="<?php echo e(@$user->user_vehicle_auto->registration_number); ?>" name="registration_number_vehicle_auto">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="" for="">Transmission</label>
                                                                    <div class="input-group">
                                                                        <select class="form-control" readonly="readonly" name="transmission_vehicle_auto" id="transmission_vehicle_auto">
                                                                            <option value="Auto" selected>Auto</option>
                                                                            
                                                                        </select>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                            <div class="row m-t-10">
                                                                <div class="col-md-4">
                                                                    <label class="" for=""> Make*</label>
                                                                    <div class="input-group">
                                                                        <select class="form-control vehicle_make"  name="vehicle_make_vehicle_auto" id="vehicle_make_vehicle_auto">
                                                                            <option value=""></option>
                                                                            <?php $__currentLoopData = $car_make; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $make): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <option <?php if(@$user->user_vehicle_auto->vehicle_make == $make->id): ?> selected <?php endif; ?>  value="<?php echo e($make->id); ?>"><?php echo e($make->title); ?></option>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="" for=""> Model*</label>
                                                                    <div class="input-group ">
                                                                        <select class=" form-control"  name="vehicle_model_vehicle_auto" id="vehicle_model_vehicle_auto">
                                                                            <?php if(!empty($car_models_auto)): ?>
                                                                            <?php $__currentLoopData = $car_models_auto; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $modl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <option <?php if(@$user->user_vehicle_auto->vehicle_model == $modl->id): ?> selected <?php endif; ?>  value="<?php echo e($modl->id); ?>"><?php echo e($modl->title); ?></option>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                            <?php endif; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">

                                                                    <label class="" for="">Year*</label>

                                                                    <div class="input-group ">
                                                                        <select class="form-control"  name="vehicle_year_vehicle_auto" id="vehicle_year_vehicle_auto">
                                                                            <?php if(!empty($car_years_auto)): ?>
                                                                            <?php $__currentLoopData = $car_years_auto; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $yer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <option <?php if(@$user->user_vehicle_auto->vehicle_year == $yer->title): ?> selected <?php endif; ?>  value="<?php echo e($yer->title); ?>"><?php echo e($yer->title); ?></option>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                            <?php endif; ?>
                                                                        </select>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row" style="margin-top: 30px;">
                                                        <div class="col-md-3">
                                                            <div class="form-group m-t-10">
                                                                <h4>Vehicle Image</h4>
                                                                <!-- <input type="hidden" name="vehicle_img" id="vehicle_img" value=""> -->
                                                            </div>
                                                            <img src="<?php echo e(@$user->user_vehicle_auto->vehicle_image !=""? asset('assets/images/cars/'.$user->user_vehicle_auto->vehicle_image) : ''); ?> " alt="" class="image_preview img-responsive" id="image_preview">
                                                        </div>

                                                        <?php /*
                                                        <div class="col-md-6 v-status">
                                                            <h4>Vehicle Status</h4>
                                                            @if(@$user->user_meta->vehicle_status==1)
                                                                <button class="btn btn-success" disabled>Approved</button>
                                                            @else
                                                                <button class="btn btn-danger" disabled>Car Image Pending for Admin Approval</button>
                                                            @endif
                                                        </div>
                                                        */ ?>

                                                    </div>
                                                </div>
                                                <div class="nested-field-blocks bordered d-none" id="instructor_user_vehicle_manual" >
                                                    <div class="fields" style="display: block;">
                                                        <center>
                                                            <h4>Vehicle for Manual</h4>
                                                            <hr>
                                                        </center>
                                                        <div class="vehicle_container" style="display: block;">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label class="" for="">
                                                                        ANCAP safety rating</label>

                                                                    <div class="input-group">
                                                                        <select class="form-control"  name="ancap_rating_vehicle_manual" id="">
                                                                            <option <?php if(@$user->user_vehicle_manual->ancap_rating =="1"): ?> selected <?php endif; ?> value="1">1 Star</option>
                                                                            <option <?php if(@$user->user_vehicle_manual->ancap_rating =="2"): ?> selected <?php endif; ?> value="2">2 Stars</option>
                                                                            <option <?php if(@$user->user_vehicle_manual->ancap_rating =="3"): ?> selected <?php endif; ?> value="3">3 Stars</option>
                                                                            <option <?php if(@$user->user_vehicle_manual->ancap_rating =="4"): ?> selected <?php endif; ?> value="4">4 Stars</option>
                                                                            <option <?php if(@$user->user_vehicle_manual->ancap_rating =="5"): ?> selected <?php endif; ?> value="5">5 Stars</option>
                                                                        </select>
                                                                    </div>

                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="" for="">
                                                                       Do you instruct with 'dual controls'?</label>
                                                                        <div class="input-group ">
                                                                            <select class="form-control" name="dual_controls_vehicle_manual" id="">
                                                                                <option <?php if(@$user->user_vehicle_manual->dual_controls =="true"): ?> selected <?php endif; ?> value="true">Yes</option>
                                                                                <option <?php if(@$user->user_vehicle_manual->dual_controls =="false"): ?> selected <?php endif; ?> value="false">No</option>
                                                                            </select>
                                                                        </div>
                                                                </div>
                                                            </div>

                                                            <div class="row m-t-10">
                                                                <div class="col-md-6">
                                                                    <label class="" for="">Vehicle registration number</label>

                                                                    <div class="input-group">
                                                                        <input class=" form-control"  type="text" value="<?php echo e(@$user->user_vehicle_manual->registration_number); ?>" name="registration_number_vehicle_manual">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="" for="">Transmission</label>
                                                                    <div class="input-group">
                                                                        <select class="form-control" readonly="readonly" name="transmission_vehicle_manual" id="transmission_vehicle_manual">
                                                                            
                                                                            <option value="Manual" selected>Manual</option>
                                                                        </select>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                            <div class="row m-t-10">
                                                                <div class="col-md-4">
                                                                    <label class="" for=""> Make</label>
                                                                    <div class="input-group">
                                                                        <select class="form-control vehicle_make"  name="vehicle_make_vehicle_manual" id="vehicle_make_vehicle_manual">
                                                                            <option value=""></option>
                                                                            <?php $__currentLoopData = $car_make; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $make): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <option <?php if(@$user->user_vehicle_manual->vehicle_make == $make->id): ?> selected <?php endif; ?>  value="<?php echo e($make->id); ?>"><?php echo e($make->title); ?></option>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="" for=""> Model</label>
                                                                    <div class="input-group ">
                                                                        <select class=" form-control"   name="vehicle_model_vehicle_manual" id="vehicle_model_vehicle_manual">
                                                                            <?php if(!empty($car_models_manual)): ?>
                                                                            <?php $__currentLoopData = $car_models_manual; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $modl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <option <?php if(@$user->user_vehicle_manual->vehicle_model == $modl->id): ?> selected <?php endif; ?>  value="<?php echo e($modl->id); ?>"><?php echo e($modl->title); ?></option>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                            <?php endif; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">

                                                                    <label class="" for="">Year</label>

                                                                    <div class="input-group ">
                                                                        <select class="form-control"  name="vehicle_year_vehicle_manual" id="vehicle_year_vehicle_manual">
                                                                            <?php if(!empty($car_years_manual)): ?>
                                                                            <?php $__currentLoopData = $car_years_manual; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $yer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <option <?php if(@$user->user_vehicle_manual->vehicle_year == $yer->title): ?> selected <?php endif; ?>  value="<?php echo e($yer->title); ?>"><?php echo e($yer->title); ?></option>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                            <?php endif; ?>
                                                                        </select>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row" style="margin-top: 30px;">
                                                        <div class="col-md-3">
                                                            <div class="form-group m-t-10">
                                                                <h4>Vehicle Image</h4>
                                                                <!-- <input type="hidden" name="vehicle_img" id="vehicle_img" value=""> -->
                                                            </div>
                                                            <img src="<?php echo e(@$user->user_vehicle_manual->vehicle_image !=""? asset('assets/images/cars/'.$user->user_vehicle_manual->vehicle_image) : ''); ?> " alt="" class="image_preview img-responsive" id="image_preview">
                                                        </div>

                                                        <?php /*
                                                        <div class="col-md-6 v-status">
                                                            <h4>Vehicle Status</h4>
                                                            @if(@$user->user_vehicle_manual->vehicle_status==1)
                                                                <button class="btn btn-success" disabled>Approved</button>
                                                            @else
                                                                <button class="btn btn-danger" disabled>Car Image Pending for Admin Approval</button>
                                                            @endif
                                                        </div>
                                                        */ ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group m-t-10">
                                            <button class="btn btn-success">SAVE</button>
                                        </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <center>
                    <h4>Vehicle History</h4>
                    <hr>
                </center>
                <hr>
                <table class="table table-light">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Rating</th>
                            <th>Dual Controls</th>
                            <th>registration number</th>
                            <th>Transmission</th>
                            <th>Make</th>
                            <th>Model</th>
                            <th>Year</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $vehicle_notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notify): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($notify->instructer_vehicles->ancap_rating); ?> Star</td>
                                <td>
                                    <?php if($notify->instructer_vehicles->dual_controls =="false"): ?>
                                        <?php echo e('No'); ?>

                                    <?php else: ?>
                                        <?php echo e('Yes'); ?>

                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($notify->instructer_vehicles->registration_number); ?></td>
                                <td><?php echo e($notify->instructer_vehicles->vehicle_type); ?></td>
                                <td><?php echo e(carMake($notify->instructer_vehicles->vehicle_make)); ?></td>

                                <td><?php echo e(carModel($notify->instructer_vehicles->vehicle_model)); ?></td>

                                <td><?php echo e($notify->instructer_vehicles->vehicle_year); ?></td>
                                <td><?php echo e($notify->notify_status); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.modal -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('assets/libs/select2/dist/js/select2.full.min.js')); ?>"></script>

    <style>
        .v-status{
            text-align: center;
        }
        .v-status button{
            margin-top: 15px;
            padding: 10px 30px;
            text-transform: uppercase;
        }
    </style>

    <script>

        $(document).ready(function() {

            $('#language').select2();
            $('#vehicle_make_vehicle_auto').select2({
                placeholder: "Select vehicle Make",
            });
            $('#vehicle_make_vehicle_manual').select2({
                placeholder: "Select vehicle Make",
            });

            $('#vehicle_model_vehicle_auto').select2({
                placeholder: "Select vehicle Model",
            });

            $('#vehicle_model_vehicle_manual').select2({
                placeholder: "Select vehicle Model",
            });

            $('#vehicle_year_vehicle_auto').val('<?php echo e(@$user->user_vehicle_auto->vehicle_year); ?>');
            $('#vehicle_model_vehicle_auto').val('<?php echo e(@$user->user_vehicle_auto->vehicle_model); ?>');
            $('#vehicle_make_vehicle_auto').val('<?php echo e(@$user->user_vehicle_auto->vehicle_make); ?>');

            $('#vehicle_year_vehicle_manual').val('<?php echo e(@$user->user_vehicle_manual->vehicle_year); ?>');
            $('#vehicle_model_vehicle_manual').val('<?php echo e(@$user->user_vehicle_manual->vehicle_model); ?>');
            $('#vehicle_make_vehicle_manual').val('<?php echo e(@$user->user_vehicle_manual->vehicle_make); ?>');


            var association_member= "<?php echo e($user->association_member); ?>";

            if(association_member == "Other"){
                $('#member_input').show();
            }


            $('#vehicle_make_vehicle_auto').change(function (){
                var make_id = $(this).val();
                if(make_id == ''){
                    $('#vehicle_model_vehicle_auto').html("<option value=''></option>");
                    return ;
                }

                $('#loading').show();

                var data = new FormData();

                data.append('make_id', make_id )

                $.ajax({
                    url: "<?php echo e(Route('get_vehicle_model')); ?>",
                    data: data,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function (res) {
                        if(res.success == true){

                            $('#vehicle_model_vehicle_auto').html(res.options);
                            $('#vehicle_year_vehicle_auto').html(res.options_year);
                            //$('#vehicle_img').val(res.image_id);
                            //$('#image_preview').attr("src", "assets/images/cars/"+res.image);

                        }else if(res.success == false){
                            swal('Warning!', res.message, 'error');
                        }

                        $('#loading').hide();
                    },
                    error: function () {
                        $('#loading').hide();
                    }

                });

                return false;
            });

            $('#vehicle_make_vehicle_manual').change(function (){
                var make_id = $(this).val();
                if(make_id == ''){
                    $('#vehicle_model_vehicle_manual').html("<option value=''></option>");
                    return ;
                }

                $('#loading').show();

                var data = new FormData();

                data.append('make_id', make_id )

                $.ajax({
                    url: "<?php echo e(Route('get_vehicle_model')); ?>",
                    data: data,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function (res) {
                        if(res.success == true){

                            $('#vehicle_model_vehicle_manual').html(res.options);
                            $('#vehicle_year_vehicle_manual').html(res.options_year);
                            //$('#vehicle_img').val(res.image_id);
                            //$('#image_preview').attr("src", "assets/images/cars/"+res.image);

                        }else if(res.success == false){
                            swal('Warning!', res.message, 'error');
                        }

                        $('#loading').hide();
                    },
                    error: function () {
                        $('#loading').hide();
                    }

                });

                return false;
            });

            //=================================================================


            $('#vehicle_model_vehicle_auto').change(function (){

                var model_id = $(this).val();
                if(model_id == ''){
                    $('#vehicle_year_vehicle_auto').html("<option value=''></option>");
                    //$('#image_preview').attr("src", "");
                    //$('#vehicle_img').val('');
                    return ;
                }

                $('#loading').show();

                var data = new FormData();

                data.append('model_id', model_id )

                $.ajax({
                    url: "<?php echo e(Route('get_vehicle_year')); ?>",
                    data: data,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function (res) {
                        if(res.success == true){

                            $('#vehicle_year_vehicle_auto').html(res.options_year);
                            //$('#vehicle_img').val(res.image_id);
                            //$('#image_preview').attr("src", "assets/images/cars/"+res.image);

                        }else if(res.success == false){
                            swal('Warning!', res.message, 'error');
                        }

                        $('#loading').hide();
                    },
                    error: function () {
                        $('#loading').hide();
                    }

                });

                return false;
            });

            $('#vehicle_model_vehicle_manual').change(function (){

                var model_id = $(this).val();
                if(model_id == ''){
                    $('#vehicle_year_vehicle_manual').html("<option value=''></option>");
                    //$('#image_preview').attr("src", "");
                    //$('#vehicle_img').val('');
                    return ;
                }

                $('#loading').show();

                var data = new FormData();

                data.append('model_id', model_id )

                $.ajax({
                    url: "<?php echo e(Route('get_vehicle_year')); ?>",
                    data: data,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function (res) {
                        if(res.success == true){

                            $('#vehicle_year_vehicle_manual').html(res.options_year);
                            //$('#vehicle_img').val(res.image_id);
                            //$('#image_preview').attr("src", "assets/images/cars/"+res.image);

                        }else if(res.success == false){
                            swal('Warning!', res.message, 'error');
                        }

                        $('#loading').hide();
                    },
                    error: function () {
                        $('#loading').hide();
                    }

                });

                return false;
            });

            //=================================================================


            /*
            $('#vehicle_year').change(function (){

                var model_id = $('#vehicle_model').val();
                var yeartitle = $(this).val();

                $('#loading').show();

                var data = new FormData();

                data.append('model_id', model_id );
                data.append('year', yeartitle );

                $.ajax({
                    url: "<?php echo e(Route('get_vehicle_model_img')); ?>",
                    data: data,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function (res) {
                        if(res.success == true){

                            $('#vehicle_img').val(res.image_id);
                            $('#image_preview').attr("src", "assets/images/cars/"+res.image);

                        }else if(res.success == false){
                            swal('Warning!', res.message, 'error');
                        }

                        $('#loading').hide();
                    },
                    error: function () {
                        $('#loading').hide();
                    }

                });

                return false;
            });
            */

            //======================================================================

            $('#edit_instructor').submit(function (){

                $('#loading').show();

                var data = new FormData(this);

                if($('input[name="services_accreditation[]"]:checked').length == 0){
                    data.append('services_accreditation', '[]');
                }
                $.ajax({
                    url: "<?php echo e(Route('save_instructor_vehicle')); ?>",
                    data: data,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function (res) {
                        if(res.success == true){
                            //swal('Success', res.message, 'success');
                            swal('', res.message, 'success').then((value) => {
                                //location.reload(true);

                                window.location.assign("<?php echo e(Route('home')); ?>");
                            });
                        }else if(res.success == false){
                            swal('Warning!', res.message, 'error');
                        }

                        $('#loading').hide();
                    },
                    error: function () {
                        $('#loading').hide();
                    }

                });

                return false;
            });

            $('#association_member').change(function (){
                if($(this).val() == 'Other'){
                    $('#member_input').show();
                }else{
                    $('#member_input').hide();
                }
            })

            var transmission_type = $("input[type='radio'][name='transmission_type']:checked").val();
            if(transmission_type == 'auto') {
                $('#instructor_user_vehicle_auto').removeClass('d-none');
                $('#instructor_user_vehicle_manual').addClass('d-none');
                document.getElementById("transmission_vehicle_auto").disabled = false;
                document.getElementById("transmission_vehicle_manual").disabled = true;
                $("input[name='registration_number_vehicle_auto']").attr('required', '');
                $("input[name='registration_number_vehicle_manual']").removeAttr('required');
            }else if(transmission_type == 'manual'){
                $('#instructor_user_vehicle_auto').addClass('d-none');
                $('#instructor_user_vehicle_manual').removeClass('d-none');
                document.getElementById("transmission_vehicle_auto").disabled = true;
                document.getElementById("transmission_vehicle_manual").disabled = false;
                $("input[name='registration_number_vehicle_manual']").attr('required', '');
                $("input[name='registration_number_vehicle_auto']").removeAttr('required');
            }else{
                $('#instructor_user_vehicle_auto').removeClass('d-none');
                $('#instructor_user_vehicle_manual').removeClass('d-none');
                document.getElementById("transmission_vehicle_auto").disabled = false;
                document.getElementById("transmission_vehicle_manual").disabled = false;
                $("input[name='registration_number_vehicle_auto']").attr('required', '');
                $("input[name='registration_number_vehicle_manual']").attr('required', '');
            }

            $('input:radio[name="transmission_type"]').change(function() {
                var transmission_type = $("input[type='radio'][name='transmission_type']:checked").val();
                if(transmission_type == 'auto') {
                    $('#instructor_user_vehicle_auto').removeClass('d-none');
                    $('#instructor_user_vehicle_manual').addClass('d-none');
                    document.getElementById("transmission_vehicle_auto").disabled = false;
                    document.getElementById("transmission_vehicle_manual").disabled = true;

                    $("input[name='registration_number_vehicle_auto']").attr('required', '');
                    $("input[name='registration_number_vehicle_manual']").removeAttr('required');

                }else if(transmission_type == 'manual'){
                    $('#instructor_user_vehicle_auto').addClass('d-none');
                    $('#instructor_user_vehicle_manual').removeClass('d-none');
                    document.getElementById("transmission_vehicle_auto").disabled = true;
                    document.getElementById("transmission_vehicle_manual").disabled = false;
                    $("input[name='registration_number_vehicle_manual']").attr('required', '');
                    $("input[name='registration_number_vehicle_auto']").removeAttr('required');

                }else{
                    $('#instructor_user_vehicle_auto').removeClass('d-none');
                    $('#instructor_user_vehicle_manual').removeClass('d-none');
                    document.getElementById("transmission_vehicle_auto").disabled = false;
                    document.getElementById("transmission_vehicle_manual").disabled = false;

                    $("input[name='registration_number_vehicle_auto']").attr('required', '');
                    $("input[name='registration_number_vehicle_manual']").attr('required', '');
                }
            });

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/zenstech/public_html/resources/views/instructor/profile_vehicle.blade.php ENDPATH**/ ?>