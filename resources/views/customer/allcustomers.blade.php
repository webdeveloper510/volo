@extends('layouts.admin')
@section('page-title')
{{__('Clients')}}
@endsection
@section('title')
<div class="page-header-title">
    {{__('Clients')}}
</div>
@endsection
@section('action-btn')
<a href="#" data-url="{{ route('uploadusersinfo') }}" data-size="lg" data-ajax-popup="true" data-bs-toggle="tooltip" data-title="{{__('New Client')}}" title="{{__('Upload')}}" class="btn btn-sm btn-primary btn-icon m-1" id="updateAnchor">
    <i class="ti ti-plus"></i>
</a>

@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
<li class="breadcrumb-item">{{__('Clients')}}</li>
@endsection
@section('content')

<div class="container-field">
    <div id="wrapper">
        <div id="page-content-wrapper">
            <div class="container-fluid xyz">
                <div class="row">
                    <div class="col-lg-12 p0">
                        <div id="useradd-1" class="card">
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
                                    <table class="table datatable" id="datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="sort">{{__('Company Name')}} <span class="opticy"> </span></th>
                                                <th scope="col" class="sort" data-sort="primary_name">{{__('Primary Contact')}} <span class="opticy"> </span></th>
                                                <th scope="col" class="sort" data-sort="primary_email">{{__('Email')}} <span class="opticy"> </span></th>
                                                <th scope="col" class="sort">{{__('Phone Number')}} <span class="opticy"> </span></th>
                                                <th scope="col" class="sort">{{__('Address')}} <span class="opticy"> </span></th>
                                                <th scope="col" class="sort">{{__('Title/Designation')}} <span class="opticy"> </span></th>

                                                <th scope="col" class="sort">{{__('Entity Name')}} <span class="opticy"> </span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($importedcustomers as $customers)
                                            <tr>
                                                <td>{{ucfirst($customers->company_name)}}</td>
                                                <td>
                                                    <a href="{{route('customer.info',urlencode(encrypt($customers->id)))}}" title="{{ __('Client Details') }}" class="action-item text-primary" style="color:#1551c9 !important;">
                                                        <b> {{ucfirst($customers->primary_name)}}</b>
                                                    </a>
                                                </td>
                                                <td>{{ucfirst($customers->primary_email)}}</td>
                                                <td>{{ucfirst($customers->primary_phone_number)}}</td>
                                                <td>{{ucfirst($customers->primary_address)}}</td>
                                                <td>{{ucfirst($customers->primary_organization)}}</td>
                                                <td>{{ucfirst($customers->entity_name)}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection