<style>
    .ins .rounded-img{
        background: white;
        border: 3px solid white;
        -webkit-box-shadow: 0 5px 10px rgba(0,0,0,0.2);
        -moz-box-shadow: 0 5px 10px rgba(0,0,0,0.2);
        -ms-box-shadow: 0 5px 10px rgba(0,0,0,0.2);
        box-shadow: 0 5px 10px rgba(0,0,0,0.2);
        border-radius: 50%;
        overflow: hidden;
    }
    .ins .title{
        color: orange !important;
    }
    .row.ins {
        margin-bottom: 15px;
        border-bottom: 1px solid #ddd;
        padding: 15px 0px;
    }
    .row.ins:last-child {
        border: none !important;
    }

    .row.ins .pointer:hover{
        color: black !important;
        text-decoration: underline;
    }
</style>

<?php
$chunk = 0;
?>
    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $language = json_decode($user->language);

            if($language!=''){
                $language = implode(', ', $language);
            }

            if($user->preferred_name!=""){ $name = $user->preferred_name; }
            else { $name = $user->name; }

            $chunk++;
            if($chunk == 1){ ?>
                <div class="row ins">
           <?php } ?>

                <div class="col-md-6 user_<?php echo e($user->id); ?>">

                    <div class="user_wrap">

                        <div class="row">
                            <div class="col-md-6 profile_wrap">
                                <?php if( $user->avatar == ''): ?>
                                    <img src="<?php echo e(url('assets/images/users/default.png')); ?>" alt="user" >
                                <?php else: ?>
                                    <img src="<?php echo e(url('assets/images/users/'.$user->avatar)); ?>" alt="user" >
                                <?php endif; ?>
                                <div class="profile_btn">
                                    <a href="<?php echo e(url('/search/'.$search_id.'/instructors/profile/'.$user->id)); ?>" class="btn btn-info btn-outline-info btn-sm ">View Profile</a>
                                    <a href="#" class="btn btn-info btn-outline-info btn-sm av-btn" data-id="<?php echo e($user->id); ?>" onclick="return openCal('<?php echo e($user->id); ?>', '<?php echo e($name); ?>', '<?php echo e($search_id); ?>');">Available Times</a>
                                </div>
                            </div>

                            <div class="col-md-6 profile_cont_wrap">
                                <a href="" class=""> <?php echo e($name); ?> </a>
                                <div class="row">
                                    <!--
                                    <div class="col-md-6">
                                        <span onclick="show_inf('intl_conv')" class="text-info pointer">
                                            <i class="fa fa-globe fa-fw"></i> Intl conversions
                                        </span>
                                    </div>
                                    <div class="col-md-6">
                                        <span onclick="show_inf('your_car')" class="text-info pointer">
                                            <i class="fa fa-car fa-fw"></i> Your car or mine
                                        </span>
                                    </div>
                                    <div class="col-md-6">
                                        <span onclick="show_inf('logbook')" class="text-info pointer">
                                            <i class="fa fa-list-alt fa-fw"></i> Logbook 1hr=3hrs
                                        </span>
                                    </div>
                                    <div class="col-md-6">
                                        <span onclick="show_inf('driving_test')" class="text-info pointer">
                                            <i class="fa fa-drivers-license fa-fw"></i> Test package
                                        </span>
                                    </div>
                                    -->
                                    <div class="col-md-12 mt-2 book_now_btn">
                                        <a href="<?php echo e(url('book-online/book/'.$search_id.'/instructor/'.$user->id)); ?>" class="btn btn-success btn-outline-success btn-sm">Book Now</a>
                                    </div>

                                    <div class="col-md-12 mt-1 profile_cont">
                                        <p> <span class=""><?php echo e(ucfirst($name)); ?></span> speaks <?php echo e($language); ?> </p>
                                    </div>
                                    
                                    
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            <?php
            if($chunk == 2){
                $chunk = 0;
                echo '</div>';
            }
        ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


<?php /**PATH D:\xampp7.4.9\htdocs\firstpass\resources\views/search/search.blade.php ENDPATH**/ ?>