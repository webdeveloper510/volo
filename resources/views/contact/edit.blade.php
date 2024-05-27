@extends('layouts.admin')
@section('page-title')
    {{ __('Contact Edit') }}
@endsection
@section('title')
    {{ __('Edit Contact') }} {{ '(' . $contact->name . ')' }}
@endsection
@php
    $plansettings = App\Models\Utility::plansettings();
@endphp
@section('action-btn')
    <div class="btn-group" role="group">
        @if (!empty($previous))
            <div class="action-btn  ms-2">
                <a href="{{ route('contact.edit', $previous) }}" class="btn btn-sm btn-primary btn-icon m-1"
                    data-bs-toggle="tooltip" title="{{ __('Previous') }}">
                    <i class="ti ti-chevron-left"></i>
                </a>
            </div>
        @else
            <div class="action-btn  ms-2">
                <a href="#" class="btn btn-sm btn-primary btn-icon m-1 disabled" data-bs-toggle="tooltip"
                    title="{{ __('Previous') }}">
                    <i class="ti ti-chevron-left"></i>
                </a>
            </div>
        @endif
        @if (!empty($next))
            <div class="action-btn ms-2">
                <a href="{{ route('contact.edit', $next) }}" class="btn btn-sm btn-primary btn-icon m-1"
                    data-bs-toggle="tooltip" title="{{ __('Next') }}">
                    <i class="ti ti-chevron-right"></i>
                </a>
            </div>
        @else
            <div class="action-btn  ms-2">
                <a href="#" class="btn btn-sm btn-primary btn-icon m-1 disabled" data-bs-toggle="tooltip"
                    title="{{ __('Next') }}">
                    <i class="ti ti-chevron-right"></i>
                </a>
            </div>
        @endif
    </div>
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('contact.index') }}">{{ __('Contact') }}</a></li>
    <li class="breadcrumb-item">{{ __('Edit') }}</li>
@endsection
@section('content')
    <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
            <div class="row">
                <div class="col-xl-3">
                    <div class="card sticky-top" style="top:30px">
                        <div class="list-group list-group-flush" id="useradd-sidenav">
                            <a href="#useradd-1"
                                class="list-group-item list-group-item-action border-0">{{ __('Overview') }} <div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#useradd-2"
                                class="list-group-item list-group-item-action border-0">{{ __('Stream') }} <div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#useradd-3"
                                class="list-group-item list-group-item-action border-0">{{ __('Opportunities') }} <div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#useradd-4"
                                class="list-group-item list-group-item-action border-0">{{ __('Tasks') }} <div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#useradd-5"
                                class="list-group-item list-group-item-action border-0">{{ __('Quotes') }} <div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#useradd-6"
                                class="list-group-item list-group-item-action border-0">{{ __('Sales Orders') }} <div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#useradd-7"
                                class="list-group-item list-group-item-action border-0">{{ __('Invoices') }} <div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#useradd-8"
                                class="list-group-item list-group-item-action border-0">{{ __('Cases') }} <div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#useradd-9"
                                class="list-group-item list-group-item-action border-0">{{ __('Calls') }} <div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#useradd-10"
                                class="list-group-item list-group-item-action border-0">{{ __('Meetings') }} <div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9">
                    <div id="useradd-1" class="card">
                        {{ Form::model($contact, ['route' => ['contact.update', $contact->id], 'method' => 'PUT']) }}
                        <div class="card-header">
                            @if (isset($plansettings['enable_chatgpt']) && $plansettings['enable_chatgpt'] == 'on')
                                <div class="text-end">
                                    <a href="#" data-size="md" class="btn btn-sm btn-primary "
                                        data-ajax-popup-over="true" data-size="md"
                                        data-title="{{ __('Generate content with AI') }}"
                                        data-url="{{ route('generate', ['contact']) }}" data-toggle="tooltip"
                                        title="{{ __('Generate') }}">
                                        <i class="fas fa-robot"></span><span
                                                class="robot">{{ __('Generate With AI') }}</span></i>
                                    </a>
                                </div>
                            @endif
                            <h5>{{ __('Overview') }}</h5>
                            <small class="text-muted">{{ __('Edit about your contact information') }}</small>
                        </div>

                        <div class="card-body">
                            <form>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            {{ Form::label('name', __('Name'), ['class' => 'form-label']) }}
                                            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter Name'), 'required' => 'required']) }}
                                            @error('name')
                                                <span class="invalid-name" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            {{ Form::label('account', __('Account'), ['class' => 'form-label']) }}
                                            {!! Form::select('account', $account, null, ['class' => 'form-control']) !!}
                                        </div>
                                        @error('account')
                                            <span class="invalid-account" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            {{ Form::label('email', __('Email'), ['class' => 'form-label']) }}
                                            {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => __('Enter Email'), 'required' => 'required']) }}
                                            @error('email')
                                                <span class="invalid-email" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            {{ Form::label('phone', __('Phone'), ['class' => 'form-label']) }}
                                            {{ Form::text('phone', null, ['class' => 'form-control', 'placeholder' => __('Enter Phone'), 'required' => 'required']) }}
                                            @error('phone')
                                                <span class="invalid-phone" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            {{ Form::label('contact_address', __('Address'), ['class' => 'form-label']) }}
                                            {{ Form::text('contact_address', null, ['class' => 'form-control', 'placeholder' => __('Enter Billing Address'), 'required' => 'required']) }}
                                            @error('contact_address')
                                                <span class="invalid-contact_address" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            {{ Form::label('contact_city', __('City'), ['class' => 'form-label']) }}
                                            {{ Form::text('contact_city', null, ['class' => 'form-control', 'placeholder' => __('Enter Billing City'), 'required' => 'required']) }}
                                            @error('contact_city')
                                                <span class="invalid-contact_city" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group">
                                            {{ Form::label('contact_state', __('State'), ['class' => 'form-label']) }}
                                            {{ Form::text('contact_state', null, ['class' => 'form-control', 'placeholder' => __('Enter Billing City'), 'required' => 'required']) }}
                                            @error('contact_state')
                                                <span class="invalid-contact_state" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            {{ Form::label('contact_postalcode', __('Postal Code'), ['class' => 'form-label']) }}
                                            {{ Form::text('contact_postalcode', null, ['class' => 'form-control', 'placeholder' => __('Enter Billing City'), 'required' => 'required']) }}
                                            @error('contact_postalcode')
                                                <span class="invalid-contact_postalcode" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            {{ Form::label('contact_country', __('Country'), ['class' => 'form-label']) }}
                                            {{ Form::text('contact_country', null, ['class' => 'form-control', 'placeholder' => __('Enter Billing City'), 'required' => 'required']) }}
                                            @error('contact_country')
                                                <span class="invalid-contact_country" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            {{ Form::label('description', __('Description'), ['class' => 'form-label']) }}
                                            {!! Form::textarea('description', null, ['class' => 'form-control ', 'rows' => 3, 'required' => 'required']) !!}
                                            @error('description')
                                                <span class="invalid-description" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-12">
                                        <div class="form-group">
                                            {{ Form::label('user', __(' Assigned User'), ['class' => 'form-label']) }}
                                            {!! Form::select('user', $user, $contact->user_id, ['class' => 'form-control ']) !!}
                                        </div>
                                        @error('user')
                                            <span class="invalid-user" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="text-end">
                                        {{ Form::submit(__('Update'), ['class' => 'btn-submit btn btn-primary']) }}
                                    </div>


                                </div>
                            </form>
                        </div>
                        {{ Form::close() }}
                    </div>

                    <div id="useradd-2" class="card">
                        {{ Form::open(['route' => ['streamstore', ['contact', $contact->name, $contact->id]], 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
                        <div class="card-header">
                            <h5>{{ __('Stream') }}</h5>
                            <small class="text-muted">{{ __('Add stream information') }}</small>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            {{ Form::label('stream', __('Stream'), ['class' => 'form-label']) }}
                                            {{ Form::text('stream_comment', null, ['class' => 'form-control', 'placeholder' => __('Enter Stream Comment'), 'required' => 'required']) }}
                                        </div>
                                    </div>
                                    <input type="hidden" name="log_type" value="contact comment">
                                    <div class="col-12 mb-3 field" data-name="attachments">
                                        <div class="attachment-upload">
                                            <div class="attachment-button">
                                                <div class="pull-left">
                                                    <div class="form-group">
                                                        {{ Form::label('attachment', __('Attachment'), ['class' => 'form-label']) }}
                                                        {{-- {{Form::file('attachment',array('class'=>'form-control'))}} --}}
                                                        <input type="file"name="attachment" class="form-control mb-3"
                                                            onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                                        <img id="blah" width="20%" height="20%" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="attachments"></div>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        {{ Form::submit(__('Save'), ['class' => 'btn-submit btn btn-primary']) }}
                                    </div>
                                </div>
                            </form>
                        </div>


                        <div class="col-12">
                            <div class="card-header">
                                <h5>{{ __('Latest comments') }}</h5>
                            </div>
                            @foreach ($streams as $stream)
                                @php
                                    $remark = json_decode($stream->remark);
                                @endphp
                                @if ($remark->data_id == $contact->id)
                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-xl-12">
                                                <ul class="list-group team-msg">
                                                    <li class="list-group-item border-0 d-flex align-items-start mb-2">
                                                        <div class="avatar me-3">
                                                            @php
                                                                $profile = \App\Models\Utility::get_file('upload/profile/');
                                                            @endphp
                                                            <a href="{{ !empty($stream->file_upload) ? $profile . $stream->file_upload : asset(url('./assets/images/user/avatar-5.jpg')) }}"
                                                                target="_blank">
                                                                <img alt="" class="rounded-circle"
                                                                    @if (!empty($stream->file_upload)) src="{{ !empty($stream->file_upload) ? $profile . $stream->file_upload : asset(url('./assets/images/user/avatar-5.jpg')) }}" @else  avatar="{{ $remark->user_name }}" @endif>
                                                            </a>
                                                        </div>
                                                        <div class="d-block d-sm-flex align-items-center right-side">
                                                            <div
                                                                class="d-flex align-items-start flex-column justify-content-center mb-3 mb-sm-0">
                                                                <div class="h6 mb-1">{{ $remark->user_name }}
                                                                </div>
                                                                <span class="text-sm lh-140 mb-0">
                                                                    posted to <a href="#">{{ $remark->title }}</a> ,
                                                                    {{ $stream->log_type }} <a
                                                                        href="#">{{ $remark->stream_comment }}</a>
                                                                </span>
                                                            </div>
                                                            <div class=" ms-2  d-flex align-items-center ">
                                                                <small
                                                                    class="text-end ">{{ $stream->created_at }}</small>
                                                            </div>
                                                        </div>

                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>


                        {{ Form::close() }}
                    </div>

                    <div id="useradd-3" class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h5>{{ __('Opportunities') }}</h5>
                                    <small class="text-muted">{{ __('Assigned opportunities for this contact') }}</small>
                                </div>
                                <div class="col">
                                    <div class="text-end">
                                        <a href="#" data-size="lg"
                                            data-url="{{ route('opportunities.create', ['contact', $contact->id]) }}"
                                            data-ajax-popup="true" data-bs-toggle="tooltip" title="{{ __('Create') }}"
                                            data-title="{{ __('Create New Opportunities') }}"
                                            class="btn btn-sm btn-primary btn-icon-only ">
                                            <i class="ti ti-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table datatable" id="datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="sort" data-sort="name">{{ __('Name') }}</th>
                                            <th scope="col" class="sort" data-sort="budget">{{ __('Account') }}
                                            </th>
                                            <th scope="col" class="sort" data-sort="status">{{ __('Stage') }}
                                            </th>
                                            <th scope="col" class="sort" data-sort="completion">
                                                {{ __('Assigned User') }}</th>
                                            <th scope="col" class="sort" data-sort="completion">{{ __('Amount') }}
                                            </th>
                                            @if (Gate::check('Show Opportunities') || Gate::check('Edit Opportunities') || Gate::check('Delete Opportunities'))
                                                <th scope="col" class="text-end">{{ __('Action') }}</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($opportunitiess as $opportunities)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('opportunities.edit', $opportunities->id) }}"
                                                        data-size="md" data-title="{{ __('Opportunities Details') }}"
                                                        class="action-item text-primary">
                                                        {{ $opportunities->name }}
                                                    </a>
                                                </td>
                                                <td class="budget">
                                                    {{ !empty($opportunities->account_names) ? $opportunities->account_names->name : '-' }}
                                                </td>

                                                <td>
                                                    <span class="badge bg-success p-2 px-3 rounded">
                                                        {{ $opportunities->stages->name }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="budget">{{ !empty($opportunities->assign_user) ? $opportunities->assign_user->name : '-' }}</span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="budget">{{ \Auth::user()->priceFormat($opportunities->amount) }}</span>
                                                </td>
                                                @if (Gate::check('Show Opportunities') || Gate::check('Edit Opportunities') || Gate::check('Delete Opportunities'))
                                                    <td class="text-end">

                                                        @can('Show Opportunities')
                                                            <div class="action-btn bg-warning ms-2">
                                                                <a href="#" data-size="md"
                                                                    data-url="{{ route('opportunities.show', $opportunities->id) }}"
                                                                    data-ajax-popup="true" data-bs-toggle="tooltip"
                                                                    title="{{ __('Quick View') }}"
                                                                    data-title="{{ __('Opportunities Details') }}"
                                                                    class="mx-3 btn btn-sm d-inline-flex align-items-center text-white">
                                                                    <i class="ti ti-eye"></i>
                                                                </a>
                                                            </div>
                                                        @endcan
                                                        @can('Edit Opportunities')
                                                            <div class="action-btn bg-info ms-2">
                                                                <a href="{{ route('opportunities.edit', $opportunities->id) }}"
                                                                    class="mx-3 btn btn-sm d-inline-flex align-items-center text-white"
                                                                    data-bs-toggle="tooltip" title="{{ __('Details') }}"
                                                                    data-title="{{ __('Edit Opportunities') }}"><i
                                                                        class="ti ti-edit"></i></a>
                                                            </div>
                                                        @endcan
                                                        @can('Delete Opportunities')
                                                            <div class="action-btn bg-danger ms-2">
                                                                {!! Form::open(['method' => 'DELETE', 'route' => ['opportunities.destroy', $opportunities->id]]) !!}
                                                                <a href="#!"
                                                                    class="mx-3 btn btn-sm  align-items-center text-white show_confirm"
                                                                    data-bs-toggle="tooltip" title='Delete'>
                                                                    <i class="ti ti-trash"></i>
                                                                </a>
                                                                {!! Form::close() !!}
                                                            </div>
                                                        @endcan

                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                    <div id="useradd-4" class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h5>{{ __('Tasks') }}</h5>
                                    <small class="text-muted">{{ __('Assigned tasks for this contact') }}</small>
                                </div>
                                <div class="col">
                                    <div class="text-end">
                                        <a href="#" data-size="lg" data-url="{{ route('task.create',['task',0]) }}"
                                            data-ajax-popup="true" title="{{ __('Create') }}" data-bs-toggle="tooltip"
                                            data-title="{{ __('Create New Task') }}"
                                            class="btn btn-sm btn-primary btn-icon-only ">
                                            <i class="ti ti-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table datatable" id="datatable1">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="sort" data-sort="name">{{ __('Name') }}</th>
                                            <th scope="col" class="sort" data-sort="budget">{{ __('Parent') }}
                                            </th>
                                            <th scope="col" class="sort" data-sort="status">{{ __('Stage') }}
                                            </th>
                                            <th scope="col" class="sort" data-sort="completion">
                                                {{ __('Date Start') }}</th>
                                            <th scope="col" class="sort" data-sort="completion">
                                                {{ __('Assigned User') }}</th>
                                            @if (Gate::check('Show Task') || Gate::check('Edit Task') || Gate::check('Delete Task'))
                                                <th scope="col" class="text-end">{{ __('Action') }}</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tasks as $task)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('task.edit', $task->id) }}" data-size="md"
                                                        data-title="{{ __('Task Details') }}"
                                                        class="action-item text-primary">
                                                        {{ $task->name }}
                                                    </a>
                                                </td>
                                                <td class="budget">
                                                    {{ $task->parent }}
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge bg-success p-2 px-3 rounded">{{ !empty($task->stages) ? $task->stages->name : '' }}</span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="budget">{{ \Auth::user()->dateFormat($task->start_date) }}</span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="budget">{{ !empty($task->assign_user) ? $task->assign_user->name : '-' }}</span>
                                                </td>
                                                @if (Gate::check('Show Task') || Gate::check('Edit Task') || Gate::check('Delete Task'))
                                                    <td class="text-end">

                                                        @can('Show Task')
                                                            <div class="action-btn bg-warning ms-2">
                                                                <a href="#" data-size="md"
                                                                    data-url="{{ route('task.show', $task->id) }}"
                                                                    data-bs-toggle="tooltip" title="{{ __('Quick View') }}"
                                                                    data-ajax-popup="true"
                                                                    data-title="{{ __('Task Details') }}"
                                                                    class="mx-3 btn btn-sm d-inline-flex align-items-center text-white">
                                                                    <i class="ti ti-eye"></i>
                                                                </a>
                                                            </div>
                                                        @endcan
                                                        @can('Edit Task')
                                                            <div class="action-btn bg-info ms-2">
                                                                <a href="{{ route('task.edit', $task->id) }}"
                                                                    class="mx-3 btn btn-sm d-inline-flex align-items-center text-white"
                                                                    data-bs-toggle="tooltip" title="{{ __('Details') }}"
                                                                    data-title="{{ __('Edit Task') }}"><i
                                                                        class="ti ti-edit"></i></a>
                                                            </div>
                                                        @endcan
                                                        @can('Delete Task')
                                                            <div class="action-btn bg-danger ms-2">
                                                                {!! Form::open(['method' => 'DELETE', 'route' => ['task.destroy', $task->id]]) !!}
                                                                <a href="#!"
                                                                    class="mx-3 btn btn-sm  align-items-center text-white show_confirm"
                                                                    data-bs-toggle="tooltip" title='Delete'>
                                                                    <i class="ti ti-trash"></i>
                                                                </a>
                                                                {!! Form::close() !!}
                                                            </div>
                                                        @endcan

                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                    <div id="useradd-5" class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h5>{{ __('Quotes') }}</h5>
                                    <small class="text-muted">{{ __('Assigned Quotes for this contact') }}</small>
                                </div>
                                <div class="col">
                                    <div class="text-end">
                                        <a href="#" data-size="lg"
                                            data-url="{{ route('quote.create', ['shipping_contact', $contact->id]) }}"
                                            data-ajax-popup="true" title="{{ __('Create') }}" data-bs-toggle="tooltip"
                                            data-title="{{ __('Create New Quote') }}"
                                            class="btn btn-sm btn-primary btn-icon-only ">
                                            <i class="ti ti-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table datatable" id="datatable4">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="sort" data-sort="name">{{ __('Name') }}</th>
                                            <th scope="col" class="sort" data-sort="status">{{ __('Status') }}
                                            </th>
                                            <th scope="col" class="sort" data-sort="completion">
                                                {{ __('Created At') }}
                                            </th>
                                            <th scope="col" class="sort" data-sort="completion">
                                                {{ __('Amount') }}</th>
                                            <th scope="col" class="sort" data-sort="completion">
                                                {{ __('Assign User') }}
                                            </th>
                                            @if (Gate::check('Show Quote') || Gate::check('Edit Quote') || Gate::check('Delete Quote'))
                                                <th scope="col" class="text-end">{{ __('Action') }}</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($quotes as $quote)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('quote.edit', $quote->id) }}" data-size="md"
                                                        data-title="{{ __('Quote Details') }}"
                                                        class="action-item text-primary">
                                                        {{ $quote->name }}
                                                    </a>
                                                </td>
                                                <td>
                                                    @if ($quote->status == 0)
                                                        <span class="badge bg-secondary p-2 px-3 rounded"
                                                            style="width: 79px;">{{ __(\App\Models\Quote::$status[$quote->status]) }}</span>
                                                    @elseif($quote->status == 1)
                                                        <span class="badge bg-info p-2 px-3 rounded"
                                                            style="width: 79px;">{{ __(\App\Models\Quote::$status[$quote->status]) }}</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    <span
                                                        class="budget">{{ \Auth::user()->dateFormat($quote->created_at) }}</span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="budget">{{ \Auth::user()->priceFormat($quote->getTotal()) }}</span>
                                                </td>
                                                <td>
                                                    <span class="col-sm-12"><span
                                                            class="text-sm">{{ ucfirst(!empty($quote->assign_user) ? $quote->assign_user->name : '-') }}</span></span>
                                                </td>

                                                @if (Gate::check('Show Quote') || Gate::check('Edit Quote') || Gate::check('Delete Quote'))
                                                    <td class="text-end">

                                                        @can('Show Quote')
                                                            <div class="action-btn bg-warning ms-2">
                                                                <a href="{{ route('quote.show', $quote->id) }}"
                                                                    data-size="md"class="mx-3 btn btn-sm align-items-center text-white "
                                                                    data-bs-toggle="tooltip" title="{{ __('Quick View') }}"
                                                                    data-title="{{ __('Quote Details') }}">
                                                                    <i class="ti ti-eye"></i>
                                                                </a>
                                                            </div>
                                                        @endcan
                                                        @can('Edit Quote')
                                                            <div class="action-btn bg-info ms-2">
                                                                <a href="{{ route('quote.edit', $quote->id) }}"
                                                                    class="mx-3 btn btn-sm align-items-center text-white"
                                                                    data-bs-toggle="tooltip" title="{{ __('Details') }}"
                                                                    data-title="{{ __('Edit Quote') }}"><i
                                                                        class="ti ti-edit"></i></a>
                                                            </div>
                                                        @endcan
                                                        @can('Delete Quote')
                                                            <div class="action-btn bg-danger ms-2">
                                                                {!! Form::open(['method' => 'DELETE', 'route' => ['quote.destroy', $quote->id]]) !!}
                                                                <a href="#!"
                                                                    class="mx-3 btn btn-sm   align-items-center text-white show_confirm"
                                                                    data-bs-toggle="tooltip" title='Delete'>
                                                                    <i class="ti ti-trash"></i>
                                                                </a>
                                                                {!! Form::close() !!}
                                                            </div>
                                                        @endcan
                                                    </td>
                                                @endif

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                    <div id="useradd-6" class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h5>{{ __('Sales Orders') }}</h5>
                                    <small class="text-muted">{{ __('Assigned SalesOrder for this contact') }}</small>
                                </div>
                                <div class="col">
                                    <div class="text-end">
                                        <a href="#" data-size="lg"
                                            data-url="{{ route('salesorder.create', ['shipping_contact', $contact->id]) }}"
                                            data-ajax-popup="true" data-bs-toggle="tooltip"
                                            data-title="{{ __('Create New SalesOrder') }}" title="{{ __('Create') }}"
                                            class="btn btn-sm btn-primary btn-icon-only ">
                                            <i class="ti ti-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table datatable" id="datatable3">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="sort" data-sort="name">{{ __('Name') }}</th>
                                            <th scope="col" class="sort" data-sort="status">{{ __('Status') }}
                                            </th>
                                            <th scope="col" class="sort" data-sort="completion">
                                                {{ __('Created At') }} </th>
                                            <th scope="col" class="sort" data-sort="completion">
                                                {{ __('Amount') }}</th>
                                            <th scope="col" class="sort" data-sort="completion">
                                                {{ __('Assigned User') }}</th>
                                            @if (Gate::check('Show SalesOrder') || Gate::check('Edit SalesOrder') || Gate::check('Delete SalesOrder'))
                                                <th scope="col" class="text-end">{{ __('Action') }}</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($salesorders as $salesorder)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('salesorder.edit', $salesorder->id) }}"
                                                        data-size="md" data-title="{{ __('SalesOrder') }}"
                                                        class="action-item text-primary">
                                                        {{ $salesorder->name }}</a>
                                                </td>
                                                <td>
                                                    @if ($salesorder->status == 0)
                                                        <span class="badge bg-secondary p-2 px-3 rounded"
                                                            style="width: 79px;">{{ __(\App\Models\SalesOrder::$status[$salesorder->status]) }}</span>
                                                    @elseif($salesorder->status == 1)
                                                        <span class="badge bg-info p-2 px-3 rounded"
                                                            style="width: 79px;">{{ __(\App\Models\SalesOrder::$status[$salesorder->status]) }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span
                                                        class="budget">{{ \Auth::user()->dateFormat($salesorder->created_at) }}</span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="budget">{{ \Auth::user()->priceFormat($salesorder->getTotal()) }}</span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="budget">{{ ucfirst(!empty($salesorder->assign_user) ? $salesorder->assign_user->name : '-') }}</span>
                                                </td>
                                                @if (Gate::check('Show SalesOrder') || Gate::check('Edit SalesOrder') || Gate::check('Delete SalesOrder'))
                                                    <td class="text-end">
                                                        @can('Show SalesOrder')
                                                            <div class="action-btn bg-warning ms-2">
                                                                <a href="{{ route('salesorder.show', $salesorder->id) }}"
                                                                    data-size="md"
                                                                    class="mx-3 btn btn-sm d-inline-flex align-items-center text-white"
                                                                    data-bs-toggle="tooltip" title="{{ __('Quick View') }}"
                                                                    data-title="{{ __('SalesOrders Details') }}">
                                                                    <i class="ti ti-eye"></i>
                                                                </a>
                                                            </div>
                                                        @endcan
                                                        @can('Edit SalesOrder')
                                                            <div class="action-btn bg-info ms-2">
                                                                <a href="{{ route('salesorder.edit', $salesorder->id) }}"
                                                                    class="mx-3 btn btn-sm d-inline-flex align-items-center text-white"
                                                                    data-bs-toggle="tooltip" title="{{ __('Details') }}"
                                                                    data-title="{{ __('Edit SalesOrders') }}"><i
                                                                        class="ti ti-edit"></i></a>
                                                            </div>
                                                        @endcan
                                                        @can('Delete SalesOrder')
                                                            <div class="action-btn bg-danger ms-2">
                                                                {!! Form::open(['method' => 'DELETE', 'route' => ['salesorder.destroy', $salesorder->id]]) !!}
                                                                <a href="#!"
                                                                    class="mx-3 btn btn-sm   align-items-center text-white show_confirm"
                                                                    data-bs-toggle="tooltip" title='Delete'>
                                                                    <i class="ti ti-trash"></i>
                                                                </a>
                                                                {!! Form::close() !!}
                                                            </div>
                                                        @endcan
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                    <div id="useradd-7" class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h5>{{ __('Invoices') }}</h5>
                                    <small class="text-muted">{{ __('Assigned SalesInvoice for this contact') }}</small>
                                </div>
                                <div class="col">
                                    <div class="text-end">
                                        <a href="#" data-size="lg"
                                            data-url="{{ route('invoice.create', ['shipping_contact', $contact->id]) }}"
                                            data-ajax-popup="true" data-bs-toggle="tooltip"
                                            data-title="{{ __('Create New SalesInvoice') }}"
                                            title="{{ __('Create') }}" class="btn btn-sm btn-primary btn-icon-only ">
                                            <i class="ti ti-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table datatable" id="datatable3">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="sort" data-sort="name">{{ __('Name') }}</th>
                                            <th scope="col" class="sort" data-sort="status">{{ __('Status') }}
                                            </th>
                                            <th scope="col" class="sort" data-sort="completion">
                                                {{ __('Created At') }}
                                            </th>
                                            <th scope="col" class="sort" data-sort="completion">
                                                {{ __('Amount') }}</th>
                                            <th scope="col" class="sort" data-sort="completion">
                                                {{ __('Assigned User') }}
                                            </th>
                                            @if (Gate::check('Show Invoice') || Gate::check('Edit Invoice') || Gate::check('Delete Invoice'))
                                                <th scope="col" class="text-end">{{ __('Action') }}</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($salesinvoices as $salesinvoice)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('invoice.edit', $salesinvoice->id) }}"
                                                        data-size="md" data-title="{{ __('SalesInvoice') }}"
                                                        class="action-item text-primary">
                                                        {{ $salesinvoice->name }}</a>
                                                </td>
                                                <td>
                                                    @if ($salesinvoice->status == 0)
                                                        <span class="badge bg-secondary p-2 px-3 rounded"
                                                            style="width: 91px;">{{ __(\App\Models\Invoice::$status[$salesinvoice->status]) }}</span>
                                                    @elseif($salesinvoice->status == 1)
                                                        <span class="badge bg-danger p-2 px-3 rounded"
                                                            style="width: 91px;">{{ __(\App\Models\Invoice::$status[$salesinvoice->status]) }}</span>
                                                    @elseif($salesinvoice->status == 2)
                                                        <span class="badge bg-warning p-2 px-3 rounded"
                                                            style="width: 91px;">{{ __(\App\Models\Invoice::$status[$salesinvoice->status]) }}</span>
                                                    @elseif($salesinvoice->status == 3)
                                                        <span class="badge bg-success p-2 px-3 rounded"
                                                            style="width: 91px;">{{ __(\App\Models\Invoice::$status[$salesinvoice->status]) }}</span>
                                                    @elseif($salesinvoice->status == 4)
                                                        <span class="badge bg-info p-2 px-3 rounded"
                                                            style="width: 91px;">{{ __(\App\Models\Invoice::$status[$salesinvoice->status]) }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span
                                                        class="budget">{{ \Auth::user()->dateFormat($salesinvoice->created_at) }}</span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="budget">{{ \Auth::user()->priceFormat($salesinvoice->getTotal()) }}</span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="budget">{{ ucfirst(!empty($salesinvoice->assign_user) ? $salesinvoice->assign_user->name : '-') }}</span>
                                                </td>
                                                @if (Gate::check('Show Invoice') || Gate::check('Edit Invoice') || Gate::check('Delete Invoice'))
                                                    <td class="text-end">
                                                        @can('Show Invoice')
                                                            <div class="action-btn bg-warning ms-2">
                                                                <a href="{{ route('invoice.show', $salesinvoice->id) }}"
                                                                    data-bs-toggle="tooltip" title="{{ __('Quick View') }}"
                                                                    class="mx-3 btn btn-sm align-items-center text-white "
                                                                    data-title="{{ __('Invoice Details') }}">
                                                                    <i class="ti ti-eye"></i>
                                                                </a>
                                                            </div>
                                                        @endcan
                                                        @can('Edit Invoice')
                                                            <div class="action-btn bg-info ms-2">
                                                                <a href="{{ route('invoice.edit', $salesinvoice->id) }}"
                                                                    data-bs-toggle="tooltip" title="{{ __('Details') }}"
                                                                    class="mx-3 btn btn-sm align-items-center text-white "
                                                                    data-title="{{ __('Edit Invoice') }}"><i
                                                                        class="ti ti-edit"></i></a>
                                                            </div>
                                                        @endcan
                                                        @can('Delete Invoice')
                                                            <div class="action-btn bg-danger ms-2">
                                                                {!! Form::open(['method' => 'DELETE', 'route' => ['invoice.destroy', $salesinvoice->id]]) !!}
                                                                <a href="#!"
                                                                    class="mx-3 btn btn-sm   align-items-center text-white show_confirm"
                                                                    data-bs-toggle="tooltip" title='Delete'>
                                                                    <i class="ti ti-trash"></i>
                                                                </a>
                                                                {!! Form::close() !!}
                                                            </div>
                                                        @endcan

                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="useradd-8" class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h5>{{ __('Cases') }}</h5>
                                    <small class="text-muted">{{ __('Assigned Cases for this contact') }}</small>
                                </div>
                                <div class="col">
                                    <div class="text-end">
                                        <a href="#" data-size="lg"
                                            data-url="{{ route('commoncases.create', ['contact', $contact->id]) }}"
                                            data-ajax-popup="true" data-bs-toggle="tooltip" title="{{ __('Create') }}"
                                            data-title="{{ __('Create New Common Case') }}"
                                            class="btn btn-sm btn-primary btn-icon-only ">
                                            <i class="ti ti-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table datatable" id="datatable2">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="sort" data-sort="name">{{ __('Name') }}</th>
                                            <th scope="col" class="sort" data-sort="budget">{{ __('Number') }}
                                            </th>
                                            <th scope="col" class="sort" data-sort="status">{{ __('Status') }}
                                            </th>
                                            <th scope="col" class="sort" data-sort="completion">
                                                {{ __('Priority') }}</th>
                                            <th scope="col" class="sort" data-sort="completion">
                                                {{ __('Created At') }}</th>
                                            @if (Gate::check('Show CommonCase') || Gate::check('Edit CommonCase') || Gate::check('Delete CommonCase'))
                                                <th scope="col" class="text-end">{{ __('Action') }}</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cases as $case)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('commoncases.edit', $case->id) }}" data-size="md"
                                                        data-title="{{ __('Cases Details') }}"
                                                        class="action-item text-primary">
                                                        {{ $case->name }}
                                                    </a>
                                                </td>
                                                <td class="budget">
                                                    {{ $case->number }}
                                                </td>
                                                <td>
                                                    @if ($case->status == 0)
                                                        <span
                                                            class="badge bg-primary p-2 px-3 rounded">{{ __(\App\Models\CommonCase::$status[$case->status]) }}</span>
                                                    @elseif($case->status == 1)
                                                        <span
                                                            class="badge bg-info p-2 px-3 rounded">{{ __(\App\Models\CommonCase::$status[$case->status]) }}</span>
                                                    @elseif($case->status == 2)
                                                        <span
                                                            class="badge bg-warning p-2 px-3 rounded">{{ __(\App\Models\CommonCase::$status[$case->status]) }}</span>
                                                    @elseif($case->status == 3)
                                                        <span
                                                            class="badge bg-danger p-2 px-3 rounded">{{ __(\App\Models\CommonCase::$status[$case->status]) }}</span>
                                                    @elseif($case->status == 4)
                                                        <span
                                                            class="badge bg-danger p-2 px-3 rounded">{{ __(\App\Models\CommonCase::$status[$case->status]) }}</span>
                                                    @elseif($case->status == 5)
                                                        <span
                                                            class="badge bg-warning p-2 px-3 rounded">{{ __(\App\Models\CommonCase::$status[$case->status]) }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($case->priority == 0)
                                                        <span
                                                            class="badge bg-primary p-2 px-3 rounded">{{ __(\App\Models\CommonCase::$priority[$case->priority]) }}</span>
                                                    @elseif($case->priority == 1)
                                                        <span
                                                            class="badge bg-info p-2 px-3 rounded">{{ __(\App\Models\CommonCase::$priority[$case->priority]) }}</span>
                                                    @elseif($case->priority == 2)
                                                        <span
                                                            class="badge bg-warning p-2 px-3 rounded">{{ __(\App\Models\CommonCase::$priority[$case->priority]) }}</span>
                                                    @elseif($case->priority == 3)
                                                        <span
                                                            class="badge bg-danger p-2 px-3 rounded">{{ __(\App\Models\CommonCase::$priority[$case->priority]) }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span
                                                        class="budget">{{ \Auth::user()->dateFormat($case->created_at) }}</span>
                                                </td>
                                                @if (Gate::check('Show CommonCase') || Gate::check('Edit CommonCase') || Gate::check('Delete CommonCase'))
                                                    <td class="text-end">

                                                        @can('Show CommonCase')
                                                            <div class="action-btn bg-warning ms-2">
                                                                <a href="#" data-size="md"
                                                                    data-url="{{ route('commoncases.show', $case->id) }}"
                                                                    data-ajax-popup="true" data-bs-toggle="tooltip"
                                                                    title="{{ __('Quick View') }}"
                                                                    data-title="{{ __('Cases Details') }}"
                                                                    class="mx-3 btn btn-sm d-inline-flex align-items-center text-white">
                                                                    <i class="ti ti-eye"></i>
                                                                </a>
                                                            </div>
                                                        @endcan
                                                        @can('Edit CommonCase')
                                                            <div class="action-btn bg-info ms-2">
                                                                <a href="{{ route('commoncases.edit', $case->id) }}"
                                                                    class="mx-3 btn btn-sm d-inline-flex align-items-center text-white"
                                                                    data-bs-toggle="tooltip" title="{{ __('Details') }}"
                                                                    data-title="{{ __('Cases Edit') }}"><i
                                                                        class="ti ti-edit"></i></a>
                                                            </div>
                                                        @endcan
                                                        @can('Delete CommonCase')
                                                            <div class="action-btn bg-danger ms-2">
                                                                {!! Form::open(['method' => 'DELETE', 'route' => ['commoncases.destroy', $case->id]]) !!}
                                                                <a href="#!"
                                                                    class="mx-3 btn btn-sm  align-items-center text-white show_confirm"
                                                                    data-bs-toggle="tooltip" title='Delete'>
                                                                    <i class="ti ti-trash"></i>
                                                                </a>
                                                                {!! Form::close() !!}
                                                            </div>
                                                        @endcan

                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="useradd-9" class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h5>{{ __('Calls') }}</h5>
                                    <small class="text-muted">{{ __('Assigned Call for this contact') }}</small>
                                </div>
                                <div class="col">
                                    <div class="text-end">
                                        <a href="#" data-size="lg"
                                            data-url="{{ route('call.create', ['attendees_contact', 0]) }}"
                                            data-ajax-popup="true" data-bs-toggle="tooltip"
                                            data-title="{{ __('Create New Call') }}" title="{{ __('Create') }}"
                                            class="btn btn-sm btn-primary btn-icon-only ">
                                            <i class="ti ti-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table datatable" id="datatable3">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="sort" data-sort="name">{{ __('Name') }}</th>
                                            <th scope="col" class="sort" data-sort="budget">{{ __('Parent') }}
                                            </th>
                                            <th scope="col" class="sort" data-sort="status">{{ __('Status') }}
                                            </th>
                                            <th scope="col" class="sort" data-sort="completion">
                                                {{ __('Date Start') }}</th>
                                            <th scope="col" class="sort" data-sort="completion">
                                                {{ __('Assigned User') }}</th>
                                            @if (Gate::check('Show Call') || Gate::check('Edit Call') || Gate::check('Delete Call'))
                                                <th scope="col" class="text-end">{{ __('Action') }}</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($calls as $call)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('call.edit', $call->id) }}" data-size="md"
                                                        data-title="{{ __('Call') }}"
                                                        class="action-item text-primary">
                                                        {{ $call->name }}</a>
                                                </td>
                                                <td class="budget">
                                                    {{ ucfirst($call->parent) }}
                                                </td>
                                                <td>
                                                    @if ($call->status == 0)
                                                        <span class="badge bg-success p-2 px-3 rounded"
                                                            style="width: 73px;">{{ __(\App\Models\Call::$status[$call->status]) }}</span>
                                                    @elseif($call->status == 1)
                                                        <span class="badge bg-warning p-2 px-3 rounded"
                                                            style="width: 73px;">{{ __(\App\Models\Call::$status[$call->status]) }}</span>
                                                    @elseif($call->status == 2)
                                                        <span class="badge bg-danger p-2 px-3 rounded"
                                                            style="width: 73px;">{{ __(\App\Models\Call::$status[$call->status]) }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span
                                                        class="budget">{{ \Auth::user()->dateFormat($call->start_date) }}</span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="budget">{{ ucfirst(!empty($call->assign_user) ? $call->assign_user->name : '') }}</span>
                                                </td>
                                                @if (Gate::check('Show Call') || Gate::check('Edit Call') || Gate::check('Delete Call'))
                                                    <td class="text-end">
                                                        @can('Show Call')
                                                            <div class="action-btn bg-warning ms-2">
                                                                <a href="#" data-size="md"
                                                                    data-url="{{ route('call.show', $call->id) }}"
                                                                    data-ajax-popup="true" data-bs-toggle="tooltip"
                                                                    data-title="{{ __('Show Call') }}"
                                                                    title="{{ __('Quick View') }}"class="mx-3 btn btn-sm d-inline-flex align-items-center text-white  ">
                                                                    <i class="ti ti-eye"></i>
                                                                </a>
                                                            </div>
                                                        @endcan
                                                        @can('Edit Call')
                                                            <div class="action-btn bg-info ms-2">
                                                                <a href="{{ route('call.edit', $call->id) }}"
                                                                    class="mx-3 btn btn-sm d-inline-flex align-items-center text-white "
                                                                    data-bs-toggle="tooltip"
                                                                    data-title="{{ __('Edit Call') }}"title="{{ __('Details') }}"><i
                                                                        class="ti ti-edit"></i></a>
                                                            </div>
                                                        @endcan
                                                        @can('Delete Call')
                                                            <div class="action-btn bg-danger ms-2">
                                                                {!! Form::open(['method' => 'DELETE', 'route' => ['call.destroy', $call->id]]) !!}
                                                                <a href="#!"
                                                                    class="mx-3 btn btn-sm   align-items-center text-white show_confirm"
                                                                    data-bs-toggle="tooltip" title='Delete'>
                                                                    <i class="ti ti-trash"></i>
                                                                </a>
                                                                {!! Form::close() !!}
                                                            </div>
                                                        @endcan
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="useradd-10" class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h5>{{ __('Meetings') }}</h5>
                                    <small class="text-muted">{{ __('Assigned Meeting for this account') }}</small>
                                </div>
                                <div class="col">
                                    <div class="text-end">
                                        <a href="#" data-size="lg"
                                            data-url="{{ route('meeting.create', ['attendees_contact', 0]) }}"
                                            data-ajax-popup="true" data-bs-toggle="tooltip"
                                            data-title="{{ __('Create New Meeting') }}" title="{{ __('Create') }}"
                                            class="btn btn-sm btn-primary btn-icon-only ">
                                            <i class="ti ti-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table datatable" id="datatable3">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="sort" data-sort="name">{{ __('Name') }}</th>
                                            <th scope="col" class="sort" data-sort="status">{{ __('Status') }}
                                            </th>
                                            <th scope="col" class="sort" data-sort="completion">
                                                {{ __('Date Start') }}</th>
                                            <th scope="col" class="sort" data-sort="completion">
                                                {{ __('Assigned User') }}</th>
                                            @if (Gate::check('meeting show') || Gate::check('meeting edit') || Gate::check('meeting delete'))
                                                <th scope="col" class="text-end">{{ __('Action') }}</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($meetings as $meeting)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('meeting.edit', $meeting->id) }}" data-size="md"
                                                        data-title="{{ __('Meeting') }}"
                                                        class="action-item text-primary">
                                                        {{ $meeting->name }}</a>
                                                </td>
                                                <td>
                                                    <span class="budget">{{ ucfirst($meeting->parent) }}</span>
                                                </td>
                                                <td>
                                                    @if ($meeting->status == 0)
                                                        <span class="badge bg-success p-2 px-3 rounded"
                                                            style="width: 73px;">{{ __(\App\Models\Meeting::$status[$meeting->status]) }}</span>
                                                    @elseif($meeting->status == 1)
                                                        <span class="badge bg-warning p-2 px-3 rounded"
                                                            style="width: 73px;">{{ __(\App\Models\Meeting::$status[$meeting->status]) }}</span>
                                                    @elseif($meeting->status == 2)
                                                        <span class="badge bg-danger p-2 px-3 rounded"
                                                            style="width: 73px;">{{ __(\App\Models\Meeting::$status[$meeting->status]) }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span
                                                        class="budget">{{ \Auth::user()->dateFormat($meeting->start_date) }}</span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="budget">{{ ucfirst(!empty($meeting->assign_user) ? $meeting->assign_user->name : '') }}</span>
                                                </td>
                                                @if (Gate::check('Show Meeting') || Gate::check('Edit Meeting') || Gate::check('Delete Meeting'))
                                                    <td class="text-end">
                                                        @can('Show Meeting')
                                                            <div class="action-btn bg-warning ms-2">
                                                                <a href="#" data-size="md"
                                                                    data-url="{{ route('meeting.show', $meeting->id) }}"
                                                                    data-ajax-popup="true" data-bs-toggle="tooltip"
                                                                    data-title="{{ __('Meeting Details') }}"title="{{ __('Quick View') }}"
                                                                    class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                                    <i class="ti ti-eye"></i>
                                                                </a>
                                                            </div>
                                                        @endcan
                                                        @can('Edit Meeting')
                                                            <div class="action-btn bg-info ms-2">
                                                                <a href="{{ route('meeting.edit', $meeting->id) }}"
                                                                    class="mx-3 btn btn-sm d-inline-flex align-items-center text-white"
                                                                    data-bs-toggle="tooltip"
                                                                    data-title="{{ __('Edit Meeting') }}"
                                                                    title="{{ __('Details') }}"><i
                                                                        class="ti ti-edit"></i></a>
                                                            </div>
                                                        @endcan
                                                        @can('Delete Meeting')
                                                            <div class="action-btn bg-danger ms-2">
                                                                {!! Form::open(['method' => 'DELETE', 'route' => ['meeting.destroy', $meeting->id]]) !!}
                                                                <a href="#!"
                                                                    class="mx-3 btn btn-sm   align-items-center text-white show_confirm"
                                                                    data-bs-toggle="tooltip" title='Delete'>
                                                                    <i class="ti ti-trash"></i>
                                                                </a>
                                                                {!! Form::close() !!}
                                                            </div>
                                                        @endcan
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ sample-page ] end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
    @endsection
    @push('script-page')
    <script>
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#useradd-sidenav',
            offset: 300
        })
    </script>
    <script>
        $(document).on('change', 'select[name=parent]', function() {
            console.log('click');
            var parent = $(this).val();
            getparent(parent);
        });

        function getparent(bid) {
            console.log('getparent', bid);
            $.ajax({
                url: '{{ route('task.getparent') }}',
                type: 'POST',
                data: {
                    "parent": bid,
                    "_token": "{{ csrf_token() }}",
                },
                success: function(data) {
                    console.log('get data');
                    console.log(data);
                    $('#parent_id').empty();
                    {{-- $('#parent_id').append('<option value="">{{__('Select Parent')}}</option>'); --}}

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
        })

        $(document).on('change', 'select[name=opportunity]', function() {

            var opportunities = $(this).val();
            console.log(opportunities);
            getaccount(opportunities);
        });

        function getaccount(opportunities_id) {
            $.ajax({
                url: '{{ route('quote.getaccount') }}',
                type: 'POST',
                data: {
                    "opportunities_id": opportunities_id,
                    "_token": "{{ csrf_token() }}",
                },
                success: function(data) {
                    console.log(data);
                    $('#amount').val(data.opportunitie.amount);
                    $('#name').val(data.opportunitie.name);
                    $('#account_name').val(data.account.name);
                    $('#account_id').val(data.account.id);
                    $('#billing_address').val(data.account.billing_address);
                    $('#shipping_address').val(data.account.shipping_address);
                    $('#billing_city').val(data.account.billing_city);
                    $('#billing_state').val(data.account.billing_state);
                    $('#shipping_city').val(data.account.shipping_city);
                    $('#shipping_state').val(data.account.shipping_state);
                    $('#billing_country').val(data.account.billing_country);
                    $('#billing_postalcode').val(data.account.billing_postalcode);
                    $('#shipping_country').val(data.account.shipping_country);
                    $('#shipping_postalcode').val(data.account.shipping_postalcode);

                }
            });
        }
    </script>
    <script>
        $(document).on('change', 'select[name=parent]', function() {
            var parent = $(this).val();

            getparent(parent);
        });

        function getparent(bid) {
            console.log(bid);
            $.ajax({
                url: '{{ route('call.getparent') }}',
                type: 'POST',
                data: {
                    "parent": bid,
                    "_token": "{{ csrf_token() }}",
                },
                success: function(data) {
                    console.log(data);
                    $('#parent_id').empty();
                    {{-- $('#parent_id').append('<option value="">{{__('Select Parent')}}</option>'); --}}

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
@endpush
