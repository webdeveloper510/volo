<?php $__env->startSection('page-title'); ?>
<?php echo e(__('Opportunity Edit')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
<div class="page-header-title">
    <?php echo e(__('Edit Opportunity')); ?> <?php echo e('(' . $lead->opportunity_name . ')'); ?>

</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
<li class="breadcrumb-item"><a href="<?php echo e(route('lead.index')); ?>"><?php echo e(__('Opportunities')); ?></a></li>
<li class="breadcrumb-item"><?php echo e(__('Details')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
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
</style>
<div class="container-field">
    <div id="wrapper">

        <div id="page-content-wrapper">
            <div class="container-fluid xyz p0">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="useradd-1" class="card">
                            <?php echo e(Form::model($lead, ['route' => ['lead.update', $lead->id], 'method' => 'PUT', 'id' => "formdata"])); ?>

                            <div class="card-header">
                                <h5><?php echo e(__('Overview')); ?></h5>
                                <small class="text-muted"><?php echo e(__('Edit About Your Opportunities Information')); ?></small>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            <?php echo e(Form::label('lead_name',__('Opportunity Name'),['class'=>'form-label'])); ?>

                                            <span class="text-sm">
                                                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                            </span>
                                            <?php echo e(Form::text('lead_name',$lead->opportunity_name,array('class'=>'form-control','placeholder'=>__('Enter Opportunitie Name'),'required'=>'required'))); ?>

                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            <?php echo e(Form::label('client_name',__('Client Name'),['class'=>'form-label'])); ?>

                                            <?php echo e(Form::text('client_name',$client_name,array('class'=>'form-control','placeholder'=>__('Enter Client Name')))); ?>

                                        </div>
                                    </div>
                                    <input type="hidden" name="client_id" value="<?php echo e($lead->user_id); ?>">
                                    <div class="col-6 need_full" id="new_region">
                                        <div class="form-group">
                                            <?php echo e(Form::label('region',__('Region'),['class'=>'form-label'])); ?>

                                            <span class="text-sm">
                                                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                            </span>
                                            <?php echo e(Form::text('region',$lead->region,array('class'=>'form-control','placeholder'=>__('Enter Region')))); ?>

                                        </div>
                                    </div>

                                    <div class="col-12  p-0 modaltitle pb-3 mt-3">
                                        <h5 style="margin-left: 14px;"><?php echo e(__('Primary Contact Information')); ?></h5>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 need_full">
                                            <div class="form-group">
                                                <?php echo e(Form::label('primary_name',__('Name'),['class'=>'form-label'])); ?>

                                                <span class="text-sm">
                                                    <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                                </span>
                                                <?php echo e(Form::text('primary_name',$lead->primary_name,array('class'=>'form-control','placeholder'=>__('Enter Name'),'required'=>'required'))); ?>

                                            </div>
                                        </div>

                                        <div class="col-6 need_full">
                                            <div class="form-group intl-tel-input">
                                                <?php echo e(Form::label('primary_contact', __('Primary contact'), ['class' => 'form-label'])); ?>

                                                <span class="text-sm">
                                                    <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                                </span>
                                                <div class="intl-tel-input">
                                                    <input type="tel" name="primary_contact" class="phone-input form-control" placeholder="Enter Phone Number" maxlength="16" value="<?php echo e($lead->primary_contact); ?>" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6 need_full">
                                            <div class="form-group">
                                                <?php echo e(Form::label('primary_email',__('Email'),['class'=>'form-label'])); ?>

                                                <span class="text-sm">
                                                    <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                                </span>
                                                <?php echo e(Form::email('primary_email',$lead->primary_email,array('class'=>'form-control','placeholder'=>__('Enter Email'),'required'=>'required'))); ?>

                                            </div>
                                        </div>
                                        <div class="col-6 need_full">
                                            <div class="form-group">
                                                <?php echo e(Form::label('primary_address',__('Address'),['class'=>'form-label'])); ?>


                                                <?php echo e(Form::text('primary_address',$lead->primary_address,array('class'=>'form-control','placeholder'=>__('Enter Address')))); ?>

                                            </div>
                                        </div>
                                        <div class="col-6 need_full">
                                            <div class="form-group">
                                                <?php echo e(Form::label('primary_organization',__('Title/Designation'),['class'=>'form-label'])); ?>

                                                <?php echo e(Form::text('primary_organization',$lead->primary_organization,array('class'=>'form-control','placeholder'=>__('Enter Designation')))); ?>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12  p-0 modaltitle pb-3 mt-3">
                                        <h5 style="margin-left: 14px;"><?php echo e(__('Secondary Contact Information')); ?></h5>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 need_full">
                                            <input type="hidden" name="customerType" value="addForm" />
                                            <div class="form-group">
                                                <?php echo e(Form::label('secondary_name',__('Name'),['class'=>'form-label'])); ?>

                                                <?php echo e(Form::text('secondary_name',$lead->secondary_name,array('class'=>'form-control','placeholder'=>__('Enter Name')))); ?>

                                            </div>
                                        </div>
                                        <div class="col-6 need_full">
                                            <div class="form-group intl-tel-input">
                                                <?php echo e(Form::label('secondary_phone_number', __('Phone Number'), ['class' => 'form-label'])); ?>

                                                <div class="intl-tel-input">
                                                    <input type="tel" name="secondary_phone_number" class="phone-input form-control" placeholder="Enter Phone Number" maxlength="16" value="<?php echo e($lead->secondary_contact); ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 need_full">
                                            <div class="form-group">
                                                <?php echo e(Form::label('secondary_email',__('Email'),['class'=>'form-label'])); ?>

                                                <?php echo e(Form::email('secondary_email',$lead->secondary_email,array('class'=>'form-control','placeholder'=>__('Enter Email')))); ?>

                                            </div>
                                        </div>
                                        <div class="col-6 need_full">
                                            <div class="form-group">
                                                <?php echo e(Form::label('secondary_address',__('Address'),['class'=>'form-label'])); ?>

                                                <?php echo e(Form::text('secondary_address',$lead->secondary_address,array('class'=>'form-control','placeholder'=>__('Enter Address')))); ?>

                                            </div>
                                        </div>
                                        <div class="col-6 need_full">
                                            <div class="form-group">
                                                <?php echo e(Form::label('secondary_designation',__('Title/Designation'),['class'=>'form-label'])); ?>

                                                <?php echo e(Form::text('secondary_designation',$lead->secondary_designation,array('class'=>'form-control','placeholder'=>__('Enter Designation')))); ?>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12  p-0 modaltitle pb-3 mt-3">
                                        <h5 style="margin-left: 14px;"><?php echo e(__('Details')); ?></h5>
                                    </div>

                                    <div class="row">
                                        <div class="col-6 need_full">
                                            <div class="form-group">
                                                <?php echo e(Form::label('Assigned Team Member',__('Assigned Team Member'),['class'=>'form-label'])); ?>

                                                <select class="form-control" name='assign_staff' required>
                                                    <option value="">Select Team Member</option>
                                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option class="form-control" value="<?php echo e($user->id); ?>" <?php echo e($user->id == $lead->assigned_user ? 'selected' : ''); ?>>
                                                        <?php echo e($user->name); ?> - <?php echo e($user->type); ?>

                                                    </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6 need_full">
                                            <div class="form-group">
                                                <label for="value_of_opportunity">Value of Opportunity</label>
                                                <input type="text" id="value_of_opportunity" name="value_of_opportunity" value="<?php echo e($lead->value_of_opportunity); ?>" placeholder="Enter Value of Opportunity" class="form-control" onkeyup="formatCurrency(this)">
                                            </div>
                                        </div>
                                        <div class="col-6 need_full">
                                            <div class="form-group">
                                                <label for="currency">Currency</label>
                                                <select name="currency" class="form-control">
                                                    <option value="" disabled <?php echo e(is_null($lead->currency) ? 'selected' : ''); ?>>Select Currency</option>
                                                    <option value="GBP" <?php echo e($lead->currency == 'GBP' ? 'selected' : ''); ?>>GBP</option>
                                                    <option value="USD" <?php echo e($lead->currency == 'USD' ? 'selected' : ''); ?>>USD</option>
                                                    <option value="EUR" <?php echo e($lead->currency == 'EUR' ? 'selected' : ''); ?>>EUR</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6 need_full">
                                            <div class="form-group">
                                                <label for="timing_close">Timing – Close</label>
                                                <select name="timing_close" id="timing_close" class="form-control">
                                                    <option value="" disabled <?php echo e(is_null($lead->timing_close) ? 'selected' : ''); ?>>Select Timing – Close</option>
                                                    <option value="immediate" <?php echo e($lead->timing_close == 'immediate' ? 'selected' : ''); ?>>Immediate</option>
                                                    <option value="0-30-days" <?php echo e($lead->timing_close == '0-30-days' ? 'selected' : ''); ?>>0-30 Days</option>
                                                    <option value="31-90-days" <?php echo e($lead->timing_close == '31-90-days' ? 'selected' : ''); ?>>31 – 90 Days</option>
                                                    <option value="91-180-days" <?php echo e($lead->timing_close == '91-180-days' ? 'selected' : ''); ?>>91 – 180 Days</option>
                                                    <option value="181-360-days" <?php echo e($lead->timing_close == '181-360-days' ? 'selected' : ''); ?>>181 – 360 Days</option>
                                                    <option value="12-months-plus" <?php echo e($lead->timing_close == '12-months-plus' ? 'selected' : ''); ?>>12 Months +</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6 need_full">
                                            <div class="form-group">
                                                <label for="sales_stage">Sales Stage</label>
                                                <select name="sales_stage" id="sales_stage" class="form-control">
                                                    <option value="" disabled <?php echo e(is_null($lead->sales_stage) ? 'selected' : ''); ?>>Select Sales Stage</option>
                                                    <option value="New" <?php echo e($lead->sales_stage == 'New' ? 'selected' : ''); ?>>New</option>
                                                    <option value="Contacted" <?php echo e($lead->sales_stage == 'Contacted' ? 'selected' : ''); ?>>Contacted</option>
                                                    <option value="Qualifying" <?php echo e($lead->sales_stage == 'Qualifying' ? 'selected' : ''); ?>>Qualifying</option>
                                                    <option value="Qualified" <?php echo e($lead->sales_stage == 'Qualified' ? 'selected' : ''); ?>>Qualified</option>
                                                    <option value="NDA Signed" <?php echo e($lead->sales_stage == 'NDA Signed' ? 'selected' : ''); ?>>NDA Signed</option>
                                                    <option value="Demo or Meeting" <?php echo e($lead->sales_stage == 'Demo or Meeting' ? 'selected' : ''); ?>>Demo or Meeting</option>
                                                    <option value="Proposal" <?php echo e($lead->sales_stage == 'Proposal' ? 'selected' : ''); ?>>Proposal</option>
                                                    <option value="Negotiation" <?php echo e($lead->sales_stage == 'Negotiation' ? 'selected' : ''); ?>>Negotiation</option>
                                                    <option value="Awaiting Decision" <?php echo e($lead->sales_stage == 'Awaiting Decision' ? 'selected' : ''); ?>>Awaiting Decision</option>
                                                    <option value="Closed Won" <?php echo e($lead->sales_stage == 'Closed Won' ? 'selected' : ''); ?>>Closed Won</option>
                                                    <option value="Closed Lost" <?php echo e($lead->sales_stage == 'Closed Lost' ? 'selected' : ''); ?>>Closed Lost</option>
                                                    <option value="Close No Decision" <?php echo e($lead->sales_stage == 'Close No Decision' ? 'selected' : ''); ?>>Close No Decision</option>
                                                    <option value="Follow-Up Needed" <?php echo e($lead->sales_stage == 'Follow-Up Needed' ? 'selected' : ''); ?>>Follow-Up Needed</option>
                                                    <option value="Implementation" <?php echo e($lead->sales_stage == 'Implementation' ? 'selected' : ''); ?>>Implementation</option>
                                                    <option value="Renewal" <?php echo e($lead->sales_stage == 'Renewal' ? 'selected' : ''); ?>>Renewal</option>
                                                    <option value="Upsell" <?php echo e($lead->sales_stage == 'Upsell' ? 'selected' : ''); ?>>Upsell</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6 need_full">
                                            <div class="form-group">
                                                <label for="deal_length">Deal Length</label>
                                                <select name="deal_length" id="deal_length" class="form-control">
                                                    <option value="" disabled <?php echo e(is_null($lead->deal_length) ? 'selected' : ''); ?>>Select Deal Length</option>
                                                    <option value="One Time" <?php echo e($lead->deal_length == 'One Time' ? 'selected' : ''); ?>>One Time</option>
                                                    <option value="Short Term" <?php echo e($lead->deal_length == 'Short Term' ? 'selected' : ''); ?>>Short Term</option>
                                                    <option value="On a Needed basis" <?php echo e($lead->deal_length == 'On a Needed basis' ? 'selected' : ''); ?>>On a Needed basis</option>
                                                    <option value="Annual" <?php echo e($lead->deal_length == 'Annual' ? 'selected' : ''); ?>>Annual</option>
                                                    <option value="Multi Year" <?php echo e($lead->deal_length == 'Multi Year' ? 'selected' : ''); ?>>Multi Year</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6 need_full">
                                            <div class="form-group">
                                                <label for="difficult_level">Difficulty Level</label>
                                                <select name="difficult_level" id="difficult_level" class="form-control">
                                                    <option value="" disabled <?php echo e(is_null($lead->difficult_level) ? 'selected' : ''); ?>>Select Difficulty Level</option>
                                                    <option value="Very Easy" <?php echo e($lead->difficult_level == 'Very Easy' ? 'selected' : ''); ?>>Very Easy</option>
                                                    <option value="Easy" <?php echo e($lead->difficult_level == 'Easy' ? 'selected' : ''); ?>>Easy</option>
                                                    <option value="Moderate" <?php echo e($lead->difficult_level == 'Moderate' ? 'selected' : ''); ?>>Moderate</option>
                                                    <option value="Challenging" <?php echo e($lead->difficult_level == 'Challenging' ? 'selected' : ''); ?>>Challenging</option>
                                                    <option value="Difficult" <?php echo e($lead->difficult_level == 'Difficult' ? 'selected' : ''); ?>>Difficult</option>
                                                    <option value="Very Difficult" <?php echo e($lead->difficult_level == 'Very Difficult' ? 'selected' : ''); ?>>Very Difficult</option>
                                                    <option value="Complex" <?php echo e($lead->difficult_level == 'Complex' ? 'selected' : ''); ?>>Complex</option>
                                                    <option value="High Risk" <?php echo e($lead->difficult_level == 'High Risk' ? 'selected' : ''); ?>>High Risk</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6 need_full">
                                            <div class="form-group">
                                                <label for="probability_to_close">Probability to close</label>
                                                <select name="probability_to_close" id="probability_to_close" class="form-control">
                                                    <option value="" disabled <?php echo e(is_null($lead->probability_to_close) ? 'selected' : ''); ?>>Select Probability to close</option>
                                                    <option value="Highly Probable" <?php echo e($lead->probability_to_close == 'Highly Probable' ? 'selected' : ''); ?>>Highly Probable</option>
                                                    <option value="Probable" <?php echo e($lead->probability_to_close == 'Probable' ? 'selected' : ''); ?>>Probable</option>
                                                    <option value="Likely" <?php echo e($lead->probability_to_close == 'Likely' ? 'selected' : ''); ?>>Likely</option>
                                                    <option value="Possible" <?php echo e($lead->probability_to_close == 'Possible' ? 'selected' : ''); ?>>Possible</option>
                                                    <option value="Unlikely" <?php echo e($lead->probability_to_close == 'Unlikely' ? 'selected' : ''); ?>>Unlikely</option>
                                                    <option value="Highly Unlikely" <?php echo e($lead->probability_to_close == 'Highly Unlikely' ? 'selected' : ''); ?>>Highly Unlikely</option>
                                                    <option value="Unknown" <?php echo e($lead->probability_to_close == 'Unknown' ? 'selected' : ''); ?>>Unknown</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6 need_full">
                                            <div class="form-group">
                                                <label for="category">Select Category</label>
                                                <select name="category" id="category" class="form-control">
                                                    <option value="" disabled <?php echo e(is_null($lead->category) ? 'selected' : ''); ?>>Select Category</option>
                                                    <option value="Partner" <?php echo e($lead->category == 'Partner' ? 'selected' : ''); ?>>Partner</option>
                                                    <option value="Reseller" <?php echo e($lead->category == 'Reseller' ? 'selected' : ''); ?>>Reseller</option>
                                                    <option value="Introducer" <?php echo e($lead->category == 'Introducer' ? 'selected' : ''); ?>>Introducer</option>
                                                    <option value="Direct Customer" <?php echo e($lead->category == 'Direct Customer' ? 'selected' : ''); ?>>Direct Customer</option>
                                                    <option value="Host" <?php echo e($lead->category == 'Host' ? 'selected' : ''); ?>>Host</option>
                                                    <option value="Tennant" <?php echo e($lead->category == 'Tennant' ? 'selected' : ''); ?>>Tennant</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6 need_full">
                                            <div class="form-group">
                                                <label for="sales_subcategory">Sales Subcategory</label>
                                                <select name="sales_subcategory" id="sales_subcategory" class="form-control">
                                                    <option value="" disabled <?php echo e(is_null($lead->sales_subcategory) ? 'selected' : ''); ?>>Select Sales Subcategory</option>
                                                    <option value="Public" <?php echo e($lead->sales_subcategory == 'Public' ? 'selected' : ''); ?>>Public</option>
                                                    <option value="Private" <?php echo e($lead->sales_subcategory == 'Private' ? 'selected' : ''); ?>>Private</option>
                                                    <option value="Government" <?php echo e($lead->sales_subcategory == 'Government' ? 'selected' : ''); ?>>Government</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6 need_full">
                                            <div class="form-group">
                                                <?php echo e(Form::label('competitor',__('Competitor'),['class'=>'form-label'])); ?>

                                                <?php echo e(Form::text('competitor',$lead->competitor,array('class'=>'form-control','placeholder'=>__('Enter Competitor')))); ?>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12  p-0 modaltitle pb-3 mt-3">
                                        <h5 style="margin-left: 14px;"><?php echo e(__('Products')); ?></h5>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            <input type="checkbox" id="hardware-one-time" name="products[]" value="Hardware One Time" <?php echo !is_null($lead->products) && in_array('Hardware One Time', json_decode($lead->products, true)) ? 'checked' : ''; ?> onchange="showAdditionalProductCategoryFields()">
                                            <label for="hardware-one-time">Hardware One Time</label><br>

                                            <input type="checkbox" id="hardware-maintenance" name="products[]" value="Hardware Maintenance Contracts" <?php echo !is_null($lead->products) && in_array('Hardware Maintenance Contracts', json_decode($lead->products, true)) ? 'checked' : ''; ?> onchange="showAdditionalProductCategoryFields()">
                                            <label for="hardware-maintenance">Hardware Maintenance Contracts</label><br>

                                            <input type="checkbox" id="software-recurring" name="products[]" value="Software Recurring" <?php echo !is_null($lead->products) && in_array('Software Recurring', json_decode($lead->products, true)) ? 'checked' : ''; ?> onchange="showAdditionalProductCategoryFields()">
                                            <label for="software-recurring">Software Recurring</label><br>

                                            <input type="checkbox" id="software-one-time" name="products[]" value="Software One Time" <?php echo !is_null($lead->products) && in_array('Software One Time', json_decode($lead->products, true)) ? 'checked' : ''; ?> onchange="showAdditionalProductCategoryFields()">
                                            <label for="software-one-time">Software One Time</label><br>

                                            <input type="checkbox" id="systems-integrations" name="products[]" value="Systems Integrations" <?php echo !is_null($lead->products) && in_array('Systems Integrations', json_decode($lead->products, true)) ? 'checked' : ''; ?> onchange="showAdditionalProductCategoryFields()">
                                            <label for="systems-integrations">Systems Integrations</label><br>

                                            <input type="checkbox" id="subscriptions" name="products[]" value="Subscriptions" <?php echo !is_null($lead->products) && in_array('Subscriptions', json_decode($lead->products, true)) ? 'checked' : ''; ?> onchange="showAdditionalProductCategoryFields()">
                                            <label for="subscriptions">Subscriptions</label><br>

                                            <input type="checkbox" id="tech-deployment" name="products[]" value="Tech Deployment Volume based" <?php echo !is_null($lead->products) && in_array('Tech Deployment Volume based', json_decode($lead->products, true)) ? 'checked' : ''; ?> onchange="showAdditionalProductCategoryFields()">
                                            <label for="tech-deployment">Tech Deployment Volume based</label><br>
                                        </div>
                                    </div>

                                    <div id="hardware-one-time-fields" class="additional-product-category card">
                                        <h5>Hardware One Time</h5>
                                        <?php if($hardware_one_time): ?>
                                        <?php $__currentLoopData = $hardware_one_time; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $hardware): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="product_title_hardware_one_time_<?php echo e($index); ?>" name="product_title_hardware_one_time[]" placeholder="Product Title" value="<?php echo e($hardware['title'] ?? ''); ?>">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="product_price_hardware_one_time_<?php echo e($index); ?>" name="product_price_hardware_one_time[]" placeholder="Product Price" onkeyup="formatCurrency(this)" value="<?php echo e($hardware['price'] ?? ''); ?>">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="product_quantity_hardware_one_time_<?php echo e($index); ?>" name="product_quantity_hardware_one_time[]" placeholder="Product Quantity" value="<?php echo e($hardware['quantity'] ?? ''); ?>">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <select name="unit_hardware_one_time[]" id="unit_hardware_one_time_<?php echo e($index); ?>" class="form-control" onchange="onUnitChange(this, 'hardware_one_time')">
                                                        <option value="" selected disabled>Select Unit</option>
                                                        <option value="Spaces" <?php echo e(isset($hardware['unit']) && $hardware['unit'] == 'Spaces' ? 'selected' : ''); ?>>Spaces</option>
                                                        <option value="Locations" <?php echo e(isset($hardware['unit']) && $hardware['unit'] == 'Locations' ? 'selected' : ''); ?>>Locations</option>
                                                        <option value="Count / Quantity" <?php echo e(isset($hardware['unit']) && $hardware['unit'] == 'Count / Quantity' ? 'selected' : ''); ?>>Count / Quantity</option>
                                                        <option value="Vehicles" <?php echo e(isset($hardware['unit']) && $hardware['unit'] == 'Vehicles' ? 'selected' : ''); ?>>Vehicles</option>
                                                        <option value="Sites" <?php echo e(isset($hardware['unit']) && $hardware['unit'] == 'Sites' ? 'selected' : ''); ?>>Sites</option>
                                                        <option value="Chargers" <?php echo e(isset($hardware['unit']) && $hardware['unit'] == 'Chargers' ? 'selected' : ''); ?>>Chargers</option>
                                                        <option value="Volume" <?php echo e(isset($hardware['unit']) && $hardware['unit'] == 'Volume' ? 'selected' : ''); ?>>Volume</option>
                                                        <option value="Transactions Count" <?php echo e(isset($hardware['unit']) && $hardware['unit'] == 'Transactions Count' ? 'selected' : ''); ?>>Transactions Count</option>
                                                        <option value="Other" <?php echo e(isset($hardware['unit']) && $hardware['unit'] == 'Other' ? 'selected' : ''); ?>>Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="product_opportunity_value_hardware_one_time_<?php echo e($index); ?>" name="product_opportunity_value_hardware_one_time[]" placeholder="Product Opportunity Value" onkeyup="formatCurrency(this)" value="<?php echo e($hardware['opportunity_value'] ?? ''); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="product_title_hardware_one_time" name="product_title_hardware_one_time[]" placeholder="Product Title" value="">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="product_price_hardware_one_time" name="product_price_hardware_one_time[]" placeholder="Product Price" onkeyup="formatCurrency(this)" value="">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="product_quantity_hardware_one_time" name="product_quantity_hardware_one_time[]" placeholder="Product Quantity" value="">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <select name="unit_hardware_one_time[]" id="unit_hardware_one_time" class="form-control" onchange="onUnitChange(this, 'hardware_one_time')">
                                                        <option value="" selected disabled>Select Unit</option>
                                                        <option value="Spaces">Spaces</option>
                                                        <option value="Locations">Locations</option>
                                                        <option value="Count / Quantity">Count / Quantity</option>
                                                        <option value="Vehicles">Vehicles</option>
                                                        <option value="Sites">Sites</option>
                                                        <option value="Chargers">Chargers</option>
                                                        <option value="Volume">Volume</option>
                                                        <option value="Transactions Count">Transactions Count</option>
                                                        <option value="Other">Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="product_opportunity_value_hardware_one_time" name="product_opportunity_value_hardware_one_time[]" placeholder="Product Opportunity Value" onkeyup="formatCurrency(this)" value="">
                                                </div>
                                            </div>
                                        </div>
                                        <?php endif; ?>

                                        <div class="col-12 plus-btn">
                                            <i class="fas fa-plus clone-btn"></i>
                                        </div>
                                    </div>



                                    <div id="hardware-maintenance-fields" class="additional-product-category card">
                                        <h5>Hardware Maintenance Contracts</h5>

                                        <?php if($hardware_maintenance): ?>
                                        <?php $__currentLoopData = $hardware_maintenance; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $maintenance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="product_title_hardware_maintenance_<?php echo e($index); ?>" name="product_title_hardware_maintenance[]" placeholder="Product Title" value="<?php echo e($maintenance['title'] ?? ''); ?>">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="product_price_hardware_maintenance_<?php echo e($index); ?>" name="product_price_hardware_maintenance[]" placeholder="Product Price" onkeyup="formatCurrency(this)" value="<?php echo e($maintenance['price'] ?? ''); ?>">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="product_quantity_hardware_maintenance_<?php echo e($index); ?>" name="product_quantity_hardware_maintenance[]" placeholder="Product Quantity" value="<?php echo e($maintenance['quantity'] ?? ''); ?>">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <select name="unit_hardware_maintenance[]" id="unit_hardware_maintenance_<?php echo e($index); ?>" class="form-control" onchange="onUnitChange(this, 'hardware_maintenance')">
                                                        <option value="" selected disabled>Select Unit</option>
                                                        <option value="Spaces" <?php echo e(isset($maintenance['unit']) && $maintenance['unit'] == 'Spaces' ? 'selected' : ''); ?>>Spaces</option>
                                                        <option value="Locations" <?php echo e(isset($maintenance['unit']) && $maintenance['unit'] == 'Locations' ? 'selected' : ''); ?>>Locations</option>
                                                        <option value="Count / Quantity" <?php echo e(isset($maintenance['unit']) && $maintenance['unit'] == 'Count / Quantity' ? 'selected' : ''); ?>>Count / Quantity</option>
                                                        <option value="Vehicles" <?php echo e(isset($maintenance['unit']) && $maintenance['unit'] == 'Vehicles' ? 'selected' : ''); ?>>Vehicles</option>
                                                        <option value="Sites" <?php echo e(isset($maintenance['unit']) && $maintenance['unit'] == 'Sites' ? 'selected' : ''); ?>>Sites</option>
                                                        <option value="Chargers" <?php echo e(isset($maintenance['unit']) && $maintenance['unit'] == 'Chargers' ? 'selected' : ''); ?>>Chargers</option>
                                                        <option value="Volume" <?php echo e(isset($maintenance['unit']) && $maintenance['unit'] == 'Volume' ? 'selected' : ''); ?>>Volume</option>
                                                        <option value="Transactions Count" <?php echo e(isset($maintenance['unit']) && $maintenance['unit'] == 'Transactions Count' ? 'selected' : ''); ?>>Transactions Count</option>
                                                        <option value="Other" <?php echo e(isset($maintenance['unit']) && $maintenance['unit'] == 'Other' ? 'selected' : ''); ?>>Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="product_opportunity_value_hardware_maintenance_<?php echo e($index); ?>" name="product_opportunity_value_hardware_maintenance[]" placeholder="Product Opportunity Value" onkeyup="formatCurrency(this)" value="<?php echo e($maintenance['opportunity_value'] ?? ''); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="product_title_hardware_maintenance_0" name="product_title_hardware_maintenance[]" placeholder="Product Title" value="">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="product_price_hardware_maintenance_0" name="product_price_hardware_maintenance[]" placeholder="Product Price" onkeyup="formatCurrency(this)" value="">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="product_quantity_hardware_maintenance_0" name="product_quantity_hardware_maintenance[]" placeholder="Product Quantity" value="">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <select name="unit_hardware_maintenance[]" id="unit_hardware_maintenance_0" class="form-control" onchange="onUnitChange(this, 'hardware_maintenance')">
                                                        <option value="" selected disabled>Select Unit</option>
                                                        <option value="Spaces">Spaces</option>
                                                        <option value="Locations">Locations</option>
                                                        <option value="Count / Quantity">Count / Quantity</option>
                                                        <option value="Vehicles">Vehicles</option>
                                                        <option value="Sites">Sites</option>
                                                        <option value="Chargers">Chargers</option>
                                                        <option value="Volume">Volume</option>
                                                        <option value="Transactions Count">Transactions Count</option>
                                                        <option value="Other">Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="product_opportunity_value_hardware_maintenance_0" name="product_opportunity_value_hardware_maintenance[]" placeholder="Product Opportunity Value" onkeyup="formatCurrency(this)" value="">
                                                </div>
                                            </div>
                                        </div>
                                        <?php endif; ?>

                                        <div class="col-12 plus-btn">
                                            <i class="fas fa-plus clone-btn"></i>
                                        </div>
                                    </div>


                                    <div id="software-recurring-fields" class="additional-product-category card">
                                        <h5>Software Recurring</h5>

                                        <?php if($software_recurring): ?>
                                        <?php $__currentLoopData = $software_recurring; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $software): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="product_title_software_recurring_<?php echo e($index); ?>" name="product_title_software_recurring[]" placeholder="Product Title" value="<?php echo e($software['title'] ?? ''); ?>">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="product_price_software_recurring_<?php echo e($index); ?>" name="product_price_software_recurring[]" placeholder="Product Price" onkeyup="formatCurrency(this)" value="<?php echo e($software['price'] ?? ''); ?>">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="product_quantity_software_recurring_<?php echo e($index); ?>" name="product_quantity_software_recurring[]" placeholder="Product Quantity" value="<?php echo e($software['quantity'] ?? ''); ?>">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <select name="unit_software_recurring[]" id="unit_software_recurring_<?php echo e($index); ?>" class="form-control" onchange="onUnitChange(this, 'software_recurring')">
                                                        <option value="" selected disabled>Select Unit</option>
                                                        <option value="Spaces" <?php echo e(isset($software['unit']) && $software['unit'] == 'Spaces' ? 'selected' : ''); ?>>Spaces</option>
                                                        <option value="Locations" <?php echo e(isset($software['unit']) && $software['unit'] == 'Locations' ? 'selected' : ''); ?>>Locations</option>
                                                        <option value="Count / Quantity" <?php echo e(isset($software['unit']) && $software['unit'] == 'Count / Quantity' ? 'selected' : ''); ?>>Count / Quantity</option>
                                                        <option value="Vehicles" <?php echo e(isset($software['unit']) && $software['unit'] == 'Vehicles' ? 'selected' : ''); ?>>Vehicles</option>
                                                        <option value="Sites" <?php echo e(isset($software['unit']) && $software['unit'] == 'Sites' ? 'selected' : ''); ?>>Sites</option>
                                                        <option value="Chargers" <?php echo e(isset($software['unit']) && $software['unit'] == 'Chargers' ? 'selected' : ''); ?>>Chargers</option>
                                                        <option value="Volume" <?php echo e(isset($software['unit']) && $software['unit'] == 'Volume' ? 'selected' : ''); ?>>Volume</option>
                                                        <option value="Transactions Count" <?php echo e(isset($software['unit']) && $software['unit'] == 'Transactions Count' ? 'selected' : ''); ?>>Transactions Count</option>
                                                        <option value="Other" <?php echo e(isset($software['unit']) && $software['unit'] == 'Other' ? 'selected' : ''); ?>>Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="product_opportunity_value_software_recurring_<?php echo e($index); ?>" name="product_opportunity_value_software_recurring[]" placeholder="Product Opportunity Value" onkeyup="formatCurrency(this)" value="<?php echo e($software['opportunity_value'] ?? ''); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="product_title_software_recurring_0" name="product_title_software_recurring[]" placeholder="Product Title" value="">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="product_price_software_recurring_0" name="product_price_software_recurring[]" placeholder="Product Price" onkeyup="formatCurrency(this)" value="">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="product_quantity_software_recurring_0" name="product_quantity_software_recurring[]" placeholder="Product Quantity" value="">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <select name="unit_software_recurring[]" id="unit_software_recurring_0" class="form-control" onchange="onUnitChange(this, 'software_recurring')">
                                                        <option value="" selected disabled>Select Unit</option>
                                                        <option value="Spaces">Spaces</option>
                                                        <option value="Locations">Locations</option>
                                                        <option value="Count / Quantity">Count / Quantity</option>
                                                        <option value="Vehicles">Vehicles</option>
                                                        <option value="Sites">Sites</option>
                                                        <option value="Chargers">Chargers</option>
                                                        <option value="Volume">Volume</option>
                                                        <option value="Transactions Count">Transactions Count</option>
                                                        <option value="Other">Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="product_opportunity_value_software_recurring_0" name="product_opportunity_value_software_recurring[]" placeholder="Product Opportunity Value" onkeyup="formatCurrency(this)" value="">
                                                </div>
                                            </div>
                                        </div>
                                        <?php endif; ?>

                                        <div class="col-12 plus-btn">
                                            <i class="fas fa-plus clone-btn"></i>
                                        </div>
                                    </div>


                                    <div id="software-one-time-fields" class="additional-product-category card">
                                        <h5>Software One Time</h5>

                                        <?php if($software_one_time): ?>
                                        <?php $__currentLoopData = $software_one_time; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $software): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="product_title_software_one_time_<?php echo e($index); ?>" name="product_title_software_one_time[]" placeholder="Product Title" value="<?php echo e($software['title'] ?? ''); ?>">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="product_price_software_one_time_<?php echo e($index); ?>" name="product_price_software_one_time[]" placeholder="Product Price" onkeyup="formatCurrency(this)" value="<?php echo e($software['price'] ?? ''); ?>">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="product_quantity_software_one_time_<?php echo e($index); ?>" name="product_quantity_software_one_time[]" placeholder="Product Quantity" value="<?php echo e($software['quantity'] ?? ''); ?>">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <select name="unit_software_one_time[]" id="unit_software_one_time_<?php echo e($index); ?>" class="form-control" onchange="onUnitChange(this, 'software_one_time')">
                                                        <option value="" selected disabled>Select Unit</option>
                                                        <option value="Spaces" <?php echo e(isset($software['unit']) && $software['unit'] == 'Spaces' ? 'selected' : ''); ?>>Spaces</option>
                                                        <option value="Locations" <?php echo e(isset($software['unit']) && $software['unit'] == 'Locations' ? 'selected' : ''); ?>>Locations</option>
                                                        <option value="Count / Quantity" <?php echo e(isset($software['unit']) && $software['unit'] == 'Count / Quantity' ? 'selected' : ''); ?>>Count / Quantity</option>
                                                        <option value="Vehicles" <?php echo e(isset($software['unit']) && $software['unit'] == 'Vehicles' ? 'selected' : ''); ?>>Vehicles</option>
                                                        <option value="Sites" <?php echo e(isset($software['unit']) && $software['unit'] == 'Sites' ? 'selected' : ''); ?>>Sites</option>
                                                        <option value="Chargers" <?php echo e(isset($software['unit']) && $software['unit'] == 'Chargers' ? 'selected' : ''); ?>>Chargers</option>
                                                        <option value="Volume" <?php echo e(isset($software['unit']) && $software['unit'] == 'Volume' ? 'selected' : ''); ?>>Volume</option>
                                                        <option value="Transactions Count" <?php echo e(isset($software['unit']) && $software['unit'] == 'Transactions Count' ? 'selected' : ''); ?>>Transactions Count</option>
                                                        <option value="Other" <?php echo e(isset($software['unit']) && $software['unit'] == 'Other' ? 'selected' : ''); ?>>Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="product_opportunity_value_software_one_time_<?php echo e($index); ?>" name="product_opportunity_value_software_one_time[]" placeholder="Product Opportunity Value" onkeyup="formatCurrency(this)" value="<?php echo e($software['opportunity_value'] ?? ''); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="product_title_software_one_time_0" name="product_title_software_one_time[]" placeholder="Product Title" value="">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="product_price_software_one_time_0" name="product_price_software_one_time[]" placeholder="Product Price" onkeyup="formatCurrency(this)" value="">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="product_quantity_software_one_time_0" name="product_quantity_software_one_time[]" placeholder="Product Quantity" value="">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <select name="unit_software_one_time[]" id="unit_software_one_time_0" class="form-control" onchange="onUnitChange(this, 'software_one_time')">
                                                        <option value="" selected disabled>Select Unit</option>
                                                        <option value="Spaces">Spaces</option>
                                                        <option value="Locations">Locations</option>
                                                        <option value="Count / Quantity">Count / Quantity</option>
                                                        <option value="Vehicles">Vehicles</option>
                                                        <option value="Sites">Sites</option>
                                                        <option value="Chargers">Chargers</option>
                                                        <option value="Volume">Volume</option>
                                                        <option value="Transactions Count">Transactions Count</option>
                                                        <option value="Other">Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="product_opportunity_value_software_one_time_0" name="product_opportunity_value_software_one_time[]" placeholder="Product Opportunity Value" onkeyup="formatCurrency(this)" value="">
                                                </div>
                                            </div>
                                        </div>
                                        <?php endif; ?>

                                        <div class="col-12 plus-btn">
                                            <i class="fas fa-plus clone-btn"></i>
                                        </div>
                                    </div>


                                    <div id="systems-integrations-fields" class="additional-product-category card">
                                        <h5>Systems Integrations</h5>

                                        <?php if($systems_integrations): ?>
                                        <?php $__currentLoopData = $systems_integrations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $integration): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="product_title_systems_integrations_<?php echo e($index); ?>" name="product_title_systems_integrations[]" placeholder="Product Title" value="<?php echo e($integration['title'] ?? ''); ?>">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="product_price_systems_integrations_<?php echo e($index); ?>" name="product_price_systems_integrations[]" placeholder="Product Price" onkeyup="formatCurrency(this)" value="<?php echo e($integration['price'] ?? ''); ?>">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="product_quantity_systems_integrations_<?php echo e($index); ?>" name="product_quantity_systems_integrations[]" placeholder="Product Quantity" value="<?php echo e($integration['quantity'] ?? ''); ?>">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <select name="unit_systems_integrations[]" id="unit_systems_integrations_<?php echo e($index); ?>" class="form-control" onchange="onUnitChange(this, 'systems_integrations')">
                                                        <option value="" selected disabled>Select Unit</option>
                                                        <option value="Spaces" <?php echo e(isset($integration['unit']) && $integration['unit'] == 'Spaces' ? 'selected' : ''); ?>>Spaces</option>
                                                        <option value="Locations" <?php echo e(isset($integration['unit']) && $integration['unit'] == 'Locations' ? 'selected' : ''); ?>>Locations</option>
                                                        <option value="Count / Quantity" <?php echo e(isset($integration['unit']) && $integration['unit'] == 'Count / Quantity' ? 'selected' : ''); ?>>Count / Quantity</option>
                                                        <option value="Vehicles" <?php echo e(isset($integration['unit']) && $integration['unit'] == 'Vehicles' ? 'selected' : ''); ?>>Vehicles</option>
                                                        <option value="Sites" <?php echo e(isset($integration['unit']) && $integration['unit'] == 'Sites' ? 'selected' : ''); ?>>Sites</option>
                                                        <option value="Chargers" <?php echo e(isset($integration['unit']) && $integration['unit'] == 'Chargers' ? 'selected' : ''); ?>>Chargers</option>
                                                        <option value="Volume" <?php echo e(isset($integration['unit']) && $integration['unit'] == 'Volume' ? 'selected' : ''); ?>>Volume</option>
                                                        <option value="Transactions Count" <?php echo e(isset($integration['unit']) && $integration['unit'] == 'Transactions Count' ? 'selected' : ''); ?>>Transactions Count</option>
                                                        <option value="Other" <?php echo e(isset($integration['unit']) && $integration['unit'] == 'Other' ? 'selected' : ''); ?>>Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="product_opportunity_value_systems_integrations_<?php echo e($index); ?>" name="product_opportunity_value_systems_integrations[]" placeholder="Product Opportunity Value" onkeyup="formatCurrency(this)" value="<?php echo e($integration['opportunity_value'] ?? ''); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="product_title_systems_integrations_0" name="product_title_systems_integrations[]" placeholder="Product Title" value="">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="product_price_systems_integrations_0" name="product_price_systems_integrations[]" placeholder="Product Price" onkeyup="formatCurrency(this)" value="">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="product_quantity_systems_integrations_0" name="product_quantity_systems_integrations[]" placeholder="Product Quantity" value="">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <select name="unit_systems_integrations[]" id="unit_systems_integrations_0" class="form-control" onchange="onUnitChange(this, 'systems_integrations')">
                                                        <option value="" selected disabled>Select Unit</option>
                                                        <option value="Spaces">Spaces</option>
                                                        <option value="Locations">Locations</option>
                                                        <option value="Count / Quantity">Count / Quantity</option>
                                                        <option value="Vehicles">Vehicles</option>
                                                        <option value="Sites">Sites</option>
                                                        <option value="Chargers">Chargers</option>
                                                        <option value="Volume">Volume</option>
                                                        <option value="Transactions Count">Transactions Count</option>
                                                        <option value="Other">Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="product_opportunity_value_systems_integrations_0" name="product_opportunity_value_systems_integrations[]" placeholder="Product Opportunity Value" onkeyup="formatCurrency(this)" value="">
                                                </div>
                                            </div>
                                        </div>
                                        <?php endif; ?>

                                        <div class="col-12 plus-btn">
                                            <i class="fas fa-plus clone-btn"></i>
                                        </div>
                                    </div>


                                    <div id="subscriptions-fields" class="additional-product-category card">
                                        <h5>Subscriptions</h5>

                                        <?php if($subscriptions): ?>
                                        <?php $__currentLoopData = $subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="product_title_subscriptions_<?php echo e($index); ?>" name="product_title_subscriptions[]" placeholder="Product Title" value="<?php echo e($subscription['title'] ?? ''); ?>">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="product_price_subscriptions_<?php echo e($index); ?>" name="product_price_subscriptions[]" placeholder="Product Price" onkeyup="formatCurrency(this)" value="<?php echo e($subscription['price'] ?? ''); ?>">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="product_quantity_subscriptions_<?php echo e($index); ?>" name="product_quantity_subscriptions[]" placeholder="Product Quantity" value="<?php echo e($subscription['quantity'] ?? ''); ?>">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <select name="unit_subscriptions[]" id="unit_subscriptions_<?php echo e($index); ?>" class="form-control" onchange="onUnitChange(this, 'subscriptions')">
                                                        <option value="" selected disabled>Select Unit</option>
                                                        <option value="Spaces" <?php echo e(isset($subscription['unit']) && $subscription['unit'] == 'Spaces' ? 'selected' : ''); ?>>Spaces</option>
                                                        <option value="Locations" <?php echo e(isset($subscription['unit']) && $subscription['unit'] == 'Locations' ? 'selected' : ''); ?>>Locations</option>
                                                        <option value="Count / Quantity" <?php echo e(isset($subscription['unit']) && $subscription['unit'] == 'Count / Quantity' ? 'selected' : ''); ?>>Count / Quantity</option>
                                                        <option value="Vehicles" <?php echo e(isset($subscription['unit']) && $subscription['unit'] == 'Vehicles' ? 'selected' : ''); ?>>Vehicles</option>
                                                        <option value="Sites" <?php echo e(isset($subscription['unit']) && $subscription['unit'] == 'Sites' ? 'selected' : ''); ?>>Sites</option>
                                                        <option value="Chargers" <?php echo e(isset($subscription['unit']) && $subscription['unit'] == 'Chargers' ? 'selected' : ''); ?>>Chargers</option>
                                                        <option value="Volume" <?php echo e(isset($subscription['unit']) && $subscription['unit'] == 'Volume' ? 'selected' : ''); ?>>Volume</option>
                                                        <option value="Transactions Count" <?php echo e(isset($subscription['unit']) && $subscription['unit'] == 'Transactions Count' ? 'selected' : ''); ?>>Transactions Count</option>
                                                        <option value="Other" <?php echo e(isset($subscription['unit']) && $subscription['unit'] == 'Other' ? 'selected' : ''); ?>>Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="product_opportunity_value_subscriptions_<?php echo e($index); ?>" name="product_opportunity_value_subscriptions[]" placeholder="Product Opportunity Value" onkeyup="formatCurrency(this)" value="<?php echo e($subscription['opportunity_value'] ?? ''); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="product_title_subscriptions_0" name="product_title_subscriptions[]" placeholder="Product Title" value="">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="product_price_subscriptions_0" name="product_price_subscriptions[]" placeholder="Product Price" onkeyup="formatCurrency(this)" value="">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="product_quantity_subscriptions_0" name="product_quantity_subscriptions[]" placeholder="Product Quantity" value="">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <select name="unit_subscriptions[]" id="unit_subscriptions_0" class="form-control" onchange="onUnitChange(this, 'subscriptions')">
                                                        <option value="" selected disabled>Select Unit</option>
                                                        <option value="Spaces">Spaces</option>
                                                        <option value="Locations">Locations</option>
                                                        <option value="Count / Quantity">Count / Quantity</option>
                                                        <option value="Vehicles">Vehicles</option>
                                                        <option value="Sites">Sites</option>
                                                        <option value="Chargers">Chargers</option>
                                                        <option value="Volume">Volume</option>
                                                        <option value="Transactions Count">Transactions Count</option>
                                                        <option value="Other">Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="product_opportunity_value_subscriptions_0" name="product_opportunity_value_subscriptions[]" placeholder="Product Opportunity Value" onkeyup="formatCurrency(this)" value="">
                                                </div>
                                            </div>
                                        </div>
                                        <?php endif; ?>

                                        <div class="col-12 plus-btn">
                                            <i class="fas fa-plus clone-btn"></i>
                                        </div>
                                    </div>


                                    <div id="tech-deployment-fields" class="additional-product-category card">
                                        <h5>Tech Deployment Volume based</h5>

                                        <?php if($tech_deployment_volume_based): ?>
                                        <?php $__currentLoopData = $tech_deployment_volume_based; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $tech_deployment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="product_title_tech_deployment_<?php echo e($index); ?>" name="product_title_tech_deployment[]" placeholder="Product Title" value="<?php echo e($tech_deployment['title'] ?? ''); ?>">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="product_price_tech_deployment_<?php echo e($index); ?>" name="product_price_tech_deployment[]" placeholder="Product Price" onkeyup="formatCurrency(this)" value="<?php echo e($tech_deployment['price'] ?? ''); ?>">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="product_quantity_tech_deployment_<?php echo e($index); ?>" name="product_quantity_tech_deployment[]" placeholder="Product Quantity" value="<?php echo e($tech_deployment['quantity'] ?? ''); ?>">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <select name="unit_tech_deployment[]" id="unit_tech_deployment_<?php echo e($index); ?>" class="form-control" onchange="onUnitChange(this, 'tech_deployment')">
                                                        <option value="" selected disabled>Select Unit</option>
                                                        <option value="Spaces" <?php echo e(isset($tech_deployment['unit']) && $tech_deployment['unit'] == 'Spaces' ? 'selected' : ''); ?>>Spaces</option>
                                                        <option value="Locations" <?php echo e(isset($tech_deployment['unit']) && $tech_deployment['unit'] == 'Locations' ? 'selected' : ''); ?>>Locations</option>
                                                        <option value="Count / Quantity" <?php echo e(isset($tech_deployment['unit']) && $tech_deployment['unit'] == 'Count / Quantity' ? 'selected' : ''); ?>>Count / Quantity</option>
                                                        <option value="Vehicles" <?php echo e(isset($tech_deployment['unit']) && $tech_deployment['unit'] == 'Vehicles' ? 'selected' : ''); ?>>Vehicles</option>
                                                        <option value="Sites" <?php echo e(isset($tech_deployment['unit']) && $tech_deployment['unit'] == 'Sites' ? 'selected' : ''); ?>>Sites</option>
                                                        <option value="Chargers" <?php echo e(isset($tech_deployment['unit']) && $tech_deployment['unit'] == 'Chargers' ? 'selected' : ''); ?>>Chargers</option>
                                                        <option value="Volume" <?php echo e(isset($tech_deployment['unit']) && $tech_deployment['unit'] == 'Volume' ? 'selected' : ''); ?>>Volume</option>
                                                        <option value="Transactions Count" <?php echo e(isset($tech_deployment['unit']) && $tech_deployment['unit'] == 'Transactions Count' ? 'selected' : ''); ?>>Transactions Count</option>
                                                        <option value="Other" <?php echo e(isset($tech_deployment['unit']) && $tech_deployment['unit'] == 'Other' ? 'selected' : ''); ?>>Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="product_opportunity_value_tech_deployment_<?php echo e($index); ?>" name="product_opportunity_value_tech_deployment[]" placeholder="Product Opportunity Value" onkeyup="formatCurrency(this)" value="<?php echo e($tech_deployment['opportunity_value'] ?? ''); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="product_title_tech_deployment_0" name="product_title_tech_deployment[]" placeholder="Product Title" value="">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="product_price_tech_deployment_0" name="product_price_tech_deployment[]" placeholder="Product Price" onkeyup="formatCurrency(this)" value="">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="product_quantity_tech_deployment_0" name="product_quantity_tech_deployment[]" placeholder="Product Quantity" value="">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <select name="unit_tech_deployment[]" id="unit_tech_deployment_0" class="form-control" onchange="onUnitChange(this, 'tech_deployment')">
                                                        <option value="" selected disabled>Select Unit</option>
                                                        <option value="Spaces">Spaces</option>
                                                        <option value="Locations">Locations</option>
                                                        <option value="Count / Quantity">Count / Quantity</option>
                                                        <option value="Vehicles">Vehicles</option>
                                                        <option value="Sites">Sites</option>
                                                        <option value="Chargers">Chargers</option>
                                                        <option value="Volume">Volume</option>
                                                        <option value="Transactions Count">Transactions Count</option>
                                                        <option value="Other">Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="product_opportunity_value_tech_deployment_0" name="product_opportunity_value_tech_deployment[]" placeholder="Product Opportunity Value" onkeyup="formatCurrency(this)" value="">
                                                </div>
                                            </div>
                                        </div>
                                        <?php endif; ?>

                                        <div class="col-12 plus-btn">
                                            <i class="fas fa-plus clone-btn"></i>
                                        </div>
                                    </div>


                                    <!--   <div class="col-6 need_full">
                                        <div class="form-group intl-tel-input">
                                            <?php echo e(Form::label('phone', __('Primary contact'), ['class' => 'form-label'])); ?>

                                            <span class="text-sm">
                                                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                            </span>
                                            <div class="intl-tel-input">
                                                <input type="tel" id="phone-input" name="primary_contact" class="phone-input form-control" placeholder="Enter Primary contact" maxlength="16" value="" required>
                                            </div>
                                        </div>
                                    </div> -->
                                    <!-- <div class="col-6 need_full">
                                        <div class="form-group intl-tel-input">
                                            <?php echo e(Form::label('phone', __('Secondary contact'), ['class' => 'form-label'])); ?>

                                            <span class="text-sm">
                                                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                            </span>
                                            <div class="intl-tel-input">
                                                <input type="tel" id="phone-input1" name="secondary_contact" class="phone-input form-control" placeholder="Enter Secondary contact" maxlength="16" value="">
                                            </div>
                                        </div>
                                    </div> -->

                                    <!--  <div class="col-6 need_full">
                                        <div class="form-group">
                                            <?php echo e(Form::label('Assign Staff',__('Assign Staff'),['class'=>'form-label'])); ?>

                                            <select class="form-control" name='user'>
                                                <option value="">Select Staff</option>
                                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option class="form-control" value="<?php echo e($user->id); ?>" <?php echo e($user->id == $lead->assigned_user ? 'selected' : ''); ?>>
                                                    <?php echo e($user->name); ?> - <?php echo e($user->type); ?>

                                                </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div> -->

                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            <?php echo e(Form::label('name', __('Active'), ['class' => 'form-label'])); ?>

                                            <div>
                                                <input type="checkbox" class="form-check-input" name="is_active" <?php echo e($lead->lead_status == 1 ? 'checked' : ''); ?>>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="text-end">
                                        <button type="button" class="btn  btn-light cancel">Cancel</button>
                                        <?php echo e(Form::submit(__('Update'), ['class' => 'btn-submit btn btn-primary'])); ?>

                                    </div>
                                </div>
                            </div>
                            <?php echo e(Form::close()); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .iti.iti--allow-dropdown.iti--separate-dial-code {
        width: 100%;
    }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
<script>
    $(document).ready(function() {
        $("input[type='text'][name='lead_name'],input[type='text'][name='name'], input[type='text'][name='email'], select[name='type'],input[type='tel'][name='primary_contact'][name='secondary_contact'],input[type='date'][name='start_date']").focusout(function() {

            var input = $(this);
            var errorMessage = '';
            if (input.attr('name') === 'email' && input.val() !== '') {
                var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailPattern.test(input.val())) {
                    errorMessage = 'Invalid email address.';
                }
            } else if (input.val() == '') {
                errorMessage = 'This field is required.';
            }

            if (errorMessage != '') {
                input.css('border', 'solid 2px red');
            } else {
                // If it is not blank. 
                input.css('border', 'solid 2px black');
            }

            // Remove any existing error message
            input.next('.validation-error').remove();

            // Append the error message if it exists
            if (errorMessage != '') {
                input.after('<div class="validation-error text-danger" style="padding:2px;">' + errorMessage + '</div>');
            }
        });
    });
</script>
<script>
    jQuery(function() {
        $('input[name = lead_name]').keyup(function() {
            var value = $(this).val();
            $('input[name = "name"]').val(value);
        });
        $('.cancel').click(function() {
            location.reload();
        })
    });
</script>
<script>
    $(document).ready(function() {
        var phoneNumber = "<?php echo $lead->primary_contact; ?>";
        var num = phoneNumber.trim();
        var lastTenDigits = phoneNumber.substr(-10);
        var formattedPhoneNumber = '(' + lastTenDigits.substr(0, 3) + ') ' + lastTenDigits.substr(3, 3) + '-' +
            lastTenDigits.substr(6);
        $('#phone-input').val(formattedPhoneNumber);

        var phoneNumber1 = "<?php echo $lead->secondary_contact; ?>";
        var num = phoneNumber1.trim();
        var lastTenDigits1 = phoneNumber1.substr(-10);
        var formattedPhoneNumber1 = '(' + lastTenDigits1.substr(0, 3) + ') ' + lastTenDigits1.substr(3, 3) + '-' +
            lastTenDigits1.substr(6);
        $('#phone-input1').val(formattedPhoneNumber1);
    })
    $(document).ready(function() {
        var input = document.querySelector("#phone-input");
        var iti = window.intlTelInput(input, {
            separateDialCode: true,
        });

        var indiaCountryCode = iti.getSelectedCountryData().iso2;
        var countryCode = iti.getSelectedCountryData().dialCode;
        $('#country-code').val(countryCode);
        if (indiaCountryCode !== 'us') {
            iti.setCountry('us');
        }

        var input1 = document.querySelector("#phone-input1");
        var iti1 = window.intlTelInput(input1, {
            separateDialCode: true,
        });

        var indiaCountryCode1 = iti1.getSelectedCountryData().iso2;
        var countryCode1 = iti1.getSelectedCountryData().dialCode;
        $('#country-code').val(countryCode1);
        if (indiaCountryCode1 !== 'us') {
            iti1.setCountry('us');
        }
    });
</script>

<script>
    const isNumericInput = (event) => {
        const key = event.keyCode;
        return ((key >= 48 && key <= 57) || // Allow number line
            (key >= 96 && key <= 105) // Allow number pad
        );
    };

    const isModifierKey = (event) => {
        const key = event.keyCode;
        return (event.shiftKey === true || key === 35 || key === 36) || // Allow Shift, Home, End
            (key === 8 || key === 9 || key === 13 || key === 46) || // Allow Backspace, Tab, Enter, Delete
            (key > 36 && key < 41) || // Allow left, up, right, down
            (
                // Allow Ctrl/Command + A,C,V,X,Z
                (event.ctrlKey === true || event.metaKey === true) &&
                (key === 65 || key === 67 || key === 86 || key === 88 || key === 90)
            )
    };

    const enforceFormat = (event) => {
        // Input must be of a valid number format or a modifier key, and not longer than ten digits
        if (!isNumericInput(event) && !isModifierKey(event)) {
            event.preventDefault();
        }
    };

    const formatToPhone = (event) => {
        if (isModifierKey(event)) {
            return;
        }

        // I am lazy and don't like to type things more than once
        const target = event.target;
        const input = event.target.value.replace(/\D/g, '').substring(0, 10); // First ten digits of input only
        const zip = input.substring(0, 3);
        const middle = input.substring(3, 6);
        const last = input.substring(6, 10);

        if (input.length > 6) {
            target.value = `(${zip}) ${middle} - ${last}`;
        } else if (input.length > 3) {
            target.value = `(${zip}) ${middle}`;
        } else if (input.length > 0) {
            target.value = `(${zip}`;
        }
    };

    const inputElement = document.getElementById('phone-input');
    inputElement.addEventListener('keydown', enforceFormat);
    inputElement.addEventListener('keyup', formatToPhone);
    const inputElement1 = document.getElementById('phone-input1');
    inputElement1.addEventListener('keydown', enforceFormat);
    inputElement1.addEventListener('keyup', formatToPhone);
</script>
<script>
    var scrollSpy = new bootstrap.ScrollSpy(document.body, {
        target: '#useradd-sidenav',
        offset: 300
    })
</script>
<script>
    var scrollSpy = new bootstrap.ScrollSpy(document.body, {
        target: '#useradd-sidenav',
        offset: 300
    })
    $(document).ready(function() {
        $('div#mailFunctionSection > div').hide();
        $('input[name="function[]"]:checked').each(function() {
            var funVal = $(this).val();
            $('div#mailFunctionSection > div').each(function() {
                var attr_value = $(this).data('main-value');
                if (attr_value == funVal) {
                    $(this).show();
                }
            });
        });
        $('div#additionalSection > div').hide();
        $('div#mailFunctionSection input[type=checkbox]:checked').each(function() {
            var funcValue = $(this).val();
            $('div#additionalSection > div').each(function() {
                var ad_val = $(this).data('additional-index');
                if (funcValue == ad_val) {
                    $(this).show();
                }
            });
        });

    });
    jQuery(function() {
        $('input[name="function[]"]').change(function() {
            $('div#mailFunctionSection > div').hide();
            $('input[name="function[]"]:checked').each(function() {
                var funVal = $(this).val();
                $('div#mailFunctionSection > div').each(function() {
                    var attr_value = $(this).data('main-value');
                    if (attr_value == funVal) {
                        $(this).show();
                    }
                });
            });
        });
    });
    jQuery(function() {
        $('div#mailFunctionSection input[type=checkbox]').change(function() {
            $('div#additionalSection > div').hide();
            $('div#mailFunctionSection input[type=checkbox]:checked').each(function() {
                var funcValue = $(this).val();
                $('div#additionalSection > div').each(function() {
                    var ad_val = $(this).data('additional-index');
                    if (funcValue == ad_val) {
                        $(this).show();
                    }
                });
            });
        });
    });
    jQuery(function() {
        $('input[type=radio][name = baropt]').change(function() {
            $('div#barpacakgeoptions').hide();
            var value = $(this).val();
            if (value == 'Package Choice') {
                $('div#barpacakgeoptions').show();
            }
        });
    });
</script>

<script>
    $(document).on('change', 'select[name=parent]', function() {
        console.log('h');
        var parent = $(this).val();
        getparent(parent);
    });

    function getparent(bid) {
        console.log(bid);
        $.ajax({
            url: "<?php echo e(route('task.getparent')); ?>",
            type: 'POST',
            data: {
                "parent": bid,
                "_token": "<?php echo e(csrf_token()); ?>",
            },
            success: function(data) {
                console.log(data);
                $('#parent_id').empty();
                // 

                $.each(data, function(key, value) {
                    $('#parent_id').append('<option value="' + key + '">' + value + '</option>');
                });
                if (data == '') {
                    $('#parent_id').empty();
                }
            }
        });
    }
</script>
<script>
    $(document).on('click', '#billing_data', function() {
        $("[name='shipping_address']").val($("[name='billing_address']").val());
        $("[name='shipping_city']").val($("[name='billing_city']").val());
        $("[name='shipping_state']").val($("[name='billing_state']").val());
        $("[name='shipping_country']").val($("[name='billing_country']").val());
        $("[name='shipping_postalcode']").val($("[name='billing_postalcode']").val());
    });
</script>

<script>
    function showAdditionalProductCategoryFields() {
        const categories = [
            'hardware-one-time',
            'hardware-maintenance',
            'software-recurring',
            'software-one-time',
            'systems-integrations',
            'subscriptions',
            'tech-deployment'
        ];

        categories.forEach(category => {
            const checkbox = document.getElementById(category);
            const fields = document.getElementById(category + '-fields');
            if (checkbox.checked) {
                fields.style.display = 'block';
            } else {
                fields.style.display = 'none';
            }
        });
    }

    document.addEventListener('DOMContentLoaded', showAdditionalProductCategoryFields);
</script>

<script>
    $(document).ready(function() {
        // Function to handle cloning
        $('.additional-product-category').on('click', '.clone-btn', function(event) {
            event.preventDefault();

            // Get the parent .additional-product-category div
            var parentDiv = $(this).closest('.additional-product-category');

            // Get the first .row div inside the parent
            var rowDiv = parentDiv.find('.row').first();

            // Clone the .row div
            var clone = rowDiv.clone();

            // Reset values of input elements within the cloned row
            clone.find('input[type="text"]').val('');
            clone.find('select').val('');

            // Append a remove button to the cloned row
            clone.append('<div class="minus-btn"><i class="fas fa-minus remove-btn"></i></div>');

            // Insert the clone after the last .row div inside the parent
            parentDiv.append(clone);
        });

        // Function to handle removal
        $('.additional-product-category').on('click', '.remove-btn', function(event) {
            event.preventDefault();
            $(this).closest('.row').remove();
        });
    });
</script>
<script>
    function onUnitChange(element, name) {
        var selectedValue = $(element).val();

        // Remove any existing input box
        var parentRow = $(element).closest('.row');
        var existingInput = parentRow.find('.extra-input');
        if (existingInput.length) {
            existingInput.closest('.col-6').remove();
        }

        if (selectedValue === 'Other') {
            // Create the outer div with class 'col-6'
            var outerDiv = document.createElement('div');
            outerDiv.className = 'col-6';

            // Create the inner div with class 'form-group'
            var innerDiv = document.createElement('div');
            innerDiv.className = 'form-group';

            // Create the input element
            var inputBox = document.createElement('input');
            inputBox.type = 'text';
            inputBox.name = 'other_unit_' + name + '[]';
            inputBox.className = 'form-control extra-input';
            inputBox.placeholder = 'Enter other unit';

            // Append the input box to the inner div
            innerDiv.appendChild(inputBox);

            // Append the inner div to the outer div
            outerDiv.appendChild(innerDiv);

            // Find the remove button
            var removeBtn = parentRow.find('.minus-btn');
            if (removeBtn.length) {
                // Append the outer div before the remove button
                removeBtn.before(outerDiv);
            } else {
                // Append the outer div to the parent row
                parentRow.append(outerDiv);
            }
        }
    }
</script>
<script>
    function formatCurrency(input) {
        // Remove non-numeric characters except for commas
        let value = input.value.replace(/[^\d]/g, '');

        // Format the number with commas
        input.value = formatNumberWithCommas(value);
    }

    function formatNumberWithCommas(number) {
        if (!number) return '';
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\volo\resources\views/lead/edit.blade.php ENDPATH**/ ?>