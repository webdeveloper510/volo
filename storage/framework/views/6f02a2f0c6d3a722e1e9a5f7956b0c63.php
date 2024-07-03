<?php
$currentYear = date('Y');
$years = [
$currentYear - 1 => $currentYear - 1,
$currentYear => $currentYear,
$currentYear + 1 => $currentYear + 1
];
?>
<style>
    .fa-asterisk {
        font-size: xx-small;
        position: absolute;
        padding: 1px;
    }

    .additional-product-category {
        display: none;
        margin-top: 10px;
    }

    #new_client {
        display: none;
    }

    #new_region {
        display: none;
    }

    .plus-btn i.fas.fa-plus.clone-btn {
        color: #fff;
        background: #48494b;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 10px;
    }

    .plus-btn {
        text-align: right;
        margin-top: -10px;
    }

    i.fas.fa-minus.remove-btn {
        color: #fff;
        background: #48494b;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 10px;
    }

    .minus-btn {
        text-align: right;
        margin-top: -10px;
    }

    .iti.iti--allow-dropdown.iti--separate-dial-code {
        width: 100%;
    }
</style>

<?php echo e(Form::open(array('route' => 'objective.store','method'=>'post'))); ?>

<input type="hidden" name="objectiveType" value="New" />
<div class="row">
    <div class="col-6 need_full">
        <div class="form-group">
            <?php echo e(Form::label('employee',__('Employee'),['class'=>'form-label'])); ?>

            <select class="form-control" name='employee' required>
                <option value="">Select Employee</option>
                <?php $__currentLoopData = $assinged_staff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option class="form-control" value="<?php echo e($staff->id); ?>"><?php echo e($staff->name); ?> (<?php echo e($staff->type); ?>)</option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            <?php echo e(Form::label('period', __('Period'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::select('year', $years, null, ['class' => 'form-control', 'placeholder' => __('Select Period'), 'required' => 'required'])); ?>

        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            <label for="category">Category</label>
            <input class="form-control" type="text" name="category" value="" placeholder="Enter Category">
        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            <label for="objective">Objective</label>
            <textarea class="form-control" name="objective" placeholder="Enter Objective"></textarea>
        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            <label for="measure">Measure</label>
            <select name="measure" class="form-control">
                <option value="" selected disabled>Select Measure</option>
                <option value="Complete all EIP document packs for Ajar participants in Volo EIP">Complete all EIP document packs for Ajar participants in Volo EIP</option>
                <option value="$1m USD/ £800k GBP of sales achieved between Volo/Ajar group of companies from internal introductions and/or cross selling products and services.">$1m USD/ £800k GBP of sales achieved between Volo/Ajar group of companies from internal introductions and/or cross selling products and services.</option>
                <option value="1. Ajar x Volo Consolidation & purchase agreement executed 2. Ajar x Volo MSA executed 3. Ajar x Volo MOU(s) executed 4. Voloforce UK x Volofleet purchase agreement executed">1. Ajar x Volo Consolidation & purchase agreement executed 2. Ajar x Volo MSA executed 3. Ajar x Volo MOU(s) executed 4. Voloforce UK x Volofleet purchase agreement executed</option>
                <option value="Ajartec branding & marketing materials updated to include 'A Volofleet portfolio company'">Ajartec branding & marketing materials updated to include 'A Volofleet portfolio company'</option>
                <option value="Create skills matrix for Systems Integration team. Map complimentary technology & services from Systems Integration team to Volo product suite to maximize sales potential.">Create skills matrix for Systems Integration team. Map complimentary technology & services from Systems Integration team to Volo product suite to maximize sales potential.</option>
                <option value="In liaison with other leaders grow commercial cross pollination by $1m.">In liaison with other leaders grow commercial cross pollination by $1m.</option>
                <option value="Establish consistent reporting format for Ajar Sales & Accounts data to Ash. Facilitate cross discipline meetings between Ajar team and Volo business units.">Establish consistent reporting format for Ajar Sales & Accounts data to Ash. Facilitate cross discipline meetings between Ajar team and Volo business units.</option>
                <option value="Financial reporting standards and frequency of issuing reports agreed with Ash Anand. Q1 reports all issued.">Financial reporting standards and frequency of issuing reports agreed with Ash Anand. Q1 reports all issued.</option>
                <option value="Strategic objectives and measures for Ajartec agreed and documented, issued out to key relevant people as part of EIP packs.">Strategic objectives and measures for Ajartec agreed and documented, issued out to key relevant people as part of EIP packs.</option>
            </select>
        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            <?php echo e(Form::label('key_dates', __('Key Dates'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::date('key_dates', null, ['class' => 'form-control'])); ?>

        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" class="form-control">
                <option value="" selected disabled>Select Status</option>
                <option value="Complete">Complete</option>
                <option value="In Progress">In Progress</option>
                <option value="Outstanding">Outstanding</option>
            </select>
        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            <label for="q1_updates">Q1 Updates</label>
            <textarea class="form-control" name="q1_updates" placeholder="Enter Q1 Updates"></textarea>
        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            <label for="q2_updates">Q2 Updates</label>
            <textarea class="form-control" name="q2_updates" placeholder="Enter Q2 Updates"></textarea>
        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            <label for="q3_updates">Q3 Updates</label>
            <textarea class="form-control" name="q3_updates" placeholder="Enter Q3 Updates"></textarea>
        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            <label for="q4_updates">Q4 Updates</label>
            <textarea class="form-control" name="q4_updates" placeholder="Enter Q4 Updates"></textarea>
        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            <label for="eoy_review">EOY Review</label>
            <textarea class="form-control" name="eoy_review" placeholder="Enter EOY Review"></textarea>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal">Close</button>
    <?php echo e(Form::submit(__('Save'),array('class'=>'btn btn-primary '))); ?>

</div>
<?php echo e(Form::close()); ?>

</div><?php /**PATH C:\xampp\htdocs\volo\resources\views/objective_tracker/create.blade.php ENDPATH**/ ?>