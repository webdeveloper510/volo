@extends('layouts.admin')
@section('page-title')
    {{ __('Campaign') }}
@endsection
@section('title')
    {{ __('Campaign') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('Home')}}</a></li>
    <li class="breadcrumb-item">{{__('Campaign')}}</li>
@endsection
@section('action-btn')
    <a href="{{ route('campaign.index') }}" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="tooltip"
        title="{{ __('List View') }}">
        <i class="ti ti-list text-white"></i>
    </a>

    @can('Create Campaign')
            <a href="#" data-size="lg" data-url="{{ route('campaign.create', ['campaign', 0]) }}" data-ajax-popup="true"
                data-bs-toggle="tooltip" data-title="{{ __('Create New Campaign') }}" title="{{ __('Create') }}" class="btn btn-sm btn-primary btn-icon m-1">
                <i class="ti ti-plus"></i>
            </a>
    @endcan
@endsection
@section('filter')
@endsection
@section('content')
<div class="row">
    @foreach ($campaigns as $campaign)
        <div class="col-md-3">
            <div class="card">
                <div class="card-header border-0 pb-0">
                    <div class="d-flex align-items-center">
                        @if ($campaign->status == 0)
                        <span
                            class="badge bg-warning p-2 px-3 rounded">{{ __(\App\Models\Campaign::$status[$campaign->status]) }}</span>
                        @elseif($campaign->status == 1)
                            <span
                                class="badge bg-success p-2 px-3 rounded">{{ __(\App\Models\Campaign::$status[$campaign->status]) }}</span>
                        @elseif($campaign->status == 2)
                            <span
                                class="badge bg-danger p-2 px-3 rounded">{{ __(\App\Models\Campaign::$status[$campaign->status]) }}</span>
                        @elseif($campaign->status == 3)
                            <span
                                class="badge bg-info p-2 px-3 rounded">{{ __(\App\Models\Campaign::$status[$campaign->status]) }}</span>
                        @endif
                    </div>
                    <div class="card-header-right">
                        <div class="btn-group card-option">
                            <button type="button" class="btn dropdown-toggle"
                                data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="feather icon-more-vertical"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                    @if (Gate::check('Show Campaign') || Gate::check('Edit Campaign') || Gate::check('Delete Campaign'))

                                    @can('Edit Campaign')
                                        <a href="{{ route('campaign.edit', $campaign->id) }}"
                                            class="dropdown-item" data-bs-whatever="{{ __('Edit Campaign') }}"
                                            data-bs-toggle="tooltip" 
                                            data-title="{{ __('Edit Campaign') }}"><i class="ti ti-edit"></i>
                                            {{ __('Edit') }}</a>
                                    @endcan
                                    @can('Show Campaign')
                                        <a href="#" data-url="{{ route('campaign.show', $campaign->id) }}"
                                            data-ajax-popup="true" data-size="md"class="dropdown-item"
                                            data-bs-whatever="{{ __('Campaign Details') }}"
                                            data-bs-toggle="tooltip" 
                                            data-title="{{ __('Campaign Details') }}"><i class="ti ti-eye"></i>
                                            {{ __('Details') }}</a>
                                    @endcan

                                    @can('Delete Campaign')
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['campaign.destroy', $campaign->id]]) !!}
                                        <a href="#!" class="dropdown-item show_confirm" data-bs-toggle="tooltip" >
                                            <i class="ti ti-trash"></i>{{ __('Delete') }}
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
                                    {{-- <img @if (!empty($employee->avatar)) src="{{ $profile . '/' . $employee->avatar }}" @else
                                                    avatar="{{ $employee->name }}" @endif
                                                class="avatar rounded-circle avatar-lg"> --}}
                                    <img alt="user-image" class="img-fluid rounded-circle" @if (!empty($campaign->avatar)) src="{{ !empty($campaign->avatar) ? asset(Storage::url('upload/profile/' . $campaign->avatar)) : asset(url('./assets/img/clients/160x160/img-1.png')) }}" @else  avatar="{{ $campaign->name }}" @endif>
                                </div>
                                <h5 class="h6 mt-3 mb-1 text-primary">
                                    {{ ucfirst($campaign->name) }}
                                </h5>
                                <div class="mb-1"><a href="#" class="text-sm small text-muted">{{ $campaign->email }}</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <div class="col-md-3">
                    
        <a href="#" class="btn-addnew-project"  data-ajax-popup="true" data-size="lg" data-title="{{ __('Create New Campaign') }}" data-url="{{ route('campaign.create', ['campaign', 0]) }}">
             <div class="badge bg-primary proj-add-icon">
                <i class="ti ti-plus"></i>
            </div>
            <h6 class="mt-4 mb-2">New Campaign</h6>
            <p class="text-muted text-center">Click here to add New Campaign</p>
        </a>
     </div>
</div>






@endsection
