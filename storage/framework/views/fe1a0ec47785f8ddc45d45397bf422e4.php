
<?php $__env->startSection('page-title'); ?>
<?php echo e(__('Objective Tracker')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
<?php echo e(__('Objective Tracker')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('objective-tracker')); ?>"><?php echo e(__('Objective Tracker')); ?></a></li>
<li class="breadcrumb-item"><?php echo e(__('Objective Tracker')); ?></li>
<?php $__env->stopSection(); ?>
<style>
    .container {
        display: flex;
        justify-content: space-between;
        width: 100%;
    }

    .left,
    .right {
        width: 48%;
    }

    .header,
    .data {
        background-color: #90ee90;
        padding: 10px;
        margin-bottom: 10px;
    }

    .header div,
    .data div {
        display: inline-block;
        width: 50%;
    }

    .tasks-status {
        margin-top: 20px;
    }

    .tasks-status .status-header {
        font-weight: bold;
        text-align: left;
        margin-bottom: 5px;
    }

    .status-item {
        display: flex;
        justify-content: space-between;
        padding: 5px 0;
    }

    .outstanding {
        color: red;
    }

    .in-progress {
        color: orange;
    }

    .complete {
        color: green;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #fff;
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
        z-index: 1;
        min-width: 160px;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {
        background-color: #f1f1f1;
    }

    .table-header_add {
        background-color: #90D67A;
        color: #fff;
        text-align: center;
    }

    .input_form {
        width: 100%;
        height: 40px;
        border: none;
        text-align: center;
        margin: auto;
    }

    /* .Category_set {
        width: 10%;
        margin-top: 48px;
        text-align: center;

    } */

    /* .icon_btn {
        width: 22px;
        height: 22px;
        fill: #fff;
        margin-top: 5px;
        margin-left: auto;
        float: right;
    } */

    .tr_icon_border {
        background: #90D67A;
        color: #ffff;
    }

    .logo_img {
        margin-left: 10px;

        width: 233px;
        height: 50px
    }

    .border_table_set {
        border: 1px solid #d8d6d6;

    }
</style>


<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body table-border-style">

                        <div class="table-responsive overflow_hidden">
                            <a href="">
                                <img src="<?php echo e($logo.'new-volo-transparent-bg.png'); ?>" alt="logo" class='logo_img'>
                            </a>
                            <div class="row">
                                <div class="col-4 mt-3">
                                    <table class="table" style="
                                            width: 100%;
                                            border-collapse: collapse;
                                        ">
                                        <tr class="table-header table-header_add">
                                            <th colspan="2">
                                                Doe Ref: Objective
                                                Tracker_V1_052024
                                            </th>
                                        </tr>
                                        <tr class="table-header table-header_add class='border_table_set'">
                                            <th>Name</th>
                                            <th>Period</th>
                                        </tr>
                                        <tr class='border_table_set'>
                                            <td>
                                                <select class="input_form" name="employee" id="">
                                                    <option value="" selected disabled>Select Employee</option>
                                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="input_form">
                                                    <?php for($year = 2024; $year <= 2050; $year++): ?> <option value="<?php echo e($year); ?>"><?php echo e($year); ?></option>
                                                        <?php endfor; ?>
                                                </select>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-4"></div>
                                <div class="col-4">
                                    <table class="table" style="border-collapse: collapse">
                                        <thead>
                                            <tr>
                                                <th>Tasks</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="outstanding">
                                                    Outstanding
                                                </td>
                                                <td class="outstanding">2</td>
                                                <td>22%</td>
                                            </tr>
                                            <tr>
                                                <td class="in-progress">
                                                    In Progress
                                                </td>
                                                <td class="in-progress">5</td>
                                                <td>56%</td>
                                            </tr>
                                            <tr>
                                                <td class="complete">
                                                    Complete
                                                </td>
                                                <td class="complete">2</td>
                                                <td>22%</td>
                                            </tr>
                                            <tr>
                                                <td>Total:</td>
                                                <td>9</td>
                                                <td>100%</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr class='tr_icon_border'>
                                        <th scope="col" class="Category_set">
                                            Category
                                            <i class="fa fa-caret-down category-dropdown icon_btn"></i>
                                            <div class="dropdown-content category-dropdown-content " style='margin-top: 8px;'>
                                                <a href="#">BDRG</a>
                                                <a href="#">Innovation</a>
                                                <a href="#">MVP D&D</a>
                                                <a href="#">O&P</a>
                                                <a href="#">People & Culture</a>
                                            </div>
                                        </th>

                                        <th scope="col" class="Category_set">
                                            Objective
                                            <i class="fa fa-caret-down objective-dropdown icon_btn"></i>
                                            <div class="dropdown-content objective-dropdown-content">
                                                <a href="#">Award allocated EIP awards
                                                    and cascade SO into entire
                                                    team.</a>
                                                <a href="#">Complete platform
                                                    consolidation agreements.</a>
                                                <a href="#">Define system integration
                                                    roles with each MVP
                                                    execution to ensure seamless
                                                    prospect management during
                                                    pre-sales and closure
                                                    processes.</a>
                                                <a href="#">Ensure accounting and
                                                    financial reporting
                                                    alignment with Volo on a
                                                    consolidated and
                                                    non-idiosyncratic method.</a>
                                                <a href="#">Grow net revenue from $4.6m
                                                    to $5.2m in additional fees
                                                    to Ajar.</a>
                                                <a href="#">In liaison with other
                                                    leaders grow commercial
                                                    cross pollination by $1m.</a>
                                                <a href="#">Lead the integration and
                                                    alignment of Ajar and
                                                    Volofleet.</a>
                                                <a href="#">Refine people and Ajar
                                                    identity process as a
                                                    'portfolio company'.</a>
                                                <a href="#">Reset organisational tone
                                                    for performance and
                                                    meritocracy, through the
                                                    establishment of measurable
                                                    S.O.s, best attitude,
                                                    practice and S.O.Ps.</a>
                                            </div>
                                        </th>
                                        <th scope="col" class="Category_set">
                                            Measure
                                            <i class="fa fa-caret-down measure-dropdown icon_btn"></i>
                                            <div class="dropdown-content measure-dropdown-content">
                                                <a href="#">Complete all EIP document
                                                    packs for Ajar participants
                                                    in Volo EIP</a>
                                                <a href="#">$1m USD/ £800k GBP of sales
                                                    achieved between Volo/Ajar
                                                    group of companies from
                                                    internal introductions
                                                    and/or cross selling
                                                    products and services.</a>
                                                <a href="#">1. Ajar x Volo
                                                    Consolidation & purchase
                                                    agreement executed 2. Ajar x
                                                    Volo MSA executed 3. Ajar x
                                                    Volo MOU(s) executed 4.
                                                    Voloforce UK x Volofleet
                                                    purchase agreement
                                                    executed</a>
                                                <a href="">Ajartec branding &
                                                    marketing materials updated
                                                    to include 'A Volofleet
                                                    portfolio company'*</a>
                                                <a href="">Create skills matrix for
                                                    Systems Integration team.
                                                    Map complimentary technology
                                                    & services from Systems
                                                    Integration team to Volo
                                                    product suite to maxminise
                                                    sales potential.</a>
                                                <a href="">Deliver financial year net
                                                    revenue of $5.2m USD/ £4.15m
                                                    GBP for Ajartec</a>
                                                <a href="">Establish consistent
                                                    reporting format for Ajar
                                                    Sales & Accounts data to
                                                    Ash. Facilitate cross
                                                    discipline meetings between
                                                    Ajar team and Volo business
                                                    units.
                                                </a>
                                                <a href="">Financial reporting
                                                    standards and frequency of
                                                    issuing reports agreed with
                                                    Ash Anand. Q1 reports all
                                                    issued.</a>
                                                <a href="">Strategic objectives and
                                                    measures for Ajartec agreed
                                                    and documented, issued out
                                                    to key relevant people as
                                                    part of EIP packs.
                                                </a>
                                            </div>
                                        </th>
                                        <th scope="col" class="Category_set">
                                            Key Dates
                                            <i class="fa fa-caret-down key-dates-dropdown icon_btn"></i>
                                            <div class="dropdown-content key-dates-dropdown-content">
                                                <a href="#">3/31/2024</a>
                                                <a href="#">6/28/2024</a>
                                                <a href="#">12/31/2024</a>
                                                <a href="#">NA</a>
                                            </div>
                                        </th>
                                        <th scope="col" class="Category_set">
                                            Status
                                            <i class="fa fa-caret-down status-dropdown icon_btn"></i>
                                            <div class="dropdown-content status-dropdown-content">
                                                <a href="#">Complete</a>
                                                <a href="#">In Progress</a>
                                                <a href="#">Outstanding</a>
                                            </div>
                                        </th>
                                        <th scope="col">
                                            Q1 Updates
                                            <i class="fa fa-caret-down q1-updates-dropdown icon_btn"></i>
                                            <div class="dropdown-content q1-updates-dropdown-content">
                                                <a href="">(Blanks)</a>
                                                <a href="#">(this is broken down into
                                                    Ajar Sales team $250k chunks
                                                    to incentivise their buy in
                                                    & support. Also see updates
                                                    for MK/OM/TM.) JK works
                                                    quoted via DCL for Zev Hub
                                                    (unsuccessful) & Solent
                                                    transport microhub (live)
                                                </a>
                                                <a href="#">£2,750,738.74 gross revenue
                                                    Q1. Need to run through net
                                                    calculation with Ash.</a>
                                                <a href="#">All documents executed</a>
                                                <a href="">Currently being reviewed in
                                                    consultation with Bev to get
                                                    better measures in place.</a>
                                                <a href="">Ongoing workstream aiming
                                                    to complete during q2.
                                                    *there's been various
                                                    discussions on this subject
                                                    throughout the last several
                                                    months (including with PB)
                                                    and general feeling is it
                                                    should be platform or
                                                    partner company. Portfolio
                                                    company is deemed to signify
                                                    being owned by Volofleet and
                                                    projects wrong message
                                                    currently.</a>
                                                <a href="">Reports & formats agreed
                                                    with Ash, all requested info
                                                    provided for Q1. On-going
                                                    for rest of year</a>
                                            </div>
                                        </th>
                                        <th scope="col" class="Category_set">
                                            Q2 Updates
                                            <i class="fa fa-caret-down q2-updates-dropdown icon_btn"></i>
                                            <div class="dropdown-content q2-updates-dropdown-content">
                                                <a href="">(Blanks)</a>
                                                <a href="#">N/A</a>
                                            </div>
                                        </th>
                                        <th scope="col" class="Category_set">
                                            Q3 Updates
                                            <i class="fa fa-caret-down q3-updates-dropdown icon_btn"></i>
                                            <div class="dropdown-content q3-updates-dropdown-content">
                                                <a href="">(Blanks)</a>
                                                <a href="#">N/A</a>
                                            </div>
                                        </th>
                                        <th scope="col" class="Category_set">
                                            Q4 Updates
                                            <i class="fa fa-caret-down q4-updates-dropdown icon_btn"></i>
                                            <div class="dropdown-content q4-updates-dropdown-content">
                                                <a href="">(Blanks)</a>
                                                <a href="#">N/A</a>
                                            </div>
                                        </th>
                                        <th scope="col" class="Category_set">
                                            EOY Review
                                            <i class="fa fa-caret-down eoy-review-dropdown icon_btn"></i>
                                            <div class="dropdown-content eoy-review-dropdown-content">
                                                <a href="">(Blanks)</a>
                                                <a href="#">Outstanding work.Have a
                                                    beer on us</a>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td contenteditable="true" class='border_table_set'>BDRG</td>
                                        <td contenteditable="true" class='border_table_set'>
                                            Lead the integration and alignment
                                            of Ajar and Volofleet.
                                        </td>
                                        <td contenteditable="true" class='border_table_set'>
                                            <p class='table_data'> Establish consistent reporting
                                                format for Ajar Sales & Accounts
                                                data to Ash. Facilitate cross
                                                discipline meetings between Ajar
                                                team and Volo business units.</p>
                                        </td>
                                        <td contenteditable="true" class='border_table_set'>
                                            6/28/2024
                                        </td>
                                        <td contenteditable="true" class='border_table_set'>
                                            In Progress
                                        </td>
                                        <td contenteditable="true" class='border_table_set'></td>
                                        <td contenteditable="true" class='border_table_set'></td>
                                        <td contenteditable="true" class='border_table_set'></td>
                                        <td contenteditable="true" class='border_table_set'></td>
                                        <td contenteditable="true" class='border_table_set'></td>
                                    </tr>

                                    <tr>
                                        <td contenteditable="true" class='border_table_set'>BDRG</td>
                                        <td contenteditable="true" class='border_table_set'>
                                            Grow net revenue from $4.6m to $5.2m
                                            in additional fees to Ajar.
                                        </td>
                                        <td contenteditable="true" class='border_table_set'>
                                            <p class='table_data'> Deliver financial year net revenue
                                                of $5.2m USD/ £4.15m GBP for Ajartec</p>
                                        </td>
                                        <td contenteditable="true" class='border_table_set'>
                                            12/31/2024
                                        </td>
                                        <td contenteditable="true" class='border_table_set'>
                                            In Progress
                                        </td>
                                        <td contenteditable="true" class='border_table_set'>
                                            £2,750,738.74 gross revenue Q1. Need
                                            to run through net calculation with
                                            Ash.
                                        </td>
                                        <td contenteditable="true" class='border_table_set'></td>
                                        <td contenteditable="true" class='border_table_set'></td>
                                        <td contenteditable="true" class='border_table_set'></td>
                                        <td contenteditable="true" class='border_table_set'></td>
                                    </tr>

                                    <tr>
                                        <td contenteditable="true" class='border_table_set'>MVP D&D</td>
                                        <td contenteditable="true" class='border_table_set'>
                                            <p class='table_data'>
                                                Define system integration roles with
                                                each MVP execution to ensure
                                                seamless prospect management during
                                                pre-sales and closure processes.
                                            </p>
                                        </td>
                                        <td contenteditable="true" class='border_table_set'>
                                            <p class='table_data'> Create skills matrix for Systems
                                                Integration team. Map complimentary
                                                technology & services from Systems
                                                Integration team to Volo product
                                                suite to maxminise sales potential.</p>
                                        </td>
                                        <td contenteditable="true" class='border_table_set'>N/A</td>
                                        <td contenteditable="true">
                                            Outstanding
                                        </td>
                                        <td contenteditable="true" class='border_table_set'></td>
                                        <td contenteditable="true" class='border_table_set'></td>
                                        <td contenteditable="true" class='border_table_set'></td>
                                        <td contenteditable="true" class='border_table_set'></td>
                                        <td contenteditable="true" class='border_table_set'></td>
                                    </tr>

                                    <tr>
                                        <td contenteditable="true" class='border_table_set'>O&P</td>
                                        <td contenteditable="true" class='border_table_set'>
                                            Complete platform consolidation
                                            agreements.
                                        </td>
                                        <td contenteditable="true" class='border_table_set'>
                                            <p class='table_data'>
                                                1. Ajar x Volo Consolidation &
                                                purchase agreement executed 2. Ajar
                                                x Volo MSA executed 3. Ajar x Volo
                                                MOU(s) executed 4. Voloforce UK x
                                                Volofleet purchase agreement
                                                executed
                                            </p>
                                        </td>
                                        <td contenteditable="true" class='border_table_set'>
                                            3/31/2024
                                        </td>
                                        <td contenteditable="true" class='border_table_set'>Complete</td>
                                        <td contenteditable="true" class='border_table_set'>
                                            All documents executed
                                        </td>
                                        <td contenteditable="true" class='border_table_set'>N/A</td>
                                        <td contenteditable="true" class='border_table_set'>N/A</td>
                                        <td contenteditable="true" class='border_table_set'>N/A</td>
                                        <td contenteditable="true" class='border_table_set'>
                                            Outstanding work.Have a beer on us
                                        </td>
                                    </tr>

                                    <tr>
                                        <td contenteditable="true" class='border_table_set'>O&P</td>
                                        <td contenteditable="true" class='border_table_set'>
                                            <p class='table_data'>Ensure accounting and financial
                                                reporting alignment with Volo on a
                                                consolidated and non-idiosyncratic
                                                method.</p>
                                        </td>
                                        <td contenteditable="true" class='border_table_set'>
                                            <p class='table_data'>
                                                Financial reporting standards and
                                                frequency of issuing reports agreed
                                                with Ash Anand. Q1 reports all
                                                issued.
                                            </p>
                                        </td>
                                        <td contenteditable="true" class='border_table_set'>
                                            3/31/2024
                                        </td>
                                        <td contenteditable="true" class='border_table_set'>
                                            In Progress
                                        </td>
                                        <td contenteditable="true" class='border_table_set'>
                                            <p class='table_data'>
                                                Reports & formats agreed with Ash,
                                                all requested info provided for Q1.
                                                On-going for rest of year
                                            </p>
                                        </td>
                                        <td contenteditable="true" class='border_table_set'></td>
                                        <td contenteditable="true" class='border_table_set'></td>
                                        <td contenteditable="true" class='border_table_set'></td>
                                        <td contenteditable="true" class='border_table_set'></td>
                                    </tr>

                                    <tr>
                                        <td contenteditable="true" class='border_table_set'>
                                            Innovation
                                        </td>
                                        <td contenteditable="true" class='border_table_set'>
                                            In liaison with other leaders grow
                                            commercial cross pollination by $1m.
                                        </td>
                                        <td contenteditable="true" class='border_table_set'>
                                            <p class='table_data'>
                                                $1m USD/ £800k GBP of sales achieved
                                                between Volo/Ajar group of companies
                                                from internal introductions and/or
                                                cross selling products and services.
                                            </p>
                                        </td>
                                        <td contenteditable="true" class='border_table_set'>
                                            12/31/2024
                                        </td>
                                        <td contenteditable="true" class='border_table_set'>
                                            In Progress
                                        </td>
                                        <td contenteditable="true" class='border_table_set'>
                                            <p class='table_data'>
                                                (this is broken down into Ajar Sales
                                                team $250k chunks to incentivise
                                                their buy in & support. Also see
                                                updates for MK/OM/TM.) JK works
                                                quoted via DCL for Zev Hub
                                                (unsuccessful) & Solent transport
                                                microhub (live)
                                            </p>
                                        </td>
                                        <td contenteditable="true" class='border_table_set'></td>
                                        <td contenteditable="true" class='border_table_set'></td>
                                        <td contenteditable="true" class='border_table_set'></td>
                                        <td contenteditable="true" class='border_table_set'></td>
                                    </tr>

                                    <tr>
                                        <td contenteditable="true" class='border_table_set'>
                                            People & Culture
                                        </td>
                                        <td contenteditable="true" class='border_table_set'>
                                            Refine people and Ajar identity
                                            process as a 'portfolio company'.
                                        </td>
                                        <td contenteditable="true" class='border_table_set'>
                                            Ajartec branding & marketing
                                            materials updated to include 'A
                                            Volofleet portfolio company'*
                                        </td>
                                        <td contenteditable="true" class='border_table_set'>
                                            6/28/2024
                                        </td>
                                        <td contenteditable="true" class='border_table_set'>
                                            Outstanding
                                        </td>
                                        <td contenteditable="true" class='border_table_set'>
                                            <p class='table_data'>
                                                Ongoing workstream aiming to
                                                complete during q2. *there's been
                                                various discussions on this subject
                                                throughout the last several months
                                                (including with PB) and general
                                                feeling is it should be platform or
                                                partner company. Portfolio company
                                                is deemed to signify being owned by
                                                Volofleet and projects wrong message
                                                currently.
                                            </p>
                                        </td>
                                        <td contenteditable="true" class='border_table_set'></td>
                                        <td contenteditable="true" class='border_table_set'></td>
                                        <td contenteditable="true" class='border_table_set'></td>
                                        <td contenteditable="true" class='border_table_set'></td>
                                    </tr>

                                    <tr>
                                        <td contenteditable="true" class='border_table_set'>
                                            People & Culture
                                        </td>
                                        <td contenteditable="true" class='border_table_set'>
                                            <p class='table_data'>
                                                Reset organisational tone for
                                                performance and meritocracy, through
                                                the establishment of measurable
                                                S.O.s, best attitude, practice and
                                                S.O.Ps.
                                            </p>
                                        </td>
                                        <td contenteditable="true" class='border_table_set'>
                                            <p class='table_data'>
                                                Strategic objectives and measures
                                                for Ajartec agreed and documented,
                                                issued out to key relevant people as
                                                part of EIP packs.
                                            </p>
                                        </td>
                                        <td contenteditable="true" class='border_table_set'>
                                            3/31/2024
                                        </td>
                                        <td contenteditable="true" class='border_table_set'>
                                            In Progress
                                        </td>
                                        <td contenteditable="true" class='border_table_set'>
                                            Currently being reviewed in
                                            consultation with Bev to get better
                                            measures in place.
                                        </td>
                                        <td contenteditable="true" class='border_table_set'></td>
                                        <td contenteditable="true" class='border_table_set'></td>
                                        <td contenteditable="true" class='border_table_set'></td>
                                        <td contenteditable="true" class='border_table_set'></td>
                                    </tr>

                                    <tr>
                                        <td contenteditable="true" class='border_table_set'>
                                            People & Culture
                                        </td>
                                        <td contenteditable="true" class='border_table_set'>
                                            Award allocated EIP awards and
                                            cascade SO into entire team.
                                        </td>
                                        <td contenteditable="true" class='border_table_set'>
                                            Complete all EIP document packs for
                                            Ajar participants in Volo EIP
                                        </td>
                                        <td contenteditable="true" class='border_table_set'>
                                            3/31/2024
                                        </td>
                                        <td contenteditable="true" class='border_table_set'>Complete</td>
                                        <td contenteditable="true" class='border_table_set'></td>
                                        <td contenteditable="true" class='border_table_set'></td>
                                        <td contenteditable="true" class='border_table_set'></td>
                                        <td contenteditable="true" class='border_table_set'></td>
                                        <td contenteditable="true" class='border_table_set'></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Toggle dropdowns on click
        $(".category-dropdown").click(function() {
            $(".category-dropdown-content").toggle();
        });

        $(".objective-dropdown").click(function() {
            $(".objective-dropdown-content").toggle();
        });

        $(".measure-dropdown").click(function() {
            $(".measure-dropdown-content").toggle();
        });

        $(".key-dates-dropdown").click(function() {
            $(".key-dates-dropdown-content").toggle();
        });

        $(".status-dropdown").click(function() {
            $(".status-dropdown-content").toggle();
        });

        $(".q1-updates-dropdown").click(function() {
            $(".q1-updates-dropdown-content").toggle();
        });

        $(".q2-updates-dropdown").click(function() {
            $(".q2-updates-dropdown-content").toggle();
        });

        $(".q3-updates-dropdown").click(function() {
            $(".q3-updates-dropdown-content").toggle();
        });

        $(".q4-updates-dropdown").click(function() {
            $(".q4-updates-dropdown-content").toggle();
        });

        $(".eoy-review-dropdown").click(function() {
            $(".eoy-review-dropdown-content").toggle();
        });
    });
</script>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\volo\resources\views/objective_tracker/index.blade.php ENDPATH**/ ?>