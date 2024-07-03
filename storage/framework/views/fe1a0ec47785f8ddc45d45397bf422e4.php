<?php
$currentYear = date('Y');
$years = [
$currentYear - 1 => $currentYear - 1,
$currentYear => $currentYear,
$currentYear + 1 => $currentYear + 1
];
?>

<?php $__env->startSection('page-title'); ?>
<?php echo e(__('Objective Tracker')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
<?php echo e(__('Objective Tracker')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('objective.index')); ?>"><?php echo e(__('Objective Tracker')); ?></a></li>
<li class="breadcrumb-item"><?php echo e(__('Objective Tracker')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-btn'); ?>
<a href="#" data-url="<?php echo e(route('objective.create', ['objective', 0])); ?>" data-size="lg" data-ajax-popup="true" data-bs-toggle="tooltip" data-title="<?php echo e(__('Create New Objective')); ?>" title="<?php echo e(__('Create')); ?>" class="btn btn-sm btn-primary btn-icon m-1">
    <i class="ti ti-plus"></i>
</a>
<?php $__env->stopSection(); ?>
<style>
    .container {
        display: flex;
        justify-content: space-between;
        width: 100%;
    }

    .left,
    .right {
        width: 48%;
    }

    .header,
    .data {
        background-color: #90ee90;
        padding: 10px;
        margin-bottom: 10px;
    }

    .header div,
    .data div {
        display: inline-block;
        width: 50%;
    }

    .tasks-status {
        margin-top: 20px;
    }

    .tasks-status .status-header {
        font-weight: bold;
        text-align: left;
        margin-bottom: 5px;
    }

    .status-item {
        display: flex;
        justify-content: space-between;
        padding: 5px 0;
    }

    .outstanding {
        color: red;
    }

    .in-progress {
        color: orange;
    }

    .complete {
        color: green;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #fff;
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
        z-index: 1;
        min-width: 160px;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {
        background-color: #f1f1f1;
    }

    .table-header_add {
        background-color: #7bbd5d;
        color: #fff;
        text-align: center;
    }

    .input_form {
        width: 100%;
        height: 40px;
        border: none;
        text-align: center;
        margin: auto;
    }

    .tr_icon_border {
        background: #90D67A;
        color: #ffff;
    }

    .logo_img {
        margin-left: 10px;

        width: 233px;
        height: 50px
    }

    .border_table_set {
        border: 1px solid #d8d6d6;

    }

    th.Category_set {
        color: white;
        background-color: #7bbd5d;
    }

    table#objectiveTrackerDatatable {
        margin-top: 30px;
    }
</style>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body table-border-style">
                        <div class="table-responsive overflow_hidden">
                            <div class="row">
                                <div class="col-4 mt-3">
                                    <a href="">
                                        <img src="<?php echo e($logo.'new-volo-transparent-bg.png'); ?>" alt="logo" class='logo_img'>
                                    </a>
                                    <table class="table" style="width: 100%; border-collapse: collapse; margin-top:8px;">
                                        <tr class="table-header table-header_add">
                                            <th colspan="2">
                                                Doe Ref: Objective
                                                Tracker_V1_052024
                                            </th>
                                        </tr>
                                        <tr class="table-header table-header_add class='border_table_set'">
                                            <th>Name</th>
                                            <th>Period</th>
                                        </tr>
                                        <tr class='border_table_set'>
                                            <td>
                                                <select class="input_form" name="user_name" id="user_name">
                                                    <option value="" selected disabled>Select Name</option>
                                                    <?php $__currentLoopData = $assinged_staff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($staff->id); ?>"><?php echo e($staff->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="input_form" name="period" id="period">
                                                    <option value="" selected disabled>Select Period</option>
                                                    <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($year); ?>"><?php echo e($year); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-4"></div>
                                <div class="col-4">
                                    <table class="table" style="border-collapse: collapse">
                                        <thead>
                                            <tr>
                                                <th>Tasks</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="outstanding">Outstanding</td>
                                                <td class="outstanding outstanding-count"><?php echo e($outstandingTask ? $outstandingTask : 0); ?></td>
                                                <td class="outstanding outstanding-percentage"><?php echo e($outstandingTaskPercentage); ?>%</td>
                                            </tr>
                                            <tr>
                                                <td class="in-progress">In Progress</td>
                                                <td class="in-progress in-progress-count"><?php echo e($inProgressTask ? $inProgressTask : 0); ?></td>
                                                <td class="in-progress in-progress-percentage"><?php echo e($inProgressTaskPercentage); ?>%</td>
                                            </tr>
                                            <tr>
                                                <td class="complete">Complete</td>
                                                <td class="complete complete-count"><?php echo e($completeTask ? $completeTask : 0); ?></td>
                                                <td class="complete complete-percentage"><?php echo e($completeTaskPercentage); ?>%</td>
                                            </tr>
                                            <tr>
                                                <td>Total:</td>
                                                <td class="total total-count"><?php echo e($totalTask); ?></td>
                                                <td class="total total-percentage"><?php echo e($totalTaskPercentage); ?>%</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <table id="objectiveTrackerDatatable" class="display" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th class="Category_set">Team Member</th>
                                        <th class="Category_set">Category</th>
                                        <th class="Category_set">Objective</th>
                                        <th class="Category_set">Measure</th>
                                        <th class="Category_set">Key Dates</th>
                                        <th class="Category_set">Status</th>
                                        <th class="Category_set">Q1 Updates</th>
                                        <th class="Category_set">Q2 Updates</th>
                                        <th class="Category_set">Q3 Updates</th>
                                        <th class="Category_set">Q4 Updates</th>
                                        <th class="Category_set">EOY Review</th>
                                    </tr>
                                </thead>
                                <tbody id="objectives-tbody">
                                    <?php $__currentLoopData = $objectives; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $objective): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="border_table_set"><?php echo e(!empty($objective->user->name) ? $objective->user->name : ''); ?></td>
                                        <td class="border_table_set"><?php echo e($objective->category); ?></td>
                                        <td class="border_table_set"><?php echo e(!empty($objective->objective) ? $objective->objective : 'N/A'); ?></td>
                                        <td class="border_table_set"><?php echo e(!empty($objective->measure) ? $objective->measure : 'N/A'); ?></td>
                                        <td class="border_table_set"><?php echo e(\Carbon\Carbon::parse($objective->key_dates)->format('m/d/Y')); ?></td>
                                        <?php
                                        $color = '';

                                        if(isset($objective->status)) {
                                        if($objective->status == 'Complete') {
                                        $color = 'color: green;';
                                        } elseif($objective->status == 'In Progress') {
                                        $color = 'color: orange;';
                                        } elseif($objective->status == 'Outstanding') {
                                        $color = 'color: red;';
                                        }
                                        }
                                        ?>

                                        <td class="border_table_set" style="width: 135px;">
                                            <select name="update_status" class="form-control status-dropdown" style="<?php echo e($color); ?>" data-objective-id="<?php echo e($objective->id); ?>" onchange="updateStatus(this)">
                                                <option value="Complete" style="color: green;" <?php echo e($objective->status == 'Complete' ? 'selected' : ''); ?>>Complete</option>
                                                <option value="In Progress" style="color: orange;" <?php echo e($objective->status == 'In Progress' ? 'selected' : ''); ?>>In Progress</option>
                                                <option value="Outstanding" style="color: red;" <?php echo e($objective->status == 'Outstanding' ? 'selected' : ''); ?>>Outstanding</option>
                                            </select>
                                        </td>

                                        <td class="border_table_set">
                                            <?php echo e(!empty($objective->q1_updates) ? $objective->q1_updates : 'N/A'); ?>

                                        </td>
                                        <td class="border_table_set">
                                            <?php echo e(!empty($objective->q2_updates) ? $objective->q2_updates : 'N/A'); ?>

                                        </td>
                                        <td class="border_table_set">
                                            <?php echo e(!empty($objective->q3_updates) ? $objective->q3_updates : 'N/A'); ?>

                                        </td>
                                        <td class="border_table_set">
                                            <?php echo e(!empty($objective->q4_updates) ? $objective->q4_updates : 'N/A'); ?>

                                        </td>
                                        <td class="border_table_set">
                                            <?php echo e(!empty($objective->eoy_review) ? $objective->eoy_review : 'N/A'); ?>

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

<script>
    function updateStatus(select) {
        const objectiveId = select.dataset.objectiveId;
        const newStatus = select.value;

        $.ajax({
            url: "<?php echo e(route('objective-status.update')); ?>",
            type: 'POST',
            data: {
                _token: '<?php echo e(csrf_token()); ?>',
                id: objectiveId,
                status: newStatus
            },
            success: function(response) {
                $('.outstanding-count').text(response.outstandingTask);
                $('.outstanding-percentage').text(response.outstandingTaskPercentage + '%');
                $('.in-progress-count').text(response.inProgressTask);
                $('.in-progress-percentage').text(response.inProgressTaskPercentage + '%');
                $('.complete-count').text(response.completeTask);
                $('.complete-percentage').text(response.completeTaskPercentage + '%');
                $('.total-count').text(response.totalTask);
                $('.total-percentage').text(response.totalTaskPercentage + '%');

                // Optionally, update the color of the dropdown
                select.style.color = newStatus === 'Complete' ? 'green' : newStatus === 'In Progress' ? 'orange' : 'red';
            }
        });
    }
</script>

<script>
    $(document).ready(function() {
        function handleFilterChange() {
            var userId = $('#user_name').val();
            var period = $('#period').val();

            $.ajax({
                url: '<?php echo e(route("filter-objective.objective")); ?>',
                method: 'GET',
                data: {
                    user_id: userId,
                    period: period
                },
                success: function(response) {
                    // Update task counts and percentages
                    $('.outstanding-count').text(response.outstandingTask);
                    $('.outstanding-percentage').text(response.outstandingTaskPercentage + '%');
                    $('.in-progress-count').text(response.inProgressTask);
                    $('.in-progress-percentage').text(response.inProgressTaskPercentage + '%');
                    $('.complete-count').text(response.completeTask);
                    $('.complete-percentage').text(response.completeTaskPercentage + '%');
                    $('.total-count').text(response.totalTask);
                    $('.total-percentage').text(response.totalTaskPercentage + '%');

                    // Clear the current objectives table
                    $('#objectives-tbody').empty();

                    // Populate the objectives table with the new data
                    response.objectives.forEach(function(objective) {
                        var color = '';
                        if (objective.status == 'Complete') {
                            color = 'color: green;';
                        } else if (objective.status == 'In Progress') {
                            color = 'color: orange;';
                        } else if (objective.status == 'Outstanding') {
                            color = 'color: red;';
                        }

                        var objectiveRow = `
                            <tr>
                                <td class="border_table_set">${objective.user ? objective.user.name : ''}</td>
                                <td class="border_table_set">${objective.category}</td>
                                <td class="border_table_set">${objective.objective ? objective.objective : 'N/A'}</td>
                                <td class="border_table_set">${objective.measure ? objective.measure : 'N/A'}</td>
                                <td class="border_table_set">${objective.key_dates ? new Date(objective.key_dates).toLocaleDateString() : ''}</td>
                                <td class="border_table_set" style="width: 135px;">
                                    <select name="update_status" class="form-control status-dropdown" style="${color}" data-objective-id="${objective.id}" onchange="updateStatusForFilterObjectives(this)">
                                        <option value="Complete" style="color: green;" ${objective.status == 'Complete' ? 'selected' : ''}>Complete</option>
                                        <option value="In Progress" style="color: orange;" ${objective.status == 'In Progress' ? 'selected' : ''}>In Progress</option>
                                        <option value="Outstanding" style="color: red;" ${objective.status == 'Outstanding' ? 'selected' : ''}>Outstanding</option>
                                    </select>
                                </td>
                                <td class="border_table_set">${objective.q1_updates ? objective.q1_updates : 'N/A'}</td>
                                <td class="border_table_set">${objective.q2_updates ? objective.q2_updates : 'N/A'}</td>
                                <td class="border_table_set">${objective.q3_updates ? objective.q3_updates : 'N/A'}</td>
                                <td class="border_table_set">${objective.q4_updates ? objective.q4_updates : 'N/A'}</td>
                                <td class="border_table_set">${objective.eoy_review ? objective.eoy_review : 'N/A'}</td>
                            </tr>
                        `;

                        $('#objectives-tbody').append(objectiveRow);
                    });
                }
            });
        }

        // Attach change event listeners to the filters
        $('#user_name, #period').change(handleFilterChange);
    });
</script>

<script>
    function updateStatusForFilterObjectives(select) {
        const objectiveId = select.dataset.objectiveId;
        const newStatus = select.value;
        const userId = $('#user_name').val();
        const period = $('#period').val();

        // console.log('objectiveId :' + objectiveId);
        // console.log('newStatus :' + newStatus);
        // console.log('userId :' + userId);
        // console.log('period :' + period);
        // return false;

        $.ajax({
            url: "<?php echo e(route('objective-status-filter.update')); ?>",
            type: 'POST',
            data: {
                _token: '<?php echo e(csrf_token()); ?>',
                objective_id: objectiveId,
                status: newStatus,
                user_id: userId,
                period: period

            },
            success: function(response) {
                console.log(response);
                $('.outstanding-count').text(response.outstandingTask);
                $('.outstanding-percentage').text(response.outstandingTaskPercentage + '%');
                $('.in-progress-count').text(response.inProgressTask);
                $('.in-progress-percentage').text(response.inProgressTaskPercentage + '%');
                $('.complete-count').text(response.completeTask);
                $('.complete-percentage').text(response.completeTaskPercentage + '%');
                $('.total-count').text(response.totalTask);
                $('.total-percentage').text(response.totalTaskPercentage + '%');

                // Optionally, update the color of the dropdown
                select.style.color = newStatus === 'Complete' ? 'green' : newStatus === 'In Progress' ? 'orange' : 'red';
            }
        });
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\volo\resources\views/objective_tracker/index.blade.php ENDPATH**/ ?>