
<?php $__env->startSection('page-title'); ?>
<?php echo e(__('Categories')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
<div class="page-header-title">
    <?php echo e(__('Categories')); ?>

</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
<a href="#" data-bs-toggle="modal" data-bs-target="#createCategoryModal" data-bs-toggle="tooltip" data-title="<?php echo e(__('Create category')); ?>" title="<?php echo e(__('Create')); ?>" class="btn btn-sm btn-primary btn-icon m-1">
    <i class="ti ti-plus"></i>
</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
<li class="breadcrumb-item"><?php echo e(__('Categories')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php if(session('success')): ?>
<div class="alert alert-success">
    <?php echo e(session('success')); ?>

</div>
<?php endif; ?>
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
                                                <th scope="col" class="sort"><?php echo e(__('Sr No.')); ?> <span class="opticy"></span></th>
                                                <th scope="col" class="sort" data-sort="name"><?php echo e(__('Category Name')); ?> <span class="opticy"></span></th>
                                                <th scope="col" class="sort"><?php echo e(__('Created On')); ?><span class="opticy"></span></th>
                                                <th scope="col" class="sort"><?php echo e(__('Action')); ?> <span class="opticy"></span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $allCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($loop->iteration); ?></td>
                                                <td><?php echo e($category->name); ?></td>
                                                <td><?php echo e($category->created_at->format('F j, Y')); ?></td>
                                                <td>
                                                    <div class="action-btn bg-info ms-2">
                                                        <a href="javascript:void(0);" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white edit-category-btn" data-id="<?php echo e($category->id); ?>" data-name="<?php echo e($category->name); ?>">
                                                            <i class="ti ti-edit"></i>
                                                        </a>
                                                    </div>
                                                    <div class="action-btn bg-danger ms-2">
                                                        <a href="javascript:void(0);" class="mx-3 btn btn-sm align-items-center text-white delete-category-btn" data-id="<?php echo e($category->id); ?>" data-name="<?php echo e($category->name); ?>">
                                                            <i class="ti ti-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>
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

<!-- Create Category Modal -->
<div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCategoryModalLabel"><?php echo e(__('Create Category')); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="message" class="alert" style="display: none;"></div>
                <form id="createCategoryForm">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label for="categoryName" class="form-label"><?php echo e(__('Category Name')); ?></label>
                        <input type="text" class="form-control" id="categoryName" name="categoryName" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
                        <button type="submit" class="btn btn-primary"><?php echo e(__('Save')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Update Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoryModalLabel"><?php echo e(__('Edit Category')); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editCategoryForm" action="<?php echo e(route('category.update')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="id" id="editCategoryId">
                    <div class="form-group">
                        <label for="editCategoryName">Category Name</label>
                        <input type="text" class="form-control" id="editCategoryName" name="name" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoryModalLabel"><?php echo e(__('Delete Category')); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete <span id="deleteCategoryName"></span>?</p>
                <input type="hidden" id="deletedCategoryId" name="deletedCategoryId">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
            </div>
        </div>
    </div>
</div>



<?php $__env->stopSection(); ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#createCategoryForm').on('submit', function(e) {
            e.preventDefault();

            let categoryName = $('#categoryName').val();

            $.ajax({
                url: '<?php echo e(route("categories.create")); ?>',
                method: 'POST',
                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
                    categoryName: categoryName
                },
                success: function(response) {
                    if (response.status === 200) {
                        $('#message').removeClass().addClass('alert alert-success').text(response.message).show();
                        setTimeout(function() {
                            $('#createCategoryModal').modal('hide');
                            location.reload();
                        }, 2000);
                    } else if (response.status === 400) {
                        $('#message').removeClass().addClass('alert alert-danger').text(response.message).show();
                    }
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.edit-category-btn').on('click', function() {
            var categoryId = $(this).data('id');
            var categoryName = $(this).data('name');

            $('#editCategoryId').val(categoryId);
            $('#editCategoryName').val(categoryName);

            $('#editCategoryModal').modal('show');
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.delete-category-btn').on('click', function() {
            var categoryId = $(this).data('id');
            var categoryName = $(this).data('name');
            $('#deleteCategoryName').text(categoryName);
            $('#deletedCategoryId').val(categoryId);
            $('#confirmDeleteModal').modal('show');
        });

        $('#confirmDeleteBtn').on('click', function() {
            var deletedCategoryId = $('#deletedCategoryId').val();

            $.ajax({
                url: "<?php echo e(route('category.softDelete')); ?>",
                type: "POST",
                data: {
                    _token: "<?php echo e(csrf_token()); ?>",
                    id: deletedCategoryId
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function() {
                    toastr.error('Error marking category as deleted');
                }
            });

            $('#confirmDeleteModal').modal('hide');
        });
    });
</script>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\volo\resources\views/category/index.blade.php ENDPATH**/ ?>