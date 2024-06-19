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

<div class="container-field">
    <div id="wrapper">
        <div id="page-content-wrapper">
            <div class="row">
                <div class="col-4 mb-4">
                    <h4>Team Member</h4>
                    <select name="team_member" class="form-control">
                        <option value="" selected disabled>Select Team Member</option>
                        <?php $__currentLoopData = $assinged_staff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($staff->id); ?>"><?php echo e($staff->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($product); ?>"><?php echo e($product); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="row">
                    <div class="col-3">
                        <div class="inner_col">
                            <h5 class="card-title mb-2">Prospecting (<?php echo e($prospectingOpportunitiesCount); ?>)</h5>
                            <h6 class="card-title mb-2">Total Value : <span><?php echo e(number_format($prospectingOpportunitiesSum)); ?></span></h6>
                            <div class="scrol-card">
                                <?php $__currentLoopData = $prospectingOpportunities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prospectingOpportunity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="card">
                                    <div class="card-body new_bottomcard">
                                        <h5 class="card-text">
                                            <?php echo e($prospectingOpportunity['opportunity_name']); ?>

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
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="inner_col">
                            <h5 class="card-title mb-2">Discovery (<?php echo e($discoveryOpportunitiesCount); ?>)</h5>
                            <h6 class="card-title mb-2">Total Value : <span><?php echo e(number_format($discoveryOpportunitiesSum)); ?></span></h6>
                            <div class="scrol-card">
                                <?php $__currentLoopData = $discoveryOpportunities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $discoveryOpportunity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="card">
                                    <div class="card-body new_bottomcard">
                                        <h5 class="card-text">
                                            <?php echo e($discoveryOpportunity['opportunity_name']); ?>

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
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="inner_col">
                            <h5 class="card-title mb-2">Demo or Meeting (<?php echo e($demoOrMeetingOpportunitiesCount); ?>)</h5>
                            <h6 class="card-title mb-2">Total Value : <span><?php echo e(number_format($demoOrMeetingOpportunitiesSum)); ?></span></h6>
                            <div class="scrol-card">
                                <?php $__currentLoopData = $demoOrMeetingOpportunities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $demoOrMeetingOpportunity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="card">
                                    <div class="card-body new_bottomcard">
                                        <h5 class="card-text">
                                            <?php echo e($demoOrMeetingOpportunity['opportunity_name']); ?>

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
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="inner_col">
                            <h5 class="card-title mb-2">Proposal (<?php echo e($proposalOpportunitiesCount); ?>)</h5>
                            <h6 class="card-title mb-2">Total Value : <span><?php echo e(number_format($proposalOpportunitiesSum)); ?></span></h6>
                            <div class="scrol-card">
                                <?php $__currentLoopData = $proposalOpportunities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proposalOpportunity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="card">
                                    <div class="card-body new_bottomcard">
                                        <h5 class="card-text">
                                            <?php echo e($proposalOpportunity['opportunity_name']); ?>

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
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-3">
                        <div class="inner_col">
                            <h5 class="card-title mb-2">Negotiation (<?php echo e($negotiationOpportunitiesCount); ?>)</h5>
                            <h6 class="card-title mb-2">Total Value : <span><?php echo e(number_format($negotiationOpportunitiesSum)); ?></span></h6>
                            <div class="scrol-card">
                                <?php $__currentLoopData = $negotiationOpportunities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $negotiationOpportunity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="card">
                                    <div class="card-body new_bottomcard">
                                        <h5 class="card-text">
                                            <?php echo e($negotiationOpportunity['opportunity_name']); ?>

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
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="inner_col">
                            <h5 class="card-title mb-2">Awaiting Decision (<?php echo e($awaitingDecisionOpportunitiesCount); ?>)</h5>
                            <h6 class="card-title mb-2">Total Value : <span><?php echo e(number_format($awaitingDecisionOpportunitiesSum)); ?></span></h6>
                            <div class="scrol-card">
                                <?php $__currentLoopData = $awaitingDecisionOpportunities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $awaitingDecisionOpportunity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="card">
                                    <div class="card-body new_bottomcard">
                                        <h5 class="card-text">
                                            <?php echo e($awaitingDecisionOpportunity['opportunity_name']); ?>

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
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="inner_col">
                            <h5 class="card-title mb-2">Post Purchase (<?php echo e($postPurchaseOpportunitiesCount); ?>)</h5>
                            <h6 class="card-title mb-2">Total Value : <span><?php echo e(number_format($postPurchaseOpportunitiesSum)); ?></span></h6>
                            <div class="scrol-card">
                                <?php $__currentLoopData = $postPurchaseOpportunities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $postPurchaseOpportunity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="card">
                                    <div class="card-body new_bottomcard">
                                        <h5 class="card-text">
                                            <?php echo e($postPurchaseOpportunity['opportunity_name']); ?>

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
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="inner_col">
                            <h5 class="card-title mb-2">Closed Won (<?php echo e($closedWonOpportunitiesCount); ?>)</h5>
                            <h6 class="card-title mb-2">Total Value : <span><?php echo e(number_format($closedWonOpportunitiesSum)); ?></span></h6>
                            <div class="scrol-card">
                                <?php $__currentLoopData = $closedWonOpportunities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $closedWonOpportunity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="card">
                                    <div class="card-body new_bottomcard">
                                        <h5 class="card-text">
                                            <?php echo e($closedWonOpportunity['opportunity_name']); ?>

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
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\volo\resources\views/home.blade.php ENDPATH**/ ?>