@php
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
$currentDate = Carbon::now();
$proposalstatus = \App\Models\Lead::$status;

$users = \Auth::user()->type;
$userRole = \Auth::user()->user_roles;
$userRoleType = Role::find($userRole)->roleType;
$userRoleName = Role::find($userRole)->name;

$settings = App\Models\Utility::settings();
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
<?php
$url = 'https://oauth.airslate.com/public/oauth/token';
// Data to be sent in the POST request
$data = array(
    'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
    'assertion' => 'eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJhdWQiOiI5YjY5YTAzNy0zN2Q1LTQ2MzgtODM0Mi1jMGJhZjkzNGM1YWMiLCJzdWIiOiJjYzllZDA0Ni0yMzBkLTRjNjctOTAwYi04NzkzMmQzNGM5YWIiLCJpc3MiOiJvYXV0aC5haXJzbGF0ZS5jb20iLCJpYXQiOjE3MjEwMzkzODIsImV4cCI6NDg3NjcxMjkzMCwic2NvcGUiOiJlbWFpbCJ9.LpEPTjeSA_TGNTvkTZsk4cnBKKEZbfIShxSmWxhER5HZ7c_1ebMpVQwB-00gzU-mX_FdV6Vd4bAhn5IuX0TCo6cuqm5Uw7wbgMIiLU8hq8DYma3tV6Oikpv1UUPJR1gtVk8BfUGtSMMf23ZkPNDLkDxY2Gvf35llH5W7RWQwrMcF4w2ux9ZcitwTZ2Du6iaJryrY41IPeHhJHPNbVEphQTBAjDUGQdfUoHrhkDS4Fiu7VYHuSITCsk9C2wglMiBTgC3-LwSz3t43PwDqXKkK952L4XO3Nmfr1w29x9tRjB4co_R3wGEy1HpVPjUJ6loYEA_jrLt4_TIQW9I7nnIJEw'
);
// Initialize cURL
$ch = curl_init();
// Set the URL and other appropriate options
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Accept: application/json',
    'Content-Type: application/x-www-form-urlencoded'
));
// Execute the request
$response = curl_exec($ch);
// Check for errors
if ($response === FALSE) {
    die(curl_error($ch));
}
// Close cURL resource
curl_close($ch);
// Decode and print the response
$token_data = json_decode($response, true);
$token_value = $token_data['access_token'];
?>
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
                                                {{--<td>
                                                    <a href="{{ route('lead.info',urlencode(encrypt($lead->id))) }}" data-size="md" title="{{ __('Opportunities Details') }}" class="action-item text-primary" style="color:#1551c9 !important;">
                                                <b> {{ ucfirst($lead->opportunity_name) }}</b>
                                                </a>
                                                </td>--}}

                                                <td>
                                                    <?php $contractor_name = ""; ?>
                                                    @if($meeting->attendees_lead != 0)
                                                    <?php $leaddata = \App\Models\Lead::where('id', $lead->attendees_lead)->first() ?>
                                                    @if(isset($leaddata) && !empty($leaddata))
                                                    <a href="{{ route('lead.info',urlencode(encrypt($leaddata->id)))}}" data-size="md"
                                                        data-title="{{ __('Event Details') }}"
                                                        class="action-item text-primary"
                                                        style=" color: #1551c9 !important;">
                                                        {{ucfirst($leaddata->leadname)}}
                                                        <?php $contractor_name = ucfirst($leaddata->leadname); ?>
                                                    </a>
                                                    @endif
                                                    @else
                                                    <a href="{{route('meeting.detailview',urlencode(encrypt($lead->id)))}}"
                                                        data-size="md" title="{{ __('Detailed view ') }}"
                                                        class="action-item text-primary" style=" color: #1551c9 !important;">
                                                        {{ucfirst($lead->eventname)}}</a>
                                                    <?php $contractor_name = ucfirst($lead->eventname); ?>
                                                    @endif
                                                </td>

                                                <td>{{ optional(\App\Models\User::find($lead->assigned_user))->name ?? '' }}</td>
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
                                                    <select name="drop_status" id="drop_status" class="form-select" data-id="{{ $lead->id }}" data-lead-name="{{ $lead->opportunity_name }}">
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
                                                    <!-- @if($lead->status == 4 && $userRoleName != 'restricted')
                                                    <div class="action-btn bg-secondary ms-2">
                                                        <a href="{{ route('meeting.create',['meeting',0])}}" id="convertLink" data-size="md" data-url="#" data-bs-toggle="tooltip" data-title="{{ __('Convert') }}" title="{{ __('Convert To Event') }}" data-id="{{$lead->id}}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                            <i class="fas fa-exchange-alt"></i> </a>
                                                    </div>
                                                    @endif -->
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

                                                    <!-- @if($lead->status >= 1 && $userRoleName != 'restricted')
                                                    <div class="action-btn bg-success ms-2">
                                                        <a href="{{route('lead.proposal',urlencode(encrypt($lead->id))) }}" data-bs-toggle="tooltip" data-title="{{__('Proposal')}}" title="{{__('View Proposal')}}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white">
                                                            <i class="ti ti-receipt"></i>
                                                        </a>
                                                    </div>
                                                    @endif -->
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
                                                    @if($lead->is_contract_accepted != 1)
                                                    <div class="action-btn bg-info ms-2 cursor" onclick="setContractorDetails('<?= $contractor_name ?>' , '<?= $lead->id ?>')" data-toggle="modal" data-target="#myModal" data-title="{{ __('Share contract') }}">
                                                        <i class="ti ti-send"></i></a>
                                                    </div>
                                                    @endif

                                                    @if($lead->is_contract_accepted == 1)
                                                    <div class="action-btn bg-info ms-2">
                                                        <a href="{{ url('/download-contract').'/'.$lead->flow_id }}"
                                                            class="mx-3 btn btn-sm d-inline-flex align-items-center text-white"
                                                            data-bs-toggle="tooltip" data-title="{{ __('Details') }}"
                                                            title="{{ __('Download Contract') }}" target="_blank"><i class="ti ti-download"></i></a>
                                                    </div>
                                                    @endif

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
<div class="modal" tabindex="-1" role="dialog" id="myModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width:900px !important; margin-left:-65px !important;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Send Contract to <span id="contractor_name"></span></h5>
                <button type="button" id="close_button" class="close btn btn-primary" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!--<div class="col-4">-->
                    <!--    <label>Template name</label>-->
                    <!--    <input class="form-control" id="template_name">-->
                    <!--</div>-->

                    <!--<div class="col-4">-->
                    <!--    <label>Template description</label>-->
                    <!--    <input class="form-control" id="template_description">-->
                    <!--</div>-->

                    <div class="col-md-4">

                        <!--<select class="form-control" id="selected_doc">-->
                        <!--    <option value="">Please select a Doc</option>-->
                        <!--    <option value="Air_Doc.docx">Dynamic Doc</option>-->
                        <!--</select>-->

                        <select class="form-control" id="selected_template">
                            <opiton selected>Select a template</opiton>
                        </select>

                    </div>

                    <!--<div class="col-md-4">-->
                    <!--    <label for="upload" class="file-upload-label">Upload the Doc file</label>-->
                    <!--    <input type="file" id="fileInput" class="form-control file-upload" accept=".doc, .docx">-->
                    <!--    <input type="hidden" id="base64Output">-->

                    <!--</div>-->

                    <div class="col-4">
                        <!--<button onclick="createTemplate()" class="mt-2 btn btn-info">Send Contract</button>-->
                        <!--<button onclick="sendEventContract()" class=" btn btn-info">Send Contract</button>-->
                        <button onclick="sendContract()" class=" btn btn-info">Send Contract</button>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

<div class="modals"><!-- Place at bottom of page --></div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<style>
    .cursor {
        cursor: pointer;
    }

    .modals {
        display: none;
        position: fixed;
        z-index: 1100;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background: rgba(255, 255, 255, .8) url('https://thesectoreight.com/public/img/loader.gif') 50% 50% no-repeat;
    }

    body.loading .modals {
        overflow: hidden;
    }

    body.loading .modals {
        display: block;
    }
</style>
@endsection
@push('script-page')
<script>
    $body = $("body");
    var event_id_number = '';
    var template_id = '';
    var template_version_id = "";
    var document_id = "";
    let loadCount = 0;

    allTemplates();

    function setContractorDetails(con_name, event_id) {
        $("#contractor_name").text(con_name);
        event_id_number = event_id;
        console.log('check---------------------', con_name, event_id)
    }


    function sendContract() {

        var template_id = $("#selected_template").val();
        if (template_id == "") {
            alert("Please select a template first")
            return
        }
        $body.addClass("loading");
        $.ajax({
            url: "<?= url('send-event-contract') ?>",
            type: 'POST',
            data: {
                "template_id": template_id,
                "event_id_number": event_id_number,
                "_token": "{{ csrf_token() }}",
            },
            success: function(data) {
                console.log('send-event-contract------', data);
                $body.removeClass("loading");
                let result = JSON.parse(data);
                console.log('send-event-contract------', result);
                $(".close").trigger("click");
                if (result.code == 200) {
                    $("#selected_template").val("")

                    setTimeout(() => {
                        show_toastr('Success', result.data + " to " + result.email, 'success');
                    }, 300);

                    // alert(result.data+" to "+ result.email);
                } else {
                    alert("Somethingh happen wrong on server side. Please try again")
                }
            },
            error: function() {
                alert(' server error---' + error);
                $body.removeClass("loading");
            }
        });
    }


    function allTemplates() {

        let organization_id = "<?= $settings['organization_id'] ?>";
        // $body.addClass("loading");
        const template_list_settings = {
            async: true,
            crossDomain: true,
            url: `https://api.airslate.io/v1/organizations/${organization_id}/templates?per_page=100000`,
            method: 'GET',
            headers: {
                Accept: 'application/json',
                Authorization: 'Bearer ' + "<?= $token_value ?>"
            }
        };

        $.ajax(template_list_settings).done(function(response) {
            // $body.removeClass("loading");
            console.log('template_list_settings----', response);
            let template_option_html = `<option value="">Select a template</option>`;
            if (response.data.length > 0) {
                for (let template of response.data) {

                    template_option_html += ` <option value="${template.id}">${template.name}</option>`;
                }
            }

            $("#selected_template").html(template_option_html);
        });
    }

    function sendEventContract() {
        var doc_seleceted = $("#selected_doc").val();
        if (doc_seleceted == "") {
            alert("Please select a Doc first")
            return
        }

        $.ajax({
            url: "<?= url('send-event-contract') ?>",
            type: 'POST',
            data: {
                "event_id_number": event_id_number,
                "_token": "{{ csrf_token() }}",
            },
            success: function(data) {
                console.log('send-event-contract------', data);
                let result = JSON.parse(data);
                if (result.code == 200) {
                    alert(result.data);
                } else {
                    alert("Somethingh happen wrong on server side. Please try again")
                }
            }
        });
    }





    function createTemplate() {

        let template_name = $("#template_name").val();
        let template_description = $("#template_description").val();

        template_name = "template-" + Date.now() + Math.floor(Math.random() * 1000);
        template_description = "template-description -" + Date.now() + Math.floor(Math.random() * 1000);
        if (template_name == '') {
            alert("Template name is required");
            return;
        }

        if (template_description == '') {
            alert("Template description is required");
            return;
        }

        let data = {
            name: template_name,
            description: template_description,
            redirect_url: "https://thesectoreight.com/send-contract"
        }

        console.log('start-----', data)

        //   Create template
        // $body.addClass("loading");
        const create_template_settings = {
            async: true,
            crossDomain: true,
            url: 'https://api.airslate.io/v1/organizations/82391828-2300-0000-0000D981/templates',
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                Accept: 'application/json',
                Authorization: 'Bearer ' + "<?= $token_value ?>"
            },
            processData: false,
            data: JSON.stringify(data)
        };

        console.log('start-----')

        $.ajax(create_template_settings).done(function(response) {
            console.log('Create Template-', response);

            template_id = response.id
            //   template_id = "CCBC8875-8700-0000-0000BA29";
            uploadDocToTemplate();
            //   allTemplates();
        });
    }



    $('#fileInput').on('change', function(event) {
        var file = event.target.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                // var base64String = e.target.result;
                var base64String = e.target.result.split(',')[1];
                $('#base64Output').val(base64String);
                console.log('Base64 String:', base64String);
            };
            reader.readAsDataURL(file);
        }
    });


    // Upload Doc To Template

    function uploadDocToTemplate() {

        const organization_id = '82391828-2300-0000-0000D981';
        const base64Content = $("#base64Output").val(); // Replace with your actual base64 content

        if (template_id == '') {
            alert("Please select a template");
            return
        }

        if (base64Content == '') {
            alert("Please upload a Doc");
            return
        }

        const url = `https://api.airslate.io/v1/organizations/${organization_id}/templates/${template_id}/documents`;
        const data = {
            "name": "NDA.pdf",
            "type": "DOC_GENERATION",
            "content": base64Content
        };

        $.ajax({
            url: url,
            type: 'POST',
            headers: {
                'Authorization': 'Bearer ' + "<?= $token_value ?>",
                'Content-Type': 'application/json'
            },
            data: JSON.stringify(data),
            success: function(response) {
                console.log('uploadDocToTemplate --Response:', response);
                document_id = response.id;
                getTemplateVersions();
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }

    function getTemplateVersions() {

        const settings = {
            async: true,
            crossDomain: true,
            url: `https://api.airslate.io/v1/organizations/82391828-2300-0000-0000D981/templates/${template_id}/versions`,
            method: 'GET',
            headers: {
                Accept: 'application/json',
                Authorization: 'Bearer ' + "<?= $token_value ?>",
            }
        };

        $.ajax(settings).done(function(response) {
            console.log(response);

            template_version_id = response.data[0].id;

            publishTemplateVersion();
        });
    }

    function publishTemplateVersion() {

        const settings = {
            async: true,
            crossDomain: true,
            url: `https://api.airslate.io/v1/organizations/82391828-2300-0000-0000D981/templates/${template_id}/versions/${template_version_id}/publish`,
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                Accept: 'application/json',
                Authorization: 'Bearer ' + "<?= $token_value ?>",
            },
            processData: false,
            data: '{\n  "description": "Version 2 after edits"\n}'
        };

        $.ajax(settings).done(function(response) {
            console.log('publishTemplateVersion-----', response);
            runWorkflow()
        });
    }


    function runWorkflow() {
        console.log("run work flow---")

        $.ajax({
            url: `https://api.airslate.io/v1/organizations/82391828-2300-0000-0000D981/templates/${template_id}/flows`,
            method: 'POST',
            headers: {
                'Authorization': 'Bearer ' + "<?= $token_value ?>",
                'Content-Type': 'application/json'
            },
            data: JSON.stringify({
                documents: [{
                    "id": `${document_id}`,
                    "fields": [{
                        "name": "EmployeeName",
                        "value": $("#contractor_name").text()
                    }]
                }],
                invites: [],
                share_links: [{
                    auth_method: 'none',
                    signer_identity: 'test@lotusus.com',
                    expire: 14400,
                    step_name: 'Recipient 1'
                }],
                webhooks: [{
                    event_name: 'flow.completed',
                    callback: {
                        url: 'https://thesectoreight.com/testing'
                    }
                }]
            }),
            success: function(response) {
                console.log('Success workflow:', response);
                alert(response.share_links[0].url)
            },
            error: function(xhr, status, error) {
                console.log('Error:', error);
            }
        });

    }

    updateContractStatus();
    setInterval(() => {
        updateContractStatus();
    }, 5000);

    function updateContractStatus() {

        console.log('updateContractStatus------')
        $.ajax({
            url: "<?= url('cron-get-contract') ?>",
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}"
            },
            success: function(data) {
                // console.log('data----'  , data)

                // console.log(val)

            }
        });
    }



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