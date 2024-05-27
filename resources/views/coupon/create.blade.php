@php
$settings = App\Models\Utility::settings();
@endphp
{{ Form::open(['url' => 'coupon', 'method' => 'post']) }}
<div class="row">
    @if (!empty($settings['chatgpt_key']))
    <div class="text-end">
        <a href="#" data-size="md" class="btn btn-sm btn-primary" data-ajax-popup-over="true" data-size="md"
            data-title="{{ __('Generate content with AI') }}" data-url="{{ route('generate', ['coupon']) }}"
            data-toggle="tooltip" title="{{ __('Generate') }}">
            <i class="fas fa-robot"></span><span class="robot">{{ __('Generate With AI') }}</span></i>
        </a>
    </div>
    @endif
    <div class="form-group col-md-12">
        {{ Form::label('name', __('Name'), ['class' => 'form-label']) }}
        {{ Form::text('name', null, ['class' => 'form-control font-style', 'placeholder' => 'Coupan Name', 'required' => 'required']) }}
    </div>

    <div class="form-group col-md-6">
        {{ Form::label('discount', __('Discount'), ['class' => 'form-label']) }}
        {{ Form::number('discount', null, ['class' => 'form-control', 'placeholder' => 'Discount', 'required' => 'required', 'step' => '0.01']) }}
        <span class="small"><b></b>{{ __('Note: Discount in Percentage') }}</span>
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('limit', __('Limit'), ['class' => 'form-label']) }}
        {{ Form::number('limit', null, ['class' => 'form-control', 'placeholder' => 'Limit', 'required' => 'required']) }}
    </div>

    <div class="form-group">
        {{ Form::label('code', __('Code'), ['class' => 'form-label']) }}
        <div class="d-flex radio-check">
            <div class="form-check form-check-inline form-group col-md-6">
                <input type="radio" id="manual_code" value="manual" name="icon-input" class="form-check-input code"
                    checked="checked">
                <label class="custom-control-label " for="manual_code">{{ __('Manual') }}</label>
            </div>
            <div class="form-check form-check-inline form-group col-md-6">
                <input type="radio" id="auto_code" value="auto" name="icon-input" class="form-check-input code">
                <label class="custom-control-label" for="auto_code">{{ __('Auto Generate') }}</label>
            </div>
        </div>
    </div>

    <div class="form-group col-md-12 d-block" id="manual">
        <input class="form-control font-uppercase" name="manualCode" type="text" placeholder="Manual Code">
    </div>
    <div class="form-group col-md-12 d-none" id="auto">
        <div class="row">
            <div class="col-md-10">
                <input class="form-control" name="autoCode" type="text" id="auto-code" placeholder="Auto Code">
            </div>
            <div class="col-md-2">
                <a href="#" class="btn btn-primary" id="code-generate"><i class="ti ti-history"></i></a>
            </div>
        </div>
    </div>

    <div class="modal-footer col-md-12">
        {{ Form::submit(__('Create'), ['class' => 'btn btn-primary ']) }}
    </div>
</div>
{{ Form::close() }}
