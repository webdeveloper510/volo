@php
use Carbon\Carbon;
$currentDate = Carbon::now();
$proposalstatus = \App\Models\Lead::$status;
@endphp
@extends('layouts.admin')
@section('page-title')
{{__('Opportunities')}}
@endsection
@section('title')
<div class="page-header-title">
    {{__('Opportunities')}}
</div>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
<style>
    .post-search-panel {
        width: 173px;
        margin-bottom: 10px;
    }
</style>
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
<li class="breadcrumb-item">{{__('Opportunities')}}</li>

@endsection
@section('action-btn')

@can('Create Lead')
<a href="#" data-url="{{ route('lead.create',['lead',0]) }}" data-size="lg" data-ajax-popup="true" data-bs-toggle="tooltip" data-title="{{__('Create New Opportunity
')}}" title="{{__('Create')}}" class="btn btn-sm btn-primary btn-icon m-1">
    <i class="ti ti-plus"></i>
</a>
@endcan
@endsection
@section('content')
<div class="container-field">

    <div id="wrapper">
        <div id="page-content-wrapper">
            <div class="container-fluid xyz p0">

                <div class="row">
                    <div class="col-lg-12 ">
                        <div id="useradd-1" class="card">
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
                                    <div class="post-search-panel">
                                        <input type="text" class="form-control" id="team_member" placeholder="Team Member">
                                    </div>
                                    <table class="table datatable" id="datatable">
                                        <thead>
                                            <tr>
                                                <!-- <th scope="col" class="sort" data-sort="name">{{__('Lead')}}</th> -->
                                                <th scope="col" class="sort" id="myInput" data-sort="name">{{__('Company')}} <span class="opticy"></span></th>
                                                <th scope="col" class="sort" data-sort="budget">{{__('Opportunity Value')}} <span class="opticy"></span></th>
                                                <th scope="col" class="sort">{{__('Status')}} <span class="opticy"></span></th>
                                                <!-- <th scope="col" class="sort">{{__('Proposal Status')}}</th> -->
                                                <th scope="col" class="sort">{{__('Sales Stage')}}<span class="opticy"></span></th>
                                                <th scope="col" class="sort">{{__('Created On')}}<span class="opticy"></span></th>
                                                <th scope="col" class="sort">{{__('Products/Services')}}<span class="opticy"></span></th>
                                                @if(Gate::check('Show Lead') || Gate::check('Edit Lead') ||
                                                Gate::check('Delete Lead'))
                                                <th scope="col" class="text-center">{{__('Action')}} <span class="opticy"></span></th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($leads as $lead)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('lead.info',urlencode(encrypt($lead->id))) }}" data-size="md" title="{{ __('Opportunities Details') }}" class="action-item text-primary" style="color:#1551c9 !important;">
                                                        <b> {{ ucfirst($lead->opportunity_name) }}</b>
                                                    </a>
                                                </td>
                                                <td>
                                                    <span class="budget">
                                                        @if (!empty($lead->value_of_opportunity))
                                                        @if ($lead->currency == 'GBP')
                                                        £{{ $lead->value_of_opportunity }}
                                                        @elseif ($lead->currency == 'USD')
                                                        ${{ $lead->value_of_opportunity }}
                                                        @elseif ($lead->currency == 'EUR')
                                                        €{{ $lead->value_of_opportunity }}
                                                        @else
                                                        {{ $lead->value_of_opportunity }}
                                                        @endif
                                                        @endif
                                                    </span>
                                                </td>
                                                <td>
                                                    <select name="lead_status" id="lead_status" class="form-select" data-id="{{$lead->id}}">
                                                        @foreach($statuss as $key => $stat)
                                                        <option value="{{ $key }}" {{ isset($lead->lead_status) && $lead->lead_status == $key ? "selected" : "" }}>
                                                            {{ $stat }}
                                                        </option>
                                                        @endforeach
                                                </td>
                                                <td>
                                                    <select name="drop_status" id="drop_status" class="form-select" data-id="{{$lead->id}}">
                                                        @foreach($proposalstatus as $key => $stat)
                                                        <option value="{{ $key }}" {{ isset($lead->status) && $lead->status == $key ? "selected" : "" }}>
                                                            {{ $stat }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>{{\Auth::user()->dateFormat($lead->created_at)}}</td>
                                                <td>
                                                    @php
                                                    $productsArray = json_decode($lead->products);
                                                    @endphp

                                                    @if (is_array($productsArray) && count($productsArray) > 0)
                                                    {{ implode(', ', $productsArray) }}
                                                    @else
                                                    No products found
                                                    @endif
                                                </td>
                                                @if(Gate::check('Show Lead') || Gate::check('Edit Lead') ||
                                                Gate::check('Delete Lead') ||Gate::check('Manage Lead') )
                                                <td class="text-end">
                                                    @if($lead->status == 4)
                                                    <div class="action-btn bg-secondary ms-2">
                                                        <a href="{{ route('meeting.create',['meeting',0])}}" id="convertLink" data-size="md" data-url="#" data-bs-toggle="tooltip" data-title="{{ __('Convert') }}" title="{{ __('Convert To Event') }}" data-id="{{$lead->id}}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                            <i class="fas fa-exchange-alt"></i> </a>
                                                    </div>
                                                    @endif
                                                    {{-- @if($lead->status == 0 ) --}}
                                                    @if($lead->is_nda_signed == 1 && $lead->status == 6 )
                                                    <div class="action-btn bg-primary ms-2">
                                                        <a href="javascript:void(0);" data-size="md" data-url="{{ route('lead.shareproposal',urlencode(encrypt($lead->id))) }}" data-ajax-popup="true" data-bs-toggle="tooltip" data-title="{{ __('MOU') }}" title="{{ __('MOU') }}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                            <i class="ti ti-share"></i>
                                                        </a>
                                                    </div>
                                                    @endif

                                                    <div class="action-btn bg-primary ms-2">
                                                        <a href="javascript:void(0);" data-size="md" data-url="{{ route('lead.sendemail',urlencode(encrypt($lead->id))) }}" data-ajax-popup="true" data-bs-toggle="tooltip" data-title="{{ __('New Message') }}" title="{{ __('Email') }}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                            <i class="ti ti-mail"></i>
                                                        </a>
                                                    </div>
                                                    {{-- @endif --}}

                                                    @if($lead->is_nda_signed == 0)
                                                    <div class="action-btn bg-primary ms-2">
                                                        <a href="javascript:void(0);" data-size="md" data-url="{{ route('lead.sharenda',urlencode(encrypt($lead->id))) }}" data-ajax-popup="true" data-bs-toggle="tooltip" data-title="{{ __('NDA') }}" title="{{ __('Share NDA') }}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                            <i class="ti ti-file"></i>
                                                        </a>
                                                    </div>
                                                    @endif

                                                    @if($lead->status >= 2 )
                                                    <div class="action-btn bg-info ms-2">
                                                        <a href="{{route('lead.review',urlencode(encrypt($lead->id))) }}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white " data-bs-toggle="tooltip" title="{{__('Review')}}" data-title="{{__('Review Opportunities')}}">
                                                            <i class="fas fa-pen"></i></a>
                                                    </div>
                                                    @endif
                                                    <div class="action-btn bg-primary ms-2">
                                                        <a href="{{route('lead.clone',urlencode(encrypt($lead->id)))}}" data-size="md" data-url="#" data-bs-toggle="tooltip" title="{{ __('Clone') }}" data-title="{{ __('Clone') }}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                            <i class="fa fa-clone"></i>
                                                        </a>
                                                    </div>
                                                    @if($lead->status >= 1)
                                                    <div class="action-btn bg-success ms-2">
                                                        <a href="{{route('lead.proposal',urlencode(encrypt($lead->id))) }}" data-bs-toggle="tooltip" data-title="{{__('Proposal')}}" title="{{__('View Proposal')}}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white">
                                                            <i class="ti ti-receipt"></i>
                                                        </a>
                                                    </div>
                                                    @endif
                                                    @can('Show Lead')
                                                    <div class="action-btn bg-warning ms-2">
                                                        <!-- <a href="{{ route('lead.show',$lead->id) }}" title="{{__('Quick View')}}"
                                                            data-ajax-popup="true" data-title="{{__('Lead Details')}}"
                                                            class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                            <i class="ti ti-eye"></i> -->
                                                        <a href="javascript:void(0);" data-size="md" data-url="{{ route('lead.show',$lead->id) }}" data-bs-toggle="tooltip" title="{{__('Quick View')}}" data-ajax-popup="true" data-title="{{__('Opportunities Details')}}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                            <i class="ti ti-eye"></i>
                                                        </a>
                                                    </div>
                                                    @endcan
                                                    @if($lead->status == 0)
                                                    @can('Edit Lead')
                                                    <div class="action-btn bg-info ms-2">
                                                        <a href="{{ route('lead.edit',$lead->id) }}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white " data-bs-toggle="tooltip" title="{{__('Details')}}" data-title="{{__('Edit Opportunitie')}}"><i class="ti ti-edit"></i></a>
                                                    </div>
                                                    @endcan
                                                    @endif
                                                    @can('Delete Lead')
                                                    <div class="action-btn bg-danger ms-2">
                                                        {!! Form::open(['method' => 'DELETE', 'route' =>
                                                        ['lead.destroy', $lead->id]]) !!}
                                                        <a href="javascript:void(0);" class="mx-3 btn btn-sm  align-items-center text-white show_confirm" data-bs-toggle="tooltip" title='Delete'>
                                                            <i class="ti ti-trash"></i>
                                                        </a>
                                                        {!! Form::close() !!}
                                                    </div>
                                                    @endcan
                                                </td>
                                                @endif
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
        $('#convertLink').on('click', function(event) {
            event.preventDefault(); // Prevent the default link behavior

            var leadId = $(this).data('id');

            // Set the lead ID in localStorage after a delay
            setTimeout(function() {
                localStorage.setItem('leadId', leadId);

                // Redirect to the specified URL after setting the item
                window.location.href = "{{ route('meeting.create',['meeting',0])}}";
            }, 1000); // Adjust the delay time as needed (1000 milliseconds = 1 second)
        });
    });
</script>
<script>
    function duplicate(id) {
        var url = "{{route('lead.create',['lead',0])}}";
        $.ajax({
            url: "{{ route('meeting.lead') }}",
            type: 'POST',
            data: {
                "venue": venu,
                "_token": "{{ csrf_token() }}",
            },
            success: function(data) {
                console.log(data);
            }
        });
    }
    $('select[name= "lead"]').on('change', function() {
        $('#breakfast').hide();
        $('#lunch').hide();
        $('#dinner').hide();
        $('#wedding').hide();
        var venu = this.value;
        $.ajax({
            url: "{{ route('meeting.lead') }}",
            type: 'POST',
            data: {
                "venue": venu,
                "_token": "{{ csrf_token() }}",
            },
            success: function(data) {
                console.log(data);
                venue_str = data.venue_selection;
                venue_arr = venue_str.split(",");
                func_str = data.function;
                func_arr = func_str.split(",");
                $('input[name ="company_name"]').val(data.company_name);
                $('input[name ="name"]').val(data.name);
                $('input[name ="phone"]').val(data.phone);
                $('input[name ="relationship"]').val(data.relationship);
                $('input[name ="start_date"]').val(data.start_date);
                // $('input[name ="end_date"]').val(data.end_date);
                $('input[name ="start_time"]').val(data.start_time);
                $('input[name ="end_time"]').val(data.end_time);
                $('input[name ="rooms"]').val(data.rooms);
                $('input[name ="email"]').val(data.email);
                $('input[name ="lead_address"]').val(data.lead_address);
                $("select[name='type'] option[value='" + data.type + "']").prop("selected", true);
                $("input[name='bar'][value='" + data.bar + "']").prop('checked', true);
                // $("select[name='user'] option[value='"+data.assigned_user+"']").prop("selected", true);
                $("input[name='user[]'][value='" + data.assigned_user + "']").prop('checked', true);
                $.each(venue_arr, function(i, val) {
                    $("input[name='venue[]'][value='" + val + "']").prop('checked', true);
                });

                $.each(func_arr, function(i, val) {
                    $("input[name='function[]'][value='" + val + "']").prop('checked', true);
                });

                $('input[name ="guest_count"]').val(data.guest_count);

                var checkedFunctions = $('input[name="function[]"]:checked').map(function() {
                    return $(this).val();
                }).get();
                console.log("check", checkedFunctions);

                if (checkedFunctions.includes('Breakfast') || checkedFunctions.includes('Brunch')) {
                    $('#breakfast').show();
                }
                if (checkedFunctions.includes('Lunch')) {
                    $('#lunch').show();
                }
                if (checkedFunctions.includes('Dinner')) {
                    $('#dinner').show();
                }
                if (checkedFunctions.includes('Wedding')) {
                    $('#wedding').show();
                }
            }
        });
    });
    $('select[name = "lead_status"]').on('change', function() {
        var val = $(this).val();
        var id = $(this).attr('data-id');
        var url = "{{route('lead.changeleadstat')}}";
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                "status": val,
                'id': id,
                "_token": "{{ csrf_token() }}"
            },
            success: function(data) {
                if (val == 1) {
                    show_toastr('Primary', 'Opportunitie Activated', 'success');
                } else {
                    show_toastr('Success', 'Opportunitie InActivated', 'danger');

                }
                console.log(val)

            }
        });
    })

    $('select[name = "drop_status"]').on('change', function() {
        var val = $(this).val();
        var id = $(this).attr('data-id');
        var url = "{{route('lead.changeproposalstat')}}";
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                "status": val,
                'id': id,
                "_token": "{{ csrf_token() }}"
            },
            success: function(data) {
                console.log(data)
                if (data == 1) {
                    show_toastr('Primary', 'Opportunitie Status Updated Successfully', 'success');
                } else {
                    show_toastr('Success', 'Opportunitie Status is not updated', 'danger');

                }
            }
        });
    });
</script>
<script>
    $("#employee_filter").keyup(function() {
        let table = new simpleDatatables.DataTable('#datatable');
        console.log('dfsjfkdfa');
        table.search(table).draw();
    });
</script>
@endpush