<?php $__env->startSection('breadcrumb'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?>
<?php echo e(__('Home')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
<?php echo e(__('Dashboard')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

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
</style>
<div class="container-field">
    <div id="wrapper">
        <div id="page-content-wrapper">
            <div class="row">
                <div class="col-4 mb-4">
                    <label class="filter-label">Team Member</label>
                    <select id="team_member" name="team_member[]" class="form-control" multiple>
                        <option value="" disabled>Select Team Member</option>
                        <?php $__currentLoopData = $assinged_staff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($staff->id); ?>"><?php echo e($staff->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <option value="clear_team_member_filter">Clear Filter</option>
                    </select>
                </div>
                <div class="col-4 mb-4">
                    <label class="filter-label">Region</label>
                    <select id="region" name="region[]" class="form-control" multiple>
                        <option value="" disabled>Select Region</option>
                        <?php $__currentLoopData = $regions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $region): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($region); ?>"><?php echo e($region); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <option value="clear_region_filter">Clear Filter</option>
                    </select>
                </div>
                <div class="col-4 mb-4">
                    <label class="filter-label">Products</label>
                    <select id="products" name="products[]" class="form-control" multiple>
                        <option value="" disabled>Select Products</option>
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($product); ?>"><?php echo e($product); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <option value="clear_products_filter">Clear Filter</option>
                    </select>
                </div>

                <div class="row">
                    <div class="col-3 prospecting-div">
                        <div class="inner_col">
                            <h5 class="card-title mb-2 opportunity-title">Prospecting (<?php echo e($prospectingOpportunitiesCount); ?>) <span class="prospecting-opportunities">$<?php echo e(human_readable_number($prospectingOpportunitiesSum)); ?></span></h5>
                            <input type="hidden" id="prospecting-opportunities-sum" name="prospecting-opportunities-sum" value="<?php echo e(human_readable_number($prospectingOpportunitiesSum)); ?>">
                            <div class="scrol-card">
                                <?php $__currentLoopData = $prospectingOpportunities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prospectingOpportunity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="card">
                                    <div class="card-body new_bottomcard">
                                        <h5 class="card-text">
                                            <?php echo e($prospectingOpportunity['opportunity_name']); ?>

                                            <span class="client-name"><?php echo e($prospectingOpportunity['primary_name']); ?></span>
                                        </h5>
                                        <?php if($prospectingOpportunity['updated_at']): ?>
                                        <p><?php echo e(Carbon\Carbon::parse($prospectingOpportunity['updated_at'])->format('M d')); ?></p>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Show Lead')): ?>
                                        <div class="action-btn bg-warning ms-2">
                                            <a href="javascript:void(0);" data-size="md" data-url="<?php echo e(route('lead.show',$prospectingOpportunity['id'])); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Quick View')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Prospecting Opportunity Details')); ?>" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                        </div>
                                        <?php endif; ?>
                                        <span class="opportunity-price"><?php echo e(getCurrencySign($prospectingOpportunity['currency'])); ?><?php echo e($prospectingOpportunity['value_of_opportunity']); ?></span>
                                    </div>
                                </div>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 discovery-div">
                        <div class="inner_col">
                            <h5 class="card-title mb-2">Discovery (<?php echo e($discoveryOpportunitiesCount); ?>) <span class="discovery-opportunities">$<?php echo e(human_readable_number($discoveryOpportunitiesSum)); ?></span></h5>
                            <input type="hidden" id="discovery-opportunities-sum" name="discovery-opportunities-sum" value="<?php echo e(human_readable_number($discoveryOpportunitiesSum)); ?>">
                            <div class="scrol-card">
                                <?php $__currentLoopData = $discoveryOpportunities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $discoveryOpportunity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="card">
                                    <div class="card-body new_bottomcard">
                                        <h5 class="card-text">
                                            <?php echo e($discoveryOpportunity['opportunity_name']); ?>

                                            <span class="client-name"><?php echo e($discoveryOpportunity['primary_name']); ?></span>
                                        </h5>

                                        <?php if($discoveryOpportunity['updated_at']): ?>
                                        <p><?php echo e(Carbon\Carbon::parse($discoveryOpportunity['updated_at'])->format('M d')); ?></p>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Show Lead')): ?>
                                        <div class="action-btn bg-warning ms-2">
                                            <a href="javascript:void(0);" data-size="md" data-url="<?php echo e(route('lead.show',$discoveryOpportunity['id'])); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Quick View')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Discovery Opportunity Details')); ?>" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                        </div>
                                        <?php endif; ?>
                                        <span class="opportunity-price"><?php echo e(getCurrencySign($discoveryOpportunity['currency'])); ?><?php echo e($discoveryOpportunity['value_of_opportunity']); ?></span>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 demo-meeting-div">
                        <div class="inner_col">
                            <h5 class="card-title mb-2">Demo or Meeting (<?php echo e($demoOrMeetingOpportunitiesCount); ?>) <span class="meeting-opportunities">$<?php echo e(human_readable_number($demoOrMeetingOpportunitiesSum)); ?></span></h5>
                            <input type="hidden" id="meeting-opportunities-sum" name="meeting-opportunities-sum" value="<?php echo e(human_readable_number($demoOrMeetingOpportunitiesSum)); ?>">
                            <div class="scrol-card">
                                <?php $__currentLoopData = $demoOrMeetingOpportunities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $demoOrMeetingOpportunity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="card">
                                    <div class="card-body new_bottomcard">
                                        <h5 class="card-text">
                                            <?php echo e($demoOrMeetingOpportunity['opportunity_name']); ?>

                                            <span class="client-name"><?php echo e($demoOrMeetingOpportunity['primary_name']); ?></span>
                                        </h5>

                                        <?php if($demoOrMeetingOpportunity['updated_at']): ?>
                                        <p><?php echo e(Carbon\Carbon::parse($demoOrMeetingOpportunity['updated_at'])->format('M d')); ?></p>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Show Lead')): ?>
                                        <div class="action-btn bg-warning ms-2">
                                            <a href="javascript:void(0);" data-size="md" data-url="<?php echo e(route('lead.show',$demoOrMeetingOpportunity['id'])); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Quick View')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Demo OR Meeting Opportunity Details')); ?>" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                        </div>
                                        <?php endif; ?>
                                        <span class="opportunity-price"><?php echo e(getCurrencySign($demoOrMeetingOpportunity['currency'])); ?><?php echo e($demoOrMeetingOpportunity['value_of_opportunity']); ?></span>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 proposal-div">
                        <div class="inner_col">
                            <h5 class="card-title mb-2">Proposal (<?php echo e($proposalOpportunitiesCount); ?>) <span class="proposal-opportunities">$<?php echo e(human_readable_number($proposalOpportunitiesSum)); ?></span></h5>
                            <input type="hidden" id="proposal-opportunities-sum" name="proposal-opportunities-sum" value="<?php echo e(human_readable_number($proposalOpportunitiesSum)); ?>">
                            <div class="scrol-card">
                                <?php $__currentLoopData = $proposalOpportunities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proposalOpportunity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="card">
                                    <div class="card-body new_bottomcard">
                                        <h5 class="card-text">
                                            <?php echo e($proposalOpportunity['opportunity_name']); ?>

                                            <span class="client-name"><?php echo e($proposalOpportunity['primary_name']); ?></span>
                                        </h5>

                                        <?php if($proposalOpportunity['updated_at']): ?>
                                        <p><?php echo e(Carbon\Carbon::parse($proposalOpportunity['updated_at'])->format('M d')); ?></p>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Show Lead')): ?>
                                        <div class="action-btn bg-warning ms-2">
                                            <a href="javascript:void(0);" data-size="md" data-url="<?php echo e(route('lead.show',$proposalOpportunity['id'])); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Quick View')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Proposal Opportunity Details')); ?>" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                        </div>
                                        <?php endif; ?>
                                        <span class="opportunity-price"><?php echo e(getCurrencySign($proposalOpportunity['currency'])); ?><?php echo e($proposalOpportunity['value_of_opportunity']); ?></span>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4 ">
                    <div class="col-3 negotiation-div">
                        <div class="inner_col">
                            <h5 class="card-title mb-2">Negotiation (<?php echo e($negotiationOpportunitiesCount); ?>) <span class="negotiation-opportunities">$<?php echo e(human_readable_number($negotiationOpportunitiesSum)); ?></span></h5>
                            <input type="hidden" id="negotiation-opportunities-sum" name="negotiation-opportunities-sum" value="<?php echo e(human_readable_number($negotiationOpportunitiesSum)); ?>">
                            <div class="scrol-card">
                                <?php $__currentLoopData = $negotiationOpportunities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $negotiationOpportunity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="card">
                                    <div class="card-body new_bottomcard">
                                        <h5 class="card-text">
                                            <?php echo e($negotiationOpportunity['opportunity_name']); ?>

                                            <span class="client-name"><?php echo e($negotiationOpportunity['primary_name']); ?></span>
                                        </h5>

                                        <?php if($negotiationOpportunity['updated_at']): ?>
                                        <p><?php echo e(Carbon\Carbon::parse($negotiationOpportunity['updated_at'])->format('M d')); ?></p>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Show Lead')): ?>
                                        <div class="action-btn bg-warning ms-2">
                                            <a href="javascript:void(0);" data-size="md" data-url="<?php echo e(route('lead.show',$negotiationOpportunity['id'])); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Quick View')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Negotiation Opportunity Details')); ?>" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                        </div>
                                        <?php endif; ?>
                                        <span class="opportunity-price"><?php echo e(getCurrencySign($negotiationOpportunity['currency'])); ?><?php echo e($negotiationOpportunity['value_of_opportunity']); ?></span>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 awaiting-decision-div">
                        <div class="inner_col">
                            <h5 class="card-title mb-2">Awaiting Decision (<?php echo e($awaitingDecisionOpportunitiesCount); ?>) <span class="awaiting-opportunities">$<?php echo e(human_readable_number($awaitingDecisionOpportunitiesSum)); ?></span></h5>
                            <input type="hidden" id="awaiting-opportunities-sum" name="awaiting-opportunities-sum" value="<?php echo e(human_readable_number($awaitingDecisionOpportunitiesSum)); ?>">
                            <div class="scrol-card">
                                <?php $__currentLoopData = $awaitingDecisionOpportunities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $awaitingDecisionOpportunity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="card">
                                    <div class="card-body new_bottomcard">
                                        <h5 class="card-text">
                                            <?php echo e($awaitingDecisionOpportunity['opportunity_name']); ?>

                                            <span class="client-name"><?php echo e($awaitingDecisionOpportunity['primary_name']); ?></span>
                                        </h5>

                                        <?php if($awaitingDecisionOpportunity['updated_at']): ?>
                                        <p><?php echo e(Carbon\Carbon::parse($awaitingDecisionOpportunity['updated_at'])->format('M d')); ?></p>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Show Lead')): ?>
                                        <div class="action-btn bg-warning ms-2">
                                            <a href="javascript:void(0);" data-size="md" data-url="<?php echo e(route('lead.show',$awaitingDecisionOpportunity['id'])); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Quick View')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Awaiting Decision Opportunity Details')); ?>" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                        </div>
                                        <?php endif; ?>
                                        <span class="opportunity-price"><?php echo e(getCurrencySign($awaitingDecisionOpportunity['currency'])); ?><?php echo e($awaitingDecisionOpportunity['value_of_opportunity']); ?></span>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 post-purchase-div">
                        <div class="inner_col">
                            <h5 class="card-title mb-2">Post Purchase (<?php echo e($postPurchaseOpportunitiesCount); ?>) <span class="postpurchase-opportunities">$<?php echo e(human_readable_number($postPurchaseOpportunitiesSum)); ?></span></h5>
                            <input type="hidden" id="postpurchase-opportunities-sum" name="postpurchase-opportunities-sum" value="<?php echo e(human_readable_number($postPurchaseOpportunitiesSum)); ?>">
                            <div class="scrol-card">
                                <?php $__currentLoopData = $postPurchaseOpportunities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $postPurchaseOpportunity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="card">
                                    <div class="card-body new_bottomcard">
                                        <h5 class="card-text">
                                            <?php echo e($postPurchaseOpportunity['opportunity_name']); ?>

                                            <span class="client-name"><?php echo e($postPurchaseOpportunity['primary_name']); ?></span>
                                        </h5>

                                        <?php if($postPurchaseOpportunity['updated_at']): ?>
                                        <p><?php echo e(Carbon\Carbon::parse($postPurchaseOpportunity['updated_at'])->format('M d')); ?></p>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Show Lead')): ?>
                                        <div class="action-btn bg-warning ms-2">
                                            <a href="javascript:void(0);" data-size="md" data-url="<?php echo e(route('lead.show',$postPurchaseOpportunity['id'])); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Quick View')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Post Purchase Opportunity Details')); ?>" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                        </div>
                                        <?php endif; ?>
                                        <span class="opportunity-price"><?php echo e(getCurrencySign($postPurchaseOpportunity['currency'])); ?><?php echo e($postPurchaseOpportunity['value_of_opportunity']); ?></span>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 closed-won-div">
                        <div class="inner_col">
                            <h5 class="card-title mb-2">Closed Won (<?php echo e($closedWonOpportunitiesCount); ?>) <span class="closedwon-opportunities">$<?php echo e(human_readable_number($closedWonOpportunitiesSum)); ?></span></h5>
                            <input type="hidden" id="closedwon-opportunitie-sum" name="closedwon-opportunitie-sum" value="<?php echo e(human_readable_number($closedWonOpportunitiesSum)); ?>">
                            <div class="scrol-card">
                                <?php $__currentLoopData = $closedWonOpportunities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $closedWonOpportunity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="card">
                                    <div class="card-body new_bottomcard">
                                        <h5 class="card-text">
                                            <?php echo e($closedWonOpportunity['opportunity_name']); ?>

                                            <span class="client-name"><?php echo e($closedWonOpportunity['primary_name']); ?></span>
                                        </h5>

                                        <?php if($closedWonOpportunity['updated_at']): ?>
                                        <p><?php echo e(Carbon\Carbon::parse($closedWonOpportunity['updated_at'])->format('M d')); ?></p>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Show Lead')): ?>
                                        <div class="action-btn bg-warning ms-2">
                                            <a href="javascript:void(0);" data-size="md" data-url="<?php echo e(route('lead.show',$closedWonOpportunity['id'])); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Quick View')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Closed Won Opportunity Details')); ?>" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                        </div>
                                        <?php endif; ?>
                                        <span class="opportunity-price"><?php echo e(getCurrencySign($closedWonOpportunity['currency'])); ?><?php echo e($closedWonOpportunity['value_of_opportunity']); ?></span>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
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
                    url: '<?php echo e(route("store.token")); ?>',
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
        function handleFilterChange() {
            var baseUrl = "<?php echo e(url('/')); ?>";
            var teamMember = $('#team_member').val();
            var region = $('#region').val();
            var products = $('#products').val();

            $.ajax({
                url: '<?php echo e(route("filter-data.dashboard")); ?>',
                method: 'GET',
                data: {
                    team_member: teamMember,
                    region: region,
                    products: products
                },
                success: function(response) {
                    console.log('Response:', response);
                    var data = response.opportunities;
                    console.log('Data:', data);

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

        function generateOpportunityHTML(type, baseUrl, data) {
            var html = '';

            if (data && data.lead && data.lead.length > 0) {
                var count = data.count;
                var sum = data.sum;
                var sumDisplay = sum ? human_readable_number(sum) : '0';

                html += '<div class="inner_col">';
                html += '<h5 class="card-title mb-2 opportunity-title">' + capitalizeFirstLetter(type) + ' (' + count + ') <span class="' + type.toLowerCase() + '-opportunities">$' + sumDisplay + '</span></h5>';
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
            var html = '<div class="inner_col">';
            html += '<h5 class="card-title mb-2 opportunity-title">' + capitalizeFirstLetter(type) + ' (0) <span class="' + type.toLowerCase() + '-opportunities">$0</span></h5>';
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
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\volo\resources\views/home.blade.php ENDPATH**/ ?>