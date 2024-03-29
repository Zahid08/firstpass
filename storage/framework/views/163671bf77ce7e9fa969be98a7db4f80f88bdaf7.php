

<?php $__env->startSection('content'); ?>
<link href="<?php echo e(url('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')); ?>" rel="stylesheet">


<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">All Notification</h4>
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
                        <li class="breadcrumb-item active" aria-current="page">All Notifications</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">

    <div id="accordion">

        <div class="card">
            
            
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="pull-right">

                                <button class="refresh-btn btn btn-xs m-b-5 btn-primary m-b-5" data-toggle="tooltip" data-title="Refresh data" onclick="$('#datatable_table').DataTable().ajax.reload();"><i class="fas fa-sync-alt"></i></button>
                            </div>

                            <div class="table-responsive">
                                <table  id="datatable_table" class="table table-striped table-bordered display">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th >Notify Type</th>
                                        <th >Status</th>
                                        <th >Notify Request Date</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

    </div>

</div>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('assets/extra-libs/DataTables/datatables.min.js')); ?>"></script>
<script>

$(document).ready(function() {

    var table =  $('#datatable_table').DataTable({
        "processing": true,
        "serverSide": true,
        "lengthMenu": [ [5,10, 25, 50, 100, -1], [5,10, 25, 50, 100, "All"] ],
        "ajax": "<?php echo e(route('instructor.get_notifications')); ?>",
        "columns":[
            { "data": "id", name:'id' },
            { "data": "notify_type", name:'notify_type' },
            { "data": "notify_status", name:'notify_status' },
            { "data": "notify_request_date", name:'notify_request_date' },
            { "data": "action", name:'Actions', searchable: false, orderable: false },
        ]
    });  

});

</script>
<script>
    $(document).on('click', '.notify_view_status', function (e) {
        let notificationId = $(this).data('id');
        $.ajax({
            url: "<?php echo e(url('/instructor/view-notification/')); ?>"+"/"+notificationId,
            // data: notificationId,
            contentType: false,
            processData: false,
            type: 'get',
            success: function (res) {
                console.log(res);
                if(res.success == true){
                    if(res.notify_type == 'instructor_licence' || res.notify_type == 'wwcc_licence' || res.notify_type == 'driving_licence'){
                        var goto_url = "<?php echo e(url('/my-documents')); ?>/";
                    }else{
                        var goto_url = "<?php echo e(url('/profile-and-vehicle')); ?>/";
                    }
                    
                    window.location = goto_url;
                }else if(res.success == false){
                    swal('Warning!', res.message, 'error');
                }
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/zenstech/public_html/resources/views/instructor/notification/index.blade.php ENDPATH**/ ?>