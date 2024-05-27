@php
    $plansettings = App\Models\Utility::plansettings();
@endphp
{{Form::open(array('url'=>'product','method'=>'post','enctype'=>'multipart/form-data'))}}
<div class="row">
    @if (isset($plansettings['enable_chatgpt']) && $plansettings['enable_chatgpt'] == 'on')
    <div class="text-end">
        <a href="#" data-size="md" class="btn btn-sm btn-primary" data-ajax-popup-over="true" data-size="md"
            data-title="{{ __('Generate content with AI') }}" data-url="{{ route('generate', ['product']) }}"
            data-toggle="tooltip" title="{{ __('Generate') }}">
            <i class="fas fa-robot"></span><span class="robot">{{ __('Generate With AI') }}</span></i>
        </a>
    </div>
    @endif
    <div class="col-6">
        <div class="form-group">
            {{Form::label('name',__('Name'),['class'=>'form-label']) }}
            {{Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Name'),'required'=>'required'))}}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('status',__('Status'),['class'=>'form-label']) }}
            {!!Form::select('status', $status, null,array('class' => 'form-control','required'=>'required')) !!}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('category',__('Category'),['class'=>'form-label']) }}
            {!!Form::select('category', $category, null,array('class' => 'form-control','required'=>'required')) !!}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('brand',__('Brand'),['class'=>'form-label']) }}
            {!!Form::select('brand', $brand, null,array('class' => 'form-control','required'=>'required')) !!}

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('price',__('Price'),['class'=>'form-label']) }}
            {{Form::text('price',null,array('class'=>'form-control','placeholder'=>__('Enter Price'),'required'=>'required'))}}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{ Form::label('tax', __('Tax'),['class'=>'form-label']) }}
            {!!Form::select('tax[]', $tax, null,array('class' => 'form-control select2','id'=>'choices-multiple','multiple')) !!}

            {{-- {!!Form::select('tax[]', $tax, null,array('class' => 'form-control select2','id'=>'choices-multiple1','multiple')) !!} --}}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('part_number',__('Part Number'),['class'=>'form-label']) }}
            {{Form::text('part_number',null,array('class'=>'form-control','placeholder'=>__('Enter Part Number'),'required'=>'required'))}}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('weight',__('Weight'),['class'=>'form-label']) }}
            {{Form::text('weight',null,array('class'=>'form-control','placeholder'=>__('Enter Weight')))}}
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            {{Form::label('URL',__('URL'),['class'=>'form-label']) }}
            {{Form::text('URL',null,array('class'=>'form-control','placeholder'=>__('Enter URL'),'required'=>'required'))}}
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            {{Form::label('description',__('Description'),['class'=>'form-label']) }}
            {{Form::textarea('description',null,array('class'=>'form-control','rows'=>2,'placeholder'=>__('Enter Description')))}}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('Assign User',__('Assign User'),['class'=>'form-label']) }}
            {!! Form::select('user', $user, null,array('class' => 'form-control')) !!}
        </div>
    </div>

     <div class="col-6">
        <div class="form-group">
            {{Form::label('SKU',__('SKU'),['class'=>'form-label']) }}
            {!! Form::text('sku',null,array('class' => 'form-control','required'=>'required')) !!}
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn  btn-light"
            data-bs-dismiss="modal">Close</button>
            {{Form::submit(__('Create'),array('class'=>'btn btn-primary '))}}
    </div>

</div>
</div>
{{Form::close()}}

@push('script-page')
<script src="{{asset('assets/js/plugins/choices.min.js')}}"></script>
<script src="{{ asset('libs/select2/dist/js/select2.min.js')}}"></script>
@endpush
