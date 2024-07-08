<?php $__env->startSection('page-title'); ?>
<?php echo e(__('Role')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
<?php echo e(__('Role')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
<li class="breadcrumb-item"><?php echo e(__('Role')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Role')): ?>
<div class="action-btn bg-warning ms-2">
    <a href="#" data-url="<?php echo e(route('role.create')); ?>" data-size="lg" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__(' Create')); ?>" data-title="<?php echo e(__('Create New Role')); ?>" class="btn btn-sm btn-primary btn-icon m-1">
        <i class="ti ti-plus"></i>
    </a>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('filter'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body table-border-style">
                <div class="table-responsive">
                    <table class="table datatable" id="datatable1">
                        <thead>
                            <tr>
                                <th width="150"><?php echo e(__('Role')); ?> </th>
                                <th><?php echo e(__('Permissions')); ?> </th>
                                <?php if(Gate::check('Edit Role') || Gate::check('Delete Role')): ?>
                                <th width="150" class="text-end"><?php echo e(__('Action')); ?> </th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>

                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <tr>
                                <td width="150"><?php echo e($role->name); ?></td>
                                <td class="Permission mt-10">
                                    <div class="badges">
                                        
                                        <?php $__currentLoopData = $role->permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span class="badge rounded p-2 m-1 px-3 bg-primary">
                                            <a href="#" class="text-white"><?php echo e($permission->name); ?></a>
                                        </span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </td>
                                <?php if(Gate::check('Edit Role') || Gate::check('Delete Role')): ?>
                                <td class="text-end">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Role')): ?>
                                    <div class="action-btn bg-info ms-2">
                                        <a href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white" data-url="<?php echo e(route('role.edit',$role->id)); ?>" data-size="lg" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-title="<?php echo e(__('Edit Role')); ?>">
                                            <i class="ti ti-edit"></i>
                                        </a>
                                    </div>
                                    <?php endif; ?>

                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Role')): ?>
                                    <div class="action-btn bg-danger ms-2">
                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['role.destroy', $role->id]]); ?>

                                        <a href="#!" class="mx-3 btn btn-sm  align-items-center text-white show_confirm" data-bs-toggle="tooltip" title='Delete'>
                                            <i class="ti ti-trash"></i>
                                        </a>
                                        <?php echo Form::close(); ?>

                                    </div>
                                    <?php endif; ?>
                                </td>
                                <?php endif; ?>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\volo\resources\views/role/index.blade.php ENDPATH**/ ?>