
<?php $__env->startSection('content'); ?>
<?php
    if(isset($docs))
    {
        $wwcc = json_decode($docs->wwcc);

    }
?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Instructor Details</h4>
                <div class="d-flex align-items-center">

                </div>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex no-block justify-content-end align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Instructor Details</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- Column -->
            <div class="col-lg-4 col-xlg-3 col-md-5">
                <div class="card">
                    <div class="card-body">
                        <center class="m-t-30">
                            <?php if($user->avatar == ''): ?>
                                <img src="<?php echo e(asset('assets/images/users/default.png')); ?>" class="rounded-circle new_profile_img_preview" width="150">
                            <?php else: ?>
                                <img src="<?php echo e(asset('assets/images/users/'.$user->avatar)); ?>" class="rounded-circle new_profile_img_preview" width="150">
                            <?php endif; ?>
                            <h4 class="card-title m-t-10"><?php echo e(ucwords($user->name)); ?></h4>
                                <div class="row text-center justify-content-md-center">
                                    <?php
                                    $langs=[];
                                    if(isset($user->user_meta->language)){
                                        if($user->user_meta->language!=""){
                                            $langs = json_decode($user->user_meta->language);

                                            foreach ($langs as $ky => $lang ){
                                                
                                                if($ky==3){
                                                    echo "</div><div class='row text-center justify-content-md-center' style='margin-top:10px;'>";
                                                }

                                                echo '<div class="col-4"> <span class="label label-info">'.$lang.'</span> </div>';
                                            }
                                        }
                                    }

                                    ?>
                                </div>

                                <a href="#" id="open_upload_profile" class="btn btn-success" style="margin-top: 30px;">EDIT PROFILE PICTURE</a>

                        </center>

                        <form style="margin-top: 25px; display: none;" id="update_profile_image" enctype="multipart/form-data">
                            <label for="">Upload Profile Image</label>
                            <input type="file" name="profile_img" id="profile_img" onchange="readURL(this, '.new_profile_img_preview')">
                            <input type="hidden" name="user_id" id="user_id" value="<?php echo e($user->id); ?>">
                            <br><br>
                            <button class="btn btn-success">SAVE</button>
                        </form>

                    </div>
                    <div><hr></div>
                    <div class="card-body">
                        <small class="text-muted">Email address </small>
                        <h6><?php echo e($user->email); ?></h6> <small class="text-muted p-t-30 db">Phone</small>
                        <h6><?php echo e($user->phone); ?></h6>
                        <div><hr></div>
                        <h6>BIO</h6>
                        <?php echo @$user->user_meta->bio; ?>


                        <div><hr></div>

                        <img width="300" src="<?php echo e(asset('assets/images/cars/'.@$user->user_vehicle_auto->vehicle_image)); ?>" class="new_image_preview" <?php if(@$user->user_vehicle_auto->vehicle_image==""): ?> style="display:none;" <?php endif; ?>>

                        <?php $css = ""; ?>
                        <?php if(@$user->user_meta->vehicle_image!=""): ?>
                            <a href="#" id="open_upload_form" class="btn btn-success" style="margin-top: 15px;">EDIT</a>
                            <?php $css = 'style="display:none; margin-top: 25px;"'; ?>
                        <?php endif; ?>

                        <form <?php echo $css; ?> id="update_vehicle_image_for_auto" enctype="multipart/form-data">
                            <label for="">Upload Vehicle Image for Auto</label>
                            <input type="file" name="vehicle_img" id="vehicle_img_auto">
                            <input type="hidden" name="instructer_vehicles_id" id="instructer_vehicles_auto" value="<?php echo e(@$user->user_vehicle_auto->id); ?>">
                            <br><br>
                            <button class="btn btn-success">SAVE</button>
                        </form>
                        <br>

                        <img width="300" src="<?php echo e(asset('assets/images/cars/'.@$user->user_vehicle_manual->vehicle_image)); ?>" class="new_image_preview" <?php if(@$user->user_vehicle_manual->vehicle_image==""): ?> style="display:none;" <?php endif; ?>>

                        <form <?php echo $css; ?> id="update_vehicle_image_for_manual" enctype="multipart/form-data">
                            <label for="">Upload Vehicle Image for Manual</label>
                            <input type="file" name="vehicle_img" id="vehicle_img_manual">
                            <input type="hidden" name="instructer_vehicles_id" id="instructer_vehicles_manual_id" value="<?php echo e(@$user->user_vehicle_manual->id); ?>">
                            <br><br>
                            <button class="btn btn-success">SAVE</button>
                        </form>


                    </div>
                    </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="col-lg-8 col-xlg-9 col-md-7">
                <div class="card">
                    <!-- Tabs -->
                    <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                        <li class="nav-item" id="vehicle-li">
                            <a class="nav-link " href="#vehicle_details" data-toggle="pill" role="tab" aria-controls="pills-vehicle_details" aria-selected="true">Vehicle Detail</a>
                        </li>
                        
                    <?php if($notify_type!='vehicle'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#inst_docs"  data-toggle="pill" role="tab" aria-controls="pills-inst_docs">Documents</a>
                        </li>
                    <?php endif; ?>
                        

                    </ul>
                    <!-- Tabs -->
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade" id="inst_docs" role="tabpanel" aria-labelledby="pills-setting-tab">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-12">
                                        <?php if( isset($docs)): ?>
                                        <div id="licence-container">
                                            <h3 class="pull-left">Driver’s Licence (C)</h3>
                                            <div class="clearfix"></div>
                                            <div class="row">
                                                <div class="col-md-6 small-margin-top-5">
                                                    <label for="">Expiration Date</label>
                                                    <input type="text" class="form-control" value="<?php echo e(@$docs->driving_licence->expiration_date); ?>"  readonly>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="row m-t-15">
                                                        <div class="col-md-6">
                                                            <p>Driver's Licence (C) - Front</p>

                                                            <?php if(@$docs->driving_licence->driving_licence_front==''): ?>
                                                                <img src="<?php echo e(asset('assets/images/empty.png')); ?>" alt="" class="img-responsive">
                                                            <?php else: ?>
                                                                <a data-fancybox="gallery" href="<?php echo e(asset('assets/images/documents/'.@$docs->driving_licence->driving_licence_front)); ?>"><img src="<?php echo e(asset('assets/images/documents/'.@$docs->driving_licence->driving_licence_front)); ?>" alt="" class="img-responsive"></a>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <p>Driver's Licence (C) - Back</p>
                                                            <?php if(@$docs->driving_licence->driving_licence_back==''): ?>
                                                                <img src="<?php echo e(asset('assets/images/empty.png')); ?>" alt="" class="img-responsive">
                                                            <?php else: ?>
                                                                <a data-fancybox="gallery" href="<?php echo e(asset('assets/images/documents/'.@$docs->driving_licence->driving_licence_back)); ?>"><img src="<?php echo e(asset('assets/images/documents/'.@$docs->driving_licence->driving_licence_back)); ?>" alt="" class="img-responsive"></a>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <center>
                                                            <h4>Request Driver’s Licence History</h4>
                                                            <hr>
                                                        </center>
                                                        <table class="table table-light">
                                                            <thead class="thead-light">
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Licence-Front</th>
                                                                    <th>Licence-Back</th>
                                                                    <th>Expiration Date</th>
                                                                    <th>Status</th>
                                                                    <th>Actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $__currentLoopData = $driving_licences; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $licence): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <tr>
                                                                        <td><?php echo e($loop->iteration); ?></td>
                                                                        <td>
                                                                            <a data-fancybox="gallery" href="<?php echo e(asset('assets/images/documents/'.@$licence->driving_licence_front)); ?>"><img src="<?php echo e(asset('assets/images/documents/'.@$licence->driving_licence_front)); ?>" alt="" class="img-responsive" style="width: 40px;"></a>
                                                                        </td>
                                                                        <td>
                                                                            <a data-fancybox="gallery" href="<?php echo e(asset('assets/images/documents/'.@$licence->driving_licence_back)); ?>"><img src="<?php echo e(asset('assets/images/documents/'.@$licence->driving_licence_back)); ?>" alt="" class="img-responsive" style="width: 40px;"></a>
                                                                        </td>
                                                                        <td><?php echo e($licence->expiration_date ?? ''); ?></td>
                                                                        <td><?php echo e($licence->driving_licence_status ?? ''); ?></td>

                                                                        <td>
                                                                            <?php if($licence->driving_licence_status == 'Requested'): ?>
                                                                                <button class="btn btn-success pull-right mt-2 update_docs" data-id="<?php echo e($licence->id); ?>" data-status="Approved" data-type="driving_licences">Approve</button>
                                                                                <button class="btn btn-danger pull-right t-2 mr-1 update_docs" data-id="<?php echo e($licence->id); ?>" data-status="Rejected" data-type="driving_licences">Reject</button>  
                                                                            <?php endif; ?>
                                                                        </td>
                                                                    </tr>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                                            </tbody>
                                                        </table>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <?php else: ?>
                                            <h3 class="text-danger">Driver’s Licence (C) not submitted by Instructor</h3>
                                            <hr>
                                        <?php endif; ?>

                                        <?php if( isset($docs)): ?>
                                        <div id="inst-licence-container">
                                            <h3 class="pull-left">Driving Instructor’s Licence (C)</h3>

                                            <div class="clearfix"></div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row m-t-15">
                                                        <div class="col-md-6 small-margin-top-5">
                                                            <label for="">Expiration Date</label>
                                                            <input type="text" class="form-control" value="<?php echo e(@$docs->instructor_licence->expiration_date); ?>" readonly>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <p>Driver's Licence (C) - Front</p>
                                                            <?php if(@$docs->instructor_licence->instructor_licence_image==''): ?>
                                                                <img src="<?php echo e(asset('assets/images/empty.png')); ?>" alt="" class="img-responsive">
                                                            <?php else: ?>
                                                                <a data-fancybox="gallery" href=""><img src="<?php echo e(asset('assets/images/documents/'.@$docs->instructor_licence->instructor_licence_image)); ?>" alt="" class="img-responsive"></a>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                   <div>
                                                    <center>
                                                        <h4>Request Instructor’s Licence History</h4>
                                                        <hr>
                                                    </center>
                                                    <table class="table table-light">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Instructor Licence</th>
                                                                <th>Expiration Date</th>
                                                                <th>Status</th>
                                                                <th>Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $__currentLoopData = $instructor_licences; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ilicence): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <tr>
                                                                    <td><?php echo e($loop->iteration); ?></td>
                                                                    <td>
                                                                        <a data-fancybox="gallery" href="<?php echo e(asset('assets/images/documents/'.@$ilicence->instructor_licence_image)); ?>"><img src="<?php echo e(asset('assets/images/documents/'.@$ilicence->instructor_licence_image)); ?>" alt="" class="img-responsive" style="width: 40px;"></a>
                                                                    </td>
                                                                    
                                                                    <td><?php echo e($ilicence->expiration_date ?? ''); ?></td>
                                                                    <td><?php echo e($ilicence->instructor_licence_status ?? ''); ?></td>

                                                                    <td>
                                                                        <?php if($ilicence->instructor_licence_status == 'Requested'): ?>
                                                                            <button class="btn btn-success pull-right mt-2 update_docs" data-id="<?php echo e($ilicence->id); ?>" data-status="Approved" data-type="instructor_licences">Approve</button>
                                                                            <button class="btn btn-danger pull-right t-2 mr-1 update_docs" data-id="<?php echo e($ilicence->id); ?>" data-status="Rejected" data-type="instructor_licences">Reject</button>  
                                                                        <?php endif; ?>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                                        </tbody>
                                                    </table>
                                                   </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <?php else: ?>
                                            <h3 class="text-danger">Driver’s Licence (C) not submitted by Instructor</h3>
                                            <hr>
                                        <?php endif; ?>
                                        <?php if( isset($docs)): ?>
                                        <div id="wwcc-container">
                                            <h3 class="pull-left">Working with Children Check (WWCC)</h3>
                                            <div class="clearfix"></div>
                                            <div class="row ">
                                                <div class="col-md-12">
                                                    <form  id="update_dob_certifiacate_image_form" enctype="multipart/form-data">
                                                        <div class="row m-t-15">
                                                            <div class="col-md-6 small-margin-top-5">

                                                                <div class="form-group">
                                                                    <label for="">Full name</label>
                                                                    <input type="text" class="form-control"  value="<?php echo e(@$docs->wwcc_licence->name); ?>" readonly="true">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="">WWCC number (or application number)</label>
                                                                    <input type="text"  class="form-control" readonly="true"  value="<?php echo e(@$docs->wwcc_licence->wwcc_number); ?>">
                                                                </div>

                                                                <label for="">WWCC expiry date</label>
                                                                <input type="text"  class="form-control" readonly="true"  value="<?php echo e(@$docs->wwcc_licence->expiration_date); ?>">

                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group sl">
                                                                    <p>Date of Birth</p>
                                                                    <input type="text"  class="form-control" readonly="true"  value="<?php echo e(@$docs->wwcc_licence->dob); ?>">
                                                                </div>

                                                                <?php if(@$docs->wwcc_licence->wwcc_image!='' || @$docs->wwcc_licence->wwcc_image!='0'): ?>
                                                                    <div class="form-group">
                                                                        <img src="<?php echo e(asset('assets/images/documents/'.@$docs->wwcc_licence->wwcc_image)); ?>" alt="" class="img-responsive new_dob_image_preview">
                                                                    </div>
                                                                <?php else: ?>
                                                                     <div class="form-group">
                                                                        <img src="<?php echo e(asset('assets/images/empty.png')); ?>" alt="" class="img-responsive new_dob_image_preview">
                                                                    </div>
                                                                <?php endif; ?>
                                                               
                                                                <div>
                                                                    
                                                                        <label for="wwc_image" class="btn btn-primary" style="margin-top: 8px;">Upload Image</label>
                                                                        <input style="display: none" type="file" name="wwc_image" id="wwc_image" class="btn btn-primary" onchange="readURL(this, '.new_dob_image_preview')">
                                                                        <button class="btn btn-success">SAVE</button>
                                                                        <!-- <a href="#" id="update_dob_certifiacate_image" class="btn btn-success" style="margin-top: 15px;">Save</a> -->
                                                                        <input type="hidden" name="wwcc_licence_id" id="wwcc_licence_id" value="<?php echo e($docs->wwcc_licence->id ?? ''); ?>">
                                                                                                                                                                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <div>
                                                        <center>
                                                            <h4>Request WWCC History</h4>
                                                            <hr>
                                                        </center>
                                                        <table class="table table-light">
                                                            <thead class="thead-light">
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Name</th>
                                                                    <th>WWCC Number</th>
                                                                    <th>Date of Birth</th>
                                                                    <th>Expiration Date</th>
                                                                    <th>Status</th>
                                                                    <th>Actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $__currentLoopData = $wwcc_licences; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wlicence): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <tr>
                                                                        <td><?php echo e($loop->iteration); ?></td>
                                                                        <td><?php echo e($wlicence->name ?? ''); ?></td>
                                                                        
                                                                        <td><?php echo e($wlicence->wwcc_number ?? ''); ?></td>
                                                                        <td><?php echo e($wlicence->dob ?? ''); ?></td>
                                                                        <td><?php echo e($wlicence->expiration_date ?? ''); ?></td>
                                                                        <td><?php echo e($wlicence->wwcc_licence_status ?? ''); ?></td>
    
                                                                        <td>
                                                                            <?php if($wlicence->wwcc_licence_status == 'Requested'): ?>
                                                                                <button class="btn btn-success pull-right mt-2 update_docs" data-id="<?php echo e($wlicence->id); ?>" data-status="Approved" data-type="wwcc_licences">Approve</button>
                                                                                <button class="btn btn-danger pull-right t-2 mr-1 update_docs" data-id="<?php echo e($wlicence->id); ?>" data-status="Rejected" data-type="wwcc_licences">Reject</button>  
                                                                            <?php endif; ?>
                                                                        </td>
                                                                    </tr>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <?php else: ?>
                                            <h3 class="text-danger">Working with Children Check (WWCC) not submitted by Instructor</h3>
                                            <hr>
                                        <?php endif; ?>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="tab-pane fade show active" id="vehicle_details" role="tabpanel" aria-labelledby="pills-setting-tab">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <label class="" for="">Member of a driving instructor association?</label>
                                        <div class="input-group">
                                            <select disabled class="form-control" required="required" name="association_member" id="association_member">
                                                <option <?php echo e(@$user->user_meta->association_member == "No"? 'selected' : ''); ?> value="No">No</option>
                                                <option <?php echo e(@$user->user_meta->association_member == "Australia Driver Trainers Association (NSW & QLD)"? 'selected' : ''); ?> value="Australia Driver Trainers Association (NSW &amp; QLD)">Australia Driver Trainers Association (NSW &amp; QLD)</option>
                                                <option <?php echo e(@$user->user_meta->association_member == "NSW Driver Trainers Association"? 'selected' : ''); ?> value="NSW Driver Trainers Association">NSW Driver Trainers Association</option>
                                                <option <?php echo e(@$user->user_meta->association_member == "Australian Driver Trainers Association (Victoria) Inc"? 'selected' : ''); ?> value="Australian Driver Trainers Association (Victoria) Inc">Australian Driver Trainers Association (Victoria) Inc</option>
                                                <option <?php echo e(@$user->user_meta->association_member == "Other"? 'selected' : ''); ?> value="Other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12" id="member_input" style="display: none;">
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
                                    <div class="col-md-6">
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
                                            if(isset($user->user_meta->services_accreditation)){
                                                if( $user->user_meta->services_accreditation!=""){
                                                    $services_accreditation = json_decode($user->user_meta->services_accreditation);
                                                }
                                            }
                                            ?>
                                            <label for="instructor_user_1">
                                                <input type="checkbox" <?php if( in_array(1, $services_accreditation)): ?> checked <?php endif; ?> value="1" name="services_accreditation[]" id="instructor_user_1"> Driving test package: existing customers</label>
                                        </div>
                                        <div class="input-group">
                                            <label for="instructor_user_2">
                                                <input type="checkbox" <?php if( in_array(2, $services_accreditation)): ?> checked <?php endif; ?> value="2" name="services_accreditation[]" id="instructor_user_2"> Driving test package: new customers</label>
                                        </div>
                                        <div class="input-group">
                                            <label for="instructor_user_12">
                                                <input type="checkbox" <?php if( in_array(3, $services_accreditation)): ?>  checked <?php endif; ?> value="3" name="services_accreditation[]" id="instructor_user_12"> Manual Instructor accredited - no vehicle</label>
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
                                                    <input class="radio_buttons optional" type="radio" <?php if( @$user->user_meta->transmission_type == "auto"): ?> checked <?php endif; ?> value="auto" name="transmission_type" id="ansmission_type_0"> Auto </label>
                                            </div>
                                            <div class="radio m-r-5">
                                                <label for="ansmission_type_1">
                                                    <input class="radio_buttons optional" type="radio" <?php if( @$user->user_meta->transmission_type == "manual"): ?> checked <?php endif; ?> value="manual" name="transmission_type" id="ansmission_type_1"> Manual </label>
                                            </div>
                                            <div class="radio m-r-5">
                                                <label for="ansmission_type_2">
                                                    <input class="radio_buttons optional" type="radio" <?php if( @$user->user_meta->transmission_type == "both"): ?> checked <?php endif; ?> value="both" name="transmission_type" id="ansmission_type_2"> Both Transmissions </label>
                                            </div>
                                        </div>

                                        <div class="nested-field-blocks bordered d-none" id="instructor_user_vehicle_auto">
                                            <div class="fields" style="display: block;">
                                                <div class="vehicle_container" style="display: block;">
                                                    <center>
                                                        <h4>Vehicle for Auto</h4>
                                                        <hr>
                                                    </center>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label class="" for="">
                                                                ANCAP safety rating</label>

                                                            <div class="input-group">
                                                                <select class="form-control" required="required" name="ancap_rating" id="">
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
                                                                <select class="form-control" required="required" name="dual_controls" id="">
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
                                                                <input class=" form-control" required="required" type="text" value="<?php echo e(@$user->user_vehicle_auto->registration_number); ?>" name="registration_number">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="" for="">Transmission</label>
                                                            <div class="input-group">
                                                                <select class="form-control" readonly="readonly">
                                                                    <option value="Auto" selected>Auto</option>
                                                                </select>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="row m-t-10">
                                                        <div class="col-md-4">
                                                            <label class="" for=""> Make</label>
                                                            <div class="input-group">
                                                                <select class="form-control" required="required" name="vehicle_make" id="vehicle_make_auto">
                                                                    <option value=""></option>
                                                                    <?php $__currentLoopData = $car_make; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $make): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option <?php if(@$user->user_vehicle_auto->vehicle_make == $make->id): ?> selected <?php endif; ?>  value="<?php echo e($make->id); ?>"><?php echo e($make->title); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="" for=""> Model</label>
                                                            <div class="input-group ">
                                                                <select class=" form-control"  required="required" name="vehicle_model" id="vehicle_model_auto">
                                                                    <?php if(@$user->user_vehicle_auto->vehicle_model ==""): ?>
                                                                        <option value=""></option>
                                                                    <?php else: ?>
                                                                        <?php
                                                                            $car_model = \App\CarModel::whereId(@$user->user_vehicle_auto->vehicle_model)->first();
                                                                            if($car_model){
                                                                                echo "<option value='$car_model->id'>$car_model->title</option>";
                                                                            }else{
                                                                                echo "<option value=''></option>";
                                                                            }
                                                                        ?>
                                                                    <?php endif; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">

                                                            <label class="" for="">Year</label>

                                                            <div class="input-group ">
                                                                <select class="form-control" required="required" name="vehicle_year" id="vehicle_year_auto">
                                                                    <option value="<?php echo e(@$user->user_vehicle_auto->vehicle_year); ?>"><?php echo e(@$user->user_vehicle_auto->vehicle_year); ?></option>
                                                                </select>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                            <hr>
                                        <div class="nested-field-blocks bordered d-none" id="instructor_user_vehicle_manual">
                                            <div class="fields" style="display: block;">
                                                <div class="vehicle_container" style="display: block;">
                                                    <center>
                                                        <h4>Vehicle for Manual</h4>
                                                        <hr>
                                                    </center>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label class="" for="">
                                                                ANCAP safety rating</label>

                                                            <div class="input-group">
                                                                <select class="form-control" required="required" name="ancap_rating" id="">
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
                                                                <select class="form-control" required="required" name="dual_controls" id="">
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
                                                                <input class=" form-control" required="required" type="text" value="<?php echo e(@$user->user_vehicle_manual->registration_number); ?>" name="registration_number">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="" for="">Transmission</label>
                                                            <div class="input-group">
                                                                <select class="form-control" readonly="readonly" required="required">
                                                                    <option selected value="Manual">Manual</option>
                                                                </select>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="row m-t-10">
                                                        <div class="col-md-4">
                                                            <label class="" for=""> Make</label>
                                                            <div class="input-group">
                                                                <select class="form-control" required="required" name="vehicle_make">
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
                                                                <select class=" form-control"  required="required" name="vehicle_model" id="">
                                                                    <?php if(@$user->user_vehicle_manual->vehicle_model ==""): ?>
                                                                        <option value=""></option>
                                                                    <?php else: ?>
                                                                        <?php
                                                                            $car_model = \App\CarModel::whereId(@$user->user_vehicle_manual->vehicle_model)->first();
                                                                            if($car_model){
                                                                                echo "<option value='$car_model->id'>$car_model->title</option>";
                                                                            }else{
                                                                                echo "<option value=''></option>";
                                                                            }
                                                                        ?>
                                                                    <?php endif; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">

                                                            <label class="" for="">Year</label>

                                                            <div class="input-group ">
                                                                <select class="form-control" required="required" name="vehicle_year" id="">
                                                                    <option value="<?php echo e(@$user->user_vehicle_manual->vehicle_year); ?>"><?php echo e(@$user->user_vehicle_manual->vehicle_year); ?></option>
                                                                </select>
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
                </div>
            </div>

            <!-- Column -->
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <center>
                    <h4>Request Vehicle History</h4>
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
                            <th>Actions</th> 
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
                                <td>
                                    <?php if($notify->notify_status == 'Requested'): ?>
                                        <div class="btn-group-vertical">
                                            <button type="button" class="btn btn-info update_vehicle_status" data-notify_vehicle_id="<?php echo e($notify->instructer_vehicles->id); ?>" data-notify_status="Approved">Approve</button>
                                            <button type="button" class="btn btn-danger update_vehicle_status" data-notify_vehicle_id="<?php echo e($notify->instructer_vehicles->id); ?>" data-notify_status="Rejected"> Reject </button>
                                        </div>
                                    <?php endif; ?>                                    
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <script>
        var notifyType = "<?php echo e($notify_type); ?>";
        
        // inst_docs vehicle_details
        if(notifyType == 'instructor_licence' || notifyType == 'wwcc_licence' || notifyType == 'driving_licence'){
            console.log(notifyType);
            $("#inst_docs").addClass('show active');
            $("#vehicle-li").addClass('d-none');
            $("#vehicle_details").removeClass('show active');
        }

            $(document).on('click', '.update_docs', function (e) {
                // e.preventDefault();

                let id = $(this).data('id');
                let status = $(this).data('status');
                let type = $(this).data('type');
                $.ajax({
                    url: "<?php echo e(Route('document_status')); ?>",
                    data: {id:id,status:status,type:type},

                    type: 'POST',
                    success: function (res) {
                        if(res.success == true){
                            swal('Success', res.message, 'success').then((value) => {
                                location.reload(true);
                            });
                        }else if(res.success == false){
                            swal('Warning!', res.message, 'error').then((value) => {
                                location.reload(true);
                            });
                        }

                        $('#loading').hide();
                    },
                    error: function () {
                        $('#loading').hide();
                    }

                });
            });


        $(document).ready(function (){
            $('#vehicle_details input, #vehicle_details select').attr('disabled', true)
            // $('#vehicle_year').val('<?php echo e(@$user->user_meta->vehicle_year); ?>');
            // $('#vehicle_model').val('<?php echo e(@$user->user_meta->vehicle_model); ?>');
            // $('#vehicle_make').val('<?php echo e(@$user->user_meta->vehicle_make); ?>');


            $("#open_upload_form").click(function(e){
                e.preventDefault();
                $("#update_vehicle_image").toggle();
            });

            $("#open_upload_profile").click(function(e){
                e.preventDefault();
                $("#update_profile_image").toggle();
            });

            $("#vehicle_img").change(function(e){
                $('.new_image_preview').show();
                readURL(this, '.new_image_preview');
            });


            // $("#make_approve").click(function(e){
            $(document).on('click', '.update_vehicle_status', function (e) {
                // e.preventDefault();
                $('#loading').show();

                let notify_vehicle_id = $(this).data('notify_vehicle_id');
                let notify_status = $(this).data('notify_status');
                $.ajax({
                    url: "<?php echo e(Route('update_vehicle_status')); ?>",
                    data: {notify_vehicle_id: notify_vehicle_id,notify_status:notify_status},

                    type: 'POST',
                    success: function (res) {
                        if(res.success == true){
                            swal('Success', res.message, 'success').then((value) => {
                                location.reload(true);
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
            });
            //=============================================

            $('#update_profile_image').submit(function (){

                $('#loading').show();

                var data = new FormData(this);

                $.ajax({
                    url: "<?php echo e(Route('update_profile_img')); ?>",
                    data: data,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function (res) {
                        if(res.success == true){
                            swal('Success', res.message, 'success');
                            $('#update_profile_image')[0].reset();
                            $("#update_profile_image").toggle();
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

            //==================================================================

            $('#update_vehicle_image_for_auto').submit(function (){

                $('#loading').show();

                var data = new FormData(this);

                $.ajax({
                    url: "<?php echo e(Route('update_vehicle_img')); ?>",
                    data: data,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function (res) {
                        // console.log(res);
                        if(res.success == true){
                            // swal('Success', res.message, 'success');
                            swal('Success', res.message, 'success').then((value) => {
                                location.reload(true);
                            });
                            // $('#update_vehicle_image')[0].reset();
                            // $("#update_vehicle_image").toggle();
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

            $('#update_vehicle_image_for_manual').submit(function (){

                $('#loading').show();

                var data = new FormData(this);

                $.ajax({
                    url: "<?php echo e(Route('update_vehicle_img')); ?>",
                    data: data,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function (res) {
                        // console.log(res);
                        if(res.success == true){
                            swal('Success', res.message, 'success').then((value) => {
                                location.reload(true);
                            });
                            // $('#update_vehicle_image')[0].reset();
                            // $("#update_vehicle_image").toggle();
                            location.reload(true);
                            
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


            //==================================================================

            $('#update_dob_certifiacate_image_form').submit(function (){

                $('#loading').show();

                var data = new FormData(this);

                $.ajax({
                    url: "<?php echo e(Route('update_wwcc_img')); ?>",
                    data: data,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function (res) {
                        if(res.success == true){
                            swal('Success', res.message, 'success');
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


            var transmission_type = "<?php echo e(@$user->user_meta->transmission_type); ?>";
            // console.log(transmission_type);

            if(transmission_type == 'auto'){
                $('#instructor_user_vehicle_auto').removeClass('d-none');
                $('#instructor_user_vehicle_manual').addClass('d-none');
                $('#update_vehicle_image_for_auto').removeClass('d-none');
                $('#update_vehicle_image_for_manual').addClass('d-none');
                
            }else if(transmission_type == 'manual'){
                $('#instructor_user_vehicle_auto').addClass('d-none');
                $('#instructor_user_vehicle_manual').removeClass('d-none');
                $('#update_vehicle_image_for_auto').addClass('d-none');
                $('#update_vehicle_image_for_manual').removeClass('d-none');
            }else{
                $('#instructor_user_vehicle_auto').removeClass('d-none');
                $('#instructor_user_vehicle_manual').removeClass('d-none');
                $('#update_vehicle_image_for_auto').removeClass('d-none');
                $('#update_vehicle_image_for_manual').removeClass('d-none');
            }



        })
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/zenstech/public_html/resources/views/users/instructor_details.blade.php ENDPATH**/ ?>