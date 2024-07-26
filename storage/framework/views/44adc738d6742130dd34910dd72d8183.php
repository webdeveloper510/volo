
<?php $__env->startSection('page-title'); ?>
<?php echo e(__('Report')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
<?php echo e(__('Power BI Report')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
<li class="breadcrumb-item"><?php echo e(__('Report')); ?></li>
<li class="breadcrumb-item"><?php echo e(__('Power BI Report')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div id="embed-container" style="width:100%;height:500px;"></div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script-page'); ?>
<script src="<?php echo e(asset('js/dist/powerbi.js')); ?>"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Check if powerbi object is loaded
        if (typeof powerbi === 'undefined') {
            console.error('Power BI JavaScript SDK not loaded');
            return;
        }

        let embedContainer = document.getElementById('embed-container');
        let embedConfiguration = {
            type: 'report',
            accessToken: '<?php echo e($accessToken); ?>',
            embedUrl: '<?php echo e($embedUrl); ?>',
            id: '<?php echo e($reportId); ?>',
            // permissions: 1,
            // tokenType: 1
        };

        // Log embedConfiguration to the console
        // console.log(embedConfiguration);

        // Embed the report
        let report = powerbi.embed(embedContainer, embedConfiguration);

        report.on('loaded', function() {
            console.log('Report loaded successfully');
        });

        report.on('error', function(event) {
            console.error('Error loading report', event.detail);
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\volo\resources\views/powerbi/index.blade.php ENDPATH**/ ?>