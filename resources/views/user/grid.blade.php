@php
$profile=\App\Models\Utility::get_file('upload/profile/');
@endphp

@extends('layouts.admin')
@section('page-title')
    {{ __('User') }}
@endsection
@section('title')
    <div class="page-header-title">
        <h4 class="m-b-10">{{ __('Users') }}</h4>
    </div>
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('User') }}</li>
@endsection
@section('action-btn')
    <a href="{{ route('user.index') }}" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="tooltip"
        title="{{ __('List View') }}">
        <i class="ti ti-list text-white"></i>
    </a>
    @can('Create User')

            <a href="#" data-url="{{ route('user.create') }}" data-size="md" data-ajax-popup="true" data-bs-toggle="tooltip"
                title="{{ __('Create') }}" data-title="{{ __('Create New User') }}"
                class="btn btn-sm btn-primary btn-icon">
                <i class="ti ti-plus"></i>
            </a>

        @endif
    @endsection
    @section('filter')
    @endsection

    @section('content')
        @if (\Auth::user()->type != 'super admin')
            <div class="row">
                 @foreach ($users as $user)
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="card-header border-0 pb-0">
                                <div class="d-flex align-items-center">
                                    @if (!empty($user->getRoleNames()))
                                    <div class="badge-container">
                                        @foreach ($user->getRoleNames() as $v  )
                                            <label class="badge bg-primary p-2 px-2 rounded">{{ $v }}</label>
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                                <div class="card-header-right">
                                    <div class="btn-group card-option">
                                        <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="feather icon-more-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            @if (Gate::check('Create User') || Gate::check('Edit User') || Gate::check('Delete User'))
                                                {{-- @can('Manage Plan')

                                                <a href="#" data-url="{{ route('plan.upgrade',$user->id) }}"
                                                    data-bs-toggle="modal" data-bs-target="#exampleModal" data-ajax-popup="true"
                                                    data-size="md" title="{{ __('Upgrade Plan') }}" class="dropdown-item"
                                                    data-bs-toggle="tooltip" data-bs-whatever="{{ __('Upgrade Plan') }}"
                                                    data-title=" {{ __('Upgrade Plan') }}"><i class="ti ti-trophy"></i>
                                                    {{ __('Upgrade Plan') }}
                                                </a>
                                                @endcan      --}}
                                                @can('Edit User')
                                                    <a href="{{ route('user.edit', $user->id) }}" class="dropdown-item"
                                                        data-bs-whatever="{{ __('Edit User') }}" data-bs-toggle="tooltip"
                                                        data-title="{{ __('Edit User') }}"><i class="ti ti-edit"></i>
                                                        {{ __('Edit') }}</a>
                                                @endcan
                                                @can('Create User')
                                                    <a href="#" data-url="{{ route('user.show', $user->id) }}"
                                                        data-ajax-popup="true" data-size="md" class="dropdown-item"
                                                        data-bs-whatever="{{ __('User Details') }}" data-bs-toggle="tooltip"
                                                        data-title="{{ __('User Details') }}"><i class="ti ti-eye"></i>
                                                        {{ __('Details') }}</a>
                                                @endcan
                                                <a href="#" data-url="{{ route('user.reset', \Crypt::encrypt($user->id)) }}"
                                                    data-bs-toggle="modal" data-bs-target="#exampleModal" data-ajax-popup="true"
                                                    data-size="md" title="{{ __('Reset Password') }}" class="dropdown-item"
                                                    data-bs-toggle="tooltip" data-bs-whatever="{{ __('Reset Password') }}"
                                                    data-title=" {{ __('Reset Password') }}"><i class="ti ti-trophy"></i>
                                                    {{ __('Reset Password') }}
                                                </a>
                                                @can('Delete User')
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['user.destroy', $user->id]]) !!}
                                                    <a href="#!" class="dropdown-item  show_confirm" data-bs-toggle="tooltip">
                                                        <i class="ti ti-trash"></i>
                                                        {{ __('Delete') }}
                                                    </a>
                                                    {!! Form::close() !!}
                                                @endcan
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row g-2 justify-content-between">
                                    <div class="col-12">
                                        <div class="text-center client-box">
                                            <div class="avatar-parent-child">

                                                <a href="{{ $profile}}{{ !empty($user->avatar)?$user->avatar:'avatar.png' }}" target="_blank">
                                                    <img class="rounded-circle" width="25%" @if($user->avatar) src="{{$profile}}{{ !empty($user->avatar)?$user->avatar:'avatar.png' }}" @else src="{{ $profile.'avatar.png' }}" @endif  alt="{{ $user->name }}">
                                                </a>
                                                {{-- <a href="{{ asset(Storage::url("upload/profile/")).'/'}}{{ !empty($user->avatar)?$user->avatar:'avatar.png' }}" target="_blank">
                                                    <img alt="" alt="user-image" src="{{ asset(Storage::url("upload/profile/")).'/'}}{{ !empty($user->avatar)?$user->avatar:'avatar.png' }}"  class="img-fluid rounded-circle">
                                                </a> --}}

                                            </div>


                                            <h5 class="h6 mt-4 mb-1">
                                                <a href="#" data-size="md"
                                                    data-url="{{ route('user.show',$user->id) }}"
                                                    data-ajax-popup="true" data-title="{{ __('User Details') }}"
                                                    class="action-item text-primary">
                                                    {{ ucfirst($user->name) }}
                                                </a>
                                            </h5>
                                            <a href="#" class="d-block text-sm text-muted mb-3"> {{ $user->email }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-md-3">
                    <a href="#" class="btn-addnew-project" data-ajax-popup="true" data-size="md"
                        data-title="{{ __('Create New User') }}" data-url="{{ route('user.create') }}">
                        <div class="badge bg-primary proj-add-icon">
                            <i class="ti ti-plus"></i>
                        </div>
                        <h6 class="mt-4 mb-2">New User</h6>
                        <p class="text-muted text-center">Click here to add New User</p>
                    </a>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-xxl-12">
                    <div class="row">
                        @foreach ($users as $user)
                            <div class="col-md-3">
                                <div class="card text-center">
                                    <div class="card-header border-0 pb-0">


                                        <div class="card-header-right">
                                            <div class="btn-group card-option">

                                                <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <i class="feather icon-more-vertical"></i>
                                                </button>

                                                <div class="dropdown-menu dropdown-menu-end">

                                                    @can('Edit User')
                                                        <a href="{{ route('user.edit', $user->id) }}" class="dropdown-item"
                                                            data-bs-whatever="{{ __('Edit User') }}" data-bs-toggle="tooltip"
                                                            data-title="{{ __('Edit User') }}"><i class="ti ti-edit"></i>
                                                            {{ __('Edit') }}</a>
                                                    @endcan


                                                    <a href="#" data-url="{{ route('user.reset', \Crypt::encrypt($user->id)) }}"
                                                        data-bs-toggle="modal" data-size="md" data-bs-target="#exampleModal"
                                                        data-ajax-popup="true" class="dropdown-item" data-bs-toggle="tooltip"
                                                        data-bs-whatever="{{ __('Reset Password') }}"
                                                        data-title=" {{ __('Reset Password') }}"><i
                                                            class="ti ti-key"></i>
                                                        {{ __('Reset Password') }}
                                                    </a>

                                                    @can('Delete User')
                                                        {!! Form::open(['method' => 'DELETE', 'route' => ['user.destroy', $user->id]]) !!}
                                                        <a href="#!" class="dropdown-item  show_confirm" data-bs-toggle="tooltip">
                                                            <i class="ti ti-trash"></i>{{ __('Delete') }}
                                                        </a>
                                                        {!! Form::close() !!}
                                                    @endcan
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="avatar-parent-child">
                                                {{-- <a href="{{ asset(Storage::url("upload/profile/")).'/'}}{{ !empty($user->avatar)?$user->avatar:'avatar.png' }}" target="_blank">
                                                    <img alt="" alt="user-image" src="{{ asset(Storage::url("upload/profile/")).'/'}}{{ !empty($user->avatar)?$user->avatar:'avatar.png' }}"  class="img-fluid rounded-circle">
                                                </a> --}}

                                                <a href="{{ $profile }}{{ !empty($user->avatar)?$user->avatar:'avatar.png' }}" target="_blank">
                                                <img class="rounded-circle" width="25%" @if($user->avatar) src="{{$profile}}{{ !empty($user->avatar)?$user->avatar:'avatar.png' }}" @else src="{{ $profile.'avatar.png' }}" @endif  alt="{{ $user->name }}">
                                                </a>
                                            </div>
                                            <h5 class="h6 mt-4 mb-0 text-primary"> {{ $user->name }}</h5>
                                            <a href="#" class="d-block text-sm text-muted mb-3"> {{ $user->email }}</a>

                                            <p></p>

                                                    <div class="mt-4">
                                                        <div class="row justify-content-between align-items-center">
                                                            <div class="col-6 text-center mb-2">
                                                                <span class="d-block font-bold mb-0">{{ !empty($user->currentPlan) ? $user->currentPlan->name : '' }}</span>
                                                            </div>
                                                            <div class="col-6 text-center Id mb-2">
                                                                <a href="#" data-url="{{ route('plan.upgrade', $user->id) }}"
                                                                    data-size="md" data-ajax-popup="true"
                                                                    data-title="{{ __('Upgrade Plan') }}"
                                                                    class="btn small--btn btn-outline-primary text-sm">{{ __('Upgrade Plan') }}</a>
                                                            </div>
                                                            <div class="col-12">
                                                                <hr class="my-3">
                                                            </div>

                                                            <div class="col-12 text-center pb-2">
                                                                <span class="d-block text-sm text-muted">{{ __('Plan Expired') }} :
                                                                    {{ !empty($user->plan_expire_date) ? \Auth::user()->dateFormat($user->plan_expire_date) : 'lifetime' }}</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row mt-3">
                                                        <div class="col-12 col-sm-12">
                                                            <div class="card mb-0">
                                                                <div class="card-body p-3">
                                                                    <div class="row">

                                                                        <div class="col-4">
                                                                            <p class="text-muted text-sm mb-0" data-bs-toggle="tooltip" title="{{__('Users')}}"><i class="ti ti-user card-icon-text-space"></i>{{ $user->countUser($user->id) }}</p>
                                                                        </div>
                                                                        <div class="col-4">
                                                                            <p class="text-muted text-sm mb-0" data-bs-toggle="tooltip" title="{{__('Account')}}"><i class="ti ti-building card-icon-text-space"></i>{{ $user->countAccount($user->id) }}</p>
                                                                        </div>
                                                                        <div class="col-4">
                                                                            <p class="text-muted text-sm mb-0" data-bs-toggle="tooltip" title="{{__('Contact')}}"><i class="ti ti-file-phone card-icon-text-space"></i>{{ $user->countContact($user->id) }}</p>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- <div class="col-4 text-center">
                                                        <span class="d-block h4 mb-0">{{ $user->countUser($user->id) }}</span>
                                                        <span class="d-block text-sm text-muted">{{ __('User') }}</span>
                                                    </div>
                                                    <div class="col-4 text-center">
                                                        <span class="d-block h4 mb-0">{{ $user->countAccount($user->id) }}</span>
                                                        <span class="d-block text-sm text-muted">{{ __('Account') }}</span>
                                                    </div>
                                                    <div class="col-4 text-center">
                                                        <span class="d-block h4 mb-0">{{ $user->countContact($user->id) }}</span>
                                                        <span class="d-block text-sm text-muted">{{ __('Contact') }}</span>
                                                    </div> --}}


                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="col-md-3">
                            <a href="#" class="btn-addnew-project" data-ajax-popup="true" data-size="md"
                                data-title="{{ __('Create New User') }}" data-url="{{ route('user.create') }}">
                                <div class="badge bg-primary proj-add-icon">
                                    <i class="ti ti-plus"></i>
                                </div>
                                <h6 class="mt-4 mb-2">New User</h6>
                                <p class="text-muted text-center">Click here to add New User</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endsection
