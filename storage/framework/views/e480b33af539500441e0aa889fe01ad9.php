<?php
$settings = App\Models\Utility::settings();
$campaign_type = explode(',',$settings['campaign_type']);
$regions = explode(',', $settings['region']);
?>


<?php $__env->startSection('page-title'); ?>
<?php echo e(__('Client Edit')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
<div class="page-header-title">
    <?php echo e(__('Edit Client')); ?> <?php echo e('(' . $client->company_name . ')'); ?>

</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
<li class="breadcrumb-item"><a href="<?php echo e(route('siteusers')); ?>"><?php echo e(__('Clients')); ?></a></li>
<li class="breadcrumb-item"><?php echo e(__('Details')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<style>
    .fa-asterisk {
        font-size: xx-small;
        position: absolute;
        padding: 1px;
    }

    .plus-btn i.fas.fa-plus.clone-btn {
        color: #fff;
        background: #48494b;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 10px;
    }

    .plus-btn {
        text-align: right;
        margin-top: -10px;
    }

    i.fas.fa-minus.remove-btn {
        color: #fff;
        background: #48494b;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 10px;
    }

    .minus-btn {
        text-align: right;
        margin-top: -10px;
    }
</style>
<div class="container-field">
    <div id="wrapper">
        <div id="page-content-wrapper">
            <div class="container-fluid xyz p0">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="tab-content">
                            <div class="tab-pane fade in active show mt-5">
                                <?php echo e(Form::open(['route' => ['client.update', $client->id], 'method' => 'post'])); ?>

                                <div class="row">
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            <?php echo e(Form::label('company_name',__('Company Name'),['class'=>'form-label'])); ?>

                                            <span class="text-sm">
                                                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                            </span>
                                            <?php echo e(Form::text('company_name', $client->company_name, array('class'=>'form-control','placeholder'=>__('Enter Company Name'),'required'=>'required'))); ?>

                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            <?php echo e(Form::label('entity_name',__('Legal Entity Name'),['class'=>'form-label'])); ?>

                                            <span class="text-sm">
                                                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                            </span>
                                            <?php echo e(Form::text('entity_name', $client->entity_name, array('class'=>'form-control','placeholder'=>__('Enter Legal Entity Name'),'required'=>'required'))); ?>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-12  p-0 modaltitle pb-3 mb-3 mt-4">
                                    <h5 style="margin-left: 14px;"><?php echo e(__('Primary Contact Information')); ?></h5>
                                </div>
                                <div class="row">
                                    <div class="col-6 need_full">
                                        <input type="hidden" name="customerType" value="addForm" />
                                        <div class="form-group">
                                            <?php echo e(Form::label('primary_name',__('Name'),['class'=>'form-label'])); ?>

                                            <span class="text-sm">
                                                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                            </span>
                                            <?php echo e(Form::text('primary_name', $client->primary_name, array('class'=>'form-control','placeholder'=>__('Enter Name'),'required'=>'required'))); ?>

                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group ">
                                            <?php echo e(Form::label('primary_phone_number',__('Phone Number'),['class'=>'form-label'])); ?>

                                            <span class="text-sm">
                                                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                            </span>
                                            <div class="intl-tel-input">
                                                <input type="tel" id="phone-input" name="primary_phone_number" class="phone-input form-control" value="<?php echo e($client->primary_phone_number); ?>" placeholder="Enter Phone Number" maxlength="16">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            <?php echo e(Form::label('primary_email',__('Email'),['class'=>'form-label'])); ?>

                                            <span class="text-sm">
                                                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                            </span>
                                            <?php echo e(Form::text('primary_email', $client->primary_email, array('class'=>'form-control','placeholder'=>__('Enter Email'),'required'=>'required'))); ?>

                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            <?php echo e(Form::label('primary_address',__('Address'),['class'=>'form-label'])); ?>


                                            <?php echo e(Form::text('primary_address', $client->primary_address, array('class'=>'form-control','placeholder'=>__('Enter Address')))); ?>

                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            <?php echo e(Form::label('primary_organization',__('Title/Designation'),['class'=>'form-label'])); ?>

                                            <?php echo e(Form::text('primary_organization', $client->primary_organization, array('class'=>'form-control','placeholder'=>__('Enter Designation')))); ?>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-12  p-0 modaltitle pb-3 mb-3 mt-4">
                                    <h5 style="margin-left: 14px;"><?php echo e(__('Secondary Contact Information')); ?></h5>
                                </div>
                                <div class="row">
                                    <div class="col-6 need_full">
                                        <input type="hidden" name="customerType" value="addForm" />
                                        <div class="form-group">
                                            <?php echo e(Form::label('secondary_name',__('Name'),['class'=>'form-label'])); ?>

                                            <?php echo e(Form::text('secondary_name', $client->secondary_name, array('class'=>'form-control','placeholder'=>__('Enter Name')))); ?>

                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group ">
                                            <?php echo e(Form::label('secondary_phone_number',__('Phone Number'),['class'=>'form-label'])); ?>

                                            <div class="intl-tel-input">
                                                <input type="tel" id="phone-input1" name="secondary_phone_number" class="phone-input form-control" value="<?php echo e($client->secondary_phone_number); ?>" placeholder="Enter Phone Number" maxlength="16">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            <?php echo e(Form::label('secondary_email',__('Email'),['class'=>'form-label'])); ?>

                                            <?php echo e(Form::text('secondary_email', $client->secondary_email, array('class'=>'form-control','placeholder'=>__('Enter Email')))); ?>

                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            <?php echo e(Form::label('secondary_address',__('Address'),['class'=>'form-label'])); ?>

                                            <?php echo e(Form::text('secondary_address', $client->secondary_address, array('class'=>'form-control','placeholder'=>__('Enter Address')))); ?>

                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            <?php echo e(Form::label('secondary_designation',__('Title/Designation'),['class'=>'form-label'])); ?>

                                            <?php echo e(Form::text('secondary_designation', $client->secondary_designation, array('class'=>'form-control','placeholder'=>__('Enter Designation')))); ?>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-12  p-0 modaltitle pb-3 mb-3 mt-4">
                                    <h5 style="margin-left: 14px;"><?php echo e(__('Other Information')); ?></h5>
                                </div>
                                <div class="row">
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            <label for="location">Location / Geography</label>
                                            <select name="location" id="location" class="form-control">
                                                <option value="" disabled>Select Location / Geography</option>
                                                <option value="Asia" <?php echo e($client->location == 'Asia' ? 'selected' : ''); ?>>Asia</option>
                                                <option value="Africa" <?php echo e($client->location == 'Africa' ? 'selected' : ''); ?>>Africa</option>
                                                <option value="Europe" <?php echo e($client->location == 'Europe' ? 'selected' : ''); ?>>Europe</option>
                                                <option value="North America" <?php echo e($client->location == 'North America' ? 'selected' : ''); ?>>North America</option>
                                                <option value="South America" <?php echo e($client->location == 'South America' ? 'selected' : ''); ?>>South America</option>
                                                <option value="Australia" <?php echo e($client->location == 'Australia' ? 'selected' : ''); ?>>Australia</option>
                                                <option value="Global" <?php echo e($client->location == 'Global' ? 'selected' : ''); ?>>Global</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            <label for="region">Region</label>
                                            <select name="region" id="region" class="form-control">
                                                <option value="" selected disabled>Select Region</option>
                                                <?php $__currentLoopData = $regions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $region): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($region); ?>" <?php echo e($client->region == $region ? 'selected' : ''); ?>><?php echo e($region); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group" id="other_region_input">
                                        <label for="other-region">Add Other Region</label>
                                        <input type="text" name="other_region" id="other_region" class="form-control" value="<?php echo e($client->other_region); ?>" placeholder="Enter Other Region" style="display: none;">
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            <label for="industry">Industries</label>
                                            <select name="industry[]" id="industry" class="form-control" multiple>
                                                <option value="" disabled>Select Industries</option>
                                                <?php
                                                // Decode the JSON string into a PHP array
                                                $selectedIndustries = json_decode($client->industry, true) ?? [];
                                                ?>
                                                <option value="Automobiles and Components" <?php echo e(in_array('Automobiles and Components', $selectedIndustries) ? 'selected' : ''); ?>>Automobiles and Components</option>
                                                <option value="Banks" <?php echo e(in_array('Banks', $selectedIndustries) ? 'selected' : ''); ?>>Banks</option>
                                                <option value="Hubs" <?php echo e(in_array('Hubs', $selectedIndustries) ? 'selected' : ''); ?>>Hubs</option>
                                                <option value="Capital Goods" <?php echo e(in_array('Capital Goods', $selectedIndustries) ? 'selected' : ''); ?>>Capital Goods</option>
                                                <option value="Commercial and Professional Services" <?php echo e(in_array('Commercial and Professional Services', $selectedIndustries) ? 'selected' : ''); ?>>Commercial and Professional Services</option>
                                                <option value="Consumer Durables and Apparel" <?php echo e(in_array('Consumer Durables and Apparel', $selectedIndustries) ? 'selected' : ''); ?>>Consumer Durables and Apparel</option>
                                                <option value="Consumer Services" <?php echo e(in_array('Consumer Services', $selectedIndustries) ? 'selected' : ''); ?>>Consumer Services</option>
                                                <option value="Diversified Financials" <?php echo e(in_array('Diversified Financials', $selectedIndustries) ? 'selected' : ''); ?>>Diversified Financials</option>
                                                <option value="Energy" <?php echo e(in_array('Energy', $selectedIndustries) ? 'selected' : ''); ?>>Energy</option>
                                                <option value="Food, Beverage, and Tobacco" <?php echo e(in_array('Food, Beverage, and Tobacco', $selectedIndustries) ? 'selected' : ''); ?>>Food, Beverage, and Tobacco</option>
                                                <option value="Food and Staples Retailing" <?php echo e(in_array('Food and Staples Retailing', $selectedIndustries) ? 'selected' : ''); ?>>Food and Staples Retailing</option>
                                                <option value="Health Care Equipment and Services" <?php echo e(in_array('Health Care Equipment and Services', $selectedIndustries) ? 'selected' : ''); ?>>Health Care Equipment and Services</option>
                                                <option value="Household and Personal Products" <?php echo e(in_array('Household and Personal Products', $selectedIndustries) ? 'selected' : ''); ?>>Household and Personal Products</option>
                                                <option value="Insurance" <?php echo e(in_array('Insurance', $selectedIndustries) ? 'selected' : ''); ?>>Insurance</option>
                                                <option value="Materials" <?php echo e(in_array('Materials', $selectedIndustries) ? 'selected' : ''); ?>>Materials</option>
                                                <option value="Media and Entertainment" <?php echo e(in_array('Media and Entertainment', $selectedIndustries) ? 'selected' : ''); ?>>Media and Entertainment</option>
                                                <option value="Pharmaceuticals, Biotechnology, and Life Sciences" <?php echo e(in_array('Pharmaceuticals, Biotechnology, and Life Sciences', $selectedIndustries) ? 'selected' : ''); ?>>Pharmaceuticals, Biotechnology, and Life Sciences</option>
                                                <option value="Real Estate" <?php echo e(in_array('Real Estate', $selectedIndustries) ? 'selected' : ''); ?>>Real Estate</option>
                                                <option value="Retailing" <?php echo e(in_array('Retailing', $selectedIndustries) ? 'selected' : ''); ?>>Retailing</option>
                                                <option value="Semiconductors and Semiconductor Equipment" <?php echo e(in_array('Semiconductors and Semiconductor Equipment', $selectedIndustries) ? 'selected' : ''); ?>>Semiconductors and Semiconductor Equipment</option>
                                                <option value="Software and Services" <?php echo e(in_array('Software and Services', $selectedIndustries) ? 'selected' : ''); ?>>Software and Services</option>
                                                <option value="Technology Hardware and Equipment" <?php echo e(in_array('Technology Hardware and Equipment', $selectedIndustries) ? 'selected' : ''); ?>>Technology Hardware and Equipment</option>
                                                <option value="Telecommunication Services" <?php echo e(in_array('Telecommunication Services', $selectedIndustries) ? 'selected' : ''); ?>>Telecommunication Services</option>
                                                <option value="Transportation" <?php echo e(in_array('Transportation', $selectedIndustries) ? 'selected' : ''); ?>>Transportation</option>
                                                <option value="Utilities" <?php echo e(in_array('Utilities', $selectedIndustries) ? 'selected' : ''); ?>>Utilities</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            <label for="engagement_level">Engagement Level</label>
                                            <select name="engagement_level" id="engagement_level" class="form-control">
                                                <option value="" disabled <?php echo e($client->engagement_level ? '' : 'selected'); ?>>Select Engagement Level</option>
                                                <option value="CEO" <?php echo e($client->engagement_level === 'CEO' ? 'selected' : ''); ?>>CEO</option>
                                                <option value="COO" <?php echo e($client->engagement_level === 'COO' ? 'selected' : ''); ?>>COO</option>
                                                <option value="Executive Director" <?php echo e($client->engagement_level === 'Executive Director' ? 'selected' : ''); ?>>Executive Director</option>
                                                <option value="Chief Fleet Officer / Fleet Operations Director" <?php echo e($client->engagement_level === 'Chief Fleet Officer / Fleet Operations Director' ? 'selected' : ''); ?>>Chief Fleet Officer / Fleet Operations Director</option>
                                                <option value="Head of Innovation / Data Science" <?php echo e($client->engagement_level === 'Head of Innovation / Data Science' ? 'selected' : ''); ?>>Head of Innovation / Data Science</option>
                                                <option value="Vice President" <?php echo e($client->engagement_level === 'Vice President' ? 'selected' : ''); ?>>Vice President</option>
                                                <option value="Director of Safety & Regulations" <?php echo e($client->engagement_level === 'Director of Safety & Regulations' ? 'selected' : ''); ?>>Director of Safety & Regulations</option>
                                                <option value="Director of Logistics" <?php echo e($client->engagement_level === 'Director of Logistics' ? 'selected' : ''); ?>>Director of Logistics</option>
                                                <option value="Vice President - Operations" <?php echo e($client->engagement_level === 'Vice President - Operations' ? 'selected' : ''); ?>>Vice President - Operations</option>
                                                <option value="Vice President - Sustainability" <?php echo e($client->engagement_level === 'Vice President - Sustainability' ? 'selected' : ''); ?>>Vice President - Sustainability</option>
                                                <option value="Vice President - Environmental Services" <?php echo e($client->engagement_level === 'Vice President - Environmental Services' ? 'selected' : ''); ?>>Vice President - Environmental Services</option>
                                                <option value="Vice President - Fleet Operations" <?php echo e($client->engagement_level === 'Vice President - Fleet Operations' ? 'selected' : ''); ?>>Vice President - Fleet Operations</option>
                                                <option value="Director of Global Safety Solutions" <?php echo e($client->engagement_level === 'Director of Global Safety Solutions' ? 'selected' : ''); ?>>Director of Global Safety Solutions</option>
                                                <option value="Vice President - Procurement" <?php echo e($client->engagement_level === 'Vice President - Procurement' ? 'selected' : ''); ?>>Vice President - Procurement</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            <label for="category_type">Category</label>
                                            <select name="category_type" id="category" class="form-control">
                                                <option value="" disabled <?php echo e(!$client->category_type ? 'selected' : ''); ?>>Select Category</option>
                                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($category->name); ?>" <?php echo e($client->category_type === $category->name ? 'selected' : ''); ?>>
                                                    <?php echo e($category->name); ?>

                                                </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            <label for="revenue_booked_to_date">Revenue booked to date</label>
                                            <input type="text" name="revenue_booked_to_date" value="<?php echo e($client->revenue_booked_to_date ?? ''); ?>" placeholder="Enter Revenue booked to date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            <label for="referred_by">Referred by / Connection</label>
                                            <input type="text" name="referred_by" value="<?php echo e($client->referred_by ?? ''); ?>" placeholder="Enter Referred by / Connection" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="pain_points">Pain Points</label>
                                            <textarea name="pain_points" class="form-control" cols="30" rows="5"><?php echo e($client->pain_points ?? ''); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="notes">Notes</label>
                                            <textarea name="notes" class="form-control" cols="30" rows="5"><?php echo e($client->notes ?? ''); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group" style="margin-top: 35px;">
                                        <?php echo e(Form::label('is_active',__('Active'),['class'=>'form-label'])); ?>

                                        <input type="checkbox" class="form-check-input" name="is_active" checked>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        <?php echo e(Form::submit(__('Save'),array('class'=>'btn btn-primary  '))); ?>

                                    </div>
                                </div>
                                <?php echo e(Form::close()); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\volo\resources\views/customer/edit.blade.php ENDPATH**/ ?>