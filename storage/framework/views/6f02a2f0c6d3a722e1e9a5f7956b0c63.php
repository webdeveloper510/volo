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
            <select name="category" class="form-control">
                <option value="" selected disabled>Select Category</option>
                <option value="BDRG">BDRG</option>
                <option value="Innovation">Innovation</option>
                <option value="MVP D&D">MVP D&D</option>
                <option value="O&P">O&P</option>
                <option value="People & Culture">People & Culture</option>
            </select>
        </div>
    </div>
    <div class="col-12  p-0 modaltitle pb-3 mb-3">
        <h5 style="margin-left: 14px;"><?php echo e(__('Objective')); ?></h5>
    </div>
    <div class="col-6 need_full">
        <textarea rows="5" cols="60" name="objective" class="form-control" disabled>Select Objective</textarea>
    </div>
    <div class="col-6 mt-2 need_full">
        <textarea rows="5" cols="60" name="objective" class="form-control">Award allocated EIP awards and cascade SO into entire team.</textarea>
    </div>
    <div class="col-6 mt-2 need_full">
        <textarea rows="5" cols="60" name="objective" class="form-control">Complete platform consolidation agreements.</textarea>
    </div>
    <div class="col-6 mt-2 need_full">
        <textarea rows="5" cols="60" name="objective" class="form-control">Define system integration roles with each MVP execution to ensure seamless prospect management during pre-sales and closure processes.</textarea>
    </div>
    <div class="col-6 mt-2 need_full">
        <textarea rows="5" cols="60" name="objective" class="form-control">Ensure accounting and financial reporting alignment with Volo on a consolidated and non-idiosyncratic method.</textarea>
    </div>
    <div class="col-6 mt-2 need_full">
        <textarea rows="5" cols="60" name="objective" class="form-control">Grow net revenue from $4.6m to $5.2m in additional fees to Ajar.</textarea>
    </div>
    <div class="col-6 mt-2 need_full">
        <textarea rows="5" cols="60" name="objective" class="form-control">In liaison with other leaders grow commercial cross pollination by $1m.</textarea>
    </div>
    <div class="col-6 mt-2 need_full">
        <textarea rows="5" cols="60" name="objective" class="form-control">Lead the integration and alignment of Ajar and Volofleet.</textarea>
    </div>
    <div class="col-6 mt-2 need_full">
        <textarea rows="5" cols="60" name="objective" class="form-control">Refine people and Ajar identity process as a 'portfolio company'.</textarea>
    </div>
    <div class="col-6 mt-2 need_full">
        <textarea rows="5" cols="60" name="objective" class="form-control">Reset organisational tone for performance and meritocracy, through the establishment of measurable S.O.s, best attitude, practice, and S.O.Ps.</textarea>
    </div>
    <div class="col-12  p-0 modaltitle pb-3 mb-3">
        <h5 style="margin-left: 14px;"><?php echo e(__('Measure')); ?></h5>
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
    <!-- <div class="col-6 need_full">
        <div class="form-group">
            <label for="update">Update</label>
            <select name="update" class="form-control">
                <option value="" selected disabled>Select Update</option>
                <option value="q1_updates">Q1 Updates</option>
                <option value="q2_updates">Q2 Updates</option>
                <option value="q3_updates">Q3 Updates</option>
                <option value="q4_updates">Q4 Updates</option>
                <option value="eoy_review">EOY Review</option>
            </select>
        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            <label for="q1_updates">Q1 Updates</label>
            <select name="q1_updates" class="form-control">
                <option value="" selected disabled>Select Q1 Updates</option>
                <option value="(Blanks)">(Blanks)</option>
                <option value="(this is broken down into Ajar Sales team $250k chunks to incentivise their buy in & support. Also see updates for MK/OM/TM.) JK works quoted via DCL for Zev Hub (unsuccessful) & Solent transport microhub (live)">(this is broken down into Ajar Sales team $250k chunks to incentivise their buy in & support. Also see updates for MK/OM/TM.) JK works quoted via DCL for Zev Hub (unsuccessful) & Solent transport microhub (live)</option>
                <option value="£2,750,738.74 gross revenue Q1. Need to run through net calculation with Ash.">£2,750,738.74 gross revenue Q1. Need to run through net calculation with Ash.</option>
                <option value="All documents executed">All documents executed</option>
                <option value="Currently being reviewed in consultation with Bev to get better measures in place.">Currently being reviewed in consultation with Bev to get better measures in place.</option>
                <option value="Ongoing workstream aiming to complete during q2. *there's been various discussions on this subject throughout the last several months (including with PB) and general feeling is it should be platform or partner company. Portfolio company is deemed to signify being owned by Volofleet and projects wrong message currently.">Ongoing workstream aiming to complete during q2. *there's been various discussions on this subject throughout the last several months (including with PB) and general feeling is it should be platform or partner company. Portfolio company is deemed to signify being owned by Volofleet and projects wrong message currently.</option>
                <option value="Reports & formats agreed with Ash, all requested info provided for Q1. On-going for rest of year">Reports & formats agreed with Ash, all requested info provided for Q1. On-going for rest of year</option>
            </select>
        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            <label for="q2_updates">Q2 Updates</label>
            <select name="q2_updates" class="form-control">
                <option value="" selected disabled>Select Q2 Updates</option>
                <option value="(Blanks)">(Blanks)</option>
                <option value="N/A">N/A</option>
            </select>
        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            <label for="q3_updates">Q3 Updates</label>
            <select name="q3_updates" class="form-control">
                <option value="" selected disabled>Select Q3 Updates</option>
                <option value="(Blanks)">(Blanks)</option>
                <option value="N/A">N/A</option>
            </select>
        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            <label for="q4_updates">Q4 Updates</label>
            <select name="q4_updates" class="form-control">
                <option value="" selected disabled>Select Q4 Updates</option>
                <option value="(Blanks)">(Blanks)</option>
                <option value="N/A">N/A</option>
            </select>
        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            <label for="eoy_review">EOY Review</label>
            <select name="eoy_review" class="form-control">
                <option value="" selected disabled>Select EOY Review</option>
                <option value="(Blanks)">(Blanks)</option>
                <option value="Outstanding work.Have a beer on us">Outstanding work.Have a beer on us</option>
            </select>
        </div>
    </div>
</div> -->
    <div class="col-6 need_full">
        <div class="form-group">
            <label for="update">Update</label>
            <select name="update" class="form-control">
                <option value="" selected disabled>Select Update</option>
                <optgroup label="Q1 Updates">
                    <option value="(Blanks)">(Blanks)</option>
                    <option value="(this is broken down into Ajar Sales team $250k chunks to incentivise their buy in & support. Also see updates for MK/OM/TM.) JK works quoted via DCL for Zev Hub (unsuccessful) & Solent transport microhub (live)">(this is broken down into Ajar Sales team $250k chunks to incentivise their buy in & support. Also see updates for MK/OM/TM.) JK works quoted via DCL for Zev Hub (unsuccessful) & Solent transport microhub (live)</option>
                    <option value="£2,750,738.74 gross revenue Q1. Need to run through net calculation with Ash.">£2,750,738.74 gross revenue Q1. Need to run through net calculation with Ash.</option>
                    <option value="All documents executed">All documents executed</option>
                    <option value="Currently being reviewed in consultation with Bev to get better measures in place.">Currently being reviewed in consultation with Bev to get better measures in place.</option>
                    <option value="Ongoing workstream aiming to complete during q2. *there's been various discussions on this subject throughout the last several months (including with PB) and general feeling is it should be platform or partner company. Portfolio company is deemed to signify being owned by Volofleet and projects wrong message currently.">Ongoing workstream aiming to complete during q2. *there's been various discussions on this subject throughout the last several months (including with PB) and general feeling is it should be platform or partner company. Portfolio company is deemed to signify being owned by Volofleet and projects wrong message currently.</option>
                    <option value="Reports & formats agreed with Ash, all requested info provided for Q1. On-going for rest of year">Reports & formats agreed with Ash, all requested info provided for Q1. On-going for rest of year</option>
                </optgroup>
                <optgroup label="Q2 Updates">
                    <option value="(Blanks)">(Blanks)</option>
                    <option value="N/A">N/A</option>
                </optgroup>
                <optgroup label="Q3 Updates">
                    <option value="(Blanks)">(Blanks)</option>
                    <option value="N/A">N/A</option>
                </optgroup>
                <optgroup label="Q4 Updates">
                    <option value="(Blanks)">(Blanks)</option>
                    <option value="N/A">N/A</option>
                </optgroup>
                <optgroup label="EOY Review">
                    <option value="(Blanks)">(Blanks)</option>
                    <option value="Outstanding work. Have a beer on us">Outstanding work. Have a beer on us</option>
                </optgroup>
            </select>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn  btn-light" data-bs-dismiss="modal">Close</button>
        <?php echo e(Form::submit(__('Save'),array('class'=>'btn btn-primary '))); ?>

    </div>
    <?php echo e(Form::close()); ?><?php /**PATH C:\xampp\htdocs\volo\resources\views/objective_tracker/create.blade.php ENDPATH**/ ?>