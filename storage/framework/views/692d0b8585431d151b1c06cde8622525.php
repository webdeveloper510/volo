<?php
$plansettings = App\Models\Utility::plansettings();
$settings = Utility::settings();
$type_arr= explode(',',$settings['event_type']);
$type_arr = array_combine($type_arr, $type_arr);
$venue = explode(',',$settings['venue']);
if(isset($settings['function']) && !empty($settings['function'])){
$function = json_decode($settings['function'],true);
}
if(isset($settings['barpackage']) && !empty($settings['barpackage'])){
$bar_package = json_decode($settings['barpackage'],true);
}
$baropt = ['Open Bar', 'Cash Bar', 'Package Choice'];
if(isset($settings['barpackage']) && !empty($settings['barpackage'])){
$bar_package = json_decode($settings['barpackage'],true);
}
if(isset($settings['additional_items']) && !empty($settings['additional_items'])){
$additional_items = json_decode($settings['additional_items'],true);
}

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
</style>
<?php echo e(Form::open(array('url'=>'lead','method'=>'post','enctype'=>'multipart/form-data' ,'id'=>'formdata'))); ?>

<input type="hidden" name="storedid" value="">
<div class="row">
    <div class="col-6 need_full">
        <div class="form-group">
            <?php echo e(Form::label('lead_name',__('Opportunity Name'),['class'=>'form-label'])); ?>

            <span class="text-sm">
                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
            </span>
            <?php echo e(Form::text('lead_name',null,array('class'=>'form-control','placeholder'=>__('Enter Opportunity Name'),'required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            <?php echo e(Form::label('company_name',__('Company Name'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('company_name',null,array('class'=>'form-control','placeholder'=>__('Enter Company Name')))); ?>

        </div>
    </div>
    <div class="col-12  p-0 modaltitle pb-3 mb-3">
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
    <!-- <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('phone',__('Phone'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('phone',null,array('class'=>'form-control','placeholder'=>__('Enter Phone'),'required'=>'required'))); ?>

        </div>
    </div> -->
    <div class="col-6 need_full">
        <div class="form-group ">
            <?php echo e(Form::label('name',__('Primary contact'),['class'=>'form-label'])); ?>

            <span class="text-sm">
                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
            </span>
            <div class="intl-tel-input">
                <input type="tel" id="phone-input" name="primary_contact" class="phone-input form-control" placeholder="Enter Primary contact" maxlength="16">
                <input type="hidden" name="primary_countrycode" id="primary-country-code">
            </div>
        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group ">
            <?php echo e(Form::label('name',__('Secondary contact'),['class'=>'form-label'])); ?>

            <!-- <span class="text-sm">
                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
            </span> -->
            <div class="intl-tel-input">
                <input type="tel" id="phone-input1" name="secondary_contact" class="phone-input form-control" placeholder="Enter Phone" maxlength="16">
                <input type="hidden" name="secondary_countrycode" id="secondary-country-code">
            </div>
        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            <?php echo e(Form::label('email',__('Email'),['class'=>'form-label'])); ?>

            <span class="text-sm">
                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
            </span>
            <?php echo e(Form::text('email',null,array('class'=>'form-control','placeholder'=>__('Enter Email')))); ?>

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
    </div>
    <div class="col-12  p-0 modaltitle pb-3 mb-3">
        <h5 style="margin-left: 14px;"><?php echo e(__('Details')); ?></h5>
    </div>
    <!-- <div class="col-6 need_full">
        <div class="form-group">
            <?php echo e(Form::label('type',__('Training Type'),['class'=>'form-label'])); ?>

            <span class="text-sm">
                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
            </span>
            <select name="type" id="type" class="form-control" required>
                <option value="">Select Type</option>
                <?php $__currentLoopData = $type_arr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($type); ?>"><?php echo e($type); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div> -->
    
    <!-- <div class="col-6 need_full">
        <div class="form-group">
            <?php echo e(Form::label('venue_selection', __('Mode of Trainings'), ['class' => 'form-label'])); ?>

            <div>
                <?php $__currentLoopData = $venue; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo e(Form::checkbox('venue[]', $label, false, ['id' => 'venue' . ($key + 1)])); ?>

                <?php echo e(Form::label($label, $label)); ?>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div> -->
    
    <!-- <div class="col-6 need_full">
        <div class="form-group">
            <?php echo e(Form::label('start_date', __('Date of Training'), ['class' => 'form-label'])); ?>

            <span class="text-sm">
                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
            </span>
            <?php echo Form::date('start_date', date('Y-m-d'), ['class' => 'form-control','required' =>'required']); ?>

        </div>
    </div> -->
    <!-- <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('end_date', __('End Date'), ['class' => 'form-label'])); ?>

            <?php echo Form::date('end_date', date('Y-m-d'), ['class' => 'form-control']); ?>

        </div>
    </div> -->

    <!-- <div class="col-6 need_full">
        <div class="form-group">
            <?php echo e(Form::label('guest_count',__('Guest Count'),['class'=>'form-label'])); ?>

            <?php echo Form::number('guest_count',old('guest_count'),array('class' => 'form-control','min'=> 0)); ?>

        </div>
    </div> -->
    <?php if(isset($function) && !empty($function)): ?>
    <div class="col-6 need_full">
        <div class="form-group">
            <?php echo e(Form::label('function', __('Product & Services'), ['class' => 'form-label'])); ?>

            <div>
                <?php $__currentLoopData = $function; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="form-check" style="    padding-left: 2.75em !important;">
                    <?php echo Form::checkbox('function[]', $value['function'], null, ['class' => 'form-check-input', 'id' =>
                    'function_' . $key]); ?>

                    <?php echo e(Form::label($value['function'], $value['function'], ['class' => 'form-check-label'])); ?>

                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
    <div class="col-6 need_full" id="mailFunctionSection">
        <?php if(isset($function) && !empty($function)): ?>
        <?php $__currentLoopData = $function; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="form-group" data-main-index="<?php echo e($key); ?>" data-main-value="<?php echo e($value['function']); ?>" id="function_package" style="display: none;">
            <?php echo e(Form::label('package', __($value['function']), ['class' => 'form-label'])); ?>

            <?php $__currentLoopData = $value['package']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="form-check" data-main-index="<?php echo e($k); ?>" data-main-package="<?php echo e($package); ?>">
                <?php echo Form::checkbox('package_'.str_replace(' ', '', strtolower($value['function'])).'[]',$package,
                null,
                ['id' => 'package_' . $key.$k, 'data-function' => $value['function'], 'class' => 'form-check-input']); ?>

                <?php echo e(Form::label($package, $package, ['class' => 'form-check-label'])); ?>

            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </div>
    <?php if(isset($additional_items) && !empty($additional_items)): ?>
    <div class="col-6 need_full" id="additionalSection">
        <div class="form-group">
            <?php echo e(Form::label('additional', __('Additional items'), ['class' => 'form-label'])); ?>

            <?php $__currentLoopData = $additional_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ad_key =>$ad_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $__currentLoopData = $ad_value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fun_key =>$packageVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="form-group" data-additional-index="<?php echo e($fun_key); ?>" data-additional-value="<?php echo e(key($packageVal)); ?>" id="ad_package" style="display:none;">
                <?php echo e(Form::label('additional', __($fun_key), ['class' => 'form-label'])); ?>

                <?php $__currentLoopData = $packageVal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pac_key =>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="form-check" data-additional-index="<?php echo e($pac_key); ?>" data-additional-package="<?php echo e($pac_key); ?>">
                    <?php echo Form::checkbox('additional_'.str_replace(' ', '_', strtolower($fun_key)).'[]',$pac_key, null,
                    ['data-function' => $fun_key, 'class' => 'form-check-input']); ?>

                    <?php echo e(Form::label($pac_key, $pac_key, ['class' => 'form-check-label'])); ?>

                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <?php endif; ?>

    <?php endif; ?>
    <div class="col-6 need_full">
        <div class="form-group">
            <?php echo e(Form::label('Assign Staff',__('Assign Staff'),['class'=>'form-label'])); ?>

            <select class="form-control" name='user'>
                <option value="">Select Staff</option>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option class="form-control" value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?> (<?php echo e($user->type); ?>)</option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            <label for="measure_units_quantity">Unit</label>
            <select name="measure_units_quantity" id="measure_units_quantity" class="form-control" required>
                <option value="" selected disabled>Select Unit</option>
                <option value="spaces">Spaces</option>
                <option value="locations">Locations</option>
                <option value="count-quantity">Count / Quantity</option>
                <option value="vehicles">Vehicles</option>
                <option value="sites">Sites</option>
                <option value="chargers">Chargers</option>
                <option value="volume">Volume</option>
                <option value="transactions-count">Transactions Count</option>
            </select>
        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            <label for="value_of_opportunity">Value of Opportunity</label>
            <input type="text" name="value_of_opportunity" value="" placeholder="Enter Value of Opportunity" class="form-control">
        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            <label for="timing_close">Timing – Close</label>
            <select name="timing_close" id="timing_close" class="form-control" required>
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
            <label for="lead_status">Sales Stage</label>
            <select name="lead_status" id="lead_status" class="form-control" required>
                <option value="" selected disabled>Select Sales Stage</option>
                <option value="New">New: Indicates a new lead or opportunity that has just been added to the system.</option>
                <option value="Contacted">Contacted: The lead has been contacted but no further action has been taken yet.</option>
                <option value="Qualifying">Qualifying: The lead is being assessed to determine if it fits the criteria for a potential deal.</option>
                <option value="Qualified">Qualified: The lead has been qualified and is deemed a valid opportunity.</option>
                <option value="Proposal Sent">Proposal Sent: A proposal or quotation has been sent to the potential client.</option>
                <option value="Negotiation">Negotiation: Active discussions and negotiations are taking place with the client.</option>
                <option value="Awaiting Decision">Awaiting Decision: Waiting for the client to make a decision based on the proposal and negotiations.</option>
                <option value="Closed Won">Closed Won: The deal has been successfully closed and the client has agreed to the terms.</option>
                <option value="Closed Lost">Closed Lost: The deal has been lost or the client has decided not to proceed.</option>
                <option value="Closed No Decision">Closed No Decision: The deal has been closed without any decision, often due to inactivity or the client's indecision.</option>
                <option value="Follow-Up Needed">Follow-Up Needed: The deal requires follow-up actions or additional information.</option>
                <option value="On Hold">On Hold: The deal is temporarily paused or delayed, possibly awaiting further information or changes in client status.</option>
                <option value="Implementation">Implementation: The deal is won, and the implementation or delivery process is in progress.</option>
                <option value="Renewal">Renewal: The deal is in the stage of renewal, typically for subscription-based or recurring services/products.</option>
                <option value="Upsell">Upsell: There is an opportunity to sell additional products or services to the client.</option>
            </select>
        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            <label for="deal_length">Deal Length</label>
            <select name="deal_length" id="deal_length" class="form-control" required>
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
            <select name="difficult_level" id="difficult_level" class="form-control" required>
                <option value="" selected disabled>Select Difficulty Level</option>
                <option value="Very Easy">Very Easy: The deal is expected to close with minimal effort; there are no significant obstacles.</option>
                <option value="Easy">Easy: The deal is likely to close without major challenges; some effort is required but no significant hurdles are anticipated.</option>
                <option value="Moderate">Moderate: The deal has some challenges that need to be addressed, but it is still attainable with reasonable effort.</option>
                <option value="Challenging">Challenging: The deal presents several significant challenges that will require substantial effort and strategic planning to overcome.</option>
                <option value="Difficult">Difficult: The deal has numerous obstacles and requires a high level of effort, resources, and strategy to move forward.</option>
                <option value="Very Difficult">Very Difficult: The deal is expected to be very hard to close due to major hurdles, high competition, or other significant barriers.</option>
                <option value="Complex">Complex: The deal involves multiple stakeholders, lengthy negotiations, and complex requirements, making it harder to manage and close.</option>
                <option value="High Risk">High Risk: The deal has a high likelihood of not closing due to various risk factors such as financial instability of the client, high competition, or uncertain requirements.</option>
            </select>
        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            <label for="probability_to_close">Probability to close</label>
            <select name="probability_to_close" id="probability_to_close" class="form-control" required>
                <option value="" selected disabled>Select Probability to close</option>
                <option value="Highly Probable">Highly Probable: The deal is very likely to close with minimal obstacles. Probability of success is above 90%.</option>
                <option value="Probable">Probable: The deal is likely to close with some manageable challenges. Probability of success is between 70% and 90%.</option>
                <option value="Likely">Likely: The deal has a good chance of closing, but there are noticeable challenges that need to be addressed. Probability of success is between 50% and 70%.</option>
                <option value="Possible">Possible: The deal has a reasonable chance of closing, but significant effort and resources are required to overcome the challenges. Probability of success is between 30% and 50%.</option>
                <option value="Unlikely">Unlikely: The deal has several substantial obstacles, making it less likely to close. Probability of success is between 10% and 30%.</option>
                <option value="Highly Unlikely">Highly Unlikely: The deal faces numerous major challenges and is very unlikely to close. Probability of success is below 10%.</option>
                <option value="Unknown">Unknown: The probability of the deal closing is unclear due to insufficient information or rapidly changing circumstances. Further analysis is needed.</option>
            </select>
        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            <label for="category">Select Category</label>
            <select name="category" id="category" class="form-control">
                <option value="" selected disabled>Select Category</option>
                <option value="Partner" class="form-control">Partner</option>
                <option value="Reseller" class="form-control">Reseller</option>
                <option value="Introducer" class="form-control">Introducer</option>
                <option value="Direct Customer" class="form-control">Direct Customer</option>
                <option value="Host" class="form-control">Host</option>
                <option value="Tennant" class="form-control">Tennant</option>
            </select>
        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            <label for="sales_subcategory">Sales Subcategory</label>
            <select name="sales_subcategory" id="sales_subcategory" class="form-control" required>
                <option value="" selected disabled>Select Sales Subcategory</option>
                <option value="Public" class="form-control">Public</option>
                <option value="Private" class="form-control">Private</option>
                <option value="Government" class="form-control">Government</option>
            </select>
        </div>
    </div>

    <!-- <div class="col-12  p-0 modaltitle pb-3 mb-3"> -->
    <!-- <hr class="mt-2 mb-2"> -->
    <!-- <h5 style="margin-left: 14px;"><?php echo e(__('Other Information')); ?></h5> -->
    <!-- </div> -->
    <!-- <div class="col-6 need_full">
        <div class="form-group">
            <?php echo e(Form::label('allergies',__('Allergies'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('allergies',null,array('class'=>'form-control','placeholder'=>__('Enter Allergies(if any)')))); ?>

        </div>
    </div>
    <div class="col-6 need_full">~
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
    <div class="col-12  p-0 modaltitle pb-3 mb-3">
        <!-- <hr class="mt-2 mb-2"> -->
        <h5 style="margin-left: 14px;"><?php echo e(__('Product Category')); ?></h5>
    </div>
    <!-- <div class="col-6 need_full">
        <div class="form-group">
            <?php echo Form::label('baropt', 'Bar'); ?>

            <?php $__currentLoopData = $baropt; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div>
                <?php echo e(Form::radio('baropt', $label, false, ['id' => $label])); ?>

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
                <?php echo Form::radio('bar'.'_'.str_replace(' ', '', strtolower($value['bar'])), $bar, false, ['id' => 'bar_'
                . $key.$k, 'data-function' => $value['bar'], 'class' => 'form-check-input']); ?>

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

            <input type="number" name="rooms" id="" placeholder="Enter No. of Room(if required)" min='0' class="form-control" value="<?php echo e(old('guest_count')); ?>">
        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            <?php echo e(Form::label('start_time', __('Estimated Start Time (24-Hour Format)'), ['class' => 'form-label'])); ?>

            <?php echo Form::input('time', 'start_time', 'null', ['class' => 'form-control']); ?>

        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            <?php echo e(Form::label('end_time', __('Estimated End Time (24-Hour Format)'), ['class' => 'form-label'])); ?>

            <?php echo Form::input('time', 'end_time', 'null', ['class' => 'form-control']); ?>

        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            <?php echo e(Form::label('is_active',__('Active'),['class'=>'form-label'])); ?>

            <input type="checkbox" class="form-check-input" name="is_active" checked>
        </div>
    </div> -->
    <div class="col-6 need_full">
        <div class="form-group">
            <input type="checkbox" id="hardware-one-time" name="service[]" value="Hardware – One Time" onchange="showAdditionalProductCategoryFields()">
            <label for="hardware-one-time">Hardware – One Time</label><br>

            <input type="checkbox" id="hardware-maintenance" name="service[]" value="Hardware – Maintenance Contracts" onchange="showAdditionalProductCategoryFields()">
            <label for="hardware-maintenance">Hardware – Maintenance Contracts</label><br>

            <input type="checkbox" id="software-recurring" name="service[]" value="Software – Recurring" onchange="showAdditionalProductCategoryFields()">
            <label for="software-recurring">Software – Recurring</label><br>

            <input type="checkbox" id="software-one-time" name="service[]" value="Software – One Time" onchange="showAdditionalProductCategoryFields()">
            <label for="software-one-time">Software – One Time</label><br>

            <input type="checkbox" id="systems-integrations" name="service[]" value="Systems Integrations" onchange="showAdditionalProductCategoryFields()">
            <label for="systems-integrations">Systems Integrations</label><br>

            <input type="checkbox" id="subscriptions" name="service[]" value="Subscriptions" onchange="showAdditionalProductCategoryFields()">
            <label for="subscriptions">Subscriptions</label><br>

            <input type="checkbox" id="tech-deployment" name="service[]" value="Tech Deployment – Volume based" onchange="showAdditionalProductCategoryFields()">
            <label for="tech-deployment">Tech Deployment – Volume based</label><br>
        </div>
    </div>
    <div id="hardware-one-time-fields" class="additional-product-category card">
        <label>Hardware – One Time</label>
        <i class="fas fa-plus clone-btn"></i>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_title_hardware_one_time" name="product_title_hardware_one_time" placeholder="Product Title">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_price_hardware_one_time" name="product_price_hardware_one_time" placeholder="Product Price">
                </div>
            </div>
        </div>
    </div>

    <div id="hardware-maintenance-fields" class="additional-product-category card">
        <label>Hardware – Maintenance Contracts</label>
        <i class="fas fa-plus clone-btn"></i>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_title_hardware_maintenance" name="product_title_hardware_maintenance" placeholder="Product Title">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_price_hardware_maintenance" name="product_price_hardware_maintenance" placeholder="Product Price">
                </div>
            </div>
        </div>
    </div>

    <div id="software-recurring-fields" class="additional-product-category card">
        <label>Software – Recurring</label>
        <i class="fas fa-plus clone-btn"></i>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_title_software_recurring" name="product_title_software_recurring" placeholder="Product Title">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_price_software_recurring" name="product_price_software_recurring" placeholder="Product Price">
                </div>
            </div>
        </div>
    </div>

    <div id="software-one-time-fields" class="additional-product-category card">
        <label>Software – One Time</label>
        <i class="fas fa-plus clone-btn"></i>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_title_software_one_time" name="product_title_software_one_time" placeholder="Product Title">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_price_software_one_time" name="product_price_software_one_time" placeholder="Product Price">
                </div>
            </div>
        </div>
    </div>

    <div id="systems-integrations-fields" class="additional-product-category card">
        <label>Systems Integrations</label>
        <i class="fas fa-plus clone-btn"></i>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_title_systems_integrations" name="product_title_systems_integrations" placeholder="Product Title">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_price_systems_integrations" name="product_price_systems_integrations" placeholder="Product Price">
                </div>
            </div>
        </div>
    </div>

    <div id="subscriptions-fields" class="additional-product-category card">
        <label>Subscriptions</label>
        <i class="fas fa-plus clone-btn"></i>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_title_subscriptions" name="product_title_subscriptions" placeholder="Product Title">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_price_subscriptions" name="product_price_subscriptions" placeholder="Product Price">
                </div>
            </div>
        </div>
    </div>

    <div id="tech-deployment-fields" class="additional-product-category card">
        <label>Tech Deployment – Volume based</label>
        <i class="fas fa-plus clone-btn"></i>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_title_tech_deployment" name="product_title_tech_deployment" placeholder="Product Title">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_price_tech_deployment" name="product_price_tech_deployment" placeholder="Product Price">
                </div>
            </div>
        </div>
    </div>

</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal">Close</button>
    <?php echo e(Form::submit(__('Save'),array('class'=>'btn btn-primary '))); ?>

</div>
<style>
    .iti.iti--allow-dropdown.iti--separate-dial-code {
        width: 100%;
    }
</style>
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


    $(document).ready(function() {
        /* Primary contact */
        var input = document.querySelector("#phone-input");
        var iti = window.intlTelInput(input, {
            separateDialCode: true,
        });

        var indiaCountryCode = iti.getSelectedCountryData().iso2;
        var countryCode = iti.getSelectedCountryData().dialCode;
        $('#primary-country-code').val(countryCode);
        if (indiaCountryCode !== 'us') {
            iti.setCountry('us');
        }
        /* Secondry contact */
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
    // $(document).ready(function() {
    //     $('#start_date, #end_date').change(function() {
    //         var startDate = new Date($('#start_date').val());
    //         var endDate = new Date($('#end_date').val());

    //         if ($(this).attr('id') === 'start_date' && endDate < startDate) {
    //             $('#end_date').val($('#start_date').val());
    //         } else if ($(this).attr('id') === 'end_date' && endDate < startDate) {
    //             $('#start_date').val($('#end_date').val());
    //         }
    //     });
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
            event.preventDefault(); // Prevent the default form submission

            // Get the parent .additional-product-category div
            var parentDiv = $(this).closest('.additional-product-category');

            // Get the first .row div inside the parent
            var rowDiv = parentDiv.find('.row').first();

            // Clone the .row div
            var clone = rowDiv.clone();

            // Get all input fields in the clone and clear their values
            clone.find('input').val('');

            // Append a remove button to the cloned row
            clone.append('<i class="fas fa-minus remove-btn"></i>');

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
<?php echo e(Form::close()); ?><?php /**PATH C:\xampp\htdocs\volo\resources\views/lead/create.blade.php ENDPATH**/ ?>