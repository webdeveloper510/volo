<?php $__env->startSection('page-title'); ?>
<?php echo e(__('Event Information')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
<?php echo e(__('Event Information')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
<li class="breadcrumb-item"><?php echo e(__('Event Information')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('filter'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container-field">
    <div id="wrapper">
        <div id="page-content-wrapper">
            <div class="container-fluid xyz">
                <div class="row">
                    <dl class="row ">
                        <dt class="col-md-6 need_half"><span class="h6  mb-0"><?php echo e(__('Event')); ?></span></dt>
                        <dd class="col-md-6 need_half"><span class=""><?php echo e(!empty($event->name) ? $event->name : '-'); ?></span></dd>
                        <dt class="col-md-6 need_half"><span class="h6  mb-0"><?php echo e(__('Assigned Team Member')); ?></span></dt>
                        <dd class="col-md-6 need_half"><span class=""><?php echo e($assigned_to); ?></span></dd>
                        <dt class="col-md-6 need_half"><span class="h6  mb-0"><?php echo e(__('Start Date')); ?></span></dt>
                        <?php if($event->start_date): ?>
                        <dd class="col-md-6 need_half"><span class=""><?php echo e(\Auth::user()->dateFormat($event->start_date)); ?></span>
                        </dd>
                        <?php else: ?>
                        <dd class="col-md-6 need_half "><span class=""><?php echo e(\Auth::user()->dateFormat($event->start_date)); ?> -
                                <?php echo e(\Auth::user()->dateFormat($event->end_date)); ?></span></dd>
                        <?php endif; ?>

                        <dt class="col-md-6 need_half"><span class="h6  mb-0"><?php echo e(__('End Date')); ?></span></dt>
                        <?php if($event->end_date): ?>
                        <dd class="col-md-6 need_half"><span class=""><?php echo e(\Auth::user()->dateFormat($event->end_date)); ?></span>
                        </dd>
                        <?php else: ?>
                        <dd class="col-md-6 need_half "><span class=""><?php echo e(\Auth::user()->dateFormat($event->end_date)); ?> -
                                <?php echo e(\Auth::user()->dateFormat($event->end_date)); ?></span></dd>
                        <?php endif; ?>

                        <dt class="col-md-6 need_half"><span class="h6  mb-0"><?php echo e(__('Location')); ?></span></dt>
                        <dd class="col-md-6 need_half"><span class=""><?php echo e($event->venue_selection); ?></span></dd>

                        <dt class="col-md-6 need_half"><span class="h6  mb-0"><?php echo e(__('Link')); ?></span></dt>
                        <dd class="col-md-6 need_half"><span class=""><?php echo e($event->link); ?></span></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\volo\resources\views/meeting/detailed_view.blade.php ENDPATH**/ ?>