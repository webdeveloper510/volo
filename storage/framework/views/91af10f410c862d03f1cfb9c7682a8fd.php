<?php $__env->startSection('page-title'); ?>
<?php echo e(__(' Customers')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
<?php echo e(__(' Customers')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
<li class="breadcrumb-item"><a href="<?php echo e(route('siteusers')); ?>"><?php echo e(__('Customers')); ?></a></li>
<!-- <li class="breadcrumb-item"><a href="#"></a></li> -->
<li class="breadcrumb-item"><?php echo e(__('Customer Details')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container-field">
    <div id="wrapper">
        <div id="page-content-wrapper">
            <div class="container-fluid xyz p0">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card" id="useradd-1">
                            <div class="card-body table-border-style">
                                <div class="row align-items-center ">
                                    <div class="col-md-4 need_half">
                                        <small class="h6  mb-3 mb-md-0"><?php echo e(__('Name')); ?> </small>
                                    </div>
                                    <div class="col-md-5 need_half ">
                                        <span class=""><?php echo e($users->name); ?></span>
                                    </div>
                                    <div class="col-md-4  mt-1 need_half">
                                        <small class="h6  mb-3 mb-md-0"><?php echo e(__('Email')); ?></small>
                                    </div>
                                    <div class="col-md-5  mt-1 need_half">
                                        <span class=""><?php echo e($users->email); ?></span>
                                    </div>
                                    <div class="col-md-4  mt-1 need_half">
                                        <small class="h6  mb-3 mb-md-0"><?php echo e(__('Phone')); ?></small>
                                    </div>
                                    <div class="col-md-5  mt-1 need_half">
                                        <span class=""><?php echo e($users->phone); ?></span>
                                    </div>
                                    <div class="col-md-4  mt-1 need_half">
                                        <small class="h6  mb-3 mb-md-0"><?php echo e(__('Address')); ?></small>
                                    </div>
                                    <div class="col-md-5  mt-1 need_half">
                                        <span class=""><?php echo e($users->address); ?></span>
                                    </div>
                                    <div class="col-md-4  mt-1 need_half">
                                        <small class="h6  mb-3 mb-md-0"><?php echo e(__('Category')); ?></small>
                                    </div>
                                    <div class="col-md-5  mt-1 need_half">
                                        <span class=""><?php echo e($users->category); ?></span>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card" id="useradd-1">
                            <div class="card-body table-border-style">
                                <h3>Attachments</h3>
                                <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <th>Attachment</th>
                                        <!-- <th>Created By</th> -->
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <?php   
                                            $files = Storage::files('app/public/External_customer/'.$users->id);
                                        ?>
                                        <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e(basename($file)); ?></td>
                                            <td><a href="<?php echo e(Storage::url($file)); ?>" download style="color: teal;"
                                                    title="Download">
                                                    View Document <i class="fa fa-download"></i></a></td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
</div>
                                <!-- <h3>Attachments</h3>
                                <?php   
                                    $files = Storage::files('app/public/External_customer/'.$users->id);
                                ?>
                                <?php if(isset($files) && !empty($files)): ?>

                                <div class="col-md-12" style="    display: flex;">
                                    <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div>
                                        <p><?php echo e(basename($file)); ?></p>
                                        <div>

                                            <?php if(pathinfo($file, PATHINFO_EXTENSION) === 'pdf'): ?>
                                            <img src="<?php echo e(asset('extension_img/pdf.png')); ?>" alt="File"
                                                style="max-width: 100px; max-height: 150px;">
                                            <?php else: ?>
                                            <img src="<?php echo e(asset('extension_img/doc.png')); ?>" alt="File"
                                                style="max-width: 100px; max-height: 150px;">
                                            <?php endif; ?>
                                            <a href="<?php echo e(Storage::url($file)); ?>" download style=" position: absolute;">
                                                <i class="fa fa-download"></i></a>

                                        </div>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <?php endif; ?> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card" id="useradd-1">
                            <div class="card-body table-border-style">
                                <h3>Notes</h3>
                                <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <th>Notes</th>
                                        <th>Created By</th>
                                        <th>Date</th>
                                    </thead>
                                    <tbody>
                                        <tr><td><?php echo e($users->notes); ?></td>
                                        <td><?php echo e(App\Models\User::where('id', $users->created_by)->first()->name); ?></td>
                                        <td><?php echo e(\Auth::user()->dateFormat($users->created_at)); ?></td>
                                    </tr>
                                        <?php $__currentLoopData = $notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e(ucfirst($note->notes)); ?></td>
                                            <td><?php echo e((App\Models\User::where('id',$note->created_by)->first()->name)); ?></td>
                                            <td><?php echo e(\Auth::user()->dateFormat($note->created_at)); ?></td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card" id="useradd-1">
                            <div class="card-body table-border-style">
                                <h3>Upload Documents</h3>
                                <form action="<?php echo e(route('upload-info',urlencode(encrypt($users->id)))); ?>" method="POST"
                                    enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <label for="customerattachment">Attachment</label>
                                    <input type="file" name="customerattachment" id="customerattachment"
                                        class="form-control" required>
                                    <input type="submit" value="Submit" class="btn btn-primary mt-4"
                                        style="float: right;">
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body table-border-style">
                                <h3>Add Notes/Comments</h3>
                                <form method="POST" id="addnotes">
                                    <?php echo csrf_field(); ?>
                                    <label for="notes">Notes</label>
                                    <input type="text" class="form-control" name="notes">
                                    <input type="submit" value="Submit"  class="btn btn-primary mt-4"
                                        style=" float: right;">
                                </form>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<style>
.list-group-flush .list-group-item {
    background: none;
}
/* body{
    overflow-y: clip;
} */
</style>
<?php $__env->startPush('script-page'); ?>
<script>
$(document).ready(function() {
    $('#addnotes').on('submit', function(e) {
        e.preventDefault();
        var id = <?php echo  $users->id; ?>;
        var notes = $('input[name="notes"]').val();
        var createrid = <?php echo Auth::user()->id ;?>;
        $.ajax({
            url: "<?php echo e(route('addusernotes', ['id' => $users->id])); ?>",
            type: 'POST',
            data: {
                "notes": notes,
                "createrid": createrid,
                "_token": "<?php echo e(csrf_token()); ?>",
            },
            success: function(data) {
                location.reload();
            }
        });
    });
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\volo\resources\views/customer/userview.blade.php ENDPATH**/ ?>