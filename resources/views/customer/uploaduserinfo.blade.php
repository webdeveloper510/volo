@php
$settings = App\Models\Utility::settings();
$campaign_type = explode(',',$settings['campaign_type']);
$regions = explode(',', $settings['region']);
@endphp
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
                <a style="color: white;font-size: larger;" data-toggle="tab" href="#barmenu0" class="active" onclick="changeNavbarLabelText(this)">Individual Client</a>
            </li>
            <li class="badge rounded p-2 m-1 px-3 bg-primary">
                <a style="color: white;    font-size: larger;" data-toggle="tab" href="#barmenu1" onclick="changeNavbarLabelText(this)">Bulk Upload</a>
            </li>
        </ul>
        <div class="tab-content">
            <div id="barmenu0" class="tab-pane fade in active show mt-5">
                {{Form::open(array('route'=>['importuser'],'method'=>'post','enctype'=>'multipart/form-data','id'=>'imported'))}}
                <div class="row">
                    <div class="col-6 need_full">
                        <div class="form-group">
                            {{Form::label('company_name',__('Company Name'),['class'=>'form-label']) }}
                            <span class="text-sm">
                                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                            </span>
                            {{Form::text('company_name',null,array('class'=>'form-control','placeholder'=>__('Enter Company Name'),'required'=>'required'))}}
                        </div>
                    </div>
                    <!-- <div class="col-6 need_full">
                        <div class="form-group">
                            {{Form::label('client_name',__('Client Name'),['class'=>'form-label']) }}
                            <span class="text-sm">
                                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                            </span>
                            {{Form::text('client_name',null,array('class'=>'form-control','placeholder'=>__('Enter Client Name'),'required'=>'required'))}}
                        </div>
                    </div> -->
                    <div class="col-6 need_full">
                        <div class="form-group">
                            {{Form::label('entity_name',__('Legal Entity Name'),['class'=>'form-label']) }}
                            <span class="text-sm">
                                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                            </span>
                            {{Form::text('entity_name',null,array('class'=>'form-control','placeholder'=>__('Enter Legal Entity Name'),'required'=>'required'))}}
                        </div>
                    </div>
                </div>

                <div class="col-12  p-0 modaltitle pb-3 mb-3 mt-4">
                    <h5 style="margin-left: 14px;">{{ __('Primary Contact Information') }}</h5>
                </div>
                <div class="row">
                    <div class="col-6 need_full">
                        <input type="hidden" name="customerType" value="addForm" />
                        <div class="form-group">
                            {{Form::label('primary_name',__('Name'),['class'=>'form-label']) }}
                            <span class="text-sm">
                                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                            </span>
                            {{Form::text('primary_name',null,array('class'=>'form-control','placeholder'=>__('Enter Name'),'required'=>'required'))}}
                        </div>
                    </div>
                    <div class="col-6 need_full">
                        <div class="form-group ">
                            {{Form::label('primary_phone_number',__('Phone Number'),['class'=>'form-label']) }}
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
                            {{Form::label('primary_email',__('Email'),['class'=>'form-label']) }}
                            <span class="text-sm">
                                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                            </span>
                            {{Form::text('primary_email',null,array('class'=>'form-control','placeholder'=>__('Enter Email'),'required'=>'required'))}}
                        </div>
                    </div>
                    <div class="col-6 need_full">
                        <div class="form-group">
                            {{Form::label('primary_address',__('Address'),['class'=>'form-label']) }}

                            {{Form::text('primary_address',null,array('class'=>'form-control','placeholder'=>__('Enter Address')))}}
                        </div>
                    </div>
                    <div class="col-6 need_full">
                        <div class="form-group">
                            {{Form::label('primary_organization',__('Title/Designation'),['class'=>'form-label']) }}
                            {{Form::text('primary_organization',null,array('class'=>'form-control','placeholder'=>__('Enter Designation')))}}
                        </div>
                    </div>
                </div>

                <div class="col-12  p-0 modaltitle pb-3 mb-3 mt-4">
                    <h5 style="margin-left: 14px;">{{ __('Secondary Contact Information') }}</h5>
                </div>
                <div class="row">
                    <div class="col-6 need_full">
                        <input type="hidden" name="customerType" value="addForm" />
                        <div class="form-group">
                            {{Form::label('secondary_name',__('Name'),['class'=>'form-label']) }}
                            {{Form::text('secondary_name',null,array('class'=>'form-control','placeholder'=>__('Enter Name')))}}
                        </div>
                    </div>
                    <div class="col-6 need_full">
                        <div class="form-group ">
                            {{Form::label('secondary_phone_number',__('Phone Number'),['class'=>'form-label']) }}
                            <div class="intl-tel-input">
                                <input type="tel" id="phone-input1" name="secondary_phone_number" class="phone-input form-control" placeholder="Enter Phone Number" maxlength="16">
                                <!-- <input type="hidden" name="secondary_countrycode" id="secondary-country-code"> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-6 need_full">
                        <div class="form-group">
                            {{Form::label('secondary_email',__('Email'),['class'=>'form-label']) }}
                            {{Form::text('secondary_email',null,array('class'=>'form-control','placeholder'=>__('Enter Email')))}}
                        </div>
                    </div>
                    <div class="col-6 need_full">
                        <div class="form-group">
                            {{Form::label('secondary_address',__('Address'),['class'=>'form-label']) }}
                            {{Form::text('secondary_address',null,array('class'=>'form-control','placeholder'=>__('Enter Address')))}}
                        </div>
                    </div>
                    <div class="col-6 need_full">
                        <div class="form-group">
                            {{Form::label('secondary_designation',__('Title/Designation'),['class'=>'form-label']) }}
                            {{Form::text('secondary_designation',null,array('class'=>'form-control','placeholder'=>__('Enter Designation')))}}
                        </div>
                    </div>
                </div>

                <div class="col-12  p-0 modaltitle pb-3 mb-3 mt-4">
                    <h5 style="margin-left: 14px;">{{ __('Other Information') }}</h5>
                </div>
                <div class="row">
                    <div class="col-6 need_full">
                        <div class="form-group">
                            <label for="location">Location / Geography</label>
                            <select name="location" id="location" class="form-control">
                                <option value="" selected disabled>Select Location / Geography</option>
                                <option value="Asia" class="form-control">Asia</option>
                                <option value="Africa" class="form-control">Africa</option>
                                <option value="Europe" class="form-control">Europe</option>
                                <option value="North America" class="form-control">North America</option>
                                <option value="South America" class="form-control">South America</option>
                                <option value="Australia" class="form-control">Australia</option>
                                <option value="Global" class="form-control">Global</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6 need_full">
                        <div class="form-group">
                            <label for="region">Region</label>
                            <select name="region" id="region" class="form-control">
                                <option value="" selected disabled>Select Region</option>
                                @foreach($regions as $region)
                                <option value="{{ $region }}" class="form-control">{{ $region }}</option>
                                @endforeach
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
                            <select name="industry[]" id="industry" class="form-control" multiple>
                                <option value="" selected disabled>Select Industries</option>
                                <option value="Automobiles and Components">Automobiles and Components</option>
                                <option value="Banks">Banks</option>
                                <option value="Hubs">Hubs</option>
                                <option value="Capital Goods">Capital Goods</option>
                                <option value="Commercial and Professional Services">Commercial and Professional Services</option>
                                <option value="Consumer Durables and Apparel">Consumer Durables and Apparel</option>
                                <option value="Consumer Services">Consumer Services</option>
                                <option value="Diversified Financials">Diversified Financials</option>
                                <option value="Energy">Energy</option>
                                <option value="Food, Beverage, and Tobacco">Food, Beverage, and Tobacco</option>
                                <option value="Food and Staples Retailing">Food and Staples Retailing</option>
                                <option value="Health Care Equipment and Services">Health Care Equipment and Services</option>
                                <option value="Household and Personal Products">Household and Personal Products</option>
                                <option value="Insurance">Insurance</option>
                                <option value="Materials">Materials</option>
                                <option value="Media and Entertainment">Media and Entertainment</option>
                                <option value="Pharmaceuticals, Biotechnology, and Life Sciences">Pharmaceuticals, Biotechnology, and Life Sciences</option>
                                <option value="real-estate">Real Estate</option>
                                <option value="retailing">Retailing</option>
                                <option value="Semiconductors and Semiconductor Equipment">Semiconductors and Semiconductor Equipment</option>
                                <option value="Software and Services">Software and Services</option>
                                <option value="Technology Hardware and Equipment">Technology Hardware and Equipment</option>
                                <option value="telecommunication-services">Telecommunication Services</option>
                                <option value="Telecommunication Services">Transportation</option>
                                <option value="Utilities">Utilities</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6 need_full">
                        <div class="form-group">
                            <label for="engagement_level">Engagement Level</label>
                            <select name="engagement_level" id="engagement_level" class="form-control">
                                <option value="" selected disabled>Select Engagement Level</option>
                                <option value="CEO">CEO</option>
                                <option value="COO">COO</option>
                                <option value="Executive Director">Executive Director</option>
                                <option value="Chief Fleet Officer / Fleet Operations Director">Chief Fleet Officer / Fleet Operations Director</option>
                                <option value="Head of Innovation / Data Science">Head of Innovation / Data Science</option>
                                <option value="Vice President">Vice President</option>
                                <option value="Director of Safety & Regulations">Director of Safety & Regulations</option>
                                <option value="Director of Logistics">Director of Logistics</option>
                                <option value="Vice President - Operations">Vice President - Operations</option>
                                <option value="Vice President - Sustainability">Vice President - Sustainability</option>
                                <option value="Vice President - Environmental Services">Vice President - Environmental Services</option>
                                <option value="Vice President - Fleet Operations">Vice President - Fleet Operations</option>
                                <option value="Director of Global Safety Solutions">Director of Global Safety Solutions</option>
                                <option value="Vice President - Procurement">Vice President - Procurement</option>
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
                        {{Form::label('name',__('Active'),['class'=>'form-label']) }}
                        <input type="checkbox" class="form-check-input" name="is_active" checked>
                    </div>
                </div>
                <div class="col-12">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        {{Form::submit(__('Save'),array('class'=>'btn btn-primary  '))}}
                    </div>
                </div>
                {{Form::close()}}
            </div>
            <div id="barmenu1" class="tab-pane fade mt-5">
                {{Form::open(array('route'=>['importuser'],'method'=>'post','enctype'=>'multipart/form-data'))}}
                <div class="row">
                    <input type="hidden" name="customerType" value="uploadFile" />
                    <div class="col-12">
                        <div class="form-group">
                            <label for="category">Select Category</label>
                            <select name="category" id="category" class="form-control" required>
                                <option selected disabled value="">Select Category</option>
                                @foreach($campaign_type as $campaign)
                                <option value="{{$campaign}}" class="form-control">{{$campaign}}</option>
                                @endforeach
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
                            {{Form::submit(__('Save'),array('class'=>'btn btn-primary  '))}}
                        </div>
                    </div>
                </div>
                {{Form::close()}}

                <div class="row">
                    <div class="col-md-12">
                        <span>
                            <h4><b>User's Sample sheet</b></h4>
                        </span>
                        <a href="{{asset('/samplecsvuser/usersheet.csv')}}" class="btn " title="Download" style="background-color:#77aaaf; color:white" download><i class="fa fa-download"></i></a>
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
</script>
<script>
    function changeNavbarLabelText(e) {
        var tabText = $(e).text().trim();
        var text = '';
        console.log(tabText);

        if (tabText.includes('Individual Client')) {
            text = 'New Client';
        } else if (tabText.includes('Bulk Upload')) {
            text = 'Upload Client';
        }

        console.log(text);

        $('#modelCommanModelLabel').text(text);

    }
</script>