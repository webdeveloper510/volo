<?php
$settings = App\Models\Utility::settings();
$category = explode(',', $settings['campaign_type']);
?>

<div id="sidebar-wrapper">
    <div class="card">
        <div class="list-group list-group-flush sidebar-nav nav-pills nav-stacked" id="menu">
            <div class="navbar-brand-box loadthisimage">
                <a href="#" class="navbar-brand">
                    <img src="{{$logo.'new-volo-transparent-bg.png'}}" alt="{{ config('app.name', 'The Sector Eight') }}" class="logo logo-lg nav-sidebar-logo" />
                </a>
            </div>


            <div class="scrollbar">
                @if(\Request::route()->getName() == 'lead.review')
                <a href="#useradd-1" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><i class="ti ti-home-2"></i></span>
                    <span class="dash-mtext">{{ __('Review Lead') }}</span>
                    <!-- <div class="float-end"><i class="ti ti-chevron-right"></i></div> -->
                </a>
                @endif
                @if(\Request::route()->getName() == 'dashboard')
                <a href="#useradd-1" class="list-group-item list-group-item-action {{ \Request::route()->getName() == 'dashboard' ? ' active' : '' }}"><span class="fa-stack fa-lg pull-left"><i class="ti ti-home-2"></i></span>
                    <span class="dash-mtext">{{ __('Dashboard') }} </span></a>
                </a>
                @endif
                @if(\Request::route()->getName() == 'settings')
                @can('Manage Email')
                <a href="#company-email-setting" class="list-group-item list-group-item-action" data-id="collapse16" onclick="showAccordion('collapse16')">
                    <span class="fa-stack fa-lg pull-left"><i class="fa fa-envelope"></i></span>
                    <span class="dash-mtext">{{ __('Email') }}</span>
                </a>

                <!-- <a href="javascript:void(0);" class="list-group-item list-group-item-action" data-id="collapse16"
                    onclick="toggleCollapse(this.getAttribute('data-id'))">
                    <span class="fa-stack fa-lg pull-left"><i class="fa fa-envelope  "></i></span>
                    <span class="dash-mtext">{{ __('Email') }} </span></a>
                </a> -->
                <a href="#twilio-settings" class="list-group-item list-group-item-action border-0" onclick="showAccordion('collapse15')">
                    <span class="fa-stack fa-lg pull-left"><i class="fa fa-sms"></i></span>
                    <span class="dash-mtext">{{ __('Twilio') }}</span>
                </a>
                @endcan
                @if (\Auth::user()->type == 'super admin')
                <a href="#recaptcha-settings" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><i class="fa fa-cog"></i></span>
                    <span class="dash-mtext">{{ __('Recaptcha') }}</span>
                </a>
                @endif
                @can('Manage User')
                <a href="#user-settings" class="list-group-item list-group-item-action border-0" onclick="showAccordion('collapse17')">
                    <span class="fa-stack fa-lg pull-left"><i class="fa fa-user"></i></span>
                    <span class="dash-mtext">{{ __('Team Member') }}</span>
                </a>
                @endcan
                @can('Manage Nda')
                <a href="#proposal-settings" class="list-group-item list-group-item-action border-0" onclick="showAccordion('collapse188')">
                    <span class="fa-stack fa-lg pull-left"><i class="fa fa-user"></i></span>
                    <!-- <span class="dash-mtext">{{ __('Proposal') }}</span> -->
                    <span class="dash-mtext">{{ __('NDA') }}</span>
                </a>
                @endcan
                @can('Manage Role')
                <a href="#role-settings" class="list-group-item list-group-item-action border-0" onclick="showAccordion('collapse18')">
                    <span class="fa-stack fa-lg pull-left"><img src="{{asset('icons/user.png')}}" alt="" style="    width: 22px;"></span>
                    <span class="dash-mtext">{{ __('Role') }}</span>
                </a>
                @endif
                @if(Gate::check('Manage Lead') || Gate::check('Manage Meeting'))
                <a href="#eventtype-settings" class="list-group-item list-group-item-action border-0" onclick="showAccordion('collapse19')">
                    <span class="fa-stack fa-lg pull-left"><i class="fa fa-tasks"></i></span>
                    <span class="dash-mtext">{{ __('Products') }}</span>
                </a>

                <!-- <a href="#venue-settings" class="list-group-item list-group-item-action border-0"  onclick="showAccordion('collapse19')">
                    <span class="fa-stack fa-lg pull-left"><img src="{{asset('icons/location.png')}}" alt=""
                            style="    width: 22px;"></span>
                    <span class="dash-mtext">{{ __('Venue') }}</span>
                </a>
                <a href="#function-settings" class="list-group-item list-group-item-action border-0"  onclick="showAccordion('collapse19')">
                    <span class="fa-stack fa-lg pull-left"><img src="{{asset('icons/restaurant.png')}}" alt=""
                            style="    width: 22px;"></span>
                    <span class="dash-mtext">{{ __('Function') }}</span>
                </a>
                <a href="#bar-settings" class="list-group-item list-group-item-action border-0" onclick="showAccordion('collapse19')">
                    <span class="fa-stack fa-lg pull-left"><i class="fas fa-cocktail"></i></span>
                    <span class="dash-mtext">{{ __('Bar') }}</span>
                </a>
                <a href="#floor-plan-setting" class="list-group-item list-group-item-action border-0"  onclick="showAccordion('collapse19')">
                    <span class="fa-stack fa-lg pull-left"><img src="{{asset('icons/roadmap.png')}}" alt=""
                            style="    width: 22px;"></span>
                    <span class="dash-mtext">{{ __('Setup') }}</span>
                </a> -->
                @endif
                @can('Manage User')
                <a href="#billing-setting" class="list-group-item list-group-item-action border-0" onclick="showAccordion('collapse20')">
                    <span class="fa-stack fa-lg pull-left"><i class="fas fa-file-invoice"></i></span>
                    <span class="dash-mtext">{{ __('Clients') }}</span>
                </a>
                @endcan
                @if (\Auth::user()->type == 'owner' || \Auth::user()->type == 'admin' || \Auth::user()->type == 'super adminc')
                <!-- <a href="#buffer-settings" class="list-group-item list-group-item-action border-0" onclick="showAccordion('collapse21')">
                    <span class="fa-stack fa-lg pull-left"><img src="{{asset('icons/loading.png')}}" alt="" style="width: 22px;"></span>
                    <span class="dash-mtext">{{ __('Buffer') }}</span>
                </a> -->
                <a href="#add-signature" class="list-group-item list-group-item-action border-0" onclick="showAccordion('collapse22')">
                    <span class="fa-stack fa-lg pull-left"><img src="{{asset('icons/signature.png')}}" alt="" style="    width: 22px;"></span>
                    <span class="dash-mtext">{{ __('Authorised Signature') }}</span>
                </a>

                @endif
                @endif
                @if(\Request::route()->getName() == 'billing.index')
                <a href="#useradd-1" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"><i class="fas fa-file-invoice"></i></span>
                    <span class="dash-mtext">{{ __('Invoice') }} </span></a>
                @endif
                @if(\Request::route()->getName() == 'calendernew.index')
                <a href="#useradd-1" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"><i class="ti ti-calendar"></i></span>
                    <span class="dash-mtext">{{ __('Calender') }} </span></a>
                @endif

                @if(\Request::route()->getName() == 'objective.index')
                <a href="{{route('objective.index')}}" class="list-group-item list-group-item-action {{ \Request::route()->getName() == 'objective.index' ?'active' : ''}}">
                    <span class="dash-mtext">{{ __('Objective Tracker') }}</span>
                </a>
                @endif

                @if(\Request::route()->getName() == 'billing.create')
                <a href="#useradd-1" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"><i class="fas fa-file-invoice"></i></span>
                    <span class="dash-mtext">{{ __('Create Invoice') }} </span></a>
                @endif
                @if(\Request::route()->getName() == 'customer.index' || \Request::route()->getName() == 'campaign-list')
                <a href="{{route('customer.index')}}" class="list-group-item list-group-item-action {{ \Request::route()->getName() == 'customer.index' ?'active' : ''}}">
                    <span class="fa-stack fa-lg pull-left"><i class="fa fa-bullhorn"></i></span>
                    <span class="dash-mtext">{{ __('Campaign') }} </span></a>
                <a href="{{route('campaign-list')}}" class="list-group-item list-group-item-action {{ \Request::route()->getName() == 'campaign-list' ?'active' : ''}}">
                    <span class="fa-stack fa-lg pull-left"><i class="fa fa-list"></i></span>
                    <span class="dash-mtext">{{ __('View Campaigns') }} </span></a>
                @endif

                @if( \Request::route()->getName() == 'siteusers' ||
                \Request::route()->getName() == 'categories.index' ? 'active' : '')

                <!-- ( \Request::route()->getName() == 'customer.info' || \Request::route()->getName() == 'lead.index' ||
                \Request::route()->getName() == 'event_customers' || \Request::route()->getName() == 'siteusers' ||
                \Request::route()->getName() == 'lead_customers' || \Request::route()->getName() == 'lead.userinfo' ||
                \Request::route()->getName() =='event.userinfo' || \Request::route()->getName()=='categ' ||
                \Request::route()->getName() == 'categories.index' ? 'active' : '') -->
                <a href="{{ route('siteusers') }}" class="list-group-item list-group-item-action {{ \Request::route()->getName() == 'siteusers' ?'active' : ''}}">
                    <span class="fa-stack fa-lg pull-left"><i class="ti ti-users"></i></span>
                    <span class="dash-mtext">{{ __('All Clients') }} </span></a>

                <!-- <a href="{{route('event_customers')}}" class="list-group-item list-group-item-action {{ \Request::route()->getName() == 'event_customers' ?'active' : ''}}">
                    <span class="fa-stack fa-lg pull-left"><i class="ti ti-user" title="Event Clients"></i></span>
                    <span class="dash-mtext">{{ __('Trainings') }} </span></a> -->
                <!-- <a href="{{route('lead_customers')}}" class="list-group-item list-group-item-action {{ \Request::route()->getName() == 'lead_customers' ?'active' : ''}}">
                    <span class="fa-stack fa-lg pull-left"><i class="ti ti-user" title="Lead Clients"></i></span>
                    <span class="dash-mtext">{{ __('Leads') }} </span></a> -->

                <a href="{{route('categories.index')}}" class="list-group-item list-group-item-action {{ \Request::route()->getName() == 'categories.index' ?'active' : ''}}">
                    <span class="fa-stack fa-lg pull-left"><i class="ti ti-user" title="Add Category"></i></span>
                    <span class="dash-mtext">{{ __('Settings') }} </span></a>

                <!-- @if(isset($category) && !empty($category))
                @foreach($category as $cat)
                <a href="{{route('categ', $cat)}}" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"><i class="ti ti-user" title="{{$cat}}"></i></span>
                    <span class="dash-mtext">{{ $cat }} </span></a>
                @endforeach
                @endif -->
                @endif

                @if(\Request::route()->getName() == 'meeting.index')
                <a href="#useradd-1" class="list-group-item list-group-item-action"><span class="fa-stack fa-lg pull-left"><i class="fa fa-tasks"></i></span>
                    <span class="dash-mtext">{{ __('Events') }} </span></a>

                </a>
                @endif
                @if( \Request::route()->getName() == 'report.index' || \Request::route()->getName() == 'report.show' ||
                \Request::route()->getName() == 'report.edit' || \Request::route()->getName() == 'report.leadsanalytic'
                ||
                \Request::route()->getName() == 'report.eventanalytic' || \Request::route()->getName() ==
                'report.customersanalytic' || \Request::route()->getName() == 'report.billinganalytic' ? ' active ' :
                '')

                <a href="{{ route('report.leadsanalytic') }}" class="list-group-item list-group-item-action {{ \Request::route()->getName() == 'report.leadsanalytic' ?'active' : ''}}"><span class="fa-stack fa-lg pull-left"><i class="fas fa-address-card"></i></span>
                    <span class="dash-mtext">{{ __('Leads') }} </span></a>

                </a>

                <a href="{{ route('report.eventanalytic') }}" class="list-group-item list-group-item-action {{ \Request::route()->getName() == 'report.eventanalytic' ?'active' : ''}}"><span class="fa-stack fa-lg pull-left"><i class="fa fa-tasks"></i></span>
                    <span class="dash-mtext">{{ __('Trainings') }} </span></a>

                </a>
                <a href="{{ route('report.customersanalytic') }}" class="list-group-item list-group-item-action {{ \Request::route()->getName() == 'report.customersanalytic' ?'active' : ''}}"><span class="fa-stack fa-lg pull-left"><i class="fa fa-users"></i></span>
                    <span class="dash-mtext">{{ __('Clients') }} </span></a>

                </a>
                <a href="{{ route('report.billinganalytic') }}" class="list-group-item list-group-item-action {{ \Request::route()->getName() == 'report.billinganalytic' ?'active' : ''}}"><span class="fa-stack fa-lg pull-left"><i class="fas fa-file-invoice"></i></span>
                    <span class="dash-mtext">{{ __('Financial') }} </span></a>

                </a>
                @endif
                @if(\Request::route()->getName() == 'meeting.create' ||\Request::route()->getName() == 'meeting.edit' )
                <a href="#useradd-1" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"><i class="fa fa-tasks"></i></span>
                    <span class="dash-mtext">{{ __('Event Details') }} </span></a>
                <!-- <a href="#event-details" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"><i class="fa fa-info"></i></span>
                    <span class="dash-mtext">{{ __('Event Details') }} </span></a>
                <a href="#special_req" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"></span>
                    <span class="dash-mtext">{{ __('Special Requirements') }} </span></a>
                <a href="#other_info" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"></span>
                    <span class="dash-mtext">{{ __('Other Information') }} </span></a> -->
                @endif
                @if(\Request::route()->getName() == 'meeting.review' )
                <a href="#useradd-1" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"><i class="fa fa-tasks"></i></span>
                    <span class="dash-mtext">{{ __('Review Event') }} </span></a>
                @endif

                @if(\Request::route()->getName() == 'lead.index')
                @can('Manage Lead')
                <a href="{{ route('lead.index') }}" class="list-group-item list-group-item-action {{ \Request::route()->getName() == 'lead.index' ? 'active' : ''}}">
                    <span class="fa-stack fa-lg pull-left"><i class="fas fa-address-card"></i></span>
                    <span class="dash-mtext">{{ __('Opportunities') }} </span>
                </a>
                @endcan
                @endif

                @if(\Request::route()->getName() == 'lead.index')
                @can('Manage Email')
                <a href="{{ route('email.index') }}" class="list-group-item list-group-item-action {{ \Request::route()->getName() == 'email.index' ? 'active' : ''}}">
                    <span class="fa-stack fa-lg pull-left"><i class="fas fa-envelope"></i></span>
                    <span class="dash-mtext">{{ __('Emails') }} </span>
                </a>
                @endcan
                @endif

                @if(\Request::route()->getName() == 'lead.edit' )
                <a href="#useradd-1" class="list-group-item list-group-item-action"><span class="fa-stack fa-lg pull-left"><i class="fas fa-address-card"></i></span>
                    <span class="dash-mtext">{{ __('Edit Opportunity') }} </span></a>
                </a>
                @endif
                @if(\Request::route()->getName() == 'lead.info')
                <a href="#useradd-1" class="list-group-item list-group-item-action"><span class="fa-stack fa-lg pull-left"><i class="fas fa-address-card"></i></span>
                    <span class="dash-mtext">{{ __('Opportunity') }} </span></a>
                </a>
                @endif

                <!-- @if(\Request::route()->getName() == 'contracts.index' ||\Request::route()->getName() == 'contracts.create')
                <a href="#useradd-1" class="list-group-item list-group-item-action"><span class="fa-stack fa-lg pull-left"><i class="fa fa-file-contract"></i></span>
                    <span class="dash-mtext">{{ __('Contracts') }} </span></a>
                </a>
                @endif -->
                <!-- <li
                    class="dash-item {{ \Request::route()->getName() == 'calendar' || \Request::route()->getName() == 'calendar.index' ? ' active' : '' }}">
                    <a href="{{ route('calendar.index') }}" class="dash-link">
                        <span class="dash-micon"><i class="far fa-calendar-alt"></i></span><span
                            class="dash-mtext">{{ __('Calendar') }}</span>
                    </a>
                </li> -->
                <!-- @if (\Request::route()->getName() == 'contracts.index')
                <a href="{{route('contracts.index')}}" class="list-group-item list-group-item-action active">
                    <span class="fa-stack fa-lg pull-left"></span>
                    <span class="dash-mtext">{{ __('E-Sign') }} </span></a>
                </a>
                @endif -->
                @if(\Request::route()->getName() == 'contracts.index' || \Request::route()->getName() ==
                'contracts.create' || \Request::route()->getName() == 'contracts.new_contract')
                <a href="#useradd-1" class="list-group-item list-group-item-action {{ \Request::route()->getName() == 'contracts.index' || \Request::route()->getName() == 'contracts.create' || \Request::route()->getName() == 'contracts.new_contract' ? ' active' : '' }}"><span class="fa-stack fa-lg pull-left"></span>
                    <span class="dash-mtext">{{ __('E-Sign') }} </span></a>
                </a>
                @endif
            </div>
        </div>
    </div>
</div>
<script>
    function showAccordion(dataId) {
        console.log(dataId);
        $('.accordion-collapse').css('display', 'none')
        if ($('#' + dataId).hasClass('show')) {
            $('#' + dataId).css('display', 'none');
            $('#' + dataId).removeClass('show');
        } else {
            $('#' + dataId).css('display', 'block');
            $('#' + dataId).addClass('show');
        }
    }
</script>

<script>
    $(document).ready(function() {
        setTimeout(function() {
            $('.loadthisimage img').each(function() {
                var $this = $(this);
                $this.attr('src', $this.attr('src'));
            });
        }, 2000);
    });
</script>