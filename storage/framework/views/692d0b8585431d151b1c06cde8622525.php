<?php
$settings = Utility::settings();
$productTypes = explode(',', $settings['product_type']);
$categoryTypes = explode(',', $settings['category_type']);
$subcategoryTypes = explode(',', $settings['subcategory_type']);
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

<?php echo e(Form::open(array('url'=>'lead','method'=>'post','enctype'=>'multipart/form-data' ,'id'=>'formdata'))); ?>

<div class="card-body">
    <div class="row">
        <div class="col-md-12">
            <?php echo e(Form::label('Select Existing Client/New Client',__('Select Existing Client/New Client'),['class'=>'form-label'])); ?>

            <div class="form-group">
                <?php echo e(Form::radio('newevent',__('Existing'),true)); ?>

                <?php echo e(Form::label('newevent','Existing')); ?>

                <?php echo e(Form::radio('newevent',__('New'),false)); ?>

                <?php echo e(Form::label('newevent','New')); ?>

            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-6 need_full">
        <div class="form-group">
            <?php echo e(Form::label('opportunity_name',__('Opportunity Name'),['class'=>'form-label'])); ?>

            <span class="text-sm">
                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
            </span>
            <?php echo e(Form::text('opportunity_name',null,array('class'=>'form-control','placeholder'=>__('Enter Opportunity Name'),'required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-6 need_full" id="client_select">
        <div class="form-group">
            <?php echo e(Form::label('existing_client', __('Client'), ['class' => 'form-label'])); ?>

            <span class="text-sm">
                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
            </span>
            <select name="existing_client" class="form-control" onchange="getExistingUser(this)">
                <option value="" disabled selected>Select Client</option>
                <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($client->id); ?>"><?php echo e($client->primary_name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
    <div class="col-6 need_full" id="new_client">
        <div class="form-group">
            <?php echo e(Form::label('client_name',__('Client Name'),['class'=>'form-label'])); ?>

            <span class="text-sm">
                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
            </span>
            <?php echo e(Form::text('client_name',null,array('class'=>'form-control','placeholder'=>__('Enter Client Name')))); ?>

        </div>
    </div>
    <div class="col-6 need_full" id="new_region">
        <div class="form-group">
            <?php echo e(Form::label('region',__('Region'),['class'=>'form-label'])); ?>

            <span class="text-sm">
                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
            </span>
            <?php echo e(Form::text('region',null,array('class'=>'form-control','placeholder'=>__('Enter Region')))); ?>

        </div>
    </div>

    <input type="hidden" id="existing_region" name="existing_region" value="">
    <div class="col-12  p-0 modaltitle pb-3 mb-3 mt-4">
        <h5 style="margin-left: 14px;"><?php echo e(__('Primary Contact Information')); ?></h5>
    </div>
    <!-- <?php echo e(Form::open(array('route'=>['create.opportunity'],'method'=>'post','enctype'=>'multipart/form-data','id'=>'imported'))); ?> -->
    <div class="row">
        <div class="col-6 need_full">
            <!-- <input type="hidden" name="customerType" value="addForm" /> -->
            <div class="form-group">
                <?php echo e(Form::label('primary_name',__('Name'),['class'=>'form-label'])); ?>

                <span class="text-sm">
                    <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                </span>
                <?php echo e(Form::text('primary_name',null,array('class'=>'form-control','placeholder'=>__('Enter Name'),'required'=>'required'))); ?>

            </div>
        </div>
        <div class="col-6 need_full">
            <div class="form-group ">
                <?php echo e(Form::label('primary_phone_number',__('Phone Number'),['class'=>'form-label'])); ?>

                <span class="text-sm">
                    <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                </span>
                <div class="intl-tel-input">
                    <input type="tel" name="primary_phone_number" class="phone-input form-control" placeholder="Enter Phone Number" maxlength="16">
                </div>
            </div>
        </div>

        <div class="col-6 need_full">
            <div class="form-group">
                <?php echo e(Form::label('primary_email',__('Email'),['class'=>'form-label'])); ?>

                <span class="text-sm">
                    <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                </span>
                <?php echo e(Form::email('primary_email',null,array('class'=>'form-control','placeholder'=>__('Enter Email'),'required'=>'required'))); ?>

            </div>
        </div>
        <div class="col-6 need_full">
            <div class="form-group">
                <?php echo e(Form::label('primary_address',__('Address'),['class'=>'form-label'])); ?>


                <?php echo e(Form::text('primary_address',null,array('class'=>'form-control','placeholder'=>__('Enter Address')))); ?>

            </div>
        </div>
        <div class="col-6 need_full">
            <div class="form-group">
                <?php echo e(Form::label('primary_organization',__('Title/Designation'),['class'=>'form-label'])); ?>

                <?php echo e(Form::text('primary_organization',null,array('class'=>'form-control','placeholder'=>__('Enter Designation')))); ?>

            </div>
        </div>
    </div>

    <div class="col-12  p-0 modaltitle pb-3 mb-3 mt-4">
        <h5 style="margin-left: 14px;"><?php echo e(__('Secondary Contact Information')); ?></h5>
    </div>
    <div class="row">
        <div class="col-6 need_full">
            <input type="hidden" name="customerType" value="addForm" />
            <div class="form-group">
                <?php echo e(Form::label('secondary_name',__('Name'),['class'=>'form-label'])); ?>

                <?php echo e(Form::text('secondary_name',null,array('class'=>'form-control','placeholder'=>__('Enter Name')))); ?>

            </div>
        </div>
        <div class="col-6 need_full">
            <div class="form-group ">
                <?php echo e(Form::label('secondary_phone_number',__('Phone Number'),['class'=>'form-label'])); ?>

                <div class="intl-tel-input">
                    <input type="tel" name="secondary_phone_number" class="phone-input form-control" placeholder="Enter Phone Number" maxlength="16">
                </div>
            </div>
        </div>
        <div class="col-6 need_full">
            <div class="form-group">
                <?php echo e(Form::label('secondary_email',__('Email'),['class'=>'form-label'])); ?>

                <?php echo e(Form::email('secondary_email',null,array('class'=>'form-control','placeholder'=>__('Enter Email')))); ?>

            </div>
        </div>
        <div class="col-6 need_full">
            <div class="form-group">
                <?php echo e(Form::label('secondary_address',__('Address'),['class'=>'form-label'])); ?>

                <?php echo e(Form::text('secondary_address',null,array('class'=>'form-control','placeholder'=>__('Enter Address')))); ?>

            </div>
        </div>
        <div class="col-6 need_full">
            <div class="form-group">
                <?php echo e(Form::label('secondary_designation',__('Title/Designation'),['class'=>'form-label'])); ?>

                <?php echo e(Form::text('secondary_designation',null,array('class'=>'form-control','placeholder'=>__('Enter Designation')))); ?>

            </div>
        </div>
    </div>

    <div class="col-12  p-0 modaltitle pb-3 mb-3">
        <h5 style="margin-left: 14px;"><?php echo e(__('Details')); ?></h5>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            <?php echo e(Form::label('Assigned Team Member',__('Assigned Team Member'),['class'=>'form-label'])); ?>

            <select class="form-control" name='assign_staff' required>
                <option value="">Select Team Member</option>
                <?php $__currentLoopData = $assinged_staff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option class="form-control" value="<?php echo e($staff->id); ?>"><?php echo e($staff->name); ?> (<?php echo e($staff->type); ?>)</option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>

    <div class="col-6 need_full">
        <div class="form-group">
            <label for="value_of_opportunity">Value of Opportunity</label>
            <input type="text" name="value_of_opportunity" value="" placeholder="Enter Value of Opportunity" class="form-control" onkeyup="formatCurrency(this)">
        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            <label for="currency">Currency</label>
            <select name="currency" class="form-control">
                <option value="" selected disabled>Select Currency</option>
                <option value="GBP">GBP</option>
                <option value="USD">USD</option>
                <option value="EUR">EUR</option>
            </select>
        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            <label for="timing_close">Timing – Close</label>
            <select name="timing_close" id="timing_close" class="form-control">
                <option value="" selected disabled>Select Timing – Close</option>
                <option value="immediate">Immediate</option>
                <option value="0-30-days">0-30 Days</option>
                <option value="31-90-days">31 – 90 Days</option>
                <option value="91-180-days">91 – 180 Days</option>
                <option value="181-360-days">181 – 360 Days</option>
                <option value="12-months-plus">12 Months +</option>
            </select>
        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            <label for="sales_stage">Sales Stage</label>
            <select name="sales_stage" id="sales_stage" class="form-control">
                <option value="" selected disabled>Select Sales Stage</option>
                <option value="New">New</option>
                <option value="Contacted">Contacted</option>
                <option value="Qualifying">Qualifying</option>
                <option value="Qualified">Qualified</option>
                <option value="NDA Signed">NDA Signed</option>
                <option value="Demo or Meeting">Demo or Meeting</>
                <option value="Proposal">Proposal</option>
                <option value="Negotiation">Negotiation</option>
                <option value="Awaiting Decision">Awaiting Decision</option>
                <option value="Closed Won">Closed Won</option>
                <option value="Closed Lost">Closed Lost</option>
                <option value="Close No Decision">Close No Decision</option>
                <option value="Follow-Up Needed">Follow-Up Needed</option>
                <option value="Implementation">Implementation</option>
                <option value="Renewal">Renewal</option>
                <option value="Upsell">Upsell</option>
            </select>
        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            <label for="deal_length">Deal Length</label>
            <select name="deal_length" id="deal_length" class="form-control">
                <option value="" selected disabled>Select Deal Length</option>
                <option value="One Time">One Time</option>
                <option value="Short Term">Short Term</option>
                <option value="On a Needed basis">On a Needed basis</option>
                <option value="Annual">Annual</option>
                <option value="Multi Year">Multi Year</option>
            </select>
        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            <label for="difficult_level">Difficulty Level</label>
            <select name="difficult_level" id="difficult_level" class="form-control">
                <option value="" selected disabled>Select Difficulty Level</option>
                <option value="Very Easy">Very Easy</option>
                <option value="Easy">Easy</option>
                <option value="Moderate">Moderate</option>
                <option value="Challenging">Challenging</option>
                <option value="Difficult">Difficult</option>
                <option value="Very Difficult">Very Difficult</option>
                <option value="Complex">Complex</option>
                <option value="High Risk">High Risk</option>
            </select>
        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            <label for="probability_to_close">Probability to close</label>
            <select name="probability_to_close" id="probability_to_close" class="form-control">
                <option value="" selected disabled>Select Probability to close</option>
                <option value="Highly Probable">Highly Probable</option>
                <option value="Probable">Probable</option>
                <option value="Likely">Likely</option>
                <option value="Possible">Possible</option>
                <option value="Unlikely">Unlikely</option>
                <option value="Highly Unlikely">Highly Unlikely</option>
                <option value="Unknown">Unknown</option>
            </select>
        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            <label for="category">Select Category</label>
            <select name="category" id="category" class="form-control">
                <option value="" selected disabled>Select Category</option>
                <?php $__currentLoopData = $categoryTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($category); ?>" class="form-control"><?php echo e($category); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            <label for="sales_subcategory">Sales Subcategory</label>
            <select name="sales_subcategory" id="sales_subcategory" class="form-control">
                <option value="" selected disabled>Select Sales Subcategory</option>
                <?php $__currentLoopData = $subcategoryTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($subcategory); ?>" class="form-control"><?php echo e($subcategory); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
    <div class="col-12  p-0 modaltitle pb-3 mb-3">
        <h5 style="margin-left: 14px;"><?php echo e(__('Products')); ?></h5>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            <input type="checkbox" id="hardware-one-time" name="products[]" value="Hardware One Time" onchange="showAdditionalProductCategoryFields()">
            <label for="hardware-one-time">Hardware One Time</label><br>

            <input type="checkbox" id="hardware-maintenance" name="products[]" value="Hardware Maintenance Contracts" onchange="showAdditionalProductCategoryFields()">
            <label for="hardware-maintenance">Hardware Maintenance Contracts</label><br>

            <input type="checkbox" id="software-recurring" name="products[]" value="Software Recurring" onchange="showAdditionalProductCategoryFields()">
            <label for="software-recurring">Software Recurring</label><br>

            <input type="checkbox" id="software-one-time" name="products[]" value="Software One Time" onchange="showAdditionalProductCategoryFields()">
            <label for="software-one-time">Software One Time</label><br>

            <input type="checkbox" id="systems-integrations" name="products[]" value="Systems Integrations" onchange="showAdditionalProductCategoryFields()">
            <label for="systems-integrations">Systems Integrations</label><br>

            <input type="checkbox" id="subscriptions" name="products[]" value="Subscriptions" onchange="showAdditionalProductCategoryFields()">
            <label for="subscriptions">Subscriptions</label><br>

            <input type="checkbox" id="tech-deployment" name="products[]" value="Tech Deployment Volume based" onchange="showAdditionalProductCategoryFields()">
            <label for="tech-deployment">Tech Deployment Volume based</label><br>
        </div>
    </div>

    <div id="hardware-one-time-fields" class="additional-product-category card">
        <h5>Hardware – One Time</h5>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_title_hardware_one_time" name="product_title_hardware_one_time[]" placeholder="Product Title">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_price_hardware_one_time" name="product_price_hardware_one_time[]" placeholder="Product Price" onkeyup="formatCurrency(this)">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_quantity_hardware_one_time" name="product_quantity_hardware_one_time[]" placeholder="Product Quantity">
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
                    <input type="text" class="form-control" id="product_opportunity_value_hardware_one_time" name="product_opportunity_value_hardware_one_time[]" placeholder="Product Opportunity Value" onkeyup="formatCurrency(this)">
                </div>
            </div>
        </div>
        <div class="col-12 plus-btn">
            <i class="fas fa-plus clone-btn"></i>
        </div>
    </div>
    <div id="hardware-maintenance-fields" class="additional-product-category card">
        <h5>Hardware – Maintenance Contracts</h5>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_title_hardware_maintenance" name="product_title_hardware_maintenance[]" placeholder="Product Title">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_price_hardware_maintenance" name="product_price_hardware_maintenance[]" placeholder="Product Price" onkeyup="formatCurrency(this)">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_quantity_hardware_maintenance" name="product_quantity_hardware_maintenance[]" placeholder="Product Quantity">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <select name="unit_hardware_maintenance[]" id="unit_hardware_maintenance" class="form-control" onchange="onUnitChange(this, 'hardware_maintenance')">
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
                    <input type="text" class="form-control" id="product_opportunity_value_hardware_maintenance" name="product_opportunity_value_hardware_maintenance[]" placeholder="Product Opportunity Value" onkeyup="formatCurrency(this)">
                </div>
            </div>
        </div>
        <div class="col-12 plus-btn">
            <i class="fas fa-plus clone-btn"></i>
        </div>
    </div>
    <div id="software-recurring-fields" class="additional-product-category card">
        <h5>Software – Recurring</h5>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_title_software_recurring" name="product_title_software_recurring[]" placeholder="Product Title">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_price_software_recurring" name="product_price_software_recurring[]" placeholder="Product Price" onkeyup="formatCurrency(this)">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_quantity_software_recurring" name="product_quantity_software_recurring[]" placeholder="Product Quantity">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <select name="unit_software_recurring[]" id="unit_software_recurring" class="form-control" onchange="onUnitChange(this, 'software_recurring')">
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
                    <input type="text" class="form-control" id="product_opportunity_value_software_recurring" name="product_opportunity_value_software_recurring[]" placeholder="Product Opportunity Value" onkeyup="formatCurrency(this)">
                </div>
            </div>
        </div>
        <div class="col-12 plus-btn">
            <i class="fas fa-plus clone-btn"></i>
        </div>
    </div>
    <div id="software-one-time-fields" class="additional-product-category card">
        <h5>Software – One Time</h5>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_title_software_one_time" name="product_title_software_one_time[]" placeholder="Product Title">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_price_software_one_time" name="product_price_software_one_time[]" placeholder="Product Price" onkeyup="formatCurrency(this)">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_quantity_software_one_time" name="product_quantity_software_one_time[]" placeholder="Product Quantity">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <select name="unit_software_one_time[]" id="unit_software_one_time" class="form-control" onchange="onUnitChange(this, 'software_one_time')">
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
                    <input type="text" class="form-control" id="product_opportunity_value_software_one_time" name="product_opportunity_value_software_one_time[]" placeholder="Product Opportunity Value" onkeyup="formatCurrency(this)">
                </div>
            </div>
        </div>
        <div class="col-12 plus-btn">
            <i class="fas fa-plus clone-btn"></i>
        </div>
    </div>
    <div id="systems-integrations-fields" class="additional-product-category card">
        <h5>Systems Integrations</h5>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_title_systems_integrations" name="product_title_systems_integrations[]" placeholder="Product Title">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_price_systems_integrations" name="product_price_systems_integrations[]" placeholder="Product Price" onkeyup="formatCurrency(this)">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_quantity_systems_integrations" name="product_quantity_systems_integrations[]" placeholder="Product Quantity">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <select name="unit_systems_integrations[]" id="unit_systems_integrations" class="form-control" onchange="onUnitChange(this, 'systems_integrations')">
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
                    <input type="text" class="form-control" id="product_opportunity_value_systems_integrations" name="product_opportunity_value_systems_integrations[]" placeholder="Product Opportunity Value" onkeyup="formatCurrency(this)">
                </div>
            </div>
        </div>
        <div class="col-12 plus-btn">
            <i class="fas fa-plus clone-btn"></i>
        </div>
    </div>
    <div id="subscriptions-fields" class="additional-product-category card">
        <h5>Subscriptions</h5>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_title_subscriptions" name="product_title_subscriptions[]" placeholder="Product Title">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_price_subscriptions" name="product_price_subscriptions[]" placeholder="Product Price" onkeyup="formatCurrency(this)">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_quantity_subscriptions" name="product_quantity_subscriptions[]" placeholder="Product Quantity">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <select name="unit_subscriptions[]" id="unit_subscriptions" class="form-control" onchange="onUnitChange(this, 'subscriptions')">
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
                    <input type="text" class="form-control" id="product_opportunity_value_subscriptions" name="product_opportunity_value_subscriptions[]" placeholder="Product Opportunity Value" onkeyup="formatCurrency(this)">
                </div>
            </div>
        </div>
        <div class="col-12 plus-btn">
            <i class="fas fa-plus clone-btn"></i>
        </div>
    </div>
    <div id="tech-deployment-fields" class="additional-product-category card">
        <h5>Tech Deployment – Volume based</h5>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_title_tech_deployment" name="product_title_tech_deployment[]" placeholder="Product Title">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_price_tech_deployment" name="product_price_tech_deployment[]" placeholder="Product Price" onkeyup="formatCurrency(this)">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_quantity_tech_deployment" name="product_quantity_tech_deployment[]" placeholder="Product Quantity">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <select name="unit_tech_deployment[]" id="unit_tech_deployment" class="form-control" onchange="onUnitChange(this, 'tech_deployment')">
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
                    <input type="text" class="form-control" id="product_opportunity_value_tech_deployment" name="product_opportunity_value_tech_deployment[]" placeholder="Product Opportunity Value" onkeyup="formatCurrency(this)">
                </div>
            </div>
        </div>
        <div class="col-12 plus-btn">
            <i class="fas fa-plus clone-btn"></i>
        </div>
    </div>
</div>
<div class="col-6 need_full">
    <div class="form-group">
        <?php echo e(Form::label('is_active',__('Active'),['class'=>'form-label'])); ?>

        <input type="checkbox" class="form-check-input" name="is_active" checked>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal">Close</button>
    <?php echo e(Form::submit(__('Save'),array('class'=>'btn btn-primary '))); ?>

</div>
<?php echo e(Form::close()); ?>


<script>
    $(document).ready(function() {
        $("input[type='text'][name='lead_name'],input[type='text'][name='name'], input[type='text'][name='email'], select[name='type'],input[type='tel'][name='primary_contact'][name='secondary_contact']").focusout(function() {

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


    // $(document).ready(function() {
    //     /* Primary contact */
    //     var input = document.querySelector("#phone-input");
    //     var iti = window.intlTelInput(input, {
    //         separateDialCode: true,
    //     });

    //     var indiaCountryCode = iti.getSelectedCountryData().iso2;
    //     var countryCode = iti.getSelectedCountryData().dialCode;
    //     $('#primary-country-code').val(countryCode);
    //     if (indiaCountryCode !== 'us') {
    //         iti.setCountry('us');
    //     }
    //     /* Secondry contact */
    //     var input1 = document.querySelector("#phone-input1");
    //     var iti1 = window.intlTelInput(input1, {
    //         separateDialCode: true,
    //     });

    //     var indiaCountryCode1 = iti1.getSelectedCountryData().iso2;
    //     var countryCode1 = iti1.getSelectedCountryData().dialCode;
    //     $('#secondary-country-code').val(countryCode1);
    //     if (indiaCountryCode1 !== 'us') {
    //         iti1.setCountry('us');
    //     }
    // });
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
    jQuery(function() {
        $('input[name = lead_name]').keyup(function() {
            var value = $(this).val();
            $('input[name = "name"]').val(value);
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
    $(document).ready(function() {
        var storedId = localStorage.getItem('clickedLinkId');
        $.ajax({
            url: "<?php echo e(route('getcontactinfo')); ?>",
            type: 'POST',
            data: {
                "customerid": storedId,
                "_token": "<?php echo e(csrf_token()); ?>",
            },
            success: function(data) {
                localStorage.removeItem('clickedLinkId');
                $('input[name="lead_name"]').val(data[0].name);
                $('input[name="name"]').val(data[0].name);
                $('input[name="primary_contact"]').val(data[0].primary_contact);
                $('input[name="secondary_contact"]').val(data[0].secondary_contact);
                $('input[name="email"]').val(data[0].email);
                $('input[name="lead_address"]').val(data[0].address);
                $('input[name="company_name"]').val(data[0].organization);
            }
        });
    })
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

</script>

<script>
    $(document).ready(function() {
        $('input[name="newevent"]').on('click', function() {
            $('#client_select').hide();
            $('#new_client').hide();
            $('#new_region').hide();
            var selectedValue = $(this).val();
            if (selectedValue == 'Existing') {
                $('#client_select').show();
                $('select[name="existing_client"]').trigger('change');
            } else {
                console.log('here');
                // return false;
                $('#new_client').show();
                $('#new_region').show();
                clearInputFields();
            }
        });

        function clearInputFields() {
            $('input[name="primary_name"]').val('');
            $('input[name="primary_phone_number"]').val('');
            $('input[name="primary_email"]').val('');
            $('input[name="primary_address"]').val('');
            $('input[name="primary_organization"]').val('');

            $('input[name="secondary_name"]').val('');
            $('input[name="secondary_phone_number"]').val('');
            $('input[name="secondary_email"]').val('');
            $('input[name="secondary_address"]').val('');
            $('input[name="secondary_designation"]').val('');
        }
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
    function getExistingUser(element) {
        var existing_client_id = $(element).val();

        if (!existing_client_id) return;

        $.ajax({
            url: "<?php echo e(route('getcontactinfo')); ?>",
            type: 'POST',
            data: {
                "clientId": existing_client_id,
                "_token": "<?php echo e(csrf_token()); ?>",
            },
            success: function(data) {
                $('input[name="primary_name"]').val(data[0].primary_name);
                $('input[name="primary_phone_number"]').val(data[0].primary_phone_number);
                $('input[name="primary_email"]').val(data[0].primary_email);
                $('input[name="primary_address"]').val(data[0].primary_address);
                $('input[name="primary_organization"]').val(data[0].primary_organization);

                $('input[name="secondary_name"]').val(data[0].secondary_name);
                $('input[name="secondary_phone_number"]').val(data[0].secondary_phone_number);
                $('input[name="secondary_email"]').val(data[0].secondary_email);
                $('input[name="secondary_address"]').val(data[0].secondary_address);
                $('input[name="secondary_designation"]').val(data[0].secondary_designation);

                $('input[name="existing_region"]').val(data[0].region);
            }
        });
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
</script><?php /**PATH C:\xampp\htdocs\volo\resources\views/lead/create.blade.php ENDPATH**/ ?>