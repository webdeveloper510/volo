<?php
$settings = Utility::settings();
$productTypes = explode(',', $settings['product_type']);
$categoryTypes = explode(',', $settings['category_type']);
$subcategoryTypes = explode(',', $settings['subcategory_type']);
?>


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
                                                    <input type="tel" name="secondary_phone_number" class="phone-input form-control" placeholder="Enter Phone Number" maxlength="16" value="<?php echo e($lead->secondary_contact); ?>">
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
                                                        <?php echo e($user->name); ?>

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
                                                    <?php $__currentLoopData = $categoryTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($category); ?>" <?php echo e($lead->category == $category ? 'selected' : ''); ?>><?php echo e($category); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-6 need_full">
                                            <div class="form-group">
                                                <label for="sales_subcategory">Sales Subcategory</label>
                                                <select name="sales_subcategory" id="sales_subcategory" class="form-control">
                                                    <option value="" disabled <?php echo e(is_null($lead->sales_subcategory) ? 'selected' : ''); ?>>Select Sales Subcategory</option>
                                                    <?php $__currentLoopData = $subcategoryTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($subcategory); ?>" <?php echo e($lead->sales_subcategory == $subcategory ? 'selected' : ''); ?>><?php echo e($subcategory); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                            <?php $__currentLoopData = $productTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                            $cleanedType = trim(preg_replace('/\s+/', ' ', str_replace('-', ' ', $type)));
                                            $id = strtolower(str_replace(' ', '-', $cleanedType));
                                            $isChecked = !is_null($lead->products) && in_array($type, $lead->products) ? 'checked' : '';
                                            ?>
                                            <input type="checkbox" id="<?php echo e($id); ?>" name="products[]" value="<?php echo e($type); ?>" <?php echo e($isChecked); ?> onchange="showAdditionalProductCategoryFields(this)">
                                            <label for="<?php echo e($id); ?>"><?php echo e($type); ?></label><br>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                    <div id="additional-fields-container"></div>

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
                                        <?php echo e(Form::submit(__('Update'),array('class'=>'btn btn-primary', 'id'=>'submit-button'))); ?>

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
        $("input[type='text'][name='lead_name'],input[type='text'][name='name'], input[type='text'][name='email'], select[name='type'],input[type='tel'][name='primary_contact'],input[type='date'][name='start_date']").focusout(function() {

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

<!-- <script>
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
</script> -->

<!-- <script>
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
</script> -->
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const products = <?php echo json_encode($lead->products, 15, 512) ?>;
        const productDetails = <?php echo json_encode($lead->product_details, 15, 512) ?>;

        products.forEach(product => {
            const checkbox = document.querySelector(`input[value="${product}"]`);
            if (checkbox) {
                checkbox.checked = true;
                showAdditionalProductCategoryFields(checkbox, productDetails[product]);
            }
        });
    });

    function showAdditionalProductCategoryFields(checkbox, productDetails = null) {
        const type = checkbox.value;
        let cleanedType = type.replace(/-/g, ' ');
        cleanedType = $.trim(cleanedType.replace(/\s+/g, ' '));
        const prefixType = cleanedType.toLowerCase().replace(/\s+/g, '-');
        const containerId = `${prefixType}-fields`;

        if (checkbox.checked) {
            let additionalFields = `
        <div id="${containerId}" class="additional-product-category card">
            <h5>${type}</h5>
            <div class="col-12 plus-btn">
                <i class="fas fa-plus clone-btn" onclick="cloneRow(this)"></i>
            </div>`;

            if (productDetails) {
                productDetails.forEach((detail, index) => {
                    additionalFields +=  `
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" class="form-control" name="title_${prefixType}[]" value="${detail.title}" placeholder="Product Title">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" class="form-control" name="price_${prefixType}[]" value="${detail.price}" placeholder="Product Price" onkeyup="formatCurrency(this)">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" class="form-control" name="quantity_${prefixType}[]" value="${detail.quantity}" placeholder="Product Quantity">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <select name="unit_${prefixType}[]" class="form-control">
                                <option value="" disabled>Select Unit</option>
                                <option value="Spaces" ${detail.unit === 'Spaces' ? 'selected' : ''}>Spaces</option>
                                <option value="Locations" ${detail.unit === 'Locations' ? 'selected' : ''}>Locations</option>
                                <option value="Count / Quantity" ${detail.unit === 'Count / Quantity' ? 'selected' : ''}>Count / Quantity</option>
                                <option value="Vehicles" ${detail.unit === 'Vehicles' ? 'selected' : ''}>Vehicles</option>
                                <option value="Sites" ${detail.unit === 'Sites' ? 'selected' : ''}>Sites</option>
                                <option value="Chargers" ${detail.unit === 'Chargers' ? 'selected' : ''}>Chargers</option>
                                <option value="Volume" ${detail.unit === 'Volume' ? 'selected' : ''}>Volume</option>
                                <option value="Transactions Count" ${detail.unit === 'Transactions Count' ? 'selected' : ''}>Transactions Count</option>
                                <option value="Other" ${detail.unit === 'Other' ? 'selected' : ''}>Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" class="form-control" name="opportunity_value_${prefixType}[]" value="${detail.opportunity_value}" placeholder="Product Opportunity Value" onkeyup="formatCurrency(this)">
                        </div>
                    </div>
                    ${index > 0 ? '<div class="minus-btn"><i class="fas fa-minus remove-btn" onclick="removeRow(this)"></i></div>' : ''}
                </div>`;
                });
            } else {
                additionalFields += `
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <input type="text" class="form-control" name="title_${prefixType}[]" placeholder="Product Title">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input type="text" class="form-control" name="price_${prefixType}[]" placeholder="Product Price" onkeyup="formatCurrency(this)">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input type="text" class="form-control" name="quantity_${prefixType}[]" placeholder="Product Quantity">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <select name="unit_${prefixType}[]" class="form-control">
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
                        <input type="text" class="form-control" name="opportunity_value_${prefixType}[]" placeholder="Product Opportunity Value" onkeyup="formatCurrency(this)">
                    </div>
                </div>
            </div>`;
            }

            additionalFields += `</div>`;
            $('#additional-fields-container').append(additionalFields);
        } else {
            $(`#${containerId}`).remove();
        }
    }

    function cloneRow(button) {
        const row = $(button).closest('.additional-product-category').find('.row').first();
        const clonedRow = row.clone();
        clonedRow.find('input').val('');
        clonedRow.find('select').val('');
        clonedRow.append('<div class="minus-btn"><i class="fas fa-minus remove-btn" onclick="removeRow(this)"></i></div>');
        row.after(clonedRow);
    }

    function removeRow(button) {
        $(button).closest('.row').remove();
    }

    function formatCurrency(input) {
        let value = input.value.replace(/,/g, '');
        value = parseFloat(value).toLocaleString('en-US');
        input.value = value;
    }

    $('#submit-button').on('click', function(event) {
        event.preventDefault();
        const formData = {};

        $('input[type="checkbox"][name="products[]"]:checked').each(function() {
            const productType = $(this).val();
            const prefixType = productType.toLowerCase().replace(/\s+/g, '-');
            const rows = [];

            $(`#${prefixType}-fields .row`).each(function() {
                const row = {
                    title: $(this).find(`input[name="title_${prefixType}[]"]`).val(),
                    price: $(this).find(`input[name="price_${prefixType}[]"]`).val(),
                    quantity: $(this).find(`input[name="quantity_${prefixType}[]"]`).val(),
                    unit: $(this).find(`select[name="unit_${prefixType}[]"]`).val(),
                    opportunity_value: $(this).find(`input[name="opportunity_value_${prefixType}[]"]`).val()
                };
                rows.push(row);
            });

            formData[productType] = rows;
        });

        console.log('formData:', formData); // Debug log

        $('<input>').attr({
            type: 'hidden',
            name: 'formData',
            value: JSON.stringify(formData)
        }).appendTo('#formdata');

        $('#formdata').submit();
    });
</script>


<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\volo\resources\views/lead/edit.blade.php ENDPATH**/ ?>