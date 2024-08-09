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

$settings = Utility::settings();
$productTypes = explode(',', $settings['product_type']);
$categoryTypes = explode(',', $settings['category_type']);
$subcategoryTypes = explode(',', $settings['subcategory_type']);
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

    /* .additional-product-category {
        display: none;
        margin-top: 10px;
    } */

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
                                            <span class="text-sm">
                                                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                            </span>
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
                                            <span class="text-sm">
                                                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                            </span>
                                            {{Form::text('primary_address',$lead->primary_address,array('class'=>'form-control','placeholder'=>__('Enter Address')))}}
                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            {{Form::label('primary_organization',__('Title/Designation'),['class'=>'form-label']) }}
                                            <span class="text-sm">
                                                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                            </span>
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
                                            <span class="text-sm">
                                                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                            </span>
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
                                                @foreach ($categoryTypes as $category)
                                                <option value="{{ $category }}" {{ $lead->category == $category ? 'selected' : '' }}>{{ $category }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            <label for="sales_subcategory">Sales Subcategory</label>
                                            <select name="sales_subcategory" id="sales_subcategory" class="form-control">
                                                <option value="" disabled {{ is_null($lead->sales_subcategory) ? 'selected' : '' }}>Select Sales Subcategory</option>
                                                @foreach ($subcategoryTypes as $subcategory)
                                                <option value="{{ $subcategory }}" {{ $lead->sales_subcategory == $subcategory ? 'selected' : '' }}>{{ $subcategory }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            {{Form::label('competitor',__('Competitor'),['class'=>'form-label']) }}
                                            {{Form::text('competitor',$lead->competitor,array('class'=>'form-control','placeholder'=>__('Enter Competitor')))}}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12  p-0 modaltitle pb-3 mt-3">
                                    <h5 style="margin-left: 14px;">{{ __('Products') }}</h5>
                                </div>
                                <div class="col-6 need_full">
                                    <div class="form-group">
                                        @foreach ($productTypes as $type)
                                        @php
                                        $cleanedType = trim(preg_replace('/\s+/', ' ', str_replace('-', ' ', $type)));
                                        $id = strtolower(str_replace(' ', '-', $cleanedType));
                                        $isChecked = !is_null($lead->products) && in_array($type, $lead->products) ? 'checked' : '';
                                        @endphp
                                        <input type="checkbox" id="{{ $id }}" name="products[]" value="{{ $type }}" {{ $isChecked }} onchange="showAdditionalProductCategoryFields(this)">
                                        <label for="{{ $id }}">{{ $type }}</label><br>
                                        @endforeach
                                    </div>
                                </div>
                                <div id="additional-fields-container"></div>

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
                                    {{Form::submit(__('Submit'),array('class'=>'btn btn-primary', 'id'=>'submit-button'))}}
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
        $("input[type='text'][name='lead_name'],input[type='text'][name='name'], input[type='text'][name='email'], select[name='type'],input[type='tel'][name='primary_contact']")
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
        const products = @json($lead->products);
        const productDetails = @json($lead->product_details);

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
                    additionalFields += `
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
        const container = $(button).closest('.additional-product-category');
        const lastRow = container.find('.row').last();
        const clonedRow = lastRow.clone();

        // Clear the values of the cloned row's inputs and selects
        clonedRow.find('input').val('');
        clonedRow.find('select').val('');

        // Remove any existing remove button from the cloned row
        clonedRow.find('.minus-btn').remove();

        // Append the remove button to the cloned row
        clonedRow.append('<div class="minus-btn"><i class="fas fa-minus remove-btn" onclick="removeRow(this)"></i></div>');

        // Append the cloned row after the last row
        lastRow.after(clonedRow);
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

        // console.log('formData:', formData); // Debug log

        $('<input>').attr({
            type: 'hidden',
            name: 'formData',
            value: JSON.stringify(formData)
        }).appendTo('#formdata');

        $('#formdata').submit();
    });
</script>
@endpush