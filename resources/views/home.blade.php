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

<div class="container-field">
    <div id="wrapper">
        <div id="page-content-wrapper">
            <div class="row">
                <div class="col-4 mb-4">
                    <h4>Team Member</h4>
                    <select name="team_member" class="form-control">
                        <option value="" selected disabled>Select Team Member</option>
                        @foreach ($assinged_staff as $staff)
                        <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4 mb-4">
                    <h4>Region</h4>
                    <select name="region" class="form-control">
                        <option value="" selected disabled>Select Region</option>
                        <option value="India" class="form-control">India</option>
                        <option value="Singapore" class="form-control">Singapore</option>
                        <option value="Latin America" class="form-control">Latin America</option>
                        <option value="Mexico" class="form-control">Mexico</option>
                        <option value="Spain" class="form-control">Spain</option>
                        <option value="France" class="form-control">France</option>
                        <option value="UK" class="form-control">UK</option>
                        <option value="USA" class="form-control">USA</option>
                    </select>
                </div>
                <div class="col-4 mb-4">
                    <h4>Products</h4>
                    <select name="products" class="form-control">
                        <option value="" selected disabled>Select Products</option>
                        @foreach ($products as $product)
                        <option value="{{ $product }}">{{ $product }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="row">
                    <div class="col-3">
                        <div class="inner_col">
                            <h5 class="card-title mb-2">Prospecting ({{ $prospectingOpportunitiesCount }})</h5>
                            <h6 class="card-title mb-2">Total Value : <span></span></h6>
                            <div class="scrol-card">
                                @foreach($prospectingOpportunities as $prospectingOpportunity)
                                <div class="card">
                                    <div class="card-body new_bottomcard">
                                        <h5 class="card-text">
                                            {{ $prospectingOpportunity['opportunity_name'] }}
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
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="inner_col">
                            <h5 class="card-title mb-2">Discovery ({{ $discoveryOpportunitiesCount }})</h5>
                            <h6 class="card-title mb-2">Total Value : </h6>
                            <div class="scrol-card">
                                @foreach($discoveryOpportunities as $discoveryOpportunity)
                                <div class="card">
                                    <div class="card-body new_bottomcard">
                                        <h5 class="card-text">
                                            {{ $discoveryOpportunity['opportunity_name'] }}
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
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="inner_col">
                            <h5 class="card-title mb-2">Demo or Meeting ({{ $demoOrMeetingOpportunitiesCount }})</h5>
                            <h6 class="card-title mb-2">Total Value : </h6>
                            <div class="scrol-card">
                                @foreach($demoOrMeetingOpportunities as $demoOrMeetingOpportunity)
                                <div class="card">
                                    <div class="card-body new_bottomcard">
                                        <h5 class="card-text">
                                            {{ $demoOrMeetingOpportunity['opportunity_name'] }}
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
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="inner_col">
                            <h5 class="card-title mb-2">Proposal ({{ $proposalOpportunitiesCount }})</h5>
                            <h6 class="card-title mb-2">Total Value : </h6>
                            <div class="scrol-card">
                                @foreach($proposalOpportunities as $proposalOpportunity)
                                <div class="card">
                                    <div class="card-body new_bottomcard">
                                        <h5 class="card-text">
                                            {{ $proposalOpportunity['opportunity_name'] }}
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
                            <h5 class="card-title mb-2">Negotiation ({{ $negotiationOpportunitiesCount }})</h5>
                            <h6 class="card-title mb-2">Total Value : </h6>
                            <div class="scrol-card">
                                @foreach($negotiationOpportunities as $negotiationOpportunity)
                                <div class="card">
                                    <div class="card-body new_bottomcard">
                                        <h5 class="card-text">
                                            {{ $negotiationOpportunity['opportunity_name'] }}
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
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="inner_col">
                            <h5 class="card-title mb-2">Awaiting Decision ({{ $awaitingDecisionOpportunitiesCount }})</h5>
                            <h6 class="card-title mb-2">Total Value : </h6>
                            <div class="scrol-card">
                                @foreach($awaitingDecisionOpportunities as $awaitingDecisionOpportunity)
                                <div class="card">
                                    <div class="card-body new_bottomcard">
                                        <h5 class="card-text">
                                            {{ $awaitingDecisionOpportunity['opportunity_name'] }}
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
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="inner_col">
                            <h5 class="card-title mb-2">Post Purchase ({{ $postPurchaseOpportunitiesCount }})</h5>
                            <h6 class="card-title mb-2">Total Value : </h6>
                            <div class="scrol-card">
                                @foreach($postPurchaseOpportunities as $postPurchaseOpportunity)
                                <div class="card">
                                    <div class="card-body new_bottomcard">
                                        <h5 class="card-text">
                                            {{ $postPurchaseOpportunity['opportunity_name'] }}
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
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="inner_col">
                            <h5 class="card-title mb-2">Closed Won ({{ $closedWonOpportunitiesCount }})</h5>
                            <h6 class="card-title mb-2">Total Value : </h6>
                            <div class="scrol-card">
                                @foreach($closedWonOpportunities as $closedWonOpportunity)
                                <div class="card">
                                    <div class="card-body new_bottomcard">
                                        <h5 class="card-text">
                                            {{ $closedWonOpportunity['opportunity_name'] }}
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
        font-size: 16px;
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

    .inner_col {
        min-height: 320px;
    }

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
@endpush