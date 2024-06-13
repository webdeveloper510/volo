<?php $__env->startSection('page-title'); ?>
<?php echo e(__('Clients')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
<div class="page-header-title">
    <?php echo e(__('Clients')); ?>

</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
<a href="#" data-url="<?php echo e(route('uploadusersinfo')); ?>" data-size="lg" data-ajax-popup="true" data-bs-toggle="tooltip" data-title="<?php echo e(__('New Client')); ?>" title="<?php echo e(__('Upload')); ?>" class="btn btn-sm btn-primary btn-icon m-1" id="updateAnchor">
    <i class="ti ti-plus"></i>
</a>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
<li class="breadcrumb-item"><?php echo e(__('Clients')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div class="container-field">
    <div id="wrapper">
        <div id="page-content-wrapper">
            <div class="container-fluid xyz">
                <div class="row">
                    <div class="col-lg-12 p0">
                        <div id="useradd-1" class="card">
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
                                    <table class="table datatable" id="datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="sort" data-sort="primary_name"><?php echo e(__('Name')); ?> <span class="opticy"> </span></th>
                                                <th scope="col" class="sort" data-sort="primary_email"><?php echo e(__('Email')); ?> <span class="opticy"> </span></th>
                                                <th scope="col" class="sort"><?php echo e(__('Phone Number')); ?> <span class="opticy"> </span></th>
                                                <th scope="col" class="sort"><?php echo e(__('Address')); ?> <span class="opticy"> </span></th>
                                                <th scope="col" class="sort"><?php echo e(__('Title/Designation')); ?> <span class="opticy"> </span></th>
                                                <th scope="col" class="sort"><?php echo e(__('Company Name')); ?> <span class="opticy"> </span></th>
                                                <th scope="col" class="sort"><?php echo e(__('Entity Name')); ?> <span class="opticy"> </span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $importedcustomers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customers): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td>
                                                    <a href="<?php echo e(route('customer.info',urlencode(encrypt($customers->id)))); ?>" title="<?php echo e(__('Client Details')); ?>" class="action-item text-primary" style="color:#1551c9 !important;">
                                                        <b> <?php echo e(ucfirst($customers->primary_name)); ?></b>
                                                    </a>
                                                </td>
                                                <td><?php echo e(ucfirst($customers->primary_email)); ?></td>
                                                <td><?php echo e(ucfirst($customers->primary_phone_number)); ?></td>
                                                <td><?php echo e(ucfirst($customers->primary_address)); ?></td>
                                                <td><?php echo e(ucfirst($customers->primary_organization)); ?></td>
                                                <td><?php echo e(ucfirst($customers->company_name)); ?></td>
                                                <td><?php echo e(ucfirst($customers->entity_name)); ?></td>
                                            </tr>
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\volo\resources\views/customer/allcustomers.blade.php ENDPATH**/ ?>