@php
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

@endphp
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

<div class="card-body">
    <div class="row">
        <div class="col-md-12">
            {{Form::label('Select Existing Opportunity/New Opportunity',__('Select Existing Opportunity/New Opportunity'),['class'=>'form-label']) }}
            <div class="form-group">
                {{ Form::radio('newevent',__('Existing Opportunity'),true) }}
                {{ Form::label('newevent','Existing Opportunity') }}
                {{ Form::radio('newevent',__('New Opportunity'),false) }}
                {{ Form::label('newevent','New Opportunity') }}
            </div>
        </div>
    </div>
</div>
{{Form::open(array('url'=>'lead','method'=>'post','enctype'=>'multipart/form-data' ,'id'=>'formdata'))}}
<input type="hidden" name="storedid" value="">
<div class="row">
    <div class="col-6 need_full">
        <div class="form-group">
            {{Form::label('lead_name',__('Opportunity Name'),['class'=>'form-label']) }}
            <span class="text-sm">
                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
            </span>
            {{Form::text('lead_name',null,array('class'=>'form-control','placeholder'=>__('Enter Opportunity Name'),'required'=>'required'))}}
        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            {{Form::label('company_name',__('Company Name'),['class'=>'form-label']) }}
            {{Form::text('company_name',null,array('class'=>'form-control','placeholder'=>__('Enter Company Name')))}}
        </div>
    </div>
    <div class="col-12  p-0 modaltitle pb-3 mb-3">
        <h5 style="margin-left: 14px;">{{ __('Contact Information') }}</h5>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            {{Form::label('name',__('Name'),['class'=>'form-label']) }}
            <span class="text-sm">
                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
            </span>
            {{Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Name'),'required'=>'required'))}}
        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group ">
            {{Form::label('name',__('Primary contact'),['class'=>'form-label']) }}
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
            {{Form::label('name',__('Secondary contact'),['class'=>'form-label']) }}
            <div class="intl-tel-input">
                <input type="tel" id="phone-input1" name="secondary_contact" class="phone-input form-control" placeholder="Enter Secondary contact" maxlength="16">
                <input type="hidden" name="secondary_countrycode" id="secondary-country-code">
            </div>
        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            {{Form::label('email',__('Email'),['class'=>'form-label']) }}
            <span class="text-sm">
                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
            </span>
            {{Form::text('email',null,array('class'=>'form-control','placeholder'=>__('Enter Email')))}}
        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            {{Form::label('lead_address',__('Address'),['class'=>'form-label']) }}
            {{Form::text('lead_address',null,array('class'=>'form-control','placeholder'=>__('Enter Address')))}}
        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            {{Form::label('relationship',__('Relationship'),['class'=>'form-label']) }}
            {{Form::text('relationship',null,array('class'=>'form-control','placeholder'=>__('Enter Relationship')))}}
        </div>
    </div>
    <div class="col-12  p-0 modaltitle pb-3 mb-3">
        <h5 style="margin-left: 14px;">{{ __('Details') }}</h5>
    </div>
    @if(isset($function) && !empty($function))
    <div class="col-6 need_full">
        <div class="form-group">
            {{ Form::label('function', __('Product & Services'), ['class' => 'form-label']) }}
            <div>
                @foreach($function as $key => $value)
                <div class="form-check" style="    padding-left: 2.75em !important;">
                    {!! Form::checkbox('function[]', $value['function'], null, ['class' => 'form-check-input', 'id' =>
                    'function_' . $key]) !!}
                    {{ Form::label($value['function'], $value['function'], ['class' => 'form-check-label']) }}
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-6 need_full" id="mailFunctionSection">
        @if(isset($function) && !empty($function))
        @foreach($function as $key =>$value)
        <div class="form-group" data-main-index="{{$key}}" data-main-value="{{$value['function']}}" id="function_package" style="display: none;">
            {{ Form::label('package', __($value['function']), ['class' => 'form-label']) }}
            @foreach($value['package'] as $k => $package)
            <div class="form-check" data-main-index="{{$k}}" data-main-package="{{$package}}">
                {!! Form::checkbox('package_'.str_replace(' ', '', strtolower($value['function'])).'[]',$package,
                null,
                ['id' => 'package_' . $key.$k, 'data-function' => $value['function'], 'class' => 'form-check-input'])
                !!}
                {{ Form::label($package, $package, ['class' => 'form-check-label']) }}
            </div>
            @endforeach
        </div>
        @endforeach
        @endif
    </div>
    @if(isset($additional_items) && !empty($additional_items))
    <div class="col-6 need_full" id="additionalSection">
        <div class="form-group">
            {{ Form::label('additional', __('Additional items'), ['class' => 'form-label']) }}
            @foreach($additional_items as $ad_key =>$ad_value)
            @foreach($ad_value as $fun_key =>$packageVal)
            <div class="form-group" data-additional-index="{{$fun_key}}" data-additional-value="{{key($packageVal)}}" id="ad_package" style="display:none;">
                {{ Form::label('additional', __($fun_key), ['class' => 'form-label']) }}
                @foreach($packageVal as $pac_key =>$item)
                <div class="form-check" data-additional-index="{{$pac_key}}" data-additional-package="{{$pac_key}}">
                    {!! Form::checkbox('additional_'.str_replace(' ', '_', strtolower($fun_key)).'[]',$pac_key, null,
                    ['data-function' => $fun_key, 'class' => 'form-check-input']) !!}
                    {{ Form::label($pac_key, $pac_key, ['class' => 'form-check-label']) }}
                </div>
                @endforeach
            </div>
            @endforeach
            @endforeach
        </div>
    </div>
    @endif
    @endif
    <div class="col-6 need_full">
        <div class="form-group">
            {{Form::label('Assign Staff',__('Assign Staff'),['class'=>'form-label']) }}
            <select class="form-control" name='user'>
                <option value="">Select Staff</option>
                @foreach($users as $user)
                <option class="form-control" value="{{$user->id}}">{{$user->name}} ({{$user->type}})</option>
                @endforeach
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
                <option value="New"></option>New
                <option value="Contacted"></option>Contacted
                <option value="Qualifying"></option>Qualifying
                <option value="Qualified"></option>Qualified
                <option value="NDA Signed"></option>NDA Signed
                <option value="Demo or Meeting"></option>Demo or Meeting
                <option value="Proposal"></option>Proposal
                <option value="Negotiation"></option>Negotiation
                <option value="Awaiting Decision"></option>Awaiting Decision
                <option value="Closed Won"></option>Closed Won
                <option value="Closed Lost"></option>Closed Lost
                <option value="Close No Decision"></option>Close No Decision
                <option value="Follow-Up Needed"></option>Follow-Up Needed
                <option value="Implementation"></option>Implementation
                <option value="Renewal"></option>Renewal
                <option value="Upsell"></option>Upsell
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
            <select name="probability_to_close" id="probability_to_close" class="form-control" required>
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
    <div class="col-12  p-0 modaltitle pb-3 mb-3">
        <h5 style="margin-left: 14px;">{{ __('Products') }}</h5>
    </div>
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
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_quantity_hardware_one_time" name="product_quantity_hardware_one_time" placeholder="Product Quantity">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_unit_hardware_one_time" name="product_unit_hardware_one_time" placeholder="Product Unit">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_opportunity_value_hardware_one_time" name="product_opportunity_value_hardware_one_time" placeholder="Product Opportunity Value">
                </div>
            </div>
        </div>
        <div class="col-6">
            <i class="fas fa-plus clone-btn"></i>
        </div>
    </div>
    <div id="hardware-maintenance-fields" class="additional-product-category card">
        <label>Hardware – Maintenance Contracts</label>
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
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_quantity_hardware_maintenance" name="product_quantity_hardware_maintenance" placeholder="Product Quantity">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_unit_hardware_maintenance" name="product_unit_hardware_maintenance" placeholder="Product Unit">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_opportunity_value_hardware_maintenance" name="product_opportunity_value_hardware_maintenance" placeholder="Product Opportunity Value">
                </div>
            </div>
        </div>
        <div class="col-6">
            <i class="fas fa-plus clone-btn"></i>
        </div>
    </div>
    <div id="software-recurring-fields" class="additional-product-category card">
        <label>Software – Recurring</label>
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
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_quantity_software_recurring" name="product_quantity_software_recurring" placeholder="Product Quantity">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_unit_software_recurring" name="product_unit_software_recurring" placeholder="Product Unit">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_opportunity_value_software_recurring" name="product_opportunity_value_software_recurring" placeholder="Product Opportunity Value">
                </div>
            </div>
        </div>
        <div class="col-6">
            <i class="fas fa-plus clone-btn"></i>
        </div>
    </div>
    <div id="software-one-time-fields" class="additional-product-category card">
        <label>Software – One Time</label>
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
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_quantity_software_one_time" name="product_quantity_software_one_time" placeholder="Product Quantity">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_unit_software_one_time" name="product_unit_software_one_time" placeholder="Product Unit">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_opportunity_value_software_one_time" name="product_opportunity_value_software_one_time" placeholder="Product Opportunity Value">
                </div>
            </div>
        </div>
        <div class="col-6">
            <i class="fas fa-plus clone-btn"></i>
        </div>
    </div>
    <div id="systems-integrations-fields" class="additional-product-category card">
        <label>Systems Integrations</label>
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
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_quantity_systems_integrations" name="product_quantity_systems_integrations" placeholder="Product Quantity">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_unit_systems_integrations" name="product_unit_systems_integrations" placeholder="Product Unit">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_opportunity_value_systems_integrations" name="product_opportunity_value_systems_integrations" placeholder="Product Opportunity Value">
                </div>
            </div>
        </div>
        <div class="col-6">
            <i class="fas fa-plus clone-btn"></i>
        </div>
    </div>
    <div id="subscriptions-fields" class="additional-product-category card">
        <label>Subscriptions</label>
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
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_quantity_subscriptions" name="product_quantity_subscriptions" placeholder="Product Quantity">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_unit_subscriptions" name="product_unit_subscriptions" placeholder="Product Unit">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_opportunity_value_subscriptions" name="product_opportunity_value_subscriptions" placeholder="Product Opportunity Value">
                </div>
            </div>
        </div>
        <div class="col-6">
            <i class="fas fa-plus clone-btn"></i>
        </div>
    </div>
    <div id="tech-deployment-fields" class="additional-product-category card">
        <label>Tech Deployment – Volume based</label>
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
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_quantity_tech_deployment" name="product_quantity_tech_deployment" placeholder="Product Quantity">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_unit_tech_deployment" name="product_unit_tech_deployment" placeholder="Product Unit">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_opportunity_value_tech_deployment" name="product_opportunity_value_tech_deployment" placeholder="Product Opportunity Value">
                </div>
            </div>
        </div>
        <div class="col-6">
            <i class="fas fa-plus clone-btn"></i>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal">Close</button>
    {{Form::submit(__('Save'),array('class'=>'btn btn-primary '))}}
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
            url: "{{ route('getcontactinfo') }}",
            type: 'POST',
            data: {
                "customerid": storedId,
                "_token": "{{ csrf_token() }}",
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
<script>
    $('input[name="newevent"]').on('click', function() {
        $('#lead_select').hide();
        $('#new_event').hide();
        $('#event_option').show();
        var selectedValue = $(this).val();
        if (selectedValue == 'Existing Lead') {
            $('#lead_select').show();
        } else {
            $('#new_event').show();
            $('input#resetForm').trigger('click');
        }
    });
</script>
{{Form::close()}}