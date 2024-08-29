@php
$settings = App\Models\Utility::settings();
$campaign_type = explode(',',$settings['campaign_type']);
$regions = explode(',', $settings['region']);
@endphp

@extends('layouts.admin')
@section('page-title')
{{ __('Client Edit') }}
@endsection
@section('title')
<div class="page-header-title">
    {{ __('Edit Client') }} {{ '(' . $client->company_name . ')' }}
</div>
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
<li class="breadcrumb-item"><a href="{{ route('siteusers') }}">{{ __('Clients') }}</a></li>
<li class="breadcrumb-item">{{ __('Details') }}</li>
@endsection
@section('content')
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
                        <div class="tab-content">
                            <div class="tab-pane fade in active show mt-5">
                                {{ Form::open(['route' => ['client.update', $client->id], 'method' => 'post']) }}
                                <div class="row">
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            {{Form::label('company_name',__('Company Name'),['class'=>'form-label']) }}
                                            <span class="text-sm">
                                                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                            </span>
                                            {{Form::text('company_name', $client->company_name, array('class'=>'form-control','placeholder'=>__('Enter Company Name'),'required'=>'required'))}}
                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            {{Form::label('entity_name',__('Legal Entity Name'),['class'=>'form-label']) }}
                                            <span class="text-sm">
                                                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                            </span>
                                            {{Form::text('entity_name', $client->entity_name, array('class'=>'form-control','placeholder'=>__('Enter Legal Entity Name'),'required'=>'required'))}}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12  p-0 modaltitle pb-3 mb-3 mt-4">
                                    <h5 style="margin-left: 14px;">{{ __('Primary Contact Information') }}</h5>
                                </div>
                                <div class="row">
                                    <div class="col-6 need_full">
                                        <input type="hidden" name="customerType" value="addForm" />
                                        <div class="form-group">
                                            {{Form::label('primary_name',__('Name'),['class'=>'form-label']) }}
                                            <span class="text-sm">
                                                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                            </span>
                                            {{Form::text('primary_name', $client->primary_name, array('class'=>'form-control','placeholder'=>__('Enter Name'),'required'=>'required'))}}
                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group ">
                                            {{Form::label('primary_phone_number',__('Phone Number'),['class'=>'form-label']) }}
                                            <span class="text-sm">
                                                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                            </span>
                                            <div class="intl-tel-input">
                                                <input type="tel" id="phone-input" name="primary_phone_number" class="phone-input form-control" value="{{ $client->primary_phone_number }}" placeholder="Enter Phone Number" maxlength="16">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            {{Form::label('primary_email',__('Email'),['class'=>'form-label']) }}
                                            <span class="text-sm">
                                                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                            </span>
                                            {{Form::text('primary_email', $client->primary_email, array('class'=>'form-control','placeholder'=>__('Enter Email'),'required'=>'required'))}}
                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            {{Form::label('primary_address',__('Address'),['class'=>'form-label']) }}

                                            {{Form::text('primary_address', $client->primary_address, array('class'=>'form-control','placeholder'=>__('Enter Address')))}}
                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            {{Form::label('primary_organization',__('Title/Designation'),['class'=>'form-label']) }}
                                            {{Form::text('primary_organization', $client->primary_organization, array('class'=>'form-control','placeholder'=>__('Enter Designation')))}}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12  p-0 modaltitle pb-3 mb-3 mt-4">
                                    <h5 style="margin-left: 14px;">{{ __('Secondary Contact Information') }}</h5>
                                </div>
                                <div class="row">
                                    <div class="col-6 need_full">
                                        <input type="hidden" name="customerType" value="addForm" />
                                        <div class="form-group">
                                            {{Form::label('secondary_name',__('Name'),['class'=>'form-label']) }}
                                            {{Form::text('secondary_name', $client->secondary_name, array('class'=>'form-control','placeholder'=>__('Enter Name')))}}
                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group ">
                                            {{Form::label('secondary_phone_number',__('Phone Number'),['class'=>'form-label']) }}
                                            <div class="intl-tel-input">
                                                <input type="tel" id="phone-input1" name="secondary_phone_number" class="phone-input form-control" value="{{ $client->secondary_phone_number }}" placeholder="Enter Phone Number" maxlength="16">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            {{Form::label('secondary_email',__('Email'),['class'=>'form-label']) }}
                                            {{Form::text('secondary_email', $client->secondary_email, array('class'=>'form-control','placeholder'=>__('Enter Email')))}}
                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            {{Form::label('secondary_address',__('Address'),['class'=>'form-label']) }}
                                            {{Form::text('secondary_address', $client->secondary_address, array('class'=>'form-control','placeholder'=>__('Enter Address')))}}
                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            {{Form::label('secondary_designation',__('Title/Designation'),['class'=>'form-label']) }}
                                            {{Form::text('secondary_designation', $client->secondary_designation, array('class'=>'form-control','placeholder'=>__('Enter Designation')))}}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12  p-0 modaltitle pb-3 mb-3 mt-4">
                                    <h5 style="margin-left: 14px;">{{ __('Other Information') }}</h5>
                                </div>
                                <div class="row">
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            <label for="location">Location / Geography</label>
                                            <select name="location" id="location" class="form-control">
                                                <option value="" disabled>Select Location / Geography</option>
                                                <option value="Asia" {{ $client->location == 'Asia' ? 'selected' : '' }}>Asia</option>
                                                <option value="Africa" {{ $client->location == 'Africa' ? 'selected' : '' }}>Africa</option>
                                                <option value="Europe" {{ $client->location == 'Europe' ? 'selected' : '' }}>Europe</option>
                                                <option value="North America" {{ $client->location == 'North America' ? 'selected' : '' }}>North America</option>
                                                <option value="South America" {{ $client->location == 'South America' ? 'selected' : '' }}>South America</option>
                                                <option value="Australia" {{ $client->location == 'Australia' ? 'selected' : '' }}>Australia</option>
                                                <option value="Global" {{ $client->location == 'Global' ? 'selected' : '' }}>Global</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            <label for="region">Region</label>
                                            <select name="region" id="region" class="form-control">
                                                <option value="" selected disabled>Select Region</option>
                                                @foreach($regions as $region)
                                                <option value="{{ $region }}" {{ $client->region == $region ? 'selected' : '' }}>{{ $region }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group" id="other_region_input">
                                        <label for="other-region">Add Other Region</label>
                                        <input type="text" name="other_region" id="other_region" class="form-control" value="{{ $client->other_region }}" placeholder="Enter Other Region" style="display: none;">
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            <label for="industry">Industries</label>
                                            <select name="industry[]" id="industry" class="form-control" multiple>
                                                <option value="" disabled>Select Industries</option>
                                                @php
                                                // Decode the JSON string into a PHP array
                                                $selectedIndustries = json_decode($client->industry, true) ?? [];
                                                @endphp
                                                <option value="Automobiles and Components" {{ in_array('Automobiles and Components', $selectedIndustries) ? 'selected' : '' }}>Automobiles and Components</option>
                                                <option value="Banks" {{ in_array('Banks', $selectedIndustries) ? 'selected' : '' }}>Banks</option>
                                                <option value="Hubs" {{ in_array('Hubs', $selectedIndustries) ? 'selected' : '' }}>Hubs</option>
                                                <option value="Capital Goods" {{ in_array('Capital Goods', $selectedIndustries) ? 'selected' : '' }}>Capital Goods</option>
                                                <option value="Commercial and Professional Services" {{ in_array('Commercial and Professional Services', $selectedIndustries) ? 'selected' : '' }}>Commercial and Professional Services</option>
                                                <option value="Consumer Durables and Apparel" {{ in_array('Consumer Durables and Apparel', $selectedIndustries) ? 'selected' : '' }}>Consumer Durables and Apparel</option>
                                                <option value="Consumer Services" {{ in_array('Consumer Services', $selectedIndustries) ? 'selected' : '' }}>Consumer Services</option>
                                                <option value="Diversified Financials" {{ in_array('Diversified Financials', $selectedIndustries) ? 'selected' : '' }}>Diversified Financials</option>
                                                <option value="Energy" {{ in_array('Energy', $selectedIndustries) ? 'selected' : '' }}>Energy</option>
                                                <option value="Food, Beverage, and Tobacco" {{ in_array('Food, Beverage, and Tobacco', $selectedIndustries) ? 'selected' : '' }}>Food, Beverage, and Tobacco</option>
                                                <option value="Food and Staples Retailing" {{ in_array('Food and Staples Retailing', $selectedIndustries) ? 'selected' : '' }}>Food and Staples Retailing</option>
                                                <option value="Health Care Equipment and Services" {{ in_array('Health Care Equipment and Services', $selectedIndustries) ? 'selected' : '' }}>Health Care Equipment and Services</option>
                                                <option value="Household and Personal Products" {{ in_array('Household and Personal Products', $selectedIndustries) ? 'selected' : '' }}>Household and Personal Products</option>
                                                <option value="Insurance" {{ in_array('Insurance', $selectedIndustries) ? 'selected' : '' }}>Insurance</option>
                                                <option value="Materials" {{ in_array('Materials', $selectedIndustries) ? 'selected' : '' }}>Materials</option>
                                                <option value="Media and Entertainment" {{ in_array('Media and Entertainment', $selectedIndustries) ? 'selected' : '' }}>Media and Entertainment</option>
                                                <option value="Pharmaceuticals, Biotechnology, and Life Sciences" {{ in_array('Pharmaceuticals, Biotechnology, and Life Sciences', $selectedIndustries) ? 'selected' : '' }}>Pharmaceuticals, Biotechnology, and Life Sciences</option>
                                                <option value="Real Estate" {{ in_array('Real Estate', $selectedIndustries) ? 'selected' : '' }}>Real Estate</option>
                                                <option value="Retailing" {{ in_array('Retailing', $selectedIndustries) ? 'selected' : '' }}>Retailing</option>
                                                <option value="Semiconductors and Semiconductor Equipment" {{ in_array('Semiconductors and Semiconductor Equipment', $selectedIndustries) ? 'selected' : '' }}>Semiconductors and Semiconductor Equipment</option>
                                                <option value="Software and Services" {{ in_array('Software and Services', $selectedIndustries) ? 'selected' : '' }}>Software and Services</option>
                                                <option value="Technology Hardware and Equipment" {{ in_array('Technology Hardware and Equipment', $selectedIndustries) ? 'selected' : '' }}>Technology Hardware and Equipment</option>
                                                <option value="Telecommunication Services" {{ in_array('Telecommunication Services', $selectedIndustries) ? 'selected' : '' }}>Telecommunication Services</option>
                                                <option value="Transportation" {{ in_array('Transportation', $selectedIndustries) ? 'selected' : '' }}>Transportation</option>
                                                <option value="Utilities" {{ in_array('Utilities', $selectedIndustries) ? 'selected' : '' }}>Utilities</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            <label for="engagement_level">Engagement Level</label>
                                            <select name="engagement_level" id="engagement_level" class="form-control">
                                                <option value="" disabled {{ $client->engagement_level ? '' : 'selected' }}>Select Engagement Level</option>
                                                <option value="CEO" {{ $client->engagement_level === 'CEO' ? 'selected' : '' }}>CEO</option>
                                                <option value="COO" {{ $client->engagement_level === 'COO' ? 'selected' : '' }}>COO</option>
                                                <option value="Executive Director" {{ $client->engagement_level === 'Executive Director' ? 'selected' : '' }}>Executive Director</option>
                                                <option value="Chief Fleet Officer / Fleet Operations Director" {{ $client->engagement_level === 'Chief Fleet Officer / Fleet Operations Director' ? 'selected' : '' }}>Chief Fleet Officer / Fleet Operations Director</option>
                                                <option value="Head of Innovation / Data Science" {{ $client->engagement_level === 'Head of Innovation / Data Science' ? 'selected' : '' }}>Head of Innovation / Data Science</option>
                                                <option value="Vice President" {{ $client->engagement_level === 'Vice President' ? 'selected' : '' }}>Vice President</option>
                                                <option value="Director of Safety & Regulations" {{ $client->engagement_level === 'Director of Safety & Regulations' ? 'selected' : '' }}>Director of Safety & Regulations</option>
                                                <option value="Director of Logistics" {{ $client->engagement_level === 'Director of Logistics' ? 'selected' : '' }}>Director of Logistics</option>
                                                <option value="Vice President - Operations" {{ $client->engagement_level === 'Vice President - Operations' ? 'selected' : '' }}>Vice President - Operations</option>
                                                <option value="Vice President - Sustainability" {{ $client->engagement_level === 'Vice President - Sustainability' ? 'selected' : '' }}>Vice President - Sustainability</option>
                                                <option value="Vice President - Environmental Services" {{ $client->engagement_level === 'Vice President - Environmental Services' ? 'selected' : '' }}>Vice President - Environmental Services</option>
                                                <option value="Vice President - Fleet Operations" {{ $client->engagement_level === 'Vice President - Fleet Operations' ? 'selected' : '' }}>Vice President - Fleet Operations</option>
                                                <option value="Director of Global Safety Solutions" {{ $client->engagement_level === 'Director of Global Safety Solutions' ? 'selected' : '' }}>Director of Global Safety Solutions</option>
                                                <option value="Vice President - Procurement" {{ $client->engagement_level === 'Vice President - Procurement' ? 'selected' : '' }}>Vice President - Procurement</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            <label for="category_type">Category</label>
                                            <select name="category_type" id="category" class="form-control">
                                                <option value="" disabled {{ !$client->category_type ? 'selected' : '' }}>Select Category</option>
                                                @foreach($categories as $category)
                                                <option value="{{ $category->name }}" {{ $client->category_type === $category->name ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            <label for="revenue_booked_to_date">Revenue booked to date</label>
                                            <input type="text" name="revenue_booked_to_date" value="{{ $client->revenue_booked_to_date ?? '' }}" placeholder="Enter Revenue booked to date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            <label for="referred_by">Referred by / Connection</label>
                                            <input type="text" name="referred_by" value="{{ $client->referred_by ?? '' }}" placeholder="Enter Referred by / Connection" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="pain_points">Pain Points</label>
                                            <textarea name="pain_points" class="form-control" cols="30" rows="5">{{ $client->pain_points ?? '' }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="notes">Notes</label>
                                            <textarea name="notes" class="form-control" cols="30" rows="5">{{ $client->notes ?? '' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group" style="margin-top: 35px;">
                                        {{Form::label('is_active',__('Active'),['class'=>'form-label']) }}
                                        <input type="checkbox" class="form-check-input" name="is_active" checked>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        {{Form::submit(__('Save'),array('class'=>'btn btn-primary  '))}}
                                    </div>
                                </div>
                                {{Form::close()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script-page')

@endpush