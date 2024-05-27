<div class="card bg-none card-box">
    {{ Form::open(array('url' => 'payments')) }}
    <div class="row">
        <div class="form-group col-12">
            {{ Form::label('name', __('Payment Name'),['class'=>'form-control-label']) }}
            {{ Form::text('name', '', array('class' => 'form-control','required'=>'required')) }}
        </div>
        <div class="col-12 text-right">
            <input type="submit" value="{{__('Create')}}" class="btn btn-sm btn-primary mr-auto">
            <input type="button" value="{{__('Cancel')}}" class="btn btn-sm btn-secondary mr-auto" data-dismiss="modal">
        </div>
    </div>
    {{ Form::close() }}
</div>
