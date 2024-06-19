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
                            <h5 class="card-title mb-2">Prospecting ({{ $activeLeadsCount }})</h5>
                            <h6 class="card-title mb-2">Total Value : <span></span></h6>
                            <div class="scrol-card">
                                @foreach($activeLeads as $lead)
                                <div class="card">
                                    <div class="card-body new_bottomcard">
                                        <h5 class="card-text">{{ $lead['leadname'] }}
                                            <span>({{ $lead['type'] }})</span>
                                        </h5>

                                        @if($lead['start_date'] == $lead['end_date'])
                                        <p>{{ Carbon\Carbon::parse($lead['start_date'])->format('M d')}}</p>
                                        @else
                                        <p>{{ Carbon\Carbon::parse($lead['start_date'])->format('M d')}} -
                                            {{ \Auth::user()->dateFormat($lead['end_date'])}}
                                        </p>
                                        @endif
                                        @can('Show Lead')
                                        <div class="action-btn bg-warning ms-2">
                                            <a href="javascript:void(0);" data-size="md" data-url="{{ route('lead.show',$lead['id']) }}" data-bs-toggle="tooltip" title="{{__('Quick View')}}" data-ajax-popup="true" data-title="{{__('Lead Details')}}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
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
                            <h5 class="card-title mb-2">Discovery ({{ $activeEventCount }})</h5>
                            <h6 class="card-title mb-2">Total Value : </h6>
                            <div class="scrol-card">
                                <div class="card">
                                    <div class="card-body new_bottomcard">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="inner_col">
                            <h5 class="card-title mb-2">Demo or Meeting (N)</h5>
                            <h6 class="card-title mb-2">Total Value : </h6>
                            <div class="scrol-card">
                                <div class="card">
                                    <div class="card-body">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="inner_col">
                            <h5 class="card-title mb-2">Proposal(1)</h5>
                            <h6 class="card-title mb-2">Total Value : </h6>
                            <div class="scrol-card">
                                <div class="card">
                                    <div class="card-body">
                                      
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-3">
                        <div class="inner_col">
                            <h5 class="card-title mb-2">Negotiation (0)</h5>
                            <h6 class="card-title mb-2">Total Value : </h6>
                            <div class="scrol-card">
                                <div class="card">
                                    <div class="card-body new_bottomcard">

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="inner_col">
                            <h5 class="card-title mb-2">Awaiting Decision (0)</h5>
                            <h6 class="card-title mb-2">Total Value : </h6>
                            <div class="scrol-card">
                                <div class="card">
                                    <div class="card-body new_bottomcard">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="inner_col">
                            <h5 class="card-title mb-2">Post Purchase (0)</h5>
                            <h6 class="card-title mb-2">Total Value : </h6>
                            <div class="scrol-card">
                                <div class="card">
                                    <div class="card-body">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="inner_col">
                            <h5 class="card-title mb-2">Closed Won (0)</h5>
                            <h6 class="card-title mb-2">Total Value : </h6>
                            <div class="scrol-card">
                                <div class="card">
                                    <div class="card-body">

                                    </div>
                                </div>
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