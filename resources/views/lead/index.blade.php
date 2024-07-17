@php
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
$currentDate = Carbon::now();
$proposalstatus = \App\Models\Lead::$status;

$users = \Auth::user()->type;
$userRole = \Auth::user()->user_roles;
$userRoleType = Role::find($userRole)->roleType;
$userRoleName = Role::find($userRole)->name;
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
        position: absolute;
        right: 19%;
    }
</style>
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
<li class="breadcrumb-item">{{__('Opportunities')}}</li>

@endsection
@section('action-btn')

@can('Create Opportunity')
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
                                    <!-- <div class="post-search-panel">
                                        <input type="text" class="form-control" id="team_member" placeholder="Team Member">
                                    </div> -->
                                    <table class="table datatable" id="datatable">
                                        <thead>
                                            <tr>
                                                <!-- <th scope="col" class="sort" data-sort="name">{{__('Lead')}}</th> -->
                                                <th scope="col" class="sort" id="myInput" data-sort="name">{{__('Company')}} <span class="opticy"></span></th>
                                                <th scope="col" class="sort" id="teamMember" data-sort="assigned_user">Team Member <span class="opticy"></span></th>
                                                <th scope="col" class="sort" data-sort="budget">{{__('Opportunity Value')}} <span class="opticy"></span></th>
                                                <!-- <th scope="col" class="sort">{{__('Status')}} <span class="opticy"></span></th> -->
                                                <!-- <th scope="col" class="sort">{{__('Proposal Status')}}</th> -->
                                                <th scope="col" class="sort">{{__('Sales Stage')}}<span class="opticy"></span></th>
                                                <th scope="col" class="sort">{{__('Created On')}}<span class="opticy"></span></th>
                                                <th scope="col" class="sort">{{__('Products/Services')}}<span class="opticy"></span></th>
                                                @if(Gate::check('Show Opportunity') || Gate::check('Edit Opportunity') ||
                                                Gate::check('Delete Opportunity'))
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
                                                <td>{{ $lead->assigned_user ? \App\Models\User::find($lead->assigned_user)->name : '' }}</td>
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
                                                    @if($userRoleName == 'restricted')
                                                    <span>{{ $lead->sales_stage }}</span>
                                                    @else
                                                    <select name="drop_status" id="drop_status" class="form-select" data-id="{{ $lead->id }}" data-lead-name="{{ $lead->name }}">
                                                        @foreach($proposalstatus as $key => $stat)
                                                        <option value="{{ $key }}" {{ isset($lead->status) && $lead->status == $key ? "selected" : "" }}>
                                                            {{ $stat }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    @endif
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

                                                @php
                                                $showActions = false;

                                                if (Gate::check('Show Opportunity') || Gate::check('Edit Opportunity') || Gate::check('Delete Opportunity') || Gate::check('Manage Opportunity')) {
                                                if ($userType == 'executive' && $userRoleType == 'individual' && $lead->assigned_user == \Auth::user()->id) {
                                                $showActions = true;
                                                } else if ($userType == 'executive' && $userRoleType == 'company' && $lead->assigned_user != \Auth::user()->id) {
                                                $showActions = false;
                                                } else if (!($userType == 'executive' && $userRoleType == 'individual')) {
                                                $showActions = true;
                                                }
                                                }
                                                @endphp

                                                @if($showActions)
                                                <td class="text-end">
                                                    @if($lead->status == 4 && $userRoleName != 'restricted')
                                                    <div class="action-btn bg-secondary ms-2">
                                                        <a href="{{ route('meeting.create',['meeting',0])}}" id="convertLink" data-size="md" data-url="#" data-bs-toggle="tooltip" data-title="{{ __('Convert') }}" title="{{ __('Convert To Event') }}" data-id="{{$lead->id}}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                            <i class="fas fa-exchange-alt"></i> </a>
                                                    </div>
                                                    @endif
                                                    {{-- @if($lead->status == 0 ) --}}
                                                    @if($lead->is_nda_signed == 1 && $lead->status == 6 && $userRoleName != 'restricted')
                                                    <div class="action-btn bg-primary ms-2">
                                                        <a href="javascript:void(0);" data-size="md" data-url="{{ route('lead.shareproposal',urlencode(encrypt($lead->id))) }}" data-ajax-popup="true" data-bs-toggle="tooltip" data-title="{{ __('MOU') }}" title="{{ __('MOU') }}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                            <i class="ti ti-share"></i>
                                                        </a>
                                                    </div>
                                                    @endif

                                                    @if($userRoleName != 'restricted')
                                                    <div class="action-btn bg-primary ms-2">
                                                        <a href="javascript:void(0);" data-size="md" data-url="{{ route('lead.sendemail',urlencode(encrypt($lead->id))) }}" data-ajax-popup="true" data-bs-toggle="tooltip" data-title="{{ __('New Message') }}" title="{{ __('Email') }}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                            <i class="ti ti-mail"></i>
                                                        </a>
                                                    </div>
                                                    @endif
                                                    {{-- @endif --}}

                                                    @if($lead->is_nda_signed == 0 && $userRoleName != 'restricted')
                                                    <div class="action-btn bg-primary ms-2">
                                                        <a href="javascript:void(0);" data-size="md" data-url="{{ route('lead.sharenda',urlencode(encrypt($lead->id))) }}" data-ajax-popup="true" data-bs-toggle="tooltip" data-title="{{ __('NDA') }}" title="{{ __('Share NDA') }}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                            <i class="ti ti-file"></i>
                                                        </a>
                                                    </div>
                                                    @endif

                                                    @if($lead->status >= 2 && $userRoleName != 'restricted')
                                                    <div class="action-btn bg-info ms-2">
                                                        <a href="{{route('lead.review',urlencode(encrypt($lead->id))) }}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white " data-bs-toggle="tooltip" title="{{__('Review')}}" data-title="{{__('Review Opportunities')}}">
                                                            <i class="fas fa-pen"></i></a>
                                                    </div>
                                                    @endif

                                                    @if($userRoleName != 'restricted')
                                                    <div class="action-btn bg-primary ms-2">
                                                        <a href="{{route('lead.clone',urlencode(encrypt($lead->id)))}}" data-size="md" data-url="#" data-bs-toggle="tooltip" title="{{ __('Clone') }}" data-title="{{ __('Clone') }}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                            <i class="fa fa-clone"></i>
                                                        </a>
                                                    </div>
                                                    @endif

                                                    @if($lead->status >= 1 && $userRoleName != 'restricted')
                                                    <div class="action-btn bg-success ms-2">
                                                        <a href="{{route('lead.proposal',urlencode(encrypt($lead->id))) }}" data-bs-toggle="tooltip" data-title="{{__('Proposal')}}" title="{{__('View Proposal')}}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white">
                                                            <i class="ti ti-receipt"></i>
                                                        </a>
                                                    </div>
                                                    @endif
                                                    @can('Show Opportunity')
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
                                                    @can('Edit Opportunity')
                                                    <div class="action-btn bg-info ms-2">
                                                        <a href="{{ route('lead.edit',$lead->id) }}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white " data-bs-toggle="tooltip" title="{{__('Details')}}" data-title="{{__('Edit Opportunitie')}}"><i class="ti ti-edit"></i></a>
                                                    </div>
                                                    @endcan
                                                    @endif
                                                    @can('Delete Opportunity')
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
                                                @else
                                                <td></td>
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
        var text = $(this).find('option:selected').text();
        var id = $(this).data('id');
        var leadName = $(this).data('lead-name');
        var url = "{{ route('lead.changeproposalstat') }}";
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                "status": val,
                "status_text": text,
                "id": id,
                "lead_name": leadName,
                "_token": "{{ csrf_token() }}"
            },
            success: function(data) {
                console.log(data)
                return false;
                if (data == 1) {
                    show_toastr('Primary', 'Opportunitie Status Updated Successfully', 'success');
                } else {
                    show_toastr('Success', 'Opportunitie Status is not updated', 'danger');

                }
            }
        });
    });
</script>

<!-- <script>
    document.getElementById('team_member').addEventListener('keyup', function() {
        var input = this.value.toLowerCase();
        var table = document.getElementById('datatable');
        var rows = table.getElementsByTagName('tr');

        for (var i = 1; i < rows.length; i++) { 
            var teamMemberCell = rows[i].getElementsByTagName('td')[1]; // Adjust the index if necessary           
            if (teamMemberCell) {
                var teamMember = teamMemberCell.textContent || teamMemberCell.innerText;
                if (teamMember.toLowerCase().indexOf(input) > -1) {
                    rows[i].style.display = '';
                } else {
                    rows[i].style.display = 'none';
                }
            }
        }
    });
</script> -->
@endpush