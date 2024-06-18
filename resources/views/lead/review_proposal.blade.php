@extends('layouts.admin')
@section('page-title')
{{ __('Review Opportunities') }}
@endsection
@php
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
@endphp
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

@section('title')
<div class="page-header-title">
    {{ __('Review Opportunities') }} {{ '(' . $lead->opportunity_name . ')' }}
</div>
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
<li class="breadcrumb-item"><a href="{{ route('lead.index') }}">{{ __('Opportunities') }}</a></li>
<li class="breadcrumb-item">{{ __('Details') }}</li>
@endsection
@section('content')
<style>
    .fa-asterisk {
        font-size: xx-small;
        position: absolute;
        padding: 1px;
    }

    .iti.iti--allow-dropdown.iti--separate-dial-code {
        width: 100%;
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
                    <div class="col-sm-12">
                        <div id="useradd-1" class="card">
                            {{ Form::model($lead, ['route' => ['lead.review.update', $lead->id], 'method' => 'POST', 'id' => "formdata"]) }}
                            <div class="card-header">
                                <h5>{{ __('Overview') }}</h5>
                                <small class="text-muted">{{ __('Review Opportunities Information') }}</small>
                            </div>
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            {{Form::label('lead_name',__('Opportunity Name'),['class'=>'form-label']) }}
                                            <span class="text-sm">
                                                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                            </span>
                                            {{Form::text('lead_name',$lead->opportunity_name,array('class'=>'form-control','placeholder'=>__('Enter Opportunitie Name'),'required'=>'required'))}}
                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            {{Form::label('client_name',__('Client Name'),['class'=>'form-label']) }}
                                            {{Form::text('client_name',$client_name,array('class'=>'form-control','placeholder'=>__('Enter Client Name')))}}
                                        </div>
                                    </div>
                                </div>

                                <!--  <div class="col-6 need_full">
                                        <div class="form-group">
                                            {{Form::label('phone',__('Primary contact'),['class'=>'form-label']) }}
                                            <span class="text-sm">
                                                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                            </span>
                                            <div class="intl-tel-input">
                                                <input type="tel" id="phone-input" name="primary_contact" class="phone-input form-control" placeholder="Enter Primary contact" maxlength="16" value="{{$lead->primary_contact}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            {{Form::label('phone',__('Secondary contact'),['class'=>'form-label']) }}
                                            <span class="text-sm">
                                                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                            </span>
                                            <div class="intl-tel-input">
                                                <input type="tel" id="phone-input1" name="secondary_contact" class="phone-input form-control" placeholder="Enter Secondary contact" maxlength="16" value="{{$lead->secondary_contact}}">
                                            </div>
                                        </div>
                                    </div> -->

                                <div class="col-12  p-0 modaltitle pb-3 mt-3">
                                    <h5 style="margin-left: 14px;">{{ __('Primary Contact Information') }}</h5>
                                </div>
                                <div class="row">
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            {{Form::label('primary_name',__('Name'),['class'=>'form-label']) }}
                                            <span class="text-sm">
                                                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                            </span>
                                            {{Form::text('primary_name',$lead->primary_name,array('class'=>'form-control','placeholder'=>__('Enter Name'),'required'=>'required'))}}
                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group ">
                                            {{Form::label('primary_phone_number',__('Phone Number'),['class'=>'form-label']) }}
                                            <span class="text-sm">
                                                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                            </span>
                                            <div class="intl-tel-input">
                                                <input type="tel" name="primary_phone_number" class="phone-input form-control" placeholder="Enter Phone Number" maxlength="16" value="{{ $lead->primary_contact }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            {{Form::label('primary_email',__('Email'),['class'=>'form-label']) }}
                                            <span class="text-sm">
                                                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                            </span>
                                            {{Form::email('primary_email',$lead->primary_email,array('class'=>'form-control','placeholder'=>__('Enter Email'),'required'=>'required'))}}
                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            {{Form::label('primary_address',__('Address'),['class'=>'form-label']) }}

                                            {{Form::text('primary_address',$lead->primary_address,array('class'=>'form-control','placeholder'=>__('Enter Address')))}}
                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            {{Form::label('primary_organization',__('Title/Designation'),['class'=>'form-label']) }}
                                            {{Form::text('primary_organization',$lead->primary_organization,array('class'=>'form-control','placeholder'=>__('Enter Designation')))}}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12  p-0 modaltitle pb-3 mt-3">
                                    <h5 style="margin-left: 14px;">{{ __('Secondary Contact Information') }}</h5>
                                </div>
                                <div class="row">
                                    <div class="col-6 need_full">
                                        <input type="hidden" name="customerType" value="addForm" />
                                        <div class="form-group">
                                            {{Form::label('secondary_name',__('Name'),['class'=>'form-label']) }}
                                            {{Form::text('secondary_name',$lead->secondary_name,array('class'=>'form-control','placeholder'=>__('Enter Name')))}}
                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group ">
                                            {{Form::label('secondary_phone_number',__('Phone Number'),['class'=>'form-label']) }}
                                            <div class="intl-tel-input">
                                                <input type="tel" name="secondary_phone_number" class="phone-input form-control" placeholder="Enter Phone Number" maxlength="16" value="{{$lead->secondary_contact}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            {{Form::label('secondary_email',__('Email'),['class'=>'form-label']) }}
                                            {{Form::email('secondary_email',$lead->secondary_email,array('class'=>'form-control','placeholder'=>__('Enter Email')))}}
                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            {{Form::label('secondary_address',__('Address'),['class'=>'form-label']) }}
                                            {{Form::text('secondary_address',$lead->secondary_address,array('class'=>'form-control','placeholder'=>__('Enter Address')))}}
                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            {{Form::label('secondary_designation',__('Title/Designation'),['class'=>'form-label']) }}
                                            {{Form::text('secondary_designation',$lead->secondary_designation,array('class'=>'form-control','placeholder'=>__('Enter Designation')))}}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12  p-0 modaltitle pb-3 mt-3">
                                    <h5 style="margin-left: 14px;">{{ __('Details') }}</h5>
                                </div>

                                <div class="row">
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            {{Form::label('Assigned Team Member',__('Assigned Team Member'),['class'=>'form-label']) }}
                                            <select class="form-control" name='assign_staff' required>
                                                <option value="">Select Team Member</option>
                                                @foreach($users as $user)
                                                <option class="form-control" value="{{$user->id}}" {{ $user->id == $lead->assigned_user ? 'selected' : '' }}>
                                                    {{$user->name}} - {{$user->type}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            <label for="value_of_opportunity">Value of Opportunity</label>
                                            <input type="text" id="value_of_opportunity" name="value_of_opportunity" value="{{ number_format((float) $lead->value_of_opportunity, 0, '.', ',') }}" placeholder="Enter Value of Opportunity" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            <label for="currency">Currency</label>
                                            <select name="currency" class="form-control">
                                                <option value="" disabled {{ is_null($lead->currency) ? 'selected' : '' }}>Select Currency</option>
                                                <option value="GBP" {{ $lead->currency == 'GBP' ? 'selected' : '' }}>GBP</option>
                                                <option value="USD" {{ $lead->currency == 'USD' ? 'selected' : '' }}>USD</option>
                                                <option value="EUR" {{ $lead->currency == 'EUR' ? 'selected' : '' }}>EUR</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            <label for="timing_close">Timing – Close</label>
                                            <select name="timing_close" id="timing_close" class="form-control">
                                                <option value="" disabled {{ is_null($lead->timing_close) ? 'selected' : '' }}>Select Timing – Close</option>
                                                <option value="immediate" {{ $lead->timing_close == 'immediate' ? 'selected' : '' }}>Immediate</option>
                                                <option value="0-30-days" {{ $lead->timing_close == '0-30-days' ? 'selected' : '' }}>0-30 Days</option>
                                                <option value="31-90-days" {{ $lead->timing_close == '31-90-days' ? 'selected' : '' }}>31 – 90 Days</option>
                                                <option value="91-180-days" {{ $lead->timing_close == '91-180-days' ? 'selected' : '' }}>91 – 180 Days</option>
                                                <option value="181-360-days" {{ $lead->timing_close == '181-360-days' ? 'selected' : '' }}>181 – 360 Days</option>
                                                <option value="12-months-plus" {{ $lead->timing_close == '12-months-plus' ? 'selected' : '' }}>12 Months +</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            <label for="sales_stage">Sales Stage</label>
                                            <select name="sales_stage" id="sales_stage" class="form-control">
                                                <option value="" disabled {{ is_null($lead->sales_stage) ? 'selected' : '' }}>Select Sales Stage</option>
                                                <option value="New" {{ $lead->sales_stage == 'New' ? 'selected' : '' }}>New</option>
                                                <option value="Contacted" {{ $lead->sales_stage == 'Contacted' ? 'selected' : '' }}>Contacted</option>
                                                <option value="Qualifying" {{ $lead->sales_stage == 'Qualifying' ? 'selected' : '' }}>Qualifying</option>
                                                <option value="Qualified" {{ $lead->sales_stage == 'Qualified' ? 'selected' : '' }}>Qualified</option>
                                                <option value="NDA Signed" {{ $lead->sales_stage == 'NDA Signed' ? 'selected' : '' }}>NDA Signed</option>
                                                <option value="Demo or Meeting" {{ $lead->sales_stage == 'Demo or Meeting' ? 'selected' : '' }}>Demo or Meeting</option>
                                                <option value="Proposal" {{ $lead->sales_stage == 'Proposal' ? 'selected' : '' }}>Proposal</option>
                                                <option value="Negotiation" {{ $lead->sales_stage == 'Negotiation' ? 'selected' : '' }}>Negotiation</option>
                                                <option value="Awaiting Decision" {{ $lead->sales_stage == 'Awaiting Decision' ? 'selected' : '' }}>Awaiting Decision</option>
                                                <option value="Closed Won" {{ $lead->sales_stage == 'Closed Won' ? 'selected' : '' }}>Closed Won</option>
                                                <option value="Closed Lost" {{ $lead->sales_stage == 'Closed Lost' ? 'selected' : '' }}>Closed Lost</option>
                                                <option value="Close No Decision" {{ $lead->sales_stage == 'Close No Decision' ? 'selected' : '' }}>Close No Decision</option>
                                                <option value="Follow-Up Needed" {{ $lead->sales_stage == 'Follow-Up Needed' ? 'selected' : '' }}>Follow-Up Needed</option>
                                                <option value="Implementation" {{ $lead->sales_stage == 'Implementation' ? 'selected' : '' }}>Implementation</option>
                                                <option value="Renewal" {{ $lead->sales_stage == 'Renewal' ? 'selected' : '' }}>Renewal</option>
                                                <option value="Upsell" {{ $lead->sales_stage == 'Upsell' ? 'selected' : '' }}>Upsell</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            <label for="deal_length">Deal Length</label>
                                            <select name="deal_length" id="deal_length" class="form-control">
                                                <option value="" disabled {{ is_null($lead->deal_length) ? 'selected' : '' }}>Select Deal Length</option>
                                                <option value="One Time" {{ $lead->deal_length == 'One Time' ? 'selected' : '' }}>One Time</option>
                                                <option value="Short Term" {{ $lead->deal_length == 'Short Term' ? 'selected' : '' }}>Short Term</option>
                                                <option value="On a Needed basis" {{ $lead->deal_length == 'On a Needed basis' ? 'selected' : '' }}>On a Needed basis</option>
                                                <option value="Annual" {{ $lead->deal_length == 'Annual' ? 'selected' : '' }}>Annual</option>
                                                <option value="Multi Year" {{ $lead->deal_length == 'Multi Year' ? 'selected' : '' }}>Multi Year</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            <label for="difficult_level">Difficulty Level</label>
                                            <select name="difficult_level" id="difficult_level" class="form-control">
                                                <option value="" disabled {{ is_null($lead->difficult_level) ? 'selected' : '' }}>Select Difficulty Level</option>
                                                <option value="Very Easy" {{ $lead->difficult_level == 'Very Easy' ? 'selected' : '' }}>Very Easy</option>
                                                <option value="Easy" {{ $lead->difficult_level == 'Easy' ? 'selected' : '' }}>Easy</option>
                                                <option value="Moderate" {{ $lead->difficult_level == 'Moderate' ? 'selected' : '' }}>Moderate</option>
                                                <option value="Challenging" {{ $lead->difficult_level == 'Challenging' ? 'selected' : '' }}>Challenging</option>
                                                <option value="Difficult" {{ $lead->difficult_level == 'Difficult' ? 'selected' : '' }}>Difficult</option>
                                                <option value="Very Difficult" {{ $lead->difficult_level == 'Very Difficult' ? 'selected' : '' }}>Very Difficult</option>
                                                <option value="Complex" {{ $lead->difficult_level == 'Complex' ? 'selected' : '' }}>Complex</option>
                                                <option value="High Risk" {{ $lead->difficult_level == 'High Risk' ? 'selected' : '' }}>High Risk</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            <label for="probability_to_close">Probability to close</label>
                                            <select name="probability_to_close" id="probability_to_close" class="form-control">
                                                <option value="" disabled {{ is_null($lead->probability_to_close) ? 'selected' : '' }}>Select Probability to close</option>
                                                <option value="Highly Probable" {{ $lead->probability_to_close == 'Highly Probable' ? 'selected' : '' }}>Highly Probable</option>
                                                <option value="Probable" {{ $lead->probability_to_close == 'Probable' ? 'selected' : '' }}>Probable</option>
                                                <option value="Likely" {{ $lead->probability_to_close == 'Likely' ? 'selected' : '' }}>Likely</option>
                                                <option value="Possible" {{ $lead->probability_to_close == 'Possible' ? 'selected' : '' }}>Possible</option>
                                                <option value="Unlikely" {{ $lead->probability_to_close == 'Unlikely' ? 'selected' : '' }}>Unlikely</option>
                                                <option value="Highly Unlikely" {{ $lead->probability_to_close == 'Highly Unlikely' ? 'selected' : '' }}>Highly Unlikely</option>
                                                <option value="Unknown" {{ $lead->probability_to_close == 'Unknown' ? 'selected' : '' }}>Unknown</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            <label for="category">Select Category</label>
                                            <select name="category" id="category" class="form-control">
                                                <option value="" disabled {{ is_null($lead->category) ? 'selected' : '' }}>Select Category</option>
                                                <option value="Partner" {{ $lead->category == 'Partner' ? 'selected' : '' }}>Partner</option>
                                                <option value="Reseller" {{ $lead->category == 'Reseller' ? 'selected' : '' }}>Reseller</option>
                                                <option value="Introducer" {{ $lead->category == 'Introducer' ? 'selected' : '' }}>Introducer</option>
                                                <option value="Direct Customer" {{ $lead->category == 'Direct Customer' ? 'selected' : '' }}>Direct Customer</option>
                                                <option value="Host" {{ $lead->category == 'Host' ? 'selected' : '' }}>Host</option>
                                                <option value="Tennant" {{ $lead->category == 'Tennant' ? 'selected' : '' }}>Tennant</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            <label for="sales_subcategory">Sales Subcategory</label>
                                            <select name="sales_subcategory" id="sales_subcategory" class="form-control">
                                                <option value="" disabled {{ is_null($lead->sales_subcategory) ? 'selected' : '' }}>Select Sales Subcategory</option>
                                                <option value="Public" {{ $lead->sales_subcategory == 'Public' ? 'selected' : '' }}>Public</option>
                                                <option value="Private" {{ $lead->sales_subcategory == 'Private' ? 'selected' : '' }}>Private</option>
                                                <option value="Government" {{ $lead->sales_subcategory == 'Government' ? 'selected' : '' }}>Government</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12  p-0 modaltitle pb-3 mt-3">
                                    <h5 style="margin-left: 14px;">{{ __('Products') }}</h5>
                                </div>
                                <div class="col-6 need_full">
                                    <div class="form-group">
                                        <input type="checkbox" id="hardware-one-time" name="products[]" value="Hardware – One Time" {!! !is_null($lead->products) && in_array('Hardware – One Time', json_decode($lead->products, true)) ? 'checked' : '' !!} onchange="showAdditionalProductCategoryFields()">
                                        <label for="hardware-one-time">Hardware – One Time</label><br>

                                        <input type="checkbox" id="hardware-maintenance" name="products[]" value="Hardware – Maintenance Contracts" {!! !is_null($lead->products) && in_array('Hardware – Maintenance Contracts', json_decode($lead->products, true)) ? 'checked' : '' !!} onchange="showAdditionalProductCategoryFields()">
                                        <label for="hardware-maintenance">Hardware – Maintenance Contracts</label><br>

                                        <input type="checkbox" id="software-recurring" name="products[]" value="Software – Recurring" {!! !is_null($lead->products) && in_array('Software – Recurring', json_decode($lead->products, true)) ? 'checked' : '' !!} onchange="showAdditionalProductCategoryFields()">
                                        <label for="software-recurring">Software – Recurring</label><br>

                                        <input type="checkbox" id="software-one-time" name="products[]" value="Software – One Time" {!! !is_null($lead->products) && in_array('Software – One Time', json_decode($lead->products, true)) ? 'checked' : '' !!} onchange="showAdditionalProductCategoryFields()">
                                        <label for="software-one-time">Software – One Time</label><br>

                                        <input type="checkbox" id="systems-integrations" name="products[]" value="Systems Integrations" {!! !is_null($lead->products) && in_array('Systems Integrations', json_decode($lead->products, true)) ? 'checked' : '' !!} onchange="showAdditionalProductCategoryFields()">
                                        <label for="systems-integrations">Systems Integrations</label><br>

                                        <input type="checkbox" id="subscriptions" name="products[]" value="Subscriptions" {!! !is_null($lead->products) && in_array('Subscriptions', json_decode($lead->products, true)) ? 'checked' : '' !!} onchange="showAdditionalProductCategoryFields()">
                                        <label for="subscriptions">Subscriptions</label><br>

                                        <input type="checkbox" id="tech-deployment" name="products[]" value="Tech Deployment – Volume based" {!! !is_null($lead->products) && in_array('Tech Deployment – Volume based', json_decode($lead->products, true)) ? 'checked' : '' !!} onchange="showAdditionalProductCategoryFields()">
                                        <label for="tech-deployment">Tech Deployment – Volume based</label><br>
                                    </div>
                                </div>

                                <div id="hardware-one-time-fields" class="additional-product-category card">
                                    <h5>Hardware – One Time</h5>
                                    @if($hardware_one_time)
                                    @foreach($hardware_one_time as $index => $hardware)
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="product_title_hardware_one_time_{{ $index }}" name="product_title_hardware_one_time[]" placeholder="Product Title" value="{{ $hardware['title'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="product_price_hardware_one_time_{{ $index }}" name="product_price_hardware_one_time[]" placeholder="Product Price" onkeyup="formatCurrency(this)" value="{{ $hardware['price'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="product_quantity_hardware_one_time_{{ $index }}" name="product_quantity_hardware_one_time[]" placeholder="Product Quantity" value="{{ $hardware['quantity'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <select name="unit_hardware_one_time[]" id="unit_hardware_one_time_{{ $index }}" class="form-control" onchange="onUnitChange(this, 'hardware_one_time')">
                                                    <option value="" selected disabled>Select Unit</option>
                                                    <option value="Spaces" {{ isset($hardware['unit']) && $hardware['unit'] == 'Spaces' ? 'selected' : '' }}>Spaces</option>
                                                    <option value="Locations" {{ isset($hardware['unit']) && $hardware['unit'] == 'Locations' ? 'selected' : '' }}>Locations</option>
                                                    <option value="Count / Quantity" {{ isset($hardware['unit']) && $hardware['unit'] == 'Count / Quantity' ? 'selected' : '' }}>Count / Quantity</option>
                                                    <option value="Vehicles" {{ isset($hardware['unit']) && $hardware['unit'] == 'Vehicles' ? 'selected' : '' }}>Vehicles</option>
                                                    <option value="Sites" {{ isset($hardware['unit']) && $hardware['unit'] == 'Sites' ? 'selected' : '' }}>Sites</option>
                                                    <option value="Chargers" {{ isset($hardware['unit']) && $hardware['unit'] == 'Chargers' ? 'selected' : '' }}>Chargers</option>
                                                    <option value="Volume" {{ isset($hardware['unit']) && $hardware['unit'] == 'Volume' ? 'selected' : '' }}>Volume</option>
                                                    <option value="Transactions Count" {{ isset($hardware['unit']) && $hardware['unit'] == 'Transactions Count' ? 'selected' : '' }}>Transactions Count</option>
                                                    <option value="Other" {{ isset($hardware['unit']) && $hardware['unit'] == 'Other' ? 'selected' : '' }}>Other</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="product_opportunity_value_hardware_one_time_{{ $index }}" name="product_opportunity_value_hardware_one_time[]" placeholder="Product Opportunity Value" onkeyup="formatCurrency(this)" value="{{ $hardware['opportunity_value'] ?? '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @else
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
                                    @endif

                                    <div class="col-12 plus-btn">
                                        <i class="fas fa-plus clone-btn"></i>
                                    </div>
                                </div>



                                <div id="hardware-maintenance-fields" class="additional-product-category card">
                                    <h5>Hardware – Maintenance Contracts</h5>

                                    @if($hardware_maintenance)
                                    @foreach($hardware_maintenance as $index => $maintenance)
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="product_title_hardware_maintenance_{{ $index }}" name="product_title_hardware_maintenance[]" placeholder="Product Title" value="{{ $maintenance['title'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="product_price_hardware_maintenance_{{ $index }}" name="product_price_hardware_maintenance[]" placeholder="Product Price" onkeyup="formatCurrency(this)" value="{{ $maintenance['price'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="product_quantity_hardware_maintenance_{{ $index }}" name="product_quantity_hardware_maintenance[]" placeholder="Product Quantity" value="{{ $maintenance['quantity'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <select name="unit_hardware_maintenance[]" id="unit_hardware_maintenance_{{ $index }}" class="form-control" onchange="onUnitChange(this, 'hardware_maintenance')">
                                                    <option value="" selected disabled>Select Unit</option>
                                                    <option value="Spaces" {{ isset($maintenance['unit']) && $maintenance['unit'] == 'Spaces' ? 'selected' : '' }}>Spaces</option>
                                                    <option value="Locations" {{ isset($maintenance['unit']) && $maintenance['unit'] == 'Locations' ? 'selected' : '' }}>Locations</option>
                                                    <option value="Count / Quantity" {{ isset($maintenance['unit']) && $maintenance['unit'] == 'Count / Quantity' ? 'selected' : '' }}>Count / Quantity</option>
                                                    <option value="Vehicles" {{ isset($maintenance['unit']) && $maintenance['unit'] == 'Vehicles' ? 'selected' : '' }}>Vehicles</option>
                                                    <option value="Sites" {{ isset($maintenance['unit']) && $maintenance['unit'] == 'Sites' ? 'selected' : '' }}>Sites</option>
                                                    <option value="Chargers" {{ isset($maintenance['unit']) && $maintenance['unit'] == 'Chargers' ? 'selected' : '' }}>Chargers</option>
                                                    <option value="Volume" {{ isset($maintenance['unit']) && $maintenance['unit'] == 'Volume' ? 'selected' : '' }}>Volume</option>
                                                    <option value="Transactions Count" {{ isset($maintenance['unit']) && $maintenance['unit'] == 'Transactions Count' ? 'selected' : '' }}>Transactions Count</option>
                                                    <option value="Other" {{ isset($maintenance['unit']) && $maintenance['unit'] == 'Other' ? 'selected' : '' }}>Other</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="product_opportunity_value_hardware_maintenance_{{ $index }}" name="product_opportunity_value_hardware_maintenance[]" placeholder="Product Opportunity Value" onkeyup="formatCurrency(this)" value="{{ $maintenance['opportunity_value'] ?? '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @else
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
                                    @endif

                                    <div class="col-12 plus-btn">
                                        <i class="fas fa-plus clone-btn"></i>
                                    </div>
                                </div>


                                <div id="software-recurring-fields" class="additional-product-category card">
                                    <h5>Software – Recurring</h5>

                                    @if($software_recurring)
                                    @foreach($software_recurring as $index => $software)
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="product_title_software_recurring_{{ $index }}" name="product_title_software_recurring[]" placeholder="Product Title" value="{{ $software['title'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="product_price_software_recurring_{{ $index }}" name="product_price_software_recurring[]" placeholder="Product Price" onkeyup="formatCurrency(this)" value="{{ $software['price'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="product_quantity_software_recurring_{{ $index }}" name="product_quantity_software_recurring[]" placeholder="Product Quantity" value="{{ $software['quantity'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <select name="unit_software_recurring[]" id="unit_software_recurring_{{ $index }}" class="form-control" onchange="onUnitChange(this, 'software_recurring')">
                                                    <option value="" selected disabled>Select Unit</option>
                                                    <option value="Spaces" {{ isset($software['unit']) && $software['unit'] == 'Spaces' ? 'selected' : '' }}>Spaces</option>
                                                    <option value="Locations" {{ isset($software['unit']) && $software['unit'] == 'Locations' ? 'selected' : '' }}>Locations</option>
                                                    <option value="Count / Quantity" {{ isset($software['unit']) && $software['unit'] == 'Count / Quantity' ? 'selected' : '' }}>Count / Quantity</option>
                                                    <option value="Vehicles" {{ isset($software['unit']) && $software['unit'] == 'Vehicles' ? 'selected' : '' }}>Vehicles</option>
                                                    <option value="Sites" {{ isset($software['unit']) && $software['unit'] == 'Sites' ? 'selected' : '' }}>Sites</option>
                                                    <option value="Chargers" {{ isset($software['unit']) && $software['unit'] == 'Chargers' ? 'selected' : '' }}>Chargers</option>
                                                    <option value="Volume" {{ isset($software['unit']) && $software['unit'] == 'Volume' ? 'selected' : '' }}>Volume</option>
                                                    <option value="Transactions Count" {{ isset($software['unit']) && $software['unit'] == 'Transactions Count' ? 'selected' : '' }}>Transactions Count</option>
                                                    <option value="Other" {{ isset($software['unit']) && $software['unit'] == 'Other' ? 'selected' : '' }}>Other</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="product_opportunity_value_software_recurring_{{ $index }}" name="product_opportunity_value_software_recurring[]" placeholder="Product Opportunity Value" onkeyup="formatCurrency(this)" value="{{ $software['opportunity_value'] ?? '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @else
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
                                    @endif

                                    <div class="col-12 plus-btn">
                                        <i class="fas fa-plus clone-btn"></i>
                                    </div>
                                </div>


                                <div id="software-one-time-fields" class="additional-product-category card">
                                    <h5>Software – One Time</h5>

                                    @if($software_one_time)
                                    @foreach($software_one_time as $index => $software)
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="product_title_software_one_time_{{ $index }}" name="product_title_software_one_time[]" placeholder="Product Title" value="{{ $software['title'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="product_price_software_one_time_{{ $index }}" name="product_price_software_one_time[]" placeholder="Product Price" onkeyup="formatCurrency(this)" value="{{ $software['price'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="product_quantity_software_one_time_{{ $index }}" name="product_quantity_software_one_time[]" placeholder="Product Quantity" value="{{ $software['quantity'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <select name="unit_software_one_time[]" id="unit_software_one_time_{{ $index }}" class="form-control" onchange="onUnitChange(this, 'software_one_time')">
                                                    <option value="" selected disabled>Select Unit</option>
                                                    <option value="Spaces" {{ isset($software['unit']) && $software['unit'] == 'Spaces' ? 'selected' : '' }}>Spaces</option>
                                                    <option value="Locations" {{ isset($software['unit']) && $software['unit'] == 'Locations' ? 'selected' : '' }}>Locations</option>
                                                    <option value="Count / Quantity" {{ isset($software['unit']) && $software['unit'] == 'Count / Quantity' ? 'selected' : '' }}>Count / Quantity</option>
                                                    <option value="Vehicles" {{ isset($software['unit']) && $software['unit'] == 'Vehicles' ? 'selected' : '' }}>Vehicles</option>
                                                    <option value="Sites" {{ isset($software['unit']) && $software['unit'] == 'Sites' ? 'selected' : '' }}>Sites</option>
                                                    <option value="Chargers" {{ isset($software['unit']) && $software['unit'] == 'Chargers' ? 'selected' : '' }}>Chargers</option>
                                                    <option value="Volume" {{ isset($software['unit']) && $software['unit'] == 'Volume' ? 'selected' : '' }}>Volume</option>
                                                    <option value="Transactions Count" {{ isset($software['unit']) && $software['unit'] == 'Transactions Count' ? 'selected' : '' }}>Transactions Count</option>
                                                    <option value="Other" {{ isset($software['unit']) && $software['unit'] == 'Other' ? 'selected' : '' }}>Other</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="product_opportunity_value_software_one_time_{{ $index }}" name="product_opportunity_value_software_one_time[]" placeholder="Product Opportunity Value" onkeyup="formatCurrency(this)" value="{{ $software['opportunity_value'] ?? '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @else
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
                                    @endif

                                    <div class="col-12 plus-btn">
                                        <i class="fas fa-plus clone-btn"></i>
                                    </div>
                                </div>


                                <div id="systems-integrations-fields" class="additional-product-category card">
                                    <h5>Systems Integrations</h5>

                                    @if($systems_integrations)
                                    @foreach($systems_integrations as $index => $integration)
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="product_title_systems_integrations_{{ $index }}" name="product_title_systems_integrations[]" placeholder="Product Title" value="{{ $integration['title'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="product_price_systems_integrations_{{ $index }}" name="product_price_systems_integrations[]" placeholder="Product Price" onkeyup="formatCurrency(this)" value="{{ $integration['price'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="product_quantity_systems_integrations_{{ $index }}" name="product_quantity_systems_integrations[]" placeholder="Product Quantity" value="{{ $integration['quantity'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <select name="unit_systems_integrations[]" id="unit_systems_integrations_{{ $index }}" class="form-control" onchange="onUnitChange(this, 'systems_integrations')">
                                                    <option value="" selected disabled>Select Unit</option>
                                                    <option value="Spaces" {{ isset($integration['unit']) && $integration['unit'] == 'Spaces' ? 'selected' : '' }}>Spaces</option>
                                                    <option value="Locations" {{ isset($integration['unit']) && $integration['unit'] == 'Locations' ? 'selected' : '' }}>Locations</option>
                                                    <option value="Count / Quantity" {{ isset($integration['unit']) && $integration['unit'] == 'Count / Quantity' ? 'selected' : '' }}>Count / Quantity</option>
                                                    <option value="Vehicles" {{ isset($integration['unit']) && $integration['unit'] == 'Vehicles' ? 'selected' : '' }}>Vehicles</option>
                                                    <option value="Sites" {{ isset($integration['unit']) && $integration['unit'] == 'Sites' ? 'selected' : '' }}>Sites</option>
                                                    <option value="Chargers" {{ isset($integration['unit']) && $integration['unit'] == 'Chargers' ? 'selected' : '' }}>Chargers</option>
                                                    <option value="Volume" {{ isset($integration['unit']) && $integration['unit'] == 'Volume' ? 'selected' : '' }}>Volume</option>
                                                    <option value="Transactions Count" {{ isset($integration['unit']) && $integration['unit'] == 'Transactions Count' ? 'selected' : '' }}>Transactions Count</option>
                                                    <option value="Other" {{ isset($integration['unit']) && $integration['unit'] == 'Other' ? 'selected' : '' }}>Other</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="product_opportunity_value_systems_integrations_{{ $index }}" name="product_opportunity_value_systems_integrations[]" placeholder="Product Opportunity Value" onkeyup="formatCurrency(this)" value="{{ $integration['opportunity_value'] ?? '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @else
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
                                    @endif

                                    <div class="col-12 plus-btn">
                                        <i class="fas fa-plus clone-btn"></i>
                                    </div>
                                </div>


                                <div id="subscriptions-fields" class="additional-product-category card">
                                    <h5>Subscriptions</h5>

                                    @if($subscriptions)
                                    @foreach($subscriptions as $index => $subscription)
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="product_title_subscriptions_{{ $index }}" name="product_title_subscriptions[]" placeholder="Product Title" value="{{ $subscription['title'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="product_price_subscriptions_{{ $index }}" name="product_price_subscriptions[]" placeholder="Product Price" onkeyup="formatCurrency(this)" value="{{ $subscription['price'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="product_quantity_subscriptions_{{ $index }}" name="product_quantity_subscriptions[]" placeholder="Product Quantity" value="{{ $subscription['quantity'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <select name="unit_subscriptions[]" id="unit_subscriptions_{{ $index }}" class="form-control" onchange="onUnitChange(this, 'subscriptions')">
                                                    <option value="" selected disabled>Select Unit</option>
                                                    <option value="Spaces" {{ isset($subscription['unit']) && $subscription['unit'] == 'Spaces' ? 'selected' : '' }}>Spaces</option>
                                                    <option value="Locations" {{ isset($subscription['unit']) && $subscription['unit'] == 'Locations' ? 'selected' : '' }}>Locations</option>
                                                    <option value="Count / Quantity" {{ isset($subscription['unit']) && $subscription['unit'] == 'Count / Quantity' ? 'selected' : '' }}>Count / Quantity</option>
                                                    <option value="Vehicles" {{ isset($subscription['unit']) && $subscription['unit'] == 'Vehicles' ? 'selected' : '' }}>Vehicles</option>
                                                    <option value="Sites" {{ isset($subscription['unit']) && $subscription['unit'] == 'Sites' ? 'selected' : '' }}>Sites</option>
                                                    <option value="Chargers" {{ isset($subscription['unit']) && $subscription['unit'] == 'Chargers' ? 'selected' : '' }}>Chargers</option>
                                                    <option value="Volume" {{ isset($subscription['unit']) && $subscription['unit'] == 'Volume' ? 'selected' : '' }}>Volume</option>
                                                    <option value="Transactions Count" {{ isset($subscription['unit']) && $subscription['unit'] == 'Transactions Count' ? 'selected' : '' }}>Transactions Count</option>
                                                    <option value="Other" {{ isset($subscription['unit']) && $subscription['unit'] == 'Other' ? 'selected' : '' }}>Other</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="product_opportunity_value_subscriptions_{{ $index }}" name="product_opportunity_value_subscriptions[]" placeholder="Product Opportunity Value" onkeyup="formatCurrency(this)" value="{{ $subscription['opportunity_value'] ?? '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @else
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
                                    @endif

                                    <div class="col-12 plus-btn">
                                        <i class="fas fa-plus clone-btn"></i>
                                    </div>
                                </div>


                                <div id="tech-deployment-fields" class="additional-product-category card">
                                    <h5>Tech Deployment – Volume based</h5>

                                    @if($tech_deployment_volume_based)
                                    @foreach($tech_deployment_volume_based as $index => $tech_deployment)
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="product_title_tech_deployment_{{ $index }}" name="product_title_tech_deployment[]" placeholder="Product Title" value="{{ $tech_deployment['title'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="product_price_tech_deployment_{{ $index }}" name="product_price_tech_deployment[]" placeholder="Product Price" onkeyup="formatCurrency(this)" value="{{ $tech_deployment['price'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="product_quantity_tech_deployment_{{ $index }}" name="product_quantity_tech_deployment[]" placeholder="Product Quantity" value="{{ $tech_deployment['quantity'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <select name="unit_tech_deployment[]" id="unit_tech_deployment_{{ $index }}" class="form-control" onchange="onUnitChange(this, 'tech_deployment')">
                                                    <option value="" selected disabled>Select Unit</option>
                                                    <option value="Spaces" {{ isset($tech_deployment['unit']) && $tech_deployment['unit'] == 'Spaces' ? 'selected' : '' }}>Spaces</option>
                                                    <option value="Locations" {{ isset($tech_deployment['unit']) && $tech_deployment['unit'] == 'Locations' ? 'selected' : '' }}>Locations</option>
                                                    <option value="Count / Quantity" {{ isset($tech_deployment['unit']) && $tech_deployment['unit'] == 'Count / Quantity' ? 'selected' : '' }}>Count / Quantity</option>
                                                    <option value="Vehicles" {{ isset($tech_deployment['unit']) && $tech_deployment['unit'] == 'Vehicles' ? 'selected' : '' }}>Vehicles</option>
                                                    <option value="Sites" {{ isset($tech_deployment['unit']) && $tech_deployment['unit'] == 'Sites' ? 'selected' : '' }}>Sites</option>
                                                    <option value="Chargers" {{ isset($tech_deployment['unit']) && $tech_deployment['unit'] == 'Chargers' ? 'selected' : '' }}>Chargers</option>
                                                    <option value="Volume" {{ isset($tech_deployment['unit']) && $tech_deployment['unit'] == 'Volume' ? 'selected' : '' }}>Volume</option>
                                                    <option value="Transactions Count" {{ isset($tech_deployment['unit']) && $tech_deployment['unit'] == 'Transactions Count' ? 'selected' : '' }}>Transactions Count</option>
                                                    <option value="Other" {{ isset($tech_deployment['unit']) && $tech_deployment['unit'] == 'Other' ? 'selected' : '' }}>Other</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="product_opportunity_value_tech_deployment_{{ $index }}" name="product_opportunity_value_tech_deployment[]" placeholder="Product Opportunity Value" onkeyup="formatCurrency(this)" value="{{ $tech_deployment['opportunity_value'] ?? '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @else
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
                                    @endif

                                    <div class="col-12 plus-btn">
                                        <i class="fas fa-plus clone-btn"></i>
                                    </div>
                                </div>

                                <!-- <div class="col-6 need_full">
                                    <div class="form-group">
                                        {{Form::label('Assign Staff',__('Assign Staff'),['class'=>'form-label']) }}
                                        <select class="form-control" name='user'>
                                            <option value="">Select Staff</option>
                                            @foreach($users as $user)
                                            <option class="form-control" value="{{$user->id}}" {{ $user->id == $lead->assigned_user ? 'selected' : '' }}>
                                                {{$user->name}} - {{$user->type}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> -->

                                <!-- <div class="col-6 need_full">
                                    <div class="form-group">
                                        {{ Form::label('status', __('Status'), ['class' => 'form-label']) }}
                                        <div class="checkbox-group">
                                            <input type="checkbox" id="approveCheckbox" name="status" value="Approve" {{ $lead->status == 2 ? 'checked' : '' }}>
                                            <label for="approveCheckbox">Approve</label>

                                            <input type="checkbox" id="resendCheckbox" name="status" value="Resend" {{ $lead->status == 0 ? 'checked' : '' }}>
                                            <label for="resendCheckbox">Resend</label>

                                            <input type="checkbox" id="withdrawCheckbox" name="status" value="Withdraw" {{ $lead->status == 3 ? 'checked' : '' }}>
                                            <label for="withdrawCheckbox">Withdraw</label>
                                        </div>
                                    </div>
                                </div> -->

                                <div class="col-6 need_full">
                                    <div class="form-group">
                                        {{ Form::label('name', __('Active'), ['class' => 'form-label']) }}
                                        <div>
                                            <input type="checkbox" class="form-check-input" name="is_active" {{ $lead->lead_status == 1 ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-end">
                                    {{ Form::submit(__('Submit'), ['class' => 'btn-submit btn btn-primary']) }}
                                </div>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@push('script-page')
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
                url: "{{ route('task.getparent') }}",
                type: 'POST',
                data: {
                    "parent": bid,
                    "_token": "{{ csrf_token() }}",
                },
                success: function(data) {
                    console.log(data);
                    $('#parent_id').empty();
                    {{-- $('#parent_id').append('<option value="">{{__("Select Parent")}}</option>'); --}}

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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var valueInput = document.getElementById('value_of_opportunity');

        valueInput.addEventListener('keyup', function(e) {
            var value = e.target.value.replace(/,/g, '');
            if (!isNaN(value) && value.length > 0) {
                e.target.value = numberWithCommas(value);
            } else {
                e.target.value = '';
            }
        });

        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
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
@endpush