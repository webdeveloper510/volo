@php
$users = \Auth::user();
// $profile = asset(Storage::url('upload/profile/'));
$profile = \App\Models\Utility::get_file('upload/profile/');
$unseenCounter = App\Models\ChMessage::where('to_id', Auth::user()->id)
->where('seen', 0)
->count();
$lang = isset($users->lang) ? $users->lang : 'en';
if ($lang == null) {
$lang = 'en';
}
$LangName = \App\Models\Languages::where('code', $lang)->first();
if (empty($LangName)) {
$LangName = new App\Models\Utility();
$LangName->fullName = 'English';
}
$logo=\App\Models\Utility::get_file('uploads/logo/');


$company_logo = \App\Models\Utility::GetLogo();

$users = \Auth::user();
$currantLang = $users->currentLanguage();
$emailTemplate = App\Models\EmailTemplate::getemailtemplate();
$defaultView = App\Models\UserDefualtView::select('module','route')->where('user_id', $users->id)->get()->pluck('route',
'module')->toArray();

$settings = App\Models\Utility::settings();
$currency_options = '';

if (isset($settings['currency_conversion']) && !empty($settings['currency_conversion'])) {
$currency_conversion = json_decode($settings['currency_conversion'], true);

foreach ($currency_conversion as $currency) {
$currency_options .= '<option value="' . $currency['conversion_rate_to_usd'] . '">' . $currency['code'] . '</option>';
}
}

@endphp

@if (isset($settings['cust_theme_bg']) && $settings['cust_theme_bg'] == 'on')
<style>
    @media screen and (max-width: 1024px) {
        li.dash-item.active a span.dash-mtext {
            color: #0e0e0e !important;

        }
    }

    .currency-select {
        padding: 8px 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        background-color: #fff;
    }

    .currency-select option {
        padding: 8px 12px;
        font-size: 14px;
    }
</style>
<div class="outer-layout">
    <header class="dash-header transprent-bg">
        @else
        <header class="dash-header">
            @endif
            <div class="new_header">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <li class="active">
                                    <button class="navbar-toggle collapse in" data-toggle="collapse" id="menu-toggle-2" style=" background: #dbdbdb;"> <span class="navbar-toggler-icon"></span>
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="mobile collapse navbar-collapse" id="navbarCollapse">
                            <div class="navbar-nav">
                                <ul class="dash-navbar">
                                    <li class="dash-item {{ \Request::route()->getName() == 'dashboard' ? ' active' : '' }}">
                                        <a href="{{ route('dashboard') }}" class="dash-link"><span class="dash-mtext">{{ __('Dashboard') }}</span></a>
                                    </li>
                                    @if(Gate::check('Manage Lead') || Gate::check('Manage Meeting') ||
                                    Gate::check('Manage User'))
                                    <li class="dash-item {{ \Request::route()->getName() == 'siteusers'||\Request::route()->getName() == 'customer.info' ||
                \Request::route()->getName() == 'event_customers'||
                \Request::route()->getName() == 'lead_customers' || \Request::route()->getName() ==
                'lead.userinfo'||\Request::route()->getName() ==
                'event.userinfo'||\Request::route()->getName()=='categ' ? ' active' : '' }}">
                                        <a href="{{route('siteusers')}}" class="dash-link">
                                            <span class="dash-mtext">{{ __('Clients') }}</span>
                                        </a>
                                    </li>

                                    @endif
                                    @if(\Auth::user()->type!='super admin')
                                    <li class="dash-item {{ \Request::route()->getName() == 'calendar-new' || \Request::route()->getName() == 'calendernew.index' ? ' active' : '' }}">
                                        <a href="{{ route('calendernew.index') }}" class="dash-link">
                                            <span class="dash-mtext">{{ __('Calendar') }}</span>
                                        </a>
                                    </li>
                                    @endif
                                    @can('Manage Lead')
                                    <li class="dash-item {{ \Request::route()->getName() == 'lead.index' || \Request::route()->getName() == 'lead.edit' ? ' active' : '' }}">
                                        <a href="{{  array_key_exists('lead',$defaultView) ? route($defaultView['lead']) : route('lead.index') }}" class="dash-link">
                                            <span class="dash-mtext">{{ __('Opportunities') }}</span>
                                        </a>
                                    </li>
                                    @endcan
                                    {{-- @can('Manage Meeting') --}}
                                    <!-- <li
                                        class="dash-item {{ \Request::route()->getName() == 'meeting.index' || \Request::route()->getName() == 'meeting.show' || \Request::route()->getName() == 'meeting.edit' ? ' active' : '' }}">
                                        <a href="{{ array_key_exists('meeting',$defaultView) ? route($defaultView['meeting']) : route('meeting.index') }}"
                                            class="dash-link">
                                            <span class="dash-mtext">{{ __('Trainings') }}</span>
                                         </a>
                                    </li> -->
                                    {{-- @endcan --}}
                                    {{-- @can('Manage Report') --}}
                                    <!-- <li class="dash-item {{ \Request::route()->getName() == 'billing' || \Request::route()->getName() == 'billing.index' ? ' active' : '' }}">
                                        <a href="{{ route('billing.index') }}" class="dash-link">
                                            <span class="dash-mtext">{{ __('Invoice') }}</span>
                                        </a>
                                    </li> -->
                                    {{-- @endcan --}}
                                    @can('Manage Payment')
                                    <li class="dash-item {{ \Request::route()->getName() =='report.leadsanalytic' ||  \Request::route()->getName() =='report.eventanalytic'|| \Request::route()->getName() =='report.customersanalytic' || \Request::route()->getName() =='report.billinganalytic'? 'active' :'' }}">
                                        <a href="{{ route('report.leadsanalytic') }}" class="dash-link">
                                            <span class="dash-mtext">{{ __('Reports') }}</span></a>
                                    </li>
                                    @endcan
                                    @can('Manage Campaign')
                                    <li class="dash-item  {{ \Request::route()->getName() == 'customer.index' ||\Request::route()->getName() ==  'campaign-list' ? ' active' : '' }}">
                                        <a href="{{ route('customer.index') }}" class="dash-link">
                                            <span class="dash-mtext">{{ __('Campaigns') }}</span></a>
                                    </li>
                                    @endcan

                                    <!-- <li
                                        class="dash-item  {{ Request::route()->getName() == 'email.index' ? 'active' : '' }}">
                                        <a href="{{ route('email.index') }}" class="dash-link">
                                            <span class="dash-mtext">{{ __('Emails') }}</span></a>
                                    </li> -->
                                    <li class="dash-item  {{ (Request::route()->getName() == 'contracts.index' || Request::route()->getName() == 'contract.show') ? 'active' : '' }}">
                                        <a href="{{route('contracts.index')}}" class="dash-link"><span class="dash-mtext">{{__('E-Sign')}}</span></a>
                                    </li>
                                    <li class="dash-item  {{ Request::route()->getName() == 'settings' ? 'active' : '' }}">
                                        <a href="{{ route('settings') }}" class="dash-link">
                                            <!-- <span class="dash-micon"><i class="ti ti-settings"></i></span> -->
                                            <span class="dash-mtext">{{ __('Settings') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="navbar-nav">
                                <select id="currency-select" class="currency-select">
                                    {!! $currency_options !!}
                                </select>
                            </div>
                            <div class="navbar-nav ">
                                <li class="dropdown dash-h-item drp-company">
                                    <a class="dash-head-link dropdown-toggle arrow-none me-0" data-target="#sidenav-main" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                        <span class="theme-avtar">
                                            @php
                                            $profile = \App\Models\Utility::get_file('upload/profile/');
                                            @endphp
                                            @if (\Request::route()->getName() == 'chats')
                                            <img class="rounded-circle" src="{{ !empty($users->avatar) ? $users->avatar : 'avatar.png' }}" style="width:30px;">
                                            @else
                                            <img class="rounded-circle" @if ($users->avatar)
                                            src="{{ $profile }}{{ !empty($users->avatar) ? $users->avatar : 'avatar.png' }}"
                                            @else src="{{ $profile . 'avatar.png' }}" @endif
                                            alt="{{ $users->name }}"style="width:30px;">
                                            @endif
                                        </span>
                                        <span class="hide-mob ms-2">{{ __('Hi') }}, {{ $users->name }}</span>
                                        <i class="ti ti-chevron-down drp-arrow nocolor hide-mob"></i>
                                    </a>
                                    <div class="dropdown-menu dash-h-dropdown">

                                        <a href="{{ route('profile') }}" class="dropdown-item">
                                            <i class="ti ti-user"></i>
                                            <span>{{ __('Profile') }}</span>
                                        </a>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();" class="dropdown-item">
                                            <i class="ti ti-power"></i>
                                            <span>{{ __('Logout') }}</span>
                                        </a>
                                        <form id="frm-logout" action="{{ route('logout') }}" method="POST" class="d-none">
                                            {{ csrf_field() }}
                                        </form>
                                    </div>
                                </li>
                            </div>

                        </div>
                    </div>
                </nav>
            </div>

            <!-- <div class="header-wrapper">
        <div class="me-auto dash-mob-drp">
            <ul class="list-unstyled" >
                <li class="dash-h-item mob-hamburger">
                    <a href="#" class="nav-link nav-link-icon sidenav-toggler" data-action="sidenav-pin"
                        data-target="#sidenav-main"></a>
                    <a href="#!" class="dash-head-link" id="mobile-collapse">
                        <div class="hamburger hamburger--arrowturn">
                            <div class="hamburger-box">
                                <div class="hamburger-inner"></div>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="dropdown dash-h-item drp-company">
                    <a class="dash-head-link dropdown-toggle arrow-none me-0" data-target="#sidenav-main"
                        data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <span class="theme-avtar">
                            @php
                                $profile = \App\Models\Utility::get_file('upload/profile/');
                            @endphp
                            @if (\Request::route()->getName() == 'chats')
                                <img class="rounded-circle"
                                    src="{{ !empty($users->avatar) ? $users->avatar : 'avatar.png' }}" style="width:30px;">
                            @else
                                <img class="rounded-circle"
                                    @if ($users->avatar) src="{{ $profile }}{{ !empty($users->avatar) ? $users->avatar : 'avatar.png' }}" @else src="{{ $profile . 'avatar.png' }}" @endif
                                                        alt="{{ $users->name }}"style="width:30px;">
                            @endif
                        </span>
                        <span class="hide-mob ms-2">{{ __('Hi') }}, {{ $users->name }}</span>
                        <i class="ti ti-chevron-down drp-arrow nocolor hide-mob"></i>
                    </a>
                    <div class="dropdown-menu dash-h-dropdown">

                        <a href="{{ route('profile') }}" class="dropdown-item">
                            <i class="ti ti-user"></i>
                            <span>{{ __('Profile') }}</span>
                        </a>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"
                            class="dropdown-item">
                            <i class="ti ti-power"></i>
                            <span>{{ __('Logout') }}</span>
                        </a>
                        <form id="frm-logout" action="{{ route('logout') }}" method="POST" class="d-none">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </li>
            </ul>
        </div>
        <div class="ms-auto">
            <ul class="list-unstyled">
            
            </ul>
        </div>
    </div> -->

        </header>

        @include('partials.admin.sidebar')

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#currency-select').on('change', function() {
            var selectedCurrency = $(this).val();

            // Parse selectedCurrency into a float number (assuming it represents a multiplier)
            var multiplier = parseFloat(selectedCurrency);

            // Extract and clean numerical values from text
            var prospecting_value = parseFloat($(".prospecting-opportunities").text().replace(/[£K]/g, ''));
            var discovery_value = parseFloat($(".discovery-opportunities").text().replace(/[£K]/g, ''));
            var meeting_value = parseFloat($(".meeting-opportunities").text().replace(/[£K]/g, ''));
            var proposal_value = parseFloat($(".proposal-opportunities").text().replace(/[£K]/g, ''));
            var negotiation_value = parseFloat($(".negotiation-opportunities").text().replace(/[£K]/g, ''));
            var awaiting_value = parseFloat($(".awaiting-opportunities").text().replace(/[£K]/g, ''));
            var postpurchase_value = parseFloat($(".postpurchase-opportunities").text().replace(/[£K]/g, ''));
            var closedwon_value = parseFloat($(".closedwon-opportunities").text().replace(/[£K]/g, ''));

            // Multiply each value by the selectedCurrency multiplier
            prospecting_value *= multiplier;
            discovery_value *= multiplier;
            meeting_value *= multiplier;
            proposal_value *= multiplier;
            negotiation_value *= multiplier;
            awaiting_value *= multiplier;
            postpurchase_value *= multiplier;
            closedwon_value *= multiplier;

            // Format values to two decimal places
            prospecting_value = prospecting_value.toFixed(2);
            discovery_value = discovery_value.toFixed(2);
            meeting_value = meeting_value.toFixed(2);
            proposal_value = proposal_value.toFixed(2);
            negotiation_value = negotiation_value.toFixed(2);
            awaiting_value = awaiting_value.toFixed(2);
            postpurchase_value = postpurchase_value.toFixed(2);
            closedwon_value = closedwon_value.toFixed(2);

            // Update HTML elements with formatted values
            $(".prospecting-opportunities").text(prospecting_value);
            $(".discovery-opportunities").text(discovery_value);
            $(".meeting-opportunities").text(meeting_value);
            $(".proposal-opportunities").text(proposal_value);
            $(".negotiation-opportunities").text(negotiation_value);
            $(".awaiting-opportunities").text(awaiting_value);
            $(".postpurchase-opportunities").text(postpurchase_value);
            $(".closedwon-opportunities").text(closedwon_value);
        });
    });
</script>