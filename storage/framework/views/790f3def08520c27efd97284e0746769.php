<?php
$settings = App\Models\Utility::settings();
$campaign_type = explode(',',$settings['campaign_type']);
?>
<style>
    .fa-asterisk {
        font-size: xx-small;
        position: absolute;
        padding: 1px;
    }

    #other_region_input {
        display: none;
    }

    .additional-product-category {
        display: none;
        margin-top: 10px;
    }
</style>
<div class="form-group col-md-12">
    <div class="badges">
        <ul class="nav nav-tabs tabActive" style="border-bottom: none">
            <li class="badge rounded p-2 m-1 px-3 bg-primary">
                <a style="color: white;font-size: larger;" data-toggle="tab" href="#barmenu0" class="active">Individual
                    Clients</a>
            </li>
            <li class="badge rounded p-2 m-1 px-3 bg-primary">
                <a style="color: white;    font-size: larger;" data-toggle="tab" href="#barmenu1" class="">Bulk
                    Upload</a>
            </li>
        </ul>
        <div class="tab-content">
            <div id="barmenu0" class="tab-pane fade in active show mt-5">
                <div class="col-12  p-0 modaltitle pb-3 mb-3 mt-4">
                    <h5 style="margin-left: 14px;"><?php echo e(__('Primary Contact Information')); ?></h5>
                </div>
                <?php echo e(Form::open(array('route'=>['importuser'],'method'=>'post','enctype'=>'multipart/form-data','id'=>'imported'))); ?>

                <div class="row">
                    <div class="col-6 need_full">
                        <input type="hidden" name="customerType" value="addForm" />
                        <div class="form-group">
                            <?php echo e(Form::label('name',__('Name'),['class'=>'form-label'])); ?>

                            <span class="text-sm">
                                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                            </span>
                            <?php echo e(Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Name'),'required'=>'required'))); ?>

                        </div>
                    </div>
                    <div class="col-6 need_full">
                        <div class="form-group ">
                            <?php echo e(Form::label('name',__('Primary contact'),['class'=>'form-label'])); ?>

                            <span class="text-sm">
                                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                            </span>
                            <div class="intl-tel-input">
                                <input type="tel" id="phone-input" name="primary_contact" class="phone-input form-control" placeholder="Enter Primary contact" maxlength="16">
                                <input type="hidden" name="primary_countrycode" id="primary-country-code">
                            </div>
                        </div>
                    </div>

                    <div class="col-6 need_full">
                        <div class="form-group">
                            <?php echo e(Form::label('email',__('Email'),['class'=>'form-label'])); ?>

                            <span class="text-sm">
                                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                            </span>
                            <?php echo e(Form::text('email',null,array('class'=>'form-control','placeholder'=>__('Enter Email'),'required'=>'required'))); ?>

                        </div>
                    </div>
                    <div class="col-6 need_full">
                        <div class="form-group">
                            <?php echo e(Form::label('address',__('Address'),['class'=>'form-label'])); ?>


                            <?php echo e(Form::text('address',null,array('class'=>'form-control','placeholder'=>__('Enter Address')))); ?>

                        </div>
                    </div>
                    <div class="col-6 need_full">
                        <div class="form-group">
                            <?php echo e(Form::label('organization',__('Title/Designation'),['class'=>'form-label'])); ?>

                            <?php echo e(Form::text('organization',null,array('class'=>'form-control','placeholder'=>__('Enter Designation')))); ?>

                        </div>
                    </div>
                </div>

                <div class="col-12  p-0 modaltitle pb-3 mb-3 mt-4">
                    <h5 style="margin-left: 14px;"><?php echo e(__('Secondary Contact Information')); ?></h5>
                </div>
                <div class="row">
                    <div class="col-6 need_full">
                        <div class="form-group ">
                            <?php echo e(Form::label('name',__('Secondary contact'),['class'=>'form-label'])); ?>

                            <div class="intl-tel-input">
                                <input type="tel" id="phone-input1" name="secondary_contact" class="phone-input form-control" placeholder="Enter Phone" maxlength="16">
                                <input type="hidden" name="secondary_countrycode" id="secondary-country-code">
                            </div>
                        </div>
                    </div>
                    <div class="col-6 need_full">
                        <div class="form-group">
                            <?php echo e(Form::label('email',__('Email'),['class'=>'form-label'])); ?>

                            <?php echo e(Form::text('secondary_email',null,array('class'=>'form-control','placeholder'=>__('Enter Email')))); ?>

                        </div>
                    </div>
                    <div class="col-6 need_full">
                        <div class="form-group">
                            <?php echo e(Form::label('address',__('Address'),['class'=>'form-label'])); ?>

                            <?php echo e(Form::text('address',null,array('class'=>'form-control','placeholder'=>__('Enter Address')))); ?>

                        </div>
                    </div>
                    <div class="col-6 need_full">
                        <div class="form-group">
                            <?php echo e(Form::label('organization',__('Organization'),['class'=>'form-label'])); ?>

                            <?php echo e(Form::text('organization',null,array('class'=>'form-control','placeholder'=>__('Enter Organization')))); ?>

                        </div>
                    </div>
                </div>

                <div class="col-12  p-0 modaltitle pb-3 mb-3 mt-4">
                    <h5 style="margin-left: 14px;"><?php echo e(__('Other Information')); ?></h5>
                </div>
                <div class="row">
                    <div class="col-6 need_full">
                        <div class="form-group">
                            <label for="category">Select Category</label>
                            <span class="text-sm">
                                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                            </span>
                            <select name="category" id="category" class="form-control">
                                <option value="" selected disabled>Select Category</option>
                                <?php $__currentLoopData = $campaign_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campaign): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($campaign); ?>" class="form-control"><?php echo e($campaign); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-6 need_full">
                        <div class="form-group">
                            <label for="location_geography">Location / Geography</label>
                            <select name="location_geography" id="location_geography" class="form-control" required>
                                <option value="" selected disabled>Select Location / Geography</option>
                                <option value="asia" class="form-control">Asia</option>
                                <option value="africa" class="form-control">Africa</option>
                                <option value="europe" class="form-control">Europe</option>
                                <option value="north-america" class="form-control">North America</option>
                                <option value="south-america" class="form-control">South America</option>
                                <option value="australia" class="form-control">Australia</option>
                                <option value="global" class="form-control">Global</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6 need_full">
                        <div class="form-group">
                            <label for="region">Region</label>
                            <select name="region" id="region" class="form-control" required>
                                <option value="" selected disabled>Select Region</option>
                                <option value="india" class="form-control">India</option>
                                <option value="singapore" class="form-control">Singapore</option>
                                <option value="latin-america" class="form-control">Latin America</option>
                                <option value="mexico" class="form-control">Mexico</option>
                                <option value="spain" class="form-control">Spain</option>
                                <option value="france" class="form-control">France</option>
                                <option value="uk" class="form-control">UK</option>
                                <option value="usa" class="form-control">USA</option>
                                <option value="other" class="form-control">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="other_region_input">
                        <label for="other-region">Add Other Region</label>
                        <input type="text" name="other_region" id="other_region" class="form-control">
                    </div>
                    <div class="col-6 need_full">
                        <div class="form-group">
                            <label for="sales_subcategory">Sales Subcategory</label>
                            <select name="sales_subcategory" id="sales_subcategory" class="form-control" required>
                                <option value="" selected disabled>Select Sales Subcategory</option>
                                <option value="Partner" class="form-control">Partner</option>
                                <option value="Reseller" class="form-control">Reseller</option>
                                <option value="Introducer" class="form-control">Introducer</option>
                                <option value="Direct Customer" class="form-control">Direct Customer</option>
                                <option value="Host" class="form-control">Host</option>
                                <option value="Tennant" class="form-control">Tennant</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6 need_full">
                        <div class="form-group">
                            <label for="industry_sectors">Industries</label>
                            <select name="industry_sectors[]" id="industry_sectors" class="form-control" multiple required>
                                <option value="" selected disabled>Select Industries</option>
                                <option value="automobiles-components">Automobiles and Components</option>
                                <option value="banks">Banks</option>
                                <option value="fleet-private">Fleet – Private</option>
                                <option value="hubs">Hubs</option>
                                <option value="public-sector">Public Sector</option>
                                <option value="capital-goods">Capital Goods</option>
                                <option value="commercial-professional-services">Commercial and Professional Services</option>
                                <option value="consumer-durables-apparel">Consumer Durables and Apparel</option>
                                <option value="consumer-services">Consumer Services</option>
                                <option value="diversified-financials">Diversified Financials</option>
                                <option value="energy">Energy</option>
                                <option value="food-beverage-tobacco">Food, Beverage, and Tobacco</option>
                                <option value="food-staples-retailing">Food and Staples Retailing</option>
                                <option value="health-care-equipment-services">Health Care Equipment and Services</option>
                                <option value="household-personal-products">Household and Personal Products</option>
                                <option value="insurance">Insurance</option>
                                <option value="materials">Materials</option>
                                <option value="media-entertainment">Media and Entertainment</option>
                                <option value="pharmaceuticals-biotechnology-life-sciences">Pharmaceuticals, Biotechnology, and Life Sciences</option>
                                <option value="real-estate">Real Estate</option>
                                <option value="retailing">Retailing</option>
                                <option value="semiconductors-semiconductor-equipment">Semiconductors and Semiconductor Equipment</option>
                                <option value="software-services">Software and Services</option>
                                <option value="technology-hardware-equipment">Technology Hardware and Equipment</option>
                                <option value="telecommunication-services">Telecommunication Services</option>
                                <option value="transportation">Transportation</option>
                                <option value="utilities">Utilities</option>
                                <option value="government">Government</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6 need_full">
                        <div class="form-group">
                            <label>Product Category</label><br>

                            <input type="checkbox" id="hardware-one-time" name="service[]" value="Hardware – One Time" onchange="showAdditionalProductCategoryFields()">
                            <label for="hardware-one-time">Hardware – One Time</label><br>

                            <input type="checkbox" id="hardware-maintenance" name="service[]" value="Hardware – Maintenance Contracts" onchange="showAdditionalProductCategoryFields()">
                            <label for="hardware-maintenance">Hardware – Maintenance Contracts</label><br>

                            <input type="checkbox" id="software-recurring" name="service[]" value="Software – Recurring" onchange="showAdditionalProductCategoryFields()">
                            <label for="software-recurring">Software – Recurring</label><br>

                            <input type="checkbox" id="software-one-time" name="service[]" value="Software – One Time" onchange="showAdditionalProductCategoryFields()">
                            <label for="software-one-time">Software – One Time</label><br>

                            <input type="checkbox" id="systems-integrations" name="service[]" value="Systems Integrations" onchange="showAdditionalProductCategoryFields()">
                            <label for="systems-integrations">Systems Integrations</label><br>

                            <input type="checkbox" id="subscriptions" name="service[]" value="Subscriptions" onchange="showAdditionalProductCategoryFields()">
                            <label for="subscriptions">Subscriptions</label><br>

                            <input type="checkbox" id="tech-deployment" name="service[]" value="Tech Deployment – Volume based" onchange="showAdditionalProductCategoryFields()">
                            <label for="tech-deployment">Tech Deployment – Volume based</label><br>
                        </div>
                    </div>

                    <div id="hardware-one-time-fields" class="additional-product-category">
                        <label>Hardware – One Time</label>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="product_title_hardware_one_time" name="product_title_hardware_one_time" placeholder="Product Title">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="product_price_hardware_one_time" name="product_price_hardware_one_time" placeholder="Product Price">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="hardware-maintenance-fields" class="additional-product-category">
                        <label>Hardware – Maintenance Contracts</label>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="product_title_hardware_maintenance" name="product_title_hardware_maintenance" placeholder="Product Title">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="product_price_hardware_maintenance" name="product_price_hardware_maintenance" placeholder="Product Price">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="software-recurring-fields" class="additional-product-category">
                        <label>Software – Recurring</label>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="product_title_software_recurring" name="product_title_software_recurring" placeholder="Product Title">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="product_price_software_recurring" name="product_price_software_recurring" placeholder="Product Price">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="software-one-time-fields" class="additional-product-category">
                        <label>Software – One Time</label>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="product_title_software_one_time" name="product_title_software_one_time" placeholder="Product Title">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="product_price_software_one_time" name="product_price_software_one_time" placeholder="Product Price">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="systems-integrations-fields" class="additional-product-category">
                        <label>Systems Integrations</label>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="product_title_systems_integrations" name="product_title_systems_integrations" placeholder="Product Title">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="product_price_systems_integrations" name="product_price_systems_integrations" placeholder="Product Price">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="subscriptions-fields" class="additional-product-category">
                        <label>Subscriptions</label>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="product_title_subscriptions" name="product_title_subscriptions" placeholder="Product Title">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="product_price_subscriptions" name="product_price_subscriptions" placeholder="Product Price">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="tech-deployment-fields" class="additional-product-category">
                        <label>Tech Deployment – Volume based</label>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="product_title_tech_deployment" name="product_title_tech_deployment" placeholder="Product Title">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="product_price_tech_deployment" name="product_price_tech_deployment" placeholder="Product Price">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 need_full">
                        <div class="form-group">
                            <label for="pain_points">Pain Points</label>
                            <input type="text" name="pain_points" value="" placeholder="Enter Pain Points" class="form-control">
                        </div>
                    </div>
                    <div class="col-6 need_full">
                        <div class="form-group">
                            <label for="engagement_level">Engagement Level</label>
                            <select name="engagement_level" id="engagement_level" class="form-control" required>
                                <option value="" selected disabled>Select Engagement Level</option>
                                <option value="ceo">CEO</option>
                                <option value="coo">COO</option>
                                <option value="executive-director">Executive Director</option>
                                <option value="chief-fleet-officer-fleet-operations-director">Chief Fleet Officer / Fleet Operations Director</option>
                                <option value="head-of-innovation-data-science">Head of Innovation / Data Science</option>
                                <option value="vice-president">Vice President</option>
                                <option value="director-of-safety-regulations">Director of Safety & Regulations</option>
                                <option value="director-of-logistics">Director of Logistics</option>
                                <option value="vice-president-operations">Vice President - Operations</option>
                                <option value="vice-president-sustainability">Vice President - Sustainability</option>
                                <option value="vice-president-environmental-services">Vice President - Environmental Services</option>
                                <option value="vice-president-fleet-operations">Vice President - Fleet Operations</option>
                                <option value="director-of-global-safety-solutions">Director of Global Safety Solutions</option>
                                <option value="vice-president-procurement">Vice President - Procurement</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6 need_full">
                        <div class="form-group">
                            <label for="revenue_booked_to_date">Revenue booked to date</label>
                            <input type="text" name="revenue_booked_to_date" value="" placeholder="Enter Revenue booked to date" class="form-control">
                        </div>
                    </div>
                    <div class="col-6 need_full">
                        <div class="form-group">
                            <label for="referred_by">Referred by / Connection</label>
                            <input type="text" name="referred_by" value="" placeholder="Enter Referred by / Connection" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="col-12  p-0 modaltitle pb-3 mb-3 mt-4">
                    <h5 style="margin-left: 14px;"><?php echo e(__('Opportunities')); ?></h5>
                </div>
                <div class="row">
                    <div class="col-6 need_full">
                        <div class="form-group">
                            <label for="measure_units_quantity">Measure / Units / Quantity (Opportunity Size)</label>
                            <select name="measure_units_quantity" id="measure_units_quantity" class="form-control" required>
                                <option value="" selected disabled>Select Measure / Units / Quantity</option>
                                <option value="spaces">Spaces</option>
                                <option value="locations">Locations</option>
                                <option value="count-quantity">Count / Quantity</option>
                                <option value="vehicles">Vehicles</option>
                                <option value="sites">Sites</option>
                                <option value="chargers">Chargers</option>
                                <option value="volume">Volume</option>
                                <option value="transactions-count">Transactions Count</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6 need_full">
                        <div class="form-group">
                            <label for="value_of_opportunity">Value of Opportunity ( Options in UK Pounds and US Dollars)</label>
                            <input type="text" name="value_of_opportunity" value="" placeholder="Enter Value of Opportunity" class="form-control">
                        </div>
                    </div>
                    <div class="col-6 need_full">
                        <div class="form-group">
                            <label for="timing_close">Timing – Close</label>
                            <select name="timing_close" id="timing_close" class="form-control" required>
                                <option value="" selected disabled>Select Timing – Close</option>
                                <option value="immediate">Immediate</option>
                                <option value="0-30-days">0-30 Days</option>
                                <option value="31-90-days">31 – 90 Days</option>
                                <option value="91-180-days">91 – 180 Days</option>
                                <option value="181-360-days">181 – 360 Days</option>
                                <option value="12-months-plus">12 Months +</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6 need_full">
                        <div class="form-group">
                            <label for="lead_status">Status</label>
                            <select name="lead_status" id="lead_status" class="form-control" required>
                                <option value="" selected disabled>Select Status</option>
                                <option value="New">New: Indicates a new lead or opportunity that has just been added to the system.</option>
                                <option value="Contacted">Contacted: The lead has been contacted but no further action has been taken yet.</option>
                                <option value="Qualifying">Qualifying: The lead is being assessed to determine if it fits the criteria for a potential deal.</option>
                                <option value="Qualified">Qualified: The lead has been qualified and is deemed a valid opportunity.</option>
                                <option value="Proposal Sent">Proposal Sent: A proposal or quotation has been sent to the potential client.</option>
                                <option value="Negotiation">Negotiation: Active discussions and negotiations are taking place with the client.</option>
                                <option value="Awaiting Decision">Awaiting Decision: Waiting for the client to make a decision based on the proposal and negotiations.</option>
                                <option value="Closed Won">Closed Won: The deal has been successfully closed and the client has agreed to the terms.</option>
                                <option value="Closed Lost">Closed Lost: The deal has been lost or the client has decided not to proceed.</option>
                                <option value="Closed No Decision">Closed No Decision: The deal has been closed without any decision, often due to inactivity or the client's indecision.</option>
                                <option value="Follow-Up Needed">Follow-Up Needed: The deal requires follow-up actions or additional information.</option>
                                <option value="On Hold">On Hold: The deal is temporarily paused or delayed, possibly awaiting further information or changes in client status.</option>
                                <option value="Implementation">Implementation: The deal is won, and the implementation or delivery process is in progress.</option>
                                <option value="Renewal">Renewal: The deal is in the stage of renewal, typically for subscription-based or recurring services/products.</option>
                                <option value="Upsell">Upsell: There is an opportunity to sell additional products or services to the client.</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6 need_full">
                        <div class="form-group">
                            <label for="deal_length">Deal Length</label>
                            <select name="deal_length" id="deal_length" class="form-control" required>
                                <option value="" selected disabled>Select Deal Length</option>
                                <option value="One Time">One Time</option>
                                <option value="Short Term">Short Term</option>
                                <option value="On a Needed basis">On a Needed basis</option>
                                <option value="Annual">Annual</option>
                                <option value="Multi Year">Multi Year</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6 need_full">
                        <div class="form-group">
                            <label for="difficult_level">Difficult Level</label>
                            <select name="difficult_level" id="difficult_level" class="form-control" required>
                                <option value="" selected disabled>Select Difficult Level</option>
                                <option value="Very Easy">Very Easy: The deal is expected to close with minimal effort; there are no significant obstacles.</option>
                                <option value="Easy">Easy: The deal is likely to close without major challenges; some effort is required but no significant hurdles are anticipated.</option>
                                <option value="Moderate">Moderate: The deal has some challenges that need to be addressed, but it is still attainable with reasonable effort.</option>
                                <option value="Challenging">Challenging: The deal presents several significant challenges that will require substantial effort and strategic planning to overcome.</option>
                                <option value="Difficult">Difficult: The deal has numerous obstacles and requires a high level of effort, resources, and strategy to move forward.</option>
                                <option value="Very Difficult">Very Difficult: The deal is expected to be very hard to close due to major hurdles, high competition, or other significant barriers.</option>
                                <option value="Complex">Complex: The deal involves multiple stakeholders, lengthy negotiations, and complex requirements, making it harder to manage and close.</option>
                                <option value="High Risk">High Risk: The deal has a high likelihood of not closing due to various risk factors such as financial instability of the client, high competition, or uncertain requirements.</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6 need_full">
                        <div class="form-group">
                            <label for="probability_to_close">Probability to close</label>
                            <select name="probability_to_close" id="probability_to_close" class="form-control" required>
                                <option value="" selected disabled>Select Probability to close</option>
                                <option value="Highly Probable">Highly Probable: The deal is very likely to close with minimal obstacles. Probability of success is above 90%.</option>
                                <option value="Probable">Probable: The deal is likely to close with some manageable challenges. Probability of success is between 70% and 90%.</option>
                                <option value="Likely">Likely: The deal has a good chance of closing, but there are noticeable challenges that need to be addressed. Probability of success is between 50% and 70%.</option>
                                <option value="Possible">Possible: The deal has a reasonable chance of closing, but significant effort and resources are required to overcome the challenges. Probability of success is between 30% and 50%.</option>
                                <option value="Unlikely">Unlikely: The deal has several substantial obstacles, making it less likely to close. Probability of success is between 10% and 30%.</option>
                                <option value="Highly Unlikely">Highly Unlikely: The deal faces numerous major challenges and is very unlikely to close. Probability of success is below 10%.</option>
                                <option value="Unknown">Unknown: The probability of the deal closing is unclear due to insufficient information or rapidly changing circumstances. Further analysis is needed.</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="notes">Notes</label>
                            <textarea name="notes" class="form-control" cols="30" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group" style="margin-top: 35px;">
                            <?php echo e(Form::label('name',__('Active'),['class'=>'form-label'])); ?>

                            <input type="checkbox" class="form-check-input" name="is_active" checked>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <?php echo e(Form::submit(__('Save'),array('class'=>'btn btn-primary  '))); ?>

                        </div>
                    </div>
                </div>
                <?php echo e(Form::close()); ?>

            </div>
            <div id="barmenu1" class="tab-pane fade mt-5">
                <?php echo e(Form::open(array('route'=>['importuser'],'method'=>'post','enctype'=>'multipart/form-data'))); ?>

                <div class="row">
                    <input type="hidden" name="customerType" value="uploadFile" />
                    <div class="col-12">
                        <div class="form-group">
                            <label for="category">Select Category</label>
                            <select name="category" id="category" class="form-control" required>
                                <option selected disabled value="">Select Category</option>
                                <?php $__currentLoopData = $campaign_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campaign): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($campaign); ?>" class="form-control"><?php echo e($campaign); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <!-- <div class="col-12">
                        <div class="form-group">
                            <label for="comments">Notes</label>
                           <textarea name="comments" class="form-control" cols="30" rows="5"></textarea>
                        </div>
                    </div> -->
                    <div class="col-12">
                        <div class="form-group">
                            <label for="users">Upload File</label>
                            <input type="file" name="users" id="users" class="form-control" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <?php echo e(Form::submit(__('Save'),array('class'=>'btn btn-primary  '))); ?>

                        </div>
                    </div>
                </div>
                <?php echo e(Form::close()); ?>


                <div class="row">
                    <div class="col-md-12">
                        <span>
                            <h4><b>User's Sample sheet</b></h4>
                        </span>
                        <a href="<?php echo e(asset('/samplecsvuser/usersheet.csv')); ?>" class="btn " title="Download" style="background-color:#77aaaf; color:white" download><i class="fa fa-download"></i></a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<style>
    li:has(> a.active) {
        border-color: #2980b9;
        box-shadow: 0 0 15px rgba(41, 128, 185, 0.8);
    }
</style>
<script>
    $(document).ready(function() {
        $("input[type='text'][name= 'name'],input[type='text'][name= 'email'], select[name='category'],input[type='tel'][name='phone']").focusout(function() {
            var input = $(this);
            var errorMessage = '';
            if (input.attr('name') === 'email' && input.val() !== '') {
                var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailPattern.test(input.val())) {
                    errorMessage = 'Invalid email address.';
                }
            } else if (input.val() == '') {
                errorMessage = 'This field is required.';
            }

            if (errorMessage != '') {
                input.css('border', 'solid 2px red');
            } else {
                // If it is not blank. 
                input.css('border', 'solid 2px black');
            }

            // Remove any existing error message
            input.next('.validation-error').remove();

            // Append the error message if it exists
            if (errorMessage != '') {
                input.after('<div class="validation-error text-danger" style="padding:2px;">' + errorMessage + '</div>');
            }
        });

        $("#imported").validate({
            onfocusout: false,
            rules: {
                'name': {
                    required: true
                },
                'email': {
                    required: true,
                    email: true
                },
                'category': {
                    required: true
                },
                'phone': {
                    required: true
                }
            },
            messages: {
                'name': {
                    required: "Please enter your name"
                },
                'email': {
                    required: "Please enter your email",
                    email: "Please enter a valid email address"
                },
                'category': {
                    required: "Please select a category"
                },
                'phone': {
                    required: "Please enter your phone number"
                }
            },
            errorPlacement: function(error, element) {
                // Display error message inline
                error.insertAfter(element);
            },
            highlight: function(element, errorClass, validClass) {
                // Highlight input fields with error
                $(element).addClass(errorClass).removeClass(validClass);
            },
            unhighlight: function(element, errorClass, validClass) {
                // Unhighlight input fields on valid input
                $(element).removeClass(errorClass).addClass(validClass);
            }
        });
    });
</script>
<script>
    document.getElementById('region').addEventListener('change', function() {
        var otherRegionInput = document.getElementById('other_region_input');
        if (this.value === 'other') {
            otherRegionInput.style.display = 'block';
            document.getElementById('other_region').required = true;
        } else {
            otherRegionInput.style.display = 'none';
            document.getElementById('other_region').required = false;
        }
    });
</script>
<script>
    function showAdditionalProductCategoryFields() {
        const categories = [
            'hardware-one-time',
            'hardware-maintenance',
            'software-recurring',
            'software-one-time',
            'systems-integrations',
            'subscriptions',
            'tech-deployment'
        ];

        categories.forEach(category => {
            const checkbox = document.getElementById(category);
            const fields = document.getElementById(category + '-fields');
            if (checkbox.checked) {
                fields.style.display = 'block';
            } else {
                fields.style.display = 'none';
            }
        });
    }

    document.addEventListener('DOMContentLoaded', showAdditionalProductCategoryFields);
</script><?php /**PATH C:\xampp\htdocs\volo\resources\views/customer/uploaduserinfo.blade.php ENDPATH**/ ?>