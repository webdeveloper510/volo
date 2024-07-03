@php
$currentYear = date('Y');
$years = [
$currentYear - 1 => $currentYear - 1,
$currentYear => $currentYear,
$currentYear + 1 => $currentYear + 1
];
@endphp
<style>
    .fa-asterisk {
        font-size: xx-small;
        position: absolute;
        padding: 1px;
    }

    .additional-product-category {
        display: none;
        margin-top: 10px;
    }

    #new_client {
        display: none;
    }

    #new_region {
        display: none;
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

    .iti.iti--allow-dropdown.iti--separate-dial-code {
        width: 100%;
    }
</style>

{{Form::open(array('route' => 'objective.store','method'=>'post'))}}
<input type="hidden" name="objectiveType" value="New" />
<div class="row">
    <div class="col-6 need_full">
        <div class="form-group">
            {{Form::label('employee',__('Employee'),['class'=>'form-label']) }}
            <select class="form-control" name='employee' required>
                <option value="">Select Employee</option>
                @foreach ($assinged_staff as $staff)
                <option class="form-control" value="{{ $staff->id }}">{{ $staff->name }} ({{$staff->type}})</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            {{ Form::label('period', __('Period'), ['class' => 'form-label']) }}
            {{ Form::select('year', $years, null, ['class' => 'form-control', 'placeholder' => __('Select Period'), 'required' => 'required']) }}
        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            <label for="category">Category</label>
            <input class="form-control" type="text" name="category" placeholder="Enter Category">
        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            <label for="objective">Objective</label>
            <textarea class="form-control" name="objective" placeholder="Enter Objective"></textarea>
        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            <label for="measure">Measure</label>
            <textarea class="form-control" name="measure" placeholder="Enter Measure"></textarea>
        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            {{ Form::label('key_dates', __('Key Dates'), ['class' => 'form-label']) }}
            {{ Form::date('key_dates', null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" class="form-control">
                <option value="" selected disabled>Select Status</option>
                <option value="Complete">Complete</option>
                <option value="In Progress">In Progress</option>
                <option value="Outstanding">Outstanding</option>
            </select>
        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            <label for="q1_updates">Q1 Updates</label>
            <textarea class="form-control" name="q1_updates" placeholder="Enter Q1 Updates"></textarea>
        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            <label for="q2_updates">Q2 Updates</label>
            <textarea class="form-control" name="q2_updates" placeholder="Enter Q2 Updates"></textarea>
        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            <label for="q3_updates">Q3 Updates</label>
            <textarea class="form-control" name="q3_updates" placeholder="Enter Q3 Updates"></textarea>
        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            <label for="q4_updates">Q4 Updates</label>
            <textarea class="form-control" name="q4_updates" placeholder="Enter Q4 Updates"></textarea>
        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            <label for="eoy_review">EOY Review</label>
            <textarea class="form-control" name="eoy_review" placeholder="Enter EOY Review"></textarea>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal">Close</button>
    {{Form::submit(__('Save'),array('class'=>'btn btn-primary '))}}
</div>
{{Form::close()}}
</div>