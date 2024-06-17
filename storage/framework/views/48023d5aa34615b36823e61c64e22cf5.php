<?php $__env->startSection('page-title'); ?>
<?php echo e(__('Review Opportunities')); ?>

<?php $__env->stopSection(); ?>
<?php
$plansettings = App\Models\Utility::plansettings();
$setting = App\Models\Utility::settings();
$type_arr= explode(',',$setting['event_type']);
$type_arr = array_combine($type_arr, $type_arr);
$venue = explode(',',$setting['venue']);
if(isset($setting['function']) && !empty($setting['function'])){
$function = json_decode($setting['function'],true);
}
if(isset($setting['additional_items']) && !empty($setting['additional_items'])){
$additional_items = json_decode($setting['additional_items'],true);
}
$meal = ['Formal Plated' ,'Buffet Style' , 'Family Style'];
$baropt = ['Open Bar', 'Cash Bar', 'Package Choice'];
if(isset($setting['barpackage']) && !empty($setting['barpackage'])){
$bar_package = json_decode($setting['barpackage'],true);
}
if(!empty($lead->func_package)){
$func_package = json_decode($lead->func_package,true);
}
if(!empty($lead->ad_opts)){
$fun_ad_opts = json_decode($lead->ad_opts,true);
}
?>
<?php
$settings = App\Models\Utility::settings();
$billings = json_decode($settings['fixed_billing'], true);
$foodpcks = json_decode($lead->func_package, true);
$labels =
    [
        'venue_rental' => 'Venue',
        'hotel_rooms' => 'Hotel Rooms',
        'food_package' => 'Food Package',
    ];
$food = [];
$totalFoodPackageCost = 0;
if (isset($billings) && !empty($billings)) {
    if (isset($foodpcks) && !empty($foodpcks)) {
        foreach ($foodpcks as $key => $foodpck) {
            foreach ($foodpck as $foods) {
                $food[] = $foods;
            }
        }
        $foodpckge = implode(',', $food);
        foreach ($food as $foodItem) {
            foreach ($billings['package'] as $category => $categoryItems) {
                if (isset($categoryItems[$foodItem])) {
                    $totalFoodPackageCost +=  (int)$categoryItems[$foodItem];
                    break;
                }
            }
        }
    }
}



$leaddata = [
    'venue_rental' => $lead->venue_selection,
    'hotel_rooms' => $lead->rooms,
    'food_package' => (isset($foodpckge) && !empty($foodpckge)) ? $foodpckge : '',
];
$venueRentalCost = 0;
$subcategories = array_map('trim', explode(',', $leaddata['venue_rental']));
foreach ($subcategories as $subcategory) {
    $venueRentalCost += $billings['venue'][$subcategory] ?? 0;
}

$leaddata['hotel_rooms_cost'] = $billings['hotel_rooms'] ?? 0;
$leaddata['venue_rental_cost'] = $venueRentalCost;
$leaddata['food_package_cost'] = $totalFoodPackageCost;

// echo "<pre>";print_r($lead->toArray());die;  

?>

<?php $__env->startSection('title'); ?>
<div class="page-header-title">
    <?php echo e(__('Review Opportunities')); ?> <?php echo e('(' . $lead->opportunity_name . ')'); ?>

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

    .iti.iti--allow-dropdown.iti--separate-dial-code {
        width: 100%;
    }
</style>
<div class="container-field">
    <div id="wrapper">
        <div id="page-content-wrapper">
            <div class="container-fluid xyz p0">
                <div class="row">
                    <div class="col-sm-12">
                        <div id="useradd-1" class="card">
                            <?php echo e(Form::model($lead, ['route' => ['lead.review.update', $lead->id], 'method' => 'POST', 'id' => "formdata"])); ?>

                            <div class="card-header">
                                <h5><?php echo e(__('Overview')); ?></h5>
                                <small class="text-muted"><?php echo e(__('Review Opportunities Information')); ?></small>
                            </div>
                            <div class="card-body ">
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
                                </div>
                                <!-- <div class="col-12  p-0 modaltitle pb-3 mb-3">
                                        <h5 style="margin-left: 14px;"><?php echo e(__('Contact Information')); ?></h5> 
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            <?php echo e(Form::label('name',__('Name'),['class'=>'form-label'])); ?>

                                            <span class="text-sm">
                                                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                            </span>
                                            <?php echo e(Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Name'),'required'=>'required'))); ?>

                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            <?php echo e(Form::label('phone',__('Primary contact'),['class'=>'form-label'])); ?>

                                            <span class="text-sm">
                                                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                            </span>
                                            <div class="intl-tel-input">
                                                <input type="tel" id="phone-input" name="primary_contact" class="phone-input form-control" placeholder="Enter Primary contact" maxlength="16" value="<?php echo e($lead->primary_contact); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            <?php echo e(Form::label('phone',__('Secondary contact'),['class'=>'form-label'])); ?>

                                            <span class="text-sm">
                                                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                            </span>
                                            <div class="intl-tel-input">
                                                <input type="tel" id="phone-input1" name="secondary_contact" class="phone-input form-control" placeholder="Enter Secondary contact" maxlength="16" value="<?php echo e($lead->secondary_contact); ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            <?php echo e(Form::label('email',__('Email'),['class'=>'form-label'])); ?>

                                            <?php echo e(Form::text('email',null,array('class'=>'form-control','placeholder'=>__('Enter Email'),'required'=>'required'))); ?>

                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            <?php echo e(Form::label('lead_address',__('Address'),['class'=>'form-label'])); ?>

                                            <?php echo e(Form::text('lead_address',null,array('class'=>'form-control','placeholder'=>__('Address')))); ?>

                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            <?php echo e(Form::label('relationship',__('Relationship'),['class'=>'form-label'])); ?>

                                            <?php echo e(Form::text('relationship',null,array('class'=>'form-control','placeholder'=>__('Enter Relationship')))); ?>

                                        </div>
                                    </div> -->

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
                                        <div class="form-group ">
                                            <?php echo e(Form::label('primary_phone_number',__('Phone Number'),['class'=>'form-label'])); ?>

                                            <span class="text-sm">
                                                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                            </span>
                                            <div class="intl-tel-input">
                                                <input type="tel" name="primary_phone_number" class="phone-input form-control" placeholder="Enter Phone Number" maxlength="16" value="<?php echo e($lead->primary_contact); ?>">
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
                                        <div class="form-group ">
                                            <?php echo e(Form::label('secondary_phone_number',__('Phone Number'),['class'=>'form-label'])); ?>

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
                                            <?php echo e(Form::label('Assign Staff',__('Assign Staff'),['class'=>'form-label'])); ?>

                                            <select class="form-control" name='assign_staff' required>
                                                <option value="">Select Staff</option>
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
                                            <input type="text" name="value_of_opportunity" value="<?php echo e($lead->value_of_opportunity); ?>" placeholder="Enter Value of Opportunity" class="form-control">
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
                                </div>

                                <div class="col-12  p-0 modaltitle pb-3 mt-3">
                                    <h5 style="margin-left: 14px;"><?php echo e(__('Products')); ?></h5>
                                </div>
                                <div class="col-6 need_full">
                                    <div class="form-group">
                                        <input type="checkbox" id="hardware-one-time" name="products[]" value="Hardware – One Time" <?php echo e(in_array('Hardware – One Time', json_decode($lead->products)) ? 'checked' : ''); ?> onchange="showAdditionalProductCategoryFields()">
                                        <label for="hardware-one-time">Hardware – One Time</label><br>

                                        <input type="checkbox" id="hardware-maintenance" name="products[]" value="Hardware – Maintenance Contracts" <?php echo e(in_array('Hardware – Maintenance Contracts', json_decode($lead->products)) ? 'checked' : ''); ?> onchange="showAdditionalProductCategoryFields()">
                                        <label for="hardware-maintenance">Hardware – Maintenance Contracts</label><br>

                                        <input type="checkbox" id="software-recurring" name="products[]" value="Software – Recurring" <?php echo e(in_array('Software – Recurring', json_decode($lead->products)) ? 'checked' : ''); ?> onchange="showAdditionalProductCategoryFields()">
                                        <label for="software-recurring">Software – Recurring</label><br>

                                        <input type="checkbox" id="software-one-time" name="products[]" value="Software – One Time" <?php echo e(in_array('Software – One Time', json_decode($lead->products)) ? 'checked' : ''); ?> onchange="showAdditionalProductCategoryFields()">
                                        <label for="software-one-time">Software – One Time</label><br>

                                        <input type="checkbox" id="systems-integrations" name="products[]" value="Systems Integrations" <?php echo e(in_array('Systems Integrations', json_decode($lead->products)) ? 'checked' : ''); ?> onchange="showAdditionalProductCategoryFields()">
                                        <label for="systems-integrations">Systems Integrations</label><br>

                                        <input type="checkbox" id="subscriptions" name="products[]" value="Subscriptions" <?php echo e(in_array('Subscriptions', json_decode($lead->products)) ? 'checked' : ''); ?> onchange="showAdditionalProductCategoryFields()">
                                        <label for="subscriptions">Subscriptions</label><br>

                                        <input type="checkbox" id="tech-deployment" name="products[]" value="Tech Deployment – Volume based" <?php echo e(in_array('Tech Deployment – Volume based', json_decode($lead->products)) ? 'checked' : ''); ?> onchange="showAdditionalProductCategoryFields()">
                                        <label for="tech-deployment">Tech Deployment – Volume based</label><br>
                                    </div>
                                </div>


                                <!-- <div class="col-12  p-0 modaltitle pb-3 mb-3">
                                        <h5 style="margin-left: 14px;"><?php echo e(__('Event Details')); ?></h5>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            <?php echo e(Form::label('type',__('Event Type'),['class'=>'form-label'])); ?>

                                            <span class="text-sm">
                                                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                            </span>
                                            <select name="type" id="type" class="form-control" required>
                                                <option value="">Select Type</option>
                                                <?php $__currentLoopData = $type_arr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($type); ?>" <?php echo e(($type == $lead->type) ? 'selected' : ''); ?>><?php echo e($type); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            <label for="venue" class="form-label"><?php echo e(__('Venue')); ?></label>
                                            <span class="text-sm">
                                                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                            </span>
                                            <?php $__currentLoopData = $venue; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div>
                                                <input type="checkbox" name="venue[]" id="<?php echo e($label); ?>" value="<?php echo e($label); ?>" <?php echo e(in_array($label, @$venue_function) ? 'checked' : ''); ?>>
                                                <label for="<?php echo e($label); ?>"><?php echo e($label); ?></label>
                                            </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            <?php echo e(Form::label('start_date', __('Date of Event'), ['class' => 'form-label'])); ?>

                                            <span class="text-sm">
                                                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                            </span>
                                            <?php echo Form::date('start_date', $lead->start_date, ['class' => 'form-control',
                                            'required' => 'required']); ?>

                                        </div>
                                    </div> -->
                                <!-- <div class="col-6">
                                        <div class="form-group">
                                            <?php echo e(Form::label('end_date', __('End Date'), ['class' => 'form-label'])); ?>

                                            <?php echo Form::date('end_date', $lead->end_date, ['class' => 'form-control',
                                            'required' => 'required']); ?>

                                        </div>
                                    </div> -->

                                <!-- <div class="col-6 need_full">
                                    <div class="form-group">
                                        <?php echo e(Form::label('guest_count',__('Guest Count'),['class'=>'form-label'])); ?>


                                        <?php echo Form::number('guest_count', null,array('class' => 'form-control','min'=>
                                        0)); ?>

                                    </div>
                                </div> -->

                                <!-- <?php if(isset($function) && !empty($function)): ?>
                                <div class="col-6 need_full">
                                    <div class="form-group">
                                        <?php echo e(Form::label('function', __('Function'), ['class' => 'form-label'])); ?>

                                        <span class="text-sm">
                                            <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                        </span>
                                        <div class="checkbox-group">
                                            <?php $__currentLoopData = $function; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <label>
                                                <input type="checkbox" id="<?php echo e($value['function']); ?>" name="function[]" value="<?php echo e($value['function']); ?>" class="function-checkbox" <?php echo e(in_array( $value['function'], $function_package) ? 'checked' : ''); ?>>
                                                <?php echo e($value['function']); ?>

                                            </label><br>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?> -->
                                <!-- <div class="col-6 need_full" id="mailFunctionSection">
                                    <?php if(isset($function) && !empty($function)): ?>
                                    <?php $__currentLoopData = $function; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="form-group" data-main-index="<?php echo e($key); ?>" data-main-value="<?php echo e($value['function']); ?>" id="function_package" style="display: none;">
                                        <?php echo e(Form::label('package', __($value['function']), ['class' => 'form-label'])); ?>

                                        <span class="text-sm">
                                            <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                        </span>
                                        <?php $__currentLoopData = $value['package']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $isChecked = false; ?>
                                        <?php if(isset($func_package) && !empty($func_package)): ?>
                                        <?php $__currentLoopData = $func_package; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $func => $pack): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $__currentLoopData = $pack; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keypac => $packval): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($package == $packval): ?>
                                        <?php $isChecked = true; ?>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                        <div class="form-check" data-main-index="<?php echo e($k); ?>" data-main-package="<?php echo e($package); ?>">
                                            <?php echo Form::checkbox('package_'.str_replace(' ', '',
                                            strtolower($value['function'])).'[]',$package,
                                            $isChecked, ['id' => 'package_' .
                                            $key.$k, 'data-function' => $value['function'], 'class' =>
                                            'form-check-input']); ?>

                                            <?php echo e(Form::label($package, $package, ['class' => 'form-check-label'])); ?>

                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </div> -->
                                <!-- <div class="col-6 need_full" id="additionalSection">
                                    <?php if(isset($additional_items) && !empty($additional_items)): ?>
                                    <?php echo e(Form::label('additional', __('Additional items'), ['class' => 'form-label'])); ?>

                                    <?php $__currentLoopData = $additional_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ad_key =>$ad_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $__currentLoopData = $ad_value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fun_key =>$packageVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="form-group" data-additional-index="<?php echo e($fun_key); ?>" data-additional-value="<?php echo e(key($packageVal)); ?>" id="ad_package" style="display: none;">
                                        <?php echo e(Form::label('additional', __($fun_key), ['class' => 'form-label'])); ?>

                                        <?php $__currentLoopData = $packageVal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pac_key =>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="form-check" data-additional-index="<?php echo e($pac_key); ?>" data-additional-package="<?php echo e($pac_key); ?>">
                                            <?php $isCheckedif = false; ?>

                                            <?php if(isset($fun_ad_opts) && !empty($fun_ad_opts )): ?>
                                            <?php $__currentLoopData = $fun_ad_opts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keys=>$valss): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                            <?php $__currentLoopData = $valss; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($pac_key == $val): ?>
                                            <?php $isCheckedif = true; ?>
                                            <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                            <?php echo Form::checkbox('additional_'.str_replace(' ', '_',
                                            strtolower($fun_key)).'[]',$pac_key, $isCheckedif, ['data-function' => $fun_key,
                                            'class' => 'form-check-input']); ?>

                                            <?php echo e(Form::label($pac_key, $pac_key, ['class' => 'form-check-label'])); ?>

                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>

                                </div> -->
                                <!-- <div class="col-6 need_full">
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
                                <!-- <div class="col-12  p-0 modaltitle pb-3 mb-3">
                                    <h5 style="margin-left: 14px;"><?php echo e(__('Other Information')); ?></h5>
                                </div>
                                <div class="col-6 need_full">
                                    <div class="form-group">
                                        <?php echo e(Form::label('allergies',__('Allergies'),['class'=>'form-label'])); ?>

                                        <?php echo e(Form::text('allergies',null,array('class'=>'form-control','placeholder'=>__('Enter Allergies(if any)')))); ?>

                                    </div>
                                </div>
                                <div class="col-6 need_full">
                                    <div class="form-group">
                                        <?php echo e(Form::label('spcl_req',__('Any Special Requirements'),['class'=>'form-label'])); ?>

                                        <?php echo e(Form::textarea('spcl_req',null,array('class'=>'form-control','rows'=>2,'placeholder'=>__('Enter Any Special Requirements')))); ?>

                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <?php echo e(Form::label('Description',__('How did you hear about us?'),['class'=>'form-label'])); ?>

                                        <?php echo e(Form::textarea('description',null,array('class'=>'form-control','rows'=>2))); ?>

                                    </div>
                                </div> -->
                                <!-- <div class="col-12  p-0 modaltitle pb-3 mb-3"> -->
                                <!-- <hr class="mt-2 mb-2"> -->
                                <!-- <h5 style="margin-left: 14px;"><?php echo e(__('Estimate Billing Summary Details')); ?></h5> -->
                                <!-- </div> -->
                                <!-- <div class="col-6 need_full">
                                    <div class="form-group">
                                        <?php echo Form::label('baropt', 'Bar'); ?>

                                        <?php $__currentLoopData = $baropt; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div>
                                            <?php echo e(Form::radio('baropt', $label,isset($lead->bar) && $lead->bar == $label ? true : false , ['id' => $label])); ?>

                                            <?php echo e(Form::label('baropt' . ($key + 1), $label)); ?>

                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div> -->
                                <!-- <div class="col-6 need_full" id="barpacakgeoptions" style="display: none;">
                                    <?php if(isset($bar_package) && !empty($bar_package)): ?>
                                    <?php $__currentLoopData = $bar_package; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="form-group" data-main-index="<?php echo e($key); ?>" data-main-value="<?php echo e($value['bar']); ?>">
                                        <?php echo e(Form::label('bar', __($value['bar']), ['class' => 'form-label'])); ?>

                                        <?php $__currentLoopData = $value['barpackage']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $bar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="form-check" data-main-index="<?php echo e($k); ?>" data-main-package="<?php echo e($bar); ?>">
                                            <?php echo Form::radio('bar'.'_'.str_replace(' ', '',
                                            strtolower($value['bar'])), $bar, false, ['id' => 'bar_' . $key.$k,
                                            'data-function' => $value['bar'], 'class' => 'form-check-input']); ?>

                                            <?php echo e(Form::label($bar, $bar, ['class' => 'form-check-label'])); ?>

                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </div> -->
                                <!-- <div class="col-6 need_full">
                                    <div class="form-group">
                                        <?php echo e(Form::label('rooms',__('Room'),['class'=>'form-label'])); ?>

                                        <input type="number" name="rooms" value="<?php echo e($lead->rooms); ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6 need_full">
                                    <div class="form-group">
                                        <?php echo e(Form::label('start_time', __('Estimated Start Time'), ['class' => 'form-label'])); ?>

                                        <?php echo Form::input('time', 'start_time', $lead->start_time, ['class' =>
                                        'form-control', 'required' => 'required']); ?>

                                    </div>
                                </div>
                                <div class="col-6 need_full">
                                    <div class="form-group">
                                        <?php echo e(Form::label('end_time', __('Estimated End Time'), ['class' => 'form-label'])); ?>

                                        <?php echo Form::input('time', 'end_time', $lead->end_time, ['class' =>
                                        'form-control', 'required' => 'required']); ?>

                                    </div>
                                </div> -->
                                <!-- <div class="col-6 need_full">
                                    <div class="form-group">
                                        <?php echo e(Form::label('status', __('Status'), ['class' => 'form-label'])); ?>

                                        <div class="checkbox-group">
                                            <input type="checkbox" id="approveCheckbox" name="status" value="Approve" <?php echo e($lead->status == 2 ? 'checked' : ''); ?>>
                                            <label for="approveCheckbox">Approve</label>

                                            <input type="checkbox" id="resendCheckbox" name="status" value="Resend" <?php echo e($lead->status == 0 ? 'checked' : ''); ?>>
                                            <label for="resendCheckbox">Resend</label>

                                            <input type="checkbox" id="withdrawCheckbox" name="status" value="Withdraw" <?php echo e($lead->status == 3 ? 'checked' : ''); ?>>
                                            <label for="withdrawCheckbox">Withdraw</label>
                                        </div>
                                    </div>
                                </div> -->

                                <div class="text-end">
                                    <?php echo e(Form::submit(__('Submit'), ['class' => 'btn-submit btn btn-primary'])); ?>

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
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
<script>
    $(document).ready(function() {
        $("input[type='text'][name='lead_name'],input[type='text'][name='name'], input[type='text'][name='email'], select[name='type'],input[type='tel'][name='primary_contact'][name='secondary_contact']")
            .focusout(function() {

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
                    input.after(
                        '<div class="validation-error text-danger" style="padding:2px;">' +
                        errorMessage + '</div>');
                }
            });
    });
</script>

<script>
    $(document).ready(function() {
        var phoneNumber = "<?php echo $lead->phone; ?>";
        var num = phoneNumber.trim();
        // if (phoneNumber.trim().length < 10) {
        //     alert('Please enter a valid phone number with at least 10 digits.');
        //     return;
        // }
        var lastTenDigits = phoneNumber.substr(-10);
        var formattedPhoneNumber = '(' + lastTenDigits.substr(0, 3) + ') ' + lastTenDigits.substr(3,
                3) + '-' +
            lastTenDigits.substr(6);
        $('#phone-input').val(formattedPhoneNumber);
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
        $('#secondary-country-code').val(countryCode1);
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
            (key === 8 || key === 9 || key === 13 || key === 46) ||
            // Allow Backspace, Tab, Enter, Delete
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
        const input = event.target.value.replace(/\D/g, '').substring(0,
            10); // First ten digits of input only
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
</script>
<script>
    var scrollSpy = new bootstrap.ScrollSpy(document.body, {
        target: '#useradd-sidenav',
        offset: 300
    })
</script>
<script>
    $('input:checkbox[name= "status"]').click(function() {
        var isChecked = $(this).prop('checked');
        var group = $(this).attr('name');

        if (isChecked) {
            $('input[name="' + group + '"]').not(this).prop('checked', false);
        }
    });
</script>
<script>
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

<!-- <script>
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
                    

                    $.each(data, function(key, value) {
                        $('#parent_id').append('<option value="' + key + '">' + value + '</option>');
                    });
                    if (data == '') {
                        $('#parent_id').empty();
                    }
                }
            });
        }
    </script> -->
<script>
    $(document).on('click', '#billing_data', function() {
        $("[name='shipping_address']").val($("[name='billing_address']").val());
        $("[name='shipping_city']").val($("[name='billing_city']").val());
        $("[name='shipping_state']").val($("[name='billing_state']").val());
        $("[name='shipping_country']").val($("[name='billing_country']").val());
        $("[name='shipping_postalcode']").val($("[name='billing_postalcode']").val());
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\volo\resources\views/lead/review_proposal.blade.php ENDPATH**/ ?>