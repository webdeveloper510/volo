<?php $__env->startSection('page-title'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
<li class="breadcrumb-item"><a href="<?php echo e(route('siteusers')); ?>"><?php echo e(__('Clients')); ?></a></li>
<li class="breadcrumb-item"><?php echo e(__('Client Details')); ?></li>
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
                                <h3>Opportunities</h3>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
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
                                                <th>Products</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            use App\Models\User;
                                            if(@$opportunity->assigned_user){
                                            $assignedUserName = $opportunity->assigned_user ? User::find($opportunity->assigned_user) : null;

                                            $selected_products = json_decode($opportunity->products);
                                            $products = $selected_products ? implode(', ', $selected_products) : '-';
                                            }
                                            ?>
                                            <?php if($opportunity): ?>
                                            <tr>
                                                <td><?php echo e($opportunity->opportunity_name); ?></td>
                                                <td><?php echo e(@$assignedUserName ? $assignedUserName->name : '-'); ?></td>
                                                <td><?php echo e($opportunity->value_of_opportunity ?? '-'); ?></td>
                                                <td><?php echo e($opportunity->currency ?? '-'); ?></td>
                                                <td><?php echo e($opportunity->timing_close ?? '-'); ?></td>
                                                <td><?php echo e($opportunity->sales_stage ?? '-'); ?></td>
                                                <td><?php echo e($opportunity->deal_length ?? '-'); ?></td>
                                                <td><?php echo e($opportunity->difficult_level ?? '-'); ?></td>
                                                <td><?php echo e($opportunity->probability_to_close ?? '-'); ?></td>
                                                <td><?php echo e($opportunity->category ?? '-'); ?></td>
                                                <td><?php echo e($opportunity->sales_subcategory ?? '-'); ?></td>
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
                    <div class="col-lg-6">
                        <div class="card" id="useradd-1">
                            <div class="card-body table-border-style">
                                <h3>Primary Contact</h3>
                                <div class="row align-items-center ">
                                    <div class="col-md-4 need_half">
                                        <small class="h6  mb-3 mb-md-0"><?php echo e(__('Name')); ?> </small>
                                    </div>
                                    <?php if($client->primary_name): ?>
                                    <div class="col-md-5 need_half ">
                                        <span class=""><?php echo e($client->primary_name); ?></span>
                                    </div>
                                    <?php else: ?>
                                    <div class="col-md-5 need_half ">
                                        <span class="">--</span>
                                    </div>
                                    <?php endif; ?>
                                    <div class="col-md-4  mt-1 need_half">
                                        <small class="h6  mb-3 mb-md-0"><?php echo e(__('Email')); ?></small>
                                    </div>
                                    <?php if($client->primary_email): ?>
                                    <div class="col-md-5  mt-1 need_half">
                                        <span class=""><?php echo e($client->primary_email); ?></span>
                                    </div>
                                    <?php else: ?>
                                    <div class="col-md-5 need_half ">
                                        <span class="">--</span>
                                    </div>
                                    <?php endif; ?>
                                    <div class="col-md-4  mt-1 need_half">
                                        <small class="h6  mb-3 mb-md-0"><?php echo e(__('Phone Number')); ?></small>
                                    </div>
                                    <?php if($client->primary_phone_number): ?>
                                    <div class="col-md-5  mt-1 need_half">
                                        <span class=""><?php echo e($client->primary_phone_number); ?></span>
                                    </div>
                                    <?php else: ?>
                                    <div class="col-md-5 need_half ">
                                        <span class="">--</span>
                                    </div>
                                    <?php endif; ?>
                                    <div class="col-md-4  mt-1 need_half">
                                        <small class="h6  mb-3 mb-md-0"><?php echo e(__('Address')); ?></small>
                                    </div>
                                    <?php if($client->primary_address): ?>
                                    <div class="col-md-5  mt-1 need_half">
                                        <span class=""><?php echo e($client->primary_address); ?></span>
                                    </div>
                                    <?php else: ?>
                                    <div class="col-md-5 need_half ">
                                        <span class="">--</span>
                                    </div>
                                    <?php endif; ?>
                                    <div class="col-md-4  mt-1 need_half">
                                        <small class="h6  mb-3 mb-md-0"><?php echo e(__('Title/Designation')); ?></small>
                                    </div>
                                    <?php if($client->primary_organization): ?>
                                    <div class="col-md-5  mt-1 need_half">
                                        <span class=""><?php echo e($client->primary_organization); ?></span>
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
                                <h3>Secondary Contact</h3>
                                <div class="row align-items-center ">
                                    <div class="col-md-4 need_half">
                                        <small class="h6  mb-3 mb-md-0"><?php echo e(__('Name')); ?> </small>
                                    </div>
                                    <?php if($client->secondary_name): ?>
                                    <div class="col-md-5 need_half ">
                                        <span class=""><?php echo e($client->secondary_name); ?></span>
                                    </div>
                                    <?php else: ?>
                                    <div class="col-md-5 need_half ">
                                        <span class="">--</span>
                                    </div>
                                    <?php endif; ?>
                                    <div class="col-md-4  mt-1 need_half">
                                        <small class="h6  mb-3 mb-md-0"><?php echo e(__('Email')); ?></small>
                                    </div>
                                    <?php if($client->secondary_email): ?>
                                    <div class="col-md-5  mt-1 need_half">
                                        <span class=""><?php echo e($client->secondary_email); ?></span>
                                    </div>
                                    <?php else: ?>
                                    <div class="col-md-5 need_half ">
                                        <span class="">--</span>
                                    </div>
                                    <?php endif; ?>
                                    <div class="col-md-4  mt-1 need_half">
                                        <small class="h6  mb-3 mb-md-0"><?php echo e(__('Phone Number')); ?></small>
                                    </div>
                                    <?php if($client->secondary_phone_number): ?>
                                    <div class="col-md-5  mt-1 need_half">
                                        <span class=""><?php echo e($client->secondary_phone_number); ?></span>
                                    </div>
                                    <?php else: ?>
                                    <div class="col-md-5 need_half ">
                                        <span class="">--</span>
                                    </div>
                                    <?php endif; ?>
                                    <div class="col-md-4  mt-1 need_half">
                                        <small class="h6  mb-3 mb-md-0"><?php echo e(__('Address')); ?></small>
                                    </div>
                                    <?php if($client->secondary_address): ?>
                                    <div class="col-md-5  mt-1 need_half">
                                        <span class=""><?php echo e($client->secondary_address); ?></span>
                                    </div>
                                    <?php else: ?>
                                    <div class="col-md-5 need_half ">
                                        <span class="">--</span>
                                    </div>
                                    <?php endif; ?>
                                    <div class="col-md-4  mt-1 need_half">
                                        <small class="h6  mb-3 mb-md-0"><?php echo e(__('Title/Designation')); ?></small>
                                    </div>
                                    <?php if($client->secondary_designation): ?>
                                    <div class="col-md-5  mt-1 need_half">
                                        <span class=""><?php echo e($client->secondary_designation); ?></span>
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
                                <h3>Other Details</h3>
                                <div class="row align-items-center ">
                                    <div class="col-md-4 need_half">
                                        <small class="h6  mb-3 mb-md-0"><?php echo e(__('Company Name')); ?> </small>
                                    </div>
                                    <?php if($client->company_name): ?>
                                    <div class="col-md-5 need_half ">
                                        <span class=""><?php echo e($client->company_name); ?></span>
                                    </div>
                                    <?php else: ?>
                                    <div class="col-md-5 need_half ">
                                        <span class="">--</span>
                                    </div>
                                    <?php endif; ?>
                                    <div class="col-md-4 need_half">
                                        <small class="h6  mb-3 mb-md-0"><?php echo e(__('Entity Name')); ?> </small>
                                    </div>
                                    <?php if($client->entity_name): ?>
                                    <div class="col-md-5 need_half ">
                                        <span class=""><?php echo e($client->entity_name); ?></span>
                                    </div>
                                    <?php else: ?>
                                    <div class="col-md-5 need_half ">
                                        <span class="">--</span>
                                    </div>
                                    <?php endif; ?>
                                    <div class="col-md-4 need_half">
                                        <small class="h6  mb-3 mb-md-0"><?php echo e(__('Location')); ?> </small>
                                    </div>
                                    <?php if($client->location): ?>
                                    <div class="col-md-5 need_half ">
                                        <span class=""><?php echo e($client->location); ?></span>
                                    </div>
                                    <?php else: ?>
                                    <div class="col-md-5 need_half ">
                                        <span class="">--</span>
                                    </div>
                                    <?php endif; ?>
                                    <div class="col-md-4  mt-1 need_half">
                                        <small class="h6  mb-3 mb-md-0"><?php echo e(__('Region')); ?></small>
                                    </div>
                                    <?php if($client->region): ?>
                                    <div class="col-md-5  mt-1 need_half">
                                        <span class=""><?php echo e($client->region); ?></span>
                                    </div>
                                    <?php else: ?>
                                    <div class="col-md-5 need_half ">
                                        <span class="">--</span>
                                    </div>
                                    <?php endif; ?>
                                    <div class="col-md-4  mt-1 need_half">
                                        <small class="h6  mb-3 mb-md-0"><?php echo e(__('Industry')); ?></small>
                                    </div>
                                    <?php if($client->industry): ?>
                                    <?php
                                    $industries = json_decode($client->industry, true);
                                    ?>
                                    <div class="col-md-5 mt-1 need_half">
                                        <span>
                                            <?php echo e(implode(', ', $industries)); ?>

                                        </span>
                                    </div>
                                    <?php else: ?>
                                    <div class="col-md-5 need_half">
                                        <span class="">--</span>
                                    </div>
                                    <?php endif; ?>
                                    <div class="col-md-4  mt-1 need_half">
                                        <small class="h6  mb-3 mb-md-0"><?php echo e(__('Engagement Level')); ?></small>
                                    </div>
                                    <?php if($client->engagement_level): ?>
                                    <div class="col-md-5  mt-1 need_half">
                                        <span class=""><?php echo e($client->engagement_level); ?></span>
                                    </div>
                                    <?php else: ?>
                                    <div class="col-md-5 need_half ">
                                        <span class="">--</span>
                                    </div>
                                    <?php endif; ?>
                                    <div class="col-md-4  mt-1 need_half">
                                        <small class="h6  mb-3 mb-md-0"><?php echo e(__('Revenue Booked To Date')); ?></small>
                                    </div>
                                    <?php if($client->revenue_booked_to_date): ?>
                                    <div class="col-md-5  mt-1 need_half">
                                        <span class=""><?php echo e($client->revenue_booked_to_date); ?></span>
                                    </div>
                                    <?php else: ?>
                                    <div class="col-md-5 need_half ">
                                        <span class="">--</span>
                                    </div>
                                    <?php endif; ?>
                                    <div class="col-md-4  mt-1 need_half">
                                        <small class="h6  mb-3 mb-md-0"><?php echo e(__('Referred By')); ?></small>
                                    </div>
                                    <?php if($client->referred_by): ?>
                                    <div class="col-md-5  mt-1 need_half">
                                        <span class=""><?php echo e($client->referred_by); ?></span>
                                    </div>
                                    <?php else: ?>
                                    <div class="col-md-5 need_half ">
                                        <span class="">--</span>
                                    </div>
                                    <?php endif; ?>
                                    <div class="col-md-4  mt-1 need_half">
                                        <small class="h6  mb-3 mb-md-0"><?php echo e(__('Status')); ?></small>
                                    </div>
                                    <?php if($client->status == 0): ?>
                                    <div class="col-md-5  mt-1 need_half">
                                        <span class="">Active</span>
                                    </div>
                                    <?php else: ?>
                                    <<div class="col-md-5  mt-1 need_half">
                                        <span class="">Inactive</span>
                                </div>
                                <?php endif; ?>
                                <div class="col-md-4  mt-1 need_half">
                                    <small class="h6  mb-3 mb-md-0"><?php echo e(__('Created At')); ?></small>
                                </div>
                                <?php if($client->created_at): ?>
                                <div class="col-md-5  mt-1 need_half">
                                    <span class=""><?php echo e(\Carbon\Carbon::parse($client->created_at)->format('F j, Y')); ?></span>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card" id="useradd-1">
                        <div class="card-body table-border-style">
                            <h3>Pain Points</h3>
                            <?php echo e($client->pain_points); ?>

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
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $files = Storage::files('app/public/External_customer/' . $client->id);
                                        ?>
                                        <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e(basename($file)); ?></td>
                                            <td><a href="<?php echo e(Storage::url($file)); ?>" download style="color: teal;" title="Download">
                                                    View Document <i class="fa fa-download"></i></a></td>
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
                            <h3>Notes</h3>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <th>Notes</th>
                                        <th>Created By</th>
                                        <th>Date</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?php echo e($client->notes); ?></td>
                                            <td><?php echo e(App\Models\User::where('id', $client->created_by)->first()->name); ?></td>
                                            <td><?php echo e(\Auth::user()->dateFormat($client->created_at)); ?></td>
                                        </tr>
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
                            <form action="<?php echo e(route('upload-info',urlencode(encrypt($client->id)))); ?>" method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <label for="customerattachment">Attachment</label>
                                <input type="file" name="customerattachment" id="customerattachment" class="form-control" required>
                                <input type="submit" value="Submit" class="btn btn-primary mt-4" style="float: right;">
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
                                <input type="submit" value="Submit" class="btn btn-primary mt-4" style=" float: right;">
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
            var id = <?php echo  $client->id; ?>;
            var notes = $('input[name="notes"]').val();
            var createrid = <?php echo Auth::user()->id; ?>;
            $.ajax({
                url: "<?php echo e(route('addusernotes', ['id' => $client->id])); ?>",
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