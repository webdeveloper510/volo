@extends('layouts.admin')
@section('breadcrumb')
@endsection
@section('page-title')
{{ __('Home') }}
@endsection
@section('title')
{{ __('Dashboard') }}
@endsection
@section('action-btn')
@endsection
@section('content')

<style>
    label.filter-label {
        font-weight: 700;
    }

    span.client-name {
        font-weight: 100 !important;
        font-size: 13px;
        display: block;
    }

    span.opportunity-price {
        position: absolute;
        margin-top: 54px;
    }

    span.no-record {
        font-style: italic;
        font-weight: 600;
        color: #a99595;
        margin: 24px 0px 0px 44px;
    }

    #team_member {
        background: none;
    }

    #region {
        background: none;
    }

    #products {
        background: none;
    }
</style>
<div class="container-field">
    <div id="wrapper">
        <div id="page-content-wrapper">
            <div class="row">
                <div class="col-4 mb-4">
                    <label class="filter-label">Team Member</label>
                    <select id="team_member" name="team_member[]" class="form-control" multiple>
                        <option value="" disabled>Select Team Member</option>
                        @foreach ($assinged_staff as $staff)
                        <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                        @endforeach
                        <option value="clear_team_member_filter">Clear Filter</option>
                    </select>
                </div>
                <div class="col-4 mb-4">
                    <label class="filter-label">Region</label>
                    <select id="region" name="region[]" class="form-control" multiple>
                        <option value="" disabled>Select Region</option>
                        @foreach($regions as $region)
                        <option value="{{ $region }}">{{ $region }}</option>
                        @endforeach
                        <option value="clear_region_filter">Clear Filter</option>
                    </select>
                </div>
                <div class="col-4 mb-4">
                    <label class="filter-label">Products</label>
                    <select id="products" name="products[]" class="form-control" multiple>
                        <option value="" disabled>Select Products</option>
                        @foreach ($products as $product)
                        <option value="{{ $product }}">{{ $product }}</option>
                        @endforeach
                        <option value="clear_products_filter">Clear Filter</option>
                    </select>
                </div>

                <div class="row">
                    <div class="col-3 prospecting-div">
                        <div class="inner_col">
                            <h5 class="card-title mb-2 opportunity-title">NDAs ({{ $prospectingOpportunitiesCount }}) <span class="prospecting-opportunities">${{ human_readable_number($prospectingOpportunitiesSum) }}</span></h5>
                            <input type="hidden" id="prospecting-opportunities-sum" name="prospecting-opportunities-sum" value="{{ human_readable_number($prospectingOpportunitiesSum) }}">
                            <div class="scrol-card">
                                @foreach($prospectingOpportunities as $prospectingOpportunity)
                                <div class="card">
                                    <div class="card-body new_bottomcard">
                                        <h5 class="card-text">
                                            {{ $prospectingOpportunity['opportunity_name'] }}
                                            <span class="client-name">{{ $prospectingOpportunity['primary_name'] }}</span>
                                        </h5>
                                        @if($prospectingOpportunity['updated_at'])
                                        <p>{{ Carbon\Carbon::parse($prospectingOpportunity['updated_at'])->format('M d')}}</p>
                                        @endif
                                        @can('Show Lead')
                                        <div class="action-btn bg-warning ms-2">
                                            <a href="javascript:void(0);" data-size="md" data-url="{{ route('lead.show',$prospectingOpportunity['id']) }}" data-bs-toggle="tooltip" title="{{__('Quick View')}}" data-ajax-popup="true" data-title="{{__('NDA Opportunity Details')}}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                        </div>
                                        @endcan
                                        <span class="opportunity-price">{{ getCurrencySign($prospectingOpportunity['currency']) }}{{ $prospectingOpportunity['value_of_opportunity'] }}</span>
                                    </div>
                                </div>

                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-3 discovery-div">
                        <div class="inner_col">
                            <h5 class="card-title mb-2">Discovery ({{ $discoveryOpportunitiesCount }}) <span class="discovery-opportunities">${{ human_readable_number($discoveryOpportunitiesSum) }}</span></h5>
                            <input type="hidden" id="discovery-opportunities-sum" name="discovery-opportunities-sum" value="{{ human_readable_number($discoveryOpportunitiesSum) }}">
                            <div class="scrol-card">
                                @foreach($discoveryOpportunities as $discoveryOpportunity)
                                <div class="card">
                                    <div class="card-body new_bottomcard">
                                        <h5 class="card-text">
                                            {{ $discoveryOpportunity['opportunity_name'] }}
                                            <span class="client-name">{{ $discoveryOpportunity['primary_name'] }}</span>
                                        </h5>

                                        @if($discoveryOpportunity['updated_at'])
                                        <p>{{ Carbon\Carbon::parse($discoveryOpportunity['updated_at'])->format('M d')}}</p>
                                        @endif
                                        @can('Show Lead')
                                        <div class="action-btn bg-warning ms-2">
                                            <a href="javascript:void(0);" data-size="md" data-url="{{ route('lead.show',$discoveryOpportunity['id']) }}" data-bs-toggle="tooltip" title="{{__('Quick View')}}" data-ajax-popup="true" data-title="{{__('Discovery Opportunity Details')}}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                        </div>
                                        @endcan
                                        <span class="opportunity-price">{{ getCurrencySign($discoveryOpportunity['currency']) }}{{ $discoveryOpportunity['value_of_opportunity'] }}</span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-3 demo-meeting-div">
                        <div class="inner_col">
                            <h5 class="card-title mb-2">Demo or Meeting ({{ $demoOrMeetingOpportunitiesCount }}) <span class="meeting-opportunities">${{ human_readable_number($demoOrMeetingOpportunitiesSum) }}</span></h5>
                            <input type="hidden" id="meeting-opportunities-sum" name="meeting-opportunities-sum" value="{{ human_readable_number($demoOrMeetingOpportunitiesSum) }}">
                            <div class="scrol-card">
                                @foreach($demoOrMeetingOpportunities as $demoOrMeetingOpportunity)
                                <div class="card">
                                    <div class="card-body new_bottomcard">
                                        <h5 class="card-text">
                                            {{ $demoOrMeetingOpportunity['opportunity_name'] }}
                                            <span class="client-name">{{ $demoOrMeetingOpportunity['primary_name'] }}</span>
                                        </h5>

                                        @if($demoOrMeetingOpportunity['updated_at'])
                                        <p>{{ Carbon\Carbon::parse($demoOrMeetingOpportunity['updated_at'])->format('M d')}}</p>
                                        @endif
                                        @can('Show Lead')
                                        <div class="action-btn bg-warning ms-2">
                                            <a href="javascript:void(0);" data-size="md" data-url="{{ route('lead.show',$demoOrMeetingOpportunity['id']) }}" data-bs-toggle="tooltip" title="{{__('Quick View')}}" data-ajax-popup="true" data-title="{{__('Demo OR Meeting Opportunity Details')}}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                        </div>
                                        @endcan
                                        <span class="opportunity-price">{{ getCurrencySign($demoOrMeetingOpportunity['currency']) }}{{ $demoOrMeetingOpportunity['value_of_opportunity'] }}</span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-3 proposal-div">
                        <div class="inner_col">
                            <h5 class="card-title mb-2">Proposal ({{ $proposalOpportunitiesCount }}) <span class="proposal-opportunities">${{ human_readable_number($proposalOpportunitiesSum) }}</span></h5>
                            <input type="hidden" id="proposal-opportunities-sum" name="proposal-opportunities-sum" value="{{ human_readable_number($proposalOpportunitiesSum) }}">
                            <div class="scrol-card">
                                @foreach($proposalOpportunities as $proposalOpportunity)
                                <div class="card">
                                    <div class="card-body new_bottomcard">
                                        <h5 class="card-text">
                                            {{ $proposalOpportunity['opportunity_name'] }}
                                            <span class="client-name">{{ $proposalOpportunity['primary_name'] }}</span>
                                        </h5>

                                        @if($proposalOpportunity['updated_at'])
                                        <p>{{ Carbon\Carbon::parse($proposalOpportunity['updated_at'])->format('M d')}}</p>
                                        @endif
                                        @can('Show Lead')
                                        <div class="action-btn bg-warning ms-2">
                                            <a href="javascript:void(0);" data-size="md" data-url="{{ route('lead.show',$proposalOpportunity['id']) }}" data-bs-toggle="tooltip" title="{{__('Quick View')}}" data-ajax-popup="true" data-title="{{__('Proposal Opportunity Details')}}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                        </div>
                                        @endcan
                                        <span class="opportunity-price">{{ getCurrencySign($proposalOpportunity['currency']) }}{{ $proposalOpportunity['value_of_opportunity'] }}</span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4 ">
                    <div class="col-3 negotiation-div">
                        <div class="inner_col">
                            <h5 class="card-title mb-2">Negotiation ({{ $negotiationOpportunitiesCount }}) <span class="negotiation-opportunities">${{ human_readable_number($negotiationOpportunitiesSum) }}</span></h5>
                            <input type="hidden" id="negotiation-opportunities-sum" name="negotiation-opportunities-sum" value="{{ human_readable_number($negotiationOpportunitiesSum) }}">
                            <div class="scrol-card">
                                @foreach($negotiationOpportunities as $negotiationOpportunity)
                                <div class="card">
                                    <div class="card-body new_bottomcard">
                                        <h5 class="card-text">
                                            {{ $negotiationOpportunity['opportunity_name'] }}
                                            <span class="client-name">{{ $negotiationOpportunity['primary_name'] }}</span>
                                        </h5>

                                        @if($negotiationOpportunity['updated_at'])
                                        <p>{{ Carbon\Carbon::parse($negotiationOpportunity['updated_at'])->format('M d')}}</p>
                                        @endif
                                        @can('Show Lead')
                                        <div class="action-btn bg-warning ms-2">
                                            <a href="javascript:void(0);" data-size="md" data-url="{{ route('lead.show',$negotiationOpportunity['id']) }}" data-bs-toggle="tooltip" title="{{__('Quick View')}}" data-ajax-popup="true" data-title="{{__('Negotiation Opportunity Details')}}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                        </div>
                                        @endcan
                                        <span class="opportunity-price">{{ getCurrencySign($negotiationOpportunity['currency']) }}{{ $negotiationOpportunity['value_of_opportunity'] }}</span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-3 awaiting-decision-div">
                        <div class="inner_col">
                            <h5 class="card-title mb-2">Awaiting Decision ({{ $awaitingDecisionOpportunitiesCount }}) <span class="awaiting-opportunities">${{ human_readable_number($awaitingDecisionOpportunitiesSum) }}</span></h5>
                            <input type="hidden" id="awaiting-opportunities-sum" name="awaiting-opportunities-sum" value="{{ human_readable_number($awaitingDecisionOpportunitiesSum) }}">
                            <div class="scrol-card">
                                @foreach($awaitingDecisionOpportunities as $awaitingDecisionOpportunity)
                                <div class="card">
                                    <div class="card-body new_bottomcard">
                                        <h5 class="card-text">
                                            {{ $awaitingDecisionOpportunity['opportunity_name'] }}
                                            <span class="client-name">{{ $awaitingDecisionOpportunity['primary_name'] }}</span>
                                        </h5>

                                        @if($awaitingDecisionOpportunity['updated_at'])
                                        <p>{{ Carbon\Carbon::parse($awaitingDecisionOpportunity['updated_at'])->format('M d')}}</p>
                                        @endif
                                        @can('Show Lead')
                                        <div class="action-btn bg-warning ms-2">
                                            <a href="javascript:void(0);" data-size="md" data-url="{{ route('lead.show',$awaitingDecisionOpportunity['id']) }}" data-bs-toggle="tooltip" title="{{__('Quick View')}}" data-ajax-popup="true" data-title="{{__('Awaiting Decision Opportunity Details')}}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                        </div>
                                        @endcan
                                        <span class="opportunity-price">{{ getCurrencySign($awaitingDecisionOpportunity['currency']) }}{{ $awaitingDecisionOpportunity['value_of_opportunity'] }}</span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-3 post-purchase-div">
                        <div class="inner_col">
                            <h5 class="card-title mb-2">Contractual ({{ $postPurchaseOpportunitiesCount }}) <span class="postpurchase-opportunities">${{ human_readable_number($postPurchaseOpportunitiesSum) }}</span></h5>
                            <input type="hidden" id="postpurchase-opportunities-sum" name="postpurchase-opportunities-sum" value="{{ human_readable_number($postPurchaseOpportunitiesSum) }}">
                            <div class="scrol-card">
                                @foreach($postPurchaseOpportunities as $postPurchaseOpportunity)
                                <div class="card">
                                    <div class="card-body new_bottomcard">
                                        <h5 class="card-text">
                                            {{ $postPurchaseOpportunity['opportunity_name'] }}
                                            <span class="client-name">{{ $postPurchaseOpportunity['primary_name'] }}</span>
                                        </h5>

                                        @if($postPurchaseOpportunity['updated_at'])
                                        <p>{{ Carbon\Carbon::parse($postPurchaseOpportunity['updated_at'])->format('M d')}}</p>
                                        @endif
                                        @can('Show Lead')
                                        <div class="action-btn bg-warning ms-2">
                                            <a href="javascript:void(0);" data-size="md" data-url="{{ route('lead.show',$postPurchaseOpportunity['id']) }}" data-bs-toggle="tooltip" title="{{__('Quick View')}}" data-ajax-popup="true" data-title="{{__('Contractual Opportunity Details')}}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                        </div>
                                        @endcan
                                        <span class="opportunity-price">{{ getCurrencySign($postPurchaseOpportunity['currency']) }}{{ $postPurchaseOpportunity['value_of_opportunity'] }}</span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-3 closed-won-div">
                        <div class="inner_col">
                            <h5 class="card-title mb-2">Closed Won ({{ $closedWonOpportunitiesCount }}) <span class="closedwon-opportunities">${{ human_readable_number($closedWonOpportunitiesSum) }}</span></h5>
                            <input type="hidden" id="closedwon-opportunitie-sum" name="closedwon-opportunitie-sum" value="{{ human_readable_number($closedWonOpportunitiesSum) }}">
                            <div class="scrol-card">
                                @foreach($closedWonOpportunities as $closedWonOpportunity)
                                <div class="card">
                                    <div class="card-body new_bottomcard">
                                        <h5 class="card-text">
                                            {{ $closedWonOpportunity['opportunity_name'] }}
                                            <span class="client-name">{{ $closedWonOpportunity['primary_name'] }}</span>
                                        </h5>

                                        @if($closedWonOpportunity['updated_at'])
                                        <p>{{ Carbon\Carbon::parse($closedWonOpportunity['updated_at'])->format('M d')}}</p>
                                        @endif
                                        @can('Show Lead')
                                        <div class="action-btn bg-warning ms-2">
                                            <a href="javascript:void(0);" data-size="md" data-url="{{ route('lead.show',$closedWonOpportunity['id']) }}" data-bs-toggle="tooltip" title="{{__('Quick View')}}" data-ajax-popup="true" data-title="{{__('Closed Won Opportunity Details')}}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                        </div>
                                        @endcan
                                        <span class="opportunity-price">{{ getCurrencySign($closedWonOpportunity['currency']) }}{{ $closedWonOpportunity['value_of_opportunity'] }}</span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    h6 {
        font-size: 12px !important;
    }

    h5.card-text {
        font-size: 14px;
    }

    .flex-div {
        display: flex;
        justify-content: space-between;
    }

    .inner_col {
        background: white;
        padding: 0px;
        border: 1px solid #ccc;
        border-radius: 0px;
        margin-top: 10px;
    }

    .date-y {
        float: right;
        padding-bottom: 10px;
        text-align: right;
        width: 100%;
        margin-top: 10px;
    }

    .inner_col p {
        position: intial !important;
    }

    .right_side {
        float: left;
        text-align: left;
    }

    .theme-avtar {
        margin-right: 10px;
    }

    .inner_col .scrol-card {
        padding: 10px;
        background: white;
        border-radius: 20px;
        /* margin-top: 10px; */
        padding-top: 20px;
        max-height: 210px;
        overflow-y: scroll;
    }

    /* 
    .inner_col {
        min-height: 320px;
    } */

    @media only screen and (max-width: 1280px) {
        .flex-div {
            display: block !important;
        }

        .card {

            height: 100%;
        }

        .new-div {
            display: flex;

        }

        .mt10 {
            margin-top: 10px;
        }
    }
</style>

@endsection
@push('script-page')
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>
<script>
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', function() {
            navigator.serviceWorker.register('firebase-messaging-sw.js')
                .then(function(registration) {
                    console.log('ServiceWorker registration successful with scope: ', registration.scope);
                })
                .catch(function(err) {
                    console.error('ServiceWorker registration failed: ', err);
                });
        });
    }
</script>

<script>
    $(document).ready(function() {
        var firebaseConfig = {
            apiKey: "AIzaSyB3y7uzZSAP39LOIvZwOjJOdFD2myDnvQk",
            authDomain: "notify-71d80.firebaseapp.com",
            projectId: "notify-71d80",
            storageBucket: "notify-71d80.appspot.com",
            messagingSenderId: "684664764020",
            appId: "1:684664764020:web:71f82128ffc0e20e3fc321",
            measurementId: "G-FTD60E8WG9"
        };
        firebase.initializeApp(firebaseConfig);
        const messaging = firebase.messaging();

        messaging
            .requestPermission()
            .then(function() {
                return messaging.getToken()
            })
            .then(function(response) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{ route("store.token") }}',
                    type: 'POST',
                    data: {
                        token: response
                    },
                    dataType: 'JSON',
                    success: function(response) {
                        console.log('Token stored.');
                    },
                    error: function(error) {
                        console.log(error);
                    },
                });
            }).catch(function(error) {
                console.log(error);
            });
        messaging.onMessage(function(payload) {
            const title = payload.notification.title;
            const options = {
                body: payload.notification.body,
                icon: payload.notification.icon,
            };
            new Notification(title, options);
        });
    })
</script>

<!-- Filter Opportunities data -->
<script>
    $(document).ready(function() {
        $('#team_member').change(function() {
            if ($(this).val().includes('clear_team_member_filter')) {
                $(this).val([]).trigger('change');
            }
        });

        $('#region').change(function() {
            if ($(this).val().includes('clear_region_filter')) {
                $(this).val([]).trigger('change');
            }
        });

        $('#products').change(function() {
            if ($(this).val().includes('clear_products_filter')) {
                $(this).val([]).trigger('change');
            }
        });

        function handleFilterChange() {
            var baseUrl = "{{ url('/') }}";
            var teamMember = $('#team_member').val();
            var region = $('#region').val();
            var products = $('#products').val();

            $.ajax({
                url: '{{ route("filter-data.dashboard") }}',
                method: 'GET',
                data: {
                    team_member: teamMember,
                    region: region,
                    products: products
                },
                success: function(response) {
                    // console.log('Response:', response);
                    var data = response.opportunities;
                    // console.log('Data:', data);

                    // List of all possible opportunity types
                    var allOpportunityTypes = [
                        'prospecting',
                        'discovery',
                        'demo_meeting',
                        'proposal',
                        'negotiation',
                        'awaiting_decision',
                        'post_purchase',
                        'closed_won'
                    ];

                    // Loop through each opportunity type and generate HTML
                    allOpportunityTypes.forEach(function(type) {
                        if (data[type]) {
                            var opportunityData = data[type];
                            var opportunityHtml = generateOpportunityHTML(type, baseUrl, opportunityData);
                            $('.' + type.replace('_', '-') + '-div').html(opportunityHtml);
                        } else {
                            // Clear the div if no data for this opportunity type
                            $('.' + type.replace('_', '-') + '-div').html(generateNoRecordHTML(type));
                        }
                    });
                },
                error: function() {
                    console.log('Error fetching data');
                }
            });
        }

        // Attach change event listeners to the filters
        $('#team_member, #region, #products').change(handleFilterChange);

        function formatTypeText(text) {
            console.log('Original Text:', text);

            // Direct replacements
            if (text === 'prospecting') {
                text = 'NDAs';
            } else if (text === 'post_purchase') {
                text = 'Contractual';
            } else {
                // Default formatting if no specific replacement found
                text = text
                    .split('_')
                    .map(word => word.charAt(0).toUpperCase() + word.slice(1).toLowerCase())
                    .join(' ');
            }

            console.log('Formatted Text:', text);
            return text;
        }

        function generateOpportunityHTML(type, baseUrl, data) {
            console.log(type);

            var html = '';

            if (data && data.lead && data.lead.length > 0) {
                var count = data.count;
                var sum = data.sum;
                var sumDisplay = sum ? human_readable_number(sum) : '0';
                var formattedType = formatTypeText(type);

                html += '<div class="inner_col">';
                html += '<h5 class="card-title mb-2 opportunity-title">' + formattedType + ' (' + count + ') <span class="' + type.toLowerCase() + '-opportunities">$' + sumDisplay + '</span></h5>';
                html += '<input type="hidden" id="' + type.toLowerCase() + '-opportunities-sum" name="' + type.toLowerCase() + '-opportunities-sum" value="' + sumDisplay + '">';
                html += '<div class="scrol-card">';

                data.lead.forEach(function(lead) {
                    html += generateLeadCard(baseUrl, lead, type);
                });

                html += '</div>'; // close scrol-card
                html += '</div>'; // close inner_col
            } else {
                html = generateNoRecordHTML(type);
            }

            return html;
        }

        function generateNoRecordHTML(type) {
            var formattedType = formatTypeText(type);

            var html = '<div class="inner_col">';
            html += '<h5 class="card-title mb-2 opportunity-title">' + formattedType + ' (0) <span class="' + type.toLowerCase() + '-opportunities">$0</span></h5>';
            html += '<div class="scrol-card">';
            html += '<div class="card">';
            html += '<div class="card-body new_bottomcard">';
            html += '<span class="no-record">No records found</span>';
            html += '</div>'; // close card-body
            html += '</div>'; // close card
            html += '</div>'; // close scrol-card
            html += '</div>'; // close inner_col

            return html;
        }

        function generateLeadCard(baseUrl, lead, type) {
            var html = '';

            html += '<div class="card">';
            html += '<div class="card-body new_bottomcard">';
            html += '<h5 class="card-text">' + lead.opportunity_name + '<span class="client-name">' + lead.primary_name + '</span></h5>';

            if (lead.updated_at) {
                var updatedAt = new Date(lead.updated_at);
                var formattedDate = getFormattedDate(updatedAt);
                html += '<p>' + formattedDate + '</p>';
            }

            html += '<div class="action-btn bg-warning ms-2">';
            html += '<a href="javascript:void(0);" data-size="md" data-url="' + baseUrl + '/lead/' + lead.id + '" data-bs-toggle="tooltip" title="Quick View" data-ajax-popup="true" data-title="' + capitalizeFirstLetter(type) + ' Opportunity Details" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">';
            html += '<i class="ti ti-eye"></i>';
            html += '</a>';
            html += '</div>';

            html += '<span class="opportunity-price">' + getCurrencySign(lead.currency) + ' ' + lead.value_of_opportunity + '</span>';
            html += '</div>'; // close card-body
            html += '</div>'; // close card

            return html;
        }

        function getFormattedDate(date) {
            var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
                "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
            ];
            return monthNames[date.getMonth()] + ' ' + date.getDate();
        }

        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }

        function human_readable_number(number) {
            if (number >= 1000000) {
                return (number / 1000000).toFixed(1) + 'M';
            }
            if (number >= 1000) {
                return (number / 1000).toFixed(1) + 'K';
            }
            return number.toLocaleString();
        }

        function getCurrencySign(currency) {
            switch (currency.toUpperCase()) {
                case 'GBP':
                    return '£';
                case 'USD':
                    return '$';
                case 'EUR':
                    return '€';
                default:
                    return '';
            }
        }
    });
</script>
@endpush