@extends('layouts.admin')
@section('page-title')
{{ __('Opportunitie Edit') }}
@endsection
@php
$plansettings = App\Models\Utility::plansettings();
$setting = App\Models\Utility::settings();
$type_arr= explode(',',$setting['event_type']);
$type_arr = array_combine($type_arr, $type_arr);
$venue = explode(',',$setting['venue']);
if(isset($setting['function']) && !empty($setting['function'])){
$function = json_decode($setting['function'],true);
}
if(isset($setting['additional_items']) && !empty($setting['additional_items'])){
$additional_items = json_decode($setting['additional_items'],true);
}
$meal = ['Formal Plated' ,'Buffet Style' , 'Family Style'];
$baropt = ['Open Bar', 'Cash Bar', 'Package Choice'];
if(isset($setting['barpackage']) && !empty($setting['barpackage'])){
$bar_package = json_decode($setting['barpackage'],true);
}

$func_package = json_decode($lead->func_package,true);
$fun_ad_opts = json_decode($lead->ad_opts,true);

@endphp
@section('title')
<div class="page-header-title">
    {{ __('Edit Opportunitie') }} {{ '(' . $lead->name . ')' }}
</div>
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
<li class="breadcrumb-item"><a href="{{ route('lead.index') }}">{{ __('Opportunitie') }}</a></li>
<li class="breadcrumb-item">{{ __('Details') }}</li>
@endsection
@section('content')
<style>
    .fa-asterisk {
        font-size: xx-small;
        position: absolute;
        padding: 1px;
    }
</style>
<div class="container-field">
    <div id="wrapper">

        <div id="page-content-wrapper">
            <div class="container-fluid xyz p0">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="useradd-1" class="card">
                            {{ Form::model($lead, ['route' => ['lead.update', $lead->id], 'method' => 'PUT', 'id' => "formdata"]) }}
                            <div class="card-header">
                                <h5>{{ __('Overview') }}</h5>
                                <small class="text-muted">{{ __('Edit About Your Opportunities Information') }}</small>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            {{Form::label('lead_name',__('Opportunitie Name'),['class'=>'form-label']) }}
                                            <span class="text-sm">
                                                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                            </span>
                                            {{Form::text('lead_name',$lead->leadname,array('class'=>'form-control','placeholder'=>__('Enter Opportunitie Name'),'required'=>'required'))}}
                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            {{Form::label('company_name',__('Company Name'),['class'=>'form-label']) }}
                                            {{Form::text('company_name',null,array('class'=>'form-control','placeholder'=>__('Enter Company Name')))}}
                                        </div>
                                    </div>
                                    <div class="col-12  p-0 modaltitle ">
                                        <h5 style="margin-left: 14px;">{{ __('Contact Information') }}</h5>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            {{Form::label('name',__('Name'),['class'=>'form-label']) }}
                                            <span class="text-sm">
                                                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                            </span>
                                            {{Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Name'),'required'=>'required'))}}
                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group intl-tel-input">
                                            {{ Form::label('phone', __('Primary contact'), ['class' => 'form-label']) }}
                                            <span class="text-sm">
                                                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                            </span>
                                            <div class="intl-tel-input">
                                                <input type="tel" id="phone-input" name="primary_contact" class="phone-input form-control" placeholder="Enter Primary contact" maxlength="16" value="" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group intl-tel-input">
                                            {{ Form::label('phone', __('Secondary contact'), ['class' => 'form-label']) }}
                                            <!-- <span class="text-sm">
                                                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                            </span> -->
                                            <div class="intl-tel-input">
                                                <input type="tel" id="phone-input1" name="secondary_contact" class="phone-input form-control" placeholder="Enter Secondary contact" maxlength="16" value="" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            {{Form::label('email',__('Email'),['class'=>'form-label']) }}
                                            {{Form::text('email',null,array('class'=>'form-control','placeholder'=>__('Enter Email'),'required' =>'required'))}}
                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            {{Form::label('lead_address',__('Address'),['class'=>'form-label']) }}
                                            {{Form::text('lead_address',null,array('class'=>'form-control','placeholder'=>__('Address')))}}
                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            {{Form::label('relationship',__('Relationship'),['class'=>'form-label']) }}
                                            {{Form::text('relationship',null,array('class'=>'form-control','placeholder'=>__('Enter Relationship')))}}
                                        </div>
                                    </div>
                                    <div class="col-12  p-0 modaltitle ">
                                        <h5 style="margin-left: 14px;">{{ __('Training Details') }}</h5>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            {{Form::label('type',__('Training Type'),['class'=>'form-label']) }}
                                            <span class="text-sm">
                                                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                            </span>
                                            <select name="type" id="type" class="form-control" required>
                                                <option value="">Select Type</option>
                                                @foreach($type_arr as $type)
                                                <option value="{{$type}}" {{ ($type == $lead->type) ? 'selected' : '' }}>{{$type}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            <label for="venue" class="form-label">{{ __('Venue') }}</label>
                                            <!-- <span class="text-sm">
                                                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                            </span> -->
                                            @foreach($venue as $key => $label)
                                            <div>
                                                <input type="checkbox" name="venue[]" id="{{ $label }}" value="{{ $label }}" {{ in_array($label, @$venue_function) ? 'checked' : '' }}>
                                                <label for="{{ $label }}">{{ $label }}</label>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            {{ Form::label('start_date', __('Date of Training'), ['class' => 'form-label']) }}
                                            <span class="text-sm">
                                                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                            </span>
                                            {!! Form::date('start_date', null, ['class' => 'form-control','required'=>'required']) !!}
                                        </div>
                                    </div>

                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            {{Form::label('guest_count',__('Guest Count'),['class'=>'form-label']) }}
                                            {!! Form::number('guest_count', null,array('class' => 'form-control','min'=>
                                            0)) !!}
                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            {{ Form::label('function', __('Function'), ['class' => 'form-label']) }}
                                            <!-- <span class="text-sm">
                                                <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                            </span> -->
                                            <div class="checkbox-group">
                                                @foreach($function as $key => $value)

                                                <label>
                                                    <input type="checkbox" id="{{ $value['function'] }}" name="function[]" value="{{  $value['function'] }}" class="function-checkbox" {{in_array( $value['function'], $function_package) ? 'checked' : '' }}>

                                                    {{ $value['function'] }}
                                                </label><br>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 need_full" id="mailFunctionSection">
                                        @if(isset($function) && !empty($function))
                                        @foreach($function as $key =>$value)
                                        <div class="form-group" data-main-index="{{$key}}" data-main-value="{{$value['function']}}" id="function_package" style="display: none;">
                                            {{ Form::label('package', __($value['function']), ['class' => 'form-label']) }}
                                            @foreach($value['package'] as $k => $package)
                                            <?php $isChecked = false; ?>
                                            @if(isset($func_package) && !empty($func_package))
                                            @foreach($func_package as $func => $pack)
                                            @foreach($pack as $keypac => $packval)
                                            @if($package == $packval)
                                            <?php $isChecked = true; ?>
                                            @endif
                                            @endforeach
                                            @endforeach
                                            @endif
                                            <div class="form-check" data-main-index="{{$k}}" data-main-package="{{$package}}">
                                                {!! Form::checkbox('package_'.str_replace(' ', '',
                                                strtolower($value['function'])).'[]',$package,
                                                $isChecked, ['id' => 'package_' .
                                                $key.$k, 'data-function' => $value['function'], 'class' =>
                                                'form-check-input']) !!}
                                                {{ Form::label($package, $package, ['class' => 'form-check-label']) }}
                                            </div>
                                            @endforeach
                                        </div>
                                        @endforeach
                                        @endif
                                    </div>
                                    <div class="col-6 need_full" id="additionalSection">
                                        @if(isset($additional_items) && !empty($additional_items))
                                        {{ Form::label('additional', __('Additional items'), ['class' => 'form-label']) }}
                                        @foreach($additional_items as $ad_key =>$ad_value)
                                        @foreach($ad_value as $fun_key =>$packageVal)

                                        <div class="form-group" data-additional-index="{{$fun_key}}" data-additional-value="{{key($packageVal)}}" id="ad_package" style="display: none;">

                                            {{ Form::label('additional', __($fun_key), ['class' => 'form-label']) }}
                                            @foreach($packageVal as $pac_key =>$item)

                                            <div class="form-check" data-additional-index="{{$pac_key}}" data-additional-package="{{$pac_key}}">
                                                <?php $isCheckedif = false; ?>

                                                @if(isset($fun_ad_opts) && !empty($fun_ad_opts ))
                                                @foreach($fun_ad_opts as $keys=>$valss)

                                                @foreach($valss as $val)
                                                @if($pac_key == $val)
                                                <?php $isCheckedif = true; ?>
                                                @endif
                                                @endforeach
                                                @endforeach
                                                @endif
                                                {!! Form::checkbox('additional_'.str_replace(' ', '_',
                                                strtolower($fun_key)).'[]',$pac_key, $isCheckedif, ['data-function' =>
                                                $fun_key,
                                                'class' => 'form-check-input']) !!}
                                                {{ Form::label($pac_key, $pac_key, ['class' => 'form-check-label']) }}
                                            </div>
                                            @endforeach
                                        </div>
                                        @endforeach
                                        @endforeach
                                        @endif


                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            {{Form::label('Assign Staff',__('Assign Staff'),['class'=>'form-label']) }}
                                            <select class="form-control" name='user'>
                                                <option value="">Select Staff</option>
                                                @foreach($users as $user)
                                                <option class="form-control" value="{{$user->id}}" {{ $user->id == $lead->assigned_user ? 'selected' : '' }}>
                                                    {{$user->name}} - {{$user->type}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12  p-0 modaltitle ">
                                        <h5 style="margin-left: 14px;">{{ __('Other Information') }}</h5>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            {{Form::label('allergies',__('Allergies'),['class'=>'form-label']) }}
                                            {{Form::text('allergies',null,array('class'=>'form-control','placeholder'=>__('Enter Allergies(if any)')))}}
                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            {{Form::label('spcl_req',__('Any Special Requirements'),['class'=>'form-label']) }}
                                            {{Form::textarea('spcl_req',null,array('class'=>'form-control','rows'=>2,'placeholder'=>__('Enter Any Special Requirements')))}}
                                        </div>
                                    </div>
                                    <div class="col-12 need_full">
                                        <div class="form-group">
                                            {{Form::label('Description',__('How did you hear about us?'),['class'=>'form-label']) }}
                                            {{Form::textarea('description',null,array('class'=>'form-control','rows'=>2))}}
                                        </div>
                                    </div>
                                    <div class="col-12  p-0 modaltitle ">
                                        <h5 style="margin-left: 14px;">{{ __('Estimate Billing Summary Details') }}</h5>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            {!! Form::label('baropt', 'Bar') !!}
                                            @foreach($baropt as $key => $label)
                                            <div>
                                                {{ Form::radio('baropt', $label, isset($lead->bar) && $lead->bar == $label ? true : false , ['id' => $label]) }}
                                                {{ Form::label('baropt' . ($key + 1), $label) }}
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-6 need_full" id="barpacakgeoptions" style="display: none;">
                                        @if(isset($bar_package) && !empty($bar_package))
                                        @foreach($bar_package as $key =>$value)
                                        <div class="form-group" data-main-index="{{$key}}" data-main-value="{{$value['bar']}}">
                                            {{ Form::label('bar', __($value['bar']), ['class' => 'form-label']) }}
                                            @foreach($value['barpackage'] as $k => $bar)
                                            <div class="form-check" data-main-index="{{$k}}" data-main-package="{{$bar}}">
                                                {!! Form::radio('bar'.'_'.str_replace(' ', '',
                                                strtolower($value['bar'])), $bar, false, ['id' => 'bar_' . $key.$k,
                                                'data-function' => $value['bar'], 'class' => 'form-check-input']) !!}
                                                {{ Form::label($bar, $bar, ['class' => 'form-check-label']) }}
                                            </div>
                                            @endforeach
                                        </div>
                                        @endforeach
                                        @endif
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            {{Form::label('rooms',__('Room'),['class'=>'form-label']) }}
                                            <input type="number" name="rooms" value="{{$lead->rooms}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            {{ Form::label('start_time', __('Estimated Start Time'), ['class' => 'form-label']) }}
                                            {!! Form::input('time', 'start_time', $lead->start_time, ['class' =>
                                            'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            {{ Form::label('end_time', __('Estimated End Time'), ['class' => 'form-label']) }}
                                            {!! Form::input('time', 'end_time', $lead->end_time, ['class' =>
                                            'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="col-6 need_full">
                                        <div class="form-group">
                                            {{ Form::label('name', __('Active'), ['class' => 'form-label']) }}
                                            <div>
                                                <input type="checkbox" class="form-check-input" name="is_active" {{ $lead->lead_status == 1 ? 'checked' : '' }}>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="text-end">
                                        <button type="button" class="btn  btn-light cancel">Cancel</button>
                                        {{ Form::submit(__('Update'), ['class' => 'btn-submit btn btn-primary']) }}
                                    </div>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .iti.iti--allow-dropdown.iti--separate-dial-code {
        width: 100%;
    }
</style>
@endsection
@push('script-page')
<script>
    $(document).ready(function() {
        $("input[type='text'][name='lead_name'],input[type='text'][name='name'], input[type='text'][name='email'], select[name='type'],input[type='tel'][name='primary_contact'][name='secondary_contact'],input[type='date'][name='start_date']").focusout(function() {

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
    });
</script>
<script>
    jQuery(function() {
        $('input[name = lead_name]').keyup(function() {
            var value = $(this).val();
            $('input[name = "name"]').val(value);
        });
        $('.cancel').click(function() {
            location.reload();
        })
    });
</script>
<script>
    $(document).ready(function() {
        var phoneNumber = "<?php echo $lead->primary_contact; ?>";
        var num = phoneNumber.trim();
        var lastTenDigits = phoneNumber.substr(-10);
        var formattedPhoneNumber = '(' + lastTenDigits.substr(0, 3) + ') ' + lastTenDigits.substr(3, 3) + '-' +
            lastTenDigits.substr(6);
        $('#phone-input').val(formattedPhoneNumber);

        var phoneNumber1 = "<?php echo $lead->secondary_contact; ?>";
        var num = phoneNumber1.trim();
        var lastTenDigits1 = phoneNumber1.substr(-10);
        var formattedPhoneNumber1 = '(' + lastTenDigits1.substr(0, 3) + ') ' + lastTenDigits1.substr(3, 3) + '-' +
            lastTenDigits1.substr(6);
        $('#phone-input1').val(formattedPhoneNumber1);
    })
    $(document).ready(function() {
        var input = document.querySelector("#phone-input");
        var iti = window.intlTelInput(input, {
            separateDialCode: true,
        });

        var indiaCountryCode = iti.getSelectedCountryData().iso2;
        var countryCode = iti.getSelectedCountryData().dialCode;
        $('#country-code').val(countryCode);
        if (indiaCountryCode !== 'us') {
            iti.setCountry('us');
        }

        var input1 = document.querySelector("#phone-input1");
        var iti1 = window.intlTelInput(input1, {
            separateDialCode: true,
        });

        var indiaCountryCode1 = iti1.getSelectedCountryData().iso2;
        var countryCode1 = iti1.getSelectedCountryData().dialCode;
        $('#country-code').val(countryCode1);
        if (indiaCountryCode1 !== 'us') {
            iti1.setCountry('us');
        }
    });
</script>

<script>
    const isNumericInput = (event) => {
        const key = event.keyCode;
        return ((key >= 48 && key <= 57) || // Allow number line
            (key >= 96 && key <= 105) // Allow number pad
        );
    };

    const isModifierKey = (event) => {
        const key = event.keyCode;
        return (event.shiftKey === true || key === 35 || key === 36) || // Allow Shift, Home, End
            (key === 8 || key === 9 || key === 13 || key === 46) || // Allow Backspace, Tab, Enter, Delete
            (key > 36 && key < 41) || // Allow left, up, right, down
            (
                // Allow Ctrl/Command + A,C,V,X,Z
                (event.ctrlKey === true || event.metaKey === true) &&
                (key === 65 || key === 67 || key === 86 || key === 88 || key === 90)
            )
    };

    const enforceFormat = (event) => {
        // Input must be of a valid number format or a modifier key, and not longer than ten digits
        if (!isNumericInput(event) && !isModifierKey(event)) {
            event.preventDefault();
        }
    };

    const formatToPhone = (event) => {
        if (isModifierKey(event)) {
            return;
        }

        // I am lazy and don't like to type things more than once
        const target = event.target;
        const input = event.target.value.replace(/\D/g, '').substring(0, 10); // First ten digits of input only
        const zip = input.substring(0, 3);
        const middle = input.substring(3, 6);
        const last = input.substring(6, 10);

        if (input.length > 6) {
            target.value = `(${zip}) ${middle} - ${last}`;
        } else if (input.length > 3) {
            target.value = `(${zip}) ${middle}`;
        } else if (input.length > 0) {
            target.value = `(${zip}`;
        }
    };

    const inputElement = document.getElementById('phone-input');
    inputElement.addEventListener('keydown', enforceFormat);
    inputElement.addEventListener('keyup', formatToPhone);
    const inputElement1 = document.getElementById('phone-input1');
    inputElement1.addEventListener('keydown', enforceFormat);
    inputElement1.addEventListener('keyup', formatToPhone);
</script>
<script>
    var scrollSpy = new bootstrap.ScrollSpy(document.body, {
        target: '#useradd-sidenav',
        offset: 300
    })
</script>
<script>
    var scrollSpy = new bootstrap.ScrollSpy(document.body, {
        target: '#useradd-sidenav',
        offset: 300
    })
    $(document).ready(function() {
        $('div#mailFunctionSection > div').hide();
        $('input[name="function[]"]:checked').each(function() {
            var funVal = $(this).val();
            $('div#mailFunctionSection > div').each(function() {
                var attr_value = $(this).data('main-value');
                if (attr_value == funVal) {
                    $(this).show();
                }
            });
        });
        $('div#additionalSection > div').hide();
        $('div#mailFunctionSection input[type=checkbox]:checked').each(function() {
            var funcValue = $(this).val();
            $('div#additionalSection > div').each(function() {
                var ad_val = $(this).data('additional-index');
                if (funcValue == ad_val) {
                    $(this).show();
                }
            });
        });

    });
    jQuery(function() {
        $('input[name="function[]"]').change(function() {
            $('div#mailFunctionSection > div').hide();
            $('input[name="function[]"]:checked').each(function() {
                var funVal = $(this).val();
                $('div#mailFunctionSection > div').each(function() {
                    var attr_value = $(this).data('main-value');
                    if (attr_value == funVal) {
                        $(this).show();
                    }
                });
            });
        });
    });
    jQuery(function() {
        $('div#mailFunctionSection input[type=checkbox]').change(function() {
            $('div#additionalSection > div').hide();
            $('div#mailFunctionSection input[type=checkbox]:checked').each(function() {
                var funcValue = $(this).val();
                $('div#additionalSection > div').each(function() {
                    var ad_val = $(this).data('additional-index');
                    if (funcValue == ad_val) {
                        $(this).show();
                    }
                });
            });
        });
    });
    jQuery(function() {
        $('input[type=radio][name = baropt]').change(function() {
            $('div#barpacakgeoptions').hide();
            var value = $(this).val();
            if (value == 'Package Choice') {
                $('div#barpacakgeoptions').show();
            }
        });
    });
</script>

<script>
    $(document).on('change', 'select[name=parent]', function() {
        console.log('h');
        var parent = $(this).val();
        getparent(parent);
    });

    function getparent(bid) {
        console.log(bid);
        $.ajax({
            url: "{{ route('task.getparent') }}",
            type: 'POST',
            data: {
                "parent": bid,
                "_token": "{{ csrf_token() }}",
            },
            success: function(data) {
                console.log(data);
                $('#parent_id').empty();
                // {{-- $('#parent_id').append('<option value="">{{__("Select Parent")}}</option>'); --}}

                $.each(data, function(key, value) {
                    $('#parent_id').append('<option value="' + key + '">' + value + '</option>');
                });
                if (data == '') {
                    $('#parent_id').empty();
                }
            }
        });
    }
</script>
<script>
    $(document).on('click', '#billing_data', function() {
        $("[name='shipping_address']").val($("[name='billing_address']").val());
        $("[name='shipping_city']").val($("[name='billing_city']").val());
        $("[name='shipping_state']").val($("[name='billing_state']").val());
        $("[name='shipping_country']").val($("[name='billing_country']").val());
        $("[name='shipping_postalcode']").val($("[name='billing_postalcode']").val());
    });
</script>
@endpush