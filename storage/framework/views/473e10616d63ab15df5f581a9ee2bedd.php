<?php
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

?>

<?php if(isset($settings['cust_theme_bg']) && $settings['cust_theme_bg'] == 'on'): ?>
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
        <?php else: ?>
        <header class="dash-header">
            <?php endif; ?>
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
                                    <li class="dash-item <?php echo e(\Request::route()->getName() == 'dashboard' ? ' active' : ''); ?>">
                                        <a href="<?php echo e(route('dashboard')); ?>" class="dash-link"><span class="dash-mtext"><?php echo e(__('Dashboard')); ?></span></a>
                                    </li>
                                    <?php if(Gate::check('Manage Lead') || Gate::check('Manage Meeting') ||
                                    Gate::check('Manage User')): ?>
                                    <li class="dash-item <?php echo e(\Request::route()->getName() == 'siteusers'||\Request::route()->getName() == 'customer.info' ||
                \Request::route()->getName() == 'event_customers'||
                \Request::route()->getName() == 'lead_customers' || \Request::route()->getName() ==
                'lead.userinfo'||\Request::route()->getName() ==
                'event.userinfo'||\Request::route()->getName()=='categ' ? ' active' : ''); ?>">
                                        <a href="<?php echo e(route('siteusers')); ?>" class="dash-link">
                                            <span class="dash-mtext"><?php echo e(__('Clients')); ?></span>
                                        </a>
                                    </li>

                                    <?php endif; ?>
                                    <?php if(\Auth::user()->type!='super admin'): ?>
                                    <li class="dash-item <?php echo e(\Request::route()->getName() == 'calendar-new' || \Request::route()->getName() == 'calendernew.index' ? ' active' : ''); ?>">
                                        <a href="<?php echo e(route('calendernew.index')); ?>" class="dash-link">
                                            <span class="dash-mtext"><?php echo e(__('Calendar')); ?></span>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Lead')): ?>
                                    <li class="dash-item <?php echo e(\Request::route()->getName() == 'lead.index' || \Request::route()->getName() == 'lead.edit' ? ' active' : ''); ?>">
                                        <a href="<?php echo e(array_key_exists('lead',$defaultView) ? route($defaultView['lead']) : route('lead.index')); ?>" class="dash-link">
                                            <span class="dash-mtext"><?php echo e(__('Opportunities')); ?></span>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                    
                                    <!-- <li
                                        class="dash-item <?php echo e(\Request::route()->getName() == 'meeting.index' || \Request::route()->getName() == 'meeting.show' || \Request::route()->getName() == 'meeting.edit' ? ' active' : ''); ?>">
                                        <a href="<?php echo e(array_key_exists('meeting',$defaultView) ? route($defaultView['meeting']) : route('meeting.index')); ?>"
                                            class="dash-link">
                                            <span class="dash-mtext"><?php echo e(__('Trainings')); ?></span>
                                         </a>
                                    </li> -->
                                    
                                    
                                    <!-- <li class="dash-item <?php echo e(\Request::route()->getName() == 'billing' || \Request::route()->getName() == 'billing.index' ? ' active' : ''); ?>">
                                        <a href="<?php echo e(route('billing.index')); ?>" class="dash-link">
                                            <span class="dash-mtext"><?php echo e(__('Invoice')); ?></span>
                                        </a>
                                    </li> -->
                                    
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Payment')): ?>
                                    <li class="dash-item <?php echo e(\Request::route()->getName() =='report.leadsanalytic' ||  \Request::route()->getName() =='report.eventanalytic'|| \Request::route()->getName() =='report.customersanalytic' || \Request::route()->getName() =='report.billinganalytic'? 'active' :''); ?>">
                                        <a href="<?php echo e(route('report.leadsanalytic')); ?>" class="dash-link">
                                            <span class="dash-mtext"><?php echo e(__('Reports')); ?></span></a>
                                    </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Campaign')): ?>
                                    <li class="dash-item  <?php echo e(\Request::route()->getName() == 'customer.index' ||\Request::route()->getName() ==  'campaign-list' ? ' active' : ''); ?>">
                                        <a href="<?php echo e(route('customer.index')); ?>" class="dash-link">
                                            <span class="dash-mtext"><?php echo e(__('Campaigns')); ?></span></a>
                                    </li>
                                    <?php endif; ?>

                                    <!-- <li
                                        class="dash-item  <?php echo e(Request::route()->getName() == 'email.index' ? 'active' : ''); ?>">
                                        <a href="<?php echo e(route('email.index')); ?>" class="dash-link">
                                            <span class="dash-mtext"><?php echo e(__('Emails')); ?></span></a>
                                    </li> -->
                                    <li class="dash-item  <?php echo e((Request::route()->getName() == 'contracts.index' || Request::route()->getName() == 'contract.show') ? 'active' : ''); ?>">
                                        <a href="<?php echo e(route('contracts.index')); ?>" class="dash-link"><span class="dash-mtext"><?php echo e(__('E-Sign')); ?></span></a>
                                    </li>
                                    <li class="dash-item  <?php echo e(Request::route()->getName() == 'objective-tracker' ? 'active' : ''); ?>">
                                        <a href="<?php echo e(route('objective-tracker')); ?>" class="dash-link">
                                            <span class="dash-mtext"><?php echo e(__('Objective Tracker')); ?></span>
                                        </a>
                                    </li>
                                    <li class="dash-item  <?php echo e(Request::route()->getName() == 'settings' ? 'active' : ''); ?>">
                                        <a href="<?php echo e(route('settings')); ?>" class="dash-link">
                                            <!-- <span class="dash-micon"><i class="ti ti-settings"></i></span> -->
                                            <span class="dash-mtext"><?php echo e(__('Settings')); ?></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="navbar-nav">
                                <select id="currency-select" class="currency-select">
                                    <?php echo $currency_options; ?>

                                </select>
                            </div>
                            <div class="navbar-nav ">
                                <li class="dropdown dash-h-item drp-company">
                                    <a class="dash-head-link dropdown-toggle arrow-none me-0" data-target="#sidenav-main" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                        <span class="theme-avtar">
                                            <?php
                                            $profile = \App\Models\Utility::get_file('upload/profile/');
                                            ?>
                                            <?php if(\Request::route()->getName() == 'chats'): ?>
                                            <img class="rounded-circle" src="<?php echo e(!empty($users->avatar) ? $users->avatar : 'avatar.png'); ?>" style="width:30px;">
                                            <?php else: ?>
                                            <img class="rounded-circle" <?php if($users->avatar): ?>
                                            src="<?php echo e($profile); ?><?php echo e(!empty($users->avatar) ? $users->avatar : 'avatar.png'); ?>"
                                            <?php else: ?> src="<?php echo e($profile . 'avatar.png'); ?>" <?php endif; ?>
                                            alt="<?php echo e($users->name); ?>"style="width:30px;">
                                            <?php endif; ?>
                                        </span>
                                        <span class="hide-mob ms-2"><?php echo e(__('Hi')); ?>, <?php echo e($users->name); ?></span>
                                        <i class="ti ti-chevron-down drp-arrow nocolor hide-mob"></i>
                                    </a>
                                    <div class="dropdown-menu dash-h-dropdown">

                                        <a href="<?php echo e(route('profile')); ?>" class="dropdown-item">
                                            <i class="ti ti-user"></i>
                                            <span><?php echo e(__('Profile')); ?></span>
                                        </a>
                                        <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();" class="dropdown-item">
                                            <i class="ti ti-power"></i>
                                            <span><?php echo e(__('Logout')); ?></span>
                                        </a>
                                        <form id="frm-logout" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                            <?php echo e(csrf_field()); ?>

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
                            <?php
                                $profile = \App\Models\Utility::get_file('upload/profile/');
                            ?>
                            <?php if(\Request::route()->getName() == 'chats'): ?>
                                <img class="rounded-circle"
                                    src="<?php echo e(!empty($users->avatar) ? $users->avatar : 'avatar.png'); ?>" style="width:30px;">
                            <?php else: ?>
                                <img class="rounded-circle"
                                    <?php if($users->avatar): ?> src="<?php echo e($profile); ?><?php echo e(!empty($users->avatar) ? $users->avatar : 'avatar.png'); ?>" <?php else: ?> src="<?php echo e($profile . 'avatar.png'); ?>" <?php endif; ?>
                                                        alt="<?php echo e($users->name); ?>"style="width:30px;">
                            <?php endif; ?>
                        </span>
                        <span class="hide-mob ms-2"><?php echo e(__('Hi')); ?>, <?php echo e($users->name); ?></span>
                        <i class="ti ti-chevron-down drp-arrow nocolor hide-mob"></i>
                    </a>
                    <div class="dropdown-menu dash-h-dropdown">

                        <a href="<?php echo e(route('profile')); ?>" class="dropdown-item">
                            <i class="ti ti-user"></i>
                            <span><?php echo e(__('Profile')); ?></span>
                        </a>
                        <a href="<?php echo e(route('logout')); ?>"
                            onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"
                            class="dropdown-item">
                            <i class="ti ti-power"></i>
                            <span><?php echo e(__('Logout')); ?></span>
                        </a>
                        <form id="frm-logout" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                            <?php echo e(csrf_field()); ?>

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

        <?php echo $__env->make('partials.admin.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#currency-select').on('change', function() {
            var selectedCurrencyVal = $(this).val();
            var selectedCurrencyText = $(this).find('option:selected').text();

            // Determine the multiplier based on the selected currency
            var multiplier;
            if (selectedCurrencyText === 'GBP') {
                multiplier = 1; // Set multiplier to 1 for GBP
            } else {
                multiplier = parseFloat(selectedCurrencyVal); // Use the selected currency value as the multiplier
            }

            // Function to extract and convert value from "X.XK" format
            function extractAndConvertValue(id) {
                var value = $('#' + id).val();
                var numericValue = parseFloat(value.replace(/[^\d.]/g, ''));
                return numericValue;
            }

            // Extract numeric values from hidden input fields
            var prospecting_value = extractAndConvertValue("prospecting-opportunities-sum");
            var discovery_value = extractAndConvertValue("discovery-opportunities-sum");
            var meeting_value = extractAndConvertValue("meeting-opportunities-sum");
            var proposal_value = extractAndConvertValue("proposal-opportunities-sum");
            var negotiation_value = extractAndConvertValue("negotiation-opportunities-sum");
            var awaiting_value = extractAndConvertValue("awaiting-opportunities-sum");
            var postpurchase_value = extractAndConvertValue("postpurchase-opportunities-sum");
            var closedwon_value = extractAndConvertValue("closedwon-opportunitie-sum");

            // Multiply each value by the selected currency multiplier
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

            // Determine currency symbol based on selected currency text
            var currencySymbol;
            switch (selectedCurrencyText) {
                case 'USD':
                    currencySymbol = '$';
                    break;
                case 'EUR':
                    currencySymbol = '€';
                    break;
                case 'GBP':
                    currencySymbol = '£';
                    break;
                default:
                    currencySymbol = '£';
                    break;
            }

            // Update HTML elements with formatted values and currency symbol
            $(".prospecting-opportunities").text(currencySymbol + prospecting_value + "K");
            $(".discovery-opportunities").text(currencySymbol + discovery_value + "K");
            $(".meeting-opportunities").text(currencySymbol + meeting_value + "K");
            $(".proposal-opportunities").text(currencySymbol + proposal_value + "K");
            $(".negotiation-opportunities").text(currencySymbol + negotiation_value + "K");
            $(".awaiting-opportunities").text(currencySymbol + awaiting_value + "K");
            $(".postpurchase-opportunities").text(currencySymbol + postpurchase_value + "K");
            $(".closedwon-opportunities").text(currencySymbol + closedwon_value + "K");
        });
    });
</script><?php /**PATH C:\xampp\htdocs\volo\resources\views/partials/admin/header.blade.php ENDPATH**/ ?>