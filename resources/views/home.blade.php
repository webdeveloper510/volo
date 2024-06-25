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
    }

    span.opportunity-price {
        position: absolute;
        margin-top: 54px;
    }
</style>
<div class="container-field">
    <div id="wrapper">
        <div id="page-content-wrapper">
            <div class="row">
                <div class="col-4 mb-4">
                    <label class="filter-label">Team Member</label>
                    <select id="team_member" name="team_member" class="form-control">
                        <option value="" selected disabled>Select Team Member</option>
                        @foreach ($assinged_staff as $staff)
                        <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4 mb-4">
                    <label class="filter-label">Region</label>
                    <select id="region" name="region" class="form-control">
                        <option value="" selected disabled>Select Region</option>
                        @foreach($regions as $region)
                        <option value="{{ $region }}" class="form-control">{{ $region }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4 mb-4">
                    <label class="filter-label">Products</label>
                    <select id="products" name="products" class="form-control">
                        <option value="" selected disabled>Select Products</option>
                        @foreach ($products as $product)
                        <option value="{{ $product }}">{{ $product }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="row">
                    <div class="col-3">
                        <div class="inner_col">
                            <h5 class="card-title mb-2 opportunity-title">Prospecting ({{ $prospectingOpportunitiesCount }}) <span class="prospecting-opportunities">£{{ human_readable_number($prospectingOpportunitiesSum) }}</span></h5>
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
                                            <a href="javascript:void(0);" data-size="md" data-url="{{ route('lead.show',$prospectingOpportunity['id']) }}" data-bs-toggle="tooltip" title="{{__('Quick View')}}" data-ajax-popup="true" data-title="{{__('Prospecting Opportunity Details')}}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
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
                    <div class="col-3">
                        <div class="inner_col">
                            <h5 class="card-title mb-2">Discovery ({{ $discoveryOpportunitiesCount }}) <span class="discovery-opportunities">£{{ human_readable_number($discoveryOpportunitiesSum) }}</span></h5>
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
                    <div class="col-3">
                        <div class="inner_col">
                            <h5 class="card-title mb-2">Demo or Meeting ({{ $demoOrMeetingOpportunitiesCount }}) <span class="meeting-opportunities">£{{ human_readable_number($demoOrMeetingOpportunitiesSum) }}</span></h5>
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
                    <div class="col-3">
                        <div class="inner_col">
                            <h5 class="card-title mb-2">Proposal ({{ $proposalOpportunitiesCount }}) <span class="proposal-opportunities">£{{ human_readable_number($proposalOpportunitiesSum) }}</span></h5>
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

                <div class="row mt-4">
                    <div class="col-3">
                        <div class="inner_col">
                            <h5 class="card-title mb-2">Negotiation ({{ $negotiationOpportunitiesCount }}) <span class="negotiation-opportunities">£{{ human_readable_number($negotiationOpportunitiesSum) }}</span></h5>
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
                    <div class="col-3">
                        <div class="inner_col">
                            <h5 class="card-title mb-2">Awaiting Decision ({{ $awaitingDecisionOpportunitiesCount }}) <span class="awaiting-opportunities">£{{ human_readable_number($awaitingDecisionOpportunitiesSum) }}</span></h5>
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
                    <div class="col-3">
                        <div class="inner_col">
                            <h5 class="card-title mb-2">Post Purchase ({{ $postPurchaseOpportunitiesCount }}) <span class="postpurchase-opportunities">£{{ human_readable_number($postPurchaseOpportunitiesSum) }}</span></h5>
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
                                            <a href="javascript:void(0);" data-size="md" data-url="{{ route('lead.show',$postPurchaseOpportunity['id']) }}" data-bs-toggle="tooltip" title="{{__('Quick View')}}" data-ajax-popup="true" data-title="{{__('Post Purchase Opportunity Details')}}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
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
                    <div class="col-3">
                        <div class="inner_col">
                            <h5 class="card-title mb-2">Closed Won ({{ $closedWonOpportunitiesCount }}) <span class="closedwon-opportunities">£{{ human_readable_number($closedWonOpportunitiesSum) }}</span></h5>
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
        padding: 10px;
        border: 1px dotted #ccc;
        border-radius: 20px;
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
        border: 1px dotted #ccc;
        border-radius: 20px;
        margin-top: 10px;
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

<script>
    $(document).ready(function() {
        function handleFilterChange() {          
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
                    console.log(response);
                    return false;
                    // Update the dashboard with the new data
                    $('.row .col-3').each(function(index, element) {
                        var category = $(element).find('.card-title').text().split(' ')[0];
                        var data = response[category.toLowerCase() + 'Opportunities'];
                        var count = response[category.toLowerCase() + 'OpportunitiesCount'];
                        var sum = response[category.toLowerCase() + 'OpportunitiesSum'];

                        $(element).find('.card-title').text(category + ' (' + count + ')');
                        $(element).find('.' + category.toLowerCase() + '-opportunities').text('£' + sum);

                        var cardContainer = $(element).find('.scrol-card');
                        cardContainer.empty();

                        data.forEach(function(opportunity) {
                            var cardHtml = '<div class="card"><div class="card-body new_bottomcard">' +
                                '<h5 class="card-text">' + opportunity.opportunity_name +
                                '<span class="client-name">' + opportunity.primary_name + '</span></h5>' +
                                (opportunity.updated_at ? '<p>' + opportunity.updated_at + '</p>' : '') +
                                '@can("Show Lead")' +
                                '<div class="action-btn bg-warning ms-2">' +
                                '<a href="javascript:void(0);" data-size="md" data-url="{{ route("lead.show", ' + opportunity.id + ') }}" data-bs-toggle="tooltip" title="{{__("Quick View")}}" data-ajax-popup="true" data-title="{{__("Opportunity Details")}}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">' +
                                '<i class="ti ti-eye"></i></a></div>' +
                                '@endcan' +
                                '<span class="opportunity-price">' + opportunity.currency + opportunity.value_of_opportunity + '</span></div></div>';

                            cardContainer.append(cardHtml);
                        });
                    });
                },
                error: function() {
                    console.log('Error fetching data');
                }
            });
        }

        // Attach change event listeners to the filters
        $('#team_member').change(handleFilterChange);
        $('#region').change(handleFilterChange);
        $('#products').change(handleFilterChange);
    });
</script>

@endpush