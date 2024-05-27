{{ Form::open(array('url' => 'form_builder')) }}
<div class="row">
    <div class="col-12 form-group">
        {{ Form::label('name', __('Name'),['class'=>'form-label']) }}
        {{ Form::text('name', '', array('class' => 'form-control','required'=> 'required','placeholder'=>'Enter Form Name')) }}
    </div>
    <div class="col-12 form-group">
        {{ Form::label('active', __('Active'),['class'=>'form-label']) }}
        <div class="d-flex radio-check">
            <div class="form-check">
                <input type="radio" id="on" value="1" name="is_active" class="form-check-input" checked="checked">
                <label class="form-check-label" for="on">{{__('On')}}</label>
            </div>
            <div class="form-check ms-3">
                <input type="radio" id="off" value="0" name="is_active" class="form-check-input">
                <label class="form-check-label" for="off">{{__('Off')}}</label>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn  btn-light"
            data-bs-dismiss="modal">Close</button>
            {{Form::submit(__('Create'),array('class'=>'btn btn-primary '))}}
    </div>
     
</div>
{{ Form::close() }}
