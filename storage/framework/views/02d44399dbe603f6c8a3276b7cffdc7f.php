<?php $__env->startSection('page-title'); ?>
<?php echo e(__('Opportunities Information')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
<div class="page-header-title">
    <?php echo e(__('Opportunities Information')); ?>

</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
<li class="breadcrumb-item"><a href="<?php echo e(route('lead.index')); ?>"><?php echo e(__('Opportunities')); ?></a></li>
<li class="breadcrumb-item"><?php echo e(__('Opportunities Details')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div class="container-field">
    <div id="wrapper">
        <div id="page-content-wrapper">
            <div class="container-fluid xyz">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="useradd-1" class="card">
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
                                    <table class="table datatable" id="datatable">
                                        <thead>
                                            <tr>
                                                <th>Opportunity Name</th>
                                                <th>Assigned Team Member</th>
                                                <th>Value of Opportunity</th>
                                                <th>Currency</th>
                                                <th>Timing – Close</th>
                                                <th>Sales Stage</th>
                                                <th>Deal Length</th>
                                                <th>Difficulty Level</th>
                                                <th>Probability to close</th>
                                                <th>Select Category</th>
                                                <th>Sales Subcategory</th>
                                                <th>Competitor</th>
                                                <th>Products</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            use App\Models\User;
                                            if(@$lead->assigned_user){
                                            $assignedUserName = $lead->assigned_user ? User::find($lead->assigned_user) : null;

                                            $selected_products = json_decode($lead->products);
                                            $products = $selected_products ? implode(', ', $selected_products) : '-';
                                            }
                                            ?>
                                            <?php if($lead): ?>
                                            <tr>
                                                <td><?php echo e($lead->opportunity_name); ?></td>
                                                <td><?php echo e(@$assignedUserName ? $assignedUserName->name : '-'); ?></td>
                                                <td><?php echo e($lead->value_of_opportunity ?? '-'); ?></td>
                                                <td><?php echo e($lead->currency ?? '-'); ?></td>
                                                <td><?php echo e($lead->timing_close ?? '-'); ?></td>
                                                <td><?php echo e($lead->sales_stage ?? '-'); ?></td>
                                                <td><?php echo e($lead->deal_length ?? '-'); ?></td>
                                                <td><?php echo e($lead->difficult_level ?? '-'); ?></td>
                                                <td><?php echo e($lead->probability_to_close ?? '-'); ?></td>
                                                <td><?php echo e($lead->category ?? '-'); ?></td>
                                                <td><?php echo e($lead->sales_subcategory ?? '-'); ?></td>
                                                <td><?php echo e($lead->competitor ?? '-'); ?></td>
                                                <td><?php echo e($products); ?></td>
                                            </tr>
                                            <?php else: ?>
                                            <tr>
                                                <td colspan="12">No opportunity found.</td>
                                            </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid xyz mt-3">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card" id="useradd-1">
                            <div class="card-body table-border-style">
                                <h3>Primary Contact Information</h3>
                                <div class="row align-items-center ">
                                    <div class="col-md-4 need_half">
                                        <small class="h6  mb-3 mb-md-0"><?php echo e(__('Name')); ?> </small>
                                    </div>
                                    <?php if($lead->primary_name): ?>
                                    <div class="col-md-5 need_half ">
                                        <span class=""><?php echo e($lead->primary_name); ?></span>
                                    </div>
                                    <?php else: ?>
                                    <div class="col-md-5 need_half ">
                                        <span class="">--</span>
                                    </div>
                                    <?php endif; ?>
                                    <div class="col-md-4  mt-1 need_half">
                                        <small class="h6  mb-3 mb-md-0"><?php echo e(__('Email')); ?></small>
                                    </div>
                                    <?php if($lead->primary_email): ?>
                                    <div class="col-md-5  mt-1 need_half">
                                        <span class=""><?php echo e($lead->primary_email); ?></span>
                                    </div>
                                    <?php else: ?>
                                    <div class="col-md-5 need_half ">
                                        <span class="">--</span>
                                    </div>
                                    <?php endif; ?>
                                    <div class="col-md-4  mt-1 need_half">
                                        <small class="h6  mb-3 mb-md-0"><?php echo e(__('Phone Number')); ?></small>
                                    </div>
                                    <?php if($lead->primary_contact): ?>
                                    <div class="col-md-5  mt-1 need_half">
                                        <span class=""><?php echo e($lead->primary_contact); ?></span>
                                    </div>
                                    <?php else: ?>
                                    <div class="col-md-5 need_half ">
                                        <span class="">--</span>
                                    </div>
                                    <?php endif; ?>
                                    <div class="col-md-4  mt-1 need_half">
                                        <small class="h6  mb-3 mb-md-0"><?php echo e(__('Address')); ?></small>
                                    </div>
                                    <?php if($lead->primary_address): ?>
                                    <div class="col-md-5  mt-1 need_half">
                                        <span class=""><?php echo e($lead->primary_address); ?></span>
                                    </div>
                                    <?php else: ?>
                                    <div class="col-md-5 need_half ">
                                        <span class="">--</span>
                                    </div>
                                    <?php endif; ?>
                                    <div class="col-md-4  mt-1 need_half">
                                        <small class="h6  mb-3 mb-md-0"><?php echo e(__('Title/Designation')); ?></small>
                                    </div>
                                    <?php if($lead->primary_organization): ?>
                                    <div class="col-md-5  mt-1 need_half">
                                        <span class=""><?php echo e($lead->primary_organization); ?></span>
                                    </div>
                                    <?php else: ?>
                                    <div class="col-md-5 need_half ">
                                        <span class="">--</span>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card" id="useradd-1">
                            <div class="card-body table-border-style">
                                <h3>Secondary Contact Information</h3>
                                <div class="row align-items-center ">
                                    <div class="col-md-4 need_half">
                                        <small class="h6  mb-3 mb-md-0"><?php echo e(__('Name')); ?> </small>
                                    </div>
                                    <?php if($lead->secondary_name): ?>
                                    <div class="col-md-5 need_half ">
                                        <span class=""><?php echo e($lead->secondary_name); ?></span>
                                    </div>
                                    <?php else: ?>
                                    <div class="col-md-5 need_half ">
                                        <span class="">--</span>
                                    </div>
                                    <?php endif; ?>
                                    <div class="col-md-4  mt-1 need_half">
                                        <small class="h6  mb-3 mb-md-0"><?php echo e(__('Email')); ?></small>
                                    </div>
                                    <?php if($lead->secondary_email): ?>
                                    <div class="col-md-5  mt-1 need_half">
                                        <span class=""><?php echo e($lead->secondary_email); ?></span>
                                    </div>
                                    <?php else: ?>
                                    <div class="col-md-5 need_half ">
                                        <span class="">--</span>
                                    </div>
                                    <?php endif; ?>
                                    <div class="col-md-4  mt-1 need_half">
                                        <small class="h6  mb-3 mb-md-0"><?php echo e(__('Phone Number')); ?></small>
                                    </div>
                                    <?php if($lead->secondary_contact): ?>
                                    <div class="col-md-5  mt-1 need_half">
                                        <span class=""><?php echo e($lead->secondary_contact); ?></span>
                                    </div>
                                    <?php else: ?>
                                    <div class="col-md-5 need_half ">
                                        <span class="">--</span>
                                    </div>
                                    <?php endif; ?>
                                    <div class="col-md-4  mt-1 need_half">
                                        <small class="h6  mb-3 mb-md-0"><?php echo e(__('Address')); ?></small>
                                    </div>
                                    <?php if($lead->secondary_address): ?>
                                    <div class="col-md-5  mt-1 need_half">
                                        <span class=""><?php echo e($lead->secondary_address); ?></span>
                                    </div>
                                    <?php else: ?>
                                    <div class="col-md-5 need_half ">
                                        <span class="">--</span>
                                    </div>
                                    <?php endif; ?>
                                    <div class="col-md-4  mt-1 need_half">
                                        <small class="h6  mb-3 mb-md-0"><?php echo e(__('Title/Designation')); ?></small>
                                    </div>
                                    <?php if($lead->secondary_designation): ?>
                                    <div class="col-md-5  mt-1 need_half">
                                        <span class=""><?php echo e($lead->secondary_designation); ?></span>
                                    </div>
                                    <?php else: ?>
                                    <div class="col-md-5 need_half ">
                                        <span class="">--</span>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid xyz mt-3">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card" id="useradd-1">
                            <div class="card-body table-border-style">
                                <h3>Upload Documents</h3>
                                <?php echo e(Form::open(array('route' => ['lead.uploaddoc', $lead->id],'method'=>'post','enctype'=>'multipart/form-data' ,'id'=>'formdata'))); ?>

                                <label for="customerattachment">Attachment</label>
                                <input type="file" name="customerattachment" id="customerattachment" class="form-control" required>
                                <input type="submit" value="Submit" class="btn btn-primary mt-4" style="float: right;">
                                <?php echo e(Form::close()); ?>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card" id="useradd-1">
                            <div class="card-body table-border-style">
                                <h3>Attachments</h3>
                                <div class="table-responsive ">
                                    <table class="table table-bordered">
                                        <thead>
                                            <th>Attachment</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $docs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(Storage::disk('public')->exists($doc->filepath)): ?>
                                            <tr>
                                                <td><?php echo e($doc->filename); ?></td>
                                                <td><a href="<?php echo e(Storage::url('app/public/'.$doc->filepath)); ?>" download style="color: teal;" title="Download">View Document <i class="fa fa-download"></i></a>
                                            </tr>
                                            <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
<script>
    $(document).ready(function() {
        $('#addnotes').on('submit', function(e) {
            e.preventDefault();
            var id = <?php echo  $lead->id; ?>;
            var notes = $('input[name="notes"]').val();
            var createrid = <?php echo Auth::user()->id; ?>;

            $.ajax({
                url: "<?php echo e(route('addleadnotes', ['id' => $lead->id])); ?>",
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\volo\resources\views/lead/leadinfo.blade.php ENDPATH**/ ?>