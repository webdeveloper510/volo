@extends('layouts.admin')
@section('page-title')
    {{ __('Lead Source') }}
@endsection
@section('title')
    {{ __('Lead Source') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item">{{ __('Constant') }}</li>
    <li class="breadcrumb-item">{{ __('Lead Source') }}</li>
@endsection
@section('action-btn')
    @can('Create LeadSource')
        <div class="action-btn ms-2">
            <a href="#" data-size="md" data-url="{{ route('lead_source.create') }}" data-ajax-popup="true"
                data-bs-toggle="tooltip" data-title="{{ __('Create New Source') }}" title="{{ __('Create') }}"
                class="btn btn-sm btn-primary btn-icon m-1">
                <i class="ti ti-plus"></i>
            </a>
        </div>
    @endcan
@endsection
@section('filter')
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive overflow_hidden">
                        <table id="datatable" class="table datatable align-items-center">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name">{{ __('Lead Source') }}</th>
                                    @if (Gate::check('Edit LeadSource') || Gate::check('Delete LeadSource'))
                                        <th class="text-end">{{ __('Action') }}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lead_sources as $lead_source)
                                    <tr>
                                        <td class="sorting_1">{{ $lead_source->name }}</td>
                                        @if (Gate::check('Edit LeadSource') || Gate::check('Delete LeadSource'))
                                            <td class="action text-end">
                                                @can('Edit LeadSource')
                                                    <div class="action-btn bg-info ms-2">
                                                        <a href="#" data-size="md"
                                                            data-url="{{ route('lead_source.edit', $lead_source->id) }}"
                                                            data-ajax-popup="true" data-bs-toggle="tooltip"
                                                            data-title="{{ __('Edit lead_source') }}"
                                                            title="{{ __('Edit') }}"
                                                            class="mx-3 btn btn-sm d-inline-flex align-items-center text-white">
                                                            <i class="ti ti-edit"></i>
                                                        </a>
                                                    </div>
                                                @endcan
                                                @can('Delete LeadSource')
                                                    <div class="action-btn bg-danger ms-2 float-end">
                                                        {!! Form::open(['method' => 'DELETE', 'route' => ['lead_source.destroy', $lead_source->id]]) !!}
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
    </div>
@endsection
