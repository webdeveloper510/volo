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
                                                <th scope="col" class="sort" data-sort="company_name">{{__('Client Name')}} <span class="opticy"> </span></th>
                                                <th scope="col" class="sort" data-sort="primary_name">{{__('Primary Contact')}} <span class="opticy"> </span></th>
                                                <th scope="col" class="sort" data-sort="primary_email">{{__('Email')}} <span class="opticy"> </span></th>
                                                <th scope="col" class="sort">{{__('Phone Number')}} <span class="opticy"> </span></th>
                                                <th scope="col" class="sort">{{__('Region')}} <span class="opticy"> </span></th>
                                                <th scope="col" class="sort">{{__('Title/Designation')}} <span class="opticy"> </span></th>
                                                <th scope="col" class="sort">{{__('Entity Name')}} <span class="opticy"> </span></th>
                                                <th scope="col" class="sort">{{__('Category')}} <span class="opticy"> </span></th>
                                                <th scope="col" class="text-center">{{__('Action')}} <span class="opticy"></span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($importedcustomers as $customers)
                                            <tr>
                                                <td>
                                                    <a href="{{route('customer.info',urlencode(encrypt($customers->id)))}}" title="{{ __('Client Details') }}" class="action-item text-primary" style="color:#1551c9 !important;">
                                                        {{ucfirst($customers->company_name)}}
                                                    </a>
                                                </td>
                                                <td>
                                                    {{ucfirst($customers->primary_name)}}
                                                </td>
                                                <td>{{ucfirst($customers->primary_email)}}</td>
                                                <td>{{ucfirst($customers->primary_phone_number)}}</td>
                                                <td>{{ucfirst($customers->primary_address)}}</td>
                                                <td>{{ucfirst($customers->primary_organization)}}</td>
                                                <td>{{ucfirst($customers->entity_name)}}</td>
                                                <td>{{ucfirst($customers->category_type)}}</td>
                                                <td class="text-end">
                                                    <div class="action-btn bg-info ms-2">
                                                        <a href="{{ route('client.edit', $customers->id) }}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white" data-bs-toggle="tooltip" title="{{__('Edit')}}" data-title="{{__('Edit Client')}}">
                                                            <i class="ti ti-edit"></i>
                                                        </a>
                                                    </div>
                                                    <div class="action-btn bg-danger ms-2">
                                                        <a href="javascript:void(0);" class="mx-3 btn btn-sm align-items-center text-white show_client_confirm" data-url="{{ route('client.destroy', $customers->id) }}" data-token="{{ csrf_token() }}" data-bs-toggle="tooltip" title="Delete">
                                                            <i class="ti ti-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>
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
@push('script-page')
<script>
    $(document).ready(function() {
        $(document).on("click", ".show_client_confirm", function(event) {
            event.preventDefault();

            var parentTR = $(this).closest("tr");
            var url = $(this).data("url");
            var token = $(this).data("token");

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-danger",
                },
                buttonsStyling: false,
            });

            swalWithBootstrapButtons
                .fire({
                    title: "Are you sure?",
                    text: "This action cannot be undone. Do you want to continue?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    reverseButtons: true,
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: url,
                            data: {
                                _token: token,
                            },
                            success: function(result) {
                                if (result.success) {
                                    Swal.fire("Done!", result.msg, "success");
                                    parentTR.remove();
                                } else {
                                    Swal.fire("Error!", result.msg, "error");
                                }
                            },
                            error: function(xhr, status, error) {
                                Swal.fire("Error!", "An error occurred: " + xhr.responseText, "error");
                            }
                        });
                    }
                });
        });
    });
</script>
@endpush