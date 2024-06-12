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
</style>
<div class="form-group col-md-12">
    <div class="badges">
        <ul class="nav nav-tabs tabActive" style="border-bottom: none">
            <li class="badge rounded p-2 m-1 px-3 bg-primary">
                <a style="color: white;font-size: larger;" data-toggle="tab" href="#barmenu0" class="active">Individual
                    Client</a>
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
                            <?php echo e(Form::label('primary_name',__('Name'),['class'=>'form-label'])); ?>

                            <span class="text-sm">
                                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                            </span>
                            <?php echo e(Form::text('primary_name',null,array('class'=>'form-control','placeholder'=>__('Enter Name'),'required'=>'required'))); ?>

                        </div>
                    </div>
                    <div class="col-6 need_full">
                        <div class="form-group ">
                            <?php echo e(Form::label('primary_phone_number',__('Phone Number'),['class'=>'form-label'])); ?>

                            <span class="text-sm">
                                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                            </span>
                            <div class="intl-tel-input">
                                <input type="tel" id="phone-input" name="primary_phone_number" class="phone-input form-control" placeholder="Enter Phone Number" maxlength="16">
                                <!-- <input type="hidden" name="primary_countrycode" id="primary-country-code"> -->
                            </div>
                        </div>
                    </div>

                    <div class="col-6 need_full">
                        <div class="form-group">
                            <?php echo e(Form::label('primary_email',__('Email'),['class'=>'form-label'])); ?>

                            <span class="text-sm">
                                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                            </span>
                            <?php echo e(Form::text('primary_email',null,array('class'=>'form-control','placeholder'=>__('Enter Email'),'required'=>'required'))); ?>

                        </div>
                    </div>
                    <div class="col-6 need_full">
                        <div class="form-group">
                            <?php echo e(Form::label('primary_address',__('Address'),['class'=>'form-label'])); ?>


                            <?php echo e(Form::text('primary_address',null,array('class'=>'form-control','placeholder'=>__('Enter Address')))); ?>

                        </div>
                    </div>
                    <div class="col-6 need_full">
                        <div class="form-group">
                            <?php echo e(Form::label('primary_organization',__('Title/Designation'),['class'=>'form-label'])); ?>

                            <?php echo e(Form::text('primary_organization',null,array('class'=>'form-control','placeholder'=>__('Enter Designation')))); ?>

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

                            <?php echo e(Form::text('secondary_name',null,array('class'=>'form-control','placeholder'=>__('Enter Name'),'required'=>'required'))); ?>

                        </div>
                    </div>
                    <div class="col-6 need_full">
                        <div class="form-group ">
                            <?php echo e(Form::label('secondary_phone_number',__('Phone Number'),['class'=>'form-label'])); ?>

                            <div class="intl-tel-input">
                                <input type="tel" id="phone-input1" name="secondary_phone_number" class="phone-input form-control" placeholder="Enter Phone Number" maxlength="16">
                                <!-- <input type="hidden" name="secondary_countrycode" id="secondary-country-code"> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-6 need_full">
                        <div class="form-group">
                            <?php echo e(Form::label('secondary_email',__('Email'),['class'=>'form-label'])); ?>

                            <?php echo e(Form::text('secondary_email',null,array('class'=>'form-control','placeholder'=>__('Enter Email')))); ?>

                        </div>
                    </div>
                    <div class="col-6 need_full">
                        <div class="form-group">
                            <?php echo e(Form::label('secondary_address',__('Address'),['class'=>'form-label'])); ?>

                            <?php echo e(Form::text('secondary_address',null,array('class'=>'form-control','placeholder'=>__('Enter Address')))); ?>

                        </div>
                    </div>
                    <div class="col-6 need_full">
                        <div class="form-group">
                            <?php echo e(Form::label('secondary_designation',__('Title/Designation'),['class'=>'form-label'])); ?>

                            <?php echo e(Form::text('secondary_designation',null,array('class'=>'form-control','placeholder'=>__('Enter Designation')))); ?>

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
                            <select name="location" id="location" class="form-control" required>
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
                            <label for="industry">Industries</label>
                            <select name="industry[]" id="industry" class="form-control" multiple required>
                                <option value="" selected disabled>Select Industries</option>
                                <option value="automobiles-components">Automobiles and Components</option>
                                <option value="banks">Banks</option>
                                <option value="hubs">Hubs</option>
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
                            </select>
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
                    <div class="col-12">
                        <div class="form-group">
                            <label for="pain_points">Pain Points</label>
                            <textarea name="pain_points" class="form-control" cols="30" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="notes">Notes</label>
                            <textarea name="notes" class="form-control" cols="30" rows="5"></textarea>
                        </div>
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
        $("input[type='text'][name= 'primary_name'],input[type='text'][name= 'primary_email'], select[name='category'],input[type='tel'][name='primary_phone_number']").focusout(function() {
            var input = $(this);
            var errorMessage = '';
            if (input.attr('name') === 'primary_email' && input.val() !== '') {
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
                'primary_name': {
                    required: true
                },
                'primary_email': {
                    required: true,
                    email: true
                },
                'category': {
                    required: true
                },
                'primary_phone_number': {
                    required: true
                }
            },
            messages: {
                'primary_name': {
                    required: "Please enter your name"
                },
                'primary_email': {
                    required: "Please enter your email",
                    email: "Please enter a valid email address"
                },
                'category': {
                    required: "Please select a category"
                },
                'primary_phone_number': {
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
</script>
<script>
    $(document).ready(function() {
        // Function to handle cloning
        $('.additional-product-category').on('click', '.clone-btn', function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Get the parent .additional-product-category div
            var parentDiv = $(this).closest('.additional-product-category');

            // Get the first .row div inside the parent
            var rowDiv = parentDiv.find('.row').first();

            // Clone the .row div
            var clone = rowDiv.clone();

            // Get all input fields in the clone and clear their values
            clone.find('input').val('');

            // Append a remove button to the cloned row
            clone.append('<i class="fas fa-minus remove-btn"></i>');

            // Insert the clone after the last .row div inside the parent
            parentDiv.append(clone);
        });

        // Function to handle removal
        $('.additional-product-category').on('click', '.remove-btn', function(event) {
            event.preventDefault();
            $(this).closest('.row').remove();
        });
    });
</script><?php /**PATH C:\xampp\htdocs\volo\resources\views/customer/uploaduserinfo.blade.php ENDPATH**/ ?>